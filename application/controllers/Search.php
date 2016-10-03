<?php
    class Search extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('search_model');
            $this->load->helper('url');
            $this->load->model('check_model');
            $this->load->model('writers_model');
            $this->load->model('last_article_model');
        }

        public function index()
        {   

            $data = $this->search_model->index($this->input->post('search'));
            if (isset($data))
            {
                $url = base_url().'index.php/article/'.$data['fk_id'];
                echo '<script>window.location.href ="'.$url.'"</script>';
                //redirect($url, 'refresh');
            }
            echo '<script> alert(\'Ничего не найдено\'); </script>';
            echo '<script>window.location.href ="/"</script>';
            //redirect('/', 'refresh');

        }

    }
?>
