<?php

    class Comments extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('check_model');
            $this->load->model('comments_model');
            $this->load->helper('url');
        }

        public function delete($id_comment)
        {
            $data = $this->check_model->index();
            if ($data['checked'] == TRUE)
            {
                $id_article = $this->comments_model->delete($id_comment, $data);
                $url = base_url().'index.php/article/'.$id_article;
                //echo '<script>window.location.href ="'.$url.'"</script>';
                redirect($url, 'refresh');
            }
        }

        public function update($id_comment)
        {
            $data = $this->check_model->index();
            if ($data['checked'] == TRUE)
            {
                $id_article = $this->comments_model->update($id_comment, $data);
                $url = base_url().'index.php/article/'.$id_article;
                echo '<script>window.location.href ="'.$url.'"</script>';
                //redirect($url, 'refresh');
            }
        }

    }
?>
