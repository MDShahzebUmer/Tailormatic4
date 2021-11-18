<!Doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>eTailor || Custom Mens Suits & Online Tailor</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
</head>

<body style="font-family: arial;font-size: 15px;margin: 0 auto;padding: 0;text-align: center; color:#616161;border-left:2px #593a2e solid;border-right: 2px #593a2e solid;">


    <header style="background: #19120e;padding:40px 0 30px;">
        <div class="container">
            <div class="row">
                <div class="logo-news" style="border-top: 1px solid #593a2e;padding-top:20px;">
                    <a href="{{url('/')}}"><img src="{{asset('asset/img/email_logo.png')}}" /></a>
                </div>
            </div>
        </div>
    </header>

    <section class="user-n" style="margin: 0 auto;width: 700px;">
        <div class="container">
            <div class="row">
                <div class="user-discription" style="padding: 40px 0;">
                    <span style="font-size: 25px;font-weight: bold;">Hi, ADMIN</span>
                    <P>The Following Person Contact On E-Tailor
                        <br></P>
                    
                </div>
                <div style="clear:both;"></div>
                <div class="user-note" style="margin-top: 50px;text-align: left;background-color: #f8f8f8;padding: 9px 20px;">
                    <span style="font-size: 18px;font-weight: bold;">The details are:</span>
                    
                    <table style="width:100%;">
                      <tr style="width:100%"><td style="width:20%">Subject</td> <td><?php echo $data['con_subject']; ?> </td> </tr>
                        <tr style="width:100%"><td style="width:20%">Name</td> <td><?php echo $data['con_email']; ?> </td> </tr>
                        <tr style="width:100%"><td style="width:20%">Email</td> <td><?php echo $data['con_email']; ?> </td> </tr>
                        <tr style="width:100%"><td style="width:20%">Mobile</td> <td><?php echo $data['con_mobile']; ?> </td> </tr>
                        <tr style="width:100%"><td style="width:20%">Message</td> <td><?php echo $data['con_message']; ?> </td> </tr>
                        
                    </table>
                </div>
                <div class="user-for">
                    <P style="font-size: 22px;margin-bottom: 45px;margin-top: 40px;">For any queries or concerns, <a href="{{url('/pages/contact-us')}}" style="color: #593a2e;text-transform: capitalize;">click here</a>
                    </P>
                </div>
            </div>
        </div>
    </section>
    
    
    <footer style="background: #593a2e;color: #fff;text-transform: uppercase;padding:15px 0;">
        <div class="container">
            <div class="row">
                <ul style="margin: 0;padding: 0;">
                    <li style="display: inline;padding: 0 10px;"><a  style="color:#fff; text-decoration:none;font-size: 12px;" href="{{url('/pages/about-us')}}">About Us</a>
                    </li>
                    <li style="display: inline;padding: 0 10px;font-size: 12px;">|</li>
                    <li style="display: inline;padding: 0 10px;"><a style="color:#fff; text-decoration:none;font-size: 12px;" href="{{url('/pages/contact-us')}}">Contact Us</a>
                    </li>
                    <li style="display: inline;padding: 0 10px;font-size: 12px;">|</li>
                    <li style="display: inline;padding: 0 10px;"><a style="color:#fff; text-decoration:none;font-size: 12px;" href="{{url('/pages/how-we-work')}}">How It Works</a>
                    </li>
                    <li style="display: inline;padding: 0 10px;font-size: 12px;">|</li>
                    <li style="display: inline;padding: 0 10px;"><a style="color:#fff; text-decoration:none;font-size: 12px;" href="{{url('/pages/faq')}}">FAQ’S </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>

</html>