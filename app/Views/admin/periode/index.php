<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-12">
            <h4>Data Periode Tracer</h4>

            <a href="<?= base_url('admin/periode/tambah') ?>" class="btn btn-primary mb-3">+ Tambah Periode</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Lulusan Tahun</th>
                        <th>Periode</th>
                        <th>Surat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $row): ?>
                        <tr>
                            <td><?= esc($row['tahun']) ?></td>
                            <td><?= esc($row['lulusan_tahun']) ?></td>
                            <td><?= date('d/m/Y', strtotime($row['tanggal_mulai'])) ?> - <?= date('d/m/Y', strtotime($row['tanggal_selesai'])) ?></td>
                            <td>
                                <?php if ($row['file_surat']): ?>
                                    <a href="<?= base_url($row['file_surat']) ?>" target="_blank" class="btn btn-sm btn-success">Lihat</a>
                                <?php else: ?>
                                    <span class="text-muted">Tidak Ada</span>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>