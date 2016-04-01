<div class="mainPicture">
    <div class="jobseeker-outer" id="jobseeker_login">
        <div class="jobseeker-login">
            <div class="col-md-12 col-sm-12">
                <span class="js-heading">Job Seeker</span>
            </div>
            <div id="errJobseeker"></div> 
            <form class="navbar-form job-seeker" role="form" id="login-form-jobseeker">
                <div class="form-group">
                    <div class="input-group ">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  type="email" class="form-control" id="inputEmail3" name="inputEmail3" placeholder="Email Address" />     
                    </div>
                    <label for="inputEmail3" class="error"></label>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" name="inputPassword3" id="inputPassword3" placeholder="Password" />
                    </div>
                    <label for="inputPassword3" class="error"></label>
                </div>

                <div class="form-group col-md-12 col-sm-12 col-md-offset-1">
                    <button type="submit" id="jobseeker-login" class="btn btn-default btn-success">Login</button>
                    <div class="col-md-4 col-sm-6">
                        <p class="bottom text-left">New Here? <a href="<?php echo base_url();?>registration/home">Register Now</a></p>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <p class="bottom text-left"><a href="#" id="forget_password_link">Forget the password?</a></p>
                    </div>
                </div>

            </form>
        </div><!-- /jobseeker-login -->
    </div><!-- /jobseeker-outer -->
       <div class="jobseeker-outer" id="forget_password">
        <div class="jobseeker-login">
            <div class="col-md-12 col-sm-12">
                <span class="js-heading"> Forget Password</span>
            </div>
            <form class="navbar-form job-seeker" role="form" id="jobseeker_forget_password">
               <div id="errForgetPass"></div> 
                <div class="form-group"  style="padding:27px 0 0;">
                    <div class="input-group ">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  type="email" class="form-control" id="forget_pass" name="forget_pass" placeholder="Email Address" />     
                    </div>
                    <label for="forget_pass" class="error"></label>
                </div>
                <div class="form-group"  style="padding:10px 0 0;">
                    <div class="input-group">
                        <button type="submit" id="jobseeker-forgetPass" class="btn btn-default btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="Corporate-Training-Main">
                    <h2>Top Employers</h2>
                    <div id="owl-clients" class="owl-carousel owl-theme">
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/microsoft-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/cisco-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/ibm-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/deloitte-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/csc-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/accenture-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/tata-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/oracle-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/wipro-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/infosys-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/allianz-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/techmahindra-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/att-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/hcl-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/bsnl-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/cnbc-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/ge-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/stromeshield-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/ikip-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/netasq-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/zoomtech-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/uscouncil-logo.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo base_url(); ?>/assets/corporate-logos/signature-logo.jpg" alt=""></div>
                    </div>
                </div> <!-- /. Corporate-Training-Main -->
            </div> <!-- /. col-lg-12 col-md-12 col-sm-12 -->
        </div>
    </div> <!-- /.container -->

</div> <!-- /. mainPicture -->

<div class="container">
    <div class="home-aboutus">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <p>We are the only job site in India dedicated to networking and security professionals , founded way back in 2000. We are a part of the Zoom group of companies with headquarters in Hyderabad, India.</p>
                <p>Zoom Technologies is a pioneering leader in network and security solutions. For well over 2 decades, Zoom has designed and built avant-garde secure networks for hundreds of clients. Zoom was the first to set up an IPsec VPN in India, the first to set up a Linux based WAN (the largest network in India), the first to set up a 24 X 7 antivirus and malware support center in India, and of course the first to offer a comprehensive bundle of networking and security courses. The list goes on...</p>
                <p>We train several engineers a month at our state of the art training centers. We have one of the biggest databases of network and security professionals across the world.</p>
                <p>We have trained over 200,000 engineers, most of them employed with several multinationals worldwide.</p>
            </div> <!-- /. col-lg-8 col-md-8 col-sm-8 -->
        </div>
    </div> <!-- /.home-aboutus -->
</div> <!-- /.container -->

