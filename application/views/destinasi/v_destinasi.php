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
                            <th>Status Pembangunan</th>
                            <th>Detail</th>
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

                            if ($w['id_built_status'] == 0) {
                                $w['id_built_status'] = '<button class="btn btn-danger btn-sm">Belum Dibangun</button>';
                            } else if ($w['id_built_status'] == 1) {
                                $w['id_built_status'] = '<button class="btn btn-warning btn-sm">Akan Dibangun</button>';
                            } else {
                                $w['id_built_status'] = '<button class="btn btn-success btn-sm">Telah Dibangun</button>';
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
                                <td><?= $w['id_status']; ?>
                                <td><?= $w['id_built_status']; ?>
                                </td>
                                <td>
                                    <?php foreach ($nilai as $n) {
                                        foreach ($n['nilai'] as $n2) : ?>
                                        <?php endforeach; ?>
                                        <?php if ($w['id_pariwisata'] == $n2['id_pariwisata']) { ?>
                                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModalWis<?= $n2['id_pariwisata'] ?>"><i class="fas fa-fw fa-eye"></i></a>
                                    <?php }
                                    } ?>
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

<?php foreach ($nilai as $n) { ?>
    <?php foreach ($n['nilai'] as $n2) : ?>
        <div class="modal fade" id="detailModalWis<?= $n2['id_pariwisata'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary" style="color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Infrastruktur Pariwisata <?= $n['nm_pariwisata']; ?></h5>
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