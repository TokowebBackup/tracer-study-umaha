<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Tracer UMAHA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                linear-gradient(rgba(255, 255, 255, 0.42),
                    rgba(255, 255, 255, 0.41)),
                url('<?= base_url("assets/img/bg-umaha.jpg") ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(5px);
            border-radius: 28px;
            padding: 40px;
            box-shadow:
                0 15px 40px rgba(0, 0, 0, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.4);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            width: 250px;
            margin-bottom: 15px;
        }

        .title {
            color: #0b1f3a;
            font-weight: 800;
            font-size: 30px;
        }

        .subtitle {
            color: #4d5b6b;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-label {
            color: #1f2937;
            font-weight: 600;
        }

        .form-control {
            height: 54px;
            border-radius: 16px;
            border: 1px solid #dbe2ea;
            background: rgba(255, 255, 255, 0.9);
            color: #1f2937;
            padding-left: 15px;
        }

        .form-control:focus {
            background: white;
            color: #1f2937;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.08);
            border-color: #0d6efd;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .input-group-text {
            background: rgba(58, 58, 58, 0.14);
            border: none;
            color: white;
            border-radius: 0 14px 14px 0;
            cursor: pointer;
        }

        .btn-login {
            height: 54px;
            border-radius: 16px;
            background: linear-gradient(135deg,
                    #0f766e,
                    #16a34a);
            border: none;
            font-weight: 700;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow:
                0 10px 25px rgba(22, 163, 74, 0.25);
        }

        .alert {
            border-radius: 14px;
            font-size: 14px;
        }

        .footer-text {
            color: rgba(21, 21, 21, 0.62);
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
        }

        .bg-overlay {
            position: absolute;
            inset: 0;
            backdrop-filter: blur(4px);
            background:
                linear-gradient(135deg,
                    rgba(255, 255, 255, 0.65),
                    rgba(255, 255, 255, 0.35));
            z-index: 1;
        }

        .login-card {
            position: relative;
            z-index: 10;
        }

        @media(max-width: 576px) {
            .login-card {
                margin: 20px;
                padding: 30px 25px;
            }
        }
    </style>
</head>

<body>
    <div class="bg-overlay"></div>

    <div class="login-card">

        <div class="text-center">

            <a href="<?= base_url('/') ?>">
                <img src="<?= base_url('/assets/img/logo-umaha.png') ?>"
                    class="logo"
                    alt="UMAHA">
            </a>

            <!-- <div class="title">
                Admin Tracer Study
            </div> -->

            <!-- <div class="subtitle">
                Universitas Maarif Hasyim Latif
            </div> -->
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif ?>

        <form action="<?= base_url('admin/login') ?>" method="post">

            <div class="mb-3">
                <label class="form-label">
                    Username
                </label>

                <input type="text"
                    name="username"
                    class="form-control"
                    placeholder="Masukkan username"
                    required>
            </div>

            <div class="mb-4">
                <label class="form-label">
                    Password
                </label>

                <div class="input-group">

                    <input type="password"
                        name="password"
                        id="passwordInput"
                        class="form-control"
                        placeholder="Masukkan password"
                        required>

                    <span class="input-group-text"
                        onclick="togglePassword()">

                        <i class="fa-solid fa-eye-slash"
                            id="eyeIcon"></i>
                    </span>

                </div>
            </div>

            <button class="btn btn-login text-white w-100">
                <i class="fa-solid fa-right-to-bracket me-2"></i>
                Login Admin
            </button>

        </form>

        <div class="footer-text">
            © <?= date('Y') ?> Tracer Study UMAHA
        </div>

    </div>

    <script>
        function togglePassword() {

            const passwordInput =
                document.getElementById('passwordInput');

            const eyeIcon =
                document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {

                passwordInput.type = 'text';

                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');

            } else {

                passwordInput.type = 'password';

                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }
    </script>

</body>

</html>