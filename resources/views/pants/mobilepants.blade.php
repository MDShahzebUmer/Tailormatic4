<?php  
$seo = App\Http\Helpers::page_seo_details(15);
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
 <title>eTailor clothes|| {{$seo['meta_title']}}</title>
<meta name="keywords" content="eTailor clothes|| {{$seo['meta_keyword']}}">
<meta name="description" content="eTailor clothes|| {{$seo['meta_desc']}}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:url" content="{{url('/')}}" />
<meta property="og:type" content="website" />
<meta property="og:title"  content="{{$seo['meta_title']}}" />
<meta property="og:description"  content="{{$seo['meta_desc']}}" />
<meta property="og:image" content="http://etailorclothes.com/asset/img/fblogo.png" />
<meta property="og:image:secure_url" content="http://etailorclothes.com/asset/img/fblogo.png" />

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Favicon
============================================ -->
<link rel="shortcut icon" type="image/x-icon" href="{{asset('asset/img/favicon.ico')}}">
<!-- CSS
============================================ -->
<link rel="stylesheet" type="text/css" href="{{asset('asset/css/style.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{asset('asset/css/et-responsive.css')}}" media="screen">

<link rel="stylesheet" type="text/css" href="{{asset('demo/css/stylepants.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{asset('demo/css/bootstrap.min.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{asset('demo/css/font-awesome.min.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('demo/css/bootstrap-touch-slider.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('demo/css/responsive_bootstrap_carousel_mega_min.css')}}" media="screen">

<link rel="stylesheet" type="text/css" href="{{asset('demo/css/stylemobilepant.css?v0')}}" media="all">

<script type="text/javascript" src="{{asset('demo/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/jquery-1.11.3.min.js')}}"></script>
<!-- Loader -->
<script type="text/javascript" src="{{asset('demo/js/jquery.DEPreLoad.js')}}"></script>
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
<input type="hidden" name="tabSActiveId" id="tabSActiveId" value="<?php echo $activeSubTab = isset($mysubtab) ? $mysubtab : 'fabric15'; ?>">
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

