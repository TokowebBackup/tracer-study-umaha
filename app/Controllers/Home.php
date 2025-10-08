<?php

// app/Controllers/Home.php
namespace App\Controllers;

use App\Models\{TahunModel, SettingsModel, LandingModel};
use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index()
    {
        $tahunModel = new TahunModel();
        $landing      = new LandingModel();
        $data['tahun_list'] = $tahunModel->getTahunUnik(); // ini benar
        $periodeModel = new \App\Models\PeriodeModel();
        $settingModel = new SettingsModel();
        $data['pdfLink'] = $settingModel->getValue('panduan_tracer') ?? '#';
        $data['landing'] = [
            'title'       => $landing->getValue('judul')      ?? 'Tracer Study UMAHA',
            'subtitle'    => $landing->getValue('subjudul')   ?? 'Jembatan antara kampus ...',
            'description' => $landing->getValue('konten') ??
                'Dukung pengembangan kurikulum ...'
        ];

        // -------- social links ----------
        $data['social_links'] = $landing->getSocialLinks();

        $data['menuItems'] = [
            [
                'icon' => 'bi-people-fill',
                'text' => 'KUESIONER TRACER STUDY',
                'link' => '#',
                'modal' => true
            ],
            [
                'icon' => 'bi-person-fill-check',
                'text' => 'KUESIONER PENGGUNA LULUSAN',
                'link' => base_url('/kuesioner/pengguna')
            ],
            [
                'icon' => 'bi-mortarboard-fill',
                'text' => 'REKAPITULASI DATA TRACER STUDY',
                'link' => base_url('/laporan/alumni')
            ],
            [
                'icon' => 'bi-building-check',
                'text' => 'REKAPITULASI DATA PENGGUNA LULUSAN',
                'link' => base_url('/laporan/pengguna')
            ],
        ];

        foreach ($data['menuItems'] as &$item) {
            // hapus prefix 'bi-' jika perlu, sesuaikan nama file
            $iconFileName = str_replace('bi-', '', $item['icon']);
            $item['background'] = iconToBackground($iconFileName);
        }
        $data['periode_list'] = $periodeModel->orderBy('tahun', 'DESC')->findAll();
        return view('home', $data);
    }
}
