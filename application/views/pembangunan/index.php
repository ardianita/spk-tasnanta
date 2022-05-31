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
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($wisata as $w) : ?>
                            <?php if ($w['built_status'] == 1) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $w['nm_pariwisata']; ?></td>
                                    <?php foreach ($pengguna as $p) :
                                        if ($w['id_user'] == $p['id_user']) { ?>
                                            <td><?= $p['name']; ?></td>
                                    <?php }
                                    endforeach; ?>
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