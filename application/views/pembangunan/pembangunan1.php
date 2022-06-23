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
                            <th>Nama Destinasi Wisata</th>
                            <th>Nama Desa</th>
                            <th>Status Pembangunan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($wisata as $w) :
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
                                <td><?= $w['nm_pariwisata']; ?></td>
                                <?php foreach ($pengguna as $p) :
                                    if ($w['id_user'] == $p['id_user']) { ?>
                                        <td><?= $p['name']; ?></td>
                                <?php }
                                endforeach; ?>
                                <td><?= $w['id_built_status']; ?></td>
                                <td>
                                    <a class="btn btn-outline-success btn-sm" href="<?= base_url('dinas/pembangunan1/') . $w['id_pariwisata']; ?>"><i class="fas fa-fw fa-check"></i></a>
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