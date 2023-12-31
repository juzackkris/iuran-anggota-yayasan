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
        $this->load->view('admin/masuk/index');
    }

    public function proses()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $cek_admin = $this->db->get_where('admin', array('username' => $username, 'password' => md5($password)));
        // $cek2 = $this->db->get_where('bendahara', array('username' => $username, 'password' => md5($password)));
        $banyak_admin = $cek_admin->num_rows();
        // $banyak2 = $cek2->num_rows();
        $data = $cek_admin->result();
        if ($banyak_admin >= 1) {
            $data_session = array(
                'id_admin' => $data[0]->id_admin,
                'username' => $username,
                'status' => 'login'
            );
            $this->session->set_userdata($data_session);
            redirect('admin/Dashboard');
        } 
        // elseif ($banyak2 >= 1) {
        //     $data_session = array(
        //         'id_siswa' => $data[0]->id_siswa,
        //         'username' => $username,
        //         'status' => 'login'
        //     );
        //     $this->session->set_userdata($data_session);
        //     redirect('pengguna/home');
        // } 
        
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