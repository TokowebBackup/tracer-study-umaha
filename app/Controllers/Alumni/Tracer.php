<?php

namespace App\Controllers\Alumni;

use App\Controllers\BaseController;
use App\Models\LandingModel;
use App\Models\TracerModel;
use App\Models\KuesionerFieldModel;

class Tracer extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function edit()
    {
        $landing = new LandingModel();
        $tracerModel = new TracerModel();

        $alumniId = session()->get('alumni_id');
        $data['landing'] = [
            'title'       => $landing->getValue('judul')      ?? 'Tracer Study UMAHA',
            'subtitle'    => $landing->getValue('subjudul')   ?? 'Jembatan antara kampus ...',
            'description' => $landing->getValue('konten') ??
                'Dukung pengembangan kurikulum ...'
        ];
        $data['social_links'] = $landing->getSocialLinks();

        // Ambil data alumni + prodi
        $builder = $this->db->table('alumni');
        $builder->select('alumni.*, prodi.nama_prodi, prodi.jenjang');
        $builder->join('prodi', 'prodi.kode_prodi = alumni.program_studi', 'left');
        $builder->where('alumni.id', $alumniId);
        $data['alumni'] = $builder->get()->getRowArray();

        // Ambil data tracer sebelumnya
        $data['tracer'] = $tracerModel->where('alumni_id', $alumniId)->first();

        // Ambil field dinamis
        $fieldModel = new KuesionerFieldModel();
        $data['fields_step1'] = $fieldModel->where('step', 1)->orderBy('order')->findAll();
        $data['fields_step2'] = $fieldModel->where('step', 2)->orderBy('order')->findAll();

        // Ambil opsi dropdown (seperti KuesionerAlumni)
        $sourceTables = [];
        foreach (array_merge($data['fields_step1'], $data['fields_step2']) as $field) {
            if (!empty($field['source_table'])) {
                $sourceTables[$field['source_table']] = true;
            }
        }

        $select_options = [];
        foreach (array_keys($sourceTables) as $table) {
            if ($table === 'prodi') {
                $rows = $this->db->table('prodi')->select('kode_prodi, nama_prodi')->get()->getResultArray();
                $select_options[$table] = array_map(fn($r) => [
                    'value' => $r['kode_prodi'],
                    'label' => $r['nama_prodi'],
                ], $rows);
            } else {
                $select_options[$table] = $this->db->table($table)->get()->getResultArray();
            }
        }

        $data['select_options'] = $select_options;

        if ($data['tracer']) {
            foreach ($data['tracer'] as $key => $val) {
                if (is_string($val)) {
                    $data['tracer'][$key] = trim($val);
                }
            }
        }


        return view('alumni/tracer_edit', $data);
    }

    public function update($id = null)
    {
        $post = $this->request->getPost();
        $alumniId = session()->get('alumni_id');

        $tracerModel = new TracerModel();
        $allowedFields = $tracerModel->allowedFields;

        // Tambahkan alumni_id ke data
        $post['alumni_id'] = $alumniId;

        // Filter input agar sesuai kolom tabel
        $dataToSave = array_intersect_key($post, array_flip($allowedFields));

        // Cek apakah data tracer sudah ada
        $existing = $tracerModel->where('alumni_id', $alumniId)->first();

        if ($existing) {
            // Update berdasarkan alumni_id
            $tracerModel->where('alumni_id', $alumniId)->set($dataToSave)->update();
        } else {
            // Insert baru kalau belum ada
            $tracerModel->insert($dataToSave);
        }

        return redirect()->to('/alumni/dashboard')->with('success', 'Data tracer berhasil diperbarui.');
    }
}
