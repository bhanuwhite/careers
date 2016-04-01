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
        $this->load->view('login');
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

    public function welcome() {
        error_reporting(0);
	if($_SESSION['auth'] == true)
        {
	#loading the required model
      $this->load->model('jobseeker_model', 'obj_reg', TRUE);

	#writing the user login information into the DB

      $return_value = $this->obj_reg->get_users();
      $data['users_data'] = $return_value; 
	//echo json_encode($return_value);
        $this->load->view('welcome',$data);
        }
        else
        {
            redirect('/login', 'refresh');
        }
    }

	public function search()
	{
            if($_SESSION['auth'] == true)
            {
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
