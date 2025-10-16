<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TracerModel;
use App\Models\AlumniModel;
use App\Models\PerusahaanModel; // kalau ada model perusahaan

class Dashboard extends BaseController
{
    public function index()
    {
        $tracer = new TracerModel();
        $alumni = new AlumniModel();

        $data['total_alumni'] = $alumni->countAll();
        $data['total_tracer'] = $tracer->countAll();

        // Persentase alumni yang sudah mengisi tracer
        $data['persentase_tracer'] = $data['total_alumni'] > 0
            ? round(($data['total_tracer'] / $data['total_alumni']) * 100, 1)
            : 0;

        // Pie chart status pekerjaan
        $data['grafik'] = [
            'bekerja' => $tracer->where('status_pekerjaan', 'bekerja')->countAllResults(),
            'wirausaha' => $tracer->where('status_pekerjaan', 'wirausaha')->countAllResults(),
            'belum_bekerja' => $tracer->where('status_pekerjaan', 'belum_bekerja')->countAllResults(),
            'studi_lanjut' => $tracer->where('status_pekerjaan', 'studi_lanjut')->countAllResults(),
        ];

        // Bar chart alumni per tahun kelulusan
        $tahun = $alumni->select('YEAR(tahun_lulus) as tahun, COUNT(*) as jumlah')
            ->groupBy('tahun')
            ->orderBy('tahun', 'ASC')
            ->findAll();
        $data['alumni_per_tahun'] = $tahun;

        // Top 5 perusahaan alumni bekerja
        $data['top_perusahaan'] = $tracer->select('institusi_bekerja, COUNT(*) as jumlah')
            ->groupBy('institusi_bekerja')
            ->orderBy('jumlah', 'DESC')
            ->limit(5)
            ->findAll();

        return view('admin/dashboard', $data);
    }
}
