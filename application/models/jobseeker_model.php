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
class Jobseeker_model extends CI_Model {

    /**
     * Default Constructor
     * 
     * @access  public
     * @since   0.0.1
     */
    public function __construct() {
        parent::__construct();
    }

    //--------------------------------------------------------------------------  
    /**
     * This function fetches all  the users.
     * 
     * @access  public 
     * @return  dataArray
     * @since   0.0.1 
     */
    public function get_users($Student_id) {

        $search_arr = array(
            'status' => 'active',
        );
        if ($Student_id != '') {
            $this->db->where('userId', $Student_id);
//            $this->db->where('status', 'active');
        } else {
//            $this->db->where('status', 'active');
        }
        $db_result = $this->db->get('jobseeker');
        $data_return = array();
        //var_dump($db_result);
        foreach ($db_result->result() as $row) {
            $data_return[] = $row;
        }
        return $data_return;
    }

    //--------------------------------------------------------

    public function get_course() {
        $course = $this->db->get('course');
        if ($course->num_rows > 0) {
            return $course->result();
        } else {
            return FALSE;
        }
    }
    public function edit_course() {
         $course_id = $_POST['course_id'];
        $data = array(
            'course_name' => $_POST['edit_course_name'],
            'parent_list' => $_POST['edit_sub_course_of']
        );
        if ($_POST['edit_sub_course_of'] != 0) {
            $this->db->where('course_id', $_POST['edit_sub_course_of']);
            $this->db->update('course', array('has_child' => 1));
        }
          $this->db->where('course_id', $course_id);
        $db_result = $this->db->update('course', $data);
        if ($db_result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
  //--------------------------------------------------------

    public function delete_course() {
        $courseId = $_POST['courseId'];
        $this->db->where('course_id', $courseId);
        $course = $this->db->delete('course');
        if ($course) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function get_employee() {
        
        $course = $this->db->get('employer');
        if ($course->num_rows > 0) {
            return $course->result();
        } else {
            return FALSE;
        }
    }

     public function get_company() {
        $this->db->select('company_name');
        $this->db->group_by('company_name');
        $course = $this->db->get('employer');
        if ($course->num_rows > 0) {
            return $course->result();
        } else {
            return FALSE;
        }
    }

    public function edit_employer() {

        if ($_POST != '') {
            
            $data = array(
                'name' => $_POST['edit_employer_name'],
                'email' => $_POST['edit_employer_email'],
                'company_name' => $_POST['edit_company_name'],
                'designation' => $_POST['edit_designation'],
                'mobile' => $_POST['edit_employer_mobile']
            );
            $this->db->where('id', $_POST['employer_id']);
            $course = $this->db->update('employer',$data);
            if ($course) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
    //--------------------------------------------------------

    public function delete_employe() {
        $courseId = $_POST['empId'];
        $this->db->where('id', $courseId);
        $course = $this->db->delete('employer');
        if ($course) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function fetches particular user data.
     * 
     * @access  public 
     * @return  dataArray
     * @since   0.0.1 
     */
    public function get_user_data($email) {

        $db_result = $this->db->get_where('jobseeker', array('email' => $email));
        $data_return = array();
        //var_dump($db_result);
        foreach ($db_result->result() as $row) {
            $data_return = $row;
        }
        return $data_return;
    }

    public function addNewCourse() {

        $data = array(
            'course_name' => $_POST['course_name'],
            'parent_list' => $_POST['sub_course_of']
        );
        if ($_POST['sub_course_of'] != 0) {
            $this->db->where('course_id', $_POST['sub_course_of']);
            $this->db->update('course', array('has_child' => 1));
        }
        $db_result = $this->db->insert('course', $data);
        if ($db_result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function fetches all  the employers.
     * 
     * @access  public 
     * @return  dataArray
     * @since   0.0.1 
     */
    public function get_employers() {

        $db_result = $this->db->get('employer');
        $data_return = array();
        //var_dump($db_result);
        foreach ($db_result->result() as $row) {
            $data_return[] = $row;
        }
        return $data_return;
    }

    //--------------------------------------------------------------------------
    /**
     * Function used to fetch users based on serach query in the database.
     * @return dataArray
     */
    public function serach_users() {
        //$search_string = $search;
//print_r($_POST['c_courses']);die();
        if (!empty($_POST['c_courses'])){
            $this->db->like('c_courses', $_POST['c_courses']);
        }
         if (!empty($_POST['degree'])){
            $this->db->like('degree', $_POST['degree']);
        }
         if (!empty($_POST['t_courses'])){
            $this->db->like('t_courses', $_POST['t_courses']);
        }
         if (!empty($_POST['expec_salary'])){
            $this->db->like('expec_salary', $_POST['expec_salary']);
        }
          if (!empty($_POST['name'])) {
            $this->db->like('name', $_POST['name']);
        }
        if (!empty($_POST['email'])) {
            $this->db->like('email', $_POST['email']);
        }
        if (!empty($_POST['contact'])) {
            $this->db->like('mobile', $_POST['contact']);
        }
         if (!empty($_POST['experience']) || $_POST['a_experience'] != 'both') {
            if ($_POST['a_experience'] == '0')
                $this->db->like('experience', '0', 'none');
            else if ($_POST['a_experience'] == '1')
                $this->db->not_like('experience', '0', 'none');
            else if (!empty($_POST['experience']))
                $this->db->like('experience', $_POST['experience'], 'none');
        }

        $db_result = $this->db->get('jobseeker');
        $data_return = array();
        //var_dump($db_result);
        foreach ($db_result->result() as $row) {
            $data_return[] = $row;
        }
        return $data_return;
    }

    public function update_seeker_details() {

        $data = array(
            'userId' => $_POST['edit_Student_id'],
            'name' => $_POST['edit_name'],
            'mobile' => $_POST['edit_mobile'],
            'age' => $_POST['edit_age'],
            'email' => $_POST['edit_email'],
            'degree' => $_POST['edit_degree'],
            'address' => $_POST['edit_address'],
            'curr_location' => $_POST['edit_curr_location'],
            'c_courses' => $_POST['edit_c_courses'],
            't_courses' => $_POST['edit_t_courses'],
            'experience' => $_POST['edit_experience'],
            'company_name' => $_POST['edit_company_name'],
            'job_title' => $_POST['edit_job_title'],
            'years_in_curr_job' => $_POST['edit_years_in_job'],
            'pres_salary' => $_POST['edit_pres_salary'],
            'expec_salary' => $_POST['edit_expec_salary'],
            'skills' => $_POST['edit_skills'],
            'status' => $_POST['edit_status'],
            'Job_status' => $_POST['edit_job_status'],
            'new_company_name' => $_POST['edit_new_company']
        );
        $this->db->where('userId', $_POST['edit_Student_id']);
        $result = $this->db->update('jobseeker', $data);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function remove_seeker_details($Student_id) {
        if ($Student_id) {
            $return = $this->db->query("DELETE FROM `jobseeker` WHERE `userId` = '" . $Student_id . "'");
            if ($return) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function get_jobseekers_mails() {
        if ($_POST) {
            $query = "SELECT * FROM `jobseeker` WHERE `userId` NOT IN "
                    . "(select `FK_student_id` from  `sending_mails`)"
                    . " order by `userId` desc "
                    . " limit ".$_POST['list'];
            $return = $this->db->query($query);
            if ($return) {
                return $return->result();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
   
   //-----------------------------------------------------------

    public function get_employee_details() {
        $empMail = $_POST['to_mail'];
        if ($empMail != '') {
            $query = "SELECT name,mobile,email,company_name,designation FROM employer WHERE email = ? ";
            $result = $this->db->query($query,$empMail);
            if ($result->num_rows == 1) {
                return $result->result();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
//---------------------------------------------------------------------------------------------------
   public function send_mail_list_to_emp() {
        $this->load->library('Communication');
        if ($_POST) {
            $std_id = $_POST['student_ids'];
            $experiance_array = $_POST['student_experiance'];
            $names_array = $_POST['student_names'];
            $location_array = $_POST['student_location'];
            $Qualification_array = $_POST['student_Qualification'];
            $c_course_array = $_POST['student_c_course'];
            $t_course_array = $_POST['student_t_course'];
            $age_array = $_POST['student_age'];
            $attachment = $_POST['attachment'];

            $student_ids = array();
            $std_exp = array();
            $student_names = array();
            $student_location = array();
            $student_Qualification = array();
            $student_c_course = array();
            $student_t_course = array();
            $student_age = array();
            $std_resume = array();
            //student Id's array
            foreach (explode(',', $std_id) as $v) {
                array_push($student_ids, $v);
            }
            //student mails array
            foreach (explode(',', $experiance_array) as $v) {
                array_push($std_exp, $v);
            }
            //student names array
            foreach (explode(',', $names_array) as $v) {
                array_push($student_names, $v);
            }
            //student contacts array
            foreach (explode(',', $location_array) as $v) {
                array_push($student_location, $v);
            }
            //student Qualification_array array
            foreach (explode(',', $Qualification_array) as $v) {
                array_push($student_Qualification, $v);
            }
            //student c_course_array array
            foreach (explode(',,', $c_course_array) as $v) {
                array_push($student_c_course, $v);
            }
            //student t_course_array array
            foreach (explode(',,', $t_course_array) as $v) {
                array_push($student_t_course, $v);
            }
            //student skills_array array
            foreach (explode(',', $age_array) as $v) {
                array_push($student_age, $v);
            }
            //student resume attachment array
            foreach (explode(',', $attachment) as $v) {
                array_push($std_resume, $v);
            }

            if (is_array($student_ids)) {
                $to_mail = $_POST['to_mail'];
                $emp_name = $_POST['emp_name'];
                $data = array();
                for ($i = 0; $i < count($student_ids); $i++) {
                    $data = array(
                        'FK_emp_id' => $to_mail,
                        'FK_student_id' => $student_ids[$i]
                    );

                    $arr_param = array(
                        'is_html' => TRUE,
                        'from_email' => " jobs@zoomgroup.com",
                        'from_name' => "Zooming Career",
                        'to_email' => $to_mail,
                        'subject' => 'List of jobseekers',
                        'attach' => $std_resume[$i],
                        'message' => "Dear ". $emp_name.",<br>"
                                . " &nbsp;&nbsp; We are pleased to let you know that we have a candidate whose profile is suitable for your organization’s requirements. Here are the details of the job seeker: <br>"
                                . "Student Name : " . $student_names[$i] . "<br>"
                                . "Student Age : " . $student_age[$i] . "<br>"
                                . "Educational Qualification : " . $student_Qualification[$i] . " <br>"
                                . "Certifications : " . $student_c_course[$i] . " <br>"
                                . "Training undergone : " . $student_t_course[$i] . " <br>"
                                . "Experience : " . $std_exp[$i] . "<br>"
                                . "Location : " . $student_location[$i] . "<br>"
                                .  " <br><br> Please find attached the resume of the candidate. Please get back to us at any time for any questions you may have.");

                    #sending a request to send an email to the user about the class details
                    if ($this->communication->send_confirmation_email($arr_param)) {
                        $result = $this->db->insert('sending_mails', $data);
                    }
                }
                if ($result) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }
    }

//-----------------------------------------------------------------------------------------------
    public function send_mails_to_jobseeker() {
        $this->load->library('Communication');

        if ($_POST) {
            $mail_array = $_POST['mail_array'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $std_email = array();
            foreach (explode(',', $mail_array) as $v) {
                array_push($std_email, $v);
            }

            if (is_array($std_email)) {
                $subject = $_POST['subject'];
                $message = $_POST['message'];

                for ($i = 0; $i < count($std_email); $i++) {
                    $arr_param = array(
                        'is_html' => TRUE,
                        'from_email' => "jobs@zoomgroup.com",
                        'from_name' => "Zooming Career",
                        'to_email' => $std_email[$i],
                        'subject' => $subject,
                        'message' => " Dear Student, <br>"
                                     . $message
                                     . "<br><br><br>"
                                     . "Regards,<br><br>"
                                     . "<img src='zoomingcareers.com/assets/images/logo.png' alt='ZOOM Technologies, CCNA India, CCIE India, Cisco Bootcamps, Microsoft Boot Camps' />" 
                    );

                    #sending a request to send an email to the user about the class details
                    $send = $this->communication->confirmation_email($arr_param);
                }
                if($send){
                    return TRUE;
                }else { return FALSE;}
            }
        } else {
            return FALSE;
        }
    }
//-----------------------------------------------------------------------------------------------
    public function studentsEmailToEmployer() {
        $query = "SELECT js.userId,js.name,js.email,js.mobile,em.name as employer_name,em.company_name as company_name,em.email as employer_email
                    FROM jobseeker as js join sending_mails as sm on sm.FK_student_id = js.userId
                    join employer as em on em.email = sm.FK_emp_id
                    order by sm.date desc";
        $db_result = $this->db->query($query);
        $data_return = array();
        //var_dump($db_result);
        foreach ($db_result->result() as $row) {
            $data_return[] = $row;
        }
        return $data_return;
    }

    public function seekerGotJob() {

        $this->db->where('Job_status', 'Yes');
        $db_result = $this->db->get('jobseeker');
        $data_return = array();
        //var_dump($db_result);
        foreach ($db_result->result() as $row) {
            $data_return[] = $row;
        }
        return $data_return;
    }

    public function serchCompany() {
          $query = "select * from employer where company_name like '%". $_POST['company'] . "%'";
//        $this->db->like('company_name', "%" . $_POST['company'] . "%");
        $db_result = $this->db->query($query);
        $data_return = array();
        //var_dump($db_result);
        if ($db_result->num_rows >= 1) {
            foreach ($db_result->result() as $row) {
                $data_return[] = $row;
            }
            return $data_return;
        } else {
            return FALSE;
        }
    }

}

//End of class Authorization_model

//End of file authorization_model.php
/* Location: ../../models/authorization_model.php */
