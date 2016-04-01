<?php

if (!defined('BASEPATH'))
    exit('Not a valid request!');

/**
 * Model Class to handle DB related operations for
 * authorization of a user.
 *
 * @version     0.0.1
 * @since       0.0.1
 */
class Authorization_model extends CI_Model {

    /**
     * Default Constructor
     * 
     * @access  public
     * @since   0.0.1
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    //--------------------------------------------------------------------------  
    /**
     * This function checks the login credentials entered by the users.
     * 
     * @access  public 
     * @return  boolean     TRUE if login credentials are correct otherwise FALSE
     * @since   0.0.1 
     */
    public function check_login_credentials($email, $password) {
        //exit;
        $db_result = $this->db->get_where('employer', array('email' => $email, 'password' => md5($password)));
        //var_dump($db_result);
        if ($db_result && $db_result->num_rows() == 0) {
            return FALSE;
        } else {
            
            $row = $db_result->row();

            $this->session->set_userdata(array(
                'userID' => $row->id,
                'logged' => 1,
                'role_id' => $row->FK_role_id,
                'email' => $row->email,
                'name'  => $row->name
            ));
            return TRUE;
        }
        //var_dump($_POST);
    }

    public function check_login_credentials_admin($email, $password) {
        //exit;
        $db_result = $this->db->get_where('admin', array('email' => $email, 'password' => $password));
        //var_dump($db_result);
        if ($db_result && $db_result->num_rows() == 0) {
            return FALSE;
        } else {
//            $row = $db_result->row();
//            $this->session->set_userdata(array(
//                'userID' => $row->id,
//                'logged' => 1,
//                'role_id' => $row->FK_role_id,
//                'email' => $row->email,
//                'name'  => $row->name
//            ));
            return TRUE;
        }
        //var_dump($_POST);
    }

    public function check_login_credentials_jobseeker($email, $password) {
        //exit;
        //var_dump($email,md5($password));
        $db_result = $this->db->get_where('jobseeker', array('email' => $email, 'password' => md5($password)));
        //var_dump($db_result);
        if ($db_result && $db_result->num_rows() == 0) {
            
            return FALSE;
        } else {
            $row = $db_result->row();
            $this->session->set_userdata(array(
                'userID' => $row->userId,
                'logged' => 1,
                'role_id' => 0,
                'email' => $row->email,
                'name'  => $row->name
            ));
            return TRUE;
        }
        //var_dump($_POST);
    }

    //--------------------------------------------------------------------------
    /**
     * Function used to write the user type of the user in the database.
     * @return boolean
     */
    public function write_user_type() {

        #reading the user id from the session
        $user_id = $this->session->userdata('userID');

        $arr_data = array('user_type' => $_POST['userType']);
        $db_result = $this->db->update('LoginInformation', $arr_data, array('user_ID' => $user_id));
        if ($db_result) {
            $this->session->unset_userdata('userType');
            $this->session->set_userdata(array('userType' => $_POST['userType']));
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

//End of class Authorization_model

//End of file authorization_model.php
/* Location: ../../models/authorization_model.php */
