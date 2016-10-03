<?php

    class About extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('check_model');
            $this->load->model('writers_model');
            $this->load->model('last_article_model');
        }

        public function index()
        {
            $data = $this->check_model->index();
            $data['writers'] = $this->writers_model->index();
            $data['last_article'] = $this->last_article_model->index();

            $this->load->helper('url');
            $this->load->view('templates/header', $data);
            $this->load->view('about_view');
            $this->load->view('templates/footer');

        }
    }
?>
