<?php

namespace App\Models;

use CodeIgniter\Model;

class PeriodeModel extends Model
{
    protected $table = 'periode_tracer';
    protected $allowedFields = ['tahun', 'lulusan_tahun', 'tanggal_mulai', 'tanggal_selesai', 'file_surat'];
}
