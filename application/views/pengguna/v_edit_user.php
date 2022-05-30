<div class="container fluid">
    <a class="btn btn-primary btn-sm my-2" href="<?= base_url('dinas/pengguna/' . $argument); ?>"><i class="fas fa-fw fa-angle-left"></i> Kembali</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Pengguna <?= $pengguna['id_level'] == 1 ? "Dinas" : "Desa" ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url('dinas/edit_pengguna/') . $pengguna['id_user']; ?>">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" value="<?= $pengguna['email']; ?>">
                    <?= form_error('email', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?= $pengguna['username']; ?>">
                    <?= form_error('username', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label><?= $pengguna['id_level'] == 1 ? "Nama Lengkap" : "Nama Desa" ?></label>
                    <input type="text" class="form-control" name="name" value="<?= $pengguna['name'] ?>">
                    <?= form_error('name', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control" name="telp" value="<?= $pengguna['telp']; ?>">
                    <?= form_error('telp', '<div class="text-danger small">', '</div>') ?>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>