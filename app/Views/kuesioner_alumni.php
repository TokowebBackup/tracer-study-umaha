<!-- app/Views/kuesioner_alumni.php -->

<?= $this->extend('layouts/main') ?>

<?php
/** @var array $fields_step1 */
/** @var array $fields_step2 */
/** @var array $select_options */
?>

<?= $this->section('content') ?>

<div class="container mt-4 mb-5">

    <h3 class="mb-4">Form Kuesioner Tracer Study</h3>

    <form action="<?= base_url('kuesioner/alumni/simpan') ?>" method="post">

        <?= csrf_field() ?>

        <input type="hidden" name="tahun_pengisian" value="<?= date('Y') ?>">

        <!-- ================= STEP 1 ================= -->
        <div id="step-1" class="step">

            <?php

            $groups = [];

            foreach ($fields_step1 as $field) {

                $header = !empty($field['header'])
                    ? $field['header']
                    : 'Default Header';

                $groups[$header][] = $field;
            }

            ?>

            <?php foreach ($groups as $header => $fields): ?>

                <?php
                $hasConditional = false;

                foreach ($fields as $f) {
                    if (!empty($f['conditional_field'])) {
                        $hasConditional = true;
                        break;
                    }
                }
                ?>

                <div class="field-group"
                    <?= $hasConditional ? 'style="display:none;"' : '' ?>>

                    <h5 class="mb-3">
                        <?= esc($header) ?>
                    </h5>

                    <div class="row mb-4">

                        <?php foreach ($fields as $field): ?>

                            <div class="col-md-6 mb-3 conditional-field"
                                data-conditional-field="<?= esc($field['conditional_field'] ?? '') ?>"
                                data-conditional-value="<?= esc($field['conditional_value'] ?? '') ?>"
                                data-section="<?= esc($field['section_key'] ?? '') ?>">

                                <label class="form-label">
                                    <?= esc($field['label']) ?>

                                    <?= $field['required'] ? '*' : '' ?>
                                </label>

                                <?php

                                $name = esc($field['field_name']);

                                $required = $field['required']
                                    ? 'required'
                                    : '';

                                $options = json_decode($field['options'], true);

                                switch ($field['type']) {

                                    case 'text':
                                    case 'number':

                                        $value = old($name) ?? ($alumni[$name] ?? '');

                                        echo "
                                    <input
                                        type='{$field['type']}'
                                        name='{$name}'
                                        value='" . esc($value) . "'
                                        class='form-control'
                                        {$required}
                                    >";

                                        break;

                                    case 'textarea':

                                        $value = old($name) ?? ($alumni[$name] ?? '');

                                        echo "
                                    <textarea
                                        name='{$name}'
                                        class='form-control'
                                        rows='3'
                                        {$required}
                                    >" . esc($value) . "</textarea>";

                                        break;

                                    case 'select':

                                        $selectedValue = old($name) ?? ($alumni[$name] ?? '');

                                        echo "<select name='{$name}' class='form-select' {$required}>";

                                        echo "<option value=''>Pilih</option>";

                                        if (
                                            !empty($field['source_table']) &&
                                            isset($select_options[$field['source_table']])
                                        ) {

                                            foreach ($select_options[$field['source_table']] as $opt) {

                                                $value = esc(
                                                    $opt['value'] ?? array_values($opt)[0]
                                                );

                                                $label = esc(
                                                    $opt['label'] ?? ($opt[1] ?? $value)
                                                );

                                                $selected = ($value == $selectedValue)
                                                    ? 'selected'
                                                    : '';

                                                echo "
                                            <option value='{$value}' {$selected}>
                                                {$label}
                                            </option>";
                                            }
                                        } elseif (is_array($options)) {

                                            foreach ($options as $opt) {

                                                $selected = ($opt == $selectedValue)
                                                    ? 'selected'
                                                    : '';

                                                echo "
                                            <option value='" . esc($opt) . "' {$selected}>
                                                " . esc($opt) . "
                                            </option>";
                                            }
                                        }

                                        echo "</select>";

                                        break;

                                    default:

                                        $value = old($name) ?? '';

                                        echo "
                                    <input
                                        type='text'
                                        name='{$name}'
                                        value='" . esc($value) . "'
                                        class='form-control'
                                        {$required}
                                    >";

                                        break;
                                }

                                ?>

                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endforeach; ?>

            <button
                type="button"
                class="btn btn-success mt-3"
                onclick="nextStep()">

                Lanjut
                <i class="bi bi-arrow-bar-right"></i>

            </button>

        </div>

        <!-- ================= STEP 2 ================= -->
        <div id="step-2" class="step d-none">

            <h5 class="mb-3">Kuesioner Step 2</h5>

            <?php

            $groups2 = [];

            foreach ($fields_step2 as $field) {

                $header = !empty($field['header'])
                    ? $field['header']
                    : 'Bagian Tanpa Judul';

                $groups2[$header][] = $field;
            }

            ?>

            <?php foreach ($groups2 as $header => $fields): ?>

                <h5 class="mt-3 mb-3">
                    <?= esc($header) ?>
                </h5>

                <div class="row">

                    <?php foreach ($fields as $field): ?>

                        <div class="col-md-6 mb-3 conditional-field"
                            data-conditional-field="<?= esc($field['conditional_field'] ?? '') ?>"
                            data-conditional-value="<?= esc($field['conditional_value'] ?? '') ?>"
                            data-section="<?= esc($field['section_key'] ?? '') ?>">

                            <label class="form-label">

                                <?= esc($field['label']) ?>

                                <?= $field['required'] ? '*' : '' ?>

                            </label>

                            <?php

                            $name = esc($field['field_name']);

                            $required = $field['required']
                                ? 'required'
                                : '';

                            $options = json_decode($field['options'], true);

                            switch ($field['type']) {

                                case 'text':
                                case 'number':

                                    $value = old($name) ?? '';

                                    echo "
                                    <input
                                        type='{$field['type']}'
                                        name='{$name}'
                                        value='" . esc($value) . "'
                                        class='form-control'
                                        {$required}
                                    >";

                                    break;

                                case 'textarea':

                                    $value = old($name) ?? '';

                                    echo "
                                    <textarea
                                        name='{$name}'
                                        class='form-control'
                                        rows='3'
                                        {$required}
                                    >" . esc($value) . "</textarea>";

                                    break;

                                case 'select':

                                    $selectedValue = old($name) ?? '';

                                    echo "<select name='{$name}' class='form-select' {$required}>";

                                    echo "<option value=''>Pilih</option>";

                                    if (
                                        !empty($field['source_table']) &&
                                        isset($select_options[$field['source_table']])
                                    ) {

                                        foreach ($select_options[$field['source_table']] as $opt) {

                                            $value = esc(
                                                $opt['value'] ?? array_values($opt)[0]
                                            );

                                            $label = esc(
                                                $opt['label'] ?? ($opt[1] ?? $value)
                                            );

                                            $selected = ($value == $selectedValue)
                                                ? 'selected'
                                                : '';

                                            echo "
                                            <option value='{$value}' {$selected}>
                                                {$label}
                                            </option>";
                                        }
                                    } elseif (is_array($options)) {

                                        foreach ($options as $opt) {

                                            $selected = ($opt == $selectedValue)
                                                ? 'selected'
                                                : '';

                                            echo "
                                            <option value='" . esc($opt) . "' {$selected}>
                                                " . esc($opt) . "
                                            </option>";
                                        }
                                    }

                                    echo "</select>";

                                    break;

                                default:

                                    $value = old($name) ?? '';

                                    echo "
                                    <input
                                        type='text'
                                        name='{$name}'
                                        value='" . esc($value) . "'
                                        class='form-control'
                                        {$required}
                                    >";

                                    break;
                            }

                            ?>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endforeach; ?>

            <div class="d-flex justify-content-between mt-4">

                <button
                    type="button"
                    class="btn btn-secondary"
                    onclick="prevStep()">

                    <i class="bi bi-arrow-bar-left"></i>
                    Kembali

                </button>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Kirim Kuesioner

                </button>

            </div>

        </div>

    </form>

