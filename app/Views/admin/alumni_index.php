<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Data Alumni</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle" id="tabelAlumni">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Tahun Lulus</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $i => $row): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($row['nim']) ?></td>
                        <td><?= esc($row['nama']) ?></td>
                        <td><?= esc($row['nama_prodi']) ?></td>
                        <td><?= esc($row['tahun_lulus']) ?></td>
                        <td><?= esc($row['email']) ?></td>
                        <td><?= esc($row['no_hp']) ?></td>
                        <td class="options-cell text-nowrap" style="width: 220px;">
                            <a href="<?= base_url('admin/alumni/edit/' . $row['id']) ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="<?= base_url('admin/alumni/detail/' . $row['id']) ?>" class="btn btn-info btn-sm text-white">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="<?= base_url('admin/alumni/delete/' . $row['id']) ?>"
                                class="btn btn-danger btn-sm btn-delete">
                                <i class="bi bi-trash"></i>
                            </a>
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
        $('#tabelAlumni').DataTable();
    });
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>