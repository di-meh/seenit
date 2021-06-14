<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubseenitController;
use App\Models\Subseenit;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('s/{slug}', [SubseenitController::class, 'show'])->name('subseenits.show');
Route::get('p/{postId}', [PostController::class, 'show'])->name('subseenits.posts.show');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/subseenits', function () {
        return Inertia::render('Seenit/Subseenits', [
            "subseenits" => Subseenit::all(['slug', 'name', 'description'])
        ]);
    })->name('subseenits');
    Route::resource('subseenits', SubseenitController::class)->except('show');
    Route::resource('subseenits.posts', PostController::class)->except('show');
    Route::resource('posts.comments', CommentController::class);
});

