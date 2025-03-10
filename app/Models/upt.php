<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class upt extends Model
{
    public static function menampilkanlaporan()
    {
        $user = Auth::user();

        // UPT TIK hanya bisa melihat laporan yang berstatus "forwarded"
        $pesan_masuk = pelapor::join('units', 'complaints.unit_id', '=', 'units.id')
                ->join('users', 'complaints.user_id', '=', 'users.id')
                ->where('complaints.status', 'forwarded')
                ->select('complaints.*', 'units.name as unit_name', 'users.name as user_name', 'users.nim', 'users.nomor')
                ->get();

            return $pesan_masuk;
    }
}