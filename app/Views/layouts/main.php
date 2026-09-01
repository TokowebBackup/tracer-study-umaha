<!-- app/Views/layouts/main.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Tracer Study UMAHA</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon"
        href="<?= base_url('/assets/img/logo-umaha-192.png') ?>"
        type="image/x-icon">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {

            --primary:
                #006633;

            --secondary:
                #009966;

            --dark:
                #041d14;

            --light:
                #f8fffc;

            --white:
                #ffffff;

            --text:
                #0f172a;

            --muted:
                #64748b;

            --glass:
                rgba(255, 255, 255, .12);

            --border:
                rgba(255, 255, 255, .18);
        }

        * {

            margin: 0;

            padding: 0;

            box-sizing: border-box;
        }

        html {

            scroll-behavior: smooth;
        }

        body {

            font-family: 'Plus Jakarta Sans', sans-serif;

            background:
                radial-gradient(circle at top left,
                    rgba(0, 153, 102, .08),
                    transparent 35%),

                radial-gradient(circle at bottom right,
                    rgba(0, 102, 51, .08),
                    transparent 35%),

                #f6fbf9;

            color: var(--text);

            overflow-x: hidden;

            cursor: none;
        }

        /* CUSTOM CURSOR */
        .custom-cursor {

            position: fixed;

            top: 0;
            left: 0;

            width: 42px;
            height: 42px;

            border:
                2px solid rgba(0, 153, 102, .6);

            border-radius: 50%;

            pointer-events: none !important;

            user-select: none;

            transform: translate(-50%, -50%);

            z-index: 9999;

            /* HAPUS backdrop-filter */
            /* backdrop-filter: blur(4px); */

            background:
                rgba(255, 255, 255, .04);

            mix-blend-mode: normal;

            will-change:
                transform,
                top,
                left;

            backdrop-filter: blur(4px);

            transition:
                transform .08s linear,
                width .2s ease,
                height .2s ease,
                background .2s ease;

            /* FIX IMPORTANT */
            isolation: isolate;
        }

        body.modal-open .custom-cursor {

            display: none !important;
        }

        .custom-cursor::after {

            content: '';

            position: absolute;

            top: 50%;
            left: 50%;

            width: 8px;
            height: 8px;

            background:
                linear-gradient(135deg,
                    var(--primary),
                    var(--secondary));

            border-radius: 50%;

            transform: translate(-50%, -50%);
        }

        /* a:hover~.custom-cursor,
        button:hover~.custom-cursor {

            transform: translate(-50%, -50%) scale(1.2);
        } */

        /* SCROLLBAR */
        ::-webkit-scrollbar {

            width: 10px;

            height: 10px;
        }

        ::-webkit-scrollbar-track {

            background: #ecfdf5;
        }

        ::-webkit-scrollbar-thumb {

            background:
                linear-gradient(180deg,
                    var(--primary),
                    var(--secondary));

            border-radius: 20px;
        }

        /* STICKY HEADER */
        .sticky-header {

            position: sticky;

            top: 0;

            z-index: 999;

            backdrop-filter: blur(16px);

            background:
                rgba(255, 255, 255, .82);

            border-bottom:
                1px solid rgba(255, 255, 255, .2);

            transition: .3s ease;

            box-shadow:
                0 10px 35px rgba(0, 0, 0, .03);
        }

        /* FUTURISTIC RIBBON */
        .ribbon-wrapper {

            position: relative;

            min-width: 50%;

            margin-left: -2rem;
        }

        .ribbon-front {

            position: relative;

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 14px;

            padding:
                20px 45px;

            background:
                linear-gradient(135deg,
                    #006633 0%,
                    #009966 100%);

            color: white;

            font-size: 20px;

            font-weight: 700;

            clip-path:
                polygon(0 0,
                    100% 0,
                    95% 100%,
                    0 100%);

            overflow: hidden;

            box-shadow:
                0 15px 30px rgba(0, 102, 51, .25);
        }

        .ribbon-front::before {

            content: '';

            position: absolute;

            width: 180px;
            height: 180px;

            background:
                rgba(255, 255, 255, .08);

            border-radius: 50%;

            right: -40px;
            top: -60px;
        }

        .header-row {

            display: flex;

            justify-content: space-between;

            align-items: stretch;

            padding: 0 24px;
        }

        /* SOSMED */
        .sosmed-icons {

            display: flex;

            align-items: center;

            gap: 14px;
        }

        .sosmed-icons a {

            width: 42px;
            height: 42px;

            border-radius: 14px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                rgba(0, 153, 102, .08);

            color: var(--primary);

            font-size: 18px;

            text-decoration: none;

            transition: .25s ease;
        }

        .sosmed-icons a:hover {

            background:
                linear-gradient(135deg,
                    var(--primary),
                    var(--secondary));

            color: white;

            transform:
                translateY(-3px);
        }

        /* MODERN TABLE */
        .table-modern {

            border-collapse: separate;

            border-spacing: 0;

            border-radius: 24px;

            overflow: hidden;

            background: white;

            box-shadow:
                0 12px 30px rgba(0, 0, 0, .04);
        }

        .table-modern thead {

            background:
                linear-gradient(135deg,
                    #006633,
                    #009966);

            color: white;
        }

        .table-modern th {

            border: none !important;

            padding: 18px;

            font-size: 13px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .5px;

            white-space: nowrap;
        }

        .table-modern td {

            padding: 18px;

            vertical-align: middle;

            border-color: #eef2f7;

            font-size: 14px;
        }

        .table-modern tbody tr {

            transition: .25s ease;
        }

        .table-modern tbody tr:hover {

            background: #f0fdf4;

            transform: scale(1.002);
        }

        /* GLASS CARD */
        .glass-card {

            background:
                rgba(255, 255, 255, .7);

            backdrop-filter: blur(16px);

            border:
                1px solid rgba(255, 255, 255, .25);

            border-radius: 28px;

            box-shadow:
                0 10px 35px rgba(0, 0, 0, .05);
        }

        /* CARD HOVER */
        .card-hover {

            transition:
                transform .25s ease,
                box-shadow .25s ease;
        }

        .card-hover:hover {

            transform:
                translateY(-6px);

            box-shadow:
                0 18px 40px rgba(0, 102, 51, .12);
        }

        /* BUTTON */
        .btn-modern {

            border: none;

            border-radius: 18px;

            padding:
                12px 22px;

            font-weight: 700;

            transition: .25s ease;
        }

        .btn-gradient {

            background:
                linear-gradient(135deg,
                    var(--primary),
                    var(--secondary));

            color: white;
        }

        .btn-gradient:hover {

            color: white;

            transform:
                translateY(-2px);

            box-shadow:
                0 10px 24px rgba(0, 153, 102, .25);
        }

        /* LOGIN MODAL */
        .modal-content {

            border: none;

            border-radius: 28px;

            overflow: hidden;

            box-shadow:
                0 25px 50px rgba(0, 0, 0, .15);
        }

        .modal-header {

            background:
                linear-gradient(135deg,
                    #006633,
                    #009966);

            color: white;

            border: none;

            padding: 24px 28px;
        }

        .modal-title {

            font-weight: 700;
        }

        .modal-body {

            padding: 28px;
        }

        .modal-footer {

            border: none;

            padding:
                0 28px 28px;
        }

        .form-control {

            border-radius: 16px;

            border: 1px solid #dbe4ea;

            padding: 14px 16px;

            font-size: 14px;

            transition: .25s ease;
        }

        .form-control:focus {

            border-color: #009966;

            box-shadow:
                0 0 0 .25rem rgba(0, 153, 102, .12);
        }

        /* ANIMATION */
        .animate-fade {

            animation:
                fadeInUp .5s ease forwards;

            opacity: 0;

            transform: translateY(12px);
        }

        @keyframes fadeInUp {

            to {

                opacity: 1;

                transform: translateY(0);
            }
        }

        #togglePassword {

            position: absolute;

            top: 50%;

            right: 14px;

            transform: translateY(-50%);

            border: none;

            background: transparent;

            width: 36px;

            height: 36px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #64748b;

            cursor: pointer;

            z-index: 10;
        }

        .position-relative {
            z-index: 1;
        }

        #togglePassword i {

            font-size: 18px;

            pointer-events: none;
        }

        /* BACK TO TOP */
        .back-to-top {

            position: fixed;

            right: 24px;
            bottom: 24px;

            width: 52px;
            height: 52px;

            border: none;

            border-radius: 18px;

            display: none;

            align-items: center;

            justify-content: center;

            background:
                linear-gradient(135deg,
                    var(--primary),
                    var(--secondary));

            color: white;

            z-index: 999;

            box-shadow:
                0 15px 30px rgba(0, 102, 51, .25);

            transition: .25s ease;
        }

        .back-to-top:hover {

            transform:
                translateY(-4px);
        }

        /* MOBILE */
        @media(max-width:768px) {

            body {

                cursor: auto !important;
            }

            .custom-cursor {

                display: none !important;
            }

            .header-row {

                flex-direction: column;

                gap: 12px;

                padding: 12px;
            }

            .ribbon-wrapper {

                width: 100%;

                margin-left: 0;
            }

            .ribbon-front {

                justify-content: center;

                clip-path: none;

                border-radius: 20px;

                text-align: center;
            }
        }

        body.modal-open {

            cursor: default !important;
        }

        body.modal-open * {

            cursor: default !important;
        }

        body.modal-open .custom-cursor {

            display: none !important;
        }

        /* PASSWORD TOGGLE FIX */
        .password-wrapper {

            position: relative;

            width: 100%;
        }

        .password-input {

            padding-right: 52px !important;
        }

        .toggle-password {

            position: absolute;

            top: 50%;

            right: 16px;

            transform: translateY(-50%);

            z-index: 99999;

            width: 34px;

            height: 34px;

            display: flex;

            align-items: center;

            justify-content: center;

            cursor: pointer;

            color: #64748b;

            user-select: none;

            pointer-events: auto;
        }

        .toggle-password i {

            font-size: 20px;

            pointer-events: none;
        }

        /* FIX MODAL STACKING */
        .modal {

            z-index: 2000;
        }

        .modal-backdrop {

            z-index: 1990;
        }

        /* FIX CUSTOM CURSOR */
        .custom-cursor {

            pointer-events: none !important;
        }

        /* FIX BOOTSTRAP INPUT */
        .form-control {

            position: relative;

            z-index: 1;
        }
    </style>
</head>

<body>

    <!-- CUSTOM CURSOR -->
    <div class="custom-cursor"
        id="cursor"></div>

    <!-- HEADER -->
    <?= $this->include('partials/header_main') ?>

    <!-- CONTENT -->
    <main class="animate-fade">

        <?= $this->renderSection('content') ?>

    </main>

    <!-- LOGIN MODAL -->
    <div class="modal fade"
        id="loginModal"
        tabindex="-1"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <form id="loginForm"
                class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="bi bi-shield-lock-fill me-2"></i>
                        Login Alumni UMAHA

                    </h5>

                    <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Email

                        </label>

                        <input type="email"
                            class="form-control"
                            name="email"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Password
                        </label>

                        <div class="password-wrapper">

                            <input type="password"
                                class="form-control password-input"
                                name="password"
                                id="loginPassword"
                                required>

                            <span id="togglePassword"
                                class="toggle-password">

                                <i class="bi bi-eye-slash"></i>

                            </span>

                        </div>

                    </div>

                    <div id="loginError"
                        class="text-danger small mt-2"></div>

                </div>

                <div class="modal-footer flex-column">

                    <button id="loginButton"
                        class="btn btn-gradient btn-modern w-100"
                        type="submit">

                        <span class="spinner-border spinner-border-sm me-2 d-none"
                            role="status"
                            id="loginSpinner"></span>

                        <span id="loginText">

                            MASUK

                        </span>

                    </button>

                    <!-- GOOGLE -->
                    <a href="#"
                        onclick="openGooglePopup()"
                        class="btn btn-light border rounded-4 shadow-sm w-100 py-3 mt-3 fw-semibold">

                        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg"
                            width="20"
                            class="me-2">

                        Masuk dengan Google

                    </a>

                </div>

            </form>

        </div>

    </div>

    <!-- FOOTER -->
    <?= $this->include('partials/footer_main') ?>

    <!-- BACK TO TOP -->
    <button class="back-to-top"
        id="backToTop">

        <i class="bi bi-arrow-up"></i>

    </button>

    <!-- JS -->
    <script>
        // CURSOR
        if (window.matchMedia("(pointer:fine)").matches) {

            const cursor =
                document.getElementById('cursor');

            document.addEventListener('mousemove', e => {

                cursor.style.top =
                    `${e.clientY}px`;

                cursor.style.left =
                    `${e.clientX}px`;
            });
        }

        // PASSWORD TOGGLE
        // PASSWORD TOGGLE FIX
        document.addEventListener('DOMContentLoaded', function() {

            const togglePassword =
                document.getElementById('togglePassword');

            const passwordInput =
                document.getElementById('loginPassword');

            const icon =
                togglePassword.querySelector('i');

            togglePassword.addEventListener('click', function(e) {

                e.preventDefault();

                e.stopPropagation();

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

        });


        // BACK TO TOP
        const backToTop =
            document.getElementById('backToTop');

        window.addEventListener('scroll', () => {

            backToTop.style.display =
                window.scrollY > 300 ?
                'flex' :
                'none';
        });

        backToTop.addEventListener('click', () => {

            window.scrollTo({

                top: 0,
                behavior: 'smooth'
            });
        });

        // GOOGLE POPUP
        function openGooglePopup() {

            const width = 500;
            const height = 650;

            const left =
                (screen.width - width) / 2;

            const top =
                (screen.height - height) / 2;

            const popup = window.open(

                "<?= base_url('auth/google') ?>",

                "Login with Google",

                `width=${width},
                height=${height},
                top=${top},
                left=${left}`

            );

            const checkPopup =
                setInterval(() => {

                    if (!popup || popup.closed) {

                        clearInterval(checkPopup);

                        window.location.href =
                            "<?= base_url('alumni/dashboard') ?>";
                    }

                }, 1000);
        }
    </script>

    <script>
        // CUSTOM CURSOR
        if (window.matchMedia("(pointer:fine)").matches) {

            const cursor =
                document.getElementById('cursor');

            document.addEventListener('mousemove', e => {

                cursor.style.top =
                    `${e.clientY}px`;

                cursor.style.left =
                    `${e.clientX}px`;
            });

            // HOVER EFFECT
            const hoverElements =
                document.querySelectorAll(
                    'a, button, .btn, input, textarea, select'
                );

            hoverElements.forEach(el => {

                el.addEventListener('mouseenter', () => {

                    cursor.style.transform =
                        'translate(-50%, -50%) scale(1.35)';

                    cursor.style.background =
                        'rgba(0, 153, 102, .10)';
                });

                el.addEventListener('mouseleave', () => {

                    cursor.style.transform =
                        'translate(-50%, -50%) scale(1)';

                    cursor.style.background =
                        'rgba(255,255,255,.04)';
                });
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const form = document.getElementById('loginForm');

            form.addEventListener('submit', async function(e) {

                e.preventDefault();

                const btn = document.getElementById('loginButton');

                const spinner = document.getElementById('loginSpinner');

                const text = document.getElementById('loginText');

                const errorBox = document.getElementById('loginError');

                errorBox.textContent = '';

                btn.disabled = true;

                spinner.classList.remove('d-none');

                text.textContent = 'Memproses...';

                try {

                    const response = await fetch(
                        "<?= base_url('auth/login') ?>", {

                            method: 'POST',

                            body: new FormData(form),

                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        }
                    );

                    const res = await response.json();

                    if (res.success) {

                        await Swal.fire({

                            icon: 'success',

                            title: 'Login berhasil',

                            text: 'Mengalihkan ke dashboard...',

                            timer: 1200,

                            showConfirmButton: false

                        });

                        window.location.href = res.redirect;

                    } else {

                        errorBox.textContent = res.message;

                        Swal.fire({

                            icon: 'error',

                            title: 'Login gagal',

                            text: res.message

                        });
                    }

                } catch (err) {

                    console.error(err);

                    errorBox.textContent =
                        'Terjadi kesalahan saat login.';

                    Swal.fire({

                        icon: 'error',

                        title: 'Server Error',

                        text: 'Terjadi kesalahan saat login'

                    });

                } finally {

                    btn.disabled = false;

                    spinner.classList.add('d-none');

                    text.textContent = 'MASUK';
                }

            });

        });
    </script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>