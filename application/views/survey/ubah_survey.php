<div class="container fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url('desa/edit_survey/') . $wisata['id_pariwisata']; ?>">

                <input type="hidden" class="form-control" name="id_user" value="<?= $user['id_user']; ?>">
                <div class="form-group">
                    <label>Nama Destinasi Wisata</label>
                    <input type="text" class="form-control" name="nm_pariwisata" value="<?= $wisata['nm_pariwisata']; ?>">
                    <?= form_error('nm_pariwisata', '<div class="text-danger small">', '</div>') ?>
                </div>
                <?php foreach ($wisata['nilai'] as $nilai) : ?>
                    <?php foreach ($kriteria as $kr) : ?>
                        <?php if ($nilai['id_kriteria'] == $kr['id_kriteria']) { ?>
                            <div class="form-group">
                                <label name="<?= $kr['id_kriteria']; ?>"><?= $kr['nm_kriteria']; ?></label>
                                <select name="<?= $kr['id_kriteria']; ?>" class="form-control">
                                    <?php foreach ($subkriteria as $sk) : ?>
                                        <?php if ($kr['id_kriteria'] == $sk['id_kriteria']) { ?>
                                            <option value="<?= $sk['id_subkriteria']; ?>" <?= set_select($kr['id_kriteria'], $sk['id_subkriteria'], $nilai['id_subkriteria'] == $sk['id_subkriteria']); ?>><?= $sk['nm_subkriteria']; ?></option>
                                    <?php }
                                    endforeach; ?>
                                </select>
                            </div>
                        <?php } ?>
                    <?php endforeach ?>
                <?php endforeach; ?>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>