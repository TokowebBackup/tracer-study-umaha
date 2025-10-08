<?= $this->extend('layouts/admin_main') ?>
<?= $this->section('content') ?>

<div class="container p-4">
    <div class="row">
        <div class="col-lg-12">
            <h4>Tambah Periode Tracer</h4>

            <form action="<?= base_url('admin/periode/simpan') ?>" method="post" enctype="multipart/form-data">
                <div class="mb-2">
                    <label>Tahun Periode</label>
                    <input type="text" name="tahun" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Tahun Lulusan</label>
                    <input type="text" name="lulusan_tahun" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Upload Surat Pemberitahuan (PDF)</label>
                    <input type="file" name="file_surat" class="form-control" accept="application/pdf">
                </div>
                <button class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>