<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
/** @var array $landing */
/** @var array $menuItems */
/** @var array $periode_list */
/** @var string $pdfLink */
?>

<style>
    body {
        background: #f4f8f6;
    }

    .hero-section {
        position: relative;
        overflow: hidden;
        border-radius: 32px;
        background:
            linear-gradient(135deg,
                rgba(0, 102, 51, 0.96),
                rgba(0, 153, 102, 0.92)),
            url('https://pmb.umaha.ac.id/wp-content/uploads/2024/02/umaha.jpg');
        background-size: cover;
        background-position: center;
        padding: 90px 40px;
        color: white;
        box-shadow: 0 20px 45px rgba(0, 0, 0, .12);
    }

    .hero-section::before {
        content: '';
        position: absolute;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .06);
        top: -180px;
        right: -120px;
        pointer-events: none;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .05);
        bottom: -120px;
        left: -80px;
        pointer-events: none;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 850px;
        margin: auto;
        text-align: center;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, .15);
        backdrop-filter: blur(10px);
        padding: 10px 18px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 24px;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 18px;
    }

    .hero-subtitle {
        font-size: 1.15rem;
        opacity: .92;
        line-height: 1.8;
        margin-bottom: 35px;
    }

    .btn-hero {
        background: white;
        color: #006633;
        border: none;
        padding: 14px 34px;
        border-radius: 18px;
        font-weight: 700;
        font-size: 16px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, .1);
        transition: .3s ease;
    }

    .btn-hero:hover {
        transform: translateY(-3px);
        color: #006633;
    }

    .modern-section-title {
        font-size: 28px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .modern-section-subtitle {
        color: #64748b;
        font-size: 15px;
    }

    .modern-card {
        border: none;
        border-radius: 26px;
        overflow: hidden;
        background: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
    }

    .periode-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 14px;
    }

    .periode-table thead th {
        background: linear-gradient(135deg, #006633, #009966);
        color: white;
        padding: 18px;
        border: none;
        font-size: 14px;
        font-weight: 700;
    }

    .periode-table thead th:first-child {
        border-radius: 16px 0 0 16px;
    }

    .periode-table thead th:last-child {
        border-radius: 0 16px 16px 0;
    }

    .periode-table tbody tr {
        background: #ffffff;
        transition: .3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, .03);
    }

    .periode-table tbody tr:hover {
        transform: translateY(-2px);
        background: #f4fff9;
    }

    .periode-table td {
        padding: 22px 18px;
        vertical-align: middle;
        border: none;
    }

    .menu-modern-card {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
        padding: 40px 30px;
        background: white;
        text-decoration: none;
        display: block;
        height: 100%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        transition: .35s ease;
        border: 1px solid #edf2ef;
    }

    .menu-modern-card::before {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(0, 153, 102, .05);
        top: -80px;
        right: -60px;
    }

    .menu-modern-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 40px rgba(0, 102, 51, .12);
    }

    .menu-modern-card i {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #006633, #00a86b);
        color: white;
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        margin-bottom: 24px;
        box-shadow: 0 12px 25px rgba(0, 102, 51, .2);
    }

    .menu-modern-card h5 {
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .menu-modern-card p {
        color: #64748b;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 0;
    }

    .download-box {
        background: linear-gradient(135deg, #ffffff, #f6fffa);
        border-radius: 30px;
        padding: 35px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        border: 1px solid #edf2ef;
    }

    .download-icon {
        width: 80px;
        height: 80px;
        border-radius: 24px;
        background: linear-gradient(135deg, #006633, #00a86b);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 34px;
        box-shadow: 0 12px 24px rgba(0, 102, 51, .2);
    }

    .btn-download {
        background: linear-gradient(135deg, #006633, #00a86b);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 16px;
        font-weight: 700;
        transition: .3s ease;
    }

    .btn-download:hover {
        color: white;
        transform: translateY(-2px);
    }

    @media(max-width:768px) {

        .hero-section {
            padding: 70px 25px;
        }

        .hero-title {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .menu-modern-card {
            padding: 30px 24px;
        }
    }
</style>

<div class="container py-5">

    <!-- HERO -->
    <div class="hero-section mb-5">

        <div class="hero-content">

            <div class="hero-badge">
                <i class="bi bi-mortarboard-fill"></i>
                Universitas Maarif Hasyim Latif
            </div>

            <h1 class="hero-title">
                <?= esc($landing['title']) ?>
            </h1>

            <p class="hero-subtitle">
                <?= esc($landing['subtitle']) ?>
                <br>
                <?= esc($landing['description']) ?>
            </p>

            <a href="#survey" class="btn btn-hero">
                <i class="bi bi-pencil-square me-2"></i>
                Mulai Isi Kuesioner
            </a>

        </div>

    </div>

    <!-- PERIODE -->
    <div class="mb-5">

        <div class="mb-4">
            <h3 class="modern-section-title">
                Periode Tracer Study
            </h3>

            <div class="modern-section-subtitle">
                Informasi jadwal pengisian tracer study alumni UMAHA.
            </div>
        </div>

        <div class="modern-card p-4">

            <div class="table-responsive">

                <table class="periode-table">

                    <thead>
                        <tr>
                            <th>Periode</th>
                            <th>Surat</th>
                            <th>Tanggal Pengisian</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($periode_list as $p): ?>

                            <tr>

                                <td>
                                    <div class="fw-bold text-success">
                                        <?= esc($p['tahun']) ?>
                                    </div>

                                    <small class="text-muted">
                                        Lulusan Tahun <?= esc($p['lulusan_tahun']) ?>
                                    </small>
                                </td>

                                <td>
                                    <?php if ($p['file_surat']): ?>

                                        <a href="<?= base_url($p['file_surat']) ?>"
                                            target="_blank"
                                            class="btn btn-outline-success rounded-pill px-3">

                                            <i class="bi bi-file-earmark-pdf"></i>
                                            Lihat
                                        </a>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            Belum tersedia
                                        </span>

                                    <?php endif ?>
                                </td>

                                <td>

                                    <?php if ($p['tanggal_mulai'] && $p['tanggal_selesai']): ?>

                                        <div class="fw-semibold">
                                            <?= date('d M Y', strtotime($p['tanggal_mulai'])) ?>
                                        </div>

                                        <small class="text-muted">
                                            sampai
                                            <?= date('d M Y', strtotime($p['tanggal_selesai'])) ?>
                                        </small>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            Belum ditentukan
                                        </span>

                                    <?php endif ?>

                                </td>

                            </tr>

                        <?php endforeach ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- MENU -->
    <div class="mb-5" id="survey">

        <div class="mb-4 text-center">

            <h3 class="modern-section-title">
                Menu Tracer Study
            </h3>

            <div class="modern-section-subtitle">
                Pilih menu yang ingin Anda akses.
            </div>

        </div>

        <div class="row g-4 justify-content-center">

            <?php foreach ($menuItems as $item): ?>

                <?php
                $isLoggedIn = session()->get('email');
                ?>

                <div class="col-md-6 col-lg-5">

                    <?php if (!empty($item['modal'])): ?>

                        <?php if ($isLoggedIn): ?>

                            <a href="<?= base_url('alumni/dashboard') ?>"
                                class="menu-modern-card">

                            <?php else: ?>

                                <a href="#"
                                    class="menu-modern-card"
                                    data-bs-toggle="modal"
                                    data-bs-target="#loginModal">

                                <?php endif; ?>

                            <?php else: ?>

                                <a href="<?= $item['link'] ?>"
                                    class="menu-modern-card">

                                <?php endif; ?>

                                <i class="<?= esc($item['icon']) ?>"></i>

                                <h5>
                                    <?= esc($item['text']) ?>
                                </h5>

                                <p>
                                    Akses fitur <?= esc($item['text']) ?>
                                    untuk pengelolaan data tracer study alumni UMAHA.
                                </p>

                                </a>

                </div>

            <?php endforeach ?>

        </div>

    </div>

    <!-- DOWNLOAD -->
    <div class="download-box">

        <div class="row align-items-center">

            <div class="col-md-8">

                <div class="d-flex align-items-start gap-4">

                    <div class="download-icon">
                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                    </div>

                    <div>

                        <h4 class="fw-bold mb-2">
                            Panduan Pengisian Tracer Study
                        </h4>

                        <p class="text-muted mb-0">
                            Unduh panduan resmi tracer study UMAHA dalam format PDF
                            untuk membantu proses pengisian data alumni.
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4 text-md-end mt-4 mt-md-0">

                <a href="<?= base_url($pdfLink) ?>"
                    target="_blank"
                    class="btn btn-download">

                    <i class="bi bi-download me-2"></i>
                    Unduh PDF
                </a>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>