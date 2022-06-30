<!DOCTYPE html>
<html>

<head></head>

<body>

    <?php foreach ($nilai as $n) {
        if ($n['id_status'] == 0) {
            $n['id_status'] = '<strong>Tidak Valid</strong>';
        } else {
            $n['id_status'] = '<strong>Valid</strong>';
        }

        if ($n['id_built_status'] == 0) {
            $n['id_built_status'] = '<strong>Belum Dibangun</strong>';
        } else if ($n['id_built_status'] == 1) {
            $n['id_built_status'] = '<strong>Akan Dibangun</strong>';
        } else {
            $n['id_built_status'] = '<strong>Telah Dibangun</strong>';
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
                            <p>Lokasi : <?= $p['name']; ?></p>
                    <?php }
                    endforeach; ?>
                    <p>Status Validasi : <?= $n['id_status']; ?>
                    <p>Status Pembangunan : <?= $n['id_built_status']; ?></p>
                    <tr></tr>
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