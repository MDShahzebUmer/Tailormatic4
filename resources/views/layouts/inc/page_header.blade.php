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
        <title>{{ setting('site.title') }} || {{$seo['meta_title']}}</title>
        <meta name="keywords" content="eTailor clothes|| {{$seo['meta_keyword']}}">
        <meta name="description" content="eTailor clothes|| {{$seo['meta_desc']}}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      	<meta property="og:url" content="{{url('/')}}" />
        <meta property="og:type" content="website" />
        <meta property="og:title"  content="{{$seo['meta_title']}}" />
        <meta property="og:description"  content="{{$seo['meta_desc']}}" />
        <meta property="og:image" content="http://etailorclothes.com/asset/img/fblogo.png" />
        <meta property="og:image:secure_url" content="http://etailorclothes.com/asset/img/fblogo.png" />
        <!-- Favicon
        ============================================ -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <!-- CSS
        ============================================ -->
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/style.css')}}" media="all">

        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/bootstrap.min.css')}}" media="all">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/font-awesome.min.css')}}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/bootstrap-touch-slider.css')}}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/responsive_bootstrap_carousel_mega_min.css')}}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/et-responsive.css')}}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/jquery-picZoomer.css')}}" media="screen">

	  <?php
	  $pro_pop = App\PromotionalPop::select('*')->first();
	   if($pro_pop->status==1){
	  ?>
	 <style type="text/css">
			#demo_info p {margin: 0; padding: 0; font-size: 30px;}
		</style>

 <script type="text/javascript" src="{{asset('asset/js/bioep.min.js')}}"></script>

 <script type="text/javascript">
			bioEp.init({
				width: 394,
				height: 298,
				html: '<a href="{{url("/")}}/#news" onclick="closepp();" ><img src="{{url("storage")."/".$pro_pop->img}}" alt="Claim your discount!" /></a>',
				cookieExp: 0
			});
		</script>
    <?php }?>
    </head>
<body>
<div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
<header id="et-header" class="et-page-header" style="background-image:url({{asset('/asset/img/page-header.jpg')}});"><!-- Header Start -->
    <div class="container">
        <div class="row c-page-h-row">
            <div id="et-wrapper" class="et-navbar"><!-- Navbar Start -->
                <div class="et-logo">
                    {{-- <figure class="top-logo">
                        @if(setting('site.logo') != '')
                        <a href="{{url('/')}}"><img src="{{asset('storage/')}}/{!! setting('site.logo') !!}" alt="{{ setting('site.site_image_name') }}"></a>
                        @endif
                    </figure> --}}

                    <figure class="top-logo">

                        <a href="{{url('/')}}"><img src="{{asset( 'asset/img/logo-2.png' )}}" alt="{{ setting('site.site_image_name') }}"></a>

                    </figure>

                </div>
                <div class="et-page-title">

                </div>
                <!-- Sidebar -->
                <div class="et-icon">
                    <div class="float-panel">
                        <button type="button" class="hamburger is-closed " data-toggle="offcanvas">
                            <div class="et-round-one">
                                <div class="et-round-two">
                                    <span class="hamb-1"></span>
                                    <!-- <span class="hamb-2"></span> -->
                                    <!-- <span class="hamb-3"></span> -->
                                    <span class="hamb-4"></span>
                                    <!-- <span class="hamb-5"></span> -->
                                    <!-- <span class="hamb-6"></span> -->
                                    <span class="hamb-7"></span>
                                    <!-- <span class="hamb-8"></span> -->
                                    <!-- <span class="hamb-9"></span> -->
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
