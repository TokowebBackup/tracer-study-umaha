<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $tracer = new \App\Models\TracerModel();
        $alumni = new \App\Models\AlumniModel();

        $data['total_alumni'] = $alumni->countAll();
        $data['total_tracer'] = $tracer->countAll();
        $data['grafik'] = [
            'bekerja' => $tracer->where('status_pekerjaan', 'bekerja')->countAllResults(),
            'wirausaha' => $tracer->where('status_pekerjaan', 'wirausaha')->countAllResults(),
            'belum_bekerja' => $tracer->where('status_pekerjaan', 'belum_bekerja')->countAllResults(),
            'studi_lanjut' => $tracer->where('status_pekerjaan', 'studi_lanjut')->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }
}
