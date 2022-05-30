<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan') ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Konversi Data Infrastruktur Pariwisata menjadi Nilai</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive my-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Destinasi Wisata</th>
                            <?php foreach ($kriteria as $kr) : ?>
                                <th><?= $kr['nm_kriteria']; ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($nilai as $n) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $n['nm_pariwisata']; ?></td>
                                <?php foreach ($kriteria as $kr) : ?>
                                    <?php
                                    $is_exist = FALSE;
                                    foreach ($n['nilai'] as $n2) : ?>
                                        <?php
                                        if ($kr['nm_kriteria'] == $n2['nm_kriteria']) {
                                            echo ('<td>' . $n2['nilai'] . '</td>');
                                            $is_exist = TRUE;
                                        }
                                        ?>
                                <?php endforeach;
                                endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->