<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan') ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <a class="btn btn-primary" href="<?= base_url('desa/isi_survey'); ?>"><i class="fas fa-fw fa-plus"></i> Tambah <?= $title; ?></a>
            <div class="table-responsive my-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Destinasi Wisata</th>
                            <th>Status Validasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($nilai as $n) : ?>
                            <tr>
                                <?php if ($n['id_user'] == $user['id_user']) { ?>
                                    <td><?= $no++; ?></td>
                                    <td><?= $n['nm_pariwisata']; ?></td>
                                    <?php foreach ($status as $st) :
                                        if ($n['id_status'] == $st['id_status']) {
                                            if ($st['id_status'] == 0) {
                                                $st['id_status'] = '<button class="btn btn-danger btn-sm">Tidak Valid</button>';
                                            } else {
                                                $st['id_status'] = '<button class="btn btn-success btn-sm">Valid</button>';
                                            } ?>
                                            <td><?= $st['id_status']; ?></td>
                                    <?php }
                                    endforeach; ?>
                                    <?php foreach ($n['nilai'] as $n2) : ?>
                                    <?php endforeach; ?>
                                    <td>
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#detailModalWis<?= $n2['id_pariwisata'] ?>"><i class="fas fa-fw fa-eye"></i></a>
                                        <?php foreach ($status as $st) :
                                            if ($n['id_status'] == $st['id_status']) {
                                                if ($st['id_status'] == 0) { ?>
                                                    <a class="btn btn-success" href="<?= base_url('desa/edit_survey/') . $n2['id_pariwisata']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                                <?php } else { ?>
                                                    <a class="btn btn-secondary"><i class="fas fa-fw fa-edit"></i></a>
                                        <?php }
                                            }
                                        endforeach; ?>
                                        <a class="btn btn-danger" data-toggle="modal" data-target=<?= "#hapusWis" . $n2['id_pariwisata'] ?>><i class="fas fa-fw fa-trash"></i></a>
                                    </td>
                            </tr>
                    <?php }
                            endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Hapus Modal-->
<?php foreach ($nilai as $n) { ?>
    <?php foreach ($n['nilai'] as $n2) : ?>
        <div class="modal fade" id=<?= "hapusWis" . $n2['id_pariwisata'] ?> tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <a class="btn btn-danger" href="<?= base_url('desa/hapus_survey/') . $n['id_pariwisata']; ?>">Ya</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php } ?>

<?php foreach ($nilai as $n) { ?>
    <?php foreach ($n['nilai'] as $n2) : ?>
        <div class="modal fade" id="detailModalWis<?= $n2['id_pariwisata'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary" style="color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Infrastruktur Destinasi Wisata <?= $n['nm_pariwisata']; ?></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span style="color: white;" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php foreach ($kriteria as $kr) : ?>
                            <strong>
                                <p><?= $kr['nm_kriteria']; ?>
                            </strong> :
                            <?php
                            $is_exist = FALSE;
                            foreach ($n['nilai'] as $n2) : ?>
                                <?php
                                if ($kr['nm_kriteria'] == $n2['nm_kriteria']) {
                                    echo ($n2['nm_subkriteria']);
                                    $is_exist = TRUE;
                                }
                                ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php } ?>