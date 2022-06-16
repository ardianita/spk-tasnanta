<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('email') == "") {
            redirect('auth');
        }
        $this->load->model('M_Kriteria', 'M_Dinas');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Kriteria Pembangunan';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['kriteria'] = $this->M_Kriteria->getAllKriteria();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('kriteria/v_kriteria', $data);
        $this->load->view('template/footer');
    }

    public function tambah_kriteria()
    {
        $data['title'] = 'Tambah Kriteria Pembangunan';
        $data['admin'] = $this->M_Dinas->getDataDinas();

        $this->form_validation->set_rules('nm_kriteria', 'Kriteria', 'required|regex_match[/^([a-z ])+$/i]', [
            'required' => 'Kriteria Wajib Diisi!',
            'regex_match' => 'Kriteria Haruf Huruf!',
        ]);
        $this->form_validation->set_rules('j_kriteria', 'Jenis Kriteria', 'required', [
            'required'  => 'Jenis Kriteria Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('bobot_kriteria', 'Bobot', 'required|numeric|trim|less_than_equal_to[100]', [
            'required'  => 'Bobot Kriteria Wajib Diisi!',
            'numeric'   => 'Bobot Kriteria Harus Angka!',
            'less_than_equal_to'    => 'Bobot Antara 0 - 100'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_dinas', $data);
            $this->load->view('kriteria/v_tambah_ktr', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Kriteria->tambahDataKriteria();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Kriteria berhasil ditambah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('kriteria');
        }
    }

    public function hapus_kriteria($id_kriteria)
    {
        $this->M_Kriteria->hapusDataKriteria($id_kriteria);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Kriteria berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('kriteria');
    }

    public function edit_kriteria($id_kriteria)
    {
        $data['title'] = 'Edit Kriteria Pembangunan';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['kriteria'] = $this->M_Kriteria->getKriteriaById($id_kriteria);

        $this->form_validation->set_rules('nm_kriteria', 'Kriteria', 'required|regex_match[/^([a-z ])+$/i]', [
            'required'  => 'Kriteria Wajib Diisi!',
            'regex_match' => 'Kriteria Haruf Huruf!',
        ]);
        $this->form_validation->set_rules('j_kriteria', 'Jenis Kriteria', 'required', [
            'required'  => 'Jenis Kriteria Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('bobot_kriteria', 'Bobot Kriteria', 'required|numeric|trim|less_than_equal_to[100]', [
            'required'  => 'Bobot Kriteria Wajib Diisi!',
            'numeric'   => 'Bobot Kriteria Harus Angka!',
            'less_than_equal_to'    => 'Bobot Antara 0 - 100'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_dinas', $data);
            $this->load->view('kriteria/v_edit_ktr', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Kriteria->editDataKriteria($id_kriteria);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Kriteria berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('kriteria');
        }
    }

    public function tampil_subkriteria()
    {
        $data['title'] = 'Subkriteria Pembangunan';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['subkriteria'] = $this->M_Kriteria->getAllSubkriteria();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('subkriteria/v_subkriteria', $data);
        $this->load->view('template/footer');
    }

    public function tambah_subkriteria()
    {
        $data['title'] = 'Tambah Subkriteria Pembangunan';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['kriteria'] = $this->M_Kriteria->getAllKriteria();

        $this->form_validation->set_rules('id_kriteria', 'Kriteria', 'required', [
            'required'  => 'Kriteria Wajib Diisi!',
        ]);
        $this->form_validation->set_rules('nm_subkriteria', 'Subkriteria', 'required|regex_match[/^([a-z ])+$/i]', [
            'required'  => 'Subkriteria Wajib Diisi!',
            'regex_match'  => 'Subkriteria Haruf Huruf!'
        ]);
        $this->form_validation->set_rules('nilai', 'Nilai Subkriteria', 'required|trim|numeric|less_than_equal_to[100]', [
            'required'  => 'Nilai Wajib Diisi!',
            'numeric'   => 'Nilai Harus Angka!',
            'less_than_equal_to'    => 'Nilai Antara 0 - 100'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_dinas', $data);
            $this->load->view('subkriteria/v_tambah_sktr', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Kriteria->tambahDataSubkriteria();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil ditambah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('kriteria/tampil_subkriteria');
        }
    }

    public function hapus_subkriteria($id_subkriteria)
    {
        $this->M_Kriteria->hapusDataSubkriteria($id_subkriteria);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('kriteria/tampil_subkriteria');
    }

    public function edit_subkriteria($id_subkriteria)
    {
        $data['title'] = 'Edit Subriteria Pembangunan';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['subkriteria'] = $this->M_Kriteria->getSubkriteriaById($id_subkriteria);
        $data['kriteria'] = $this->M_Kriteria->getAllKriteria();

        $this->form_validation->set_rules('id_kriteria', 'Kriteria', 'required', [
            'required'  => 'Kriteria Wajib Diisi!',
        ]);
        $this->form_validation->set_rules('nm_subkriteria', 'Subkriteria', 'required|regex_match[/^([a-z ])+$/i]', [
            'required'  => 'Subkriteria Wajib Diisi!',
            'regex_match'  => 'Subkriteria Harus Huruf!',
        ]);
        $this->form_validation->set_rules('nilai', 'Nilai', 'required|trim|numeric|less_than_equal_to[100]', [
            'required'             => 'Nilai Wajib Diisi!',
            'numeric'              => 'Nilai Harus Angka!',
            'less_than_equal_to'   => 'Nilai Antara 0 - 100'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_dinas', $data);
            $this->load->view('subkriteria/v_edit_sktr', $data);
            $this->load->view('template/footer');
        } else {
            $this->M_Kriteria->editDataSubkriteria($id_subkriteria);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('kriteria/tampil_subkriteria');
        }
    }
}
