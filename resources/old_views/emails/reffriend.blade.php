<!Doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>E-Tailor || Custom Mens Suits & Online Tailor</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
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
    'secondry-bold-title' => 'font-size: 18px; font-weight:bold; margin-top: 0;',
    'product-td-img' => 'padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; width: 150px;',
    'product-details' => 'padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;',
    'margin0'  => 'margin: 0;',
    'footer-dt-wrap' => 'padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; background: #795548; font-size: 15px; letter-spacing: 1px; color: #fff; font-family: "Proxima Nova Regular"; text-align: center;',
    'footer-ul-list' => 'display: block; width: 465px; margin: 10px auto; font-size: 12px;',
   'footer-listitem' => 'text-align: center;border-right: 1px solid #fff;margin-right: 15px;list-style-type:none;font-style: normal;display:inline-block;',
    'footer-listitem-last' => 'float: left; text-align: center;  margin-right: 15px; list-style-type: none;font-style: normal;',
    'footer-listitem-a' => 'color: #fff; padding-right: 15px;text-decoration: none;',
    'font-italic' => 'font-style: italic;',
    'signup-title' => 'font-size: 18px;margin-bottom: 15px;margin-top: 0px;',
    'register-btn' => 'color: #593a2e;text-transform: capitalize;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>
<body style="{{ $style['body'] }}">
    <table cellpadding="0" cellspacing="0" style="{{ $style['table-wrap'] }}">
        <thead>
          <tr class="invoice-header">
            <td colspan="4" style="{{ $style['logo-td-wrap'] }}"><a href="{{url('/')}}"><img src="{{asset('asset/img/email_logo.png')}}"  style="max-width: 260px;" /></a></td>
          </tr>
        </thead>
        <tbody>
            <tr class="orderId">
              <td colspan="4" style="{{ $style['first-head'] }}"><h2 style="{{ $style['margin0']}}">Hi {{$data['name']}},</h2></td>
            </tr>
            <tr class="billing-info">
              <td colspan="4" style="{{ $style['first-head'] }}">
                <p style="{{ $style['secondry-bold-title'] }}">Your friend has invited you to try EtailorClothes.com </p>
                <p style="{{ $style['margin0'] }}"><strong>Friend Name: </strong>
               <?php echo $data['fname']; ?> 
                </p>
                <p style="{{ $style['margin0'] }}"><strong>Friend Message: </strong>
               <?php echo $data['message']; ?> 
                </p>
                <br>
                <P style="{{ $style['signup-title'] }}">Join Now, <a href="{{url('/register')}}" style="{{ $style['register-btn'] }}">Register Now</a>
                    </P>
              </td>
            </tr>
            </tr>

            <tr class="footer" style="background-color: #593a2e;">
              <td style="footer-dt-wrap" colspan="4">
                <ul style="{{ $style['footer-ul-list'] }}">
                  <li style="{{ $style['footer-listitem'] }}"><a style="{{ $style['footer-listitem-a'] }}" href="{{url('/pages/about-us')}}">About Us</a></li>
                  <li style="{{ $style['footer-listitem'] }}"><a style="{{ $style['footer-listitem-a'] }}" href="{{url('/pages/contact-us')}}">Contact Us</a></li>
                  <li style="{{ $style['footer-listitem'] }}"><a style="{{ $style['footer-listitem-a'] }}" href="{{url('/pages/how-we-work')}}">How it Works</a></li>
                  <li style="{{ $style['footer-listitem'] }}"><a style="{{ $style['footer-listitem-a'] }}" href="{{url('/pages/faq')}}">FAQ'S</a></li>
                </ul>
              </td>
            </tr>
        </tbody>
   </table>
</body>

</html>