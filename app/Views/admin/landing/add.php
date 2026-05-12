<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<style>
    .page-card {
        border: 0;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.06);
    }

    .page-header {
        background: linear-gradient(135deg, #006633, #009966);
        padding: 35px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {

        content: '';

        position: absolute;

        width: 220px;
        height: 220px;

        border-radius: 50%;

        background: rgba(255, 255, 255, .08);

        right: -70px;
        top: -70px;
    }

    .page-header h4 {

        margin: 0;
        font-weight: 800;
        position: relative;
        z-index: 2;
    }

    .page-header p {

        margin-top: 8px;
        margin-bottom: 0;

        opacity: .85;

        position: relative;
        z-index: 2;
    }

    .page-body {

        padding: 35px;
        background: white;
    }

    .form-label {

        font-weight: 700;
        color: #334155;
        margin-bottom: 10px;
    }

    .form-control,
    .form-select {

        height: 54px;

        border-radius: 16px;

        border: 1px solid #dbe2ea;

        padding-left: 16px;

        box-shadow: none;
    }

    textarea.form-control {

        min-height: 130px;
        padding-top: 14px;
    }

    .form-control:focus,
    .form-select:focus {

        border-color: #009966;

        box-shadow: 0 0 0 4px rgba(0, 153, 102, .08);
    }

    /* ========================
       UPLOAD AREA
    ======================== */

    .upload-area {

        border: 2px dashed #cbd5e1;

        border-radius: 24px;

        padding: 50px 20px;

        text-align: center;

        cursor: pointer;

        transition: all .3s ease;

        background:
            linear-gradient(135deg,
                #f8fafc,
                #ffffff);
    }

    .upload-area:hover {

        border-color: #009966;

        background: #f0fdf4;

        transform: translateY(-2px);
    }

    .upload-area.dragover {

        border-color: #16a34a;

        background: #ecfdf3;
    }

    .upload-icon {

        font-size: 60px;

        color: #009966;

        margin-bottom: 18px;
    }

    .upload-text {

        font-size: 17px;

        color: #334155;

        line-height: 1.7;
    }

    /* ========================
       BUTTON
    ======================== */

    .btn-save {

        height: 54px;

        padding: 0 28px;

        border-radius: 16px;

        border: none;

        font-weight: 700;

        background:
            linear-gradient(135deg,
                #006633,
                #009966);

        transition: .25s ease;
    }

    .btn-save:hover {

        transform: translateY(-2px);

        box-shadow:
            0 12px 30px rgba(0, 153, 102, .25);
    }

    .btn-back {

        height: 54px;

        padding: 0 24px;

        border-radius: 16px;

        font-weight: 600;
    }
</style>

<div class="container-fluid p-4">

    <div class="card page-card">

        <!-- HEADER -->
        <div class="page-header">

            <h4>
                <i class="bi bi-window-stack me-2"></i>

                <?= isset($item['id']) ? 'Edit' : 'Tambah' ?>
                Konten Landing Page
            </h4>

            <p>
                Tambahkan konten baru untuk landing page tracer study UMAHA
            </p>

        </div>

        <!-- BODY -->
        <div class="page-body">

            <form action="<?= base_url('admin/landing/' . (isset($item['id']) ? 'update' : 'add')) ?>"
                method="post"
                enctype="multipart/form-data">

                <?php if (isset($item['id'])): ?>

                    <input type="hidden"
                        name="id"
                        value="<?= $item['id'] ?>">

                <?php endif ?>

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Judul
                        </label>

                        <input type="text"
                            name="judul"
                            class="form-control"
                            value="<?= esc($item['judul'] ?? '') ?>"
                            required>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Subjudul
                        </label>

                        <input type="text"
                            name="subjudul"
                            class="form-control"
                            value="<?= esc($item['subjudul'] ?? '') ?>">

                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Konten
                    </label>

                    <textarea name="konten"
                        class="form-control"><?= esc($item['konten'] ?? '') ?></textarea>

                </div>

                <!-- UPLOAD IMAGE -->
                <div class="mb-4">

                    <label class="form-label">
                        Upload Gambar Landing Page
                    </label>

                    <div class="upload-wrapper">

                        <input
                            type="file"
                            name="gambar"
                            id="gambar"
                            class="d-none"
                            accept="image/*">

                        <label for="gambar"
                            class="upload-area"
                            id="uploadArea">

                            <div class="upload-icon">

                                <i class="bi bi-cloud-arrow-up-fill"></i>

                            </div>

                            <div class="upload-text">

                                <strong>
                                    Drag & Drop Gambar
                                </strong>

                                <br>

                                atau klik untuk upload gambar

                            </div>

                            <small class="text-muted d-block mt-2">

                                Format JPG, PNG, WEBP

                            </small>

                            <div id="fileName"
                                class="mt-3 text-success fw-semibold">
                            </div>

                        </label>

                    </div>

                </div>

                <!-- STATUS -->
                <div class="mb-4">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                        class="form-select"
                        required>

                        <option value="aktif"
                            <?= ($item['status'] ?? '') == 'aktif' ? 'selected' : '' ?>>

                            Aktif

                        </option>

                        <option value="nonaktif"
                            <?= ($item['status'] ?? '') == 'nonaktif' ? 'selected' : '' ?>>

                            Nonaktif

                        </option>

                    </select>

                </div>

                <!-- SOCIAL MEDIA -->
                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Facebook
                        </label>

                        <input type="url"
                            name="facebook"
                            class="form-control"
                            value="<?= esc($item['facebook'] ?? '') ?>"
                            placeholder="https://facebook.com/...">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Instagram
                        </label>

                        <input type="url"
                            name="instagram"
                            class="form-control"
                            value="<?= esc($item['instagram'] ?? '') ?>"
                            placeholder="https://instagram.com/...">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Twitter (X)
                        </label>

                        <input type="url"
                            name="twitter"
                            class="form-control"
                            value="<?= esc($item['twitter'] ?? '') ?>"
                            placeholder="https://twitter.com/...">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            LinkedIn
                        </label>

                        <input type="url"
                            name="linkedin"
                            class="form-control"
                            value="<?= esc($item['linkedin'] ?? '') ?>"
                            placeholder="https://linkedin.com/...">

                    </div>

                    <div class="col-md-12 mb-4">

                        <label class="form-label">
                            YouTube
                        </label>

                        <input type="url"
                            name="youtube"
                            class="form-control"
                            value="<?= esc($item['youtube'] ?? '') ?>"
                            placeholder="https://youtube.com/...">

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-3">

                    <button class="btn btn-success btn-save">

                        <i class="bi bi-save me-2"></i>

                        Simpan Konten

                    </button>

                    <a href="<?= base_url('admin/landing') ?>"
                        class="btn btn-light border btn-back">

                        <i class="bi bi-arrow-left me-2"></i>

                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->section('scripts') ?>

<script>
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('gambar');
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
            <i class="bi bi-image-fill text-success"></i>
            ${file.name}
        `;
    }
</script>

<?= $this->endSection() ?>

<?= $this->endSection() ?>