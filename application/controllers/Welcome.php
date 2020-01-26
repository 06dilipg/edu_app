<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	

    public function __construct()
    {
        parent::__construct();
        $this->load->helper ( array (
            'form',
            'url',
            'html',
            'security',
        	'string'
        ) );
        
        $this->load->library ( array (
            'session',
            'form_validation',
            'email',
        	'upload',
        	'send_email'
        ) );
        
//         $this->load->library('send_email');

        //Changing the Error Delimiters Globally
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');

        $this->load->model ( 'course_model' );       
        $this->load->model ( 'user_type_model' );
        $this->load->model ( 'user_model' );


    }

	public function index()
	{

		$this->load->view('welcome_message');
	}

    public function register(){

        $data['userTypes'] = $this->user_type_model->get_userTypes();

        $this->load->view('header');
        $this->load->view('user_register',$data);
        $this->load->view('footer');
    }
    
    public function submitRegistration(){
    	
    	// set validation rules
    	$this->form_validation->set_rules ( 'userType', 'USER TYPE', 'required|xss_clean' );
    	$this->form_validation->set_rules ( 'firstName', 'FIRST NAME', 'trim|required|alpha_numeric_spaces|min_length[3]|max_length[30]|xss_clean' );
    	$this->form_validation->set_rules ( 'lastName', 'LAST NAME', 'trim|required|alpha_numeric_spaces|min_length[3]|max_length[30]|xss_clean' );
    	$this->form_validation->set_rules ( 'dob', 'DATE OF BIRTH', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'gender', 'GENDER', 'required' );
    	$this->form_validation->set_rules ( 'mobile', 'MOBILE NUMBER', 'trim|required|numeric|is_unique[user.mobile_no]|regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[10]|xss_clean',
    			array('is_unique' => 'The %s is already registered.'));
    	$this->form_validation->set_rules ( 'email', 'EMAIL', 'trim|required|valid_email|is_unique[user.email_address]',
    			array('is_unique' => 'The %s Id is already registered.'));
    	$this->form_validation->set_rules ( 'userName', 'USER NAME', 'trim|required|alpha_numeric_spaces|min_length[3]|max_length[10]|xss_clean|is_unique[user.username]',
    			array('is_unique' => 'The User Name is already registered.'));
    	$this->form_validation->set_rules ( 'password', 'PASSWORD', 'trim|required|md5' );
        $this->form_validation->set_rules ( 'agreeCheckbox', 'I Agree to terms of use and privacy policy.', 'required',
            array('required' => 'I Agree to terms of use and privacy policy. Must be checked'));

        if ($this->form_validation->run () == FALSE) {

            $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error.  Please correct below form error(s)</div>' );
        	$this->register();

        }else{

            // insert user data

            $data = array (
                'user_type_id' => $this->input->post ( 'userType' ),
                'first_name' => $this->input->post ( 'firstName' ),
                'last_name' => $this->input->post ( 'lastName' ),
                'gender_id' => $this->input->post ( 'gender' ),
                'dob' => $this->input->post ( 'dob' ),
                'email_address' => $this->input->post ( 'email' ),
                'mobile_no' => $this->input->post ( 'mobile' ),
                'username' => $this->input->post ( 'userName' ),
                'password' => $this->input->post ( 'password' )
            );

            if($this->user_model->insertUser($data)>0){
                // redirect to success page

                $this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">Registration Success!!!, Admin team will get back to you once your account is activated.</div>' );
                redirect('register');
            }else{
                // redirect to success page

                $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error.  Please contact admin team.</div>' );
                redirect('register');
            }


        }


    }

    public function forgotPassword(){

        $this->load->view('header');
        $this->load->view('forgot_password');
        $this->load->view('footer');
    }

    public function changePasswordEmail(){
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");


        if ($this->form_validation->run() == FALSE)
        {
            //validation fails
            $this->load->view("header");
            $this->load->view("forgot_password");
            $this->load->view("footer");
        }
        else
        {
            $email = $this->input->post("email");
            $usr_result = $this->user_model->getUserByEmail($email);
            if ($usr_result != false) //active user record is present
            {

                $UserEmail=$usr_result['email_address'];
                $this->send_email->sendChangePWDEmail( $UserEmail);
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">Change password link sent to your registered Email-ID.</div>' );
                redirect('forgotPassword');

//                if ($this->send_email->sendChangePWDEmail( $UserEmail)) {
//                    // successfully sent mail
//                    $this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">Change password link sent to your registered Email-ID.</div>' );
//                    redirect('forgotPassword');
//                } else {
//                    // error
//                    $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error.  While Sending email!!!</div>' );
//
//                    redirect('forgotPassword');
//                }

            }else {

                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Given Email Id, Is Not Registered With Us!</div>');
                redirect('forgotPassword');
            }


        }
    }

    public  function changePassword($hash = NULL){

        $data['email']=$hash;

        $this->load->view("header");
        $this->load->view("change_password",$data);
        $this->load->view("footer");
    }

    function reSetPassword() {


        $this->form_validation->set_rules ( 'newPassword', 'New Password', 'trim|required|md5' );
        $this->form_validation->set_rules ( 'cpassword', 'Confirm New Password', 'trim|required|matches[newPassword]|md5' );



        // validate form input
        if ($this->form_validation->run () == FALSE) {
            // fails
            $data['email']=$this->input->post ( 'email' );

            $this->load->view("header");
            $this->load->view("change_password",$data);
            $this->load->view("footer");

        } else {

            // check for is logged in
            if ($_SESSION['logged_in']==true) {
                $userId=$_SESSION['userId'];
                $usr_result=$this->user_model->getUserById($userId);
                $UserEmail=$usr_result['email_address'];
                $emailHash=md5($UserEmail);
            }else{
                $emailHash=$this->input->post ( 'email' );
            }


            $data = array (
                'password' => $this->input->post ( 'newPassword' )
            );

            if ($this->user_model->changePassword( $emailHash,$data)) {

                $this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">Password successfully changed, Please login to access your account!</div>' );
                redirect ( 'login' );

            } else {
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address to Change Password!</div>' );
                redirect ( 'forgotPassword' );
            }
        }



    }

    public function login(){

        // set validation rules

        $this->form_validation->set_rules ( 'userName', 'USER NAME', 'trim|required');
        $this->form_validation->set_rules ( 'password', 'PASSWORD', 'trim|required' );


        if ($this->form_validation->run () == FALSE) {

            $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error.  Please correct below form error(s)</div>' );
            $this->index();

        }else{

        	//get the posted values
        	$username = $this->input->post("userName");
        	$password = $this->input->post("password");
        	
            //check if username / unique_id and password is correct
            $usr_result = $this->user_model->get_user($username, $password);
            if ($usr_result != false) //active user record is present
            {
                $profileImgPath='';
                if($usr_result['photo']){
                    $profileImgPath=PROFILE_IMAGE_URL.$usr_result['user_id'].'/'.$usr_result['photo'];
                }else{
                    $profileImgPath='assets/images/avatars/default_avatar.jpg';
                }

                // check user type such as Admin or student or staff etc
                $userId=$usr_result['user_id'];
                $userTypeId=$usr_result['user_type_id'];
                $userType = $this->user_type_model->get_userTypeById($userTypeId);

                //set the session variables
                $session_data = array(
                    'userId'    => $usr_result['user_id'],
                    'firstName' => $usr_result['first_name'],
                    'lastName' => $usr_result['last_name'],
                    'uniqueId' => $usr_result['unique_id'],
                    'userType' => $userType[0]->type,
                    'userTypeId' => $userTypeId,
                    'profileImgPath'=>$profileImgPath,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);



                //TODO implement user type wise functionality

                redirect('dashboard');
            }else{
                
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username or password!</div>');
                $this->index();
            }
        }
    }
    
    
    public function logout() {
    	
    	// Removing session data
    	
    	$session_data = array(
    			'userId'    => '',
    			'firstName' => '',
    			'lastName' => '',
                'uniqueId' => '',
    			'userType' => '',
    			'logged_in' => FALSE
    	);
    	$this->session->unset_userdata('logged_in', $session_data);
    	session_destroy();
    	$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Successfully Logged Out!</div>');
    	redirect('welcome');
    }


    public function admissionSlots()
    {
        $data['admissionSlots']=$this->admission_model->get_admissions();

    	$this->load->view('header');
    	$this->load->view('admission_slots',$data);
//     	$this->load->view('application_form');
        $this->load->view('footer');
    }

    public function visitors(){
        $this->load->view('header');
     	$this->load->view('visitors_form');
        $this->load->view('footer');
    }

    public function postApplicant(){
        $this->load->view('header');
        $this->load->view('post_applicant');
        $this->load->view('footer');
    }

    
    public function fillApplication($admissionId){

    	$data=$this->admission_model->getAdmissionById($admissionId);
    	$data['docTypes']=$this->admissiondoctype_model->get_admission_doc_types();
    	
    	$checkCourse=$data['courseId'];
        if($checkCourse==1 || $checkCourse==3 || $checkCourse==8 || $checkCourse==9 || $checkCourse==10 || $checkCourse==11){ // check is applying for MSc /Post BSc then show or hide accordingly
    		$data['display']="display:block";
    	}else{
    		$data['display']="display:none";
    	}
    	
    	$this->load->view('header');    	
    	$this->load->view('application_form',$data);
    	$this->load->view('footer');
    }
    
    public function submitApplication(){
    	
    	$admissionId=$this->input->post ( 'admissionId' );
    	$courseId=$this->input->post ( 'courseId' );
    	
    	// form validation
    	$this->form_validation->set_rules ( 'firstName', 'FIRST NAME', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'lastName', 'LAST NAME', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'dob', 'DATE OF BIRTH', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'gender', 'GENDER', 'required' );
//     	$this->form_validation->set_rules ( 'imageUpload', 'APPLICANT PHOTO', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'mobile', 'MOBILE', 'required|regex_match[/^[0-9]{10}$/]|trim|xss_clean' );    	
//    	$this->form_validation->set_rules ( 'email', 'EMAIL', 'required|trim|valid_email|xss_clean' );
    	$this->form_validation->set_rules ( 'parentName', 'PARENT/GUARDIAN NAME', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'parentMobile', 'PARENT/GUARDIAN MOBILE', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'occupation', 'PARENT/GUARDIAN OCCUPATION', 'required|trim|xss_clean' );
//     	$this->form_validation->set_rules ( 'annualIncome', 'ANNUAL INCOME', 'required|trim|xss_clean' );
        $this->form_validation->set_rules ( 'caste', 'CASTE', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'nationality', 'NATIONALITY', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'domicileStatus', 'DOMICILE STATUS', 'required|trim|xss_clean' );
    	
   	
    	
    	// ADDRESS FIELD STARTS
//    	$this->form_validation->set_rules ( 'doorNo', 'DOOR NO', 'required|trim|xss_clean' );
//    	$this->form_validation->set_rules ( 'street', 'STREET', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'addressLine1', 'ADDRESS LINE1', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'city', 'CITY/TOWN', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'state', 'STATE', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'country', 'COUNTRY', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'pinCode', 'PIN CODE', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'localGuardian', 'Does the candidate have a local guardian', 'required' );
    	$this->form_validation->set_rules ( 'localGuardianMobile', 'LOCAL GUARDIAN MOBILE', 'regex_match[/^[0-9]{10}$/]|trim|xss_clean' ); 
    	// PUV SUBJECTS & MARKS
    	$this->form_validation->set_rules ( 'pucYearOfPassing', 'YEAR OF PASSING', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'syllabus', 'SYLLABUS', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'pucTotalMark', 'TOTAL MARK OBTAINED', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'pucTotalMarkMax', 'TOTAL MARK MAX', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'pucPercentage', 'PERCENTAGE', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'pucPCBPercentage', 'PCB PERCENTAGE', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'pucPCBEPercentage', 'PCBE PERCENTAGE', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'subject1', 'SUBJECT NAME', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'subject2', 'SUBJECT NAME', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'subject3', 'SUBJECT NAME', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'subject4', 'SUBJECT NAME', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'subject5', 'SUBJECT NAME', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'subject6', 'SUBJECT NAME', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'obtainedMark1', 'OBTAINED MARK', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'obtainedMark2', 'OBTAINED MARK', 'required|trim|xss_clean' ); 
    	$this->form_validation->set_rules ( 'obtainedMark3', 'OBTAINED MARK', 'required|trim|xss_clean' ); 
    	$this->form_validation->set_rules ( 'obtainedMark4', 'OBTAINED MARK', 'required|trim|xss_clean' ); 
    	$this->form_validation->set_rules ( 'obtainedMark5', 'OBTAINED MARK', 'required|trim|xss_clean' ); 
    	$this->form_validation->set_rules ( 'obtainedMark6', 'OBTAINED MARK', 'required|trim|xss_clean' ); 
    	$this->form_validation->set_rules ( 'maxMark1', 'MAX MARK', 'required|trim|xss_clean' );     	
    	$this->form_validation->set_rules ( 'maxMark2', 'MAX MARK', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'maxMark3', 'MAX MARK', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'maxMark4', 'MAX MARK', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'maxMark5', 'MAX MARK', 'required|trim|xss_clean' );
    	$this->form_validation->set_rules ( 'maxMark6', 'MAX MARK', 'required|trim|xss_clean' );

//     	$this->form_validation->set_rules ( 'agreeCheckbox', 'Agree College Rules And Regulations,Eligibility For The Course.', 'required' );
    	$this->form_validation->set_rules ( 'agreeCheckbox', 'Agree College Rules And Regulations,Eligibility For The Course.', 'required',
    			array('required' => 'Agree College Rules And Regulations,Eligibility For The Course. Must be checked'));
    	
    	//UG ACADEMIC DETAIL VALIDATION
    	if($courseId==1 || $courseId==3 || $courseId==8 || $courseId==9 || $courseId==10 || $courseId==11){ // check is applying for MSc /Post BSc then apply validations
    		
    		$this->form_validation->set_rules ( 'ugYearOfPassing', 'YEAR OF PASSING', 'required|trim|xss_clean' );
    		$this->form_validation->set_rules ( 'ugTotalMarkObtained', 'TOTAL MARK OBTAINED', 'required|trim|xss_clean' );
    		$this->form_validation->set_rules ( 'nursingRegistrationNumber', 'NURSING COUNCIL REGISTRATION NUMBER', 'required|trim|xss_clean' );
    		$this->form_validation->set_rules ( 'nursingRegistrationDate', 'NURSING COUNCIL REGISTRATION DATE', 'required|trim|xss_clean' );
    		$this->form_validation->set_rules ( 'stateExperienceObtained', 'STATE WHERE EXPERIENCE OBTAINED', 'required|trim|xss_clean' );
//    		$this->form_validation->set_rules ( 'dischargeDate', 'DATE OF DISCHARGE', 'required|trim|xss_clean' );
//    		$this->form_validation->set_rules ( 'appointmentDate', 'DATE OF APPOINTMENT', 'required|trim|xss_clean' );
    	}
    
    try{
    		
    	
    	
    	if ($this->form_validation->run () == FALSE) {
    		
    		$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error.  Please correct below form error(s)</div>' );
    		
    		$this->fillApplication($admissionId);
    		
    	}else{
    		
    		// get input data
    		
    		//generate application referance number
    		$referenceNumber="";
    		$referenceNumber=random_string('alnum', 5);
    		
    		$to_email=$this->input->post ( 'email' );
    		// insert data
    		// Database transaction starts
    		$this->db->trans_start();
    		
    		$data_applicant_address=array (
    		    	
    				'door_no' => $this->input->post ( 'doorNo' ),
    				'street' => $this->input->post ( 'street' ),
    				'address_line1' => $this->input->post ( 'addressLine1' ),
    				'address_line2' => $this->input->post ( 'addressLine2' ),
    				'district' => $this->input->post ( 'city' ),
    				'state' => $this->input->post ( 'state' ),
    				'country' => $this->input->post ( 'country' ),
    				'pincode' => $this->input->post ( 'pinCode' ),
    				
    		);
    		
    		$addressId=$this->address_model->insertAddress($data_applicant_address);  // insert address
    		
    		$data_admission_application = array (

    				'admission_id' => $this->input->post ( 'admissionId' ),
    				'reference_number' => $referenceNumber,
    				'application_status_id' => 6,							// 6=Applied Status
    				'first_name' => $this->input->post ( 'firstName' ),
    				'middle_name' => $this->input->post ( 'middleName' ),
    				'last_name' => $this->input->post ( 'lastName' ),
    				'dob' => $this->input->post ( 'dob' ),
    				'gender_id' => $this->input->post ( 'gender' ),
    				'photo_file_name' => "",						// all file name of a application will be in admission_document table
   					'address_id' => $addressId,
    				'landline_no' => $this->input->post ( 'landLine' ),
    				'mobile_no' => $this->input->post ( 'mobile' ),
    				'email_address' => $this->input->post ( 'email' ),
    				'parent_name' => $this->input->post ( 'parentName' ),
    				'parent_mobile' => $this->input->post ( 'parentMobile' ),
    				'parent_occupation' => $this->input->post ( 'occupation' ),
    				'parent_income' => $this->input->post ( 'annualIncome' ),
    				'nationality' => $this->input->post ( 'nationality' ),
    				'religion' => $this->input->post ( 'religion' ),
    				'caste' => $this->input->post ( 'caste' ),
    				'domicile_status' => $this->input->post ( 'domicileStatus' ),
    				'have_local_guardian' => $this->input->post ( 'localGuardian' ),
    				'local_guardian_number' => $this->input->post ( 'localGuardianMobile' ),
    				'puc_yearofpassing' => $this->input->post ( 'pucYearOfPassing' ),
    				'puc_syllabus' => $this->input->post ( 'syllabus' ),
    				'puc_totalmark' => $this->input->post ( 'pucTotalMark' ),
    				'puc_totalmarkMax' => $this->input->post ( 'pucTotalMarkMax' ),
    				'puc_percentage' => $this->input->post ( 'pucPercentage' ),
    				'puc_pcb_percentage' => $this->input->post ( 'pucPCBPercentage' ),
    				'puc_pcbe_percentage' => $this->input->post ( 'pucPCBEPercentage' ),
    				'gnm_or_bsc_yearofpassing' => $this->input->post ( 'ugYearOfPassing' ),
    				'gnm_or_bsc_totalmark_obtained' => $this->input->post ( 'ugTotalMarkObtained' ),
    				'nursingcouncil_registration_number' => $this->input->post ( 'nursingRegistrationNumber' ),
    				'nursingcouncil_registration_date' => $this->input->post ( 'nursingRegistrationDate' ),
    				'state_exp_obtained' => $this->input->post ( 'stateExperienceObtained' ),
    				'discharge_date' => $this->input->post ( 'dischargeDate' ),
    				'appointment_date' => $this->input->post ( 'appointmentDate' )
    				
    				
    		);
    		
    		$applicationId=$this->admissionapplications_model->insertAdmissionApplication($data_admission_application);
    		
    		// validation check (functionality)  may be later
    		
    		// PUC Subject Details insertion 
    		$data_applicant_PUCmarks=array (
    				'admission_application_id' => $applicationId,
    				'subject_name1' => $this->input->post ( 'subject1' ),
    				'max_mark1' => $this->input->post ( 'maxMark1' ),
    				'obtained_mark1' => $this->input->post ( 'obtainedMark1' ),
    				'subject_name2' => $this->input->post ( 'subject2' ),
    				'max_mark2' => $this->input->post ( 'maxMark2' ),
    				'obtained_mark2' => $this->input->post ( 'obtainedMark2' ),
    				'subject_name3' => $this->input->post ( 'subject3' ),
    				'max_mark3' => $this->input->post ( 'maxMark3' ),
    				'obtained_mark3' => $this->input->post ( 'obtainedMark3' ),
    				'subject_name4' => $this->input->post ( 'subject4' ),
    				'max_mark4' => $this->input->post ( 'maxMark4' ),
    				'obtained_mark4' => $this->input->post ( 'obtainedMark4' ),
    				'subject_name5' => $this->input->post ( 'subject5' ),
    				'max_mark5' => $this->input->post ( 'maxMark5' ),
    				'obtained_mark5' => $this->input->post ( 'obtainedMark5' ),
    				'subject_name6' => $this->input->post ( 'subject6' ),
    				'max_mark6' => $this->input->post ( 'maxMark6' ),
    				'obtained_mark6' => $this->input->post ( 'obtainedMark6' )
    			
    				
    		);
    		
    		$this->admission_subject_marks_model->insertPucMarks($data_applicant_PUCmarks);
    		
    		// upload file - profile image    	
    		
//     		$config['upload_path']          = './uploads/profile_img/';
    		$config['upload_path']          = PROFILE_IMAGE_URL.$referenceNumber;
    		$config['allowed_types']        = 'jpg|jpeg|jpe|png|pdf';
    		$config['max_size']             = '5000';
//     		$config['max_width']            = '1024';
//     		$config['max_height']           = '768';
    		
    		$this->load->library('upload', $config);
    		$this->upload->initialize($config);

            if (!is_dir(PROFILE_IMAGE_URL.$referenceNumber)) {                 // make directory with referenceNumber
                mkdir(PROFILE_IMAGE_URL.$referenceNumber, 0777, TRUE);

            }
    		
    		if (!$this->upload->do_upload('imageUpload'))
    		{
//     			$error = array('error' => $this->upload->display_errors());
    			$error = $this->upload->display_errors();
    			$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error: Profile Image.'.$error.'</div>' );
    			$this->fillApplication($admissionId);

    		}
    		else
    		{

                $data = array('upload_data' => $this->upload->data());

                //insert document details
                $data_applicant_document=array (

                    'admission_application_id' =>$applicationId,
                    'admission_doc_type_id' => 0, 								//zero for profile image
                    'doc_name' => $this->upload->data('file_name')

                );

                $this->admissiondocument_model->insertAdmissionDocument($data_applicant_document);


                // upload files - supporting docs
                $this->multiple_upload($admissionId,$applicationId,$referenceNumber);


                // transaction complete
                if(empty($data['upload_message'])){ // check is error in support doc upload

                    $this->db->trans_complete();

                    //response msg to user
                    if ($this->db->trans_status() === TRUE)
                    {
//    					$isSent=$this->send_email->sendEmail($referenceNumber,$to_email);
//    					if($isSent==TRUE){
                        $this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">Application Referance Number:'.$referenceNumber.'</div>' );
                        $this->fillApplication($admissionId);
//    					}else{
//    						$this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">Application Referance Number:'.$this->email->print_debugger().'</div>' );
//    						$this->fillApplication($admissionId);
//    					}

                    }else {
                        $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error (DB).  Please try again later!!!</div>' );
                        $this->fillApplication($admissionId);
                    }
                }


            }
    		
    	
    	}
    	
    	}catch (Exception $e){
    		$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error(Exception).  Please try again later!!!</div>' );
    		$this->fillApplication($admissionId);
    	}
    	
    	
    	
    }
    
