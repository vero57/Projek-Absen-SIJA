<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\dash_feature\AbsensiController;
use App\Http\Controllers\dashboard\dash_feature\JurnalController;
use App\Http\Controllers\dashboard\dash_feature\UsersController;
use App\Http\Controllers\dashboard\dash_feature\PelanggaranController;
use App\Http\Controllers\dashboard\dash_feature\IzinController;

// Admin dan Guru
Route::middleware(['userakses:Admin,Guru'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.dash');
    Route::get('/dashboard/absensi', [AbsensiController::class, 'index'])->name('dashboard.absensi');
    Route::get('/dashboard/jurnal', [JurnalController::class, 'index'])->name('dashboard.jurnal');
});

// Hanya Admin
Route::middleware(['userakses:Admin'])->group(function () {
    Route::resource('/dashboard/users', UsersController::class, [
        'as' => 'dashboard'
    ]);
});
Route::get('/dashboard/absensi', [AbsensiController::class, 'index'])->name('dashboard.absensi');
Route::get('/dashboard/jurnal', [JurnalController::class, 'index'])->name('dashboard.jurnal');
Route::get('/dashboard/pelanggaran', [PelanggaranController::class, 'index'])->name('dashboard.pelanggaran');
Route::get('/dashboard/izin', [IzinController::class, 'index'])->name('dashboard.izin');
