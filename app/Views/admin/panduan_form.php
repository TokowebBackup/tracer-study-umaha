<!-- app/Views/admin/panduan_form.php -->

<?= $this->extend('layouts/admin_main') ?>
<?php
/** @var array $pdf */
/** @var array $fields_step2 */
/** @var array $select_options */
?>
<?= $this->section('content') ?>

<style>
    .page-card {
        border: 0;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
    }

    .page-header {
        background: linear-gradient(135deg, #0f766e, #16a34a);
        padding: 30px;
        color: white;
    }

    .page-header h4 {
        margin: 0;
        font-weight: 700;
    }

    .page-body {
        padding: 30px;
        background: #fff;
    }

    .form-label {
        font-weight: 600;
        color: #334155;
        margin-bottom: 10px;
    }

    .upload-area {
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        padding: 50px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #f8fafc, #ffffff);
    }

    .upload-area:hover {
        border-color: #0d6efd;
        background: #f0f7ff;
        transform: translateY(-2px);
    }

    .upload-area.dragover {
        border-color: #16a34a;
        background: #ecfdf3;
    }

    .upload-icon {
        font-size: 60px;
        color: #0d6efd;
        margin-bottom: 15px;
    }

    .upload-text {
        font-size: 17px;
        color: #334155;
        line-height: 1.7;
    }

    .btn-save {
        height: 52px;
        border-radius: 14px;
        padding: 0 30px;
        font-weight: 600;
        background: linear-gradient(135deg, #0f766e, #16a34a);
        border: none;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(22, 163, 74, 0.25);
    }

    .pdf-preview-card {
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        padding: 20px;
        background: #f8fafc;
    }

    .pdf-preview-card .pdf-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        background: #fee2e2;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .btn-modern {
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 600;
    }
</style>

<div class="container-fluid p-4">

    <div class="card page-card">

        <div class="page-header">

            <h4>
                <i class="bi bi-file-earmark-pdf-fill me-2"></i>
                Upload Panduan Tracer Study
            </h4>

        </div>

        <div class="page-body">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success rounded-4 border-0 shadow-sm">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger rounded-4 border-0 shadow-sm">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif ?>

            <form action="<?= base_url('admin/panduan/upload') ?>"
                method="post"
                enctype="multipart/form-data">

                <?= csrf_field() ?>

                <div class="mb-4">

                    <label class="form-label">
                        Upload File Panduan (PDF)
                    </label>

                    <div class="upload-wrapper">

                        <input
                            type="file"
                            name="pdf_file"
                            id="pdf_file"
                            class="d-none"
                            accept="application/pdf"
                            required>

                        <label for="pdf_file"
                            class="upload-area"
                            id="uploadArea">

                            <div class="upload-icon">
                                <i class="bi bi-cloud-arrow-up-fill"></i>
                            </div>

                            <div class="upload-text">

                                <strong>
                                    Drag & Drop File PDF
                                </strong>

                                <br>

                                atau klik untuk memilih file

                            </div>

                            <small class="text-muted d-block mt-2">
                                Format file PDF • Maksimal 5MB
                            </small>

                            <div id="fileName"
                                class="mt-3 text-success fw-semibold">
                            </div>

                        </label>

                    </div>

                </div>

                <button type="submit" class="btn btn-success btn-save">

                    <i class="bi bi-upload me-2"></i>
                    Upload Panduan

                </button>

            </form>

            <?php if ($pdf): ?>

                <div class="mt-5">

                    <h5 class="fw-bold mb-3">
                        PDF Saat Ini
                    </h5>

                    <div class="pdf-preview-card">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div class="d-flex align-items-center gap-3">

                                <div class="pdf-icon">
                                    <i class="bi bi-file-earmark-pdf-fill"></i>
                                </div>

                                <div>

                                    <div class="fw-bold">
                                        Panduan Tracer Study
                                    </div>

                                    <small class="text-muted">
                                        File PDF aktif yang digunakan pada halaman home tracer study.
                                    </small>

                                </div>

                            </div>

                            <a href="<?= base_url($pdf) ?>"
                                target="_blank"
                                class="btn btn-outline-primary btn-modern">

                                <i class="bi bi-eye-fill me-2"></i>
                                Lihat PDF

                            </a>

                        </div>

                    </div>

                </div>

            <?php endif ?>

        </div>

    </div>

</div>

<?= $this->section('scripts') ?>

<script>
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('pdf_file');
    const fileName = document.getElementById('fileName');

    uploadArea.addEventListener('dragover', (e) => {

        e.preventDefault();

        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', () => {

        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', (e) => {

        e.preventDefault();

        uploadArea.classList.remove('dragover');

        if (e.dataTransfer.files.length) {

            fileInput.files = e.dataTransfer.files;

            showFileName(e.dataTransfer.files[0]);
        }
    });

    fileInput.addEventListener('change', function() {

        if (this.files.length) {

            showFileName(this.files[0]);
        }
    });

    function showFileName(file) {

        fileName.innerHTML = `
            <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
            ${file.name}
        `;
    }
</script>

<?= $this->endSection() ?>

<?= $this->endSection() ?>