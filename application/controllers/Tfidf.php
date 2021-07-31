<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
        
        class Tfidf extends CI_Controller {
        
            function __construct(){

                parent::__construct();
    
                $this->load->model('M_tfidf');
    
            }
            
            public function index(){
                
                $this->load->view('template/template_header');

                // pagination
                $this->load->library('pagination');
                // config TF
                $config['base_url'] = 'http://localhost/ta_syifa/tfidf/index';
                $config['total_rows'] = $this->M_tfidf->count_TF();

                // config NTF
                $config['base_url'] = 'http://localhost/ta_syifa/tfidf/index';
                $config['total_rows'] = $this->M_tfidf->count_NTF();
                
                // config NTF
                $config['base_url'] = 'http://localhost/ta_syifa/tfidf/index';
                $config['total_rows'] = $this->M_tfidf->count_idfd();

                // config TQ
                $config['base_url'] = 'http://localhost/ta_syifa/tfidf/index';
                $config['total_rows'] = $this->M_tfidf->count_tq();

                // config TQ
                $config['base_url'] = 'http://localhost/ta_syifa/tfidf/index';
                $config['total_rows'] = $this->M_tfidf->count_rq();

                $config['per_page'] = 5;

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

                // Tampil Data Query
                $set['data']=$this->M_tfidf->set_query();

                // Tampil Data TF
                $set['start'] = $this->uri->segment(3);
                $set['TF'] = $this->M_tfidf->TF($config['per_page'], $set['start']);

                // Tampil Data NTF
                $set['NTF'] = $this->M_tfidf->N_TF($config['per_page'], $set['start']);

                // Tampil Data IDF Data
                $set['idf'] = $this->M_tfidf->idf($config['per_page'], $set['start']);

                // Tampil Data TQ Data
                $set['termq'] = $this->M_tfidf->term_q($config['per_page'], $set['start']);

                // Tampil Data Result Query
                $set['result_query'] = $this->M_tfidf->result_q($config['per_page'], $set['start']);

                $this->load->view('tfidf/V_tfidf', $set);
                
                $this->load->view('template/template_footer');
            }
        
        }
        
        /* End of file TFIDF.php */
        