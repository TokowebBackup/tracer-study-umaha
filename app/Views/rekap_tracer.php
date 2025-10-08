<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
            <h3 class="fw-bold text-success mb-1">📊 Rekap Tracer Study Alumni</h3>
            <small class="text-muted">Laporan statistik berdasarkan hasil kuesioner alumni</small>
        </div>
    </div>

    <form method="get" class="row g-3 mb-5">
        <div class="col-md-4">
            <label class="form-label fw-semibold">Filter Tahun</label>
            <select class="form-select" name="tahun">
                <option value="">Semua Tahun</option>
                <?php foreach ($tahun_list as $t): ?>
                    <option value="<?= $t['tahun_pengisian'] ?>" <?= ($filter_tahun == $t['tahun_pengisian']) ? 'selected' : '' ?>>
                        <?= $t['tahun_pengisian'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">Filter Program Studi</label>
            <select class="form-select" name="prodi">
                <option value="">Semua Prodi</option>
                <?php foreach ($prodi_list as $p): ?>
                    <option value="<?= $p['nama_prodi'] ?>" <?= ($filter_prodi == $p['nama_prodi']) ? 'selected' : '' ?>>
                        <?= $p['nama_prodi'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-4 align-self-end">
            <button class="btn btn-success w-100 fw-semibold"><i class="bi bi-funnel-fill me-1"></i> Tampilkan</button>
        </div>
    </form>

    <?php
    $grafik = [
        'Rekap Prodi' => ['rekap_prodi', 'nama_prodi'],
        'Jenis Kelamin' => ['rekap_jk', 'jenis_kelamin'],
        'Tahun Lulus' => ['rekap_lulus', 'tahun_lulus'],
        'Status Pekerjaan' => ['rekap_status', 'status_pekerjaan'],
        'Sumber Dana' => ['rekap_sumberdana', 'sumber_dana'],
        'Program Studi' => ['rekap_prodi', 'nama_prodi'],
        'Jenjang' => ['rekap_jenjang', 'jenjang'],
        'Tahun Masuk' => ['rekap_terdaftar', 'tahun_masuk'],
        'Tempat Kerja (Kabupaten)' => ['rekap_kabupaten', 'kabupaten'],
        'Sektor Tempat Kerja' => ['rekap_sektor', 'sektor'],
        'Kesesuaian Bidang' => ['rekap_sesuai', 'sesuai'],
        'Kerja Sebelum Lulus' => ['rekap_sebelum_lulus', 'sebelum_lulus'],
        'Relevansi Kurikulum' => ['rekap_relevansi', 'relevansi_kurikulum'],
    ];
    ?>

    <?php foreach ($grafik as $judul => [$var, $key]): ?>
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light border-bottom d-flex justify-content-between align-items-center">
                <div class="fw-semibold text-dark"><i class="bi bi-pie-chart-fill text-success me-2"></i> Persentase Berdasarkan <?= $judul ?></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th><?= $judul ?></th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($$var as $i => $row): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= esc($row[$key]) ?></td>
                                        <td><?= $row['total'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div id="chart-<?= $key ?>" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>

    <!-- Waktu Mendapatkan Pekerjaan -->
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-light border-bottom fw-semibold text-dark">
            <i class="bi bi-clock-history text-success me-2"></i> Persentase Berdasarkan Rata-rata Waktu Mendapatkan Pekerjaan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Sebelum Lulus</h6>
                    <table class="table table-sm table-bordered mb-3">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Kategori (bulan)</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rekap_bulan_sebelum as $i => $row): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($row['kategori']) ?></td>
                                    <td><?= $row['total'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <div id="chart-sebelum" style="height: 300px;"></div>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3">Setelah Lulus</h6>
                    <table class="table table-sm table-bordered mb-3">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Kategori (bulan)</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rekap_bulan_setelah as $i => $row): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($row['kategori']) ?></td>
                                    <td><?= $row['total'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <div id="chart-setelah" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    <?php foreach ($grafik as $judul => [$var, $key]): ?>
        Highcharts.chart('chart-<?= $key ?>', {
            chart: {
                type: 'pie'
            },
            title: {
                text: ''
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: <?= json_encode(array_map(fn($d) => ['name' => $d[$key], 'y' => (int)$d['total']], $$var)) ?>
            }]
        });
    <?php endforeach ?>

    Highcharts.chart('chart-sebelum', {
        chart: {
            type: 'pie'
        },
        title: {
            text: ''
        },
        series: [{
            name: 'Jumlah',
            colorByPoint: true,
            data: <?= json_encode(array_map(fn($r) => ['name' => $r['kategori'] . ' bulan', 'y' => (int)$r['total']], $rekap_bulan_sebelum)) ?>
        }]
    });

    Highcharts.chart('chart-setelah', {
        chart: {
            type: 'pie'
        },
        title: {
            text: ''
        },
        series: [{
            name: 'Jumlah',
            colorByPoint: true,
            data: <?= json_encode(array_map(fn($r) => ['name' => $r['kategori'] . ' bulan', 'y' => (int)$r['total']], $rekap_bulan_setelah)) ?>
        }]
    });
</script>

<?= $this->endSection() ?>