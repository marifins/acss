<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 *
 * @copyright 2010
 * @author Muhammad Arifin Siregar
 * @package archieve
 * @modified Sep 6, 2010
 */
class Bidang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('bidang_model');
        $this->load->model('drt_model');
        $this->load->helper('url');
        $this->load->library('auth');
        $this->auth->restrict();
    }

    public function index($tahun = 0) {
        $this->load->library('parser');
        
        $d['query'] = $this->bidang_model->get_kategori();

        $data = array(
            'title' => 'Kategori Bidang',
            'h1' => 'Kategori Bidang',
            'content' => $this->load->view('bidang/view_bidang', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }

    public function index_ajax($tahun = 0) {
        $d['data'] = $this->bidang_model->get_bulan($tahun);
        $d['rows'] = $this->bidang_model->get_bulan_rows($tahun);

        $this->load->view('bidang/show_bidang', $d, '');
    }
    
    public function add_kategori($tanggal = 0) {
        $this->load->library('parser');

        $d['query'] = $this->bidang_model->get_bidang();

        $data = array(
            'title' => 'Tambah Kategori',
            'h1' => 'Tambah Kategori',
            'content' => $this->load->view('bidang/add_kategori', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }
    
    public function add_sub_bidang($tanggal = 0) {
        $this->load->library('parser');

        $d['query'] = $this->bidang_model->get_bidang();

        $data = array(
            'title' => 'Tambah Sub Bidang',
            'h1' => 'Tambah Sub Bidang',
            'content' => $this->load->view('bidang/add_sub_bidang', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }
    
    public function get_kategori_bidang($id = 0) {
        $d['query'] = $this->bidang_model->get_kategori_bidang($id);
        
        $this->load->view('bidang/show_kategori', $d, '');
    }

    public function insert_kategori() {
        $this->load->helper('url');
        $this->load->model('bidang_model');
        
        $this->bidang_model->insert_entry_kategory();
        redirect(base_url() . 'bidang/add_kategori?s=success');
    }
    
    public function insert_sub_bidang() {
        $this->load->helper('url');
        $this->load->model('bidang_model');
        
        $this->bidang_model->insert_entry_sub_bidang();
        redirect(base_url() . 'bidang/add_sub_bidang?s=success');
    }
    
    public function update() {
        $this->load->helper('url');
        $this->load->model('bidang_model');
        
        $this->bidang_model->update_entry();
        redirect(base_url() . 'bidang?s=success');
    }
    
    public function check_rows($tahun, $bulan) {
        $rows = $this->bidang_model->get_rows($tahun, $bulan);
        echo $rows;
    }
    
    public function delete($tahun, $bulan) {
        $this->bidang_model->delete_entry($tahun, $bulan);
        redirect(base_url() . 'bidang?s=success');
    }

}

?>