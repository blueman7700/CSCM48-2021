<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostController::class, 'apiIndex'])->name('api.posts.index');

Route::post('/posts/likes/up', [PostController::class, 'apiIncLikes'])->name('api.posts.likes.up');

Route::post('/posts/likes/down', [PostController::class, 'apiDecLikes'])->name('api.posts.likes.down');

Route::get('/posts/user/{id}', [PostController::class, 'apiIndexFrom'])->name('api.posts.index.from');

Route::get('/posts/{id}/likes', [PostController::class, 'apiGetLikes'])->name('api.posts.likes');

Route::get('/posts/{id}/comments', [PostController::class, 'apiGetCommentsFor'])->name('api.posts.comments');

Route::get('/posts/{id}', [PostController::class, 'apiGetOne'])->name('api.posts.get');

Route::get('/users/{id}', [UserController::class, 'apiGetOne'])->name('api.users.get');

Route::post('/comments/store', [CommentController::class, 'apiStore'])->name('api.comments.store');





