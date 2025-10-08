<?php
// app/Controllers/KuesionerPengguna.php
namespace App\Controllers;

use App\Models\{ LandingModel};
use App\Models\PenggunaModel;

class KuesionerPengguna extends BaseController
{
    public function index()
    {
        $landing      = new LandingModel();
        $data['landing'] = [
            'title'       => $landing->getValue('judul')      ?? 'Tracer Study UMAHA',
            'subtitle'    => $landing->getValue('subjudul')   ?? 'Jembatan antara kampus ...',
            'description' => $landing->getValue('konten') ??
                'Dukung pengembangan kurikulum ...'
        ];

        // -------- social links ----------
        $data['social_links'] = $landing->getSocialLinks();
        return view('kuesioner_pengguna', $data);
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
            return redirect()->back()->withInput()->with('error', 'Form belum lengkap atau tidak valid.');
        }

        $data = $this->request->getPost();
        $penggunaModel->save($data);

        return redirect()->to('/')->with('success', 'Terima kasih! Kuesioner pengguna telah disimpan.');
    }
}
