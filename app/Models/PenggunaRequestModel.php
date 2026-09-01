<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaRequestModel extends Model
{
    protected $table = 'pengguna_request';

    protected $primaryKey = 'id';

    protected $allowedFields = [

        'alumni_id',

        'nama_perusahaan',
        'alamat_perusahaan',

        'email_hrd',

        'nama_penilai',
        'jabatan_penilai',
        'no_telp_penilai',

        'token',

        'is_sent',
        'sent_at',

        'is_submitted',

        'submitted_at',

        'expired_at',
    ];

    protected $useTimestamps = true;
}
