<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class to process the CCAVENUE and PAYPAL Payment requests.
 * 
 * @version     0.0.1
 * @since       0.0.1
 * @access      public
 * @author      Anil Saini  <anilsaini@ahex.co.in>
 */
class Payment extends CI_Controller {

    /**
     * Default Constructor
     * 
     * @since       0.0.1
     * @version     0.0.1
     */
    public function __construct() {
        parent::__construct();
        #loading the required helper
        $this->load->helper('url');
        $this->load->library('session');
    }

    //--------------------------------------------------------------------------
    /**
     * This function is used to check for the region from where the payment is done.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @author      Anil Saini  <anilsaini@ahex.co.in>
     */
    public function check_payment_region() {
        if (empty($_POST)) {
            return FALSE;
        }

        if (floatval($_POST['Amount']) == 0.00) {
            $date = new DateTime();
            $order_id = $date->getTimestamp();
            #loading the required model
            $this->load->model('payment_model', 'obj_payment', TRUE);
            if ($this->obj_payment->save_payment_detail($order_id, '')) {
                $order_result = $this->obj_payment->read_order_details($order_id);

                $this->session->set_userdata(array(
                    'subscribed' => TRUE,
                    'course_name' => $order_result->course_name,
                    'course_schedule' => $order_result->course_schedule,
                ));
                $redirect_url = base_url();
                echo '<script language="javascript">window.location.href="' . $redirect_url . '"</script>';
                exit();
            }
        }

        if ($_POST['billing_cust_country'] === 'India') {
            $this->send_ccavenue_payment_request();
        } else {
            $_POST['cmd'] = '_xclick';
            $_POST['no_note'] = 1;
            $_POST['lc'] = 'USA';
            $_POST['currency_code'] = 'USD';
            $_POST['bn'] = 'PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest';
            $_POST['item_number'] = $_POST['paypal_selected_course_quantity'];
            $paymentMethod = 'PAYPAL';
            $date = new DateTime();
            $order_id = $date->getTimestamp();

            #loading the required model
            $this->load->model('payment_model', 'obj_payment', TRUE);

            #saving the payment details into the database
            if ($this->obj_payment->save_payment_detail($order_id, $paymentMethod)) {
                #verify the payment details submitted by the user
                if($this->verify_course_amount($_POST)){
                  #calling the method to send the user to paypal
                  $this->send_paypal_payment_request($_POST, $order_id);
                }
            }
        }
    }

    //--------------------------------------------------------------------------
    /**
     * This function is used to save the payment details into the database and send
     * the user to ccavenue for processing payment.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @author      Anil Saini  <anilsaini@ahex.co.in>
     */
    public function send_ccavenue_payment_request() {

        #array to hold the response values to be displayed
        $arr_response = array();

        #default response status message
        $arr_response['status'] = ERR_DEFAULT;

        #loading the required library
        $this->load->library('Ccavenue_payment');

        #saving the payment details into the database
        #loading the requitred model
        $this->load->model('payment_model', 'obj_payment', true);
        $paymentMethod = 'CCAVENUE';
        $date = new DateTime();
        $order_id = $date->getTimestamp();
        if ($this->obj_payment->save_payment_detail($order_id, $paymentMethod)) {
            #verify the payment details submitted by the user
            if($this->verify_course_amount($_POST)){
              #calling the method to send the user to ccavenue
              $this->ccavenue_payment->send_ccavenue_payment_request($order_id);
            }
        }
    }

