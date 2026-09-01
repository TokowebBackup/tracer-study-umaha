<!-- app/Views/kuesioner_alumni.php -->

<?= $this->extend('layouts/main') ?>


<?php
/** @var array $fields_step1 */
/** @var array $fields_step2 */
/** @var array $select_options */
?>


<?= $this->section('content') ?>

<div class="container mt-4 mb-5">

    <h3 class="mb-4">
        Form Kuesioner Tracer Study
    </h3>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('kuesioner/alumni/simpan') ?>" method="post">

        <?= csrf_field() ?>

        <input
            type="hidden"
            name="tahun_pengisian"
            value="<?= date('Y') ?>">

        <!-- ===================================================== -->
        <!-- STEP 1 -->
        <!-- ===================================================== -->

        <div id="step-1" class="step">

            <?php

            $groups = [];

            foreach ($fields_step1 as $field) {

                $header = $field['header'] ?: 'Informasi Alumni';

                $groups[$header][] = $field;
            }

            ?>

            <?php foreach ($groups as $header => $fields): ?>

                <div class="field-group mb-4">

                    <h5 class="mb-3 fw-bold text-primary">
                        <?= esc($header) ?>
                    </h5>

                    <div class="row">

                        <?php foreach ($fields as $field): ?>

                            <?php

                            $name = $field['field_name'];

                            $required = $field['required']
                                ? 'required'
                                : '';

                            $options = json_decode(
                                $field['options'],
                                true
                            );

                            $value = old($name)
                                ?? ($alumni[$name]
                                    ?? ($tracer[$name] ?? ''));

                            ?>

                            <div
                                class="col-md-6 mb-3 conditional-field"
                                data-conditional-field="<?= esc($field['conditional_field'] ?? '') ?>"
                                data-conditional-value="<?= esc($field['conditional_value'] ?? '') ?>">

                                <label class="form-label">

                                    <?= esc($field['label']) ?>

                                    <?php if ($field['required']): ?>
                                        <span class="text-danger">*</span>
                                    <?php endif; ?>

                                </label>

                                <?php switch ($field['type']):

                                    case 'text':
                                    case 'number':
                                    case 'email':
                                    case 'date':
                                ?>

                                        <input
                                            type="<?= esc($field['type']) ?>"
                                            name="<?= esc($name) ?>"
                                            value="<?= esc($value) ?>"
                                            class="form-control"
                                            data-required="<?= $field['required'] ? '1' : '0' ?>"
                                            <?= $required ?>>

                                        <?php break; ?>

                                    <?php
                                    case 'textarea': ?>

                                        <textarea
                                            name="<?= esc($name) ?>"
                                            class="form-control"
                                            rows="3"
                                            data-required="<?= $field['required'] ? '1' : '0' ?>"
                                            <?= $required ?>><?= esc($value) ?></textarea>

                                        <?php break; ?>

                                    <?php
                                    case 'select': ?>

                                        <select
                                            name="<?= esc($name) ?>"
                                            class="form-select"
                                            data-required="<?= $field['required'] ? '1' : '0' ?>"
                                            <?= $required ?>>

                                            <option value="">
                                                Pilih
                                            </option>

                                            <?php if (
                                                !empty($field['source_table']) &&
                                                isset($select_options[$field['source_table']])
                                            ): ?>

                                                <?php foreach ($select_options[$field['source_table']] as $opt):

                                                    $optValue = $opt['value']
                                                        ?? array_values($opt)[0];

                                                    $optLabel = $opt['label']
                                                        ?? ($opt[1] ?? $optValue);

                                                ?>

                                                    <option
                                                        value="<?= esc($optValue) ?>"
                                                        <?= $optValue == $value ? 'selected' : '' ?>>

                                                        <?= esc($optLabel) ?>

                                                    </option>

                                                <?php endforeach; ?>

                                            <?php elseif (is_array($options)): ?>

                                                <?php foreach ($options as $opt): ?>

                                                    <option
                                                        value="<?= esc($opt) ?>"
                                                        <?= $opt == $value ? 'selected' : '' ?>>

                                                        <?= esc($opt) ?>

                                                    </option>

                                                <?php endforeach; ?>

                                            <?php endif; ?>

                                        </select>

                                        <?php break; ?>

                                    <?php
                                    default: ?>

                                        <input
                                            type="text"
                                            name="<?= esc($name) ?>"
                                            value="<?= esc($value) ?>"
                                            class="form-control"
                                            data-required="<?= $field['required'] ? '1' : '0' ?>"
                                            <?= $required ?>>

                                <?php endswitch; ?>

                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endforeach; ?>

            <button
                type="button"
                class="btn btn-success"
                onclick="nextStep()">

                Lanjut
                <i class="bi bi-arrow-right"></i>

            </button>

        </div>

        <!-- ===================================================== -->
        <!-- STEP 2 -->
        <!-- ===================================================== -->

        <div id="step-2" class="step d-none">

            <?php

            $groups2 = [];

            foreach ($fields_step2 as $field) {

                $header = $field['header']
                    ?: 'Informasi Tambahan';

                $groups2[$header][] = $field;
            }

            ?>

            <?php foreach ($groups2 as $header => $fields): ?>

                <div class="field-group mb-4">

                    <h5 class="mb-3 fw-bold text-success">
                        <?= esc($header) ?>
                    </h5>

                    <div class="row">

                        <?php foreach ($fields as $field): ?>

                            <?php

                            $name = $field['field_name'];

                            $required = $field['required']
                                ? 'required'
                                : '';

                            $options = json_decode(
                                $field['options'],
                                true
                            );

                            $value = old($name)
                                ?? ($tracer[$name] ?? '');

                            ?>

                            <div
                                class="col-md-6 mb-3 conditional-field"
                                data-conditional-field="<?= esc($field['conditional_field'] ?? '') ?>"
                                data-conditional-value="<?= esc($field['conditional_value'] ?? '') ?>">

                                <label class="form-label">

                                    <?= esc($field['label']) ?>

                                    <?php if ($field['required']): ?>
                                        <span class="text-danger">*</span>
                                    <?php endif; ?>

                                </label>

                                <?php switch ($field['type']):

                                    case 'text':
                                    case 'number':
                                    case 'email':
                                    case 'date':
                                ?>

                                        <input
                                            type="<?= esc($field['type']) ?>"
                                            name="<?= esc($name) ?>"
                                            value="<?= esc($value) ?>"
                                            class="form-control"
                                            data-required="<?= $field['required'] ? '1' : '0' ?>"
                                            <?= $required ?>>

                                        <?php break; ?>

                                    <?php
                                    case 'textarea': ?>

                                        <textarea
                                            name="<?= esc($name) ?>"
                                            class="form-control"
                                            rows="3"
                                            data-required="<?= $field['required'] ? '1' : '0' ?>"
                                            <?= $required ?>><?= esc($value) ?></textarea>

                                        <?php break; ?>

                                    <?php
                                    case 'select': ?>

                                        <select
                                            name="<?= esc($name) ?>"
                                            class="form-select"
                                            data-required="<?= $field['required'] ? '1' : '0' ?>"
                                            <?= $required ?>>

                                            <option value="">
                                                Pilih
                                            </option>

                                            <?php if (
                                                !empty($field['source_table']) &&
                                                isset($select_options[$field['source_table']])
                                            ): ?>

                                                <?php foreach ($select_options[$field['source_table']] as $opt):

                                                    $optValue = $opt['value']
                                                        ?? array_values($opt)[0];

                                                    $optLabel = $opt['label']
                                                        ?? ($opt[1] ?? $optValue);

                                                ?>

                                                    <option
                                                        value="<?= esc($optValue) ?>"
                                                        <?= $optValue == $value ? 'selected' : '' ?>>

                                                        <?= esc($optLabel) ?>

                                                    </option>

                                                <?php endforeach; ?>

                                            <?php elseif (is_array($options)): ?>

                                                <?php foreach ($options as $opt): ?>

                                                    <option
                                                        value="<?= esc($opt) ?>"
                                                        <?= $opt == $value ? 'selected' : '' ?>>

                                                        <?= esc($opt) ?>

                                                    </option>

                                                <?php endforeach; ?>

                                            <?php endif; ?>

                                        </select>

                                        <?php break; ?>

                                <?php endswitch; ?>

                            </div>

                        <?php endforeach; ?>

                        <!-- ===================================== -->
                        <!-- TAMBAHAN ALAMAT PERUSAHAAN -->
                        <!-- ===================================== -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">
                                Alamat Perusahaan
                            </label>

                            <textarea
                                name="alamat_perusahaan"
                                class="form-control"
                                rows="3"><?= old(
                                                'alamat_perusahaan',
                                                $tracer['alamat_perusahaan'] ?? ''
                                            ) ?></textarea>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

            <div class="d-flex justify-content-between">

                <button
                    type="button"
                    class="btn btn-secondary"
                    onclick="prevStep()">

                    <i class="bi bi-arrow-left"></i>
                    Kembali

                </button>

                <button
                    type="submit"
                    id="submitTracer"
                    class="btn btn-primary">

                    Kirim Kuesioner

                </button>

            </div>

        </div>

    </form>

