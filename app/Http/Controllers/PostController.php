<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subseenit;
use App\Notifications\PostReportNotification;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Subseenit $subseenit)
    {
//        dd($subseenit);
        return view('posts.create', ['subseenit' => $subseenit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Subseenit $subseenit)
    {
        $post = $subseenit->posts()->create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'post_text' => $request->post_text ?? null,
            'post_url' => $request->post_url ?? null,
        ]);
        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image')->getClientOriginalName();
            $request->file('post_image')
                ->storeAs('posts/' . $post->id, $image);
            $post->update(['post_image' => $image]);
            $file = Image::make(storage_path('app/public/posts/' . $post->id . '/' . $image));
            $file->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $file->save(storage_path('app/public/posts/' . $post->id . '/thumbnail_' . $image));
        }

        return redirect()->route('subseenits.show', $subseenit->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($postId)
    {
        $post = Post::where('id', $postId)->firstOrFail();
        $comments = $post->comments()->with('votes')->paginate(15);
        return view('posts.show', ['post' => $post, 'comments' =>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Subseenit $subseenit, Post $post)
    {
        return auth()->id() == $post->user->id ? view('posts.edit', compact('subseenit', 'post')) : redirect()->route('subseenits.show', 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subseenit $subseenit, Post $post)
    {
        $post->update([
            'title' => $request->title,
            'post_text' => $request->post_text,
            'post_url' => $request->post_url ?? $post->post_url
        ]);
        return redirect()->route('subseenits.show', $subseenit->slug)->with('message', 'Post mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subseenit $subseenit, Post $post)
    {
        if ($post->user_id != auth()->id() && $subseenit->user_id != auth()->id() && !auth()->user()->is_admin) {
            return redirect()->route('subseenits.show', [$subseenit->slug], 403);
        }
        $post->delete();
        return redirect()->route('subseenits.show', [$subseenit->slug])->with('message', 'Post supprimé !');
    }
    public function report($postId) {
        $post = Post::with('subseenit.user')->findOrFail($postId);
        $post->subseenit->user->notify(new PostReportNotification($post));
        return redirect()->route('subseenits.posts.show', $postId)->with('message', 'Post signalé!');
    }
}
