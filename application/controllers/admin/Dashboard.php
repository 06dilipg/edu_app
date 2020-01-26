<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
            'form_validation',
            'email'
        ) );
        $this->load->model ('timetable_model');
    }

    public function index(){
        $this->load->view("admin/header");
        $this->load->view("admin/sidebar");
        if($this->session->userdata('userTypeId')==='1'){  //ADMIN USER
            $this->load->view("admin/dashboard");
        }elseif ($this->session->userdata('userTypeId')==='2'){ // STUDENT
            $this->load->view("admin/dashboard");
        }elseif ($this->session->userdata('userTypeId')==='3'){ // TEACHING STAFF

            $userId=$this->session->userdata('userId'); // get logged in user id
            $data["timetableList"]=$this->timetable_model->getUserTimeTable($userId);


            $this->load->view("admin/dashboard_teachingstaff",$data);
        }
        $this->load->view("admin/footer");
    }
}