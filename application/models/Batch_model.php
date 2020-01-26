<?php
/**
 * Created by PhpStorm.
 * User: Onto Technologies
 * Date: 8/17/19
 * Time: 12:18 PM
 */

class Batch_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function get_batch(){
        $query = $this->db->get('course_batch');
        $query_result = $query->result();
        return $query_result;
    }

    function get_course_batch($courseId){
        $sql = "select CB.course_batch_id,CB.course_id,C.name as courseName,CB.batch_name as batchName,section,DATE_FORMAT(CB.start_date, '%W, %M %e, %Y') as startDate,DATE_FORMAT(CB.end_date, '%W, %M %e, %Y') as endDate
                ,CB.start_date,CB.end_date from course_batch CB inner join course C on C.course_id=CB.course_id
                where CB.course_id=".$courseId;
        $query = $this->db->query($sql);
        $query_result = $query->result();
        return $query_result;
    }


    function insert_batch($batch){
        $this->db->insert('course_batch', $batch);
        return $this->db->insert_id();
    }

    function update_batch($batchId,$data){
        $this->db->where('course_batch_id', $batchId);
        return $this->db->update('course_batch', $data);

    }

} 