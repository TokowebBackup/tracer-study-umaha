<?php

namespace App\Controllers\Alumni;

use App\Controllers\BaseController;
use App\Models\TracerModel;
use App\Models\AlumniModel;
use Config\Database;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        $email = $session->get('email');

        $alumniModel = new AlumniModel();
        $tracerModel = new TracerModel();

        // =========================
        // DATA ALUMNI
        // =========================

        $alumni = $alumniModel
            ->select('alumni.*, prodi.nama_prodi, prodi.jenjang')
            ->join('prodi', 'prodi.kode_prodi = alumni.program_studi', 'left')
            ->where('alumni.email', $email)
            ->first();

        if (!$alumni) {

            return redirect()
                ->to('/')
                ->with('error', 'Data alumni tidak ditemukan.');
        }

        // =========================
        // DATA TRACER
        // =========================

        $tracer = $tracerModel
            ->where('alumni_id', $alumni['id'])
            ->first();

        // =========================
        // FIELD DINAMIS
        // =========================

        $fieldModel = new \App\Models\KuesionerFieldModel();

        $kuesionerFields = $fieldModel
            ->orderBy('step', 'ASC')
            ->orderBy('order', 'ASC')
            ->findAll();

        // =========================
        // GROUP BY HEADER
        // =========================

        $groupedFields = [];

        foreach ($kuesionerFields as $field) {

            $header = $field['header'] ?: 'Informasi Lain';

            $groupedFields[$header][] = $field;
        }

        // =========================
        // REQUEST PENGGUNA
        // =========================

        $requestModel = new \App\Models\PenggunaRequestModel();

        $penggunaRequest = $requestModel
            ->where('alumni_id', $alumni['id'])
            ->orderBy('created_at', 'DESC')
            ->first();

        // =========================
        // RETURN VIEW
        // =========================

        return view('alumni/dashboard', [
            'alumni'          => $alumni,
            'tracer'          => $tracer,
            'groupedFields'   => $groupedFields,
            'penggunaRequest' => $penggunaRequest,
        ]);
    }
}
