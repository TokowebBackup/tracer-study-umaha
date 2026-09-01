<?php
// app/Controllers/KuesionerPengguna.php
namespace App\Controllers;

use App\Models\{LandingModel};
use App\Models\PenggunaModel;

class KuesionerPengguna extends BaseController
{
    public function index($token = null)
    {
        $requestModel = new \App\Models\PenggunaRequestModel();

        $request = $requestModel
            ->where('token', $token)
            ->first();

        // =====================================================
        // TOKEN INVALID
        // =====================================================

        if (!$request) {

            return redirect()
                ->to('/')
                ->with(
                    'error',
                    'Link kuesioner tidak valid.'
                );
        }

        // =====================================================
        // SUDAH SUBMIT
        // =====================================================

        if ((int)$request['is_submitted'] === 1) {

            return redirect()
                ->to('/')
                ->with(
                    'error',
                    'Kuesioner pengguna sudah pernah diisi.'
                );
        }

        // =====================================================
        // TOKEN EXPIRED
        // =====================================================

        if (
            !empty($request['expired_at']) &&
            strtotime($request['expired_at']) < time()
        ) {

            return redirect()
                ->to('/')
                ->with(
                    'error',
                    'Link kuesioner sudah kadaluarsa.'
                );
        }

        $landing = new LandingModel();

        $data['landing'] = [

            'title' =>
            $landing->getValue('judul')
                ?? 'Tracer Study UMAHA',

            'subtitle' =>
            $landing->getValue('subjudul')
                ?? 'Jembatan antara kampus ...',

            'description' =>
            $landing->getValue('konten')
                ?? 'Dukung pengembangan kurikulum ...'
        ];

        $data['social_links'] =
            $landing->getSocialLinks();

        // =====================================================
        // REQUEST DATA
        // =====================================================

        $data['request'] = $request;

        return view(
            'kuesioner_pengguna',
            $data
        );
    }

    public function simpan()
    {
        $penggunaModel = new PenggunaModel();

        if (!$this->validate([
            'nama_perusahaan' => 'required',
            'nama_pengisi'    => 'required',
            'jabatan_pengisi' => 'required',
            'tahun_merekrut'  => 'required|numeric',
            'jumlah_lulusan_direkrut' => 'required|numeric',
        ])) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Form belum lengkap atau tidak valid.'
                );
        }

        $data = $this->request->getPost();

        $requestModel = new \App\Models\PenggunaRequestModel();

        $request = $requestModel
            ->where(
                'token',
                $this->request->getPost('token')
            )
            ->first();

        if (!$request) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Token tidak valid.'
                );
        }

        // =====================================================
        // CEGAH DOUBLE SUBMIT
        // =====================================================

        if ((int)$request['is_submitted'] === 1) {

            return redirect()
                ->to('/')
                ->with(
                    'error',
                    'Kuesioner sudah pernah diisi.'
                );
        }

        // =====================================================
        // SAVE KUESIONER
        // =====================================================

        // =====================================================
        // RELASI
        // =====================================================

        $data['alumni_id'] =
            $request['alumni_id'];

        $data['request_id'] =
            $request['id'];

        // =====================================================
        // SAVE KUESIONER
        // =====================================================

        $penggunaModel->save($data);

        // =====================================================
        // UPDATE REQUEST STATUS
        // =====================================================

        $requestModel->update(
            $request['id'],
            [

                'is_submitted' => 1,

                'submitted_at' => date(
                    'Y-m-d H:i:s'
                ),
            ]
        );

        return redirect()
            ->to('/')
            ->with(
                'success',
                'Terima kasih! Kuesioner pengguna telah disimpan.'
            );
    }
}
