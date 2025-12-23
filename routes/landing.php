<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landing\HomeController;
use App\Http\Controllers\landing\feature\AbsenController;
use App\Http\Controllers\landing\feature\IzinController;
use App\Http\Controllers\landing\feature\JurnalController;
use App\Http\Controllers\landing\ProfileController;
use App\Http\Controllers\API\FaceApiController;

Route::get('/', [HomeController::class, 'index'])->name('landing.home');

Route::middleware('fiturakses')->group(function () {
    Route::get('/absen', [AbsenController::class, 'index'])->name('feature.absen');
    Route::get('/izin', [IzinController::class, 'index'])->name('feature.izin');
    Route::post('/izin', [IzinController::class, 'store'])->name('feature.izin.store');
    Route::get('/jurnal', [JurnalController::class, 'index'])->name('feature.jurnal');
    Route::get('/profile', [ProfileController::class, 'index'])->name('landing.profile');

    // Route untuk FACE API
    Route::get('/faceapi/user-image', [FaceApiController::class, 'getUserFace']);
});
