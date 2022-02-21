<?php
    $seo = App\Http\Helpers::page_seo_details(14);
    $cartcount = App\Http\Helpers::cartcount();
?>
<!doctype html>
<!--[if IE]><![endif]-->
<!--[if lt IE 7 ]> <html lang="en" class="ie6">    <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7">    <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8">    <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9">    <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Duniya Tailor|| {{$seo['meta_title']}}</title>
    <meta name="keywords" content="Duniya Tailor|| {{$seo['meta_keyword']}}">
    <meta name="description" content="Duniya Tailor|| {{$seo['meta_desc']}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:url" content="{{url('/')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:title"  content="{{$seo['meta_title']}}" />
    <meta property="og:description"  content="{{$seo['meta_desc']}}" />
    <meta property="og:image" content="http://etailorclothes.com/asset/img/fblogo.png" />
    <meta property="og:image:secure_url" content="http://etailorclothes.com/asset/img/fblogo.png" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('asset/img/favicon.ico')}}">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/style.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/et-responsive.css')}}" media="screen">

    <link rel="stylesheet" type="text/css" href="{{asset('demo/css/stylejacket.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('demo/css/bootstrap.min.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('demo/css/font-awesome.min.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('demo/css/bootstrap-touch-slider.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('demo/css/responsive_bootstrap_carousel_mega_min.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('demo/css/stylemobilethreepiece.css?v0')}}" media="all">

    <script type="text/javascript" src="{{asset('demo/js/jquery.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('demo/js/jquery-1.11.3.min.js')}}"></script>

    <!-- Loader -->
    <script type="text/javascript" src="{{asset('demo/js/jquery.DEPreLoad.js')}}"></script>
    <script type="text/javascript">
    window.onbeforeunload = function() {
        return 'Your progress will be lost';
    }
</script>
    <script type="text/javascript">
    $(document).ready(function() {
        var l=$("#loadme").val();
        if(l==0){
            setTimeout(function(){$("#depreload .wrapper").animate({ opacity: 1 });}, 40);
            setTimeout(function(){$("#depreload .logo").animate({ opacity: 1 });}, 600);
            var canvas  = $("#depreload .line")[0],
            context = canvas.getContext("2d");
            context.beginPath();
            context.arc(125, 125, 125, Math.PI * 1.5, Math.PI * 1.6);
            context.strokeStyle = '#9e792b';
            context.lineWidth = 5;
            context.stroke();
            var loader = $("html").DEPreLoad({
                OnStep: function(percent) {
                    // console.log(percent + '%');
                    $("#depreload .line").animate({ opacity: 1 });
                    $("#depreload .perc").text(percent + "%");
                    if (percent > 5) {
                        context.clearRect(0, 0, canvas.width, canvas.height);
                        context.beginPath();
                        context.arc(125, 125, 125, Math.PI * 1.5, Math.PI * (1.5 + percent / 50), false);
                        context.stroke();
                    }
                },
                OnComplete: function() {
                    // console.log('Everything loaded!');
                    $("#depreload").hide(100);
                    $("#depreload .perc").text("done");
                    $("#depreload .loading").animate({ opacity: 0 });
                    setTimeout(function(){$(".t-s-price").css("display","block");}, 1000);
                    $("#tailor_content").css("display","flex");
                }
            });
        }
    });
    </script>
    <!-- Loader Ends -->

</head>
<body class="designshirt">

<?php $myArray=$eTailorObj;?>
<input type="hidden" name="loadme" id="loadme" value="<?php echo $activeload = isset($loadme) ? $loadme : '0'; ?>">
<input type="hidden" name="tabActiveId" id="tabActiveId" value="<?php echo $activeTab = isset($mytab) ? $mytab : 'etfabric'; ?>">
<input type="hidden" name="tabSActiveId" id="tabSActiveId" value="<?php echo $activeSubTab = isset($mysubtab) ? $mysubtab : 'fabric6'; ?>">
<input type="hidden" name="harr" id="harr" value="<?php echo htmlspecialchars(json_encode($myArray)); ?>">

<!-- ================== loading progress ================== -->
@if($loadme==0)
<div id="depreload" class="table et-loader">
    <div class="table-cell wrapper">
        <div class="circle">
            <canvas class="line" width="256px" height="256px"></canvas>
            <img src="{{asset('demo/img/logo.png')}}" class="logo" alt="logo" />
            <p class="perc"></p>
        	<p class="loading">Loading</p>
        </div>
    </div>
</div>
@endif

