<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kk_m');
        $this->load->library('Zend');
        // cekSession();
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
            $data['title'] = 'Data Kepala Keluarga';
            $data['kk'] = $this->Kk_m->get('kk')->result_array();
            $this->form_validation->set_rules('nik', 'Nama Kepala Keluarga', 'required|trim', ['required' => 'NIK Kepala Keluarga Wajib diisi!.']);
            $this->form_validation->set_rules('nama_kk', 'Nama Kepala Keluarga', 'required|trim', ['required' => 'Nama Wajib diisi!.']);
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat wajib di isi!.']);
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => 'Tanggal Lahir wajib di isi!.']);
            $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim', ['required' => 'Telepon wajib di isi!.']);
            $this->form_validation->set_rules('biaya', 'Biaya', 'required|trim', ['required' => 'Biaya wajib di isi!.']);
            $this->form_validation->set_rules('nomor_id', 'nomor_id', 'required|trim', ['required' => 'Nomor ID wajib di isi!.']);
            $this->form_validation->set_rules('nomor_kk', 'nomor_kk', 'required|trim', ['required' => 'Nomor Kartu Keluarga wajib di isi!.']);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates_super_admin/header', $data);
                $this->load->view('templates_super_admin/sidebar', $data);
                $this->load->view('superAdmin/kk/index', $data);
                $this->load->view('templates_super_admin/footer');
                // $this->session->set_flashdata('danger', '<div class="alert alert-danger" role="alert"><i class="fas fa-info-circle"></i> Data yang diisi belum lengkap</div>');
            } else {
                $tgl_input = date('Y-m');
                $biaya = html_escape($this->input->post('biaya', true));
                $data = [
                    'nik' => html_escape($this->input->post('nik', true)),
                    'nama_kk' => html_escape($this->input->post('nama_kk', true)),
                    'alamat' => html_escape($this->input->post('alamat', true)),
                    'tgl_lahir' => html_escape($this->input->post('tgl_lahir', true)),
                    'telepon' => html_escape($this->input->post('telepon', true)),
                    'nomor_kk' => html_escape($this->input->post('nomor_kk', true)),
                    'nomor_id' => html_escape($this->input->post('nomor_id', true)),
                    'tgl_input' => $tgl_input,
                    'biaya' => $biaya
                ];

                $AwalJatuhTempo = $this->input->post('jatuh_tempo', true);

                // Tampil bulan berdasarkan bhs indonesia
                $bulanIndo = [
                    '01' => 'Januari',
                    '02' => 'Februari',
                    '03' => 'Maret',
                    '04' => 'April',
                    '05' => 'Mei',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'Agustus',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'Desember'
                ];

                // tambah data kk
                $tbKk = $this->db->insert('kk', $data);


                // Ambil data DB kk berdasarkan id_keluarga
                $this->db->limit(1);
                $this->db->order_by('id_keluarga', 'desc');
                $kk = $this->db->get('kk')->row_array();
                $idKk = $kk['id_keluarga'];

                // for ($i = 0; $i < 180; $i++) {
                //     // membuat tgl jatuh tempo nya setiap tanggal 10
                //     $jatuhTempo = date('Y-m-d', strtotime("+$i month", strtotime($AwalJatuhTempo)));
                //     $bulan = $bulanIndo[date('m', strtotime($jatuhTempo))] . " " . date('Y', strtotime($jatuhTempo));

                //     $data = [
                //         'id_keluarga' => $idKk,
                //         'jatuh_tempo' => $jatuhTempo,
                //         'bulan' => $bulan,
                //         'jumlah' => $biaya
                //         // 'id_user' => $this->session->userdata('id_user')
                //     ];
                //     $this->Kk_m->insert('pembayaran', $data);
                // }

                for ($i = 0; $i < 360; $i++) {
                    // membuat tgl jatuh tempo nya setiap tanggal 10
                    // $jatuhTempo = date('d-m-Y', strtotime("+$i month"));
                    $jatuhTempo = date('d-m-Y');
                    $date = new DateTime($jatuhTempo);
                    $date->modify("+$i month");
                    $dateMon = $date->format('F Y');
                    // $bulan = $bulanIndo[date('m', strtotime($dateMon))] . " " . date('Y', strtotime($dateMon));
        
                    $data = [
                        'id_keluarga' => $idKk,
                        'jatuh_tempo' => $jatuhTempo,
                        'bulan' => $dateMon,
                        'jumlah' => $biaya
                    ];
                    $this->Kk_m->insert('pembayaran', $data);
                }

                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Kepala Keluarga Berhasil Ditambahkan.</div>');
                redirect('superAdmin/kk');
            }
        } else {
            redirect('home/keluar/');
        }
    }

    public function ubahKk($id)
    {
        $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
        $data = array(
            'id_super_admin' => $data->id_super_admin,
            'nama_super_admin' => $data->nama_super_admin,
            'username' => $data->username,
            'password' => $data->password
        );
        $where = ['id_keluarga' => $id];
        $data['kk'] = $this->Kk_m->get_where('kk', $where)->row_array();
        $data['pembayaran'] = $this->Transaksi_m->get_where('pembayaran', $where)->row_array();
        $data['title'] = 'Ubah Data Kepala Keluarga ';

        // Rules Form
        $this->form_validation->set_rules('nik', 'Nama Kepala Keluarga', 'required|trim', ['required' => 'NIK Kepala Keluarga Wajib diisi!.']);
        $this->form_validation->set_rules('nama_kk', 'Nama Kepala Keluarga', 'required|trim', ['required' => 'Nama Wajib diisi!.']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat wajib di isi!.']);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => 'Tanggal Lahir wajib di isi!.']);
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim', ['required' => 'Telepon wajib di isi!.']);
        $this->form_validation->set_rules('nomor_id', 'nomor_id', 'required|trim', ['required' => 'Nomor ID wajib di isi!.']);
        $this->form_validation->set_rules('nomor_kk', 'nomor_kk', 'required|trim', ['required' => 'Nomor Kartu Keluarga wajib di isi!.']);
        $this->form_validation->set_rules('biaya', 'Biaya', 'required|trim', ['required' => 'Biaya wajib di isi!.']);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates_super_admin/header', $data);
            $this->load->view('templates_super_admin/sidebar', $data);
            $this->load->view('superAdmin/kk/ubah', $data);
            $this->load->view('templates_super_admin/footer');
        } else {
            $this->db->delete('pembayaran', ['id_keluarga' => $id]);
            $this->ubahDataKk($id);
        }
    }

    public function ubahDataKk($id)
    {
        $idKk = $this->input->post('id_keluarga');
        $biaya = html_escape($this->input->post('biaya', true));
        // $tgl_meninggal = date('Y-m-d');
        $data = [
            'nik' => html_escape($this->input->post('nik', true)),
            'nama_kk' => html_escape($this->input->post('nama_kk', true)),
            'alamat' => html_escape($this->input->post('alamat', true)),
            'tgl_lahir' => html_escape($this->input->post('tgl_lahir', true)),
            'telepon' => html_escape($this->input->post('telepon', true)),
            'nomor_kk' => html_escape($this->input->post('nomor_kk', true)),
            'nomor_id' => html_escape($this->input->post('nomor_id', true)),
            'biaya' => $biaya,
            'tgl_meninggal' => html_escape($this->input->post('tgl_meninggal', true)),
        ];
        
        $AwalJatuhTempo = $this->input->post('jatuh_tempo', true);

        // Tampil bulan berdasarkan bhs indonesia
        $bulanIndo = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
        // update data
        $this->db->where('id_keluarga', $idKk);
        $this->Kk_m->update('kk', $data);

        // Ambil data DB kk berdasarkan id_keluarga
        $this->db->limit(1);
        $this->db->order_by('id_keluarga', 'desc');
        $kk = $this->db->get('kk')->row_array();
        $id_Kk = $kk['id_keluarga'];

        for ($i = 0; $i < 360; $i++) {
            // membuat tgl jatuh tempo nya setiap tanggal 10
            // $jatuhTempo = date('d-m-Y', strtotime("+$i month"));
            $jatuhTempo = date('d-m-Y', strtotime("1 January 2024"));
            $date = new DateTime($jatuhTempo);
            $date->modify("+$i month");
            $dateMon = $date->format('F Y');
            // $bulan = $bulanIndo[date('m', strtotime($dateMon))] . " " . date('Y', strtotime($dateMon));

            $data = [
                'id_keluarga' => $id,
                'jatuh_tempo' => $jatuhTempo,
                'bulan' => $dateMon,
                'jumlah' => $biaya
            ];
            $this->Kk_m->insert('pembayaran', $data);
            $this->db->where('id_keluarga', $id_Kk);
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Kepala Keluarga Berhasil Diubah.</div>');
        redirect('superAdmin/kk');
    }

    public function hapus($id)
    {
        $this->db->delete('kk', ['id_keluarga' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-trash"></i> Data Kepala Keluarga Berhasil Dihapus.</div>');
        redirect('superAdmin/kk');
    }
}
