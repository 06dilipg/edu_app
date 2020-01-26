<?php
/**
 * Created by PhpStorm.
 * User: Onto Technologies
 * Date: 10/3/19
 * Time: 11:01 AM
 */

class Timetable_timing_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function insertTimetableTiming($data){
        $this->db->insert('timetable_timing', $data);
        return $this->db->insert_id();
    }


    public function updateTimetableTiming($timingId,$data){

        $this->db->where('timing_id', $timingId);
        return $this->db->update('timetable_timing', $data);

    }

    function deleteTimetableTiming($timingId)
    {
        $this->db->where('timing_id', $timingId);
        return $this->db->delete('timetable_timing');
    }

} 