    //--------------------------------------------------------------------------
    /**
     * Checks the status for CCavenue payment done. Based on the Acknowledgement 
     * sent by CCAvenue further actions are taken.
     * 
     * @version   0.0.1
     * @since     0.0.1
     * @access    public
     * @author    Anil Saini  <anilsaini@ahex.co.in>
     */
    public function check_ccavenue_payment_status() {

        #loading the required helper
        $this->load->helper('libfuncs');

        #CCAVENUE MERCHANT WORKING KEY
        $WorkingKey = CCAVENUE_WORKING_KEY;
        $Merchant_Id = $_REQUEST['Merchant_Id'];
        $Amount = $_REQUEST['Amount'];
        $Order_Id = $_REQUEST['Order_Id'];
        $Merchant_Param = $_REQUEST['Merchant_Param'];
        $Checksum = $_REQUEST['Checksum'];
        $AuthDesc = $_REQUEST['AuthDesc'];

        $Checksum = verifyChecksum($Merchant_Id, $Order_Id, $Amount, $AuthDesc, $Checksum, $WorkingKey);
        if ($Checksum == "true" && $AuthDesc == "Y") {
            #payment successful
            $status = 'VERIFIED';
        } else if ($Checksum == "true" && $AuthDesc == "B") {
            #payment is under batch processing, only for American Express Card 
            #as they give the payment status in 5-6 hours
            $status = 'BATCH PROCESSING';
        } else if ($Checksum == "true" && $AuthDesc == "N") {
            #payment declined
            $status = 'DECLINED';
        } else {
            #security error, illegal access attempted
            $status = 'ERROR ILLEGAL ACCESS';
        }

        #loading the required model
        $this->load->model('payment_model', 'obj_payment', TRUE);
        if ($this->obj_payment->set_payment_status($Order_Id, $status)) {
            $payment_status = TRUE;
        } else {
            $payment_status = FALSE;
        }
        if ($payment_status) {
            $this->load->model('payment_model', 'obj_payment', TRUE);
            #reading the order details from the database
            $order_result = $this->obj_payment->read_order_details_for_session_setting($Order_Id);

            $this->session->set_userdata(array(
                                    'payment_status' => TRUE,
                                    'payment_method' => 'CCAVENUE',
                                    'order_id' => $order_result->order_id,
                                    'customer_name' => $order_result->billing_cust_name,
                                    'customer_email' => $order_result->billing_cust_email,
                                    'customer_phone' => $order_result->billing_cust_tel,
                                    'course_name' => $order_result->course_name,
                                    'course_schedule' => $order_result->course_schedule,
                                    'webinar_link' => $order_result->webinar_link
                                ));
            $redirect_url = base_url();
            echo '<script language="javascript">window.location.href="' . $redirect_url . '"</script>';
            exit();
        }
    }

    //--------------------------------------------------------------------------
    /**
     * This function is used to check the payment status as sent by the CCAVENUE
     * server in response to the payment request.
     */
    public function check_ccavenue_payment_status_encrypted() {

        #loading the required helpers
        $this->load->helper(array('Aes', 'adler32'));

        #CCAVENUE Working Key
        $workingKey = CCAVENUE_WORKING_KEY;

        #This is the response sent by the CCAvenue Server
        $encResponse = $_POST['encResponse'];
        echo $encResponse;
        echo '<br/>i am after enc response';
        #decrypt the recieved response from the server, AES Decryption used as per the specified working key.
        $rcvdString = decrypt($encResponse, $workingKey);

        $AuthDesc = "";
        $MerchantId = "";
        $OrderId = "";
        $Amount = 0;
        $Checksum = 0;
        $veriChecksum = false;

        echo $rcvdString;
        echo '<br/>';
        $decryptValues = explode('&', $rcvdString);
        print_r($decryptValues);
        echo '<br/>values';
        $dataSize = sizeof($decryptValues);

        for ($i = 0; $i < $dataSize; $i++) {

            $information = explode('=', $decryptValues[$i]);
            echo $information[1] . '<br/>';
            if ($i == 0)
                $MerchantId = $information[1];
            if ($i == 1)
                $OrderId = $information[1];
            if ($i == 2)
                $Amount = $information[1];
            if ($i == 3)
                $AuthDesc = $information[1];
            if ($i == 4)
                $Checksum = $information[1];
        }

        $rcvdString = $MerchantId . '|' . $OrderId . '|' . $Amount . '|' . $AuthDesc . '|' . $workingKey;
        $veriChecksum = verifyChecksum(genchecksum($rcvdString), $Checksum);

        if ($veriChecksum == TRUE && $AuthDesc === "Y") {
            #payment successful
            $status = 'VERIFIED';
        } else if ($veriChecksum == TRUE && $AuthDesc === "B") {
            #payment is under batch processing, only for American Express Card 
            #as they give the payment status in 5-6 hours
            $status = 'BATCH PROCESSING';
        } else if ($veriChecksum == TRUE && $AuthDesc === "N") {
            #payment declined
            $status = 'DECLINED';
        } else {
            #security error, illegal access attempted
            $status = 'ERROR ILLEGAL ACCESS';
        }
        echo $status;

        #loading the required model
        $this->load->model('payment_model', 'obj_payment', TRUE);
        if ($this->obj_payment->set_payment_status($OrderId, $status)) {
            echo '<br/>' . 'i am here';
            $payment_status = TRUE;
        } else {
            $payment_status = FALSE;
        }
        if ($payment_status) {
            echo '<br/> i am here dhondhu';
            $this->session->set_userdata(array(
                'payment_status' => TRUE,
                'payment_method' => 'CCAVENUE'
            ));
            $redirect_url = 'location:' . base_url();
            header($redirect_url);
            exit();
        }
    }

