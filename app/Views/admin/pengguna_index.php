<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Data Pengguna Lulusan</h3>

    <div class="table-responsive">
        <table class="table table-bordered" id="tabelPengguna">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Perusahaan</th>
                    <th>Nama Pengisi</th>
                    <th>Jabatan</th>
                    <th>Email / No HP</th>
                    <th>Tahun</th>
                    <th>Jumlah Rekrut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $i => $row): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($row['nama_perusahaan']) ?></td>
                        <td><?= esc($row['nama_pengisi']) ?></td>
                        <td><?= esc($row['jabatan_pengisi']) ?></td>
                        <td><?= esc($row['email_pengisi']) ?> / <?= esc($row['no_telp_pengisi']) ?></td>
                        <td><?= esc($row['tahun_merekrut']) ?></td>
                        <td><?= esc($row['jumlah_lulusan_direkrut']) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(function() {
        $('#tabelPengguna').DataTable();
    });
</script>

<?= $this->endSection() ?>