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

    .profile-wrapper {

        padding: 35px;
    }

    .profile-grid {

        display: grid;

        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));

        gap: 24px;
    }

    .input-group-modern {

        display: flex;

        flex-direction: column;
    }

    .input-group-modern label {

        font-size: 12px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .5px;

        color: #64748b;

        margin-bottom: 10px;
    }

    .form-control-modern {

        border-radius: 18px;

        border: 1px solid #dbe2ea;

        padding: 14px 18px;

        font-size: 14px;

        font-weight: 600;

        color: #0f172a;

        background: #fff;

        transition: .25s ease;

        box-shadow: none;
    }

    .form-control-modern:focus {

        border-color: #009966;

        box-shadow:
            0 0 0 4px rgba(0, 153, 102, .12);
    }

    .readonly-box {

        background: #f8fafc !important;

        color: #64748b !important;
    }

    .btn-save {

        border: none;

        border-radius: 18px;

        padding: 14px 28px;

        font-weight: 700;

        font-size: 14px;

        background:
            linear-gradient(135deg,
                #006633 0%,
                #009966 100%);

        color: white;

        transition: .25s ease;
    }

    .btn-save:hover {

        transform: translateY(-2px);

        box-shadow:
            0 12px 24px rgba(0, 153, 102, .2);
    }

    .password-note {

        font-size: 12px;

        color: #94a3b8;

        margin-top: 8px;
    }

    @media(max-width:768px) {

        .page-hero {

            padding: 30px 24px;
        }

        .profile-wrapper {

            padding: 25px;
        }
    }
</style>

<div class="container-fluid p-4">

    <!-- HERO -->
    <div class="page-hero mb-4">

        <div>

            <h3>
                <i class="bi bi-person-circle me-2"></i>
                Profil Admin
            </h3>

            <p>
                Kelola informasi akun administrator tracer study UMAHA
            </p>

        </div>

    </div>

    <!-- ALERT -->
    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success border-0 shadow-sm rounded-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            <?= session()->getFlashdata('success') ?>

        </div>

    <?php endif ?>

    <!-- FORM -->
    <div class="glass-card">

        <div class="profile-wrapper">

            <form method="post"
                action="<?= base_url('admin/profile/update') ?>">

                <input type="hidden"
                    name="id"
                    value="<?= esc($admin['id'] ?? '') ?>">

                <div class="profile-grid">

                    <!-- USERNAME -->
                    <div class="input-group-modern">

                        <label>
                            Username
                        </label>

                        <input type="text"
                            class="form-control form-control-modern readonly-box"
                            value="<?= esc($admin['username'] ?? '') ?>"
                            readonly>

                    </div>

                    <!-- NAMA -->
                    <div class="input-group-modern">

                        <label>
                            Nama Admin
                        </label>

                        <input type="text"
                            name="nama_admin"
                            class="form-control form-control-modern"
                            value="<?= esc($admin['nama_admin'] ?? '') ?>"
                            required>

                    </div>

                    <!-- EMAIL -->
                    <div class="input-group-modern">

                        <label>
                            Email
                        </label>

                        <input type="email"
                            name="email"
                            class="form-control form-control-modern"
                            value="<?= esc($admin['email'] ?? '') ?>">

                    </div>

                    <!-- PASSWORD -->
                    <div class="input-group-modern">

                        <label>
                            Password Baru
                        </label>

                        <input type="password"
                            name="password"
                            class="form-control form-control-modern"
                            placeholder="Isi jika ingin mengganti password">

                        <div class="password-note">

                            Kosongkan jika tidak ingin mengganti password.

                        </div>

                    </div>

                </div>

                <div class="mt-4">

                    <button type="submit"
                        class="btn-save">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>