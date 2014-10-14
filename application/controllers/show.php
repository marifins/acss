<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
/**
 *
 *
 * @copyright 2010
 * @author Muhammad Arifin Siregar
 * @package archieve
 * @modified Sep 6, 2010
 */

class Show extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('show_model');
        $this->load->helper('url');
    }

    public function index($kebun = 0, $tanggal = 0)
    {
        $d['query'] = $this->show_model->get_all($tanggal);
        $d['rows'] = $this->show_model->get_rows();
        $d['allkebun'] = $this->show_model->get_kebun_all();

        $this->load->library('parser');

        $data = array(
            'title' => 'Produksi',
            'judul' => 'Produksi',
            'content' => $this->load->view('show/view', $d, TRUE)
        );
        $this->parser->parse('template_show', $data);
    }
    
    public function index_ajax($kebun = 0, $tanggal = 0)
    {
        $d['query'] = $this->show_model->get_all($tanggal);
        $d['rows'] = $this->show_model->get_rows();
        $d['allkebun'] = $this->show_model->get_kebun_all();

        $this->load->view('show/show', $d);
    }

}
?>