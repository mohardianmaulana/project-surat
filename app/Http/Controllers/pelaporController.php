<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelapor;
use App\Models\Unit;

class pelaporController extends Controller
{
    public function index() {
        $unit_id = Unit::all();
        return view('pelapor.index', compact('unit_id'));
    }

    public function storeLaporan(Request $request) {
        $pelapor = pelapor::tambahlaporan($request);
        if ($pelapor['status'] == 'error') {
            // Jika ada error validasi, kembali ke form dengan error
            return redirect()->back()
                ->withErrors($pelapor['errors'])
                ->withInput();
        }
        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }
}
