<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
        
    class Preprocessing extends CI_Controller {

        function __construct(){

            parent::__construct();

            $this->load->model('M_prepro');

        }

        public function index(){
            
            $this->load->view('template/template_header');

            // pagination
            $this->load->library('pagination');
            // config
            $config['base_url'] = 'http://localhost/ta_syifa/preprocessing/index';
            $config['total_rows'] = $this->M_prepro->count_data();
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

            $y['start'] = $this->uri->segment(3);
            $y['data'] = $this->M_prepro->data_prepro($config['per_page'], $y['start']);
            $this->load->view('preprocessing/V_preprocessing', $y);
            
            $this->load->view('template/template_footer');
        }

    }

    /* End of file Preprocessing.php */
