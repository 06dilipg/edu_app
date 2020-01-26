<?php
class Course_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function get_courses(){
//		$query = $this->db->get('course');
        $sql = "select C.course_id,C.name,C.number_of_years,C.course_major_id,M.name as major,C.course_type_id ,T.name as type from course C
                inner join course_major M on C.course_major_id=M.course_major_id
                inner join course_type T on C.course_type_id=T.course_type_id";
        $query = $this->db->query($sql);
		$query_result = $query->result();
		return $query_result;
	}

    function get_courseMajors(){
        $query = $this->db->get('course_major');
        $query_result = $query->result();
        return $query_result;

    }

    function get_courseTypes(){
        $query = $this->db->get('course_type');
        $query_result = $query->result();
        return $query_result;
    }

    function insert_course($courseData){
        $this->db->insert('course', $courseData);
        return $this->db->insert_id();
    }

    function update_course($courseId,$data){
        $this->db->where('course_id', $courseId);
        return $this->db->update('course', $data);
    }

    function check_duplicate($courseName)
    {
        $query = $this->db->get_where('course',array('name ='=> $courseName));
        return $query->num_rows();

    }

    function update_check_course($courseName,$courseId)
    {
        $query = $this->db->get_where('course',array('name ='=> $courseName , 'course_id <>'=>$courseId));
        return $query->num_rows();
    }
}