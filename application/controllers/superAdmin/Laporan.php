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
            $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
            $data = array(
                'id_super_admin' => $data->id_super_admin,
                'nama_super_admin' => $data->nama_super_admin,
                'username' => $data->username,
                'password' => $data->password
            );
            $data['title'] = 'Laporan';
            $this->load->view('templates_super_admin/header', $data);
            $this->load->view('templates_super_admin/sidebar', $data);
            $this->load->view('superAdmin/laporan/index', $data);
            $this->load->view('templates_super_admin/footer');
        } else {
            redirect('home/keluar/');
        }
    }

    public function kk()
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $data['title'] = 'Laporan Kepala Keluarga';
        $data['kk'] = $this->db->get('kk')->result_array();
        $this->load->view('templates_super_admin/header', $data);
        $this->load->view('superAdmin/laporan/laporan_kk', $data);
        $this->load->view('templates_super_admin/footer');
    }

    public function anggota()
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $data['title'] = 'Laporan Anggota Keluarga';
        $data['anggota'] = $this->db->get('anggota')->result_array();
        $this->load->view('templates_super_admin/header', $data);
        $this->load->view('superAdmin/laporan/laporan_anggota', $data);
        $this->load->view('templates_super_admin/footer');
    }

    public function pembayaran()
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
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
        $this->load->view('templates_super_admin/header', $data);
        $this->load->view('superAdmin/laporan/laporan_pembayaran', $data);
        $this->load->view('templates_super_admin/footer');
    }

    public function pembayaranExcel($mulaiTgl, $sampaiTgl)
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $data = [
            'mulaiTgl' => $mulaiTgl,
            'sampaiTgl' => $sampaiTgl
        ];
        $data['title'] = 'Laporan Excel Pembayaran';
        $data['bayar'] = $this->Transaksi_m->get_join($mulaiTgl, $sampaiTgl)->result_array();
        $this->load->view('templates_super_admin/header', $data);
        $this->load->view('superAdmin/laporan/laporan_pembayaran_excel', $data);
        $this->load->view('templates_super_admin/footer');
    }

    public function pendaftaranBulanan()
    {

        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data_admin = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $tgl_input = $this->input->post('tgl_input');
        $data = [
            'tgl_input' => $tgl_input
        ];
        $data['title'] = 'Laporan Pendaftaran Anggota Baru Bulanan';
        $data['kk'] = $this->Transaksi_m->get_pendaftaran_bulanan($tgl_input)->result_array();
        $this->load->view('templates_super_admin/header', $data);
        $this->load->view('templates_super_admin/sidebar', $data_admin);
        $this->load->view('superAdmin/laporan/laporan_pendaftaranBulanan', $data);
        $this->load->view('templates_super_admin/footer');
    }

    public function kematianPertahun()
    {

        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data_admin = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $mulaiTgl = $this->input->post('mulai_tgl');
        $sampaiTgl = $this->input->post('sampai_tgl');
        $data = [
            'mulaiTgl' => $mulaiTgl,
            'sampaiTgl' => $sampaiTgl
        ];
        $data['title'] = 'Laporan Kematian Anggota Pertahun';
        $data['kk'] = $this->Transaksi_m->get_kematian_anggota($mulaiTgl, $sampaiTgl)->result_array();
        $this->load->view('templates_super_admin/header', $data);
        $this->load->view('templates_super_admin/sidebar', $data_admin);
        $this->load->view('superAdmin/laporan/laporan_kematian', $data);
        $this->load->view('templates_super_admin/footer');
    }

    public function cetakStruk($nomor_id)
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
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
        $this->load->view('templates_super_admin/header', $data);
        $this->load->view('superAdmin/laporan/cetak_struk', $data);
    }

    public function cetakStrukPeriode($nomor_id)
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
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
            redirect('superAdmin/transaksi/cariTransaksi?nomor_id=' . $nomor_id);
        }
        $this->load->view('templates_super_admin/header', $data);
        $this->load->view('superAdmin/laporan/cetak_struk', $data);
    }
}
