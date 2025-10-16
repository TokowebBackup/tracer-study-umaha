<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <h3>Selamat Datang, <?= session('admin_nama') ?></h3>

    <!-- Key Metrics -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5>Total Alumni</h5>
                    <h3><?= $total_alumni ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5>Total Kuesioner Tracer</h5>
                    <h3><?= $total_tracer ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5>Persentase Mengisi Tracer</h5>
                    <h3><?= $persentase_tracer ?>%</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div id="pieStatus" style="height: 400px;"></div>
        </div>
        <div class="col-md-6">
            <div id="barAlumniTahun" style="height: 400px;"></div>
        </div>
    </div>

    <!-- Top Perusahaan -->
    <div class="row">
        <div class="col-md-12">
            <h5>Top 5 Perusahaan Alumni Bekerja</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Perusahaan</th>
                        <th>Jumlah Alumni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($top_perusahaan as $p): ?>
                        <tr>
                            <td><?= esc($p['institusi_bekerja']) ?></td>
                            <td><?= $p['jumlah'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('pieStatus', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Distribusi Status Pekerjaan Alumni'
        },
        series: [{
            name: 'Jumlah',
            colorByPoint: true,
            data: [{
                    name: 'Bekerja',
                    y: <?= $grafik['bekerja'] ?>
                },
                {
                    name: 'Wirausaha',
                    y: <?= $grafik['wirausaha'] ?>
                },
                {
                    name: 'Belum Bekerja',
                    y: <?= $grafik['belum_bekerja'] ?>
                },
                {
                    name: 'Studi Lanjut',
                    y: <?= $grafik['studi_lanjut'] ?>
                }
            ]
        }]
    });

    Highcharts.chart('barAlumniTahun', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Alumni Per Tahun Kelulusan'
        },
        xAxis: {
            categories: [<?= implode(',', array_map(fn($t) => "'" . $t['tahun'] . "'", $alumni_per_tahun)) ?>],
            title: {
                text: 'Tahun Kelulusan'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Alumni'
            }
        },
        series: [{
            name: 'Alumni',
            data: [<?= implode(',', array_map(fn($t) => $t['jumlah'], $alumni_per_tahun)) ?>]
        }]
    });
</script>

<?= $this->endSection() ?>