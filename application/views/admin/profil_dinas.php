<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>
    <?= $this->session->flashdata('pesan') ?>
    <div class="card mb-3" style="max-width: 640px;">
        <div class="row">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $admin['foto']; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text">Nama Lengkap : <?= $admin['name']; ?></p>
                    <p class="card-text">Email : <?= $admin['email']; ?></p>
                    <p class="card-text">No. Telp : <?= $admin['telp']; ?></p>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#profilModal">Edit Profile</button>
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
                <form method="POST" action="<?= base_url('dinas/ubah_profile'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $admin['email']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $admin['username']; ?>">
                        <?= form_error('username', '<div class="text-danger small">', '</div>') ?>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" value="<?= $admin['name'] ?>">
                        <?= form_error('name', '<div class="text-danger small">', '</div>') ?>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" class="form-control" name="telp" value="<?= $admin['telp']; ?>">
                        <?= form_error('telp', '<div class="text-danger small">', '</div>') ?>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <br><img id="fotoprof" src="<?= base_url('assets/img/profile/') . $admin['foto']; ?>" class="rounded" style="width: 100px;">
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