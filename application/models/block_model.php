<?php
    class Block_model extends CI_Model
    {

        public function __construct()
        {
            $this->load->database();
        }

        public function block($id, $block)
        {
        	$this->db->update('users', array('fb_block' => $block, 'fc_hash' => NULL), array('fk_id' => $id) );

        }
    }

?>