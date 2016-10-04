<?php
/**
*
*/
	class Users_list_model extends CI_Model
	{

		public function __construct()
		{

			$this->load->database();
		}

		public function index($id)
		{
			$this->db->order_by('fk_id','ASC');
			$this->db->where('fk_id !=', $id);//вытаскиваем всех пользователей и администраторов за исключением самого инициатора запроса
            $query = $this->db->get('users');
            return $query->result_array();			
		}
	}
?>