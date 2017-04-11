<?php
// put your code here
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
        <div class="col-md-4 col-md-offset-4" style="margin-top:2%; ">
            <div class="col-md-12 boxborder">
                <div class="col-md-12 text-center">
                    <img src="assets/images/farhorizon.png" alt="Far Horizon" class="farlogo"/>
                </div>
                <div class="clearfix"></div>
                <br>
                <form action="" method="POST" id="FormData" name="FormData">
                    <fieldset>
                        <div class="form-group">
                            <label>Customer Full Name</label>
                            <div class="row">
                                <div class="col-md-3" style="padding-right: 1%;">
                                    <select class="form-control" name="title" id="title" required>
                                        <option value="Mr.">Mr</option>
                                        <option value="Ms.">Ms</option>
                                        <option value="Mrs">Mrs</option>
                                    </select>
                                </div>
                                <div class="col-md-9" style="padding-left: 1%;">
                                    <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Customer Full Name" title="Customer Name Required" required>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label>Customer Email</label>
                            <input type="text" name="customer_email" id="customer_email" class="form-control" placeholder="Customer Email" title="Customer Email Required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                        </div>
                        <div class="form-group">
                            <label>CC Email</label>
                            <input type="text" name="cc_email" id="cc_email" class="form-control" placeholder="CC Email" title="CC Email Required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                        </div>
                        <div class="form-group">
                            <label>Invoice Number</label>
                            <input type="text" name="invoice_number" id="invoice_number" class="form-control" placeholder="Invoice Number" title="Invoice Number Required" required>
                        </div>
                        <div class="form-group">
                            <label>Reference No / File No</label>
                            <input type="text" name="file_no" id="file_no" class="form-control" placeholder="Reference No / File No" title="Reference No / File No Required" required>
                        </div>
                        <div class="form-group">
                            <label>Invoice Amount</label>
                            <div class="row">
                                <div class="col-md-4" style="padding-right: 1%;">
                                    <select class="form-control" name="currency">
                                        <option value="INR">INR</option>
                                        <option value="USD">USD</option>
                                        <option value="GBP">GBP</option>
                                        <option value="AUD">AUD</option>
                                        <option value="EURO">EURO</option>
                                    </select>
                                </div>
                                <div class="col-md-8" style="padding-left: 1%;">
                                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" title="Amount Required" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="country" id="country" class="form-control" placeholder="Country" title="Country Required" required>
                        </div>
                        <div class="form-group text-center">
                            <input type="hidden" name="type" value="SendMail">
                            <button type="submit" data-form="FormData" id="formvalidate" class="btn btn-info btn-md btn-submit" name="Send">Send Mail</button>
                        </div>
                        
                    </fieldset>

                </form>
            </div>
        </div>
        
        
        
        <script src="assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-notify-3.1.3/bootstrap-notify.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="assets/plugins/jqueryvalidate/jquery.validate.min.js" ></script>
        <script src="includes/webscript.js" type="text/javascript"></script>
    </body>
</html>
