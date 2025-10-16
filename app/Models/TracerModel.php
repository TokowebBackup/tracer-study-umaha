<?php

namespace App\Models;

use CodeIgniter\Model;

class TracerModel extends Model
{
    protected $table = 'tracer_study';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $protectFields = false;

    public function __construct()
    {
        parent::__construct();

        // Ambil semua kolom dari tabel secara otomatis
        $fields = $this->db->getFieldNames($this->table);

        // Hilangkan kolom yang tidak boleh diubah secara manual
        $this->allowedFields = array_diff($fields, ['id', 'created_at', 'updated_at']);
    }
}
