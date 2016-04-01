<?php

if (!defined('BASEPATH'))
    exit('Not a valid request!');

/**
 * Description of registration
 *
 * @version     0.0.1
 * @since       0.0.1
 * @access      public
 */
class Registration extends CI_Controller {

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
    }

//--------------------------------------------------------------------------

    /**
     * This function is used to load the UI for Home page into the system.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     */
    public function home() {
#loading the required views
        $this->load->view('header');
        $this->load->view('jobseeker_register');
        $this->load->view('footer');
    }

//--------------------------------- Jobseeker Related Methods
//--------------------------------------------------------------------------
    /**
     * This function is used to load the UI for registering a new user into the system.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     */
    public function index() {
#loading the required views
        $this->load->view('header');
        $this->load->view('home');
        $this->load->view('footer');
    }

    /**
     * This function is to check if the entered email is available for jobseeker.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @return      boolean     Returns TRUE if email is available, FALSE otherwise
     */
    public function checkEmailAvailability() {

#reading the posted values
        $userEmail = $_POST['email'];
#loading the required model
        $this->load->model('registration_model', 'obj_reg', TRUE);
        $return_val = $this->obj_reg->checkEmailAvailability($userEmail);

        echo json_encode($return_val);
    }

//--------------------------------------------------------------------------
    /**
     * This function handles the request for registering a new Jobseeker into the system.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     */
    public function addNewJobseeker() {

#array to hold response to be displayed
        $arr_response = array();
#default error
        $arr_response['status'] = ERROR_DEFAULT;

#loading the validation library
        $this->load->library('form_validation');

#setting up the validation rules
        $this->form_validation->set_rules('userName', 'Name', 'trim|required|html_entities|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|html_entities|xss_clean');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required||html_entities|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'trim|required||html_entities|xss_clean');
        
       // $this->form_validation->set_rules('overall', 'Overall', 'trim|required||html_entities|xss_clean');
       // $this->form_validation->set_rules('experience', 'Experience', 'trim|required|html_entities|xss_clean');
       // $this->form_validation->set_rules('training', 'Training', 'trim|html_entities|xss_clean');
       // $this->form_validation->set_rules('address', 'Address', 'trim|required|html_entities|xss_clean');
       // $this->form_validation->set_rules('currentAddress', 'Current Address', 'trim|required|html_entities|xss_clean');
#running the rules
        if ($this->form_validation->run() == FALSE) {
#validation test failed
            $arr_response['status'] = ERROR_VALIDATION;
            $arr_response['userName'] = form_error('userName');
            $arr_response['email'] = form_error('email');
            $arr_response['mobile'] = form_error('mobile');
            $arr_response['password'] = form_error('password');

          //  $arr_response['overall'] = form_error('overall');
           // $arr_response['experience'] = form_error('experience');
           // $arr_response['training'] = form_error('training');
           // $arr_response['address'] = form_error('address');
           // $arr_response['currentAddress'] = form_error('currentAddress');
        } else { #validation test passed
#loading the required model
            $this->load->model('registration_model', 'obj_reg', TRUE);

#writing the user login information into the DB
            $return_value = $this->obj_reg->addNewJobseeker();
            if ($return_value === 'email') {
                $arr_response['status'] = ERROR_DB;
                $arr_response['message'] = 'User already registered. Please use another Email.';
            } else if ($return_value) { #information saved successfully
#check if the user is coming for registration after doing some payment
                $arr_response['status'] = SUCCESS;
                $arr_response['message'] = 'User Registered Successfully. Please <a href="http://zoomingcareers.com">login</a> and update your profile.';
                $arr_response['password'] = $return_value;
            } else {
                $arr_response['status'] = ERROR_DB;
                $arr_response['message'] = 'Database query failed. Please retry';
            }
        }
        echo json_encode($arr_response);
    }
