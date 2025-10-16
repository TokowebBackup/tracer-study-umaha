<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<h3>Profil Admin</h3>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif ?>

<form method="post" action="<?= base_url('admin/profile/update') ?>" class="mt-3">
    <input type="hidden" name="id" value="<?= esc($admin['id']) ?>">

    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" value="<?= esc($admin['username']) ?>" readonly>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Admin</label>
        <input type="text" name="nama_admin" class="form-control" value="<?= esc($admin['nama_admin']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= esc($admin['email']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password Baru (opsional)</label>
        <input type="password" name="password" class="form-control" placeholder="Isi jika ingin ganti password">
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>

<?= $this->endSection() ?>