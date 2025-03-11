<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class upt extends Model
{
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
                ->select('complaints.*', 'units.name as unit_name', 'users.name as user_name', 'users.nim', 'users.nomor')
                ->get();
        } else {
            // Jika user tidak terkait dengan unit mana pun, kosongkan hasil
            $pesan_masuk = collect();
        }

        return $pesan_masuk;
    }
}