<div class="container-fluid">
    <a class="btn btn-primary btn-sm my-2" href="<?= base_url('kriteria'); ?>"><i class="fas fa-fw fa-angle-left"></i> Kembali</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url('kriteria/tambah_kriteria'); ?>">
                <div class="form-group">
                    <label>Kriteria</label>
                    <input type="text" class="form-control" name="nm_kriteria" value="<?= set_value('nm_kriteria'); ?>">
                    <?= form_error('nm_kriteria', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Jenis Kriteria</label>
                    <select name="j_kriteria" class="form-control">
                        <option value="">Pilih Jenis Kriteria</option>
                        <option value="Benefit" <?= set_select('j_kriteria', 'Benefit'); ?>>Benefit</option>
                        <option value="Cost" <?= set_select('j_kriteria', 'Cost'); ?>>Cost</option>
                    </select>
                    <?= form_error('j_kriteria', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Bobot</label>
                    <input type="text" class="form-control" name="bobot_kriteria" value="<?= set_value('bobot_kriteria'); ?>">
                    <?= form_error('bobot_kriteria', '<div class="text-danger small">', '</div>') ?>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>