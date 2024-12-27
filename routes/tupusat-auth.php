<?php

use App\Http\Controllers\tupusat\Auth\LoginController;
use App\Http\Controllers\tupusat\Auth\RegisteredUserController;
use App\Http\Controllers\TupusatProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('tupusat')->middleware('guest:tupusat')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('tupusat.register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [LoginController::class, 'create'])->name('tupusat.login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::prefix('tupusat')->middleware('auth:tupusat')->group(function () {

    Route::get('/dashboard', function () {
        return view('tupusat.dashboard');
    })->name('tupusat.dashboard');

    Route::get('/manage-transaksi', action: function () {
        return view('tupusat.manage-transaksi');
    })->name('tupusat.manage-transaksi');

    Route::get(uri: '/laporan-transaksi', action: function () {
        return view('tupusat.laporan-transaksi');
    })->name('tupusat.laporan-transaksi');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', action: [TupusatProfileController::class, 'edit'])->name(name: 'tupusat.profile.edit');
        Route::patch('/profile', action: [TupusatProfileController::class, 'update'])->name('tupusat.profile.update');
        Route::delete('/profile', action: [TupusatProfileController::class, 'destroy'])->name('tupusat.profile.destroy');
    });


    Route::post('logout', [LoginController::class, 'destroy'])->name('tupusat.logout');
});
