<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Bidang_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function main_query($tahun = 0, $bulan = 0) {
        if ($tahun == 0)
            $query = $this->db->query('SELECT * FROM bulanan WHERE tahun = (SELECT MAX(tahun) FROM bulanan) AND bulan = (SELECT MAX(bulan) FROM bulanan WHERE tahun = (SELECT MAX(tahun))) ORDER BY bulan');
        else
            $query = $this->db->query('SELECT * FROM bulanan WHERE tahun = "' . $tahun . '" AND bulan = "' . $bulan . '" ORDER BY bulan');
        return $query;
    }

    function get_kategori() {
        $query = $this->db->query('SELECT * FROM t_bidang AS b JOIN t_kategori AS k WHERE b.id_bidang = k. id_bidang');
        return $query->result();
    }
    
    function get_bidang() {
        $query = $this->db->query('SELECT * FROM t_bidang');
        return $query->result();
    }
    
    function get_sub_bidang($id) {
        $query = $this->db->query('SELECT * FROM t_sub_bidang WHERE id_kategori = "'.$id.'"');
        return $query->result();
    }
    
    function get_kategori_bidang($id) {
        $query = $this->db->query('SELECT * FROM t_kategori WHERE id_bidang = "'.$id.'"');
        return $query->result();
    }

    function insert_entry_kategory() {
        $this->id_kategori = '';
        $this->id_bidang = $_POST['bidang'];
        $this->nama_kategori = $_POST['kategori'];    

        $this->db->insert('t_kategori', $this);
    }
    
    function insert_entry_sub_bidang() {
        $this->id_sub = '';
        $this->id_bidang = $_POST['bidang'];
        $this->id_kategori = $_POST['kategori'];
        $this->nama_sub = $_POST['sub_bidang'];    

        $this->db->insert('t_sub_bidang', $this);
    }

    function update_entry() {
        $rek = array('080.01', '080.02', '080.03', '080.04', '080.08', '080.13');
        for ($i = 0; $i < 6; $i++) {
            
            $temp = $_POST['rkap'];
            $this->rkap = $temp[$i];           
            $temp2 = $_POST['rko'];
            $this->rko = $temp2[$i];
            $temp3 = $_POST['id'];
            $this->id = $temp3[$i];
            
            $this->db->update('bulanan', $this, array('id' => $temp3[$i]));
        }
    }

    function delete_entry($tahun, $bulan) {
        $this->db->query('DELETE FROM bulanan WHERE tahun = "' . $tahun . '" AND bulan = "' . $bulan . '"');
    }
}

?>