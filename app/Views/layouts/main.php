<!-- app/Views/layouts/main.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tracer Study UMAHA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url('/assets/img/logo-umaha-192.png') ?>" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            cursor: none;
            background: #f7f7f7;
        }

        .custom-cursor {
            position: fixed;
            top: 0;
            left: 0;
            width: 40px;
            height: 40px;
            border: 2px solid #2db598;
            border-radius: 50%;
            pointer-events: none;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        .custom-cursor::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 8px;
            height: 8px;
            background-color: #2db598;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .card-hover {
            transition: transform 0.2s;
        }

        .card-hover:hover {
            transform: scale(1.02);
        }

        /* Header sticky shrink */
        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        /* Logo miring kiri */
        .ribbon {
            background-color: #2bbbad;
            color: white;
            font-weight: 600;
            font-size: 20px;
            padding: 55px 30px;
            clip-path: polygon(0 0, 100% 0, 95% 100%, 0% 100%);
            display: inline-block;
            white-space: nowrap;
        }

        .ribbon-wrapper {
            min-width: 50%;
            margin-left: -2rem;
            height: auto;
            /* biar fleksibel */
        }

        .ribbon-back {
            position: absolute;
            top: 10px;
            left: 0px;
            background-color: #2bbbad;
            height: 100%;
            width: 100%;
            clip-path: polygon(0 10%, 100% 10%, 96% 100%, 0% 100%);
            z-index: 0;
        }

        .ribbon-front {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 16px 40px;
            clip-path: polygon(0 0, 100% 0, 95% 100%, 0% 100%);
            background-color: #26a69a;
            color: white;
            font-weight: 600;
            font-size: 20px;
        }

        /* Header row disamakan tinggi dengan isi */
        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            /* biar ngikut tinggi konten */
            padding: 0 20px;
            min-height: auto;
            /* biarkan isi yang menentukan tinggi */
        }

        /* Sosmed ikon */
        .sosmed-icons a {
            color: #444;
            margin-left: 12px;
            font-size: 18px;
            text-decoration: none;
        }

        .sticky-header {
            border-bottom: 1px solid #e0e0e0;
        }

        .table-modern {
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.03);
        }

        .table-modern thead {
            background: linear-gradient(90deg, #198754, #2db598);
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .table-modern th,
        .table-modern td {
            vertical-align: middle;
            padding: 12px;
            font-size: 14px;
            text-align: center;
        }

        .table-modern tbody tr {
            background-color: #fff;
            transition: all 0.3s ease-in-out;
        }

        .table-modern tbody tr:hover {
            background-color: #f1fdf7;
        }

        .animate-fade {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
            transform: translateY(10px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            body {
                cursor: auto !important;
            }

            .custom-cursor {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="custom-cursor" id="cursor"></div>

    <?= $this->include('partials/header_main') ?>



    <?= $this->renderSection('content') ?>

    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="loginForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Halaman Login Alumni</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                    <label class="form-label mt-2">Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" name="password" id="loginPassword" required>
                        <i class="bi bi-eye-slash toggle-password" id="togglePassword" style="position: absolute; top: 50%; right: 12px; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>

                    <div id="loginError" class="text-danger mt-2 small"></div>
                </div>
                <div class="modal-footer mb-3">
                    <button id="loginButton" class="btn btn-success w-100" type="submit">
                        <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true" id="loginSpinner"></span>
                        <span id="loginText">MASUK</span>
                    </button>

                    <a href="#" onclick="openGooglePopup()" class="btn btn-light w-100 h-80 border d-flex align-items-center justify-content-center gap-2 shadow-sm mt-2 mb-5" style="font-weight: 600; font-size: 1rem;">
                        <!-- Google SVG Icon -->
                        <svg width="20" height="20" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 3px;">
                            <path fill="#4285F4" d="M533.5 278.4c0-17.9-1.6-35.1-4.7-51.9H272v98.3h146.9c-6.3 33.6-25.3 62.1-54 81.3v67h87.3c51.1-47 80.3-116.4 80.3-194.7z" />
                            <path fill="#34A853" d="M272 544.3c72.6 0 133.6-24 178.1-65.3l-87.3-67c-24.1 16.1-54.8 25.7-90.8 25.7-69.8 0-129-47.2-150.1-110.3h-89.1v69.3c44.5 87.8 136.5 147.9 239.2 147.9z" />
                            <path fill="#FBBC05" d="M121.9 322.4c-10.5-31.3-10.5-65.5 0-96.8v-69.3h-89.1c-39.5 77.5-39.5 169.8 0 247.3l89.1-69.3z" />
                            <path fill="#EA4335" d="M272 213.1c39.5 0 75 13.6 103.1 40.2l77.4-77.4c-47-43.8-107.9-70.6-180.5-70.6-102.7 0-194.7 60.1-239.2 147.9l89.1 69.3c21.1-63.1 80.3-110.3 150.1-110.3z" />
                        </svg>
                        Masuk dengan Google
                    </a>
                </div>

            </form>
        </div>
    </div>


    <?= $this->include('partials/footer_main') ?>

    <!-- JS Login -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('loginPassword');
            const icon = this;

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    </script>
    <script>
        const cursor = document.getElementById('cursor');
        document.addEventListener('mousemove', e => {
            cursor.style.top = `${e.clientY}px`;
            cursor.style.left = `${e.clientX}px`;
        });

        // Hanya aktif di device dengan pointer "fine" (biasanya mouse/trackpad)
        if (window.matchMedia("(pointer: fine)").matches) {
            const cursor = document.getElementById('cursor');
            document.addEventListener('mousemove', e => {
                cursor.style.top = `${e.clientY}px`;
                cursor.style.left = `${e.clientX}px`;
            });
        }
    </script>
    <script>
        document.querySelector('#loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const data = new FormData(form);

            const btn = document.getElementById('loginButton');
            const spinner = document.getElementById('loginSpinner');
            const text = document.getElementById('loginText');
            const errorBox = document.getElementById('loginError');

            // Aktifkan loading
            btn.disabled = true;
            spinner.classList.remove('d-none');
            text.textContent = 'Memproses...';
            errorBox.textContent = '';

            fetch('<?= base_url('auth/login') ?>', {
                    method: 'POST',
                    body: data
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        window.location.href = res.redirect;
                    } else {
                        errorBox.textContent = res.message;
                    }
                })
                .catch((e) => {
                    console.log(e);
                    errorBox.textContent = 'Terjadi kesalahan saat login.';
                })
                .finally(() => {
                    // Matikan loading setelah selesai
                    btn.disabled = false;
                    spinner.classList.add('d-none');
                    text.textContent = 'MASUK';
                });
        });


        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            backToTop.style.display = window.scrollY > 300 ? 'block' : 'none';
        });
        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

    <script>
        function openGooglePopup() {
            const width = 500;
            const height = 600;
            const left = (screen.width - width) / 2;
            const top = (screen.height - height) / 2;

            const popup = window.open(
                "<?= base_url('auth/google') ?>",
                "Login with Google",
                `width=${width},height=${height},top=${top},left=${left}`
            );

            const checkPopup = setInterval(() => {
                if (!popup || popup.closed) {
                    clearInterval(checkPopup);
                    // Optionally: reload or redirect after login
                    window.location.href = "<?= base_url('alumni/dashboard') ?>";
                }
            }, 1000);
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>