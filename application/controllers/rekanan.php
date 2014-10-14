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
class Rekanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('drt_model');
        $this->load->helper('url');
        $this->load->library('auth');
        $this->auth->restrict();
    }

    public function index($tanggal = 0) {
        $this->load->model('rekanan_model');
        $this->load->library('parser');
        
        $d['data'] = $this->drt_model->get_rekanan();
        $d['rows'] = $this->drt_model->get_rows();

        $data = array(
            'title' => 'Daftar Rekanan',
            'h1' => 'Daftar Rekanan',
            'content' => $this->load->view('rekanan/view_rekanan', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }
    
    public function lulus($tahun = 0, $tahap = 0) {
        $this->load->library('parser');
        
        $d['d_tahun'] = $this->drt_model->get_tahun_drt();
        $d['data'] = $this->drt_model->get_drt($tahun, $tahap);
        $d['data2'] = $this->drt_model->tahun_tahap($tahun, $tahap);
        $d['data3'] = $this->drt_model->get_tdrt($tahun, $tahap);

        $data = array(
            'title' => 'Daftar Rekanan',
            'h1' => 'Daftar Rekanan',
            'content' => $this->load->view('rekanan/view_rekanan_lulus', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }
    
    public function lulus_ajax($tahun = 0, $tahap = 0) {
        $d['d_tahun'] = $this->drt_model->get_tahun_drt();
        $d['data'] = $this->drt_model->get_drt($tahun, $tahap);
        $d['data2'] = $this->drt_model->tahun_tahap($tahun, $tahap);
        $d['data3'] = $this->drt_model->get_tdrt($tahun, $tahap);
        
        $this->load->view('rekanan/show_rekanan_lulus', $d, '');
    }

    public function index_ajax($tanggal = 0) {
        $d['query'] = $this->drt_model->getby_date($tanggal);
        $d['rows'] = $this->drt_model->get_rows($tanggal);
        $d['tanggal'] = $this->drt_model->get_date($tanggal);
        $d['hk'] = $this->drt_model->get_hk($tanggal);

        $this->load->view('rekanan/show_rekanan', $d, '');
    }
    
    public function view($tanggal = 0) {
        $this->load->library('parser');

        $d['query'] = $this->drt_model->getby_date($tanggal);
        $d['rows'] = $this->drt_model->get_rows($tanggal);
        $d['tanggal'] = $this->drt_model->get_date($tanggal);
        $d['hk'] = $this->drt_model->get_hk($tanggal);

        $data = array(
            'title' => 'Produksi',
            'h1' => 'Realisasi Produksi',
            'content' => $this->load->view('rekanan/view_rekanan', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }

    public function add() {
        $this->load->library('parser');
        
        $data = array(
            'title' => 'Tambah Rekanan',
            'h1' => 'Tambah Rekanan',
            'content' => $this->load->view('rekanan/add_rekanan', '', TRUE)
        );
        $this->parser->parse('template', $data);
    }
    
    public function edit($id = 0) {
        $this->load->library('parser');
        
        $d['query'] = $this->drt_model->get_details($id);

        $data = array(
            'title' => 'Edit Data Rekanan',
            'h1' => 'Edit Data Rekanan',
            'content' => $this->load->view('rekanan/edit_rekanan', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }
    
    public function details($id = 0) {
        $this->load->library('parser');
        
        $d['query'] = $this->drt_model->get_details($id);

        $data = array(
            'title' => 'Details Data Rekanan',
            'h1' => 'Details Data Rekanan',
            'content' => $this->load->view('rekanan/details_rekanan', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }
    
    public function seleksi($id = 0) {
        $this->load->library('parser');
        
        $d['query'] = $this->drt_model->get_details($id);
        $d['rows'] = $this->drt_model->count_waiting_list();

        $data = array(
            'title' => 'Seleksi Rekanan',
            'h1' => 'Seleksi Rekanan',
            'content' => $this->load->view('rekanan/seleksi', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }
    
    public function waiting_list($tanggal = 0) {
        $this->load->model('rekanan_model');
        $this->load->library('parser');
        $d['data'] = $this->drt_model->waiting_list();
        $d['rows'] = $this->drt_model->count_waiting_list();

        $data = array(
            'title' => 'Waiting List',
            'h1' => 'Waiting List',
            'content' => $this->load->view('rekanan/view_waiting_list', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }
    
    public function perpanjang($tanggal = 0) {
        $this->load->model('rekanan_model');
        $this->load->library('parser');
        
        $d['data'] = $this->drt_model->get_rekanan();
        $d['rows'] = $this->drt_model->get_rows();
        
        $data = array(
            'title' => 'Perpanjang Rekanan',
            'h1' => 'Perpanjang Rekanan',
            'content' => $this->load->view('perpanjangan/view_perpanjangan', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }
    
    public function to_wl() {
        $this->load->helper('url');
        
        $this->drt_model->to_waiting_list();
        redirect(base_url() . 'rekanan/waiting_list?s=success');
    }
    
    public function show_iujk() {
        $this->load->view('rekanan/show_iujk', '', '');
    }
    
    public function hide_iujk() {
        $this->load->view('rekanan/hide_iujk', '', '');
    }

    public function insert() {
        $this->load->helper('url');
        $this->load->model('rekanan_model');
        
        $this->rekanan_model->insert_entry();
        redirect(base_url() . 'rekanan?s=success');
    }
    
    public function update() {
        $this->load->helper('url');
        $this->load->model('rekanan_model');
        
        $this->rekanan_model->update_entry();
        redirect(base_url() . 'rekanan?s=success');
    }
    
    public function proses_seleksi() {
        $this->load->helper('url');
        
        $this->drt_model->proses_seleksi();
        redirect(base_url() . 'rekanan/seleksi?s=success');
    }
    
    public function check_rows($tanggal = 0) {
        $rows = $this->drt_model->get_rows($tanggal);
        echo $rows;
    }
    
    public function delete($id = 0) {
        $this->load->model('rekanan_model');
        $this->rekanan_model->delete_entry($id);
        redirect(base_url() . 'rekanan?s=success_delete&id='.$id);
    }
    
    public function get_bidang2(){
        $term = strtolower($_GET['term']);
        $this->drt_model->get_bidang2($term);
    }
    
    public function get_sub_bidang2($bidang){
        $term = strtolower($_GET['term']);
        $this->drt_model->get_sub_bidang2($bidang, $term);
    }
    
    public function get_sub_bidang3($bidang){
        $this->drt_model->get_sub_bidang3($bidang);
    }
    
    public function get_tahap_drt($tahun){    
        $d['query'] = $this->drt_model->get_tahap_drt($tahun);
        $this->load->view('rekanan/show_tahap', $d, '');
    }

}

?>