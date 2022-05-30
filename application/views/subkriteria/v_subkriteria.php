<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan') ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data <?= $title; ?></h6>
        </div>
        <div class="card-body">
            <a class="btn btn-primary" href="<?= base_url('kriteria/tambah_subkriteria'); ?>"><i class="fas fa-fw fa-plus"></i> Tambah <?= $title; ?></a>
            <div class="table-responsive my-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kriteria</th>
                            <th>Subkriteria</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($subkriteria as $sktr) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $sktr['nm_kriteria']; ?></td>
                                <td><?= $sktr['nm_subkriteria']; ?></td>
                                <td><?= $sktr['nilai']; ?></td>
                                <td>
                                    <a class="btn btn-success" href="<?= base_url('kriteria/edit_subkriteria/') . $sktr['id_subkriteria']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                    <a class="btn btn-danger" data-toggle="modal" data-target=<?= "#hapusModalSub" . $sktr['id_subkriteria'] ?>><i class="fas fa-fw fa-trash"></i></a>
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
<?php foreach ($subkriteria as $sktr) : ?>
    <div class="modal fade" id=<?= "hapusModalSub" . $sktr['id_subkriteria'] ?> tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-danger" href="<?= base_url('kriteria/hapus_subkriteria/') . $sktr['id_subkriteria']; ?>">Ya</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>