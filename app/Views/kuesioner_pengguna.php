<!-- app/Views/kuesioner_pengguna.php -->
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .form-step {
        display: none;
    }

    .form-step.active {
        display: block;
    }
</style>

<div class="container mt-4 mb-5">
    <h3 class="mb-3">Form Kuesioner Pengguna Lulusan UMAHA</h3>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif ?>

    <form method="post" action="<?= base_url('kuesioner/pengguna/simpan') ?>" id="multiStepForm">
        <!-- LANGKAH 1 -->
        <div class="form-step step-1 active">
            <h5>Langkah 1: Informasi Perusahaan & Rekrutmen</h5>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <label>Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" class="form-control" required>
                </div>
                <div class="col-md-12 mb-2">
                    <label>Alamat Perusahaan</label>
                    <textarea name="alamat_perusahaan" class="form-control"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label>Nama Pengisi</label>
                    <input type="text" name="nama_pengisi" class="form-control" required>
                </div>
                <div class="col-md-12 mb-2">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan_pengisi" class="form-control" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label>Email</label>
                    <input type="email" name="email_pengisi" class="form-control">
                </div>
                <div class="col-md-6 mb-2">
                    <label>No. Telepon / WhatsApp</label>
                    <input type="text" name="no_telp_pengisi" class="form-control">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Tahun Merekrut</label>
                    <input type="number" name="tahun_merekrut" class="form-control" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label>Jumlah Lulusan UMAHA yang Direkrut</label>
                    <input type="number" name="jumlah_lulusan_direkrut" class="form-control" required>
                </div>
            </div>

            <button type="button" class="btn btn-success mt-3" onclick="nextStep()">Lanjut <i class="bi bi-arrow-bar-right"></i></button>
        </div>

        <!-- LANGKAH 2 -->
        <div class="form-step step-2">
            <h5>Langkah 2: Penilaian Terhadap Lulusan UMAHA</h5>
            <?php
            $indikator = [
                'etika_kerja' => 'Etika Kerja',
                'keahlian_profesional' => 'Keahlian Profesional',
                'penguasaan_bahasa_asing' => 'Bahasa Asing',
                'teknologi_informasi' => 'Teknologi Informasi',
                'komunikasi' => 'Komunikasi',
                'kerjasama' => 'Kerja Sama',
                'pengembangan_diri' => 'Pengembangan Diri',
            ];
            foreach ($indikator as $key => $label):
            ?>
                <div class="mb-3">
                    <label><?= $label ?> (1 = Sangat Kurang, 5 = Sangat Baik)</label>
                    <select class="form-select" name="<?= $key ?>" required>
                        <option value="">Pilih</option>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor ?>
                    </select>
                </div>
            <?php endforeach ?>

            <div class="mb-3">
                <label>Saran/Masukan Umum</label>
                <textarea name="saran_umum" class="form-control" rows="3"></textarea>
            </div>

            <button type="button" class="btn btn-secondary" onclick="prevStep()">Kembali</button>
            <button type="submit" class="btn btn-success">Kirim Kuesioner</button>
        </div>
    </form>
</div>

<script>
    function nextStep() {
        const step1Fields = document.querySelectorAll('.step-1 [required]');
        let isValid = true;

        step1Fields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (isValid) {
            document.querySelector('.step-1').classList.remove('active');
            document.querySelector('.step-2').classList.add('active');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Lengkapi Data',
                text: 'Harap lengkapi semua data wajib di Langkah 1 sebelum melanjutkan.',
                confirmButtonColor: '#3085d6',
            });
        }
    }

    function prevStep() {
        document.querySelector('.step-2').classList.remove('active');
        document.querySelector('.step-1').classList.add('active');
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>

<?= $this->endSection() ?>