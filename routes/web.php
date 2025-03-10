<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\pelaporController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/tambah-user', [RegisterController::class, 'store'])->name('register.store');

Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::post('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pelapor', [pelaporController::class, 'index'])->name('pelapor')->middleware('role:pelapor');
    Route::post('/tambah-laporan', [pelaporController::class, 'storeLaporan'])->name('pelapor.store')->middleware('role:pelapor');
    Route::get('/pesan-masuk', [AdminController::class, 'index'])->name('pesan-masuk')->middleware('role:admin');
});    // route::get('/login', function () {
//     return view('login');
// });
route::get('/homepage', function () {
    return view('homepage');
});
// route::get('/pesanMasuk', function () {
//     return view('pesanMasuk');
// });
route::get('/pesanKeluar', function () {
    return view('pesanKeluar');
});
// route::get('/pelapor', function() {
//     return view('pelapor.index');
// });