<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * @copyright 2010
 * @author Muhammad Arifin Siregar
 * @package default_template
 * @modified Sep 2, 2010
 */

 class Unit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('unit_model');
        $this->load->helper('url');
        $this->load->library('auth');
        $session = from_session('username');
        if($session == "") redirect(base_url()."login_page");
    }

    public function index($tahun = 0, $bulan = 0) {
        $pks = from_session('unit');
        if($tahun == 0) $tahun = date("Y");
        if($bulan == 0) $bulan = date("m");

        $this->load->library('parser');

        //$d['query'] = $this->unit_model->getAll($tahun, $bulan, $pks);
        //$d['rows'] = $this->unit_model->getRowsAll($tahun, $bulan, $pks);

        //$d['tahun'] = $this->unit_model->get_tahun_produksi();

        $d['year'] = $tahun;
        $d['month'] = $bulan;

        $data = array(
            'title' => 'SMS-Based Information System for Oil Palm FFB Production',
            'judul' => '',
            'content' => $this->load->view('unit', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }

    public function i($tahun = 0, $bulan = 0) {
        $pks = from_session('unit');
        if($tahun == 0) $tahun = date("Y");
        if($bulan == 0) $bulan = date("m");

        $this->load->library('parser');

        $d['query'] = $this->unit_model->getAll($tahun, $bulan, $pks);
        $d['rows'] = $this->unit_model->getRowsAll($tahun, $bulan, $pks);

        $d['tahun'] = $this->unit_model->get_tahun_produksi();

        $d['year'] = $tahun;
        $d['month'] = $bulan;

        $data = array(
            'title' => 'SMS-Based Information System FFB Production',
            'judul' => 'Welcome!'
        );
        $this->load->view('show_home_unit', $d, '');
    }
    
    function s($input){
        $res = 0;
        if (array_key_exists('0', $input)) {
            $res = $input['0']['realisasi'] / 1000;
            return round($res, 2);
        }else{
            return 0;
        }
    }

    function setNum($str) {
        return number_format($str, 0, ',', '.');
    }
    
    function t_olah($pks, $a, $b) {
        if ($pks == '080.15') {
            return "\n" .$a;
        } else {
            return $b;
        }
    }
}

?>
