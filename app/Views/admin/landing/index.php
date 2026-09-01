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

        min-width: 950px;

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

    .landing-title {

        font-size: 15px;

        font-weight: 700;

        color: #0f172a;

        line-height: 1.6;
    }

    .status-badge {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        padding: 8px 16px;

        border-radius: 30px;

        font-size: 12px;

        font-weight: 700;
    }

    .status-active {

        background: rgba(34, 197, 94, .12);

        color: #16a34a;
    }

    .status-inactive {

        background: rgba(239, 68, 68, .12);

        color: #dc2626;
    }

    .image-preview {

        width: 120px;

        height: 80px;

        border-radius: 18px;

        overflow: hidden;

        border: 1px solid #e2e8f0;

        background: #f8fafc;

        display: flex;

        align-items: center;

        justify-content: center;
    }

    .image-preview img {

        width: 100%;

        height: 100%;

        object-fit: cover;
    }

    .image-empty {

        color: #94a3b8;

        font-size: 12px;

        text-align: center;
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

        transition: .25s ease;

        border: none;
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

    .btn-gradient {

        background:
            linear-gradient(135deg,
                #006633 0%,
                #009966 100%);

        color: white;
    }

    .btn-gradient:hover {

        color: white;

        box-shadow:
            0 10px 24px rgba(0, 153, 102, .25);
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

            min-width: 850px;
        }
    }
</style>

<div class="container-fluid p-4">

    <!-- HERO -->
    <div class="page-hero mb-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>

                <h3>
                    <i class="bi bi-window-stack me-2"></i>
                    Konten Landing Page
                </h3>

                <p>
                    Kelola konten landing page tracer study UMAHA
                </p>

            </div>

            <div class="mt-3 mt-md-0">

                <a href="<?= base_url('admin/landing/edit/0') ?>"
                    class="btn btn-light rounded-4 px-4 py-2 fw-semibold">

                    <i class="bi bi-plus-circle-fill me-2"></i>
                    Tambah Konten

                </a>

            </div>

        </div>

    </div>

    <!-- ALERT -->
    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success border-0 shadow-sm rounded-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            <?= session()->getFlashdata('success') ?>

        </div>

    <?php endif ?>

    <!-- TABLE -->
    <div class="glass-card">

        <div class="table-responsive">

            <table class="table table-modern align-middle"
                id="tabelLanding">

                <thead>

                    <tr>

                        <th>Judul</th>

                        <th>Status</th>

                        <th>Preview Gambar</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($landing)): ?>

                        <?php foreach ($landing as $item): ?>

                            <tr>

                                <td>

                                    <div class="landing-title">

                                        <?= esc($item['judul']) ?>

                                    </div>

                                </td>

                                <td>

                                    <?php if ($item['status'] === 'aktif'): ?>

                                        <span class="status-badge status-active">

                                            <i class="bi bi-check-circle-fill me-2"></i>

                                            Aktif

                                        </span>

                                    <?php else: ?>

                                        <span class="status-badge status-inactive">

                                            <i class="bi bi-x-circle-fill me-2"></i>

                                            Nonaktif

                                        </span>

                                    <?php endif ?>

                                </td>

                                <td>

                                    <?php if ($item['gambar']): ?>

                                        <div class="image-preview">

                                            <img src="<?= base_url($item['gambar']) ?>"
                                                alt="Preview Landing">

                                        </div>

                                    <?php else: ?>

                                        <div class="image-preview">

                                            <div class="image-empty">

                                                Tidak ada gambar

                                            </div>

                                        </div>

                                    <?php endif ?>

                                </td>

                                <td>

                                    <div class="action-group">

                                        <a href="<?= base_url('admin/landing/edit/' . $item['id']) ?>"
                                            class="btn-action btn-edit"
                                            title="Edit Konten">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="4"
                                class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-database-fill-x fs-1 d-block mb-3"></i>

                                    Belum ada konten landing page.

                                </div>

                            </td>

                        </tr>

                    <?php endif ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->section('scripts') ?>

<script>
    $(function() {

        $('#tabelLanding').DataTable({

            responsive: true,

            pageLength: 10,

            language: {

                search: "_INPUT_",
                searchPlaceholder: "Cari konten landing...",

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

<?= $this->endSection(); ?>

<?= $this->endSection() ?>