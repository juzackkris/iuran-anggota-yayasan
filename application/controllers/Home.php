<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        if ($this->session->userdata('status') !== "login"){
        }
    }
    public function index()
    {
        $this->load->view('home/index');
    }

    public function proses()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $cek_admin = $this->db->get_where('admin', array('username' => $username, 'password' => md5($password)));

        $banyak_admin = $cek_admin->num_rows();
        $data_admin = $cek_admin->result();

        if ($banyak_admin >= 1) {
            $data_session = array(
                'id_admin' => $data_admin[0]->id_admin,
                'username' => $username,
                'status' => 'login'
            );
            $this->session->set_userdata($data_session);
            redirect('admin/dashboard');
        } 
        else {
            $this->session->set_flashdata('error', 'Username atau Password masih salah');
            redirect('home');
        }
    }

    public function keluar()
    {
        session_destroy();
        redirect('home');
    }
}
