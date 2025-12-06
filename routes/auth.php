<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginRegisterController;
use App\Http\Controllers\dashboard\SesiController;

// Siswa login/register
Route::get('/auth', [LoginRegisterController::class, 'showLoginRegister'])->name('auth.login-register');
Route::post('/auth/login-siswa', [LoginRegisterController::class, 'loginSiswa'])->name('auth.loginsiswa');
Route::post('/auth/logout-siswa', [LoginRegisterController::class, 'logoutSiswa'])->name('auth.logoutsiswa');
Route::post('/auth/register-siswa', [LoginRegisterController::class, 'registerSiswa'])->name('auth.registersiswa');

// Dashboard login routes (admin/guru)
Route::get('/auth_dash', [SesiController::class, 'showLoginForm'])->name('auth.login-dash');
Route::post('/auth_dash', [SesiController::class, 'login'])->name('login.dash');
Route::post('/logout_dash', [SesiController::class, 'logout'])->name('logout.dash');