//--------------------------------------------------------------------------
    /**
     * This function is to sent mail for forgot password.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @return      boolean     Returns TRUE if email is available, FALSE otherwise
     */
    public function forgotPasswordJobseeker() {
        #loading the required model
        $this->load->model('registration_model', 'obj_reg', TRUE);
        $return_val = $this->obj_reg->forgotPasswordJobseeker($_POST['email']);
        if ($return_val) {
                $arr_response['status'] = SUCCESS;
                $arr_response['password']=$return_val;
                $arr_response['message'] = 'Your Password send to your mail. Please <a href="http://zoomingcareers.com">login</a> and reset password';
            } else { 
                $arr_response['status'] = ERROR_DB;
                $arr_response['password']=$return_val;
                $arr_response['message'] = 'Please enter your registered email address.';
            } 
        echo json_encode($arr_response);
    }


//--------------------------------------------------------------------------
    /**
     * This function is to check if the entered email is available for Employer.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @return      boolean     Returns TRUE if email is available, FALSE otherwise
     */
    public function checkEmailAvailabilityEmployer() {

#reading the posted values
        $userEmail = $_POST['jobseeker_email'];
#loading the required model
        $this->load->model('registration_model', 'obj_reg', TRUE);
        $return_val = $this->obj_reg->checkEmailAvailabilityEmployer($userEmail);

        echo json_encode($return_val);
    }

//--------------------------------------------------------------------------
    /**
     * This function handles the request for registering a new Employer into the system.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     */
    public function addNewJobseekerEmployer() {

#array to hold response to be displayed
        $arr_response = array();
#default error
        $arr_response['status'] = ERROR_DEFAULT;

#loading the validation library
        $this->load->library('form_validation');

#setting up the validation rules
        $this->form_validation->set_rules('jobseeker_name', 'Jobseeker Name', 'trim|required|html_entities|xss_clean');
        $this->form_validation->set_rules('jobseeker_email', 'Jobseeker Email', 'trim|required|html_entities|xss_clean');
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required||html_entities|xss_clean');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required|html_entities|xss_clean');
        $this->form_validation->set_rules('jobseeker_mobile', 'Jobseeker Mobile', 'trim|html_entities|xss_clean');
#running the rules
        if ($this->form_validation->run() == FALSE) {

#validation test failed
            $arr_response['status'] = ERROR_VALIDATION;
            $arr_response['jobseeker_name'] = form_error('jobseeker_name');
            $arr_response['jobseeker_email'] = form_error('jobseeker_email');
            $arr_response['company_name'] = form_error('company_name');
            $arr_response['designation'] = form_error('designation');
            $arr_response['jobseeker_mobile'] = form_error('jobseeker_mobile');
        } else {
            #validation test passed
#loading the required model
            $this->load->model('registration_model', 'obj_reg', TRUE);

#writing the user login information into the DB
            $return_value = $this->obj_reg->addNewEmployer();
            if ($return_value === 'email') {
                $arr_response['status'] = ERROR_DB;
                $arr_response['message'] = 'Employer already registered. Please check your Email.';
            } else if ($return_value) { #information saved successfully
#check if the user is coming for registration after doing some payment
                $arr_response['status'] = SUCCESS;
                $arr_response['message'] = 'Employer registered successfully.';
            } else {
                $arr_response['status'] = ERROR_DB;
                $arr_response['message'] = 'Database query failed. Please retry';
            }
        }
        echo json_encode($arr_response);
    }

//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
    /**
     * This function is to sent mail for forgot password.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @return      boolean     Returns TRUE if email is available, FALSE otherwise
     */
    public function forgotPassword() {
        #loading the required model
        $this->load->model('registration_model', 'obj_reg', TRUE);
        $return_val = $this->obj_reg->forgotPassword($_POST['jobseeker_email']);
        echo json_encode($return_val);
    }

}

//End of class Registration

/* End of file registration.php */
/* Location: ./application/controllers/regis/registration.php */
