<?php
/**
 * Created by PhpStorm.
 * User: Onto Technologies
 * Date: 8/23/19
 * Time: 5:08 PM
 */

class Batch_year_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function get_batchYear(){
//        $query = $this->db->get('batch_year');
        $sql = "select Y.batch_year_id as batchYearId, Y.course_batch_id as courseBatchId,CB.batch_name as batchName,C.course_id as courseId,C.name as courseName, Y.batch_year as batchYear,Y.no_of_working_days as workingDays,
                DATE_FORMAT(Y.start_date, '%W, %M %e, %Y') as startDate,DATE_FORMAT(Y.end_date, '%W, %M %e, %Y') as endDate,Y.start_date,Y.end_date
                from batch_year Y inner join course_batch CB on Y.course_batch_id=CB.course_batch_id
                inner join course C on C.course_id=CB.course_id";
        $query = $this->db->query($sql);
        $query_result = $query->result();
        return $query_result;
    }

    function get_batchYearByYearId($batchYearId){

        $sql = "select Y.batch_year_id as batchYearId, Y.course_batch_id as courseBatchId,CB.batch_name as batchName,C.course_id as courseId,C.name as courseName, Y.batch_year as batchYear,Y.no_of_working_days as workingDays,
                DATE_FORMAT(Y.start_date, '%W, %M %e, %Y') as startDate,DATE_FORMAT(Y.end_date, '%W, %M %e, %Y') as endDate,Y.start_date,Y.end_date
                from batch_year Y inner join course_batch CB on Y.course_batch_id=CB.course_batch_id
                inner join course C on C.course_id=CB.course_id where Y.batch_year_id=".$batchYearId;
        $query = $this->db->query($sql);
        $query_result = $query->row_array();
        return $query_result;
    }

    function get_current_batchYear(){

        $sql = "select Y.batch_year_id as batchYearId, Y.course_batch_id as courseBatchId,CB.batch_name as batchName,C.course_id as courseId,C.name as courseName, Y.batch_year as batchYear,Y.no_of_working_days as workingDays,
DATE_FORMAT(Y.start_date, '%W, %M %e, %Y') as startDate,DATE_FORMAT(Y.end_date, '%W, %M %e, %Y') as endDate,Y.start_date,Y.end_date
from batch_year Y inner join course_batch CB on Y.course_batch_id=CB.course_batch_id
inner join course C on C.course_id=CB.course_id
where CURDATE() between Y.start_date and Y.end_date";
        $query = $this->db->query($sql);
        $query_result = $query->result();
        return $query_result;
    }

    function get_batchYearByBatchId($courseBatchId){
//        $query = $this->db->get('batch_year');
        $sql = "select Y.batch_year_id as batchYearId, Y.course_batch_id as courseBatchId,CB.batch_name as batchName,C.course_id as courseId,C.name as courseName, Y.batch_year as batchYear,Y.no_of_working_days as workingDays,
                DATE_FORMAT(Y.start_date, '%W, %M %e, %Y') as startDate,DATE_FORMAT(Y.end_date, '%W, %M %e, %Y') as endDate,Y.start_date,Y.end_date
                from batch_year Y inner join course_batch CB on Y.course_batch_id=CB.course_batch_id
                inner join course C on C.course_id=CB.course_id where Y.course_batch_id=".$courseBatchId;
        $query = $this->db->query($sql);
        $query_result = $query->result();
        return $query_result;
    }

    function insert_batchYear($batch){
        $this->db->insert('batch_year', $batch);
        return $this->db->insert_id();
    }

    function update_batchYear($batchYearId,$data){
        $this->db->where('batch_year_id', $batchYearId);
        return $this->db->update('batch_year', $data);

    }

    function check_duplicate($batchYear,$courseBatchId)
    {
        $query = $this->db->get_where('batch_year',array('batch_year ='=> $batchYear,'course_batch_id ='=> $courseBatchId));
        return $query->num_rows();

    }

    function update_check_batchYear($batchYear,$courseBatchId,$batchYearId)
    {
        $query = $this->db->get_where('batch_year',array('batch_year ='=> $batchYear,'course_batch_id ='=> $courseBatchId, 'batch_year_id <>'=>$batchYearId));
        return $query->num_rows();
    }

} 