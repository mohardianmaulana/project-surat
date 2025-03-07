<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class pelapor extends Model
{
    public static function tambahPelapor($request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:3|max:50',
            'nim' => 'required|string|regex:/^[0-9\s]+$/|min:9|max:15',
            'email' => 'required|email|min:3|max:100',
            'nomor' => 'required|string|regex:/^[0-9\s]+$/|min:9|max:15',
        ], [
            'nama.required' => 'Nama pelapor wajib diisi',
            'nim.required' => 'NIM wajib diisi',
            'email.required' => 'Email aktif wajib diisi',
            'nomor.required' => 'Nomor HP wajib diisi',
        ]);
    
        if ($validator->fails()) {
            return [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
        }

        // Simpan data pelapor
        Pelapor::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'nomor' => $request->nomor, 
            'status' => 1,// Set status to 1
        ]);
    
        return ['status' => 'success'];
    }
}
