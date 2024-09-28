<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    public function index()
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $data['title'] = 'Profil';
        $data['super_admin'] = $this->db->get('super_admin')->result();
        $this->load->view('templates_super_admin/header', $data);
        $this->load->view('templates_super_admin/sidebar', $data);
        $this->load->view('superAdmin/profil/index', $data);
        $this->load->view('templates_super_admin/footer');
    }


    public function ubah($id)
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $data['cari'] = $this->db->get_where('super_admin', array('id_super_admin' => $id))->result();
        $this->load->view('templates_super_admin/header', $data);
        $this->load->view('templates_super_admin/sidebar', $data);
        $this->load->view('superAdmin/profil/index', $data);
        $this->load->view('templates_super_admin/footer');
    }

    public function subah()
    {
        $nama_SuperAdmin = $this->input->post('nama_super_admin');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $id = $this->input->post('kode');

        if ($password == "") {
            $data = array(
                'nama_super_admin' => $nama_SuperAdmin,
                'username' => $username,
            );
        } else {
            $data = array(
                'nama_super_admin' => $nama_SuperAdmin,
                'username' => $username,
                'password' => md5($password)
            );
        }
        $this->db->where('id_super_admin', $id);
        $this->db->update('super_admin', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Profil berhasil diubah.</div>');
        redirect('superAdmin/profil');
    }
}