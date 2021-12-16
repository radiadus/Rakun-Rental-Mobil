<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('home');
});
Route::get('/landing', [CarController::class, 'show'])->name('landing');
Route::get('/sewa/{id}', [CarController::class, 'detail']);
Route::get('/{page}', [UserController::class, 'index']);

Route::put('/edit', [UserController::class, 'edit']);

Route::post('/reservasi', [CarController::class, 'reservasi']);

Route::post('/register', [UserController::class, 'insert']);

Route::post('/login', [UserController::class, 'authenticate']);

Route::post('/logout', [UserController::class, 'logout']);


// Google login
Route::get('login/google', [App\Http\Controllers\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [App\Http\Controllers\LoginController::class, 'handleGoogleCallback']);
