<!DOCTYPE html>
<html>

<head>
    <title>Login Admin Tracer UMAHA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="col-md-4 mx-auto card p-4 shadow-sm">
            <a href="<?= base_url('/') ?>">
                <h4 class="text-center mb-3">
                    <img src="<?= base_url('/assets/img/logo-umaha.png') ?>" alt="">
                </h4>
            </a>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif ?>
            <form action="<?= base_url('admin/login') ?>" method="post">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="passwordInput" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                            <span id="eyeEmoji">🫣</span>
                        </button>
                    </div>
                </div>
                <button class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const eyeEmoji = document.getElementById('eyeEmoji');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeEmoji.textContent = '👁️'; // tampak
            } else {
                passwordInput.type = 'password';
                eyeEmoji.textContent = '🫣'; // sembunyi
            }
        }
    </script>
</body>

</html>