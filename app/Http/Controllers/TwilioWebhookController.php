<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\pelapor;

class TwilioWebhookController extends Controller
{
    public function receive(Request $request)
    {
        // Ambil data dari Twilio Webhook
        $data = $request->all();

        // Pastikan data yang masuk valid
        if (isset($data['From']) && isset($data['Body'])) {
            $phone = str_replace("whatsapp:", "", $data['From']); // Hapus prefix "whatsapp:"
            $message = strtolower($data['Body']); // Konversi ke huruf kecil agar mudah diproses

            // Default nilai untuk setiap kolom
            $nama_pelapor = 'Tidak Diketahui';
            $unit_id = null;
            $complaint_text = 'Tidak ada laporan';

            // Ekstrak data berdasarkan format pesan WhatsApp
            preg_match('/nama\s*:\s*(.+)/i', $data['Body'], $namaMatches);
            preg_match('/kepada\s*:\s*(.+)/i', $data['Body'], $unitMatches);
            preg_match('/laporan\s*:\s*(.+)/is', $data['Body'], $laporanMatches);

            if (!empty($namaMatches[1])) {
                $nama_pelapor = trim($namaMatches[1]);
            }

            if (!empty($unitMatches[1])) {
                $unit_name = trim(strtolower($unitMatches[1]));

                // Mapping unit_id berdasarkan nama unit
                $unitMapping = [
                    'upt tik' => 1,
                    'upt perpustakaan' => 2
                ];

                $unit_id = $unitMapping[$unit_name] ?? null;
            }

            if (!empty($laporanMatches[1])) {
                $complaint_text = trim($laporanMatches[1]);
            }

            // Simpan ke tabel complaints (opsional)
            // Complaint::create([
            //     'sender_phone' => $phone,
            //     'message' => $complaint_text
            // ]);

            // Simpan ke tabel pelapor
            pelapor::create([
                'nomor_pelapor' => $phone, // Nomor WhatsApp mahasiswa
                'nama_pelapor' => $nama_pelapor, // Nama pelapor dari format pesan
                'unit_id' => $unit_id, // Unit ID berdasarkan mapping
                'complaint_text' => $complaint_text, // Isi laporan dari format pesan
                'pending' => now(),
                'forwarded_at' => null,
                'processed_at' => null,
                'completed_at' => null,
                'status' => 'pending',
            ]);
        }

        return response()->json(['status' => 'success']);
    }
}
