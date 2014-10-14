<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * @copyright 2010
 * @author Muhammad Arifin Siregar
 * @package default_template
 * @modified Sep 2, 2010
 */

 class Myaccount extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('auth');
        $this->auth->restrict();
    }

    public function index() {
        $this->load->library('parser');
        
        $register =  from_session('user_id');
        $d['query'] = $this->user_model->get_details($register);
        
        $data = array(
            'title' => 'My Account',
            'h1' => 'My Account',
            'content' => $this->load->view('user/myaccount', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }
}

?>
