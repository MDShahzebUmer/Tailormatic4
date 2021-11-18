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

    </style>

    <!-- end style for order details view -->

   

@stop

@section('page_header')

<canvas id="frontcanvas" width="340" height="417" style="display:none"></canvas>
<canvas id="backcanvas" width="340" height="417" style="display:none"></canvas>
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

<div class="page-content container-fluid">

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-bordered">

               

                <div class="panel-body">

                

	 <?php
      $description=unserialize($data->custom_description);
    ?>
	<script>
    $(document).ready(function(e) {
		var arr='<?php echo json_encode($description); ?>';
		designProcessing(JSON.parse(arr));
		});
    </script>

                <!-- single order list view start here -->

                    <div class="col-sm-4">

                        <div class="st-img-box">
                         <?php
                        $proimg = App\Http\helpers::get_proimg($data->id);
						?>

                          <div class="pt-men-left" id="main-front-etstyle">
<div id="plod" style="display:block; width:80px; position: absolute;left: 30%; top: 35%;"><img width="80" src="{{URL::asset('asset/img/page-loader.gif')}}"></div>
                                <div class="pt-image-div">

                                   <?php /*?> <img src="{{URL::asset('/storage/'.$proimg[0])}}"/><?php */?>
                                    <div id="main-front-1"><div class="pt-image-div"><img src="{{URL::asset('/storage/'.$proimg[0])}}"  alt="" width="340px"/></div></div>

                                </div>
                                <div class="pt-price-shirt" >

                                    <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBack('etstyle');">BACK VIEW </a>

                                </div>  

                            </div>

                            <div class="pt-men-left" id="main-back-etstyle"  style="display:none;">

                                <div class="pt-image-div">
                                    <?php /*?><img src="{{URL::asset('/storage/'.$proimg[1])}}"/><?php */?>
                                      <div id="main-back-1"><div class="pt-image-div"><img src=""  alt="" width="340px"/></div></div>
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

                        <a href="{{url('admin/productslists/')}}" class="st-remove-btn"><img src="{{asset('asset/img/remove.png')}}"></a>

                        <div class="st-content-box full-width">

                            <div class="st-box-left">

                                <ul class="st-mf-list">

                                    <li class="st-mf-item"><label>Fabric</label><span>{{$description['ofabricName']}} <figure> <img src="{{URL::asset('/storage/'.$description['ofabricImage'])}}" alt="{{$description['ofabricName']}}" title="{{$description['ofabricName']}}" width="10%"></figure></span></li>

                                        <li class="st-mf-item"><label>Style</label><span>{{$description['ostyleName']}}</span></li>

                                        <li class="st-mf-item"><label>Lapel</label><span>{{$description['olapelName']}}</span></li>

                                        <li class="st-mf-item"><label>Lapel Hole</label><span>{{$description['olapelHoleName']}}</span></li>

                                        <li class="st-mf-item"><label>Jacket bottom</label><span>{{$description['obottomName']}}</span></li>

                                         <li class="st-mf-item"><label>Jacket Button</label><span><?php echo $attstycode;?></span></li>

                                        <li class="st-mf-item"><label>Jacket Pocket</label><span>{{$description['opacketName']}} @if($description['obreastPacket']=='true')with Breast Pocket @endif</span></li>

                                        <li class="st-mf-item"><label>Jacket Sleeve Bu..</label><span>{{$description['osleeveButnStyle']}}</span></li>

                                        <li class="st-mf-item"><label>Jacket Vent</label><span>{{$description['oventName']}}</span></li>

                                        <li class="st-mf-item"><label>Buttons & Thread</label><span>{{$description['obuttonName']}} Button { {{$description['obuttonCode']}} } , <br>{{{$description['obuttonHoleName']}}} { {{$description['obuttonHoleCode']}} }</span></li>

                                        <li class="st-mf-item"><label>Monogram</label><span>{{$description['omonogramName']}} @if($description['omonogramName']!='No Monogram'), Color : {{$description['omonogramCode']}}@endif</span></li>                                         

                                </ul>

                            </div>

                            <div class="st-box-right">
     
                                <ul class="st-mf-list">

                                    <li class="pt-mf-item"><label>Contrast</label><span>{{$description['ocontrastName']}} <img src="{{URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['ocontrast'],'contrsfab_img'))}}" width="24"  alt="{{$description['ocontrastName']}}" title="{{$description['ocontrastName']}}"></span></li>

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

                                   @if($description['osizePattern']=='Standard'), Size SML : {{$description['osizeFit']}} , Fit : Regular @endif { {{$description['osizeType']}} }</h5>

                               

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

                            </div>

                        </div>

                    </div> 

                <!-- single order list view -->

              

                </div>

            </div>

        </div>

    </div>

</div>
<script>
$(document).ready(function(e) {
$("#plod").delay(2000).hide(0);

});
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

    document.getElementById("main-front-"+str).style.display="none";

    document.getElementById("main-back-"+str).style.display="block";

}



function viewMainFront(str){

    document.getElementById("main-front-"+str).style.display="block";

    document.getElementById("main-back-"+str).style.display="none";

}

</script>