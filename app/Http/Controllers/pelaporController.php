<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelapor;

class pelaporController extends Controller
{
    public function index() {
        return view('pelapor.index');
    }

    public function storePelapor(Request $request) {
        $pelapor = pelapor::tambahlaporan($request);
        if ($pelapor['status'] == 'error') {
            // Jika ada error validasi, kembali ke form dengan error
            return redirect()->back()
                ->withErrors($pelapor['errors'])
                ->withInput();
        }
        return redirect()->to('pelapor.index')->with('success', 'Laporan berhasil dikirimkan');
    }
}
