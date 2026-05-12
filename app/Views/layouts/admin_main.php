<!DOCTYPE html>
<html lang="id">

<head>

    <title>Admin Panel - Tracer Study UMAHA</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon"
        href="<?= base_url('/assets/img/logo-umaha-192.png') ?>"
        type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {

            --primary: #006633;
            --primary-light: #009966;
            --dark: #0f172a;
            --sidebar: #071b11;
            --sidebar-soft: #0d281b;
            --text-soft: #94a3b8;
            --border: rgba(255, 255, 255, .08);
        }

        * {
            box-sizing: border-box;
        }

        body {

            margin: 0;
            padding: 0;
            font-family: "Inter", "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left,
                    rgba(0, 153, 102, .08),
                    transparent 20%),
                #f5f7fb;

            overflow-x: hidden;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {

            position: fixed;
            top: 0;
            left: 0;

            width: 290px;
            height: 100vh;

            background:
                linear-gradient(180deg,
                    #071b11 0%,
                    #0d281b 100%);

            backdrop-filter: blur(16px);

            border-right: 1px solid rgba(255, 255, 255, .06);

            z-index: 1100;

            transition: .35s ease;

            overflow-y: auto;
        }

        .sidebar.hidden {

            transform: translateX(-100%);
        }

        .sidebar::before {

            content: '';

            position: absolute;

            width: 240px;
            height: 240px;

            border-radius: 50%;

            background: rgba(0, 255, 153, .06);

            top: -100px;
            right: -80px;
        }

        .sidebar-brand {

            padding: 35px 30px 25px;

            position: relative;

            z-index: 2;
        }

        .sidebar-brand img {

            width: 62px;
            height: 62px;

            object-fit: contain;

            margin-bottom: 15px;
        }

        .sidebar-brand h4 {

            color: white;
            font-weight: 800;
            margin: 0;
            font-size: 24px;
        }

        .sidebar-brand small {

            color: rgba(255, 255, 255, .65);
            font-size: 13px;
        }

        .sidebar-menu {

            padding: 10px 18px 40px;
        }

        .sidebar-menu a {

            display: flex;
            align-items: center;
            gap: 14px;

            padding: 15px 18px;

            margin-bottom: 8px;

            border-radius: 18px;

            text-decoration: none;

            color: rgba(255, 255, 255, .78);

            transition: .25s ease;

            position: relative;

            font-size: 15px;
            font-weight: 500;
        }

        .sidebar-menu a i {

            font-size: 20px;
        }

        .sidebar-menu a:hover {

            background: rgba(255, 255, 255, .08);

            color: white;

            transform: translateX(4px);
        }

        .sidebar-menu a.active {

            background:
                linear-gradient(135deg,
                    rgba(0, 153, 102, .95),
                    rgba(0, 102, 51, .95));

            color: white;

            box-shadow:
                0 10px 25px rgba(0, 153, 102, .25);
        }

        /* =========================
           NAVBAR
        ========================= */

        .topbar {

            position: fixed;

            top: 0;
            left: 290px;
            right: 0;

            height: 78px;

            background: rgba(255, 255, 255, .75);

            backdrop-filter: blur(18px);

            border-bottom: 1px solid rgba(0, 0, 0, .04);

            z-index: 1000;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 30px;

            transition: .35s ease;
        }

        .topbar.full {

            left: 0;
        }

        .topbar-left {

            display: flex;
            align-items: center;
            gap: 18px;
        }

        .toggle-btn {

            width: 48px;
            height: 48px;

            border: none;

            border-radius: 16px;

            background:
                linear-gradient(135deg,
                    #006633,
                    #009966);

            color: white;

            font-size: 22px;

            transition: .25s ease;
        }

        .toggle-btn:hover {

            transform: scale(1.05);
        }

        .topbar-title h5 {

            margin: 0;

            font-weight: 700;

            color: #0f172a;
        }

        .topbar-title small {

            color: #64748b;
        }

        /* =========================
           USER MENU
        ========================= */

        .user-dropdown {

            background: white;

            border-radius: 18px;

            padding: 8px 14px;

            box-shadow:
                0 8px 24px rgba(0, 0, 0, .06);
        }

        .user-dropdown a {

            text-decoration: none;

            color: #0f172a;

            font-weight: 600;
        }

        .dropdown-menu {

            border: none;

            border-radius: 18px;

            padding: 10px;

            box-shadow:
                0 12px 35px rgba(0, 0, 0, .12);
        }

        .dropdown-item {

            border-radius: 12px;

            padding: 10px 14px;

            transition: .2s ease;
        }

        .dropdown-item:hover {

            background: #f1f5f9;
        }

        /* =========================
           CONTENT
        ========================= */

        .main-content {

            margin-left: 290px;

            padding: 110px 28px 30px;

            transition: .35s ease;
        }

        .main-content.full {

            margin-left: 0;
        }

        /* =========================
           GLOBAL CARD
        ========================= */

        .card {

            border: none !important;

            border-radius: 24px !important;

            box-shadow:
                0 10px 35px rgba(0, 0, 0, .05);

            overflow: hidden;
        }

        .card-header {

            border-bottom: 1px solid rgba(0, 0, 0, .04) !important;
        }

        /* =========================
           TABLES
        ========================= */

        .table {

            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .table thead th {

            border: none;

            background: #f8fafc;

            color: #64748b;

            padding: 16px;
        }

        .table tbody tr {

            background: white;

            transition: .2s ease;
        }

        .table tbody tr:hover {

            transform: translateY(-2px);
        }

        .table tbody td {

            border-top: none;
            border-bottom: none;

            padding: 16px;

            vertical-align: middle;
        }

        /* =========================
           DATATABLE
        ========================= */

        .dataTables_wrapper .dataTables_filter input {

            border-radius: 14px;
            border: 1px solid #dbe2ea;

            padding: 10px 14px;
        }

        .dataTables_wrapper .dataTables_length select {

            border-radius: 12px;
        }

        /* =========================
           SCROLLBAR
        ========================= */

        ::-webkit-scrollbar {

            width: 10px;
        }

        ::-webkit-scrollbar-thumb {

            background:
                linear-gradient(180deg,
                    #006633,
                    #009966);

            border-radius: 20px;
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 992px) {

            .sidebar {

                transform: translateX(-100%);
            }

            .sidebar.show {

                transform: translateX(0);
            }

            .topbar {

                left: 0;
            }

            .main-content {

                margin-left: 0;
                padding: 100px 18px 25px;
            }
        }
    </style>

</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-brand">

            <img src="<?= base_url('/assets/img/logo-umaha-192.png') ?>"
                alt="Logo UMAHA">

            <h4>Tracer UMAHA</h4>

            <small>
                Admin Management Panel
            </small>

        </div>

        <div class="sidebar-menu">

            <a href="<?= base_url('admin/dashboard') ?>"
                class="<?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>">

                <i class="bi bi-grid-fill"></i>
                Dashboard

            </a>

            <a href="<?= base_url('admin/landing') ?>"
                class="<?= uri_string() == 'admin/landing' ? 'active' : '' ?>">

                <i class="bi bi-window-stack"></i>
                Setting Page

            </a>

            <a href="<?= base_url('admin/kuesionerfields') ?>"
                class="<?= uri_string() == 'admin/kuesionerfields' ? 'active' : '' ?>">

                <i class="bi bi-ui-checks-grid"></i>
                Setting Form

            </a>

            <a href="<?= base_url('admin/alumni') ?>"
                class="<?= uri_string() == 'admin/alumni' ? 'active' : '' ?>">

                <i class="bi bi-people-fill"></i>
                Data Alumni

            </a>

            <a href="<?= base_url('admin/tracer') ?>"
                class="<?= uri_string() == 'admin/tracer' ? 'active' : '' ?>">

                <i class="bi bi-bar-chart-line-fill"></i>
                Data Tracer

            </a>

            <a href="<?= base_url('admin/kuesioner-pengguna') ?>"
                class="<?= uri_string() == 'admin/kuesioner-pengguna' ? 'active' : '' ?>">

                <i class="bi bi-briefcase-fill"></i>
                Kuesioner Pengguna

            </a>

            <a href="<?= base_url('admin/pengguna') ?>"
                class="<?= uri_string() == 'admin/pengguna' ? 'active' : '' ?>">

                <i class="bi bi-person-badge-fill"></i>
                Pengguna

            </a>

            <a href="<?= base_url('admin/periode') ?>"
                class="<?= uri_string() == 'admin/periode' ? 'active' : '' ?>">

                <i class="bi bi-calendar-range-fill"></i>
                Periode Tracer

            </a>

            <a href="<?= base_url('admin/panduan') ?>"
                class="<?= uri_string() == 'admin/panduan' ? 'active' : '' ?>">

                <i class="bi bi-file-earmark-pdf-fill"></i>
                Panduan Tracer

            </a>

        </div>

    </aside>

    <!-- TOPBAR -->
    <header class="topbar" id="topbar">

        <div class="topbar-left">

            <button class="toggle-btn" id="toggleSidebar">

                <i class="bi bi-list"></i>

            </button>

            <div class="topbar-title">

                <h5>
                    Admin Dashboard
                </h5>

                <small>
                    Tracer Study Universitas Maarif Hasyim Latif
                </small>

            </div>

        </div>

        <!-- USER -->
        <div class="dropdown user-dropdown">

            <a href="#"
                class="dropdown-toggle"
                data-bs-toggle="dropdown">

                <i class="bi bi-person-circle me-2"></i>

                <?= session('admin_nama') ?? 'Administrator' ?>

            </a>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>

                    <a class="dropdown-item"
                        href="<?= base_url('admin/profile') ?>">

                        <i class="bi bi-person-lines-fill me-2"></i>
                        Profil Admin

                    </a>

                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>

                    <a class="dropdown-item text-danger"
                        href="<?= base_url('admin/logout') ?>">

                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout

                    </a>

                </li>

            </ul>

        </div>

    </header>

    <!-- CONTENT -->
    <main class="main-content" id="mainContent">

        <?= $this->renderSection('content') ?>

    </main>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const topbar = document.getElementById('topbar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleSidebar');

        toggleBtn.addEventListener('click', () => {

            if (window.innerWidth <= 992) {

                sidebar.classList.toggle('show');

            } else {

                sidebar.classList.toggle('hidden');

                topbar.classList.toggle('full');

                mainContent.classList.toggle('full');
            }
        });

        // =========================
        // SWEET ALERT DELETE
        // =========================

        document.addEventListener("DOMContentLoaded", function() {

            $(document).on('click', '.btn-delete', function(e) {

                e.preventDefault();

                const url = $(this).attr('href');

                Swal.fire({

                    title: 'Yakin hapus data?',
                    text: "Data tidak dapat dikembalikan.",

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#64748b',

                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',

                    background: '#fff',
                    borderRadius: '24px'

                }).then((result) => {

                    if (result.isConfirmed) {

                        window.location.href = url;
                    }
                });
            });
        });
    </script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>