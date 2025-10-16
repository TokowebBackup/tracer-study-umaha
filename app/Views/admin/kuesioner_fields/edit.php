<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<h3>Edit Field Kuesioner</h3>

<form action="<?= base_url('admin/kuesionerfields/update/' . $field['id']) ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label>Field Name</label>
        <input type="text" class="form-control" value="<?= esc($field['field_name']) ?>" readonly>
    </div>
    <div class="mb-3">
        <label>Label</label>
        <input type="text" class="form-control" name="label" value="<?= esc($field['label']) ?>" required>
    </div>
    <div class="mb-3">
        <label>Header</label>
        <input type="text" class="form-control" name="header" value="<?= esc($field['header']) ?>">
    </div>
    <div class="mb-3">
        <label>Tipe Input</label>
        <select name="type" class="form-select">
            <option value="text" <?= $field['type'] == 'text' ? 'selected' : '' ?>>Text</option>
            <option value="number" <?= $field['type'] == 'number' ? 'selected' : '' ?>>Number</option>
            <option value="select" <?= $field['type'] == 'select' ? 'selected' : '' ?>>Select</option>
            <option value="textarea" <?= $field['type'] == 'textarea' ? 'selected' : '' ?>>Textarea</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Source Table</label>
        <input type="text" class="form-control" name="source_table" value="<?= esc($field['source_table']) ?>">
    </div>
    <div class="mb-3">
        <label>Options (JSON)</label>
        <textarea name="options" class="form-control"><?= esc($field['options']) ?></textarea>
    </div>
    <div class="form-check mb-3">
        <input type="checkbox" name="required" class="form-check-input" <?= $field['required'] ? 'checked' : '' ?>>
        <label class="form-check-label">Wajib diisi</label>
    </div>
    <div class="mb-3">
        <label>Step</label>
        <select name="step" class="form-select">
            <option value="1" <?= $field['step'] == 1 ? 'selected' : '' ?>>Step 1</option>
            <option value="2" <?= $field['step'] == 2 ? 'selected' : '' ?>>Step 2</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Urutan Tampil (Posisi Kolom)</label>
        <input type="number" name="order" value="<?= esc($field['order']) ?>" class="form-control">
    </div>

    <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
    <a href="<?= base_url('admin/kuesionerfields') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>