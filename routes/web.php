<?php

use App\Http\Controllers\BlogPostController;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';

Route::get('/', [BlogPostController::class, 'index'])->name('posts.index');
Route::get('/posts/{blogPost}', [BlogPostController::class, 'show'])->name('post.show');

Route::middleware('auth')->group(function (){
    Route::get('/my-posts', [BlogPostController::class, 'userPosts'])->name('posts.user');
});
