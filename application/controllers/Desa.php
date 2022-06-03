<?php

class desa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('email') == "") {
            redirect('auth');
        }
        $this->load->model('M_Desa', 'M_Kriteria', 'M_Dinas');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->M_Desa->getDataByEmail();
        $data['tot_notif'] = $this->M_Desa->getCountUserNotifUnread($data['user']['id_user']);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_desa', $data);
        $this->load->view('admin/dashboard_desa', $data);
        $this->load->view('template/footer');
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->M_Desa->getDataByEmail();
        $data['tot_notif'] = $this->M_Desa->getCountUserNotifUnread($data['user']['id_user']);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_desa', $data);
        $this->load->view('admin/profile_desa', $data);
        $this->load->view('template/footer');
    }
    public function ubah_profile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->M_Desa->getDataByEmail();
        $data['tot_notif'] = $this->M_Desa->getCountUserNotifUnread($data['user']['id_user']);

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_user.username]', [
            'required'  => 'Username Wajib Diisi!',
            'is_unique'  => 'Username Sudah Ada!'
        ]);
        $this->form_validation->set_rules('name',  'Nama Desa', 'required', [
            'required'  => 'Nama Desa Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim|numeric', [
            'required'  => 'Nomor Telepon Wajib Diisi!',
            'numeric'  => 'Nomor Telepon Harus Angka!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_desa', $data);
            $this->load->view('admin/profile_desa', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Desa->ubahDataProfile();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('desa/profile');
        }
    }

    public function ubah_password()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->M_Desa->getDataByEmail();
        $data['tot_notif'] = $this->M_Desa->getCountUserNotifUnread($data['user']['id_user']);

        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim', [
            'required'  => 'Password Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[6]|matches[password_baru2]', [
            'required'  => 'Password Baru Wajib Diisi!',
            'matches'   => 'Password Tidak Sama!'
        ]);
        $this->form_validation->set_rules('password_baru2', 'Confirm Password Baru', 'required|trim|matches[password_baru1]', [
            'required'  => 'Ulangi Password Baru!',
            'matches'   => 'Password Tidak Sama!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_desa', $data);
            $this->load->view('admin/ubah_pass2', $data);
            $this->load->view('template/footer');
        } else {
            $password_lama = $this->input->post('password_lama');
            $password_baru1 = $this->input->post('password_baru1');
            if (!password_verify($password_lama, $data['user']['password'])) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password salah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('desa/ubah_password');
            } else {
                if ($password_lama == $password_baru1) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password baru tidak boleh sama dengan password lama!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('desa/ubah_password');
                } else {
                    $password_hash = password_hash($password_baru1, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('tb_user');

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Password berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('desa/ubah_password');
                }
            }
        }
    }

    public function tampil_survey()
    {
        $data['title'] = 'Data Infrastruktur Destinasi Wisata';
        $data['user'] = $this->M_Desa->getDataByEmail();
        $data['status'] = $this->M_Dinas->getStatus();
        $data['wisata'] = $this->M_Desa->getWisataByUser();
        $data['kriteria'] = $this->M_Kriteria->getAllKriteria();
        $data['subkriteria'] = $this->M_Kriteria->getAllSubkriteria();
        $data['nilai'] = $this->M_Desa->getPariwisataWithNilai();
        $data['tot_notif'] = $this->M_Desa->getCountUserNotifUnread($data['user']['id_user']);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_desa', $data);
        $this->load->view('survey/v_survey', $data);
        $this->load->view('template/footer');
    }

    public function isi_survey()
    {
        $data['title'] = 'Tambah Data Destinasi Wisata';
        $data['user'] = $this->M_Desa->getDataByEmail();
        $data['kriteria'] = $this->M_Kriteria->getAllKriteria();
        $data['subkriteria'] = $this->M_Kriteria->getAllSubkriteria();
        $data['nilai'] = $this->M_Desa->getNilaiByPariwisata();
        $data['tot_notif'] = $this->M_Desa->getCountUserNotifUnread($data['user']['id_user']);

        $this->form_validation->set_rules('nm_pariwisata', 'Nama Destinasi Wisata', 'required', [
            'required'  => 'Nama Destinasi Wisata Wajib Diisi!'
        ]);

        $dropdown[''] = '';
        foreach ($data['kriteria'] as $kr) {
            $dropdown[$kr['id_kriteria']] = $this->input->post($kr['id_kriteria'], true);
        }
        $data['dropdown'] = $dropdown;
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_desa', $data);
            $this->load->view('survey/isi_survey', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Desa->tambahDataWisata();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil ditambah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('desa/tampil_survey');
        }
    }

    public function hapus_survey($id_pariwisata)
    {
        $this->M_Desa->hapusDataWisata($id_pariwisata);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('desa/tampil_survey');
    }

    public function edit_survey($id_pariwisata)
    {
        $data['title'] = 'Edit Data Destinasi Wisata';
        $data['user'] = $this->M_Desa->getDataByEmail();
        $data['wisata'] = $this->M_Desa->getPariwisataWithNilaiById($id_pariwisata);
        $data['kriteria'] = $this->M_Kriteria->getAllKriteria();
        $data['subkriteria'] = $this->M_Kriteria->getAllSubkriteria();
        $data['tot_notif'] = $this->M_Desa->getCountUserNotifUnread($data['user']['id_user']);

        $this->form_validation->set_rules('nm_pariwisata', 'Nama Destinasi Wisata', 'required', [
            'required'  => 'Nama Destinasi Wisata Wajib Diisi!',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_desa', $data);
            $this->load->view('survey/ubah_survey', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Desa->editDataWisataWithNilai($id_pariwisata);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('desa/tampil_survey');
        }
    }

    public function getUserNotif($user_id)
    {
        $data = $this->M_Desa->getUserNotif($user_id);
        echo json_encode($data);
    }

    public function getCountUserNotifUnread($user_id)
    {
        $data = $this->M_Desa->getCountUserNotifUnread($user_id);
        echo $data;
    }

    public function readAllNotif($user_id)
    {
        $this->M_Desa->readAllNotif($user_id);
    }
}
