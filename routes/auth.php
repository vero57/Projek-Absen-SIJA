<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginRegisterController;

Route::get('/auth', [LoginRegisterController::class, 'showLoginRegister'])->name('auth.login-register');

// Dummy route untuk login dan register agar error hilang
Route::post('/login', function () {
    return back()->with('status', 'Login dummy!');
})->name('login');

Route::post('/register', function () {
    return back()->with('status', 'Register dummy!');
})->name('register');