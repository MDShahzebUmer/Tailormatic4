@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd" >

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>
Payment Pages: Sample PHP Payment Form
</title>

<style type="text/css">
label {
display: block;
margin: 5px 0px;
color: #AAA;
}
input {
display: block;
}
input[type=submit] {
margin-top: 20px;
}
</style>


<h1>Processing Please Wait...</h1>

<?php

/*print_r($proname);
echo '<br>';
echo $shiptotal;
echo '<br>';
echo $couamt;
echo '<br>';
echo $tax;
echo '<br>';
echo $grtotal;

echo $cartsess=Session::get('carts');*/
$ppath=url('/order');

?>
<form action="https://demo.globalgatewaye4.firstdata.com/pay" method="POST" name="myForm" id="myForm">

<?php
$x_login = "HCO-NEWWO-34"; // Take from Payment Page ID in Payment Pages interface
$transaction_key = "efwme~q36S6CVoXjR0tY"; // Take from Payment Pages configuration interface
$x_amount = $grtotal;
$x_currency_code = "USD"; // Needs to agree with the currency of the payment page
srand(time()); // initialize random generator for x_fp_sequence
$x_fp_sequence = rand(1000, 100000) + 123456;
$x_fp_timestamp = time(); // needs to be in UTC. Make sure webserver produces UTC
$p='/order';

// The values that contribute to x_fp_hash
$hmac_data = $x_login . "^" . $x_fp_sequence . "^" . $x_fp_timestamp . "^" . $x_amount . "^" . $x_currency_code;
$x_fp_hash = hash_hmac('MD5', $hmac_data, $transaction_key);

echo ('<input name="x_login" value="' . $x_login . '" type="hidden">' );
echo ('<input name="x_amount" value="' . $x_amount . '" type="hidden">' );
echo ('<input name="x_fp_sequence" value="' . $x_fp_sequence . '" type="hidden">' );
echo ('<input name="x_fp_timestamp" value="' . $x_fp_timestamp . '" type="hidden">' );
echo ('<input name="x_fp_hash" value="' . $x_fp_hash . '" size="50" type="hidden">' );
echo ('<input name="x_currency_code" value="' . $x_currency_code . '" type="hidden">'); 
//echo ('<input name="x_relay_response" value="TRUE" type="hidden">');
echo ('<input name="x_invoice_num" value="'.$x_fp_sequence.'" type="hidden">');
echo ('<input name="x_email_customer" value="TRUE" type="hidden">');
echo ('<input name="x_email" value="'.$useremail.'" type="hidden">');



foreach($proname as $key => $pval){	
echo ('<input name="x_line_item" value="1<|>'.$pval.'<|>'.$pval.'<|>1<|>'.$proprice[$key].'<|>YES" type="hidden">');
}
echo ('<input name="x_line_item" value="1<|>Shipping<|>Shipping<|>1<|>'.$shiptotal.'<|>YES" type="hidden">');
if($couamt!=0){
echo ('<input name="x_line_item" value="1<|>Discount Amount<|>Discount Amount<|>1<|>'.$couamt.'<|>YES" type="hidden">');
}
if($tax!=0){
echo ('<input name="x_line_item" value="1<|>Tax<|>Tax<|>1<|>'.$tax.'<|>YES" type="hidden">');
}
//echo ('<input name="x_relay_url" value="https://www.google.co.in/" type="hidden">');
echo ('<input name="x_receipt_link_method" value="AUTO-GET" type="hidden">');
echo ('<input name="x_receipt_link_url" value="'.$ppath.'" type="hidden">');

echo ('<input name="tocken" value="{{csrf_token() }}" type="hidden">');
// create parameters input in html
foreach ($_POST as $a => $b) {
	echo "<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>";
}

?>

<input type="hidden" name="x_show_form" value="PAYMENT_FORM"/>
</form>

<script type='text/javascript'>document.myForm.submit();</script>


    </div>
</div>
@endsection