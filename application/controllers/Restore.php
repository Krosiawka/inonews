<?php
    class Restore extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('restore_model');
            $this->load->helper('string');
            $this->load->helper('url');

        }

        public function restore($modal = NULL)
        {
          $this->load->helper('form');
          $this->load->library('form_validation');
          $config = array(
                          array(
                              'field' => 'email',
                              'label' => 'email',
                              'rules' => 'trim|required|valid_email',
                              'errors' => array(
                                      'required' => 'Поле %s должно быть заполнено',
                                      'valid_email' => 'Вы ввели не корректный %s'
                                                ),
                                ),
                          );
          $this->form_validation->set_rules($config);
          if ($this->form_validation->run() === FALSE)
          {
            if (isset($modal))
              echo validation_errors();
            else
              $this->load->view('restore_view');
          }
          else
          {
            $data = $this->restore_model->check($this->input->post('email')); //проверка существования email
            if (isset($data['fc_email']))
            {

              $capctha = random_string('alnum', 20);//формирование строки доступа к смене пароля 

              //отправка письма
              $to  = $data['fc_email'];
              $this->load->library('email');
              // $config['protocol'] = 'smtp';
              // $config['smtp_host'] = 'smtp.mail.ru'; //Адрес SMTP-сервера.
              // $config['smtp_user'] = 'v_paliy@inbox.ru'; //SMTP логин.
              // $config['smtp_pass'] = 'XXX'; //SMTP пароль.
              // $config['smtp_port'] = '465'; //SMTP порт.
              // $config['smtp_timeout'] = '5';//SMTP тайм-аут (в секундах).
              //$config['mailpath'] = '../../modules/sendmail';
              $config['wordwrap'] = TRUE;
              //$config['mailtype'] = 'html';
              $this->email->initialize($config);

              $this->email->from('v_paliy@inbox.ru', 'Paliy');
              $this->email->to($to);
              $this->email->subject('Восстановление пароля');
              $this->email->message('Если вы не заказывали смену пароля на сайте InoNews.ru, то проигнарируйте данное письмо. Перейдите по ссылке что бы сменить пароль на сайте InoNews.ru: '.base_url().'index.php/new_password/'.$capctha);
              if (!$this->email->send())
                $error = 'Не получилось отправиль письмо на указанный email';
              else
              {
                $error = 'Письмо отправленно на указаный Email';
                //конец блока
                $this->restore_model->insert($data['fc_login'],$capctha); //сохраняем в базе сформированную строку
                echo $error;
              }
            }
            else
            {
              $error = 'Такой пользователь не существует';
              if (isset($modal))
                echo $error;
              else
              $this->load->view('restore_view', $error);
            }
          }
        }

        public function new_password($restore_str)
        {
          $data = $this->restore_model->select($restore_str);
          if (isset($data))
          {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $config = array(
                            array(
                              'field' => 'password',
                              'label' => 'пароль',
                              'rules' => 'trim|required|min_length[4]|max_length[20]',
                              'errors' => array(
                                      'required' => 'Поле %s должно быть заполнено',
                                      'min_length' => 'Поле %s должно быть болье 4 символов',
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

                            );

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() === FALSE)
            {
              $this->load->view('new_password_view');
            }
            else
            {
              $this->restore_model->update($data['fc_login'],$this->input->post('password'));
              //echo '<script>window.location.href ="/"</script>';
              redirect('/', 'refresh');
            }
          }
          else
            show_404();
        }
    }
?>
