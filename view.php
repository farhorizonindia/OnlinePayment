<?php
if(isset($_GET['code']) && !empty($_GET['code']))
{
    include("assets/lib/icicipayment/ipg-util.php");
    $data = (array)json_decode(base64_decode($_GET['code']));
    $data1 = json_encode($data);
    
    extract($data);

    if(strtotime($endtime) > strtotime(date('Y-m-d H:i:s')))
    {
    ?>
    <?php
    if($currency == 'USD')
    {
        $storename = "3300215629";
        $sharedsecret = 'b7Mg7{<tRN';
        $currencycode = "840";
    }
    else if($currency == 'GBP')
    {
        $storename = "3300215630";
        $sharedsecret = 'F6<a+C2WrM';
        $currencycode = "826";
    }
    else if($currency == 'AUD')
    {
        $storename = "3300215631";
        $sharedsecret = 'M75tA@e!Qb';
        $currencycode = "036";
    }
    else if($currency == 'EURO')
    {
        $storename = "3300215632";
        $sharedsecret = 'Vg24Z%]rHc';
        $currencycode = "978";
    }
    else
    {
        $storename = "3300215628";
        $sharedsecret = 'jn95s-`yij';
        $currencycode = "356";
    }

    if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=="127.0.0.1" || $_SERVER['HTTP_HOST']=="192.168.1.1"){
        $base_url = "http://127.0.0.1/farhorizon/";
    }
    else
    {
        $base_url = "http://farhorizonindia.com/farhorizonlive/";
    }
    $responseSuccessURL = $base_url."success.php"; //Need to change as per location of response page
    $responseFailURL = $base_url."fail.php";       //Need to change as per location of response page
    $CT = $amount;
    $txntype = "sale";
    $mode = "payonly";
    $oid = $invoice_number."_".rand(100, 999)."";

    $ogurl = "https://www4.ipg-online.com/connect/gateway/processing";
    //$ogurl = "https://test.ipg-online.com/connect/gateway/processing";
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
        <form method="post" name="frm1" id="PayNow" action="<?php echo $ogurl ?>">
            <input type="hidden" name="timezone" value="IST" />
            <input type="hidden" name="authenticateTransaction" value="true" />
            <input size="50" type="hidden" name="txntype" value="<?php echo $txntype ?>"  />
            <input size="50" type="hidden" name="txndatetime" value="<?php echo getDateTime(); ?>"  />
            <input size="50" type="hidden" name="hash" value="<?php echo createHash($CT,$currencycode,$storename,$sharedsecret); ?>"  />
            <input size="50" type="hidden" name="currency" value="<?php echo $currencycode ?>"  />
            <input size="50" type="hidden" name="mode" value="<?php echo $mode ?>"  />
            <input size="50" type="hidden" name="storename" value="<?php echo $storename ?>"  />
            <input size="50" type="hidden" name="chargetotal" value="<?php echo $CT ?>"  />
            <input size="50" type="hidden" name="sharedsecret" value="<?php echo $sharedsecret ?>"  />
            <input size="50" type="hidden" name="oid" value="<?php echo $oid ?>"  />
            <input type="hidden" name="note" value='<?php echo $data1;?>'>
            <input type="hidden" name="responseSuccessURL" value="<?php echo $responseSuccessURL ?>"  />
            <input type="hidden" name="responseFailURL" value="<?php echo $responseFailURL ?>"  />
            <input type="hidden" name="hash_algorithm" value="SHA1"/>
        </form>
        <div class="col-md-6 col-md-offset-3" style="margin-top:2%; ">
            <div class="col-md-12 boxborder">
                <div class="col-md-12 text-center">
                    <img src="assets/images/farhorizon.png" alt="Far Horizon" class="farlogo"/>
                </div>
                <div class="clearfix"></div>
                <br>
                <fieldset>
                    <table class="table-responsive">
                        <tr>
                            <th>Reference No / File No : </th>
                            <td><?php echo $file_no;?></td>
                        </tr>
                         <tr>
                            <th>Invoice No : </th>
                            <td><?php echo $invoice_number;?></td>
                        </tr>
                        <tr>
                            <th>Name : </th>
                            <td><?php echo $title." ".$customer_name;?></td>
                        </tr>
                        <tr>
                            <th>Email : </th>
                            <td><?php echo $customer_email;?></td>
                        </tr>
                        <tr>
                            <th>Country : </th>
                            <td><?php echo $country;?></td>
                        </tr>
                       
                        <tr>
                            <th>Amount : </th>
                            <td><?php echo $currency." ".$amount;?></td>
                        </tr>
                    </table>
                    <div class="clearfix"></div>
                    <br>
                    <div class="form-group text-center">
                        <p><input type="checkbox" name="accept" id="accept" value="1"> The above given information is correct and I agree to make the payment.</p>
                    </div>
                    
                    <div class="form-group text-center">
                        <button type="button" id="PayBill" class="btn btn-info btn-lg btn-submit" name="Send">Pay Now</button>
                    </div>
                </fieldset>
            </div>
        </div>

        <script src="assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-notify-3.1.3/bootstrap-notify.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="assets/plugins/jqueryvalidate/jquery.validate.min.js" ></script>
        <script src="includes/webscript.js" type="text/javascript"></script>
    </body>
</html>
<?php
    }
    else
    {
        echo "<h1 style='color:red;'>Link has been expired, Please Contact $cc_email for any further information</h1>";
    }
}
else
{
    echo "<h1 style='color:red;'>Invalid Access</h1>";
}
?>
