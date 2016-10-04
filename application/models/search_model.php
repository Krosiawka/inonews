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

        public function index($search, $num = NULL, $offset = NULL)
        {
            
            $this->db->order_by('fk_id','desc');
            $this->db->like('fc_title', $search);
            $query = $this->db->get('news', $num, $offset);
            //$query = $this->db->get_where('news', array('fc_title' => $search));
            //$data = $query->result_array();

            $data['count'] = $query->num_rows();
            return $query;
        }
    }

?>