<!-- =================== 3pc content ==================== -->
<div id="tailor_content" class="tailor-content" style="display:none;">
    <?php
        $i = 0;
        $fabric_ary = [];
        foreach ($group_jacket_record as $gr) {
            $fabric_ary[$i] = [];
            foreach($fb_group as $row){
                if($gr->id == $row->parent_id){
                    $fabric_ary[$i]['jacket'] = $gr;
                    $fabric_ary[$i]['jacket']['fabric_rate'] = $row->fabric_rate;
                    $fabric_ary[$i]['jacket']['fabric_offer_price'] = $row->fabric_offer_price;
                    break;
                }
            }
            // $fabric_ary[$i]['jacket'] = $gr;
            $i++;
        }
        $i = 0;
        foreach ($group_pant_record as $gr) {
            foreach($fb_group as $row){
                if($gr->id == $row->parent_id){
                    $fabric_ary[$i]['pant'] = $gr;
                    $fabric_ary[$i]['pant']['fabric_rate'] = $row->fabric_rate;
                    $fabric_ary[$i]['pant']['fabric_offer_price'] = $row->fabric_offer_price;
                    break;
                }
            }
            // $fabric_ary[$i]['pant'] = $gr;
            $i++;
        }
        $i = 0;
        foreach ($group_record as $gr) {
            foreach($fb_group as $row){
                if($gr->id == $row->parent_id){
                    $fabric_ary[$i]['vest'] = $gr;
                    $fabric_ary[$i]['vest']['fabric_rate'] = $row->fabric_rate;
                    $fabric_ary[$i]['vest']['fabric_offer_price'] = $row->fabric_offer_price;
                    break;
                }
            }
            // $fabric_ary[$i]['vest'] = $gr;
            $i++;
        }

        $first_price = 0;
        if(!empty($fabric_ary[0]['jacket']->fabric_rate)){
            $first_price += $fabric_ary[0]['jacket']->fabric_rate;
        }
        if(!empty($fabric_ary[0]['pant']->fabric_rate)){
            $first_price += $fabric_ary[0]['pant']->fabric_rate;
        }
        if(!empty($fabric_ary[0]['vest']->fabric_rate)){
            $first_price += $fabric_ary[0]['vest']->fabric_rate;
        }
    ?>
    <!-- ========================== header =============================== -->
    <div class="row t-header">
        <div class="col-md-11 left-h">
            <div class="pt-right-p">
                <ul>
                    <li class="">
                        <a class="cart-checkout">
                            <figure class="t-cart-figure">
                                <img class="t-cart-img" src="{{asset('asset/img/product/cart.png')}}">
                                <figcaption>{{$cartcount}}</figcaption>
                            </figure>
                        </a>
                        <input type="hidden" id="crtcount" value="{{$cartcount}}">
                    </li>
                    <li>|</li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">MY ACCOUNT</a></li>
                        <li>|</li>
                        <li><a href="{{ url('/login') }}">LOGIN </a></li>
                    @else
                        <li><a href="{{ url('/myaccount') }}">MY ACCOUNT</a></li>
                        <li>|</li>
                        <li>
                        <a href="{{ url('/logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <span>LOGOUT</span>
                        </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
             </li>
             @endif
            </ul>
            </div>
        </div>
        <div class="col-md-1 right-h">
            <header id="et-header"><!-- Header Start -->
                <div class="container">
                    <div class="row">
                        <div id="et-wrapper" class="et-navbar"><!-- Navbar Start -->
                            <div class="et-icon">
                                <div class="float-panel">
                                    <button type="button" class="hamburger is-closed " data-toggle="offcanvas">
                                        <div class="et-round-one">
                                            <div class="et-round-two">
                                                <span class="hamb-1"></span>
                                                <span class="hamb-4"></span>
                                                <span class="hamb-7"></span>
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
            </header>
        </div>
    </div>
    <div class="t-logo-content">
        <div class="et-logo">
            <figure class="top-logo">
                @if(setting('site.logo'))
                <a href="{{url('/')}}"><img src="{{asset('storage/')}}/{!! setting('site.logo') !!}" alt="{{ setting('site.site_image_name') }}"></a>
                @endif
            </figure>
        </div>
        <div>
            <figure class="t-price">
                <span class="t-s-price" style="display:none;">${{$first_price}}</span>
            </figure>
        </div>
    </div>
    <!-- ================================== preview image ================================ -->

    <div id="prev_img_jacket" class="design-prev-div prev-active" >
        <div class="pt-men-left" id="main-front">
            <div class="pt-jacketimage-div">@include('jacket.process')
                <img src="{{asset('demo/img/product/blank.png')}}"/>
            </div>
            <div class="pt-price-shirt">
                <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBackJacket();">BACK VIEW</a>
            </div>
        </div>
        <div class="pt-men-left" id="main-side" style="display:none;">
            <div class="pt-jacketimage-div">@include('jacket.process')
                <img src="{{asset('demo/img/product/blank.png')}}"/>
            </div>
            <div class="pt-price-shirt">
                <span style="color: #eb4301;font-size: 20px;"> Inside View Of Jacket </span>
            </div>
        </div>
        <div class="pt-men-left" id="main-back" style="display:none;">
            <div class="pt-jacketimage-div">@include('jacket.process')
                <img src="{{asset('demo/img/product/blank.png')}}"/>
            </div>
            <div class="pt-price-shirt">
                <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFrontJacket();">FRONT VIEW</a>
            </div>
        </div>
    </div>
    <div id="prev_img_pant" class="design-prev-div" >
        <div class="pt-men-left" id="main-front">
            <div class="m-image pt-pantimage-div">@include('pants.process')
                <img src="{{asset('demo/img/product/blank.png')}}" alt=""/>
            </div>
            <div class="pt-price-shirt">
                <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBackPant();">BACK VIEW</a>
            </div>
        </div>
        <div class="pt-men-left" id="main-back" style="display:none;">
            <div class="m-image pt-pantimage-div">@include('pants.process')
                <img src="{{asset('demo/img/product/blank.png')}}" alt=""/>
            </div>
            <div class="pt-price-shirt">
                <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFrontPant();">FRONT VIEW</a>
            </div>
        </div>
    </div>
    <div id="prev_img_vest" class="design-prev-div" >
        <div class="pt-men-left" id="main-front">
            <div class="pt-image-div">@include('jacket.process')
                <img src="{{asset('demo/img/product/blank.png')}}"/>
            </div>
            <div class="pt-price-shirt">
                <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBack();">BACK VIEW</a>
            </div>
        </div>
        <div class="pt-men-left" id="main-side" style="display:none;">
            <div class="pt-image-div">@include('jacket.process')
                <img src="{{asset('demo/img/product/blank.png')}}"/>
            </div>
            <div class="pt-price-shirt">
                <span style="color: #eb4301;font-size: 20px;"> Inside View Of Jacket </span>
            </div>
        </div>
        <div class="pt-men-left" id="main-back" style="display:none;">
            <div class="pt-image-div">@include('jacket.process')
                <img src="{{asset('demo/img/product/blank.png')}}"/>
            </div>
            <div class="pt-price-shirt">
                <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFront();">FRONT VIEW</a>
            </div>
        </div>
    </div>
    <div class="box-view-design">
        <ul>
            <li>
                <div id="sb_jacket" class="pt-image-div-2 sb-open" onClick="showStyleByImg('jacket')">
                    <img src="{{asset('demo/img/product/threepiece-jacket.png')}}"
                    style="height:55px;width: 37px;" />
                </div>
            </li>
            <li>
                <div id="sb_pant" class="pt-image-div-2" onClick="showStyleByImg('pant')">
                    <img src="{{asset('demo/img/product/threepiece-pant.png')}}"
                    style="height:56px;width: 27px;" />
                </div>
            </li>
            <li>
                <div id="sb_vest" class="pt-image-div-2" onClick="showStyleByImg('vest')">
                    <img src="{{asset('demo/img/product/threepiece-vest.png')}}"
                    style="height:52px;width: 35px;" />
                </div>
            </li>
        </ul>
    </div>

    <!-- =================================== tab content ================================== -->
    <div id="tab-content" class="c-tab-content tab-content" style="display:none;">
        <div class="row m-auto">
            <div class="col-md-12">
                <a onclick="hideTabContent();" class="tab-close-btn"></a>
            </div>
        </div>
        <div class="threepiece-content">
            @include('threepiece.mobile1')
            @include('threepiece.mobile2')
            @include('threepiece.mobile3')
        </div>
    </div>
    <!-- =================================== tab menu ===================================== -->
    <div class="t-p-menu-1">
        <ul class="nav nav-tabs" role="tablist">
            <li id="main_menu_etfabric" role="presentation" class="mm-li <?php echo (isset($mytab)&& $mytab == 'etfabric') ? 'active' : '' ?>" >
                <a href="#etfabric" class="fabric-link" aria-controls="fabric" role="tab" data-toggle="tab" onclick="openNav('etfabric')">
                    <figure class="fnd-fg">
                        <figcaption><span class="lang">Fabric</span> </figcaption>
                        <div class="fg-preview">
                            <div class="fg-border">
                                <img src="{{asset('asset/img/product/fabric2.png')}}" alt="Fabric">
                            </div>
                        </div>
                    </figure>
                </a>
            </li>
            <li id="main_menu_etstyle" role="presentation" class="mm-li <?php echo (isset($mytab)&& $mytab == 'etstyle') ? 'active' : '' ?>" >
                <a href="#etstyle" class="style-link" aria-controls="style" role="tab" data-toggle="tab" onclick="openNav('etstyle')">
                    <figure class="fnd-fg">
                        <figcaption><span class="lang">Style</span> </figcaption>
                        <div class="fg-preview">
                            <div class="fg-border">
                                <img src="{{asset('asset/img/product/style2.png')}}" alt="Style">
                            </div>
                        </div>
                    </figure>
                </a>
            </li>
            <li id="main_menu_etcontrast" role="presentation" class="mm-li <?php echo (isset($mytab)&& $mytab == 'etcontrast') ? 'active' : '' ?>" >
                <a href="#etcontrast" class="contrast-link" aria-controls="contrast" role="tab" data-toggle="tab" onclick="openNav('etcontrast')">
                    <figure class="fnd-fg">
                        <figcaption><span class="lang">Contrast</span> </figcaption>
                        <div class="fg-preview">
                            <div class="fg-border">
                                <img src="{{asset('asset/img/product/contrast2.png')}}" alt="contrast">
                            </div>
                        </div>
                    </figure>
                </a>
            </li>
            <li id="main_menu_etmeasurement" role="presentation" class="mm-li <?php echo (isset($mytab)&& $mytab == 'etmeasurement') ? 'active' : '' ?>" >
                <a href="#etmeasurement" class="measurement-link" aria-controls="settings" role="tab" data-toggle="tab" onclick="openNav('etmeasurement')">
                    <figure class="fnd-fg">
                        <figcaption><span class="lang">Measurement</span> </figcaption>
                        <div class="fg-preview">
                            <div class="fg-border">
                                <img src="{{asset('asset/img/product/measurement2.png')}}" alt="measurement">
                            </div>
                        </div>
                    </figure>
                </a>
            </li>
        </ul>
    </div>
    <div id="style_sub_menu" class="t-p-sub-menu" style="display:none;">
        <ul class="nav nav-tabs" role="tablist">
            <li id="style_sm_jackets" class="style-sm" role="presentation">
                <a class="jacket-link" role="tab" onClick="showStyle('jackets')">
                    <figure class="fnd-fg">
                        <figcaption><span class="lang">Jacket</span> </figcaption>
                        <div class="fg-preview">
                            <div class="fg-border">
                            </div>
                        </div>
                    </figure>
                </a>
            </li>
            <li id="style_sm_pants" class="style-sm" role="presentation">
                <a class="pant-link" role="tab" onClick="showStyle('pants')">
                    <figure class="fnd-fg">
                        <figcaption><span class="lang">Pants</span> </figcaption>
                        <div class="fg-preview">
                            <div class="fg-border">
                            </div>
                        </div>
                    </figure>
                </a>
            </li>
            <li id="style_sm_vests" class="style-sm" role="presentation">
                <a class="vest-link" role="tab" onClick="showStyle('vests')">
                    <figure class="fnd-fg">
                        <figcaption><span class="lang">Vest</span> </figcaption>
                        <div class="fg-preview">
                            <div class="fg-border">
                            </div>
                        </div>
                    </figure>
                </a>
            </li>
        </ul>
    </div>
