<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7 ieold"><![endif]-->
<!--[if IE 8 ]><html class="ie8 ieold"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html><!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <!-- Title -->
        <title>Zooming Careers</title>
        <link href="<?php echo base_url(); ?>assets/images/zooming-favicon.ico" rel="icon" type="image/x-icon" />

        <!-- Site Meta -->
        <meta name="description" content="ZOOMING Careers">

        <!-- Win 8 Tiles -->
        <meta name="application-name" content="ZOOMING Careers"/>

        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/zooming-stylesheet.css">

        <!-- Google Fonts IPs -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-theme.min.css">

        <!-- Owl Carousel Assets -->
        <link href="<?php echo base_url(); ?>assets/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/owl-carousel/owl.theme.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/owl-carousel/owl.transitions.css" rel="stylesheet">

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/owl-carousel/owl.carousel.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/owl.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/constant.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/login.js"></script>
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
    </head>

    <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="container"> <!-- Container -->
                    <div class="row">

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href=""><i class="glyphicon glyphicon-phone"></i>  Whatsapp: +91-83744-27052</a></li>
                                <li><a href="mailto:jobs@zoomingcareers.com"><i class="fa fa-envelope-o"></i> &nbsp; jobs@zoomingcareers.com</a></li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                                <li><a href="<?php echo base_url(); ?>login/contactUs">Contact Us</a></li>
                                <li><a href="<?php echo base_url(); ?>login/index">Job Seeker</a></li>
                                <li><a href="<?php echo base_url(); ?>login/employerRegister">Employer</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Admin Login</b> <span class="caret"></span></a>
                                    <ul id="login-dp" class="dropdown-menu">
                                        <li>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-form">
                                                        <div class="form-group">
                                                            <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                            <input type="email" class="form-control" id="inputEmail" name="inputEmail3" placeholder="Email address" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                            <input type="password" class="form-control" name="inputPassword3" id="inputPassword" placeholder="Password" >
                                                            <div class="help-block text-right"><a href="">Forget the password ?</a></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" id="admin-login" class="btn btn-success success-green btn-block">Sign in</button>
                                                        </div>
                                                      
                                                    </form>
                                                </div>
                                                <div class="bottom text-center">
                                                    New here ? <a href="#"><b>Join Us</b></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div> <!-- ./Collapse -->
                    </div>
                </div> <!-- ./Container -->

            </div>
        </nav>

        <div class="container"> <!-- Container -->
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="sub-header">
                    <div class="row">
                        <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>assets/images/logo.png" alt="Zooming Careers" /></a>
                        <p class="slogan">Only Networking Jobs Site</p>
                    </div>
                </div>
            </div>	
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="row">
                    <p class="btn btn-default btn-sm get-train"><a href="http://zoomgroup.com/"><span class="glyphicon glyphicon-education"></span> Get Trained Get Job</a></p>
                </div>
            </div>
        </div> <!-- ./Container -->