<!-- =================== pant content ===================== -->
<div id="tailor_content" class="tailor-content">
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
                <span class="t-s-price" style="display:none;">${{$eTailorObj['ofabricPrice']}}</span>
            </figure>
        </div>
    </div>
    <!-- ================================== preview image ================================ -->
    <div class="design-prev-div">
        <!-- Main Preview -->
        <div class="pt-men-left" id="main-front">
            <div class="pt-image-div">@include('pants.process')
                <img src="{{asset('demo/img/product/blank.png')}}" alt=""/>
            </div>
            <div class="pt-price-shirt">
                <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBack('etfabric');">BACK VIEW</a>
            </div>
        </div>
        <div class="pt-men-left" id="main-back" style="display:none;">
            <div class="pt-image-div">@include('pants.process')
                <img src="{{asset('demo/img/product/blank.png')}}" alt=""/>
            </div>
            <div class="pt-price-shirt">
                <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFront('etfabric');">FRONT VIEW</a>
            </div>
        </div>
        <!-- End Main Preview -->
    </div>
    <!-- =================================== tab content ================================== -->
    <div id="tab-content" class="c-tab-content tab-content" style="display:none;">
        <div class="row m-auto">
            <div class="col-md-12">
                <a onclick="hideTabContent();" class="tab-close-btn"></a>
            </div>
        </div>
        <!-- ======= Fabric Start Here ========= -->
        <div role="tabpanel" class="tab-pane" id="etfabric">
            <div class="pt-variation-main">
                <div class="pt-variation">
                    @foreach($group_record as $gr)
                    <div id="menu-fabric{{$gr->id}}" class="pt-box-square <?php if($gr->id == $eTailorObj['ofabricType']) {?>active<?php } ?>" onClick="javascript:getPgOption(this.id,'etfabric','{{$gr->id}}','menu-fabric');">
                        <p class="sub-fabric-name">{{$gr->fbgrp_name}}</p>
                       <?php
                        if($gr->fabric_offer_price != 0 && $gr->fabric_offer_price != '')
                        {
                            $frate = $gr->fabric_offer_price;
                        }else{
                            $frate =    $gr->fabric_rate;
                        }
                        ?>
                        <p class="sub-fabric-price">${{number_format($frate,2)}}</P>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="pt-customize">
                <div class="pt-men">
                    <!-- Right Option Section -->
                    <div class="pt-choose-right">
                        <div class="pt-thumb-slider">
                            <div class="pt-pagination">
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                <span id="menuopttitle-etfabric">Choose Your Fabric : </span>
                            </div>
                            <!-- Fabric of the Week -->
                            @foreach($group_record as $gr)
                            <div class="et-carousel" id="menu-opt-fabric{{$gr->id}}"  <?php if($gr->id == $eTailorObj['ofabricType']) {?>style="display:block;"<?php } else {?>style="display:none;"<?php } ?> >
                                <div id="et-carousel-item-fabric{{$gr->id}}" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active">
                                            <ul class="et-item-list">
                                                <?php $fabriclst = App\Etfabric::select('*')->where('fbgrp_id','=',$gr->id)->where('fabric_status','=','1')->whereRaw('fabric_qty > fabric_min_qty')->get();?>
                                                @foreach($fabriclst as $fablst)
                                                <li class="et-item" id="optionlist-fabric{{$gr->id}}-{{$fablst->id}}" 
                                                    title="{{ $fablst->fabric_name }}" 
                                                    data-title="{{ $fablst->fabric_name }}" 
                                                    onClick="javascript:getfab({{$fablst->id}},'etfabric');"
                                                    style="background:url('/storage/{{$fablst->fabric_img_l}}');">
                                                    <figure class="et-item-img">
                                                        <!-- <img src="{{asset('/storage/'.$fablst->fabric_img_s)}}" alt="{{ $fablst->fabric_name }}"> -->
                                                    </figure>
                                                    @if($fablst->id==$eTailorObj['ofabric'])<div class="icon-check"></div>@endif
                                                    <div class="m-et-fab-box">
                                                        <p class="m-i-f-desc">{{$fablst['fabric_desc']}}</p>
                                                        <span class="m-i-f-name">{{$fablst['fabric_name']}}</span>
                                                        <?php
                                                        if($gr->fabric_offer_price != 0 && $gr->fabric_offer_price != '') {
                                                            $rec_frate = $gr->fabric_offer_price;
                                                        }else{
                                                            $rec_frate =    $gr->fabric_rate;
                                                        }
                                                        ?>
                                                        <p class="m-i-f-price">${{number_format($rec_frate,2)}}</p> 
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ======= Fabric End Here ========= -->
        <!-- ======= Style Start Here ========= -->
        <div role="tabpanel" class="tab-pane" id="etstyle">
            <div class="pt-variation-main">
                <div class="pt-variation">
                    <?php $smi=1;?>
                    @foreach($mainattr_record as $mattr)
                    <div id="menu-{{$mattr->id}}" class="pt-box-square <?php if($mattr->id=='48'){?>active<?php } ?>" onClick="javascript:getPgOption(this.id,'etstyle','{{$mattr->id}}','{{$mattr->attribute_name}}');" >
                        <p>2.{{$smi}}  {{$mattr->attribute_name}}</p>
                    </div>
                    <?php $smi++;?>
                    @endforeach
                </div>
            </div>
            <div class="pt-customize">
                <div class="pt-men">
                    <!-- Right Option Section -->
                    <div class="pt-choose-right">
                        <div class="pt-thumb-slider">
                            <div class="pt-pagination">
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                <span id="menuopttitle-etstyle">Choose Your Pant Style : </span>
                            </div>
                            <div id="fullstyle">
                            <!-- Menu Sleeves -->
                            @foreach($mainattr_record as $mattr)
                            <div class="et-carousel" id="menu-opt-{{$mattr->id}}">
                                <div id="et-style-item-{{$mattr->id}}" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active">
                                            <ul class="et-item-list">
                                                @if($mattr->id=="50")
                                                <?php $stylci=1; $stylelst = App\AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get(); ?>
                                                @foreach($stylelst as $styllst)
                                                <?php if($stylci==7){?></ul></div><div class="item"><ul class="et-item-list"><?php  $stylci=1;}?>
                                                @if(($styllst->id==112 || $styllst->id==113) && $eTailorObj['opleat']==102)
                                                <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getstyles({{$styllst->id}},'{{$mattr->id}}','etstyle');">
                                                    <?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                        @foreach($styleimglst as $ls)
                                                        <figure class="et-item-img"><img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($mattr->id==50)
                                                            @if($styllst->id == $eTailorObj['opacket'])
                                                            <div class="icon-check"></div>
                                                            @endif
                                                        @endif
                                                        @endforeach
                                                </li>
                                                @elseif($styllst->id==108 || $styllst->id==109 || $styllst->id==110 || $styllst->id==111)
                                                <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getstyles({{$styllst->id}},'{{$mattr->id}}','etstyle');">
                                                    <?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                        @foreach($styleimglst as $ls)
                                                        <figure class="et-item-img"><img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$alt_name}}" ></figure>
                                                         @if($mattr->id==50)
                                                            @if($styllst->id == $eTailorObj['opacket'])
                                                            <div class="icon-check"></div>
                                                            @endif
                                                        @endif
                                                        @endforeach
                                                </li>
                                                @endif
                                                <?php $stylci++;?>
                                                @endforeach
                                                @else
                                                <?php $stylci=1; $stylelst = App\AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get(); ?>
                                                @foreach($stylelst as $styllst)
                                                <?php if($stylci==7){?></ul></div><div class="item"><ul class="et-item-list"><?php  $stylci=1;}?>
                                                <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getstyles({{$styllst->id}},'{{$mattr->id}}','etstyle');">
                                                    <?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                        @foreach($styleimglst as $ls)
                                                        <figure class="et-item-img"><img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($mattr->id==48)
                                                            @if($styllst->id == $eTailorObj['ostyle'])
                                                            <div class="icon-check"></div>
                                                            @endif
                                                        @elseif($mattr->id==49)
                                                            @if($styllst->id == $eTailorObj['opleat'])
                                                            <div class="icon-check"></div>
                                                            @endif
                                                        @elseif($mattr->id==51)
                                                            @if($styllst->id == $eTailorObj['obackpockt'])
                                                            <div class="icon-check"></div>
                                                            @endif
                                                        @elseif($mattr->id==52)
                                                            @if($styllst->id == $eTailorObj['obeltloop'])
                                                            <div class="icon-check"></div>
                                                            @endif
                                                        @elseif($mattr->id==53)
                                                            @if($styllst->id == $eTailorObj['ocuff'])
                                                            <div class="icon-check"></div>
                                                            @endif
                                                        @endif
                                                        @endforeach
                                                </li>
                                                <?php $stylci++;?>
                                                @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- ======= Navigation Buttons ========= -->
                                    <!-- ======= Left Button ========= -->
                                    <a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-{{$mattr->id}}" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('demo/img/ar-left.png')}}" alt=""></span><span class="sr-only">Previous</span></a>
                                    <!-- ======= Right Button ========= -->
                                    <a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-{{$mattr->id}}" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('demo/img/ar-right.png')}}" alt=""></span><span class="sr-only">Next</span></a>
                                </div>
                            </div>
                            @endforeach
                            <!--  Mini Preview Section -->
                            <div class="et-progress-des et-style-bg">
                                <div class="et-content-fab " id="miniview-etstyle-48">
                                    <figure class="et-selected-img et-selected-full"><img src="{{asset('demo/img/product/blank.png')}}" alt=""></figure>
                                    <div class="et-style-select">
                                        <h2>{{$eTailorObj['ostyleName']}}</h2><p>Classic,All Time,Business</p>
                                    </div>
                                </div>
                                <div class="et-content-fab jacket-lapel-bg" id="miniview-etstyle-49" style="display:none;background-image: url({{asset('demo/img/product/blank.png')}});">
                                    <div class="et-style-select">
                                        <h2>{{$eTailorObj['opleatName']}}</h2><p>Classic,All Time,Business</p>
                                    </div>
                                </div>
                                <div class="et-content-fab jacket-lapel-bg" id="miniview-etstyle-50" style="display:none;background-image: url({{asset('demo/img/product/blank.png')}});">
                                    <div class="et-style-select">
                                        <h2>{{$eTailorObj['opacketName']}}</h2><p>Classic,All Time,Business</p>
                                    </div>
                                </div>
                                <div class="et-content-fab jacket-pocket-bg" id="miniview-etstyle-51" style="display:none;background-image: url({{asset('demo/img/product/blank.png')}});">
                                    <div class="et-style-select">
                                        <h2>Back Pockets</h2><p>{{$eTailorObj['obackpocktName']}}</p>
                                        <div class="radio">
                                            <label><input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" <?php if($eTailorObj['obackpocktSide']=="left"){?>checked<?php } ?> onClick="javascript:getseloptions('left','PocketSide','51','etstyle');"><span class="cr"><i class="cr-icon"></i></span> Left </label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" <?php if($eTailorObj['obackpocktSide']=="right"){?>checked<?php } ?> onClick="javascript:getseloptions('right','PocketSide','51','etstyle');"> <span class="cr"><i class="cr-icon"></i></span> Right </label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" <?php if($eTailorObj['obackpocktSide']=="both"){?>checked<?php } ?> onClick="javascript:getseloptions('both','PocketSide','51','etstyle');"> <span class="cr"><i class="cr-icon"></i></span> Both</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="et-content-fab jacket-lapel-bg" id="miniview-etstyle-52" style="display:none; background-image: url({{asset('demo/img/product/blank.png')}});"">
                                    <div class="et-style-select">
                                        <h2>Belt Loop and Waistband</h2>
                                        <p>{{$eTailorObj['obeltloopName']}}</p>
                                        <span>Waistband Edge</span>
                                        <div class="radio">
                                            <label><input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" <?php if($eTailorObj['owaistbandedge']=="normal"){?>checked<?php } ?> onClick="javascript:getseloptions('normal','WaistEdge','52','etstyle');"> <span class="cr"><i class="cr-icon"></i></span>Normal</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" <?php if($eTailorObj['owaistbandedge']=="round"){?>checked<?php } ?> onClick="javascript:getseloptions('round','WaistEdge','52','etstyle');"><span class="cr"><i class="cr-icon"></i></span>Round</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" <?php if($eTailorObj['owaistbandedge']=="square"){?>checked<?php } ?> onClick="javascript:getseloptions('square','WaistEdge','52','etstyle');"><span class="cr"><i class="cr-icon"></i></span>Square</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="et-content-fab pant-style" id="miniview-etstyle-53" style="display:none;">
                                    <figure class="et-selected-img et-selected-full">
                                        @if($eTailorObj['ocuff']=="125")
                                        <img src="{{asset('storage/Pants/Style/Cuffs/Regular/Show/'.$eTailorObj['ofabric'].'.png')}}" alt="">
                                        @elseif($eTailorObj['ocuff']=="126")
                                        <img src="{{asset('storage/Pants/Style/Cuffs/Cuff/Show/'.$eTailorObj['ofabric'].'.png')}}" alt="">
                                        @elseif($eTailorObj['ocuff']=="127")
                                        <img src="{{asset('storage/Pants/Style/Cuffs/SingleTabs/Show/'.$eTailorObj['ofabric'].'.png')}}" alt="">
                                        <img src="{{asset('storage/Pants/Style/Cuffs/SingleTabs/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}" alt="">
                                        @elseif($eTailorObj['ocuff']=="128")
                                        <img src="{{asset('storage/Pants/Style/Cuffs/DoubleTabs/Show/'.$eTailorObj['ofabric'].'.png')}}" alt="">
                                        <img src="{{asset('storage/Pants/Style/Cuffs/DoubleTabs/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}" alt="">
                                        @elseif($eTailorObj['ocuff']=="129")
                                        <img src="{{asset('storage/Pants/Style/Cuffs/FoldoverTabs/Show/'.$eTailorObj['ofabric'].'.png')}}" alt="">
                                        <img src="{{asset('storage/Pants/Style/Cuffs/FoldoverTabs/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}" alt="">
                                        @endif
                                    </figure>
                                    <div class="et-style-select">
                                        <h2>{{$eTailorObj['ocuffName']}}</h2>
                                        @if($eTailorObj['ocuff']!="125")
                                        <p>If you choose Double Cuff style the Pant Length measurement that you measure has to be very accurate as double cuff styles the Length of Pants can not be adjusted,for new customers we suggest regular cuffs as it is very easy to adjust with your tailor locally.</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="et-next-back">
                                    <ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul>
                                </div>
                            </div>
                            <!-- End Mini Preview Section -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ======= Style End Here ========= -->
        <!-- ======= Contrast Start Here ========= -->
        <div role="tabpanel" class="tab-pane" id="etcontrast">
            <div class="pt-variation-main">
                <div class="pt-variation">
                    <?php $cmi=1;?>
                    @foreach($contrast_record as $contlst)
                    <div id="menu-{{$contlst->id}}" class="pt-box-square <?php if($contlst->id=='54'){?>active<?php } ?>" onClick="javascript:getPgOption(this.id,'etcontrast','{{$contlst->id}}','{{$contlst->attribute_name}}');" >
                    <p>3.{{$cmi}}  {{$contlst->attribute_name}}</p>
                    </div>
                    <?php $cmi++;?>
                    @endforeach
                </div>
            </div>
            <div class="pt-customize">
                <div class="pt-men">
                    <!-- Right Option Section -->
                    <div class="pt-choose-right">
                        <div class="pt-thumb-slider">
                            <div class="pt-pagination no-pad-left">
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                <span id="menuopttitle-etcontrast">Choose Your Contrast Fabric : </span>
                            </div>
                            <!-- Menu Contrast -->
                            @foreach($contrast_record as $contlst)
                            @if($contlst->id == '54')
                            <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                <div class="et-contrast-list">
                                    <ul class="et-item-list">
                                        <?php $contfablst = App\Contrast::select('*')->where('cat_id','=',4)->get(); ?>
                                        @foreach($contfablst as $cfablst)
                                        <li class="et-item" id="optionlist-{{$contlst->id}}-{{$cfablst->id}}" data-title="{{$cfablst->contrsfab_name}}" title="{{$cfablst->contrsfab_name}}" onClick="javascript:getcontrast({{$cfablst->id}},'etcontrast');">
                                            <figure class="et-item-img"><img src="{{asset('/storage/'.$cfablst->contrsfab_img)}}" alt="{{$alt_name}}" ></figure>
                                            @if($cfablst->id==$eTailorObj['ocontrast'])
                                            <div class="icon-check"></div>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @elseif($contlst->id == '55')
                            <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                <div class="et-contrast-list">
                                    <ul class="et-item-list">
                                        <?php $buttonlst = App\Button::select('*')->where('cat_id','=',4)->get(); ?>
                                        @foreach($buttonlst as $bttnlst)
                                        <li class="et-item" id="optionlist-{{$contlst->id}}-{{$bttnlst->id}}" data-title="{{$bttnlst->button_name}}" title="{{$bttnlst->button_name}}" onClick="javascript:getbuttons({{$bttnlst->id}},'etcontrast')">
                                            <figure class="et-item-img"><img src="{{asset('/storage/'.$bttnlst->button_img)}}" alt="{{$alt_name}}" ></figure>
                                            @if($bttnlst->id==$eTailorObj['obutton'])
                                            <div class="icon-check"></div>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- Threads -->
                                <div class="pt-pagination no-pad-left"><span>B. Choose Your Button Hole Thread</span></div>
                                <div class="et-contrast-list">
                                    <ul class="et-item-list">
                                        <?php $contthrdlst = App\Thread::select('*')->where('cat_id','=',4)->get(); ?>
                                        @foreach($contthrdlst as $cthreadlst)
                                        <li class="et-item" id="optionlist-thrd-{{$cthreadlst->id}}" data-title="{{$cthreadlst->thrd_name}}" title="{{$cthreadlst->thrd_name}}" onClick="javascript:getthread({{$cthreadlst->id}},'etcontrast');">
                                            <figure class="et-item-img"><img src="{{asset('/storage/'.$cthreadlst->thrd_img)}}" alt="{{$alt_name}}" ></figure>
                                            @if($cthreadlst->id==$eTailorObj['obuttonHole'])
                                            <div class="icon-check"></div>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            <!--  Mini Preview Section -->
                            <div class="et-progress-des et-style-bg">
                                <div class="et-content-fab jacket-pocket-bg" id="miniview-etcontrast-54" >
                                    <div class="et-style-select">
                                        <h2>Contrast Fabric</h2>
                                        <div class="et-check-box">
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="beltlooptxt" id="beltlooptxt" value="true" <?php if($eTailorObj['ocontbeltloop']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['ocontbeltloop']}},'BeltLoop','54','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Belt Loops</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="backpocketstxt" id="backpocketstxt" value="true" <?php if($eTailorObj['ocontbackpockets']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['ocontbackpockets']}},'BackPockets','54','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Pockets</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="et-content-fab jacket-lapel-bg" id="miniview-etcontrast-55" style="display:none;">
                                    <div class="et-style-select">
                                        <h2>Jacket Button</h2><p>{{$eTailorObj['obuttonName']}}</p>
                                    </div>
                                </div>
                                <div class="et-next-back">
                                    <ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul>
                                </div>
                            </div>
                            <!--  End Mini Preview Section -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ======= Contrast End Here ========= -->
        <!-- ======= Measurement Start Here ========= -->
        <div role="tabpanel" class="tab-pane" id="etmeasurement">
            <div class="pt-variation-main">
                <div class="pt-variation">
                    <div id="menu-bodysize" class="pt-box-square" onClick="javascript:showMeasureSect('bodysize');"><p>Body Size</p></div>
                    <div id="menu-standardsize" class="pt-box-square" onClick="javascript:showMeasureSect('standardsize');"><p>Standard Sizes</p></div>
                </div>
            </div>
            <div class="pt-customize">
                <div class="pt-men">
                    <div id="menu-mesure-main" style="display:block;">
                        <!-- Right Option Section -->
                        <div class="pt-choose-right et-measure-right">
                            <div class="pt-thumb-slider">
                                <div class="et-des-title">
                                    <h2>Great Choice!  Please Select Your Measurement Option</h2>
                                </div>
                                <div class="et-ment-option">
                                    <div class="et-body-size light-bg" onClick="javascript:showMeasureSect('bodysize');">
                                        <h2 class="un-bg">BODY SIZE</h2>
                                        <p>Part of the tailor-made experience is getting yourself measured up. With the assistance of our easy-to-follow video measuring guide, get yourself measured up in no time!</p>
                                        <span><a href="javascript:void(0);" onClick="javascript:showMeasureSect('bodysize');"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a></span>
                                        <figure class="et-img"><img src="{{asset('demo/img/Measurement.png')}}" alt=""></figure>
                                    </div>
                                    <div class="et-standard-size light-bg" onClick="javascript:showMeasureSect('standardsize');">
                                        <h2 class="un-bg">Standard SIZES</h2>
                                        <p>Standard sizes provide an equally amazing fit. Select from an array of sizes from our standard size chart. Enjoy your Tailor-made product with the perfect combination of the right size and your creative style choices!</p>
                                        <span><a href="javascript:void(0);" onClick="javascript:showMeasureSect('standardsize');"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a></span>
                                        <figure class="et-img"><img src="{{asset('demo/img/SML.png')}}" alt=""></figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Right Option Section -->
                    </div>
                    </div>
                    <!-- STANDARD SIZES -->
                    <div class="pt-choose-right et-main-body-size" id="menu-mesure-standardsize" style="display:none;">
                        <div class="pt-thumb-slider">
                            <div class="et-des-title"><h2>STANDARD SIZES</h2></div>
                            <div class="et-main-measurement">
                                <form class="et-shirt-measure" role="form" method="POST" action="{{ url('/designpants/postcart2') }}">
                                    {{ csrf_field() }}
                                <div class="et-block et-vests-size">
                                    <label>Pants Size :</label>
                                    <div class="et-btn-select">
                                        <select class="selectpicker btn-primary" id="cntrysize" name="cntrysize" onChange="javascript:changeCntrySize(this.value);"><option value="1" selected>European Size</option><option value="2">UK/American Size</option></select>
                                    </div>
                                    <div class="et-btn-select" id="divsizefit">
                                        <select class="selectpicker btn-primary" id="sizefit" name="sizefit" onChange="javascript:changeSizeDetails();">
                                            <?php $measureeurolst = App\BodyMeasurment::select('*')->where('cat_id','=',4)->where('country_id','=',1)->orderBy('standardsize_id', 'asc')->get();?>
                                            @foreach($measureeurolst as $eurosizelst)
                                            <?php $stdeurosizelst = App\StandardSize::select('*')->where('id','=',$eurosizelst->standardsize_id)->get();?>
                                            @foreach($stdeurosizelst as $stdeurolst)
                                            <option value="{{$eurosizelst->id}}">{{$stdeurolst->value}}</option>
                                            @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <p style="display:none" class="et-orange">"The Measurements shown is garment size not body size,<br>this is the measurement from the suit itself (it includes ease/addition already)"</p>
                                <p class="et-yellow" style="display:none">You are able to adjust Sleeve Length , Length and Waist for a Perfect fit!<br>These sizes can be changed below</p>
                                <div class="et-block">
                                    <div class="et-measure-image">
                                        <figure><img src="{{asset('/storage/Measurment/Shirts/plength/length.jpg')}}" alt=""></figure>
                                    </div>
                                    <div class="et-measure-video"><video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="{{asset('/storage/Measurment/Shirts/plength/length.ogv')}}" type="video/ogg"><source src="{{asset('/storage/Measurment/Shirts/plength/length.mp4')}}" type="video/mp4"><object data="{{asset('/storage/Measurment/Shirts/plength/length.swf')}}" type="application/x-shockwave-flash" width="300" height="220"></object><source src="{{asset('/storage/Measurment/Shirts/plength/length.webm')}}" type="video/webm"></video></div>
                                </div>
                                <div class="et-block et-common-lr">
                                    <label class="pull-left">Pant</label>
                                    <div class="et-radio-check pull-right">
                                        <div class="radio">
                                            <label><input type="radio" name="sizetyp" id="sizetyp" value="cm" <?php if($eTailorObj['osizeType']=="cm"){?>checked<?php } ?> onClick="javascript:changeSizeDetails();"><span class="cr"><i class="cr-icon"></i></span> Cm </label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="sizetyp" id="sizetyp" value="inch" <?php if($eTailorObj['osizeType']=="inch"){?>checked<?php } ?> onClick="javascript:changeSizeDetails();"><span class="cr"><i class="cr-icon"></i></span> Inch </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="et-common-size et-block">
                                    <div class="et-type-Input">
                                        <div class="et-input">
                                            <span>WAIST</span>
                                            {{-- <p class="et-blue" id="vwaist"></p> --}}
                                            <input type="text" name="sizeWaist" id="sizewaist" value="">
                                            <p class="et-tsize">Inch</p>
                                        </div>
                                        <div class="et-input">
                                            <span>HIP</span>
                                            <p class="et-blue" id="vhip"></p>
                                            <p class="et-tsize">Inch</p>
                                            <input type="hidden" name="sizeHip" id="sizehip" value="">
                                        </div>
                                        <div class="et-input">
                                            <span>CROTCH</span>
                                            <p class="et-blue" id="vcrotch"></p>
                                            <p class="et-tsize">Inch</p>
                                            <input type="hidden" name="sizeCrotch" id="sizecrotch" value="">
                                        </div>
                                        <div class="et-input">
                                            <span>THIGH</span>
                                            <p class="et-blue" id="vthigh"></p>
                                            <p class="et-tsize">Inch</p>
                                            <input type="hidden" name="sizeThigh" id="sizethigh" value="">
                                        </div>
                                        <div class="et-input">
                                            <span>LENGTH</span>
                                            <input type="text" name="sizeLength" id="sizelength" value="">
                                            <p class="et-tsize">Inch</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="et-block et-form-btn">
                                    <a href="#" onClick="javascript:showMeasureSect('main');" class="et-blk-brn blue">Back To Design</a>
                                    <input type="hidden" name="setarr" id="setarr" value="">
                                    <input type="hidden" name="frntviewfinal" id="frntviewfinal">
                                    <input type="hidden" name="bkviewfinal" id="bkviewfinal">
                                    <input type="hidden" name="mpattern" value="Standard">
                                    <input type="hidden" name="selstdqty" value="1">
                                    <input type="hidden" name="hsizefit" id="hsizefit">
                                    <button type="sumbit" class="et-cart-brn">Add To Cart</button>
                                    <div class="et-btn-group">
                                        <h4 style="color:#f00; font-weight:bold;" class="vwprice">1 Pant: ${{$eTailorObj['ofabricPrice']}} </h4>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- STANDARD SIZES END -->
                    <!-- BODY SIZES -->
                    <div class="pt-choose-right et-main-body-size" id="menu-mesure-bodysize" style="display:none;">
                        <div class="pt-thumb-slider">
                            <div class="et-des-title"><h2>YOUR BODY SIZES</h2></div>
                            <div class="et-main-measurement">
                                <form class="et-shirt-measure" role="form" method="POST" action="{{ url('/designpants/postcart2') }}" onSubmit="javascript:return validatebodyform();">
                                 {{ csrf_field() }}
                                    <div class="et-block">
                                        <div class="et-measure-image"><figure><img src="{{asset('/storage/Measurment/Shirts/plength/length.jpg')}}" alt=""></figure></div>
                                        <div class="et-measure-video"><video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="{{asset('/storage/Measurment/Shirts/plength/length.ogv')}}" type="video/ogg"><source src="{{asset('/storage/Measurment/Shirts/plength/length.mp4')}}" type="video/mp4"><object data="{{asset('/storage/Measurment/Shirts/plength/length.swf')}}" type="application/x-shockwave-flash" width="300" height="220"></object><source src="{{asset('/storage/Measurment/Shirts/plength/length.webm')}}" type="video/webm"></video></div>
                                    </div>
                                    <div class="et-block no-pad">
                                        <div class="et-subhead">
                                            <span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
                                            <span>Pant <span id="fldtitle">Waist</span> generally range from <b><span id="rngfrom">28</span></b> to <b><span id="rngto">75</span></b> <span id="mtyp">inch</span></span>
                                        </div>
                                        <div class="et-type-Input">
                                            <div class="et-input">
                                                <span>WAIST</span>
                                                <?php $measurewaistlst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',20)->get();?>
                                                @foreach($measurewaistlst as $mwaistlst)
                                                <input type="text" data-title="{{$mwaistlst->from_range}}-{{$mwaistlst->to_range}}" name="bsizeWaist" id="bsizeWaist" onFocus="javascript:showRanges('{{$mwaistlst->bodysize_type}}',{{$mwaistlst->from_range}},{{$mwaistlst->to_range}},'waist');" onBlur="javascript:validateField(this.id,{{$mwaistlst->from_range}},{{$mwaistlst->to_range}});" value="<?php echo $eTailorObj['osizeWaist'];?>" >
                                                @endforeach
                                            </div>
                                            <div class="et-input">
                                                <span>HIP</span>
                                                <?php $measurehiplst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',21)->get();?>
                                                @foreach($measurehiplst as $mhiplst)
                                                <input type="text" data-title="{{$mhiplst->from_range}}-{{$mhiplst->to_range}}" name="bsizeHip" id="bsizeHip" onFocus="javascript:showRanges('{{$mhiplst->bodysize_type}}',{{$mhiplst->from_range}},{{$mhiplst->to_range}},'hip');" onBlur="javascript:validateField(this.id,{{$mhiplst->from_range}},{{$mhiplst->to_range}});" value="<?php echo $eTailorObj['osizeHip'];?>" >
                                                @endforeach
                                            </div>
                                            <div class="et-input">
                                                <span>CROTCH</span>
                                                <?php $measurecrotchlst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',22)->get();?>
                                                @foreach($measurecrotchlst as $mcrotchlst)
                                                <input type="text" data-title="{{$mcrotchlst->from_range}}-{{$mcrotchlst->to_range}}" name="bsizeCrotch" id="bsizeCrotch" onFocus="javascript:showRanges('{{$mcrotchlst->bodysize_type}}',{{$mcrotchlst->from_range}},{{$mcrotchlst->to_range}},'croch');" onBlur="javascript:validateField(this.id,{{$mcrotchlst->from_range}},{{$mcrotchlst->to_range}});" value="<?php echo $eTailorObj['osizeCrotch'];?>" >
                                                @endforeach
                                            </div>
                                            <div class="et-input">
                                                <span>THIGH</span>
                                                <?php $measurethighlst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',23)->get();?>
                                                @foreach($measurethighlst as $mthighlst)
                                                <input type="text" data-title="{{$mthighlst->from_range}}-{{$mthighlst->to_range}}" name="bsizeThigh" id="bsizeThigh" onFocus="javascript:showRanges('{{$mthighlst->bodysize_type}}',{{$mthighlst->from_range}},{{$mthighlst->to_range}},'thigh');" onBlur="javascript:validateField(this.id,{{$mthighlst->from_range}},{{$mthighlst->to_range}});" value="<?php echo $eTailorObj['osizeThigh'];?>" >
                                                @endforeach
                                            </div>
                                            <div class="et-input">
                                                <span>LENGTH</span>
                                                <?php $measurelengthlst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',24)->get();?>
                                                @foreach($measurelengthlst as $mlengthlst)
                                                <input type="text" data-title="{{$mlengthlst->from_range}}-{{$mlengthlst->to_range}}" name="bsizeLength" id="bsizeLength" onFocus="javascript:showRanges('{{$mlengthlst->bodysize_type}}',{{$mlengthlst->from_range}},{{$mlengthlst->to_range}},'length');" onBlur="javascript:validateField(this.id,{{$mlengthlst->from_range}},{{$mlengthlst->to_range}});" value="<?php echo $eTailorObj['osizeLength'];?>" >
                                                @endforeach
                                            </div>
                                            <div class="et-radio-check">
                                                <div class="radio"><label><input type="radio" name="bsizetyp" id="bsizetyp" value="cm" <?php if($eTailorObj['osizeType']=="cm"){?>checked<?php } ?>><span class="cr"><i class="cr-icon"></i></span>Cm</label></div>
                                                <div class="radio"><label><input type="radio" name="bsizetyp" id="bsizetyp" value="inch" <?php if($eTailorObj['osizeType']=="inch"){?>checked<?php } ?> ><span class="cr"><i class="cr-icon"></i></span>Inch</label></div>
                                            </div>
                                        </div>
                                        <div class="et-block">
                                            <div class="et-setect-fit">
                                                <ul>
                                                    <li><span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span><span>Select Your Size :</span></li>
                                                    <li><div class="radio"><label><input type="radio" name="fitstyle" value="Comfortable" <?php if($eTailorObj['osizeStyle']=="Comfortable"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Signature Standard Fit</label></div></li>
                                                    <li><div class="radio"><label><input type="radio" name="fitstyle" value="Slim" <?php if($eTailorObj['osizeStyle']=="Slim"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Euro Slim Fit</label></div></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="et-block et-form-btn">
                                            <a href="#" onClick="javascript:showMeasureSect('main');" class="et-blk-brn blue">Back To Design</a>
                                            <input type="hidden" name="setarr" id="setarr" value="">
                                            <input type="hidden" name="frntviewfinal" id="frntviewfinal">
                                            <input type="hidden" name="bkviewfinal" id="bkviewfinal">
                                            <input type="hidden" name="mpattern" value="Body">
                                            <input type="hidden" name="selbodyqty" value="1">
                                            <button type="sumbit" class="et-cart-brn">Add To Cart</button>
                                            <div class="et-btn-group">
                                                <h4 style="color:#f00; font-weight:bold;" class="vwprice">1 Pant: ${{$eTailorObj['ofabricPrice']}} </h4>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- BODY SIZES END -->
                </div>
            </div>
        </div>
        <!-- ======= Measurement End Here ========= -->
    </div>
    <!-- =================================== tab menu ===================================== -->
    <div class="t-p-menu-1">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="<?php echo (isset($mytab)&& $mytab == 'etfabric') ? 'active' : '' ?>" >
                <a href="#etfabric" class="fabric-link" aria-controls="fabric" role="tab" data-toggle="tab" onClick="javascript:getTabSect('etfabric');">
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
            <li role="presentation" class="<?php echo (isset($mytab)&& $mytab == 'etstyle') ? 'active' : '' ?>" >
                <a href="#etstyle" class="style-link" aria-controls="style" role="tab" data-toggle="tab" onClick="javascript:getTabSect('etstyle');">
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
            <li role="presentation" class="<?php echo (isset($mytab)&& $mytab == 'etcontrast') ? 'active' : '' ?>" >
                <a href="#etcontrast" class="contrast-link" aria-controls="contrast" role="tab" data-toggle="tab" onClick="javascript:getTabSect('etcontrast');">
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
            <li role="presentation" class="<?php echo (isset($mytab)&& $mytab == 'etmeasurement') ? 'active' : '' ?>" >
                <a href="#etmeasurement" class="measurement-link" aria-controls="settings" role="tab" data-toggle="tab" onClick="javascript:getTabSect('etmeasurement');">
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
</div>

<canvas id="frontcanvas" width="313" height="421" style="display:none"></canvas>
<canvas id="backcanvas" width="313" height="421" style="display:none"></canvas>
</body>
<!-- Bootstrap Main JS File -->
<script type="text/javascript" src="{{asset('demo/js/bootstrap.min.js')}}"></script>
<!-- Bootstrap bootstrap-touch-slider Slider Main JS File -->
<script type="text/javascript" src="{{asset('demo/js/float-panel.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/responsive_bootstrap_carousel.js')}}"></script>
<!--<script type="text/javascript" src="{{asset('demo/js/jquery.touchSwipe.min.js')}}"></script>-->
<script type="text/javascript" src="{{asset('demo/js/bootstrap-touch-slider.js')}}"></script>
<script type="text/javascript">var url = "{{asset('/storage/')}}";</script>
<script type="text/javascript" src="{{asset('demo/js/fabric.min.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/mobilepantsprocessnew.js?v1')}}"></script>
<!-- Bootstrap Side Menu JS File -->
<script language="javascript" type="text/javascript">
$(document).ready(function(e){
    var stid="menu-"+$('#tabSActiveId').val(); 
    var stab=$('#tabSActiveId').val(); 
    // getTabSect($('#tabActiveId').val());
    getPgOption(stid,$('#tabActiveId').val(),$('#tabSActiveId').val(),''); 
    frontdesignProcess(<?php echo json_encode($eTailorObj);?>); 
    backdesignProcess(<?php echo json_encode($eTailorObj);?>); 
    changeSizeDetails();
});

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

function hideTabContent(){
    $('#tab-content').hide();
}

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
</script>
</html>