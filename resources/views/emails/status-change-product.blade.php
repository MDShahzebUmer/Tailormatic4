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
    'product-details' => 'padding-left: 20px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;',
    'margin0'  => 'margin: 0;',
    'footer-dt-wrap' => 'padding: 8px; line-height: 1.42857143; vertical-lign: top; border-top: 1px solid #ddd; font-style: italic;background: #593A2E; font-size: 15px; letter-spacing: 1px; color: #fff; font-family: "Proxima Nova Regular"; text-align: center; ',
    'footer-ul-list' => 'display: block; width: 465px; margin: 10px auto; font-size: 12px;',
  'footer-listitem' => 'text-align: center;border-right: 1px solid #fff;margin-right: 15px;list-style-type:none;font-style: normal;display:inline-block;',
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
            <td colspan="4" style="{{ $style['logo-td-wrap'] }}"><a href="{{url('/')}}"><img style="max-width: 260px;" src="{{asset('asset/img/email_logo.png')}}"></a></td>
          </tr>
        </thead>
        <tbody>
            <tr>
              <th colspan="4" style="padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; font-style: italic;background: #593A2E; font-size: 15px; letter-spacing: 1px; color: #fff; font-family: 'Proxima Nova Regular';" class="text-center invoice-header-title">{{$mess['subject']}}</th>
            </tr>
            <tr class="orderId">
              <td colspan="4" style="{{ $style['first-head'] }}"><h2 style="{{ $style['margin0'] }}">Dear {{$mess['name']}}, </h2></td>
            </tr>
            <tr class="billing-info">
              <!-- <td style="padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; width: 150px;">
                <img src="img/1-product1.jpg">
              </td> -->
              <td colspan="4" style="{{ $style['product-details'] }}">
                <p style="{{ $style['margin0'] }}"><strong>OrderID No :</strong> #{{$mess['orderid']}},</p>
                <p style="{{ $style['margin0'] }}"><strong>Tracking Code No :</strong> #{{$mess['tracking_code']}}</p>
                <p style="{{ $style['margin0'] }}"><strong>Message : </strong>
                   {{$mess['message']}}
                </p>
                
               
              </td>
            </tr>
            </tr>
            <tr>
         @if($mess['status'] == 5)
           
            <td colspan="4" style="product-details">
               <div class="user-for">
                    <P style="font-size: 16px;margin-bottom: 8px;margin-top: 8px;margin-left: 20px;"><a href="{{url('/review/add')}}/{{$mess['action']}}" style="color: #593a2e;text-transform: capitalize;">Write a review</a>
                    </P>
                </div>
              </td>
                    
            @endif
          
            </tr>
            <tr class="">
              <td colspan="4" style="{{ $style['product-details'] }}">
               <p style="{{ $style['font-italic'] }}"><strong>Regards,</strong><br>EtailorClothes.com</p>
              </td>
            </tr>

           <tr class="footer" style="background-color: #593a2e;">
              <td style="footer-dt-wrap" colspan="4">
                <ul style="{{ $style['footer-ul-list'] }}">
                  <li style="{{ $style['footer-listitem'] }}"><a style="{{ $style['footer-listitem-a'] }}" href="{{url('/pages/about-us')}}">About Us</a></li>
                  <li style="{{ $style['footer-listitem'] }}"><a style="{{ $style['footer-listitem-a'] }}" href="{{url('/pages/contact-us')}}">Contact Us</a></li>
                  <li style="{{ $style['footer-listitem'] }}"><a style="{{ $style['footer-listitem-a'] }}" href="{{url('/pages/how-we-work')}}">How it Works</a></li>
                  <li style="{{ $style['footer-listitem'] }}"><a style="{{ $style['footer-listitem-a'] }}" href="{{url('/pages/faq')}}">FAQ</a></li>
                </ul>
              </td>
            </tr>
        </tbody>
  </table>
</body>


</html>
