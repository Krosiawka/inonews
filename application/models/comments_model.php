<?php
    class Comments_model extends CI_Model
    {

        public function __construct()
        {
            $this->load->database();
        }

        public function select($id_article)
        {
            $this->db->order_by('fk_id','desc');
        	$query = $this->db->get_where('comments', array('fn_idarticle' => $id_article));
            $data = $query->result_array();
            //Сильно нагружает сервер!!!
            // foreach ($data as $key => $comment_item)
            // {
            //     $query = $this->db->get_where('users', array('fk_id' => $comment_item['fn_iduser']));
            //     $data[$key]['login'] = ($query->row_array())['fc_login'];
            // }
            return $data;
        }

        public function insert($id_article, $id_user, $user)
        {
            $this->db->insert('comments',array('ft_text' => $this->input->post('text'), 'fn_iduser' => $id_user, 'fn_idarticle' => $id_article, 'fc_user' => $user));
            
            $query = $this->db->get_where('news', array('fk_id' => $id_article));
            $count = ($query->row_array())['fn_count_comments'] + 1;
            $this->db->update('news', array('fn_count_comments' => $count), array('fk_id' => $id_article) );
        }

        public function delete($id_comment, $data)
        {
            $query = $this->db->get_where('comments', array('fk_id' => $id_comment));
            $comment = $query->row_array();
            //проверяем что это либо владелец комментария либо администратор
            if (($data['id'] == $comment['fn_iduser']) or ($data['admin'] == TRUE))
            {
                $this->db->delete('comments', array('fk_id' => $id_comment) );
                $query = $this->db->get_where('news', array('fk_id' => $comment['fn_idarticle']));
                $count = ($query->row_array())['fn_count_comments'] - 1;
                $this->db->update('news', array('fn_count_comments' => $count), array('fk_id' => $comment['fn_idarticle']));
                return $comment['fn_idarticle']; 
            }

        }
        
        public function update($id_comment, $data)
        {
      
            $query = $this->db->get_where('comments', array('fk_id' => $id_comment));
            $comment = $query->row_array();
            //проверяем что это либо владелец комментария либо администратор
            if (($data['id'] == $comment['fn_iduser']) or ($data['admin'] == TRUE))
            {
                $this->db->update('comments', array('ft_text' => $this->input->post('text')),array('fk_id' => $id_comment));
                return $comment['fn_idarticle']; 
            }
        }

    }

?>