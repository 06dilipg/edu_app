<?php

class Category_model extends CI_Model{
     function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_subCategory($id){

        $this->db->where('category_id',$id);
        $query = $this->db->get('sub_category');
        return $query;

    }




}