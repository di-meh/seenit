<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subseenit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubseenitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subseenits = Subseenit::paginate(50);
        return view('subseenits.index', ['subseenits' => $subseenits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

//        $subseenits = Subseenit::all();

        return view('subseenits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subseenit = new Subseenit();
        $subseenit->name = $request->name;
        $subseenit->slug = $request->slug;
        $subseenit->description = $request->description;
        $subseenit->user_id = Auth::id();
        $subseenit->save();
        return redirect('subseenits');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subseenit  $subseenit
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $subseenit = Subseenit::where('slug', $slug)->firstOrFail();
        $posts = $subseenit->posts()->with('votes')->paginate(15);
        return view('subseenits.show', compact('subseenit', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subseenit  $subseenit
     * @return \Illuminate\Http\Response
     */
    public function edit(Subseenit $subseenit)
    {
        return auth()->id() == $subseenit->user->id ?  view('subseenits.edit', compact('subseenit')) : redirect()->route('subseenits', 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subseenit  $subseenit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subseenit $subseenit)
    {
        $subseenit->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return redirect()->route('subseenits')->with('message', 'Subseenit mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subseenit  $subseenit
     * @return \Illuminate\Http\Response
     */
    public function destroy($subseenitId)
    {
        $sub = Subseenit::find($subseenitId);
        $user = User::find(auth()->id());
        if ($sub->user_id != $user->id && !$user->is_admin) {
            return redirect('subseenits', 403);
        }
        $sub->delete();
        return redirect('subseenits')->with('message', 'Subseenit supprimé !');
    }
}
