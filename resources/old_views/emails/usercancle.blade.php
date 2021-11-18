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
    'first-head' => 'padding-left: 20px; line-height: 1.42857143; vertical-align: top; ',
    'first-heads' => 'padding: 8px; line-height: 1.42857143; vertical-align: top;',
    'fisrt-title' => 'margin: 0; margin-left: 20px;',
    'second-title' => 'font-weight: bold; margin: 0;',
    'product-td-img' => 'padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; width: 150px;',
    'product-details' => 'padding-left:20px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;',
    'margin0' =>  'margin: 0;',
    'footer-dt-wrap' => 'padding: 8px; line-height: 1.42857143; vertical-lign: top; border-top: 1px solid #ddd; font-style: italic;background: #593A2E; font-size: 15px; letter-spacing: 1px; color: #fff; font-family: "Proxima Nova Regular";',
    'footer-ul-list' => 'display: block; width: 465px; margin: 10px auto; font-size: 12px;',
   'footer-listitem' => 'text-align: center;border-right: 1px solid #fff;margin-right: 15px;list-style-type:none;font-style: normal;display:inline-block;',
    'footer-listitem-last' => 'float: left; text-align: center;  margin-right: 15px; list-style-type: none;font-style: normal;',
    'footer-listitem-a' => 'color: #fff; padding-right: 15px;text-decoration: none;',
    'footer-viewinfo' => 'font-size: 18px;margin-bottom: 0px;margin-top: 45px;',
    'footer-info' => 'color: #593a2e;text-transform: capitalize;',
    'font-italic' => 'font-style: italic;',


];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>
<body style="{{ $style['body'] }}">
   <table cellpadding="0" cellspacing="0" style="{{ $style['table-wrap'] }}">
        <thead>
          <tr class="invoice-header">
            <td colspan="4" style="{{$style['logo-td-wrap']}}"> <a href="{{url('/')}}"><img src="{{asset('asset/img/email_logo.png')}}" style="max-width: 260px"/></a></td>
          </tr>
        </thead>
        <tbody>
          <tr class="orderId">
            <td colspan="4" style="{{$style['first-heads']}}">
              <h2 style="{{ $style['fisrt-title'] }}">Dear {{$u['name']}},</h2>
              <br>
            </td>
          </tr>

            <tr class="orderId">
              <td colspan="4">
                <h4 style="{{ $style['fisrt-title'] }}">We would like to inform you that we have processed your cancellation request for the following Order No.#{{$u['order_id']}}</h4>
            </td>
            
            </tr>
            <tr class="orderId">
              <td colspan="4" style="{{$style['first-head']}}">
              
              <h4 style="margin-left:18px;">Message From {{$u['name']}}</h4>
              <p style="margin-left:18px;"><b>Reason</b>:{{$u['reason']}}<br>{{$u['decs_reason']}} </p>
              </td>
            </tr>
            <tr class="billing-info">
              
              <td colspan="4" style="{{ $style['product-details'] }}">
                <p style="{{ $style['margin0'] }}"><strong>OrderId :</strong>#<?php echo $u['order_id'];?> </p>
                <p style="{{ $style['margin0'] }}"><strong>Tracking Code:</strong><?php echo $u['tracking_code'];?> </p>
                <p style="{{ $style['margin0'] }}"><strong>Total Items:</strong><?php echo $u['itemcoun'];?> </p>
                <p style="{{ $style['margin0'] }}"><strong>Date :</strong><?php echo $u['odate'];?> </p>
               
                  </P>
              </td>
            </tr>
             <tr class="billing-info">
              
              <td colspan="4" style="{{ $style['product-details'] }}">
               <div class="user-for">
                    <P style="font-size: 16px;margin-bottom: 8px;margin-top: 8px;margin-left: 3px;"><a href="{{url('/storage/pdf/')}}/{{$u['order_id']}}-invoice.pdf" style="color: #593a2e;text-transform: capitalize;">View Invoice</a>
                    </P>
                </div>
              </td>
            </tr>
            <tr>
                <td colspan="4" style="{{$style['first-head']}}"> <p style="{{ $style['font-italic'] }}"><strong>Regards,</strong><br>E-Tailor</p></td></tr>
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