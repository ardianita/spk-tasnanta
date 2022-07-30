<!DOCTYPE html>
<html>

<head>
    <title>PDF</title>
</head>

<body>

    <?php foreach ($nilai as $n) {
        if ($n['id_status'] == 0) {
            $n['id_status'] = 'Tidak Valid';
        } else {
            $n['id_status'] = 'Valid';
        }

        if ($n['id_built_status'] == 0) {
            $n['id_built_status'] = 'Belum Dibangun';
        } else if ($n['id_built_status'] == 1) {
            $n['id_built_status'] = 'Akan Dibangun';
        } else {
            $n['id_built_status'] = 'Telah Dibangun';
        }
    ?>
        <center>
            <h1 class="m-0 font-weight-bold text-primary"><?= $n['nm_pariwisata']; ?> </h1>
        </center>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <?php foreach ($pengguna as $p) :
                        if ($n['id_user'] == $p['id_user']) { ?>
                            <p><strong>Lokasi</strong> : <?= $p['name']; ?></p>
                    <?php }
                    endforeach; ?>
                    <p><strong>Status Validasi</strong> : <?= $n['id_status']; ?>
                    <p><strong>Status Pembangunan</strong> : <?= $n['id_built_status']; ?></p>
                    <?php foreach ($kriteria as $kr) : ?>
                        <p><strong><?= $kr['nm_kriteria']; ?></strong> :
                        <?php
                        foreach ($n['nilai'] as $n2) :
                            if ($kr['nm_kriteria'] == $n2['nm_kriteria']) {
                                echo ($n2['nm_subkriteria'] . '</p>');
                            }
                        endforeach;
                    endforeach; ?>
                </thead>
            </table>
        </div>
    <?php } ?>
</body>

</html>