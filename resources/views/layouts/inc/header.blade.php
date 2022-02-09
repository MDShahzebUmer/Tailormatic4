<!doctype html>
<!--[if IE]><![endif]-->
<!--[if lt IE 7 ]> <html lang="en" class="ie6">    <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7">    <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8">    <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9">    <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
    <head>
    <meta name="google-site-verification" content="BumvrIGn5r8haa5F9dx8llA8PM5t8wVKURSerqzoYnQ" />
    <meta name="p:domain_verify" content="81cbbb5e2d5826c00a5fe173b132c21c"/>

    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KPBC6RT');</script>
<!-- End Google Tag Manager -->
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ setting('site.title') }} || {{$seo['meta_title']}}</title>
        <meta name="keywords" content="Duniya Tailor|| {{$seo['meta_keyword']}}">
        <meta name="description" content="{{ setting('site.description') }} || {{$seo['meta_desc']}}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:url" content="{{url('/')}}" />
        <meta property="og:type" content="website" />
        <meta property="og:title"  content="{{$seo['meta_title']}}" />
        <meta property="og:description"  content="{{$seo['meta_desc']}}" />
        <meta property="og:image" content="http://duniyatailor.com/asset/img/fblogo.png" />
        <meta property="og:image:secure_url" content="http://duniyatailor.com/asset/img/fblogo.png" />


        <!-- Favicon
        ============================================ -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('asset/img/favicon.ico')}}">
        <!-- CSS
        ============================================ -->
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/style.css')}}" media="all">
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/bootstrap.min.css')}}" media="all">
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/font-awesome.min.css')}}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/bootstrap-touch-slider.css')}}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/et-responsive.css')}}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{asset('asset/css/responsive_bootstrap_carousel_mega_min.css')}}" media="screen">

	<?php
        $pro_pop = App\PromotionalPop::select('*')->first();
        if($pro_pop->status==1){
    ?>

         <style type="text/css">
			#demo_info p {margin: 0; padding: 0; font-size: 30px;}
		</style>

 {{-- <script type="text/javascript" src="{{asset('asset/js/bioep.min.js')}}"></script>

 <script type="text/javascript">
			bioEp.init({
				width: 394,
				height: 298,
				html: '<a href="{{url("/")}}/#news"  onclick="closepp();" ><img src="{{url("storage")."/".$pro_pop->img}}" alt="Claim your discount!" /></a>',
				cookieExp: 0
			});
		</script> --}}
        <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/983d1bb8f245a30763cd239a2/f245ab78133b3614469e853db.js");</script>


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
<header id="et-header"><!-- Header Start -->
    <div class="container-l">
        <div class="row">
            <div id="et-wrapper" class="et-navbar"><!-- Navbar Start -->
                <div class="et-logo">
                    <figure class="top-logo">

                       @if(setting('site.logo'))
                        <a href="{{url('/')}}"><img src="{{asset('storage/')}}/{!! setting('site.logo') !!}" alt="{{ setting('site.site_image_name') }}"></a>
                        @endif
                    </figure>
                </div>
                <!-- Sidebar -->
                <div class="et-icon">
                    <div class="float-panel">
                        <button type="button" class="hamburger is-closed " data-toggle="offcanvas">
                            <div class="et-round-one">
                                <div class="et-round-two">
                                    <div class="hamb-nav"></div>
                                    <div class="hamb-nav"></div>
                                    <div class="hamb-nav"></div>
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
