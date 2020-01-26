<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timetable extends CI_Controller {

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
            'security',
            'date'
        ) );
        $this->load->library ( array (
            'session',
            'form_validation',
            'email'
        ) );

        //Changing the Error Delimiters Globally
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');

        $this->load->model ( 'user_model' );
        $this->load->model ( 'batch_year_model' );
        $this->load->model ( 'subject_model' );
        $this->load->model ( 'timetable_timing_model' );
        $this->load->model ( 'timetable_model' );


    }


    public function currentBatchYear(){

        $data['batchYearList']=$this->batch_year_model->get_current_batchYear();
        $this->load->view("admin/header");
        $this->load->view("admin/sidebar");
        $this->load->view("academic/current_batch_year",$data);
        $this->load->view("admin/footer");
    }


    public function regularTimetable($courseBatchId,$batchYearId,$whichWeek){

        $courseBatchYearInfo=$this->batch_year_model->get_batchYearByYearId($batchYearId);
        $data['courseBatchYearName']=$courseBatchYearInfo['courseName']." - ".$courseBatchYearInfo['batchName']." - ".$courseBatchYearInfo['batchYear']."(Year)";
        $data['courseBatchId']=$courseBatchId;
        $data['batchYearId']=$batchYearId;
        $data['subjectList']=$this->subject_model->get_subject($batchYearId);
        $data['staffList']=$this->user_model->getTeachingStaffs();

        // getting current week timetable
        $currentWeekTimetable=$this->timetable_model->getCurrentWeekTimetable($courseBatchId,$batchYearId);
        $thisMonday=$this->timetable_model->getCurrentWeekMonday();

        // getting next week timetable
        $nextWeekTimetable=$this->timetable_model->getNextWeekTimetable($courseBatchId,$batchYearId);
        $nextMonday=$this->timetable_model->getNextWeekMonday();

        // disable template creating button if timetable exist
        if(!empty($currentWeekTimetable)){
            $data['hideCurrentWeekButton']="hidden";
        }else{
            $data['hideCurrentWeekButton']="";
        }

        if(!empty($nextWeekTimetable)){
            $data['hideNextWeekButton']="hidden";
        }else{
            $data['hideNextWeekButton']="";
        }

        // construct timing array and classes as inner array
        $i=0;
        $t=0;
        $timeTableData=null;
        $timeTableToConstruct=null;
        $dateRange=null;
        if($whichWeek==0){ // current week
            $timeTableToConstruct=$currentWeekTimetable;
            // construct current week date array object
            $range = date_range($thisMonday, date('Y-m-d', strtotime($thisMonday. ' + 6 days')));
            $data['dateRange']=$range;

        }elseif($whichWeek==1){ // next week
            $timeTableToConstruct=$nextWeekTimetable;
            $range = date_range($nextMonday, date('Y-m-d', strtotime($nextMonday. ' + 6 days')));
            $data['dateRange']=$range;

        }
        foreach($timeTableToConstruct as $timeTable){


            $timeTableClasses[$i]= array(
                "timetable_id" => $timeTable->timetable_id,
                "course_batch_id" => $timeTable->course_batch_id,
                "batch_year_id" => $timeTable->batch_year_id,
                "day" => $timeTable->day,
                "faculty_id"=> $timeTable->faculty_id,
                "subject_id" => $timeTable->subject_id,
                "faculty_name"=> $timeTable->first_name.' '.$timeTable->last_name,
                "subject_name" => $timeTable->subjectName,
                "timetable_date" => $timeTable->date
             );


                $timeTableData[$t] = array(
                    "timing_id" => $timeTable->timing_id,
                    "start_time" => $timeTable->start_time,
                    "end_time" => $timeTable->end_time,
                    "type"  => $timeTable->type,
                    "classes" => $timeTableClasses
                );

            if($i==6){ // reset $i
                $i=0;
                $t++;
            }else{
                $i++;
            }

        }
        $data['timeTableData']=$timeTableData;
        $this->load->view("admin/header");
        $this->load->view("admin/sidebar");
        $this->load->view("academic/regular_timetable",$data);
        $this->load->view("admin/footer");
    }

    public function saveTimeTable(){
        // Un escape the string values in the JSON array
        $timeTableData = stripcslashes($this->input->post('timeTableData'));
        $courseBatchId =$this->input->post('courseBatchId');
        $batchYearId = $this->input->post('batchYearId');
        // Decode the JSON array
        $timeTableData = json_decode($timeTableData,TRUE);

        $this->db->trans_start();

        // if time table exist delete existing and insert new
//        $timetableExist=$this->timetable_model->getTimetable($courseBatchId,$batchYearId);



//        if(!empty($timetableExist)){
//
//            $this->timetable_model->OFF_SQL_SAFE_UPDATES(); // disable safe update to delete row where clause not using PK column
//
//            $this->timetable_model->deleteTimetable($courseBatchId,$batchYearId);
//
//            $this->timetable_model->ON_SQL_SAFE_UPDATES(); // enable safe update
//        }


        foreach($timeTableData as $timetable){
            $timingId=intval($timetable['timing_id']);
            $startTime=$timetable['start_time'];
            $endTime=$timetable['end_time'];
            $classType=$timetable['type'];
            $classes=$timetable['classes'];

            $timingData = array (

                'start_time' => $startTime,
                'end_time' => $endTime,
                'type' => $classType
            );

            if($timingId !=0){ // update
                $this->timetable_timing_model->updateTimetableTiming($timingId,$timingData);
            }else{ // insert
                $timingId=$this->timetable_timing_model->insertTimetableTiming($timingData);
            }



            foreach($classes as $class){

                if(!is_null($class)){
                    $timetableId=intval($class['timetable_id']);
                    $course_batch_id=$class['course_batch_id'];
                    $batch_year_id=$class['batch_year_id'];
                    $day=intval($class['day']);
                    $faculty_id=intval($class['faculty_id']);
                    $subject_id=intval($class['subject_id']);
                    $date=$class['date'];

                    $timetableData = array (

                        'course_batch_id' => $course_batch_id,
                        'batch_year_id' => $batch_year_id,
                        'day'   =>$day,
                        'timing_id' => $timingId,
                        'date' => $date
                    );
                    if($faculty_id != 0){
                        $timetableData['faculty_id']=$faculty_id;
                    }
                    if($subject_id != 0){
                        $timetableData['subject_id']=$subject_id;
                    }

                    if($timetableId != 0){ //update
                        $this->timetable_model->updateTimetable($timetableId,$timetableData);
                    }else{ //insert
                        $this->timetable_model->insertTimetable($timetableData);
                    }


                }

            }

        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE){

            $this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">Time Table Saved</div>' );
//            $this->regularTimetable($courseBatchId,$batchYearId);
            echo 'true';
        }else{
            $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error (DB).  Please try again later!!!</div>' );
//            $this->regularTimetable($courseBatchId,$batchYearId);
            echo 'true';
        }




    }


    public function additionalDuty(){

        $this->load->view("admin/header");
        $this->load->view("admin/sidebar");
        $this->load->view("academic/additional_timetable");
        $this->load->view("admin/footer");
    }

} 