    //--------------------------------------------------------------------------
    /**
     * This function is used to send paypal payment request and redirects the user
     * to paypal server.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @author      Anil Saini  <anilsaini@ahex.co.in>
     * @param       array       $_my_post               post array with other added values needed for paypal payment
     * @param       string      $order_id               Unique order id for the current transaction
     */
    public function send_paypal_payment_request($_my_post, $order_id) {
        #we need to send request to paypal
        #Firstly Append paypal account to querystring
        $querystring = '';
        $querystring .= "?business=" . urlencode(PAYPAL_EMAIL) . "&";

        #Append amount& currency (£) to quersytring so it cannot be edited in html	
        #The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
        $querystring .= "item_name=" . urlencode($_POST['course_name']) . "&";
        $querystring .= "amount=" . urlencode(floatval($_POST['Amount']) * $_POST['paypal_selected_course_quantity']) . "&";
        
        #loop for posted values and append to querystring
        foreach ($_my_post as $key => $value) {
            if ($key !== 'course_id' && $key !== 'Amount') {
                $value = urlencode(stripslashes($value));
                $querystring .= "$key=$value&";
            }
        }

        #Append paypal return addresses
        $querystring .= "return=" . urlencode(stripslashes(RETURN_URL)) . "&";
        $querystring .= "cancel_return=" . urlencode(stripslashes(CANCEL_URL)) . "&";
        $querystring .= "notify_url=" . urlencode(stripslashes(NOTIFY_URL));

        #Append querystring with custom field
        $querystring .= "&custom=" . $_my_post['billing_cust_name'] . "-" . $_my_post['billing_cust_email'] . "-" . $_my_post['billing_cust_tel'] . "-" . $_my_post['billing_cust_country'] . "-" . $order_id . "-" . $_my_post['course_id'] . "-" . $_my_post['training_class_schedule'] . "-" . $_my_post['counsellor_name'] . "-" . $_my_post['referrer_name'];

        #edirect to paypal IPN
        $querystring1 = 'location:https://www.paypal.com/cgi-bin/webscr' . $querystring;
        header($querystring1);
        exit();
    }

    //--------------------------------------------------------------------------
    /**
     * Handles the response sent back by  paypal.
     * 
     * @version     0.0.1
     * @since       0.0.1
     * @access      public
     * @author      Anil Saini  <anilsaini@ahex.co.in>
     */
    public function handle_paypal_response() {
        if (empty($_POST)) {
            return FALSE;
        }
        #Response from Paypal
        #read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-validate';
        $payment_status = FALSE;
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
            $req .= "&$key=$value";
        }

        #assign posted variables to local variables
        $data = array();
        $data['item_name'] = $_POST['item_name'];
        $data['item_number'] = $_POST['item_number'];
        $data['payment_status'] = $_POST['payment_status'];
        $data['mc_gross'] = $_POST['mc_gross'];
        $data['mc_currency'] = $_POST['mc_currency'];
        $data['txn_id'] = $_POST['txn_id'];
        $data['receiver_email'] = $_POST['receiver_email'];
        $data['payer_email'] = $_POST['payer_email'];
        $data['receiver_id'] = $_POST['receiver_id'];
        $data['payment_gross'] = $_POST['payment_gross'];
        $data['shipping'] = $_POST['shipping'];
        $data['tax'] = $_POST['tax'];
        $data['payer_id'] = $_POST['payer_id'];
        $data['mc_fee'] = $_POST['mc_fee'];
        $data['payer_status'] = $_POST['payer_status'];
        $data['payment_type'] = $_POST['payment_type'];

        $custom = array();
        $custom = explode("-", $_POST['custom']);
        # You can now reference each variable as
        $data['billing_cust_name'] = $custom[0];
        $data['billing_cust_email'] = $custom[1];
        $data['billing_cust_tel'] = $custom[2];
        $data['billing_cust_country'] = $custom[3];
        $data['order_id'] = $custom[4];
        $data['course_id'] = $custom[5];
        $data['training_class_schedule'] = $custom[6];
        $data['counsellor_name'] = $custom[7];
        $data['reseller_name'] = $custom[8];

        #post back to PayPal system to validate
        $url = "https://www.paypal.com/cgi_bin/webscr";
        $res = file_get_contents($url . "?" . $req);

