<?php

namespace App\Controllers;

use App\Controllers\Alumni\Tracer;
use App\Models\LandingModel;
use  App\Models\TracerModel;

class KuesionerAlumni extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $landing      = new LandingModel();


        $id = session()->get('alumni_id');
        $data['landing'] = [
            'title'       => $landing->getValue('judul')      ?? 'Tracer Study UMAHA',
            'subtitle'    => $landing->getValue('subjudul')   ?? 'Jembatan antara kampus ...',
            'description' => $landing->getValue('konten') ??
                'Dukung pengembangan kurikulum ...'
        ];

        // -------- social links ----------
        $data['social_links'] = $landing->getSocialLinks();
        $builder = $this->db->table('alumni');
        $builder->select('alumni.*, prodi.nama_prodi, prodi.jenjang');
        $builder->join('prodi', 'prodi.kode_prodi = alumni.program_studi', 'left');
        $builder->where('alumni.id', $id);
        $data['alumni'] = $builder->get()->getRowArray();

        $data['prodi_list'] = $this->db->table('prodi')->get()->getResultArray();

        $fieldModel = new \App\Models\KuesionerFieldModel();
        $fields_step1 = $fieldModel->where('step', 1)->orderBy('order')->findAll();
        $fields_step2 = $fieldModel->where('step', 2)->orderBy('order')->findAll();

        // Ambil semua source_table unik dari fields_step1 dan fields_step2
        $sourceTables = [];
        foreach (array_merge($fields_step1, $fields_step2) as $field) {
            if (!empty($field['source_table'])) {
                $sourceTables[$field['source_table']] = true;
            }
        }

        // Ambil data opsi untuk tiap source_table
        $select_options = [];
        foreach (array_keys($sourceTables) as $table) {
            if ($table === 'prodi') {
                // Khusus prodi, ambil kode_prodi sebagai value dan nama_prodi sebagai label
                $rows = $this->db->table('prodi')->select('kode_prodi, nama_prodi')->get()->getResultArray();
                $select_options[$table] = array_map(function ($row) {
                    return [
                        'value' => $row['kode_prodi'],
                        'label' => $row['nama_prodi'],
                    ];
                }, $rows);
            } else {
                // Table lain ambil semua data apa adanya
                $select_options[$table] = $this->db->table($table)->get()->getResultArray();
            }
        }

        $data['fields_step1'] = $fields_step1;
        $data['fields_step2'] = $fields_step2;
        $data['select_options'] = $select_options;

        return view('kuesioner_alumni', $data);
    }

    public function simpan()
    {
        $post = $this->request->getPost();

        // =========================
        // VALIDATION RULES
        // =========================

        $rules = [
            'tahun_pengisian' => 'required|numeric',
            'nim'             => 'required',
            'nama'            => 'required',
            'program_studi'   => 'required',
            'tahun_lulus'     => 'required',
            'email'           => 'required|valid_email',
        ];

        // =========================
        // CONDITIONAL VALIDATION
        // =========================

        if (($post['status_pekerjaan'] ?? '') === 'Studi Lanjut') {

            $rules['sumber_biaya_studi_lanjut'] = 'required';
            $rules['perguruan_tinggi_studi_lanjut'] = 'required';
            $rules['program_studi_lanjut'] = 'required';
        }

        if (($post['status_pekerjaan'] ?? '') === 'Wirausaha') {

            $rules['nama_usaha'] = 'required';
            $rules['skala_usaha'] = 'required';
            $rules['pendapatan_usaha'] = 'required|numeric';
        }

        // =========================
        // VALIDATE
        // =========================

        if (!$this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', validation_list_errors());
        }

        $alumniId = session()->get('alumni_id');

        // =========================
        // UPDATE DATA ALUMNI
        // =========================

        $alumniModel = new \App\Models\AlumniModel();

        $alumniModel->update($alumniId, [

            'nim'             => $post['nim'],
            'nama'            => $post['nama'],
            'program_studi'   => $post['program_studi'] ?? null,
            'tahun_lulus'     => $post['tahun_lulus'] ?? null,
            'email'           => $post['email'] ?? null,
            'nik'             => $post['nik'] ?? null,
            'npwp'            => $post['npwp'] ?? null,
        ]);

        // =========================
        // SIMPAN TRACER
        // =========================

        $tracerModel = new TracerModel();

        // tambahkan alumni_id
        $post['alumni_id'] = $alumniId;

        // ambil field tabel tracer_study
        $allowedFields = $tracerModel->allowedFields;

        // filter hanya field yang ada di tabel
        $dataInsert = array_intersect_key(
            $post,
            array_flip($allowedFields)
        );

        // insert
        $tracerModel->insert($dataInsert);

        return redirect()
            ->to('/')
            ->with('success', 'Data tracer berhasil disimpan.');
    }
}
