<?php
/**
*
*/
	class News_model extends CI_Model
	{

		public function __construct()
		{
			$this->load->database();
		}

		public function index($num, $offset, $id = FALSE)
		{
			if ($id === FALSE)
			{
				//$this->db->limit('5');
				$this->db->order_by('fk_id','desc');
				$query = $this->db->get('news', $num, $offset);
				return $query->result_array();
			}
			//$data['fc_slug'] = $slug;
			$query = $this->db->get_where('news', array('fk_id' => $id));
			return $query->row_array();

		}



		public function add_article($data)
		{
			$this->load->helper('url');
			$slug = url_title($this->input->post('title'), 'underscore'); //создание строки для запроса конкретной статьи в url
			$data['fc_title'] = htmlspecialchars($this->input->post('title'));
			$data['ft_text'] = $this->input->post('text');
			$data['fd_date'] = date("Y-m-d");
			$data['fc_slug'] = $slug;

			$this->db->insert('news', $data);//добавляем статью
			$query = $this->db->get_where('news', array('fc_title' => $data['fc_title']));
			$data['fk_id'] = ($query->row_array())['fk_id']; //вытаскиваем id для перехода на статью после создания

			//наращиваем счетчик статей у пользователя
			$query = $this->db->get_where('users', array('fk_id' => $data['fn_iduser']));
			$count = ($query->row_array())['fn_count_article'] + 1;
			$this->db->update('users', array('fn_count_article' => $count), array('fk_id' => $data['fn_iduser']) );
			return $data;
		}


		public function reader_articles($num, $offset, $id = NULL)
		{
			$this->db->order_by('fk_id','desc');
			$query = $this->db->get_where('news', array('fn_iduser' => $id), $num, $offset);
			return $query->result_array();
		}

		public function count_articles($id = NULL)
		{
			$query = $this->db->get_where('news', array('fn_iduser' => $id));
			return $query->num_rows();
		}
	}
?>
