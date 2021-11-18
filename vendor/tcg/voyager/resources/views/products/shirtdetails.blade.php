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
<script type="text/javascript" src="{{asset('demo/js/cart.js')}}"></script> 
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
    designProcessing(JSON.parse(arr),1);
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

                    <div class="col-sm-8">

                        <a href="{{url('admin/productslists/')}}" class="st-remove-btn"><img src="{{asset('asset/img/remove.png')}}"></a>

                        <div class="st-content-box full-width">

                            <div class="st-box-left">

                                <ul class="st-mf-list">

                                    <li class="st-mf-item"><label>Fabric</label><span>{{$description['ofabricName']}} <figure><img src="{{URL::asset('/storage/'.$description['ofabricImage'])}}" alt="{{$description['ofabricName']}}" title="{{$description['ofabricName']}}" width="10%"></figure></span></li>

                                    <li class="st-mf-item"><label>Sleeve</label><span>{{$description['osleeveName']}} @if($description['oshoulder']=='true')with Epaulettes @endif</span></li>

                                    <li class="st-mf-item"><label>Front Style</label><span>{{$description['ofrontName']}} @if($description['oseams']=='true')with Seam @endif</span></li>

                                    <li class="st-mf-item"><label>Back Style</label><span>{{$description['obackName']}} @if($description['odart']=='true')with Dart @endif</span></li>

                                    <li class="st-mf-item"><label>Collar Style</label><span>{{$description['ocollarName']}} @if($description['ocollarStay']=='true')with Collar Stay @endif</span></li>

                                    <li class="st-mf-item"><label>Cuff Style</label><span>{{$description['ocuffName']}}</span></li>

                                    <li class="st-mf-item"><label>Pocket Style</label><span>{{$description['opacketName']}} @if($description['opacketName']!='No Pocket')<br>{{$description['opacketCount']}} Pocket @endif</span></li>

                                    <li class="st-mf-item"><label>Bottom Style</label><span>{{$description['obottomName']}}</span></li>

                                    <li class="st-mf-item"><label>Monogram</label><span>{{$description['omonogramName']}} @if($description['omonogramName']!='No Monogram'), Color : {{$description['omonogramCode']}}@endif</span></li>

                                    <li class="st-mf-item"><label>Buttons & Thread</label><span>{{$description['obuttonName']}} Button { {{$description['obuttonCode']}} } , <br>{{{$description['obuttonHoleStyleName']}}} { {{$description['obuttonHoleCode']}} }</span></li>

                                    

                                </ul>

                            </div>

                            <div class="st-box-right">

                                <ul class="st-mf-list">

                                    <li class="pt-mf-item"><label>Contrast</label><span>{{$description['ocontrastName']}} <img src="{{URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['ocontrast'],'contrsfab_img'))}}" width="24"  alt="{{$description['ocontrastName']}}" title="{{$description['ocontrastName']}}"></span></li>

                                </ul>



                                 <?php

                                        $cuffIn = App\Http\helpers::optionval($description['ocollarCuffIn']);

                                        $cuffout = App\Http\helpers::optionval($description['ocollarCuffout']);

                                        $placketin = App\Http\helpers::optionval($description['ofrontPlacketIn']);

                                        $placketout = App\Http\helpers::optionval($description['ofrontPlacketOut']);

                                        $boxout = App\Http\helpers::optionval($description['ofrontBoxOut']);

                                        $boxin = App\Http\helpers::optionval($description['obackBoxOut']);

                                        ?>

                                <div class="st-indiv-block">

                                    <h5>Collar Contrast</h5>

                                    <ul class="st-mf-list">

                                        <li class="st-mf-item"><label>Inside</label><span>{{$cuffIn}}</span></li>

                                        <li class="st-mf-item"><label>Outside</label><span>{{$cuffout}}</span></li>

                                        

                                    </ul>

                                </div>

                                <div class="st-indiv-block">

                                    <h5>Cuff Contrast</h5>

                                    <ul class="st-mf-list">

                                        <li class="st-mf-item"><label>Inside</label><span>{{$cuffIn}}</span></li>

                                        <li class="st-mf-item"><label>Outside</label><span>{{$cuffout}}</span></li>

                                        

                                    </ul>

                                </div>

                                <div class="st-indiv-block">

                                    <h5>Front/Back Placket Contrast</h5>

                                    <ul class="st-mf-list">

                                        <li class="st-mf-item"><label>Inside</label><span>{{$cuffIn}}</span></li>

                                        <li class="st-mf-item"><label>Outside</label><span>{{$cuffout}}</span></li>

                                        <li class="st-mf-item"><label>Front Box Pl..</label><span>{{$boxout}}</span></li>

                                        <li class="st-mf-item"><label>Back Box Pl..</label><span>{{$boxin}}</span></li>

                                        

                                    </ul>

                                </div>

                            </div>

                            <div class="st-box-bottom">

                                <h5><span>Type Measure:</span> {{$description['osizePattern']}} , {{$description['osizeStyle']}} { {{$description['osizeType']}} }</h5>

                                <?php if($description['osizePattern']=='Body'){?>

                                <ul class="st-mg-list">

                                    <li class="st-mg-item">

                                        <div class="st-small-box">

                                            <span class="mg-title">Neck</span>

                                            <span class="mg-size">{{$description['osizeNeck']}}</span>

                                        </div>

                                    </li>

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

                                    <?php }else{?>

                                    <li class="st-mg-item" style=" width:80px;">

                                        <div class="st-small-box">

                                            <span class="mg-title">Size</span>

                                            <span class="mg-size">{{$description['osizeFit']}}</span>

                                        </div>

                                    </li>

                                    <?php }?>

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