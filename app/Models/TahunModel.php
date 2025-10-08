<?php
// app/Models/TahunModel.php
namespace App\Models;

use CodeIgniter\Model;

class TahunModel extends Model
{
    protected $table = 'tracer_study';
    protected $allowedFields = ['tahun_pengisian'];
    protected $primaryKey = 'id';

    public function getTahunUnik()
    {
        return $this->select('tahun_pengisian')
            ->groupBy('tahun_pengisian')
            ->orderBy('tahun_pengisian', 'DESC')
            ->findAll();
    }
}
