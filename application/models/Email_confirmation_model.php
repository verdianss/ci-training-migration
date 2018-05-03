<?php
class Email_confirmation_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'email_confirmations';
    }
    
    public function getdata() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function insert($data = array()) {
        $data['expired'] = time() + 86400;
        $data['created'] = time();
        $insert = $this->db->insert($this->table, $data);
        if($insert){
            return $this->db->insert_id();
        }
    }
}