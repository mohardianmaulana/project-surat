<?php

namespace App\Http\Controllers;

use App\Models\upt;
use Illuminate\Http\Request;

class UnitPoliwangiController extends Controller
{
    public function index()
    {
        $pesan_masuk = upt::menampilkanlaporan(); 
        return view('pesanMasuk-upt.index', compact('pesan_masuk'));
    }
}