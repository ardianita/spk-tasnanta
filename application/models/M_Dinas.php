<?php

class M_Dinas extends CI_model
{
    public function getDataDinas()
    {
        return $this->db->get_where('tb_user', ['email' =>
        $this->session->userdata('email')])->row_array();
    }

    public function getDataUser()
    {
        return $this->db->get('tb_user')->result_array();
    }

    public function getUserById($id_user)
    {
        return $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
    }

    public function getLevel()
    {
        return $this->db->get('tb_level')->result_array();
    }

    public function getStatus()
    {
        return $this->db->get('tb_status')->result_array();
    }

    public function getCountWisata()
    {
        $query = $this->db->get('tb_pariwisata');
        return $query->num_rows();
    }

    public function getCountDinas()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('id_level', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getCountDesa()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('id_level', 2);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getCountDataDesa()
    {
        $this->db->select('name');
        $this->db->from('tb_user');
        $this->db->where('id_level', 2);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function tambah_user()
    {
        $data = array(
            'email'     => htmlspecialchars($this->input->post('email', TRUE)),
            'username'  => htmlspecialchars($this->input->post('username', TRUE)),
            'name'      => htmlspecialchars($this->input->post('name', TRUE)),
            'telp'      => $this->input->post('telp', TRUE),
            'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'id_level'  => $this->input->post('id_level', TRUE),
            'foto'      => 'default.png',
        );

        $this->db->insert('tb_user', $data);
    }

    public function edit_user($id_user)
    {
        $email     = $this->input->post('email', TRUE);
        $username  = $this->input->post('username', TRUE);
        $name  = $this->input->post('name', TRUE);
        $telp      = $this->input->post('telp', TRUE);

        $data = [
            'email'     => $email,
            'username'  => $username,
            'name'      => $name,
            'telp'      => $telp
        ];

        $this->db->set('email', $email);
        $this->db->set('username', $username);
        $this->db->set('name', $name);
        $this->db->set('telp', $telp);
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_user', $data);
    }

    public function hapus_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');
    }

    public function validate_status($id_pariwisata)
    {
        $id_status  = 1;

        $data = array(
            'id_status'  => $id_status,
        );

        $this->db->set('id_status', $id_status);
        $this->db->where('id_pariwisata', $id_pariwisata);
        $this->db->update('tb_pariwisata', $data);
    }

    public function ubahDataProfile()
    {
        $email     = $this->input->post('email', TRUE);
        $username  = $this->input->post('username', TRUE);
        $name      = $this->input->post('name', TRUE);
        $telp      = $this->input->post('telp', TRUE);

        $data = array(
            'email'     => $email,
            'username'  => $username,
            'name'      => $name,
            'telp'      => $telp
        );

        //Jika Ada Foto yang diupload
        $upload_foto = $_FILES['foto']['name'];
        $file_name = str_replace('.', '', $email);
        if ($upload_foto) {
            $config['upload_path']      = './assets/img/profile/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = 2048;
            $config['file_name']        = $file_name;
            $config['overwrite']        = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $foto_baru = $this->upload->data('file_name');
                $data['foto'] = $foto_baru;
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('dinas/profil');
            }
        }

        $this->db->where('email', $email);
        $this->db->update('tb_user', $data);
    }

    public function getValidWisata()
    {
        $this->db->select('*');
        $this->db->from('tb_pariwisata');
        $this->db->where('id_status', '1');
        $this->db->where('id_built_status', '0');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPariwisataWithNilai()
    {
        $pariwisata = $this->getValidWisata();
        foreach ($pariwisata as $key => $value) {
            $this->db->select('*');
            $this->db->from('tb_kriteria');
            $this->db->join('tb_nilai', 'tb_nilai.kriteria_id = tb_kriteria.id_kriteria', 'inner');
            $this->db->join('tb_subkriteria', 'tb_nilai.id_subkriteria = tb_subkriteria.id_subkriteria', 'inner');
            $this->db->where('id_pariwisata', $value['id_pariwisata']);
            $query = $this->db->get();
            $pariwisata[$key]['nilai'] = $query->result_array();
        }
        return $pariwisata;
    }

    public function send_notif($from, $to, $title, $desription)
    {
        $notif = array(
            'from_user_id'  => $from,
            'user_id'       => $to,
            'title'          => $title,
            'description'   => $desription,
        );
        $this->db->insert('tb_notif', $notif);
    }

    public function ubah_status_p($id_pariwisata)
    {
        $id_built_status  = 1;

        $data = array(
            'id_built_status'  => $id_built_status,
        );

        $this->db->where('id_pariwisata', $id_pariwisata);
        $this->db->update('tb_pariwisata', $data);

        $pariwisata = $this->db->get_where('tb_pariwisata', ['id_pariwisata' => $id_pariwisata])->row_array();
        $email = $this->session->userdata('email');

        $user = $this->db->get_where('tb_user', ['email' => $email])->row_array();
        $this->send_notif($user['id_user'], $pariwisata['id_user'], 'Persetujuan Pembangunan', 'Pembangunan wisata ' . $pariwisata['nm_pariwisata'] . ' disetujui.');
    }

    public function check_sts_pem($id_pariwisata)
    {
        $id_built_status  = 2;

        $data = array(
            'id_built_status'  => $id_built_status,
        );

        $this->db->where('id_pariwisata', $id_pariwisata);
        $this->db->update('tb_pariwisata', $data);

        $pariwisata = $this->db->get_where('tb_pariwisata', ['id_pariwisata' => $id_pariwisata])->row_array();
        $email = $this->session->userdata('email');
        $user = $this->db->get_where('tb_user', ['email' => $email])->row_array();
        $this->send_notif($user['id_user'], $pariwisata['id_user'], 'Pemberitahuan Pembangunan', 'Pembangunan wisata ' . $pariwisata['nm_pariwisata'] . ' sudah selesai. <br>Apabila desa ingin melakukan pembangunan lagi pada pariwisata ini silahkan masukkan ulang data destinasi ' . $pariwisata['nm_pariwisata']);
    }
}
