<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sarvodaya College Of Nursing IMS</title>

    <!-- Favicon -->
<!--    <link rel="apple-touch-icon" href="--><?php //echo base_url('assets/images/logo/apple-touch-icon.png')?><!--">-->
<!--    <link rel="shortcut icon" href="--><?php //echo base_url('assets/images/logo/favicon.png')?><!--">-->

    <!-- core dependcies css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/dist/css/bootstrap.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/PACE/themes/blue/pace-theme-minimal.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/perfect-scrollbar/css/perfect-scrollbar.min.css')?>" />

    <!-- page css -->

    <!-- core css -->
    <link href="<?php echo base_url('assets/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/themify-icons.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/materialdesignicons.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/animate.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/app.css')?>" rel="stylesheet">
</head>

<body>
    <div class="app">
        <div class="layout bg-gradient-info">
            <div class="container">
                <div class="row full-height align-items-center">
                    <div class="col-md-7 d-none d-md-block">

                        <div class="m-t-15 m-l-20">
                            <img class="img-fluid align-items-center" src="<?php echo base_url('assets/images/logo/logo-bg.png')?>" alt="">
                            <h2 class="font-weight-light font-size-35 text-white">SARVODAYA COLLEGE OF NURSING</h2>
                            <h4 class="font-weight-light text-white">(A Unit Of Sarvodaya Group Of Institutions)</h4>
                            <p class="text-white width-100 text-opacity m-t-25 font-size-16">Affiliated to Rajiv Gandhi University of Health Science
                                Approved by Karnataka Nursing Council & Indian Nursing Council.</p>
<!--                            <div class="m-t-60">-->
<!--                                <a href="" class="text-white text-link m-r-15">Term &amp; Conditions</a>-->
<!--                                <a href="" class="text-white text-link">Privacy &amp; Policy</a>-->
<!--                            </div>-->

<!--                            <a href=""><button class="btn btn-block btn-w-md btn-gradient-success">Enquiry Online</button></a>-->
                        </div>
                        <div class="col-md-12">
                            <div class="text-sm-center m-t-25">
                                <a href="<?php echo base_url('index.php/visitors');?>"><button class="btn btn-gradient-success">Enquire</button></a>
                                <a href="<?php echo base_url('index.php/admissionSlots');?>"><button class="btn btn-gradient-success">Online Application</button></a>
<!--                                <a href="--><?php //echo base_url('index.php/postApplicant');?><!--"><button class="btn btn-gradient-success">Post Applicant (By Agent)</button></a>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-shadow">
                            <?php echo $this->session->flashdata('msg'); ?>
                            <div class="card-body">
                                <div class="p-h-15 p-v-40">
                                    <h2>Login</h2>
                                    <p class="m-b-15 font-size-13">Please enter your user name and password to login</p>
                                    <form action="<?php echo base_url('index.php/login');?>" method="post">
                                        <div class="form-group">
                                            <input id="userName" name="userName" type="text" class="form-control" placeholder="User Name or Unique Id">
                                            <?php echo form_error('userName'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                            <?php echo form_error('password'); ?>
                                        </div>
                                        <button class="btn btn-block btn-lg btn-gradient-success" type="submit">Login</button>

                                    </form>
                                    <div class="text-center m-t-30">
                                        <a href="<?php echo base_url('index.php/forgotPassword');?>" class=" text-link text-opacity">Forgot Password?</a>
                                        <p>Create new account? <a href="<?php echo base_url('index.php/register');?>">Sign Up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/vendor.js"></script>

    <script src="assets/js/app.min.js"></script>

    <!-- page js -->
    
</body>

</html>