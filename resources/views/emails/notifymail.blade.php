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

<body style="font-family: arial;font-size: 15px;margin: 0 auto;padding: 0;text-align: center; color:#616161;border-left:2px #593a2e solid;border-right: 2px #593a2e solid;">


    <header style="background: #19120e;padding:0px 0 30px;">
        <div class="container">
            <div class="row">
                <div class="logo-news" style="border-top: 1px solid #593a2e;padding-top:5px;">
                    <a href="{{url('/')}}"><img src="{{asset('asset/img/email_logo.png')}}" /></a>
                </div>
            </div>
        </div>
    </header>
   
<?php //print_r($data); ?>
    <section class="user-n" style="margin: 0 auto;width: 700px;">
        <div class="container">
            <div class="row">
                <div class="user-discription" style="padding: 40px 0;">
                    <span style="font-size: 25px;font-weight: bold;">Hello {{$data['name']}}, </span>
                    <P>A Product of your wishlist is on sale. 
                        <br></P>
                    
                </div>
                <div style="clear:both;"></div>
                <div class="user-note" style="margin-top: 10px;text-align: left;background-color: #f8f8f8;padding: 9px 20px;">
                    <span style="font-size: 18px;font-weight: bold;">Product Details:</span>
                    
                    <table style="width:100%;">
                      
                        <tr class="billing-info">
	          <td style="padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; width: 150px;">
	            <a href="{{url('/productdetails')}}/{{$data['proID']}}"><img src="{{url('/storage/')}}/{{$data['main_img']}}"width="89%" ></a>
	          </td>
	          <td colspan="3" style="padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">
	            <p style="margin: 0;"><strong>Product Name :</strong> {{$data['prod_name']}},</p>
                @if($data['pp']==1)
                <p style="margin: 0;"><strong>Size:</strong> 
                @foreach($data['siz'] as $sz)                
                <?php echo App\MeasurmentSize::ecollection_size_name($sz) ?>                
                 @endforeach
                 </p>
                @endif
                 <p style="margin: 0;"><strong>Price :</strong> ${{$data['mrp']}},</p>
	            <p style="margin: 0;"><strong>Product Description : </strong>
	          {{$data['desc']}}
	            </p>
	          </td>
	        </tr>
	        </tr>
                       
                        
                    </table>
                </div>
                <div class="user-for">
                    <P style="font-size: 22px;margin-bottom: 45px;margin-top: 40px;">More information about products, <a href="{{url('/productdetails')}}/{{$data['proID']}}" style="color: #593a2e;text-transform: capitalize;">View Product</a>
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