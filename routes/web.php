<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Services\SocialMedia;

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

app()->singleton(SocialMedia::class, function ($app) {
    return new SocialMedia('key');
});

Route::get('/', function () {
    return redirect('/welcome', 301);
});

Route::get('/welcome', function () {
    return view('homepage');
});

Route::get('/social-media-share', [SocialShareButtonsController::class, 'ShareWidget']);

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/home', [UserController::class, 'home'])->middleware(['auth'])->name('users.home');

Route::get('/users/edit', [UserController::class, 'edit'])->middleware(['auth'])->name('users.edit');

Route::get('/users/stats', [UserController::class, 'stats'])->middleware(['auth'])->name('users.stats');

Route::delete('/users/delete', [UserController::class, 'destroy'])->middleware(['auth'])->name('users.delete');

Route::post('/users/update', [UserController::class, 'update'])->middleware(['auth'])->name('users.update');

Route::post('/users/update/image', [UserController::class, 'updateImage'])->middleware(['auth'])->name('users.update.image');

Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

Route::get('/posts/create', [PostController::class, 'create'])->middleware(['auth'])->name('posts.create');

Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');

Route::post('/posts/update/{id}', [PostController::class, 'update'])->middleware(['auth'])->name('posts.update');

Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->middleware(['auth'])->name('posts.edit');

Route::delete('/posts/delete/{id}', [PostController::class, 'destroy'])->middleware(['auth'])->name('posts.delete');

Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');

Route::get('/all', [PostController::class, 'index'])->middleware(['auth'])->name('posts.index');

Route::get('/logout', '\App\Http\Controllers\Auth\AuthenticatedSessionController@destroy');

Route::get('/dashboard', function () {
    return redirect('/users/home', 301);
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
