<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\pelapor;

class AdminController extends Controller
{
    public function pesan_masuk()
    {
        $pesan_masuk = pelapor::menampilkanLaporanMasuk(); 
        return view('admin.pesan_masuk', compact('pesan_masuk'));
    }

    public function pesan_masuk_upt()
    {
        $pesan_masuk_upt = pelapor::menampilkanLaporanMasukUpt(); 
        return view('pesanMasuk-upt.pesan_masuk_upt', compact('pesan_masuk_upt'));
    }

    public function pesan_keluar()
    {
        $pesan_keluar = pelapor::menampilkanLaporanKeluar(); 
        return view('admin.pesan_keluar', compact('pesan_keluar'));
    }

    public function pesan()
    {
        $pesan = pelapor::menampilkanLaporan(); 
        return view('admin.pesan', compact('pesan'));
    }

    public function updatelaporan($id) {
        $laporan = pelapor::MengirimLaporan($id);
    
        if (isset($laporan['status']) && $laporan['status'] === 'error') {
            return redirect()->back()->with('error', $laporan['message']);
        }
    
        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }

    public function balas(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'reply_text' => 'required',
        ], [
            'reply_text.required' => 'Balasan wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Ambil data pelapor berdasarkan ID
        $pelapor = pelapor::find($id);

        // if (!$pelapor) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Data pelapor tidak ditemukan',
        //     ], 404);
        // }

        // Update hanya kolom reply_text
        $pelapor->update([
            'replied_by' => Auth::id(),
            'reply_text' => $request->reply_text,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Balasan berhasil dikirim!');
    }

}
