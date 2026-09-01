<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KuesionerKemendikbudSeeder extends Seeder
{
    public function run()
    {
        $table = 'kuesioner_fields';

        $fields = [

            // =====================================================
            // BAGIAN VI
            // KEBUTUHAN KOMPETENSI DI TEMPAT KERJA
            // =====================================================

            [
                'field_name' => 'kebutuhan_etika',
                'label' => 'Etika Profesional Dibutuhkan di Tempat Kerja',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 100,
                'header' => 'Kebutuhan Kompetensi di Tempat Kerja',
            ],

            [
                'field_name' => 'kebutuhan_keahlian_bidang_ilmu',
                'label' => 'Keahlian Bidang Ilmu Dibutuhkan di Tempat Kerja',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 101,
                'header' => 'Kebutuhan Kompetensi di Tempat Kerja',
            ],

            [
                'field_name' => 'kebutuhan_bahasa_inggris',
                'label' => 'Bahasa Inggris Dibutuhkan di Tempat Kerja',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 102,
                'header' => 'Kebutuhan Kompetensi di Tempat Kerja',
            ],

            [
                'field_name' => 'kebutuhan_teknologi_informasi',
                'label' => 'Teknologi Informasi Dibutuhkan di Tempat Kerja',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 103,
                'header' => 'Kebutuhan Kompetensi di Tempat Kerja',
            ],

            [
                'field_name' => 'kebutuhan_komunikasi',
                'label' => 'Komunikasi Dibutuhkan di Tempat Kerja',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 104,
                'header' => 'Kebutuhan Kompetensi di Tempat Kerja',
            ],

            [
                'field_name' => 'kebutuhan_kerjasama',
                'label' => 'Kerjasama Tim Dibutuhkan di Tempat Kerja',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 105,
                'header' => 'Kebutuhan Kompetensi di Tempat Kerja',
            ],

            [
                'field_name' => 'kebutuhan_pengembangan_diri',
                'label' => 'Pengembangan Diri Dibutuhkan di Tempat Kerja',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 106,
                'header' => 'Kebutuhan Kompetensi di Tempat Kerja',
            ],

            // =====================================================
            // BAGIAN VII
            // METODE PEMBELAJARAN
            // =====================================================

            [
                'field_name' => 'kontribusi_perkuliahan',
                'label' => 'Kontribusi Perkuliahan',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 110,
                'header' => 'Kontribusi Metode Pembelajaran',
            ],

            [
                'field_name' => 'kontribusi_demonstrasi',
                'label' => 'Kontribusi Demonstrasi Dosen',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 111,
                'header' => 'Kontribusi Metode Pembelajaran',
            ],

            [
                'field_name' => 'kontribusi_riset',
                'label' => 'Kontribusi Riset / Penelitian',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 112,
                'header' => 'Kontribusi Metode Pembelajaran',
            ],

            [
                'field_name' => 'kontribusi_diskusi',
                'label' => 'Kontribusi Diskusi / Seminar',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 113,
                'header' => 'Kontribusi Metode Pembelajaran',
            ],

            [
                'field_name' => 'kontribusi_praktikum',
                'label' => 'Kontribusi Praktikum',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 114,
                'header' => 'Kontribusi Metode Pembelajaran',
            ],

            [
                'field_name' => 'kontribusi_magang',
                'label' => 'Kontribusi Magang / PKL',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 115,
                'header' => 'Kontribusi Metode Pembelajaran',
            ],

            [
                'field_name' => 'kontribusi_studi_kasus',
                'label' => 'Kontribusi Studi Kasus',
                'type' => 'select',
                'options' => json_encode(['1', '2', '3', '4', '5']),
                'required' => 1,
                'step' => 2,
                'order' => 116,
                'header' => 'Kontribusi Metode Pembelajaran',
            ],

            // =====================================================
            // BAGIAN VIII
            // PROSES PENCARIAN KERJA
            // =====================================================

            [
                'field_name' => 'mulai_mencari_kerja',
                'label' => 'Kapan Mulai Mencari Kerja',
                'type' => 'select',
                'options' => json_encode([
                    'Sebelum lulus',
                    'Setelah lulus',
                    'Tidak mencari kerja'
                ]),
                'required' => 1,
                'step' => 2,
                'order' => 120,
                'header' => 'Proses Pencarian Kerja',
            ],

            [
                'field_name' => 'jumlah_lamaran',
                'label' => 'Jumlah Perusahaan yang Dilamar',
                'type' => 'select',
                'options' => json_encode([
                    'Belum pernah melamar',
                    '1-2 perusahaan',
                    '3-5 perusahaan',
                    '6-10 perusahaan',
                    '11-20 perusahaan',
                    'Lebih dari 20 perusahaan'
                ]),
                'required' => 1,
                'step' => 2,
                'order' => 121,
                'header' => 'Proses Pencarian Kerja',
            ],

            [
                'field_name' => 'jumlah_respon',
                'label' => 'Jumlah Respon Lamaran',
                'type' => 'select',
                'options' => json_encode([
                    'Tidak ada',
                    '1-2 perusahaan',
                    '3-5 perusahaan',
                    '6-10 perusahaan',
                    'Lebih dari 10 perusahaan'
                ]),
                'required' => 1,
                'step' => 2,
                'order' => 122,
                'header' => 'Proses Pencarian Kerja',
            ],

            [
                'field_name' => 'jumlah_wawancara',
                'label' => 'Jumlah Undangan Wawancara',
                'type' => 'select',
                'options' => json_encode([
                    'Tidak ada',
                    '1 perusahaan',
                    '2-3 perusahaan',
                    '4-5 perusahaan',
                    'Lebih dari 5 perusahaan'
                ]),
                'required' => 1,
                'step' => 2,
                'order' => 123,
                'header' => 'Proses Pencarian Kerja',
            ],

            [
                'field_name' => 'aktif_mencari_kerja',
                'label' => 'Status Aktif Mencari Kerja',
                'type' => 'select',
                'options' => json_encode([
                    'Ya',
                    'Tidak karena sudah bekerja',
                    'Tidak karena studi lanjut',
                    'Tidak karena alasan lain'
                ]),
                'required' => 1,
                'step' => 2,
                'order' => 124,
                'header' => 'Proses Pencarian Kerja',
            ],

            [
                'field_name' => 'alasan_pekerjaan_tidak_sesuai',
                'label' => 'Alasan Mengambil Pekerjaan Tidak Sesuai Bidang',
                'type' => 'textarea',
                'required' => 0,
                'step' => 2,
                'order' => 125,
                'header' => 'Proses Pencarian Kerja',
            ],
        ];

        foreach ($fields as $field) {

            $exists = $this->db->table($table)
                ->where('field_name', $field['field_name'])
                ->countAllResults();

            if (!$exists) {

                $this->db->table($table)->insert($field);
            }
        }

        echo "Seeder KuesionerKemendikbud selesai dijalankan.\n";
    }
}
