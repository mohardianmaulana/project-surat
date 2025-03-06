<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template');
});
route::get('/login', function () {
    return view('login');
});
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