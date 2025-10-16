<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .home-header {
        padding: 50px 20px;
        width: 55%;
        margin: 0 auto;
        /* text-align: center; */
        font-family: "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
        color: #333;
    }

    .home-header h2 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 15px;
        position: relative;
        display: inline-block;
    }

    .home-header h2::after {
        content: '';
        display: block;
        width: 60%;
        margin: 8px auto 0;
        height: 3px;
        background-color: #198754;
        /* Bootstrap success */
        border-radius: 2px;
    }

    .home-header p {
        font-size: 16px;
        line-height: 1.7;
        color: #666;
    }

    .home-header p.text-muted {
        color: #555 !important;
    }

    .menu-card {
        position: relative;
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden;
    }

    .menu-card::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-image: var(--bg-image);
        background-repeat: no-repeat;
        background-position: top right;
        opacity: 0.1;
        background-size: 70px auto;
        /* opacity background image */
        pointer-events: none;
        /* supaya gak ngeblok klik */
        z-index: 0;
    }

    .menu-card>* {
        position: relative;
        z-index: 1;
    }


    .menu-card:hover {
        background: rgba(160, 160, 160, 0.1);
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 56 28' width='56' height='28'%3E%3Cpath fill='%239C92AC' fill-opacity='0.07' d='M56 26v2h-7.75c2.3-1.27 4.94-2 7.75-2zm-26 2a2 2 0 1 0-4 0h-4.09A25.98 25.98 0 0 0 0 16v-2c.67 0 1.34.02 2 .07V14a2 2 0 0 0-2-2v-2a4 4 0 0 1 3.98 3.6 28.09 28.09 0 0 1 2.8-3.86A8 8 0 0 0 0 6V4a9.99 9.99 0 0 1 8.17 4.23c.94-.95 1.96-1.83 3.03-2.63A13.98 13.98 0 0 0 0 0h7.75c2 1.1 3.73 2.63 5.1 4.45 1.12-.72 2.3-1.37 3.53-1.93A20.1 20.1 0 0 0 14.28 0h2.7c.45.56.88 1.14 1.29 1.74 1.3-.48 2.63-.87 4-1.15-.11-.2-.23-.4-.36-.59H26v.07a28.4 28.4 0 0 1 4 0V0h4.09l-.37.59c1.38.28 2.72.67 4.01 1.15.4-.6.84-1.18 1.3-1.74h2.69a20.1 20.1 0 0 0-2.1 2.52c1.23.56 2.41 1.2 3.54 1.93A16.08 16.08 0 0 1 48.25 0H56c-4.58 0-8.65 2.2-11.2 5.6 1.07.8 2.09 1.68 3.03 2.63A9.99 9.99 0 0 1 56 4v2a8 8 0 0 0-6.77 3.74c1.03 1.2 1.97 2.5 2.79 3.86A4 4 0 0 1 56 10v2a2 2 0 0 0-2 2.07 28.4 28.4 0 0 1 2-.07v2c-9.2 0-17.3 4.78-21.91 12H30zM7.75 28H0v-2c2.81 0 5.46.73 7.75 2zM56 20v2c-5.6 0-10.65 2.3-14.28 6h-2.7c4.04-4.89 10.15-8 16.98-8zm-39.03 8h-2.69C10.65 24.3 5.6 22 0 22v-2c6.83 0 12.94 3.11 16.97 8zm15.01-.4a28.09 28.09 0 0 1 2.8-3.86 8 8 0 0 0-13.55 0c1.03 1.2 1.97 2.5 2.79 3.86a4 4 0 0 1 7.96 0zm14.29-11.86c1.3-.48 2.63-.87 4-1.15a25.99 25.99 0 0 0-44.55 0c1.38.28 2.72.67 4.01 1.15a21.98 21.98 0 0 1 36.54 0zm-5.43 2.71c1.13-.72 2.3-1.37 3.54-1.93a19.98 19.98 0 0 0-32.76 0c1.23.56 2.41 1.2 3.54 1.93a15.98 15.98 0 0 1 25.68 0zm-4.67 3.78c.94-.95 1.96-1.83 3.03-2.63a13.98 13.98 0 0 0-22.4 0c1.07.8 2.09 1.68 3.03 2.63a9.99 9.99 0 0 1 16.34 0z'%3E%3C/path%3E%3C/svg%3E");
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(25, 135, 84, 0.15);
    }

    .menu-card i {
        font-size: 42px;
        color: #198754;
        transition: transform 0.3s;
    }

    .menu-card:hover i {
        transform: scale(1.1);
    }

    .menu-card strong {
        display: block;
        margin-top: 12px;
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }


    .tutorial-bar {
        background: #1e1f37;
        color: white;
        padding: 12px 20px;
        font-weight: 600;
    }

    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }

    .table-modern thead {
        background: linear-gradient(90deg, #198754, #2db598);
        color: white;
        font-weight: 600;
        font-size: 15px;
    }

    .table-modern th,
    .table-modern td {
        vertical-align: middle;
        padding: 14px;
        font-size: 14px;
        text-align: center;
    }

    .table-modern tbody tr {
        background-color: #ffffff;
        transition: background 0.3s;
    }

    .table-modern tbody tr:hover {
        background-color: #f1fdf7;
    }

    .table-modern .table-row-highlight {
        background-color: #e6f9f0 !important;
    }

    .table-modern .btn {
        font-size: 13px;
        padding: 5px 10px;
    }

    .table-modern .table-row-highlight td {
        background-color: #e6f9f0 !important;
        font-weight: 500;
        color: #198754;
    }

    @media (max-width: 768px) {
        .home-header {
            width: 100%;
            padding: 30px 15px;
        }

        .home-header h2 {
            font-size: 1.5rem;
        }

        .home-header p {
            font-size: 15px;
            line-height: 1.6;
        }

        .menu-card {
            padding: 24px 16px;
        }

        .menu-card i {
            font-size: 32px;
        }

        .menu-card strong {
            font-size: 15px;
        }
    }
</style>


<div class="position-relative overflow-hidden p-5 p-md-5 mb-5 text-center bg-light rounded-4 shadow-sm">
    <div class="col-md-8 mx-auto home-header">
        <h1 class="display-5 fw-bold text-success mb-3">
            <i class="bi bi-graph-up-arrow me-2"></i><?= esc($landing['title']) ?>
        </h1>
        <p class="fs-5 text-muted mb-3"><?= esc($landing['subtitle']) ?></p>
        <p class="text-secondary fw-semibold mb-4"><?= esc($landing['description']) ?></p>
        <a href="#survey" class="btn btn-success btn-lg px-4 rounded-pill shadow-sm">
            <i class="bi bi-pencil-square me-1"></i> Mulai Isi Kuesioner
        </a>
    </div>


    <!-- SVG Ornaments -->
    <!-- Kiri bawah -->
    <svg class="position-absolute bottom-0 start-0" width="200" height="200" viewBox="0 0 500 500" style="opacity: 0.1;">
        <circle cx="250" cy="250" r="200" fill="#d1fae5" />
    </svg>

    <!-- Kanan atas -->
    <svg class="position-absolute top-0 end-0" width="150" height="150" viewBox="0 0 500 500" style="opacity: 0.2;">
        <rect x="100" y="100" width="300" height="300" rx="100" fill="#a7f3d0" />
    </svg>

    <!-- Kiri atas -->
    <svg class="position-absolute top-0 start-0" width="120" height="120" viewBox="0 0 500 500" style="opacity: 0.2;">
        <polygon points="250,60 100,400 400,400" fill="#bbf7d0" />
    </svg>

    <!-- Kanan bawah -->
    <svg class="position-absolute bottom-0 end-0" width="220" height="220" viewBox="0 0 500 500" style="opacity: 0.1;">
        <ellipse cx="250" cy="250" rx="180" ry="120" fill="#ecfdf5" />
    </svg>
</div>

<div class="container py-4">
    <!-- Tabel Periode -->
    <div class="table-responsive mb-4">
        <table class="table table-modern text-center">
            <thead class="table-primary">
                <tr>
                    <th style="width: 40%">Periode</th>
                    <th style="width: 30%">Surat Pemberitahuan</th>
                    <th style="width: 30%">Tanggal Periode</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($periode_list as $p): ?>
                    <?php
                    $has_data = $p['file_surat'] && $p['tanggal_mulai'] && $p['tanggal_selesai'];
                    $row_class = $has_data ? 'table-row-highlight' : '';
                    ?>
                    <tr class="<?= $row_class ?>">
                        <td><?= esc($p['tahun']) ?> : Lulusan Tahun <?= esc($p['lulusan_tahun']) ?></td>
                        <td>
                            <?php if ($p['file_surat']): ?>
                                <a href="<?= base_url($p['file_surat']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                            <?php else: ?>
                                <a href="#" class="btn btn-sm btn-outline-secondary disabled">-</a>
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if ($p['tanggal_mulai'] && $p['tanggal_selesai']): ?>
                                Tanggal Pengisian : <?= date('d/m/Y', strtotime($p['tanggal_mulai'])) ?> – <?= date('d/m/Y', strtotime($p['tanggal_selesai'])) ?>
                            <?php else: ?>
                                <span class="text-muted">Belum ditentukan</span>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <!-- Menu Card -->
    <div class="row text-center mb-4 justify-content-center" id="survey">
        <div class="col-md-10 col-lg-10">
            <div class="row">
                <?php foreach ($menuItems as $item): ?>
                    <?php
                    $bg = $item['background'] ?: "none";
                    $style = " --bg-image: {$bg};";
                    ?>
                    <?php
                    $isLoggedIn = session()->get('email');
                    ?>

                    <div class="col-12 col-md-6 mb-3">
                        <?php if (!empty($item['modal'])): ?>
                            <?php if ($isLoggedIn): ?>
                                <a href="<?= base_url('alumni/dashboard') ?>" class="menu-card card p-4 h-100" style="<?= $style ?>">
                                <?php else: ?>
                                    <a href="#" class="menu-card card p-4 h-100" data-bs-toggle="modal" data-bs-target="#loginModal" style="<?= $style ?>">
                                    <?php endif; ?>
                                <?php else: ?>
                                    <a href="<?= $item['link'] ?>" class="menu-card card p-4 h-100" style="<?= $style ?>">
                                    <?php endif; ?>

                                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                        <i class="<?= esc($item['icon']) ?>"></i>
                                        <strong><?= esc($item['text']) ?></strong>
                                    </div>
                                    </a>
                    </div>

                <?php endforeach ?>
            </div>

        </div>
    </div>
</div>

<div class="container my-5">
    <div class="alert alert-success d-flex align-items-center justify-content-between flex-column flex-md-row text-start shadow-sm rounded-4 p-4">
        <div class="d-flex align-items-center mb-3 mb-md-0">
            <i class="bi bi-file-earmark-arrow-down-fill fs-2 me-3 text-success"></i>
            <div>
                <div class="fw-bold fs-5 mb-1">Panduan Pengisian Tracer Study</div>
                <small class="text-muted">Klik tombol di samping untuk mengunduh panduan lengkap dalam format PDF.</small>
            </div>
        </div>
        <a href="<?= base_url($pdfLink) ?>" class="btn btn-outline-success px-4" target="_blank">
            <i class="bi bi-download"></i> Unduh PDF
        </a>
    </div>
</div>

<?= $this->endSection() ?>