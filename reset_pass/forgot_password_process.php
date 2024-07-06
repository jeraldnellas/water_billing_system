<?php
include_once "../db_con/db.php";

if(isset($_POST['reset'])){
$email = $_POST['email'];

}else{
    exit(); 
}



//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $mail->CharSet  ="utf-8";

    //Server settings
  
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'jeraldnellas@gmail.com';                     //SMTP username
    $mail->Password   = 'uughtgrfoyujbbkl';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('jeraldnellas@gmail.com', 'IT ADMIN');
    $mail->addAddress($email);     //Add a recipient
    
    $code = substr(str_shuffle('1234567890QWERTUIOPASDFGHJKLZXCVBNM'),0,10);


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'PASSWORD RESET';
    $mail->Body    = 'To reset your <b>PASSWORD<b> click <a href="http://localhost/water_bill/reset_pass/change_password.php?code='.$code.'">link here </a> ';
 
$verifyquery = $con -> query("SELECT * FROM `user_log` WHERE email = '$email' ");

if($verifyquery->num_rows){
    $codequery = $con->query("UPDATE `user_log` SET code = '$code' WHERE email = '$email'");
    $mail->send();
    echo "The Link has been sent to your email";

}
$con->close(); 

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>