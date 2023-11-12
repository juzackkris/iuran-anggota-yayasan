<?php

class SuperAdmin_m extends CI_Model
{
    public function ambil_data($id)
    {
        $this->db->where('id_super_admin', $id);
        return $this->db->get('super_admin')->row();
    }

    public function get_where($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function get($table)
    {
        return $this->db->get($table);
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function update($table, $data)
    {
        $this->db->update($table, $data);
    }
}


