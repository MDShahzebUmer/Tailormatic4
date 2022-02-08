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
    <link rel="stylesheet" type="text/css" href="{{asset('demo/css/stylemobilejacket.css?v1')}}" media="all">

    <script type="text/javascript" src="{{asset('demo/js/jquery.min.js')}}"></script>
    <script type="text/javascript">
    window.onbeforeunload = function() {
        return 'Your progress will be lost';
    }
</script>
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
<!-- =================== follow step ======================= -->
<div id="follow_step" class="follow-step" style="display:none;">
    <figure class="fs-figure">
        <figcaption>
            <h4 data-lang="easysteps4">4 Follow Steps</h4>
            <div class="fs-inn">
                <ul>
                    <li data-menu="fabric"><span data-lang="fabric">FABRIC</span></li>
                    <li data-menu="style"><span data-lang="style">STYLE</span></li>
                    <li data-menu="contrast"><span data-lang="color-contrast">COLOR CONTRAST</span></li>
                    <li data-menu="measurement"><span data-lang="your-size">MEASUREMENTS</span></li>
                </ul>
            </div>
            <button data-lang="design-now" onclick="showStep('1');">Design Now</button>
        </figcaption>
    </figure>
</div>
<!-- =================== jacket content ==================== -->
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
            <div class="pt-image-div">@include('jacket.process')
                <img src="{{asset('demo/img/product/blank.png')}}"/>
            </div>
            <div class="pt-price-shirt">
                <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBack('etfabric');">BACK VIEW</a>
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
                        <p class="sub-fabric-name">{{strtoupper($gr->fbgrp_name)}}</p>
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
                    <div id="menu-{{$mattr->id}}" class="pt-box-square <?php if($mattr->id=='19'){?>active<?php } ?>" onClick="javascript:getPgOption(this.id,'etstyle','{{$mattr->id}}','{{$mattr->attribute_name}}');" >
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
                                <span id="menuopttitle-etstyle">Choose Your Buttons : </span>
                            </div>
                            <div id="fullstyle">
                            <!-- Menu Sleeves -->
                            @foreach($mainattr_record as $mattr)
                            <div class="et-carousel" id="menu-opt-{{$mattr->id}}">
                                <div id="et-style-item-{{$mattr->id}}" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active">
                                            <ul class="et-item-list">
                                                @if($mattr->id==21)
                                                <?php $stylci=1; $stylelst = App\AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();?>
                                                @foreach($stylelst as $styllst)
                                                <?php if($stylci==6){?></ul></div><div class="item"><ul class="et-item-list"><?php  $stylci=1;}?>
                                                @if(($eTailorObj['ostyle']==54 || $eTailorObj['ostyle']==55 || $eTailorObj['ostyle']==56 || $eTailorObj['ostyle']==57 || $eTailorObj['ostyle']==58) && ($styllst->id==130))
                                                <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getstyles({{$styllst->id}},'{{$mattr->id}}','etstyle');">
                                                    <?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                        @foreach($styleimglst as $ls)
                                                        <figure class="et-item-img">
                                                        <img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$ls->style_name}}">
                                                        <?php $buttimglst = App\ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObj['obutton'])->get();?>
                                                        @foreach($buttimglst as $buttls)
                                                        <img src="{{asset('/storage/'.$buttls->button_list_img)}}" alt="{{$ls->style_name}}">
                                                        @endforeach
                                                        </figure>
                                                        @if($mattr->id==21)
                                                            @if($styllst->id == $eTailorObj['obottom'])<div class="icon-check"></div>@endif
                                                        @endif
                                                        @endforeach
                                                </li>
                                                @elseif(($eTailorObj['ostyle']==50 || $eTailorObj['ostyle']==51 || $eTailorObj['ostyle']==52 || $eTailorObj['ostyle']==53) && ($styllst->id==63 || $styllst->id==64 || $styllst->id==65))
                                                <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getstyles({{$styllst->id}},'{{$mattr->id}}','etstyle');">
                                                    <?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                        @foreach($styleimglst as $ls)
                                                        <figure class="et-item-img">
                                                        <img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$ls->style_name}}">
                                                        <?php $buttimglst = App\ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObj['obutton'])->get();?>
                                                        @foreach($buttimglst as $buttls)
                                                        <img src="{{asset('/storage/'.$buttls->button_list_img)}}" alt="{{$ls->style_name}}">
                                                        @endforeach
                                                        </figure>
                                                        @if($mattr->id==21)
                                                            @if($styllst->id == $eTailorObj['obottom'])<div class="icon-check"></div>@endif
                                                        @endif
                                                        @endforeach
                                                </li>
                                                @endif
                                                <?php $stylci++;?>
                                                @endforeach
                                                @else
                                                <?php $stylci=1; $stylelst = App\AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();?>
                                                @foreach($stylelst as $styllst)
                                                <?php if($stylci==6){?></ul></div><div class="item"><ul class="et-item-list"><?php  $stylci=1;}?>
                                                <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getstyles({{$styllst->id}},'{{$mattr->id}}','etstyle');">
                                                    <?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                        @foreach($styleimglst as $ls)
                                                        <figure class="et-item-img">
                                                        <img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$ls->style_name}}">
                                                        <?php $buttimglst = App\ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObj['obutton'])->get();?>
                                                        @foreach($buttimglst as $buttls)
                                                        <img src="{{asset('/storage/'.$buttls->button_list_img)}}" alt="{{$ls->style_name}}">
                                                        @endforeach
                                                        </figure>
                                                        @if($mattr->id==19)
                                                            @if($styllst->id == $eTailorObj['ostyle'])<div class="icon-check"></div>@endif
                                                        @elseif($mattr->id==20)
                                                            @if($styllst->id == $eTailorObj['olapel'])<div class="icon-check"></div>@endif
                                                        @elseif($mattr->id==22)
                                                            @if($styllst->id == $eTailorObj['opacket'])<div class="icon-check"></div>@endif
                                                        @elseif($mattr->id==23)
                                                            @if($styllst->id == $eTailorObj['osleeveButn'])<div class="icon-check"></div>@endif
                                                        @elseif($mattr->id==24)
                                                            @if($styllst->id == $eTailorObj['ovent'])<div class="icon-check"></div>@endif
                                                        @endif
                                                        @endforeach
                                                </li>
                                                <?php $stylci++;?>
                                                @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <!--======= Navigation Buttons =========-->
                                    <!--======= Left Button =========-->
                                    <a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-{{$mattr->id}}" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('demo/img/ar-left.png')}}"></span><span class="sr-only">Previous</span></a>
                                    <!--======= Right Button =========-->
                                    <a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-{{$mattr->id}}" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('demo/img/ar-right.png')}}"></span><span class="sr-only">Next</span></a>
                                </div>
                            </div>
                            @endforeach
                            <!--  Mini Preview Section -->
                            <div class="et-progress-des et-style-bg">
                                <div class="et-content-fab " id="miniview-etstyle-19">
                                    <figure class="et-selected-img et-selected-full"><img src="{{asset('demo/img/product/blank.png')}}" alt=""></figure>
                                    <div class="et-style-select">
                                        <h2>{{$eTailorObj['ostyleName']}}</h2><p>Classic,All Time,Business</p>
                                    </div>
                                </div>
                                <div class="et-content-fab jacket-lapel-bg" id="miniview-etstyle-20" style="display:none;background-image: url({{asset('demo/img/product/blank.png')}});">
                                    <div class="et-style-select">
                                        <h2>{{$eTailorObj['olapelName']}}</h2><p>Classic,All Time,Business</p>
                                        @if($eTailorObj['olapel']!="62")
                                        <span>Button Hole on Lapel</span>
                                        <div class="radio">
                                            <label><input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" <?php if($eTailorObj['olapelHole']=="false"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['olapelHole']}},'LapelHole','20','etstyle');"><span class="cr"><i class="cr-icon"></i></span>No Button Hole</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" <?php if($eTailorObj['olapelHole']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['olapelHole']}},'LapelHole','20','etstyle');"><span class="cr"><i class="cr-icon"></i></span>With Lapel Buttonhole</label>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="et-content-fab jacket-bottom-bg" id="miniview-etstyle-21" style="display:none;background-image: url({{asset('demo/img/product/blank.png')}});">
                                    <div class="et-style-select"><h2>{{$eTailorObj['obottomName']}}</h2></div>
                                </div>
                                <div class="et-content-fab jacket-pocket-bg" id="miniview-etstyle-22" style="display:none;background-image: url({{asset('demo/img/product/blank.png')}});">
                                    <div class="et-style-select">
                                        <h2>{{$eTailorObj['opacketName']}}</h2>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="breastpackt" id="breastpackt" value="true" <?php if($eTailorObj['obreastPacket']=="false"){?> checked<?php }?> onClick="javascript:getseloptions({{$eTailorObj['obreastPacket']}},'BreastPocket','22','etstyle');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>No Breast Pocket</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="et-content-fab" id="miniview-etstyle-23" style="display:none;">
                                    <figure class="et-sleevebuttonds">
                                        <img class="et-main-sleeve" src="{{asset('/storage/Jacket/Fabric/ImageIn/'.$eTailorObj['ofabric'].'.png')}}">
                                        @if($eTailorObj['osleeveButn']=="73")
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/3StandardButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/3StandardButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="74")
                                        <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/3WorkingButtons/Thread/ShowImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/3WorkingButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/3WorkingButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="75")
                                        <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/3KissingButtons/Thread/ShowImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/3KissingButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/3KissingButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="76")
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/4StandardButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/4StandardButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="77")
                                        <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/4WorkingButtons/Thread/ShowImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/4WorkingButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/4WorkingButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="78")
                                        <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/4KissingButtons/Thread/ShowImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/4KissingButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/4KissingButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="79")
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/5StandardButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/5StandardButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="80")
                                        <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/5WorkingButtons/Thread/ShowImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/5WorkingButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/5WorkingButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="81")
                                        <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/5KissingButtons/Thread/ShowImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/5KissingButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/5KissingButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @endif
                                    </figure>
                                    <div class="et-style-select">
                                        <h2>{{$eTailorObj['osleeveButnStyle']}}</h2><p>Classic,All Time,Business</p>
                                    </div>
                                </div>
                                <div class="et-content-fab jacket-vent-bg" id="miniview-etstyle-24" style="display:none; background-image: url({{asset('demo/img/product/blank.png')}});">
                                    <div class="et-style-select">
                                        <h2>{{$eTailorObj['oventName']}}</h2><p>Classic,All Time,Business</p>
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
                    <div id="menu-{{$contlst->id}}" class="pt-box-square <?php if($contlst->id=='25'){?>active<?php } ?>" onClick="javascript:getPgOption(this.id,'etcontrast','{{$contlst->id}}','{{$contlst->attribute_name}}');" >
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
                            <div id="fullcontrast">
                            <!-- Menu Contrast -->
                            @foreach($contrast_record as $contlst)
                            @if($contlst->id == '25')
                            <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                <div class="et-contrast-list">
                                    <ul class="et-item-list">
                                        <?php $contfablst = App\Contrast::select('*')->where('cat_id','=',2)->get(); ?>
                                        @foreach($contfablst as $cfablst)
                                        <li class="et-item" id="optionlist-{{$contlst->id}}-{{$cfablst->id}}" data-title="{{$cfablst->contrsfab_name}}" title="{{$cfablst->contrsfab_name}}" onClick="javascript:getcontrast({{$cfablst->id}},'etcontrast');">
                                            <figure class="et-item-img"><img src="{{asset('/storage/'.$cfablst->contrsfab_img)}}" alt="{{$cfablst->contrsfab_name}}"></figure>
                                            @if($cfablst->id==$eTailorObj['ocontrast'])<div class="icon-check"></div>@endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @elseif($contlst->id == '26')
                            <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                <div class="et-contrast-list">
                                    <ul class="et-item-list">
                                        <?php $liningfablst = App\JvLiningFabric::select('*')->where('cat_id','=',2)->get(); ?>
                                        @foreach($liningfablst as $lngfablst)
                                        <li class="et-item" id="optionlist-{{$contlst->id}}-{{$lngfablst->id}}" data-title="{{$lngfablst->fabric_name}}" title="{{$lngfablst->fabric_name}}" onClick="javascript:getlining({{$lngfablst->id}},'etcontrast')">
                                            <figure class="et-item-img"><img src="{{asset('/storage/'.$lngfablst->lining_img)}}" alt="{{$lngfablst->fabric_name}}"></figure>
                                            @if($lngfablst->id==$eTailorObj['olining'])<div class="icon-check"></div>@endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @elseif($contlst->id == '27')
                            <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                <div class="et-contrast-list">
                                    <ul class="et-item-list">
                                        <?php $bckcollrfablst = App\Colorcoller::select('*')->get(); ?>
                                        @foreach($bckcollrfablst as $bkcfablst)
                                        <li class="et-item" id="optionlist-{{$contlst->id}}-{{$bkcfablst->id}}" data-title="{{$bkcfablst->name}}" title="{{$bkcfablst->name}}" onClick="javascript:getbackcollar({{$bkcfablst->id}},'etcontrast')">
                                            <figure class="et-item-img"><img src="{{asset('/storage/'.$bkcfablst->color_img)}}" alt="{{$bkcfablst->name}}"></figure>
                                            @if($bkcfablst->id==$eTailorObj['obackCollar'])<div class="icon-check"></div>@endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @elseif($contlst->id == '28')
                            <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                <div class="et-contrast-list">
                                    <ul class="et-item-list">
                                        <?php $buttonlst = App\Button::select('*')->where('cat_id','=',2)->get(); ?>
                                        @foreach($buttonlst as $bttnlst)
                                        <li class="et-item" id="optionlist-{{$contlst->id}}-{{$bttnlst->id}}" data-title="{{$bttnlst->button_name}}" title="{{$bttnlst->button_name}}" onClick="javascript:getbuttons({{$bttnlst->id}},'etcontrast')">
                                            <figure class="et-item-img"><img src="{{asset('/storage/'.$bttnlst->button_img)}}" alt="{{$bttnlst->button_name}}"></figure>
                                            @if($bttnlst->id==$eTailorObj['obutton'])<div class="icon-check"></div>@endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- Threads -->
                                <div class="pt-pagination no-pad-left">
                                    <span>B. Choose Your Button Hole Thread</span>
                                </div>
                                <div class="et-contrast-list">
                                    <ul class="et-item-list">
                                        <?php $contthrdlst = App\Thread::select('*')->where('cat_id','=',2)->get(); ?>
                                        @foreach($contthrdlst as $cthreadlst)
                                        <li class="et-item" id="optionlist-thrd-{{$cthreadlst->id}}" data-title="{{$cthreadlst->thrd_name}}" title="{{$cthreadlst->thrd_name}}" onClick="javascript:getthread({{$cthreadlst->id}},'etcontrast');">
                                            <figure class="et-item-img"><img src="{{asset('/storage/'.$cthreadlst->thrd_img)}}" alt="{{$cthreadlst->thrd_name}}({{$cthreadlst->thread_code}})"></figure>
                                            @if($cthreadlst->id==$eTailorObj['obuttonHole'])<div class="icon-check"></div>@endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @elseif($contlst->id == '29')
                            <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                <div class="et-radio-block">
                                    <div class="radio">
                                        <label><input type="radio" name="chkmonotxt" id="chkmonotxt1" value="true" <?php if($eTailorObj['omonogram']=="false"){?>checked<?php }?> onClick="javascript:getmonogram('false','etcontrast');"><span class="cr"><i class="cr-icon"></i></span>No Monogram</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="chkmonotxt" id="chkmonotxt2" value="true" <?php if($eTailorObj['omonogram']=="true"){?>checked<?php }?> onClick="javascript:getmonogram('true','etcontrast');"><span class="cr"><i class="cr-icon"></i></span>Inside Jacket</label>
                                    </div>
                                </div>
                                @if($eTailorObj['omonogram']=="true")
                                <div class="pt-pagination no-pad-left"><span>B. Choose Your Monogram color</span></div>
                                <div class="et-contrast-list">
                                    <ul class="et-item-list pad-left-20">
                                        <?php $monothrdlst = App\Thread::select('*')->where('cat_id','=',2)->get(); ?>
                                        @foreach($monothrdlst as $monothrdlst)
                                        <li class="et-item" id="optionlist-{{$contlst->id}}-{{$monothrdlst->id}}" data-title="{{$monothrdlst->thrd_name}}({{$monothrdlst->thread_code}})" onClick="javascript:getmonotxtcolor({{$monothrdlst->id}},'etcontrast');">
                                            <figure class="et-item-img"><img src="{{asset('/storage/'.$monothrdlst->thrd_img)}}" alt="{{$monothrdlst->thrd_name}}({{$monothrdlst->thread_code}})"></figure>
                                            @if($monothrdlst->id==$eTailorObj['omonogramColor'])<div class="icon-check"></div>@endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="pt-pagination no-pad-left"><span>C. Enter Desired Monogram/Initials</span></div>
                                <div class="et-contrast-list">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="specialttxt" id="specialttxt" value="{{$eTailorObj['omonogramSpecial']}}" <?php if($eTailorObj['omonogramSpecial']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions('{{$eTailorObj['omonogramSpecial']}}','Special','29','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Specially Tailored For </label><input type="text" name="monotext" id="monotext" maxlength="20" value="{{$eTailorObj['omonogramText']}}" style="color:#8c7676;" onBlur="javascript:getmonotext(this.value,'etcontrast');">
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif
                            @endforeach
                            <!--  Mini Preview Section -->
                            <div class="et-progress-des et-style-bg">
                                <div class="et-content-fab" id="miniview-etcontrast-25" >
                                    <figure class="et-selected-img et-selected-full"><img src="{{asset('demo/img/product/blank.png')}}" alt=""></figure>
                                    <div class="et-style-select">
                                        <h2>Contrast Fabric</h2>
                                        <div class="et-check-box">
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" <?php if($eTailorObj['olapelupper']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['olapelupper']}},'LapelUpper','25','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Upper</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" <?php if($eTailorObj['olapellower']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['olapellower']}},'LapelLower','25','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Lower</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" <?php if($eTailorObj['ocontpockets']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['ocontpockets']}},'Pockets','25','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pockets</label>
                                            </div>
                                            @if($eTailorObj['obreastPacket']=="true")
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" <?php if($eTailorObj['ocontchestpocket']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['ocontchestpocket']}},'ChestPocket','25','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Chest Pocket</label>
                                            </div>
                                            @endif
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" <?php if($eTailorObj['ocontelbowmix']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['ocontelbowmix']}},'ElbowMix','25','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Elbow Mix</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="et-content-fab" id="miniview-etcontrast-26" >
                                    <div class="et-style-select et-jacket-piping">
                                        <h5>Piping</h5>
                                        <ul class="et-item-list">
                                            <?php $pipngfablst = App\Piping::select('*')->get(); ?>
                                            @foreach($pipngfablst as $pipfablst)
                                            <li class="et-item" id="optionlist-pip-{{$pipfablst->id}}" data-title="{{$pipfablst->name}}" title="{{$pipfablst->name}}" onClick="javascript:getpiping({{$pipfablst->id}},'etcontrast')">
                                                <figure class="et-item-img"><img src="{{asset('/storage/'.$pipfablst->piping_img)}}" alt="{{$pipfablst->name}}"></figure>
                                                @if($pipfablst->id==$eTailorObj['opiping'])<div class="icon-check"></div>@endif
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="et-content-fab jacket-backcollr-bg" id="miniview-etcontrast-27" style="display:none; background-image: url({{asset('demo/img/product/blank.png')}});" >
                                    <figure><img src="{{asset('/storage/Jacket/BackColler/'.$eTailorObj['obackCollar'].'.png')}}" style="position: absolute;top: -2px;left: 138px;width: 80%;"></figure>
                                    <div class="et-style-select"><h2>Back Collar</h2></div>
                                </div>
                                <div class="et-content-fab" id="miniview-etcontrast-28" style="display:none;">
                                    <figure class="et-sleevebuttonds">
                                        <img class="et-main-sleeve" src="{{asset('/storage/Jacket/Fabric/ImageIn/'.$eTailorObj['ofabric'].'.png')}}">
                                        @if($eTailorObj['osleeveButn']=="73")
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/3StandardButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/3StandardButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="74")
                                        <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/3WorkingButtons/Thread/ShowImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/3WorkingButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/3WorkingButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="75")
                                        <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/3KissingButtons/Thread/ShowImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/3KissingButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/3KissingButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="76")
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/4StandardButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/4StandardButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="77")
                                        <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/4WorkingButtons/Thread/ShowImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/4WorkingButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/4WorkingButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="78")
                                        <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/4KissingButtons/Thread/ShowImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/4KissingButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/4KissingButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="79")
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/5StandardButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/5StandardButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="80")
                                        <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/5WorkingButtons/Thread/ShowImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/5WorkingButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/5WorkingButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @elseif($eTailorObj['osleeveButn']=="81")
                                        <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/5KissingButtons/Thread/ShowImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/5KissingButtons/Button/ShowImg/'.$eTailorObj['obutton'].'.png')}}">
                                        <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/5KissingButtons/Thread/JCross/'.$eTailorObj['obuttonHole'].'.png')}}">
                                        @endif
                                    </figure>
                                    <div class="et-style-select">
                                        <h2>Jacket Button</h2><p>{{$eTailorObj['obuttonName']}}</p>
                                    </div>
                                </div>
                                <div class="et-content-fab jacket-monogram-bg" id="miniview-etcontrast-29" style="display:none; background-image:url({{asset('demo/img/product/blank.png')}});">
                                    <div class="et-style-select">
                                        <h2>Inside View of Jacket</h2>
                                        @if($eTailorObj['omonogram']=="true")
                                        <p>Monogram Color: {{$eTailorObj['omonogramHoleName']}}</p>
                                        @endif
                                    </div>
                                    @if($eTailorObj['omonogram']=="true")
                                    <div class="et-addtttext" style="color:{{$eTailorObj['omonogramtextColor']}}">
                                        @if($eTailorObj['omonogramSpecial']=="true")
                                        <p>Specially Tailored For</p>
                                        @endif
                                        <p>{{$eTailorObj['omonogramText']}}</p>
                                    </div>
                                    @endif
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
        </div>
        <!-- ======= Contrast End Here ========= -->
        <!-- ======= Measurement Start Here ========= -->
        <div role="tabpanel" class="tab-pane" id="etmeasurement">
            <div class="pt-variation-main">
                <div class="pt-variation">
                    <div id="menu-bodysize" class="pt-box-square" onClick="javascript:showMeasureSect('bodysize');">
                        <p>Body Size</p>
                    </div>
                    <div id="menu-standardsize" class="pt-box-square" onClick="javascript:showMeasureSect('standardsize');">
                        <p>Standard Sizes</p>
                    </div>
                </div>
            </div>
            <div class="pt-customize">
                <div class="pt-men">
                    <div id="menu-mesure-main" style="display:block;">
                        <!-- Right Option Section -->
                        <div class="pt-choose-right et-measure-right">
                            <div class="pt-thumb-slider">
                                <div class="et-des-title"><h2>Great Choice!  Please Select Your Measurement Option</h2></div>
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
                            <form class="et-shirt-measure" role="form" method="POST">
                                {{ csrf_field() }}
                            <div class="et-block et-vests-size">
                                <label>Jacket Size :</label>
                                <div class="et-btn-select">
                                    <select class="selectpicker btn-primary" id="cntrysize" name="cntrysize" onChange="javascript:changeCntrySize(this.value);"><option value="1" selected>European Size</option><option value="2">UK/American Size</option></select>
                                </div>
                                <div class="et-btn-select" id="divsizefit">
                                    <select class="selectpicker btn-primary" id="sizefit" name="sizefit" onChange="javascript:changeSizeDetails();">
                                        <?php $measureeurolst = App\BodyMeasurment::select('*')->where('cat_id','=',2)->where('country_id','=',1)->orderBy('standardsize_id', 'asc')->get();?>
                                        @foreach($measureeurolst as $eurosizelst)
                                        <?php $stdeurosizelst = App\StandardSize::select('*')->where('id','=',$eurosizelst->standardsize_id)->get();?>
                                        @foreach($stdeurosizelst as $stdeurolst)
                                        <option value="{{$eurosizelst->id}}">{{$stdeurolst->value}}</option>
                                        @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <p class="et-orange">"The Measurements shown is garment size not body size,<br>this is the measurement from the suit itself (it includes ease/addition already)"</p>
                            <p class="et-yellow">You are able to adjust Sleeve Length , Length and Waist for a Perfect fit!<br>These sizes can be changed below</p>
                            <div class="et-block">
                                <div class="et-measure-image">
                                    <figure><img src="{{asset('/storage/Measurment/Shirts/length/length.jpg')}}" alt=""></figure>
                                </div>
                                <div class="et-measure-video"><video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="{{asset('/storage/Measurment/Shirts/length/length.ogv')}}" type="video/ogg"><source src="{{asset('/storage/Measurment/Shirts/length/length.mp4')}}" type="video/mp4"><object data="{{asset('/storage/Measurment/Shirts/length/length.swf')}}" type="application/x-shockwave-flash" width="300" height="220"></object><source src="{{asset('/storage/Measurment/Shirts/length/length.webm')}}" type="video/webm"></video></div>
                            </div>
                            <div class="et-block et-common-lr">
                                <label class="pull-left">Jacket</label>
                                <div class="et-radio-check pull-right">
                                    <div class="radio">
                                        <label><input type="radio" name="sizetyp" id="sizetyp" value="cm" <?php if($eTailorObj['osizeType']=="cm"){?>checked<?php } ?> onClick="javascript:changeSizeDetails();"><span class="cr"><i class="cr-icon"></i></span>Cm</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="sizetyp" id="sizetyp" value="inch" <?php if($eTailorObj['osizeType']=="inch"){?>checked<?php } ?> onClick="javascript:changeSizeDetails();"><span class="cr"><i class="cr-icon"></i></span>Inch</label>
                                    </div>
                                </div>
                            </div>
                            <div class="et-common-size et-block">
                                <div class="et-type-Input">
                                    <div class="et-input">
                                        <span>CHEST</span><p class="et-blue" id="vchest"></p><p class="et-tsize">Inch</p><input type="hidden" name="sizeChest" id="sizechest" value="">
                                    </div>
                                    <div class="et-input">
                                        {{-- <span>WAIST</span><p class="et-blue" id="vwaist"></p><p class="et-tsize">Inch</p><input type="hidden" name="sizeWaist" id="sizewaist" value=""> --}}
                                        <span>WAIST</span><input type="text" name="sizeWaist" id="sizewaist" value=""><p class="et-tsize">Inch</p>
                                    </div>
                                    <div class="et-input">
                                        <span>HIP</span><p class="et-blue" id="vhip"></p><p class="et-tsize">Inch</p><input type="hidden" name="sizeHip" id="sizehip" value="">
                                    </div>
                                    <div class="et-input">
                                        <span>SHOULDER</span><p class="et-blue" id="vshoulder"></p><p class="et-tsize">Inch</p><input type="hidden" name="sizeShoulder" id="sizeshoulder" value="">
                                    </div>
                                    <div class="et-input">
                                        <span>SLEEVE</span><input type="text" name="sizeSleeve" id="sizesleeve" value=""><p class="et-tsize">Inch</p>
                                    </div>
                                    <div class="et-input">
                                        <span>LENGTH</span><input type="text" name="sizeLength" id="sizelength" value=""><p class="et-tsize">Inch</p>
                                    </div>
                                </div>
                            </div>
                            <div class="et-block et-form-btn">
                                <a href="#" onClick="javascript:showMeasureSect('main');" class="et-blk-brn blue">Back To Design</a>
                                <input type="hidden" name="setarr" id="setarr" value="">
                                <input type="hidden" name="frntviewfinal" id="frntviewfinal">
                                <input type="hidden" name="bkviewfinal" id="bkviewfinal">
                                <input type="hidden" name="mpattern" value="Standard" id="mpattern">
                                <input type="hidden" name="selstdqty" value="1" id="selstdqty">
                                <input type="hidden" name="hsizefit" id="hsizefit">
                                <input type="hidden" name="rndvalue" id="rndvalue" value="<?php echo rand(100000, 999999);?>">
                                  <div id="et-smallr"  class="et-cart-brn" style="display:none; width:80px">
                                  <img src="{{URL::asset('asset/img/page-loader.gif')}}"></div>
                                 <button type="sumbit" class="et-cart-brn" id="stand">Add To Cart</button>
                                <div class="et-btn-group">
                                    <h4 style="color:#f00; font-weight:bold;" class="vwprice">1 Jacket: $ {{$eTailorObj['ofabricPrice']}} </h4>
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
                            <form class="et-shirt-measure" role="form" method="POST" onSubmit="javascript:return validatebodyform();" enctype="multipart/form-data">
                             {{ csrf_field() }}
                                <div class="et-block">
                                    <div class="et-measure-image">
                                        <figure><img src="{{asset('/storage/Measurment/Shirts/chest/chest.jpg')}}" alt=""></figure>
                                    </div>
                                    <div class="et-measure-video">
                                        <video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="{{asset('/storage/Measurment/Shirts/chest/chest.ogv')}}" type="video/ogg"><source src="{{asset('/storage/Measurment/Shirts/chest/chest.mp4')}}" type="video/mp4"><object data="{{asset('/storage/Measurment/Shirts/chest/chest.swf')}}" type="application/x-shockwave-flash" width="300" height="220"></object><source src="{{asset('/storage/Measurment/Shirts/chest/chest.webm')}}" type="video/webm"></video>
                                    </div>
                                </div>
                                <div class="et-block no-pad">
                                    <div class="et-subhead">
                                        <span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
                                        <span>Jacket <span id="fldtitle">Chest</span> generally range from <b><span id="rngfrom">28</span></b> to <b><span id="rngto">75</span></b> <span id="mtyp">inch</span></span>
                                    </div>
                                    <div class="et-type-Input">
                                        <div class="et-input">
                                            <span>CHEST</span>
                                            <?php $measurechestlst = App\MeasurmentVideo::select('*')->where('cat_id','=',2)->where('id','=',9)->get();?>
                                            @foreach($measurechestlst as $mchestlst)
                                            <input type="text" data-title="{{$mchestlst->from_range}}-{{$mchestlst->to_range}}" name="bsizeChest" id="bsizeChest" onFocus="javascript:showRanges('{{$mchestlst->bodysize_type}}',{{$mchestlst->from_range}},{{$mchestlst->to_range}},'chest');" onBlur="javascript:validateField(this.id,{{$mchestlst->from_range}},{{$mchestlst->to_range}});" value="<?php echo $eTailorObj['osizeChest'];?>" style="border-color:#f00;">
                                            @endforeach
                                        </div>
                                        <div class="et-input">
                                            <span>WAIST</span>
                                            <?php $measurewaistlst = App\MeasurmentVideo::select('*')->where('cat_id','=',2)->where('id','=',10)->get();?>
                                            @foreach($measurewaistlst as $mwaistlst)
                                            <input type="text" data-title="{{$mwaistlst->from_range}}-{{$mwaistlst->to_range}}" name="bsizeWaist" id="bsizeWaist" onFocus="javascript:showRanges('{{$mwaistlst->bodysize_type}}',{{$mwaistlst->from_range}},{{$mwaistlst->to_range}},'waist');" onBlur="javascript:validateField(this.id,{{$mwaistlst->from_range}},{{$mwaistlst->to_range}});" value="<?php echo $eTailorObj['osizeWaist'];?>" >
                                            @endforeach
                                        </div>
                                        <div class="et-input">
                                            <span>HIP</span>
                                            <?php $measurehiplst = App\MeasurmentVideo::select('*')->where('cat_id','=',2)->where('id','=',11)->get();?>
                                            @foreach($measurehiplst as $mhiplst)
                                            <input type="text" data-title="{{$mhiplst->from_range}}-{{$mhiplst->to_range}}" name="bsizeHip" id="bsizeHip" onFocus="javascript:showRanges('{{$mhiplst->bodysize_type}}',{{$mhiplst->from_range}},{{$mhiplst->to_range}},'hip');" onBlur="javascript:validateField(this.id,{{$mhiplst->from_range}},{{$mhiplst->to_range}});" value="<?php echo $eTailorObj['osizeHip'];?>" >
                                            @endforeach
                                        </div>
                                        <div class="et-input">
                                            <span>SHOULDER</span>
                                            <?php $measureshoulderlst = App\MeasurmentVideo::select('*')->where('cat_id','=',2)->where('id','=',12)->get();?>
                                            @foreach($measureshoulderlst as $mshoulderlst)
                                            <input type="text" data-title="{{$mshoulderlst->from_range}}-{{$mshoulderlst->to_range}}" name="bsizeShoulder" id="bsizeShoulder" onFocus="javascript:showRanges('{{$mshoulderlst->bodysize_type}}',{{$mshoulderlst->from_range}},{{$mshoulderlst->to_range}},'shoulder');" onBlur="javascript:validateField(this.id,{{$mshoulderlst->from_range}},{{$mshoulderlst->to_range}});" value="<?php echo $eTailorObj['osizeShoulder'];?>" >
                                            @endforeach
                                        </div>
                                        <div class="et-input">
                                            <span>SLEEVE</span>
                                            <?php $measuresleevelst = App\MeasurmentVideo::select('*')->where('cat_id','=',2)->where('id','=',13)->get();?>
                                            @foreach($measuresleevelst as $msleevlst)
                                            <input type="text" data-title="{{$msleevlst->from_range}}-{{$msleevlst->to_range}}" name="bsizeSleeve" id="bsizeSleeve" onFocus="javascript:showRanges('{{$msleevlst->bodysize_type}}',{{$msleevlst->from_range}},{{$msleevlst->to_range}},'sleeve');" onBlur="javascript:validateField(this.id,{{$msleevlst->from_range}},{{$msleevlst->to_range}});" value="<?php echo $eTailorObj['osizeSleeve'];?>" >
                                            @endforeach
                                        </div>
                                        <div class="et-input">
                                            <span>LENGTH</span>
                                            <?php $measurelengthlst = App\MeasurmentVideo::select('*')->where('cat_id','=',2)->where('id','=',14)->get();?>
                                            @foreach($measurelengthlst as $mlengthlst)
                                            <input type="text" data-title="{{$mlengthlst->from_range}}-{{$mlengthlst->to_range}}" name="bsizeLength" id="bsizeLength" onFocus="javascript:showRanges('{{$mlengthlst->bodysize_type}}',{{$mlengthlst->from_range}},{{$mlengthlst->to_range}},'length');" onBlur="javascript:validateField(this.id,{{$mlengthlst->from_range}},{{$mlengthlst->to_range}});" value="<?php echo $eTailorObj['osizeLength'];?>" >
                                            @endforeach
                                        </div>
                                        <div class="et-radio-check">
                                            <div class="radio">
                                                <label><input type="radio" name="bsizetyp" id="bsizetyp" value="cm" <?php if($eTailorObj['osizeType']=="cm"){?>checked<?php } ?>><span class="cr"><i class="cr-icon"></i></span>Cm</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="bsizetyp" id="bsizetyp" value="inch" <?php if($eTailorObj['osizeType']=="inch"){?>checked<?php } ?> ><span class="cr"><i class="cr-icon"></i></span>Inch</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="et-block">
                                        <div class="et-setect-fit">
                                            <ul>
                                                <li><span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span><span>Select Your Size :</span></li>
                                                <li><div class="radio"><label><input type="radio" name="fitstyle" id="fitstyle" value="Comfortable" <?php if($eTailorObj['osizeStyle']=="Comfortable"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Signature Standard Fit</label></div></li>
                                                <li><div class="radio"><label><input type="radio" name="fitstyle" id="fitstyle" value="Slim" <?php if($eTailorObj['osizeStyle']=="Slim"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Euro Slim Fit</label></div></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="et-block et-form-btn">
                                        <a href="#" onClick="javascript:showMeasureSect('main');" class="et-blk-brn blue">Back To Design</a>
                                    <input type="hidden" name="setarr" id="setarr" class="bsetarr" value="">
                                    <input type="hidden" name="frntviewfinal" id="frntviewfinal" class="bfrntviewfinal">
                                    <input type="hidden" name="bkviewfinal" id="bkviewfinal" class="bbkviewfinal">
                                    <input type="hidden" name="mpattern" value="Body" id="bmpattern">
                                    <input type="hidden" name="selbodyqty" value="1" id="bselbodyqty">
                                     <input type="hidden" name="tocken" id="tocken" value="{{csrf_token() }}">
                                    <input type="hidden" name="rndvalue" id="brndvalue" value="<?php echo rand(100000, 999999);?>">
                                    <div id="et-body"  class="et-cart-brn" style="display:none; width:80px"><img src="{{URL::asset('asset/img/page-loader.gif')}}"></div>
                                        <button type="sumbit" class="et-cart-brn" id="body">Add To Cart</button>
                                        <div class="et-btn-group">
                                            <h4 style="color:#f00; font-weight:bold;" class="vwprice">1 Jacket: ${{$eTailorObj['ofabricPrice']}} </h4>
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
<canvas id="sidecanvas" width="313" height="421" style="display:none"></canvas>

<!-- ======================================================= -->
</body>
<!-- =================== script ============================ -->
<script type="text/javascript" src="{{asset('demo/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/float-panel.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/responsive_bootstrap_carousel.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/bootstrap-touch-slider.js')}}"></script>
<script type="text/javascript">var url = "{{asset('/storage/')}}";</script>
<script type="text/javascript" src="{{asset('demo/js/fabric.min.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/mobilejacketprocessnew.js?v0')}}"></script>

<script type="text/javascript">
$( '#et-banner' ).bsTouchSlider();
</script>

<script type="text/javascript">

var cur_step = 0;
function showStep(step){
    cur_step = step;
    if(cur_step>0){
        $('#follow_step').hide();
        $('#tailor_content').show();
    }
}

function hideTabContent(){
    $('#tab-content').hide();
    // $('#tab-content').slideUp();
}
// page init ------------------------------
$(document).ready(function(e) {
    var stid="menu-"+$('#tabSActiveId').val();
    var stab=$('#tabSActiveId').val();
    // getTabSect($('#tabActiveId').val());
    getPgOption(stid,$('#tabActiveId').val(),$('#tabSActiveId').val(),'');
    frontdesignProcess(<?php echo json_encode($eTailorObj);?>);
    backdesignProcess(<?php echo json_encode($eTailorObj);?>);
    sidedesignProcess(<?php echo json_encode($eTailorObj);?>);changeSizeDetails();
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

<script type="text/javascript">
$("#stand").click(function(){

    var cntrysize = $('#cntrysize').val();
    var sizefit = $('#sizefit').val();
    var sizetyp = $('#sizetyp:checked').val();
    var sizechest = $('#sizechest').val();
    var sizewaist = $('#sizewaist').val();
    var sizehip = $('#sizehip').val();
    var sizeshoulder = $('#sizeshoulder').val();
    var sizesleeve = $('#sizesleeve').val();
    var sizelength = $('#sizelength').val();
    var setarr = $('#setarr').val();
    var frntviewfinal = $('#frntviewfinal').val();
    var bkviewfinal = $('#bkviewfinal').val();
    var mpattern = $('#mpattern').val();
    var selstdqty = $('#selstdqty').val();
    var hsizefit = $('#hsizefit').val();
    var rndvalue = $('#rndvalue').val();

    if (rndvalue!='') {
        $.ajax({
            type:'POST',
            url:'/designjackets/postfdataurl',
            data:{frntviewfinal:frntviewfinal,rndvalue:rndvalue,},
            beforeSend: function() {
               $("#et-smallr").show();
               $("#stand").hide();
            },

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                postbdataurl();
            }
        });

        function postbdataurl(){
            $.ajax({
                type:'POST',
                url:'/designjackets/postbdataurl',
                data:{bkviewfinal:bkviewfinal,rndvalue:rndvalue,},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                postcart();
               }
            });
        }

        function postcart(){
            $.ajax({
                type:'POST',
                url:'/designjackets/postcart',
                data:{setarr:setarr,cntrysize:cntrysize,sizefit:sizefit,sizetyp:sizetyp,sizeChest:sizechest,sizeWaist:sizewaist,sizeHip:sizehip,sizeShoulder:sizeshoulder,sizeSleeve:sizesleeve,sizeLength:sizelength,mpattern:mpattern,selstdqty:selstdqty,hsizefit:hsizefit,rndvalue:rndvalue,},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    $("#msg").html(data.msg);
                    window.location.href = "/cart";
                }
            });
        }
    }
    return false;
});
</script>

<script type="text/javascript">
$("#body").click(function(){

    var bsizetyp = $('#bsizetyp:checked').val();
    var fitstyle = $('#fitstyle:checked').val();
    var bsizechest = $('#bsizeChest').val();
    var bsizewaist = $('#bsizeWaist').val();
    var bsizehip = $('#bsizeHip').val();
    var bsizeshoulder = $('#bsizeShoulder').val();
    var bsizesleeve = $('#bsizeSleeve').val();
    var bsizelength = $('#bsizeLength').val();
    var setarr = $('.bsetarr').val();
    var frntviewfinal = $('.bfrntviewfinal').val();
    var bkviewfinal = $('.bbkviewfinal').val();
    var mpattern = $('#bmpattern').val();
    var selstdqty = $('#bselbodyqty').val();
    var rndvalue = $('#brndvalue').val();

    if(bsizechest) if(bsizewaist) if(bsizehip) if(bsizeshoulder) if(bsizesleeve) if(bsizelength) valuCheck = true;

    if(valuCheck){

    if (rndvalue!='') {
        $.ajax({
            type:'POST',
            url:'/designjackets/postfdataurl',
            data:{frntviewfinal:frntviewfinal,rndvalue:rndvalue,},
            beforeSend: function() {
                $("#et-body").show();
                $("#body").hide();
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                postbdataurl();
            }
        });

        function postbdataurl(){
            $.ajax({
                type:'POST',
                url:'/designjackets/postbdataurl',
                data:{bkviewfinal:bkviewfinal,rndvalue:rndvalue,},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    postcart();
                }
            });
        }

        function postcart(){
            $.ajax({
                type:'POST',
                url:'/designjackets/postcart',
                data:{setarr:setarr,fitstyle:fitstyle,bsizetyp:bsizetyp,bsizeChest:bsizechest,bsizeWaist:bsizewaist,bsizeHip:bsizehip,bsizeShoulder:bsizeshoulder,bsizeSleeve:bsizesleeve,bsizeLength:bsizelength,mpattern:mpattern,bselbodyqty:selstdqty,rndvalue:rndvalue,},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    $("#msg").html(data.msg);
                    window.location.href = "/cart";
                }
            });
        }
    }
}
    return false;
});
</script>
</html>
