<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PeriodeModel;

class Periode extends BaseController
{
    public function index()
    {
        $model = new PeriodeModel();
        $data['list'] = $model->orderBy('tahun', 'DESC')->findAll();
        return view('admin/periode/index', $data);
    }

    public function tambah()
    {
        return view('admin/periode/tambah');
    }

    public function simpan()
    {
        $model = new PeriodeModel();

        $file = $this->request->getFile('file_surat');
        $path = null;
        if ($file && $file->isValid()) {
            $path = 'uploads/surat/' . $file->getRandomName();
            $file->move('uploads/surat', basename($path));
        }

        $model->insert([
            'tahun' => $this->request->getPost('tahun'),
            'lulusan_tahun' => $this->request->getPost('lulusan_tahun'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'file_surat' => $path
        ]);

        return redirect()->to('/admin/periode')->with('success', 'Berhasil menambahkan periode');
    }
}
