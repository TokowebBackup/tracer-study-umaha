<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-4">

    <h3 class="mb-4">
        <i class="bi bi-person-workspace me-2"></i>
        Detail Kuesioner Pengguna
    </h3>

    <a href="<?= base_url('admin/kuesioner-pengguna') ?>"
        class="btn btn-secondary mb-4">

        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>

    <!-- DATA ALUMNI -->
    <div class="card mb-4">

        <div class="card-header fw-bold">
            Data Alumni Dinilai
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Nama Alumni</label>
                    <div class="fw-semibold">
                        <?= esc($pengguna['nama_alumni']) ?>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label>NIM</label>
                    <div class="fw-semibold">
                        <?= esc($pengguna['nim']) ?>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Program Studi</label>
                    <div class="fw-semibold">
                        <?= esc($pengguna['nama_prodi']) ?>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jenjang</label>
                    <div class="fw-semibold">
                        <?= esc($pengguna['jenjang']) ?>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- DATA PEKERJAAN -->
    <div class="card mb-4">

        <div class="card-header fw-bold">
            Data Pekerjaan Alumni
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label>Status Pekerjaan</label>
                    <div class="fw-semibold">
                        <?= esc($pengguna['status_pekerjaan']) ?>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Perusahaan</label>
                    <div class="fw-semibold">
                        <?= esc($pengguna['institusi_bekerja']) ?>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Posisi</label>
                    <div class="fw-semibold">
                        <?= esc($pengguna['posisi_pekerjaan']) ?>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- PENILAI -->
    <div class="card mb-4">

        <div class="card-header fw-bold">
            Penilai / HRD
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Nama Pengisi</label>
                    <div class="fw-semibold">
                        <?= esc($pengguna['nama_pengisi']) ?>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jabatan</label>
                    <div class="fw-semibold">
                        <?= esc($pengguna['jabatan_pengisi']) ?>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>