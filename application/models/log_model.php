<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Log_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function main_query($tanggal = 0){
        if($tanggal == 0)
            $query = $this->db->query('SELECT k.nama_kebun, p.id, p.afdeling, p.estimasi, p.realisasi, p.tanggal FROM produksi as p JOIN kebun as k WHERE p.kebun = k.no_rek ORDER BY tanggal DESC');
        else
            $query = $this->db->query('SELECT * FROM produksi WHERE tanggal = "'.$tanggal.'" ORDER BY tanggal DESC');
        return $query;
    }

    function get_all($tanggal = 0)
    {
        $query = $this->main_query($tanggal);
        return $query->result();
    }
    function get_rows($tanggal = 0){
        $query = $this->main_query($tanggal);
        return $query->num_rows();
    }

    function get_last_ten($limit,$offset)
    {
        $query = $this->db->query('SELECT * FROM produksi AS p JOIN kebun AS k WHERE p.kebun = k.no_rek ORDER BY tanggal DESC LIMIT ' .$offset .',' .$limit);
        return $query->result();
    }

    function count(){
        $query = $this->db->query('SELECT * FROM produksi');
        return $query->num_rows();
    }
    
    function get_details($id){
        $query = $this->db->query('SELECT * FROM produksi AS p JOIN kebun AS k WHERE p.kebun = k.no_rek AND id = '.$id.'');
        return $query->row();
    }

    function get_kebun_all() {
      $this->db->select('no_rek, nama_kebun');
      $this->db->from('kebun');
      $this->db->where('status', '1');
      $query = $this->db->get();
      return $query->result();
    }
  
    function cek_data_log($pks, $kebun, $tanggal){
      $this->db->select('id');
      $this->db->from('produksi');
      $this->db->where('pks', $pks);
      $this->db->where('kebun', $kebun);
      $this->db->where('tanggal', $tanggal);
      $query = $this->db->get();
      return $query->num_rows();
    }
    
    function cek_data_do($no_do_ms, $no_do_is, $tanggal){
      $query = $this->db->query('SELECT id_do FROM do WHERE (no_do_ms = "'.$no_do_ms.'" OR no_do_is = "'.$no_do_is.'") AND (tanggal_do = "'.$tanggal.'")');
      return $query->num_rows();
    }
    
    function cek_data_details($pks, $tanggal){
      $this->db->select('id');
      $this->db->from('details');
      $this->db->where('pks', $pks);
      $this->db->where('tanggal', $tanggal);
      $query = $this->db->get();
      return $query->num_rows();
    }

    function get_produksi_id($pks, $kebun, $tanggal){
        $query = $this->db->query('SELECT MAX(id) max_id FROM produksi WHERE pks = "'.$pks.'" AND kebun = "'.$kebun.'" AND tanggal = "'.$tanggal.'"');
        return $query->row();
    }

    function get_last_stok($pks, $kebun){
        $query = $this->db->query('SELECT stok_ms, stok_is FROM stok WHERE pks = "'.$pks.'" AND kebun = "'.$kebun.'" AND tanggal = (SELECT MAX(tanggal) FROM stok WHERE pks = "'.$pks.'" AND kebun = "'.$kebun.'")');
        return $query->row();
    }
    
    function get_sisa_kemarin_all($pks, $kebun, $tgl){
        $sisa = "";
        $query = $this->db->query('SELECT sisa FROM produksi WHERE pks = "'.$pks.'" AND kebun = "'.$kebun.'" AND tanggal = "' . $tgl . '" - INTERVAL 1 DAY');
        $dt = $query->row();
        if(isset($dt->sisa))
            $sisa = $dt->sisa;
        else
            $sisa = 0;
        
        return $sisa;
    }

    function save() {
        $tanggal = $this->input->post('tanggal');
        $pks = $this->input->post('pks');
        $kebun = $this->input->post('kebun');
        $diterima = $this->input->post('diterima');
        $diolah = $this->input->post('diolah');
        $sisa_kemarin = $this->get_sisa_kemarin_all($pks, $kebun, $tanggal);
        $sisa = $sisa_kemarin + $diterima - $diolah;
        $ms = $this->input->post('ms');
        $is = $this->input->post('is');

        $ms_out = $this->input->post('ms_out');
        $is_out = $this->input->post('is_out');

        $data = array(
            'tanggal' => $tanggal,
            'pks' => $pks,
            'kebun' => $kebun,
            'diterima' => $diterima,
            'diolah' => $diolah,
            'sisa' => $sisa,
            'ms_in' => $ms,
            'is_in' => $is,
        );

        $this->db->insert('produksi', $data);

        $row = $this->get_produksi_id($pks, $kebun, $tanggal);
        $data2 = array(
            'id_produksi' => $row->max_id,
            'ms_out' => $ms_out,
            'is_out' => $is_out,
        );      
        $this->db->insert('cpo_out', $data2);


        $r = $this->get_last_stok($pks, $kebun);
        
        $get_ms = 0;
        $get_is = 0;

        if(isset($r->stok_ms)){
            $get_ms = $r->stok_ms;
        }
        if(isset($r->stok_is)){
            $get_is = $r->stok_is;
        }
        
        $stok_ms = ($get_ms + $ms) - $ms_out;
        $stok_is = ($get_is + $is) - $is_out;
        
        $data3 = array(
            'tanggal' => $tanggal,
            'pks' => $pks,
            'kebun' => $kebun,
            'stok_ms' => $stok_ms,
            'stok_is' => $stok_is,
        );
        $this->db->insert('stok', $data3);
    }

    function update() {
        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $pks = $this->input->post('pks');
        $kebun = $this->input->post('kebun');
        $diterima = $this->input->post('diterima');
        $diolah = $this->input->post('diolah');
        $sisa_kemarin = $this->get_sisa_kemarin_all($pks, $kebun, $tanggal);
        $sisa = $sisa_kemarin + $diterima - $diolah;
        $ms = $this->input->post('ms');
        $is = $this->input->post('is');

        $ms_out = $this->input->post('ms_out');
        $is_out = $this->input->post('is_out');

        $data = array(
            'tanggal' => $tanggal,
            'pks' => $pks,
            'kebun' => $kebun,
            'diterima' => $diterima,
            'diolah' => $diolah,
            'sisa' => $sisa,
            'ms_in' => $ms,
            'is_in' => $is
        );

        $data2 = array(
            'tanggal' => $tanggal,
            'pks' => $pks,
            'kebun' => $kebun,
            'ms_out' => $ms_out,
            'is_out' => $is_out,
        );
        
        $this->db->where('id', $id);
        $this->db->update('produksi', $data);

        $this->db->where('id', $id);
        $this->db->update('cpo_out', $data2);
    }

    function delete($pks, $kbn, $tanggal) {
        $id = $this->input->post('id');
        $this->db->delete('produksi', array('id' => $id));
        
        $this->db->delete('cpo_out', array('id_produksi' => $id));
        
        $this->db->delete('stok', array('pks' => $pks, 'kebun' => $kbn, 'tanggal' => $tanggal));
    }
    
    
    function save_do() {
        $tanggal = $this->input->post('tanggal_do');
        $pks = $this->input->post('pks');
        $pembeli = $this->input->post('pembeli');
        $transport = $this->input->post('pengangkut');
        $no_do_ms = $this->input->post('no_do_ms');
        $do_ms = $this->input->post('do_ms');
        $sisa_do_ms = $this->input->post('sisa_do_ms');
        $no_do_is = $this->input->post('no_do_is');
        $do_is = $this->input->post('do_is');
        $sisa_do_is = $this->input->post('sisa_do_is');

        $data = array(
            'tanggal_do' => $tanggal,
            'pks' => $pks,
            'pembeli' => $pembeli,
            'pengangkut' => $transport,
            'no_do_ms' => $no_do_ms,
            'do_ms' => $do_ms,
            'sisa_do_ms' => $sisa_do_ms,
            'no_do_is' => $no_do_is,
            'do_is' => $do_is,
            'sisa_do_is' => $sisa_do_is,
        );

        $this->db->insert('do', $data);
    }

    function update_do() {
        $id = $this->input->post('id_do');
        $tanggal = $this->input->post('tanggal_do');
        $pks = $this->input->post('pks');
        $pembeli = $this->input->post('pembeli');
        $transport = $this->input->post('pengangkut');
        $no_do_ms = $this->input->post('no_do_ms');
        $do_ms = $this->input->post('do_ms');
        $sisa_do_ms = $this->input->post('sisa_do_ms');
        $no_do_is = $this->input->post('no_do_is');
        $do_is = $this->input->post('do_is');
        $sisa_do_is = $this->input->post('sisa_do_is');


        $data = array(
            'tanggal_do' => $tanggal,
            'pks' => $pks,
            'pembeli' => $pembeli,
            'pengangkut' => $transport,
            'no_do_ms' => $no_do_ms,
            'do_ms' => $do_ms,
            'sisa_do_ms' => $sisa_do_ms,
            'no_do_is' => $no_do_is,
            'do_is' => $do_is,
            'sisa_do_is' => $sisa_do_is,
        );
        
        $this->db->where('id', $id);
        $this->db->update('do', $data);
    }

    function delete_do() {
        $id = $this->input->post('id');
        $this->db->delete('do', array('id_do' => $id));
    }
    
    function save_details() {
        $tanggal = $this->input->post('tanggal_details');
        $pks = $this->input->post('pks');
        $alb_cpo = $this->input->post('alb_ms');
        $air_cpo = $this->input->post('k_air_ms');
        $kotoran_cpo = $this->input->post('k_kotoran_ms');
        $alb_inti = $this->input->post('alb_is');
        $air_inti = $this->input->post('k_air_is');
        $kotoran_inti = $this->input->post('k_kotoran_is');
        $jam_olah = $this->input->post('jam_olah');
        $kapasitas_olah = $this->input->post('kapasitas_olah');
        $jam_screw = $this->input->post('jam_screw');
        $jam_stagnasi = $this->input->post('jam_stagnasi');

        $data = array(
            'tanggal' => $tanggal,
            'pks' => $pks,
            'alb_ms' => $alb_cpo,
            'k_air_ms' => $air_cpo,
            'k_kotoran_ms' => $kotoran_cpo,
            'alb_is' => $alb_inti,
            'k_air_is' => $air_inti,
            'k_kotoran_is' => $kotoran_inti,
            'jam_olah' => $jam_olah,
            'kapasitas_olah' => $kapasitas_olah,
            'jam_screw' => $jam_screw,
            'jam_stagnasi' => $jam_stagnasi,
        );

        $this->db->insert('details', $data);
    }

    function update_details() {
        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal_details');
        $pks = $this->input->post('pks');
        $alb_cpo = $this->input->post('alb_ms');
        $air_cpo = $this->input->post('k_air_ms');
        $kotoran_cpo = $this->input->post('k_kotoran_ms');
        $alb_inti = $this->input->post('alb_is');
        $air_inti = $this->input->post('k_air_is');
        $kotoran_inti = $this->input->post('k_kotoran_is');
        $jam_olah = $this->input->post('jam_olah');
        $kapasitas_olah = $this->input->post('kapasitas_olah');
        $jam_screw = $this->input->post('jam_screw');
        $jam_stagnasi = $this->input->post('jam_stagnasi');

        $data = array(
            'tanggal' => $tanggal,
            'pks' => $pks,
            'alb_ms' => $alb_cpo,
            'k_air_ms' => $air_cpo,
            'k_kotoran_ms' => $kotoran_cpo,
            'alb_is' => $alb_inti,
            'k_air_is' => $air_inti,
            'k_kotoran_is' => $kotoran_inti,
            'jam_olah' => $jam_olah,
            'kapasitas_olah' => $kapasitas_olah,
            'jam_screw' => $jam_screw,
            'jam_stagnasi' => $jam_stagnasi,
        );
        
        $this->db->where('id', $id);
        $this->db->update('details', $data);
    }

    function delete_details() {
        $id = $this->input->post('id');
        $this->db->delete('details', array('id' => $id));
    }
    
    function get_pembeli($id){
        $this->db->select('nama');
        $this->db->from('pembeli');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_pengangkut($id){
        $this->db->select('nama');
        $this->db->from('pengangkut');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
}
?>