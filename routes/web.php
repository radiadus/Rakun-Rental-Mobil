<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/alltransactionlist', [TransactionController::class, 'viewtransaction']);
Route::get('/userlist', [UserController::class, 'viewuser']);
Route::get('/history', [TransactionController::class, 'viewuserhistory']);
Route::get('/available/{id}', [CarController::class, 'makeavailable']);
Route::get('/notavailable/{id}', [CarController::class, 'makenotavailable']);

// Route::get('/{page}', [UserController::class, 'index']);

Route::put('/edit', [UserController::class, 'edit']);
Route::get('/edit', [UserController::class, 'editget']);

Route::post('/reservasi', [CarController::class, 'reservasi']);

Route::post('/register', [UserController::class, 'insert']);
Route::get('/register', [UserController::class, 'register']);

Route::post('/login', [UserController::class, 'authenticate']);
Route::get('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');


// Google login
Route::get('login/google', [App\Http\Controllers\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [App\Http\Controllers\LoginController::class, 'handleGoogleCallback']);
