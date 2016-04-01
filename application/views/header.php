<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Zoom Technologies offers Online CCIE Training, Online CCNP Training, Online MCSE Training, Online VMware Training, Online Linux Training, Online Cisco Training, Online CCNA Training, Online Ethical Hacking & Security Courses, etc. online courses.">
        <meta name="keywords" content="online ccie training, online ccnp training, online mcse training, online vmware training, online linux training, online cisco training, online ccna training, online ethical hacking & security courses, zoom technologies">
        <meta name="author" content="Team Ahex Technologies">
        <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

        <title></title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>assets/css/theme.css" rel="stylesheet">
        <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'> -->
         <!--<link href="<?php echo base_url(); ?>assets/css/fonts.css" rel="stylesheet" type="text/css"/> -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/innerpages.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/ddsmoothmenu.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugin/perfectscroll/perfect-scrollbar.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/accordian.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/careers.css"/>
        <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.css" rel="stylesheet">
        <!-- Data Table css and js -->
        <link href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>

        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/datatables.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/perfectscroll/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/perfectscroll/perfect-scrollbar.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/jobseeker.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/constant.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jobseeker_view_details.js"></script>
        <style>
            #table_box_length label:before  { background:none !important;  }
            #table_box_length label:after  {  content:'' !important;  }
            #table_box_filter label:before  {   background:none !important; }
            #table_box_filter label:after  {  content:'' !important;  }
            .downarrowclass  {   display:none !important;   }
            #table_box_length , #table_box_filter  { display:none;  }
            #table_box{  font-size: 12px;   }
            .modal-body.view-modals{ height: auto;   }
            .modal-body.view-modals .table{ font-size: 13px;  }
            .inside-wrap { margin: 8px 29px;  }
            #table_box a:hover{  text-decoration: none;    }
            #table_box {   color: black;   }
            #table_box_wrapper{
                border: 1px solid #ddd;
                margin-bottom: 15px;               
                width: 100%; 
            }
        </style>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-16208766-5', 'auto');
            ga('send', 'pageview');

        </script>
        <!-- Bootstrap select CSS -->
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">
    </head>
    <body class="online-training">
        <div id="headerBar">
            <!-- Header Bar -->
            <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="ZOOM Technologies, CCNA India, CCIE India, Cisco Bootcamps, Microsoft Boot Camps"
                 class="logo" />  
            <div id="navBarTop">
            </div>
            <!-- End Header Bar -->
            <br style="clear: both" />
            <!--</div>-->
            <div class="container" >
                    <div class="row">
                        <div class="navbar-collapse collapse" id="navBarMain">
                            <ul>
                                <?php
                                if ($this->session->userdata('logged') != '') {
                                    $role_id = $this->session->userdata('role_id');
                                    if ($role_id == 0) {
                                        echo "<li><a class='corner' href=" . base_url() . "jobseeker/welcome>Home</a></li>";
                                    } else {
                                        echo "<li><a class='corner' href=" . base_url() . "login/welcome>Home</a></li>";
                                    }
                                    if ($role_id == -1) {
                                        ?>
                                        <li><a href="<?php echo base_url(); ?>welcome/employerRegister" >Employer</a></li>
                                        <li><a href="<?php echo base_url(); ?>welcome/add_course" >Course</a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
                                            <ul class="dropdown-menu" id="submenu">
                                                <li><a href="<?php echo base_url(); ?>welcome/seekerGotJob">Job selected students</a></li>
                                                <li><a href="<?php echo base_url(); ?>welcome/studentsEmailToEmployer">Mails to Employer</a></li>
                                            </ul>
                                        </li>
                                    <?php } ?>

                                    <li><a class="last" href="<?php echo base_url(); ?>login/logout">Logout</a></li>
                                    <?php } ?>
                            </ul>
                        </div>
                    </div>
