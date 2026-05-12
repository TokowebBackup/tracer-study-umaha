<?= $this->extend('layouts/admin_main') ?>
<?php
/** @var array $periode */
/** @var array $fields_step2 */
/** @var array $select_options */
?>
<?= $this->section('content') ?>

<style>
    .upload-area {
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        padding: 45px 20px;
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
        border-color: #198754;
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

    .pdf-preview {
        overflow: hidden;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
    }
</style>

<div class="container p-4">
    <div class="row">
        <div class="col-lg-12">

            <h4>Edit Periode Tracer</h4>

            <form action="<?= base_url('admin/periode/update/' . $periode['id']) ?>"
                method="post"
                enctype="multipart/form-data">

                <div class="mb-2">
                    <label>Tahun Periode</label>
                    <input type="text"
                        name="tahun"
                        class="form-control"
                        value="<?= esc($periode['tahun']) ?>"
                        required>
                </div>

                <div class="mb-2">
                    <label>Tahun Lulusan</label>
                    <input type="text"
                        name="lulusan_tahun"
                        class="form-control"
                        value="<?= esc($periode['lulusan_tahun']) ?>"
                        required>
                </div>

                <div class="mb-2">
                    <label>Tanggal Mulai</label>
                    <input type="date"
                        name="tanggal_mulai"
                        class="form-control"
                        value="<?= esc($periode['tanggal_mulai']) ?>"
                        required>
                </div>

                <div class="mb-2">
                    <label>Tanggal Selesai</label>
                    <input type="date"
                        name="tanggal_selesai"
                        class="form-control"
                        value="<?= esc($periode['tanggal_selesai']) ?>"
                        required>
                </div>

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Upload Surat Pemberitahuan (PDF)
                    </label>

                    <div class="upload-wrapper">

                        <input
                            type="file"
                            name="file_surat"
                            id="file_surat"
                            class="d-none"
                            accept="application/pdf">

                        <label for="file_surat" class="upload-area" id="uploadArea">

                            <div class="upload-icon">
                                <i class="bi bi-cloud-arrow-up-fill"></i>
                            </div>

                            <div class="upload-text">
                                <strong>Drag & Drop File PDF</strong>
                                <br>
                                atau klik untuk upload file
                            </div>

                            <small class="text-muted d-block mt-2">
                                Maksimal file 5MB
                            </small>

                            <div id="fileName" class="mt-3 text-success fw-semibold"></div>

                        </label>

                    </div>

                    <?php if (!empty($periode['file_surat'])): ?>

                        <div class="card border-0 shadow-sm mt-4">

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <div>
                                        <h6 class="mb-1">
                                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                            File PDF Saat Ini
                                        </h6>

                                        <small class="text-muted">
                                            Surat pemberitahuan periode tracer
                                        </small>
                                    </div>

                                    <a href="<?= base_url($periode['file_surat']) ?>"
                                        target="_blank"
                                        class="btn btn-primary btn-sm rounded-pill px-3">

                                        <i class="bi bi-eye"></i>
                                        Lihat PDF

                                    </a>

                                </div>

                                <div class="pdf-preview">

                                    <embed
                                        src="<?= base_url($periode['file_surat']) ?>"
                                        type="application/pdf"
                                        width="100%"
                                        height="500px">

                                </div>

                            </div>

                        </div>

                    <?php endif; ?>

                </div>

                <button class="btn btn-success">
                    Update
                </button>

            </form>

        </div>
    </div>
</div>

<?= $this->section('scripts') ?>

<script>
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('file_surat');
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