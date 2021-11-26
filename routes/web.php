<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

/*
|   Admin Routes
*/

Route::get('/users', [UserController::class, 'index'])->name('users.index');

/*
|   Public Routes
*/

Route::get('/users/register', [UserController::class, 'create'])->name('users.create');

Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::get('/{user}/home', [UserController::class, 'show'])->name('users.show');

Route::get('/{user}/options', function ($user) {
    return "whoops, looks like you're early!";
});

Route::get('/home', function () {
    return "Looks like nobody's home :<";
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
