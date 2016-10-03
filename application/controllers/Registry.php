<?php

    class Registry extends CI_Controller
    {

    	public function __construct()
		{
			parent::__construct();
			$this->load->model('news_model');
			$this->load->model('registry_model');
			$this->load->model('check_model');

		}

		public function check_login()
		{
			$subject = $this->input->post('login');
			$pattern = '/^[а-яА-ЯёЁa-zA-Z0-9_-]+$/';
			$check = $this->registry_model->check_login();
			if  (!preg_match($pattern, $subject))
        	{
        		$this->form_validation->set_message('check_login', 'Логин может состоять из букв латиницы и кирилицы, цифр, подчеркиваний и дефисов');
            	return FALSE;            	
        	}
        	elseif (isset($check))
        	{
        		$this->form_validation->set_message('check_login', 'Пользователь с таким логином уже существует!');
            	return FALSE;
        	}
        	else
        	{
            	return TRUE;
        	}
		}

		public function check_password()
		{
			$subject = $this->input->post('password');
			$pattern = '/^[а-яА-ЯёЁa-zA-Z0-9]+$/';
			if  (!preg_match($pattern, $subject))
        	{
        		$this->form_validation->set_message('check_password', 'Пароль может состоять из букв латиницы, кирилицы и цифр');
            	return FALSE;            	
        	}
        	else
        	{
        		return TRUE;
        	}
        }

		public function check_email()
		{
			$check = $this->registry_model->check_email();
			if  (isset($check))
        	{
            	$this->form_validation->set_message('check_email', 'Пользователь с такой почтой уже существует!');
            	return FALSE;
        	}
        	else
        	{
            	return TRUE;
        	}
		}

		public function view_form()
		{
			$this->load->view('form');
		}

        public function index()
        {
        	$check = $this->check_model->index();
        	if($check['checked'] == FALSE)
        	{
	     		$this->load->helper('form', 'url');
				$this->load->library('form_validation');
				$config = array(
							array(
								'field' => 'login',
								'label' => 'логин',
								'rules' => 'trim|required|min_length[3]|max_length[20]|callback_check_login',
								'errors' => array(
												'required' => 'Поле %s должно быть заполнено',
												'min_length' => 'Поле %s должно быть болье 3 символов',
												'max_length' => 'Поле %s должно быть не более 20 символов',
												),
								),

							array(
								'field' => 'password',
								'label' => 'пароль',
								'rules' => 'trim|required|min_length[5]|max_length[20]|callback_check_password',
								'errors' => array(
												'required' => 'Поле %s должно быть заполнено',
												'min_length' => 'Поле %s должно быть болье 5 символов',
												'max_length' => 'Поле %s должно быть не более 20 символов',
												),
								),

							array(
								'field' => 'password_confirm',
								'label' => 'подтверждение пароля',
								'rules' => 'trim|required|matches[password]',
								'errors' => array(
												'required' => 'Поле %s должно быть заполнено',
												'matches' => 'Вы ошиблись при подтверждении пароля'
												),
								),

							array(
								'field' => 'email',
								'label' => 'email',
								'rules' => 'trim|required|valid_email|callback_check_email',
								'errors' => array(
												'required' => 'Поле %s должно быть заполнено',
												'valid_email' => 'Вы ввели не корректный Email'
												),
								)
							);
				$this->form_validation->set_rules($config);
				if ($this->form_validation->run() === FALSE)
	        	{
	     			echo validation_errors();
		        }
		        else
		        {
		        	$this->registry_model->index();
		        	echo '<script>window.location.href ="/"</script>';
		        	//redirect('/', 'refresh');
		        }
			}
			else
			{
				echo 'Выйдети с текущего пользователя';
			}
		}
	}
?>
