<!-- =========================
     NEO FUTURISTIC FOOTER UMAHA
========================= -->

<style>
    .footer-neo {

        position: relative;

        margin-top: 120px;

        background:
            linear-gradient(180deg,
                #03140e 0%,
                #06261b 45%,
                #083e2c 100%);

        overflow: hidden;

        border-top:
            1px solid rgba(255, 255, 255, .08);
    }

    .footer-neo,
    .footer-neo * {

        cursor: none !important;
    }

    /* GRID EFFECT */
    .footer-neo::before {

        content: '';

        position: absolute;

        inset: 0;

        background-image:
            linear-gradient(rgba(255, 255, 255, .03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, .03) 1px, transparent 1px);

        background-size: 40px 40px;

        opacity: .4;

        pointer-events: none;
    }

    /* GLOW */
    .footer-neo::after {

        content: '';

        position: absolute;

        width: 500px;
        height: 500px;

        background:
            radial-gradient(circle,
                rgba(0, 255, 170, .14),
                transparent 70%);

        top: -180px;
        right: -150px;

        pointer-events: none;
    }

    .footer-neo-content {

        position: relative;

        z-index: 2;
    }

    /* TOP SECTION */
    .footer-top {

        padding:
            80px 0 50px;
    }

    .footer-brand {

        display: flex;

        align-items: center;

        gap: 18px;

        margin-bottom: 24px;
    }

    .footer-brand-logo {

        width: 72px;
        height: 72px;

        object-fit: contain;

        padding: 14px;

        border-radius: 22px;

        background:
            rgba(255, 255, 255, .08);

        border:
            1px solid rgba(255, 255, 255, .08);

        backdrop-filter: blur(12px);

        box-shadow:
            0 12px 30px rgba(0, 0, 0, .18);
    }

    .footer-brand-text h2 {

        color: white;

        font-size: 30px;

        font-weight: 800;

        margin-bottom: 4px;
    }

    .footer-brand-text span {

        color: rgba(255, 255, 255, .6);

        font-size: 14px;
    }

    .footer-desc {

        color: rgba(255, 255, 255, .72);

        line-height: 1.9;

        font-size: 14px;

        max-width: 580px;
    }

    /* SOCIAL */
    .footer-social {

        display: flex;

        gap: 14px;

        margin-top: 28px;
    }

    .footer-social a {

        width: 52px;
        height: 52px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 18px;

        text-decoration: none;

        color: white;

        font-size: 20px;

        background:
            rgba(255, 255, 255, .06);

        border:
            1px solid rgba(255, 255, 255, .08);

        backdrop-filter: blur(14px);

        transition: .3s ease;
    }

    .footer-social a:hover {

        transform:
            translateY(-6px);

        background:
            linear-gradient(135deg,
                #00b96b,
                #00d084);

        box-shadow:
            0 15px 35px rgba(0, 208, 132, .25);
    }

    /* MENU */
    .footer-menu-title {

        color: white;

        font-size: 18px;

        font-weight: 700;

        margin-bottom: 22px;
    }

    .footer-links {

        list-style: none;

        padding: 0;

        margin: 0;
    }

    .footer-links li {

        margin-bottom: 14px;
    }

    .footer-links a {

        color: rgba(255, 255, 255, .7);

        text-decoration: none;

        transition: .25s ease;

        display: inline-flex;

        align-items: center;

        gap: 10px;
    }

    .footer-links a:hover {

        color: white;

        transform: translateX(6px);
    }

    .footer-links i {

        color: #00d084;
    }

    /* BOTTOM */
    .footer-bottom {

        border-top:
            1px solid rgba(255, 255, 255, .08);

        padding:
            24px 0;

        margin-top: 50px;
    }

    .footer-copy {

        color: rgba(255, 255, 255, .58);

        font-size: 13px;

        line-height: 1.8;
    }

    .footer-copy strong {

        color: white;
    }

    /* BADGE */
    .footer-badge {

        display: inline-flex;

        align-items: center;

        gap: 10px;

        padding:
            10px 18px;

        border-radius: 999px;

        background:
            rgba(255, 255, 255, .06);

        border:
            1px solid rgba(255, 255, 255, .08);

        color: rgba(255, 255, 255, .75);

        font-size: 13px;

        backdrop-filter: blur(12px);
    }

    .footer-badge i {

        color: #00d084;
    }

    /* BACK TO TOP */
    .back-top-neo {

        position: fixed;

        right: 24px;
        bottom: 24px;

        width: 58px;
        height: 58px;

        border: none;

        border-radius: 20px;

        display: none;

        align-items: center;

        justify-content: center;

        background:
            linear-gradient(135deg,
                #00b96b,
                #00d084);

        color: white;

        z-index: 99999;

        box-shadow:
            0 20px 35px rgba(0, 208, 132, .28);

        transition: .3s ease;
    }

    .back-top-neo:hover {

        transform:
            translateY(-6px) scale(1.04);

        box-shadow:
            0 25px 45px rgba(0, 208, 132, .35);
    }

    .back-top-neo i {

        font-size: 22px;
    }

    @media(max-width:768px) {

        .footer-brand {

            flex-direction: column;

            text-align: center;
        }

        .footer-brand-text h2 {

            font-size: 24px;
        }

        .footer-social {

            justify-content: center;
        }

        .footer-desc {

            text-align: center;
        }

        .footer-menu {

            margin-top: 40px;
        }

        .footer-bottom {

            text-align: center;
        }
    }
</style>

<!-- BACK TO TOP -->
<button id="backToTop"
    class="back-top-neo">

    <i class="bi bi-arrow-up"></i>

</button>

<!-- FOOTER -->
<footer class="footer-neo">

    <div class="container footer-neo-content">

        <div class="footer-top">

            <div class="row g-5 align-items-start">

                <!-- LEFT -->
                <div class="col-lg-6">

                    <div class="footer-brand">

                        <img src="<?= base_url('/assets/img/logo-umaha-192.png') ?>"
                            alt="UMAHA"
                            class="footer-brand-logo">

                        <div class="footer-brand-text">

                            <h2>
                                Tracer Study UMAHA
                            </h2>

                            <span>
                                Smart Alumni Tracking System
                            </span>

                        </div>

                    </div>

                    <p class="footer-desc">

                        Platform digital tracer study Universitas Maarif Hasyim Latif
                        berbasis data modern untuk monitoring alumni,
                        evaluasi lulusan, dan peningkatan kualitas pendidikan
                        secara terintegrasi dan futuristik.

                    </p>

                    <div class="footer-social">

                        <a href="#">
                            <i class="bi bi-twitter-x"></i>
                        </a>

                        <a href="#">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <a href="#">
                            <i class="bi bi-instagram"></i>
                        </a>

                        <a href="mailto:info@umaha.ac.id">
                            <i class="bi bi-envelope-fill"></i>
                        </a>

                        <a href="https://umaha.ac.id"
                            target="_blank">

                            <i class="bi bi-globe2"></i>

                        </a>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-lg-3 footer-menu">

                    <h5 class="footer-menu-title">

                        Navigasi

                    </h5>

                    <ul class="footer-links">

                        <li>
                            <a href="<?= base_url('/') ?>">
                                <i class="bi bi-chevron-right"></i>
                                Beranda
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('kuesioner/alumni') ?>">
                                <i class="bi bi-chevron-right"></i>
                                Kuesioner Alumni
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('laporan/alumni') ?>">
                                <i class="bi bi-chevron-right"></i>
                                Rekap Alumni
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('laporan/pengguna') ?>">
                                <i class="bi bi-chevron-right"></i>
                                Rekap Pengguna
                            </a>
                        </li>

                    </ul>

                </div>

                <!-- INFO -->
                <div class="col-lg-3 footer-menu">

                    <h5 class="footer-menu-title">

                        Informasi

                    </h5>

                    <div class="footer-badge mb-3">

                        <i class="bi bi-geo-alt-fill"></i>

                        Sidoarjo, Jawa Timur

                    </div>

                    <div class="footer-badge mb-3">

                        <i class="bi bi-building"></i>

                        Universitas UMAHA

                    </div>

                    <div class="footer-badge">

                        <i class="bi bi-shield-check"></i>

                        Secure Digital System

                    </div>

                </div>

            </div>

            <!-- BOTTOM -->
            <div class="footer-bottom">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div class="footer-copy">

                        &copy; <?= date('Y') ?>

                        <strong>
                            Universitas Maarif Hasyim Latif
                        </strong>

                        — All rights reserved.

                    </div>

                    <div class="footer-copy">

                        Crafted with ❤️ for UMAHA Digital Ecosystem

                    </div>

                </div>

            </div>

        </div>

    </div>

</footer>

<script>
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
</script>