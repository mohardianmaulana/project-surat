<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelapor;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;

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

    public function pesanMasuk() {
        $userId = Auth::id();

        $pesan_masuk = pelapor::join('units', 'complaints.unit_id', '=', 'units.id')
            ->join('users as pelapor_user', 'complaints.user_id', '=', 'pelapor_user.id') // Join untuk pelapor
            ->leftJoin('users as replied_user', 'complaints.replied_by', '=', 'replied_user.id') // Join untuk yang membalas
            ->whereNotNull('complaints.reply_text') // Hanya tampilkan yang sudah dibalas
            ->where('complaints.user_id', $userId)
            ->where('complaints.status', 'pending')
            ->select(
                'complaints.*', 
                'units.name as unit_name', 
                'pelapor_user.name as user_name', 
                'pelapor_user.nim', 
                'pelapor_user.nomor',
                'replied_user.name as replied_name' // Nama yang membalas
            )
            ->get();
    
        return view('pelapor.pesan_masuk', compact('pesan_masuk'));
    }
    
}
