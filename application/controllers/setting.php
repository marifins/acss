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
class Setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->restrict();
    }

    public function index($tahun = 0) {
        $this->load->library('parser');
        
        $data = array(
            'title' => 'Setting',
            'h1' => 'Setting',
            'content' => $this->load->view('bidang/view_setting', '', TRUE)
        );
        $this->parser->parse('template', $data);
    }

}

?>