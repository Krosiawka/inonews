<?php
	class Login_model extends CI_Model
	{

		public function __construct()
		{
			$this->load->database();
		}

		public function generateCode($length = 6)
		{
			# Функция для генерации случайной строки
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
			$code = "";
			$clen = strlen($chars) - 1;
			while (strlen($code) < $length) {
				$code .= $chars[mt_rand(0, $clen)];
			}
			return $code;
		}

		public function log_out()
		{
			$this->db->where(array('fk_id' => $_COOKIE['id'], 'fc_hash' => $_COOKIE['hash']));
			$this->db->update('users', array('fc_hash' => 'NULL')); //чистим хэш в базе
			//чистим куки пользователя
			setcookie("id", "", time() - 3600 * 24 * 30 * 12, "/");
            setcookie("hash", "", time() - 3600 * 24 * 30 * 12, "/");
            setcookie("user_name", "", time() - 3600 * 24 * 30 * 12, "/");
		}


		public function check_login()
		{
			$query = $this->db->get_where('users', array('fc_login' => $this->input->post('login')));
			if ($query->num_rows() == 0)
			{
				$error = "Такого пользователя не существует";
			}
			elseif ($query->row_array()['fb_block'])
			{
				$error = 'Пользователь заблокирован';
			}
			if (isset($error)) return $error;
		}

		public function check_password()
		{
			$query = $this->db->get_where('users', array('fc_login' => $this->input->post('login')));
			$data = $query->row_array();
			if (!password_verify($this->input->post('password'), $data['fc_password']))
			{
				$error = "Вы ввели неправильный пароль";
				return $error;
			}

		}

		public function index()
		{
			ob_start();
			$login = $this->input->post('login');
			$password = $this->input->post('password');
			//Вытаскиваем из БД запись, у которой логин равняеться введенному
			$query = $this->db->get_where('users', array('fc_login' => $login));
				$data = $query->row_array();
					# Генерируем случайное число и шифруем его
					$options = [
						'cost' => 11,
						//'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
					];
					$hash = password_hash($this->generateCode(10), PASSWORD_BCRYPT, $options);

					$this->db->where('fc_login', $login);
					$this->db->update('users', array('fc_hash' => $hash));
					#Ставим куки
					if ($this->input->post('remember') != NULL) //если пользователь поставил галочку запомнить меня, устанавливаем куки на месяц
					{
						setcookie("id", $data['fk_id'], time() + 60 * 60 * 24 * 30, '/');
						setcookie("user_name", $login, time() + 60 * 60 * 24 * 30, '/');
						setcookie("hash", $hash, time() + 60 * 60 * 24 * 30, '/');
					}
					else //если галочка запомнить меня не выбранна куки будут жить до закрытия браузера
					{
						setcookie("id", $data['fk_id'], 0, '/');
						setcookie("user_name", $login, 0, '/');
						setcookie("hash", $hash, 0, '/');
					}
					ob_get_clean();
		}
	}
?>
