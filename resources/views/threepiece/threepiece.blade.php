<?php  $seo = App\Http\Helpers::page_seo_details(14);?>
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
 <title>Duniya Tailor | {{$seo['meta_title']}}</title>
<meta name="keywords" content="Duniya Tailor | {{$seo['meta_keyword']}}">
<meta name="description" content="Duniya Tailor | {{$seo['meta_desc']}}">
<meta name="description" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Favicon
============================================ -->
<link rel="shortcut icon" type="image/x-icon" href="{{asset('asset/img/favicon.ico')}}">
<!-- CSS 
============================================ -->
<link rel="stylesheet" type="text/css" href="{{asset('demo/css/stylethreepiece.css?v4')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{asset('demo/css/bootstrap.min.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{asset('demo/css/font-awesome.min.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('demo/css/bootstrap-touch-slider.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('demo/css/responsive_bootstrap_carousel_mega_min.css')}}" media="screen">
<script type="text/javascript" src="{{asset('demo/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/jquery-1.11.3.min.js')}}"></script>
<!-- Loader -->
<script type="text/javascript" src="{{asset('demo/js/jquery.DEPreLoad.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {var l=$("#loadme").val();if(l==0){setTimeout(function(){$("#depreload .wrapper").animate({ opacity: 1 });}, 40);setTimeout(function(){$("#depreload .logo").animate({ opacity: 1 });}, 600);var canvas  = $("#depreload .line")[0],context = canvas.getContext("2d");context.beginPath();context.arc(280, 280, 260, Math.PI * 1.5, Math.PI * 1.6);context.strokeStyle = '#9e792b';context.lineWidth = 5;context.stroke();var loader = $("html").DEPreLoad({OnStep: function(percent) {console.log(percent + '%');$("#depreload .line").animate({ opacity: 1 });$("#depreload .perc").text(percent + "%");if (percent > 5) {context.clearRect(0, 0, canvas.width, canvas.height);context.beginPath();context.arc(280, 280, 260, Math.PI * 1.5, Math.PI * (1.5 + percent / 50), false);context.stroke();}},OnComplete: function() {console.log('Everything loaded!');$("#depreload").hide(100);$("#depreload .perc").text("done");$("#depreload .loading").animate({ opacity: 0 });}});}});
</script>
<!-- Loader Ends -->
</head>
<body class="designshirt"> 
<style>

</style> 
<input type="hidden" name="loadme" id="loadme" value="<?php echo $activeload = isset($loadme) ? $loadme : '0'; ?>">

