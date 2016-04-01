<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller. 
     */
    public function index() {
        $this->load->view('welcome_message');
    }

    //-------------------------------------------------------------------
    /*
     * This function is used to load page for job seeker
     */
    public function jobseeker() {
        $this->load->view('jobseeker');
    }

    public function contactUs() {
        $this->load->view('home_header');
        $this->load->view('contact_us');
    }

    //-------------------------------------------------------------------
    /*
     * This function is used to load page for job seeker
     */
    public function sendDetail() {
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);
        $employee = $this->obj_reg->get_employee();
           $data['employee'] = $employee;
        $this->load->view('header');
        $this->load->view('sendDetail',$data);
        $this->load->view('footer');
    }

    public function employerRegister() {
            $this->load->model('jobseeker_model', 'obj_reg', TRUE);
        $employee = $this->obj_reg->get_employee();
        $company = $this->obj_reg->get_company();

        $data['employee'] = $employee;
        $data['company'] = $company;
        #loading the required views
        $this->load->view('header');
        $this->load->view('employer_register',$data);
        $this->load->view('footer');
    }

    //---------------------------------------------------------------------
    public function student_mail_list() {

        $this->load->model('jobseeker_model', 'obj_reg', TRUE);
        $return_value = $this->obj_reg->get_jobseekers_mails();
        if ($return_value == TRUE) {
            $arr_response['status'] = 200;
            $arr_response['data'] = $return_value;
        } else {
            $arr_response['status'] = 201;
            $arr_response['message'] = 'No records.';
        }
        echo json_encode($arr_response);
    }
     //---------------------------------------------------------------------
    public function get_employee_details() {
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);

        $return_value = $this->obj_reg->get_employee_details();
        if ($return_value) {
            $arr_response['status'] = 200;
            $arr_response['data'] = $return_value;
        } else {
            $arr_response['status'] = 201;
            $arr_response['message'] = 'No Details found.';
        }
        echo json_encode($arr_response);
    }
  //---------------------------------------------------------------------
    public function send_mail_list_to_emp() {
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);

        $return_value = $this->obj_reg->send_mail_list_to_emp();
        if ($return_value === TRUE) {
            $arr_response['status'] = 200;
            $arr_response['data'] = $return_value;
        } else {
            $arr_response['status'] = 201;
            $arr_response['message'] = 'Mails are not send, Please try again.';
        }
        echo json_encode($arr_response);
    }

     //---------------------------------------------------------------------
    public function send_mails_to_jobseeker() {
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);

        $return_value = $this->obj_reg->send_mails_to_jobseeker();
        if ($return_value == TRUE) {
            $arr_response['status'] = 200;
            $arr_response['data'] = $return_value;
        } else {
            $arr_response['status'] = 201;
            $arr_response['message'] = 'Mails are not send, Please try again.';
        }
        echo json_encode($arr_response);
    }
    //---------------------------------------------------------------------
    public function add_course() {
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);
        $data['course_list'] = $this->obj_reg->get_course();

        $this->load->view('header');
        $this->load->view('add_course', $data);
        $this->load->view('footer');
    }
    //---------------------------------------------------------------------
    public function edit_course() {
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);
        $return_value = $this->obj_reg->edit_course();

        if ($return_value == TRUE) {
            $arr_response['status'] = 200;
            $arr_response['message'] = 'Course Updated Successfully.';
        } else {
            $arr_response['status'] = 201;
            $arr_response['message'] = 'Course is not Updated, Please try again.';
        }
        echo json_encode($arr_response);
    }
  //---------------------------------------------------------------------
    public function delete_course() {
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);

        $return_value = $this->obj_reg->delete_course();
        if ($return_value == TRUE) {
            $arr_response['status'] = 200;
            $arr_response['message'] = 'Course delete Successfully.';
        } else {
            $arr_response['status'] = 201;
            $arr_response['message'] = 'Course not delete, Please try again.';
        }
        echo json_encode($arr_response);
    }

   //---------------------------------------------------------------------
    public function edit_employer() {
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);
        $return_value = $this->obj_reg->edit_employer();

        if ($return_value == TRUE) {
            $arr_response['status'] = 200;
            $arr_response['message'] = 'Employe Data Updated Successfully.';
        } else {
            $arr_response['status'] = 201;
            $arr_response['message'] = 'Employe Data is not Updated, Please try again.';
        }
        echo json_encode($arr_response);
    }
    
     //---------------------------------------------------------------------
    public function delete_employe() {
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);
        $return_value = $this->obj_reg->delete_employe();

        if ($return_value == TRUE) {
            $arr_response['status'] = 200;
            $arr_response['message'] = 'Employer Data deleted Successfully.';
        } else {
            $arr_response['status'] = 201;
            $arr_response['message'] = 'Employer Data is not deleted, Please try again.';
        }
        echo json_encode($arr_response);
    }  
   //---------------------------------------------------------------------
    public function studentsEmailToEmployer() {
        $this->load->model('jobseeker_model', 'obj_reg', TRUE);
        $data['listOfMails'] = $this->obj_reg->studentsEmailToEmployer();

        $this->load->view('header');
        $this->load->view('listOfMailsToEmployer', $data);
        $this->load->view('footer');
    }

    //---------------------------------------------------------------------
    public function seekerGotJob() {

        $this->load->model('jobseeker_model', 'obj_reg', TRUE);
        $data['gotJob'] = $this->obj_reg->seekerGotJob();

        $this->load->view('header');
        $this->load->view('seekerGotJob', $data);
        $this->load->view('footer');
    }
    
     //---------------------------------------------------------------------
    public function serchCompany() {

        $this->load->model('jobseeker_model', 'obj_reg', TRUE);
        $company = $this->obj_reg->serchCompany();
        
         if ($company) {
            $arr_response['status'] = 200;
            $arr_response['company'] = $company;
        } else {
            $arr_response['status'] = 201;
            $arr_response['message'] = '';
        }
        echo json_encode($arr_response);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */