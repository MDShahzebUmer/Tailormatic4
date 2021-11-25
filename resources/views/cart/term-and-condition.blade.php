<?php  $seo = App\Http\Helpers::page_seo_details(33);?>
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
        <title>eTailor clothes|| {{$seo['meta_title']}}</title>
        <meta name="keywords" content="eTailor clothes|| {{$seo['meta_keyword']}}">
        <meta name="description" content="eTailor clothes|| {{$seo['meta_desc']}}">
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
@include('layouts.inc.page_menu')

<section class="et-content">
	<div class="container">
    	<div class="row">
        <div class="et-sub-title et-fw">
            	<h2>Coupan Term Policies</h2>
            </div> 
      	     <div class="col-sm-12 ">
               <p>{!! $term->coupan_term !!}</p>
               <br>
                <br>
<br>
<br>
<br>
<br>
<br>

             </div>
        </div>
    </div>
</section>

<section class="et-visa-section"><!-- Section Start -->
    <div class="container">
        <div class="row">
            <div class="et-visa-sec">
               <div class="col-md-6 col-sm-6">
               <div class="left-sil-area">
                <div class="image-sil">
                  <img src="{{asset('/asset/img/sil.png')}}"/>
                </div>
                <div class="need-help">
                 <h4>Need Help? Call Us On: +91 123 456 7890</h4>
                </div>
               </div> 
               </div> 
               
               <div class="col-md-6 col-sm-6">
               <div class="right-pay-area">
               
                <ul>
                 <li><img src="{{asset('/asset/img/icon-01.png')}}"/></li>
                  <li><img src="{{asset('/asset/img/icon-02.png')}}"/></li>
                  <li><img src="{{asset('/asset/img/icon-03.png')}}"/></li>
                  <li><img src="{{asset('/asset/img/icon-05.png')}}"/></li>
                  <li><img src="{{asset('/asset/img/icon-06.png')}}"/></li>
                </ul>
                
               </div>   
               </div> 
            </div>
         </div>
    </div>
</section>

<section class="et-powered"><!-- Section Start -->
    <div class="container">
        <div class="row">
         <div class="et-linkspow">
            <div class="col-md-6 col-sm-6">
              <div class="et-Copyright"><P>{{setting('site.Copyright')}}</P></div>
            </div>
            <div class="col-md-6 col-sm-6">
             <div class="et--link">
             
               <ul>
                @foreach($soc as $s)
                 <li><a href="{{$s->url}}" target="_blank"><i class="fa fa-{{$s->name}}" aria-hidden="true" ></i></a></li>
                 @endforeach
               </ul>
             </div>
            </div>
          </div>
       </div>
    </div>
</section>

<section class="et-footer">
    <div class="container">
   <div class="row">
     <div class="et-foot">
       @include('../layouts.inc.footer-strkey')
   </div>
 </div>
</div>
</section>

    <!-- Bootstrap Main JS File -->
    <script type="text/javascript" src="{{asset('asset/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset/js/bootstrap.min.js')}}"></script>
    <!-- Bootstrap bootstrap-touch-slider Slider Main JS File -->
    <script type="text/javascript" src="{{asset('asset/js/float-panel.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset/js/responsive_bootstrap_carousel.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset/js/jquery.touchSwipe.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset/js/bootstrap-touch-slider.js')}}"></script>
   
    <script type="text/javascript">
        $( '#et-banner' ).bsTouchSlider();
    </script>
     <!-- Bootstrap Side Menu JS File -->
    <script type="text/javascript">
        $(document).ready(function () {
          var trigger = $('.hamburger'),
              overlay = $('.overlay'),
             isClosed = false;
        
            trigger.click(function () {
              hamburger_cross();      
            });
        
            function hamburger_cross() {
        
              if (isClosed == true) {          
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
              } else {   
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
              }
          }
          
          $('[data-toggle="offcanvas"]').click(function () {
                $('#et-wrapper').toggleClass('toggled');
          });  
        });
        $('.navbar-nav > li').mouseover( function(){
            $(this).find('a').tab('show');
        });
        $('.navbar-nav > li').mouseout( function(){
            $(this).find('a').tab('hide');
        });
    </script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function(e) {
            $("[id^='lst_']").hover(function(e) {
                var colr=$(this).attr('id');
                var orgcolr=colr.replace('lst_','').trim();
                var bgc={'red':'fullimage1.jpg','black':'fullimage2.jpg','blue':'fullimage3.jpg','green':'fullimage4.jpg','cyan':'fullimage5.jpg'};
                //alert(bgc[orgcolr]);
                $("body").css('background-image','url('+bgc[orgcolr]+')');
                $("body").css('background-repeat','no-repeat');
            });
        });
    </script>