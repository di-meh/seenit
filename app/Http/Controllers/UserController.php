<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($username) {
        $user = User::where('username', $username)->firstOrFail();
        $posts = $user->posts()->paginate(50);

        return view('users.index', compact('user', 'posts'));

    }
}
