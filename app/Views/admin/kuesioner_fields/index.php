<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<h3>Kelola Field Kuesioner</h3>

<a href="<?= base_url('admin/kuesionerfields/create') ?>" class="btn btn-primary mb-3">Tambah Field Baru</a>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Order</th>
            <th>Step</th>
            <th>Field Name</th>
            <th>Label</th>
            <th>Type</th>
            <th>Required</th>
            <th>Options (JSON)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($fields as $f): ?>
            <tr>
                <td><?= esc($f['order']) ?></td>
                <td><?= esc($f['step']) ?></td>
                <td><?= esc($f['field_name']) ?></td>
                <td><?= esc($f['label']) ?></td>
                <td><?= esc($f['type']) ?></td>
                <td><?= $f['required'] ? 'Ya' : 'Tidak' ?></td>
                <td><?= esc($f['options']) ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?= $this->endSection() ?>