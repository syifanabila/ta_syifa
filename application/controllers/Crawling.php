<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Crawling extends CI_Controller {

        function __construct(){

            parent::__construct();

            $this->load->model('M_crawling');

        }
    
        public function index(){
            
            $this->load->view('template/template_header');

            $x['data'] = $this->M_crawling->data_crawl();
            $this->load->view('crawling/V_crawling', $x);
            
            $this->load->view('template/template_footer');
        }
    
    }
    
    /* End of file Crawling.php */
    