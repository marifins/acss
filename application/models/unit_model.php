<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Unit_model extends CI_Model {

    /*var $no_reg = '';
    var $nama = '';
    var $jabatan = '';
    var $gol = '';
    var $bagian = '';
    var $kebun_unit = '';*/

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getAll($tahun, $bulan, $pks) {
        if($tahun == "0") $tahun = date("Y");
        if($bulan == "0") $bulan = date("m");
        $str = $tahun ."-" .$bulan;

        $this->db->select('*');
        $this->db->from('produksi');
        $this->db->where('SUBSTRING(tanggal,1,7)', $str);
        $this->db->where('pks', $pks);
        $this->db->order_by('tanggal', 'ASC');
        $this->db->group_by('tanggal');
        $query = $this->db->get();
        return $query->result();
    }

    function getRowsAll($tahun, $bulan, $pks) {
        if($tahun == "0") $tahun = date("Y");
        if($bulan == "0") $bulan = date("m");
        $str = $tahun ."-" .$bulan;

        $this->db->select('*');
        $this->db->from('produksi');
        $this->db->where('SUBSTRING(tanggal,1,7)', $str);
        $this->db->where('pks', $pks);
        $this->db->order_by('tanggal', 'ASC');
        $this->db->group_by('tanggal');
        $query = $this->db->get();
        return $query->num_rows();
    }

    
    function get_tahun_produksi() {
        $query = $this->db->query('SELECT DISTINCT SUBSTRING(tanggal,1,4) AS tahun FROM produksi');
        return $query->result();
    }    
          
    function get_data_from_date($tgl, $pks){
        $query = $this->db->query('SELECT SUM(sisa) sisa, SUM(diterima) diterima, SUM(diolah) diolah, SUM(ms_in) ms_in, SUM(is_in) is_in FROM produksi WHERE tanggal = "' . $tgl . '" AND pks = "' . $pks . '"');
        return $query->row();
    }
    
    function get_sisa_kemarin_from_date($tgl, $pks){
        $query = $this->db->query('SELECT SUM(sisa) sisa FROM produksi WHERE tanggal = "' . $tgl . '" - INTERVAL 1 DAY  AND pks = "' . $pks . '"');
        return $query->row();
    }

    function get_data_kebun_sendiri($tgl, $pks){
        $pembelian = "080.99"; $tolah = "080.98";
        $query = $this->db->query('SELECT SUM(sisa) sisa, SUM(diterima) diterima, SUM(diolah) diolah, SUM(ms_in) ms_in, SUM(is_in) is_in FROM produksi WHERE tanggal = "' . $tgl . '" AND kebun != "' . $pembelian . '" AND kebun != "' . $tolah . '" AND pks = "' . $pks . '"');
        return $query->row();
    }
    
    function get_data_pembelian($tgl, $pks){
        $pembelian = "080.99";
        $query = $this->db->query('SELECT SUM(sisa) sisa, SUM(diterima) diterima, SUM(diolah) diolah, SUM(ms_in) ms_in, SUM(is_in) is_in FROM produksi WHERE tanggal = "' . $tgl . '" AND kebun = "' . $pembelian . '" AND pks = "' . $pks . '"');
        return $query->row();
    }
    
    function get_data_tolah($tgl, $pks){
        $tolah = "080.98";
        $query = $this->db->query('SELECT SUM(sisa) sisa, SUM(diterima) diterima, SUM(diolah) diolah, SUM(ms_in) ms_in, SUM(is_in) is_in FROM produksi WHERE tanggal = "' . $tgl . '" AND kebun = "' . $tolah . '" AND pks = "' . $pks . '"');
        return $query->row();
    }
    
    function get_unit_name($id){
        $this->db->select('nama_unit');
        $this->db->from('unit');
        $this->db->where('no_rek', $id);
        $query = $this->db->get();
        return $query->row();
    }

  
}
?>
