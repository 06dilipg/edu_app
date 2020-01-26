<?php
/**
 * Created by PhpStorm.
 * User: Onto Technologies
 * Date: 8/24/19
 * Time: 11:26 AM
 */

class Subject_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function get_subject($batchYearId){
        $sql = "select S.subject_id,S.code,S.name,S.batch_year_id,C.name as courseName,CB.batch_name as batchName,Y.batch_year,S.type_id,ST.subject_type_name,S.description,S.internal from subject S
                inner join subject_type ST on ST.subject_type_id=S.type_id
                inner join batch_year Y on S.batch_year_id= Y.batch_year_id
                inner join course_batch CB on Y.course_batch_id=CB.course_batch_id
                inner join course C on C.course_id=CB.course_id
                where S.batch_year_id=".$batchYearId;
        $query = $this->db->query($sql);
        $query_result = $query->result();
        return $query_result;
    }

    function get_subjectType(){
        $query = $this->db->get('subject_type');
        $query_result = $query->result();
        return $query_result;
    }

    function insert_subject($data){
        $this->db->insert('subject', $data);
        return $this->db->insert_id();
    }

    function update_batch($subjectId,$data){
        $this->db->where('subject_id', $subjectId);
        return $this->db->update('subject', $data);

    }

    function check_duplicate($subjectName,$batchYearId)
    {
        $query = $this->db->get_where('subject',array('name ='=> $subjectName,'batch_year_id ='=> $batchYearId));
        return $query->num_rows();

    }

    function update_check_subject($subjectName,$batchYearId,$subjectId)
    {
        $query = $this->db->get_where('subject',array('name ='=> $subjectName,'batch_year_id ='=> $batchYearId, 'subject_id <>'=>$subjectId));
        return $query->num_rows();
    }



} 