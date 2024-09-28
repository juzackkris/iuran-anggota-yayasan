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
            $data = $this->SuperAdmin_m->ambil_data($this->session->userdata('id_super_admin'));
            $data = array(
                'id_super_admin' => $data->id_super_admin,
                'nama_super_admin' => $data->nama_super_admin,
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
            $data['super_admin'] = $this->db->get('super_admin')->row();
            $data['title'] = "Dashboard";
            $this->load->view('templates_super_admin/header', $data);
            $this->load->view('templates_super_admin/sidebar');
            $this->load->view('superAdmin/dashboard', $data);
            $this->load->view('templates_super_admin/footer');
        } else {
            session_destroy();
            redirect('home');
        }
    }
}
