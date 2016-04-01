<?php

if (!defined('BASEPATH'))
    exit('Not a valid request!');

/**
 * Description of login
 *
 * @version     0.0.1
 * @since       0.0.1
 * @access      public
 */
class Jobseeker extends CI_Controller {

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        session_start();
    }

//--------------------------------------------------------------------------
    /**
     * This function is used to load the UI for login page for job provider.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     */
    public function index() {
#loading the required views
        unset($_SESSION['auth_jobseeker']);
        unset($_SESSION['jobseeker_email']);
        $this->load->view('jobseeker_login');
    }

    //--------------------------------------------------------------------------   
    /**
     * This function is used to logging in into the system after verifying the user credentials
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @author      arthur
     */
    public function login() {

        #array to store response to be displayed
        $arr_response = array();

        #default response status message
        $arr_response['status'] = 1100;
        #loading the validation library
        $this->load->library('form_validation');

#setting up the validation rules
        $this->form_validation->set_rules('password', 'Password', 'trim|required|html_entities|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|html_entities|xss_clean');
#running the rules
        if ($this->form_validation->run() == FALSE) {
#validation test failed
            $arr_response['status'] = ERROR_VALIDATION;
            $arr_response['password'] = form_error('password');
            $arr_response['email'] = form_error('email');
        } else {
            #validation test passed
            #loading the required model
            $this->load->model('authorization_model', 'obj_auth', TRUE);
            #matching the user credentials
            $returned_value = $this->obj_auth->check_login_credentials_jobseeker();
            //var_dump($_POST);exit();
            if ($returned_value) {
                #login credentials are correct
                $arr_response['status'] = 1000;

                #if redirect url exists in the session
                $redirect_url = $this->session->userdata('redirect_to');
                if ($redirect_url) {
                    $arr_response['mydirect'] = $redirect_url;
                    $this->session->unset_userdata('redirect_to');
                } else {
                    $arr_response['mydirect'] = base_url();
                }
            } else {
                $arr_response['status'] = 1300;
            }
            echo json_encode($arr_response);
        }
    }

    public function logout() {
        session_destroy();
        redirect(base_url());
    }
    public function welcome() {
        error_reporting(0);
        if ($_SESSION['auth_jobseeker'] == true) {
            $this->jobseeker_profile($_SESSION['jobseeker_email']);
        } else {
            redirect(base_url().'login');
        }
    }

    //--------------------------------------------------------------------------   
    /**
     * This function is used for employer verify login
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @author      arthur
     */
    public function verify() {
        #loading the required model
        $this->load->model('authorization_model', 'obj_auth', TRUE);
        #matching the user credentials
        $returned_value = $this->obj_auth->check_login_credentials_jobseeker($_POST['email'], $_POST['password']);
        //var_dump($returned_value);
        //exit;
        if ($returned_value) {
            $arr_response['status'] = true;

            $_SESSION['auth_jobseeker'] = true;
            $_SESSION['jobseeker_email'] = $_POST['email'];

            //var_dump($_SESSION);exit;
        } else {
            $arr_response['status'] = false;
        }

        echo json_encode($arr_response);
    }

    //--------------------------------------------------------------------------
    /**
     * This function is to for Jobseeker Profile Update.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     */
    public function jobseeker_profile($email) {
        if ($_SESSION['auth_jobseeker'] == true && $_SESSION['jobseeker_email'] == $email) {
            //$email = "admin@zoomtech.com";
#loading the required model
            $this->load->model('jobseeker_model', 'obj_reg', TRUE);

#fetching user data
            $user_data = $this->obj_reg->get_user_data($email);
            $data['course'] = $this->obj_reg->get_course();
            //var_dump($user_data);exit;
            $data['user_data'] = $user_data;
            $this->load->view('header');
            $this->load->view('jobseeker_profile', $data);
            $this->load->view('footer');
        } else {
            redirect(base_url().'login');
        }
    }

