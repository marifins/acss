<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 *
 * @copyright 2010
 * @author Muhammad Arifin Siregar
 * @package default_template
 * @modified Sep 2, 2010
 */
class Gallery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('show_model');
        $this->load->helper('url');
    }

    public function index() {
        $this->load->library('auth');
        $this->auth->restrict();
        
        $this->load->library('parser');

        $d['query'] = $this->show_model->get_gallery();

        $data = array(
            'title' => 'Gallery',
            'h1' => 'Gallery',
            'content' => $this->load->view('gallery/view', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }

    public function edit($id) {
        $this->load->library('auth');
        $this->auth->restrict();
        
        $this->load->library('parser');

        $d['query'] = $this->show_model->get_gallery_details($id);

        $data = array(
            'title' => 'Update Gallery',
            'h1' => 'Update Gallery',
            'content' => $this->load->view('gallery/edit_gallery', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }

    function do_upload($id) {
        $config['upload_path'] = './assets/images';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $_POST['link'];
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '500';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload', $config);

        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            redirect(base_url() . 'gallery/edit/' . $id . '?s=error');
        } else {
            $data = array('upload_data' => $this->upload->data());
            $this->show_model->update_gallery();
       
            redirect(base_url() . 'gallery');
        }
    }
    
    public function show($id) {
        $d['query'] = $this->show_model->get_gallery_details($id);
        $this->load->view('gallery/show', $d);
    }

	public function flash() {
        $this->load->view('n1');
    }

}

?>