        if (strcmp(trim($res), "VERIFIED") == 0) {
            #checking the uniqueness for the transaction id returned by the paypal system
            if ($this->check_txnid($data['txn_id'])) {
                #writing the transaction details into the database
                $this->load->model('payment_model', 'obj_payment', TRUE);
                if ($this->obj_payment->write_paypal_transaction_detail($data)) {
                    $payment_status = TRUE;
                }
            }
            $this->load->model('payment_model', 'obj_payment', TRUE);
            #reading the order details from the database
            $order_result = $this->obj_payment->read_order_details_for_session_setting($data['order_id']);

            #setting the session variables
            $this->session->set_userdata(array(
                            'payment_status' => TRUE,
                            'payment_method' => 'PAYPAL',
                            'order_id' => $order_result->order_id,
                            'customer_name' => $order_result->billing_cust_name,
                            'customer_email' => $order_result->billing_cust_email,
                            'customer_phone' => $order_result->billing_cust_tel,
                            'course_name' => $order_result->course_name,
                            'course_schedule' => $order_result->course_schedule,
                            'webinar_link' => $order_result->webinar_link
                        ));
            $redirect_url = base_url();
            echo '<script language="javascript">window.location.href="' . $redirect_url . '"</script>';
            exit();
        } else if (strcmp(trim($res), "INVALID") == 0) {
            $payment_status = FALSE;
        }
    }

    //-------------------------------------------------------------------------
    /**
     * This function is used to check whether the id returned by paypal server is uniqur or not
     * 
     * @version 0.0.1
     * @since   0.0.1
     * @access  public
     * @author  anil saini  <anilsaini@ahex.co.in>
     * @param   int         $tnxid                  Transaction ID returned by the Paypal Server
     * @return  boolean                             Returns TRUE if the ID is unique, FALSE otherwise
     */
    public function check_txnid($txn_id) {
        #setting the value to TRUE by default
        $valid_txnid = TRUE;
        //get result set
        $this->load->database();
        $this->db->where('paypal_txn_id', $txn_id);
        $this->db->from('paypalTransactionDetail');
        $db_result = $this->db->get();
        if ($db_result && $db_result->num_rows() > 0) {
            $valid_txnid = FALSE;
        }
        return $valid_txnid;
    }

    //--------------------------------------------------------------------------
    /**
     * Check the number of students registered for a batch under a course.
     * 
     * @since     0.0.1
     * @access    public
     * @author    Mayara Rajesh
     */
    public function get_student_strength() {

        #array that holds the values to be sent with default status message
        $arr_response['status'] = ERR_DEFAULT;

        #loading the required modal
        $this->load->model('payment_model', 'obj_payment', TRUE);

        #checking if the seats are available
        $strength = $this->obj_payment->get_student_strength();
        if ($strength && $strength === 'NO ROW') {
            $arr_response['status'] = SUCCESS;
            $arr_response['message'] = 'No registration done yet.';
        } else if ($strength) {
            $total_student = $strength->total_student;
            $max_strength = $strength->strength;
            if ($total_student == $max_strength) {
                $arr_response['status'] = ERR_VALIDATION;
                $arr_response['message'] = "All seats are reserved. Please try with another batch.";
            } else {
                $arr_response['status'] = SUCCESS;
                #$arr_response['currentStrength'] = $strength->total_student;
                #$arr_response['maxStrength'] = $strength->strength;
                $arr_response['message'] = 'Seats available';
            }
        } else {
            $arr_response['status'] = ERR_DATABASE;
            $arr_response['message'] = "Problem with database.";
        }
        echo json_encode($arr_response);
    }
    
    //--------------------------------------------------------------------------
   /**
    * This function is used to verify if the amount for payment submitted by the
    * user for the selected course, matches the course fee present in the system
    * for the selected course.
    * 
    * @version    0.0.1
    * @sincre     0.0.1
    * @access     public
    * @author     Anil Saini    <anilsaini@ahex.co.in>
    * @param      array         $payment_detail         Payment details as submitted by the user
    * @return     boolean       Return TRUE if the payment amount matches the course fee, FALSE otherwise
    */
    public function verify_course_amount($payment_detail){
      
      #reading the course ID from the data submitted by the user
      $course_id = $payment_detail['course_id'];
      
      #reading the payment amount submitted by the user for selected course
      $selected_course_fee = floatval($payment_detail['Amount']);
      
      #reading the original course fee for the selected course in the system
      #loading the database
      $this->load->database();
      
      $db_result = $this->db->get_where('courseDetail', array('course_id' => $course_id));
      if($db_result){
        $result = $db_result->row();
        $orig_course_fee = $result->course_fees;
        
        #calculating the service tax
        $service_tax = $orig_course_fee * SERVICE_TAX;
        
        #fee after service tax
        $fee_with_service_tax = $orig_course_fee + $service_tax;
        
        #online fee
        $online_fee = $fee_with_service_tax * ONLINE_PAYMENT_COMMISSION;
           
        $amount = $fee_with_service_tax + $online_fee;
	$final_amount = number_format((float)$amount, 2, '.', '');
        
        if(floatval($final_amount) === floatval($selected_course_fee)){
            return TRUE;
        }else{
            #course fee has been tampered between the communication channel, so throw the user out
            $this->session->set_userdata(array(
                                    'payment_status' => 'TAMPERED'
                                ));
            $redirect_url = base_url();
            echo '<script language="javascript">window.location.href="' . $redirect_url . '"</script>';
            exit();
        }
      }
    }
}

//End of class Payment
//End of file payment.php
/*  Location: application/controllers/payment.php */
