<?php

use PhpParser\Node\Expr\FuncCall;

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_m extends CI_Model
{
    public function get_where($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function cariIdKk($id_kk)
    {
        $this->db->where("id_keluarga", $id_kk);
        return $this->db->get("pembayaran");
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

    public function update_where($table, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function getAnggotaId($idAnggota)
    {
        return $this->db->get_where('anggota', $idAnggota)->row_array();
    }

    public function updateBanyak($nobayar, $tglbayar, $nomor_id, $id_pb){
        $query = "UPDATE pembayaran INNER JOIN kk ON kk.id_keluarga = pembayaran.id_keluarga 
                  SET pembayaran.nobayar = '$nobayar', pembayaran.tglbayar = '$tglbayar', pembayaran.ket = 'Lunas' WHERE kk.nomor_id = '$nomor_id'
                  AND pembayaran.id_pb IN ('$id_pb')";
        return $this->db->query($query);
    }

    public function get_join($mulaiTgl, $sampaiTgl)
    {
        $query = "SELECT pembayaran.*, kk.nomor_id, kk.nama_kk, kk.alamat FROM pembayaran INNER JOIN kk ON kk.id_keluarga = pembayaran.id_keluarga WHERE tglbayar BETWEEN date_format('$mulaiTgl', '%d-%m-%Y') AND date_format('$sampaiTgl', '%d-%m-%Y') ORDER BY tglbayar ASC";
        return $this->db->query($query);
    }

    public function get_pendaftaran_bulanan($tgl_input){
        $query = "SELECT nomor_id, nama_kk, alamat FROM kk WHERE tgl_input = '$tgl_input' UNION SELECT status, nama, alamat FROM anggota WHERE tgl_input = '$tgl_input'";
        return $this->db->query($query);
    }

    public function get_kematian_anggota($mulaiTgl, $sampaiTgl){
        $query = "SELECT nomor_id, nama_kk, alamat FROM kk WHERE tgl_meninggal BETWEEN '$mulaiTgl' AND '$sampaiTgl' UNION SELECT status, nama, alamat FROM anggota WHERE tgl_meninggal BETWEEN '$mulaiTgl' AND '$sampaiTgl';";
        return $this->db->query($query);
    }

    public function get_struk_periode($tanggal, $nomor_id)
    {
        $query = "SELECT pembayaran.*, kk.nomor_id, kk.nama_kk, kk.alamat FROM pembayaran INNER JOIN kk ON kk.id_keluarga = pembayaran.id_keluarga WHERE tglbayar = date_format('$tanggal', '%d-%m-%Y') AND kk.nomor_id = '$nomor_id' ORDER BY id_pb DESC";
        return $this->db->query($query);
    }

    public function get_bulanBayar_periode($tanggal, $nomor_id){
        $query = "SELECT pembayaran.*, kk.nomor_id, kk.nama_kk, kk.alamat FROM pembayaran INNER JOIN kk ON kk.id_keluarga = pembayaran.id_keluarga WHERE tglbayar = date_format('$tanggal', '%d-%m-%Y') AND kk.nomor_id = '$nomor_id'";
        return $this->db->query($query);
    }

    public function get_struk($nomor_id)
    {
        $query = "SELECT pembayaran.*, kk.nomor_id, kk.nama_kk, kk.alamat FROM pembayaran INNER JOIN kk ON kk.id_keluarga = pembayaran.id_keluarga WHERE tglbayar = date_format(curdate(), '%d-%m-%Y') AND kk.nomor_id = '$nomor_id' ORDER BY id_pb DESC";
        return $this->db->query($query);

        // $this->db->join('kk', 'kk.id_keluarga = pembayaran.id_keluarga');
        // $this->db->where('tglbayar', 'CURDATE()');s
        // $this->db->order_by('tglbayar', 'ASC');
        // return $this->db->get_where($table, $where);
    }

    public function get_bulanBayar($nomor_id){
        $query = "SELECT bulan FROM pembayaran INNER JOIN kk ON kk.id_keluarga = pembayaran.id_keluarga WHERE tglbayar = date_format(curdate(), '%d-%m-%Y') AND kk.nomor_id = '$nomor_id'";
        return $this->db->query($query);
    }

    public function get_join_where($table, $where)
    {
        $this->db->join('kk', 'kk.id_keluarga = pembayaran.id_keluarga');
        return $this->db->get_where($table, $where);
    }
}