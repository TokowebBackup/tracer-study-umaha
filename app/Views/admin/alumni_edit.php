<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Edit Data Alumni</h3>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif ?>

    <form method="post" action="<?= base_url('admin/alumni/update/' . $alumni['id']) ?>">
        <div class="mb-2">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control" value="<?= esc($alumni['nim']) ?>" required>
        </div>
        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= esc($alumni['nama']) ?>" required>
        </div>
        <div class="mb-2">
            <label>Program Studi</label>
            <select name="program_studi" class="form-select" required>
                <option value="">Pilih Prodi</option>
                <?php foreach ($prodi_list as $p): ?>
                    <option value="<?= $p['kode_prodi'] ?>" <?= $alumni['program_studi'] == $p['kode_prodi'] ? 'selected' : '' ?>>
                        <?= $p['nama_prodi'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Tahun Lulus</label>
            <input type="text" name="tahun_lulus" class="form-control" value="<?= esc($alumni['tahun_lulus']) ?>" required>
        </div>
        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= esc($alumni['email']) ?>">
        </div>
        <div class="mb-2">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="<?= esc($alumni['no_hp']) ?>">
        </div>

        <button class="btn btn-success">Update</button>
        <a href="<?= base_url('admin/alumni') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= $this->endSection() ?>