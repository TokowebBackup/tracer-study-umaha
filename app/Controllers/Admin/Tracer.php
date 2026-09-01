<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TracerModel;
use App\Models\KuesionerFieldModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\PenggunaRequestModel;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Tracer extends BaseController
{
    protected $tracerModel;
    protected $fieldModel;

    protected array $defaultFields = [
        'nama' => 'Nama',
        'nim' => 'NIM',
        'nama_prodi' => 'Program Studi',
        'jenjang' => 'Jenjang',
    ];

    public function __construct()
    {
        $this->tracerModel = new TracerModel();
        $this->fieldModel = new KuesionerFieldModel();
    }

    // =========================================================
    // INDEX
    // =========================================================
    public function index()
    {
        $data['title'] = 'Data Tracer Study';

        $requestModel = new PenggunaRequestModel();

        $tracers = $this->tracerModel
            ->select('
        tracer_study.*,
        alumni.nama,
        alumni.nim,
        prodi.nama_prodi,
        prodi.jenjang
    ')
            ->join('alumni', 'alumni.id = tracer_study.alumni_id', 'left')
            ->join('prodi', 'prodi.kode_prodi = alumni.program_studi', 'left')
            ->orderBy('tracer_study.created_at', 'DESC')
            ->findAll();

        foreach ($tracers as &$tracer) {

            $request = $requestModel
                ->where('alumni_id', $tracer['alumni_id'])
                ->orderBy('id', 'DESC')
                ->first();

            $tracer['pengguna_request'] = $request;
        }

        $data['tracers'] = $tracers;

        return view('admin/tracer/index', $data);
    }

    // =========================================================
    // DETAIL
    // =========================================================
    public function detail($id)
    {
        $tracer = $this->tracerModel
            ->select('
            tracer_study.*,
            alumni.nama,
            alumni.nim,
            alumni.email,
            prodi.nama_prodi,
            prodi.jenjang
        ')
            ->join(
                'alumni',
                'alumni.id = tracer_study.alumni_id',
                'left'
            )
            ->join(
                'prodi',
                'prodi.kode_prodi = alumni.program_studi',
                'left'
            )
            ->where('tracer_study.id', $id)
            ->first();

        if (!$tracer) {

            return redirect()
                ->to(base_url('admin/tracer'))
                ->with(
                    'error',
                    'Data tidak ditemukan.'
                );
        }

        // =====================================================
        // FIELD VIRTUAL
        // =====================================================

        $tracer['program_studi'] =
            $tracer['nama_prodi'] ?? '-';

        $tracer['nama'] =
            $tracer['nama'] ?? '-';

        $tracer['nim'] =
            $tracer['nim'] ?? '-';

        // =====================================================
        // GET FIELD
        // =====================================================

        $fields = $this->fieldModel
            ->orderBy('step', 'ASC')
            ->orderBy('order', 'ASC')
            ->findAll();

        $groupedFields = [];

        foreach ($fields as $field) {

            $header =
                $field['header']
                ?: 'Informasi Lain';

            $groupedFields[$header][] = $field;
        }

        return view('admin/tracer/detail', [

            'tracer' => $tracer,

            'groupedFields' => $groupedFields,

        ]);
    }

    // =========================================================
    // DELETE
    // =========================================================
    public function delete($id)
    {
        $this->tracerModel->delete($id);

        return redirect()
            ->to(base_url('admin/tracer'))
            ->with('success', 'Data berhasil dihapus.');
    }

    // =========================================================
    // EXPORT ALL
    // =========================================================
    public function exportAll()
    {
        $data = $this->getExportData();

        if (!$data) {

            return redirect()
                ->back()
                ->with('error', 'Data tidak ditemukan.');
        }

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Tracer Study');

        $dynamicFields = $this->fieldModel
            ->orderBy('step', 'ASC')
            ->orderBy('order', 'ASC')
            ->findAll();

        // =====================================================
        // HEADER
        // =====================================================

        $headers = array_values($this->defaultFields);

        foreach ($dynamicFields as $field) {

            $headers[] = $field['label'];
        }

        $headers[] = 'Created At';

        $col = 'A';

        foreach ($headers as $header) {

            $sheet->setCellValue(
                $col . '1',
                $header
            );

            $col++;
        }

        // =====================================================
        // HEADER STYLING
        // =====================================================

        $headerRange =
            'A1:' . $sheet->getHighestColumn() . '1';

        $sheet->getStyle($headerRange)
            ->getFont()
            ->setBold(true);

        $sheet->getStyle($headerRange)
            ->getFont()
            ->getColor()
            ->setARGB('FFFFFFFF');

        $sheet->getStyle($headerRange)
            ->getFill()
            ->setFillType(
                \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID
            )
            ->getStartColor()
            ->setARGB('009966');

        // =====================================================
        // DATA
        // =====================================================

        $row = 2;

        foreach ($data as $d) {

            $col = 'A';

            // default fields
            foreach (
                array_keys($this->defaultFields)
                as $fieldKey
            ) {

                $sheet->setCellValue(
                    $col++ . $row,
                    $d[$fieldKey] ?? ''
                );
            }

            // dynamic fields
            foreach ($dynamicFields as $field) {

                $fieldName = $field['field_name'];

                $value = $d[$fieldName] ?? '';

                $sheet->setCellValue(
                    $col++ . $row,
                    $value
                );
            }

            $sheet->setCellValue(
                $col++ . $row,
                $d['created_at'] ?? ''
            );

            $row++;
        }

        // =====================================================
        // AUTO SIZE COLUMN
        // =====================================================

        $highestColumn = $sheet->getHighestColumn();

        $highestColumnIndex =
            \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString(
                $highestColumn
            );

        for (
            $col = 1;
            $col <= $highestColumnIndex;
            $col++
        ) {

            $columnLetter =
                \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(
                    $col
                );

            $sheet
                ->getColumnDimension($columnLetter)
                ->setAutoSize(true);
        }

        // =====================================================
        // BORDER TABLE
        // =====================================================

        $tableRange =
            'A1:' .
            $sheet->getHighestColumn() .
            $sheet->getHighestRow();

        $sheet->getStyle($tableRange)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );

        // =====================================================
        // FREEZE HEADER
        // =====================================================

        $sheet->freezePane('A2');

        // =====================================================
        // DOWNLOAD
        // =====================================================

        $filename =
            'TracerStudy_' .
            date('YmdHis') .
            '.xlsx';

        $writer = new Xlsx($spreadsheet);

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );

        header(
            "Content-Disposition: attachment; filename=\"$filename\""
        );

        header('Cache-Control: max-age=0');

        $writer->save('php://output');

        exit;
    }

    // =========================================================
    // EXPORT SINGLE
    // =========================================================
    public function exportSingle($id)
    {
        $data = $this->getExportData($id);

        if (!$data) {

            return redirect()
                ->back()
                ->with('error', 'Data tidak ditemukan.');
        }

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Tracer');

        $dynamicFields = $this->fieldModel
            ->orderBy('step', 'ASC')
            ->orderBy('order', 'ASC')
            ->findAll();

        $row = 1;

        // default fields
        foreach ($this->defaultFields as $fieldKey => $label) {

            $sheet->setCellValue('A' . $row, $label);

            $sheet->setCellValue(
                'B' . $row,
                $data[$fieldKey] ?? ''
            );

            $row++;
        }

        // dynamic fields
        foreach ($dynamicFields as $field) {

            $fieldName = $field['field_name'];

            $sheet->setCellValue(
                'A' . $row,
                $field['label']
            );

            $sheet->setCellValue(
                'B' . $row,
                $data[$fieldName] ?? ''
            );

            $row++;
        }

        $sheet->getColumnDimension('A')->setAutoSize(true);

        $sheet->getColumnDimension('B')->setAutoSize(true);

        $filename = 'Tracer_' . time() . '.xlsx';

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        header("Content-Disposition: attachment; filename=\"$filename\"");

        $writer->save('php://output');

        exit;
    }

    // =========================================================
    // SHARED EXPORT QUERY
    // =========================================================
    protected function getExportData($id = null)
    {
        $builder = $this->tracerModel
            ->select('
                tracer_study.*,
                alumni.nama,
                alumni.nim,
                prodi.nama_prodi,
                prodi.jenjang
            ')
            ->join('alumni', 'alumni.id = tracer_study.alumni_id', 'left')
            ->join('prodi', 'prodi.kode_prodi = alumni.program_studi', 'left');

        if ($id !== null) {

            return $builder
                ->where('tracer_study.id', $id)
                ->first();
        }

        return $builder
            ->orderBy('tracer_study.created_at', 'DESC')
            ->findAll();
    }

    public function requestPengguna($id)
    {
        $tracer = $this->tracerModel
            ->select('
            tracer_study.*,
            alumni.nama,
            alumni.email
        ')
            ->join(
                'alumni',
                'alumni.id = tracer_study.alumni_id',
                'left'
            )
            ->where('tracer_study.id', $id)
            ->first();

        if (!$tracer) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tracer tidak ditemukan.'
                );
        }

        // =====================================================
        // VALIDASI STATUS PEKERJAAN
        // =====================================================

        if (
            empty($tracer['institusi_bekerja'])
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Institusi bekerja alumni belum diisi.'
                );
        }

        // =====================================================
        // GENERATE TOKEN
        // =====================================================

        $token = bin2hex(random_bytes(32));

        $requestModel = new PenggunaRequestModel();

        $requestModel->insert([

            'alumni_id' => $tracer['alumni_id'],

            'nama_perusahaan' =>
            $tracer['institusi_bekerja'],

            'alamat_perusahaan' =>
            $tracer['alamat_perusahaan'] ?? null,

            'token' => $token,

            'expired_at' => date(
                'Y-m-d H:i:s',
                strtotime('+30 days')
            ),
        ]);

        $link = base_url(
            'kuesioner/pengguna/' . $token
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Link kuesioner pengguna berhasil dibuat: '
                    . $link
            );
    }
}
