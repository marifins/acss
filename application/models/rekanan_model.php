<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Rekanan_model extends CI_Model {
    /* var $no_reg = '';
      var $nama = '';
      var $jabatan = '';
      var $gol = '';
      var $bagian = '';
      var $kebun_unit = ''; */

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_all($pks = 0, $tanggal = 0) {
        $session = from_session('unit');
        if ($session == "")
            $session = '080.15';
        if (($tanggal == 0 || $pks == 0) && ($session != ""))
            $query = $this->db->query('SELECT * FROM produksi WHERE tanggal = (SELECT MAX(tanggal) FROM produksi) AND pks = "' . $session . '"');
        else
            $query = $this->db->query('SELECT * FROM produksi WHERE tanggal = "' . $tanggal . '" AND pks = "' . $pks . '"');
        return $query->result();
    }

    function getby_date($tanggal = 0) {
        if ($tanggal == 0)
            $query = $this->db->query('SELECT * FROM tbs WHERE tanggal = (SELECT MAX(tanggal) FROM tbs) ORDER BY kebun');
        else
            $query = $this->db->query('SELECT * FROM tbs WHERE tanggal = "' . $tanggal . '" ORDER BY kebun');
        return $query->result();
    }

    function get_rows($tanggal = 0) {
        if ($tanggal == 0)
            $query = $this->db->query('SELECT * FROM tbs WHERE tanggal = (SELECT MAX(tanggal) FROM tbs) ORDER BY kebun');
        else
            $query = $this->db->query('SELECT * FROM tbs WHERE tanggal = "' . $tanggal . '" ORDER BY kebun');
        return $query->num_rows();
    }

    function get_date($tanggal = 0) {
        if ($tanggal == 0)
            $query = $this->db->query('SELECT DISTINCT tanggal FROM tbs WHERE tanggal = (SELECT MAX(tanggal) FROM tbs) ORDER BY kebun');
        else
            $query = $this->db->query('SELECT DISTINCT tanggal FROM tbs WHERE tanggal = "' . $tanggal . '" ORDER BY kebun');
        return $query->row();
    }
    
    function get_hk($tanggal = 0) {
        $bulan = substr($tanggal, 5, 2);
        $tahun = substr($tanggal, 0, 4);
        
        if ($tanggal == 0)
            $query = $this->db->query('SELECT jlh_hari FROM hk WHERE tahun = (SELECT MAX(tahun) FROM hk) AND  bulan = (SELECT MAX(bulan) FROM hk WHERE tahun = (SELECT MAX(tahun) FROM hk))');
        else
            $query = $this->db->query('SELECT jlh_hari FROM hk WHERE tahun = "' . $tahun . '" AND  bulan = "' . $bulan . '"');
        return $query->num_rows();
    }
    
    function max_id_rekanan(){
        $query = $this->db->query('SELECT MAX(id_rekanan) id FROM t_rekanan');
        return $query->row();
    }
    
    function get_nama_rekanan($id){
        $query = $this->db->query('SELECT nama_rekanan id FROM t_rekanan WHERE id_rekanan = "'.$id.'"');
        return $query->row();
    }
    
    function insert_rekanan(){
        $rekanan = array(
            'id_rekanan' => '',
            'nama_rekanan' => $_POST['nama_perusahaan'],
            'alamat_rekanan' => $_POST['alamat_perusahaan'],
            'no_telp' => $_POST['no_telp'],
            'nama_pimpinan' => $_POST['nama_pimpinan'],
            'jabatan_pimpinan' => $_POST['jabatan'],
            'golongan' => $_POST['golongan']
        );
        $this->db->insert('t_rekanan', $rekanan);
    }
    
    function insert_dokumen(){
        $data = $this->max_id_rekanan();
        $id_rekanan = $data->id;
        $iujk = "";
        if(isset($_POST['iujk'])) $iujk = $_POST['iujk'];
        
        $dokumen = array(
            'id_dokumen' => '',
            'id_rekanan' => $id_rekanan,
            'srp_sbu' => $this->fungsi->set_back($_POST['srp']),
            'n_akta_notaris' => $this->fungsi->set_back($_POST['n_akta_notaris']),
            'tdp' => $this->fungsi->set_back($_POST['tdp']),
            'skitu' => $this->fungsi->set_back($_POST['skitu']),
            'siup' => $this->fungsi->set_back($_POST['siup']),
            'iujk' => $this->fungsi->set_back($iujk),
            'n_npwp' => $_POST['n_npwp'],
            'kta_asosiasi' => $this->fungsi->set_back($_POST['kta_asosiasi']),
            'struktur_org' => $_POST['struktur']
        );
        $this->db->insert('t_dokumen', $dokumen);
    }
    
    function insert_sub_bidang(){
        $data = $this->max_id_rekanan();
        $id_rekanan = $data->id;
        
        foreach($_POST['sub'] as $value){
            $sub_bidang = array(
                'id' => '',
                'id_sub_bidang' => $value,
                'id_rekanan' => $id_rekanan
            );       
            $this->db->insert('t_sub', $sub_bidang);
        }
    }

    function insert_entry() {
        $this->insert_rekanan();
        $this->insert_dokumen();
        $this->insert_sub_bidang();   
    }
    
    function update_rekanan(){
        $rekanan = array(
            'nama_rekanan' => $_POST['enama_perusahaan'],
            'alamat_rekanan' => $_POST['ealamat_perusahaan'],
            'no_telp' => $_POST['eno_telp'],
            'nama_pimpinan' => $_POST['enama_pimpinan'],
            'jabatan_pimpinan' => $_POST['ejabatan'],
            'golongan' => $_POST['egolongan']
        );
        $this->db->where('id_rekanan',$_POST['id_perusahaan']);
        $this->db->update('t_rekanan',$rekanan);
    }
    
    function update_dokumen(){
        $iujk = "";
        if(isset($_POST['iujk'])) $iujk = $_POST['iujk'];
        
        $dokumen = array(
            'srp_sbu' => $this->fungsi->set_back($_POST['esrp']),
            'n_akta_notaris' => $this->fungsi->set_back($_POST['en_akta_notaris']),
            'tdp' => $this->fungsi->set_back($_POST['etdp']),
            'skitu' => $this->fungsi->set_back($_POST['eskitu']),
            'siup' => $this->fungsi->set_back($_POST['esiup']),
            'iujk' => $this->fungsi->set_back($iujk),
            'n_npwp' => $_POST['en_npwp'],
            'kta_asosiasi' => $this->fungsi->set_back($_POST['ekta_asosiasi']),
            'struktur_org' => $_POST['estruktur']
        );
        $this->db->where('id_rekanan',$_POST['id_perusahaan']);
        $this->db->update('t_dokumen',$dokumen);
    }
    
    function update_sub_bidang(){
        $id_rekanan = $_POST['id_perusahaan'];
        
        foreach($_POST['esub'] as $value){
            $sub_bidang = array(
                'id' => '',
                'id_sub_bidang' => $value,
                'id_rekanan' => $id_rekanan
            );       
            $this->db->insert('t_sub', $sub_bidang);
        }
    }

    function update_entry() {
        $this->update_rekanan();
        $this->update_dokumen();
        $this->update_sub_bidang(); 
    }
    
    function delete_entry($id) {
        $this->db->query('DELETE FROM t_rekanan WHERE id_rekanan = "'.$id.'"');
        $this->db->query('DELETE FROM t_dokumen WHERE id_rekanan = "'.$id.'"');
        $this->db->query('DELETE FROM t_sub WHERE id_rekanan = "'.$id.'"');
    }
    
    function tbs_latest_update() {
        $query = $this->db->query('SELECT MAX(tanggal) AS tanggal FROM tbs');
        return $query->row();
    }
    
    function notice_latest_update() {
        $query = $this->db->query('SELECT MAX(latest_update) AS tanggal FROM notice');
        return $query->row();
    }
    
    function gallery_latest_update() {
        $query = $this->db->query('SELECT MAX(latest_update) AS tanggal FROM gallery');
        return $query->row();
    }

}

?>
