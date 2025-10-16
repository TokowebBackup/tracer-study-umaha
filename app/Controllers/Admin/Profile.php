<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Profile extends BaseController
{
    public function index()
    {
        $session = session();
        $username = $session->get('username');

        $adminModel = new AdminModel();

        if ($username) {
            $admin = $adminModel->where('username', $username)->first();
        } else {
            // fallback kalau belum login atau session kosong
            $admin = $adminModel->first();
        }

        if (!$admin) {
            return redirect()->to('/')->with('error', 'Data admin tidak ditemukan.');
        }

        return view('admin/profile', ['admin' => $admin]);
    }


    public function update()
    {
        $adminModel = new AdminModel();

        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama_admin');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = [
            'nama_admin' => $nama,
            'email' => $email,
        ];

        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        $adminModel->update($id, $data);

        return redirect()->to(base_url('admin/profile'))->with('success', 'Profil admin berhasil diperbarui!');
    }
}