//--------------------------------------------------------------------------
    /**
     * This function is used for jobseeker profile update.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     */
    public function jobseeker_update() {

        $arr_response = array();
#default error
        $arr_response['status'] = ERROR_DEFAULT;
        if ($_SESSION['auth_jobseeker'] == true) {
            # check login here
            # check already email
            #update records if login
            #array to hold response to be displayed
            
            #loading the required model
           $this->load->model('registration_model', 'obj_reg', TRUE);

#writing the user login information into the DB
                $return_value = $this->obj_reg->jobseekerUpdate();
                if ($return_value === 'email') {
                    $arr_response['status'] = ERROR_DB;
                    $arr_response['message'] = 'User already registered. Please use another Email.';
                } else if ($return_value) { #information saved successfully
#check if the user is coming for registration after doing some payment
                    $arr_response['status'] = SUCCESS;
                    $arr_response['message'] = 'Profile updated  successfully';
                } else {
                    $arr_response['status'] = ERROR_DB;
                    $arr_response['message'] = 'Database query failed. Please retry';
                }
        } else {
            // header('Location:http://zoomgroup.com/careers/jobseeker');
        }
        echo json_encode($arr_response);
    }

    
 //------------------------------------------------------------------------------
    public function jobseeker_upload_resume() {
            
            $arr_response['status'] = ERROR_DEFAULT;
        if ($_SESSION['auth_jobseeker'] == true) {

            $info = pathinfo($_FILES['file']['name']);

            $ext = $info['extension']; // get the extension of the file
            if ($ext == "docx" || $ext == 'doc' || $ext == 'pdf') {
                $filename = uniqid().'-'.date('Ymd His') . '.' . $ext;
                chmod(APPATH.'resumes/', 777);
                if(move_uploaded_file($_FILES['file']['tmp_name'], 'resumes/' . $filename))
                {
                   chmod($filename, 777);
                  $this->load->model('registration_model', 'obj_reg', TRUE);

                    #writing the user login information into the DB
                if($this->obj_reg->jobseeker_upload_resume($filename))
                  {
                    $arr_response['status'] = SUCCESS;
                    $arr_response['message'] = 'Resume upload successfully.';
                    $arr_response['file'] = $filename;
                  }
                }else{
                    $arr_response['status'] = ERROR_DB;
                    $arr_response['message'] = 'Resume not uploaded. Please Try again.';
                    $arr_response['error'] = $_FILES['file']['error'];
                }
            } else {
                $arr_response['status'] = ERROR_DB;
                $arr_response['message'] = 'You should upload only pdf or word documents.';
            }
        }echo json_encode($arr_response);
    }
    
    public function jobseeker_update_password() {
        if ($_SESSION['auth_jobseeker'] == true) {
            #auth user here
            #update password here
            //var_dump($_POST);
            //exit;
            #array to hold response to be displayed
            $arr_response = array();
#default error
            $arr_response['status'] = ERROR_DEFAULT;

#loading the required model
            $this->load->model('registration_model', 'obj_reg', TRUE);

#writing the user login information into the DB
            $return_value = $this->obj_reg->jobseekerUpdatePassword();
            if ($return_value === 'email') {
                $arr_response['status'] = ERROR_DB;
                $arr_response['message'] = 'User already registered. Please use another Email.';
            } else if ($return_value) { #information saved successfully
#check if the user is coming for registration after doing some payment
                $arr_response['status'] = SUCCESS;
                $arr_response['message'] = 'Password changed successfully';
            } else {
                $arr_response['status'] = ERROR_DB;
                $arr_response['message'] = 'Database query failed. Please retry';
            }
        } else {
            // header('Location:http://zoomgroup.com/careers/jobseeker');
            $arr_response['status'] = ERROR_DB;
            $arr_response['message'] = 'Database query failed. Please retry';
        }
        echo json_encode($arr_response);
    }

    public function search() {

#loading the required model
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);

#writing the user login information into the DB
        $return_value = $this->obj_reg->serach_users();
        if (count($return_value) > 0) {
            $arr_response['status'] = SUCCESS;
            $arr_response['data'] = $return_value;
        } else {
            $arr_response['status'] = ERROR_DB;
            $arr_response['data'] = $return_value;
        }
        //var_dump($return_value);exit;
        echo json_encode($arr_response);
    }

}

//End of class login

//End of file login.php
/* Location: ../../controllor/login.php */
