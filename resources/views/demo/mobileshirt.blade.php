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
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('demo/css/style.css')}}" media="all"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/et-responsive.css')}}" media="screen">

    <link rel="stylesheet" type="text/css" href="{{asset('demo/css/stylejacket.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('demo/css/bootstrap.min.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('demo/css/font-awesome.min.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('demo/css/bootstrap-touch-slider.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('demo/css/responsive_bootstrap_carousel_mega_min.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('demo/css/stylemobileshirt.css')}}" media="all">

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
                <img src="{{asset('demo/img/product/shirt_new_one.png')}}"/>
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
                <img id="shirt-back" src="{{asset('demo/img/product/pt-shirts-back.png')}}"/>
            </div>
            <div class="pt-price-shirt">
                <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFront('etfabric');">FRONT VIEW</a>
            </div>
        </div>
        <div class="pt-bottom-thumb">
            <ul>
                <li><a href="javascript:designProcessing();"><img src="{{asset('demo/img/product/view-normal.png')}}"></a></li>
                <?php
                if($eTailorObj['ocollar']!=21 && $eTailorObj['ocollar']!=22
                && $eTailorObj['ocollar']!=23 && $eTailorObj['ocollar']!=26
                && $eTailorObj['ocollar']!=27){?>
                    <li><a href="javascript:designOpenProcessing();"><img src="{{asset('demo/img/product/view-advanced.png')}}"/></a></li>
                <?php } ?>
            </ul>
        </div>
        <!-- End Main Preview -->
        <!-- <div class="pt-men-left" id="main-front-etfabric">
            <div class="pt-image-div">@include('demo.process')
                <img src="{{asset('demo/img/product/shirt_new_one.png')}}"/>
            </div>
            <div class="pt-price-shirt">
                <span class="pt-sht"> Shirt {1 Shirt} </span><br>
                <span class="pt-dollor">${{number_format($eTailorObj['ofabricPrice'],2)}}</span><br>
                <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBack('etfabric');">BACK VIEW</a>
            </div>
            <div class="pt-bottom-thumb">
                <ul>
                    <li><a href="javascript:designProcessing();"><img src="{{asset('demo/img/product/view-normal.png')}}"></a></li>
                    <?php
                    if($eTailorObj['ocollar']!=21 && $eTailorObj['ocollar']!=22
                    && $eTailorObj['ocollar']!=23 && $eTailorObj['ocollar']!=26
                    && $eTailorObj['ocollar']!=27){?>
                        <li><a href="javascript:designOpenProcessing();"><img src="{{asset('demo/img/product/view-advanced.png')}}"/></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div> -->
        <!-- <div class="pt-men-left" id="main-back-etfabric" style="display:none;">
            <div class="pt-image-div">@include('demo.process')
                <img id="shirt-back" src="{{asset('demo/img/product/pt-shirts-back.png')}}"/>
            </div>
            <div class="pt-price-shirt">
                <span class="pt-sht"> Shirt {1 Shirt} </span><br>
                <span class="pt-dollor">${{number_format($eTailorObj['ofabricPrice'],2)}}</span><br>
                <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFront('etfabric');">FRONT VIEW</a>
            </div>
            <div class="pt-bottom-thumb">
                <ul>
                    <li><a href="javascript:designProcessing();"><img src="{{asset('demo/img/product/view-normal.png')}}"/></a></li>
                    <?php
                    if($eTailorObj['ocollar']!=21 && $eTailorObj['ocollar']!=22
                    && $eTailorObj['ocollar']!=23 && $eTailorObj['ocollar']!=26
                    && $eTailorObj['ocollar']!=27){?>
                        <li><a href="javascript:designOpenProcessing();"><img src="{{asset('demo/img/product/view-advanced.png')}}"/></a></li>
                    <?php } ?>
                </ul>
                <a href="{{url('/')}}/advance3D" class="et-threed-pro" >3D PRO<span>Advanced Designing</span></a>
            </div>
        </div> -->
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
                <div class="pt-variation" id="stablist">
                    <?php $smi=1;?>
                    @if($eTailorObj['osleeve']==3)
                        @foreach($mainattr_record as $mattr)
                            @if($mattr->id!=9)
                                <div id="menu-{{$mattr->id}}" class="pt-box-square <?php if($mattr->id=='4'){?>active<?php } ?>" onClick="javascript:getPgOption(this.id,'etstyle','{{$mattr->id}}','{{$mattr->attribute_name}}');">
                                    <p>2.{{$smi}}  {{$mattr->attribute_name}}</p>
                                </div>
                                <?php $smi++;?>
                            @endif
                        @endforeach
                    @else
                        @foreach($mainattr_record as $mattr)
                            <div id="menu-{{$mattr->id}}" class="pt-box-square <?php if($mattr->id=='4'){?>active<?php } ?>" onClick="javascript:getPgOption(this.id,'etstyle','{{$mattr->id}}','{{$mattr->attribute_name}}');">
                                <p>2.{{$smi}}  {{$mattr->attribute_name}}</p>
                            </div>
                            <?php $smi++;?>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="pt-customize">
                <div class="pt-men">
                    <!-- Right Option Section -->
                    <div class="pt-choose-right">
                        <div class="pt-thumb-slider">
                            <div class="pt-pagination">
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                <span id="menuopttitle-etstyle">Choose Your Sleeves Style : </span>
                            </div>
                            <div id="fullstyle">
                                <!-- Menu Sleeves -->
                                @foreach($mainattr_record as $mattr)
                                <div class="et-carousel" id="menu-opt-{{$mattr->id}}">
                                    <div id="et-style-item-{{$mattr->id}}" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false">
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active">
                                                <ul class="et-item-list">
                                                    <?php $stylci=1; $stylelst = App\AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get(); ?>
                                                    @foreach($stylelst as $styllst)
                                                    <?php if($stylci==7){?></ul></div><div class="item"><ul class="et-item-list"><?php  $stylci=1;}?>
                                                    <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getstyles({{$styllst->id}},'{{$mattr->id}}','etstyle');">
                                                        <?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                        @if($styllst->id == 37)
                                                            <figure class="et-item-img"><img class="et-main-list-img" src="{{asset('/storage/none/none.jpg')}}" alt="{{$alt_name}}"></figure>
                                                            @if($styllst->id == $eTailorObj['opacket'])<div class="icon-check"></div>@endif
                                                        @else
                                                            @foreach($styleimglst as $ls)
                                                            <figure class="et-item-img"><img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$alt_name}}">
                                                            <?php $thrdimglst = App\ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('thrd_id' , '=' , $eTailorObj['obuttonHole'])->get();?>
                                                            @foreach($thrdimglst as $thrdls)
                                                            @if($mattr->id!='5')<img src="{{asset('/storage/'.$thrdls->thrd_list_img)}}" alt="{{$alt_name}}">@endif
                                                            @endforeach
                                                            <?php $buttimglst = App\ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObj['obutton'])->get();?>
                                                            @foreach($buttimglst as $buttls)
                                                            @if($mattr->id!='4')<img src="{{asset('/storage/'.$buttls->button_list_img)}}" alt="{{$alt_name}}">@endif
                                                            @endforeach
                                                            </figure>
                                                            @if($mattr->id==4)
                                                                @if($styllst->id == $eTailorObj['osleeve'])<div class="icon-check"></div>@endif
                                                            @elseif($mattr->id==5)
                                                                @if($styllst->id == $eTailorObj['ofront'])<div class="icon-check"></div>@endif
                                                            @elseif($mattr->id==6)
                                                                @if($styllst->id == $eTailorObj['oback'])<div class="icon-check"></div>@endif
                                                            @elseif($mattr->id==7)
                                                                @if($styllst->id == $eTailorObj['obottom'])<div class="icon-check"></div>@endif
                                                            @elseif($mattr->id==8)
                                                                @if($styllst->id == $eTailorObj['ocollar'])<div class="icon-check"></div>@endif
                                                            @elseif($mattr->id==9)
                                                                @if($styllst->id == $eTailorObj['ocuff'])<div class="icon-check"></div>@endif
                                                            @elseif($mattr->id==10)
                                                                @if($styllst->id == $eTailorObj['opacket'] && $styllst->id != 37)<div class="icon-check"></div>@endif
                                                            @elseif($mattr->id==11)
                                                                @if($styllst->id == $eTailorObj['ocontrast'])<div class="icon-check"></div>@endif
                                                            @elseif($mattr->id==12)
                                                                @if($styllst->id == $eTailorObj['obutton'])<div class="icon-check"></div>@endif
                                                            @elseif($mattr->id==13)
                                                                @if($styllst->id == $eTailorObj['omonogramColor'])<div class="icon-check"></div>@endif
                                                            @endif
                                                            @endforeach
                                                        @endif
                                                    </li>
                                                    <?php $stylci++;?>
                                                    @endforeach
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
                                    <!-- Sleeves -->
                                    <div class="et-content-fab" id="miniview-etstyle-4">
                                        <figure class="et-selected-img et-selected-full">
                                            <img src="{{asset('demo/img/product/pt-shirts.png')}}" alt="{{$eTailorObj['osleeveName']}}">
                                        </figure>
                                        <div class="et-style-select">
                                            <h2>Sleeve</h2>
                                            <span>{{$eTailorObj['osleeveName']}}</span>
                                            <div class="et-check-box">
                                                <div class="checkbox"><label><input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" <?php if($eTailorObj['oshoulder']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['oshoulder']}},'Epaulette','4','etstyle');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Epaulettes</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Front -->
                                    <div class="et-content-fab" id="miniview-etstyle-5" style="display:none">
                                        <figure class="et-selected-img et-selected-full"><img src="{{asset('demo/img/product/pt-shirts.png')}}" alt="{{$alt_name}}"></figure>
                                        <div class="et-style-select">
                                            <h2>Front Style</h2>
                                            <span>{{$eTailorObj['ofrontName']}}</span>
                                            <div class="et-check-box">
                                                <div class="checkbox"><label><input type="checkbox" name="seamstxt" id="seamstxt" value="true" <?php if($eTailorObj['oseams']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['oseams']}},'Seams','5','etstyle');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Seams</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Back -->
                                    <div class="et-content-fab" id="miniview-etstyle-6" style="display:none">
                                        <figure class="et-selected-img et-selected-full"><img src="{{asset('demo/img/product/pt-shirts.png')}}" alt="{{$eTailorObj['obackName']}}"></figure>
                                        <div class="et-style-select">
                                            <h2>Back Style</h2>
                                            <span>{{$eTailorObj['obackName']}}</span>
                                            <div class="et-check-box">
                                                <div class="checkbox">@if($eTailorObj['oback']==7 || $eTailorObj['oback']==8)<label><input type="checkbox" name="dartstxt" id="dartstxt" value="true" <?php if($eTailorObj['odart']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['odart']}},'Darts','6','etstyle');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Darts</label>@endif</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Bottom -->
                                    <div class="et-content-fab" id="miniview-etstyle-7" style="display:none">
                                        <figure class="et-selected-img">
                                            <img src="{{asset('/storage/Shirts/Style/Bottom/TriTab/List/1.png')}}" alt="">
                                        </figure>
                                        <div class="et-style-select">
                                            <h2>Bottom Style</h2>
                                            <span>{{$eTailorObj['obottomName']}}</span>
                                        </div>
                                    </div>
                                    <!-- Collar -->
                                    <div class="et-content-fab" id="miniview-etstyle-8" style="display:none">
                                        <figure class="et-selected-img">
                                            <img src="{{asset('/storage/Shirts/Style/Collar/ItalianCollar1Button/List/1.png')}}" alt="{{$alt_name}}">
                                            <img src="{{asset('/storage/Shirts/Style/Collar/ItalianCollar1Button/Thread/ListImg/3.png')}}" alt="">
                                            <img src="{{asset('/storage/Shirts/Style/Collar/ItalianCollar1Button/Button/ListImg/1.png')}}" alt="">
                                        </figure>
                                        <div class="et-style-select">
                                            <h2>Collar Style</h2>
                                            <span>{{$eTailorObj['ocollarName']}}</span>
                                            <div class="et-check-box">
                                                <div class="checkbox"><label><input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" <?php if($eTailorObj['ocollarStay']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['ocollarStay']}},'CollarStay','8','etstyle');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Stay</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Cuffs -->
                                    <div class="et-content-fab" id="miniview-etstyle-9" style="display:none">
                                        <figure class="et-selected-img">
                                            <img src="{{asset('/storage/Shirts/Style/Cuffs/1ButtonRound/List/1.png')}}" alt="{{$alt_name}}">
                                            <img src="{{asset('/storage/Shirts/Style/Cuffs/1ButtonRound/Thread/ListImg/3.png')}}" alt="">
                                            <img src="{{asset('/storage/Shirts/Style/Cuffs/1ButtonRound/Button/ListImg/1.png')}}" alt="">
                                        </figure>
                                        <div class="et-style-select">
                                            <h2>Cuff Style</h2>
                                            <span>{{$eTailorObj['ocuffName']}}</span>
                                        </div>
                                    </div>
                                    <!-- Pockets -->
                                    <div class="et-content-fab" id="miniview-etstyle-10" style="display:none;">
                                        <figure class="et-selected-img">
                                            <img src="{{asset('/storage/none/none.jpg')}}" alt="{{$alt_name}}">
                                        </figure>
                                        <div class="et-style-select">
                                            <h2>Pocket Style</h2>
                                            <span>{{$eTailorObj['opacketName']}}</span>
                                            @if($eTailorObj['opacket']!=37)
                                            <div class="et-check-box">
                                                <div class="et-btn-group"><span>Number Of Pocket</span><div class="et-btn-select"><select class="selectpicker btn-primary" name="pocketstxt" id="pocketstxt" onChange="javascript:getseloptions(this.value,'NumPocket','10','etstyle');"><option value="1" <?php if($eTailorObj['opacketCount']=="1"){?>selected<?php } ?>>1 Pocket</option><option value="2" <?php if($eTailorObj['opacketCount']=="2"){?>selected<?php } ?>>2 Pockets</option></select></div></div>
                                            </div>
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
                    <div id="menu-{{$contlst->id}}" class="pt-box-square <?php if($contlst->id=='11'){?>active<?php } ?>" onClick="javascript:getPgOption(this.id,'etcontrast','{{$contlst->id}}','{{$contlst->attribute_name}}');">
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
                                <span id="menuopttitle-etcontrast">Choose your Contrast Fabric</span>
                            </div>
                            <div id="fullcontrast">
                                <!-- Menu Contrast -->
                                @foreach($contrast_record as $contlst)
                                    @if($contlst->id == '11')
                                        <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                            <div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                    <?php $contfablst = App\Contrast::select('*')->where('cat_id','=',1)->get(); ?>
                                                    @foreach($contfablst as $cfablst)
                                                    <li class="et-item" id="optionlist-{{$contlst->id}}-{{$cfablst->id}}" data-title="{{$cfablst->contrsfab_name}}" title="{{$cfablst->contrsfab_name}}" onClick="javascript:getcontrast({{$cfablst->id}},'etcontrast');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$cfablst->contrsfab_img)}}" alt="{{$cfablst->contrsfab_name}}"></figure>
                                                        @if($cfablst->id==$eTailorObj['ocontrast'])<div class="icon-check"></div>@endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @elseif($contlst->id == '12')
                                        <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                            <div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                    <?php $contbuttlst = App\Button::select('*')->where('cat_id','=',1)->get(); ?>
                                                    @foreach($contbuttlst as $cbuttnlst)
                                                    <li class="et-item" id="optionlist-{{$contlst->id}}-{{$cbuttnlst->id}}" data-title="{{$cbuttnlst->button_name}}({{$cbuttnlst->button_code}})" onClick="javascript:getbutton({{$cbuttnlst->id}},'etcontrast');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$cbuttnlst->button_img)}}" alt="{{$cbuttnlst->button_name}}({{$cbuttnlst->button_code}})"></figure>
                                                        @if($cbuttnlst->id==$eTailorObj['obutton'])<div class="icon-check"></div>@endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <!-- Threads -->
                                            <div class="pt-pagination no-pad-left"><span>B. Choose Your Buttonhole Thread</span></div>
                                            <div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                    <?php $contthrdlst = App\Thread::select('*')->where('cat_id','=',1)->get(); ?>
                                                    @foreach($contthrdlst as $cthreadlst)
                                                    <li class="et-item" id="optionlist-thrd-{{$cthreadlst->id}}" data-title="{{$cthreadlst->thrd_name}}({{$cthreadlst->thread_code}})" onClick="javascript:getthread({{$cthreadlst->id}},'etcontrast');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$cthreadlst->thrd_img)}}" alt="{{$cthreadlst->thrd_name}}({{$cthreadlst->thread_code}})"></figure>
                                                        @if($cthreadlst->id==$eTailorObj['obuttonHole'])<div class="icon-check"></div>@endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <!-- ThreadHoles -->
                                            <div class="pt-pagination no-pad-left"><span>C. Choose Your Button Hole Style</span></div>
                                            <div class="et-contrast-list">
                                                <?php $contthrdstyllst = App\Thread::select('*')->where('cat_id','=',1)->get(); ?>
                                                @foreach($contthrdstyllst as $cthrdstyllst)
                                                <ul class="et-item-list" id="TC{{$cthrdstyllst->id}}" <?php if($cthrdstyllst->id==$eTailorObj['obuttonHole']){?>style="display:block;"<?php } else { ?>style="display:none"<?php } ?>>
                                                    <li class="et-item" id="optionlist-thrdstyl-{{$cthrdstyllst->id}}" data-title="Vertical(V)" onClick="javascript:getthreadhole('V','etcontrast');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/Shirts/Fabric/S/'.$eTailorObj['ofabric'].'.jpg')}}" ><img src="{{asset('/storage/'.$cthrdstyllst->thrd_hole_vertical)}}" alt="Vertical(V)"></figure>
                                                        @if($eTailorObj['obuttonHoleStyle']=='V')<div class="icon-check"></div>@endif
                                                    </li>
                                                    <li class="et-item" id="optionlist-thrdstyl-{{$cthrdstyllst->id}}" data-title="Horizontal(H)" onClick="javascript:getthreadhole('H','etcontrast');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/Shirts/Fabric/S/'.$eTailorObj['ofabric'].'.jpg')}}" ><img src="{{asset('/storage/'.$cthrdstyllst->thrd_hole_horizontal)}}" alt="Horizontal(H)"></figure>
                                                        @if($eTailorObj['obuttonHoleStyle']=='H')<div class="icon-check"></div>@endif
                                                    </li>
                                                    <li class="et-item" id="optionlist-thrdstyl-{{$cthrdstyllst->id}}" data-title="Slanted(L)" onClick="javascript:getthreadhole('S','etcontrast');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/Shirts/Fabric/S/'.$eTailorObj['ofabric'].'.jpg')}}" ><img src="{{asset('/storage/'.$cthrdstyllst->thrd_hole_slanted)}}" alt="Slanted(L)"></figure>
                                                        @if($eTailorObj['obuttonHoleStyle']=='S')<div class="icon-check"></div>@endif
                                                    </li>
                                                </ul>
                                                @endforeach
                                            </div>
                                        </div>
                                    @elseif($contlst->id == '13')
                                        <div class="et-carousel" id="menu-opt-{{$contlst->id}}">
                                            <div id="et-style-item" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="item active">
                                                        <ul class="et-item-list">
                                                            <li class="et-item" id="optionlist-{{$contlst->id}}-1" data-title="No Monogram" onClick="javascript:getmonogram('1','etcontrast');">
                                                                <figure class="et-item-img"><img src="{{asset('/storage/none/none.jpg')}}" alt="No Monogram" title="No Monogram"></figure>
                                                                @if($eTailorObj['omonogram']=='1')<div class="icon-check"></div>@endif
                                                            </li>
                                                            <?php $contmonogrmlst = App\AttributeStyle::select('*')->where('attri_id','=','13')->get(); ?>
                                                            @foreach($contmonogrmlst as $cmonolst)
                                                            <?php $cmonoimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$cmonolst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                            @if($cmonolst->id==46)
                                                                @foreach($cmonoimglst as $cmonols)
                                                                <li class="et-item" id="optionlist-{{$contlst->id}}-{{$cmonolst->id}}" data-title="{{$cmonolst->style_name}}" onClick="javascript:getmonogram({{$cmonolst->id}},'etcontrast');">
                                                                    <figure class="et-item-img"><img src="{{asset('/storage/'.$cmonols->list_img)}}" alt="{{$alt_name}}" title="{{$cmonolst->style_name}}">
                                                                        @if($cmonolst->id==46)<img src="{{asset('/storage/none/Waist.png')}}">@elseif($cmonolst->id==47)<img src="{{asset('/storage/none/Chest.png')}}">@elseif($cmonolst->id==48)<img src="{{asset('/storage/none/Pocket.png')}}">@elseif($cmonolst->id==49)<img src="{{asset('/storage/none/Cuff.png')}}">@endif
                                                                    </figure>
                                                                    @if($cmonolst->id==$eTailorObj['omonogram'])<div class="icon-check"></div>@endif
                                                                </li>
                                                                @endforeach
                                                            @elseif($cmonolst->id==47)
                                                                @if($eTailorObj['opacket']==37)
                                                                @foreach($cmonoimglst as $cmonols)
                                                                <li class="et-item" id="optionlist-{{$contlst->id}}-{{$cmonolst->id}}" data-title="{{$cmonolst->style_name}}" onClick="javascript:getmonogram({{$cmonolst->id}},'etcontrast');">
                                                                    <figure class="et-item-img"><img src="{{asset('/storage/'.$cmonols->list_img)}}" alt="{{$alt_name}}" title="{{$cmonolst->style_name}}">
                                                                        @if($cmonolst->id==46)<img src="{{asset('/storage/none/Waist.png')}}">@elseif($cmonolst->id==47)<img src="{{asset('/storage/none/Chest.png')}}">@elseif($cmonolst->id==48)<img src="{{asset('/storage/none/Pocket.png')}}">@elseif($cmonolst->id==49)<img src="{{asset('/storage/none/Cuff.png')}}">@endif
                                                                    </figure>
                                                                    @if($cmonolst->id==$eTailorObj['omonogram'])<div class="icon-check"></div>@endif
                                                                </li>
                                                                @endforeach
                                                                @endif
                                                            @elseif($cmonolst->id==48)
                                                                @if($eTailorObj['opacket']!=37)
                                                                @foreach($cmonoimglst as $cmonols)
                                                                <li class="et-item" id="optionlist-{{$contlst->id}}-{{$cmonolst->id}}" data-title="{{$cmonolst->style_name}}" onClick="javascript:getmonogram({{$cmonolst->id}},'etcontrast');">
                                                                    <figure class="et-item-img"><img src="{{asset('/storage/'.$cmonols->list_img)}}" alt="{{$alt_name}}" title="{{$cmonolst->style_name}}">
                                                                        @if($cmonolst->id==46)
                                                                        <img src="{{asset('/storage/none/Waist.png')}}">
                                                                        @elseif($cmonolst->id==47)
                                                                        <img src="{{asset('/storage/none/Chest.png')}}">
                                                                        @elseif($cmonolst->id==48)
                                                                        <img src="{{asset('/storage/none/Pocket.png')}}">
                                                                        @elseif($cmonolst->id==49)<img src="{{asset('/storage/none/Cuff.png')}}">
                                                                        @endif
                                                                    </figure>
                                                                    @if($cmonolst->id==$eTailorObj['omonogram'])<div class="icon-check"></div>@endif
                                                                </li>
                                                                @endforeach
                                                                @endif
                                                            @elseif($cmonolst->id==49)
                                                                @if($eTailorObj['osleeve']!=3)
                                                                @foreach($cmonoimglst as $cmonols)
                                                                <li class="et-item" id="optionlist-{{$contlst->id}}-{{$cmonolst->id}}" data-title="{{$cmonolst->style_name}}" onClick="javascript:getmonogram({{$cmonolst->id}},'etcontrast');">
                                                                    <figure class="et-item-img"><img src="{{asset('/storage/'.$cmonols->list_img)}}" alt="{{$alt_name}}" title="{{$cmonolst->style_name}}">
                                                                        @if($cmonolst->id==46)<img src="{{asset('/storage/none/Waist.png')}}">@elseif($cmonolst->id==47)<img src="{{asset('/storage/none/Chest.png')}}">@elseif($cmonolst->id==48)<img src="{{asset('/storage/none/Pocket.png')}}">@elseif($cmonolst->id==49)<img src="{{asset('/storage/none/Cuff.png')}}">@endif
                                                                    </figure>
                                                                    @if($cmonolst->id==$eTailorObj['omonogram'])<div class="icon-check"></div>@endif
                                                                </li>
                                                                @endforeach
                                                                @endif
                                                            @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($eTailorObj['omonogram']==46 || $eTailorObj['omonogram']==47 || $eTailorObj['omonogram']==48 || $eTailorObj['omonogram']==49)
                                            <div class="pt-pagination no-pad-left"><span>B. Enter Desire Monogram/Initials (English Script)</span></div>
                                            <div class="et-contrast-list"><input type="text" name="monotext" id="monotext" maxlength="5" value="{{$eTailorObj['omonogramText']}}" style="color:#8c7676;" onBlur="javascript:getmonotext(this.value,'etcontrast');"></div>
                                            <div class="pt-pagination no-pad-left"><span>C. Monogram Color</span></div>
                                            <div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                    <?php $monothrdlst = App\Thread::select('*')->where('cat_id','=',1)->get(); ?>
                                                    @foreach($monothrdlst as $monothrdlst)
                                                    <li class="et-item" id="optionlist-thrdcolr-{{$monothrdlst->id}}" data-title="{{$monothrdlst->thrd_name}}({{$monothrdlst->thread_code}})" onClick="javascript:getmonotxtcolor({{$monothrdlst->id}},'etcontrast');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$monothrdlst->thrd_img)}}" alt="{{$alt_name}}"></figure>
                                                        @if($monothrdlst->id==$eTailorObj['omonogramColor'])<div class="icon-check"></div>@endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                                <!--  Mini Preview Section -->
                                <div class="et-progress-des et-style-bg">
                                    <div class="et-content-fab" id="miniview-etcontrast-11">
                                        <figure class="et-selected-img et-selected-con"><img src="{{asset('/storage/Shirts/Fabric/C/'.$eTailorObj['ofabric'].'.png')}}">
                                            @if($eTailorObj['ocollarCuffIn']=="true")
                                            <img src="{{asset('/storage/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObj['ocontrast'].'.png')}}" >
                                            @endif
                                            @if($eTailorObj['ocollarCuffout']=="true")
                                            <img src="{{asset('/storage/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObj['ocontrast'].'.png')}}">
                                            @endif
                                            @if($eTailorObj['ofrontPlacketIn']=="true")
                                            <img src="{{asset('/storage/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObj['ocontrast'].'.png')}}">
                                            @endif
                                            @if($eTailorObj['ofrontPlacketOut']=="true")
                                            <img src="{{asset('/storage/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObj['ocontrast'].'.png')}}">
                                            @endif
                                            @if($eTailorObj['ofrontBoxOut']=="true")
                                            <img src="{{asset('/storage/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObj['ocontrast'].'.png')}}">
                                            @endif
                                            @if($eTailorObj['ofront']==4)
                                            <img src="{{asset('/storage/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                            <img src="{{asset('/storage/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObj['obutton'].'.png')}}">
                                            @elseif($eTailorObj['ofront']==5)
                                            <img src="{{asset('/storage/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                            <img src="{{asset('/storage/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObj['obutton'].'.png')}}">
                                            @endif
                                            @if($eTailorObj['osleeve']!=3)
                                                @if($eTailorObj['ocuff']==34 || $eTailorObj['ocuff']==35 || $eTailorObj['ocuff']==36)
                                                    <!-- FRENCH CUFF PART -->
                                                    @if($eTailorObj['ocollarCuffIn']=="true")
                                                    <img src="{{asset('/storage/Shirts/FabricContrasts/Mix/CuffFrenchIn/'.$eTailorObj['ocontrast'].'.png')}}" class="menu-l-contrast-cuff ">
                                                    @else
                                                    <img src="{{asset('/storage/Shirts/Style/Cuffs/FrenchRound/Inner/'.$eTailorObj['ofabric'].'.png')}}" class="menu-l-contrast-cuff ">
                                                    @endif
                                                    @if($eTailorObj['ocollarCuffout']=="true")
                                                    <img src="{{asset('/storage/Shirts/FabricContrasts/Mix/CuffFrenchOut/'.$eTailorObj['ocontrast'].'.png')}}" class="menu-l-contrast-cuff ">
                                                    @else
                                                    <img src="{{asset('/storage/Shirts/Style/Cuffs/FrenchRound/Outer/'.$eTailorObj['ofabric'].'.png')}}" class="menu-l-contrast-cuff ">
                                                    @endif
                                                <img src="{{asset('/storage/Shirts/Style/Cuffs/FrenchRound/Button/ContrastImg/'.$eTailorObj['obutton'].'.png')}}" class="menu-l-contrast-cuff " >
                                                @else
                                                    <!-- ROUND CUFF PART -->
                                                    @if($eTailorObj['ocollarCuffIn']=="true")
                                                    <img src="{{asset('/storage/Shirts/FabricContrasts/Mix/RoundCuffIn/'.$eTailorObj['ocontrast'].'.png')}}" class="menu-l-contrast-cuff ">
                                                    @else
                                                    <img src="{{asset('/storage/Shirts/Style/Cuffs/1ButtonRound/Inner/'.$eTailorObj['ofabric'].'.png')}}" class="menu-l-contrast-cuff ">
                                                    @endif
                                                    @if($eTailorObj['ocollarCuffout']=="true")
                                                    <img src="{{asset('/storage/Shirts/FabricContrasts/Mix/RoundCuffOut/'.$eTailorObj['ocontrast'].'.png')}}" class="menu-l-contrast-cuff ">
                                                    @else
                                                    <img src="{{asset('/storage/Shirts/Style/Cuffs/1ButtonRound/Outer/'.$eTailorObj['ofabric'].'.png')}}" class="menu-l-contrast-cuff ">
                                                    @endif
                                                <img src="{{asset('/storage/Shirts/Style/Cuffs/1ButtonRound/Thread/ContrastImg/'.$eTailorObj['obuttonHole'].'.png')}}" class="menu-l-contrast-cuff ">
                                                <img src="{{asset('/storage/Shirts/Style/Cuffs/1ButtonRound/Button/ContrastImg/'.$eTailorObj['obutton'].'.png')}}" class="menu-l-contrast-cuff " >
                                                @endif
                                            @endif
                                        </figure>
                                        <div class="et-style-select">
                                            <h2>Contrast Fabric</h2>
                                            <span class="highlight">Collar & Cuff</span>
                                            <div class="et-check-box">
                                                <div class="checkbox"><label><input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" <?php if($eTailorObj['ocollarCuffIn']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['ocollarCuffIn']}},'CollarCuffIn','11','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" <?php if($eTailorObj['ocollarCuffout']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['ocollarCuffout']}},'CollarCuffOut','11','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div>
                                            </div>
                                            <span class="highlight">Front Placket</span>
                                            <div class="et-check-box">
                                                <div class="checkbox"><label><input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" <?php if($eTailorObj['ofrontPlacketIn']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['ofrontPlacketIn']}},'FrontPlacketIn','11','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" <?php if($eTailorObj['ofrontPlacketOut']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['ofrontPlacketOut']}},'FrontPlacketOut','11','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div>
                                                @if($eTailorObj['ofront']==5)
                                                <div class="checkbox"><label><input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" <?php if($eTailorObj['ofrontBoxOut']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['ofrontBoxOut']}},'FrontBoxOut','11','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box Placket</label></div>
                                                @endif
                                                @if($eTailorObj['oback']==8)
                                                <div class="checkbox"><label><input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" <?php if($eTailorObj['obackBoxOut']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['obackBoxOut']}},'BackBoxOut','11','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Box Placket</label></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="et-content-fab" id="miniview-etcontrast-12" style="display:none;" >
                                        <figure class="et-selected-img">
                                        <img src="{{asset('storage/Shirts/Fabric/S/'.$eTailorObj['ofabric'].'.jpg')}}" alt="{{$alt_name}}" >
                                        <img src="{{asset('storage/Shirts/Threads/'.$eTailorObj['obuttonHoleStyle'].'/'.$eTailorObj['obuttonHole'].'.png')}}" alt="{{$alt_name}}" style="padding-left:18px; padding-top:20px;">
                                        <img src="{{asset('storage/Shirts/Buttons/'.$eTailorObj['obutton'].'.png')}}" alt="{{$alt_name}}"  style="padding-left:34px; padding-top:36px;"><img src="{{asset('storage/Shirts/Threads/C/'.$eTailorObj['obuttonHole'].'.png')}}" style="padding-left:17px; padding-top:18px;"></figure>
                                        <div class="et-style-select">
                                            <h2>Contrast & Threads</h2>
                                            <span class="highlight">A. Button Color :</span>
                                            <p>{{$eTailorObj['obuttonName']}} ({{$eTailorObj['obuttonCode']}})</p>
                                            <span class="highlight">B. Thread Color :</span>
                                            <p>{{$eTailorObj['obuttonHoleName']}} ({{$eTailorObj['obuttonHoleCode']}})</p>
                                            <span class="highlight">C. Button Hole Thread :</span>
                                            <p>{{$eTailorObj['obuttonHoleStyleName']}} ({{$eTailorObj['obuttonHoleStyle']}})</p>
                                        </div>
                                    </div>
                                    <div class="et-content-fab" id="miniview-etcontrast-13" style="display:none;" >
                                        <figure class="et-selected-img">
                                            @if($eTailorObj['omonogram']==1)
                                            <img src="{{asset('/storage/none/none.jpg')}}" alt="{{$alt_name}}">
                                            @elseif($eTailorObj['omonogram']==46)
                                            <img src="{{asset('/storage/Shirts/ColorContract/Monogram/MonogramOnWaist/List/'.$eTailorObj['ofabric'].'.jpg')}}" alt="{{$alt_name}}">
                                            <span style="color: {{$eTailorObj['omonogramtextColor']}};position: absolute;top: 0;width: 100%;left: 0;padding: 55px 0px;font-size:12px;font-style:italic;font-family: Mtcorsva;">{{$eTailorObj['omonogramText']}}</span>
                                            @elseif($eTailorObj['omonogram']==47)
                                            <img src="{{asset('/storage/Shirts/ColorContract/Monogram/MonogramOnChest/List/'.$eTailorObj['ofabric'].'.jpg')}}" alt="{{$alt_name}}">
                                            <span style="color: {{$eTailorObj['omonogramtextColor']}};position: absolute;top: 0;width: 100%;left: 0;padding: 75px 0px 35px;font-size:12px;font-style:italic;font-family: Mtcorsva;">{{$eTailorObj['omonogramText']}}</span>
                                            @elseif($eTailorObj['omonogram']==48)
                                            <img src="{{asset('/storage/Shirts/ColorContract/Monogram/MonogramOnPocket/List/'.$eTailorObj['ofabric'].'.jpg')}}" alt="{{$alt_name}}">
                                            <span style="color: {{$eTailorObj['omonogramtextColor']}};position: absolute;top: 11px;width: 100%;left: 0;font-size:12px;font-style:italic;font-family: Mtcorsva;">{{$eTailorObj['omonogramText']}}</span>
                                            @elseif($eTailorObj['omonogram']==49)
                                            <img src="{{asset('/storage/Shirts/ColorContract/Monogram/MonogramOnCuff(Right)/List/'.$eTailorObj['ofabric'].'.jpg')}}" alt="{{$alt_name}}">
                                            <span style="color: {{$eTailorObj['omonogramtextColor']}};position: absolute;top: 55px;width: 100%;left: 0;transform: rotate(65deg);;font-size:12px;font-style:italic;font-family: Mtcorsva;">{{$eTailorObj['omonogramText']}}</span>
                                            @endif
                                        </figure>
                                        <div class="et-style-select">
                                            <h2>Monogram</h2>
                                            <span class="highlight">A. Position :</span>
                                            <p>{{$eTailorObj['omonogramName']}}</p>
                                            <span class="highlight">B. Enter Monogram :</span>
                                            <p></p>
                                            <span class="highlight">C. Monogram Color :</span>
                                            <p>{{$eTailorObj['omonogramHoleName']}} ({{$eTailorObj['omonogramCode']}})</p>
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
                    <!-- STANDARD SIZES -->
                    <div class="pt-choose-right et-main-body-size" id="menu-mesure-standardsize" style="display:none;">
                        <div class="pt-thumb-slider">
                            <div class="et-des-title"><h2>SIZE CHART</h2></div>
                            <div class="et-main-measurement">
                                <form class="et-shirt-measure" role="form" method="POST" >

                                    <div class="et-block no-pad">
                                        <div class="et-block">
                                            <div class="et-setect-fit">
                                                <ul style="display:block;">
                                                    <li><span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></li>
                                                    <li>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="sizetyp" id="sizetyp"
                                                                class="sizetyp" value="cm" <?php if($eTailorObj['osizeType']=="cm"){?>checked<?php } ?>
                                                                onClick="javascript:changeMview(this.value)"><span class="cr"><i class="cr-icon"></i></span>Cm
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="sizetyp" class="sizetyp" id="sizetyp"
                                                                value="inch" <?php if($eTailorObj['osizeType']=="inch"){?>checked<?php } ?>
                                                                onClick="javascript:changeMview(this.value)"><span class="cr"><i class="cr-icon"></i></span>Inch
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php $stdsizelst = App\MeasurmentSize::select('*')->get();?>
                                        <div class="et-block no-pad" id="tble_inch">
                                            <div class="et-standard-chart">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td data-lang="size">Size</td>
                                                            @foreach($stdsizelst as $stdsizee)<td>{{$stdsizee->name}}</td>@endforeach
                                                        </tr>
                                                        <tr>
                                                            <td data-lang="neck">Neck</td>
                                                            @foreach($stdsizelst as $stdsizee)
                                                            <?php $stdneckSize=App\BodyMeasurment::select('*')->where('cat_id','=','1')->where('mer_id','=',$stdsizee->id)->get();?>
                                                            @foreach($stdneckSize as $necksizelst)<td>{{$necksizelst->neck}}</td>@endforeach
                                                            @endforeach
                                                        </tr>
                                                        <tr>
                                                            <td data-lang="chest">Chest</td>
                                                            @foreach($stdsizelst as $stdsizee)
                                                            <?php $stdchestSize=App\BodyMeasurment::select('*')->where('cat_id','=','1')->where('mer_id','=',$stdsizee->id)->get();?>
                                                            @foreach($stdchestSize as $chestsizelst)<td>{{$chestsizelst->chest}}</td>@endforeach
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="et-block no-pad" id="tble_cm" style="display:none;">
                                            <div class="et-standard-chart">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td data-lang="size">Size</td>
                                                            @foreach($stdsizelst as $stdsizee)<td>{{$stdsizee->name}}</td>@endforeach
                                                        </tr>
                                                        <tr>
                                                            <td data-lang="neck">Neck</td>
                                                            @foreach($stdsizelst as $stdsizee)
                                                            <?php $stdneckSize=App\BodyMeasurment::select('*')->where('cat_id','=','1')->where('mer_id','=',$stdsizee->id)->get();?>
                                                            @foreach($stdneckSize as $necksizelst)<td>{{round($necksizelst->neck*2.54)}}</td>@endforeach
                                                            @endforeach
                                                        </tr>
                                                        <tr>
                                                            <td data-lang="chest">Chest</td>
                                                            @foreach($stdsizelst as $stdsizee)
                                                            <?php $stdchestSize=App\BodyMeasurment::select('*')->where('cat_id','=','1')->where('mer_id','=',$stdsizee->id)->get();?>
                                                            @foreach($stdchestSize as $chestsizelst)
                                                            <?php list($f,$l)=explode('-',$chestsizelst->chest);?>
                                                            <td>{{round($f*2.54)}}-{{round($l*2.54)}}</td>
                                                            @endforeach
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="et-setect-fit et-standard" id="stdullst">
                                                <ul>
                                                    <li class="st-m-sli">
                                                        <span class="st-m-sli-cap">Select Your Size :</span>
                                                        <div class="et-btn-group">
                                                            <div class="et-btn-select" id="dvsizeoption">
                                                                <?php $sizelst = App\MeasurmentSize::select('*')->get();?>
                                                                <select class="selectpicker btn-primary selsize" id="selsize" name="selsize[]">
                                                                    @foreach($sizelst as $sizee)
                                                                    @if($eTailorObj['osizeFit']==$sizee->name)<option value="{{$sizee->name}}" selected>{{$sizee->name}}</option>@else<option value="{{$sizee->name}}">{{$sizee->name}}</option>@endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @if($eTailorObj['ocartID']=="")
                                                    <li class="st-m-sli">
                                                        <span class="st-m-sli-cap">Quantity :</span>
                                                        <div class="et-btn-group">
                                                            <div class="et-btn-select" id="dvqtyoption">
                                                                <select class="selectpicker btn-primary selstdqty" id="selstdqty" name="selstdqty[]">
                                                                    @for($i=1;$i<=100;$i++)
                                                                    @if($eTailorObj['oqty']==$i)<option value="{{$i}}" selected>{{$i}}</option>@else<option value="{{$i}}" >{{$i}}</option>@endif
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li style="margin:15px;"><a href="#" class="et-black-btn" onClick="javascript:addMoreSize();">Add Other Sizes</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        <div class="et-block et-form-btn">
                                            <a href="#" onClick="javascript:showMeasureSect('main');" class="et-blk-brn blue">Back</a>
                                                <input type="hidden" name="setarr" id="setarr" value="">
                                            <input type="hidden" name="frntviewfinal" id="frntviewfinal">
                                            <input type="hidden" name="bkviewfinal" id="bkviewfinal">
                                            <input type="hidden" name="mpattern" value="Standard" id="mpattern">
                                            <input type="hidden" name="tocken" id="tocken" value="{{csrf_token() }}">
                                            <input type="hidden" name="rndvalue" id="rndvalue" value="<?php echo rand(100000, 999999);?>">
                                            <div id="et-smallr"  class="et-cart-brn" style="display:none; width:80px"><img src="{{URL::asset('asset/img/page-loader.gif')}}"></div>
                                            <button type="sumbit" class="et-cart-brn" id="stand">Add To Cart</button>
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
                                <form class="et-shirt-measure" role="form" method="POST"  onSubmit="javascript:return validatebodyform();">
                                    <div class="et-block">
                                        <div class="et-measure-image"><figure><img src="{{asset('/storage/Measurment/Shirts/neck/neck.jpg')}}" alt=""></figure></div>
                                        <div class="et-measure-video"><video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="{{asset('/storage/Measurment/Shirts/neck/neck.ogv')}}" type="video/ogg"><source src="{{asset('/storage/Measurment/Shirts/neck/neck.mp4')}}" type="video/mp4"><object data="{{asset('/storage/Measurment/Shirts/neck/neck.swf')}}" type="application/x-shockwave-flash" width="300" height="220"></object><source src="{{asset('/storage/Measurment/Shirts/neck/neck.webm')}}" type="video/webm"></video></div>
                                    </div>
                                    <div class="et-block no-pad">
                                        <div class="et-subhead">
                                            <span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
                                            <span>Enter your measurements in the corresponding boxes : <span id="fldtitle">Neck</span> generally range from <b><span id="rngfrom">9</span></b> to <b><span id="rngto">23</span></b> <span id="mtyp">inch</span></span>
                                        </div>
                                        <div class="et-type-Input">
                                            <div class="et-input">
                                                <span>NECK</span>
                                                <?php $measurenecklst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',1)->get();?>
                                                @foreach($measurenecklst as $mnecklst)
                                                <input onkeyup="submitCheck('neck',this.value);" type="text" data-title="{{$mnecklst->from_range}}-{{$mnecklst->to_range}}" name="bsizeNeck" id="bsizeNeck" style="border-color:#F30;" onFocus="javascript:showRanges('{{$mnecklst->bodysize_type}}',{{$mnecklst->from_range}},{{$mnecklst->to_range}},'neck');" onBlur="javascript:validateField(this.id,{{$mnecklst->from_range}},{{$mnecklst->to_range}});" value="<?php echo $eTailorObj['osizeNeck'];?>"  >
                                                @endforeach
                                            </div>
                                            <div class="et-input">
                                                <span>CHEST</span>
                                                <?php $measurechestlst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',2)->get();?>
                                                @foreach($measurechestlst as $mchestlst)
                                                <input onkeyup="submitCheck('chest',this.value);" type="text" data-title="{{$mchestlst->from_range}}-{{$mchestlst->to_range}}" name="bsizeChest" id="bsizeChest" onFocus="javascript:showRanges('{{$mchestlst->bodysize_type}}',{{$mchestlst->from_range}},{{$mchestlst->to_range}},'chest');" onBlur="javascript:validateField(this.id,{{$mchestlst->from_range}},{{$mchestlst->to_range}});" value="<?php echo $eTailorObj['osizeChest'];?>"  >
                                                @endforeach
                                            </div>
                                            <div class="et-input">
                                                <span>WAIST</span>
                                                <?php $measurewaistlst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',3)->get();?>
                                                @foreach($measurewaistlst as $mwaistlst)
                                                <input onkeyup="submitCheck('wasit',this.value);" type="text" data-title="{{$mwaistlst->from_range}}-{{$mwaistlst->to_range}}" name="bsizeWaist" id="bsizeWaist" onFocus="javascript:showRanges('{{$mwaistlst->bodysize_type}}',{{$mwaistlst->from_range}},{{$mwaistlst->to_range}},'waist');" onBlur="javascript:validateField(this.id,{{$mwaistlst->from_range}},{{$mwaistlst->to_range}});" value="<?php echo $eTailorObj['osizeWaist'];?>" >
                                                @endforeach
                                            </div>
                                            <div class="et-input">
                                                <span>HIP</span>
                                                <?php $measurehiplst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',4)->get();?>
                                                @foreach($measurehiplst as $mhiplst)
                                                <input onkeyup="submitCheck('hip',this.value);" type="text" data-title="{{$mhiplst->from_range}}-{{$mhiplst->to_range}}" name="bsizeHip" id="bsizeHip" onFocus="javascript:showRanges('{{$mhiplst->bodysize_type}}',{{$mhiplst->from_range}},{{$mhiplst->to_range}},'hip');" onBlur="javascript:validateField(this.id,{{$mhiplst->from_range}},{{$mhiplst->to_range}});" value="<?php echo $eTailorObj['osizeHip'];?>" >
                                                @endforeach
                                            </div>
                                            <div class="et-input">
                                                <span>LENGTH</span>
                                                <?php $measurelengthlst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',5)->get();?>
                                                @foreach($measurelengthlst as $mlengthlst)
                                                <input onkeyup="submitCheck('lentgh',this.value);" type="text" data-title="{{$mlengthlst->from_range}}-{{$mlengthlst->to_range}}" name="bsizeLength" id="bsizeLength" onFocus="javascript:showRanges('{{$mlengthlst->bodysize_type}}',{{$mlengthlst->from_range}},{{$mlengthlst->to_range}},'length');" onBlur="javascript:validateField(this.id,{{$mlengthlst->from_range}},{{$mlengthlst->to_range}});" value="<?php echo $eTailorObj['osizeLength'];?>" >
                                                @endforeach
                                            </div>
                                            <div class="et-input">
                                                <span>SHOULDER</span>
                                                <?php $measureshoulderlst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',6)->get();?>
                                                @foreach($measureshoulderlst as $mshoulderlst)
                                                <input onkeyup="submitCheck('shoulder',this.value);" type="text" data-title="{{$mshoulderlst->from_range}}-{{$mshoulderlst->to_range}}" name="bsizeShoulder" id="bsizeShoulder" onFocus="javascript:showRanges('{{$mshoulderlst->bodysize_type}}',{{$mshoulderlst->from_range}},{{$mshoulderlst->to_range}},'shoulder');" onBlur="javascript:validateField(this.id,{{$mshoulderlst->from_range}},{{$mshoulderlst->to_range}});" value="<?php echo $eTailorObj['osizeShoulder'];?>" >
                                                @endforeach
                                            </div>
                                            <div class="et-input" id="bdymsleeve">
                                                <span>SLEEVE</span>
                                                @if($eTailorObj['osleeve']==3)
                                                <?php $measureshortsleevelst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',8)->get();?>
                                                @foreach($measureshortsleevelst as $mshrtslevlst)
                                                <input onkeyup="submitCheck('sleev',this.value);" type="text" data-title="{{$mshrtslevlst->from_range}}-{{$mshrtslevlst->to_range}}" name="bsizeSleeve" id="bsizeSleeve" onFocus="javascript:showRanges('{{$mshrtslevlst->bodysize_type}}',{{$mshrtslevlst->from_range}},{{$mshrtslevlst->to_range}},'shortsleeve');" onBlur="javascript:validateField(this.id,{{$mshrtslevlst->from_range}},{{$mshrtslevlst->to_range}});" value="<?php echo $eTailorObj['osizeSleeve'];?>" >
                                                @endforeach
                                                @else
                                                <?php $measuresleevelst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',7)->get();?>
                                                @foreach($measuresleevelst as $msleevlst)
                                                <input onkeyup="submitCheck('sleev',this.value);" type="text" data-title="{{$msleevlst->from_range}}-{{$msleevlst->to_range}}" name="bsizeSleeve" id="bsizeSleeve" onFocus="javascript:showRanges('{{$msleevlst->bodysize_type}}',{{$msleevlst->from_range}},{{$msleevlst->to_range}},'sleeve');" onBlur="javascript:validateField(this.id,{{$msleevlst->from_range}},{{$msleevlst->to_range}});" value="<?php echo $eTailorObj['osizeSleeve'];?>" >
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="et-radio-check">
                                                <div class="radio"><label><input type="radio" name="bsizetyp" id="bsizetyp" class="bsizetyp" value="cm" <?php if($eTailorObj['osizeType']=="cm"){?>checked<?php } ?>><span class="cr"><i class="cr-icon"></i></span>Cm</label></div>
                                                <div class="radio"><label><input type="radio" name="bsizetyp" id="bsizetyp" class="bsizetyp"  value="inch" <?php if($eTailorObj['osizeType']=="inch"){?>checked<?php } ?> ><span class="cr"><i class="cr-icon"></i></span>Inch</label></div>
                                            </div>
                                        </div>
                                        <div class="et-block">
                                            <div class="et-setect-fit">
                                                <ul><li><span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span><span>Select Your Size :</span></li><li><div class="radio"><label><input type="radio" name="fitstyle" class="fitstyle" id="fitstyle" value="Comfortable" <?php if($eTailorObj['osizeStyle']=="Comfortable"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Signature Standard Fit</label></div></li><li><div class="radio"><label><input type="radio" id="fitstyle" class="fitstyle" name="fitstyle" value="Slim" <?php if($eTailorObj['osizeStyle']=="Slim"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Euro Slim Fit</label></div></li></ul>
                                            </div>
                                        </div>
                                        <div class="et-block et-form-btn">
                                            <a href="#" onClick="javascript:showMeasureSect('main');" class="et-blk-brn blue">Back</a>
                                            <input type="hidden" name="setarr" id="setarr" class="bsetarr" value="">
                                            <input type="hidden" name="frntviewfinal" id="frntviewfinal" class="bfrntviewfinal">
                                            <input type="hidden" name="bkviewfinal" id="bkviewfinal"  class="bbkviewfinal">
                                            <input type="hidden" name="tocken" id="tocken" value="{{csrf_token() }}">
                                            <input type="hidden" name="mpattern" value="Body"  id="bmpattern">
                                            <input type="hidden" name="rndvalue" id="brndvalue" value="<?php echo rand(100000, 999999);?>">
                                            <div id="et-body"  class="et-cart-brn" style="display:none; width:80px"><img src="{{URL::asset('asset/img/page-loader.gif')}}"></div>

                                            <div class="et-btn-group">
                                                @if($eTailorObj['ocartID']=="")
                                                <span>Quantity :</span>
                                                <div class="et-btn-select">
                                                    <select class="selectpicker btn-primary" id="selbodyqty" name="selbodyqty">
                                                        @for($i=1;$i<=100;$i++)
                                                        @if($eTailorObj['oqty']==$i)<option value="{{$i}}" selected>{{$i}}</option>@else<option value="{{$i}}" >{{$i}}</option>@endif
                                                        @endfor
                                                    </select>
                                                </div>
                                                @endif
                                            </div>

                                            <button type="sumbit" class="et-cart-brn" id="body">Add To Cart</button>
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
<canvas id="frontcanvas" width="340" height="417" style="display:none"></canvas>
<canvas id="backcanvas" width="340" height="417" style="display:none"></canvas>
<canvas id="sidecanvas" width="340" height="417" style="display:none"></canvas>
<input type="hidden" name="sview" id="sview" value="open">
<!-- ======================================================= -->
</body>
<!-- =================== script ============================ -->
<script type="text/javascript" src="{{asset('demo/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/float-panel.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/responsive_bootstrap_carousel.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/bootstrap-touch-slider.js')}}"></script>
<script type="text/javascript">var url = "{{asset('/storage/')}}";</script>
<script type="text/javascript" src="{{asset('demo/js/fabric.min.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/mobileshirt.js?v0')}}"></script>

<script type="text/javascript">
$( '#et-banner' ).bsTouchSlider();
</script>

<script type="text/javascript">
function hideTabContent(){
    $('#tab-content').hide();
    // $('#tab-content').slideUp();
}
// page init ------------------------------
$(document).ready(function(){
    setTimeout(function(){
        $("#shirt-back").attr("src", "https://user-images.githubusercontent.com/51516043/143732878-4c702976-8529-4d20-866a-f20d29a8f898.png");
    }, 2000);
})

$(document).ready(function(e){
    var stid="menu-"+$('#tabSActiveId').val();
    var stab=$('#tabSActiveId').val();
    var newarr=$('#harr').val();
    // getTabSect($('#tabActiveId').val());
    getPgOption(stid,$('#tabActiveId').val(),$('#tabSActiveId').val(),'');
    designOpenProcessing(JSON.parse(newarr));
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
    var setarr = $('#setarr').val();
    // var frntviewfinal = $('#frntviewfinal').val();
    // var bkviewfinal = $('#bkviewfinal').val();
    var mpattern = $('#mpattern').val();
    var sizetyp = $('.sizetyp:checked').val();
    var rndvalue = $('#rndvalue').val();

    var selsize = [];
    $('.selsize').each(function(index,val){
    selsize[index] = $(this).val();
    })

    var selstdqty = [];
    $('.selstdqty').each(function(index,val){
    selstdqty[index] = $(this).val();
    })

    if (rndvalue!='') {
        $.ajax({
            type:'POST',
            url:'/designshirts/postcart',
            data:{setarr:setarr,mpattern:mpattern,selstdqty:selstdqty,selsize:selsize,sizetyp:sizetyp,rndvalue:rndvalue,},
            beforeSend: function() {
                $("#et-smallr").show();
                $("#stand").hide();
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                $("#msg").html(data.msg);
                window.location.href = "/cart";
            }
        });
    }
    return false;
});
</script>

<script type="text/javascript">
$("#body").click(function(){
    var bsizeNeck = $('#bsizeNeck').val();
    var bsizeChest = $('#bsizeChest').val();
    var bsizeWaist = $('#bsizeWaist').val();
    var bsizeHip = $('#bsizeHip').val();
    var bsizeLength = $('#bsizeLength').val();
    var bsizeShoulder = $('#bsizeShoulder').val();
    var bsizeSleeve = $('#bsizeSleeve').val();
    var bsizeSleeve = $('#bsizeSleeve').val();
    var bsizetyp = $('.bsizetyp:checked').val();
    var fitstyle = $('.fitstyle:checked').val();
    var setarr = $('.bsetarr').val();
    //  var frntviewfinal = $('.bfrntviewfinal').val();
    //  var bkviewfinal = $('.bbkviewfinal').val();
    var mpattern = $('#bmpattern').val();
    var selbodyqty = $('#selbodyqty').val();
    var rndvalue = $('#brndvalue').val();

    if (rndvalue!='') {
        $.ajax({
            type:'POST',
            url:'/designshirts/postcart',
            data:{
                bsizeNeck:bsizeNeck,
                bsizeChest:bsizeChest,
                bsizeWaist:bsizeWaist,
                bsizeHip:bsizeHip,
                bsizeLength:bsizeLength,
                bsizeShoulder:bsizeShoulder,
                bsizeSleeve:bsizeSleeve,
                bsizetyp:bsizetyp,
                fitstyle:fitstyle,
                setarr:setarr,
                mpattern:mpattern,
                selbodyqty:selbodyqty,
                rndvalue:rndvalue,
            },
            beforeSend: function() {
                $("#et-body").show();
                $("#body").hide();
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){

                $("#msg").html(data.msg);
                window.location.href = "/cart";
            }
        });
    }
    return false;
});
</script>
</html>
