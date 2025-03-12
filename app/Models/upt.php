<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Validator;

class upt extends Model
{
    use hasFactory;
    protected $table = 'responses';
    protected $fillable = ['complaint_id', 'unit_id', 'response_text', 'complaint_text', 'status', 'reviewed_by', 'sent_at', 'reviewed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function compliment()
    {
        return $this->belongsTo(Unit::class, 'complaint_id');
    }

    public static function getBalasPesan()
    {
        return self::with(['user', 'unit'])->get();
    }

    public static function menampilkanlaporan()
    {
        $user = Auth::user();

        // Ambil unit dari user jika ada
        $unitUser = $user->unit_id; 

        // Cek apakah user memiliki unit_id
        if ($unitUser) {
            $pesan_masuk = pelapor::join('units', 'complaints.unit_id', '=', 'units.id')
                ->join('users', 'complaints.user_id', '=', 'users.id')
                ->where('complaints.unit_id', $unitUser) // Filter berdasarkan unit_id
                ->where('complaints.status', 'forwarded') // Filter berdasarkan status forwarded
                ->select('complaints.*', 'units.name as unit_name', 'users.name as user_name', 'users.nim', 'users.nomor')
                ->get();
        } else {
            // Jika user tidak terkait dengan unit mana pun, kosongkan hasil
            $pesan_masuk = collect();
        }

        return $pesan_masuk;
    }

    public static function BalasPesanView($complaint_id)
    {
        // Ambil data complaint berdasarkan ID yang diberikan
        $complaint = pelapor::where('id', $complaint_id)->first();

        // Pastikan complaint ditemukan
        if (!$complaint) {
            return redirect()->back()->with('error', 'Keluhan tidak ditemukan.');
        }

        // Cek apakah answer_status sudah bernilai 1
        if ($complaint->answer_status == 1) {
            return redirect()->back()->with('error', 'Keluhan ini sudah dibalas, tidak bisa mengakses halaman ini.');
        }
        $balasPesan = pelapor::join('units', 'complaints.unit_id', '=', 'units.id')
            ->join('users', 'complaints.user_id', '=', 'users.id')
            ->where('complaints.id', $complaint_id) // 🔹 Filter berdasarkan complaint_id
            ->select('complaints.*', 'units.name as unit_name', 'users.name as user_name')
            ->first(); // 🔹 Mengambil satu data saja

        return $balasPesan;
    }

    public static function storeResponse(Request $request)
    {
        // Validasi input
        // *🔹 Validasi di Model*
        $validator = Validator::make($request->all(), [
            'complaint_id' => 'required|exists:complaints,id',
            'unit_id' => 'required|exists:units,id',
            'response_text' => 'required|string',
        ], [
            'complaint_id.required' => 'Keluhan harus dipilih.',
            'unit_id.required' => 'Unit harus dipilih.',
            'response_text.required' => 'Balasan tidak boleh kosong.',
        ]);

        // Jika validasi gagal, kembalikan error
        if ($validator->fails()) {
            return [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
        }

        // Ambil data complaint berdasarkan complaint_id
        $complaint = pelapor::find($request->input('complaint_id'));

        // Jika complaint tidak ditemukan, kembalikan error
        if (!$complaint) {
            return redirect()->back()->with('error', 'Keluhan tidak ditemukan.');
        }

        // Cek apakah answer_status sudah bernilai 1
        if ($complaint->answer_status == 1) {
            return redirect()->back()->with('error', 'Keluhan ini sudah dibalas, tidak bisa membalas lagi.');
        }

        // *🔹 Simpan ke Database*
        $response = self::create([
            'complaint_id' => $request->input('complaint_id'),
            'unit_id' => $request->input('unit_id'),
            'response_text' => $request->input('response_text'),
            'reviewed_by' => Auth::id(),
            'sent_at' => now(),
            'status' => 'pending',
        ]);

        pelapor::where('id', $request->input('complaint_id'))
        ->update(['status' => 'processed']);

        return $response;
    }

}