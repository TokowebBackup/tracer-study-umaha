<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('content') ?>

<div class="container-fluid p-4">

    <div class="card shadow-sm border-0 rounded-4">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Monitoring Request Pengguna
            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Alumni</th>
                            <th>Perusahaan</th>
                            <th>Status</th>
                            <th>Expired</th>
                            <th>Dibuat</th>
                            <th>Link</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($requests as $i => $r): ?>

                            <?php

                            $link = base_url(
                                'kuesioner/pengguna/' . $r['token']
                            );
                            ?>

                            <tr>

                                <td>
                                    <?= $i + 1 ?>
                                </td>

                                <td>

                                    <strong>
                                        <?= esc($r['nama']) ?>
                                    </strong>

                                    <br>

                                    <small>
                                        <?= esc($r['nim']) ?>
                                    </small>

                                </td>

                                <td>
                                    <?= esc($r['nama_perusahaan']) ?>
                                </td>

                                <td>

                                    <?php if ($r['is_submitted']): ?>

                                        <span class="badge bg-success">
                                            Sudah Diisi
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-warning text-dark">
                                            Belum Diisi
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>
                                    <?= esc($r['expired_at']) ?>
                                </td>

                                <td>
                                    <?= esc($r['created_at']) ?>
                                </td>

                                <td>

                                    <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        value="<?= esc($link) ?>"
                                        readonly>

                                </td>

                                <td>

                                    <div class="d-flex gap-2">

                                        <a href="<?= esc($link) ?>"
                                            target="_blank"
                                            class="btn btn-sm btn-success rounded-3">

                                            <i class="bi bi-box-arrow-up-right"></i>

                                        </a>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-primary rounded-3 btn-copy-link"
                                            data-link="<?= esc($link) ?>">

                                            <i class="bi bi-clipboard"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?= $this->section('scripts') ?>

<script>
    $(document).on(
        'click',
        '.btn-copy-link',
        function() {

            const link =
                $(this).data('link');

            navigator.clipboard.writeText(link);

            Swal.fire({

                icon: 'success',

                title: 'Berhasil',

                text: 'Link berhasil disalin.',

                timer: 1500,

                showConfirmButton: false,
            });
        }
    );
</script>

<?= $this->endSection() ?>
<?= $this->endSection() ?>