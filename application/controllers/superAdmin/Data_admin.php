<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
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
            $data['title'] = 'Data Admin';
            $data['admin'] = $this->SuperAdmin_m->get('admin')->result_array();
            $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required|trim', ['required' => 'Nama Super Admin Wajib diisi!.']);
            $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => 'Username Wajib diisi!.']);
            $this->form_validation->set_rules('password', 'password', 'required|trim', ['required' => 'password wajib di isi!.']);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates_super_admin/header', $data);
                $this->load->view('templates_super_admin/sidebar', $data);
                $this->load->view('superAdmin/data_admin/index', $data);
                $this->load->view('templates_super_admin/footer');
            } else {
                $nama_admin = $this->input->post('nama_admin');
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $data = array(
                    'nama_admin' => $nama_admin,
                    'username' => $username,
                    'password' => md5($password)
                );

                // tambah data Aggota
                $admin = $this->db->insert('admin', $data);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Admin Berhasil Ditambahkan.</div>');
                redirect('superAdmin/Data_admin');
            }
        } else {
            redirect('home/keluar/');
        }
    }

    public function ubahAdmin($id)
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $where = ['id_admin' => $id];
        $data['admin'] = $this->SuperAdmin_m->get_where('admin', $where)->row_array();
        $data['title'] = 'Ubah Data Admin';

        // Rules Form
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required|trim', ['required' => 'Nama Admin Wajib diisi!.']);
        $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => 'username Wajib diisi!.']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password wajib di isi!.']);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates_super_admin/header', $data);
            $this->load->view('templates_super_admin/sidebar', $data);
            $this->load->view('superAdmin/data_admin/ubah', $data);
            $this->load->view('templates_super_admin/footer');
        } else {
            $this->ubahDataAdmin();
        }
    }

    public function ubahDataAdmin()
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $id_admin = $this->input->post('id_admin');
        // $data = [
        //     'nama_super_admin' => html_escape($this->input->post('nama_admin', true)),
        //     'username' => html_escape($this->input->post('username', true)),
        //     'password' => html_escape($this->input->post('password', true)),
        // ];


        $nama_admin = $this->input->post('nama_admin');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data = array(
            'nama_admin' => $nama_admin,
            'username' => $username,
            'password' => md5($password)
        );
        $this->db->where('id_admin', $id_admin);
        $this->SuperAdmin_m->update('admin', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Admin Berhasil Diubah.</div>');
        redirect('superAdmin/Data_admin');
    }

    public function hapus($id)
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_admin'));
            $data = array(
                'id_admin' => $data->id_admin,
                'nama_admin' => $data->nama_admin,
                'username' => $data->username,
                'password' => $data->password
            );
        $this->db->delete('admin', ['id_admin' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-trash"></i> Data Admin Berhasil Dihapus.</div>');
        redirect('superAdmin/Data_admin');
    }
}
