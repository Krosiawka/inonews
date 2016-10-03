<?php
/**
*
*/
	class Writers_model extends CI_Model
	{

		public function __construct()
		{
			$this->load->database();
		}

		public function index()
		{
				$this->db->limit('5');
				$this->db->order_by('fn_count_article','desc');
				//вытаскиваем топ 5 администраторов по колличеству статей, за исключением авторов без статей
				$query = $this->db->get_where('users', array('fb_superuser' => TRUE, 'fn_count_article >' => 0));
				return $query->result_array();
		}

	}
?>
