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
        $data = $this->Admin_m->ambil_data($this->session->userdata('id_admin'));
        $data = array(
            'id_admin' => $data->id_admin,
            'nama_admin' => $data->nama_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $data['title'] = 'Profil';
        $data['admin'] = $this->db->get('admin')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/profil/index', $data);
        $this->load->view('templates/footer');
    }


    public function ubah($id)
    {
        $data = $this->Admin_m->ambil_data($this->session->userdata('id_admin'));
        $data = array(
            'id_admin' => $data->id_admin,
            'nama_admin' => $data->nama_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $data['cari'] = $this->db->get_where('admin', array('id_admin' => $id))->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/profil/index', $data);
        $this->load->view('templates/footer');
    }

    public function subah()
    {
        $nama_admin = $this->input->post('nama_admin');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $id = $this->input->post('kode');

        if ($password == "") {
            $data = array(
                'nama_admin' => $nama_admin,
                'username' => $username,
            );
        } else {
            $data = array(
                'nama_admin' => $nama_admin,
                'username' => $username,
                'password' => md5($password)
            );
        }
        $this->db->where('id_admin', $id);
        $this->db->update('admin', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Profil berhasil diubah.</div>');
        redirect('admin/profil');
    }
}