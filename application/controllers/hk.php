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
class Hk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('hk_model');
        $this->load->helper('url');
        $this->load->library('auth');
        $this->auth->restrict();
    }

    public function index($tahun = 0) {
        $this->load->library('parser');

        $d['query'] = $this->hk_model->get_all($tahun);
        $d['rows'] = $this->hk_model->get_rows($tahun);
        $d['tahun'] = $this->hk_model->get_tahun_all();

        $data = array(
            'title' => 'Hari Kerja',
            'h1' => 'Hari Kerja',
            'content' => $this->load->view('hk/view_hk', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }

    public function index_ajax($tahun = 0) {
        $this->load->library('parser');

        $d['query'] = $this->hk_model->get_all($tahun);
        $d['rows'] = $this->hk_model->get_rows($tahun);
        $d['tahun'] = $this->hk_model->get_tahun_all();

        $this->load->view('hk/show_hk', $d, '');
    }

    public function add($tahun = 0) {
        $this->load->library('parser');

        $data = array(
            'title' => 'Hari Kerja',
            'h1' => 'Hari Kerja',
            'content' => $this->load->view('hk/edit_hk', '', TRUE)
        );
        $this->parser->parse('template', $data);
    }

    public function edit($tahun, $bulan) {
        $this->load->library('parser');

        $d['query'] = $this->hk_model->get_all($tahun);
        $d['rows'] = $this->hk_model->get_rows($tahun);
        $d['tahun'] = $this->hk_model->get_tahun_all();

        $data = array(
            'title' => 'Hari Kerja',
            'h1' => 'Hari Kerja',
            'content' => $this->load->view('hk/edit_hk', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }

    public function load($tahun = 0) {
        $d['query_hk'] = $this->hk_model->get_all($tahun);
        $d['rows_hk'] = $this->hk_model->get_rows($tahun);
        $d['tahun_hk'] = $this->hk_model->get_tahun_all();

        $this->load->view('hk/show_hk', $d);
    }
    
    public function insert() {
        $this->load->helper('url');
        $this->load->model('hk_model');
        
        $this->hk_model->insert_entry();
        redirect(base_url() . 'hk?s=success');
    }
    
    public function update() {
        $this->load->helper('url');
        $this->load->model('hk_model');
        
        $this->hk_model->update_entry();
        redirect(base_url() . 'hk?s=success');
    }
    
    public function check_rows($tahun, $bulan) {
        $rows = $this->hk_model->cek_data($tahun, $bulan);
        echo $rows;
    }
    
    public function delete($id) {
        $this->hk_model->delete_entry($id);
        redirect(base_url() . 'hk?s=success');
    }

}

?>