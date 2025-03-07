<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', [LoginController::class, 'login'])->name('login');


Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::post('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('role:admin');
});    // route::get('/login', function () {
//     return view('login');
// });
route::get('/register', function () {
    return view('register');
});
route::get('/homepage', function () {
    return view('homepage');
});
route::get('/pesanMasuk', function () {
    return view('pesanMasuk');
});
route::get('/pesanKeluar', function () {
    return view('pesanKeluar');
});
route::get('/pelapor', function() {
    return view('pelapor.index');
});