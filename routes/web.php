<?php

use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::get('/register', [AuthenticatedController::class, 'register']);
Route::post('/store', [AuthenticatedController::class, "create"])->name('register');

Route::get('/loginView', [AuthenticatedController::class, "loginView"])->name('loginView');
Route::post('/login', [AuthenticatedController::class, "login"])->name('login');

Route::post('/create', [StoreController::class, "store"])->name('create');

Route::get('/home', [StoreController::class, "home"])->name('home')->middleware('auth');

Route::post('/logout', [AuthenticatedController::class, "logout"])->name('logout');

