<div class="container fluid">
    <a class="btn btn-primary btn-sm my-2" href="<?= base_url('kriteria/tampil_subkriteria'); ?>"><i class="fas fa-fw fa-angle-left"></i> Kembali</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url('kriteria/tambah_subkriteria'); ?>">
                <div class="form-group">
                    <label>Kriteria</label>
                    <select name="id_kriteria" class="form-control">
                        <option value="">Pilih Kriteria</option>
                        <?php foreach ($kriteria as $r) : ?>
                            <option value="<?= $r['id_kriteria']; ?>"><?= $r['nm_kriteria']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('id_kriteria', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Subkriteria</label>
                    <input type="text" class="form-control" name="nm_subkriteria" value="<?= set_value('nm_subkriteria') ?>">
                    <?= form_error('nm_subkriteria', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Nilai</label>
                    <input type="text" class="form-control" name="nilai" value="<?= set_value('nilai') ?>">
                    <?= form_error('nilai', '<div class="text-danger small">', '</div>') ?>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>