<div class="Online-Training-Home">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3"> <!-- col-lg-3 -->
                <div class="Online-Training-Content">
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/uOgQZlgFuR0" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <p class="text-center"><strong>Corporate Video</strong></p>
                </div> <!-- /. Online-Training-Content -->
            </div> <!-- /. col-lg-3 -->

            <div class="col-lg-3 col-md-3 col-sm-3"> <!-- col-lg-3 -->
                <div class="Online-Training-Content">
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/8sGG6_HBOo0" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <p class="text-center"><strong>Online CCIE Training</strong></p>
                </div> <!-- /. Online-Training-Content -->
            </div> <!-- /. col-lg-3 -->

            <div class="col-lg-6 col-md-6 col-sm-6"> <!-- col-lg-6 -->
                <div class="Online-Training-Content otc-border-left">
                    <h3 class="text-uppercase">Online Training</h3>
                    <p>Online Training@Zoom is a cost effective method of learning new networking skills from the convenience of your home/workplace. Professionals need to constantly update their skill portfolios to stay relevant in today's fast changing world. Taking an online training course has many advantages for everyone (Fresher / Working Professional). Zoom offers online training for the highly coveted CCNA, CCNP and CCIE courses as well as MCSE, Linux, VMware, Ethical Hacking and Firewalls, IPv6 with more courses planned for the near future.
                        <strong>Check out</strong> our online course offerings at: <a href="http://zoomgroup.com/online_course/">Online Training</a></p>
                </div> <!-- /. Online-Training-Content -->
            </div> <!-- /. col-lg-6 -->
        </div> <!-- /. Row -->
    </div> <!-- /. Container -->
</div> <!-- /. Online-Training-Home -->

<!-- Testimonials -->

<section id="clients-reviews">
    <div class="container">
        <h2>Testimonials</h2>
        <div class="row">
            <div class="col-lg-12 text-center">
                        <p>My experience with ZoomingCareers was really great... Excellent site. Recently I accepted a full time position with a Fortune 500 company as a Project Analyst. All this could not have been possible without your service!!! Thank you very much and I will continue to recommend your website to everyone.</p>
                        <br>
                        <h4><span class="name">Dick R.</span> | <span class="post">IT Analyst</span> </h4>
            </div>
        </div>
    </div>
</section>

<div class="clearfix">&nbsp;</div>


<!-- Footer -->
<footer>

    <div class="footer"> <!-- Footer -->
        <div class="container">

            <div class="col-lg-56 col-sm-5 col-md-5">
                <div class="row">
                    <ul>
                        <li><a href="http://zoomingcareers.com/">Home</a></li>
						<li><a href="http://zoomingcareers.com/login/contactUs">Contact Us</a></li>
						<li><a href="http://zoomingcareers.com/">Job Seeker</a></li>
						<li><a href="http://zoomingcareers.com/login/employerRegister">Employer</a></li>
                    </ul>	
                </div>
            </div>

            <div class="col-lg-3 col-sm-3 col-md-3">
                <div class="row">
                    <h3>Keep In Touch</h3>
                    <ul class="social">
                        <li><a href="http://www.facebook.com/ZoomTechnolgies" target="_blank"><i class="fa fa-lg fa-facebook facebook"></i></a></li>
                        <li><a href="https://twitter.com/zoomgroupindia" target="_blank"><i class="fa fa-lg fa-twitter twitter"></i></a></li>
                        <li><a href="http://www.linkedin.com/in/zoomtechnologies" target="_blank"><i class="fa fa-lg fa-linkedin linkedin"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-sm-3 col-md-3">
                <div class="row">
                    <h3>Get Quick Info</h3>
                    <ul>
                        <li><i class="glyphicon glyphicon-phone"></i> +91-95731-64017</li>
                        <li><a href="mailto:jobs@zoomingcareers.com"><i class="fa fa-envelope-o"></i> jobs@zoomingcareers.com</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-1 col-sm-1 col-md-1">
                <div class="row">

                </div>
            </div>

        </div> <!-- Container -->
    </div> <!-- /. Footer -->

    <div class="container">
        <p>© 2000 – 2015 Zooming Careers. All Rights Reserved.</p>
    </div> <!-- /. Container -->
</footer>


</body>
</html>