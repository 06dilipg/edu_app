<?php


class User_type_model extends  CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function get_userTypes(){
        $query = $this->db->get('user_type');
        $query_result = $query->result();
        return $query_result;
    }

    function get_userTypeById($userTypeId){
        $this->db->where('user_type_id', $userTypeId);
        $query = $this->db->get('user_type');
        $query_result = $query->result();
        return $query_result;
    }
}