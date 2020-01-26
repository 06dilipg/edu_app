<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Attendance extends CI_Controller {

    public function __construct()
    {
        parent::__construct();


        // check for session
        if ($_SESSION['logged_in']==false) {
            return redirect('welcome');
        }

        $this->load->helper ( array (
            'form',
            'url',
            'html',
            'security'
        ) );
        $this->load->library ( array (
            'session',
            'form_validation',
            'email'
        ) );

        //Changing the Error Delimiters Globally
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');

        $this->load->model ( 'user_model' );
        $this->load->model ('timetable_model');
        $this->load->model ('attendance_model');


    }

    public function timetableSchedule(){

        $userId=$this->session->userdata('userId'); // get logged in user id
        $data["timetableList"]=$this->timetable_model->getUserTimeTable($userId);

        $this->load->view("admin/header");
        $this->load->view("admin/sidebar");
        $this->load->view("academic/timetable_schedule_attendance",$data);
        $this->load->view("admin/footer");
    }

    public function takeAttendance($timeTableId,$courseBatchId){

        $userId=$this->session->userdata('userId'); // get logged in user id

        $data["timetableDetails"]=$this->timetable_model->getUserTimeTableByTimeTableId($userId,$timeTableId);
        $attendanceDetails=$this->attendance_model->getAttendanceByTimetableId($timeTableId);

        if(!empty($attendanceDetails)){ // if attendance already exist
            $data["hasAttendance"]=true;
            $data["studentList"]=$this->user_model->getStudentsAttendanceByCourseBatchIdTimetableId($courseBatchId,$timeTableId);
        }else{
            $data["hasAttendance"]=false;
            $data["studentList"]=$this->user_model->getStudentsByCourseBatchId($courseBatchId);
        }


        $this->load->view("admin/header");
        $this->load->view("admin/sidebar");
        $this->load->view("academic/take_attendance",$data);
        $this->load->view("admin/footer");
    }


    public function saveAttendance(){
        // Un escape the string values in the JSON array
        $attendanceData = stripcslashes($this->input->post('attendanceData'));

        // Decode the JSON array
        $attendanceData = json_decode($attendanceData,TRUE);

        $this->db->trans_start();

        foreach($attendanceData as $attendance){

            $attendanceId=intval($attendance['attendance_id']);
            $userId=intval($attendance['user_id']);
            $timetableId=intval($attendance['timetable_id']);
            $date=$attendance['date'];
            $presence=intval($attendance['presence']);
            $leaveReasonType=intval($attendance['leave_reason_type_id']);
            $details=$attendance['details'];

            $attendanceStudentData = array (
//                'attendance_id' => $attendanceId,
                'user_id' => $userId,
                'timetable_id' => $timetableId,
                'date' => $date,
                'presence' => $presence,
//                'leave_reason_type_id' => $leaveReasonType,
//                'details' => $details
            );

            if($attendanceId !=0){ // update
                $this->attendance_model->updateAttendance($attendanceId,$attendanceStudentData);
            }else{ // insert
                $this->attendance_model->insertAttendance($attendanceStudentData);
            }




        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE){

            $this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">Attendance Saved</div>' );
//            $this->regularTimetable($courseBatchId,$batchYearId);
            echo 'true';
        }else{
            $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error (DB).  Please try again later!!!</div>' );
//            $this->regularTimetable($courseBatchId,$batchYearId);
            echo 'true';
        }




    }

} 