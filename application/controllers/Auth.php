<?php

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            if ($this->session->userdata('id_level') == 1) {
                redirect('dinas');
            } else if ($this->session->userdata('id_level') == 2) {
                redirect('desa');
            }
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required'  => 'Email Wajib Diisi!',
            'valid_email'  => 'Email Tidak Valid!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required'  => 'Password Wajib Diisi!'
        ]);

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Login';
            $this->load->view('template/header', $data);
            $this->load->view('v_login');
            $this->load->view('template/footer');
        } else {

            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->db->get_where('tb_user', ['email' => $email])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'id_user' => $user['id_user'],
                    'id_level' => $user['id_level']
                ];
                $this->session->set_userdata($data);

                if ($this->session->userdata('id_level') == '1') {
                    redirect('dinas');
                } else if ($this->session->userdata('id_level') == '2') {
                    redirect('desa');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class ="alert alert-danger" role="alert">Password Salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class ="alert alert-danger" role="alert">Email Belum Terdaftar!</div>');
            redirect('auth');
        }
    }

    public function registrasi()
    {
        if ($this->session->userdata('email')) {
            if ($this->session->userdata('id_level') == 1) {
                redirect('dinas');
            } else if ($this->session->userdata('id_level') == 2) {
                redirect('desa');
            }
        }

        $argument = 'desa';
        $data['argument'] = $argument;

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
            'required'  => 'Email Wajib Diisi!',
            'is_unique'  => 'Email Sudah Terdaftar!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required'  => 'Username Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('name',  $argument ? 'Nama Lengkap' : 'Nama Lengkap', 'required', [
            'required'  => $argument ? 'Nama Lengkap' : 'Nama Lengkap' . 'Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim|numeric', [
            'required'  => 'Nomor Telepon Wajib Diisi!',
            'numeric'  => 'Nomor Telepon Harus Angka!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|max_length[8]', [
            'required'  => 'Password Wajib Diisi!'
        ]);

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Registrasi';
            $this->load->view('template/header', $data);
            $this->load->view('v_registrasi');
            $this->load->view('template/footer');
        } else {
            $data = array(
                'email'     => htmlspecialchars($this->input->post('email', TRUE)),
                'username'  => htmlspecialchars($this->input->post('username', TRUE)),
                'name'      => htmlspecialchars($this->input->post('name', TRUE)),
                'telp'      => $this->input->post('telp', TRUE),
                'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'id_level'  => 2,
                'foto'      => 'default.png',
            );

            $this->db->insert('tb_user', $data);

            $this->session->set_flashdata('pesan', '<div class ="alert alert-success" role="alert">Berhasil Registrasi. Silahkan Login!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id_level');

        $this->session->set_flashdata('pesan', '<div class ="alert alert-success" role="alert">Berhasil Logout!</div>');
        redirect('auth');
    }
}
