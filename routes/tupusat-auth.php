<?php

use App\Http\Controllers\tupusat\Auth\LoginController;
use App\Http\Controllers\tupusat\Auth\RegisteredUserController;
use App\Http\Controllers\TupusatProfileController;
use App\Http\Controllers\tupusat\TagihanController;
use App\Http\Controllers\tuPusat\TabunganController;
use App\Http\Controllers\tupusat\DashboardController;
use App\Http\Controllers\tupusat\KasController;
use App\Http\Controllers\tuPusat\TransaksiTabunganController;
use Illuminate\Support\Facades\Route;

Route::prefix('tupusat')->middleware('guest:tupusat')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('tupusat.login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::prefix('tupusat')->middleware('auth:tupusat', 'verified')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('tupusat.dashboard.index');

    Route::get('tagihan/create', [TagihanController::class, 'create'])->name('tupusat.tagihan.create');
    Route::post('tagihan', [TagihanController::class, 'store'])->name('tupusat.tagihan.store');

    // AJAX untuk dropdown dinamis tagihan
    // routes/web.php atau api.php jika ingin via API route
    Route::get('/api/jenispembayaran/nominal', [TagihanController::class, 'getNominalJenisPembayaran'])->name('tupusat.api.jenispembayaran.nominal');

    Route::get('/api/tagihan/jenispembayaran', [TagihanController::class, 'getJenisPembayaran'])->name('tupusat.api.jenispembayaran');
    Route::get('/api/tagihan/siswa', [TagihanController::class, 'getSiswa'])->name('tupusat.api.siswa');
    Route::get('/api/kelas', [TagihanController::class, 'getKelasByUnit'])->name('tupusat.api.kelas');
    // Daftar Siswa
    Route::get('/tagihan-siswa', [TagihanController::class, 'index'])->name('tupusat.tagihan-siswa.index');
    // Cetak
    Route::get('/tagihan/{siswa}/cetak', [TagihanController::class, 'cetak'])->name('tupusat.tagihan.cetak');
    // Rincian Tagihan Siswa
    Route::get('/tagihan/{siswa}', [TagihanController::class, 'show'])->name('tupusat.tagihan.show');
    // Form bayar tagihan
    Route::get('/tagihan/{tagihan}/bayar', [TagihanController::class, 'formBayar'])->name('tupusat.tagihan.bayar.form');
    // Proses pembayaran tagihan
    Route::post('/tagihan/{tagihan}/bayar', [TagihanController::class, 'bayar'])->name('tupusat.tagihan.bayar.proses');
    Route::get('/tupusat/tagihan/{tagihan}/cetak-kwitansi', [TagihanController::class, 'cetakKwitansi'])->name('tupusat.tagihan.cetak.kwitansi');
    Route::post('/tupusat/tagihan/cetak-kwitansi-multiple', [TagihanController::class, 'cetakMultipleKwitansi'])->name('tupusat.tagihan.bulkKwitansi');
    Route::get('tagihan/{siswaId}/export-excel', [TagihanController::class, 'exportExcel'])->name('tupusat.tagihan.export-excel');




    Route::get('tabungan', [TabunganController::class, 'index'])->name('tupusat.tabungan.index');
    Route::get('tabungan/create', [TabunganController::class, 'create'])->name('tupusat.tabungan.create');
    Route::post('tabungan', [TabunganController::class, 'store'])->name('tabungan.store');
    // Export Excel seluruh tabungan
    Route::get('tabungan/export', [TabunganController::class, 'exportAll'])->name('tupusat.tabungan.export.all');
    Route::get('tabungan/{id}/edit', [TabunganController::class, 'edit'])->name('tupusat.tabungan.edit');
    Route::put('tabungan/{id}', [TabunganController::class, 'update'])->name('tupusat.tabungan.update');
    Route::get('tabungan/{id}', [TabunganController::class, 'show'])->name('tabungan.show');
    Route::get('tabungan/{id}/transaksi/create', [TransaksiTabunganController::class, 'create'])->name('tupusat.transaksi.create');
    Route::post('tabungan/{id}/transaksi', [TransaksiTabunganController::class, 'store'])->name('tupusat.transaksi.store');
    Route::get('transaksi/{id}/edit', [TransaksiTabunganController::class, 'edit'])->name('tupusat.transaksi.edit');
    Route::put('transaksi/{id}', [TransaksiTabunganController::class, 'update'])->name('tupusat.transaksi.update');
    Route::delete('transaksi/{id}', [TransaksiTabunganController::class, 'destroy'])->name('tupusat.transaksi.destroy');
    // Export PDF transaksi tabungan tertentu
    Route::get('tabungan/{id}/export-pdf', [TabunganController::class, 'exportPdf'])->name('tupusat.tabungan.export.pdf');
    // Soft Delete
    Route::delete('tabungan/{id}', [TabunganController::class, 'destroy'])->name('tupusat.tabungan.destroy');
    // Restore Soft Delete
    Route::post('tabungan/{id}/restore', [TabunganController::class, 'restore'])->name('tupusat.tabungan.restore');
    //delete permanent
    Route::delete('tabungan/{id}/force-delete', [TabunganController::class, 'forceDelete'])->name('tupusat.tabungan.forceDelete');


    Route::get('kas', [KasController::class, 'index'])->name('tupusat.kas.index');
    Route::get('kas/create', [KasController::class, 'create'])->name('tupusat.kas.create');
    Route::post('kas', [KasController::class, 'store'])->name('tupusat.kas.store');
    Route::get('kas/{id}/edit', [KasController::class, 'edit'])->name('tupusat.kas.edit');
    Route::put('kas/{id}', [KasController::class, 'update'])->name('tupusat.kas.update');
    Route::delete('kas/{id}', [KasController::class, 'destroy'])->name('tupusat.kas.destroy');
    // Tambahan fitur Soft Delete
    Route::get('kas/trashed', [KasController::class, 'trashed'])->name('tupusat.kas.trashed');
    Route::post('kas/{id}/restore', [KasController::class, 'restore'])->name('tupusat.kas.restore');
    Route::delete('kas/{id}/force-delete', [KasController::class, 'forceDelete'])->name('tupusat.kas.forceDelete');
    // Route::get('kas/laporan', [KasController::class, 'laporan'])->name('tupusat.kas.laporan');

    // Route::get('kas/export-excel', [KasController::class, 'exportExcel'])->name('tupusat.kas.export.excel');
    // Route::get('kas/export-pdf', [KasController::class, 'exportPDF'])->name('tupusat.kas.export.pdf');

    // Route::get('/dashboard', function () {
    //     return view('tupusat.dashboard');
    // })->name('tupusat.dashboard');

    // Route::get('/kas-siswa', function () {
    //     return view('tupusat.kas-siswa');
    // })->name('tupusat.kas-siswa');

    Route::get('/detail-tabungan', function () {
        return view('tupusat.detail-tabungan');
    })->name('tupusat.detail-tabungan');

    Route::get('/setor-tabungan', function () {
        return view('tupusat.setor-tabungan');
    })->name('tupusat.setor-tabungan');

    Route::get('/tarik-tabungan', function () {
        return view('tupusat.tarik-tabungan');
    })->name('tupusat.tarik-tabungan');

    Route::get('/manage-transaksi',  function () {
        return view('tupusat.manage-transaksi');
    })->name('tupusat.manage-transaksi');

    Route::get('/laporan-transaksi',  function () {
        return view('tupusat.laporan-transaksi');
    })->name('tupusat.laporan-transaksi');

    Route::middleware('auth')->group(function () {
        Route::get('/profile',  [TupusatProfileController::class, 'edit'])->name(name: 'tupusat.profile.edit');
        Route::patch('/profile',  [TupusatProfileController::class, 'update'])->name('tupusat.profile.update');
        Route::delete('/profile',  [TupusatProfileController::class, 'destroy'])->name('tupusat.profile.destroy');
    });


    Route::post('logout', [LoginController::class, 'destroy'])->name('tupusat.logout');
});
