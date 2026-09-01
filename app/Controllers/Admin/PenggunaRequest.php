<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenggunaRequestModel;

class PenggunaRequest extends BaseController
{
    public function index()
    {
        $requestModel = new PenggunaRequestModel();

        $requests = $requestModel
            ->select('
                pengguna_request.*,
                alumni.nama,
                alumni.nim,
                prodi.nama_prodi
            ')
            ->join(
                'alumni',
                'alumni.id = pengguna_request.alumni_id',
                'left'
            )
            ->join(
                'prodi',
                'prodi.kode_prodi = alumni.program_studi',
                'left'
            )
            ->orderBy(
                'pengguna_request.created_at',
                'DESC'
            )
            ->findAll();

        return view(
            'admin/pengguna_request/index',
            [
                'requests' => $requests
            ]
        );
    }
}
