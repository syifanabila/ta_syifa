<?php

class M_crawling extends CI_Model {
    
    function data_crawl($limit, $start) {

        $crawl = $this->db->get("dataset1", $limit, $start)->result_array();
        
        return $crawl;
    }

    function count_data() {
        
        $count = $this->db->get("dataset1")->num_rows();
        
        return $count;

    }

}

?>