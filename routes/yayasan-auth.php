<?php

use App\Http\Controllers\yayasan\Auth\LoginController;
use App\Http\Controllers\yayasan\Auth\RegisteredUserController;
use App\Http\Controllers\yayasanProfileController;
use App\Http\Controllers\yayasan\TagihanController;
use App\Http\Controllers\yayasan\TabunganController;
use App\Http\Controllers\yayasan\DashboardController;
use App\Http\Controllers\yayasan\KasController;
use App\Http\Controllers\yayasan\TransaksiTabunganController;
use Illuminate\Support\Facades\Route;

Route::prefix('yayasan')->middleware('guest:yayasan')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('yayasan.login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::prefix('yayasan')->middleware('auth:yayasan', 'verified')->group(function () {

    Route::get('/dashboard',  function () {
        return view('yayasan.dashboard');
    })->name('yayasan.dashboard');

    Route::post('logout', [LoginController::class, 'destroy'])->name('yayasan.logout');
});
