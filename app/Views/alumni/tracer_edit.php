<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4 mb-5">
    <h3 class="mb-3">Edit Kuesioner Tracer Study</h3>

    <form action="<?= base_url('alumni/tracer/update') ?>" method="post">
        <input type="hidden" name="tahun_pengisian" value="<?= esc($tracer['tahun_pengisian'] ?? date('Y')) ?>">

        <!-- STEP 1 -->
        <div id="step-1" class="step">
            <?php
            $groups = [];
            foreach ($fields_step1 as $field) {
                $header = !empty($field['header']) ? $field['header'] : 'Bagian Umum';
                $groups[$header][] = $field;
            }
            ?>

            <?php foreach ($groups as $header => $fields): ?>
                <h5 class="mb-2"><?= esc($header) ?></h5>
                <div class="row mb-5">
                    <?php foreach ($fields as $field): ?>
                        <div class="col-md-6 mb-3">
                            <label><?= esc($field['label']) ?> <?= $field['required'] ? '*' : '' ?></label>
                            <?php
                            $name = esc($field['field_name']);
                            $required = $field['required'] ? 'required' : '';
                            $options = json_decode($field['options'], true);

                            // urutan prioritas: old() -> tracer -> alumni -> kosong
                            $value = old($name) ?? ($tracer[$name] ?? ($alumni[$name] ?? ''));

                            switch ($field['type']) {
                                case 'text':
                                case 'number':
                                    echo "<input type='{$field['type']}' name='{$name}' value='" . esc($value) . "' class='form-control' {$required}>";
                                    break;

                                case 'textarea':
                                    echo "<textarea name='{$name}' class='form-control' rows='3' {$required}>" . esc($value) . "</textarea>";
                                    break;

                                case 'select':
                                    echo "<select name='{$name}' class='form-select' {$required}>";
                                    echo "<option value=''>Pilih</option>";

                                    if (!empty($field['source_table']) && isset($select_options[$field['source_table']])) {
                                        foreach ($select_options[$field['source_table']] as $opt) {
                                            $optValue = esc($opt['value'] ?? array_values($opt)[0]);
                                            $optLabel = esc($opt['label'] ?? ($opt[1] ?? $optValue));
                                            $selected = ($optValue == $value) ? 'selected' : '';
                                            echo "<option value='{$optValue}' {$selected}>{$optLabel}</option>";
                                        }
                                    } elseif (is_array($options)) {
                                        foreach ($options as $opt) {
                                            $selected = (strcasecmp(trim($opt), trim($value)) === 0) ? 'selected' : '';
                                            echo "<option value='" . esc($opt) . "' {$selected}>" . esc($opt) . "</option>";
                                        }
                                    }
                                    echo "</select>";
                                    break;

                                default:
                                    echo "<input type='text' name='{$name}' value='" . esc($value) . "' class='form-control' {$required}>";
                            }
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <button type="button" class="btn btn-success mt-3" onclick="nextStep()">Lanjut <i class="bi bi-arrow-bar-right"></i></button>
        </div>

        <!-- STEP 2 -->
        <div id="step-2" class="step d-none">
            <h5 class="mb-2">Kuesioner Step 2</h5>

            <?php
            $groups2 = [];
            foreach ($fields_step2 as $field) {
                $header = !empty($field['header']) ? $field['header'] : 'Bagian Lanjutan';
                $groups2[$header][] = $field;
            }
            ?>

            <?php foreach ($groups2 as $header => $fields): ?>
                <h5 class="mt-3 mb-2"><?= esc($header) ?></h5>
                <div class="row">
                    <?php foreach ($fields as $field): ?>
                        <div class="col-md-6 mb-3">
                            <label><?= esc($field['label']) ?> <?= $field['required'] ? '*' : '' ?></label>
                            <?php
                            $name = esc($field['field_name']);
                            $required = $field['required'] ? 'required' : '';
                            $options = json_decode($field['options'], true);
                            $value = old($name) ?? ($tracer[$name] ?? '');

                            switch ($field['type']) {
                                case 'text':
                                case 'number':
                                    echo "<input type='{$field['type']}' name='{$name}' value='" . esc($value) . "' class='form-control' {$required}>";
                                    break;

                                case 'textarea':
                                    echo "<textarea name='{$name}' class='form-control' rows='3' {$required}>" . esc($value) . "</textarea>";
                                    break;

                                case 'select':
                                    echo "<select name='{$name}' class='form-select' {$required}>";
                                    echo "<option value=''>Pilih</option>";

                                    if (!empty($field['source_table']) && isset($select_options[$field['source_table']])) {
                                        foreach ($select_options[$field['source_table']] as $opt) {
                                            $optValue = esc($opt['value'] ?? array_values($opt)[0]);
                                            $optLabel = esc($opt['label'] ?? ($opt[1] ?? $optValue));
                                            $selected = ($optValue == $value) ? 'selected' : '';
                                            echo "<option value='{$optValue}' {$selected}>{$optLabel}</option>";
                                        }
                                    } elseif (is_array($options)) {
                                        foreach ($options as $opt) {
                                            $selected = (strcasecmp(trim($opt), trim($value)) === 0) ? 'selected' : '';
                                            echo "<option value='" . esc($opt) . "' {$selected}>" . esc($opt) . "</option>";
                                        }
                                    }
                                    echo "</select>";
                                    break;

                                default:
                                    echo "<input type='text' name='{$name}' value='" . esc($value) . "' class='form-control' {$required}>";
                            }
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <div class="d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-secondary" onclick="prevStep()"><i class="bi bi-arrow-bar-left"></i> Kembali</button>
                <button type="submit" class="btn btn-primary">Perbarui Data</button>
            </div>
        </div>
    </form>
</div>

<script>
    function nextStep() {
        const requiredFields = document.querySelectorAll('#step-1 [required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (isValid) {
            document.getElementById('step-1').classList.add('d-none');
            document.getElementById('step-2').classList.remove('d-none');
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
        document.getElementById('step-2').classList.add('d-none');
        document.getElementById('step-1').classList.remove('d-none');
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>

<?= $this->endSection() ?>