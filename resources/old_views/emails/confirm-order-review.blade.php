<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<?php

$style = [
    /* Layout ------------------------------ */

    'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
    'table-wrap' => 'width: 100%; max-width: 790px; margin: 0 auto;border: 2px solid #212325; color: #333;',
    'logo-td-wrap' => 'padding: 8px; line-height: 1.42857143; vertical-align: top; background: #212325; text-align: center;',
    'first-head' => 'padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;',
    'fisrt-title' => 'margin: 0; margin-left: 20px;',
    'second-title' => 'font-weight: bold; margin: 0;',
    'product-td-img' => 'padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; width: 150px;',
    'product-details' => 'padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;',
    'margin0'  => 'margin: 0;',
    'footer-dt-wrap' => 'padding: 8px; line-height: 1.42857143; vertical-lign: top; border-top: 1px solid #ddd; font-style: italic;background: #593A2E; font-size: 15px; letter-spacing: 1px; color: #fff; font-family: "Proxima Nova Regular";',
    'footer-ul-list' => 'display: block; width: 415px; margin: 0 auto; font-size: 12px;',
    'footer-listitem' => 'float: left; text-align: center; border-right: 1px solid #fff; margin-right: 15px; list-style-type: none;font-style: normal;',
    'footer-listitem-last' => 'float: left; text-align: center;  margin-right: 15px; list-style-type: none;font-style: normal;',
    'footer-listitem-a' => 'color: #fff; padding-right: 15px;text-decoration: none;',
    'font-italic' => 'font-style: italic;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>

<body style="{{ $style['body'] }}">
    <table cellpadding="0" cellspacing="0" style="{{ $style['table-wrap'] }}">
        <thead>
          <tr class="invoice-header">
            <td colspan="4" style="{{ $style['logo-td-wrap'] }}"> <a href="{{url('/')}}"><img style="max-width: 260px;" src="img/eTailor-logo.png"></a></td>
          </tr>
        </thead>
        <tbody>
            <tr class="orderId">
              <td colspan="4" style="{{ $style['first-head'] }}"><h2 style="{{ $style['margin0']}}">Dear {{$mess['name']}},</h2></td>
            </tr>
            <tr class="billing-info">
              <td colspan="4" style="{{ $style['product-details'] }}">
                
                <p style="{{ $style['margin0'] }}"><strong>OrderID No: </strong> #{{$mess['orderid']}}
                </p>
                <P><strong>Tracking Code No : </strong> #{{$mess['tracking_code']}}</P>
                 <P><strong>Message : </strong> {{$mess['message']}}</P>
                <br>
                <p style="{{ $style['font-italic'] }}"><strong>Regards,</strong><br>E-Tailor</p>
                <p>Please click on the link to write a review about product. <a href="">Add Review.</a></p>
              </td>
            </tr>
            </tr>

            <tr class="footer">
              <td style="text-align: center {{ $style['footer-dt-wrap'] }}" colspan="4">
                &copy; 2017 E-Tailor. All rights reserved.
              </td>
            </tr>
        </tbody>
  </table>
     
</body>

</html>
