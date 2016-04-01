<?php if (!defined('BASEPATH')) exit('<h1>Error! Not a valid Request</h1>');
/**
 * Communication class to handle email sending.
 * 
 * @version     0.0.1
 * @since       0.0.1
 * @access      public
 */
class Email_no_attachment {

  /**
   * Default Constructor
   */
  public function __construct() {
    
  }
  
  //----------------------------------------------------------------------------
  /**
   * Sends an email to the user upon successful registration for a course.
   * 
   * @version     0.0.1
   * @since       0.0.1             
   * @access      public
   * @param       array      $arr_param       Various values required for sending the mail
   * @return      boolean                     TRUE if mail has been sent successfully otherwise FALSE
   */
  public function confirmation_email($arr_param) {
    if (empty($arr_param)) {
      return FALSE;
    }
    require_once APPPATH . '/libraries/mail7/class.phpmailer.php';
    $mail = new PHPMailer();
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->Host = 'relay-hosting.secureserver.net'; // SMTP server
    $mail->Port = 25;
    $mail->SMTPAuth = FALSE;
    #$mail->Username = MAIL_USER;
    #$mail->Password = MAIL_PASS;
    $mail->IsHTML(true);

    $mail->From = $arr_param['from_email'];
    $mail->FromName = $arr_param['from_name'];
    $mail->AddAddress($arr_param['to_email']);
//    $mail->AddAddress('sharon@zoomgroup.com');

    $mail->Subject = $arr_param['subject'];
    $mail->Body = $arr_param['message'];    
//    $mail->AddAttachment("G:/PleskVhosts/zoomgroup.net/zoomingcareers.com/resumes/".$arr_param['attach']);
    $mail->WordWrap = 200;

    if ($mail->Send()) {
      $mail->ClearAllRecipients(); //clears all recipients
      $mail->ClearCustomHeaders(); //clears headers for next message
      $mail->ClearAttachments(); //clears all attachments
      return TRUE;
    } else {
      $mail->ClearAllRecipients(); //clears all recipients
      $mail->ClearCustomHeaders(); //clears headers for next message
      $mail->ClearAttachments(); //clears all attachments
      return FALSE;
    }
  }

}
// END Communication class
/* End of file Communication.php */
/* Location: ./application/libraries/Communication.php */
//