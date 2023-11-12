<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barcode extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kk_m');
        $this->load->library('Zend');
        $this->load->helper('download'); 
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
            $data['title'] = 'Generate Barcode';
            $data['kk'] = $this->Kk_m->get('kk')->result_array();
            $this->load->view('templates_super_admin/header', $data);
            $this->load->view('templates_super_admin/sidebar', $data);
            $this->load->view('superAdmin/barcode/index', $data);
            $this->load->view('templates_super_admin/footer');
        }
    }

    public function download($code)
	{
		$this->zend->load('Zend/Barcode');
        $file = Zend_Barcode::render('code128', 'image', array('text' => $code, 'drawText' => false, 'transparentBackground' => true));  
        $store_image = imagepng($file,"/assets/{$code}.png");
        $data['barcode'] = $code.'.png';

        force_download($store_image);
	}

    public function set_barcode($code){

        $this->zend->load('Zend/Barcode');
        $file = Zend_Barcode::render('code128', 'image', array('text' => $code, 'drawText' => false, 'transparentBackground' => true)); 
        imagepng($file,"barcode/{$code}.png");

        $kk = $this->db->get('kk')->row_array();
        $nomor_id = $kk['nomor_id'];
        $data['barcode'] = $code.'.png';
        $this->db->update('kk', $data);
    }
}
