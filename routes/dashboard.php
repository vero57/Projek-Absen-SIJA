<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\dash_feature\AbsensiController;
use App\Http\Controllers\dashboard\dash_feature\JurnalController;
use App\Http\Controllers\dashboard\dash_feature\UsersController;
use App\Http\Controllers\dashboard\dash_feature\PelanggaranController;
use App\Http\Controllers\dashboard\dash_feature\IzinController;
use App\Http\Controllers\dashboard\dash_feature\SiswaController;

// Admin dan Guru
Route::middleware(['userakses:Admin,Guru'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.dash');
    Route::get('/dashboard/absensi', [AbsensiController::class, 'index'])->name('dashboard.absensi');
    Route::get('/dashboard/jurnal', [JurnalController::class, 'index'])->name('dashboard.jurnal');
    Route::get('/dashboard/siswa', [SiswaController::class, 'index'])->name('dashboard.siswa');
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

// Tambah detail siswa (bukan edit user, tapi tambah detail student)
Route::get('/dashboard/siswa/{user}/detail', [\App\Http\Controllers\dashboard\dash_feature\SiswaController::class, 'createDetail'])->name('dashboard.siswa.detail.create');
Route::post('/dashboard/siswa/{user}/detail', [\App\Http\Controllers\dashboard\dash_feature\SiswaController::class, 'storeDetail'])->name('dashboard.siswa.detail.store');
