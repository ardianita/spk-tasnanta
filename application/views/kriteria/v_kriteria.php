<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan') ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data <?= $title; ?></h6>
        </div>
        <div class="card-body">
            <a class="btn btn-primary btn-sm" href="<?= base_url('kriteria/tambah_kriteria'); ?>"><i class="fas fa-fw fa-plus"></i> Tambah <?= $title; ?></a>
            <div class="table-responsive my-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kriteria</th>
                            <th>Jenis</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($kriteria as $ktr) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $ktr['nm_kriteria']; ?></td>
                                <td><?= $ktr['j_kriteria']; ?></td>
                                <td><?= $ktr['bobot_kriteria']; ?> %</td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="<?= base_url('kriteria/edit_kriteria/' . $ktr['id_kriteria']); ?>"><i class="fas fa-fw fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target=<?= "#hapusModalKtr" . $ktr['id_kriteria'] ?>><i class="fas fa-fw fa-trash"></i></a>
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
<?php foreach ($kriteria as $ktr) : ?>
    <div class="modal fade" id=<?= "hapusModalKtr" . $ktr['id_kriteria'] ?> tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-danger" href="<?= base_url('kriteria/hapus_kriteria/') . $ktr['id_kriteria']; ?>">Ya</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>