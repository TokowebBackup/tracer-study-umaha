<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Alumni - Tracer Study UMAHA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-dns-prefetch-control" content="off">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #198754;
        }

        .navbar-brand,
        .nav-link,
        .navbar-text {
            color: #fff !important;
        }

        .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="<?= base_url('alumni/dashboard') ?>">
                <img src="<?= base_url('/assets/img/logo-umaha-192.png') ?>" alt="Logo" width="40" class="mb-2">
                Dashboard Alumni</a>
            <div class="ms-auto">
                <span class="navbar-text me-3"><?= session()->get('email') ?></span>
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>