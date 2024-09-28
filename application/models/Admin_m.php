<?php

class Admin_m extends CI_Model
{
    public function ambil_data($id)
    {
        $this->db->where('id_admin', $id);
        return $this->db->get('admin')->row();
    }
}
