<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TracerPenggunaSeeder extends Seeder
{
    public function run()
    {
        $alumni = $this->db
            ->table('alumni')
            ->get()
            ->getResultArray();

        if (!$alumni) {

            echo "Data alumni kosong.\n";
            return;
        }

        foreach ($alumni as $a) {

            // =========================================
            // UPDATE DATA ALUMNI
            // =========================================

            $this->db
                ->table('alumni')
                ->where('id', $a['id'])
                ->update([

                    'jenis_kelamin' => 'Laki-laki',

                    'tempat_lahir' => 'Bandung',

                    'tanggal_lahir' => '1999-05-22',

                    'jenjang' => 'S1',

                    'tahun_masuk' => 2018,

                    'tahun_lulus' => 2024,

                    'fakultas' => 'Teknik',

                    'sumber_dana' => 'Orang Tua',

                    'nik' => '3212345678900001',

                    'npwp' => '12.345.678.9-123.000',

                    'no_hp' => '081234567890',

                    'provinsi' => 'Jawa Barat',

                    'kota' => 'Bandung',
                ]);

            // =========================================
            // HAPUS TRACER LAMA
            // =========================================

            $this->db
                ->table('tracer_study')
                ->where('alumni_id', $a['id'])
                ->delete();

            // =========================================
            // INSERT TRACER STUDY
            // =========================================

            $this->db
                ->table('tracer_study')
                ->insert([

                    'alumni_id' => $a['id'],

                    'tahun_pengisian' => 2026,

                    'tahun_lulus' => 2024,

                    'status_pekerjaan' => 'bekerja',

                    'institusi_bekerja' =>
                    'PT Teknologi Nusantara',

                    'alamat_perusahaan' =>
                    'Jl. Jenderal Sudirman No. 123 Jakarta',

                    'posisi_pekerjaan' =>
                    'Software Engineer',

                    'tahun_mulai_bekerja' => 2024,

                    'gaji_pertama' => 7500000,

                    'tempat_kerja_kabupaten' =>
                    'Jakarta Selatan',

                    'sektor_tempat_kerja' =>
                    'Teknologi Informasi',

                    'sesuai_bidang' => 'ya',

                    'dapat_kerja_sebelum_lulus' => 'tidak',

                    'cara_mendapat_kerja' =>
                    'Melalui LinkedIn dan job fair kampus.',

                    'kepuasan_etika' => 5,

                    'kepuasan_keahlian_bidan_ilmu' => 4,

                    'kepuasan_bahasa_asing' => 4,

                    'kepuasan_teknologi_informasi' => 5,

                    'kepuasan_komunikasi' => 4,

                    'kepuasan_kerjasama' => 5,

                    'kepuasan_pengembangan_diri' => 5,

                    'relevansi_kurikulum' => 'tinggi',

                    'saran_kurikulum' =>
                    'Perbanyak praktik industri dan project real.',

                    'harapan_umaha' =>
                    'Semoga UMAHA semakin maju dan memiliki lebih banyak kerja sama industri.',

                    'domisili_alumni' =>
                    'Bandung, Jawa Barat',

                    'bulan_mulai_mencari_pekerjaan' =>
                    '2 bulan setelah lulus',

                    'email' =>
                    $a['email'] ?? 'alumni@mail.com',

                    'nik' =>
                    '3212345678900001',

                    'npwp' =>
                    '12.345.678.9-123.000',

                    // =====================================
                    // STUDI LANJUT
                    // =====================================

                    'sumber_biaya_studi_lanjut' =>
                    'Beasiswa',

                    'perguruan_tinggi_studi_lanjut' =>
                    'Institut Teknologi Bandung',

                    'program_studi_lanjut' =>
                    'Magister Informatika',

                    // =====================================
                    // WIRAUSAHA
                    // =====================================

                    'nama_usaha' =>
                    'Digital Creative Studio',

                    'skala_usaha' =>
                    'UMKM',

                    'pendapatan_usaha' =>
                    12000000,

                    // =====================================
                    // KEBUTUHAN DUNIA KERJA
                    // =====================================

                    'kebutuhan_etika' => 5,

                    'kebutuhan_keahlian_bidang_ilmu' => 5,

                    'kebutuhan_bahasa_inggris' => 4,

                    'kebutuhan_teknologi_informasi' => 5,

                    'kebutuhan_komunikasi' => 4,

                    'kebutuhan_kerjasama' => 5,

                    'kebutuhan_pengembangan_diri' => 5,

                    // =====================================
                    // KONTRIBUSI KAMPUS
                    // =====================================

                    'kontribusi_perkuliahan' => 5,

                    'kontribusi_demonstrasi' => 4,

                    'kontribusi_riset' => 4,

                    'kontribusi_diskusi' => 5,

                    'kontribusi_praktikum' => 5,

                    'kontribusi_magang' => 5,

                    'kontribusi_studi_kasus' => 5,

                    // =====================================
                    // TRACKING KERJA
                    // =====================================

                    'mulai_mencari_kerja' =>
                    '1 bulan sebelum lulus',

                    'jumlah_lamaran' => '15',

                    'jumlah_respon' => '8',

                    'jumlah_wawancara' => '5',

                    'aktif_mencari_kerja' =>
                    'Tidak, karena sudah bekerja',

                    'alasan_pekerjaan_tidak_sesuai' =>
                    'Tidak ada, pekerjaan sudah sesuai bidang.',

                    'created_at' =>
                    date('Y-m-d H:i:s'),
                ]);

            echo "Seeder tracer alumni ID {$a['id']} berhasil.\n";
        }

        echo "Seeder tracer selesai.\n";
    }
}
