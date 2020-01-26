<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 1/6/20
 * Time: 10:17 AM
 */

class Attendance_model  extends CI_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getAttendanceByTimetableId($timetableId){
        $query = $this->db->get_where('attendance',array('timetable_id'=>$timetableId));
        $query_result = $query->row();
        return $query_result;
    }

    public function insertAttendance($attendance){
        $this->db->insert('attendance', $attendance);
        return $this->db->insert_id();
    }

    public function updateAttendance($attendanceId,$data){

        $this->db->where('attendance_id', $attendanceId);
        return $this->db->update('attendance', $data);

    }
} 