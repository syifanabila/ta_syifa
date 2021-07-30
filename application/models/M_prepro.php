<?php

class M_prepro extends CI_Model {
    
    function data_prepro($limit, $start) {

        $prepro = $this->db->get("prepro1", $limit, $start)->result_array();
        
        return $prepro;
    }

    function count_data() {
        
        $count = $this->db->get("prepro1")->num_rows();
        
        return $count;

    }

}

?>