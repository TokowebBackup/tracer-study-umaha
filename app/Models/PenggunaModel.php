<?php
// app/Models/PenggunaModel.php
namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'pengguna_lulusan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_perusahaan',
        'alamat_perusahaan',
        'nama_pengisi',
        'jabatan_pengisi',
        'email_pengisi',
        'no_telp_pengisi',
        'tahun_merekrut',
        'jumlah_lulusan_direkrut',
        'etika_kerja',
        'keahlian_profesional',
        'penguasaan_bahasa_asing',
        'teknologi_informasi',
        'komunikasi',
        'kerjasama',
        'pengembangan_diri',
        'saran_umum'
    ];
}
