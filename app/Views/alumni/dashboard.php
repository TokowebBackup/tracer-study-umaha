<?= $this->extend('layouts/alumni') ?>
<?php
/** @var array $alumni */
/** @var array $tracer */
/** @var array $groupedFields */
?>
<?= $this->section('content') ?>
<style>
    .dashboard-hero {
        background: linear-gradient(135deg, #006633 0%, #009966 100%);
        border-radius: 24px;
        padding: 40px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
        z-index: 1;
    }

    .dashboard-hero>* {
        position: relative;
        z-index: 2;
    }

    .dashboard-hero::before {
        content: '';
        position: absolute;
        right: -50px;
        top: -50px;
        width: 220px;
        height: 220px;
        background: rgba(255, 255, 255, .08);
        border-radius: 50%;
        z-index: 1;
        pointer-events: none;
    }

    .modern-card {
        border: none;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, .06);
        transition: .3s ease;
    }

    .modern-card:hover {
        transform: translateY(-3px);
    }

    .modern-card .card-header {
        border: none;
        padding: 18px 24px;
    }

    .modern-card .card-body {
        padding: 24px;
    }

    .info-item {
        background: #f8faf9;
        border-radius: 18px;
        padding: 18px;
        height: 100%;
        border: 1px solid #edf2ef;
        transition: .25s ease;
    }

    .info-item:hover {
        background: #f1f9f4;
        transform: translateY(-2px);
    }

    .info-label {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 6px;
    }

    .info-value {
        font-weight: 600;
        color: #1c1c1c;
        font-size: 15px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #006633;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-umaha {
        background: linear-gradient(135deg, #006633 0%, #009966 100%);
        border: none;
        color: white;
        border-radius: 14px;
        padding: 10px 18px;
        font-weight: 600;
    }

    .btn-umaha:hover {
        color: white;
        opacity: .95;
    }

    .btn-soft {
        background: #eef8f1;
        color: #006633;
        border-radius: 14px;
        border: none;
        padding: 10px 18px;
        font-weight: 600;
    }

    .modal-content {
        border: none;
        border-radius: 24px;
        overflow: hidden;
    }

    .modal-header {
        border: none;
        padding: 24px;
        background: linear-gradient(135deg, #006633 0%, #009966 100%);
    }

    .modal-body {
        padding: 28px;
        background: #fcfcfc;
    }

    .modal-footer {
        border: none;
        padding: 20px 24px;
    }

    .badge-modern {
        background: rgba(255, 255, 255, .18);
        padding: 8px 14px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 500;
    }
</style>

<div class="container mt-5">
    <?php if (session()->getFlashdata('info')): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle"></i> <?= session()->getFlashdata('info') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="dashboard-hero mb-4">

        <div class="d-flex justify-content-between align-items-start flex-wrap">

            <div>
                <div class="badge-modern mb-3">
                    Dashboard Alumni UMAHA
                </div>

                <h2 class="fw-bold mb-2">
                    Selamat Datang,
                    <?= esc($alumni['nama']) ?>
                </h2>

                <p class="mb-0 opacity-75">
                    Kelola data tracer study alumni Anda dengan mudah.
                </p>
            </div>

            <div class="mt-3 mt-md-0">
                <a href="<?= base_url('/') ?>" class="btn btn-light rounded-4 px-4">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>

        </div>

    </div>

    <!-- Biodata -->
    <div class="card modern-card mb-4">

        <div class="card-header bg-success text-white">
            <i class="bi bi-person-vcard-fill me-2"></i>
            Biodata Alumni
        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">NIM</div>
                        <div class="info-value"><?= esc($alumni['nim']) ?></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-value"><?= esc($alumni['nama']) ?></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">Program Studi</div>
                        <div class="info-value">
                            <?= esc($alumni['nama_prodi']) ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">Tahun Lulus</div>
                        <div class="info-value">
                            <?= esc($alumni['tahun_lulus']) ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php if ($tracer): ?>

        <?php

        $showRequestForm = true;

        if (
            $penggunaRequest &&
            (
                (int)$penggunaRequest['is_sent'] === 1 ||
                (int)$penggunaRequest['is_submitted'] === 1
            )
        ) {

            $showRequestForm = false;
        }

        ?>

        <?php if ($showRequestForm): ?>

            <div class="card modern-card mb-4">

                <div class="card-header bg-warning text-dark">

                    <i class="bi bi-send-check-fill me-2"></i>
                    Request Penilaian Pengguna

                </div>

                <div class="card-body">

                    <p class="text-muted">
                        Kirim form penilaian ke HRD, atasan,
                        atau perusahaan tempat Anda bekerja.
                    </p>

                    <form
                        action="<?= base_url('alumni/request-pengguna/generate') ?>"
                        method="post">

                        <?= csrf_field() ?>

                        <div class="mb-3">

                            <label class="form-label">
                                Nomor WhatsApp HR / Atasan
                            </label>

                            <input
                                type="text"
                                name="whatsapp"
                                class="form-control"
                                placeholder="Contoh: 628123456789"
                                required>

                            <small class="text-muted">
                                Gunakan format 62 tanpa tanda +
                            </small>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-umaha">

                            <i class="bi bi-whatsapp"></i>
                            Generate & Kirim WhatsApp

                        </button>

                    </form>

                </div>

            </div>

        <?php else: ?>

            <div class="card modern-card mb-4">

                <div class="card-header bg-success text-white">

                    <i class="bi bi-check-circle-fill me-2"></i>
                    Status Penilaian Pengguna

                </div>

                <div class="card-body">

                    <?php if (
                        $penggunaRequest &&
                        (int)$penggunaRequest['is_submitted'] === 1
                    ): ?>

                        <div class="alert alert-success mb-0">

                            <i class="bi bi-patch-check-fill me-2"></i>

                            Penilaian pengguna sudah berhasil diisi.

                        </div>

                    <?php else: ?>

                        <div class="alert alert-info mb-0">

                            <i class="bi bi-send-check-fill me-2"></i>

                            Link penilaian pengguna sudah berhasil dikirim
                            dan sedang menunggu pengisian.

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        <?php endif; ?>


        <div class="card modern-card mb-4">

            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center flex-wrap">

                <div>
                    <i class="bi bi-bar-chart-line-fill me-2"></i>
                    Data Tracer Study
                </div>

                <div class="mt-2 mt-md-0">

                    <a href="<?= base_url('alumni/tracer/edit') ?>"
                        class="btn btn-light btn-sm rounded-4 px-3 me-2">

                        <i class="bi bi-pencil-square"></i>
                        Edit
                    </a>

                    <button
                        class="btn btn-warning btn-sm rounded-4 px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#detailTracerModal">

                        <i class="bi bi-eye-fill"></i>
                        Detail
                    </button>

                </div>

            </div>

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h5 class="fw-bold mb-2">
                            Data tracer sudah tersimpan
                        </h5>

                        <p class="text-muted mb-0">
                            Terakhir diperbarui:
                            <?= date('d M Y H:i', strtotime($tracer['updated_at'] ?? $tracer['created_at'])) ?>
                        </p>

                    </div>

                    <div class="col-md-4 text-md-end mt-3 mt-md-0">

                        <div class="badge bg-success px-3 py-2 rounded-pill">
                            Status Aktif
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- MODAL DETAIL -->
        <div class="modal fade" id="detailTracerModal" tabindex="-1" aria-labelledby="detailTracerLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="detailTracerLabel">
                            <i class="bi bi-info-circle"></i> Detail Data Tracer Study
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <?php foreach ($groupedFields as $header => $fields): ?>

                            <?php

                            // cek apakah ada data yang terisi
                            $hasValue = false;

                            foreach ($fields as $field) {

                                $fieldName = $field['field_name'];

                                if (
                                    isset($tracer[$fieldName]) &&
                                    $tracer[$fieldName] !== '' &&
                                    $tracer[$fieldName] !== null
                                ) {
                                    $hasValue = true;
                                    break;
                                }
                            }

                            // skip section kosong
                            if (!$hasValue) {
                                continue;
                            }

                            ?>

                            <h6 class="fw-bold text-primary mb-3">
                                <?= esc($header) ?>
                            </h6>

                            <div class="row mb-4">

                                <?php foreach ($fields as $field): ?>

                                    <?php

                                    $fieldName = $field['field_name'];

                                    $value = $tracer[$fieldName] ?? null;

                                    // skip field kosong
                                    if ($value === '' || $value === null) {
                                        continue;
                                    }

                                    ?>

                                    <div class="col-md-6 mb-3">

                                        <div class="info-item">

                                            <div class="info-label">
                                                <?= esc($field['label']) ?>
                                            </div>

                                            <div class="info-value">

                                                <?php

                                                // format angka gaji / pendapatan
                                                if (
                                                    is_numeric($value) &&
                                                    (
                                                        str_contains($fieldName, 'gaji') ||
                                                        str_contains($fieldName, 'pendapatan')
                                                    )
                                                ) {

                                                    echo 'Rp ' . number_format($value, 0, ',', '.');
                                                } else {

                                                    echo nl2br(esc($value));
                                                }

                                                ?>

                                            </div>

                                        </div>

                                    </div>

                                <?php endforeach; ?>

                            </div>

                            <hr>

                        <?php endforeach; ?>

                        <div class="text-end text-muted small mt-3">
                            <em>
                                Diperbarui pada:
                                <?= date('d M Y H:i', strtotime($tracer['updated_at'] ?? $tracer['created_at'])) ?>
                            </em>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
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