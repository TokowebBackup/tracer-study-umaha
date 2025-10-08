<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Detail Alumni</h3>
    <table class="table table-bordered">
        <tr>
            <th>NIM</th>
            <td><?= $alumni['nim'] ?></td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><?= $alumni['nama'] ?></td>
        </tr>
        <tr>
            <th>Program Studi</th>
            <td><?= esc($alumni['nama_prodi']) ?></td>
        </tr>
        <tr>
            <th>Tahun Lulus</th>
            <td><?= $alumni['tahun_lulus'] ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $alumni['email'] ?></td>
        </tr>
        <tr>
            <th>No HP</th>
            <td><?= $alumni['no_hp'] ?></td>
        </tr>
    </table>
    <a href="<?= base_url('admin/alumni') ?>" class="btn btn-secondary">Kembali</a>
</div>

<?= $this->endSection() ?>