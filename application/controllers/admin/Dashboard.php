<?php
class Dashboard extends CI_Controller
{
    public function __construct()
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
            $kk = $this->db->query("SELECT * FROM kk");
            $anggota = $this->db->query("SELECT * FROM anggota");
            $jumlah = $this->db->query("SELECT SUM(jumlah) AS jumlah FROM pembayaran WHERE ket = 'LUNAS'");
            foreach ($jumlah->result_array() as $row){
                $row['jumlah'];
            }
            $data['kk'] = $kk->num_rows();
            $data['anggota'] = $anggota->num_rows();
            $data['uang'] = 'Rp ' . $row['jumlah'];
            $data['keseluruhan'] = $data['kk'] + $data['anggota'];
            $data['admin'] = $this->db->get('admin')->row();
            $data['title'] = "Dashboard";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('admin/dashboard', $data);
            $this->load->view('templates/footer');
        } else {
            session_destroy();
            redirect('home');
        }
    }
}
