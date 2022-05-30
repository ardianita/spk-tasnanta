<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('pesan') ?>
            <form method="POST" action="<?= base_url('desa/ubah_password'); ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Password Lama</label>
                    <input type="password" class="form-control" name="password_lama">
                    <?= form_error('password_lama', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" class="form-control" name="password_baru1">
                    <?= form_error('password_baru1', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Ulangi Password Baru</label>
                    <input type="password" class="form-control" name="password_baru2">
                    <?= form_error('password_baru2', '<div class="text-danger small">', '</div>') ?>
                </div>
                <button class="btn btn-primary" type="submit">Ubah Password</button>
            </form>
        </div>
    </div>
</div>