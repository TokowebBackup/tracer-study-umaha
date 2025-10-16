<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<h3>Kelola Field Kuesioner</h3>

<a href="<?= base_url('admin/kuesionerfields/create') ?>" class="btn btn-primary mb-3">
    Tambah Field Baru
</a>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif ?>

<table class="table table-bordered table-striped align-middle" id="tabelKuesionerFields">
    <thead class="table-dark">
        <tr>
            <th style="width: 70px;">Order</th>
            <th style="width: 70px;">Step</th>
            <th>Field Name</th>
            <th>Label</th>
            <th style="width: 100px;">Type</th>
            <th style="width: 90px;">Required</th>
            <th>Options (JSON)</th>
            <th style="width: 150px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($fields)): ?>
            <?php foreach ($fields as $f): ?>
                <tr>
                    <td><?= esc($f['order']) ?></td>
                    <td><?= esc($f['step']) ?></td>
                    <td><?= esc($f['field_name']) ?></td>
                    <td><?= esc($f['label']) ?></td>
                    <td><?= esc($f['type']) ?></td>
                    <td><?= $f['required'] ? 'Ya' : 'Tidak' ?></td>
                    <td>
                        <pre class="mb-0" style="white-space: pre-wrap;"><?= esc($f['options']) ?></pre>
                    </td>
                    <td>
                        <a href="<?= base_url('admin/kuesionerfields/edit/' . $f['id']) ?>"
                            class="btn btn-sm btn-warning">
                            <i class="bi bi-trash"></i> Edit
                        </a>
                        <a href="<?= base_url('admin/kuesionerfields/delete/' . $f['id']) ?>"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin ingin menghapus field ini?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr>
                <td colspan="8" class="text-center">Belum ada field kuesioner yang ditambahkan.</td>
            </tr>
        <?php endif ?>
    </tbody>
</table>

<?= $this->section('scripts') ?>
<script>
    $(function() {
        $('#tabelKuesionerFields').DataTable();
    });
</script>
<?= $this->endSection(); ?>
<?= $this->endSection() ?>