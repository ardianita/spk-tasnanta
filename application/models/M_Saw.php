<?php
class M_Saw extends CI_Model
{
    public function get_min(array $array)
    {
        $min = $array[0];
        for ($i = 0; $i < count($array); $i++) {
            if ($min > $array[$i]) {
                $min = $array[$i];
            }
        }
        return $min;
    }

    public function get_max(array $array)
    {
        $max = $array[0];
        for ($i = 0; $i < count($array); $i++) {
            if ($max < $array[$i]) {
                $max = $array[$i];
            }
        }
        return $max;
    }

    public function get_saw()
    {
        $pariwisata = $this->M_Desa->getPariwisataWithNilai();
        foreach ($pariwisata as $key => $value) {
            foreach ($pariwisata[$key]['nilai'] as $key2 => $value2) {
                $arr = array();
                foreach ($pariwisata as $key3 => $value3) {
                    $arr[] = $value3['nilai'][$key2]['nilai'];
                }
                if ($value2['j_kriteria'] == 'Cost') {
                    $min = $this->get_min($arr);
                    $result = $min / $value2['nilai'];
                    $pariwisata[$key]['saw'][$value2['id_kriteria']]['nilai'] = $result;
                    $pariwisata[$key]['saw'][$value2['id_kriteria']]['bobot'] = $value2['bobot_kriteria'];
                } else {
                    $max = $this->get_max($arr);
                    $result = $value2['nilai'] / $max;
                    $pariwisata[$key]['saw'][$value2['id_kriteria']]['nilai'] = $result;
                    $pariwisata[$key]['saw'][$value2['id_kriteria']]['bobot'] = $value2['bobot_kriteria'];
                }
            }
            $arr = array();
            $pariwisata[$key]['total_saw'] = 0;
            foreach ($pariwisata[$key]['saw'] as $key4 => $value4) {
                $result = $value4['nilai'] * $value4['bobot'];
                $pariwisata[$key]['total_saw'] += $result;
            }
        }
        return $pariwisata;
    }
}
