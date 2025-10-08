<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\TracerModel;
use App\Models\AlumniModel;

class Tracer extends BaseController
{
    protected $tracerModel;
    protected $alumniModel;

    public function __construct()
    {
        $this->tracerModel = new TracerModel();
        $this->alumniModel = new AlumniModel();
    }

    // ==============================
    // ✅ 1. LIST DATA TRACER STUDY
    // ==============================
    public function index()
    {
        $data['title'] = 'Data Tracer Study';

        $data['tracers'] = $this->tracerModel
            ->select('tracer_study.*, alumni.nama, alumni.nim, prodi.nama_prodi, prodi.jenjang')
            ->join('alumni', 'alumni.id = tracer_study.alumni_id', 'left')
            ->join('prodi', 'prodi.kode_prodi = alumni.program_studi', 'left')
            ->orderBy('tracer_study.created_at', 'DESC')
            ->findAll();

        return view('admin/tracer/index', $data);
    }

    // ==============================
    // ✅ 2. DETAIL DATA TRACER STUDY
    // ==============================
    public function detail($id)
    {
        $data['tracer'] = $this->tracerModel
            ->select('tracer_study.*, alumni.nama, alumni.nim, alumni.email, prodi.nama_prodi, prodi.jenjang')
            ->join('alumni', 'alumni.id = tracer_study.alumni_id', 'left')
            ->join('prodi', 'prodi.kode_prodi = alumni.program_studi', 'left')
            ->where('tracer_study.id', $id)
            ->first();

        if (!$data['tracer']) {
            return redirect()->to(base_url('admin/tracer'))->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/tracer/detail', $data);
    }

    // ==============================
    // ✅ 3. HAPUS DATA TRACER STUDY
    // ==============================
    public function delete($id)
    {
        $this->tracerModel->delete($id);
        return redirect()->to(base_url('admin/tracer'))->with('success', 'Data tracer study berhasil dihapus.');
    }

    public function exportAll()
    {
        $data = $this->tracerModel
            ->select('tracer_study.*, alumni.nama, alumni.nim, prodi.nama_prodi, prodi.jenjang')
            ->join('alumni', 'alumni.id = tracer_study.alumni_id', 'left')
            ->join('prodi', 'prodi.kode_prodi = alumni.program_studi', 'left')
            ->orderBy('tracer_study.created_at', 'DESC')
            ->findAll();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        // =============================
        // 🧾 SHEET 1 — Data Alumni
        // =============================
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('Data Alumni');

        $headers1 = [
            'No',
            'Nama',
            'NIM',
            'Prodi',
            'Jenjang',
            'Tahun Pengisian',
            'Tahun Lulus',
            'Status Pekerjaan',
            'Institusi',
            'Posisi',
            'Tahun Mulai Bekerja',
            'Gaji Pertama',
            'Tempat Kerja (Kabupaten)',
            'Sektor',
            'Sesuai Bidang',
            'Dapat Kerja Sebelum Lulus',
            'Cara Mendapat Kerja',
            'Relevansi Kurikulum',
            'Saran Kurikulum',
            'Harapan UMAHA',
            'Domisili Alumni',
            'Bulan Mulai Mencari Pekerjaan',
            'Created At'
        ];

        // Header
        $col = 'A';
        foreach ($headers1 as $h) {
            $sheet1->setCellValue($col . '1', $h);
            $col++;
        }

        // Data
        $row = 2;
        $no = 1;
        foreach ($data as $d) {
            $col = 'A';
            $sheet1->setCellValue($col++ . $row, $no++);
            $sheet1->setCellValue($col++ . $row, $d['nama']);
            $sheet1->setCellValue($col++ . $row, $d['nim']);
            $sheet1->setCellValue($col++ . $row, $d['nama_prodi']);
            $sheet1->setCellValue($col++ . $row, $d['jenjang']);
            $sheet1->setCellValue($col++ . $row, $d['tahun_pengisian']);
            $sheet1->setCellValue($col++ . $row, $d['tahun_lulus']);
            $sheet1->setCellValue($col++ . $row, $d['status_pekerjaan']);
            $sheet1->setCellValue($col++ . $row, $d['institusi_bekerja']);
            $sheet1->setCellValue($col++ . $row, $d['posisi_pekerjaan']);
            $sheet1->setCellValue($col++ . $row, $d['tahun_mulai_bekerja']);
            $sheet1->setCellValue($col++ . $row, $d['gaji_pertama']);
            $sheet1->setCellValue($col++ . $row, $d['tempat_kerja_kabupaten']);
            $sheet1->setCellValue($col++ . $row, $d['sektor_tempat_kerja']);
            $sheet1->setCellValue($col++ . $row, $d['sesuai_bidang']);
            $sheet1->setCellValue($col++ . $row, $d['dapat_kerja_sebelum_lulus']);
            $sheet1->setCellValue($col++ . $row, $d['cara_mendapat_kerja']);
            $sheet1->setCellValue($col++ . $row, $d['relevansi_kurikulum']);
            $sheet1->setCellValue($col++ . $row, $d['saran_kurikulum']);
            $sheet1->setCellValue($col++ . $row, $d['harapan_umaha']);
            $sheet1->setCellValue($col++ . $row, $d['domisili_alumni']);
            $sheet1->setCellValue($col++ . $row, $d['bulan_mulai_mencari_pekerjaan']);
            $sheet1->setCellValue($col++ . $row, $d['created_at']);
            $row++;
        }

        // Auto width
        foreach (range('A', $sheet1->getHighestColumn()) as $col) {
            $sheet1->getColumnDimension($col)->setAutoSize(true);
        }

        // Border
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $sheet1->getStyle('A1:' . $sheet1->getHighestColumn() . ($row - 1))->applyFromArray($styleArray);


        // =============================
        // 🧮 SHEET 2 — Penilaian & Evaluasi
        // =============================
        $sheet2 = $spreadsheet->createSheet();
        $sheet2->setTitle('Penilaian');

        $headers2 = [
            'No',
            'Nama',
            'NIM',
            'Prodi',
            'Jenjang',
            'Kepuasan Etika',
            'Kepuasan Bidang Ilmu',
            'Kepuasan Bahasa Asing',
            'Kepuasan Teknologi Informasi',
            'Kepuasan Komunikasi',
            'Kepuasan Kerjasama',
            'Kepuasan Pengembangan Diri'
        ];

        // Header
        $col = 'A';
        foreach ($headers2 as $h) {
            $sheet2->setCellValue($col . '1', $h);
            $col++;
        }

        // Data
        $row = 2;
        $no = 1;
        foreach ($data as $d) {
            $col = 'A';
            $sheet2->setCellValue($col++ . $row, $no++);
            $sheet2->setCellValue($col++ . $row, $d['nama']);
            $sheet2->setCellValue($col++ . $row, $d['nim']);
            $sheet2->setCellValue($col++ . $row, $d['nama_prodi']);
            $sheet2->setCellValue($col++ . $row, $d['jenjang']);
            $sheet2->setCellValue($col++ . $row, $d['kepuasan_etika']);
            $sheet2->setCellValue($col++ . $row, $d['kepuasan_keahlian_bidan_ilmu']);
            $sheet2->setCellValue($col++ . $row, $d['kepuasan_bahasa_asing']);
            $sheet2->setCellValue($col++ . $row, $d['kepuasan_teknologi_informasi']);
            $sheet2->setCellValue($col++ . $row, $d['kepuasan_komunikasi']);
            $sheet2->setCellValue($col++ . $row, $d['kepuasan_kerjasama']);
            $sheet2->setCellValue($col++ . $row, $d['kepuasan_pengembangan_diri']);
            $row++;
        }

        // Auto width + border
        foreach (range('A', $sheet2->getHighestColumn()) as $col) {
            $sheet2->getColumnDimension($col)->setAutoSize(true);
        }
        $sheet2->getStyle('A1:' . $sheet2->getHighestColumn() . ($row - 1))->applyFromArray($styleArray);

        // =============================
        // 📊 SHEET 3 — Summary Statistik
        // =============================
        $sheet3 = $spreadsheet->createSheet();
        $sheet3->setTitle('Summary');

        // Header
        $sheet3->setCellValue('A1', 'Aspek Penilaian');
        $sheet3->setCellValue('B1', 'Rata-rata');

        // Hitung rata-rata
        $total = [
            'kepuasan_etika' => 0,
            'kepuasan_keahlian_bidan_ilmu' => 0,
            'kepuasan_bahasa_asing' => 0,
            'kepuasan_teknologi_informasi' => 0,
            'kepuasan_komunikasi' => 0,
            'kepuasan_kerjasama' => 0,
            'kepuasan_pengembangan_diri' => 0,
        ];
        $count = count($data);

        foreach ($data as $d) {
            foreach ($total as $k => $v) {
                $total[$k] += (int) $d[$k];
            }
        }

        if ($count > 0) {
            foreach ($total as $k => &$v) {
                $v = round($v / $count, 2);
            }
        }

        $labels = [
            'kepuasan_etika' => 'Kepuasan Etika',
            'kepuasan_keahlian_bidan_ilmu' => 'Kepuasan Bidang Ilmu',
            'kepuasan_bahasa_asing' => 'Kepuasan Bahasa Asing',
            'kepuasan_teknologi_informasi' => 'Kepuasan Teknologi Informasi',
            'kepuasan_komunikasi' => 'Kepuasan Komunikasi',
            'kepuasan_kerjasama' => 'Kepuasan Kerjasama',
            'kepuasan_pengembangan_diri' => 'Kepuasan Pengembangan Diri'
        ];

        // Isi data summary
        $row = 2;
        foreach ($labels as $key => $label) {
            $sheet3->setCellValue('A' . $row, $label);
            $sheet3->setCellValue('B' . $row, $total[$key]);
            $row++;
        }

        // Format kolom
        $sheet3->getColumnDimension('A')->setAutoSize(true);
        $sheet3->getColumnDimension('B')->setAutoSize(true);
        $sheet3->getStyle('A1:B1')->getFont()->setBold(true);
        $sheet3->getStyle('A1:B' . ($row - 1))->applyFromArray($styleArray);


        // =============================
        // 💾 OUTPUT FILE
        // =============================
        $filename = 'TracerStudy_All_' . date('Ymd_His') . '.xlsx';
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer->save('php://output');
        exit;
    }

    public function exportSingle($id)
    {
        $d = $this->tracerModel
            ->select('tracer_study.*, alumni.nama, alumni.nim, prodi.nama_prodi, prodi.jenjang')
            ->join('alumni', 'alumni.id = tracer_study.alumni_id', 'left')
            ->join('prodi', 'prodi.kode_prodi = alumni.program_studi', 'left')
            ->where('tracer_study.id', $id)
            ->first();

        if (!$d) {
            return redirect()->to(base_url('admin/tracer'))->with('error', 'Data tidak ditemukan.');
        }

        $spreadsheet = new Spreadsheet();
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        // =============================
        // 🧾 SHEET 1 — Data Alumni
        // =============================
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('Data Alumni');

        $headers1 = [
            'Nama',
            'NIM',
            'Prodi',
            'Jenjang',
            'Tahun Pengisian',
            'Tahun Lulus',
            'Status Pekerjaan',
            'Institusi Bekerja',
            'Posisi Pekerjaan',
            'Tahun Mulai Bekerja',
            'Gaji Pertama',
            'Tempat Kerja (Kabupaten)',
            'Sektor Tempat Kerja',
            'Sesuai Bidang',
            'Dapat Kerja Sebelum Lulus',
            'Cara Mendapat Kerja',
            'Relevansi Kurikulum',
            'Saran Kurikulum',
            'Harapan UMAHA',
            'Domisili Alumni',
            'Bulan Mulai Mencari Pekerjaan',
            'Created At'
        ];

        $col = 'A';
        foreach ($headers1 as $h) {
            $sheet1->setCellValue($col . '1', $h);
            $col++;
        }

        $row = 2;
        $col = 'A';
        $sheet1->setCellValue($col++ . $row, $d['nama']);
        $sheet1->setCellValue($col++ . $row, $d['nim']);
        $sheet1->setCellValue($col++ . $row, $d['nama_prodi']);
        $sheet1->setCellValue($col++ . $row, $d['jenjang']);
        $sheet1->setCellValue($col++ . $row, $d['tahun_pengisian']);
        $sheet1->setCellValue($col++ . $row, $d['tahun_lulus']);
        $sheet1->setCellValue($col++ . $row, $d['status_pekerjaan']);
        $sheet1->setCellValue($col++ . $row, $d['institusi_bekerja']);
        $sheet1->setCellValue($col++ . $row, $d['posisi_pekerjaan']);
        $sheet1->setCellValue($col++ . $row, $d['tahun_mulai_bekerja']);
        $sheet1->setCellValue($col++ . $row, $d['gaji_pertama']);
        $sheet1->setCellValue($col++ . $row, $d['tempat_kerja_kabupaten']);
        $sheet1->setCellValue($col++ . $row, $d['sektor_tempat_kerja']);
        $sheet1->setCellValue($col++ . $row, $d['sesuai_bidang']);
        $sheet1->setCellValue($col++ . $row, $d['dapat_kerja_sebelum_lulus']);
        $sheet1->setCellValue($col++ . $row, $d['cara_mendapat_kerja']);
        $sheet1->setCellValue($col++ . $row, $d['relevansi_kurikulum']);
        $sheet1->setCellValue($col++ . $row, $d['saran_kurikulum']);
        $sheet1->setCellValue($col++ . $row, $d['harapan_umaha']);
        $sheet1->setCellValue($col++ . $row, $d['domisili_alumni']);
        $sheet1->setCellValue($col++ . $row, $d['bulan_mulai_mencari_pekerjaan']);
        $sheet1->setCellValue($col++ . $row, $d['created_at']);

        foreach (range('A', $sheet1->getHighestColumn()) as $col) {
            $sheet1->getColumnDimension($col)->setAutoSize(true);
        }
        $sheet1->getStyle('A1:' . $sheet1->getHighestColumn() . $row)->applyFromArray($styleArray);

        // =============================
        // 🧠 SHEET 2 — Penilaian & Evaluasi
        // =============================
        $sheet2 = $spreadsheet->createSheet();
        $sheet2->setTitle('Penilaian');

        $headers2 = [
            'Nama',
            'NIM',
            'Prodi',
            'Jenjang',
            'Kepuasan Etika',
            'Kepuasan Bidang Ilmu',
            'Kepuasan Bahasa Asing',
            'Kepuasan Teknologi Informasi',
            'Kepuasan Komunikasi',
            'Kepuasan Kerjasama',
            'Kepuasan Pengembangan Diri'
        ];

        $col = 'A';
        foreach ($headers2 as $h) {
            $sheet2->setCellValue($col . '1', $h);
            $col++;
        }

        $row = 2;
        $col = 'A';
        $sheet2->setCellValue($col++ . $row, $d['nama']);
        $sheet2->setCellValue($col++ . $row, $d['nim']);
        $sheet2->setCellValue($col++ . $row, $d['nama_prodi']);
        $sheet2->setCellValue($col++ . $row, $d['jenjang']);
        $sheet2->setCellValue($col++ . $row, $d['kepuasan_etika']);
        $sheet2->setCellValue($col++ . $row, $d['kepuasan_keahlian_bidan_ilmu']);
        $sheet2->setCellValue($col++ . $row, $d['kepuasan_bahasa_asing']);
        $sheet2->setCellValue($col++ . $row, $d['kepuasan_teknologi_informasi']);
        $sheet2->setCellValue($col++ . $row, $d['kepuasan_komunikasi']);
        $sheet2->setCellValue($col++ . $row, $d['kepuasan_kerjasama']);
        $sheet2->setCellValue($col++ . $row, $d['kepuasan_pengembangan_diri']);

        foreach (range('A', $sheet2->getHighestColumn()) as $col) {
            $sheet2->getColumnDimension($col)->setAutoSize(true);
        }
        $sheet2->getStyle('A1:' . $sheet2->getHighestColumn() . $row)->applyFromArray($styleArray);

        // =============================
        // 💾 OUTPUT FILE
        // =============================
        $filename = 'Tracer_' . preg_replace('/[^A-Za-z0-9]/', '_', $d['nama']) . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer->save('php://output');
        exit;
    }
}
