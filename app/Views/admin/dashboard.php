<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Selamat Datang, <?= session('admin_nama') ?></h3>
    <p>Total Alumni: <strong><?= $total_alumni ?></strong></p>
    <p>Total Kuesioner Tracer: <strong><?= $total_tracer ?></strong></p>

    <div id="grafikRekap" style="height: 400px;"></div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('grafikRekap', {
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
</script>

<?= $this->endSection() ?>