<?= $this->extend('layouts/admin_main') ?>
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

    .table-modern {

        width: 100%;

        min-width: 1250px;

        margin-bottom: 0;
    }

    .table-modern thead {

        background:
            linear-gradient(135deg,
                #0f172a,
                #1e293b);

        color: white;
    }

    .table-modern thead th {

        border: none !important;

        padding: 18px 16px;

        font-size: 12px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .6px;

        vertical-align: middle;

        white-space: nowrap;
    }

    .table-modern tbody td {

        padding: 18px 16px;

        vertical-align: middle;

        border-color: #eef2f7;

        font-size: 13px;
    }

    .table-modern tbody tr {

        transition: .25s ease;
    }

    .table-modern tbody tr:hover {

        background: #f0fdf4;
    }

    .badge-number {

        background: rgba(0, 153, 102, .12);

        color: #009966;

        border-radius: 30px;

        padding: 7px 14px;

        font-size: 12px;

        font-weight: 700;

        display: inline-flex;

        align-items: center;

        justify-content: center;
    }

    .company-box {

        display: flex;

        flex-direction: column;
    }

    .company-name {

        font-size: 14px;

        font-weight: 700;

        color: #0f172a;

        line-height: 1.6;
    }

    .company-sub {

        font-size: 12px;

        color: #64748b;
    }

    .person-box {

        display: flex;

        flex-direction: column;
    }

    .person-name {

        font-size: 13px;

        font-weight: 700;

        color: #1e293b;
    }

    .person-job {

        font-size: 12px;

        color: #64748b;
    }

    .contact-box {

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        padding: 12px 14px;

        border-radius: 16px;

        display: flex;

        flex-direction: column;

        gap: 6px;
    }

    .contact-item {

        font-size: 12px;

        font-weight: 600;

        color: #334155;

        line-height: 1.6;
    }

    .contact-item i {

        color: #009966;
    }

    .tahun-badge {

        background: rgba(59, 130, 246, .12);

        color: #2563eb;

        border-radius: 30px;

        padding: 8px 14px;

        font-size: 12px;

        font-weight: 700;

        display: inline-flex;

        align-items: center;
    }

    .rekrut-badge {

        background: rgba(168, 85, 247, .12);

        color: #7c3aed;

        border-radius: 30px;

        padding: 8px 14px;

        font-size: 12px;

        font-weight: 700;

        display: inline-flex;

        align-items: center;

        gap: 6px;
    }

    .dataTables_wrapper {

        padding: 22px;
    }

    .dataTables_wrapper .dataTables_filter input {

        border-radius: 14px;

        border: 1px solid #dbe2ea;

        padding: 8px 14px;

        font-size: 13px;

        margin-left: 10px;
    }

    .dataTables_wrapper .dataTables_length select {

        border-radius: 12px;

        border: 1px solid #dbe2ea;

        padding: 6px 10px;

        font-size: 13px;
    }

    .dataTables_info,
    .dataTables_paginate {

        margin-top: 14px;

        font-size: 13px;
    }

    .table-responsive {

        overflow-x: auto;

        scrollbar-width: thin;
    }

    .table-responsive::-webkit-scrollbar {

        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-thumb {

        background: rgba(0, 102, 51, .25);

        border-radius: 20px;
    }

    @media(max-width:768px) {

        .page-hero {

            padding: 30px 24px;
        }

        .table-modern {

            min-width: 1200px;
        }
    }
</style>

<div class="container-fluid p-4">

    <!-- HERO -->
    <div class="page-hero mb-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>

                <h3>
                    <i class="bi bi-buildings-fill me-2"></i>
                    Data Pengguna Lulusan
                </h3>

                <p>
                    Monitoring data perusahaan pengguna lulusan alumni UMAHA
                </p>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="glass-card">

        <div class="table-responsive">

            <table class="table table-modern align-middle"
                id="tabelPengguna">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Perusahaan</th>

                        <th>Pengisi</th>

                        <th>Kontak</th>

                        <th>Tahun</th>

                        <th>Jumlah Rekrut</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($list)): ?>

                        <?php foreach ($list as $i => $row): ?>

                            <tr>

                                <td>

                                    <span class="badge-number">

                                        #<?= $i + 1 ?>

                                    </span>

                                </td>

                                <td>

                                    <div class="company-box">

                                        <div class="company-name">

                                            <?= esc($row['nama_perusahaan']) ?>

                                        </div>

                                        <div class="company-sub">

                                            Perusahaan Pengguna Alumni

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <div class="person-box">

                                        <div class="person-name">

                                            <?= esc($row['nama_pengisi']) ?>

                                        </div>

                                        <div class="person-job">

                                            <?= esc($row['jabatan_pengisi']) ?>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <div class="contact-box">

                                        <div class="contact-item">

                                            <i class="bi bi-envelope-fill me-2"></i>

                                            <?= esc($row['email_pengisi']) ?>

                                        </div>

                                        <div class="contact-item">

                                            <i class="bi bi-telephone-fill me-2"></i>

                                            <?= esc($row['no_telp_pengisi']) ?>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <span class="tahun-badge">

                                        <?= esc($row['tahun_merekrut']) ?>

                                    </span>

                                </td>

                                <td>

                                    <span class="rekrut-badge">

                                        <i class="bi bi-people-fill"></i>

                                        <?= esc($row['jumlah_lulusan_direkrut']) ?>

                                        Lulusan

                                    </span>

                                </td>

                            </tr>

                        <?php endforeach ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="6"
                                class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-database-fill-x fs-1 d-block mb-3"></i>

                                    Belum ada data pengguna lulusan.

                                </div>

                            </td>

                        </tr>

                    <?php endif ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<link rel="stylesheet"
    href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(function() {

        $('#tabelPengguna').DataTable({

            responsive: true,

            pageLength: 10,

            language: {

                search: "_INPUT_",
                searchPlaceholder: "Cari perusahaan atau pengisi...",

                lengthMenu: "Tampilkan _MENU_ data",

                zeroRecords: "Data tidak ditemukan",

                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",

                paginate: {

                    previous: "‹",
                    next: "›"
                }
            }
        });

    });
</script>

<?= $this->endSection() ?>