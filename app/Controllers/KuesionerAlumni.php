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

        // Validasi sederhana (lu bisa tambah custom lagi)
        if (!$this->validate([
            'tahun_pengisian' => 'required|numeric'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Isian wajib belum lengkap.');
        }

        $alumniId = session()->get('alumni_id');

        // Update data alumni tetap jalan
        $alumniModel = new \App\Models\AlumniModel();
        $alumniModel->update($alumniId, [
            'nim' => $post['nim'],
            'nama' => $post['nama'],
            'program_studi' => $post['program_studi'] ?? null,
            'tahun_lulus' => $post['tahun_lulus'] ?? null,
        ]);

        // Ambil allowed fields dari model
        $tracerModel = new TracerModel();
        $allowedFields = $tracerModel->allowedFields;

        // Tambahkan alumni_id ke post supaya ikut keinsert
        $post['alumni_id'] = $alumniId;

        // Filter input yang sesuai allowedFields
        // $dataToSave = array_intersect_key($post, array_flip($allowedFields));

        // Simpan ke database
        $tracerModel->insert($post);

        return redirect()->to('/')->with('success', 'Data tracer berhasil disimpan.');
    }
}
