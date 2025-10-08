<!-- app/Views/rekap_pengguna.php -->
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
            <h3 class="fw-bold text-success mb-1">ðŸ“Š Rekap Pengguna Lulusan UMAHA</h3>
            <small class="text-muted">Laporan statistik berdasarkan hasil kuesioner alumni</small>
        </div>
    </div>

    <form method="get" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Filter Tahun</label>
            <select name="tahun" class="form-select">
                <option value="">Semua Tahun</option>
                <?php foreach ($tahun_list as $t): ?>
                    <option value="<?= $t['tahun_merekrut'] ?>" <?= $filter_tahun == $t['tahun_merekrut'] ? 'selected' : '' ?>>
                        <?= $t['tahun_merekrut'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" value="<?= esc($filter_nama) ?>" class="form-control" placeholder="Ketik sebagian nama...">
        </div>
        <div class="col-md-4 align-self-end">
            <button class="btn btn-primary w-100">Tampilkan</button>
        </div>
    </form>

    <div class="card mb-5 shadow-sm border-0 rounded-4 animate-fade">
        <div class="card-header bg-gradient-to-r from-success to-teal text-dark rounded-top-4 fw-semibold">
            Persentase Berdasarkan Prodi
        </div>
        <div class="card-body bg-white">
            <div class="row">
                <div class="col-md-6">
                    <!-- Tabel Data -->
                    <div class="table-responsive">
                        <table class="table table-modern small mb-3" id="table-prodi">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Program Studi</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rekap_prodi as $i => $row): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= esc($row['nama_prodi']) ?></td>
                                        <td><?= $row['total'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Chart -->
                    <div id="chart-prodi" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jenjang -->
    <div class="card mb-5 shadow-sm border-0 rounded-4 animate-fade">
        <div class="card-header bg-gradient-to-r from-success to-teal text-dark rounded-top-4 fw-semibold">
            Persentase Berdasarkan Jenjang
        </div>
        <div class="card-body bg-white">
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-modern small mb-3" id="table-jenjang">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Jenjang</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rekap_jenjang as $i => $row): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= esc($row['jenjang']) ?></td>
                                        <td><?= $row['total'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="chart-jenjang" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lembaga -->
    <div class="card mb-5 shadow-sm border-0 rounded-4 animate-fade">
        <div class="card-header bg-gradient-to-r from-success to-teal text-dark rounded-top-4 fw-semibold">
            Persentase Berdasarkan Lembaga
        </div>
        <div class="card-body bg-white">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-modern small mb-3" id="table-lembaga">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Lembaga</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rekap_lembaga as $i => $row): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($row['lembaga']) ?></td>
                                    <td><?= $row['total'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <div id="chart-lembaga" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tahun lulus -->
    <div class="card mb-5 shadow-sm border-0 rounded-4 animate-fade">
        <div class="card-header bg-gradient-to-r from-success to-teal text-dark rounded-top-4 fw-semibold">
            Persentase Berdasarkan Tahun Lulus
        </div>
        <div class="card-body bg-white">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-modern small mb-3" id="table-lulus">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Tahun Lulus</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rekap_lulus as $i => $row): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($row['tahun_lulus']) ?></td>
                                    <td><?= $row['total'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <div id="chart-lulus" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Provinsi & Kota -->
    <div class="card mb-5 shadow-sm border-0 rounded-4 animate-fade">
        <div class="card-header bg-gradient-to-r from-success to-teal text-dark rounded-top-4 fw-semibold">
            Persentase Berdasarkan Provinsi dan Kota
        </div>
        <div class="card-body bg-white">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-modern small mb-3" id="table-wilayah">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Provinsi & Kota</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rekap_wilayah as $i => $row): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($row['provinsi_kota']) ?></td>
                                    <td><?= $row['total'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <div id="chart-wilayah" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tahun terdaftar -->
    <div class="card mb-5 shadow-sm border-0 rounded-4 animate-fade">
        <div class="card-header bg-gradient-to-r from-success to-teal text-dark rounded-top-4 fw-semibold">
            Persentase Berdasarkan Tahun Terdaftar di Institusi
        </div>
        <div class="card-body bg-white">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-modern small mb-3" id="table-terdaftar">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Tahun Masuk</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rekap_terdaftar as $i => $row): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($row['tahun_masuk']) ?></td>
                                    <td><?= $row['total'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <div id="chart-terdaftar" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mb-5 shadow-sm border-0 rounded-4 animate-fade">
        <div class="card-header bg-gradient-to-r from-success to-teal text-dark rounded-top-4 fw-semibold">
            Penilaian Pengguna terhadap Lulusan UMAHA
        </div>
        <div class="card-body bg-white">
            <div id="grafikPengguna" style="height: 400px;"></div>
        </div>
    </div>

    <!-- Kondisi saat ini -->
    <div class="card mb-5 shadow-sm border-0 rounded-4 animate-fade">
        <div class="card-header bg-gradient-to-r from-success to-teal text-dark rounded-top-4 fw-semibold">
            Persentase Berdasarkan Kondisi Saat Ini
        </div>
        <div class="card-body bg-white">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-modern small mb-3" id="table-kondisi">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Kondisi</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rekap_kondisi as $i => $row): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($row['status_pekerjaan']) ?></td>
                                    <td><?= $row['total'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <div id="chart-kondisi" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Script -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    $(function() {
        $('#tabelPengguna').DataTable();
        // Prodi
        Highcharts.chart('chart-prodi', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Distribusi Berdasarkan Program Studi'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: ''
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: <?= json_encode(array_map(function($d) { return [
                            'name' => $d['nama_prodi'],
                            'y' => (int) $d['total']
                        ];
                    
                }, $rekap_prodi)) ?>
            }]
        });

        // Jenjang
        Highcharts.chart('chart-jenjang', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Distribusi Berdasarkan Jenjang'
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: <?= json_encode(array_map(function($d) { 
                        return [
                            'name' => $d['jenjang'],
                            'y' => (int) $d['total']
                        ];
                        }, $rekap_jenjang)) ?>
            }]
        });

        // Lembaga
        Highcharts.chart('chart-lembaga', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Distribusi Berdasarkan Lembaga'
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: <?= json_encode(array_map(function($d) { 
                    return [
                            'name' => $d['lembaga'],
                            'y' => (int) $d['total']
                        ];
                        }, $rekap_lembaga)) ?>
            }]
        });

        // Tahun Lulus
        Highcharts.chart('chart-lulus', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Distribusi Berdasarkan Tahun Lulus'
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: <?= json_encode(array_map(function($d) { 
                    return [
                            'name' => $d['tahun_lulus'],
                            'y' => (int) $d['total']
                        ];
                        }, $rekap_lulus)) ?>
            }]
        });

        // Provinsi & Kota
        Highcharts.chart('chart-wilayah', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Distribusi Berdasarkan Wilayah'
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: <?= json_encode(array_map(function($d) { 
                    return [
                            'name' => $d['provinsi_kota'],
                            'y' => (int) $d['total']
                        ];
                        }, $rekap_wilayah)) ?>
            }]
        });

        // Tahun Terdaftar
        Highcharts.chart('chart-terdaftar', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Distribusi Berdasarkan Tahun Masuk'
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: <?= json_encode(array_map(function($d) { 
                    return [
                            'name' => $d['tahun_masuk'],
                            'y' => (int) $d['total']
                        ];
                        }, $rekap_terdaftar)) ?>
            }]
        });

        // Kondisi Saat Ini
        Highcharts.chart('chart-kondisi', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Distribusi Berdasarkan Kondisi Saat Ini'
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: <?= json_encode(array_map(function($d) { 
                    return [
                            'name' => $d['status_pekerjaan'],
                            'y' => (int) $d['total']
                        ];
                        }, $rekap_kondisi)) ?>
            }]
        });

        Highcharts.chart('grafikPengguna', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Penilaian Pengguna terhadap Lulusan UMAHA'
            },
            xAxis: {
                categories: ['Etika', 'Profesional', 'Bahasa Asing', 'IT', 'Komunikasi', 'Kerja Sama', 'Pengembangan Diri'],
                crosshair: true
            },
            yAxis: {
                min: 0,
                max: 5,
                title: {
                    text: 'Rata-rata Skor (1–5)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Skor Rata-rata',
                data: [
                    <?= number_format(array_sum(array_column($list, 'etika_kerja')) / max(count($list),1),2) ?>,
                    <?= number_format(array_sum(array_column($list, 'keahlian_profesional')) / max(count($list),1),2) ?>,
                    <?= number_format(array_sum(array_column($list, 'penguasaan_bahasa_asing')) / max(count($list),1),2) ?>,
                    <?= number_format(array_sum(array_column($list, 'teknologi_informasi')) / max(count($list),1),2) ?>,
                    <?= number_format(array_sum(array_column($list, 'komunikasi')) / max(count($list),1),2) ?>,
                    <?= number_format(array_sum(array_column($list, 'kerjasama')) / max(count($list),1),2) ?>,
                    <?= number_format(array_sum(array_column($list, 'pengembangan_diri')) / max(count($list),1),2) ?>
                ]
            }]
        });

    });
</script>

<?= $this->endSection() ?>