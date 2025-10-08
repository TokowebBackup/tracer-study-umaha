<?php

namespace App\Controllers\Alumni;

use App\Controllers\BaseController;
use App\Models\TracerModel;
use App\Models\AlumniModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        $email = $session->get('email');

        $alumniModel = new AlumniModel();
        $tracerModel = new TracerModel();

        $alumni = $alumniModel
            ->select('alumni.*, prodi.nama_prodi, prodi.jenjang')
            ->join('prodi', 'prodi.kode_prodi = alumni.program_studi', 'left')
            ->where('alumni.email', $email)
            ->first();
        if (!$alumni) {
            return redirect()->to('/')->with('error', 'Data alumni tidak ditemukan.');
        }

        // Ganti pencarian tracer berdasarkan alumni_id
        $tracer = $tracerModel->where('alumni_id', $alumni['id'])->first();

        return view('alumni/dashboard', [
            'alumni' => $alumni,
            'tracer' => $tracer
        ]);
    }
}
