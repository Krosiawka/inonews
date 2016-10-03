<?php

    class Login extends CI_Controller
    {
    	public function __construct()
		{
			parent::__construct();
			$this->load->model('login_model');
			$this->load->model('news_model');
			$this->load->model('check_model');
			//$data = $this->check_model->index();
		}

		public function check_login()
		{
			$subject = $this->input->post('login');
			$pattern = '/^[а-яА-ЯёЁa-zA-Z0-9_-]+$/';
			$check = $this->login_model->check_login();
			if  (!preg_match($pattern, $subject))
        	{
        		$this->form_validation->set_message('check_login', 'Логин может состоять из букв латиницы и кирилицы, цифр, подчеркиваний и дефисов');
            	return FALSE;            	
        	}
        	elseif (isset($check))
        	{
        		$this->form_validation->set_message('check_login',  $check);
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
			$check = $this->login_model->check_password();
			if  (!preg_match($pattern, $subject))
        	{
        		$this->form_validation->set_message('check_password', 'Пароль может состоять из букв латиницы, кирилицы и цифр');
            	return FALSE;            	
        	}
        	elseif (isset($check))
        	{
            	$this->form_validation->set_message('check_password', $check);
            	return FALSE;
        	}
        	else
        	{
        		return TRUE;
        	}
        }

        public function index($modal = NULL)
        {
        	$check = $this->check_model->index();
        	if ($check['checked'] == FALSE)
        	{	
				$this->load->helper('form');
				$this->load->library('form_validation');
				$config = array(
							array(
								'field' => 'login',
								'label' => 'логин',
								'rules' => 'trim|required|min_length[3]|max_length[20]|callback_check_login',
								'errors' => array(
												'required' => 'Поле %s должно быть заполнено',
												'min_length' => 'Поле %s должно быть не менее 3 символов',
												'max_length' => 'Поле %s должно быть не более 20 символов',
												),
								),

							array(
								'field' => 'password',
								'label' => 'пароль',
								'rules' => 'trim|required|min_length[5]|max_length[20]|callback_check_password',
								'errors' => array(
												'required' => 'Поле %s должно быть заполнено',
												'min_length' => 'Поле %s должно быть не менее 5 символов',
												'max_length' => 'Поле %s должно быть не более 20 символов',
												),
								),

						);

				$this->form_validation->set_rules($config);
				if ($this->form_validation->run() === FALSE)
				{
	                if (isset($modal))
	                    echo validation_errors();
	                else
					    $this->load->view('login_view');
				}
				else
				{
					$this->login_model->index();
					echo "<script>window.location.href = '/';</script>";
	       		}
       		}
       		else
       		{
       			echo "Пользователь уже авторизован!";
       		}
    	}

    	public function log_out()
    	{
    		$this->login_model->log_out();
			echo "<script>window.location.href = '/';</script>";
    	}	
    }
?>
