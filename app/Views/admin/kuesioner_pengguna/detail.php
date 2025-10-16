<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<h4><i class="bi bi-person-workspace"></i> Detail Kuesioner Pengguna</h4>
<a href="<?= base_url('admin/kuesioner-pengguna') ?>" class="btn btn-secondary btn-sm mb-3">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

<table class="table table-bordered">
    <?php foreach ($pengguna as $field => $value): ?>
        <tr>
            <th width="25%"><?= ucfirst(str_replace('_', ' ', $field)) ?></th>
            <td><?= esc($value) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection() ?>