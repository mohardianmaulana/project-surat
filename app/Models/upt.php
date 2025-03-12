<?php

namespace App\Models;

use App\Models\pelapor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Validator;

class upt extends Model
{
    use hasFactory;
    protected $table = 'responses';
    protected $fillable = ['complaint_id', 'unit_id', 'response_text', 'status', 'reviewed_by', 'sent_at', 'reviewed_at'];

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

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
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

    public static function menampilkanlaporanKeluar() {
        $user = Auth::user();
    
        // Ambil unit dari user jika ada
        $unitUser = $user->unit_id; 
    
        // Cek apakah user memiliki unit_id
        if ($unitUser) {
            $pesan_keluar = DB::table('responses')
                ->join('complaints', 'responses.complaint_id', '=', 'complaints.id') // Join ke complaints
                ->join('units', 'complaints.unit_id', '=', 'units.id') // Join ke units
                ->join('users as pelapor', 'complaints.user_id', '=', 'pelapor.id') // Join ke users
                ->join('users as reviewer', 'responses.reviewed_by', '=', 'reviewer.id')
                ->where('complaints.unit_id', $unitUser) // Filter berdasarkan unit_id
                ->where('complaints.status', 'processed') // Filter status forwarded
                ->select(
                    'responses.*', // Ambil semua data dari responses
                    'complaints.status as complaint_status', 
                    'units.name as unit_name',
                    // Data pelapor
                    'pelapor.name as pelapor_name',
                    'pelapor.nim as pelapor_nim',
                    'pelapor.nomor as pelapor_nomor',

                    // Data reviewer (yang melakukan review)
                    'reviewer.name as reviewer_name',
                    'reviewer.nim as reviewer_nim',
                    'reviewer.nomor as reviewer_nomor'
                )
                ->get();
        } else {
            // Jika user tidak memiliki unit_id, hasil kosong
            $pesan_keluar = collect();
        }
    
        return $pesan_keluar;
    }

    public static function RedirecWa($complaint_id)
    {
        // Ambil complaint + pelapor (user) + response terbaru + reviewer
        $complaint = pelapor::where('id', $complaint_id)
            ->with([
                'user', // Ambil pelapor langsung dari tabel users
                'responses.reviewer', // Ambil response beserta reviewernya
                'responses.unit' // Unit terkait response
            ])
            ->first();

        if (!$complaint || !$complaint->user) {
            return null;
        }

        // Data pelapor
        $namaPelapor = $complaint->user->name ?? 'Tidak diketahui';
        $nomorPelapor = $complaint->user->nomor ?? null;

        if (!$nomorPelapor) {
            return null;
        }

        // Ambil response terbaru
        $latestResponse = $complaint->responses->sortByDesc('created_at')->first();

        // Data respons
        $complaintText = $complaint->complaint_text ?? 'Tidak ada deskripsi masalah.';
        $responseText = "Belum ada respons.";
        $reviewerNama = "Belum direview";
        $unitReviewer = "Tidak diketahui";

        if ($latestResponse) {
            $responseText = $latestResponse->response_text;
            $reviewerNama = $latestResponse->reviewer->name ?? "Belum direview";
            $unitReviewer = $latestResponse->unit->name ?? "Tidak diketahui";
            $complaintText = $complaint->complaint_text ?? 'Tidak ada deskripsi masalah.';
        }

        // Format teks untuk WhatsApp $namaPelapor
        $text = "Halo%20*$namaPelapor*%0A"
          . "Saya%20dari%20admin%20mengirim%20konfirmasi%20atas%20masalah%3A%20%22*$complaintText*%22%0A"
          . "Saya%20*$reviewerNama*%20Dari%20*$unitReviewer*%0A"
          . "%22*$responseText*%22";

        return "https://api.whatsapp.com/send?phone=" . $nomorPelapor . "&text=" . $text;
    }

    

}