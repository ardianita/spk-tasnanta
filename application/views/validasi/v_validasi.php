<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan') ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Destinasi Wisata</th>
                            <th>Nama Desa</th>
                            <th>Status Validasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($wisata as $w) : ?>
                            <?php
                            if ($w['id_status'] == 0) {
                                $w['id_status'] = '<button class="btn btn-danger btn-sm">Tidak Valid</button>';
                            } else {
                                $w['id_status'] = '<button class="btn btn-success btn-sm">Valid</button>';
                            }
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= format_indo($w['tgl']); ?></td>
                                <td><?= $w['nm_pariwisata']; ?></td>
                                <?php foreach ($pengguna as $p) :
                                    if ($w['id_user'] == $p['id_user']) { ?>
                                        <td><?= $p['name']; ?></td>
                                <?php }
                                endforeach; ?>
                                <td><?= $w['id_status']; ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target=<?= "#modalValidasi" . $w['id_pariwisata'] ?>>Validasi</a>
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

<?php foreach ($wisata as $w) : ?>
    <div class="modal fade" id=<?= "modalValidasi" . $w['id_pariwisata'] ?> tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Yakin ingin memvalidasi data?</h5>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</a>
                    <a class="btn btn-danger" href="<?= base_url('dinas/validasi/') . $w['id_pariwisata']; ?>">Ya</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>