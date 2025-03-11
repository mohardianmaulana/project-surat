<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelapor;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;
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
            ->where('complaints.reply_pelapor', '0')
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

    public function pesan()
    {
        $user = Auth::user();

        $userId = Auth::id();

        $pesan = pelapor::join('units', 'complaints.unit_id', '=', 'units.id')
                ->join('users', 'complaints.user_id', '=', 'users.id')
                ->where('complaints.user_id', $userId)
                ->select('complaints.*', 'units.name as unit_name', 'users.name as user_name', 'users.nim', 'users.nomor')
                ->get();
        return view('admin.pesan', compact('pesan'));
    }

    public function pesanKeluar() {
        $userId = Auth::id();

        $pesan_keluar = pelapor::join('units', 'complaints.unit_id', '=', 'units.id')
            ->join('users as pelapor_user', 'complaints.user_id', '=', 'pelapor_user.id') // Join untuk pelapor
            ->leftJoin('users as replied_user', 'complaints.replied_by', '=', 'replied_user.id') // Join untuk yang membalas
            ->whereNotNull('complaints.reply_text') // Hanya tampilkan yang sudah dibalas
            ->where('complaints.user_id', $userId)
            ->where('complaints.status', 'pending')
            ->where('complaints.reply_pelapor', '1')
            ->select(
                'complaints.*', 
                'units.name as unit_name', 
                'pelapor_user.name as user_name', 
                'pelapor_user.nim', 
                'pelapor_user.nomor',
                'replied_user.name as replied_name' // Nama yang membalas
            )
            ->get();
    
        return view('pelapor.pesan_keluar', compact('pesan_keluar'));
    }

    public function balas_pelapor(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'complain_text' => 'required',
        ], [
            'complain_text.required' => 'Balasan wajib diisi',
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
            'complaint_text' => $request->complain_text,
            'reply_pelapor' => '1',
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Balasan berhasil dikirim!');
    }
    
}