</div>

<script>
    function validateStep(stepId) {

        const requiredFields = document.querySelectorAll(
            `${stepId} [required]:not([disabled])`
        );

        let isValid = true;

        requiredFields.forEach(field => {

            let isEmpty = false;

            if (
                field.type === 'checkbox' ||
                field.type === 'radio'
            ) {

                isEmpty = !field.checked;

            } else {

                isEmpty = !(
                    field.value &&
                    field.value.trim()
                );
            }

            if (isEmpty) {

                field.classList.add('is-invalid');

                isValid = false;

            } else {

                field.classList.remove('is-invalid');
            }
        });

        return isValid;
    }

    function nextStep() {

        if (!validateStep('#step-1')) {

            Swal.fire({
                icon: 'warning',
                title: 'Lengkapi Data',
                text: 'Lengkapi seluruh field wajib.',
            });

            return;
        }

        document
            .getElementById('step-1')
            .classList.add('d-none');

        document
            .getElementById('step-2')
            .classList.remove('d-none');

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    function prevStep() {

        document
            .getElementById('step-2')
            .classList.add('d-none');

        document
            .getElementById('step-1')
            .classList.remove('d-none');

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    document.addEventListener('DOMContentLoaded', function() {

        function toggleConditionalFields() {

            document.querySelectorAll('.conditional-field')
                .forEach(field => {

                    const conditionalField =
                        (field.dataset.conditionalField || '').trim();

                    const conditionalValue =
                        (field.dataset.conditionalValue || '')
                        .trim()
                        .toLowerCase();

                    if (!conditionalField || !conditionalValue) {

                        field.classList.remove('d-none');

                        field.querySelectorAll(
                            'input, textarea, select'
                        ).forEach(input => {

                            input.disabled = false;

                            if (input.dataset.required === '1') {
                                input.required = true;
                            }
                        });

                        return;
                    }

                    const controllerInput = document.querySelector(
                        `[name="${conditionalField}"]`
                    );

                    const selectedValue = controllerInput ?
                        controllerInput.value.trim().toLowerCase() :
                        '';

                    if (selectedValue === conditionalValue) {

                        field.classList.remove('d-none');

                        field.querySelectorAll(
                            'input, textarea, select'
                        ).forEach(input => {

                            input.disabled = false;

                            if (input.dataset.required === '1') {
                                input.required = true;
                            }
                        });

                    } else {

                        field.classList.add('d-none');

                        field.querySelectorAll(
                            'input, textarea, select'
                        ).forEach(input => {

                            input.disabled = true;
                            input.required = false;
                        });
                    }
                });
        }

        document.addEventListener('change', function(e) {

            if (
                e.target.matches('select') ||
                e.target.matches('input')
            ) {

                toggleConditionalFields();
            }
        });

        document
            .getElementById('submitTracer')
            .addEventListener('click', function(e) {

                if (!validateStep('#step-2')) {

                    e.preventDefault();

                    Swal.fire({
                        icon: 'warning',
                        title: 'Form Belum Lengkap',
                        text: 'Lengkapi seluruh data wajib.',
                    });
                }
            });

        toggleConditionalFields();
    });
</script>

<?= $this->endSection() ?>