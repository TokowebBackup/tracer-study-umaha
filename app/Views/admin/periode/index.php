<?= $this->extend('layouts/admin_main') ?>

<?php
/** @var array $list */
/** @var array $fields_step2 */
/** @var array $select_options */
?>

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

        min-width: 1000px;

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

    .tahun-badge {

        background: rgba(0, 153, 102, .12);

        color: #009966;

        border-radius: 30px;

        padding: 8px 16px;

        font-size: 12px;

        font-weight: 700;

        display: inline-flex;

        align-items: center;
    }

    .lulusan-box {

        display: flex;

        flex-direction: column;
    }

    .lulusan-year {

        font-size: 14px;

        font-weight: 700;

        color: #0f172a;
    }

    .lulusan-sub {

        font-size: 12px;

        color: #64748b;
    }

    .periode-box {

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        border-radius: 18px;

        padding: 14px 16px;

        display: inline-flex;

        flex-direction: column;

        gap: 4px;
    }

    .periode-date {

        font-size: 13px;

        font-weight: 700;

        color: #1e293b;
    }

    .periode-label {

        font-size: 11px;

        text-transform: uppercase;

        letter-spacing: .5px;

        color: #64748b;
    }

    .btn-surat {

        background: rgba(34, 197, 94, .12);

        color: #16a34a;

        border: none;

        border-radius: 14px;

        padding: 10px 16px;

        font-size: 12px;

        font-weight: 700;

        transition: .25s ease;

        display: inline-flex;

        align-items: center;

        gap: 8px;
    }

    .btn-surat:hover {

        background: #16a34a;

        color: white;

        transform: translateY(-2px);
    }

    .no-file {

        color: #94a3b8;

        font-size: 12px;

        font-weight: 600;
    }

    .action-group {

        display: flex;

        align-items: center;

        gap: 8px;

        flex-wrap: wrap;
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

    .btn-delete {

        background: rgba(239, 68, 68, .12);

        color: #dc2626;
    }

    .btn-delete:hover {

        background: #dc2626;

        color: white;

        transform: translateY(-2px);
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

            min-width: 950px;
        }
    }
</style>

<div class="container-fluid p-4">

    <!-- HERO -->
    <div class="page-hero mb-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>

                <h3>
                    <i class="bi bi-calendar-range-fill me-2"></i>
                    Data Periode Tracer
                </h3>

                <p>
                    Kelola periode tracer study alumni UMAHA
                </p>

            </div>

            <div class="mt-3 mt-md-0">

                <a href="<?= base_url('admin/periode/tambah') ?>"
                    class="btn btn-light rounded-4 px-4 py-2 fw-semibold">

                    <i class="bi bi-plus-circle-fill me-2"></i>
                    Tambah Periode

                </a>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="glass-card">

        <div class="table-responsive">

            <table class="table table-modern align-middle"
                id="tabelPeriode">

                <thead>

                    <tr>

                        <th>Tahun</th>

                        <th>Lulusan Tahun</th>

                        <th>Periode</th>

                        <th>Surat</th>

                        <th width="180">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($list)): ?>

                        <?php foreach ($list as $row): ?>

                            <tr>

                                <td>

                                    <span class="tahun-badge">

                                        <?= esc($row['tahun']) ?>

                                    </span>

                                </td>

                                <td>

                                    <div class="lulusan-box">

                                        <div class="lulusan-year">

                                            <?= esc($row['lulusan_tahun']) ?>

                                        </div>

                                        <div class="lulusan-sub">

                                            Tahun Kelulusan

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <div class="periode-box">

                                        <div class="periode-label">

                                            Periode Aktif

                                        </div>

                                        <div class="periode-date">

                                            <?= date('d M Y', strtotime($row['tanggal_mulai'])) ?>

                                        </div>

                                        <div class="periode-date">

                                            s/d
                                            <?= date('d M Y', strtotime($row['tanggal_selesai'])) ?>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <?php if ($row['file_surat']): ?>

                                        <a href="<?= base_url($row['file_surat']) ?>"
                                            target="_blank"
                                            class="btn-surat">

                                            <i class="bi bi-file-earmark-pdf-fill"></i>

                                            Lihat Surat

                                        </a>

                                    <?php else: ?>

                                        <span class="no-file">

                                            Tidak Ada Surat

                                        </span>

                                    <?php endif ?>

                                </td>

                                <td>

                                    <div class="action-group">

                                        <a href="<?= base_url('admin/periode/edit/' . $row['id']) ?>"
                                            class="btn-action btn-edit"
                                            title="Edit">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                        <a href="<?= base_url('admin/periode/delete/' . $row['id']) ?>"
                                            class="btn-action btn-delete btn-delete-confirm"
                                            title="Delete">

                                            <i class="bi bi-trash-fill"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="5"
                                class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-database-fill-x fs-1 d-block mb-3"></i>

                                    Belum ada data periode tracer.

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

        $('#tabelPeriode').DataTable({

            responsive: true,

            pageLength: 10,

            language: {

                search: "_INPUT_",
                searchPlaceholder: "Cari periode tracer...",

                lengthMenu: "Tampilkan _MENU_ data",

                zeroRecords: "Data tidak ditemukan",

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

                title: 'Hapus Periode?',

                text: 'Data periode tracer akan dihapus permanen.',

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