<?php
    class Users_list extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('users_list_model');
            $this->load->model('check_model');
            $this->load->model('writers_model');
            $this->load->model('last_article_model');
            $this->load->helper('url');
        }

        public function index()
        {
            $data = $this->check_model->index();
            if ($data['admin'] == TRUE)
            {
                $data['users'] = $this->users_list_model->index($data['id']);

                $data['writers'] = $this->writers_model->index();
                $data['last_article'] = $this->last_article_model->index();            
                
                $this->load->view('templates/header',$data);
                $this->load->view('users_list_view', $data);
                $this->load->view('templates/footer');
            }
            else
                echo '<script>window.location.href ="/"</script>';
            
        }

    }
?>
