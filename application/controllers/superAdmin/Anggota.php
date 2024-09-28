<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
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
            $data['title'] = 'Data Anggota Keluarga';
            $data['anggota'] = $this->Anggota_m->get('anggota')->result_array();
            $data['kk'] = $this->iuranModel->get_data('kk')->result();
            $this->form_validation->set_rules('nama', 'Nama Anggota Keluarga', 'required|trim', ['required' => 'Nama Anggota Keluarga Wajib diisi!.']);
            $this->form_validation->set_rules('nama_kk', 'Nama Kepala Keluarga', 'required|trim', ['required' => 'Nama Kepala Keluarga Wajib diisi!.']);
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat wajib di isi!.']);
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => 'Tanggal Lahir wajib di isi!.']);
            $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim', ['required' => 'Nomor Telepon wajib di isi!.']);
            $this->form_validation->set_rules('status', 'Status', 'required|trim', ['required' => 'Status wajib di isi!.']);
            $this->form_validation->set_rules('no_kk', 'No Kartu Keluarga', 'required|trim', ['required' => 'Nomor Kartu Keluarga wajib di isi!.']);
            $this->form_validation->set_rules('nik', 'No Kartu Keluarga', 'required|trim', ['required' => 'NIK wajib di isi!.']);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates_super_admin/header', $data);
                $this->load->view('templates_super_admin/sidebar', $data);
                $this->load->view('superAdmin/Anggota/index', $data);
                $this->load->view('templates_super_admin/footer');
            } else {
                $tgl_input = date('Y-m');
                $data = [
                    'nama' => html_escape($this->input->post('nama', true)),
                    'nama_kk' => html_escape($this->input->post('nama_kk', true)),
                    'alamat' => html_escape($this->input->post('alamat', true)),
                    'tgl_lahir' => html_escape($this->input->post('tgl_lahir', true)),
                    'telepon' => html_escape($this->input->post('telepon', true)),
                    'status' => html_escape($this->input->post('status', true)),
                    'no_kk' => html_escape($this->input->post('no_kk', true)),
                    'nik' => html_escape($this->input->post('nik', true)),
                    'tgl_input' => $tgl_input,
                ];

                // tambah data Aggota
                $tbAnggota = $this->db->insert('Anggota', $data);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Anggota Keluarga Berhasil Ditambahkan.</div>');
                redirect('admin/Anggota');
            }
        } else {
            redirect('home/keluar/');
        }
    }

    public function ubahAnggota($id)
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $where = ['id_anggota' => $id];
        $data['anggota'] = $this->Anggota_m->get_where('anggota', $where)->row_array();
        $data['kk'] = $this->iuranModel->get_data('kk')->result();

        $data['title'] = 'Ubah Data Anggota Keluarga ';

        // Rules Form
        $this->form_validation->set_rules('nama', 'Nama Anggota Keluarga', 'required|trim', ['required' => 'Nama Anggota Keluarga Wajib diisi!.']);
        $this->form_validation->set_rules('nama_kk', 'Nama Kepala Keluarga', 'required|trim', ['required' => 'Nama Kepala Keluarga Wajib diisi!.']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat wajib di isi!.']);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => 'Tanggal Lahir wajib di isi!.']);
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim', ['required' => 'Nomor Telepon wajib di isi!.']);
        $this->form_validation->set_rules('status', 'Status', 'required|trim', ['required' => 'Status wajib di isi!.']);
        $this->form_validation->set_rules('no_kk', 'Nomor Kartu Keluarga', 'required|trim', ['required' => 'Nomor Kartu Keluarga wajib di isi!.']);
        $this->form_validation->set_rules('nik', 'Nomor Kartu Keluarga', 'required|trim', ['required' => 'NIK wajib di isi!.']);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates_super_admin/header', $data);
            $this->load->view('templates_super_admin/sidebar', $data);
            $this->load->view('superAdmin/anggota/ubah', $data);
            $this->load->view('templates_super_admin/footer');
        } else {
            $this->ubahDataAnggota();
        }
    }

    public function ubahDataAnggota()
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $idAnggota = $this->input->post('id_anggota');
        $data = [
            'nama' => html_escape($this->input->post('nama', true)),
            'nama_kk' => html_escape($this->input->post('nama_kk', true)),
            'alamat' => html_escape($this->input->post('alamat', true)),
            'tgl_lahir' => html_escape($this->input->post('tgl_lahir', true)),
            'telepon' => html_escape($this->input->post('telepon', true)),
            'status' => html_escape($this->input->post('status', true)),
            'no_kk' => html_escape($this->input->post('no_kk', true)),
            'nik' => html_escape($this->input->post('nik', true)),
            'tgl_meninggal' => html_escape($this->input->post('tgl_meninggal', true)),
        ];
        $this->db->where('id_anggota', $idAnggota);
        $this->Anggota_m->update('anggota', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Anggota Keluarga Berhasil Diubah.</div>');
        redirect('superAdmin/anggota');
    }

    public function hapus($id)
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
            $data = array(
                'id_super_admin' => $data->id_super_admin,
                'nama_super_admin' => $data->nama_super_admin,
                'username' => $data->username,
                'password' => $data->password
            );
        $this->db->delete('anggota', ['id_anggota' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-trash"></i> Data Anggota Keluarga Berhasil Dihapus.</div>');
        redirect('superAdmin/anggota');
    }
}
