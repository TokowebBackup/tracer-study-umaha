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

        min-width: 1200px;

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

    .email-box {

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        padding: 10px 14px;

        border-radius: 14px;

        display: inline-block;

        color: #0f172a;

        font-weight: 600;

        font-size: 13px;
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

    .btn-detail {

        background: rgba(59, 130, 246, .12);

        color: #2563eb;
    }

    .btn-detail:hover {

        background: #2563eb;

        color: white;

        transform: translateY(-2px);
    }

    .btn-export {

        background: rgba(34, 197, 94, .12);

        color: #16a34a;
    }

    .btn-export:hover {

        background: #16a34a;

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

            min-width: 1100px;
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
                    Monitoring data pengguna lulusan dan perusahaan perekrut alumni UMAHA
                </p>

            </div>

            <div class="mt-3 mt-md-0">

                <a href="<?= base_url('admin/kuesioner-pengguna/export/all') ?>"
                    class="btn btn-light rounded-4 px-4 py-2 fw-semibold">

                    <i class="bi bi-file-earmark-excel-fill me-2"></i>
                    Export Semua

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

    <?php endif; ?>

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

                        <th>Email</th>

                        <th>Tahun Merekrut</th>

                        <th>Tindakan</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if ($pengguna): ?>

                        <?php foreach ($pengguna as $i => $p): ?>

                            <tr>

                                <td>

                                    <span class="badge-number">

                                        #<?= $i + 1 ?>

                                    </span>

                                </td>

                                <td>

                                    <div class="company-box">

                                        <div class="company-name">

                                            <?= esc($p['nama_perusahaan']) ?>

                                        </div>

                                        <div class="company-sub">

                                            Perusahaan Pengguna Alumni

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <div class="person-box">

                                        <div class="person-name">

                                            <?= esc($p['nama_pengisi']) ?>

                                        </div>

                                        <div class="person-job">

                                            <?= esc($p['jabatan_pengisi']) ?>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <div class="email-box">

                                        <?= esc($p['email_pengisi']) ?>

                                    </div>

                                </td>

                                <td>

                                    <span class="tahun-badge">

                                        <?= esc($p['tahun_merekrut']) ?>

                                    </span>

                                </td>

                                <td>

                                    <div class="action-group">

                                        <a href="<?= base_url('admin/kuesioner-pengguna/detail/' . $p['id']) ?>"
                                            class="btn-action btn-detail"
                                            title="Detail">

                                            <i class="bi bi-eye-fill"></i>

                                        </a>

                                        <a href="<?= base_url('admin/kuesioner-pengguna/export/' . $p['id']) ?>"
                                            class="btn-action btn-export"
                                            title="Export">

                                            <i class="bi bi-download"></i>

                                        </a>

                                        <a href="<?= base_url('admin/kuesioner-pengguna/delete/' . $p['id']) ?>"
                                            class="btn-action btn-delete btn-delete-confirm"
                                            title="Hapus">

                                            <i class="bi bi-trash-fill"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

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

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->section('scripts') ?>

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

        $('.btn-delete-confirm').on('click', function(e) {

            e.preventDefault();

            const url = $(this).attr('href');

            Swal.fire({

                title: 'Hapus Data?',

                text: 'Data pengguna lulusan akan dihapus permanen.',

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

<?= $this->endSection(); ?>

<?= $this->endSection() ?>