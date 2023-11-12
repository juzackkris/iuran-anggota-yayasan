<?php
class Transaksi extends CI_Controller
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
            $data['title'] = 'Iuran Bulanan';
            $this->load->model('Kk_m');
            $this->form_validation->set_rules('nomor_id', 'Nomor ID', 'required|trim', ['required' => 'Nomor ID wajib di isi!.']);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates_super_admin/header', $data);
                $this->load->view('templates_super_admin/sidebar');
                $this->load->view('superAdmin/transaksi/index', $data);
                $this->load->view('templates_super_admin/footer');
            } else {
                $this->cariTransaksi();
            }
        } else {
            redirect('home/keluar/');
        }
    }

    public function cariTransaksi()
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $data['title'] = 'Iuran Bulanan';

        $nomor_id = $this->input->get('nomor_id', true);
        $where = ['nomor_id' => $nomor_id];
        $data['kk'] = $this->Transaksi_m->get_where('kk', $where)->row_array();
        $idKk = $data['kk']['id_keluarga'];

        if ($data['kk'] == null) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info-circle"></i> Nomor ID Kepala Keluarga <strong>' . $nomor_id . '</strong> Tidak Terdaftar.</div>');
            redirect('superAdmin/transaksi');
        }

        $where = ['id_keluarga' => $idKk];
        $data['pembayaran'] = $this->Transaksi_m->get_where('pembayaran', $where)->result_array();
        $this->load->view('templates_super_admin/header', $data);
        $this->load->view('templates_super_admin/sidebar');
        $this->load->view('superAdmin/transaksi/index', $data);
        $this->load->view('templates_super_admin/footer');
    }

    public function bayar($nomor_id, $id)
    {
        $hari_ini = date('d-m-Y');
        $today = date('ymd');

        // membuat no bayar acak
        $query = "SELECT max(nobayar) AS NoBayar FROM pembayaran WHERE nobayar LIKE '$today%'";
        $data = $this->db->query($query)->result_array();
        $lastNoBayar = $data['NoBayar'];
        $lastNoUrut = substr($lastNoBayar, 6, 4);
        $nextNoUrut = $lastNoUrut + 1;
        $nextNoBayar = $today . sprintf('%04s', $nextNoUrut);

        $where = ['nomor_id' => $nomor_id];
        $data['kk'] = $this->Transaksi_m->get_where('kk', $where)->row_array();
        $nama_kk = $data['kk']['nama_kk'];

        $where = ['id_pb' => $id];
        $data = [
            'nobayar' => $nextNoBayar,
            'tglbayar' => $hari_ini,
            'ket' => 'Lunas'
        ];

        $this->Transaksi_m->update_where('pembayaran', $data, $where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Iuran atas nama kepala keluarga <strong>' . $nama_kk . '</strong> Berhasil Dibayar.</div>');
        redirect('superAdmin/transaksi/cariTransaksi?nomor_id=' . $nomor_id);
    }

    public function bayarBanyak($nomor_id)
    {
        $hari_ini = date('d-m-Y');
        $today = date('ymd');

        // membuat no bayar acak
        $query = "SELECT max(nobayar) AS NoBayar FROM pembayaran WHERE nobayar LIKE '$today%'";
        $data = $this->db->query($query)->result_array();
        $lastNoBayar = $data['NoBayar'];
        $lastNoUrut = substr($lastNoBayar, 6, 4);
        $nextNoUrut = $lastNoUrut + 1;
        $nextNoBayar = $today . sprintf('%04s', $nextNoUrut);

        $where_no = ['nomor_id' => $nomor_id];
        $data['kk'] = $this->Transaksi_m->get_where('kk', $where_no)->row_array();
        $nama_kk = $data['kk']['nama_kk'];
        $checkbox_value = $this->input->post('checkbox_value' , true);
        if (!empty($checkbox_value)) {
            $data = [
                'nobayar' => $nextNoBayar,
                'tglbayar' => $hari_ini,
                'ket' => 'Lunas'
            ];
            $this->db->where_in('id_pb', $checkbox_value);
            $this->db->update('pembayaran', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Iuran atas nama kepala keluarga <strong>' . $nama_kk . '</strong> Berhasil Dibayar </div>');
            redirect('superAdmin/transaksi/cariTransaksi?nomor_id=' . $nomor_id);
        }
        else{
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info-circle"></i> Tidak ada bulan pembayaran yang dipilih</div>');
            redirect('superAdmin/transaksi/cariTransaksi?nomor_id=' . $nomor_id);
        }        
    }

    public function batal($nomor_id, $idPb)
    {
        $where = ['nomor_id' => $nomor_id];
        $data['kk'] = $this->Transaksi_m->get_where('kk', $where)->row_array();
        $nama_kk = $data['kk']['nama_kk'];

        $where = ['id_pb' => $idPb];
        $data = [
            'nobayar' => null,
            'tglbayar' => null,
            'ket' => 'Belum Lunas'
        ];

        $this->Transaksi_m->update_where('pembayaran', $data, $where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert"><i class="fas fa-info-circle"></i> Iuran atas nama kepala keluarga <strong>' . $nama_kk . '</strong> Berhasil Dibatalkan.</div>');
        redirect('superAdmin/transaksi/cariTransaksi?nomor_id=' . $nomor_id);
    }

    public function cetak($nomor_id, $idPb)
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
        $data['title'] = 'Laporan ' . $data['kk']['nama_kk'];
        $where = ['id_pb' => $idPb];
        $data['bayar'] = $this->Transaksi_m->get_join_where('pembayaran', $where)->result_array();
        $this->load->view('templates_super_admin/header', $data);
        $this->load->view('superAdmin/laporan/laporan_pembayaran_cetak', $data);
        $this->load->view('templates_super_admin/footer');
    }
}