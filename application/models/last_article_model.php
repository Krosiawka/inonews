 <?php
    class Last_article_model extends CI_Model
    {

        public function __construct()
        {
//            $this->load->helper('cookie');
            $this->load->database();
        }

        public function index()
        {
            $this->db->limit('5');
            $this->db->order_by('fk_id','desc');
            $query = $this->db->get('news');
            return $query->result_array();
        }
    }
?>
