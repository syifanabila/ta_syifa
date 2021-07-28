<?php

class M_prepro extends CI_Model {
    
    function data_prepro() {

        $prepro = $this->db->query("SELECT id, tweet FROM prepro1");
        
        return $prepro;
    }

    // function count_data() {
        
    //     $count = $this->db->query("SELECT * FROM dataset1");
        
    //     return $count->num_rows;

    // }

}

?>