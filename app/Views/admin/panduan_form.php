<!-- app/Views/admin/panduan_form.php -->
<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4>Upload Panduan Tracer Study</h4>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif ?>

    <form action="<?= base_url('admin/panduan/upload') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Unggah PDF Baru</label>
            <input type="file" class="form-control" name="pdf_file" accept="application/pdf" required>
        </div>
        <button class="btn btn-success" type="submit">Upload</button>
    </form>

    <?php if ($pdf): ?>
        <div class="mt-3">
            <p>PDF Saat Ini:</p>
            <a href="<?= base_url($pdf) ?>" target="_blank" class="btn btn-outline-primary">Lihat PDF</a>
        </div>
    <?php endif ?>
</div>

<?= $this->endSection() ?>