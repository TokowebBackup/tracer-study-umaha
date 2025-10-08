<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel - Tracer Study UMAHA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url('/assets/img/logo-umaha-192.png') ?>" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 240px;
            background: linear-gradient(135deg, #1d3557, #457b9d);
            color: #fff;
            padding-top: 60px;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar.hidden {
            margin-left: -240px;
        }

        .sidebar a {
            display: block;
            padding: 15px 20px;
            color: #eee;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .sidebar .brand {
            font-size: 1.25rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin-left: 240px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .content.full {
            margin-left: 0;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 240px;
            right: 0;
            z-index: 999;
            transition: left 0.3s ease;
        }

        .navbar.full {
            left: 0;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -240px;
            }

            .sidebar.show {
                left: 0;
            }

            .navbar {
                left: 0;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>

    <style>
        /* ✅ Lebarkan kolom Options */
        #tabelAlumni th:last-child,
        #tabelAlumni td.options-cell {
            width: 150px !important;
            white-space: nowrap;
        }

        /* Sedikit jarak antar tombol */
        #tabelAlumni td.options-cell .btn {
            margin-bottom: 3px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <div class="brand">
            <img src="<?= base_url('/assets/img/logo-umaha-192.png') ?>" alt="Logo" width="40" class="mb-2"><br>
            Tracer UMAHA
        </div>
        <a href="<?= base_url('admin/dashboard') ?>" class="<?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
        <a href="<?= base_url('admin/landing') ?>" class="<?= uri_string() == 'admin/periode' ? 'active' : '' ?>"><i class="bi bi-sliders"></i> Setting Page</a>
        <a href="<?= base_url('admin/kuesionerfields') ?>" class="<?= uri_string() == 'admin/periode' ? 'active' : '' ?>"><i class="bi bi-gear"></i> Setting Form</a>
        <a href="<?= base_url('admin/alumni') ?>" class="<?= uri_string() == 'admin/alumni' ? 'active' : '' ?>"><i class="bi bi-person-lines-fill me-2"></i>Data Alumni</a>
        <a href="<?= base_url('admin/tracer') ?>" class="<?= uri_string() == 'admin/tracer' ? 'active' : '' ?>">
            <i class="bi bi-clipboard-data me-2"></i> Data Tracer Study
        </a>
        <a href="<?= base_url('admin/pengguna') ?>" class="<?= uri_string() == 'admin/pengguna' ? 'active' : '' ?>"><i class="bi bi-person-workspace me-2"></i>Pengguna</a>
        <a href="<?= base_url('admin/periode') ?>" class="<?= uri_string() == 'admin/periode' ? 'active' : '' ?>"><i class="bi bi-calendar-range me-2"></i>Periode Tracer</a>
        <a href="<?= base_url('admin/panduan') ?>" class="<?= uri_string() == 'admin/panduan' ? 'active' : '' ?>">
            <i class="bi bi-file-earmark-arrow-down me-2"></i>Panduan Tracer
        </a>
        <a href="<?= base_url('admin/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
    </div>

    <!-- NAVBAR TOP -->
    <nav class="navbar navbar-dark bg-dark px-3" id="navbar">
        <button class="sidebar-toggle" onclick="toggleSidebar()" title="Toggle Sidebar"><i class="bi bi-list"></i></button>
        <span class="navbar-text text-white ms-3">Admin Panel</span>
    </nav>

    <!-- CONTENT -->
    <div class="content mt-5 pt-3" id="mainContent">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('mainContent');
            const navbar = document.getElementById('navbar');

            sidebar.classList.toggle('hidden');
            content.classList.toggle('full');
            navbar.classList.toggle('full');
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Delegasi klik tombol hapus
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');

                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    text: "Data akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
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