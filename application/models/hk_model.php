<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Hk_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function main_query($tahun = 0) {
        if ($tahun == 0)
            $query = $this->db->query('SELECT * FROM hk WHERE tahun = (SELECT MAX(tahun) FROM hk) ORDER BY bulan');
        else
            $query = $this->db->query('SELECT * FROM hk WHERE tahun = "' . $tahun . '" ORDER BY bulan');
        return $query;
    }

    function get_tahun_all() {
        $query = $this->db->query('SELECT tahun FROM hk');
        return $query->result();
    }

    function get_all($tanggal = 0) {
        $query = $this->main_query($tanggal);
        return $query->result();
    }

    function get_rows($tahun = 0) {
        $query = $this->main_query($tahun);
        return $query->num_rows();
    }

    function get_kebun_name($id) {
        $query = $this->db->query('SELECT nama_kebun FROM kebun WHERE no_rek = "' . $id . '"');
        return $query->row();
    }

    function insert_entry() {
        $this->id = '';
        $this->tahun = $_POST['tahun'];
        $this->bulan = $_POST['bulan'];
        $this->jlh_hari = $_POST['jlh_hari'];

        $this->db->insert('hk', $this);
    }

    function delete_entry($id) {
        $this->db->query('DELETE FROM hk WHERE id = "' . $id . '"');
    }

    function get_kebun_all() {
        $this->db->select('no_rek, nama_kebun');
        $this->db->from('kebun');
        $this->db->where('status', '1');
        $query = $this->db->get();
        return $query->result();
    }

    function cek_data($tahun, $bulan) {
        $this->db->select('id');
        $this->db->from('hk');
        $this->db->where('tahun', $tahun);
        $this->db->where('bulan', $bulan);
        $query = $this->db->get();
        return $query->num_rows();
    }

}

?>