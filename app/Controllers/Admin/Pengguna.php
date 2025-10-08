<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class Pengguna extends BaseController
{
    public function index()
    {
        $model = new PenggunaModel();
        $data['list'] = $model->orderBy('tahun_merekrut', 'DESC')->findAll();
        return view('admin/pengguna_index', $data);
    }
}
