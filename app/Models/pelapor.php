<?php

namespace App\Models;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class pelapor extends Model
{
    protected $table = 'complaints';
    protected $fillable = ['id', 'user_id', 'nama_pelapor', 'nomor_pelapor', 'unit_id', 'complaint_text', 'reply_text', 'replied_by', 'reply_pelapor', 'date_replied_by', 'date_reply_pelapor', 'status', 'pending', 'forwarded_at', 'processed_at', 'completed_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function responses()
    {
        return $this->hasMany(upt::class, 'complaint_id', 'id'); // Relasi ke responses
    }

        public static function menampilkanLaporanMasuk()
        {
            $user = Auth::user();

            // Admin bisa melihat semua laporan kecuali yang "forwarded"
            $pesan_masuk = pelapor::join('units', 'complaints.unit_id', '=', 'units.id')
                
                ->where('complaints.status', 'pending')
                ->select('complaints.*', 'units.name as unit_name')
                ->get();

                

            return $pesan_masuk; // Tambahkan return agar bisa digunakan di controller
        }

        public static function menampilkanLaporanMasukUpt()
        {
            $user = Auth::user();

            // Ambil semua data dari tabel responses beserta relasi yang diperlukan
            $pesan_masuk_upt = DB::table('responses')
                ->join('complaints', 'responses.complaint_id', '=', 'complaints.id')
                ->join('units', 'responses.unit_id', '=', 'units.id')
                ->join('users as pelapor', 'complaints.user_id', '=', 'pelapor.id')
                ->join('users as reviewer', 'responses.reviewed_by', '=', 'reviewer.id')
                ->where('responses.status', 'pending')
                ->select(
                    'responses.*', 
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

            return $pesan_masuk_upt;
        }


        public static function menampilkanLaporan()
        {
            $user = Auth::user();

            $pesan = pelapor::join('units', 'complaints.unit_id', '=', 'units.id')
                ->join('users', 'complaints.user_id', '=', 'users.id')
                ->select('complaints.*', 'units.name as unit_name', 'users.name as user_name', 'users.nim', 'users.nomor')
                ->get();

            return $pesan; // Tambahkan return agar bisa digunakan di controller
        }

        public static function menampilkanLaporanKeluar()
        {
            $user = Auth::user();

            // Admin bisa melihat semua laporan kecuali yang "forwarded"
            $pesan_keluar = pelapor::join('units', 'complaints.unit_id', '=', 'units.id')
                ->join('users', 'complaints.user_id', '=', 'users.id')
                ->where('complaints.status', 'forwarded')
                ->select('complaints.*', 'units.name as unit_name', 'users.name as user_name', 'users.nim', 'users.nomor')
                ->get();

            return $pesan_keluar; // Tambahkan return agar bisa digunakan di controller
        }

    public static function tambahLaporan($request) {
        $validator = Validator::make($request->all(), [
            'complaint_text' => 'required',
        ], [
            'complaint_text.required' => 'Permasalahan wajib diisi',
        ]);
    
        if ($validator->fails()) {
            return [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
        }

        // Simpan data pelapor
        pelapor::create([
            'user_id' => Auth::user()->id,
            'unit_id' => $request->unit_id,
            'complaint_text' => $request->complaint_text,
            'pending' => now(),
            'forwarded_at' => null,
            'processed_at' => null,
            'completed_at' => null,
            'status' => 'pending',
        ]);
    
        return ['status' => 'success'];
    }

    public static function MengirimLaporan($id) {
        $laporan = pelapor::find($id);

        if(!$laporan){
            return [
                'status' => 'error',
                'message' => 'Laporan tidak ditemukan',
            ];
        }

        $laporan->status = 'forwarded';
        $laporan->forwarded_at = date('Y-m-d H:i:s');
        $laporan->save();

        return $laporan;
    }

}