</div>

<script>
    function nextStep() {

        const requiredFields = document.querySelectorAll(
            '#step-1 [required]:not([disabled])'
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

        if (isValid) {

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

        } else {

            Swal.fire({
                icon: 'warning',
                title: 'Lengkapi Data',
                text: 'Harap lengkapi semua data wajib di Langkah 1 sebelum melanjutkan.',
                confirmButtonColor: '#3085d6',
            });
        }
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
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        function toggleConditionalFields() {

            // =========================
            // TOGGLE CONDITIONAL FIELD
            // =========================

            document.querySelectorAll('.conditional-field').forEach(field => {

                const conditionalField = (
                    field.dataset.conditionalField || ''
                ).trim();

                const conditionalValue = (
                    field.dataset.conditionalValue || ''
                ).trim().toLowerCase();

                // jika field tidak conditional
                if (!conditionalField || !conditionalValue) {

                    field.classList.remove('d-none');

                    field.querySelectorAll('input, textarea, select')
                        .forEach(input => {
                            input.disabled = false;
                        });

                    return;
                }

                // field controller
                const controllerInput = document.querySelector(
                    `[name="${conditionalField}"]`
                );

                const selectedValue = controllerInput ?
                    controllerInput.value.trim().toLowerCase() :
                    '';

                // tampilkan
                if (selectedValue === conditionalValue) {

                    field.classList.remove('d-none');

                    field.querySelectorAll('input, textarea, select')
                        .forEach(input => {
                            input.disabled = false;
                        });

                } else {

                    // hidden
                    field.classList.add('d-none');

                    field.querySelectorAll('input, textarea, select')
                        .forEach(input => {

                            input.disabled = true;

                            if (
                                input.type === 'checkbox' ||
                                input.type === 'radio'
                            ) {

                                input.checked = false;

                            } else {

                                input.value = '';
                            }
                        });
                }
            });

            // =========================
            // TOGGLE GROUP HEADER
            // =========================

            document.querySelectorAll('.field-group').forEach(group => {

                const visibleFields = group.querySelectorAll(
                    '.conditional-field:not(.d-none)'
                );

                if (visibleFields.length > 0) {

                    group.style.display = '';

                } else {

                    group.style.display = 'none';
                }
            });
        }

        // =========================
        // EVENT LISTENER
        // =========================

        document.addEventListener('change', function(e) {

            if (
                e.target.matches('select') ||
                e.target.matches('input')
            ) {

                toggleConditionalFields();
            }
        });

        // =========================
        // INIT
        // =========================

        toggleConditionalFields();

    });
</script>

<?= $this->endSection() ?>