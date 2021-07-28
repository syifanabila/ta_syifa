<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Akurasi extends CI_Controller {
    
        public function index(){
            
            $this->load->view('template/template_header');

            $this->load->view('akurasi/V_akurasi');
            
            $this->load->view('template/template_footer');
        }
    
    }
    
    /* End of file Crawling.php */
    