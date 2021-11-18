<!DOCTYPE html>
<html lang="en">
<head>
  <title>Coming Soon </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="{{asset('asset/css/bootstrap.min.css')}}" media="all">
  <style type="text/css">
    *{margin: 0; padding: 0;}
    html, body{height: 100%; margin: 0; font-family:Arial;}
    .sk-wrapper{width: 100%; float: left; background: url(bgsoon-tailor.jpg); height: 100%;background-size: 106%;padding-top: 10%;}
    .sk-wrapper:before{position: absolute; min-height: 100%; content: "";}
    .sk-cominsoon-title{color: #fff;text-transform: uppercase; font-weight: bold; font-size: 50px;margin-top: 35px;font-family: sans-serif; margin-bottom: 0;}
    .sk-btn-box{max-width: 330px; margin: 25px auto;}
    .sk-btn{background: #fff; padding: 12px 15px; min-width: 140px; border: 0; margin: 0 12px; color: #000; font-size: 15px;    font-weight: 600;text-decoration: none;float: left;}
    .sk-btn:hover, .sk-btn:focus, .sk-btn:active{text-decoration: none;color: #000;}
    .sk-inner-box img{max-width: 100%;}
    .sk-inner-box{padding: 0 10%;}
    @media only screen and (max-width: 1199px) {
      .sk-wrapper{background-position: 50% -33px;background-size: inherit;}

    }
    @media only screen and (max-width: 490px) {
      .sk-cominsoon-title{font-size: 30px;}
      .sk-btn{padding: 7px 15px;min-width: 100px; margin-left: 0; margin-right: 0; font-family:Arial;}
      .sk-btn-mr{margin-right: 10px;}
      .sk-btn-box{max-width: 212px;}
    }
  </style>
</head>
<body>
<section class="sk-wrapper" style="background-image:url({{asset('/asset/img/bgsoonetailor.jpg')}});">
  <div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
          <div class="sk-inner-box">
           <a href="{{url('/')}}"> <img src="{{asset('asset/img/cs-logo.png')}}"></a>
            <h1 class="sk-cominsoon-title">Coming Soon</h1>
            <div class="sk-btn-box">
              <a href="{{url('pages/contact-us')}}" class="sk-btn sk-btn-mr">Contact Us</a>
               <a href="{{url('pages/about-us')}}" class="sk-btn">About Us</a>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>
</body>
</html>
