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

    public function balasPesan()
    {
        return view('balas-pesan-upt.pesanKeluar');
    }

    public function balasPesanView($complaint_id)
    {
        $balasPesan = upt::BalasPesanView($complaint_id);
    
        if (!$balasPesan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }
        return view('balas-pesan-upt.pesanKeluar', compact('balasPesan'));
    }

    public function store(Request $request)
    {
        // *🔹 Kirim Data ke Model*
        $response = upt::storeResponse($request);

        // *🔹 Cek jika validasi gagal*
        if (isset($response['status']) && $response['status'] === 'error') {
            return redirect()->back()->withErrors($response['errors'])->withInput();
        }

        return redirect('/pesanupt')->with('success', 'Laporan berhasil ditanggapi!'); 
    }
}