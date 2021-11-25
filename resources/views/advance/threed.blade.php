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
<title>eTailor || Custom Mens Suits & Online Tailor</title>
<meta name="description" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Favicon
============================================ -->
<link rel="shortcut icon" type="image/x-icon" href="{{asset('asset/img/favicon.ico')}}">
<!-- CSS
============================================ -->
<link rel="stylesheet" type="text/css" href="{{asset('advance/css/style.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{asset('advance/css/bootstrap.min.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{asset('advance/css/font-awesome.min.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('advance/css/bootstrap-touch-slider.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('advance/css/responsive_bootstrap_carousel_mega_min.css')}}" media="screen">
<script type="text/javascript" src="{{asset('advance/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('advance/js/jquery-1.11.3.min.js')}}"></script>
<!-- Loader -->
<script type="text/javascript" src="{{asset('advance/js/jquery.DEPreLoad.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {var l=$("#loadme").val();if(l==0){setTimeout(function(){$("#depreload .wrapper").animate({ opacity: 1 });}, 40);setTimeout(function(){$("#depreload .logo").animate({ opacity: 1 });}, 600);var canvas  = $("#depreload .line")[0],context = canvas.getContext("2d");context.beginPath();context.arc(280, 280, 260, Math.PI * 1.5, Math.PI * 1.6);context.strokeStyle = '#9e792b';context.lineWidth = 5;context.stroke();var loader = $("html").DEPreLoad({OnStep: function(percent) {console.log(percent + '%');$("#depreload .line").animate({ opacity: 1 });$("#depreload .perc").text(percent + "%");if (percent > 5) {context.clearRect(0, 0, canvas.width, canvas.height);context.beginPath();context.arc(280, 280, 260, Math.PI * 1.5, Math.PI * (1.5 + percent / 50), false);context.stroke();}},OnComplete: function() {console.log('Everything loaded!');$("#depreload").hide(100);$("#depreload .perc").text("done");$("#depreload .loading").animate({ opacity: 0 });}});}});
</script>
<!-- Loader Ends -->
</head>
<body class="designshirt">
<?php $myArray=$eTailorObj;?>
<input type="hidden" name="loadme" id="loadme" value="<?php echo $activeload = isset($loadme) ? $loadme : '0'; ?>">
<input type="hidden" name="tabActiveId" id="tabActiveId" value="<?php echo $activeTab = isset($mytab) ? $mytab : 'etfabric'; ?>">
<input type="hidden" name="tabSActiveId" id="tabSActiveId" value="<?php echo $activeSubTab = isset($mysubtab) ? $mysubtab : 'fabric1'; ?>">
<input type="hidden" name="harr" id="harr" value="<?php echo htmlspecialchars(json_encode($myArray)); ?>">
<input type="hidden" name="sview" id="sview" value="open">
@if($loadme==0)
<div id="depreload" style="background-image:url({{asset('advance/img/product/bg.jpg')}});" class="table et-loader">
    <div class="table-cell wrapper">
        <div class="circle">
            <canvas class="line" width="560px" height="560px"></canvas>
            <img src="{{asset('advance/img/logo.png')}}" class="logo" alt="{{$alt_name}}" />
            <p class="perc"></p>
        	<p class="loading">Loading</p>
        </div>
    </div>
