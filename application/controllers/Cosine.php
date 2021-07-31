<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cosine extends CI_Controller {
    
        function __construct(){

            parent::__construct();

            $this->load->model('M_cosine');

        }

        public function index(){
            
            $this->load->view('template/template_header');

            // pagination
            $this->load->library('pagination');
            // config
            $config['base_url'] = 'http://localhost/ta_syifa/cosine/index';
            $config['total_rows'] = $this->M_cosine->count_data_c();
            $config['per_page'] = 25;

            // styling
            $config['full_tag_open'] = '<nav><ul class="pagination">';
            $config['full_tag_close'] = '</ul></nav>';

            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';

            $config['attributes'] = array('class' => 'page-link');

            // initialize conf
            $this->pagination->initialize($config);

            $cosine['start'] = $this->uri->segment(3);
            $cosine['data'] = $this->M_cosine->data_cosine($config['per_page'], $cosine['start']);

            $this->load->view('cosine/V_cosine', $cosine);
            
            $this->load->view('template/template_footer');
        }
    
    }
    
    /* End of file Crawling.php */
    