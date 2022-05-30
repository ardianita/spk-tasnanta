<?php

class SAW extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('email') == "") {
            redirect('auth');
        }
        $this->load->model('M_Dinas', 'M_Desa', 'M_Kriteria', 'M_Saw');
    }

    public function index()
    {
        $data['title'] = 'Perhitungan SAW';
        $data['admin'] = $this->M_Dinas->getDataDinas();
        $data['wisata'] = $this->M_Desa->getWisata();
        $data['kriteria'] = $this->M_Kriteria->getAllKriteria();
        $data['subkriteria'] = $this->M_Kriteria->getAllSubkriteria();
        $data['nilai'] = $this->M_Desa->getPariwisataWithNilai();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_dinas', $data);
        $this->load->view('saw/index', $data);
        $this->load->view('template/footer');
    }
}
