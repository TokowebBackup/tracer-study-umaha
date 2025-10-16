<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KuesionerFieldModel;
use Config\Database;

class KuesionerFields extends BaseController
{
    protected $fieldModel;

    public function __construct()
    {
        $this->fieldModel = new KuesionerFieldModel();
    }

    public function index()
    {
        $data['fields'] = $this->fieldModel->orderBy('step')->orderBy('order')->findAll();
        return view('admin/kuesioner_fields/index', $data);
    }

    public function create()
    {
        return view('admin/kuesioner_fields/create');
    }

    // public function store()
    // {
    //     $post = $this->request->getPost();

    //     // Validasi sederhana
    //     if (!$this->validate([
    //         'field_name' => 'required|alpha_dash|is_unique[kuesioner_fields.field_name]',
    //         'label'      => 'required',
    //         'type'       => 'required',
    //         'step'       => 'required|in_list[1,2]',
    //         'order'      => 'required|numeric',
    //     ])) {
    //         return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    //     }


    //     // Jika tipe select wajib isi options
    //     if ($post['type'] === 'select') {
    //         if (empty($post['source_table']) && empty($post['options'])) {
    //             return redirect()->back()->withInput()->with('error', 'Options wajib diisi jika Source Table kosong untuk tipe select');
    //         }

    //         if (!empty($post['options'])) {
    //             $decoded = json_decode($post['options'], true);
    //             if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
    //                 return redirect()->back()->withInput()->with('error', 'Options harus berupa JSON array yang valid');
    //             }
    //         }
    //     }

    //     $this->fieldModel->save([
    //         'field_name' => $post['field_name'],
    //         'label'      => $post['label'],
    //         'header'       => $post['header'] ?? null,
    //         'type'       => $post['type'],
    //         'options'    => $post['options'] ?? null,
    //         'required'   => isset($post['required']) ? true : false,
    //         'step'       => $post['step'],
    //         'order'      => $post['order'],
    //         'source_table' => $post['source_table'] ?? null,
    //     ]);

    //     $forge = Database::forge();

    //     // Buat nama tabel tujuan (misalnya `kuesioner_alumni`)
    //     $table = 'tracer_study';
    //     $fieldName = $post['field_name'];

    //     // Tentukan tipe kolom berdasarkan jenis input
    //     if ($post['type'] === 'select' && !empty($post['options'])) {
    //         $options = json_decode($post['options'], true);

    //         if (json_last_error() !== JSON_ERROR_NONE || !is_array($options)) {
    //             return redirect()->back()->withInput()->with('error', 'Options harus berupa JSON array yang valid');
    //         }

    //         // Escape setiap value dan buat ENUM
    //         $enumValues = implode(',', array_map(function ($opt) {
    //             return "'" . addslashes($opt) . "'";
    //         }, $options));

    //         // Gunakan raw SQL karena CI4 Database Forge belum support ENUM secara langsung
    //         $db = Database::connect();
    //         $db->query("ALTER TABLE `$table` ADD `$fieldName` ENUM($enumValues) NULL");
    //     } elseif ($post['type'] === 'number') {
    //         $forge->addColumn($table, [
    //             $fieldName => [
    //                 'type' => 'INT',
    //                 'null' => true
    //             ]
    //         ]);
    //     } else {
    //         $forge->addColumn($table, [
    //             $fieldName => [
    //                 'type' => 'TEXT',
    //                 'null' => true
    //             ]
    //         ]);
    //     }

