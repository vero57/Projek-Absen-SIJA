<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\dash_feature\AbsensiController;
use App\Http\Controllers\dashboard\dash_feature\JurnalController;
use App\Http\Controllers\dashboard\dash_feature\UsersController;
use App\Http\Controllers\dashboard\dash_feature\PelanggaranController;
use App\Http\Controllers\dashboard\dash_feature\IzinController;
use App\Http\Controllers\dashboard\dash_feature\SiswaController;
use App\Http\Controllers\dashboard\dash_feature\SubjectController;
use App\Http\Controllers\dashboard\dash_feature\KelasController;

// Semua dashboard kecuali users: Admin dan Guru
Route::middleware(['userakses:Admin,Guru'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.dash');
    Route::get('/dashboard/absensi', [AbsensiController::class, 'index'])->name('dashboard.absensi');
    Route::get('/dashboard/absensi/{user_id}/show', [AbsensiController::class, 'show'])->name('dashboard.absensi.show');
    Route::get('/dashboard/jurnal', [JurnalController::class, 'index'])->name('dashboard.jurnal');
    Route::get('/dashboard/jurnal/{id}/show', [JurnalController::class, 'show'])->name('dashboard.jurnal.show');
    Route::get('/dashboard/siswa', [SiswaController::class, 'index'])->name('dashboard.siswa');
    Route::get('/dashboard/pelanggaran', [PelanggaranController::class, 'index'])->name('dashboard.pelanggaran');
    Route::get('/dashboard/pelanggaran/show', [PelanggaranController::class, 'show'])->name('dashboard.pelanggaran.show');
    Route::get('/dashboard/izin', [IzinController::class, 'index'])->name('dashboard.izin');
    Route::get('/dashboard/izin/{id}/show', [IzinController::class, 'show'])->name('dashboard.izin.show');
    Route::post('/dashboard/izin/{id}/update-status', [IzinController::class, 'updateStatus'])->name('dashboard.izin.updateStatus');
    // Tambah detail siswa (bukan edit user, tapi tambah detail student)
    Route::get('/dashboard/siswa/{user}/detail', [SiswaController::class, 'createDetail'])->name('dashboard.siswa.detail.create');
    Route::post('/dashboard/siswa/{user}/detail', [SiswaController::class, 'storeDetail'])->name('dashboard.siswa.detail.store');
    // Halaman detail siswa (pure melihat detail siswa)
    Route::get('/dashboard/siswa/{user}/show', [SiswaController::class, 'show'])->name('dashboard.siswa.detail.show');
    Route::resource('/dashboard/subjects', SubjectController::class, [
        'as' => 'dashboard'
    ]);
    Route::resource('/dashboard/kelas', KelasController::class, [
        'as' => 'dashboard'
    ]);
    Route::post('/dashboard/kelas/{kelas}/update-walas', [KelasController::class, 'updateWalas'])->name('dashboard.kelas.updateWalas');
    Route::post('/dashboard/kelas/{kelas}/add-students', [KelasController::class, 'addStudents'])->name('dashboard.kelas.addStudents');
    Route::post('/dashboard/kelas/{kelas}/remove-students', [KelasController::class, 'removeStudents'])->name('dashboard.kelas.removeStudents');
    Route::post('/dashboard/kelas/{kelas}/update-schedule', [KelasController::class, 'updateSchedule'])->name('dashboard.kelas.updateSchedule');
    Route::post('/dashboard/kelas/{kelas}/update-name', [KelasController::class, 'updateName'])->name('dashboard.kelas.updateName');
});

// Hanya Admin untuk users
Route::middleware(['userakses:Admin'])->group(function () {
    Route::resource('/dashboard/users', UsersController::class, [
        'as' => 'dashboard'
    ]);
});
