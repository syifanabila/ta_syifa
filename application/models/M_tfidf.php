<?php

class M_tfidf extends CI_Model {
    

    function ambilDataQuery() {

        return $this->db->get('set_query');
    }

    function ambilDataPrepro() {

        return $this->db->get('prepro1');
    }

    function ambilTabel( $table, $id_query ) {

        $this->db->where('id_query', $id_query);
        return $this->db->get( $table );
    }



    function query_t( $type, $id_query ) {

        $where = array(

            'id_query'  => $id_query,
            'query_type'=> $type
        );

        $this->db->where($where);
        return $this->db->get( 'hasil_query' );
    }


    function set_query() {

        $set_q = $this->db->query("SELECT * FROM set_query");
        return $set_q;
    }

    function TF($limit, $start) {

        $tf = $this->db->get("term_frequency", $limit, $start)->result_array();
        return $tf;

    }

    function count_TF() {

        $count_tf = $this->db->get("term_frequency")->num_rows();
        return $count_tf;

    }

    function N_TF($limit, $start) {

        $ntf = $this->db->get("normalize_term_frequency", $limit, $start)->result_array();
        return $ntf;

    }

    function count_NTF() {

        $count_ntf = $this->db->get("normalize_term_frequency")->num_rows();
        return $count_ntf;
        
    }

    function idf($limit, $start) {

        $idf = $this->db->get("idf", $limit, $start)->result_array();
        return $idf;

    }

    function count_idfd() {

        $count_idfd = $this->db->get("idf")->num_rows();
        return $count_idfd;
        
    }

    function term_q($limit, $start) {

        $idf = $this->db->get("term_query", $limit, $start)->result_array();
        return $idf;

    }

    function count_tq() {

        $count_idfd = $this->db->get("term_query")->num_rows();
        return $count_idfd;
        
    }

    function result_q($limit, $start) {

        $rq = $this->db->get("hasil_query", $limit, $start)->result_array();
        return $rq;

    }

    function count_rq() {

        $count_rq = $this->db->get("hasil_query")->num_rows();
        return $count_rq;
        
    }

}

?>