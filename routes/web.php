<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\pelaporController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UnitPoliwangiController;
use App\Http\Controllers\TwilioWebhookController;

Route::post('/twilio/webhook', [TwilioWebhookController::class, 'receive'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/tambah-user', [RegisterController::class, 'store'])->name('register.store');

Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::post('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard-admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard-upt', [DashboardController::class, 'upt'])->name('dashboard.upt');
    Route::get('/pelapor', [pelaporController::class, 'index'])->name('pelapor.index')->middleware('role:pelapor');
    Route::post('/tambah-laporan', [pelaporController::class, 'storeLaporan'])->name('pelapor.store')->middleware('role:pelapor');
    Route::get('/pesanMasuk', [pelaporController::class, 'pesanMasuk'])->name('pesanMasuk')->middleware('role:pelapor');
    Route::get('/pesanKeluar', [pelaporController::class, 'pesanKeluar'])->name('pesanKeluar')->middleware('role:pelapor');
    Route::get('/pesan-masuk', [AdminController::class, 'pesan_masuk'])->name('pesan-masuk')->middleware('role:admin');
    Route::get('/pesan-masuk-upt', [AdminController::class, 'pesan_masuk_upt'])->name('pesan-masuk_upt')->middleware('role:admin');
    Route::get('/pesan_pelapor', [pelaporController::class, 'pesan'])->name('pesan_pelapor')->middleware('role:pelapor');
    Route::get('/pesan', [AdminController::class, 'pesan'])->name('pesan')->middleware('role:admin');
    Route::get('/pesan-keluar', [AdminController::class, 'pesan_keluar'])->name('pesan-keluar')->middleware('role:admin');
    Route::post('/complaints/reply/{id}', [AdminController::class, 'balas'])->name('reply')->middleware('role:admin');
    Route::post('/laporan/{id}/update', [AdminController::class, 'updatelaporan'])->name('laporan.update');
    Route::post('/pelapor/reply/{id}', [pelaporController::class, 'balas_pelapor'])->name('reply_pelapor')->middleware('role:pelapor');
});
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/pesanupt', [UnitPoliwangiController::class, 'index'])->name('pesanupt')->middleware('role:upt');  
    Route::get('/response/form/{complaint_id}', [UnitPoliwangiController::class, 'balasPesanView'])->name('balasPesanView')->middleware('role:upt');
    Route::post('/response/store', [UnitPoliwangiController::class, 'store'])->name('response.store')->middleware('role:upt');
    Route::get('/pesanupt_keluar', [UnitPoliwangiController::class, 'pesan_keluar'])->name('pesanupt_keluar')->middleware('role:upt');
});
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/send-wa/{complaint_id}', [AdminController::class, 'sendWhatsApp'])->name('send.wa')->middleware('role:admin');
});// route::get('/login', function () {
//     return view('login');
// });
route::get('/homepage', function () {
    return view('homepage');
});
// route::get('/pesanMasuk', function () {
//     return view('pesanMasuk');
// });
// route::get('/pesan', function () {
//     return view('balas-pesan-upt.pesanKeluar');
// });
// route::get('/pelapor', function() {
//     return view('pelapor.index');
// });