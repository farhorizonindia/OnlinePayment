<?php
include("../assets/lib/icicipayment/ipg-util.php");
require_once '../assets/lib/phpmailer/PHPMailerAutoload.php';
if(isset($_POST['type']) && $_POST['type']=='SendMail')
{
    $success = false;
    $message = "";
    extract($_POST);
    if (filter_var($customer_email, FILTER_VALIDATE_EMAIL) === false) 
    {
        $message = "$customer_email is not a valid email address";
    } 
    else if (filter_var($cc_email, FILTER_VALIDATE_EMAIL) === false) 
    {
        $message = "$cc_email is not a valid email address";
    }
    else if(!is_numeric($amount))
    {
        $message = "$amount is not a valid amount";
    }
    else
    {
        $starttime = time();
        $endtime = date('Y-m-d H:i:s', strtotime('+1 day', $starttime));
        $user_name = explode(" ", $customer_name);
        $count = count($user_name)-1;
        $last_name = $user_name[$count];
        $urldata = array(
            "title" => $title,
            "last_name"=>$last_name,
            "customer_name"=> $customer_name,
            "customer_email" => $customer_email,
            "cc_email" => $cc_email,
            "invoice_number" => $invoice_number,
            "file_no" => $file_no,
            "currency" => $currency,
            "amount" => $amount,
            "country" => $country,
            "starttime" => date('Y-m-d H:i:s'),
            "endtime" => $endtime
        );
        $code = base64_encode(json_encode($urldata));
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = str_replace("includes/webfunction.php","view.php?code=".$code,$url);


        $subject = "Invoice from Far Horizon Tours ($invoice_number)";
        $body="
            <p>Dear $title $last_name, </p>
            <p> Thank you for choosing Far Horizon Tours!</p>
            <p> Please find below link to pay the invoice no $invoice_number for $currency $amount.</p>
            <br><br>
            <p><a href='$url' style='border-radius: 10px;padding:10px 20px;color: #fff;background-color: #5bc0de; border-color: #46b8da;text-decoration: none;'>Click to Pay</a></p>
            <br>
            <p>Best wishes,</p>
            <p>Far Horizon Tours Pvt. Ltd.</p>
            <p>India.</p>
        ";
        
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
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
            $message = $mail->ErrorInfo;
        } else {
            $success = true;
            $message = "Mail Sent Successfully";
        }
    }
    
     echo json_encode(array(
        "success"=>$success,
        "message" => $message
    ));
}

