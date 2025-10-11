<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landing\HomeController;
use App\Http\Controllers\feature\AbsenController;
use App\Http\Controllers\feature\IzinController;
use App\Http\Controllers\feature\JurnalController;
use App\Http\Controllers\landing\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('landing.home');
Route::get('/absen', [AbsenController::class, 'index'])->name('feature.absen');
Route::get('/izin', [IzinController::class, 'index'])->name('feature.izin');
Route::get('/jurnal', [JurnalController::class, 'index'])->name('feature.jurnal');
Route::get('/profile', [ProfileController::class, 'index'])->name('landing.profile');