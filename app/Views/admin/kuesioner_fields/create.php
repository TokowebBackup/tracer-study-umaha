<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<h3>Tambah Field Kuesioner Baru</h3>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif ?>

<form action="<?= base_url('admin/kuesionerfields/store') ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="field_name" class="form-label">Field Name (harus unik, tanpa spasi)</label>
        <input type="text" class="form-control" id="field_name" name="field_name" value="<?= old('field_name') ?>" required>
    </div>
    <div class="mb-3">
        <label for="label" class="form-label">Label</label>
        <input type="text" class="form-control" id="label" name="label" value="<?= old('label') ?>" required>
    </div>
    <div class="mb-3">
        <label for="header" class="form-label">Judul/Heading Bagian (opsional)</label>
        <input type="text" id="header" name="header" class="form-control" value="<?= old('header') ?>" placeholder="Misal: Biodata Alumni & Kuesioner Step 1">
        <div class="form-text">Isi judul section/form group ini, bisa dikosongkan.</div>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Tipe Input</label>
        <select id="type" name="type" class="form-select" required>
            <option value="text" <?= old('type') == 'text' ? 'selected' : '' ?>>Text</option>
            <option value="number" <?= old('type') == 'number' ? 'selected' : '' ?>>Number</option>
            <option value="select" <?= old('type') == 'select' ? 'selected' : '' ?>>Select</option>
            <option value="textarea" <?= old('type') == 'textarea' ? 'selected' : '' ?>>Textarea</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="source_table" class="form-label">Source Table (opsional untuk tipe select dinamis)</label>
        <input type="text" id="source_table" name="source_table" class="form-control" value="<?= old('source_table') ?>" placeholder="Misal: prodi">
        <div class="form-text">Isi nama tabel jika opsi select berasal dari database (misal: prodi), kosongkan jika opsi manual</div>
    </div>
    <div class="mb-3">
        <label for="options" class="form-label">Options (khusus tipe Select, isi JSON array, contoh: ["Ya","Tidak"])</label>
        <textarea id="options" name="options" class="form-control" rows="3"><?= old('options') ?></textarea>
    </div>
    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="required" name="required" <?= old('required') ? 'checked' : '' ?>>
        <label class="form-check-label" for="required">Wajib diisi</label>
    </div>
    <div class="mb-3">
        <label for="step" class="form-label">Step Form</label>
        <select id="step" name="step" class="form-select" required>
            <option value="1" <?= old('step') == '1' ? 'selected' : '' ?>>Step 1</option>
            <option value="2" <?= old('step') == '2' ? 'selected' : '' ?>>Step 2</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="order" class="form-label">Urutan Tampil (Posisi Kolom)</label>
        <input type="number" id="order" name="order" value="<?= old('order') ?? 0 ?>" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan Field</button>
    <a href="<?= base_url('admin/kuesionerfields') ?>" class="btn btn-secondary">Batal</a>
</form>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const sourceTableDiv = document.getElementById('source_table').parentElement; // container div dari input source_table

        function toggleSourceTable() {
            if (typeSelect.value === 'select') {
                sourceTableDiv.style.display = 'block';
            } else {
                sourceTableDiv.style.display = 'none';
                // opsi reset input kalau mau
                // document.getElementById('source_table').value = '';
            }
        }

        // jalankan sekali saat load halaman
        toggleSourceTable();

        // event listener ketika tipe input berubah
        typeSelect.addEventListener('change', toggleSourceTable);
    });
</script>

<?= $this->endSection() ?>