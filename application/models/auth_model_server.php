<?php

if (!defined('BASEPATH'))
    exit('Not a valid request!');

/**
 * Description of registration_model
 *
 * @version     0.0.1
 * @since       0.0.1
 * @access      public
 */
class Registration_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
    }

    //--------------------------------------------------------------------------

    /**
     * This function is used to check whether the email entered by the useris already registered or not.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @param       string      $userEmail              Email entered by the user
     * @return      boolean                             Return TRUE if email exists, FALSE otherwise
     */
    public function checkEmailAvailability($userEmail) {

        #checking if the email exista in the database 
        $db_result = $this->db->get_where('jobseeker', array('email' => $userEmail));
        if ($db_result && $db_result->num_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //--------------------------------------------------------------------------

    /**
     * This function is used to write the user login information and user personal information
     * 
     * @version 0.0.1
     * @since   0.0.1
     * @access  public
     * @return  boolean/CI_Result                           
     */
    public function addNewJobseeker() {
        if ($this->checkEmailAvailability($_POST['email'])) {
            $password = substr(md5(microtime()), rand(0, 26), 6);
            $data = array(
                'name' => $_POST['userName'],
		'password' => md5($password),
                'email' => $_POST['email'],
                'mobile' => $_POST['mobile'],
               // 'overall' => $_POST['overall'],
               // 'experience' => $_POST['experience'],
               // 'training' => $_POST['training'],
               // 'address' => $_POST['address'],
               // 'currentAddress' => $_POST['currentAddress'],
                'status'=>'inactive'
            );
            $result = $this->db->insert('jobseeker', $data);
            if ($result > 0) {
                
                
                // Insert Mail code
                #loading the required library
                $this->load->library('Communication');
                $arr_param = array(
                    'is_html' => TRUE,
                    'from_email' => 'admin@zoomgroup.com',
                    'from_name' => 'Zoom Careers',
                    'to_email' => $_POST['email'],
                    'subject' => 'Your password @zoom careers.',
                    'message' => 'Hello,<br/>Thanks for registering with us.<br/><br/>Your Password is: ' . $password . '<br/>Click below to login.<br/><br/><a href="' . base_url() . 'jobseeker">Login Here</a><br/><br/>After login please update your profile.<br/><br/><br/>Zoom Careers');

                #sending a request to send an email to the user about the class details
                //$this->communication->send_confirmation_email($arr_param);
                
                return $password;
            } else {
                return FALSE;
            }
        } else {
            return 'email';
        }
    }

    //--------------------------------------------------------------------------

    /**
     * This function is used to update jobseeker profile
     * 
     * @version 0.0.1
     * @since   0.0.1
     * @access  public
     * @return  boolean/CI_Result                           
     */
    public function jobseekerUpdate() {
        //var_dump($_POST);exit;

        $data = array(
            'name' => $_POST['name'],
            //'email' => $_POST['email'],
            'mobile' => $_POST['mobile'],
            'curr_location' => $_POST['curr_location'],
            'age' => $_POST['age'],
            'degree' => $_POST['degree'],
            'c_courses' => implode(',',$_POST['c_courses']),
            't_courses' => $_POST['t_courses'],
            'company_name' => $_POST['company_name'],
            'skills' => $_POST['skills'],
            'job_title' => $_POST['job_title'],
            'years_in_curr_job' => $_POST['years_in_curr_job'],
            'pres_salary' => $_POST['pres_salary'],
            'experience' => $_POST['experience'],
            'expec_salary' => $_POST['expec_salary'],
            'status' => 'active'           
            
        );
        
        $this->db->where('email', $_POST['email']);
        $db_result = $this->db->update('jobseeker', $data);
        
        if ($db_result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function jobseeker_upload_resume($filename) {
        $seeker_email = $this->session->userdata('email');
        //print_r($seeker_email);die();
        $data = array(
            'resume_name' => $filename
        );
        $this->db->where('email', $seeker_email);
        $db_result = $this->db->update('jobseeker', $data);
        if($db_result){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    //--------------------------------------------------------------------------

    /**
     * This function is used to update jobseeker password
     * 
     * @version 0.0.1
     * @since   0.0.1
     * @access  public
     * @return  boolean/CI_Result                           
     */
    public function jobseekerUpdatePassword()
    {
        $data = array(
                'password' => md5($_POST['password']),
            );
            $this->db->where('email', $_POST['email']);
           $db_result =  $this->db->update('jobseeker', $data);
           if ($db_result) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
    /**
     * This function is used to check whether the email entered by the useris already registered or not.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @param       string      $userEmail              Email entered by the user
     * @return      boolean                             Return TRUE if email exists, FALSE otherwise
     */
    public function checkEmailAvailabilityEmployer($userEmail) {

        #checking if the email exista in the database 
        $db_result = $this->db->get_where('employer', array('email' => $userEmail));
        if ($db_result && $db_result->num_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function is forgot passwordmail
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @param       string      $userEmail              Email entered by the user
     * @return      boolean                             Return TRUE if email exists, FALSE otherwise
     */
    public function forgotPassword($email) {
        if (!$this->checkEmailAvailabilityEmployer($email)) {
            $password = substr(md5(microtime()), rand(0, 26), 6);
            $data = array(
                'password' => md5($password),
            );
            $this->db->where('email', $email);
            $this->db->update('employer', $data);

            // Mail send
            #loading the required library
            $this->load->library('Communication');
            $arr_param = array(
                'is_html' => TRUE,
                'from_email' => 'admin@zoomgroup.com',
                'from_name' => 'Zoom Careers',
                'to_email' => $email,
                'subject' => 'Your password @zoom careers.',
                'message' => 'Hello,<br/>Your New Password is: ' . $password . '<br/>Click below to login.<br/><br/><a href="' . base_url() . 'login">Login Here</a><br/><br/><br/>Zoom Careers');

            #sending a request to send an email to the user about the class details
            $this->communication->send_confirmation_email($arr_param);
            return true;
        } else {
            return false;
        }
    }
/**
     * This function is forgot passwordmail
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @param       string      $userEmail              Email entered by the user
     * @return      boolean                             Return TRUE if email exists, FALSE otherwise
     */
    public function forgotPasswordJobseeker($email) {
        if (!$this->checkEmailAvailabilityEmployer($email)) {
            $password = substr(md5(microtime()), rand(0, 26), 6);
            $data = array(
                'password' => md5($password),
            );
            $this->db->where('email', $email);
            $this->db->update('jobseeker', $data);

            // Mail send
            #loading the required library
            $this->load->library('Communication');
            $arr_param = array(
                'is_html' => TRUE,
                'from_email' => 'admin@zoomgroup.com',
                'from_name' => 'Zoom Careers',
                'to_email' => $email,
                'subject' => 'Your password @zoom careers.',
                'message' => 'Hello,<br/>Your New Password is: ' . $password . '<br/>Click below to login.<br/><br/><a href="' . base_url() . 'jobseeker">Login Here</a><br/><br/><br/>Zoom Careers');

            #sending a request to send an email to the user about the class details
            $this->communication->send_confirmation_email($arr_param);
            return true;
        } else {
            return false;
        }
    }
    /**
     * This function is used to write the user login information and employer personal information
     * 
     * @version 0.0.1
     * @since   0.0.1
     * @access  public
     * @return  boolean/CI_Result                           
     */
    public function addNewEmployer() {
        if ($this->checkEmailAvailabilityEmployer($_POST['jobseeker_email'])) {
            //$password = substr(md5(microtime()), rand(0, 26), 6);
            $data = array(
                'name' => $_POST['jobseeker_name'],
                // 'password' => md5('PaSsWorD'.$_POST['jobseeker_email']),
                'password' => md5($_POST['password']),
                'email' => $_POST['jobseeker_email'],
                'company_name' => $_POST['company_name'],
                'FK_role_id' => $_POST['role_id'],
                'contact_person' => $_POST['contact_person'],
                'designation' => $_POST['designation'],
                'mobile' => $_POST['jobseeker_mobile'],
            );
            $result = $this->db->insert('employer', $data);
            if ($result > 0) {
                // Insert Mail code
                #loading the required library
//                $this->load->library('Communication');
//                $arr_param = array(
//                    'is_html' => TRUE,
//                    'from_email' => 'admin@zoomgroup.com',
//                    'from_name' => 'Zoom Careers',
//                    'to_email' => $_POST['jobseeker_email'],
//                    'subject' => 'Your password @zoom careers.',
//                    'message' => 'Hello,<br/>Thanks for registering with us.<br/><br/>Your Password is: ' . $password . '<br/>Click below to login.<br/><br/><a href="' . base_url() . 'login/">Login Here</a><br/><br/><br/>Zoom Careers');

                #sending a request to send an email to the user about the class details
                //$this->communication->send_confirmation_email($arr_param);

                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return 'email';
        }
    }

}

//End of class Registration_model

/*End of file registration_model.php */
/* Location: ./application/models/regis/registration_model.php */
