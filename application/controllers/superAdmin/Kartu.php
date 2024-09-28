<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kartu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kk_m');
        // cekSession();
    }

    public function index()
    {
        if ($this->session->userdata('status') == "login") {
            $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
            $data = array(
                'id_super_admin' => $data->id_super_admin,
                'nama_super_admin' => $data->nama_super_admin,
                'username' => $data->username,
                'password' => $data->password
            );
            $data['title'] = 'Cetak Kartu Anggota';
            $data['kk'] = $this->Kk_m->get('kk')->result_array();
            $this->load->view('templates_super_admin/header', $data);
            $this->load->view('templates_super_admin/sidebar', $data);
            $this->load->view('superAdmin/kartu/index', $data);
            $this->load->view('templates_super_admin/footer');
        }
    }
}
