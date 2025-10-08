<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LandingModel;

class Landing extends BaseController
{
    protected $landingModel;

    public function __construct()
    {
        $this->landingModel = new LandingModel();
    }

    public function index()
    {
        $data['landing'] = $this->landingModel->findAll();
        return view('admin/landing/index', $data);
    }

    public function edit($id)
    {
        $data['item'] = $this->landingModel->find($id);
        return view('admin/landing/edit', $data);
    }

    public function add()
    {
        $data = $this->request->getPost();
        $file = $this->request->getFile('gambar');

        if ($file && $file->isValid()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/landing/', $fileName);
            $data['gambar'] = 'uploads/landing/' . $fileName;
        }

        $this->landingModel->save($data);
        return redirect()->to(base_url('admin/landing'))->with('success', 'Konten berhasil ditambahkan.');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $data = $this->request->getPost();
        $file = $this->request->getFile('gambar');

        if ($file && $file->isValid()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/landing/', $fileName);
            $data['gambar'] = 'uploads/landing/' . $fileName;
        } else {
            unset($data['gambar']);
        }

        $this->landingModel->update($id, $data);
        return redirect()->to(base_url('admin/landing'))->with('success', 'Konten berhasil diperbarui.');
    }
}
