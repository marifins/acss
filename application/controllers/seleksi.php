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
class Seleksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('drt_model');
        $this->load->helper('url');
        $this->load->library('auth');
        $this->auth->restrict();
    } 
    
    public function index($id = 0) {
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
    
    

}

?>