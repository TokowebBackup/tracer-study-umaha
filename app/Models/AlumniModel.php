<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumniModel extends Model
{
    protected $table = 'alumni';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nim',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'program_studi',
        'jenjang',
        'tahun_masuk',
        'tahun_lulus',
        'email',
        'no_hp',
        'password',
        'provinsi',
        'kota'
    ];
}
