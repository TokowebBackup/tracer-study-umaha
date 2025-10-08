<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4><?= isset($item['id']) ? 'Edit' : 'Tambah' ?> Konten Landing Page</h4>

    <form action="<?= base_url('admin/landing/' . (isset($item['id']) ? 'update' : 'add')) ?>" method="post" enctype="multipart/form-data">
        <?php if (isset($item['id'])): ?>
            <input type="hidden" name="id" value="<?= $item['id'] ?>">
        <?php endif ?>

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="<?= esc($item['judul'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label>Subjudul</label>
            <input type="text" name="subjudul" class="form-control" value="<?= esc($item['subjudul'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label>Konten</label>
            <textarea name="konten" class="form-control" rows="5"><?= esc($item['konten'] ?? '') ?></textarea>
        </div>

        <div class="mb-3">
            <label>Gambar</label>
            <?php if (!empty($item['gambar'])): ?>
                <div class="mb-2"><img src="<?= base_url($item['gambar']) ?>" width="120"></div>
            <?php endif ?>
            <input type="file" name="gambar" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select" required>
                <option value="aktif" <?= ($item['status'] ?? '') == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="nonaktif" <?= ($item['status'] ?? '') == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Facebook</label>
            <input type="url" name="facebook" class="form-control" value="<?= esc($item['facebook'] ?? '') ?>" placeholder="https://facebook.com/...">
        </div>

        <div class="mb-3">
            <label>Instagram</label>
            <input type="url" name="instagram" class="form-control" value="<?= esc($item['instagram'] ?? '') ?>" placeholder="https://instagram.com/...">
        </div>

        <div class="mb-3">
            <label>Twitter (X)</label>
            <input type="url" name="twitter" class="form-control" value="<?= esc($item['twitter'] ?? '') ?>" placeholder="https://twitter.com/...">
        </div>

        <div class="mb-3">
            <label>LinkedIn</label>
            <input type="url" name="linkedin" class="form-control" value="<?= esc($item['linkedin'] ?? '') ?>" placeholder="https://linkedin.com/...">
        </div>

        <div class="mb-3">
            <label>YouTube</label>
            <input type="url" name="youtube" class="form-control" value="<?= esc($item['youtube'] ?? '') ?>" placeholder="https://youtube.com/...">
        </div>


        <button class="btn btn-success" type="submit">Simpan</button>
        <a href="<?= base_url('admin/landing') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>