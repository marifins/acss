<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * @copyright 2010
 * @author Muhammad Arifin Siregar
 * @package default_template
 * @modified Sep 2, 2010
 */

 class Def extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('drt_model');
        $this->load->model('show_model');
        $this->load->helper('url');
        $this->load->library('auth');
        $session = from_session('username');
        if($session == "") redirect(base_url()."login_page");
    }

    public function index($tahun = 0, $bulan = 0) {
        if($tahun == 0) $tahun = date("Y");
        if($bulan == 0) $bulan = date("m");

        $this->load->library('parser');

        $d['year'] = $tahun;
        $d['month'] = $bulan;

        $data = array(
            'title' => 'Dashboard Admin',
            'h1' => 'Dashboard',
            'content' => $this->load->view('home', '', TRUE)
        );
        $this->parser->parse('template', $data);
    }

    public function i($tahun = 0, $bulan = 0) {
        if($tahun == 0) $tahun = date("Y");
        if($bulan == 0) $bulan = date("m");

        $this->load->library('parser');

        $d['query'] = $this->drt_model->getAll($tahun, $bulan);
        $d['rows'] = $this->drt_model->getRowsAll($tahun, $bulan);
        //$d['kebun'] = $this->drt_model->get_kebun_aktif();
        $d['tahun'] = $this->drt_model->get_tahun_produksi();

        $d['year'] = $tahun;
        $d['month'] = $bulan;

        $data = array(
            'title' => 'SMS-Based Information System FFB Production',
            'judul' => 'Welcome!'
        );
        $this->load->view('show_home', $d, '');
    }

    public function igraph($tahun = 0, $bulan = 0){
        if($tahun == 0) $tahun = date("Y");
        if($bulan == 0) $bulan = date("m");

        $d['query_g'] = $this->drt_model->getAll2($tahun, $bulan);
        $d['rows_g'] = $this->drt_model->getRowsAll2($tahun, $bulan);

        $this->load->view('graph', $d, '');
    }

    public function graph($tahun = 0, $bulan = 0) {
        if($tahun == 0) $tahun = date("Y");
        if($bulan == 0) $bulan = date("m");

        $this->load->library('parser');

        $d['query'] = $this->drt_model->getAll($tahun, $bulan);
        $d['rows'] = $this->drt_model->getRowsAll($tahun, $bulan);

        $data = array(
            'title' => 'SMS-Based Information System FFB Production',
            'judul' => 'Produksi Harian Kebun',
            'content' => $this->load->view('graph', $d, TRUE)
        );
        $this->parser->parse('template', $data);
    }

    public function graph2($kebun = 0){

        $d['query'] = $this->drt_model->get_data_per_kebun($kebun);
        $d['rows'] = $this->drt_model->get_data_per_kebun_row($kebun);

        $this->load->view('graph', $d, '');
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

    public function not_found() {
        $this->load->view('404', '', '');
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
    
    function d2($str){
        $res = round($str, 2);
        $s = explode(".", $res);
        if(strlen($res) == 1) $res .= ".00";
        if(isset($s[1])){
            if(strlen($s[1]) == 1) $res .= "0";
        }
        return $res;
    }
}

?>