//     function multiple_upload($upload_dir = 'uploads', $config = array(),$admissionId)
    function multiple_upload($admissionId,$applicationId,$referenceNumber)
    {
    	$files = array();
    	
//    	if(empty($config))
//    	{
//     		$config2['upload_path'] = './uploads/support_docs/';
			$config2['upload_path'] = SUPPORT_DOC_URL.$referenceNumber;
   			$config2['allowed_types'] = 'jpg|jpeg|jpe|png|pdf';
   			$config2['max_size']      = '5000';
//    	}
    	
//     	$this->load->library('upload', $config2);
    	$this->upload->initialize($config2);
    	
    	$errors = FALSE;

        if (!is_dir(SUPPORT_DOC_URL.$referenceNumber)) {                 // make directory with a referenceNumber
            mkdir(SUPPORT_DOC_URL.$referenceNumber, 0777, TRUE);

        }

    	
    	foreach($_FILES as $key => $value)
    	{
    		if( ! empty($value['name']) && $key!='imageUpload')
    		{
    			if( ! $this->upload->do_upload($key))
    			{
//     				$data['upload_message'] = $this->upload->display_errors(ERR_OPEN, ERR_CLOSE); // ERR_OPEN and ERR_CLOSE are error delimiters defined in a config file
    				$data['upload_message'] = $this->upload->display_errors();
    				$this->load->vars($data);
    				
    				$errors = TRUE;
    			}
    			else
    			{
    				// Build a file array from all uploaded files
    				$files[] = $this->upload->data();
    				
    				//insert document details
    				$data_applicant_document=array (
    						
    						'admission_application_id' =>$applicationId,
    						'admission_doc_type_id' => $key, 								
    						'doc_name' => $this->upload->data('file_name')
    						
    				);
    				
    				$this->admissiondocument_model->insertAdmissionDocument($data_applicant_document);
    			}
    		}
    	}
    	
    	// There was errors, we have to delete the uploaded files
    	if($errors)
    	{
    		foreach($files as $key => $file)
    		{
    			@unlink($file['full_path']);
    		}
    	}
    	elseif(empty($files) AND empty($data['upload_message']))
    	{
//     		$this->lang->load('upload');
//     		$data['upload_message'] = ERR_OPEN.$this->lang->line('upload_no_file_selected').ERR_CLOSE;
//     		$this->load->vars($data);
    		
    		$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error Support Doc.'.$data['upload_message'].'</div>' );
    		$this->fillApplication($admissionId);
    	}
    	else
    	{
    		return $files;
    	}
    }
    
}
