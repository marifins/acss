<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Stok_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function cek_data_stok($pks, $kebun, $tanggal){
      $this->db->select('id');
      $this->db->from('stok');
      $this->db->where('pks', $pks);
      $this->db->where('kebun', $kebun);
      $this->db->where('tanggal', $tanggal);
      $query = $this->db->get();
      return $query->num_rows();
    }

    function delete() {
        $id = $this->input->post('id');
        $this->db->delete('produksi', array('id' => $id));
    }
}
?>