	<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Tagihan_kost extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $params = array('server_key' => 'SB-Mid-server-SUgyYd_evM9QK4Jdx9QiacG5', 'production' => false);
            $this->load->library('midtrans');
            $this->midtrans->config($params);
            $this->load->helper('url');
            $this->load->model('tagihan');
        }

        public function index()
        {
            $data['bulan'] = $this->tagihan->getbulan();
            $data['tagihankost'] = $this->tagihan->gettagihankost();
            $this->load->view('bayaran', $data);
        }
    }
