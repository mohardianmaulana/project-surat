<?php

namespace App\Models;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class pelapor extends Model
{
    protected $table = 'complaints';
    protected $fillable = ['id', 'user_id', 'unit_id', 'complaint_text', 'status', 'forwarded_at', 'processed_at', 'completed_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
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
            'forwarded_at' => null,
            'processed_at' => null,
            'completed_at' => null,
            'status' => 'pending',
        ]);
    
        return ['status' => 'success'];
    }
}
