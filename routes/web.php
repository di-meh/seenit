<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubseenitController;
use App\Models\Subseenit;

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
    return view('home');
});

Route::get('s/{slug}', [SubseenitController::class, 'show'])->name('subseenits.show');
Route::get('p/{postId}', [PostController::class, 'show'])->name('subseenits.posts.show');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    Route::get('subseenits', [SubseenitController::class, 'index'])->name('subseenits');
    // Route::resource('subseenits', SubseenitController::class)->except('show');
    Route::resource('subseenits.posts', PostController::class)->except('show');
    Route::resource('posts.comments', CommentController::class);
    Route::post('/subseenits/store', [SubseenitController::class, 'store'])
        ->middleware(['auth'])->name('subseenits_store');
    Route::post('/subseenits/create', [SubseenitController::class, 'create'])
        ->middleware(['auth'])->name('subseenits_create');
});
