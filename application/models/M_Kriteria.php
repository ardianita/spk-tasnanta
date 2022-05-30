<?php
class M_Kriteria extends CI_Model
{
    public function getAllKriteria()
    {
        $this->db->order_by('nm_kriteria', 'ASC');
        $query = $this->db->get('tb_kriteria');
        return $query->result_array();
    }

    public function getKriteriaById($id_kriteria)
    {
        $this->db->select('*');
        $this->db->from('tb_kriteria');
        $this->db->where('id_kriteria', $id_kriteria);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function tambahDataKriteria()
    {
        $nm_kriteria = $this->input->post('nm_kriteria', true);
        $j_kriteria = $this->input->post('j_kriteria', true);
        $bobot_kriteria = $this->input->post('bobot_kriteria', true);

        $data = array(
            'nm_kriteria'     => $nm_kriteria,
            'j_kriteria'      => $j_kriteria,
            'bobot_kriteria'  => $bobot_kriteria,

        );

        $this->db->insert('tb_kriteria', $data);
    }

    public function editDataKriteria($id_kriteria)
    {
        $nm_kriteria    = $this->input->post('nm_kriteria', TRUE);
        $j_kriteria     = $this->input->post('j_kriteria', TRUE);
        $bobot_kriteria =  $this->input->post('bobot_kriteria', TRUE);

        $data = [
            'nm_kriteria'       => $nm_kriteria,
            'j_kriteria'        => $j_kriteria,
            'bobot_kriteria'    => $bobot_kriteria,
        ];

        $this->db->set('nm_kriteria', $nm_kriteria);
        $this->db->set('j_kriteria', $j_kriteria);
        $this->db->set('bobot_kriteria', $bobot_kriteria);
        $this->db->where('id_kriteria', $id_kriteria);
        $this->db->update('tb_kriteria', $data);
    }

    public function hapusDataKriteria($id_kriteria)
    {
        $this->db->where('id_kriteria', $id_kriteria);
        $this->db->delete('tb_kriteria');
    }

    public function getAllSubkriteria()
    {
        $this->db->select('*');
        $this->db->from('tb_kriteria');
        $this->db->join('tb_subkriteria', 'tb_subkriteria.id_kriteria = tb_kriteria.id_kriteria');
        $this->db->order_by('nm_kriteria, nilai', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSubkriteriaById($id_subkriteria)
    {
        $this->db->select('*');
        $this->db->from('tb_subkriteria');
        $this->db->where('id_subkriteria', $id_subkriteria);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function tambahDataSubkriteria()
    {
        $id_kriteria = $this->input->post('id_kriteria', true);
        $nm_subkriteria = $this->input->post('nm_subkriteria', true);
        $nilai = $this->input->post('nilai', true);

        $data = array(
            'id_kriteria'     => $id_kriteria,
            'nm_subkriteria'  => $nm_subkriteria,
            'nilai'           => $nilai,

        );

        $this->db->insert('tb_subkriteria', $data);
    }

    public function editDataSubkriteria($id_subkriteria)
    {
        $id_kriteria = $this->input->post('id_kriteria', true);
        $nm_subkriteria = $this->input->post('nm_subkriteria', true);
        $nilai = $this->input->post('nilai', true);

        $data = array(
            'id_kriteria'     => $id_kriteria,
            'nm_subkriteria'  => $nm_subkriteria,
            'nilai'           => $nilai,

        );

        $this->db->set('id_kriteria', $id_kriteria);
        $this->db->set('nm_subkriteria', $nm_subkriteria);
        $this->db->set('nilai', $nilai);
        $this->db->where('id_subkriteria', $id_subkriteria);
        $this->db->update('tb_subkriteria', $data);
    }

    public function hapusDataSubkriteria($id_subkriteria)
    {
        $this->db->delete('tb_subkriteria', ['id_subkriteria' => $id_subkriteria]);
    }
}
