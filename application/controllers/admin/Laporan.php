<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
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
            $data['title'] = 'Laporan';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/laporan/index', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('home/keluar/');
        }
    }

    public function kk()
    {
        $data = $this->Admin_m->ambil_data($this->session->userdata('id_admin'));
        $data = array(
            'id_admin' => $data->id_admin,
            'nama_admin' => $data->nama_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $data['title'] = 'Laporan Kepala Keluarga';
        $data['kk'] = $this->db->get('kk')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/laporan/laporan_kk', $data);
        $this->load->view('templates/footer');
    }

    public function anggota()
    {
        $data = $this->Admin_m->ambil_data($this->session->userdata('id_admin'));
        $data = array(
            'id_admin' => $data->id_admin,
            'nama_admin' => $data->nama_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $data['title'] = 'Laporan Anggota Keluarga';
        $data['anggota'] = $this->db->get('anggota')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/laporan/laporan_anggota', $data);
        $this->load->view('templates/footer');
    }

    public function pembayaran()
    {
        $data = $this->Admin_m->ambil_data($this->session->userdata('id_admin'));
        $data = array(
            'id_admin' => $data->id_admin,
            'nama_admin' => $data->nama_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $mulaiTgl = $this->input->post('mulai_tgl');
        $sampaiTgl = $this->input->post('sampai_tgl');
        $data = [
            'mulaiTgl' => $mulaiTgl,
            'sampaiTgl' => $sampaiTgl
        ];
        $data['title'] = 'Laporan Pembayaran';
        $data['bayar'] = $this->Transaksi_m->get_join($mulaiTgl, $sampaiTgl)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/laporan/laporan_pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function pembayaranExcel($mulaiTgl, $sampaiTgl)
    {
        $data = $this->Admin_m->ambil_data($this->session->userdata('id_admin'));
        $data = array(
            'id_admin' => $data->id_admin,
            'nama_admin' => $data->nama_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $data = [
            'mulaiTgl' => $mulaiTgl,
            'sampaiTgl' => $sampaiTgl
        ];
        $data['title'] = 'Laporan Excel Pembayaran';
        $data['bayar'] = $this->Transaksi_m->get_join($mulaiTgl, $sampaiTgl)->result_array();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/laporan/laporan_pembayaran_excel', $data);
        $this->load->view('layout/footer');
    }

    public function tunggakan()
    {
        $data = $this->Admin_m->ambil_data($this->session->userdata('id_admin'));
        $data = array(
            'id_admin' => $data->id_admin,
            'nama_admin' => $data->nama_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $data['title'] = 'Laporan Tunggakan Pembayaran';
        $where = [
            'ket' => ''
        ];
        $data['tunggakan'] = $this->Transaksi_m->get_join_where('pembayaran', $where)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/laporan/laporan_tunggakan', $data);
        $this->load->view('templates/footer');
    }

    public function cetakStruk($nomor_id)
    {
        $data = $this->Admin_m->ambil_data($this->session->userdata('id_admin'));
        $data = array(
            'id_admin' => $data->id_admin,
            'nama_admin' => $data->nama_admin,
            'username' => $data->username,
            'password' => $data->password
        );

        $where = ['nomor_id' => $nomor_id];
        $data['kk'] = $this->Transaksi_m->get_where('kk', $where)->row_array();
        $data['pembayaran'] = $this->Transaksi_m->get_join_where('pembayaran', $where)->row_array();
        $data['title'] = 'Nota Pembayaran_'. $nomor_id;
        $data['bayar'] = $this->Transaksi_m->get_struk($nomor_id)->result_array();
        $data['bulanBayar'] = $this->Transaksi_m->get_bulanBayar($nomor_id)->result_array();
        if ($data['bayar'] == null) {
            $this->session->set_flashdata('pesan_transaksi', '<div class="alert alert-danger" role="alert"><i class="fas fa-info-circle"></i> Tidak ada transaksi hari ini.</div>');
            redirect('admin/transaksi/cariTransaksi?nomor_id=' . $nomor_id);
        }
        $this->load->view('templates/header', $data);
        $this->load->view('admin/laporan/cetak_struk', $data);
    }

    public function cetakStrukPeriode($nomor_id)
    {
        $data = $this->Admin_m->ambil_data($this->session->userdata('id_admin'));
        $data = array(
            'id_admin' => $data->id_admin,
            'nama_admin' => $data->nama_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $tanggal = $this->input->post('tanggal');
        $convertTanggal = date("d F Y", strtotime($tanggal));
        // $nobayar = $this->input->post('nobayar');
        $data = [
            'tanggal' => $tanggal
        ];
        $where = ['nomor_id' => $nomor_id];
        $data['kk'] = $this->Transaksi_m->get_where('kk', $where)->row_array();
        $data['pembayaran'] = $this->Transaksi_m->get_join_where('pembayaran', $where)->row_array();
        $data['title'] = 'Nota Pembayaran_'. $nomor_id;
        $data['bulanBayar'] = $this->Transaksi_m->get_bulanBayar_periode($tanggal, $nomor_id)->result_array();
        $data['bayar'] = $this->Transaksi_m->get_struk_periode($tanggal, $nomor_id)->result_array();
        if ($data['bayar'] == null) {
            $this->session->set_flashdata('pesan_pertanggal', '<div class="alert alert-danger" role="alert"><i class="fas fa-info-circle"></i> Tidak ada transaksi pada tanggal '. $convertTanggal .'.</div>');
            redirect('admin/transaksi/cariTransaksi?nomor_id=' . $nomor_id);
        }
        $this->load->view('templates/header', $data);
        $this->load->view('admin/laporan/cetak_struk', $data);
    }
}
