<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-buildings"></i> Data Pengguna Lulusan</h4>
    <a href="<?= base_url('admin/kuesioner-pengguna/export/all') ?>" class="btn btn-success">
        <i class="bi bi-file-earmark-excel"></i> Export Semua
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle" id="tabelPengguna">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama Perusahaan</th>
                <th>Nama Pengisi</th>
                <th>Jabatan</th>
                <th>Email</th>
                <th>Tahun Merekrut</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($pengguna): ?>
                <?php foreach ($pengguna as $i => $p): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($p['nama_perusahaan']) ?></td>
                        <td><?= esc($p['nama_pengisi']) ?></td>
                        <td><?= esc($p['jabatan_pengisi']) ?></td>
                        <td><?= esc($p['email_pengisi']) ?></td>
                        <td><?= esc($p['tahun_merekrut']) ?></td>
                        <td>
                            <a href="<?= base_url('admin/kuesioner-pengguna/detail/' . $p['id']) ?>" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="<?= base_url('admin/kuesioner-pengguna/export/' . $p['id']) ?>" class="btn btn-sm btn-success">
                                <i class="bi bi-download"></i> Export
                            </a>
                            <a href="<?= base_url('admin/kuesioner-pengguna/delete/' . $p['id']) ?>" class="btn btn-sm btn-danger btn-delete">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data pengguna lulusan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->section('scripts') ?>
<script>
    $(function() {
        $('#tabelPengguna').DataTable();
    });
</script>
<?= $this->endSection(); ?>

<?= $this->endSection() ?>