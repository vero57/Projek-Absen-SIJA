<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landing\HomeController;
use App\Http\Controllers\feature\AbsenController;

Route::get('/', [HomeController::class, 'index'])->name('landing.home');
Route::get('/absen', [AbsenController::class, 'index'])->name('feature.absen');