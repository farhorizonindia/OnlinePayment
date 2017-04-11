<?php
if(isset($_POST) && !empty($_POST))
{
    include("assets/lib/icicipayment/ipg-util.php");
    require_once 'assets/lib/phpmailer/PHPMailerAutoload.php';
    $data = (array)json_decode($_POST['note']);
    extract($data);
    $txn_id = $_POST['endpointTransactionId'];

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Far Horizon</title>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <link href="assets/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
        <link href="custom/custom.css" rel="stylesheet" type="text/css"/>
        <script src="https://use.fontawesome.com/a32ff56380.js"></script>
        <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
        <!--[if lt IE 9]>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="col-md-6 col-md-offset-3" style="margin-top:2%; ">
            <div class="col-md-12 boxborder">
                <div class="col-md-12 text-center">
                    <img src="assets/images/farhorizon.png" alt="Far Horizon" class="farlogo"/>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="col-md-12 text-left">
                    <p>Dear <?php echo $title." ".$customer_name;?>,</p>
                    <p>Your payment of <?php echo $currency." ".$amount;?> for the invoice number <?php echo $invoice_number;?> has been received. Payment reference number is <?php echo $txn_id;?>.</p>
                    <p>Thank you for your payment.</p>
                    <p>Best wishes,</p>
                    <p>Far Horizon Tours Pvt. Ltd.</p>
                    <p>India.</p>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    $subject = "Payment successful (Invoice number: $invoice_number)";
    $body="
        <p>Dear $title $last_name, </p>
        <p> Your payment of $currency $amount for the invoice number $invoice_number has been received.</p>
        <p>Thank you for your payment.</p>
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
else
{
    echo "<h1 style='color:red;'>Invalid Access</h1>";
}
?>

