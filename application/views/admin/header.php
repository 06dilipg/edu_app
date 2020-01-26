<?php
header("Content-Type: text/html; charset=ISO-8859-1");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sarvodaya College Of Nursing IMS</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="<?php echo base_url('assets/images/logo/apple-touch-icon.png')?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png')?>">

    <!-- core dependcies css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/dist/css/bootstrap.css')?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/PACE/themes/blue/pace-theme-minimal.css')?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/perfect-scrollbar/css/perfect-scrollbar.min.css')?>"/>

    <!-- page css -->
    <link href="<?php echo base_url('assets/vendor/selectize/dist/css/selectize.default.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/summernote/dist/summernote-bs4.css')?>"  rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/datatables/media/css/dataTables.bootstrap4.min.css')?>" rel="stylesheet" />

    <!-- core css -->
    <link href="<?php echo base_url('assets/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/themify-icons.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/materialdesignicons.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/animate.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/app.css')?>" rel="stylesheet">




    <script src="<?php echo base_url('assets/js/vendor.js')?>"></script>
    <script src="<?php echo base_url('assets/js/validation/jquery.validate.js')?>"></script>

   <!--  <link rel="stylesheet" href="https://twitter.github.io/typeahead.js/css/examples.css" />  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script src="https://twitter.github.io/typeahead.js/js/handlebars.js"></script>
    <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    

</head>

<body>
<div class="app header-default side-nav-dark">
    <div class="layout">
        <!-- Header START -->
        <div class="header navbar">
            <div class="header-container">
                <div class="nav-logo">
                    <a href="">
                        <div class="logo logo-dark" style="background-image: url('<?php echo base_url('assets/images/logo/logo.png')?>')"></div>
                        <div class="logo logo-white" style="background-image: url('<?php echo base_url('assets/images/logo/logo.png')?>')"></div>

                    </a>
                </div>
                <ul class="nav-left">
                    <li>
                        <a class="sidenav-fold-toggler" href="javascript:void(0);">
                            <i class="mdi mdi-menu"></i>
                        </a>
                        <a class="sidenav-expand-toggler" href="javascript:void(0);">
                            <i class="mdi mdi-menu"></i>
                        </a>
                    </li>
<!--                    <li class="search-box">-->
<!--                        <a class="search-toggle" href="javascript:void(0);">-->
<!--                            <i class="search-icon mdi mdi-magnify"></i>-->
<!--                            <i class="search-icon-close mdi mdi-close-circle-outline"></i>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li class="search-input">-->
<!--                        <input class="form-control" type="text" placeholder="Type to search...">-->
<!---->
<!--                        <div class="search-predict">-->
<!--                            <div class="search-wrapper scrollable">-->
<!--                                <div class="p-v-10">-->
<!--                                        <span class="display-block m-v-5 p-h-20 text-gray">-->
<!--                                            <i class="ti-file p-r-5"></i>-->
<!--                                            <span>Files</span>-->
<!--                                        </span>-->
<!--                                    <ul class="list-media">-->
<!--                                        <li class="list-item">-->
<!--                                            <a href="javascript:void(0);" class="media-hover p-h-20">-->
<!--                                                <div class="media-img">-->
<!--                                                    <div class="icon-avatar bg-success">-->
<!--                                                        <i class="mdi mdi-file-outline"></i>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                                <div class="info">-->
<!--                                                    <span class="title p-t-10">Document.xls</span>-->
<!--                                                </div>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                        <li class="list-item">-->
<!--                                            <a href="javascript:void(0);" class="media-hover p-h-20">-->
<!--                                                <div class="media-img">-->
<!--                                                    <div class="icon-avatar bg-info">-->
<!--                                                        <i class="mdi mdi-file-outline"></i>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                                <div class="info">-->
<!--                                                    <span class="title p-t-10">Mockup.doc</span>-->
<!--                                                </div>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                        <li class="list-item">-->
<!--                                            <a href="javascript:void(0);" class="media-hover p-h-20">-->
<!--                                                <div class="media-img">-->
<!--                                                    <div class="icon-avatar bg-danger">-->
<!--                                                        <i class="mdi mdi-file-outline"></i>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                                <div class="info">-->
<!--                                                    <span class="title p-t-10">Document.pdf</span>-->
<!--                                                </div>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                </div>-->
<!--                                <div class="m-h-20 border top"></div>-->
<!--                                <div class="p-v-10">-->
<!--                                        <span class="display-block m-v-5 p-h-20 text-gray">-->
<!--                                            <i class="ti-user p-r-5"></i>-->
<!--                                            <span>Members</span>-->
<!--                                        </span>-->
<!--                                    <ul class="list-media">-->
<!--                                        <li class="list-item">-->
<!--                                            <a href="javascript:void(0);"-->
<!--                                               class="conversation-toggler media-hover p-h-20">-->
<!--                                                <div class="media-img">-->
<!--                                                    <img src="assets/images/avatars/thumb-3.jpg" alt="">-->
<!--                                                </div>-->
<!--                                                <div class="info">-->
<!--                                                    <span class="title p-t-10">Debra Stewart</span>-->
<!--                                                </div>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                        <li class="list-item">-->
<!--                                            <a href="javascript:void(0);"-->
<!--                                               class="conversation-toggler media-hover p-h-20">-->
<!--                                                <div class="media-img">-->
<!--                                                    <img src="assets/images/avatars/thumb-5.jpg" alt="">-->
<!--                                                </div>-->
<!--                                                <div class="info">-->
<!--                                                    <span class="title p-t-10">Jane Hunt</span>-->
<!--                                                </div>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="search-footer">-->
<!--                                <span>You are Searching for '<b class="text-dark"><span class="serach-text-bind"></span></b>'</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </li>-->
                </ul>
                <ul class="nav-right">

                    <li class="user-profile dropdown dropdown-animated scale-left">

                        <a href="" class="dropdown-toggle" data-toggle="dropdown">
                            <img class="profile-img img-fluid" src="<?php echo base_url($this->session->userdata("profileImgPath"))?>" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-md p-v-0">
                            <li>
                                <ul class="list-media">

                                    <li class="list-item p-15">
                                        <div class="media-img">
                                            <img src="<?php echo base_url($this->session->userdata("profileImgPath"))?>" alt="">
                                        </div>
                                        <div class="info">
                                            <span class="title text-semibold"><?php echo $this->session->userdata("firstName");?></span>
                                            <span class="sub-title text-info">ID:<?php echo $this->session->userdata("uniqueId");?></span>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li role="separator" class="divider"></li>
<!--                            <li>-->
<!--                                <a href="">-->
<!--                                    <i class="ti-settings p-r-10"></i>-->
<!--                                    <span>Setting</span>-->
<!--                                </a>-->
<!--                            </li>-->
                            <li>
                                <a href="<?php echo  base_url('index.php/viewUser/'.$this->session->userdata("userId")) ;?>">
                                    <i class="ti-user p-r-10"></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/welcome/changePassword');?>">
                                    <i class="ti-lock p-r-10"></i>
                                    <span>Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/logout');?>">
                                    <i class="ti-power-off p-r-10"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!--  <li class="m-r-10">
                         <a class="quick-view-toggler" href="javascript:void(0);">
                             <i class="mdi mdi-format-indent-decrease"></i>
                         </a>
                     </li> -->
                </ul>
            </div>
        </div>
        <!-- Header END -->