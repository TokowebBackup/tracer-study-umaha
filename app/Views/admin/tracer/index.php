<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-clipboard-data"></i> Data Tracer Study Alumni</h4>
    <a href="<?= base_url('admin/tracer/export/all') ?>" class="btn btn-success">
        <i class="bi bi-file-earmark-excel"></i> Export Semua
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle" id="tabelTracer">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama Alumni</th>
                <th>NIM</th>
                <th>Program Studi</th>
                <th>Status Pekerjaan</th>
                <th>Institusi</th>
                <th>Tahun Pengisian</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($tracers): ?>
                <?php foreach ($tracers as $i => $t): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($t['nama']) ?></td>
                        <td><?= esc($t['nim']) ?></td>
                        <td><?= esc($t['nama_prodi']) ?> (<?= esc($t['jenjang']) ?>)</td>
                        <td><?= esc($t['status_pekerjaan']) ?></td>
                        <td><?= esc($t['institusi_bekerja']) ?></td>
                        <td><?= esc($t['tahun_pengisian']) ?></td>
                        <td>
                            <a href="<?= base_url('admin/tracer/export/' . $t['id']) ?>" class="btn btn-sm btn-success">
                                <i class="bi bi-download"></i> Export
                            </a>
                            <a href="<?= base_url('admin/tracer/detail/' . $t['id']) ?>" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="<?= base_url('admin/tracer/delete/' . $t['id']) ?>"
                                class="btn btn-sm btn-danger btn-delete">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center text-muted">Belum ada data tracer study</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->section('scripts') ?>
<script>
    $(function() {
        $('#tabelTracer').DataTable();
    });
</script>
<?= $this->endSection(); ?>

<?= $this->endSection() ?>