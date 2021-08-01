<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Dashboard extends CI_Controller {


        function __construct() {

            parent::__construct();

            // load model
            $this->load->model('M_tfidf');
        }
    
        public function index(){
            
            $data['query'] = $this->M_tfidf->ambilDataQuery();

            $this->load->view('template/template_header');
            $this->load->view('dashboard/V_dashboard', $data);
            $this->load->view('template/template_footer');
        }



        function detail( $id_query ) {

            $data['id_query'] = $id_query;
            $data['syifa'] = $this->M_tfidf->ambilTabel('set_query', $id_query)->row_array();

            $this->load->view('template/template_header');
            $this->load->view('dashboard/V_dashboard_detail', $data);
            $this->load->view('template/template_footer');
        }



        // hasil data detail dashboard
        function hasil( $id_query ) {

            $dataPrepro = $this->M_tfidf->ambilDataPrepro();
            
            $hasilQueryCosine = array();
            $index = 0;
            foreach ( $dataPrepro->result_array() AS $rowPrepro ) {

                // panggil data cosine berdasarkan id_query : detail
                $dataCosine = $this->M_tfidf->ambilTabel('cosine_similarity', $id_query)->row_array();


                $nilai = explode('-', $dataCosine['data']);

                array_push( $hasilQueryCosine, array(

                    'RecordID'  => $index + 1,
                    'tweet' => $rowPrepro['tweet'],
                    'value' => $nilai[$index]
                ) );

                $index++;
            }


            echo json_encode(array(

                'data'  => $hasilQueryCosine
            ));
        } 
    }
    
    /* End of file Dashboard.php */
    