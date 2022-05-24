@extends('voyager::master')

@section('css')
<link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/database.css">
<style type="text/css">
    .st-dt-order-list-wrap .item-short-desc{float: left; padding-left: 12px; font-size: 12px}
    .st-dt-order-list-wrap .st-item-desc img{float: left;}
</style><!-- end style for order list-->
<!-- style for order details view -->
<style type="text/css">
    .st-box-left{width: 50%; float: left;}
    .st-mf-list .st-mf-item, .st-indiv-block, .st-box-bottom{width: 100%; float: left;}
    .st-mf-list, .st-mg-list{list-style-type: none; margin: 0;float: left; width: 100%; padding: 0;}
    .st-mf-list .st-mf-item label, .st-mf-list .st-mf-item span{width: 50%; float: left;}
    .st-mf-list .st-mf-item label:after{content: ':'; display: block; position: absolute; right: 0; top: 0; color: #fff;}
    .st-mf-list .st-mf-item span figure{display: inline-block;}
    .full-width{width: 100%; float: left;}
    .st-content-box{background: #f8f8f8; padding-left:20px; padding-top:10px; padding-bottom:10px;}
    .st-box-right{width: 50%; float: right;}
    .st-indiv-block .st-mf-list [class*="st-mf-"]{width: 50%; float: left;}
    .st-indiv-block h5{margin: 15px 0;}
    .st-mg-list [class*="st-mg-"] {display: inline-block;}
    .st-small-box{width: 100%; float: left; background-color: #0c0703; text-align: center;}       
    .st-small-box .mg-title{ color: #fff; width: 100%; float: left; background-color: #625d5a; padding: 2px 7px;}
    .st-small-box .mg-size { color: #ac56d5; padding: 7px 0; width: 100%;  float: left;}
    .st-remove-btn{padding: 8px; background: #242c32; position: absolute; right: 12px; top: -88px;}
    .st-remove-btn img{width: 24px;}
	.mr-bt{margin-bottom: 10px;}
	.st-mf-hef .pt-mf-item label{width: 25%;}
</style>
<!-- end style for order details view -->
@stop

@section('page_header')
<!-- <canvas id="frontcanvas" width="340" height="417" style="display:none"></canvas> -->
<!-- <canvas id="backcanvas" width="340" height="417" style="display:none"></canvas> -->
<script type="text/javascript" src="{{asset('asset/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/bootstrap.min.js')}}"></script>
<!-- Bootstrap bootstrap-touch-slider Slider Main JS File -->
<script type="text/javascript" src="{{asset('asset/js/float-panel.js')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/responsive_bootstrap_carousel.js')}}"></script>
<!--<script type="text/javascript" src="{{asset('asset/js/jquery.touchSwipe.min.js')}}"></script>-->
<script type="text/javascript" src="{{asset('asset/js/bootstrap-touch-slider.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/fabric.min.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/jcart.js')}}"></script> 
<script type="text/javascript">var url = "{{asset('/storage/')}}";</script>

<h1 class="page-title">
    <i class="voyager-data"></i>Product Details:
</h1>
@stop

@section('content')
<style>
/* new added 3piece style */
.box-view-design{
    left: 80px;
    position: absolute;
    top: 200px;
    z-index: 1;
}
.pt-image-div-2 {
    width: 45px;
    height: 70px;
    float: left;
    position: relative;
    background-color: #0c0909;
    border: 1px solid #544545;
    margin: 5px 0px;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
}
.pt-image-div-2:hover {
    box-shadow: 0px 0px 10px #1c8bbc;
    transition-duration: 20ms;
}
.box-view-design ul li{
    list-style: none;
}
.pt-image-div {
    text-align: center;
}
</style>
<div class="page-content container-fluid">
    <div class="box-view-design">
        <ul>
            <li>
                <div class="pt-image-div-2" onClick="showContent('jacket')">
                    <img src="{{asset('demo/img/product/threepiece-jacket.png')}}" 
                    style="height:55px;width: 37px;" />
                </div>
            </li>
            <li>
                <div class="pt-image-div-2" onClick="showContent('pant')">
                    <img src="{{asset('demo/img/product/threepiece-pant.png')}}"
                    style="height:69px;width: 32px;" />
                </div>
            </li>
        </ul>
    </div>
    <!-- ================================ jacket data ================================ -->
    <div id="container_jacket" class="row tab-container">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
    				<?php
                        $description=unserialize($data->item_description);
                    ?>
                    <!-- single order list view start here -->
                    <div class="col-sm-4">
                        <div class="st-img-box">
                            <div class="pt-men-left main-front-etstyle" id="main-front-etstyle">
                                <div id="plod" style="display:block; width:80px; position: absolute;left: 30%; top: 35%;">
                                    <img width="80" src="{{URL::asset('asset/img/page-loader.gif')}}">
                                </div>
                                <div class="pt-image-div">
                                    <img src="{{URL::asset('/storage/'.$data->canvas_front_img)}}"/>
                                </div> 
                                <div class="pt-price-shirt" >
                                    <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBack('etstyle');">BACK VIEW </a>
                                </div>  
                            </div>
                            <div class="pt-men-left main-back-etstyle" id="main-back-etstyle"  style="display:none;">
                                <div class="pt-image-div">
                                    <img src="{{URL::asset('/storage/'.$data->canvas_back_img)}}"/>
                                </div> 
                                <div class="pt-price-shirt" >
                                    <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFront('etstyle');">FRONT VIEW </a>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <?php                          
                        $attstycode = App\Http\helpers::alltebinfo('attribute_styles',$description['ostyle'],'style_code');
                    ?>
                    <div class="col-sm-8">
                        <a href="{{ url()->previous() }}" class="st-remove-btn"><img src="{{asset('asset/img/remove.png')}}"></a>
                        <div class="st-content-box full-width">
                            <div class="st-box-left">
                                <ul class="st-mf-list">
                                    <li class="st-mf-item"><label>Fabric</label><span>{{$description['ofabricName']}} <figure> <img src="{{URL::asset('/storage/'.$description['ofabricImage'])}}" alt="{{$description['ofabricName']}}" title="{{$description['ofabricName']}}" width="10%"></figure></span></li>
                                        <li class="st-mf-item"><label>Style</label><span>{{$description['ostyleName']}}</span></li>
                                        <li class="st-mf-item"><label>Lapel</label><span>{{$description['olapelName']}}</span></li>
                                        <li class="st-mf-item"><label>Lapel Hole</label><span>{{$description['olapelHoleName']}}</span></li>
                                        <li class="st-mf-item"><label>Jacket bottom</label><span>{{$description['obottomName']}}</span></li>
                                        <!-- <li class="st-mf-item"><label>Jacket Button</label><span><?php echo $attstycode;?></span></li>-->
                                        <li class="st-mf-item"><label>Jacket Pocket</label><span>{{$description['opacketName']}} @if($description['obreastPacket']=='true')with Breast Pocket @endif</span></li>
                                        <li class="st-mf-item"><label>Jacket Sleeve Bu..</label><span>{{$description['osleeveButnStyle']}}</span></li>
                                        <li class="st-mf-item"><label>Jacket Vent</label><span>{{$description['oventName']}}</span></li>
                                        <li class="st-mf-item"><label>Buttons & Thread</label><span>{{$description['obuttonName']}} Button { {{$description['obuttonCode']}} } , <br>{{{$description['obuttonHoleName']}}} { {{$description['obuttonHoleCode']}} }</span></li>
                                        <li class="st-mf-item"><label>Monogram</label><span>{{$description['omonogramName']}} @if($description['omonogramName']!='No Monogram'), Color : {{$description['omonogramCode']}}@endif</span></li>                                         
                                </ul>
                            </div>
                            <div class="st-box-right">
                                <ul class="st-mf-list mr-bt st-mf-hef">
                                <li class="pt-mf-item"><label>Lining</label> : <span>{{$description['oliningName']}}</span></li>
                                <li class="pt-mf-item"><label>Pining Color</label> : <span>{{$description['opipingName']}}</span></li>
                                <li class="pt-mf-item"><label>Back Collar</label> : <span>{{$description['obackCollarName']}}</span></li>
                                    <li class="pt-mf-item"><label>Contrast</label> : <span>{{$description['ocontrastName']}} <img src="{{URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['ocontrast'],'contrsfab_img'))}}" width="24"  alt="{{$description['ocontrastName']}}" title="{{$description['ocontrastName']}}"></span></li>
                                </ul>
                                <?php

                                    $olapelupper = App\Http\helpers::optionval($description['olapelupper']);
                                    $olapellower = App\Http\helpers::optionval($description['olapellower']);
                                    $ocontpockets = App\Http\helpers::optionval($description['ocontpockets']);
                                    $ocontchestpocket = App\Http\helpers::optionval($description['ocontchestpocket']);
                                    $ocontelbowmix = App\Http\helpers::optionval($description['ocontelbowmix']);
                                ?>
                                <div class="st-indiv-block">
                                    <h5>Contrast Fabric</h5>
                                    <ul class="st-mf-list">
                                        <li class="st-mf-item"><label>Lapel Upper</label><span>{{$olapelupper}}</span></li>
                                        <li class="st-mf-item"><label>Lapel Lower</label><span>{{$olapellower}}</span></li> 
                                    </ul>
                                </div>
                                <div class="st-indiv-block">                                   
                                    <ul class="st-mf-list">
                                        <li class="st-mf-item"><label>Pockets</label><span>{{$ocontpockets}}</span></li>
                                            <li class="st-mf-item"><label>Chest Pocket</label><span>{{$ocontchestpocket}}</span></li>
                                    </ul>
                                </div>
                                <div class="st-indiv-block">
                                    <ul class="st-mf-list">
                                        <li class="st-mf-item"><label>Elbow Mix</label><span>{{$ocontelbowmix}}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="st-box-bottom">
                                <h5><span>Type Measure :</span> {{$description['osizePattern']}} , {{$description['osizeStyle']}} 
                                   @if($description['osizePattern']=='Standard'), Size SML : {{$description['osizeFit']}} , Fit : Regular @endif { {{$description['osizeType']}} }
                                </h5>
                                <ul class="st-mg-list">
                                    <li class="st-mg-item">
                                        <div class="st-small-box">
                                            <span class="mg-title">Chest</span>
                                            <span class="mg-size">{{$description['osizeChest']}}</span>
                                        </div>
                                    </li>
                                    <li class="st-mg-item">
                                        <div class="st-small-box">
                                            <span class="mg-title">Waist</span>
                                            <span class="mg-size">{{$description['osizeWaist']}}</span>
                                        </div>
                                    </li>
                                    <li class="st-mg-item">
                                        <div class="st-small-box">
                                            <span class="mg-title">Hip</span>
                                            <span class="mg-size">{{$description['osizeHip']}}</span>
                                        </div>
                                    </li>
                                    <li class="st-mg-item">
                                        <div class="st-small-box">
                                            <span class="mg-title">Shoulder</span>
                                            <span class="mg-size">{{$description['osizeShoulder']}}</span>
                                        </div>
                                    </li>
                                    <li class="st-mg-item">
                                        <div class="st-small-box">
                                            <span class="mg-title">Sleeve</span>
                                            <span class="mg-size">{{$description['osizeSleeve']}}</span>
                                        </div>
                                    </li>
                                    <li class="st-mg-item">
                                        <div class="st-small-box">
                                            <span class="mg-title">Length</span>
                                            <span class="mg-size">{{$description['osizeLength']}}</span>
                                        </div>
                                    </li>
                                </ul>
                                <!-- ====================== new added for body type =============================== -->
                                <ul class="st-mg-list">
                                    <?php if(!empty($description['body_type_front'])): ?>
                                        <li class="st-mg-item" style="margin-top:5px;margin-right:5px;">
                                            <div class="st-small-box">
                                                <span class="mg-title">Body Type Front</span>
                                                <span class="mg-size">{{$description['body_type_front']}}</span>
                                                <?php $b_type = $description['body_type_front']; ?>
                                                <figure style="margin-bottom:10px;">
                                                    <img src="{{asset('/asset/img/body_type/front_'.$b_type.'.png')}}" alt="" style="width:100px;">
                                                </figure>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(!empty($description['body_type_back'])): ?>
                                        <li class="st-mg-item" style="margin-top:5px;margin-right:5px;">
                                            <div class="st-small-box">
                                                <span class="mg-title">Body Type Back</span>
                                                <span class="mg-size">{{$description['body_type_back']}}</span>
                                                <?php $b_type = $description['body_type_back']; ?>
                                                <figure style="margin-bottom:10px;">
                                                    <img src="{{asset('/asset/img/body_type/back_'.$b_type.'.png')}}" alt="" style="width:100px;">
                                                </figure>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(!empty($description['body_type_shoulder'])): ?>
                                        <li class="st-mg-item" style="margin-top:5px;margin-right:5px;">
                                            <div class="st-small-box">
                                                <span class="mg-title">Body Type Shoulder</span>
                                                <span class="mg-size">{{$description['body_type_shoulder']}}</span>
                                                <?php $b_type = $description['body_type_shoulder']; ?>
                                                <figure style="margin-bottom:10px;">
                                                    <img src="{{asset('/asset/img/body_type/shoulder_'.$b_type.'.png')}}" alt="" style="width:100px;">
                                                </figure>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(!empty($description['body_type_stomach'])): ?>
                                        <li class="st-mg-item" style="margin-top:5px;margin-right:5px;">
                                            <div class="st-small-box">
                                                <span class="mg-title">Body Type Stomach</span>
                                                <span class="mg-size">{{$description['body_type_stomach']}}</span>
                                                <?php $b_type = $description['body_type_stomach']; ?>
                                                <figure style="margin-bottom:10px;">
                                                    <img src="{{asset('/asset/img/body_type/stomach_'.$b_type.'.png')}}" alt="" style="width:100px;">
                                                </figure>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                                <!-- ====================== end for body type ===================================== -->
                            </div>
                        </div>
                    </div> 
                <!-- single order list view -->
                </div>
            </div>
        </div>
    </div>
    <!-- ================================ pant data ================================ -->
    <div id="container_pant" class="row tab-container" style="display:none;">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <?php
                        $description=unserialize($data->item_description);
                    ?>
                    <!-- single order list view start here -->
                    <div class="col-sm-4">
                        <div class="st-img-box">
                            <div class="pt-men-left main-front-etstyle" id="main-front-etstyle">
                                <div class="pt-image-div">
                                    <img src="{{URL::asset('/storage/'.$description['pant_frntviewfinal'])}}"/>
                                </div> 
                                <div class="pt-price-shirt" >
                                    <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBack('etstyle');">BACK VIEW </a>
                                </div>  
                            </div>
                            <div class="pt-men-left main-back-etstyle" id="main-back-etstyle"  style="display:none;">
                                <div class="pt-image-div">
                                    <img src="{{URL::asset('/storage/'.$description['pant_bkviewfinal'])}}"/>
                                </div> 
                                <div class="pt-price-shirt" >
                                    <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFront('etstyle');">FRONT VIEW </a>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <?php                          
                        $attstycode = App\Http\helpers::alltebinfo('attribute_styles',$description['ostyle'],'style_code');
                    ?>
                    <div class="col-sm-8">
                        <a href="{{ url()->previous() }}" class="st-remove-btn"><img src="{{asset('asset/img/remove.png')}}"></a>
                        <div class="st-content-box full-width">
                            <div class="st-box-left">
                                <ul class="st-mf-list">
                                    <li class="st-mf-item"><label>Fabric</label><span>{{$description['pant_ofabricName']}} <figure> <img src="{{URL::asset('/storage/'.$description['pant_ofabricImage'])}}" alt="{{$description['pant_ofabricName']}}" title="{{$description['pant_ofabricName']}}" width="10%"></figure></span></li>
                                    <li class="st-mf-item"><label>Style</label><span>{{$description['pant_ostyleName']}}</span></li>
                                    <li class="st-mf-item"><label>Pleats</label><span>{{$description['pant_opleatName']}} </span></li>
                                    <li class="st-mf-item"><label>Front Pockets</label><span>{{$description['pant_opacketName']}}</span></li>
                                    <li class="st-mf-item"><label>Back Pockets</label><span>{{$description['pant_obackpocktName']}}</span></li>
                                    <li class="st-mf-item"><label>Back Pocket Position</label><span>{{$description['pant_obackpocktSide']}}</span></li>
                                    <li class="st-mf-item"><label>Pant Closure</label><span>{{$description['pant_owaistbandedge']}}</span></li>
                                    <li class="st-mf-item"><label>Belt Loops</label><span>{{$description['pant_obeltloopName']}}</span></li>
                                    <li class="st-mf-item"><label>Cuffs</label><span>{{$description['pant_ocuffName']}}</span></li>
                                    <li class="st-mf-item"><label>Buton Color</label><span>{{$description['pant_obuttonCode']}} { {{$description['pant_obuttonName']}} }</span></li>
                                    <li class="st-mf-item"><label>Thread Color</label><span>{{$description['pant_obuttonHoleCode']}} {  {{$description['pant_obuttonHoleName']}}  }</span></li>                 
                                </ul>
                            </div>
                            <div class="st-box-right">
                                <?php
                                    $ocontbeltloop = App\Http\helpers::optionval($description['pant_ocontbeltloop']);
                                    $ocontbackpockets = App\Http\helpers::optionval($description['pant_ocontbackpockets']);

                                ?>                                  
                                <ul class="st-mf-list">
                                    <li class="pt-mf-item"><label>Contrast</label> : <span>{{$description['pant_ocontrastName']}} <img src="{{URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['pant_ocontrast'],'contrsfab_img'))}}" width="24"    alt="{{$description['pant_ocontrastName']}}" title="{{$description['pant_ocontrastName']}}"></span></li>
                                </ul>
                                <div class="st-indiv-block">
                                    <h5>Collar Contrast</h5>
                                    <ul class="st-mf-list">                                    
                                        <li class="st-mf-item"><label>Belt Loops</label><span>{{$ocontbeltloop}}</span></li>
                                        <li class="st-mf-item"><label>Back Pockets</label><span>{{$ocontbackpockets}}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="st-box-bottom">
                                <h5><span>Type Measure :</span> {{$description['osizePattern']}} , {{$description['osizeStyle']}} @if($description['osizePattern']=='Standard'), Size SML : {{$description['osizeFit']}} @endif { {{$description['osizeType']}} }</h5>
                                <ul class="st-mg-list">
                                    <li class="st-mg-item">
                                        <div class="st-small-box">
                                            <span class="mg-title">Waist</span>
                                            <span class="mg-size">{{$description['pant_osizeWaist']}}</span>
                                        </div>
                                    </li>
                                    <li class="st-mg-item">
                                        <div class="st-small-box">
                                            <span class="mg-title">Hip</span>
                                            <span class="mg-size">{{$description['pant_osizeHip']}}</span>
                                        </div>
                                    </li>
                                    <li class="st-mg-item">
                                        <div class="st-small-box">
                                            <span class="mg-title">Crotch</span>
                                            <span class="mg-size">{{$description['pant_osizeCrotch']}}</span>
                                        </div>
                                    </li>
                                    <li class="st-mg-item">
                                        <div class="st-small-box">
                                            <span class="mg-title">Thigh</span>
                                            <span class="mg-size">{{$description['pant_osizeThigh']}}</span>
                                        </div>
                                    </li>
                                     <li class="st-mg-item">
                                        <div class="st-small-box">
                                            <span class="mg-title">Length</span>
                                            <span class="mg-size">{{$description['pant_osizeLength']}}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> 
                <!-- single order list view -->
                </div>
            </div>
        </div>
    </div>
    <!-- ================================ end data ================================ -->
</div>
<script>
$(document).ready(function(e) {		
$("#plod").delay(2000).hide(0);

});
function showContent(cat){
    $('.tab-container').css('display','none');
    $('#container_'+cat).css('display','block');
}
</script>
@stop

@section('javascript')

    <!-- DataTables -->

<script>
	$(document).ready(function () {
		$('#dataTable').DataTable({ "order": [] });
	});
$('td').on('click', '.delete', function (e) {
	var form = $('#delete_form')[0];
	form.action = parseActionUrl(form.action, $(this).data('id'));
	$('#delete_modal').modal('show');
});

function parseActionUrl(action, id) {
		return action.match(/\/[0-9]+$/)
				? action.replace(/([0-9]+$)/, id)
				: action + '/' + id;
	}

</script>

@stop



<script type="text/javascript">
function viewMainBack(str){
    $(".main-front-"+str).css('display','none');
    $(".main-back-"+str).css('display','block');
}

function viewMainFront(str){
    $(".main-front-"+str).css('display','block');
    $(".main-back-"+str).css('display','none');
}
</script>