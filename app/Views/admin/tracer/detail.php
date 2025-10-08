<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<h4 class="mb-3"><i class="bi bi-person-lines-fill"></i> Detail Tracer Study</h4>

<a href="<?= base_url('admin/tracer') ?>" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>

<?php if ($tracer): ?>
    <div class="card mb-4">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <span>Data Tracer Study Lengkap</span>
            <a href="<?= base_url('alumni/tracer/edit') ?>" class="btn btn-light btn-sm">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Tahun Pengisian:</strong> <?= esc($tracer['tahun_pengisian']) ?></p>
                    <p><strong>Tahun Lulus:</strong> <?= esc($tracer['tahun_lulus']) ?></p>
                    <p><strong>Status Pekerjaan:</strong> <?= esc($tracer['status_pekerjaan']) ?></p>
                    <p><strong>Institusi Bekerja:</strong> <?= esc($tracer['institusi_bekerja']) ?></p>
                    <p><strong>Posisi Pekerjaan:</strong> <?= esc($tracer['posisi_pekerjaan']) ?></p>
                    <p><strong>Tahun Mulai Bekerja:</strong> <?= esc($tracer['tahun_mulai_bekerja']) ?></p>
                    <p><strong>Gaji Pertama:</strong> <?= $tracer['gaji_pertama'] ? 'Rp' . number_format($tracer['gaji_pertama'], 0, ',', '.') : '-' ?></p>
                    <p><strong>Kabupaten Tempat Kerja:</strong> <?= esc($tracer['tempat_kerja_kabupaten']) ?></p>
                    <p><strong>Sektor Tempat Kerja:</strong> <?= esc($tracer['sektor_tempat_kerja']) ?></p>
                    <p><strong>Sesuai Bidang:</strong> <?= esc(ucfirst($tracer['sesuai_bidang'])) ?></p>
                    <p><strong>Dapat Kerja Sebelum Lulus:</strong> <?= esc(ucfirst($tracer['dapat_kerja_sebelum_lulus'])) ?></p>
                    <p><strong>Cara Mendapat Pekerjaan:</strong> <?= nl2br(esc($tracer['cara_mendapat_kerja'])) ?></p>
                    <p><strong>Bulan Mulai Mencari Pekerjaan:</strong> <?= esc($tracer['bulan_mulai_mencari_pekerjaan']) ?></p>
                    <p><strong>Domisili Alumni:</strong> <?= nl2br(esc($tracer['domisili_alumni'])) ?></p>
                </div>
                <div class="col-md-6">
                    <h6><strong>Penilaian Kepuasan</strong></h6>
                    <p>Etika: <?= esc($tracer['kepuasan_etika']) ?>/5</p>
                    <p>Keahlian Bidang Ilmu: <?= esc($tracer['kepuasan_keahlian_bidan_ilmu']) ?>/5</p>
                    <p>Bahasa Asing: <?= esc($tracer['kepuasan_bahasa_asing']) ?>/5</p>
                    <p>Teknologi Informasi: <?= esc($tracer['kepuasan_teknologi_informasi']) ?>/5</p>
                    <p>Komunikasi: <?= esc($tracer['kepuasan_komunikasi']) ?>/5</p>
                    <p>Kerjasama: <?= esc($tracer['kepuasan_kerjasama']) ?>/5</p>
                    <p>Pengembangan Diri: <?= esc($tracer['kepuasan_pengembangan_diri']) ?>/5</p>

                    <h6 class="mt-3"><strong>Kurikulum dan Saran</strong></h6>
                    <p><strong>Relevansi Kurikulum:</strong> <?= esc(ucfirst($tracer['relevansi_kurikulum'])) ?></p>
                    <p><strong>Saran Kurikulum:</strong><br><?= nl2br(esc($tracer['saran_kurikulum'])) ?></p>
                    <p><strong>Harapan untuk UMAHA:</strong><br><?= nl2br(esc($tracer['harapan_umaha'])) ?></p>

                    <p class="text-muted mt-3"><small><strong>Terakhir Diperbarui:</strong> <?= esc($tracer['created_at']) ?></small></p>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-warning">
        Data Tracer Study belum diisi. <a href="<?= base_url('alumni/tracer/create') ?>">Isi sekarang</a>.
    </div>
<?php endif; ?>


<?= $this->endSection() ?>