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

        width: 280px;
        height: 280px;

        border-radius: 50%;

        background: rgba(255, 255, 255, .08);

        top: -100px;
        right: -80px;
    }

    .page-hero h3 {

        font-size: 2rem;

        font-weight: 800;

        margin-bottom: 10px;

        position: relative;

        z-index: 2;
    }

    .page-hero p {

        opacity: .9;

        margin-bottom: 0;

        font-size: 15px;

        position: relative;

        z-index: 2;
    }

    .btn-modern {

        border: none;

        border-radius: 18px;

        padding: 12px 22px;

        font-weight: 700;

        transition: .25s ease;
    }

    .btn-modern:hover {

        transform: translateY(-2px);
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

        min-width: 1450px;

        margin-bottom: 0;

        table-layout: auto;
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

    /* Column Width */
    .col-no {

        width: 70px;

        min-width: 70px;
    }

    .col-nim {

        width: 180px;

        min-width: 180px;
    }

    .col-nama {

        width: 260px;

        min-width: 260px;
    }

    .col-prodi {

        width: 220px;

        min-width: 220px;
    }

    .col-tahun {

        width: 140px;

        min-width: 140px;
    }

    .col-email {

        width: 280px;

        min-width: 280px;
    }

    .col-hp {

        width: 190px;

        min-width: 190px;
    }

    .col-action {

        width: 220px;

        min-width: 220px;
    }

    .badge-number {

        background: rgba(0, 153, 102, .12);

        color: #009966;

        border-radius: 30px;

        padding: 7px 14px;

        font-size: 12px;

        font-weight: 700;
    }

    .nim-box {

        display: inline-block;

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        border-radius: 12px;

        padding: 10px 14px;

        font-family: monospace;

        font-size: 13px;

        font-weight: 700;

        color: #0f172a;
    }

    .alumni-name {

        font-weight: 700;

        font-size: 14px;

        color: #0f172a;
    }

    .prodi-badge {

        display: inline-flex;

        align-items: center;

        gap: 6px;

        background: rgba(59, 130, 246, .12);

        color: #2563eb;

        border-radius: 30px;

        padding: 8px 14px;

        font-size: 12px;

        font-weight: 700;
    }

    .tahun-badge {

        display: inline-flex;

        align-items: center;

        gap: 6px;

        background: rgba(168, 85, 247, .12);

        color: #9333ea;

        border-radius: 30px;

        padding: 8px 14px;

        font-size: 12px;

        font-weight: 700;
    }

    .contact-info {

        font-size: 13px;

        color: #334155;

        line-height: 1.7;

        word-break: break-word;
    }

    .action-group {

        display: flex;

        align-items: center;

        gap: 10px;
    }

    .btn-action {

        width: 42px;
        height: 42px;

        border-radius: 14px;

        display: flex;

        align-items: center;
        justify-content: center;

        border: none;

        transition: .25s ease;
    }

    .btn-edit {

        background: rgba(245, 158, 11, .12);

        color: #d97706;
    }

    .btn-edit:hover {

        background: #f59e0b;

        color: white;

        transform: translateY(-2px);
    }

    .btn-detail {

        background: rgba(14, 165, 233, .12);

        color: #0284c7;
    }

    .btn-detail:hover {

        background: #0ea5e9;

        color: white;

        transform: translateY(-2px);
    }

    .btn-delete {

        background: rgba(239, 68, 68, .12);

        color: #dc2626;
    }

    .btn-delete:hover {

        background: #dc2626;

        color: white;

        transform: translateY(-2px);
    }

    /* DataTables */
    .dataTables_wrapper {

        padding: 24px;
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

    /* Scroll */
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

            min-width: 1350px;
        }

        .table-modern thead th,
        .table-modern tbody td {

            padding: 14px 12px;
        }
    }
</style>

