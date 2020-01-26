<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_email  {
	
	protected $CI;
	
	public function __construct()
	{
		
		
		$this->CI =& get_instance();
		
// 		$this->load->helper ( array (
// 				'form',
// 				'url',
// 				'html',
// 				'security',
// 				'string'
// 		) );
		
		$this->CI->load->library ( array (
				'session',	
				'email'
	
		) );
		
	}

    function sendEmail($subject,$message,$to_emails)
    {
        $from_email = 'donotreply@edengroups.org';

        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->CI->email->initialize($config);

        //send mail
        $this->CI->email->from($from_email, 'Sarvodaya College Of Nursing');
        $this->CI->email->to($to_emails);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);

         $this->CI ->email->send();

        echo $this->CI ->email->print_debugger();

    }

	//send application confirmation email to user's email id
	function sendApplicationConfirmationEmail($referenceNumber,$to_email)
	{

		$subject = 'Sarvodaya College Of Nursing: Application Confirmation';
		$message = 'Dear Applicant,<br /><br />Thank for choosing Sarvodaya College Of Nursing.
					<br /><br /> Your Application Reference Number:' . $referenceNumber. '<br /><br /><br />Thanks<br />Admission Team';

        $this->sendEmail($subject,$message,$to_email);


	}

    function sendMomInvitationEmail($topic,$agenda,$mom_date,$mom_time,$to_emails){

        $subject = 'Meeting Invitation: ' .$mom_date. ' , '.$mom_time;
        $message = 'Dear Participant,<br /><br />You have been invited for a meeting, details as below.
					<br /><br /> Meeting Regarding:  ' . $topic. '
					<br /><br /> Agenda:             '.$agenda.
					'<br /><br /> Scheduled On:  ' . $mom_date. '  at  '.$mom_time.'<br /><br /><br />
					Thanks<br />Admin Team';


        $this->sendEmail($subject,$message,$to_emails);

    }


    function sendMomActionPlanEmail($topic,$agenda,$actionPlan,$next_mom_date,$next_mom_time,$to_emails){

    $subject = 'Meeting Action Plan for: ' .$topic;
    $message = 'Dear Participant,<br /><br />Please find the action plan of the meeting for your review.
					<br /><br /> Meeting Regarding:  ' . $topic. '
					<br /><br /> Agenda:             '.$agenda.
        '<br /><br /> Action Plan :      '.$actionPlan.
        '<br /><br /> Next Meeting Scheduled On:  ' . $next_mom_date. '  at  '.$next_mom_time.'<br /><br /><br />
					Thanks<br />Admin Team';

    $this->sendEmail($subject,$message,$to_emails);

    }

    function sendClosedMomActionPlanEmail($topic,$agenda,$actionPlan,$to_emails){

        $subject = 'Meeting Action Plan for: ' .$topic;
        $message = 'Dear Participant,<br /><br />Please find the action plan of the meeting for your review.
					<br /><br /> Meeting Regarding:  ' . $topic. '
					<br /><br /> Agenda:             '.$agenda.
            '<br /><br /> Action Plan :      '.$actionPlan.
            '<br /><br /> Meeting Status: CLOSED <br /><br /><br />
					Thanks<br />Admin Team';

        $this->sendEmail($subject,$message,$to_emails);

    }

    function sendChangePWDEmail($to_email)
    {

        $subject = 'Your Password Recovery';
        $message = 'Dear User,<br /><br />Please click on the below link to create new password.
					<br /><br /> http://www.edengroups.org/index.php/welcome/changePassword/' . md5($to_email) . '<br /><br /><br />Thanks<br />Admin Team';

        $this->sendEmail($subject,$message,$to_email);
    }

    function sendUserActivationEmail($to_email)
    {

        $subject = 'Your Account Activated';
        $message ='Dear User,<br /><br />Your Sarvodaya IMS account has been activated.
                   <br /><br /> You can start using it from now on. <br /><br /><br />Thanks<br />Admin Team';

        $this->sendEmail($subject,$message,$to_email);
    }



	
}