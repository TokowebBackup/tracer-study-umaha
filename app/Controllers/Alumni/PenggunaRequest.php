<?php

namespace App\Controllers\Alumni;

use App\Controllers\BaseController;
use App\Models\PenggunaRequestModel;
use App\Models\TracerModel;

class PenggunaRequest extends BaseController
{
    public function index()
    {
        $alumniId = session()->get('alumni_id');

        $requestModel = new PenggunaRequestModel();

        $requests = $requestModel
            ->where('alumni_id', $alumniId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('alumni/request_pengguna', [
            'requests' => $requests
        ]);
    }

    public function generate()
    {
        $alumniId = session()->get('alumni_id');

        $whatsapp = $this->request->getPost('whatsapp');

        // =============================================
        // NORMALISASI NOMOR WHATSAPP
        // =============================================

        $whatsapp = preg_replace('/[^0-9]/', '', $whatsapp);

        if (substr($whatsapp, 0, 1) === '0') {

            $whatsapp = '62' . substr($whatsapp, 1);
        }

        $tracerModel = new TracerModel();

        $tracer = $tracerModel
            ->where('alumni_id', $alumniId)
            ->first();

        if (!$tracer) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tracer belum tersedia.'
                );
        }

        // =============================================
        // GENERATE TOKEN
        // =============================================

        $token = bin2hex(random_bytes(32));

        $requestModel = new PenggunaRequestModel();

        // =============================================
        // CEK REQUEST YANG MASIH AKTIF
        // =============================================

        $existingRequest = $requestModel
            ->where('alumni_id', $alumniId)
            ->groupStart()
            ->where('is_sent', 1)
            ->orWhere('is_submitted', 1)
            ->groupEnd()
            ->first();

        if ($existingRequest) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Request penilaian pengguna sudah pernah dibuat.'
                );
        }

        // =============================================
        // INSERT REQUEST
        // =============================================

        $requestId = $requestModel->insert([

            'alumni_id' => $alumniId,

            'nama_perusahaan' =>
            $tracer['institusi_bekerja'],

            'alamat_perusahaan' =>
            $tracer['alamat_perusahaan'] ?? null,

            'no_telp_penilai' => $whatsapp,

            'token' => $token,

            'is_sent' => 1,

            'sent_at' => date('Y-m-d H:i:s'),

            'is_submitted' => 0,

            'expired_at' => date(
                'Y-m-d H:i:s',
                strtotime('+30 days')
            ),
        ]);

        // =============================================
        // LINK KUESIONER
        // =============================================

        $link = base_url(
            'kuesioner/pengguna/' . $token
        );

        // =============================================
        // PESAN WHATSAPP
        // =============================================

        $message =
            "Halo,\n\n" .

            "Mohon kesediaannya untuk mengisi " .

            "Kuesioner Pengguna Lulusan UMAHA.\n\n" .

            "Link kuesioner:\n" .

            $link . "\n\n" .

            "Terima kasih.";

        // =============================================
        // URL WHATSAPP
        // =============================================

        $waUrl =
            'https://wa.me/' .
            $whatsapp .
            '?text=' .
            urlencode($message);

        return redirect()->to($waUrl);
    }
}