<div class="container-fluid p-4">

    <!-- HERO -->
    <div class="page-hero mb-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>

                <h3>
                    <i class="bi bi-mortarboard-fill me-2"></i>
                    Data Alumni
                </h3>

                <p>
                    Manajemen data alumni tracer study Universitas Maarif Hasyim Latif
                </p>

            </div>

            <div class="mt-3 mt-md-0">

                <a href="<?= base_url('admin/alumni/add') ?>"
                    class="btn btn-light rounded-4 px-4 py-2 fw-semibold">

                    <i class="bi bi-plus-circle-fill me-2"></i>
                    Tambah Alumni

                </a>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="glass-card">

        <div class="table-responsive">

            <table class="table table-modern align-middle"
                id="tabelAlumni">

                <thead>

                    <tr>

                        <th class="col-no">
                            #
                        </th>

                        <th class="col-nim">
                            NIM
                        </th>

                        <th class="col-nama">
                            Nama
                        </th>

                        <th class="col-prodi">
                            Prodi
                        </th>

                        <th class="col-tahun">
                            Tahun Lulus
                        </th>

                        <th class="col-email">
                            Email
                        </th>

                        <th class="col-hp">
                            No HP
                        </th>

                        <th class="col-action">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($list as $i => $row): ?>

                        <tr>

                            <td>

                                <span class="badge-number">

                                    #<?= $i + 1 ?>

                                </span>

                            </td>

                            <td>

                                <div class="nim-box">

                                    <?= esc($row['nim']) ?>

                                </div>

                            </td>

                            <td>

                                <div class="alumni-name">

                                    <?= esc($row['nama']) ?>

                                </div>

                            </td>

                            <td>

                                <span class="prodi-badge">

                                    <i class="bi bi-book-half"></i>

                                    <?= esc($row['nama_prodi']) ?>

                                </span>

                            </td>

                            <td>

                                <span class="tahun-badge">

                                    <i class="bi bi-calendar-event"></i>

                                    <?= esc($row['tahun_lulus']) ?>

                                </span>

                            </td>

                            <td>

                                <div class="contact-info">

                                    <i class="bi bi-envelope-fill me-1 text-success"></i>

                                    <?= esc($row['email']) ?>

                                </div>

                            </td>

                            <td>

                                <div class="contact-info">

                                    <i class="bi bi-whatsapp me-1 text-success"></i>

                                    <?= esc($row['no_hp']) ?>

                                </div>

                            </td>

                            <td>

                                <div class="action-group">

                                    <a href="<?= base_url('admin/alumni/edit/' . $row['id']) ?>"
                                        class="btn-action btn-edit"
                                        title="Edit Alumni">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                    <a href="<?= base_url('admin/alumni/detail/' . $row['id']) ?>"
                                        class="btn-action btn-detail"
                                        title="Detail Alumni">

                                        <i class="bi bi-eye-fill"></i>

                                    </a>

                                    <a href="<?= base_url('admin/alumni/delete/' . $row['id']) ?>"
                                        class="btn-action btn-delete btn-delete-confirm"
                                        title="Hapus Alumni">

                                        <i class="bi bi-trash-fill"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->section('scripts') ?>

<script>
    $(function() {

        $('#tabelAlumni').DataTable({

            responsive: true,

            pageLength: 10,

            language: {

                search: "_INPUT_",

                searchPlaceholder: "Cari alumni...",

                lengthMenu: "Tampilkan _MENU_ data",

                zeroRecords: "Data alumni tidak ditemukan",

                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",

                paginate: {

                    previous: "‹",
                    next: "›"
                }
            }
        });

        $('.btn-delete-confirm').on('click', function(e) {

            e.preventDefault();

            const url = $(this).attr('href');

            Swal.fire({

                title: 'Hapus Alumni?',

                text: 'Data alumni akan dihapus permanen.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc2626',

                cancelButtonColor: '#64748b',

                confirmButtonText: 'Ya, Hapus',

                cancelButtonText: 'Batal',

                borderRadius: 24

            }).then((result) => {

                if (result.isConfirmed) {

                    window.location.href = url;
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>

<?= $this->endSection() ?>