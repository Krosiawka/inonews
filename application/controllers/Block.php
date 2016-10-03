<?php

    class Block extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('check_model');
            $this->load->model('block_model');
        }

        public function index($id = NULL, $block = NULL)
        {
            $data = $this->check_model->index();
            $this->load->helper('url');

            if ($data['admin'] == TRUE)
            {
                $this->block_model->block($id, $block);

                $url = base_url().'index.php/users_list';
                //echo '<script>window.location.href ="'.$url.'"</script>';
                redirect($url, 'refresh');
            }

            //echo '<script>window.location.href ="/"</script>';
            redirect('/', 'refresh');

        }
    }
?>
