
<!doctype html>
<!--[if IE]><![endif]-->
<!--[if lt IE 7 ]> <html lang="en" class="ie6">    <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7">    <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8">    <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9">    <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
          <title>eTailor clothes</title>
        <meta name="keywords" content="eTailor clothes">
        <meta name="description" content="eTailor clothes">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon
        ============================================ -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <!-- CSS 
        ============================================ -->            
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/style.css')}}" media="all">
        
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/bootstrap.min.css')}}" media="all">
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/font-awesome.min.css')}}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/bootstrap-touch-slider.css')}}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/responsive_bootstrap_carousel_mega_min.css')}}" media="screen">
       <link rel="stylesheet" type="text/css" href="{{asset('asset/css/et-responsive.css')}}" media="screen">
        
    </head>
<body>
<header id="et-header" class="et-page-header" style="background-image:url({{asset('/asset/img/page-header.jpg')}});"><!-- Header Start -->
    <div class="container">
        <div class="row">
            <div id="et-wrapper" class="et-navbar"><!-- Navbar Start -->
                <div class="et-logo">
                    <figure class="top-logo">
                        <a href="{{url('/')}}"><img src="{{asset('storage/')}}/{!! setting('site.logo') !!}" alt="{{ setting('site.site_image_name') }}"></a>
                    </figure>
                </div>                
                <div class="et-page-title">
                    <div class="et-title">
                      <!-- {!! Route::getCurrentRoute()->getPath() !!} -->
                   </div>
                </div>
                <!-- Sidebar -->
                <div class="et-icon">
                    <div class="float-panel">
                        <button type="button" class="hamburger is-closed " data-toggle="offcanvas">
                            <div class="et-round-one">
                                <div class="et-round-two">
                                    <span class="hamb-1"></span>
                                    <span class="hamb-2"></span>
                                    <span class="hamb-3"></span>
                                    <span class="hamb-4"></span>
                                    <span class="hamb-5"></span>
                                    <span class="hamb-6"></span>
                                    <span class="hamb-7"></span>
                                    <span class="hamb-8"></span>
                                    <span class="hamb-9"></span>
                                    <span class="hamb-top"></span>
                                    <span class="hamb-bottom"></span>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
                <nav class="navbar navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                    @include('layouts.inc.side-menu')
                </nav>
            </div><!-- Navbar End -->
        </div>
    </div>
</header><!-- Header End -->
@include('layouts.inc.page_menu')

<section class="et-content">
	<div class="container">
    	<div class="row">
        	<!-- <div class="et-sub-title et-fw">
            	<h2>Contact Us</h2>
            </div> -->
      	     <div class="col-sm-12 text-center">
                @if($sta == 1)
                <div class="et-thank-you">

                    <h1 class="text-center">
                   
                    You're all set!
                    </h1>
                    <p><strong>Fabric Id : </strong> {{$ids}}</p>
                    <h3>Thank you  For Images Created, <br> we hope you enjoy !</h3> <br>
                    <a href="{{url('/')}}"  class="et-btn">Continue ></a>
                </div> 
                @elseif($sta == 2)
                <div class="et-thank-you">
                     <h1 class="text-center">
                     You're all set!
                    </h1>
                    <p><strong>Fabric Id : </strong> {{$ids}}</p>
                    <h3>Fabric are not created in serverr  </h3> <br>
                    <a href="{{url('/')}}"  class="et-btn">Continue ></a>
                </div> 

                @else
                <div class="et-thank-you">
                     <h1 class="text-center">
                     You're all set!
                    </h1>
                    <p><strong>Fabric Id : </strong> {{$ids}}</p>
                    <h3>Thank you  For Images Created, <br> we hope you enjoy !</h3> <br>
                    <a href="{{url('/')}}"  class="et-btn">Continue ></a>
                </div> 

                @endif
             </div>
        </div>
    </div>
</section>

<!-- Bootstrap Main JS File -->
	@include('profile.profile-footer')
</body>
</html>
