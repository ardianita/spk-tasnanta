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
                            <th>Total Poin</th>
                            <th>Notifikasi</th>
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
                                <td><?= round($w['total_saw'], 1); ?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?= base_url('dinas/ubah_pembangunan/' . $w['id_pariwisata']); ?>"><i class="fas fa-fw fa-envelope"></i></a>
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