</div>
<canvas id="frontcanvas" width="313" height="421" style="display:none"></canvas>
<canvas id="backcanvas" width="313" height="421" style="display:none"></canvas>
<canvas id="sidecanvas" width="313" height="421" style="display:none"></canvas>

<canvas id="frontcanvas2" width="313" height="421" style="display:none"></canvas>
<canvas id="backcanvas2" width="313" height="421" style="display:none"></canvas>

<canvas id="frontcanvas3" width="313" height="421" style="display:none"></canvas>
<canvas id="backcanvas3" width="313" height="421" style="display:none"></canvas>
<canvas id="sidecanvas3" width="313" height="421" style="display:none"></canvas>
<!-- ======================================================= -->
</body>
<!-- =================== script ============================ -->
<script type="text/javascript" src="{{asset('demo/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/float-panel.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/responsive_bootstrap_carousel.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/bootstrap-touch-slider.js')}}"></script>
<script type="text/javascript">var url = "{{asset('/storage/')}}";</script>
<script type="text/javascript" src="{{asset('demo/js/fabric.min.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/mobilethreepiece1.js?v0')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/mobilethreepiece2.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/mobilethreepiece3.js')}}"></script>

<script type="text/javascript">
$( '#et-banner' ).bsTouchSlider();
</script>
<script>
// 3pc script -----------------------------------------------
var selected_fabric = 6; // first fabric
function openNav(tabstr) {
    $("#tab-content").show();
    $("#container_jackets").show();
    $("#container_pants").hide();
    $("#container_vests").hide();

    $('.t-p-sub-menu').hide();
    if(tabstr == 'etfabric'){
    } else if(tabstr == 'etstyle'){
        var active_id = $('#style_sub_menu .nav-tabs').find('li.active').attr('id');
        if(active_id == 'style_sm_pants'){
            showStyle('pants');
        }else if(active_id == 'style_sm_vests'){
            showStyle('vests');
        }else{
            showStyle('jackets');
        }
        $('#style_sub_menu').show();

    } else if(tabstr == 'etcontrast'){
    } else {
        $("div[id^='menu-mesure-jacket-']").hide();
	    $("#menu-mesure-jacket-main").show();
    }

    // content active and sub tab active
    $(".tab-pane").removeClass("active");
    var type1 = 'jacket';
    var type2 = 'pant';
    var type3 = '';
    getTabJacketSect(tabstr+type1);
    getTabPantSect(tabstr+type2);
    getTabSect(tabstr+type3);

    $(".t-p-menu-1 .mm-li").removeClass('active');
    $(".t-p-menu-1 #main_menu_"+tabstr).addClass('active');

    if(tabstr == 'etfabric'){
        openPgContent('menu-fabric'+selected_fabric,'etfabricjacket',selected_fabric,'menu-fabric','fabric');
    }else if(tabstr == 'etmeasurement'){
        $("#menu-jacket-bodysize").removeClass("active");
    }
}

