<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Search_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_data() {
        $str = $_POST['search'];
        $str = "%" .$str ."%";
        $query = $this->db->query('SELECT * FROM t_rekanan WHERE nama_rekanan LIKE "'.$str.'"');
        return $query->result();
    }
    
    function get_rows() {
        $str = $_POST['search'];
        $str = "%" .$str ."%";
        $query = $this->db->query('SELECT * FROM t_rekanan WHERE nama_rekanan LIKE "'.$str.'"');
        return $query->num_rows();
    }
    
    function get_rekanan($letter) {
        $str = explode("-", $letter);
        $str1 = $str[0] ."%";
        $str2 = $str[1] ."%";;
        //$query = $this->db->query('SELECT * FROM t_rekanan WHERE TRIM(SUBSTR(nama_rekanan,4)) LIKE "'.$str1.'" OR TRIM(SUBSTR(nama_rekanan,4)) LIKE "'.$str2.'"');
        $query = $this->db->query('SELECT * FROM t_rekanan WHERE TRIM(SUBSTR(nama_rekanan,LOCATE(".",nama_rekanan)+1)) LIKE "'.$str1.'" OR TRIM(SUBSTR(nama_rekanan,LOCATE(".",nama_rekanan)+1)) LIKE "'.$str2.'"');
        return $query->result();
    }
    
    function get_rekanan_rows($letter) {
        $str = explode("-", $letter);
        $str1 = $str[0] ."%";
        $str2 = $str[1] ."%";;
        $query = $this->db->query('SELECT * FROM t_rekanan WHERE TRIM(SUBSTR(nama_rekanan,LOCATE(".",nama_rekanan)+1)) LIKE "'.$str1.'" OR TRIM(SUBSTR(nama_rekanan,LOCATE(".",nama_rekanan)+1)) LIKE "'.$str2.'"');
        return $query->num_rows();
    }
    
    function get_waiting_list($letter) {
        $str = explode("-", $letter);
        $str1 = $str[0] ."%";
        $str2 = $str[1] ."%";;
        $query = $this->db->query('SELECT * FROM t_rekanan WHERE (TRIM(SUBSTR(nama_rekanan,LOCATE(".",nama_rekanan)+1)) LIKE "'.$str1.'" OR TRIM(SUBSTR(nama_rekanan,LOCATE(".",nama_rekanan)+1)) LIKE "'.$str2.'") AND (status = 0)');
        return $query->result();
    }
    
    function get_waiting_list_rows($letter) {
        $str = explode("-", $letter);
        $str1 = $str[0] ."%";
        $str2 = $str[1] ."%";;
        $query = $this->db->query('SELECT * FROM t_rekanan WHERE (TRIM(SUBSTR(nama_rekanan,LOCATE(".",nama_rekanan)+1)) LIKE "'.$str1.'" OR TRIM(SUBSTR(nama_rekanan,LOCATE(".",nama_rekanan)+1)) LIKE "'.$str2.'") AND (status = 0)');
        return $query->num_rows();
    }

}

?>
