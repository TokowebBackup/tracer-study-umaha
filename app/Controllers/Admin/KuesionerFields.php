<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KuesionerFieldModel;
use Config\Database;

class KuesionerFields extends BaseController
{
    protected $fieldModel;

    protected array $protectedFields = [
        'nim',
        'nama',
        'program_studi',
        'tahun_lulus',
        'email',
        'status_pekerjaan'
    ];

    public function __construct()
    {
        $this->fieldModel = new KuesionerFieldModel();
    }

    public function index()
    {
        $data['fields'] = $this->fieldModel
            ->orderBy('step')
            ->orderBy('order')
            ->findAll();

        $data['protectedFields'] = $this->protectedFields;

        return view('admin/kuesioner_fields/index', $data);
    }

    public function create()
    {
        return view('admin/kuesioner_fields/create');
    }

    public function store()
    {
        $post = $this->request->getPost();

        // =========================================================
        // VALIDASI
        // =========================================================
        if (!$this->validate([
            'field_name' => 'required|alpha_dash|is_unique[kuesioner_fields.field_name]',
            'label'      => 'required',
            'type'       => 'required',
            'step'       => 'required|in_list[1,2]',
            'order'      => 'required|numeric',
        ])) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // =========================================================
        // VALIDASI KHUSUS SELECT
        // =========================================================
        if ($post['type'] === 'select') {

            if (
                empty($post['source_table']) &&
                empty($post['options'])
            ) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Options wajib diisi jika Source Table kosong untuk tipe select'
                    );
            }