function openPgContent(str,tabstr,attrid,attrnm,tab_type) {
    // content active
    if(tab_type == 'fabric'){
        selected_fabric = attrid;
        getPgJacketOption(str,tabstr,attrid,attrnm);
    } else if(tab_type == 'style'){
        if(tabstr == 'etstylejacket'){
            getPgJacketOption(str,tabstr,attrid,attrnm);
            $("#container_jackets").show();
            $("#container_pants").hide();
            $("#container_vests").hide();
        } else if(tabstr == 'etstylepant'){
            getPgPantOption(str,tabstr,attrid,attrnm);
            $("#container_jackets").hide();
            $("#container_pants").show();
            $("#container_vests").hide();
        } else {
            getPgOption(str,tabstr,attrid,attrnm);
            $("#container_jackets").hide();
            $("#container_pants").hide();
            $("#container_vests").show();
        }
    } else if(tab_type == 'contrast') {
        if(tabstr == 'etcontrastjacket'){
            getPgJacketOption(str,tabstr,attrid,attrnm);
            $("#container_jackets").show();
            $("#container_pants").hide();
            $("#container_vests").hide();
        } else if(tabstr == 'etcontrastpant'){
            getPgPantOption(str,tabstr,attrid,attrnm);
            $("#container_jackets").hide();
            $("#container_pants").show();
            $("#container_vests").hide();
        } else {
            getPgOption(str,tabstr,attrid,attrnm);
            $("#container_jackets").hide();
            $("#container_pants").hide();
            $("#container_vests").show();
        }
        $('.contrast-content .pt-variation-main .pt-box-square').removeClass('active');
        $(".contrast-content div[id^='menu-"+attrid+"']").addClass('active');
    } else {
        showJacketMeasureSect(attrnm);
    }
}

function showJacketMeasureSect2(attrnm){
    showJacketMeasureSect(attrnm);
}

function showStyle(style_type) { //jacket, pant ,vest
    $('.style-sm').removeClass('active');
    $('#style_sm_'+style_type).addClass('active');

    $('.tab-container').hide();
    $('#container_'+style_type).show();
}
function hideTabContent(){
    $('#tab-content').hide();
    $('.t-p-sub-menu').hide();
}
</script>

<script type="text/javascript">
// page init ------------------------------
$(document).ready(function(e) {
    var stid="menu-"+$('#tabSActiveId').val();
    var stab=$('#tabSActiveId').val();
    // for jacket ------------
    var stid="menu-"+$('#tabJacketSActiveId').val();
    var stab=$('#tabJacketSActiveId').val();
    getPgJacketOption(stid,$('#tabJacketActiveId').val(),$('#tabJacketSActiveId').val(),'');
    frontdesignJacketProcess(<?php echo json_encode($eJacketTailorObj);?>);
    backdesignJacketProcess(<?php echo json_encode($eJacketTailorObj);?>);
    sidedesignJacketProcess(<?php echo json_encode($eJacketTailorObj);?>);
    changeJacketSizeDetails();
    showStyle('jackets');
    // for pant --------------
    stid="menu-"+$('#tabPantSActiveId').val();
    stab=$('#tabPantSActiveId').val();
    getPgPantOption(stid,$('#tabPantActiveId').val(),$('#tabPantSActiveId').val(),'');
    frontdesignPantProcess(<?php echo json_encode($ePantTailorObj);?>);
    backdesignPantProcess(<?php echo json_encode($ePantTailorObj);?>);
    changePantSizeDetails();
    // for vest --------------
    stid="menu-"+$('#tabSActiveId').val();
    stab=$('#tabSActiveId').val();
    // var newarr=$('#harr').val();
    getPgOption(stid,$('#tabActiveId').val(),$('#tabSActiveId').val(),'');
    frontdesignProcess(<?php echo json_encode($eTailorObj);?>);
    backdesignProcess(<?php echo json_encode($eTailorObj);?>);
    sidedesignProcess(<?php echo json_encode($eTailorObj);?>);
    changeSizeDetails();
});
function showStyleByImg(style_type) {
    $('.pt-image-div-2').removeClass('sb-open');
    $('#sb_'+style_type).addClass('sb-open');
    // $('.design-prev-div').css('display','none');
    // $('#prev_img_'+style_type).css('display','block');
    $('.design-prev-div').removeClass('prev-active');
    $('#prev_img_'+style_type).addClass('prev-active');
}
// side bar menu --------------------------
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


// cart menu button ----------------------------------------
$(document).ready(function(){
    $(".cart-checkout").click(function(){
        var cc=$("#crtcount").val();
        if(cc==0) {
            alert("No item in the cart, please add 1");
        } else{
            $(".cart-checkout").attr("href","{{url('/cart')}}");
        }
    });
});

