<?php

namespace App\Controllers\Admin;

use Dompdf\Dompdf;

use App\Controllers\BaseController;
use App\Models\AlumniModel;

class Alumni extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $builder = $this->db->table('alumni');
        $builder->select('alumni.*, prodi.nama_prodi');
        $builder->join('prodi', 'prodi.kode_prodi = alumni.program_studi', 'left');
        $builder->orderBy('alumni.tahun_lulus', 'DESC');

        $data['list'] = $builder->get()->getResultArray();

        return view('admin/alumni_index', $data);
    }

    public function add()
    {
        return view('admin/alumni_add');
    }

    public function save()
    {
        $model = new \App\Models\AlumniModel();
        $data = $this->request->getPost();

        if (!$this->validate([
            'nim' => 'required',
            'nama' => 'required',
            'program_studi' => 'required',
            'tahun_lulus' => 'required|numeric',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal.');
        }

        $model->save($data);
        return redirect()->to('/admin/alumni')->with('success', 'Data alumni ditambahkan.');
    }

    public function edit($id)
    {
        $alumniModel = new \App\Models\AlumniModel();
        $prodiModel = new \App\Models\ProdiModel();

        $data['alumni'] = $alumniModel->find($id);
        $data['prodi_list'] = $prodiModel->orderBy('nama_prodi')->findAll();

        return view('admin/alumni_edit', $data);
    }

    public function update($id)
    {
        $alumniModel = new \App\Models\AlumniModel();

        $data = $this->request->getPost();
        if (!$this->validate([
            'nim' => 'required',
            'nama' => 'required',
            'program_studi' => 'required',
            'tahun_lulus' => 'required|numeric',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal.');
        }

        $alumniModel->update($id, $data);
        return redirect()->to('/admin/alumni')->with('success', 'Data alumni diperbarui.');
    }

    public function detail($id)
    {
        $builder = $this->db->table('alumni');
        $builder->select('alumni.*, prodi.nama_prodi, prodi.jenjang');
        $builder->join('prodi', 'prodi.kode_prodi = alumni.program_studi', 'left');
        $builder->where('alumni.id', $id);
        $data['alumni'] = $builder->get()->getRowArray();

        return view('admin/alumni_detail', $data);
    }

    public function delete($id)
    {
        $model = new \App\Models\AlumniModel();
        $model->delete($id);
        return redirect()->to('/admin/alumni')->with('success', 'Data berhasil dihapus');
    }

    public function cetak()
    {
        $model = new \App\Models\AlumniModel();
        $data['list'] = $model->findAll();

        $html = view('admin/cetak_alumni', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("data_alumni.pdf", ["Attachment" => false]);
        exit;
    }
}
