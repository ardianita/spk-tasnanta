<div class="container-fluid">
    <?= $this->session->flashdata('pesan') ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengguna Desa</h6>
        </div>
        <div class="card-body">
            <a class="btn btn-primary" href="<?= base_url('dinas/tambah_pengguna/desa'); ?>"><i class="fas fa-fw fa-plus"></i> Tambah Pengguna</a>
            <div class="table-responsive my-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama Desa</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Nomor Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($pengguna as $p) : ?>
                            <?php
                            if ($p['id_level'] == 1) {
                                continue;
                            }
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $p['username']; ?></td>
                                <td><?= $p['name']; ?></td>
                                <td><?= $p['email']; ?></td>
                                <td>Desa</td>
                                <td><?= $p['telp']; ?></td>
                                <td>
                                    <a href="<?= base_url('dinas/edit_pengguna/') . $p['id_user']; ?>" class="btn btn-success"><i class="fas fa-fw fa-edit"></i></a>
                                    <a class="btn btn-danger" data-toggle="modal" data-target=<?= "#hapusUser" . $p['id_user'] ?>><i class="fas fa-fw fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Hapus Modal-->
<?php foreach ($pengguna as $p) : ?>
    <div class="modal fade" id=<?= "hapusUser" . $p['id_user'] ?> tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Yakin ingin menghapus data?</h5>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</a>
                    <a class="btn btn-danger" href="<?= base_url('dinas/hapus_pengguna/') . $p['id_user']; ?>">Ya</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>