// post cart ==============================================
$("#stand").click(function(e){
    var cntrysize = $('#container_jackets #cntrysize').val();
    var sizefit = $('#container_jackets #sizefit').val();
    var sizetyp = $('#container_jackets #sizetyp:checked').val();
    var sizechest = $('#container_jackets #sizechest').val();
    var sizewaist = $('#container_jackets #sizewaist').val();
    var sizehip = $('#container_jackets #sizehip').val();
    var sizeshoulder = $('#container_jackets #sizeshoulder').val();
    var sizesleeve = $('#container_jackets #sizesleeve').val();
    var sizelength = $('#container_jackets #sizelength').val();
    var setarr = $("#container_jackets input#setarr").val();
    var frntviewfinal = $('#container_jackets #frntviewfinal').val();
    var bkviewfinal = $('#container_jackets #bkviewfinal').val();
    var mpattern = $('#container_jackets #mpattern').val();
    var selstdqty = $('#container_jackets #selstdqty').val();
    var hsizefit = $('#container_jackets #hsizefit').val();

    var pant_setarr = $("#container_pants input#setarr").val();
    var pant_frntviewfinal = $("#container_pants input#frntviewfinal").val();
    var pant_bkviewfinal = $("#container_pants input#bkviewfinal").val();
    var pant_sizewaist = $('#temp_sizewaist').val();
    var pant_sizehip = $('#temp_sizehip').val();
    var pant_sizecrotch = $('#temp_sizecrotch').val();
    var pant_sizethigh = $('#temp_sizethigh').val();
    var pant_sizelength = $('#temp_sizelength').val();

    var vest_sizeChest = $('#vest_s_sizechest').val();
    var vest_sizeWaist = $('#vest_s_sizewaist').val();
    var vest_sizeHip = $('#vest_s_sizehip').val();
    var vest_sizeShoulder = $('#vest_s_sizeshoulder').val();
    var vest_sizeLength = $('#vest_s_sizelength').val();
    var vest_setarr = $('#container_vests input#setarr').val();
    var vest_frntviewfinal = $('#container_vests input#frntviewfinal').val();
    var vest_bkviewfinal = $('#container_vests input#bkviewfinal').val();

    var total_price = 0;
    var old_jacket_setarr = JSON.parse(setarr);
    var old_pant_setarr = JSON.parse(pant_setarr);
    var old_vest_setarr = JSON.parse(vest_setarr);
    // console.log("old jacket setarr:", old_jacket_setarr);
    // console.log("old pant setarr:", old_pant_setarr);
    var new_setarr_ary = old_jacket_setarr;
    // change basic data --------------------------------------------
    new_setarr_ary['oprodType1'] = new_setarr_ary['oprodType'];
    new_setarr_ary['oprodType'] = "3Piece Suit";

    if(cntrysize==2){
        new_setarr_ary['osizeStyle']= 'Uk/American Size';
    }else{
        new_setarr_ary['osizeStyle']= 'European Size';
    }
    new_setarr_ary['osizePattern']= mpattern;
    new_setarr_ary['osizeType']= sizetyp;
    new_setarr_ary['osizeFit']=hsizefit;
    new_setarr_ary['oqty']= selstdqty;

    // add jacket data ----------------------------------------------
    new_setarr_ary['osizeChest']= sizechest;
    new_setarr_ary['osizeWaist']= sizewaist;
    new_setarr_ary['osizeHip']= sizehip;
    new_setarr_ary['osizeShoulder']= sizeshoulder;
    new_setarr_ary['osizeSleeve']= sizesleeve;
    new_setarr_ary['osizeLength']= sizelength;
    // add pant data ------------------------------------------------
    new_setarr_ary['pant_obackpockt'] = old_pant_setarr['obackpockt'];
    new_setarr_ary['pant_obackpocktName'] = old_pant_setarr['obackpocktName'];
    new_setarr_ary['pant_obackpocktSide'] = old_pant_setarr['obackpocktSide'];
    new_setarr_ary['pant_obeltloop'] = old_pant_setarr['obeltloop'];
    new_setarr_ary['pant_obeltloopName'] = old_pant_setarr['obeltloopName'];
    new_setarr_ary['pant_obutton'] = old_pant_setarr['obutton'];
    new_setarr_ary['pant_obuttonCode'] = old_pant_setarr['obuttonCode'];
    new_setarr_ary['pant_obuttonHole'] = old_pant_setarr['obuttonHole'];
    new_setarr_ary['pant_obuttonHoleCode'] = old_pant_setarr['obuttonHoleCode'];
    new_setarr_ary['pant_obuttonHoleName'] = old_pant_setarr['obuttonHoleName'];
    new_setarr_ary['pant_obuttonName'] = old_pant_setarr['obuttonName'];
    new_setarr_ary['pant_ocatID'] = old_pant_setarr['ocatID'];
    new_setarr_ary['pant_ocontbackpockets'] = old_pant_setarr['ocontbackpockets'];
    new_setarr_ary['pant_ocontbeltloop'] = old_pant_setarr['ocontbeltloop'];
    new_setarr_ary['pant_ocontrast'] = old_pant_setarr['ocontrast'];
    new_setarr_ary['pant_ocontrastName'] = old_pant_setarr['ocontrastName'];
    new_setarr_ary['pant_ocuff'] = old_pant_setarr['ocuff'];
    new_setarr_ary['pant_ocuffName'] = old_pant_setarr['ocuffName'];
    new_setarr_ary['pant_ofabric'] = old_pant_setarr['ofabric'];
    new_setarr_ary['pant_ofabricDesc'] = old_pant_setarr['ofabricDesc'];
    new_setarr_ary['pant_ofabricGroup'] = old_pant_setarr['ofabricGroup'];
    new_setarr_ary['pant_ofabricImage'] = old_pant_setarr['ofabricImage'];
    new_setarr_ary['pant_ofabricList'] = old_pant_setarr['ofabricList'];
    new_setarr_ary['pant_ofabricName'] = old_pant_setarr['ofabricName'];
    new_setarr_ary['pant_ofabricPrice'] = old_pant_setarr['ofabricPrice'];
    new_setarr_ary['pant_ofabricType'] = old_pant_setarr['ofabricType'];
    new_setarr_ary['pant_opacket'] = old_pant_setarr['opacket'];
    new_setarr_ary['pant_opacketName'] = old_pant_setarr['opacketName'];
    new_setarr_ary['pant_opleat'] = old_pant_setarr['opleat'];
    new_setarr_ary['pant_opleatName'] = old_pant_setarr['opleatName'];
    new_setarr_ary['pant_oprodType'] = old_pant_setarr['oprodType'];
    new_setarr_ary['pant_oqty'] = old_pant_setarr['oqty'];
    // new_setarr_ary['pant_osizeFit'] = old_pant_setarr['osizeFit'];
    // new_setarr_ary['pant_osizePattern'] = old_pant_setarr['osizePattern'];
    new_setarr_ary['pant_ostyle'] = old_pant_setarr['ostyle'];
    new_setarr_ary['pant_ostyleName'] = old_pant_setarr['ostyleName'];
    new_setarr_ary['pant_owaistbandedge'] = old_pant_setarr['owaistbandedge'];

    new_setarr_ary['pant_osizeWaist']= pant_sizewaist;
    new_setarr_ary['pant_osizeHip']= pant_sizehip;
    new_setarr_ary['pant_osizeCrotch']= pant_sizecrotch;
    new_setarr_ary['pant_osizeThigh']= pant_sizethigh;
    new_setarr_ary['pant_osizeLength']= pant_sizelength;

    // add vest data ------------------------------------------------
    new_setarr_ary['vest_oback'] = old_vest_setarr['oback'];
    new_setarr_ary['vest_obackName'] = old_vest_setarr['obackName'];
    new_setarr_ary['vest_obackView'] = old_vest_setarr['obackView'];
    new_setarr_ary['vest_obottom'] = old_vest_setarr['obottom'];
    new_setarr_ary['vest_obottomName'] = old_vest_setarr['obottomName'];
    new_setarr_ary['vest_obutton'] = old_vest_setarr['obutton'];
    new_setarr_ary['vest_obuttonCode'] = old_vest_setarr['obuttonCode'];
    new_setarr_ary['vest_obuttonHole'] = old_vest_setarr['obuttonHole'];
    new_setarr_ary['vest_obuttonHoleCode'] = old_vest_setarr['obuttonHoleCode'];
    new_setarr_ary['vest_obuttonHoleName'] = old_vest_setarr['obuttonHoleName'];
    new_setarr_ary['vest_obuttonName'] = old_vest_setarr['obuttonName'];
    new_setarr_ary['vest_obuttonstyle'] = old_vest_setarr['obuttonstyle'];
    new_setarr_ary['vest_obuttonstyleName'] = old_vest_setarr['obuttonstyleName'];
    new_setarr_ary['vest_ocatID'] = old_vest_setarr['ocatID'];
    new_setarr_ary['vest_ocontlapel'] = old_vest_setarr['ocontlapel'];
    new_setarr_ary['vest_ocontpockets'] = old_vest_setarr['ocontpockets'];
    new_setarr_ary['vest_ocontrast'] = old_vest_setarr['ocontrast'];
    new_setarr_ary['vest_ocontrastName'] = old_vest_setarr['ocontrastName'];
    new_setarr_ary['vest_ofabric'] = old_vest_setarr['ofabric'];
    new_setarr_ary['vest_ofabricDesc'] = old_vest_setarr['ofabricDesc'];
    new_setarr_ary['vest_ofabricGroup'] = old_vest_setarr['ofabricGroup'];
    new_setarr_ary['vest_ofabricImage'] = old_vest_setarr['ofabricImage'];
    new_setarr_ary['vest_ofabricList'] = old_vest_setarr['ofabricList'];
    new_setarr_ary['vest_ofabricName'] = old_vest_setarr['ofabricName'];
    new_setarr_ary['vest_ofabricPrice'] = old_vest_setarr['ofabricPrice'];
    new_setarr_ary['vest_ofabricType'] = old_vest_setarr['ofabricType'];
    new_setarr_ary['vest_ofrontView'] = old_vest_setarr['ofrontView'];
    new_setarr_ary['vest_olining'] = old_vest_setarr['olining'];
    new_setarr_ary['vest_oliningName'] = old_vest_setarr['oliningName'];
    new_setarr_ary['vest_opacket'] = old_vest_setarr['opacket'];
    new_setarr_ary['vest_opacketName'] = old_vest_setarr['opacketName'];
    new_setarr_ary['vest_opiping'] = old_vest_setarr['opiping'];
    new_setarr_ary['vest_opipingName'] = old_vest_setarr['opipingName'];
    new_setarr_ary['vest_oprodType'] = old_vest_setarr['oprodType'];
    new_setarr_ary['vest_ostyle'] = old_vest_setarr['ostyle'];
    new_setarr_ary['vest_ostyleName'] = old_vest_setarr['ostyleName'];

    new_setarr_ary['vest_osizeChest'] = vest_sizeChest;
    new_setarr_ary['vest_osizeWaist'] = vest_sizeWaist;
    new_setarr_ary['vest_osizeHip'] = vest_sizeHip;
    new_setarr_ary['vest_osizeShoulder'] =vest_sizeShoulder;
    new_setarr_ary['vest_osizeLength'] = vest_sizeLength;

    // console.log("new_setarr_ary : ",new_setarr_ary);

    total_price = (1*new_setarr_ary['ofabricPrice']) + (1*new_setarr_ary['pant_ofabricPrice']) + (1*new_setarr_ary['vest_ofabricPrice']);
    var new_setarr = JSON.stringify(new_setarr_ary);

    // console.log(" ============== total price:",total_price);
    // e.preventDefault();
    $.ajax({
        type:'POST',
        url:'/designthreepiece/postcart2',
        data:{
            setarr:new_setarr,
            frntviewfinal:frntviewfinal,
            bkviewfinal:bkviewfinal,
            pant_frntviewfinal:pant_frntviewfinal,
            pant_bkviewfinal:pant_bkviewfinal,
            vest_frntviewfinal:vest_frntviewfinal,
            vest_bkviewfinal:vest_bkviewfinal,
            catId:18,// db categories table id : 18 (three piece suit)
            totalPrice:total_price,
        },
        beforeSend: function() {
            $("#et-smallr").show();
            $("#stand").hide();
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data){
            $("#et-smallr").hide();
            $("#stand").show();
            // console.log(data);
            window.location.href = "/cart";
        }
    });

    e.preventDefault();
    return;
});

