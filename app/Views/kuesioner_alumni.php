<!-- app/Views/kuesioner_alumni.php -->
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4 mb-5">
    <h3 class="mb-3">Form Kuesioner Tracer Study</h3>

    <form action="<?= base_url('kuesioner/alumni/simpan') ?>" method="post">
        <input type="hidden" name="tahun_pengisian" value="<?= date('Y') ?>">

        <!-- Langsung taruh step-1 di sini tanpa include -->
        <div id="step-1" class="step">
            <?php
            // Group fields_step1 berdasarkan header
            $groups = [];
            foreach ($fields_step1 as $field) {
                $header = !empty($field['header']) ? $field['header'] : 'Default Header';
                if (!isset($groups[$header])) {
                    $groups[$header] = [];
                }
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
                            switch ($field['type']) {
                                case 'text':
                                case 'number':
                                    $value = old($name) ?? ($alumni[$name] ?? '');
                                    echo "<input type='{$field['type']}' name='{$name}' value='" . esc($value) . "' class='form-control' {$required}>";
                                    break;
                                case 'textarea':
                                    $value = old($name) ?? ($alumni[$name] ?? '');
                                    echo "<textarea name='{$name}' class='form-control' rows='3' {$required}>" . esc($value) . "</textarea>";
                                    break;
                                case 'select':
                                    $selectedValue = old($name) ?? ($alumni[$name] ?? '');
                                    echo "<select name='{$name}' class='form-select' {$required}>";
                                    echo "<option value=''>Pilih</option>";

                                    if (!empty($field['source_table']) && isset($select_options[$field['source_table']])) {
                                        foreach ($select_options[$field['source_table']] as $opt) {
                                            $value = esc($opt['value'] ?? array_values($opt)[0]);
                                            $label = esc($opt['label'] ?? ($opt[1] ?? $value));
                                            $selected = ($value == $selectedValue) ? 'selected' : '';
                                            echo "<option value='{$value}' {$selected}>{$label}</option>";
                                        }
                                    } else if (is_array($options)) {
                                        foreach ($options as $opt) {
                                            $selected = ($opt == $selectedValue) ? 'selected' : '';
                                            echo "<option value='" . esc($opt) . "' {$selected}>" . esc($opt) . "</option>";
                                        }
                                    }
                                    echo "</select>";
                                    break;
                                default:
                                    echo "<input type='text' name='{$name}' class='form-control' {$required}>";
                            }
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <button type="button" class="btn btn-success mt-3" onclick="nextStep()">Lanjut <i class="bi bi-arrow-bar-right"></i></button>
        </div>

        <!-- Step 2 di bawahnya -->
        <div id="step-2" class="step d-none">
            <h5 class="mb-2">Kuesioner Step 2</h5>

            <?php
            // Grouping fields_step2 by header
            $groups2 = [];
            foreach ($fields_step2 as $field) {
                $header = !empty($field['header']) ? $field['header'] : 'Bagian Tanpa Judul';
                if (!isset($groups2[$header])) {
                    $groups2[$header] = [];
                }
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
                            switch ($field['type']) {
                                case 'text':
                                case 'number':
                                    echo "<input type='{$field['type']}' name='{$name}' class='form-control' {$required}>";
                                    break;
                                case 'textarea':
                                    echo "<textarea name='{$name}' class='form-control' rows='3' {$required}></textarea>";
                                    break;
                                case 'select':
                                    echo "<select name='{$name}' class='form-select' {$required}>";
                                    echo "<option value=''>Pilih</option>";
                                    if (!empty($field['source_table'])) {
                                        $sourceData = ${$field['source_table'] . '_list'} ?? [];
                                        foreach ($sourceData as $opt) {
                                            $values = array_values($opt);
                                            $value = esc($values[0]);
                                            $label = esc($values[1] ?? $values[0]);
                                            echo "<option value='{$value}'>{$label}</option>";
                                        }
                                    } else if (is_array($options)) {
                                        foreach ($options as $opt) {
                                            echo "<option value='" . esc($opt) . "'>" . esc($opt) . "</option>";
                                        }
                                    }
                                    echo "</select>";
                                    break;
                                default:
                                    echo "<input type='text' name='{$name}' class='form-control' {$required}>";
                            }
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <div class="d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-secondary" onclick="prevStep()"><i class="bi bi-arrow-bar-left"></i> Kembali</button>
                <button type="submit" class="btn btn-primary">Kirim Kuesioner</button>
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