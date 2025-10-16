<?= $this->extend('layouts/alumni') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <?php if (session()->getFlashdata('info')): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle"></i> <?= session()->getFlashdata('info') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h4 class="mb-4">Dashboard Alumni</h4>
    <a href="<?= base_url('/') ?>" class="btn btn-link mt-2 mb-5"><i class="bi bi-backspace-fill"></i> kembali Ke Halaman Tracer</a>
    <div class="card mb-4">
        <div class="card-header bg-success text-white">Biodata</div>
        <div class="card-body">
            <p><strong>NIM:</strong> <?= esc($alumni['nim']) ?></p>
            <p><strong>Nama:</strong> <?= esc($alumni['nama']) ?></p>
            <p><strong>Prodi:</strong> <?= esc($alumni['nama_prodi']) ?> (<?= esc($alumni['jenjang']) ?>)</p>
            <p><strong>Tahun Lulus:</strong> <?= esc($alumni['tahun_lulus']) ?></p>
        </div>
    </div>

    <?php if ($tracer): ?>
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-bar-chart"></i> Data Tracer Study</span>
                <a href="<?= base_url('alumni/tracer/edit') ?>" class="btn btn-light btn-sm">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Tahun Pengisian:</strong> <?= esc($tracer['tahun_pengisian']) ?></p>
                        <p><strong>Tahun Lulus:</strong> <?= esc($tracer['tahun_lulus']) ?></p>
                        <p><strong>Status Pekerjaan:</strong> <?= esc(ucwords(str_replace('_', ' ', $tracer['status_pekerjaan']))) ?></p>
                        <p><strong>Institusi Bekerja:</strong> <?= esc($tracer['institusi_bekerja']) ?></p>
                        <p><strong>Posisi Pekerjaan:</strong> <?= esc($tracer['posisi_pekerjaan']) ?></p>
                        <p><strong>Tahun Mulai Bekerja:</strong> <?= esc($tracer['tahun_mulai_bekerja']) ?></p>
                        <p><strong>Gaji Pertama:</strong> Rp<?= number_format($tracer['gaji_pertama'], 0, ',', '.') ?></p>
                        <p><strong>Domisili Alumni:</strong> <?= esc($tracer['domisili_alumni'] ?? '-') ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Kabupaten Tempat Kerja:</strong> <?= esc($tracer['tempat_kerja_kabupaten']) ?></p>
                        <p><strong>Sektor Tempat Kerja:</strong> <?= esc($tracer['sektor_tempat_kerja']) ?></p>
                        <p><strong>Pekerjaan Sesuai Bidang:</strong> <?= esc(ucfirst($tracer['sesuai_bidang'])) ?></p>
                        <p><strong>Dapat Kerja Sebelum Lulus:</strong> <?= esc(ucfirst($tracer['dapat_kerja_sebelum_lulus'])) ?></p>
                        <p><strong>Cara Mendapat Kerja:</strong> <?= esc($tracer['cara_mendapat_kerja']) ?></p>
                        <p><strong>Bulan Mulai Mencari Kerja:</strong> <?= esc($tracer['bulan_mulai_mencari_pekerjaan']) ?></p>
                    </div>
                </div>

                <hr>

                <h6 class="fw-bold text-primary mb-2">📊 Penilaian Kepuasan</h6>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Etika:</strong> <?= esc($tracer['kepuasan_etika']) ?>/5</p>
                        <p><strong>Keahlian Bidang Ilmu:</strong> <?= esc($tracer['kepuasan_keahlian_bidan_ilmu']) ?>/5</p>
                        <p><strong>Bahasa Asing:</strong> <?= esc($tracer['kepuasan_bahasa_asing']) ?>/5</p>
                        <p><strong>Teknologi Informasi:</strong> <?= esc($tracer['kepuasan_teknologi_informasi']) ?>/5</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Komunikasi:</strong> <?= esc($tracer['kepuasan_komunikasi']) ?>/5</p>
                        <p><strong>Kerjasama:</strong> <?= esc($tracer['kepuasan_kerjasama']) ?>/5</p>
                        <p><strong>Pengembangan Diri:</strong> <?= esc($tracer['kepuasan_pengembangan_diri']) ?>/5</p>
                    </div>
                </div>

                <hr>

                <h6 class="fw-bold text-primary mb-2">📘 Relevansi & Saran</h6>
                <p><strong>Relevansi Kurikulum:</strong> <?= esc(ucfirst($tracer['relevansi_kurikulum'])) ?></p>
                <p><strong>Saran untuk Kurikulum:</strong><br><?= nl2br(esc($tracer['saran_kurikulum'])) ?></p>
                <p><strong>Harapan terhadap UMAHA:</strong><br><?= nl2br(esc($tracer['harapan_umaha'])) ?></p>

                <div class="text-end text-muted small mt-3">
                    <em>Diperbarui pada: <?= date('d M Y H:i', strtotime($tracer['created_at'])) ?></em>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle"></i> Anda belum mengisi Tracer Study.
            <a href="<?= base_url('kuesioner/alumni') ?>" class="alert-link">Isi sekarang</a>.
        </div>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>