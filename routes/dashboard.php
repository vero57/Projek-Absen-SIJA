<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.dash');