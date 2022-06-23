<?php

class dinas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('email') == "") {
            redirect('auth');
        }
        $this->load->model('M_Dinas', 'M_Desa', 'M_Saw');
    }

    public function index()
    {

        $data['title'] = 'Dashboard';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['dinas'] = $this->M_Dinas->getCountDinas($data['admin']['id_level'] == 1);
        $data['desa'] = $this->M_Dinas->getCountDesa($data['admin']['id_level'] == 2);
        $data['wisata'] = $this->M_Dinas->getCountWisata();
        $data['data_desa'] = $this->M_Dinas->getCountDataDesa($data['admin']['id_level'] == 2);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('admin/dashboard_dinas', $data);
        $this->load->view('template/footer');
    }

    public function ubah_password()
    {

        $data['title'] = 'Ubah Password';
        $data['admin'] = $this->M_Dinas->getDataDinas();

        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim', [
            'required'  => 'Password Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[6]|matches[password_baru2]', [
            'required'      => 'Password Baru Wajib Diisi!',
            'matches'       => 'Password Tidak Sama!',
            'min_length'    => 'Password kurang dari 6 karakter!'
        ]);
        $this->form_validation->set_rules('password_baru2', 'Confirm Password Baru', 'required|trim|min_length[6]|matches[password_baru1]', [
            'required'  => 'Ulangi Password Baru!',
            'matches'   => 'Password Tidak Sama!',
            'min_length'    => 'Password kurang dari 6 karakter!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_dinas', $data);
            $this->load->view('admin/ubah_pass', $data);
            $this->load->view('template/footer');
        } else {
            $password_lama = $this->input->post('password_lama');
            $password_baru1 = $this->input->post('password_baru1');
            if (!password_verify($password_lama, $data['admin']['password'])) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password salah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('dinas/ubah_password');
            } else {
                if ($password_lama == $password_baru1) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password baru tidak boleh sama dengan password lama!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('dinas/ubah_password');
                } else {
                    $password_hash = password_hash($password_baru1, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('tb_user');

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Password berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('dinas/ubah_password');
                }
            }
        }
    }

    public function tampil_destinasi()
    {
        $data['title'] = 'Data Infrastruktur Destinasi Wisata';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['pengguna'] = $this->M_Dinas->getDataUser();
        $data['wisata'] = $this->M_Desa->getWisata();
        $data['status'] = $this->M_Dinas->getStatus();
        $data['kriteria'] = $this->M_Kriteria->getAllKriteria();
        $data['subkriteria'] = $this->M_Kriteria->getAllSubkriteria();
        $data['nilai'] = $this->M_Desa->getPariwisataWithNilai();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('destinasi/v_destinasi', $data);
        $this->load->view('template/footer');
    }

    public function profil()
    {
        $this->load->model('M_Dinas');

        $data['title'] = 'Profile';
        $data['admin'] = $this->M_Dinas->getDataDinas();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('admin/profil_dinas', $data);
        $this->load->view('template/footer');
    }
    public function ubah_profile()
    {
        $data['title'] = 'Edit Profile';
        $data['admin'] = $this->M_Dinas->getDataDinas();

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_user.username]', [
            'required'  => 'Username Wajib Diisi!',
            'is_unique' => 'Username Sudah Ada!'
        ]);
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required', [
            'required'  => 'Nama Lengkap Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim|numeric', [
            'required'  => 'Nomor Telepon Wajib Diisi!',
            'numeric'  => 'Nomor Telepon Harus Angka!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_dinas', $data);
            $this->load->view('admin/profile_dinas', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Dinas->ubahDataProfile();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('dinas/profil');
        }
    }

    public function pengguna($role = 'desa')
    {

        $data['title'] = 'Pengguna';
        $data['pengguna'] = $this->M_Dinas->getDataUser();
        $data['role'] = $this->M_Dinas->getLevel();
        $data['admin'] = $this->M_Dinas->getDataDinas();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $role == "desa" ? $this->load->view('pengguna/v_user_desa', $data) : $this->load->view('pengguna/v_user', $data);
        $this->load->view('template/footer');
    }

    public function tambah_pengguna($argument = 'desa')
    {
        $data['title'] = 'Tambah Pengguna ' . ucfirst($argument);
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['pengguna'] = $this->M_Dinas->getDataUser();
        $data['role'] = $this->M_Dinas->getLevel();
        $data['argument'] = $argument;

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
            'required'      => 'Email Wajib Diisi!',
            'valid_email'   => 'Email Tidak Valid!',
            'is_unique'     => 'Email Sudah Terdaftar!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_user.username]', [
            'required'  => 'Username Wajib Diisi!',
            'is_unique' => 'Username Sudah Ada!'
        ]);
        $this->form_validation->set_rules('name',  $argument ? 'Nama Desa' : 'Nama Lengkap', 'required|regex_match[/^([a-z ])+$/i]', [
            'required'  => $argument ? 'Nama Desa Wajib Diisi!' : 'Nama Lengkap Wajib Diisi!',
            'regex_match'   => $argument ? 'Nama Desa Harus Huruf!' : 'Nama Lengkap Harus Huruf!'
        ]);
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim|numeric', [
            'required'  => 'Nomor Telepon Wajib Diisi!',
            'numeric'   => 'Nomor Telepon Harus Angka!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
            'required'      => 'Password Wajib Diisi!',
            'min_length'    => 'Password Kurang Dari 6 Karakter!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_dinas', $data);
            $this->load->view('pengguna/v_tambah_user', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Dinas->tambah_user();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Pengguna berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('dinas/pengguna/' . $argument);
        }
    }

    public function edit_pengguna($id_user)
    {
        $data['title'] = 'Edit Data Pengguna';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['pengguna'] = $this->M_Dinas->getUserById($id_user);
        $data['argument'] = $data['pengguna']['id_level'] == 1 ? 'dinas' : 'desa';

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required'  => 'Email Wajib Diisi!',
            'valid_email'   => 'Email Tidak Valid!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'trim|required', [
            'required'  => 'Username Wajib Diisi!',
        ]);
        $this->form_validation->set_rules('name',  $data['pengguna']['id_level'] == 1 ? 'Nama Lengkap' : 'Nama Desa', 'required|regex_match[/^([a-z ])+$/i]', [
            'required'  => $data['pengguna']['id_level'] == 1 ? 'Nama Lengkap Wajib Diisi!' : 'Nama Desa Wajib Diisi!',
            'regex_match'   => $data['pengguna']['id_level'] == 1 ? 'Nama Lengkap Harus Huruf!' : 'Nama Desa Harus Huruf!',
        ]);
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim|numeric', [
            'required'  => 'Nomor Telepon Wajib Diisi!',
            'numeric'   => 'Nomor Telepon Harus Angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_dinas', $data);
            $this->load->view('pengguna/v_edit_user', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Dinas->edit_user($id_user);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Pengguna berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('dinas/pengguna/' . $data['argument']);
        }
    }

    public function hapus_pengguna($id_user)
    {
        $data['pengguna'] = $this->M_Dinas->getUserById($id_user);
        $data['argument'] = $data['pengguna']['id_level'] == 1 ? 'dinas' : 'desa';

        $this->M_Dinas->hapus_user($id_user);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Pengguna berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('dinas/pengguna/' . $data['argument']);
    }

    public function tampil_validasi()
    {
        $data['title'] = 'Validasi Pariwisata';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['wisata'] = $this->M_Desa->getWisata();
        $data['status'] = $this->M_Dinas->getStatus();
        $data['pengguna'] = $this->M_Dinas->getDataUser();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('validasi/v_validasi', $data);
        $this->load->view('template/footer');
    }

    public function validasi($id_pariwisata)
    {
        $data['title'] = 'Validasi';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['wisata'] = $this->M_Desa->getWisataById($id_pariwisata);

        $this->M_Dinas->validate_status($id_pariwisata);
        $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">Status validasi data telah diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('dinas/tampil_validasi');
    }

    public function pemeringkatan()
    {
        $data['title'] = 'Pemeringkatan';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['wisata'] = $this->M_Saw->get_saw();
        $data['status'] = $this->M_Dinas->getStatus();
        $data['pengguna'] = $this->M_Dinas->getDataUser();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('pemeringkatan/v_pemeringkatan', $data);
        $this->load->view('template/footer');
    }

    public function tampil_pembangunan1()
    {
        $data['title'] = 'Pembangunan';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['wisata'] = $this->M_Desa->getStatusWisata1();
        $data['pengguna'] = $this->M_Dinas->getDataUser();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('pembangunan/pembangunan1', $data);
        $this->load->view('template/footer');
    }

    public function tampil_pembangunan2()
    {
        $data['title'] = 'Pembangunan';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['wisata'] = $this->M_Desa->getStatusWisata2();
        $data['pengguna'] = $this->M_Dinas->getDataUser();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('pembangunan/pembangunan2', $data);
        $this->load->view('template/footer');
    }

    public function pembangunan1($id_pariwisata)
    {
        $data['title'] = 'Pembangunan';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['wisata'] = $this->M_Desa->getStatusWisata1();
        $data['pengguna'] = $this->M_Dinas->getDataUser();

        $this->M_Dinas->check_sts_pem($id_pariwisata);
        $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">Status pembangunan telah diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('dinas/tampil_pembangunan2');
    }

    public function ubah_pembangunan($id_pariwisata)
    {
        $data['title'] = 'Pembangunan';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['wisata'] = $this->M_Desa->getWisataById($id_pariwisata);

        $this->M_Dinas->ubah_status_p($id_pariwisata);
        $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">Status pembangunan ditetapkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('dinas/pemeringkatan');
    }
}
