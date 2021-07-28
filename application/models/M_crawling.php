<?php

class M_crawling extends CI_Model {
    
    function data_crawl() {

        $crawl = $this->db->query("SELECT * FROM dataset1");
        
        return $crawl;
    }

    function count_data() {
        
        $count = $this->db->query("SELECT * FROM dataset1");
        
        return $count->num_rows;

    }

}

?>