            if (!empty($post['options'])) {

                $decoded = json_decode($post['options'], true);

                if (
                    json_last_error() !== JSON_ERROR_NONE ||
                    !is_array($decoded)
                ) {

                    return redirect()
                        ->back()
                        ->withInput()
                        ->with(
                            'error',
                            'Options harus berupa JSON array yang valid'
                        );
                }
            }
        }

        // =========================================================
        // DATABASE
        // =========================================================
        $db = Database::connect();

        $db->transStart();

        try {

            // =====================================================
            // SIMPAN FIELD
            // =====================================================
            $this->fieldModel->save([
                'field_name'       => $post['field_name'],
                'label'            => $post['label'],
                'header'           => $post['header'] ?? null,
                'type'             => $post['type'],
                'options'          => $post['options'] ?? null,
                'required'         => isset($post['required']) ? 1 : 0,
                'step'             => $post['step'],
                'order'            => $post['order'],
                'source_table'     => $post['source_table'] ?? null,
                'conditional_field' => $post['conditional_field'] ?? null,
                'conditional_value' => $post['conditional_value'] ?? null
            ]);

            // =====================================================
            // SETUP TABLE
            // =====================================================
            $table = 'tracer_study';

            $fieldName = preg_replace(
                '/[^a-zA-Z0-9_]/',
                '',
                $post['field_name']
            );

            $order = (int) $post['order'];

            $fields = $db->getFieldNames($table);

            // =====================================================
            // TIPE KOLOM
            // =====================================================
            if ($post['type'] === 'number') {

                $columnType = "INT";
            } else {

                $columnType = "TEXT";
            }

            // =====================================================
            // CARI POSISI KOLOM
            // =====================================================
            $afterColumn = null;

            $existingFields = $this->fieldModel
                ->orderBy('order', 'ASC')
                ->findAll();

            foreach ($existingFields as $f) {

                if ((int)$f['order'] < $order) {

                    $afterColumn = $f['field_name'];
                }
            }

            // =====================================================
            // PASTIKAN KOLOM BELUM ADA
            // =====================================================
            if (in_array($fieldName, $fields)) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        "Kolom '$fieldName' sudah ada di tabel tracer_study"
                    );
            }

            // =====================================================
            // QUERY ALTER TABLE
            // =====================================================
            if (
                $afterColumn &&
                in_array($afterColumn, $fields)
            ) {

                $sql = "
                    ALTER TABLE `$table`
                    ADD `$fieldName` $columnType NULL
                    AFTER `$afterColumn`
                ";
            } else {

                $sql = "
                    ALTER TABLE `$table`
                    ADD `$fieldName` $columnType NULL
                ";
            }

            $db->query($sql);

            // =====================================================
            // TRANSACTION COMPLETE
            // =====================================================
            $db->transComplete();

            if ($db->transStatus() === false) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Transaksi database gagal.'
                    );
            }
        } catch (\Throwable $e) {

            log_message('error', $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal menambahkan field.'
                );
        }

        return redirect()
            ->to('/admin/kuesionerfields')
            ->with(
                'success',
                'Field berhasil ditambahkan.'
            );
    }

    public function edit($id)
    {
        $field = $this->fieldModel->find($id);

        if (!$field) {

            return redirect()
                ->to('/admin/kuesionerfields')
                ->with(
                    'error',
                    'Field tidak ditemukan'
                );
        }

        return view(
            'admin/kuesioner_fields/edit',
            [
                'field' => $field
            ]
        );
    }

    public function update($id)
    {
        $post = $this->request->getPost();

        $field = $this->fieldModel->find($id);

        if (!$field) {

            return redirect()
                ->to('/admin/kuesionerfields')
                ->with(
                    'error',
                    'Field tidak ditemukan'
                );
        }

        // =========================================================
        // VALIDASI
        // =========================================================
        if (!$this->validate([
            'label' => 'required',
            'type'  => 'required',
            'step'  => 'required|in_list[1,2]',
            'order' => 'required|numeric',
        ])) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }

        $db = Database::connect();

        $db->transStart();

        try {

            // =====================================================
            // UPDATE FIELD
            // =====================================================
            $this->fieldModel->update($id, [
                'label'             => $post['label'],
                'header'            => $post['header'] ?? null,
                'type'              => $post['type'],
                'options'           => $post['options'] ?? null,
                'required'          => isset($post['required']) ? 1 : 0,
                'step'              => $post['step'],
                'order'             => $post['order'],
                'source_table'      => $post['source_table'] ?? null,
                'conditional_field' => $post['conditional_field'] ?? null,
                'conditional_value' => $post['conditional_value'] ?? null,
            ]);

            // =====================================================
            // TABLE
            // =====================================================
            $table = 'tracer_study';

            $fieldName = preg_replace(
                '/[^a-zA-Z0-9_]/',
                '',
                $field['field_name']
            );

            $order = (int)$post['order'];

            $columns = $db->getFieldNames($table);

            // =====================================================
            // TIPE KOLOM
            // =====================================================
            if ($post['type'] === 'number') {

                $columnType = "INT";
            } else {

                $columnType = "TEXT";
            }

            // =====================================================
            // POSISI KOLOM
            // =====================================================
            $afterColumn = null;

            $existingFields = $this->fieldModel
                ->orderBy('order', 'ASC')
                ->findAll();

            foreach ($existingFields as $f) {

                if ((int)$f['order'] < $order) {

                    $afterColumn = $f['field_name'];
                }
            }

            // =====================================================
            // ALTER TABLE
            // =====================================================
            if (!in_array($fieldName, $columns)) {

                if (
                    $afterColumn &&
                    in_array($afterColumn, $columns)
                ) {

                    $sql = "
                        ALTER TABLE `$table`
                        ADD `$fieldName` $columnType NULL
                        AFTER `$afterColumn`
                    ";
                } else {

                    $sql = "
                        ALTER TABLE `$table`
                        ADD `$fieldName` $columnType NULL
                    ";
                }
            } else {

                if (
                    $afterColumn &&
                    in_array($afterColumn, $columns)
                ) {

                    $sql = "
                        ALTER TABLE `$table`
                        MODIFY `$fieldName` $columnType NULL
                        AFTER `$afterColumn`
                    ";
                } else {

                    $sql = "
                        ALTER TABLE `$table`
                        MODIFY `$fieldName` $columnType NULL
                    ";
                }
            }

            $db->query($sql);

            // =====================================================
            // TRANSACTION COMPLETE
            // =====================================================
            $db->transComplete();

            if ($db->transStatus() === false) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Transaksi database gagal.'
                    );
            }
        } catch (\Throwable $e) {

            log_message('error', $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal memperbarui field.'
                );
        }

        return redirect()
            ->to('/admin/kuesionerfields')
            ->with(
                'success',
                'Field berhasil diperbarui.'
            );
    }

    public function delete($id)
    {
        $field = $this->fieldModel->find($id);

        if (!$field) {

            return redirect()
                ->to('/admin/kuesionerfields')
                ->with(
                    'error',
                    'Field tidak ditemukan'
                );
        }

        // =========================================================
        // PROTECTED FIELD
        // =========================================================
        if (
            in_array(
                $field['field_name'],
                $this->protectedFields
            )
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Field inti sistem tidak boleh dihapus.'
                );
        }

        $db = Database::connect();

        $db->transStart();

        try {

            $table = 'tracer_study';

            $fieldName = preg_replace(
                '/[^a-zA-Z0-9_]/',
                '',
                $field['field_name']
            );

            // =====================================================
            // DROP COLUMN
            // =====================================================
            $db->query("
                ALTER TABLE `$table`
                DROP COLUMN `$fieldName`
            ");

            // =====================================================
            // DELETE FIELD
            // =====================================================
            $this->fieldModel->delete($id);

            $db->transComplete();

            if ($db->transStatus() === false) {

                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'Gagal menghapus field.'
                    );
            }
        } catch (\Throwable $e) {

            log_message('error', $e->getMessage());

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Terjadi kesalahan saat menghapus field.'
                );
        }

        return redirect()
            ->to('/admin/kuesionerfields')
            ->with(
                'success',
                'Field berhasil dihapus.'
            );
    }
}
