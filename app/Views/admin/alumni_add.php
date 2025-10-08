<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Tambah Alumni Baru</h3>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif ?>

    <form method="post" action="<?= base_url('admin/alumni/save') ?>">
        <div class="row mb-2">
            <div class="col-md-6">
                <label>NIM</label>
                <input type="text" name="nim" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Program Studi</label>
                <input type="text" name="program_studi" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Tahun Lulus</label>
                <input type="number" name="tahun_lulus" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="col-md-6">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control">
            </div>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('admin/alumni') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>