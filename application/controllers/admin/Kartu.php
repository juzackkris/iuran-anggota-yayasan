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
            $data = $this->Admin_m->ambil_data($this->session->userdata('id_admin'));
            $data = array(
                'id_admin' => $data->id_admin,
                'nama_admin' => $data->nama_admin,
                'username' => $data->username,
                'password' => $data->password
            );
            $data['title'] = 'Cetak Kartu Anggota';
            $data['kk'] = $this->Kk_m->get('kk')->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/kartu/index', $data);
            $this->load->view('templates/footer');
        }
    }
}
