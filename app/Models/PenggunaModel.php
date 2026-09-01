<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'pengguna_lulusan';

    protected $primaryKey = 'id';

    protected $allowedFields = [

        // =================================================
        // IDENTITAS PENGGUNA LULUSAN
        // =================================================

        'nama_perusahaan',
        'alamat_perusahaan',

        'nama_pengisi',
        'jabatan_pengisi',

        'email_pengisi',
        'no_telp_pengisi',

        'tahun_merekrut',
        'jumlah_lulusan_direkrut',

        // =================================================
        // DATA PEGAWAI / ALUMNI DINILAI
        // =================================================

        'nama_pegawai_dinilai',
        'asal_program_studi_pegawai',
        'tahun_lulus_pegawai',

        // =================================================
        // PENILAIAN KOMPETENSI
        // =================================================

        'etika_kerja',
        'keahlian_profesional',
        'penguasaan_bahasa_asing',
        'teknologi_informasi',
        'komunikasi',
        'kerjasama',
        'pengembangan_diri',

        // =================================================
        // SARAN & HARAPAN
        // =================================================

        'harapan_lulusan_umaha',
        'saran_umum',

        'alumni_id',
        'request_id',
    ];
}
