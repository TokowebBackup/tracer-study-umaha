<?php
// app/Controllers/Rekap.php
namespace App\Controllers;

use App\Models\{TracerModel, PenggunaModel, AlumniModel, LandingModel, ProdiModel};
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Rekap extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function tracer()
    {
        $tracerModel = new TracerModel();
        $prodiModel = new ProdiModel();
        $landing      = new LandingModel();

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

        // Ambil filter input
        $tahun = $this->request->getGet('tahun');
        $prodiNama = $this->request->getGet('prodi');

        // Untuk dropdown filter
        $data['tahun_list'] = $tracerModel->select('tahun_pengisian')->distinct()->orderBy('tahun_pengisian', 'DESC')->findAll();
        $data['prodi_list'] = $prodiModel->orderBy('nama_prodi')->findAll();
        $data['filter_tahun'] = $tahun;
        $data['filter_prodi'] = $prodiNama;

        // Ambil kode_prodi dari nama_prodi (untuk WHERE)
        $kodeProdi = null;
        if ($prodiNama) {
            $prodiRow = $prodiModel->where('nama_prodi', $prodiNama)->first();
            $kodeProdi = $prodiRow['kode_prodi'] ?? null;
        }

        // Build condition for WHERE (manual SQL & Query Builder)
        $filter = function ($builder) use ($tahun, $kodeProdi) {
            if ($tahun) {
                $builder->where('tracer_study.tahun_pengisian', $tahun);
            }
            if ($kodeProdi) {
                $builder->where('alumni.program_studi', $kodeProdi);
            }
        };

        // Data utama (list alumni + tracer)
        $builder = $tracerModel
            ->select('tracer_study.*, alumni.nama, alumni.nim, prodi.nama_prodi')
            ->join('alumni', 'alumni.id = tracer_study.alumni_id')
            ->join('prodi', 'prodi.kode_prodi = alumni.program_studi');
        $filter($builder);
        $data['list'] = $builder->findAll();

        // Reusable SQL WHERE clause
        $whereSQL = [];
        if ($tahun) $whereSQL[] = "tracer_study.tahun_pengisian = " . $this->db->escape($tahun);
        if ($kodeProdi) $whereSQL[] = "alumni.program_studi = " . $this->db->escape($kodeProdi);
        $whereClause = $whereSQL ? 'WHERE ' . implode(' AND ', $whereSQL) : '';

        // Helper to run query
        $runQuery = function($sql) {
            return $this->db->query($sql)->getResultArray();
        };

        // Rekap data
        $data['rekap_prodi'] = $runQuery("
        SELECT prodi.nama_prodi, prodi.jenjang, COUNT(*) as total
        FROM tracer_study
        JOIN alumni ON alumni.id = tracer_study.alumni_id
        JOIN prodi ON prodi.kode_prodi = alumni.program_studi
        $whereClause
        GROUP BY prodi.nama_prodi, prodi.jenjang
        ORDER BY prodi.jenjang, prodi.nama_prodi
    ");

        $data['rekap_jk'] = $runQuery("
        SELECT alumni.jenis_kelamin, COUNT(*) as total
        FROM tracer_study
        JOIN alumni ON alumni.id = tracer_study.alumni_id
        $whereClause
        GROUP BY alumni.jenis_kelamin
    ");

        // Sebelum Lulus (bulan negatif)
        $data['rekap_bulan_sebelum'] = $this->db->query("
            SELECT 
                (alumni.tahun_lulus - tracer_study.tahun_mulai_bekerja) * 12 AS kategori,
                COUNT(*) AS total
            FROM tracer_study
            JOIN alumni ON alumni.id = tracer_study.alumni_id
            $whereClause
            AND tracer_study.tahun_mulai_bekerja IS NOT NULL
            AND tracer_study.tahun_mulai_bekerja < alumni.tahun_lulus
            GROUP BY kategori
            ORDER BY kategori
        ")->getResultArray();

        // Setelah Lulus (bulan positif)
        $data['rekap_bulan_setelah'] = $this->db->query("
            SELECT 
                (tracer_study.tahun_mulai_bekerja - alumni.tahun_lulus) * 12 AS kategori,
                COUNT(*) AS total
            FROM tracer_study
            JOIN alumni ON alumni.id = tracer_study.alumni_id
            $whereClause
            AND tracer_study.tahun_mulai_bekerja IS NOT NULL
            AND tracer_study.tahun_mulai_bekerja >= alumni.tahun_lulus
            GROUP BY kategori
            ORDER BY kategori
        ")->getResultArray();


        $data['rekap_lulus'] = $runQuery("
        SELECT alumni.tahun_lulus, COUNT(*) as total
        FROM tracer_study
        JOIN alumni ON alumni.id = tracer_study.alumni_id
        $whereClause
        GROUP BY alumni.tahun_lulus
    ");

        $data['rekap_status'] = $runQuery("
        SELECT tracer_study.status_pekerjaan, COUNT(*) as total
        FROM tracer_study
        JOIN alumni ON alumni.id = tracer_study.alumni_id
        $whereClause
        GROUP BY tracer_study.status_pekerjaan
    ");

        $data['rekap_sumberdana'] = $runQuery("
        SELECT alumni.sumber_dana, COUNT(*) as total
        FROM tracer_study
        JOIN alumni ON alumni.id = tracer_study.alumni_id
        $whereClause
        GROUP BY alumni.sumber_dana
    ");

        $data['rekap_terdaftar'] = $runQuery("
        SELECT alumni.tahun_masuk, COUNT(*) as total
        FROM tracer_study
        JOIN alumni ON alumni.id = tracer_study.alumni_id
        $whereClause
        GROUP BY alumni.tahun_masuk
    ");

        $data['rekap_jenjang'] = $runQuery("
        SELECT prodi.jenjang, COUNT(*) as total
        FROM tracer_study
        JOIN alumni ON alumni.id = tracer_study.alumni_id
        JOIN prodi ON prodi.kode_prodi = alumni.program_studi
        $whereClause
        GROUP BY prodi.jenjang
    ");

        $data['rekap_sektor'] = $runQuery("
        SELECT tracer_study.sektor_tempat_kerja AS sektor, COUNT(*) as total
        FROM tracer_study
        JOIN alumni ON alumni.id = tracer_study.alumni_id
        $whereClause
        GROUP BY sektor
    ");

        $data['rekap_sesuai'] = $runQuery("
        SELECT tracer_study.sesuai_bidang AS sesuai, COUNT(*) as total
        FROM tracer_study
        JOIN alumni ON alumni.id = tracer_study.alumni_id
        $whereClause
        GROUP BY tracer_study.sesuai_bidang
    ");

        $data['rekap_sebelum_lulus'] = $runQuery("
        SELECT tracer_study.dapat_kerja_sebelum_lulus AS sebelum_lulus, COUNT(*) as total
        FROM tracer_study
        JOIN alumni ON alumni.id = tracer_study.alumni_id
        $whereClause
        GROUP BY tracer_study.dapat_kerja_sebelum_lulus
    ");

        $data['rekap_relevansi'] = $this->db->query("
            SELECT relevansi_kurikulum, COUNT(*) as total
            FROM tracer_study
            JOIN alumni ON alumni.id = tracer_study.alumni_id
            $whereClause
            GROUP BY relevansi_kurikulum
        ")->getResultArray();

        // Kabupaten pakai Query Builder
        $builderKab = $this->db->table('tracer_study')
            ->select('tracer_study.tempat_kerja_kabupaten AS kabupaten, COUNT(*) as total')
            ->join('alumni', 'alumni.id = tracer_study.alumni_id');
        $filter($builderKab);
        $data['rekap_kabupaten'] = $builderKab->groupBy('tempat_kerja_kabupaten')->get()->getResultArray();

        return view('rekap_tracer', $data);
    }


    public function pengguna()
    {
        $model = new \App\Models\PenggunaModel();

        $penggunaModel = new PenggunaModel();

        $landing      = new LandingModel();

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

        $tahun = $this->request->getGet('tahun');
        $nama = $this->request->getGet('nama_perusahaan');

        $builder = $model;

        if ($tahun) {
            $builder = $builder->where('tahun_merekrut', $tahun);
        }

        if ($nama) {
            $builder = $builder->like('nama_perusahaan', $nama);
        }

        $data['list'] = $builder->orderBy('created_at', 'DESC')->findAll();
        $data['tahun_list'] = $model->select('tahun_merekrut')->distinct()->orderBy('tahun_merekrut', 'DESC')->findAll();
        $data['filter_tahun'] = $tahun;
        $data['filter_nama'] = $nama;
        $sql = "
            SELECT prodi.nama_prodi, prodi.jenjang, COUNT(*) as total
            FROM pengguna_lulusan_detail
            JOIN pengguna_lulusan ON pengguna_lulusan.id = pengguna_lulusan_detail.pengguna_id
            JOIN alumni ON alumni.id = pengguna_lulusan_detail.alumni_id
            JOIN prodi ON prodi.kode_prodi = alumni.program_studi
            WHERE 1=1
        ";

        if ($tahun) {
            $sql .= " AND pengguna_lulusan.tahun_merekrut = " . $this->db->escape($tahun);
        }
        if ($nama) {
            $sql .= " AND pengguna_lulusan.nama_perusahaan LIKE " . $this->db->escape("%$nama%");
        }

        $sql .= " GROUP BY prodi.nama_prodi, prodi.jenjang ORDER BY prodi.jenjang, prodi.nama_prodi";

        $data['rekap_prodi'] = $this->db->query($sql)->getResultArray();


        $data['rekap_jenjang'] = $this->db->query("
            SELECT alumni.jenjang, COUNT(*) as total
            FROM pengguna_lulusan_detail
            JOIN alumni ON alumni.id = pengguna_lulusan_detail.alumni_id
            GROUP BY alumni.jenjang
        ")->getResultArray();

        $data['rekap_lembaga'] = $model->select("nama_perusahaan AS lembaga, COUNT(*) as total")
            ->groupBy("nama_perusahaan")
            ->findAll();

        $data['rekap_lulus'] = $this->db->query("
            SELECT alumni.tahun_lulus, COUNT(*) as total
            FROM pengguna_lulusan_detail
            JOIN alumni ON alumni.id = pengguna_lulusan_detail.alumni_id
            GROUP BY alumni.tahun_lulus
        ")->getResultArray();

        $data['rekap_wilayah'] = $this->db->query("
            SELECT CONCAT(alumni.provinsi, ', ', alumni.kota) AS provinsi_kota, COUNT(*) as total
            FROM pengguna_lulusan_detail
            JOIN alumni ON alumni.id = pengguna_lulusan_detail.alumni_id
            GROUP BY alumni.provinsi, alumni.kota
        ")->getResultArray();

        $data['rekap_terdaftar'] = $this->db->query("
            SELECT alumni.tahun_masuk, COUNT(*) as total
            FROM pengguna_lulusan_detail
            JOIN alumni ON alumni.id = pengguna_lulusan_detail.alumni_id
            GROUP BY alumni.tahun_masuk
        ")->getResultArray();

        $data['rekap_kondisi'] = $this->db->query("
            SELECT status_pekerjaan, COUNT(*) as total
            FROM tracer_study
            GROUP BY status_pekerjaan
        ")->getResultArray();

        return view('rekap_pengguna', $data);
    }

    public function exportAlumni()
    {
        $model = new \App\Models\TracerModel();
        $data = $model->select('tracer_study.*, alumni.nama, alumni.nim, alumni.program_studi, alumni.tahun_lulus')
            ->join('alumni', 'alumni.id = tracer_study.alumni_id')
            ->orderBy('tahun_pengisian', 'DESC')
            ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIM');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Prodi');
        $sheet->setCellValue('E1', 'Tahun Lulus');
        $sheet->setCellValue('F1', 'Status');
        $sheet->setCellValue('G1', 'Institusi');
        $sheet->setCellValue('H1', 'Posisi');
        $sheet->setCellValue('I1', 'Tahun Pengisian');

        $row = 2;
        foreach ($data as $i => $d) {
            $sheet->setCellValue("A$row", $i + 1);
            $sheet->setCellValue("B$row", $d['nim']);
            $sheet->setCellValue("C$row", $d['nama']);
            $sheet->setCellValue("D$row", $d['program_studi']);
            $sheet->setCellValue("E$row", $d['tahun_lulus']);
            $sheet->setCellValue("F$row", $d['status_pekerjaan']);
            $sheet->setCellValue("G$row", $d['institusi_bekerja']);
            $sheet->setCellValue("H$row", $d['posisi_pekerjaan']);
            $sheet->setCellValue("I$row", $d['tahun_pengisian']);
            $row++;
        }

        // Output
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Rekap_Tracer_Alumni.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
