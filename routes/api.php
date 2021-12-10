<?php

use App\Http\Controllers\PostController;
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

Route::get('/posts/user/{id}', [PostController::class, 'apiIndexFrom'])->name('api.posts.index.from');

Route::get('/posts/{id}', [PostController::class, 'apiGetOne'])->name('api.posts.get.one');