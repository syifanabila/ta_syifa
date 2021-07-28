<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cosine extends CI_Controller {
    
        public function index(){
            
            $this->load->view('template/template_header');

            $this->load->view('cosine/V_cosine');
            
            $this->load->view('template/template_footer');
        }
    
    }
    
    /* End of file Crawling.php */
    