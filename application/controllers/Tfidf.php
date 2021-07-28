<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
        
        class Tfidf extends CI_Controller {
        
            public function index(){
                
                $this->load->view('template/template_header');

                $this->load->view('tfidf/V_tfidf');
                
                $this->load->view('template/template_footer');
            }
        
        }
        
        /* End of file Crawling.php */
        