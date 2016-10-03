<?php
/**
*
*/
    class Search_model extends CI_Model
    {

        public function __construct()
        {

            $this->load->database();
        }

        public function index($search = NULL)
        {
            $query = $this->db->get_where('news', array('fc_title' => $search));
            return $query->row_array();
        }

    }

?>
