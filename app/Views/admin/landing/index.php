<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4>Konten Landing Page</h4>
    <a href="<?= base_url('admin/landing/edit/0') ?>" class="btn btn-primary mb-3">Tambah Konten</a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle" id="tabelLanding">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($landing as $item): ?>
                    <tr>
                        <td><?= esc($item['judul']) ?></td>
                        <td><?= esc($item['status']) ?></td>
                        <td>
                            <?php if ($item['gambar']): ?>
                                <img src="<?= base_url($item['gambar']) ?>" width="100">
                            <?php endif ?>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/landing/edit/' . $item['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    $(function() {
        $('#tabelTracer').DataTable();
    });
</script>
<?= $this->endSection(); ?>
<?= $this->endSection() ?>