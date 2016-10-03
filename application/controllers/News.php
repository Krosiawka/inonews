<?php
ob_start();
	class News extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('news_model');
			$this->load->helper('url');
			$this->load->model('check_model');
			$this->load->model('writers_model');
			$this->load->model('last_article_model');
			$this->load->model('comments_model');
		}

		public function index()
		{
			$data = $this->check_model->index();

			$data['writers'] = $this->writers_model->index();
			$data['last_article'] = $this->last_article_model->index();
			//настройки pagination
 			$config['base_url'] = base_url().'index.php/news/index';
			$config['total_rows'] = $this->db->count_all('news'); //всего записей в таблице
			$config['per_page'] = '10'; //сколько записей на странице
			$config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['first_link'] = 'Первая';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'Последняя';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = 'Далее';
			$config['prev_link'] = 'Назад'; 
//			$config['display_pages'] = FALSE;
			$config['cur_tag_open'] = '<li><a><font color="black">';
			$config['cur_tag_close'] = '</font></a></li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '<a</li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';

			$this->pagination->initialize($config);

			$data['news'] = $this->news_model->index($config['per_page'],$this->uri->segment(3));			
			//нагружает сервер
			// foreach ($data['news'] as $key => $news_item)
			// {
			// 	$tmp = $this->news_model->reader_info($data['news'][$key]['fn_iduser']);
			//  $data['news'][$key]['name'] = $tmp['fc_name'];
			// 	$data['news'][$key]['surename'] = $tmp['fc_surename'];
			// }
			$this->load->view('templates/header',$data);
			$this->load->view('news/index',$data);
			$this->load->view('templates/footer');

		}

		public function article($id_article)
		{

			$data = $this->check_model->index();

			$data['news'] = $this->news_model->index('','',$id_article);
			if (empty($data['news']))
			{
				show_404();
			}
			$data['writers'] = $this->writers_model->index();
			$data['last_article'] = $this->last_article_model->index();
			$data['comments'] = $this->comments_model->select($data['news']['fk_id']);
			$data['count'] = count($data['comments']);

                $this->load->library('form_validation');
                $config = array(
                                array(
                                    'field' => 'text',
                                    'label' => 'текст комментария',
                                    'rules' => 'required',
                                    'errors' => array(
                                                    'required' => 'Поле %s должно быть заполнено',
                                                    )
                                    )

                                );

                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() === FALSE)
                {
                 	$this->load->view('templates/header', $data);
					$this->load->view('news/article_view', $data);
					$this->load->view('templates/footer');    	  
                }
                else
                {
                	if ($data['checked'] == TRUE)
            		{
	                    $this->comments_model->insert($id_article, $data['id'], $data['login']);
	                    $url = base_url().'index.php/article/'.$id_article;
	                    echo '<script>window.location.href ="'.$url.'"</script>';
					}
					else
            		{
                		echo 'Вы не авторизованный пользователь';
            		}    
                }
            

		}

		public function add_article()
		{
			$this->load->helper('form');
			$check_aut = $this->check_model->index();

			if (($check_aut['checked'] == TRUE) and ($check_aut['admin'] == TRUE))
			{
				$this->load->library('form_validation');
				$config = array(
								array(
									'field' => 'title',
									'label' => 'название статьи',
									'rules' => 'required|max_length[100]',
									'errors' => array(
													'required' => 'Поле %s должно быть заполнено',
													'max_length' => 'Поле %s должно быть не более 100 символов',
													),
									),

								array(
									'field' => 'text',
									'label' => 'текст статьи',
									'rules' => 'required',
									'errors' => array(
												'required' => 'Поле %s должно быть заполнено',
													),
									)

								);

				$this->form_validation->set_rules($config);
				if ($this->form_validation->run() === FALSE)
				{
					$data = $this->check_model->index();
					$data['writers'] = $this->writers_model->index();
					$data['last_article'] = $this->last_article_model->index();

					$this->load->view('templates/header', $data);
					$this->load->view('news/add_article_view');
					$this->load->view('templates/footer');

				}
				else
				{
					$data['fc_img'] = '1';
					if (!empty($_FILES['userfile']['name']))
					{
						//начало блока добавления картинки и миниатюры
						$config['upload_path'] = './images/' ;
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size'] = 30048; //почти 30 Мб
						$config['max_width'] = 10000; //10000px 
						$config['max_height'] = 10000;
						$config['encrypt_name'] = TRUE;
						$config['remove_spaces'] = TRUE;

						$this->load->library('upload',$config);
						$this->upload->do_upload();
						$tmp = $this->upload->data();

						$config['image_library'] = 'gd2'; // выбираем библиотеку
						$config['source_image']	= $tmp['full_path'];
						$config['create_thumb'] = TRUE; // ставим флаг создания эскиза
						$config['maintain_ratio'] = TRUE; // сохранять пропорции
						$config['width']	= 200; //  и задаем размеры
						$config['height']	= 150;
						$config['new_image'] = APPPATH.'../images/thumbs';
						$config['master_dim'] = 'height';
						$config['thumb_marker'] = '';
						$this->load->library('image_lib', $config); // загружаем библиотеку
						$this->image_lib->resize(); // и вызываем функцию
						//конец добавления картинки и миниатюры
						$data['fc_img'] = $tmp['file_name'];//$this->upload->data()['file_name'];
					}

					$data['fn_iduser'] = $check_aut['id'];
					$data['fc_name_writer'] = $check_aut['name'];
					$data['fc_surename_writer'] = $check_aut['surename'];
					$data = $this->news_model->add_article($data);

					$url = base_url().'index.php/article/'.$data['fk_id'];
                	echo '<script>window.location.href ="'.$url.'"</script>';
				}
			}
			else

				echo 'Вы не администратор!';

			}

			public function writer_articles($id)
			{
				$data = $this->check_model->index();
					$data['writers'] = $this->writers_model->index();
					$data['last_article'] = $this->last_article_model->index();
					$data['count_articles'] = $this->news_model->count_articles($id);
					//настройка pagination
	 				$config['base_url'] = base_url().'index.php/reader_articles/'.$id;
					$config['total_rows'] = $data['count_articles']; //всего записей в таблице
					//$config['num_links'] = 0;
					$config['per_page'] = '10'; //сколько записей на странице
					//настройка визуальной части pagination
					$config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
					$config['full_tag_close'] = '</ul></div>';
					$config['num_tag_open'] = '<li>';
					$config['num_tag_close'] = '</li>';
					$config['first_link'] = 'Первая';
					$config['first_tag_open'] = '<li>';
					$config['first_tag_close'] = '</li>';
					$config['last_link'] = 'Последняя';
					$config['last_tag_open'] = '<li>';
					$config['last_tag_close'] = '</li>';
					$config['next_link'] = 'Далее';
					$config['prev_link'] = 'Назад';
		//			$config['display_pages'] = FALSE;
					$config['cur_tag_open'] = '<li><a><font color="black">';
					$config['cur_tag_close'] = '</font></a></li>';
					$config['next_tag_open'] = '<li>';
					$config['next_tag_close'] = '<a</li>';
					$config['prev_tag_open'] = '<li>';
					$config['prev_tag_close'] = '</li>';

					$this->pagination->initialize($config);

					$data['news'] = $this->news_model->reader_articles($config['per_page'],$this->uri->segment(3), $id);
					$this->load->view('templates/header',$data);
					$this->load->view('news/index', $data);
					$this->load->view('templates/footer');
					
			}
		}
?>
