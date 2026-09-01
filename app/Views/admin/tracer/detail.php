<?= $this->extend('layouts/admin_main') ?>

<?php
/** @var array $tracer */
/** @var array $group_fields */
/** @var array $groupedFields */
?>

<?= $this->section('content') ?>

<style>
    .page-hero {

        background:
            linear-gradient(135deg,
                #006633 0%,
                #009966 100%);

        border-radius: 30px;

        padding: 40px;

        color: white;

        position: relative;

        overflow: hidden;

        box-shadow:
            0 15px 40px rgba(0, 0, 0, .08);
    }

    .page-hero::before {

        content: '';

        position: absolute;

        width: 260px;
        height: 260px;

        border-radius: 50%;

        background: rgba(255, 255, 255, .08);

        top: -80px;
        right: -80px;
    }

    .page-hero h3 {

        font-weight: 800;

        margin-bottom: 10px;

        position: relative;
        z-index: 2;
    }

    .page-hero p {

        opacity: .9;

        margin-bottom: 0;

        position: relative;
        z-index: 2;
    }

    .glass-card {

        background: rgba(255, 255, 255, .92);

        backdrop-filter: blur(14px);

        border-radius: 28px;

        overflow: hidden;

        border: 1px solid rgba(255, 255, 255, .25);

        box-shadow:
            0 10px 35px rgba(0, 0, 0, .05);
    }

    .btn-modern {

        border: none;

        border-radius: 16px;

        padding: 12px 22px;

        font-weight: 700;

        transition: .25s ease;
    }

    .btn-modern:hover {

        transform: translateY(-2px);
    }

    .btn-back {

        background: #f1f5f9;

        color: #334155;
    }

    .btn-back:hover {

        background: #e2e8f0;

        color: #0f172a;
    }

    .btn-edit {

        background:
            linear-gradient(135deg,
                #006633 0%,
                #009966 100%);

        color: white;
    }

    .btn-edit:hover {

        color: white;

        box-shadow:
            0 10px 24px rgba(0, 153, 102, .25);
    }

    .profile-section {

        padding: 35px;

        border-bottom: 1px solid #eef2f7;
    }

    .profile-grid {

        display: grid;

        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));

        gap: 20px;
    }

    .profile-card {

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        border-radius: 22px;

        padding: 24px;

        transition: .25s ease;
    }

    .profile-card:hover {

        background: #f0fdf4;

        border-color: rgba(0, 153, 102, .2);
    }

    .profile-label {

        font-size: 12px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .5px;

        color: #64748b;

        margin-bottom: 10px;
    }

    .profile-value {

        font-size: 15px;

        font-weight: 700;

        color: #0f172a;

        line-height: 1.7;
    }

    .section-wrapper {

        padding: 35px;
    }

    .section-title {

        display: inline-flex;

        align-items: center;

        gap: 10px;

        background:
            linear-gradient(135deg,
                rgba(0, 102, 51, .08),
                rgba(0, 153, 102, .12));

        color: #006633;

        padding: 12px 18px;

        border-radius: 18px;

        font-weight: 800;

        margin-bottom: 25px;

        font-size: 16px;
    }

    .field-card {

        background: #ffffff;

        border: 1px solid #eef2f7;

        border-radius: 22px;

        padding: 22px;

        height: 100%;

        transition: .25s ease;

        position: relative;

        overflow: hidden;
    }

    .field-card::before {

        content: '';

        position: absolute;

        top: 0;
        left: 0;

        width: 100%;
        height: 4px;

        background:
            linear-gradient(135deg,
                #006633,
                #009966);
    }

    .field-card:hover {

        transform: translateY(-3px);

        box-shadow:
            0 12px 28px rgba(0, 0, 0, .05);

        border-color: rgba(0, 153, 102, .18);
    }

    .field-label {

        font-size: 12px;

        text-transform: uppercase;

        letter-spacing: .6px;

        font-weight: 700;

        color: #64748b;

        margin-bottom: 12px;
    }

    .field-value {

        font-size: 15px;

        font-weight: 600;

        color: #0f172a;

        line-height: 1.8;

        word-break: break-word;
    }

    .updated-box {

        border-top: 1px solid #eef2f7;

        padding: 22px 35px;

        background: #f8fafc;

        color: #64748b;

        font-size: 13px;

        display: flex;

        justify-content: end;

        align-items: center;
    }

    .empty-state {

        padding: 70px 30px;

        text-align: center;

        color: #64748b;
    }

    .empty-state i {

        font-size: 60px;

        margin-bottom: 20px;

        display: block;

        color: #cbd5e1;
    }

    @media(max-width:768px) {

        .page-hero {

            padding: 30px 24px;
        }

        .profile-section,
        .section-wrapper {

            padding: 25px;
        }

        .updated-box {

            padding: 20px 25px;

            justify-content: start;
        }
    }
</style>

<div class="container-fluid p-4">

    <!-- HERO -->
    <div class="page-hero mb-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>

                <h3>
                    <i class="bi bi-person-lines-fill me-2"></i>
                    Detail Tracer Study Alumni
                </h3>

                <p>
                    Detail lengkap data tracer study alumni UMAHA
                </p>

            </div>

            <div class="d-flex gap-2 mt-3 mt-md-0">

                <a href="<?= base_url('admin/tracer') ?>"
                    class="btn btn-light rounded-4 px-4 py-2 fw-semibold">

                    <i class="bi bi-arrow-left me-2"></i>
                    Kembali

                </a>

                <a href="<?= base_url('alumni/tracer/edit') ?>"
                    class="btn btn-dark rounded-4 px-4 py-2 fw-semibold">

                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Data

                </a>

            </div>

        </div>

    </div>

    <?php if ($tracer): ?>

        <div class="glass-card">

            <!-- PROFILE -->
            <div class="profile-section">

                <div class="profile-grid">

                    <div class="profile-card">

                        <div class="profile-label">
                            Nama Alumni
                        </div>

                        <div class="profile-value">
                            <?= esc($tracer['nama']) ?>
                        </div>

                    </div>

                    <div class="profile-card">

                        <div class="profile-label">
                            NIM
                        </div>

                        <div class="profile-value">
                            <?= esc($tracer['nim']) ?>
                        </div>

                    </div>

                    <div class="profile-card">

                        <div class="profile-label">
                            Email
                        </div>

                        <div class="profile-value">
                            <?= esc($tracer['email']) ?>
                        </div>

                    </div>

                    <div class="profile-card">

                        <div class="profile-label">
                            Program Studi
                        </div>

                        <div class="profile-value">
                            <?= esc($tracer['nama_prodi']) ?>
                        </div>

                    </div>

                    <div class="profile-card">

                        <div class="profile-label">
                            Jenjang
                        </div>

                        <div class="profile-value">
                            <?= esc($tracer['jenjang']) ?>
                        </div>

                    </div>

                </div>

            </div>

            <!-- GROUPED FIELDS -->
            <?php foreach ($groupedFields as $header => $fields): ?>

                <div class="section-wrapper">

                    <div class="section-title">

                        <i class="bi bi-ui-checks-grid"></i>

                        <?= esc($header) ?>

                    </div>

                    <div class="row g-4">

                        <?php foreach ($fields as $field): ?>

                            <?php

                            $fieldName = $field['field_name'];

                            // ========================================
                            // SKIP FIELD YANG SUDAH ADA DI PROFILE
                            // ========================================

                            $skipFields = [
                                'nama',
                                'nim',
                                'program_studi'
                            ];

                            if (in_array($fieldName, $skipFields)) {
                                continue;
                            }

                            // ========================================
                            // VALUE
                            // ========================================

                            $value = $tracer[$fieldName] ?? '-';

                            if (
                                is_string($value) &&
                                trim($value) === ''
                            ) {
                                $value = '-';
                            }

                            ?>

                            <div class="col-md-6">

                                <div class="field-card">

                                    <div class="field-label">

                                        <?= esc($field['label']) ?>

                                    </div>

                                    <div class="field-value">

                                        <?php

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

                </div>

            <?php endforeach; ?>

            <!-- FOOTER -->
            <div class="updated-box">

                <i class="bi bi-clock-history me-2"></i>

                Diperbarui :
                <?= date('d M Y H:i', strtotime($tracer['updated_at'] ?? $tracer['created_at'])) ?>

            </div>

        </div>

    <?php else: ?>

        <div class="glass-card">

            <div class="empty-state">

                <i class="bi bi-database-fill-x"></i>

                <h5 class="fw-bold mb-3">
                    Data Tracer Study Belum Tersedia
                </h5>

                <p class="mb-4">
                    Alumni belum mengisi data tracer study.
                </p>

                <a href="<?= base_url('alumni/tracer/create') ?>"
                    class="btn btn-success rounded-4 px-4 py-2">

                    Isi Data Sekarang

                </a>

            </div>

        </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>