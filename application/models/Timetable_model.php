<?php
/**
 * Created by PhpStorm.
 * User: Onto Technologies
 * Date: 10/3/19
 * Time: 11:01 AM
 */

class Timetable_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getCurrentWeekTimetable($course_batch_id,$batch_year_id)
    {

        $sql = "select t.*,DATE_FORMAT(t.date, '%d-%b-%Y') as timetable_date,time_format(tt.start_time, '%H:%i') as start_time,time_format(tt.end_time, '%H:%i') as end_time,time_format(tt.start_time, '%h:%i %p'),time_format(tt.end_time, '%h:%i %p'),tt.type,U.first_name,U.last_name,S.name as subjectName from timetable t
                inner join timetable_timing tt on t.timing_id=tt.timing_id
				left outer join user U on U.user_id=t.faculty_id
				left outer join subject S on S.subject_id=t.subject_id
                where t.course_batch_id=".$course_batch_id." and t.batch_year_id=".$batch_year_id."
                and date(t.date) >= DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)
				and date(t.date) < DATE_ADD(CURDATE(), INTERVAL (9 - IF(DAYOFWEEK(CURDATE())=1, 8, DAYOFWEEK(CURDATE()))) DAY)
				order by tt.start_time,t.day";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getNextWeekTimetable($course_batch_id,$batch_year_id)
    {

        $sql = "select t.*,DATE_FORMAT(t.date, '%d-%b-%Y') as timetable_date,time_format(tt.start_time, '%H:%i') as start_time,time_format(tt.end_time, '%H:%i') as end_time,time_format(tt.start_time, '%h:%i %p'),time_format(tt.end_time, '%h:%i %p'),tt.type,U.first_name,U.last_name,S.name as subjectName from timetable t
                inner join timetable_timing tt on t.timing_id=tt.timing_id
				left outer join user U on U.user_id=t.faculty_id
				left outer join subject S on S.subject_id=t.subject_id
                where t.course_batch_id=".$course_batch_id." and t.batch_year_id=".$batch_year_id."
                and date(t.date) >= DATE_ADD(CURDATE(), INTERVAL (9 - IF(DAYOFWEEK(CURDATE())=1, 8, DAYOFWEEK(CURDATE()))) DAY)
                order by tt.start_time,t.day";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getUserTimeTable($userId){
        $sql="select   t.timetable_id,t.day,C.name,Y.batch_year,CB.batch_name,CB.course_batch_id,S.name as subjectName,DATE_FORMAT(t.date, '%d-%b-%Y') as timetable_date,time_format(tt.start_time, '%h:%i %p') as startTime,time_format(tt.end_time, '%h:%i %p') as endTime,U.first_name,U.last_name
    	 		from timetable t
				inner join timetable_timing tt on t.timing_id=tt.timing_id
				inner join course_batch CB on t.course_batch_id=CB.course_batch_id
				inner join batch_year Y on t.batch_year_id=Y.batch_year_id
				inner join course C on CB.course_id=C.course_id
				left outer join user U on U.user_id=t.faculty_id
				left outer join subject S on S.subject_id=t.subject_id
				where t.faculty_id=".$userId."  and t.date >= CURDATE()  order by t.date,tt.start_time";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getUserTimeTableByTimeTableId($userId,$timeTableId){
        $sql="select   t.timetable_id,t.day,C.name,Y.batch_year,CB.batch_name,CB.course_batch_id,S.name as subjectName,t.date,DATE_FORMAT(t.date, '%d-%b-%Y') as timetable_date,time_format(tt.start_time, '%h:%i %p') as startTime,time_format(tt.end_time, '%h:%i %p') as endTime,U.first_name,U.last_name
    	 		from timetable t
				inner join timetable_timing tt on t.timing_id=tt.timing_id
				inner join course_batch CB on t.course_batch_id=CB.course_batch_id
				inner join batch_year Y on t.batch_year_id=Y.batch_year_id
				inner join course C on CB.course_id=C.course_id
				left outer join user U on U.user_id=t.faculty_id
				left outer join subject S on S.subject_id=t.subject_id
				where t.faculty_id=".$userId." and t.timetable_id=".$timeTableId."  and t.date >= CURDATE()  order by t.date,tt.start_time";
        $query = $this->db->query($sql);
        return $query->row();
    }

    function getCurrentWeekMonday(){
        $sql="SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY) as THIS_MONDAY";
        $query = $this->db->query($sql);
        return $query->row()->THIS_MONDAY;
    }

    function getNextWeekMonday(){
        $sql="SELECT DATE_ADD(CURDATE(), INTERVAL (9 - IF(DAYOFWEEK(CURDATE())=1, 8, DAYOFWEEK(CURDATE()))) DAY) AS NEXT_MONDAY";
        $query = $this->db->query($sql);
        return $query->row()->NEXT_MONDAY;
    }

    public function insertTimetable($data){
        $this->db->insert('timetable', $data);
        return $this->db->insert_id();
    }


    public function updateTimetable($timetableId,$data){

        $this->db->where('timetable_id', $timetableId);
        return $this->db->update('timetable', $data);

    }

//    function deleteTimetable($course_batch_id,$batch_year_id)
//    {
//        $sql = "delete t,tt from timetable t
//                inner join timetable_timing tt on t.timing_id=tt.timing_id
//                where t.course_batch_id=".$course_batch_id." and t.batch_year_id=".$batch_year_id;
//        $this->db->query($sql);
////        $query = $this->db->query($sql);
////        return $query->result();
//    }

    function OFF_SQL_SAFE_UPDATES(){
        $sql = "SET SQL_SAFE_UPDATES=0";
        $this->db->query($sql);
    }

    function ON_SQL_SAFE_UPDATES(){
        $sql = "SET SQL_SAFE_UPDATES=1";
        $this->db->query($sql);
    }
} 