<?= $this->extend('layouts/admin_main') ?>
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
        margin-bottom: 8px;
    }

    .form-control {
        height: 52px;
        border-radius: 14px;
        border: 1px solid #dbe2ea;
        padding-left: 15px;
    }

    .form-control:focus {
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.08);
        border-color: #0d6efd;
    }

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
</style>

<div class="container-fluid p-4">

    <div class="card page-card">

        <div class="page-header">

            <h4>
                <i class="bi bi-calendar-plus me-2"></i>
                Tambah Periode Tracer
            </h4>

        </div>

        <div class="page-body">

            <form action="<?= base_url('admin/periode/simpan') ?>"
                method="post"
                enctype="multipart/form-data">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Tahun Periode
                        </label>

                        <input type="text"
                            name="tahun"
                            class="form-control"
                            placeholder="Contoh: 2025"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Tahun Lulusan
                        </label>

                        <input type="text"
                            name="lulusan_tahun"
                            class="form-control"
                            placeholder="Contoh: 2024"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Tanggal Mulai
                        </label>

                        <input type="date"
                            name="tanggal_mulai"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Tanggal Selesai
                        </label>

                        <input type="date"
                            name="tanggal_selesai"
                            class="form-control"
                            required>

                    </div>

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

                        <label for="file_surat"
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

                                atau klik untuk upload file

                            </div>

                            <small class="text-muted d-block mt-2">
                                Maksimal file 5MB
                            </small>

                            <div id="fileName"
                                class="mt-3 text-success fw-semibold">
                            </div>

                        </label>

                    </div>

                </div>

                <button class="btn btn-success btn-save">

                    <i class="bi bi-save me-2"></i>
                    Simpan Periode

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