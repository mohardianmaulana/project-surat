<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\pelapor;

class AdminController extends Controller
{
    public function index()
    {
        $pesan_masuk = pelapor::menampilkanlaporan(); 
        return view('pesan-masuk.index', compact('pesan_masuk'));
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
