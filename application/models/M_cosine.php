<?php

class M_cosine extends CI_Model {
    
    function data_cosine($limit, $start) {

        $cosine = $this->db->get("cosine_similarity", $limit, $start)->result_array();
        
        return $cosine;
    }

    function count_data_c() {
        
        $count_c = $this->db->get("cosine_similarity")->num_rows();
        
        return $count_c;

    }

}

?>