</div>
@endif
<section class="pt-bg">
	<!-- TOP LINKS -->
  	<div class="container">
		<div class="row">
       		<div class="pt-top-menu">
        		<div class="pt-left-p">
                    <ul>
                        <li><a href="javascript:void(0);">PRODUCT</a></li>
                        <li>|</li>
                        <li><a href="javascript:void(0);">MENU</a></li>
                        <li>|</li>
                        <li><a href="javascript:void(0);">COLLECTION</a></li>
                    </ul>
    			</div>
        		<div class="pt-right-p">
                   <ul>
                        @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">MY ACCOUNT</a></li>
                        <li>|</li>
                        <li><a href="{{ url('/login') }}">LOGIN </a></li>
                        @else
                        <li><a href="{{ url('/myaccount') }}">MY ACCOUNT</a></li>
                        <li>|</li>
                        <li><a  href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
    	</div>
  	</div>
    <!-- DESIGN AREA -->
  	<div class="pt-design" id="sect-design">
    	<!-- Container Start -->
        <div class="container">
            <!-- TABS START -->
            <div class="row">
                <div class="pt-tab">
                    <div class="card">
                    	<div class="et-advance-content">
                        	<div class="pt-variation-main">
                            	<h3>Start Here!</h3>
                                <div class="pt-variation">
                                    @foreach($group_record as $gr)
                                    <div id="menu-fabric{{$gr->id}}" class="pt-box-square <?php if($gr->id == $eTailorObj['ofabricType']) {?>active<?php } ?>" onClick="javascript:getPgOption(this.id);showfabtab();">
                                        <p>{{$gr->fbgrp_name}}</p>
                                        <p>{{number_format($gr->fabric_rate,2)}}$</P>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Tabs End -->
                            <div class="pt-customize">
                                <div class="pt-men">
                                    <!-- Main Preview -->
                                    <div class="pt-men-left">
                                    	<div class="et-advance-editor">
                                            <div class="pt-image-div" id="main-front">@include('advance.process')
                                                <img src="{{asset('advance/img/product/pt-shirt-front-open.png')}}"/>
                                            </div>
                                            <div class="pt-image-div" id="main-back" style="display:none;">@include('advance.process')
                                                <img src="{{asset('advance/img/product/pt-shirts-back.png')}}"/>
                                            </div>
                                            <!-- Menus -->
                                            <div id="selmenus">
                                                <div class="ad-option-1 et-advance-options" id="fabric" onClick="javascript:showMenu(this.id);">
                                                    <div class="et-option-inner">
                                                        <div class="et-icon-check"></div>
                                                        <span class="et-process-number">1. </span>
                                                        <span class="et-style-name" data-lang="fabric">Fabric</span>
                                                        <div class="et-line"></div>
                                                    </div>
                                                </div>
                                                <div class="ad-option-2 et-advance-options" id="collers" onClick="javascript:showMenu(this.id);">
                                                    <div class="et-option-inner">
                                                        <div class="et-icon-check"></div>
                                                        <span class="et-process-number">2. </span>
                                                        <span class="et-style-name" data-lang="collar">Collar</span>
                                                        <div class="et-line"></div>
                                                    </div>
                                                </div>
                                                <div class="ad-option-3 et-advance-options" id="sleeves" onClick="javascript:showMenu(this.id);">
                                                    <div class="et-option-inner">
                                                        <div class="et-icon-check"></div>
                                                        <span class="et-process-number">3. </span>
                                                        <span class="et-style-name" data-lang="sleeve">Sleeve</span>
                                                        <div class="et-line"></div>
                                                    </div>
                                                </div>
                                                <div class="ad-option-4 et-advance-options et-oc" id="fronts" onClick="javascript:showMenu(this.id);">
                                                    <div class="et-option-inner">
                                                        <div class="et-icon-check"></div>
                                                        <span class="et-process-number">4. </span>
                                                        <span class="et-style-name" data-lang="front">Front</span>
                                                        <div class="et-line"></div>
                                                    </div>
                                                </div>
                                                <div class="ad-option-5 et-advance-options" id="cuffs" onClick="javascript:showMenu(this.id);">
                                                    <div class="et-option-inner">
                                                        <div class="et-icon-check"></div>
                                                        <span class="et-process-number">5. </span>
                                                        <span class="et-style-name" data-lang="cuffs">Cuffs</span>
                                                        <div class="et-line"></div>
                                                    </div>
                                                </div>
                                                <div class="ad-option-6 et-advance-options et-oc" id="bottms" onClick="javascript:showMenu(this.id);">
                                                    <div class="et-option-inner">
                                                        <div class="et-icon-check"></div>
                                                        <span class="et-process-number">6. </span>
                                                        <span class="et-style-name" data-lang="bottom">Bottom</span>
                                                        <div class="et-line"></div>
                                                    </div>
                                                </div>
                                                <div class="ad-option-7 et-advance-options" id="backs" onClick="javascript:showMenu(this.id);">
                                                    <div class="et-option-inner">
                                                        <div class="et-icon-check"></div>
                                                        <span class="et-process-number">7. </span>
                                                        <span class="et-style-name" data-lang="back">Back Detail</span>
                                                        <div class="et-line"></div>
                                                    </div>
                                                </div>
                                                <div class="ad-option-8 et-advance-options et-oc" id="pockts" onClick="javascript:showMenu(this.id);">
                                                    <div class="et-option-inner">
                                                        <div class="et-icon-check"></div>
                                                        <span class="et-process-number">8. </span>
                                                        <span class="et-style-name" data-lang="pockets">Pockets</span>
                                                        <div class="et-line"></div>
                                                    </div>
                                                </div>
                                                <div class="ad-option-9 et-advance-options et-oc" id="buttns" onClick="javascript:showMenu(this.id);">
                                                    <div class="et-option-inner">
                                                        <div class="et-icon-check"></div>
                                                        <span class="et-process-number">9. </span>
                                                        <span class="et-style-name" data-lang="buttons">Buttons</span>
                                                        <div class="et-line"></div>
                                                    </div>
                                                </div>
                                                <div class="ad-option-10 et-advance-options et-oc" id="monogrms" onClick="javascript:showMenu(this.id);">
                                                    <div class="et-option-inner">
                                                        <div class="et-icon-check"></div>
                                                        <span class="et-process-number">10. </span>
                                                        <span class="et-style-name" data-lang="monogram">Monogram</span>
                                                        <div class="et-line"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Menus Ends -->
                                        </div>
                                        <!-- All Details Pop-ups -->
                                        <div class="et-advance-modals">
                                            <!-- Fabric modal Start -->
                                            <div class="et-modal-content et-for-fabric">
                                                <div class="et-modal-header">
                                                    <h3>Choose Your Fabric</h3>
                                                    <span class="ad-option-1 et-oc" onClick="javascript:hideMenu();"><img src="{{asset('advance/img/CloesButton.png')}}"/></span>
                                                </div>
                                                <!-- Fabric of the Week -->
                                                @foreach($group_record as $gr)
                                                <div class="et-carousel" id="menu-opt-fabric{{$gr->id}}" <?php if($gr->id == $eTailorObj['ofabricType']) {?>style="display:block;"<?php } else {?>style="display:none;"<?php } ?> >
                                                    <div id="est-item-fabric{{$gr->id}}" class="carousel slide  gp_products_carousel_wrapper st-chose-fabric" data-ride="carousel" data-interval="false">
                                                        <div class="carousel-inner" role="listbox">
                                                            <div class="item active">
                                                                <ul class="et-item-list">
                                                                    <?php $ci=1; $fabriclst = App\Etfabric::select('*')->where('fbgrp_id','=',$gr->id)->get();?>
                                                                    @foreach($fabriclst as $fablst)
                                                                    <?php if($ci==15){?></ul></div><div class="item"><ul class="et-item-list"><?php  $ci=1;}?>
                                                                    <li class="et-item" id="optionlist-fabric{{$gr->id}}-{{$fablst->id}}" title="{{ $fablst->fabric_name }}" data-title="{{ $fablst->fabric_name }}" onClick="javascript:getfab({{$fablst->id}});">
                                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$fablst->fabric_img_s)}}" alt="{{$alt_name}}"></figure>
                                                                        @if($fablst->id==$eTailorObj['ofabric']) <div class="icon-check"></div> @endif
                                                                    </li>
                                                                    <?php $ci++;?>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--======= Navigation Buttons =========-->
                                                        <!--======= Left Button =========-->
                                                        <a class="left carousel-control gp_products_carousel_control_left" href="#est-item-fabric{{$gr->id}}" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('advance/img/ar-left.png')}}"></span><span class="sr-only">Previous</span></a>
                                                        <!--======= Right Button =========-->
                                                        <a class="right carousel-control gp_products_carousel_control_right" href="#est-item-fabric{{$gr->id}}" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('advance/img/ar-right.png')}}"></span><span class="sr-only">Next</span></a>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="et-bottom-wrp">
                                                    <div class="pt-variation">
                                                        @foreach($group_record as $gr)
                                                        <div id="menu-fabric{{$gr->id}}" class="pt-box-square <?php if($gr->id == $eTailorObj['ofabricType']) {?>active<?php } ?>" onClick="javascript:getPgOption(this.id);">
                                                            <p>{{$gr->fbgrp_name}}</p>
                                                            <p>{{number_format($gr->fabric_rate,2)}}$</P>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="et-bottom-wrp">
                                                    <div class="pt-box-square ad-option-2">
                                                        <p>All Fabric</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fabric modal End -->
                                            <!-- All Fabric modal Start -->
                                            <div class="et-modal-content et-all-fabric" id="option-allfabrics">
                                                <!-- All Type of Fabric  -->
                                                <div class="et-full-modal">
                                                    <div class="et-modal-header">
                                                        <h3>All Shirt Fabrics</h3>
                                                        <div class="et-modal-listem">
                                                            <ul>
                                                                <li class="et-yellow">Search :</li>
                                                                <li>
                                                                    <div class="et-btn-group">
                                                                        <div class="et-btn-select">
                                                                            <select class="selectpicker btn-primary" name="allfabtxt" id="allfabtxt" onChange="javascript:getallfabricslist(this.value);">
                                                                                <option value="0">Fabric All</option>
                                                                                <?php $cntv=0; ?>
                                                                                @foreach($group_record as $grall)
                                                                                <?php $fabricalllst = App\Etfabric::select('*')->where('fbgrp_id','=',$grall->id)->get(); $cntv=$cntv-(-count($fabricalllst))?>
                                                                                <option value="{{$grall->id}}">{{$grall->fbgrp_name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="et-blue" id="totfab">Total : <?php echo $cntv;?> Fabric</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="et-fabric-view">
                                                        <div class="et-selected-fabric et-fw">
                                                            <figure class="choosen-fabric st-fabric-img-group" id="cpreview">
                                                                <img src="{{asset('/storage/Shirts/Fabric/C/'.$eTailorObj['ofabric'].'.png')}}" alt=""/>
                                                                @if($eTailorObj['ocollarCuffIn']=="true")
                                                                <img class="st-fabric-img-abs" src="{{asset('/storage/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObj['ocontrast'].'.png')}}" >
                                                                @endif
                                                            	@if($eTailorObj['ocollarCuffout']=="true")
                                                                <img  class="st-fabric-img-abs" src="{{asset('/storage/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObj['ocontrast'].'.png')}}">
                                                               	@endif
                                                            	@if($eTailorObj['ofrontPlacketIn']=="true")
                                                                <img class="st-fabric-img-abs" src="{{asset('/storage/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObj['ocontrast'].'.png')}}">
                                                                @endif
                                                            	@if($eTailorObj['ofrontPlacketOut']=="true")
                                                                <img class="st-fabric-img-abs" src="{{asset('/storage/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObj['ocontrast'].'.png')}}">
                                                                @endif
                                                            	@if($eTailorObj['ofrontBoxOut']=="true")
                                                                <img class="st-fabric-img-abs" src="{{asset('/storage/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObj['ocontrast'].'.png')}}">
                                                               	@endif
                                                            	@if($eTailorObj['ofront']==4)
                                                                <img class="st-fabric-img-abs" src="{{asset('/storage/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                                                <img class="st-fabric-img-abs" src="{{asset('/storage/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObj['obutton'].'.png')}}">
                                                                @elseif($eTailorObj['ofront']==5)
                                                                <img class="st-fabric-img-abs" src="{{asset('/storage/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObj['obuttonHole'].'.png')}}">
                                                                <img class="st-fabric-img-abs" src="{{asset('/storage/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObj['obutton'].'.png')}}">
                                                               	@endif
                                                            </figure>
                                                        </div>
                                                        <div class="btn-wrp et-fw">
                                                        	<input type="hidden" id="allfabh" value="{{$eTailorObj['ofabric']}}">
                                                            <input type="hidden" id="allfabch" value="{{$eTailorObj['ofabric']}}">
                                                            <button type="button" class="btn adv-button" onClick="javascript:getCfabric();">Choose</button>
                                                            <button type="button" class="btn adv-button" onClick="javascript:getExit();">EXIT</button>
                                                        </div>
                                                    </div>
                                                    <div class="et-custom-scrollbar">
                                                        <ul class="et-item-list">
                                                        	@foreach($group_record as $grall)
                                                            <?php $fabricalllst = App\Etfabric::select('*')->where('fbgrp_id','=',$grall->id)->get();?>
                                                            @foreach($fabricalllst as $faballlst)
                                                            <li class="et-item" id="optionlist-fabric-all{{$faballlst->id}}" onClick="javascript:showCPreview('{{ $faballlst->id }}')">
                                                                <figure class="et-item-img">
                                                                    <img src="{{asset('/storage/'.$faballlst->fabric_img_s)}}" alt="{{$alt_name}}">
                                                                </figure>
                                                                @if($faballlst->id==$eTailorObj['ofabric']) <div class="icon-check"></div> @endif
                                                            </li>
                                                            @endforeach
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- All Fabric modal End -->
                                            <!-- Coller Modal Start -->
                                            <div class="et-modal-content et-coller-fabric" id="colr1">
                                                <div class="et-modal-header">
                                                    <h4>Choose your Collar Style</h4>
                                                    <span class="ad-option-collar et-oc" onClick="hidediv('et-coller-fabric');"><img src="{{asset('advance/img/CloesButton.png')}}"/></span>
                                                </div>
                                                <div class="et-carousel">
                                                    <div id="est-item-8" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false">
                                                        <div class="carousel-inner" role="listbox">
                                                            <div class="item active">
                                                                <ul class="et-item-list">
                                                                    <?php $stylolrci=1; $stylecolrlst = App\AttributeStyle::select('*')->where('attri_id','=',8)->get();?>
                                                                    @foreach($stylecolrlst as $stylcolrlst)
                                                                    <?php if($stylolrci==8){?></ul></div><div class="item"><ul class="et-item-list"><?php  $stylolrci=1;}?>
                                                                    <li class="et-item" id="optionlist-8-{{$stylcolrlst->id}}" data-title="{{$stylcolrlst->style_name}}" title="{{$stylcolrlst->style_name}}" onClick="javascript:getstycollars({{$stylcolrlst->id}});">
                                                                    	<?php $stylecolrimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylcolrlst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                                        @foreach($stylecolrimglst as $colrls)
                                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$colrls->list_img)}}" alt="{{$alt_name}}">
                                                                        <?php $thrdimglst = App\ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcolrlst->id)->where('attri_id' , '=' , $stylcolrlst->attri_id)->where('thrd_id' , '=' , $eTailorObj['obuttonHole'])->get();?>
                                                                        @foreach($thrdimglst as $thrdls)
                                                                        <img src="{{asset('/storage/'.$thrdls->thrd_list_img)}}" alt="{{$alt_name}}">
                                                                        @endforeach
                                                                        <?php $buttimglst = App\ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcolrlst->id)->where('attri_id' , '=' , $stylcolrlst->attri_id)->where('but_id' , '=' , $eTailorObj['obutton'])->get();?>
                                                                        @foreach($buttimglst as $buttls)
                                                                        <img src="{{asset('/storage/'.$buttls->button_list_img)}}" alt="{{$alt_name}}">
                                                                        @endforeach
                                                                        </figure>
                                                                        @endforeach
                                                                        @if($stylcolrlst->id==$eTailorObj['ocollar']) <div class="icon-check"></div> @endif
                                                                    </li>
                                                                    <?php $stylolrci++;?>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <a class="left carousel-control gp_products_carousel_control_left" href="#est-item-8" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('advance/img/ar-left.png')}}"></span><span class="sr-only">Previous</span></a>
                                                        <a class="right carousel-control gp_products_carousel_control_right" href="#est-item-8" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('advance/img/ar-right.png')}}"></span><span class="sr-only">Next</span></a>
                                                    </div>
                                                </div>
                                                <div class="et-bottom-wrp et-pro-wrp">
                                                    <button type="button" class="btn pull-left et-skip" onClick="hidediv('et-coller-fabric');">Skip</button>
                                                    <button type="button" class="btn pull-right et-done" onClick="javascript:goNextColr();">Next</button>
                                                </div>
                                            </div>
                                            <div class="et-modal-content et-coller-fabric" id="colr2" style="display:none;">
                                                <div class="et-modal-header">
                                                    <h4>More Collar Detail</h4>
                                                    <span class="ad-option-collar et-oc" onClick="hidediv('et-coller-fabric');"><img src="{{asset('advance/img/CloesButton.png')}}"/></span>
                                                </div>
                                                <div class="et-modal-colum-2">
                                                    <div class="preview-box">
                                                        <figure class="ad-selected-item" id="collarpreview">
                                                            <img src="{{asset('advance/img/product/pt-shirt-front-open.png')}}">
                                                        </figure>
                                                    </div>
                                                    <div class="et-options-more">
                                                        <div class="et-check-box">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="colloutertxt" id="colloutertxt" value="true" <?php if($eTailorObj['ocollarCuffout']=="true"){?>checked<?php } ?> onClick="javascript:getcollrcuffcontrast({{$eTailorObj['ocollarCuffout']}},'CollarCuffOut');">
                                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Outside Contrast
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="collinnertxt" id="collinnertxt" value="true" <?php if($eTailorObj['ocollarCuffIn']=="true"){?>checked<?php } ?> onClick="javascript:getcollrcuffcontrast({{$eTailorObj['ocollarCuffIn']}},'CollarCuffIn');" >
                                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Inside Contrast
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" <?php if($eTailorObj['ocollarStay']=="true"){?>checked<?php } ?>  onClick="javascript:getcollrcuffcontrast({{$eTailorObj['ocollarStay']}},'CollarStay');">
                                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Stay
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="et-sm-carousel">
                                                            <h5>Contrast fabrics Selection :</h5>
                                                            <div class="et-contrast-list">
                                                                <ul class="et-item-list">
                                                                	<?php $contfablst = App\Contrast::select('*')->where('cat_id','=',1)->get(); ?>
																	@foreach($contfablst as $cfablst)
                                                                    <li class="et-item" id="optionlist-11-{{$cfablst->id}}" data-title="{{$cfablst->contrsfab_name}}" title="{{$cfablst->contrsfab_name}}" onClick="javascript:getcontrast({{$cfablst->id}});">
                                                                        <figure class="et-item-img">
                                                                            <img src="{{asset('/storage/'.$cfablst->contrsfab_img)}}" alt="{{$alt_name}}" />
                                                                        </figure>
                                                                        @if($cfablst->id==$eTailorObj['ocontrast'])<div class="icon-check"></div>@endif
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="et-bottom-wrp et-pro-wrp">
                                                    <button type="button" class="btn pull-left et-skip" onClick="javascript:goBackColr();">Back</button>
                                                    <button type="button" class="btn pull-right et-done" onClick="hidediv('et-coller-fabric');">Done</button>
                                                </div>
                                            </div>
                                            <!-- Coller Modal End -->
                                            <!-- Sleeve Modal Start -->
                                            <div class="et-modal-content et-sleeve-fabric" id="option-etstyle-Sleeve">
                                                <div class="et-modal-header">
                                                    <h4>1. Please Choose Sleeve Style</h4>
                                                    <span class="ad-option-sleeve et-oc" onClick="hidediv('et-sleeve-fabric');"><img src="{{asset('advance/img/CloesButton.png')}}"/></span>
                                                </div>
                                                <div class="et-modal-colum-block">
                                                    <div class="et-choose-style">
                                                        <ul>
                                                        	<?php $styleslevlst = App\AttributeStyle::select('*')->where('attri_id','=',4)->get();?>
                                                            @foreach($styleslevlst as $stylslevlst)
                                                            <li class="et-item" id="optionlist-4-{{$stylslevlst->id}}" data-title="{{$stylslevlst->style_name}}" title="{{$stylslevlst->style_name}}" onClick="javascript:getstysleeves({{$stylslevlst->id}});">
                                                            	<?php $styleslevimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylslevlst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                                @foreach($styleslevimglst as $slevls)
                                                                <figure class="et-item-style">
                                                                    <img src="{{asset('/storage/'.$slevls->list_img)}}" alt="{{$alt_name}}" />
                                                                </figure>
                                                                @endforeach
                                                                @if($stylslevlst->id==$eTailorObj['osleeve'])<div class="icon-check"></div>@endif
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="et-options-more">
                                                        <div class="et-check-box">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" <?php if($eTailorObj['oshoulder']=="true"){?>checked<?php } ?> onClick="javascript:getepaulette({{$eTailorObj['oshoulder']}});" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Epaulettes </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="et-bottom-wrp et-pro-wrp">
                                                    <button type="button" class="btn pull-left et-skip" onClick="hidediv('et-sleeve-fabric');">Skip</button>
                                                    <button type="button" class="btn pull-right et-done" onClick="hidediv('et-sleeve-fabric');">Done</button>
                                                </div>
                                            </div>
                                            <!-- Sleeve Modal End -->
                                            <!-- Front Modal Start -->
                                            <div class="et-modal-content et-front-fabric" id="option-etstyle-Front">
                                                <div class="et-modal-header">
                                                    <h4>1. Choose your Front Style</h4>
                                                    <span class="ad-option-front et-oc" onClick="hidediv('et-front-fabric');"><img src="{{asset('advance/img/CloesButton.png')}}"/></span>
                                                </div>
                                                <div class="et-modal-colum-front">
                                                    <div class="et-select-style">
                                                        <ul>
                                                        	<?php $stylefrntlst = App\AttributeStyle::select('*')->where('attri_id','=',5)->get();?>
                                                            @foreach($stylefrntlst as $stylfrntlst)
                                                            <li class="et-item" id="optionlist-5-{{$stylfrntlst->id}}" data-title="{{$stylfrntlst->style_name}}" title="{{$stylfrntlst->style_name}}" onClick="javascript:getstyfronts({{$stylfrntlst->id}});">
                                                            	<?php $stylefrntimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylfrntlst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                                @foreach($stylefrntimglst as $frntls)
                                                                <figure class="et-item-style">
                                                                    <img src="{{asset('/storage/'.$frntls->list_img)}}" alt="{{$alt_name}}" />
																	<?php $buttimglst = App\ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylfrntlst->id)->where('attri_id' , '=' , $stylfrntlst->attri_id)->where('but_id' , '=' , $eTailorObj['obutton'])->get();?>
                                                                    @foreach($buttimglst as $buttls)
                                                                    <img src="{{asset('/storage/'.$buttls->button_list_img)}}" alt="{{$alt_name}}">
                                                                    @endforeach
                                                                </figure>
                                                                @if($frntls->id==$eTailorObj['ofront'])<div class="icon-check"></div>@endif
                                                                @endforeach
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                        <div class="et-options-more">
                                                            <div class="et-check-box">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="seamstxt" id="seamstxt" value="true" <?php if($eTailorObj['oseams']=="true"){?>checked<?php } ?> onClick="javascript:getfrontoptions({{$eTailorObj['oseams']}},'Seams');">
                                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>2. Seams
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="et-select-style check-box-style">
                                                        <ul>
                                                            <li>
                                                                <figure class="et-item-style-check">
                                                                    <img src="{{asset('advance/img/styFront/InSide.png')}}"/>
                                                                </figure>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" <?php if($eTailorObj['ofrontPlacketIn']=="true"){?>checked<?php } ?>  onClick="javascript:getfrontoptions({{$eTailorObj['ofrontPlacketIn']}},'FrontPlacketIn');">
                                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <figure class="et-item-style-check">
                                                                    <img src="{{asset('advance/img/styFront/OutSide.png')}}"/>
                                                                </figure>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" <?php if($eTailorObj['ofrontPlacketOut']=="true"){?>checked<?php } ?> onClick="javascript:getfrontoptions({{$eTailorObj['ofrontPlacketOut']}},'FrontPlacketOut');">
                                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            @if($eTailorObj['ofront']==5)
                                                            <li>
                                                                <figure class="et-item-style-check">
                                                                    <img src="{{asset('advance/img/styFront/FrontBox.png')}}"/>
                                                                </figure>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" <?php if($eTailorObj['ofrontBoxOut']=="true"){?>checked<?php } ?> onClick="javascript:getfrontoptions({{$eTailorObj['ofrontBoxOut']}},'FrontBoxOut');">
                                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="et-bottom-wrp et-pro-wrp">
                                                    <button type="button" class="btn pull-left et-skip" onClick="hidediv('et-front-fabric');">Skip</button>
                                                    <button type="button" class="btn pull-right et-done" onClick="hidediv('et-front-fabric');">Done</button>
                                                </div>
                                            </div>
                                            <!-- Front Modal End -->
                                            <!-- Cuffs Modal Start -->
                                            <div class="et-modal-content et-cuffs-fabric" id="cuff1">
                                                <div class="et-modal-header">
                                                    <h4>Choose From 9 Cuff Style</h4>
                                                    <span class="ad-option-cuffs et-oc" onClick="hidediv('et-cuffs-fabric');"><img src="{{asset('advance/img/CloesButton.png')}}"/></span>
                                                </div>
                                                <div class="et-modal-colum-cuff">
                                                    <div class="et-select-style">
                                                        <ul>
                                                        	<?php $stylecufflst = App\AttributeStyle::select('*')->where('attri_id','=',9)->get();?>
                                                            @foreach($stylecufflst as $stylcufflst)
                                                            <li class="et-item" id="optionlist-9-{{$stylcufflst->id}}" data-title="{{$stylcufflst->style_name}}" title="{{$stylcufflst->style_name}}" onClick="javascript:getstycuffs({{$stylcufflst->id}});">
                                                            	<?php $stylecuffimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylcufflst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                                @foreach($stylecuffimglst as $cuffls)
                                                                <figure class="et-item-style">
                                                                    <img src="{{asset('/storage/'.$cuffls->list_img)}}" alt="{{$alt_name}}" />
                                                                    <?php $thrdimglst = App\ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcufflst->id)->where('attri_id' , '=' , $stylcufflst->attri_id)->where('thrd_id' , '=' , $eTailorObj['obuttonHole'])->get();?>
                                                                    @foreach($thrdimglst as $thrdls)
                                                                    <img src="{{asset('/storage/'.$thrdls->thrd_list_img)}}" alt="{{$alt_name}}">
                                                                    @endforeach
                                                                    <?php $buttimglst = App\ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcufflst->id)->where('attri_id' , '=' , $stylcufflst->attri_id)->where('but_id' , '=' , $eTailorObj['obutton'])->get();?>
                                                                    @foreach($buttimglst as $buttls)
                                                                    <img src="{{asset('/storage/'.$buttls->button_list_img)}}" alt="{{$alt_name}}">
                                                                    @endforeach
                                                                </figure>
                                                                @if($cuffls->id==$eTailorObj['ocuff'])<div class="icon-check"></div>@endif
                                                                @endforeach
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="et-bottom-wrp et-pro-wrp">
                                                    <button type="button" class="btn pull-left et-skip" onClick="hidediv('et-cuffs-fabric');">Skip</button>
                                                    <button type="button" class="btn pull-right et-done" onClick="javascript:goNextCuff();">Next</button>
                                                </div>
                                            </div>
                                            <div class="et-modal-content et-cuffs-fabric" id="cuff2" style="display:none;">
                                                <div class="et-modal-header">
                                                    <h4>More Cuff Detail</h4>
                                                    <span class="ad-option-cuffs et-oc" onClick="hidediv('et-cuffs-fabric');"><img src="{{asset('advance/img/CloesButton.png')}}"/></span>
                                                </div>
                                                <div class="et-modal-colum-2">
                                                    <div class="preview-box">
                                                        <figure class="ad-selected-item" id="cuffpreview">
                                                            <img src="{{asset('advance/img/product/pt-shirt-front-open.png')}}">
                                                        </figure>
                                                    </div>
                                                    <div class="et-options-more">
                                                        <div class="et-check-box">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="cuffoutertxt" id="cuffoutertxt" value="true" <?php if($eTailorObj['ocollarCuffout']=="true"){?>checked<?php } ?> onClick="javascript:getcollrcuffcontrast({{$eTailorObj['ocollarCuffout']}},'CollarCuffOut');" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Cuff Outside Contrast
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="cuffinnertxt" id="cuffinnertxt" value="true" <?php if($eTailorObj['ocollarCuffIn']=="true"){?>checked<?php } ?> onClick="javascript:getcollrcuffcontrast({{$eTailorObj['ocollarCuffIn']}},'CollarCuffIn');" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Cuff Inside Contrast
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="et-bottom-wrp et-pro-wrp">
                                                    <button type="button" class="btn pull-left et-skip" onClick="javascript:goBackCuff();">Back</button>
                                                    <button type="button" class="btn pull-right et-done" onClick="hidediv('et-cuffs-fabric');">Done</button>
                                                </div>
                                            </div>
                                            <!-- Cuffs Modal End -->
                                            <!-- Bottom Modal Start -->
                                            <div class="et-modal-content et-bottom-fabric" id="option-etstyle-Bottom">
                                                <div class="et-modal-header">
                                                    <h4>Bottom Style</h4>
                                                    <span class="ad-option-bottom et-oc" onClick="hidediv('et-bottom-fabric');"><img src="{{asset('advance/img/CloesButton.png')}}"/></span>
                                                </div>
                                                <div class="et-modal-colum-bottom">
                                                    <div class="et-select-style">
                                                        <ul>
                                                        	<?php $stylebotmlst = App\AttributeStyle::select('*')->where('attri_id','=',7)->get();?>
                                                            @foreach($stylebotmlst as $stylbotmlst)
                                                            <li class="et-item" id="optionlist-7-{{$stylbotmlst->id}}" data-title="{{$stylbotmlst->style_name}}" title="{{$stylbotmlst->style_name}}" onClick="javascript:getstybottoms({{$stylbotmlst->id}});">
                                                            	<?php $stylebotmimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylbotmlst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                                @foreach($stylebotmimglst as $botmls)
                                                                <figure class="et-item-style">
                                                                    <img src="{{asset('/storage/'.$botmls->list_img)}}" alt="{{$alt_name}}" />
                                                                </figure>
                                                                @if($stylbotmlst->id==$eTailorObj['obottom'])<div class="icon-check"></div>@endif
                                                                @endforeach
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="et-bottom-wrp et-pro-wrp">
                                                    <button type="button" class="btn pull-left et-skip" onClick="hidediv('et-bottom-fabric');">Skip</button>
                                                    <button type="button" class="btn pull-right et-done" onClick="hidediv('et-bottom-fabric');">Done</button>
                                                </div>
                                            </div>
                                            <!-- Bottom Modal End -->
                                            <!-- Back details Modal Start -->
                                            <div class="et-modal-content et-back-fabric" id="option-etstyle-backs">
                                                <div class="et-modal-header">
                                                    <h4>1. Choose your Back Style</h4>
                                                    <span class="ad-option-back et-oc" onClick="hidediv('et-back-fabric');"><img src="{{asset('advance/img/CloesButton.png')}}"/></span>
                                                </div>
                                                <div class="et-modal-colum-back">
                                                    <div class="et-select-style">
                                                        <ul>
                                                        	<?php $stylebacklst = App\AttributeStyle::select('*')->where('attri_id','=',6)->get();?>
                                                            @foreach($stylebacklst as $stylbacklst)
                                                            <li class="et-item" id="optionlist-6-{{$stylbacklst->id}}" data-title="{{$stylbacklst->style_name}}" title="{{$stylbacklst->style_name}}" onClick="javascript:getstybacks({{$stylbacklst->id}});">
                                                            	<?php $stylebackimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylbacklst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                                @foreach($stylebackimglst as $backls)
                                                                <figure class="et-item-style">
                                                                    <img src="{{asset('/storage/'.$backls->list_img)}}" alt="{{$alt_name}}" />
                                                                </figure>
                                                                @if($stylbacklst->id==$eTailorObj['oback'])<div class="icon-check"></div>@endif
                                                                @endforeach
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                        @if($eTailorObj['oback']==7 || $eTailorObj['oback']==8)
                                                        <div class="et-options-more">
                                                            <div class="et-check-box">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="dartstxt" id="dartstxt" value="true" <?php if($eTailorObj['odart']=="true"){?>checked<?php } ?> onClick="javascript:getbackoptions({{$eTailorObj['odart']}},'Darts');">
                                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>2. Darts
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="et-select-style check-box-style">
                                                        <ul>
                                                        	@if($eTailorObj['oback']==8)
                                                            <li>
                                                                <figure class="et-item-style-check">
                                                                	<img src="{{asset('advance/img/styFront/Box.png')}}"/>
                                                                </figure>
                                                                <div class="checkbox">
                                                                    <label><input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" <?php if($eTailorObj['obackBoxOut']=="true"){?>checked<?php } ?> onClick="javascript:getbackoptions({{$eTailorObj['obackBoxOut']}},'BackBoxOut');" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Placket
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="et-bottom-wrp et-pro-wrp">
                                                    <button type="button" class="btn pull-left et-skip" onClick="hidediv('et-back-fabric');">Skip</button>
                                                    <button type="button" class="btn pull-right et-done" onClick="hidediv('et-back-fabric');">Done</button>
                                                </div>
                                            </div>
                                            <!-- Back Modal End -->
                                            <!-- POCKETS Start-->
                                            <div class="et-modal-content et-pockts-fabric" id="option-etstyle-pockets">
                                                <div class="et-modal-header">
                                                    <h4>Select Pocket Style</h4>
                                                    <span class="ad-option-pockts et-oc" onClick="hidediv('et-pockts-fabric');"><img src="{{asset('advance/img/CloesButton.png')}}"/></span>
                                                </div>
                                                <div class="et-modal-colum-cuff">
                                                    <div class="et-select-style">
                                                        <ul>
                                                        	<?php $stylepocktlst = App\AttributeStyle::select('*')->where('attri_id','=',10)->get();?>
                                                            @foreach($stylepocktlst as $stylpocktlst)
                                                            <li class="et-item" id="optionlist-10-{{$stylpocktlst->id}}" data-title="{{$stylpocktlst->style_name}}" title="{{$stylpocktlst->style_name}}" onClick="javascript:getstypockets({{$stylpocktlst->id}});">
                                                            	<?php $stylepocktimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylpocktlst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                                @if($stylpocktlst->id == 37)
                                                                	<figure class="et-item-style"><img src="{{asset('/advance/img/none.jpg')}}" alt="{{$alt_name}}"></figure>
                                                                    @if($stylpocktlst->id == $eTailorObj['opacket'])<div class="icon-check"></div>@endif
                                                                @else
                                                                    @foreach($stylepocktimglst as $pocktls)
                                                                    <figure class="et-item-style">
                                                                        <img src="{{asset('/storage/'.$pocktls->list_img)}}" alt="{{$alt_name}}" />
                                                                        <?php $thrdimglst = App\ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylpocktlst->id)->where('attri_id' , '=' , $stylpocktlst->attri_id)->where('thrd_id' , '=' , $eTailorObj['obuttonHole'])->get();?>
                                                                        @foreach($thrdimglst as $thrdls)
                                                                        <img src="{{asset('/storage/'.$thrdls->thrd_list_img)}}" alt="{{$alt_name}}">
                                                                        @endforeach
                                                                        <?php $buttimglst = App\ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylpocktlst->id)->where('attri_id' , '=' , $stylpocktlst->attri_id)->where('but_id' , '=' , $eTailorObj['obutton'])->get();?>
                                                                        @foreach($buttimglst as $buttls)
                                                                        <img src="{{asset('/storage/'.$buttls->button_list_img)}}" alt="{{$alt_name}}">
                                                                        @endforeach
                                                                    </figure>
                                                                    @if($stylpocktlst->id==$eTailorObj['opacket'])<div class="icon-check"></div>@endif
                                                                    @endforeach
                                                                @endif
                                                            </li>
                                                            @endforeach
                                                        </ul>

                                                        <div class="et-fw text-center">
                                                        	@if($eTailorObj['opacket']!=37)
                                                        	<div class="et-btn-group">
                                                                <div class="et-btn-select">
                                                                    <select class="selectpicker btn-primary" name="pocketstxt" id="pocketstxt" onChange="javascript:getnumpockets(this.value);"><option value="1" <?php if($eTailorObj['opacketCount']=="1"){?>selected<?php } ?>>1 Pocket</option><option value="2" <?php if($eTailorObj['opacketCount']=="2"){?>selected<?php } ?>>2 Pockets</option></select>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="et-bottom-wrp et-pro-wrp">
                                                    <button type="button" class="btn pull-left et-skip" onClick="hidediv('et-pockts-fabric');">Skip</button>
                                                    <button type="button" class="btn pull-right et-done" onClick="hidediv('et-pockts-fabric');">Done</button>
                                                </div>
                                            </div>
                                            <!-- Pockets End -->
                                            <!--Buttons Modal Start-->
                                            <div class="et-modal-content et-buttons-fabric" id="option-etstyle-buttons" >
                                                <div class="et-modal-header">
                                                    <h4>Button / Hole Thread Color</h4>
                                                    <span class="ad-option-button et-oc" onClick="hidediv('et-buttons-fabric');"><img src="{{asset('advance/img/CloesButton.png')}}"/></span>
                                                </div>
                                                <div class="et-modal-colum-2">
                                                    <div class="preview-box">
                                                        <figure class="ad-selected-item">
                                                            <div id="design-3D-pro-button-color">
                                                                <img src="{{asset('storage/Shirts/Fabric/S/'.$eTailorObj['ofabric'].'.jpg')}}">
                                                                <img src="{{asset('storage/Shirts/Threads/'.$eTailorObj['obuttonHoleStyle'].'/'.$eTailorObj['obuttonHole'].'.png')}}">
                                                                <img src="{{asset('storage/Shirts/Buttons/'.$eTailorObj['obutton'].'.png')}}">
                                                                <img src="{{asset('storage/Shirts/Threads/C/'.$eTailorObj['obuttonHole'].'.png')}}">
                                                            </div>
                                                        </figure>
                                                	</div>
                                                    <div class="et-options-more">
                                                        <div class="et-sm-carousel">
                                                            <h5>1. Choose your Button color</h5>
                                                            <div class="et-contrast-list">
                                                                <ul class="et-item-list">
                                                                	<?php $contbuttlst = App\Button::select('*')->where('cat_id','=',1)->get(); ?>
																	@foreach($contbuttlst as $cbuttnlst)
                                                                    <li class="et-item" onClick="javascript:getstybuttons({{$cbuttnlst->id}},'11');">
                                                                        <figure class="et-item-img">
                                                                            <img src="{{asset('/storage/'.$cbuttnlst->button_img)}}" alt="{{$alt_name}}" />
                                                                        </figure>
                                                                        @if($cbuttnlst->id==$eTailorObj['obutton'])<div class="icon-check"></div>@endif
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="et-sm-carousel">
                                                            <h5>2. Thread Color</h5>
                                                            <div class="et-contrast-list">
                                                                <ul class="et-item-list">
                                                                	<?php $contthrdlst = App\Thread::select('*')->where('cat_id','=',1)->get(); ?>
																	@foreach($contthrdlst as $cthreadlst)
                                                                    <li class="et-item" onClick="javascript:getstybuttons({{$cthreadlst->id}},'12');">
                                                                        <figure class="et-item-img">
                                                                            <img src="{{asset('/storage/'.$cthreadlst->thrd_img)}}" alt="{{$alt_name}}" />
                                                                        </figure>
                                                                        @if($cthreadlst->id==$eTailorObj['obuttonHole'])<div class="icon-check"></div>@endif
                                                                    </li>
                                                                    @endforeach
                                                                 </ul>
                                                            </div>
                                                        </div>
                                                        <div class="et-sm-carousel">
                                                            <h5>3. Buttons Hole Style</h5>
                                                            <div class="et-contrast-list">
                                                            	<?php $contthrdstyllst = App\Thread::select('*')->where('cat_id','=',1)->where('id','=',$eTailorObj['obuttonHole'])->get(); ?>
                                                        		@foreach($contthrdstyllst as $cthrdstyllst)
                                                                <ul class="et-item-list">
                                                                    <li class="et-item" onClick="javascript:getstybuttons('V','13');">
                                                                        <figure class="et-item-img">
                                                                            <img src="{{asset('/storage/Shirts/Fabric/S/'.$eTailorObj['ofabric'].'.jpg')}}"/>
                                                                            <img src="{{asset('/storage/'.$cthrdstyllst->thrd_hole_vertical)}}"/>
                                                                        </figure>
                                                                        @if($eTailorObj['obuttonHoleStyle']=='V')<div class="icon-check"></div>@endif
                                                                    </li>
                                                                    <li class="et-item" onClick="javascript:getstybuttons('H','13');">
                                                                        <figure class="et-item-img">
                                                                            <img src="{{asset('/storage/Shirts/Fabric/S/'.$eTailorObj['ofabric'].'.jpg')}}"/>
                                                                            <img src="{{asset('/storage/'.$cthrdstyllst->thrd_hole_horizontal)}}"/>
                                                                        </figure>
                                                                        @if($eTailorObj['obuttonHoleStyle']=='H')<div class="icon-check"></div>@endif
                                                                    </li>
                                                                    <li class="et-item" onClick="javascript:getstybuttons('S','13');">
                                                                        <figure class="et-item-img">
                                                                            <img src="{{asset('/storage/Shirts/Fabric/S/'.$eTailorObj['ofabric'].'.jpg')}}"/>
                                                                            <img src="{{asset('/storage/'.$cthrdstyllst->thrd_hole_slanted)}}"/>
                                                                        </figure>
                                                                        @if($eTailorObj['obuttonHoleStyle']=='S')<div class="icon-check"></div>@endif
                                                                    </li>
                                                                 </ul>
                                                                 @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="et-bottom-wrp et-pro-wrp">
                                                    <button type="button" class="btn pull-left et-skip" onClick="hidediv('et-buttons-fabric');">Skip</button>
                                                    <button type="button" class="btn pull-right et-done" onClick="hidediv('et-buttons-fabric');">Done</button>
                                                </div>
                                            </div>
                                            <!--Buttons Model End-->
                                            <!-- Monogram Modal Start -->
                                            <div class="et-modal-content et-monogram-fabric" id="options-monogram">
                                                <div class="et-modal-header">
                                                    <h4>MONOGRAM PERSONALISATION</h4>
                                                    <span class="ad-option-monogram et-oc" onClick="hidediv('et-monogram-fabric');"><img src="{{asset('advance/img/CloesButton.png')}}"/></span>
                                                </div>
                                                <div class="et-modal-colum-2">
                                                    <div class="preview-box monogram" style="position:relative;">
                                                        <label class="monogram-subhead" >
                                                             <span class="cr"><i class="cr-icon"></i></span>  1. Click on the Monogram Location(red dot)
                                                        </label>
                                                        <figure class="ad-selected-item" id="monogrmpreview">
                                                            <img src="{{asset('advance/img/product/pt-shirt-front-open.png')}}">
                                                        </figure>
                                                        @if($eTailorObj['opacket']!=37)
                                                            <button type="button" class="et-point mon-pocket <?php if($eTailorObj['omonogram']=='48'){?>active<?php }?>" onClick="javascript:getmonogrmplace('48');"></button>
                                                            @else
                                                            <button type="button" class="et-point mon-chest <?php if($eTailorObj['omonogram']=='47'){?>active<?php }?>" onClick="javascript:getmonogrmplace('47');"></button>
                                                            @endif
                                                            @if($eTailorObj['osleeve']!=3)
                                                            <button type="button" class="et-point mon-cuff <?php if($eTailorObj['omonogram']=='49'){?>active<?php }?>" onClick="javascript:getmonogrmplace('49');"></button>
                                                            @endif

                                                            <button type="button" class="et-point mon-waist <?php if($eTailorObj['omonogram']=='46'){?>active<?php }?>" onClick="javascript:getmonogrmplace('46');"></button>
                                                    </div>
                                                    <div class="et-options-more">
                                                        <div class="et-check-box">
                                                            <label class="subhead-two" >
                                                                 <span class="cr"><i class="cr-icon"></i></span>  2. Enter Desired Monogram/Initials
                                                                 <p class="sub-title">{<span>English Script Only</span>}</p>
                                                            </label>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="monogrmrad" id="monogrmrad" value="true" <?php if($eTailorObj['omonogramStyle']=='normal'){?>checked<?php }?> onClick="javascript:getmonostyle('normal');" >
                                                                    <span class="cr"><i class="cr-icon"></i></span>monogram
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="monogrmrad" id="monogrmrad" value="true" <?php if($eTailorObj['omonogramStyle']=='italic'){?>checked<?php }?> onClick="javascript:getmonostyle('italic');" >
                                                                    <span class="cr"><i class="cr-icon"></i></span><i>monogram</i>
                                                                </label>
                                                            </div>
                                                             <div class="text-box">
                                                                <label>
                                                                    <input type="text" name="monogrmtxt" id="monogrmtxt" value="{{$eTailorObj['omonogramText']}}" maxlength="10" onBlur="javascript:getmonotext(this.value);">
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="et-sm-carousel">
                                                          	<h5><i class="cr-icon"></i></span>  3. Monogram Colors</h5>
                                                            <div class="et-contrast-list">
                                                                <ul class="et-item-list">
                                                                	<?php $monothrdlst = App\Thread::select('*')->where('cat_id','=',1)->get(); ?>
                                                            		@foreach($monothrdlst as $monothrdlst)
                                                                    <li class="et-item threads" onClick="javascript:getmonotxtcolor({{$monothrdlst->id}});">
                                                                        <figure class="et-item-img">
                                                                            <img src="{{asset('/storage/'.$monothrdlst->thrd_img)}}" alt="{{$alt_name}}" />
                                                                        </figure>
                                                                        @if($monothrdlst->id==$eTailorObj['omonogramColor'])<div class="icon-check"></div>@endif
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="et-bottom-wrp et-pro-wrp">
                                                    <button type="button" class="btn pull-left et-skip" onClick="hidediv('et-monogram-fabric');">BACK</button>
                                                    <button type="button" class="btn pull-right et-done" onClick="javascript:showSection('sect-measurement');">Go TO MEASUREMENT</button>
                                                </div>
                                            </div>
                                            <!-- Monogram Modal End -->
                                        </div>
                                        <!-- Modal -->
                                        <!-- Fabric modal -->
                                    </div>
                                        <!-- All Details Pop-ups End -->
                                        <div class="pt-price-shirt">
                                            <span class="pt-sht"> Shirt {1 Shirt} </span>
                                            <span class="pt-dollor">${{number_format($eTailorObj['ofabricPrice'],2)}}</span>
                                      	</div>
                                        <div class="pt-bottom-thumb" id="viewtab">
                                        	<ul>
                                            	<?php if($eTailorObj['ocollar']!=21 && $eTailorObj['ocollar']!=22 && $eTailorObj['ocollar']!=23 && $eTailorObj['ocollar']!=26 && $eTailorObj['ocollar']!=27){?>
                                                <li>
                                                	<a href="javascript:designOpenProcessing();viewMainFront();"><img src="{{asset('advance/img/product/view-advanced.png')}}"/></a>
                                             	</li>
                                                <?php } ?>
                                            	<li>
                                                	<a href="javascript:designProcessing(),viewMainFront();"><img src="{{asset('advance/img/product/view-normal.png')}}"></a>
                                             	</li>
												<li id="backview">
                                                	<a href="javascript:void(0);" onClick="javascript:viewMainBack();"><img src="{{asset('advance/img/product/view-back.png')}}"/></a>
                                              	</li>
                                                <li id="frontview" style="display:none">
                                                	<a href="javascript:void(0);" onClick="javascript:viewMainFront();"><img src="{{asset('advance/img/product/view-advanced.png')}}"/></a>
                                              	</li>
                                         	</ul>
                                    	</div>
                                        <div class="et-ad-button">
                                        	<button type="button" class="btn adv-button" onClick="javascript:showSection('sect-measurement');">Go To Measurements</button>
                                        </div>
                                        <div class="et-sm-carousel et-conrast-new" id="option-etcontrast">
                                            <h5>Contrast fabrics Selection :</h5>
                                            <div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                    <?php $contfablst = App\Contrast::select('*')->where('cat_id','=',1)->get(); ?>
                                                    @foreach($contfablst as $cfablst)
                                                    <li class="et-item" id="optionlist-11-{{$cfablst->id}}" data-title="{{$cfablst->contrsfab_name}}" title="{{$cfablst->contrsfab_name}}" onClick="javascript:getcontrast({{$cfablst->id}});">
                                                        <figure class="et-item-img">
                                                            <img src="{{asset('/storage/'.$cfablst->contrsfab_img)}}" alt="{{$alt_name}}" />
                                                        </figure>
                                                        @if($cfablst->id==$eTailorObj['ocontrast'])<div class="icon-check"></div>@endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                	</div>
                                    <!-- End Main Preview -->
                                </div>
                            </div>
                        </div>
                        <div class="et-bottom">
                        	<div class="et-rating-exp">
                                <a href="javascript:void(0);">
                                    <ul class="et-rating-style">
                                        <li>Excellent</li>
                                        <li>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>Based on 1,020 reviews</li>
                                    </ul>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TABS ENDS -->
        </div>
        <!-- Container Ends-->
	</div>
    <!-- DESIGN AREA ENDS -->
    <!-- MEASURMENT SECTION -->
    <section class="fw et-fw" id="sect-measurement" style="display:none;">
        <div class="container">
            <div class="row">
                <div class="et-measure-right">
                    <div class="pt-thumb-slider">
                        <div class="et-des-title"><h2>Great Choice!  Please Select Your Measurement Option</h2></div>
                        <div class="et-ment-option">
                            <div class="et-body-size light-bg">
                                <h2 class="un-bg">BODY SIZE</h2>
                                <p>Part of the tailor-made experience is getting yourself measured up. With the assistance of our easy-to-follow video measuring guide, get yourself measured up in no time!</p>
                                <span><a href="javascript:void(0);" onClick="javascript:showSection('sect-bodysize');"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a></span>
                                <figure class="et-img"><img src="{{asset('demo/img/Measurement.png')}}" alt=""></figure>
                            </div>
                            <div class="et-standard-size light-bg">
                                <h2 class="un-bg">Standard SIZES</h2>
                                <p>Standard sizes provide an equally amazing fit. Select from an array of sizes from our standard size chart. Enjoy your Tailor-made product with the perfect combination of the right size and your creative style choices!</p>
                                <span><a href="javascript:void(0);"  onClick="javascript:showSection('sect-standardsize');"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a></span>
                                <figure class="et-img"><img src="{{asset('demo/img/SML.png')}}" alt=""></figure>
                            </div>
                        </div>
                    </div>
                    <div class="et-block et-form-btn">
                        <a href="#" onclick="javascript:showSection('sect-design');" class="et-blk-brn blue">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MEASURMENT SECTION ENDS -->
    <!-- MEASURMENT BODY SIZE SECTION -->
    <section class="fw et-fw text-center" id="sect-bodysize" style="display:none;">
        <div class="container">
            <div class="row">
            	<div class="et-des-title antiwhite"><h2>YOUR BODY SIZES</h2></div>
                <div class="et-main-measurement">
                    <form class="et-shirt-measure" role="form" method="POST" onSubmit="javascript:return validatebodyform();">
                    {{ csrf_field() }}
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
                                <input type="text" data-title="{{$mnecklst->from_range}}-{{$mnecklst->to_range}}" name="bsizeNeck" id="bsizeNeck" style="border-color:#F30;" onFocus="javascript:showRanges('{{$mnecklst->bodysize_type}}',{{$mnecklst->from_range}},{{$mnecklst->to_range}},'neck');" onBlur="javascript:validateField(this.id,{{$mnecklst->from_range}},{{$mnecklst->to_range}});" value="<?php echo $eTailorObj['osizeNeck'];?>"  >
                                @endforeach
                            </div>
                            <div class="et-input">
                                <span>CHEST</span>
                                <?php $measurechestlst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',2)->get();?>
                                @foreach($measurechestlst as $mchestlst)
                                <input type="text" data-title="{{$mchestlst->from_range}}-{{$mchestlst->to_range}}" name="bsizeChest" id="bsizeChest" onFocus="javascript:showRanges('{{$mchestlst->bodysize_type}}',{{$mchestlst->from_range}},{{$mchestlst->to_range}},'chest');" onBlur="javascript:validateField(this.id,{{$mchestlst->from_range}},{{$mchestlst->to_range}});" value="<?php echo $eTailorObj['osizeChest'];?>"  >
                                @endforeach
                            </div>
                            <div class="et-input">
                                <span>WAIST</span>
                                <?php $measurewaistlst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',3)->get();?>
                                @foreach($measurewaistlst as $mwaistlst)
                                <input type="text" data-title="{{$mwaistlst->from_range}}-{{$mwaistlst->to_range}}" name="bsizeWaist" id="bsizeWaist" onFocus="javascript:showRanges('{{$mwaistlst->bodysize_type}}',{{$mwaistlst->from_range}},{{$mwaistlst->to_range}},'waist');" onBlur="javascript:validateField(this.id,{{$mwaistlst->from_range}},{{$mwaistlst->to_range}});" value="<?php echo $eTailorObj['osizeWaist'];?>" >
                                @endforeach
                            </div>
                            <div class="et-input">
                                <span>HIP</span>
                                <?php $measurehiplst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',4)->get();?>
                                @foreach($measurehiplst as $mhiplst)
                                <input type="text" data-title="{{$mhiplst->from_range}}-{{$mhiplst->to_range}}" name="bsizeHip" id="bsizeHip" onFocus="javascript:showRanges('{{$mhiplst->bodysize_type}}',{{$mhiplst->from_range}},{{$mhiplst->to_range}},'hip');" onBlur="javascript:validateField(this.id,{{$mhiplst->from_range}},{{$mhiplst->to_range}});" value="<?php echo $eTailorObj['osizeHip'];?>" >
                                @endforeach
                            </div>
                            <div class="et-input">
                                <span>LENGTH</span>
                                <?php $measurelengthlst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',5)->get();?>
                                @foreach($measurelengthlst as $mlengthlst)
                                <input type="text" data-title="{{$mlengthlst->from_range}}-{{$mlengthlst->to_range}}" name="bsizeLength" id="bsizeLength" onFocus="javascript:showRanges('{{$mlengthlst->bodysize_type}}',{{$mlengthlst->from_range}},{{$mlengthlst->to_range}},'length');" onBlur="javascript:validateField(this.id,{{$mlengthlst->from_range}},{{$mlengthlst->to_range}});" value="<?php echo $eTailorObj['osizeLength'];?>" >
                                @endforeach
                            </div>
                            <div class="et-input">
                                <span>SHOULDER</span>
                                <?php $measureshoulderlst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',6)->get();?>
                                @foreach($measureshoulderlst as $mshoulderlst)
                                <input type="text" data-title="{{$mshoulderlst->from_range}}-{{$mshoulderlst->to_range}}" name="bsizeShoulder" id="bsizeShoulder" onFocus="javascript:showRanges('{{$mshoulderlst->bodysize_type}}',{{$mshoulderlst->from_range}},{{$mshoulderlst->to_range}},'shoulder');" onBlur="javascript:validateField(this.id,{{$mshoulderlst->from_range}},{{$mshoulderlst->to_range}});" value="<?php echo $eTailorObj['osizeShoulder'];?>" >
                                @endforeach
                            </div>
                            <div class="et-input" id="bdymsleeve">
                                <span>SLEEVE</span>
                                @if($eTailorObj['osleeve']==3)
                                <?php $measureshortsleevelst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',8)->get();?>
                                @foreach($measureshortsleevelst as $mshrtslevlst)
                                <input type="text" data-title="{{$mshrtslevlst->from_range}}-{{$mshrtslevlst->to_range}}" name="bsizeSleeve" id="bsizeSleeve" onFocus="javascript:showRanges('{{$mshrtslevlst->bodysize_type}}',{{$mshrtslevlst->from_range}},{{$mshrtslevlst->to_range}},'shortsleeve');" onBlur="javascript:validateField(this.id,{{$mshrtslevlst->from_range}},{{$mshrtslevlst->to_range}});" value="<?php echo $eTailorObj['osizeSleeve'];?>" >
                                @endforeach
                                @else
                                <?php $measuresleevelst = App\MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',7)->get();?>
                                @foreach($measuresleevelst as $msleevlst)
                                <input type="text" data-title="{{$msleevlst->from_range}}-{{$msleevlst->to_range}}" name="bsizeSleeve" id="bsizeSleeve" onFocus="javascript:showRanges('{{$msleevlst->bodysize_type}}',{{$msleevlst->from_range}},{{$msleevlst->to_range}},'sleeve');" onBlur="javascript:validateField(this.id,{{$msleevlst->from_range}},{{$msleevlst->to_range}});" value="<?php echo $eTailorObj['osizeSleeve'];?>" >
                                @endforeach
                                @endif
                            </div>
                            <div class="et-radio-check">
                                <div class="radio"><label><input type="radio" name="bsizetyp" id="bsizetyp" class="bsizetyp" value="cm" <?php if($eTailorObj['osizeType']=="cm"){?>checked<?php } ?>><span class="cr"><i class="cr-icon"></i></span>Cm</label></div>
                                <div class="radio"><label><input type="radio" name="bsizetyp" id="bsizetyp" class="bsizetyp" value="inch" <?php if($eTailorObj['osizeType']=="inch"){?>checked<?php } ?> ><span class="cr"><i class="cr-icon"></i></span>Inch</label></div>
                            </div>
                        </div>
                        <div class="et-block">
                            <div class="et-setect-fit">
                                <ul><li><span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span><span>Select Your Size :</span></li><li><div class="radio"><label><input type="radio" name="fitstyle" id="fitstyle" value="Comfortable" <?php if($eTailorObj['osizeStyle']=="Comfortable"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Signature Standard Fit</label></div></li><li><div class="radio"><label><input type="radio" name="fitstyle" id="fitstyle" value="Slim" <?php if($eTailorObj['osizeStyle']=="Slim"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Euro Slim Fit</label></div></li></ul>
                            </div>
                        </div>
                        <div class="et-block et-form-btn">
                            <a href="#" onClick="javascript:showSection('sect-measurement');" class="et-blk-brn blue">Back</a>
                            <input type="hidden" name="setarr" id="setarr" class="bsetarr" value="">
                            <input type="hidden" name="frntviewfinal" id="frntviewfinal" class="bfrntviewfinal">
                            <input type="hidden" name="bkviewfinal" id="bkviewfinal" class="bbkviewfinal">
                            <input type="hidden" name="tocken" id="tocken" value="{{csrf_token() }}">
                            <input type="hidden" name="mpattern" value="Body" id="bmpattern">
                            <input type="hidden" name="rndvalue" id="brndvalue" value="<?php echo rand(100000, 999999);?>">
                            <div id="et-body"  class="et-cart-brn" style="display:none; width:80px"><img src="{{URL::asset('asset/img/page-loader.gif')}}"></div>						<button type="sumbit" class="et-cart-brn" id="body">Add To Cart</button>
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
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- MEASURMENT BODY SIZE SECTION ENDS -->
    <!-- MEASURMENT STANDARD SIZE SECTION -->
    <section class="fw et-fw text-center" id="sect-standardsize" style="display:none;">
        <div class="container">
            <div class="row">
                <div class="et-des-title antiwhite"><h2>SIZE CHART</h2></div>
                <div class="et-main-measurement">
                    <form class="et-shirt-measure" role="form" method="POST" action="{{ url('/advance3D/postcart') }}">
                    {{ csrf_field() }}
                        <div class="et-block no-pad">
                            <div class="et-block">
                                <div class="et-setect-fit">
                                    <ul><li><span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></li><li><div class="radio"><label><input type="radio" name="sizetyp" id="sizetyp" value="cm" <?php if($eTailorObj['osizeType']=="cm"){?>checked<?php } ?> onClick="javascript:changeMview(this.value)"><span class="cr"><i class="cr-icon"></i></span>Cm</label></div></li><li><div class="radio"><label><input type="radio" name="sizetyp" id="sizetyp" value="inch" <?php if($eTailorObj['osizeType']=="inch"){?>checked<?php } ?> onClick="javascript:changeMview(this.value)"><span class="cr"><i class="cr-icon"></i></span>Inch</label></div></li></ul>
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
                                                @foreach($stdsizelst as $std1sizee)
                                                <?php $stdneckSize=App\BodyMeasurment::select('*')->where('cat_id','=','1')->where('mer_id','=',$std1sizee->id)->get();?>
                                                @foreach($stdneckSize as $necksizelst)<td>{{$necksizelst->neck}}</td>@endforeach
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td data-lang="chest">Chest</td>
                                                @foreach($stdsizelst as $std2sizee)
                                                <?php $stdchestSize=App\BodyMeasurment::select('*')->where('cat_id','=','1')->where('mer_id','=',$std2sizee->id)->get();?>
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
                                                @foreach($stdsizelst as $std3sizee)<td>{{$std3sizee->name}}</td>@endforeach
                                            </tr>
                                            <tr>
                                                <td data-lang="neck">Neck</td>
                                                @foreach($stdsizelst as $std4sizee)
                                                <?php $stdneckSize=App\BodyMeasurment::select('*')->where('cat_id','=','1')->where('mer_id','=',$std4sizee->id)->get();?>
                                                @foreach($stdneckSize as $necksizelst)<td>{{round($necksizelst->neck*2.54)}}</td>@endforeach
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td data-lang="chest">Chest</td>
                                                @foreach($stdsizelst as $std5sizee)
                                                <?php $stdchestSize=App\BodyMeasurment::select('*')->where('cat_id','=','1')->where('mer_id','=',$std5sizee->id)->get();?>
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
                                    <li><span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span><span>Select Your Size :</span></li>
                                    <li><div class="et-btn-group"><div class="et-btn-select" id="dvsizeoption">
                                        <?php $sizelst = App\MeasurmentSize::select('*')->get();?>
                                        <select class="selectpicker btn-primary selsize" id="selsize" name="selsize[]">
                                            @foreach($sizelst as $sizee)
                                            @if($eTailorObj['osizeFit']==$sizee->name)
                                            <option value="{{$sizee->name}}" selected>{{$sizee->name}}</option>
                                            @else
                                            <option value="{{$sizee->name}}">{{$sizee->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div></div></li>
                                    <li><span>Quantity :</span></li>
                                    <li><div class="et-btn-group"><div class="et-btn-select" id="dvqtyoption">
                                        <select class="selectpicker btn-primary selstdqty" id="selstdqty" name="selstdqty[]">
                                        @for($i=1;$i<=100;$i++)
                                        @if($eTailorObj['oqty']==$i)
                                        <option value="{{$i}}" selected>{{$i}}</option>
                                        @else
                                        <option value="{{$i}}" >{{$i}}</option>
                                        @endif
                                        @endfor
                                        </select>
                                    </div></div></li>
                                    <li><a href="#" class="et-black-btn" onclick="javascript:addMoreSize();">Add Other Sizes</a></li>
                                </ul>
                            </div>
                            <div class="et-block et-form-btn">
                                <a href="#" onClick="javascript:showSection('sect-measurement');" class="et-blk-brn blue">Back</a>
                                <input type="hidden" name="setarr" id="setarr" value="">
                                <input type="hidden" name="frntviewfinal" id="frntviewfinal" value="">
                                <input type="hidden" name="bkviewfinal" id="bkviewfinal" value="">
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
    </section>
	<!-- MEASURMENT STANDARD SIZE SECTION ENDS -->
    <!-- FOOTER SECTION -->
    @include('../layouts.inc.footer-desgin')
    <!-- FOOTER SECTION END -->
    <canvas id="frontcanvas" width="340" height="417" style="display:none"></canvas>
	<canvas id="backcanvas" width="340" height="417" style="display:none"></canvas>
</section>

</body>
<!-- --------------------------------------Product Section End Here----------------------------- -->
<!-- Bootstrap Main JS File -->
<script type="text/javascript" src="{{asset('advance/js/bootstrap.min.js')}}"></script>
<!-- Bootstrap bootstrap-touch-slider Slider Main JS File -->
<script type="text/javascript" src="{{asset('advance/js/float-panel.js')}}"></script>
<script type="text/javascript" src="{{asset('advance/js/responsive_bootstrap_carousel.js')}}"></script>
<!--<script type="text/javascript" src="{{asset('advance/js/jquery.touchSwipe.min.js')}}"></script>-->
<script type="text/javascript" src="{{asset('advance/js/bootstrap-touch-slider.js')}}"></script>
<script type="text/javascript">var url = "{{asset('/storage/')}}";</script>
<script type="text/javascript" src="{{asset('advance/js/fabric.min.js')}}"></script>
<script type="text/javascript" src="{{asset('advance/js/designthreedprocess.js')}}"></script>
<!-- Bootstrap Side Menu JS File -->
<script language="javascript" type="text/javascript">
$(document).ready(function(e){ designOpenProcessing();});
</script>
<script type="text/javascript">
	var clicked=true;
	$(".ad-option-1").on('click', function(){
		if(clicked){ clicked=false; $(".et-for-fabric").css({"bottom": 0}); $(this).addClass('st-advance-editor-active-history'); } else { clicked=true; $(".et-for-fabric").css({"bottom": "-100%"}); }
	});
	var clickedcollar=true;
	$("#collers").on('click', function(){
		if(clickedcollar) { clickedcollar=false; $(".et-coller-fabric").css({"top": "10%"}); $(this).addClass('st-advance-editor-active-history'); } else { clickedcollar=true; $(".et-coller-fabric").css({"top": "-100%"}); }
	});
	var clickedslev=true;
	$("#sleeves").on('click', function(){
		if(clickedslev) { clickedslev=false; $(".et-sleeve-fabric").css({"top": "10%"}); $(this).addClass('st-advance-editor-active-history'); } else { clickedslev=true; $(".et-sleeve-fabric").css({"top": "-100%"}); }
	});
	var clickedfrnt=true;
	$("#fronts").on('click', function(){
		if(clickedfrnt) { clickedfrnt=false; $(".et-front-fabric").css({"top": "10%"}); $(this).addClass('st-advance-editor-active-history'); } else { clickedfrnt=true; $(".et-front-fabric").css({"top": "-100%"}); }
	});
	var clickedcuff=true;
	$("#cuffs").on('click', function(){
		if(clickedcuff) { clickedcuff=false; $(".et-cuffs-fabric").css({"top": "10%"}); $(this).addClass('st-advance-editor-active-history'); } else { clickedcuff=true; $(".et-cuffs-fabric").css({"top": "-100%"}); }
	});
	var clickedbotm=true;
	$("#bottms").on('click', function(){
		if(clickedbotm) { clickedbotm=false; $(".et-bottom-fabric").css({"top": "10%"}); $(this).addClass('st-advance-editor-active-history'); } else { clickedbotm=true; $(".et-bottom-fabric").css({"top": "-100%"}); }
	});
	var clickedbck=true;
	$("#backs").on('click', function(){
		if(clickedbck) { clickedbck=false; $(".et-back-fabric").css({"top": "10%"}); viewMainBack(); $(this).addClass('st-advance-editor-active-history'); } else { clickedbck=true; $(".et-back-fabric").css({"top": "-100%"}); }
	});
	var clickedbutn=true;
	$("#buttns").on('click', function(){
		if(clickedbutn) { clickedbutn=false; $(".et-buttons-fabric").css({"top": "10%"}); $(this).addClass('st-advance-editor-active-history'); } else { clickedbutn=true; $(".et-buttons-fabric").css({"top": "-100%"}); }
	});
	var clickedpockt=true;
	$("#pockts").on('click', function(){
		if(clickedpockt) { clickedpockt=false; $(".et-pockts-fabric").css({"top": "10%"}); $(this).addClass('st-advance-editor-active-history'); } else { clickedpockt=true; $(".et-pockts-fabric").css({"top": "-100%"}); }
	});
	var clickedmono=true;
	$("#monogrms").on('click', function(){
		if(clickedmono) { clickedmono=false; $(".et-monogram-fabric").css({"top": "10%"}); getmonogrmplace('46'); $(this).addClass('st-advance-editor-active-history'); } else { clickedmono=true; $(".et-monogram-fabric").css({"top": "-100%"}); }
	});
	var clicked2=true;
	$("div.et-bottom-wrp div.ad-option-2").on('click', function(){
		if(clicked2){
			clicked2=false;
			$(".et-all-fabric").css({"top": 0});
			$(".et-for-fabric").css({"bottom": "-100%"});
		}else{
			clicked2=true;
			$(".et-all-fabric").css({"top": "-100%"});
		}
	});
</script>
<script language="javascript" type="text/javascript">
function hidediv(str){
	clicked=true; clicked2=true; clickedcollar=true; clickedslev=true; clickedfrnt=true; clickedcuff=true; clickedbotm=true; clickedbck=true; clickedbutn=true; clickedpockt=true; clickedmono=true;
	$("."+str).css({"top": "-100%"});
	hideMenu();
	viewMainFront();
}
</script>



<script type="text/javascript">
$("#stand").click(function(){

   var setarr = $('#setarr').val();
   var frntviewfinal = $('#frntviewfinal').val();
   var bkviewfinal = $('#bkviewfinal').val();
   var mpattern = $('#mpattern').val();
   var sizetyp = $('#sizetyp:checked').val();
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
               url:'/advance3D/postfdataurl',
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
               url:'/advance3D/postbdataurl',
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
               url:'/advance3D/postcart',
               data:{setarr:setarr,mpattern:mpattern,selstdqty:selstdqty,selsize:selsize,sizetyp:sizetyp,rndvalue:rndvalue,},
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


	var bsizeNeck = $('#bsizeNeck').val();
	var bsizeChest = $('#bsizeChest').val();
	var bsizeWaist = $('#bsizeWaist').val();
	var bsizeHip = $('#bsizeHip').val();
	var bsizeLength = $('#bsizeLength').val();
	var bsizeShoulder = $('#bsizeShoulder').val();
	var bsizeSleeve = $('#bsizeSleeve').val();
	var bsizeSleeve = $('#bsizeSleeve').val();
	var bsizetyp = $('.bsizetyp:checked').val();
	var fitstyle = $('#fitstyle:checked').val();
	var setarr = $('.bsetarr').val();
   var frntviewfinal = $('.bfrntviewfinal').val();
   var bkviewfinal = $('.bbkviewfinal').val();
   var mpattern = $('#bmpattern').val();
   var selbodyqty = $('#selbodyqty').val();
   var rndvalue = $('#brndvalue').val();


  if (rndvalue!='') {
	    $.ajax({
               type:'POST',
               url:'/advance3D/postfdataurl',
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
               url:'/advance3D/postbdataurl',
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
               url:'/advance3D/postcart',
               data:{bsizeNeck:bsizeNeck,bsizeChest:bsizeChest,bsizeWaist:bsizeWaist,bsizeHip:bsizeHip,bsizeLength:bsizeLength,bsizeShoulder:bsizeShoulder,bsizeSleeve:bsizeSleeve,bsizetyp:bsizetyp,fitstyle:fitstyle,setarr:setarr,mpattern:mpattern,selbodyqty:selbodyqty,rndvalue:rndvalue,},
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
</html>
