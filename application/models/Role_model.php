<?php


class Role_model extends  CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function get_roles(){
        $query = $this->db->get('role');
        $query_result = $query->result();
        return $query_result;
    }

    function getRoleByUserId($userId){


        $sql = "select R.* from role R
                inner join user_role UR on R.role_id=UR.role_id
                where UR.user_id=".$userId;
        $query = $this->db->query($sql);
        $query_result = $query->result();
        return $query_result;
    }



} 