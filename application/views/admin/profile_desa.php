<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>
    <?= $this->session->flashdata('pesan') ?>
    <div class="card mb-3" style="max-width: 640px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['foto']; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text">Username : <?= $user['username']; ?></p>
                    <p class="card-text">Nama Desa : <?= $user['name']; ?></p>
                    <p class="card-text">Email : <?= $user['email']; ?></p>
                    <p class="card-text">No. Telp : <?= $user['telp']; ?></p>
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#profilModal" href="<?= base_url('') ?>">Edit Profile</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('desa/ubah_profile'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $user['email']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $user['username']; ?>">
                        <?= form_error('username', '<div class="text-danger small">', '</div>') ?>
                    </div>
                    <div class="form-group">
                        <label>Nama Desa</label>
                        <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>">
                        <?= form_error('name', '<div class="text-danger small">', '</div>') ?>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" class="form-control" name="telp" value="<?= $user['telp']; ?>">
                        <?= form_error('telp', '<div class="text-danger small">', '</div>') ?>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <br><img id="fotoprof" src="<?= base_url('assets/img/profile/') . $user['foto']; ?>" class="rounded" style="width: 100px;">
                        <br><input type="file" class="form-control" id="foto" name="foto">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    foto.onchange = evt => {
        const [file] = foto.files
        if (file) {
            fotoprof.src = URL.createObjectURL(file)
        }
    }
</script>