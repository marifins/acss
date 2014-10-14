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
class Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('search_model');
        $this->load->helper('url');
        $this->load->library('auth');
        $this->auth->restrict();
    }

    public function index() {
        $this->load->library('parser');
        $this->load->model('drt_model');
        
        $d['data'] = $this->search_model->get_data();
        $d['rows'] = $this->search_model->get_rows();

        $data = array(
            'title' => 'Search Result',
            'h1' => 'Search Result',
            'content' => $this->load->view('search/result', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }
    
    public function get_letter($letter) {
        $this->load->model('drt_model');
        
        $d['data'] = $this->search_model->get_rekanan($letter);
        $d['rows'] = $this->search_model->get_rekanan_rows($letter);

        $this->load->view('rekanan/show_rekanan', $d, '');
    }
    
    public function get_perpanjangan($letter) {
        $this->load->model('drt_model');
        
        $d['data'] = $this->search_model->get_rekanan($letter);
        $d['rows'] = $this->search_model->get_rekanan_rows($letter);

        $this->load->view('perpanjangan/show_perpanjangan', $d, '');
    }
    
    public function get_waiting_list($letter) {
        $this->load->model('drt_model');
        
        $d['data'] = $this->search_model->get_waiting_list($letter);
        $d['rows'] = $this->search_model->get_waiting_list_rows($letter);

        $this->load->view('rekanan/show_waiting_list', $d, '');
    }
}

?>