$("#temp_body_btn").click(function(e){
    var bsizetyp = $('#container_jackets #bsizetyp:checked').val();
    $('#container_pants input:radio[name=bsizetyp]').filter('[value='+bsizetyp+']').prop('checked', true);
    $('#container_vests input:radio[name=bsizetyp]').filter('[value='+bsizetyp+']').prop('checked', true);

    var fitstyle = $('#container_jackets #fitstyle:checked').val();
    $('#container_pants input:radio[name=fitstyle]').filter('[value='+fitstyle+']').prop('checked', true);
    $('#container_vests input:radio[name=fitstyle]').filter('[value='+fitstyle+']').prop('checked', true);

    var bsizeChest = $('#container_jackets #bsizeChest').val();
    var bsizeWaist = $('#container_jackets #bsizeWaist').val();
    var bsizeHip = $('#container_jackets #bsizeHip').val();
    var bsizeShoulder = $('#container_jackets #bsizeShoulder').val();
    var bsizeSleeve = $('#container_jackets #bsizeSleeve').val();
    var bsizeLength = $('#container_jackets #bsizeLength').val();
    var setarr = $('#container_jackets .bsetarr').val();
    var frntviewfinal = $('#container_jackets .bfrntviewfinal').val();
    var bkviewfinal = $('#container_jackets .bbkviewfinal').val();
    var mpattern = $('#container_jackets #bmpattern').val();
    var selstdqty = $('#container_jackets #bselbodyqty').val();
    var rndvalue = $('#container_jackets #brndvalue').val();

    var pant_setarr = $("#container_pants input#setarr").val();
    var pant_frntviewfinal = $("#container_pants input#frntviewfinal").val();
    var pant_bkviewfinal = $("#container_pants input#bkviewfinal").val();
    var pant_bsizewaist = $('#temp_pant_bsizeWaist').val();
    var pant_bsizehip = $('#temp_pant_bsizeHip').val();
    var pant_bsizecrotch = $('#temp_pant_bsizeCrotch').val();
    var pant_bsizethigh = $('#temp_pant_bsizeThigh').val();
    var pant_bsizelength = $('#temp_pant_bsizeLength').val();
    $('#container_pants #bsizeWaist').val(pant_bsizewaist);
    $('#container_pants #bsizeHip').val(pant_bsizehip);
    $('#container_pants #bsizeCrotch').val(pant_bsizecrotch);
    $('#container_pants #bsizeThigh').val(pant_bsizethigh);
    $('#container_pants #bsizeLength').val(pant_bsizelength);

    var vest_bsizeChest = $('#temp_vest_bsizeChest').val();
    var vest_bsizeWaist = $('#temp_vest_bsizeWaist').val();
    var vest_bsizeHip = $('#temp_vest_bsizeHip').val();
    var vest_bsizeShoulder = $('#temp_vest_bsizeShoulder').val();
    var vest_bsizeLength = $('#temp_vest_bsizeLength').val();
    var vest_setarr = $('#container_vests input#setarr').val();
    var vest_frntviewfinal = $('#container_vests input#frntviewfinal').val();
    var vest_bkviewfinal = $('#container_vests input#bkviewfinal').val();

    var total_price = 0;

    var validation_state = validatejacketbodyform();
    // console.log("validattion state: " , validation_state);

    // e.preventDefault();
    // return;

    var old_jacket_setarr = JSON.parse(setarr);
    var old_pant_setarr = JSON.parse(pant_setarr);
    var old_vest_setarr = JSON.parse(vest_setarr);
    // console.log("old jacket setarr:", old_jacket_setarr);
    // console.log("old pant setarr:", old_pant_setarr);
    // console.log("old vest setarr:", old_vest_setarr);

    var new_setarr_ary = old_jacket_setarr;
    // change basic data --------------------------------------------
    new_setarr_ary['oprodType1'] = new_setarr_ary['oprodType'];
    new_setarr_ary['oprodType'] = "3Piece Suit";
    new_setarr_ary['osizePattern']= mpattern;
    new_setarr_ary['osizeStyle']= fitstyle;
    new_setarr_ary['osizeType']= bsizetyp;
    new_setarr_ary['oqty']= 1;
    new_setarr_ary['osizeFit']='';

    // add jacket data ---------------------------------------------
    new_setarr_ary['osizeChest']= bsizeChest;
    new_setarr_ary['osizeWaist']= bsizeWaist;
    new_setarr_ary['osizeHip']= bsizeHip;
    new_setarr_ary['osizeShoulder']= bsizeShoulder;
    new_setarr_ary['osizeSleeve']= bsizeSleeve;
    new_setarr_ary['osizeLength']= bsizeLength;

    // add pant data ------------------------------------------------
    new_setarr_ary['pant_obackpockt'] = old_pant_setarr['obackpockt'];
    new_setarr_ary['pant_obackpocktName'] = old_pant_setarr['obackpocktName'];
    new_setarr_ary['pant_obackpocktSide'] = old_pant_setarr['obackpocktSide'];
    new_setarr_ary['pant_obeltloop'] = old_pant_setarr['obeltloop'];
    new_setarr_ary['pant_obeltloopName'] = old_pant_setarr['obeltloopName'];
    new_setarr_ary['pant_obutton'] = old_pant_setarr['obutton'];
    new_setarr_ary['pant_obuttonCode'] = old_pant_setarr['obuttonCode'];
    new_setarr_ary['pant_obuttonHole'] = old_pant_setarr['obuttonHole'];
    new_setarr_ary['pant_obuttonHoleCode'] = old_pant_setarr['obuttonHoleCode'];
    new_setarr_ary['pant_obuttonHoleName'] = old_pant_setarr['obuttonHoleName'];
    new_setarr_ary['pant_obuttonName'] = old_pant_setarr['obuttonName'];
    new_setarr_ary['pant_ocatID'] = old_pant_setarr['ocatID'];
    new_setarr_ary['pant_ocontbackpockets'] = old_pant_setarr['ocontbackpockets'];
    new_setarr_ary['pant_ocontbeltloop'] = old_pant_setarr['ocontbeltloop'];
    new_setarr_ary['pant_ocontrast'] = old_pant_setarr['ocontrast'];
    new_setarr_ary['pant_ocontrastName'] = old_pant_setarr['ocontrastName'];
    new_setarr_ary['pant_ocuff'] = old_pant_setarr['ocuff'];
    new_setarr_ary['pant_ocuffName'] = old_pant_setarr['ocuffName'];
    new_setarr_ary['pant_ofabric'] = old_pant_setarr['ofabric'];
    new_setarr_ary['pant_ofabricDesc'] = old_pant_setarr['ofabricDesc'];
    new_setarr_ary['pant_ofabricGroup'] = old_pant_setarr['ofabricGroup'];
    new_setarr_ary['pant_ofabricImage'] = old_pant_setarr['ofabricImage'];
    new_setarr_ary['pant_ofabricList'] = old_pant_setarr['ofabricList'];
    new_setarr_ary['pant_ofabricName'] = old_pant_setarr['ofabricName'];
    new_setarr_ary['pant_ofabricPrice'] = old_pant_setarr['ofabricPrice'];
    new_setarr_ary['pant_ofabricType'] = old_pant_setarr['ofabricType'];
    new_setarr_ary['pant_opacket'] = old_pant_setarr['opacket'];
    new_setarr_ary['pant_opacketName'] = old_pant_setarr['opacketName'];
    new_setarr_ary['pant_opleat'] = old_pant_setarr['opleat'];
    new_setarr_ary['pant_opleatName'] = old_pant_setarr['opleatName'];
    new_setarr_ary['pant_oprodType'] = old_pant_setarr['oprodType'];
    new_setarr_ary['pant_oqty'] = old_pant_setarr['oqty'];
    // new_setarr_ary['pant_osizeFit'] = old_pant_setarr['osizeFit'];
    // new_setarr_ary['pant_osizePattern'] = old_pant_setarr['osizePattern'];
    new_setarr_ary['pant_ostyle'] = old_pant_setarr['ostyle'];
    new_setarr_ary['pant_ostyleName'] = old_pant_setarr['ostyleName'];
    new_setarr_ary['pant_owaistbandedge'] = old_pant_setarr['owaistbandedge'];

    new_setarr_ary['pant_osizeWaist']= pant_bsizewaist;
    new_setarr_ary['pant_osizeHip']= pant_bsizehip;
    new_setarr_ary['pant_osizeCrotch']= pant_bsizecrotch;
    new_setarr_ary['pant_osizeThigh']= pant_bsizethigh;
    new_setarr_ary['pant_osizeLength']= pant_bsizelength;

    // add vest data ------------------------------------------------
    new_setarr_ary['vest_oback'] = old_vest_setarr['oback'];
    new_setarr_ary['vest_obackName'] = old_vest_setarr['obackName'];
    new_setarr_ary['vest_obackView'] = old_vest_setarr['obackView'];
    new_setarr_ary['vest_obottom'] = old_vest_setarr['obottom'];
    new_setarr_ary['vest_obottomName'] = old_vest_setarr['obottomName'];
    new_setarr_ary['vest_obutton'] = old_vest_setarr['obutton'];
    new_setarr_ary['vest_obuttonCode'] = old_vest_setarr['obuttonCode'];
    new_setarr_ary['vest_obuttonHole'] = old_vest_setarr['obuttonHole'];
    new_setarr_ary['vest_obuttonHoleCode'] = old_vest_setarr['obuttonHoleCode'];
    new_setarr_ary['vest_obuttonHoleName'] = old_vest_setarr['obuttonHoleName'];
    new_setarr_ary['vest_obuttonName'] = old_vest_setarr['obuttonName'];
    new_setarr_ary['vest_obuttonstyle'] = old_vest_setarr['obuttonstyle'];
    new_setarr_ary['vest_obuttonstyleName'] = old_vest_setarr['obuttonstyleName'];
    new_setarr_ary['vest_ocatID'] = old_vest_setarr['ocatID'];
    new_setarr_ary['vest_ocontlapel'] = old_vest_setarr['ocontlapel'];
    new_setarr_ary['vest_ocontpockets'] = old_vest_setarr['ocontpockets'];
    new_setarr_ary['vest_ocontrast'] = old_vest_setarr['ocontrast'];
    new_setarr_ary['vest_ocontrastName'] = old_vest_setarr['ocontrastName'];
    new_setarr_ary['vest_ofabric'] = old_vest_setarr['ofabric'];
    new_setarr_ary['vest_ofabricDesc'] = old_vest_setarr['ofabricDesc'];
    new_setarr_ary['vest_ofabricGroup'] = old_vest_setarr['ofabricGroup'];
    new_setarr_ary['vest_ofabricImage'] = old_vest_setarr['ofabricImage'];
    new_setarr_ary['vest_ofabricList'] = old_vest_setarr['ofabricList'];
    new_setarr_ary['vest_ofabricName'] = old_vest_setarr['ofabricName'];
    new_setarr_ary['vest_ofabricPrice'] = old_vest_setarr['ofabricPrice'];
    new_setarr_ary['vest_ofabricType'] = old_vest_setarr['ofabricType'];
    new_setarr_ary['vest_ofrontView'] = old_vest_setarr['ofrontView'];
    new_setarr_ary['vest_olining'] = old_vest_setarr['olining'];
    new_setarr_ary['vest_oliningName'] = old_vest_setarr['oliningName'];
    new_setarr_ary['vest_opacket'] = old_vest_setarr['opacket'];
    new_setarr_ary['vest_opacketName'] = old_vest_setarr['opacketName'];
    new_setarr_ary['vest_opiping'] = old_vest_setarr['opiping'];
    new_setarr_ary['vest_opipingName'] = old_vest_setarr['opipingName'];
    new_setarr_ary['vest_oprodType'] = old_vest_setarr['oprodType'];
    new_setarr_ary['vest_ostyle'] = old_vest_setarr['ostyle'];
    new_setarr_ary['vest_ostyleName'] = old_vest_setarr['ostyleName'];

    new_setarr_ary['vest_osizeChest'] = vest_bsizeChest;
    new_setarr_ary['vest_osizeWaist'] = vest_bsizeWaist;
    new_setarr_ary['vest_osizeHip'] = vest_bsizeHip;
    new_setarr_ary['vest_osizeShoulder'] =vest_bsizeShoulder;
    new_setarr_ary['vest_osizeLength'] = vest_bsizeLength;

    // --------------------------------------------------------------

    // console.log("new_setarr_ary : ",new_setarr_ary);

    total_price = (1*new_setarr_ary['ofabricPrice']) + (1*new_setarr_ary['pant_ofabricPrice']) + (1*new_setarr_ary['vest_ofabricPrice']);
    var new_setarr = JSON.stringify(new_setarr_ary);

    // console.log("============== vest_frntviewfinal :",vest_frntviewfinal);
    // console.log("============== vest_bkviewfinal :",vest_bkviewfinal);
    // e.preventDefault();
    // return;

    if(validation_state){
        $.ajax({
            type:'POST',
            url:'/designthreepiece/postcart2',
            data:{
                setarr:new_setarr,
                // mpattern:mpattern,
                // fitstyle:fitstyle,
                // bsizetyp:bsizetyp,
                // bsizeChest:bsizeChest,
                // bsizeWaist:bsizeWaist,
                // bsizeHip:bsizeHip,
                // bsizeShoulder:bsizeShoulder,
                // bsizeSleeve:bsizeSleeve,
                // bsizeLength:bsizeLength,
                frntviewfinal:frntviewfinal,
                bkviewfinal:bkviewfinal,
                pant_frntviewfinal:pant_frntviewfinal,
                pant_bkviewfinal:pant_bkviewfinal,
                vest_frntviewfinal:vest_frntviewfinal,
                vest_bkviewfinal:vest_bkviewfinal,
                catId:18,// db categories table id : 18 (three piece suit)
                totalPrice:total_price,
            },
            beforeSend: function() {
				$("#et-body").show();
				$("#temp_body_btn").hide();
			},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                window.location.href = "/cart";
            }
        });
    }

    e.preventDefault();
    return;
});
</script>


</html>
