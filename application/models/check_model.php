<?php
    class Check_model extends CI_Model
    {

        public function __construct()
        {
            $this->load->helper('cookie');
            $this->load->database();
        }

        public function index()
        {
            $data['checked'] = FALSE;
            $data['admin'] = FALSE;
            $data['id'] = '-1';
            if (get_cookie('id') and get_cookie('hash'))
            {
                $query = $this->db->get_where('users', array('fk_id' => $_COOKIE['id'])); //находим пользователя по id кукис
                $userdata = $query->row_array();
                //проверяем пользователя на блокировку и сравниваем хэш, проверка id не нужна так как мы по id вытащили данные
                if (($userdata['fc_hash'] !== $_COOKIE['hash']) or ($userdata['fk_id'] !== $_COOKIE['id']) or ($userdata['fb_block'] == TRUE))
                {
                    //setcookie("id", "", time() - 3600 * 24 * 30 * 12, "/");
                    //setcookie("hash", "", time() - 3600 * 24 * 30 * 12, "/");
                    $data['error'] = 'Пользователь не авторизован!';
                }
                else
                {
                    $data['checked'] = TRUE;
                    if ($userdata['fb_superuser'] == TRUE) $data['admin'] = TRUE;
                    $data['id'] = $userdata['fk_id'];
                    $data['login'] = $userdata['fc_login'];
                    $data['name'] = $userdata['fc_name'];
                    $data['surename'] =  $userdata['fc_surename'];
                }
            }
            else
            {
                $data['error'] = "Включите cookies!";
            }
            return $data;
        }
    }

?>
