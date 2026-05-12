<?= $this->extend('layouts/admin_main') ?>
<?php
/** @var array $tracer */
/** @var array $group_fields */
/** @var array $groupedFields */
?>
<?= $this->section('content') ?>

<h4 class="mb-3"><i class="bi bi-person-lines-fill"></i> Detail Tracer Study</h4>

<a href="<?= base_url('admin/tracer') ?>" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>

<?php if ($tracer): ?>
    <div class="card mb-4">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <span>Data Tracer Study Lengkap</span>
            <a href="<?= base_url('alumni/tracer/edit') ?>" class="btn btn-light btn-sm">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
        </div>
        <div class="card-body">

            <div class="row mb-4">

                <div class="col-md-6">
                    <p><strong>Nama:</strong> <?= esc($tracer['nama']) ?></p>
                    <p><strong>NIM:</strong> <?= esc($tracer['nim']) ?></p>
                    <p><strong>Email:</strong> <?= esc($tracer['email']) ?></p>
                </div>

                <div class="col-md-6">
                    <p><strong>Program Studi:</strong> <?= esc($tracer['nama_prodi']) ?></p>
                    <p><strong>Jenjang:</strong> <?= esc($tracer['jenjang']) ?></p>
                </div>

            </div>

            <hr>

            <?php foreach ($groupedFields as $header => $fields): ?>

                <?php

                $hasValue = false;

                foreach ($fields as $field) {

                    $fieldName = $field['field_name'];

                    if (
                        isset($tracer[$fieldName]) &&
                        $tracer[$fieldName] !== '' &&
                        $tracer[$fieldName] !== null
                    ) {
                        $hasValue = true;
                        break;
                    }
                }

                if (!$hasValue) {
                    continue;
                }

                ?>

                <h5 class="fw-bold text-success mt-4 mb-3">
                    <?= esc($header) ?>
                </h5>

                <div class="row">

                    <?php foreach ($fields as $field): ?>

                        <?php

                        $fieldName = $field['field_name'];

                        $value = $tracer[$fieldName] ?? null;

                        if ($value === '' || $value === null) {
                            continue;
                        }

                        ?>

                        <div class="col-md-6 mb-3">

                            <div class="border rounded-4 p-3 h-100 bg-light">

                                <div class="text-muted small mb-1">
                                    <?= esc($field['label']) ?>
                                </div>

                                <div class="fw-semibold">

                                    <?php

                                    if (
                                        is_numeric($value) &&
                                        (
                                            str_contains($fieldName, 'gaji') ||
                                            str_contains($fieldName, 'pendapatan')
                                        )
                                    ) {

                                        echo 'Rp ' . number_format($value, 0, ',', '.');
                                    } else {

                                        echo nl2br(esc($value));
                                    }

                                    ?>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endforeach; ?>

            <div class="text-end text-muted mt-4">
                <small>
                    Diperbarui:
                    <?= date('d M Y H:i', strtotime($tracer['updated_at'] ?? $tracer['created_at'])) ?>
                </small>
            </div>

        </div>
    </div>
<?php else: ?>
    <div class="alert alert-warning">
        Data Tracer Study belum diisi. <a href="<?= base_url('alumni/tracer/create') ?>">Isi sekarang</a>.
    </div>
<?php endif; ?>


<?= $this->endSection() ?>