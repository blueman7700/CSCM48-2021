<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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
    return redirect('/welcome', 301);
});

Route::get('/welcome', function () {
    return view('homepage');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/home', [UserController::class, 'home'])->middleware(['auth'])->name('users.home');

Route::get('/users/edit', [UserController::class, 'edit'])->middleware(['auth'])->name('users.edit');

Route::post('/users/edit', [userController::class, 'edit.put'])->middleware(['auth']);

Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');

Route::get('/all', [PostController::class, 'index'])->name('posts.all');

Route::get('/logout', '\App\Http\Controllers\Auth\AuthenticatedSessionController@destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