    //     return redirect()->to('/admin/kuesionerfields')->with('success', 'Field berhasil ditambahkan');
    // }
    public function store()
    {
        $post = $this->request->getPost();

        // Validasi input
        if (!$this->validate([
            'field_name' => 'required|alpha_dash|is_unique[kuesioner_fields.field_name]',
            'label'      => 'required',
            'type'       => 'required',
            'step'       => 'required|in_list[1,2]',
            'order'      => 'required|numeric',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validasi khusus untuk tipe select
        if ($post['type'] === 'select') {
            if (empty($post['source_table']) && empty($post['options'])) {
                return redirect()->back()->withInput()->with('error', 'Options wajib diisi jika Source Table kosong untuk tipe select');
            }

            if (!empty($post['options'])) {
                $decoded = json_decode($post['options'], true);
                if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
                    return redirect()->back()->withInput()->with('error', 'Options harus berupa JSON array yang valid');
                }
            }
        }

        // Simpan field ke tabel kuesioner_fields
        $this->fieldModel->save([
            'field_name'   => $post['field_name'],
            'label'        => $post['label'],
            'header'       => $post['header'] ?? null,
            'type'         => $post['type'],
            'options'      => $post['options'] ?? null,
            'required'     => isset($post['required']) ? true : false,
            'step'         => $post['step'],
            'order'        => $post['order'],
            'source_table' => $post['source_table'] ?? null,
        ]);

        // ---------------------------------------------------------------------
        // Tambah kolom baru ke tabel tracer_study dengan posisi sesuai urutan
        // ---------------------------------------------------------------------
        $db = Database::connect();
        $forge = Database::forge();
        $table = 'tracer_study';
        $fieldName = $post['field_name'];
        $order = (int) $post['order'];

        // Ambil semua kolom dari tabel tracer_study
        $fields = $db->getFieldNames($table);

        // Tentukan tipe kolom berdasarkan jenis input
        if ($post['type'] === 'select' && !empty($post['options'])) {
            $options = json_decode($post['options'], true);
            $enumValues = implode(',', array_map(function ($opt) {
                return "'" . addslashes($opt) . "'";
            }, $options));
            $columnType = "ENUM($enumValues)";
        } elseif ($post['type'] === 'number') {
            $columnType = "INT";
        } else {
            $columnType = "TEXT";
        }

        // Tentukan posisi kolom berdasarkan 'order'
        // Misalnya: kolom baru dimasukkan setelah kolom ke-n sesuai order
        $afterColumn = null;
        $existingFields = $this->fieldModel->orderBy('order', 'ASC')->findAll();

        foreach ($existingFields as $f) {
            if ((int)$f['order'] < $order) {
                $afterColumn = $f['field_name'];
            }
        }

        // Pastikan kolom belum ada sebelumnya
        if (in_array($fieldName, $fields)) {
            return redirect()->back()->with('error', "Kolom '$fieldName' sudah ada di tabel tracer_study");
        }

        // Jalankan query untuk tambah kolom dengan posisi spesifik
        if ($afterColumn && in_array($afterColumn, $fields)) {
            $sql = "ALTER TABLE `$table` ADD `$fieldName` $columnType NULL AFTER `$afterColumn`";
        } else {
            // Jika belum ada kolom sebelumnya, taruh di akhir tabel
            $sql = "ALTER TABLE `$table` ADD `$fieldName` $columnType NULL";
        }

        $db->query($sql);

        // Pastikan kolom created_at dan updated_at ada di tabel
        $existingColumns = $db->getFieldNames($table);

        if (!in_array('created_at', $existingColumns)) {
            $db->query("ALTER TABLE `$table` ADD `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP");
        } else {
            $db->query("ALTER TABLE `$table` MODIFY `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP");
        }

        if (!in_array('updated_at', $existingColumns)) {
            // Tambah kolom updated_at kalau belum ada
            $db->query("ALTER TABLE `$table` ADD `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        } else {
            // Jika sudah ada tapi belum punya ON UPDATE, pastikan properti-nya benar
            $db->query("ALTER TABLE `$table` MODIFY `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        }

        return redirect()->to('/admin/kuesionerfields')->with('success', 'Field berhasil ditambahkan dan kolom dibuat di tabel tracer_study.');
    }

    public function edit($id)
    {
        $field = $this->fieldModel->find($id);

        if (!$field) {
            return redirect()->to('/admin/kuesionerfields')->with('error', 'Field tidak ditemukan');
        }

        $data['field'] = $field;
        return view('admin/kuesioner_fields/edit', $data);
    }

    public function update($id)
    {
        $post = $this->request->getPost();
        $field = $this->fieldModel->find($id);

        if (!$field) {
            return redirect()->to('/admin/kuesionerfields')->with('error', 'Field tidak ditemukan');
        }

        // Validasi input
        if (!$this->validate([
            'label' => 'required',
            'type'  => 'required',
            'step'  => 'required|in_list[1,2]',
            'order' => 'required|numeric',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data di tabel kuesioner_fields
        $this->fieldModel->update($id, [
            'label'        => $post['label'],
            'header'       => $post['header'] ?? null,
            'type'         => $post['type'],
            'options'      => $post['options'] ?? null,
            'required'     => isset($post['required']),
            'step'         => $post['step'],
            'order'        => $post['order'],
            'source_table' => $post['source_table'] ?? null,
        ]);

        // Koneksi DB
        $db = Database::connect();
        $table = 'tracer_study';
        $fieldName = $field['field_name'];
        $order = (int)$post['order'];

        // Ambil semua kolom tabel
        $columns = $db->getFieldNames($table);

        // Tentukan tipe kolom baru
        if ($post['type'] === 'select' && !empty($post['options'])) {
            $options = json_decode($post['options'], true);
            $enumValues = implode(',', array_map(fn($opt) => "'" . addslashes($opt) . "'", $options));
            $columnType = "ENUM($enumValues)";
        } elseif ($post['type'] === 'number') {
            $columnType = "INT";
        } else {
            $columnType = "TEXT";
        }

        // Cari kolom sebelumnya berdasarkan urutan (order)
        $afterColumn = null;
        $existingFields = $this->fieldModel->orderBy('order', 'ASC')->findAll();

        foreach ($existingFields as $f) {
            if ((int)$f['order'] < $order) {
                $afterColumn = $f['field_name'];
            }
        }

        // Jika kolom belum ada → tambahkan
        if (!in_array($fieldName, $columns)) {
            if ($afterColumn && in_array($afterColumn, $columns)) {
                $sql = "ALTER TABLE `$table` ADD `$fieldName` $columnType NULL AFTER `$afterColumn`";
            } else {
                $sql = "ALTER TABLE `$table` ADD `$fieldName` $columnType NULL";
            }
            $db->query($sql);
        } else {
            // Kalau sudah ada → ubah tipe dan pindahkan posisi kolom
            if ($afterColumn && in_array($afterColumn, $columns)) {
                $sql = "ALTER TABLE `$table` MODIFY `$fieldName` $columnType NULL AFTER `$afterColumn`";
            } else {
                $sql = "ALTER TABLE `$table` MODIFY `$fieldName` $columnType NULL";
            }
            $db->query($sql);
        }

        // Pastikan kolom created_at dan updated_at ada di tabel
        $existingColumns = $db->getFieldNames($table);

        if (!in_array('created_at', $existingColumns)) {
            $db->query("ALTER TABLE `$table` ADD `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP");
        } else {
            $db->query("ALTER TABLE `$table` MODIFY `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP");
        }

        if (!in_array('updated_at', $existingColumns)) {
            // Tambah kolom updated_at kalau belum ada
            $db->query("ALTER TABLE `$table` ADD `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        } else {
            // Jika sudah ada tapi belum punya ON UPDATE, pastikan properti-nya benar
            $db->query("ALTER TABLE `$table` MODIFY `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        }

        return redirect()->to('/admin/kuesionerfields')->with('success', 'Field berhasil diperbarui dan posisi kolom di tabel tracer_study disesuaikan.');
    }

    public function delete($id)
    {
        $field = $this->fieldModel->find($id);

        if (!$field) {
            return redirect()->to('/admin/kuesionerfields')->with('error', 'Field tidak ditemukan');
        }

        $table = 'tracer_study';
        $db = Database::connect();

        // Drop kolom dari tabel tracer_study
        try {
            $db->query("ALTER TABLE `$table` DROP COLUMN `{$field['field_name']}`");
        } catch (\Throwable $e) {
            // Kalau gagal drop kolom (misal sudah dihapus manual)
        }

        // Hapus field dari tabel kuesioner_fields
        $this->fieldModel->delete($id);

        return redirect()->to('/admin/kuesionerfields')->with('success', 'Field dan kolom di tabel tracer_study berhasil dihapus.');
    }


    // Tambah fungsi edit, update, delete sesuai kebutuhan
}
