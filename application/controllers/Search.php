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

        public function index($search = null, $asd = NULL)
        {   

            //$interenc = mb_internal_encoding();mb_internal_encoding();
            //mb_convert_variables(mb_internal_encoding(), "cp-1251", $search);
            $search = urldecode($search);
            $data = $this->check_model->index();
            if ($this->input->get('search'))
                $search = $this->input->get('search');
            $data['count'] =($this->search_model->index($search,'',''))->num_rows();;
  
//echo $search;
echo ($this->input->get('search'));
            if ($data['count'] > 0)
            {
                    
                    $data['writers'] = $this->writers_model->index();
                    $data['last_article'] = $this->last_article_model->index();

                    //настройка pagination
                    $config['base_url'] = base_url().'index.php/search/'.$search;
                    $config['total_rows'] = $data['count']; //всего записей в таблице
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
        //          $config['display_pages'] = FALSE;
                    $config['cur_tag_open'] = '<li><a><font color="black">';
                    $config['cur_tag_close'] = '</font></a></li>';
                    $config['next_tag_open'] = '<li>';
                    $config['next_tag_close'] = '<a</li>';
                    $config['prev_tag_open'] = '<li>';
                    $config['prev_tag_close'] = '</li>';
                    //$config['uri_segment'] = 3;

                    $this->pagination->initialize($config);

                    $data['news'] = ($this->search_model->index($search,$config['per_page'],$this->uri->segment(3)))->result_array();

                    //print_r($data['news']);
                    $this->load->view('templates/header',$data);
                    $this->load->view('news/index', $data);
                    $this->load->view('templates/footer');

            }
            else
            {
                //echo '<script> alert(\'Ничего не найдено\'); </script>';
                //echo '<script>window.location.href ="/"</script>';
            //redirect('/', 'refresh');

            }

        }

    }
?>
