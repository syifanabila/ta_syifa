<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
        
    class Preprocessing extends CI_Controller {

        function __construct(){

            parent::__construct();

            $this->load->model('M_prepro');

        }

        public function index(){
            
            $this->load->view('template/template_header');

            $y['data'] = $this->M_prepro->data_prepro();
            $this->load->view('preprocessing/V_preprocessing', $y);
            
            $this->load->view('template/template_footer');
        }

    }

    /* End of file Crawling.php */
