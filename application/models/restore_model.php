<?php
/**
*
*/
	class Restore_model extends CI_Model
	{

		public function __construct()
		{

			$this->load->database();
		}

		public function check($email)
		{
			$query = $this->db->get_where('users', array('fc_email'  => $email));
			return $query->row_array();
		}

		public function select($restore_str)
		{
			$query = $this->db->get_where('users', array('fc_restore_str'  => $restore_str));
			return $query->row_array();
		}

		public function insert($login, $restore_str)
		{
			$this->db->update('users', array('fc_restore_str' => $restore_str) ,array('fc_login'  => $login));

		}

		public function update($login, $password)
		{
			$options = [
						'cost' => 11,
						//'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
						];
			$password = password_hash(trim($password), PASSWORD_BCRYPT, $options);
			$this->db->update('users', array('fc_password' => $password, 'fc_restore_str' => NULL), array('fc_login'  => $login));

		}

	}

?>