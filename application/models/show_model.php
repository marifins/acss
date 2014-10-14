<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Show_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function main_query($tanggal = 0) {
        $yesterday = date("Y-m-d", time() - 86400);
        if ($tanggal == 0)
            $query = $this->db->query('SELECT * FROM tbs WHERE tanggal = "' . $yesterday . '" ORDER BY kebun DESC');
        else
            $query = $this->db->query('SELECT * FROM tbs WHERE tanggal = "' . $tanggal . '" ORDER BY kebun DESC');
        return $query;
    }

    function get_all($tanggal = 0) {
        $query = $this->main_query($tanggal);
        return $query->result();
    }

    function get_rows($tanggal = 0) {
        $query = $this->main_query($tanggal);
        return $query->num_rows();
    }

    function get_real_daily($kebun = 0) {
        $yesterday = date("Y-m-d", time() - 86400);
        $query = $this->db->query('SELECT * FROM tbs WHERE tanggal = "' . $yesterday . '" AND kebun = "' . $kebun . '" ORDER BY kebun DESC');
        return $query->row();
    }

    function get_real_monthly($kebun = 0) {
        $yesterday = date("Y-m-d", time() - 86400);
        $str = substr($yesterday, 0, 7);
        $query = $this->db->query('SELECT SUM(realisasi) AS realisasi FROM tbs WHERE SUBSTRING(tanggal,1,7) = "' . $str . '" AND kebun = "' . $kebun . '" ORDER BY kebun DESC');
        return $query->row();
    }

    function get_real_yearly($kebun = 0) {
        $yesterday = date("Y-m-d", time() - 86400);
        $str = substr($yesterday, 0, 4);
        $query = $this->db->query('SELECT SUM(realisasi) AS realisasi FROM tbs WHERE SUBSTRING(tanggal,1,4) = "' . $str . '" AND kebun = "' . $kebun . '" ORDER BY kebun DESC');
        return $query->row();
    }

    function get_rkap($kebun = 0) {
        $yesterday = date("Y-m-d", time() - 86400);
        $bulan = substr($yesterday, 5, 2);
        $tahun = substr($yesterday, 0, 4);
        $query = $this->db->query('SELECT * FROM bulanan WHERE tahun = "' . $tahun . '" AND bulan = "' . $bulan . '" AND kebun = "' . $kebun . '" ORDER BY kebun DESC');
        return $query->row();
    }

    function get_rkap_yearly($kebun = 0) {
        $yesterday = date("Y-m-d", time() - 86400);
        $bulan = substr($yesterday, 5, 2);
        $tahun = substr($yesterday, 0, 4);
        $query = $this->db->query('SELECT SUM(rkap) AS rkap, SUM(rko) AS rko FROM bulanan WHERE tahun = "' . $tahun . '" AND bulan <= "' . $bulan . '" AND kebun = "' . $kebun . '" ORDER BY kebun DESC');
        return $query->row();
    }

    function get_hk($kebun = 0) {
        $yesterday = date("Y-m-d", time() - 86400);
        $bulan = substr($yesterday, 5, 2);
        $tahun = substr($yesterday, 0, 4);
        if ($kebun == 0)
            $query = $this->db->query('SELECT jlh_hari FROM hk WHERE tahun = (SELECT MAX(tahun) FROM hk) AND  bulan = (SELECT MAX(bulan) FROM hk WHERE tahun = (SELECT MAX(tahun) FROM hk))');
        else
            $query = $this->db->query('SELECT jlh_hari FROM hk WHERE tahun = "' . $tahun . '" AND  bulan = "' . $bulan . '"');
        return $query->row();
    }

    function save() {
        $rek = array("080.01", "080.02", "080.03", "080.04", "080.08", "080.13");
        for ($i = 0; $i < 6; $i++) {
            $data = array(
                'kebun' => $rek[$i],
                'tanggal' => $this->input->post('tgl'),
                'rkap' => $this->input->post('rkap' . $i),
                'rko' => $this->input->post('rko' . $i),
                'realisasi' => $this->input->post('real' . $i)
            );
            $this->db->insert('tbs', $data);
        }
    }

    function get_data($kebun, $tanggal) {
        if ($kebun == 0)
            $kebun = '080.03';
        if ($tanggal == 0)
            $tanggal = date('Y-m-d');
        $query = $this->db->query('SELECT * FROM produksi WHERE kebun = "' . $kebun . '" AND tanggal = "' . $tanggal . '" ORDER BY afdeling');
        return $query->result();
    }

    function get_info() {
        $today = date('Y-m-d');
        $yesterday = date("Y-m-d", time() - 86400);
        $query = $this->db->query('SELECT text, tanggal, no_ponsel FROM info WHERE SUBSTRING(tanggal, 1, 10) = "' . $today . '" OR SUBSTRING(tanggal, 1, 10) = "' . $yesterday . '" ORDER BY id DESC');
        return $query->result();
    }

    function count() {
        $query = $this->db->query('SELECT * FROM produksi');
        return $query->num_rows();
    }

    function get_details($id) {
        $query = $this->db->query('SELECT * FROM produksi AS p JOIN kebun AS k WHERE p.kebun = k.no_rek AND id = ' . $id . '');
        return $query->row();
    }

    function get_kebun_all() {
        $this->db->select('no_rek, nama_kebun');
        $this->db->from('kebun');
        $query = $this->db->get();
        return $query->result();
    }

    function get_kebun_name($rek) {
        $this->db->select('nama_kebun');
        $this->db->from('kebun');
        $this->db->where('no_rek', $rek);
        $query = $this->db->get();
        return $query->row();
    }

    function real_kebun($id) {
        $query = $this->db->query('SELECT SUM(realisasi) as r, SUM(telling) as t, SUM(sisa) as s FROM produksi WHERE kebun = "' . $id . '" AND tanggal = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
        return $query->row();
    }

    function real_kebun_sd($id) {
        $tanggal = date('Y-m-d');
        $str = substr($tanggal, 0, 7);
        $query = $this->db->query('SELECT SUM(realisasi) as r, SUM(telling) as t FROM produksi WHERE kebun = "' . $id . '" AND SUBSTRING(tanggal, 1, 7) = "' . $str . '"');
        return $query->row();
    }

    function real_kebun_jan_sd($id) {
        $tanggal = date('Y-m-d');
        $str = substr($tanggal, 0, 4);
        $query = $this->db->query('SELECT SUM(realisasi) as r, SUM(telling) as t FROM produksi WHERE kebun = "' . $id . '" AND SUBSTRING(tanggal, 1, 4) = "' . $str . '"');
        return $query->row();
    }

    function get_notice() {
        $query = $this->db->query('SELECT * FROM notice LIMIT 1');
        return $query->row();
    }

    function update_notice() {
        $this->judul = $_POST['judul'];
        $this->isi = $_POST['isi'];
        $this->tanggal = $_POST['tanggal'];
        $this->pejabat = $_POST['pejabat'];
        $this->jabatan = $_POST['jabatan'];

        $this->db->update('notice', $this, array('id' => $_POST['id']));
    }

    function get_gallery() {
        $query = $this->db->query('SELECT * FROM gallery');
        return $query->result();
    }

    function get_gallery_details($id) {
        $query = $this->db->query('SELECT * FROM gallery WHERE id = "' . $id . '"');
        return $query->row();
    }

    function update_gallery() {
        $this->id = $_POST['id'];
        $this->desc = $_POST['desc'];

        $this->db->update('gallery', $this, array('id' => $_POST['id']));
    }

}

?>