<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\pelaporController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UnitPoliwangiController;

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/tambah-user', [RegisterController::class, 'store'])->name('register.store');

Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::post('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pelapor', [pelaporController::class, 'index'])->name('pelapor')->middleware('role:pelapor');
    Route::post('/tambah-laporan', [pelaporController::class, 'storeLaporan'])->name('pelapor.store')->middleware('role:pelapor');
    Route::get('/pesanMasuk', [pelaporController::class, 'pesanMasuk'])->name('pesanMasuk')->middleware('role:pelapor');
    Route::get('/pesanKeluar', [pelaporController::class, 'pesanKeluar'])->name('pesanKeluar')->middleware('role:pelapor');
    Route::get('/pesan-masuk', [AdminController::class, 'pesan_masuk'])->name('pesan-masuk')->middleware('role:admin');
    Route::get('/pesan-keluar', [AdminController::class, 'pesan_keluar'])->name('pesan-keluar')->middleware('role:admin');
    Route::post('/complaints/reply/{id}', [AdminController::class, 'balas'])->name('reply')->middleware('role:admin');
    Route::post('/laporan/{id}/update', [AdminController::class, 'updatelaporan'])->name('laporan.update');
    Route::post('/pelapor/reply/{id}', [pelaporController::class, 'balas_pelapor'])->name('reply_pelapor')->middleware('role:pelapor');
});
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/pesanupt', [UnitPoliwangiController::class, 'index'])->name('pesanupt')->middleware('role:upt'); 
});    // route::get('/login', function () {
//     return view('login');
// });
route::get('/homepage', function () {
    return view('homepage');
});
// route::get('/pesanMasuk', function () {
//     return view('pesanMasuk');
// });
route::get('/pesan', function () {
    return view('pesanKeluar');
});
// route::get('/pelapor', function() {
//     return view('pelapor.index');
// });