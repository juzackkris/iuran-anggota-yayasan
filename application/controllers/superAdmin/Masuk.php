<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masuk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    public function index()
    {
        $this->load->view('superAdmin/masuk/index');
    }

    public function proses()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $cek_admin = $this->db->get_where('admin', array('username' => $username, 'password' => md5($password)));
        $cek_SuperAdmin = $this->db->get_where('super_admin', array('username' => $username, 'password' => md5($password)));

        $banyak_admin = $cek_admin->num_rows();
        $banyak_SuperAdmin = $cek_SuperAdmin->num_rows();

        $data_admin = $cek_admin->result();
        $data_SuperAdmin = $cek_SuperAdmin->result();


        if ($banyak_admin >= 1) {
            $data_session = array(
                'id_admin' => $data_admin[0]->id_admin,
                'username' => $username,
                'status' => 'login'
            );
            $this->session->set_userdata($data_session);
            redirect('admin/Dashboard');
        } 
        elseif ($banyak_SuperAdmin >= 1) {
            $data_session = array(
                'id_super_admin' => $data_SuperAdmin[0]->id_SuperAdmin,
                'username' => $username,
                'status' => 'login'
            );
            $this->session->set_userdata($data_session);
            redirect('superAdmin/home');
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