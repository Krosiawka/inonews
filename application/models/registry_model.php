<?php
/**
*
*/
	class Registry_model extends CI_Model
	{

		public function __construct()
		{

			$this->load->database();
		}

		public function index()
		{
			//регситрация нового пользователя
			$data['fc_login'] = $this->input->post('login');
			$options = [
						'cost' => 11,
						//'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
						];
			$data['fc_password'] = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);//, $options);
			$data['fc_email'] = $this->input->post('email');
			$this->db->insert('users', $data);


		}

		public function check_login()
		{
			$query = $this->db->get_where('users', array('fc_login' => $this->input->post('login')));
			if ($query->num_rows() > 0)
			{
				$data['error_login'] = 'Пользователь с таким логином уже существует';
				return $data;
			}
		}

		public function check_email()
		{
			$query = $this->db->get_where('users', array('fc_email' => $this->input->post('email')));
			if ($query->num_rows() > 0)
			{
				$data['error_email'] = 'Пользователь с такой почтой уже существует';
				return $data;
			}

		}
	}

?>