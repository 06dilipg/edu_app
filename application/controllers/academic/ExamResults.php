<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Onto Technologies
 * Date: 6/7/19
 * Time: 9:15 AM
 */

class ExamResults extends CI_Controller {

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

//        $this->load->model ( 'user_model' );


    }

    public function feedExamResult(){

        $this->load->view("admin/header");
        $this->load->view("admin/sidebar");
        $this->load->view("academic/feed_examresults");
        $this->load->view("admin/footer");
    }

} 