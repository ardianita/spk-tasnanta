<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>EXCEL</title>
</head>

<body>
    <?php

    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Laporan Destinasi Wisata.xlsx");

    $table = '
            <table border="1">
                <tr>
                <th>No</th>
                            <th>Nama Pariwisata</th>';
    foreach ($kriteria as $kr) {
        $table .= '
            <th>' . $kr['nm_kriteria'] . '</th>';
    }
    $table .= '</tr>';
    $no = 1;
    foreach ($nilai as $n) {
        $table .= '
                <tr>
                    <td>' . $no++ . '</td>
                    <td>' . $n['nm_pariwisata'] . '</td>';
        foreach ($kriteria as $kr) {
            $is_exist = FALSE;
            foreach ($n['nilai'] as $n2) {
                if ($kr['nm_kriteria'] == $n2['nm_kriteria']) {
                    echo ($table .= '<td>' . $n2['nm_subkriteria'] . '</td>');
                    $is_exist = TRUE;
                }
            }
        }
        $table .= '</tr>';
    }
    $table .= '</table>';

    echo $table;
    ?>
</body>

</html>