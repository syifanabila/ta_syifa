<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
        
    class Preprocessing extends CI_Controller {

        public function index(){
            
            $this->load->view('template/template_header');

            $this->load->view('preprocessing/V_preprocessing');
            
            $this->load->view('template/template_footer');
        }

    }

    /* End of file Crawling.php */
