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
class Pengumuman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('show_model');
        $this->load->helper('url');
    }

    public function index() {
        $d['query'] = $this->show_model->get_notice();      
        $this->load->view('pengumuman/pengumuman', $d);
    }

    public function direksi() {
        $this->load->view('pengumuman/direksi', "");
    }

    public function komisaris() {
        $this->load->view('pengumuman/komisaris', "");
    }

    public function view() {
        $this->load->library('parser');
        
        $d['query'] = $this->show_model->get_notice();
        
        $data = array(
            'title' => 'Pengumuman',
            'h1' => 'Pengumuman',
            'content' => $this->load->view('pengumuman/view', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }
    
    public function edit() {
        $this->load->library('parser');
        
        $d['query'] = $this->show_model->get_notice();
        
        $data = array(
            'title' => 'Update Pengumuman',
            'h1' => 'Update Pengumuman',
            'content' => $this->load->view('pengumuman/edit_pengumuman', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }
    
    public function update() {
        $this->load->helper('url');
        
        $this->show_model->update_notice();
        redirect(base_url() . 'pengumuman/view?s=success');
    }

}

?>