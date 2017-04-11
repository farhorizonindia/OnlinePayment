<?php
require_once 'assets/lib/phpmailer/PHPMailerAutoload.php';
function send_phpmail( $toname, $to ,$fromname, $from , $subject, $body )
{
    
    
	$cc_email = "info@farhorizonindia.com";
    
	$customer_name  = "test user";
	$customer_email = "dsvmailer@gmail.com";
    
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
	$mail->Username = "info@farhorizonindia.com";
    $mail->Password = "kimsgfcgdakdjydi";
    $mail->setFrom($cc_email, 'Far Horizon Tours Pvt. Ltd. India');
    $mail->addReplyTo($cc_email, 'Far Horizon Tours Pvt. Ltd. India');
    $mail->addAddress($customer_email, $customer_name);
    $mail->addCC($cc_email);
    $mail->addBCC('receivables@farhorizonindia.com');
    $mail->addBCC('cashbank@farhorizonindia.com');
    $mail->Subject = $subject;
    $mail->IsHTML(true);
    $mail->Body    = $body;
    if (!$mail->send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
         return $mail->ErrorInfo;
    } else {
        return 1;
    }
}

echo send_phpmail( "", "" ,"", "" , "test", "test body" );