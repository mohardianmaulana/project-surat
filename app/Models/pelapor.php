<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class pelapor extends Model
{
    protected $table = 'complaints';
    protected $fillable = ['id', 'user_id', 'unit_id', 'complaint-text', 'status', 'forwarded_at', 'processed_at', 'completed_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }



    // public static function tambahLaporan($request) {
    //     $validator = Validator::make($request->all(), [
    //         'nama' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:3|max:50',
    //         'nim' => 'required|string|regex:/^[0-9\s]+$/|min:9|max:15',
    //         'email' => 'required|email|min:3|max:100',
    //         'nomor' => 'required|string|regex:/^[0-9\s]+$/|min:9|max:15',
    //     ], [
    //         'nama.required' => 'Nama pelapor wajib diisi',
    //         'nim.required' => 'NIM wajib diisi',
    //         'email.required' => 'Email aktif wajib diisi',
    //         'nomor.required' => 'Nomor HP wajib diisi',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return [
    //             'status' => 'error',
    //             'errors' => $validator->errors(),
    //         ];
    //     }

    //     // Simpan data pelapor
    //     Pelapor::create([
    //         'user_id' => Auth::user()->id,
    //         'status' => 'pending',
    //     ]);
    
    //     return ['status' => 'success'];
    // }
}
