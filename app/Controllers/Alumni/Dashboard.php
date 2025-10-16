<?php

namespace App\Controllers\Alumni;

use App\Controllers\BaseController;
use App\Models\TracerModel;
use App\Models\AlumniModel;
use Config\Database;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        $email = $session->get('email');

        $alumniModel = new AlumniModel();
        $tracerModel = new TracerModel();

        // Ambil data alumni
        $alumni = $alumniModel
            ->select('alumni.*, prodi.nama_prodi, prodi.jenjang')
            ->join('prodi', 'prodi.kode_prodi = alumni.program_studi', 'left')
            ->where('alumni.email', $email)
            ->first();

        if (!$alumni) {
            return redirect()->to('/')->with('error', 'Data alumni tidak ditemukan.');
        }

        // Ambil data tracer
        $tracer = $tracerModel->where('alumni_id', $alumni['id'])->first();

        // -------------------------------
        // CEK KELENGKAPAN KOLOM DI DATABASE
        // -------------------------------
        $db = Database::connect();
        $table = 'tracer_study';
        $existingColumns = $db->getFieldNames($table);

        // Daftar kolom penting yang digunakan di view + kemungkinan tambahan
        $requiredColumns = [
            // Identitas umum
            'id',
            'alumni_id',
            'tahun_pengisian',
            'tahun_lulus',

            // Status pekerjaan
            'status_pekerjaan',
            'institusi_bekerja',
            'posisi_pekerjaan',
            'tahun_mulai_bekerja',
            'gaji_pertama',
            'domisili_alumni',
            'tempat_kerja_kabupaten',
            'sektor_tempat_kerja',
            'sesuai_bidang',
            'dapat_kerja_sebelum_lulus',
            'cara_mendapat_kerja',
            'bulan_mulai_mencari_pekerjaan',

            // Kepuasan & Penilaian
            'kepuasan_etika',
            'kepuasan_keahlian_bidan_ilmu',
            'kepuasan_bahasa_asing',
            'kepuasan_teknologi_informasi',
            'kepuasan_komunikasi',
            'kepuasan_kerjasama',
            'kepuasan_pengembangan_diri',

            // Relevansi & harapan
            'relevansi_kurikulum',
            'saran_kurikulum',
            'harapan_umaha',

            // Audit fields
            'created_at',
            'updated_at'
        ];

        // Cek kolom mana yang belum ada di tabel
        $missingColumns = array_diff($requiredColumns, $existingColumns);

        // Ambil email admin dari tabel admin
        $adminEmail = null;
        try {
            $adminRow = $db->table('admin')->select('email')->get()->getFirstRow();
            if ($adminRow && isset($adminRow->email)) {
                $adminEmail = $adminRow->email;
            }
        } catch (\Throwable $th) {
            $adminEmail = null;
        }

        // Jika ada kolom yang hilang, tampilkan alert untuk user
        if (!empty($missingColumns)) {
            $missingList = implode(', ', $missingColumns);

            if ($adminEmail) {
                $mailto = "mailto:{$adminEmail}?subject=Kelengkapan Field Tracer Study&body=Halo Admin,%0D%0AKolom berikut belum tersedia di tabel tracer_study:%0D%0A- " . str_replace(', ', "%0D%0A- ", $missingList);
                session()->setFlashdata('info', "Kolom berikut belum tersedia di tabel tracer_study: <strong>{$missingList}</strong>.<br>Silakan hubungi admin melalui <a href='{$mailto}'>email ini</a> untuk memperbaruinya.");
            } else {
                session()->setFlashdata('info', "Kolom berikut belum tersedia di tabel tracer_study: <strong>{$missingList}</strong>. Namun email admin belum terdaftar di tabel <code>admin</code>.");
            }
        }

        // -------------------------------
        // CEK SETIAP FIELD TRACER NULL/TAK ADA
        // -------------------------------
        if ($tracer) {
            foreach ($requiredColumns as $col) {
                if (!array_key_exists($col, $tracer)) {
                    $tracer[$col] = '-'; // kasih nilai default biar gak error
                }
            }
        }

        return view('alumni/dashboard', [
            'alumni' => $alumni,
            'tracer' => $tracer,
        ]);
    }
}
