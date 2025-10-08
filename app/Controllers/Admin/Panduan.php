<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingsModel;

class Panduan extends BaseController
{
    public function index()
    {
        $settings = new SettingsModel();
        $pdfPath = $settings->getValue('panduan_tracer');
        return view('admin/panduan_form', ['pdf' => $pdfPath]);
    }

    public function upload()
    {
        $file = $this->request->getFile('pdf_file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = 'panduan_tracer_' . time() . '.pdf';
            $file->move('uploads', $newName);

            $settings = new SettingsModel();
            $settings->setValue('panduan_tracer', 'uploads/' . $newName);

            return redirect()->back()->with('success', 'PDF berhasil diunggah.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah PDF.');
    }
}
