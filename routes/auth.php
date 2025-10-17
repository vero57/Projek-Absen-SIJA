<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginRegisterController;
use App\Http\Controllers\auth\dashboard\LoginDashController;

Route::get('/auth', [LoginRegisterController::class, 'showLoginRegister'])->name('auth.login-register');

// Landing auth
Route::post('/login', function () {
    return back()->with('status', 'Login dummy!');
})->name('login');

Route::post('/register', function () {
    return back()->with('status', 'Register dummy!');
})->name('register');

// Dashboard login routes
Route::get('/auth_dash', [LoginDashController::class, 'show'])->name('auth.login-dash');
Route::post('/auth_dash', [LoginDashController::class, 'login'])->name('login.dash');