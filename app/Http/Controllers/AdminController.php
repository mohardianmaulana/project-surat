<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelapor;

class AdminController extends Controller
{
    public function index()
    {
        $pesan_masuk = pelapor::join('units', 'complaints.unit_id', '=', 'units.id')
        ->join('users', 'complaints.user_id', '=', 'users.id')
        ->select('complaints.*', 'units.name as unit_name', 'users.name as user_name')
        ->get();
        return view('pesan-masuk.index', compact('pesan_masuk'));
    }
}
