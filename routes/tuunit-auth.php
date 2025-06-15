<?php

use App\Http\Controllers\tuunit\Auth\LoginController;
use App\Http\Controllers\TuunitProfileController;
use App\Http\Controllers\tuunit\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('tuunit')->group(function () {

    // Guest Routes
    Route::middleware('guest:tuunit')->group(function () {
        Route::get('login', [LoginController::class, 'create'])->name('tuunit.login');
        Route::post('login', [LoginController::class, 'store']);
    });

    // Authenticated Routes
    Route::middleware('auth:tuunit', 'verified')->group(function () {

        // General dashboard and redirect
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('tuunit.dashboard');

        // Madin routes
        Route::prefix('madin')->group(function () {
            // Route::get('/dashboard', fn() => view('tuunit.madin.dashboard'))->name('tuunit.madin.dashboard');
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('tuunit.madin.dashboard');
            Route::get('/manage-transaksi', fn() => view('tuunit.madin.manage-transaksi'))->name('tuunit.madin.manage-transaksi');
            Route::get('/laporan-transaksi', fn() => view('tuunit.madin.laporan-transaksi'))->name('tuunit.madin.laporan-transaksi');
        });

        // TPQ routes
        Route::prefix('tpq')->middleware('check.unit:tpq')->group(function () {
            Route::get('/dashboard', fn() => view('tuunit.tpq.dashboard'))->name('tuunit.tpq.dashboard');
            Route::get('/manage-transaksi', fn() => view('tuunit.tpq.manage-transaksi'))->name('tuunit.tpq.manage-transaksi');
            Route::get('/laporan-transaksi', fn() => view('tuunit.tpq.laporan-transaksi'))->name('tuunit.tpq.laporan-transaksi');
        });

        // Controller-based routes for manage and laporan
        Route::get('/manage-transaksi', [DashboardController::class, 'manageTransaksi'])->name('tuunit.manage-transaksi');
        Route::get('/laporan-transaksi', [DashboardController::class, 'laporanTransaksi'])->name('tuunit.laporan-transaksi');

        // Profile routes
        Route::get('/profile', [TuunitProfileController::class, 'edit'])->name('tuunit.profile.edit');
        Route::patch('/profile', [TuunitProfileController::class, 'update'])->name('tuunit.profile.update');
        Route::delete('/profile', [TuunitProfileController::class, 'destroy'])->name('tuunit.profile.destroy');

        // Logout
        Route::post('logout', [LoginController::class, 'destroy'])->name('tuunit.logout');
    });
});
