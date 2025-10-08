<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function login()
    {
        return view('admin/login');
    }

    public function doLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $db = db_connect();
        $admin = $db->table('admin')->where('username', $username)->get()->getRow();

        if ($admin && password_verify($password, $admin->password)) {
            session()->set([
                'admin_id' => $admin->id,
                'admin_nama' => $admin->nama_admin,
                'is_admin' => true
            ]);
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->back()->with('error', 'Username atau Password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin');
    }
}
