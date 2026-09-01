<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FinalisasiTracerKemendikbud extends Migration
{
    public function up()
    {
        // =====================================================
        // TABLE: tracer_study
        // =====================================================

        $fields = [

            // =================================================
            // BAGIAN VI
            // KEBUTUHAN KOMPETENSI DI TEMPAT KERJA
            // =================================================

            'kebutuhan_etika' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            'kebutuhan_keahlian_bidang_ilmu' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            'kebutuhan_bahasa_inggris' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            'kebutuhan_teknologi_informasi' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            'kebutuhan_komunikasi' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            'kebutuhan_kerjasama' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            'kebutuhan_pengembangan_diri' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            // =================================================
            // BAGIAN VII
            // METODE PEMBELAJARAN
            // =================================================

            'kontribusi_perkuliahan' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            'kontribusi_demonstrasi' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            'kontribusi_riset' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            'kontribusi_diskusi' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            'kontribusi_praktikum' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            'kontribusi_magang' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            'kontribusi_studi_kasus' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],

            // =================================================
            // BAGIAN VIII
            // PROSES PENCARIAN KERJA
            // =================================================

            'mulai_mencari_kerja' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],

            'jumlah_lamaran' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],

            'jumlah_respon' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],

            'jumlah_wawancara' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],

            'aktif_mencari_kerja' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],

            'alasan_pekerjaan_tidak_sesuai' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ];

        // Tambah field satu per satu jika belum ada
        foreach ($fields as $fieldName => $fieldConfig) {

            if (!$this->db->fieldExists($fieldName, 'tracer_study')) {

                $this->forge->addColumn('tracer_study', [
                    $fieldName => $fieldConfig
                ]);
            }
        }

        // =====================================================
        // TABLE: pengguna_lulusan
        // =====================================================

        $penggunaFields = [

            'nama_pegawai_dinilai' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'asal_program_studi_pegawai' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'tahun_lulus_pegawai' => [
                'type' => 'YEAR',
                'null' => true,
            ],

            'harapan_lulusan_umaha' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ];

        foreach ($penggunaFields as $fieldName => $fieldConfig) {

            if (!$this->db->fieldExists($fieldName, 'pengguna_lulusan')) {

                $this->forge->addColumn('pengguna_lulusan', [
                    $fieldName => $fieldConfig
                ]);
            }
        }
    }

    public function down()
    {
        $tracerFields = [

            'kebutuhan_etika',
            'kebutuhan_keahlian_bidang_ilmu',
            'kebutuhan_bahasa_inggris',
            'kebutuhan_teknologi_informasi',
            'kebutuhan_komunikasi',
            'kebutuhan_kerjasama',
            'kebutuhan_pengembangan_diri',

            'kontribusi_perkuliahan',
            'kontribusi_demonstrasi',
            'kontribusi_riset',
            'kontribusi_diskusi',
            'kontribusi_praktikum',
            'kontribusi_magang',
            'kontribusi_studi_kasus',

            'mulai_mencari_kerja',
            'jumlah_lamaran',
            'jumlah_respon',
            'jumlah_wawancara',
            'aktif_mencari_kerja',
            'alasan_pekerjaan_tidak_sesuai',
        ];

        foreach ($tracerFields as $field) {

            if ($this->db->fieldExists($field, 'tracer_study')) {

                $this->forge->dropColumn('tracer_study', $field);
            }
        }

        $penggunaFields = [

            'nama_pegawai_dinilai',
            'asal_program_studi_pegawai',
            'tahun_lulus_pegawai',
            'harapan_lulusan_umaha',
        ];

        foreach ($penggunaFields as $field) {

            if ($this->db->fieldExists($field, 'pengguna_lulusan')) {

                $this->forge->dropColumn('pengguna_lulusan', $field);
            }
        }
    }
}
