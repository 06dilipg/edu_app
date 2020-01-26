<?php
/**
 * Created by PhpStorm.
 * User: Onto Technologies
 * Date: 4/11/19
 * Time: 11:27 AM
 */

class User_model extends  CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getAllUsers(){
//        $query = $this->db->get('user');
        $sql = "SELECT U.user_id,U.unique_id,first_name,last_name,mobile_no,email_address,U.user_type_id,UT.type as user_type,U.status,U.photo
                FROM user U inner join user_type UT on UT.user_type_id=U.user_type_id";
        $query = $this->db->query($sql);
        return $query->result();
    }


    public function getStudentsByCourseBatchId($courseBatchId){
        $sql = "select U.user_id,U.first_name,U.last_name,CB.batch_name,Y.batch_year,Y.batch_year_id from user U
                inner join user_course UC on U.user_id=UC.user_id
                inner join course_batch CB on CB.course_batch_id=UC.course_batch_id
                inner join batch_year Y on Y.course_batch_id=CB.course_batch_id
                where Y.batch_year_id=(select batch_year_id from batch_year where  course_batch_id=".$courseBatchId." and CURDATE() between start_date and end_date)
                order by U.first_name ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getStudentsAttendanceByCourseBatchIdTimetableId($courseBatchId,$timetableId){

        $sql = "select A.attendance_id,A.presence,A.timetable_id,U.user_id,U.first_name,U.last_name,CB.batch_name,Y.batch_year,Y.batch_year_id from user U
                inner join user_course UC on U.user_id=UC.user_id
                inner join course_batch CB on CB.course_batch_id=UC.course_batch_id
                inner join batch_year Y on Y.course_batch_id=CB.course_batch_id
				left outer join attendance A on A.user_id=U.user_id
				left outer join timetable T on T.timetable_id=A.timetable_id
                where  A.timetable_id=".$timetableId." and Y.batch_year_id=(select batch_year_id from batch_year where  course_batch_id=".$courseBatchId." and CURDATE() between start_date and end_date)
                order by U.first_name ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getAllUsersExceptParticipants($momId){

        $sql = "SELECT * FROM user where user_id not in (select user_id from mom_participant where mom_id=".$momId.")";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //get the username & password from users
    function get_user($usr, $pwd)
    {
        $sql = "select * from user where (username = '" . $usr . "' or unique_id= '" . $usr . "') and password = '" . md5($pwd) . "' and status = '1'";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 1) {

            return $query-> row_array();
        } else {
            return false;
        }
    }


    public function getUserByEmail($emailId){
        $query = $this->db->get_where('user',array('email_address'=>$emailId));

        if ($query->num_rows() == 1) {
            return $query-> row_array();

        } else {
            return false;
        }
    }

    public function getUserById($userId){
    $query = $this->db->get_where('user',array('user_id'=>$userId));
//        $sql = "select U.*,R.*,UT.* from user U
//                inner join user_role UR on U.user_id=UR.user_id
//                inner join role R on UR.role_id=R.role_id
//                inner join user_type UT on U.user_type_id=UT.user_type_id where U.user_id=".$userId;
//        $query = $this->db->query($sql);
        if ($query->num_rows() == 1) {
            return $query-> row_array();

        } else {
            return false;
        }
    }

    public function getTeachingStaffs(){
        $query = $this->db->get_where('user',array('user_type_id'=>3)); // 3= teaching staff

        return $query->result();
    }

    function changePassword($key,$data)
    {
        $this->db->where('md5(email_address)', $key);
        return $this->db->update('user', $data);
    }

    function insertUser($user){
        $this->db->insert('user', $user);
        return $this->db->insert_id();
    }

    //
    function updateUser($userId,$data)
    {
        $this->db->where('user_id', $userId);
        return $this->db->update('user', $data);
    }

    function activateUser($userId,$uniqueId)
    {
        $data = array('status' => 1,
                      'unique_id' => $uniqueId,
                    );
        $this->db->where('user_id', $userId);
        return $this->db->update('user', $data);
    }

    function deActivateUser($userId)
    {
        $data = array('status' => 0);
        $this->db->where('user_id', $userId);
        return $this->db->update('user', $data);
    }
}