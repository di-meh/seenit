<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
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
    public function create(Post $post)
    {
        return view('comments.create', ['post' => $post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $comment = $post->comments()->create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'comment_text' => $request->comment_text
        ]);
        return redirect()->route('subseenits.posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Comment $comment)
    {
        return auth()->id() == $comment->user->id ? view('comments.edit', compact('post', 'comment')) : redirect()->route('subseenits.posts.show', 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        $comment->update([
            "comment_text" => $request->comment_text
        ]);
        return redirect()->route('subseenits.posts.show', $post->id)->with('message', 'Commentaire mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        if ($comment->user_id != auth()->id() && $post->user_id != auth()->id() && !auth()->user()->is_admin) {
            return redirect()->route('subseenits.posts.show', [$post->id], 403);
        }
        $comment->delete();
        return redirect()->route('subseenits.posts.show', [$post->id])->with('message', 'Commentaire supprimé !');
    }
}
