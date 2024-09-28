<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_barcode extends CI_Model {
 
    public function __construct(){
        parent::__construct();
   
    } 
 
function getId() {
    $this->db->order_by('id','ASC');
    $query = $this->db->get('barcode');  
    return $query->result();     
}

function insert_barcode($data){
    $this->db->insert('barcode', $data);  
    }
} 
?>
