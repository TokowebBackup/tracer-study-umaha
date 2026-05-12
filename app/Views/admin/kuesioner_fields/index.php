<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<style>
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

        min-width: 1400px;

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

        padding: 16px 14px;

        font-size: 12px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .6px;

        vertical-align: middle;

        white-space: nowrap;
    }

    .table-modern tbody td {

        padding: 16px 14px;

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

    /* Kolom lebih proporsional */
    .col-order {

        width: 80px;

        min-width: 80px;
    }

    .col-step {

        width: 90px;

        min-width: 90px;
    }

    .col-field {

        width: 240px;

        min-width: 240px;
    }

    .col-label {

        width: 380px;

        min-width: 380px;
    }

    .col-type {

        width: 120px;

        min-width: 120px;
    }

    .col-required {

        width: 140px;

        min-width: 140px;
    }

    .col-options {

        width: 320px;

        min-width: 320px;
    }

    .col-action {

        width: 140px;

        min-width: 140px;
    }

    .badge-step {

        background: rgba(0, 153, 102, .12);

        color: #009966;

        border-radius: 30px;

        padding: 6px 12px;

        font-size: 11px;

        font-weight: 700;

        display: inline-flex;

        align-items: center;

        justify-content: center;
    }

    .badge-type {

        background: rgba(59, 130, 246, .12);

        color: #2563eb;

        border-radius: 30px;

        padding: 6px 12px;

        font-size: 11px;

        font-weight: 700;

        display: inline-flex;

        align-items: center;

        justify-content: center;
    }

    .badge-required {

        border-radius: 30px;

        padding: 6px 12px;

        font-size: 11px;

        font-weight: 700;

        display: inline-flex;

        align-items: center;

        gap: 6px;
    }

    .required-yes {

        background: rgba(34, 197, 94, .12);

        color: #16a34a;
    }

    .required-no {

        background: rgba(239, 68, 68, .12);

        color: #dc2626;
    }

    .field-name {

        font-family: monospace;

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        padding: 10px 14px;

        border-radius: 12px;

        font-size: 12px;

        font-weight: 700;

        color: #0f172a;

        word-break: break-word;

        line-height: 1.5;
    }

    .field-label {

        font-size: 13px;

        font-weight: 600;

        color: #1e293b;

        line-height: 1.7;
    }

    .json-box {

        background: #0f172a;

        color: #d1fae5;

        border-radius: 14px;

        padding: 12px;

        max-height: 160px;

        overflow: auto;

        font-size: 11px;

        line-height: 1.7;

        font-family: monospace;
    }

    .json-box pre {

        margin: 0;

        white-space: pre-wrap;

        word-break: break-word;
    }

    .action-group {

        display: flex;

        align-items: center;

        gap: 8px;
    }

    .btn-action {

        width: 38px;

        height: 38px;

        border-radius: 12px;

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

    /* DataTables */
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

    /* Scroll horizontal lebih smooth */
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

    @media(max-width: 768px) {

        .table-modern {

            min-width: 1300px;
        }

        .table-modern thead th,
        .table-modern tbody td {

            padding: 14px 12px;
        }
    }

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

        opacity: .85;

        margin-bottom: 0;

        position: relative;
        z-index: 2;
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

    .glass-card {

        background: rgba(255, 255, 255, .9);

        backdrop-filter: blur(12px);

        border: 1px solid rgba(255, 255, 255, .2);

        border-radius: 28px;

        overflow: hidden;

        box-shadow:
            0 10px 35px rgba(0, 0, 0, .06);
    }

    .table-modern {

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

        font-size: 13px;

        text-transform: uppercase;

        letter-spacing: .5px;

        padding: 18px 16px;

        vertical-align: middle;
    }

    .table-modern tbody tr {

        transition: .25s ease;
    }

    .table-modern tbody tr:hover {

        background: #f0fdf4;

        transform: scale(1.001);
    }

    .table-modern td {

        vertical-align: middle;

        padding: 18px 16px;

        border-color: #eef2f7;
    }

    .badge-step {

        background: rgba(0, 153, 102, .12);

        color: #009966;

        border-radius: 30px;

        padding: 8px 14px;

        font-weight: 700;

        font-size: 12px;
    }

    .badge-type {

        background: rgba(59, 130, 246, .1);

        color: #2563eb;

        border-radius: 30px;

        padding: 8px 14px;

        font-size: 12px;

        font-weight: 700;
    }

    .badge-required {

        border-radius: 30px;

        padding: 8px 14px;

        font-size: 12px;

        font-weight: 700;
    }

    .required-yes {

        background: rgba(34, 197, 94, .12);

        color: #16a34a;
    }

    .required-no {

        background: rgba(239, 68, 68, .12);

        color: #dc2626;
    }

    .field-name {

        font-family: monospace;

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        padding: 10px 14px;

        border-radius: 12px;

        display: inline-block;

        color: #0f172a;

        font-weight: 700;
    }

    .json-box {

        background: #0f172a;

        color: #d1fae5;

        border-radius: 16px;

        padding: 14px;

        max-height: 180px;

        overflow: auto;

        font-size: 12px;

        font-family: monospace;
    }

    .action-group {

        display: flex;

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

    .btn-delete {

        background: rgba(239, 68, 68, .12);

        color: #dc2626;
    }

    .btn-delete:hover {

        background: #dc2626;

        color: white;

        transform: translateY(-2px);
    }

    .dataTables_wrapper .dataTables_filter input {

        border-radius: 14px;

        border: 1px solid #dbe2ea;

        padding: 8px 14px;

        margin-left: 10px;
    }

    .dataTables_wrapper .dataTables_length select {

        border-radius: 12px;

        border: 1px solid #dbe2ea;

        padding: 6px 10px;
    }

    @media(max-width:768px) {

        .page-hero {

            padding: 30px 24px;
        }

        .action-group {

            flex-wrap: wrap;
        }
    }
</style>

<div class="container-fluid p-4">

    <!-- HERO -->
    <div class="page-hero mb-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>

                <h3>
                    <i class="bi bi-ui-checks-grid me-2"></i>
                    Kelola Field Kuesioner
                </h3>

                <p>
                    Manajemen field dinamis tracer study alumni UMAHA
                </p>

            </div>

            <div class="mt-3 mt-md-0">

                <a href="<?= base_url('admin/kuesionerfields/create') ?>"
                    class="btn btn-light rounded-4 px-4 py-2 fw-semibold">

                    <i class="bi bi-plus-circle-fill me-2"></i>
                    Tambah Field

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
                id="tabelKuesionerFields">

                <thead>
                    <tr>

                        <th class="col-order">
                            Order
                        </th>

                        <th class="col-step">
                            Step
                        </th>

                        <th class="col-field">
                            Field Name
                        </th>

                        <th class="col-label">
                            Label
                        </th>

                        <th class="col-type">
                            Type
                        </th>

                        <th class="col-required">
                            Required
                        </th>

                        <th class="col-options">
                            Options JSON
                        </th>

                        <th class="col-action">
                            Actions
                        </th>

                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($fields)): ?>

                        <?php foreach ($fields as $f): ?>

                            <tr>

                                <td>

                                    <span class="badge-step">

                                        #<?= esc($f['order']) ?>

                                    </span>

                                </td>

                                <td>

                                    <span class="badge-step">

                                        Step <?= esc($f['step']) ?>

                                    </span>

                                </td>

                                <td>

                                    <div class="field-name">

                                        <?= esc($f['field_name']) ?>

                                    </div>

                                </td>

                                <td>

                                    <div class="fw-semibold text-dark">

                                        <?= esc($f['label']) ?>

                                    </div>

                                </td>

                                <td>

                                    <span class="badge-type">

                                        <?= esc($f['type']) ?>

                                    </span>

                                </td>

                                <td>

                                    <?php if ($f['required']): ?>

                                        <span class="badge-required required-yes">

                                            <i class="bi bi-check-circle-fill me-1"></i>
                                            Required

                                        </span>

                                    <?php else: ?>

                                        <span class="badge-required required-no">

                                            <i class="bi bi-x-circle-fill me-1"></i>
                                            Optional

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?php if (!empty($f['options'])): ?>

                                        <div class="json-box">

                                            <pre class="mb-0 text-light"><?= esc($f['options']) ?></pre>

                                        </div>

                                    <?php else: ?>

                                        <span class="text-muted">

                                            -

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <div class="action-group">

                                        <a href="<?= base_url('admin/kuesionerfields/edit/' . $f['id']) ?>"
                                            class="btn-action btn-edit"
                                            title="Edit Field">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                        <a href="<?= base_url('admin/kuesionerfields/delete/' . $f['id']) ?>"
                                            class="btn-action btn-delete btn-delete-confirm"
                                            title="Hapus Field">

                                            <i class="bi bi-trash-fill"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="8"
                                class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-database-fill-x fs-1 d-block mb-3"></i>

                                    Belum ada field kuesioner yang ditambahkan.

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

        $('#tabelKuesionerFields').DataTable({

            responsive: true,

            pageLength: 10,

            language: {

                search: "_INPUT_",
                searchPlaceholder: "Cari field...",

                lengthMenu: "Tampilkan _MENU_ data",

                zeroRecords: "Data tidak ditemukan",

                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",

                paginate: {

                    previous: "‹",
                    next: "›"
                }
            }
        });

        // Sweet Alert Delete
        $('.btn-delete-confirm').on('click', function(e) {

            e.preventDefault();

            const url = $(this).attr('href');

            Swal.fire({

                title: 'Hapus Field?',

                text: 'Field dan kolom database akan dihapus permanen.',

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