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
class Login extends CI_Controller {

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        session_start();
    }

    public function jobseeker() {
        $this->load->view('jobseeker');
    }

    public function contactUs() {
        $this->load->view('home_header');
        $this->load->view('contact_us');
    }
       public function employerRegister() {

        $this->load->view('home_header');
        $this->load->view('employer');
//        $this->load->view('footer');
    }
//--------------------------------------------------------------------------
    /**
     * This function is used to load the UI for login page for job provider.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     */
    public function index1() {
#loading the required views
        unset($_SESSION['auth']);
        $this->load->view('header');
        $this->load->view('login');
        $this->load->view('footer');
    }

       public function index() {
#loading the required views
        unset($_SESSION['auth']);
        $this->load->view('home_header');
        $this->load->view('index1');
        //$this->load->view('footer');
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
            $returned_value = $this->obj_auth->check_login_credentials();
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
        $this->session->sess_destroy();
        redirect(base_url());
    }
    
    
    public function welcome() {
        error_reporting(E_ALL);

        if ($_SESSION['auth'] == true) {

            #loading the required model
            $this->load->model('jobseeker_model', 'obj_reg', TRUE);

            $Student_id = 0;
            $return_value = $this->obj_reg->get_users($Student_id);
            $course_list = $this->obj_reg->get_course();

           $employee = $this->obj_reg->get_employee();
            $data['employee'] = $employee;
            $data['users_data'] = $return_value;
            $data['course_list'] = $course_list;
         
            //echo json_encode($return_value);
            $this->load->view('header');
            $this->load->view('welcome', $data);
            $this->load->view('footer');
        } else {
           redirect(base_url().'login');
        }
    }

 
    public function addNewCourse(){
        if ($_SESSION['auth'] == true) {
        $data = array();
       #default error
        $data['status'] = ERROR_DEFAULT;
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);

        $return_value = $this->obj_reg->addNewCourse();
        if ($return_value) {
                $data['status'] = 200;
                $data['message'] = 'Course is added successfully. ';
            } else {
                $data['status'] = 201;
                $data['message'] = 'Course is not added..!';
            }
            echo json_encode($data);
        } else {
           redirect(base_url().'login');
        }
        
    }
    //----------------------------------------------------------
    
    public function get_seeker_details() {
        if ($_SESSION['auth'] == true) {
            $Student_id = $_POST['Student_id'];
            #loading the required model
            $this->load->model('jobseeker_model', 'obj_reg', TRUE);

            $return_value = $this->obj_reg->get_users($Student_id);
            if ($return_value) {
                $data['status'] = 200;
                $data['users_data'] = $return_value;
            } else {
                $data['status'] = 201;
                $data['message'] = 'No data in database';
            }
            echo json_encode($data);
        } else {
           redirect(base_url().'login');
        }
    }

    public function search() {
        if ($_SESSION['auth'] == true) {
            error_reporting(0);
            //var_dump($_POST);
            $search = $_GET['search'];
            #loading the required model
            $this->load->model('jobseeker_model', 'obj_reg', TRUE);

            #writing the user login information into the DB

            $return_value = $this->obj_reg->serach_users($search);
            $data['users_data'] = $return_value;
            echo json_encode($return_value);
            //exit;
        }
    }
    //--------------------------------------------------------
    
    public function get_employee(){
        if ($_SESSION['auth'] == true) {
            error_reporting(0);
            //var_dump($_POST);
            $search = $_GET['search'];
            #loading the required model
            $this->load->model('jobseeker_model', 'obj_reg', TRUE);

            #writing the user login information into the DB

            $return_value = $this->obj_reg->get_employee($search);
            $data['users_data'] = $return_value;
            echo json_encode($return_value);
            //exit;
        }
    }

    public function update_seeker_details() {
        error_reporting(0);
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);

        $return_value = $this->obj_reg->update_seeker_details();
        if ($return_value == TRUE) {
            $arr_response['status'] = 200;
            $arr_response['data'] = $return_value;
            $arr_response['message'] = 'Record updated successfully.';

            //var_dump($_SESSION);exit;
        } else {
            $arr_response['status'] = 201;
            $arr_response['message'] = 'Record not updated.';
            $arr_response['data'] = $return_value;
        }
        echo json_encode($arr_response);
    }

    public function remove_seeker_details() {
        //error_reporting(0);
        //var_dump($_POST);
        $Student_id = $_POST['Student_id'];
        #loading the required model
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);

        #writing the user login information into the DB

        $return_value = $this->obj_reg->remove_seeker_details($Student_id);
        // print_r($return_value);die();
        if ($return_value == TRUE) {
            $arr_response['status'] = 200;
            $arr_response['data'] = $return_value;
            $arr_response['message'] = 'Record deleted successfully.';

            //var_dump($_SESSION);exit;
        } else {
            $arr_response['status'] = 201;
            $arr_response['message'] = 'Record not deleted';
            $arr_response['data'] = $return_value;
        }
        echo json_encode($arr_response);
    }

    public function verify() {
        #loading the required model
        $this->load->model('authorization_model', 'obj_auth', TRUE);
        #matching the user credentials
        $returned_value = $this->obj_auth->check_login_credentials($_POST['email'], $_POST['password']);
        //var_dump($returned_value);
        //exit;
        if ($returned_value) {
            $arr_response['status'] = true;

            $_SESSION['auth'] = true;

            //var_dump($_SESSION);exit;
        } else {
            $arr_response['status'] = false;
        }

        echo json_encode($arr_response);
    }

}

//End of class login

//End of file login.php
/* Location: ../../controllor/login.php */
