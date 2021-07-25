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
    return redirect('subseenits');
})->name('root');

Route::get('s/{slug}', [SubseenitController::class, 'show'])->name('subseenits.show');
Route::get('p/{postId}', [PostController::class, 'show'])->name('subseenits.posts.show');
Route::get('subseenits', [SubseenitController::class, 'index'])->name('subseenits');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/home', function () {
        return redirect('subseenits');
    })->name('home');
    Route::resource('subseenits', SubseenitController::class)->except(['index','show', 'store','create','destroy']);
    Route::resource('subseenits.posts', PostController::class)->except('show');
    Route::resource('posts.comments', CommentController::class);
    Route::post('/subseenits/store', [SubseenitController::class, 'store'])->name('subseenits.store');
    Route::get('/subseenits/create', [SubseenitController::class, 'create'])->name('subseenits.create');
    Route::get('/subseenits/destroy/{subseenitId}', [SubseenitController::class, 'destroy'])->name('subseenits.destroy');
    Route::post('posts/{post_id}/report', [PostController::class, 'report'])->name('post.report');
});
