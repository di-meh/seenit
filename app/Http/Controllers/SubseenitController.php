<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subseenit;
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
        return view('subseenits', ['subseenits' => $subseenits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $subseenits = Subseenit::all();

        return view('subseenitsCreate', compact('subseenits'));
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
        $posts = $subseenit->posts()->paginate(15);
        return view('subseenitShow', ['subseenit' => $subseenit, 'posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subseenit  $subseenit
     * @return \Illuminate\Http\Response
     */
    public function edit(Subseenit $subseenit)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subseenit  $subseenit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subseenit $subseenit)
    {
        //
    }
}
