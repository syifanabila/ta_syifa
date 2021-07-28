<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Crawling extends CI_Controller {
    
        public function index(){
            
            $this->load->view('template/template_header');

            $this->load->view('crawling/V_crawling');
            
            $this->load->view('template/template_footer');
        }
    
    }
    
    /* End of file Crawling.php */
    