@if($loadme==0)
<div id="depreload" style="background-image:url({{asset('demo/img/product/bg.jpg')}});" class="table et-loader">
    <div class="table-cell wrapper">
        <div class="circle">
            <canvas class="line" width="560px" height="560px"></canvas>
            <img src="{{asset('demo/img/logo.png')}}" class="logo" alt="logo" />
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
                    @include('../layouts.inc.login')
                </div>
            </div>
        </div>
    </div>
    <!-- DESIGN AREA -->
    <div class="pt-design">  
        <!-- Container Start -->     
        <div class="container">
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
            <div class="row custom-main-content mb75">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                 @include('../layouts.inc.rating')
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="pt-customer">
                                <p class="bd-pt">Duniya Tailor</p> 
                                <p>CUSTOMIZER</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="total-price-div">
                                <p>
                                    <span class="fn-skyblue" data-lang="suit3pcs">3Piece Suit</span></br>
                                    <span class="span-jack">{ 1 <l data-lang="jacket">Jacket</l>, 1 <l data-lang="pant">Pant</l> , 1 <l data-lang="vest">Vest</l> } </span> &nbsp;&nbsp;
                                    <span id="threepiece_total" class="price fn-red">${{number_format($first_price,2)}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="box-view-design">
                        <ul>
                            <li>
                                <div class="pt-image-div-2" onClick="showStyleByImg('jacket')">
                                    <img src="{{asset('demo/img/product/threepiece-jacket.png')}}" 
                                    style="height:65px;width: 45px;" />
                                </div>
                            </li>
                            <li>
                                <div class="pt-image-div-2" onClick="showStyleByImg('pant')">
                                    <img src="{{asset('demo/img/product/threepiece-pant.png')}}"
                                    style="height:75px;width: 35px;" />
                                </div>
                            </li>
                            <li>
                                <div class="pt-image-div-2" onClick="showStyleByImg('vest')">
                                    <img src="{{asset('demo/img/product/threepiece-vest.png')}}"
                                    style="height:65px;width: 40px;" />
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="custom-menu">
                        <div class="custom-main-menu">                    
                            <nav>
                                <ul class="mcd-menu">
                                    <li>
                                        <a class="main-menu-link active" id="main_menu_etfabric" onclick="openNav(this,'etfabric')">
                                            <p>1. FABRIC</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="main-menu-link" id="main_menu_etstyle" onclick="openNav(this,'etstyle')">
                                            <p>2. STYLE</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="main-menu-link" id="main_menu_etcontrast" onclick="openNav(this,'etcontrast')">
                                            <p>3. COLOR CONTRAST</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="main-menu-link" id="main_menu_etmeasurement" onclick="openNav(this,'etmeasurement')">
                                            <p>4. MEASUREMENTS</p>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <div id="mySidenav" class="sidenav">
                                <ul class="mcd-sub-menu sub-menu-etfabric">
                                    <?php $i = 0; ?>
                                    <?php foreach($fabric_ary as $gr): ?>
                                        <li>
                                            <a class="link menu-link <?=$i==0?'active':'' ?>" id="sub_menu_{{$gr['jacket']->id}}" onClick="openPgContent(this,'menu-fabric{{$gr['jacket']->id}}','etfabricjacket','{{$gr['jacket']->id}}','menu-fabric','fabric');">
                                                <p>{{$gr['jacket']->fbgrp_name}}</p>
                                                <?php
                                                $frate = 0;
                                                if($gr['jacket']->fabric_offer_price > 0 && $gr['jacket']->fabric_offer_price != '') {
                                                    if(!empty($gr['jacket']->fabric_offer_price)){
                                                        $frate += $gr['jacket']->fabric_offer_price;
                                                    }
                                                }else{
                                                    if(!empty($gr['jacket']->fabric_rate)){
                                                        $frate += $gr['jacket']->fabric_rate;
                                                    }
                                                }
                                                if($gr['pant']->fabric_offer_price > 0 && $gr['pant']->fabric_offer_price != ''){
                                                    if(!empty($gr['pant']->fabric_offer_price)){
                                                        $frate += $gr['pant']->fabric_offer_price;
                                                    }
                                                }else{
                                                    if(!empty($gr['pant']->fabric_rate))
                                                        $frate += $gr['pant']->fabric_rate;
                                                }
                                                if($gr['vest']->fabric_offer_price > 0 && $gr['vest']->fabric_offer_price != ''){
                                                    if(!empty($gr['vest']->fabric_offer_price)){
                                                        $frate += $gr['vest']->fabric_offer_price;
                                                    }
                                                }else{
                                                    if(!empty($gr['vest']->fabric_rate))
                                                        $frate += $gr['vest']->fabric_rate;
                                                }
                                                ?>
                                                <p class="fabric-price">${{number_format($frate,2)}}</P>
                                            </a>
                                        </li>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </ul>
                                <ul class="mcd-sub-menu sub-menu-etstyle" style="display:none;">
                                    <li>
                                        <a class="link s-title menu-link" onClick="showStyle('jacket')">Jacket</a>
                                        <ul class="m-style-jacket">
                                            <?php $smi=1;?>
                                            @foreach($mainattr_jacket_record as $mattr)
                                                <li>
                                                    <a class="link s-sub-link menu-link" id="sub_menu_{{$mattr->id}}" onClick="openPgContent(this,'menu-{{$mattr->id}}','etstylejacket','{{$mattr->id}}','{{$mattr->attribute_name}}','style');">
                                                        <p>{{$mattr->attribute_name}}</p>
                                                    </a>
                                                </li>
                                                <?php $smi++;?>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="link s-title menu-link" onClick="showStyle('pant')">Pant</a>
                                        <ul class="m-style-pant" style="display: none;">
                                            <?php $smi=1;?>
                                            @foreach($mainattr_pant_record as $mattr)
                                                <li>
                                                    <a class="link s-sub-link menu-link" id="sub_menu_{{$mattr->id}}" onClick="openPgContent(this,'menu-{{$mattr->id}}','etstylepant','{{$mattr->id}}','{{$mattr->attribute_name}}','style');">
                                                        <p>{{$mattr->attribute_name}}</p>
                                                    </a>
                                                </li>
                                                <?php $smi++;?>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="link s-title menu-link" onClick="showStyle('vest')">Vest</a>
                                        <ul class="m-style-vest" style="display: none;">
                                            <?php $smi=1;?>
                                            @foreach($mainattr_record as $mattr)
                                                <li>
                                                    <a class="link s-sub-link menu-link" id="sub_menu_{{$mattr->id}}" onClick="openPgContent(this,'menu-{{$mattr->id}}','etstyle','{{$mattr->id}}','{{$mattr->attribute_name}}','style');">
                                                        <p>{{$mattr->attribute_name}}</p>
                                                    </a>
                                                </li>
                                                <?php $smi++;?>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="mcd-sub-menu sub-menu-etcontrast" style="display:none;">
                                    <?php $cmi=1;?>
                                    @foreach($contrast_jacker_record as $contlst)
                                        <li>
                                            <a class="link menu-link" id="sub_menu_{{$contlst->id}}" onClick="openPgContent(this,'menu-{{$contlst->id}}','etcontrastjacket','{{$contlst->id}}','{{$contlst->attribute_name}}','contrast');">
                                                <p>{{$contlst->attribute_name}}</p>
                                            </a>
                                        </li>
                                        <?php 
                                            if($cmi == 1){ 
                                                $cmi++;
                                        ?>      
                                                <li>
                                                    <a class="link menu-link" id="sub_menu_54" onClick="openPgContent(this,'menu-54','etcontrastpant','54','Pant Contrast','contrast');">
                                                        <p>Pant Contrast</p>
                                                    </a>
                                                </li>
                                                <?php $cmi++; ?>
                                                <li>
                                                    <a class="link menu-link" id="sub_menu_40" onClick="openPgContent(this,'menu-40','etcontrast','40','Vest Contrast','contrast');">
                                                        <p>Vest Contrast</p>
                                                    </a>
                                                </li>
                                        <?php
                                            }
                                        ?>
                                        <?php $cmi++;?>
                                    @endforeach
                                </ul>
                                <ul class="mcd-sub-menu sub-menu-etmeasurement" style="display:none;">
                                    <li>
                                        <a class="link menu-link" id="bodysize_link" onClick="openPgContent(this,'','etmeasurementjacket','','bodysize','measurement');">
                                            <p>Body Size</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="link menu-link" id="standardsize_link" onClick="openPgContent(this,'','etmeasurementjacket','','standardsize','measurement');">
                                            <p>Standard Size</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 custom-right-content">
                    <!-- TABS START -->
                    <div class="threepiece-content">
                        @include('threepiece.jacket')
                        @include('threepiece.pants')
                        @include('threepiece.vest')
                    </div>                
                    <!-- TABS ENDS -->
                </div>
            </div>
            
        </div> 
        <!-- Container Ends-->
    </div>
    <!-- DESIGN AREA ENDS -->  
    <!-- FOOTER SECTION -->
    @include('../layouts.inc.footer-desgin')
    <!-- FOOTER SECTION END -->
    <canvas id="frontcanvas" width="313" height="421" style="display:none"></canvas>
    <canvas id="backcanvas" width="313" height="421" style="display:none"></canvas>
    <canvas id="sidecanvas" width="313" height="421" style="display:none"></canvas>

    <canvas id="frontcanvas2" width="313" height="421" style="display:none"></canvas>
    <canvas id="backcanvas2" width="313" height="421" style="display:none"></canvas>

    <canvas id="frontcanvas3" width="313" height="421" style="display:none"></canvas>
    <canvas id="backcanvas3" width="313" height="421" style="display:none"></canvas>
    <canvas id="sidecanvas3" width="313" height="421" style="display:none"></canvas>
</section>
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
<script type="text/javascript" src="{{asset('demo/js/threepieceprocessnew.js?v0')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/threepiece-pants-new.js?v1')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/threepiece-vests-new.js?v1')}}"></script>
<!-- Bootstrap Side Menu JS File -->
<script language="javascript" type="text/javascript">
$(document).ready(function(e) {
    //for jacket ========================================
    var stid="menu-"+$('#tabJacketSActiveId').val();
    var stab=$('#tabJacketSActiveId').val();
    getTabJacketSect($('#tabJacketActiveId').val());
    getPgJacketOption(stid,$('#tabJacketActiveId').val(),$('#tabJacketSActiveId').val(),'');
    frontdesignJacketProcess(<?php echo json_encode($eJacketTailorObj);?>);
    backdesignJacketProcess(<?php echo json_encode($eJacketTailorObj);?>);
    sidedesignJacketProcess(<?php echo json_encode($eJacketTailorObj);?>);
    changeJacketSizeDetails();
    //for pants =========================================
    var stid="menu-"+$('#tabPantSActiveId').val(); 
    var stab=$('#tabPantSActiveId').val(); 
    getTabPantSect($('#tabPantActiveId').val());
    getPgPantOption(stid,$('#tabPantActiveId').val(),$('#tabPantSActiveId').val(),''); 
    frontdesignPantProcess(<?php echo json_encode($ePantTailorObj);?>); 
    backdesignPantProcess(<?php echo json_encode($ePantTailorObj);?>); 
    changePantSizeDetails();
    //for vests =========================================
    var stid="menu-"+$('#tabSActiveId').val(); 
    var stab=$('#tabSActiveId').val(); 
    var newarr=$('#harr').val(); 
    getTabSect($('#tabActiveId').val()); 
    getPgOption(stid,$('#tabActiveId').val(),$('#tabSActiveId').val(),'');
    frontdesignProcess(JSON.parse(newarr)); 
    backdesignProcess(JSON.parse(newarr)); sidedesignProcess(JSON.parse(newarr)); 
    changeSizeDetails();
});

$(document).ready(function(){
    $(".et-ck-btn").click(function(){
        var cc=$("#crtcount").val();
        if(cc==0) { 
            alert("No item in the cart, please add 1");
        } else{  
            $(".et-ck-btn").attr("href","{{url('/cart')}}");
        }
    });
});

var selected_fabric = 6; // first fabric
function openNav(obj,tabstr) {
    // main menu tab active
    $(".main-menu-link").removeClass("active");
    $(".menu-link").removeClass("active");
    obj.classList.add("active");

    // sub menu first active
    if(tabstr == 'etfabric'){
        $('#sub_menu_'+selected_fabric).addClass('active');
    } else if(tabstr == 'etstyle'){
        $(".m-style-jacket li:first-child a").addClass("active");
        // show jacket style
        // $(".sub-menu-etstyle ul").css("display","none");
        // $(".m-style-jacket").css("display","block");
        $(".sub-menu-etstyle ul").hide().animate({ opacity: "0" }, 50 );
        $(".m-style-jacket").show().animate({ opacity: "1" }, 50 );
    } else if(tabstr == 'etcontrast'){
        $('#sub_menu_25').addClass('active');
    } else {
        $('#menu-mesure-jacket-main').css('display','block');
        $('#menu-mesure-jacket-standardsize').css('display','none');
        $('#menu-mesure-jacket-bodysize').css('display','none');
    }      

    // show sub menu
    $(".mcd-sub-menu").css("display","none");
    $(".sub-menu-"+tabstr).css("display","block");

    // content active and sub tab active
    $(".tab-pane").removeClass("active");
    var type1 = 'jacket';
    var type2 = 'pant';
    var type3 = '';
    getTabJacketSect(tabstr+type1);        
    $('#'+tabstr+type1).addClass('active');
    getTabPantSect(tabstr+type2);        
    $('#'+tabstr+type2).addClass('active');
    getTabSect(tabstr+type3);        
    $('#'+tabstr+type3).addClass('active');

    $("#container_jackets").css("display","block");
    $("#container_pants").css("display","none");
    $("#container_vests").css("display","none");
    
    if(tabstr == 'etfabric'){
        var sub_menu = document.getElementById("sub_menu_"+selected_fabric);
        openPgContent(sub_menu,'menu-fabric'+selected_fabric,'etfabricjacket',selected_fabric,'menu-fabric','fabric');
    }
}

function openPgContent(obj,str,tabstr,attrid,attrnm,tab_type) {
    // main menu tab active
    $(".mcd-sub-menu .link").removeClass("active");
    obj.classList.add("active");

    // content active
    if(tab_type == 'fabric'){
        selected_fabric = attrid;
        getPgJacketOption(str,tabstr,attrid,attrnm);
    } else if(tab_type == 'style'){
        if(tabstr == 'etstylejacket'){
            getPgJacketOption(str,tabstr,attrid,attrnm);
            $("#container_jackets").css("display","block");
            $("#container_pants").css("display","none");
            $("#container_vests").css("display","none");
        } else if(tabstr == 'etstylepant'){
            getPgPantOption(str,tabstr,attrid,attrnm);
            $("#container_jackets").css("display","none");
            $("#container_pants").css("display","block");
            $("#container_vests").css("display","none");
        } else {
            getPgOption(str,tabstr,attrid,attrnm);
            $("#container_jackets").css("display","none");
            $("#container_pants").css("display","none");
            $("#container_vests").css("display","block");
        }
    } else if(tab_type == 'contrast') {        
        if(tabstr == 'etcontrastjacket'){
            getPgJacketOption(str,tabstr,attrid,attrnm);
            $("#container_jackets").css("display","block");
            $("#container_pants").css("display","none");
            $("#container_vests").css("display","none");
        } else if(tabstr == 'etcontrastpant'){
            getPgPantOption(str,tabstr,attrid,attrnm);
            $("#container_jackets").css("display","none");
            $("#container_pants").css("display","block");
            $("#container_vests").css("display","none");
        } else {
            getPgOption(str,tabstr,attrid,attrnm);
            $("#container_jackets").css("display","none");
            $("#container_pants").css("display","none");
            $("#container_vests").css("display","block");
        }
    } else {
        showJacketMeasureSect(attrnm);
    }
}

function showJacketMeasureSect2(attrnm){
    // main menu tab active
    $(".mcd-sub-menu .link").removeClass("active");
    $('#'+attrnm+'_link').addClass('active');
    showJacketMeasureSect(attrnm);
}

function showStyleByImg(style_type) {
    $("#main_menu_etstyle").trigger("click");
    // $(".sub-menu-etstyle ul").css("display","none");
    // $(".m-style-"+style_type).css("display","block");
    $(".sub-menu-etstyle ul").hide().animate({ opacity: "0" }, 50 );
    $(".m-style-"+style_type).show().animate({ opacity: "1" }, 50 );

    $(".m-style-"+style_type+" .link").removeClass("active");
    $(".m-style-"+style_type+" li:first-child a").addClass("active");
    $(".m-style-"+style_type+" li:first-child a").trigger("click");
}

function showStyle(style_type) { //jacket, pant ,vest
    // $(".sub-menu-etstyle ul").css("display","none");
    // $(".m-style-"+style_type).css("display","block");
    $(".sub-menu-etstyle ul").hide().animate({ opacity: "0" }, 50 );
    $(".m-style-"+style_type).show().animate({ opacity: "1" }, 50 );

    $(".m-style-"+style_type+" .link").removeClass("active");
    $(".m-style-"+style_type+" li:first-child a").addClass("active");
    $(".m-style-"+style_type+" li:first-child a").trigger("click");
}

function showDetail(event,type){
    event.preventDefault();
    $(".tab-container").css("display","none");
    $("#container_"+type).css("display","block");
}

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
    // return;

    $.ajax({
        type:'POST',
        url:'/designthreepiece/postcart',
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
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data){
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
            url:'/designthreepiece/postcart',
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