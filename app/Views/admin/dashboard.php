<?= $this->extend('layouts/admin_main') ?>
<?php
/** @var array $total_tracer */
/** @var array $total_alumni */
/** @var array $persentase_tracer */
/** @var array $top_perusahaan */
?>
<?= $this->section('content') ?>

<style>
    .dashboard-hero {
        background: linear-gradient(135deg, #006633 0%, #009966 100%);
        border-radius: 28px;
        padding: 40px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, .12);
    }

    .dashboard-hero::before {
        content: '';
        position: absolute;
        right: -80px;
        top: -80px;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
    }

    .dashboard-hero::after {
        content: '';
        position: absolute;
        left: -40px;
        bottom: -40px;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .06);
    }

    .hero-badge {
        background: rgba(255, 255, 255, .16);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border-radius: 16px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
        backdrop-filter: blur(10px);
    }

    .stats-card {
        border: none;
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
        transition: .3s ease;
        height: 100%;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .stats-card .card-body {
        padding: 28px;
    }

    .stats-icon {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        margin-bottom: 20px;
    }

    .stats-title {
        font-size: 15px;
        color: #64748b;
        margin-bottom: 10px;
    }

    .stats-number {
        font-size: 36px;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 8px;
    }

    .stats-desc {
        color: #94a3b8;
        font-size: 14px;
    }

    .card-gradient-primary {
        background: linear-gradient(135deg, #0ea5e9, #2563eb);
        color: white;
    }

    .card-gradient-success {
        background: linear-gradient(135deg, #16a34a, #059669);
        color: white;
    }

    .card-gradient-warning {
        background: linear-gradient(135deg, #f59e0b, #ea580c);
        color: white;
    }

    .chart-card {
        border: none;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
        overflow: hidden;
        background: white;
        height: 100%;
    }

    .chart-card .card-header {
        background: white;
        border-bottom: 1px solid #f1f5f9;
        padding: 24px 28px;
    }

    .chart-card .card-header h5 {
        margin: 0;
        font-weight: 700;
        color: #0f172a;
    }

    .chart-card .card-body {
        padding: 20px;
    }

    .modern-table {
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .modern-table thead th {
        border: none;
        background: #f8fafc;
        color: #475569;
        font-weight: 700;
        padding: 18px;
    }

    .modern-table tbody tr {
        background: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .04);
        transition: .25s ease;
    }

    .modern-table tbody tr:hover {
        transform: translateY(-2px);
    }

    .modern-table tbody td {
        padding: 18px;
        vertical-align: middle;
        border-top: none;
        border-bottom: none;
    }

    .modern-table tbody tr td:first-child {
        border-radius: 14px 0 0 14px;
    }

    .modern-table tbody tr td:last-child {
        border-radius: 0 14px 14px 0;
    }

    .ranking-badge {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        background: linear-gradient(135deg, #006633, #009966);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    .section-spacing {
        margin-top: 35px;
    }

    @media (max-width: 768px) {

        .dashboard-hero {
            padding: 30px;
        }

        .stats-number {
            font-size: 28px;
        }
    }
</style>

<div class="container-fluid p-4">

    <!-- HERO -->
    <div class="dashboard-hero mb-4">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <div class="hero-badge">
                    <i class="bi bi-shield-check"></i>
                    Admin Dashboard UMAHA
                </div>

                <h1 class="fw-bold mb-3">
                    Selamat Datang,
                    <?= session('admin_nama') ?>
                </h1>

                <p class="opacity-75 fs-5 mb-0">
                    Monitoring data tracer study alumni UMAHA secara real-time,
                    modern, dan terintegrasi.
                </p>

            </div>

            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

                <div class="d-inline-block bg-white bg-opacity-10 rounded-4 px-4 py-3">

                    <div class="small opacity-75">
                        Total Respon Tracer
                    </div>

                    <div class="fs-1 fw-bold">
                        <?= $total_tracer ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- STATS -->
    <div class="row g-4">

        <div class="col-md-4">

            <div class="card stats-card card-gradient-primary">

                <div class="card-body">

                    <div class="stats-icon bg-white bg-opacity-25">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <div class="stats-title text-white opacity-75">
                        Total Alumni
                    </div>

                    <div class="stats-number">
                        <?= number_format($total_alumni) ?>
                    </div>

                    <div class="stats-desc text-white opacity-75">
                        Alumni terdaftar di sistem
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card stats-card card-gradient-success">

                <div class="card-body">

                    <div class="stats-icon bg-white bg-opacity-25">
                        <i class="bi bi-bar-chart-line-fill"></i>
                    </div>

                    <div class="stats-title text-white opacity-75">
                        Total Tracer
                    </div>

                    <div class="stats-number">
                        <?= number_format($total_tracer) ?>
                    </div>

                    <div class="stats-desc text-white opacity-75">
                        Alumni sudah mengisi tracer
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card stats-card card-gradient-warning">

                <div class="card-body">

                    <div class="stats-icon bg-white bg-opacity-25">
                        <i class="bi bi-pie-chart-fill"></i>
                    </div>

                    <div class="stats-title text-white opacity-75">
                        Persentase Tracer
                    </div>

                    <div class="stats-number">
                        <?= $persentase_tracer ?>%
                    </div>

                    <div class="stats-desc text-white opacity-75">
                        Tingkat partisipasi alumni
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- CHARTS -->
    <div class="row g-4 section-spacing">

        <div class="col-lg-6">

            <div class="card chart-card">

                <div class="card-header">
                    <h5>
                        <i class="bi bi-pie-chart-fill text-success me-2"></i>
                        Distribusi Status Alumni
                    </h5>
                </div>

                <div class="card-body">
                    <div id="pieStatus" style="height: 420px;"></div>
                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="card chart-card">

                <div class="card-header">
                    <h5>
                        <i class="bi bi-bar-chart-fill text-primary me-2"></i>
                        Alumni per Tahun Kelulusan
                    </h5>
                </div>

                <div class="card-body">
                    <div id="barAlumniTahun" style="height: 420px;"></div>
                </div>

            </div>

        </div>

    </div>

    <!-- TOP PERUSAHAAN -->
    <div class="card chart-card section-spacing">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5>
                <i class="bi bi-buildings-fill text-success me-2"></i>
                Top Perusahaan Alumni
            </h5>

            <span class="badge bg-success rounded-pill px-3 py-2">
                TOP 5
            </span>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table modern-table align-middle">

                    <thead>
                        <tr>
                            <th width="80">Rank</th>
                            <th>Perusahaan</th>
                            <th width="180">Jumlah Alumni</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($top_perusahaan as $index => $p): ?>

                            <tr>

                                <td>
                                    <div class="ranking-badge">
                                        #<?= $index + 1 ?>
                                    </div>
                                </td>

                                <td>

                                    <div class="fw-bold text-dark">
                                        <?= esc($p['institusi_bekerja']) ?>
                                    </div>

                                </td>

                                <td>

                                    <span class="badge bg-success rounded-pill px-3 py-2 fs-6">
                                        <?= $p['jumlah'] ?> Alumni
                                    </span>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script src="https://code.highcharts.com/highcharts.js"></script>

<?php if (!empty($grafik)): ?>

    <script>
        Highcharts.chart('pieStatus', {

            chart: {
                type: 'pie',
                backgroundColor: 'transparent'
            },

            title: {
                text: null
            },

            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: [{
                        name: 'Bekerja',
                        y: <?= $grafik['bekerja'] ?? 0 ?>
                    },
                    {
                        name: 'Wirausaha',
                        y: <?= $grafik['wirausaha'] ?? 0 ?>
                    },
                    {
                        name: 'Belum Bekerja',
                        y: <?= $grafik['belum_bekerja'] ?? 0 ?>
                    },
                    {
                        name: 'Studi Lanjut',
                        y: <?= $grafik['studi_lanjut'] ?? 0 ?>
                    }
                ]
            }]
        });
    </script>

<?php else: ?>

    <div class="text-center py-5 text-muted">
        <i class="bi bi-pie-chart fs-1"></i>
        <p class="mt-3 mb-0">
            Belum ada data tracer untuk ditampilkan.
        </p>
    </div>

<?php endif; ?>

<?php if (!empty($alumni_per_tahun)): ?>

    <script>
        Highcharts.chart('barAlumniTahun', {

            chart: {
                type: 'column',
                backgroundColor: 'transparent'
            },

            title: {
                text: null
            },

            xAxis: {
                categories: [
                    <?= implode(',', array_map(fn($t) => "'" . $t['tahun'] . "'", $alumni_per_tahun)) ?>
                ]
            },

            series: [{
                name: 'Alumni',
                data: [
                    <?= implode(',', array_map(fn($t) => $t['jumlah'], $alumni_per_tahun)) ?>
                ]
            }]
        });
    </script>

<?php else: ?>

    <div class="text-center py-5 text-muted">
        <i class="bi bi-bar-chart fs-1"></i>
        <p class="mt-3 mb-0">
            Belum ada data alumni per tahun.
        </p>
    </div>

<?php endif; ?>

<?= $this->endSection() ?>