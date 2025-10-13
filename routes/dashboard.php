<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\dash_feature\AbsensiController;
use App\Http\Controllers\dashboard\dash_feature\JurnalController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.dash');

Route::get('/dashboard/absensi', [AbsensiController::class, 'index'])->name('dashboard.absensi');
Route::get('/dashboard/jurnal', [JurnalController::class, 'index'])->name('dashboard.jurnal');