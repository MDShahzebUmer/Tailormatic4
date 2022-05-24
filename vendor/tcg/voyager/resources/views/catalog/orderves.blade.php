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
                <?php $description=unserialize($data->item_description); ?>
                <!-- single order list view start here -->
                    <div class="col-sm-4">
                        <div class="st-img-box">
                          <div class="pt-men-left" id="main-front-etstyle">
                                <div class="pt-image-div">
                                    <img src="{{URL::asset('/storage/'.$data->canvas_front_img)}}"/>
                                </div>   
                                <div class="pt-price-shirt" >
                                    <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBack('etstyle');">BACK VIEW </a>
                                </div>  
                            </div>
                            <div class="pt-men-left" id="main-back-etstyle"  style="display:none;">
                                <div class="pt-image-div">
                                     <img src="{{URL::asset('/storage/'.$data->canvas_back_img)}}"/>
                                </div>   
                                <div class="pt-price-shirt" >
                                    <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFront('etstyle');">FRONT VIEW </a>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <a href="{{url()->previous()}}" class="st-remove-btn"><img src="{{asset('asset/img/remove.png')}}"></a>
                        <div class="st-content-box full-width">
                            <div class="st-box-left">
                                <ul class="st-mf-list">
                                    <li class="st-mf-item"><label>Fabric</label><span>{{$description['ofabricName']}} <figure> <img src="{{URL::asset('/storage/'.$description['ofabricImage'])}}" alt="{{$description['ofabricName']}}" title="{{$description['ofabricName']}}" width="10%"></figure></span></li>
                                    <li class="st-mf-item"><label>Lapel</label><span>{{$description['ostyleName']}}</span></li>
                                    <li class="st-mf-item"><label>Pockets</label><span>{{$description['opacketName']}} </span></li>
                                    <li class="st-mf-item"><label>Bottom</label><span>{{$description['obuttonstyleName']}}</span></li>
                                    <li class="st-mf-item"><label>Back</label><span>{{$description['obackName']}}</span></li>
                                    <li class="st-mf-item"><label>Buttons</label><span>{{$description['obuttonstyleName']}}</span></li>
                                    <li class="st-mf-item"><label>Buton Color</label><span>{{$description['obuttonCode']}} { {{$description['obuttonName']}} }</span></li>
                                    <li class="st-mf-item"><label>Thread Color</label><span>{{$description['obuttonHoleCode']}} {  {{$description['obuttonHoleName']}}  }</span></li>
                                    <li class="st-mf-item"><label>Lining</label><span>{{$description['oliningName']}}</span></li>
                                </ul>
                            </div>
                            <div class="st-box-right">
                                <h5>Collar Contrast</h5>
							    <?php
                                    $ocontlapel = App\Http\helpers::optionval($description['ocontlapel']);
                                    $ocontpockets = App\Http\helpers::optionval($description['ocontpockets']);
                                ?>
                                <ul class="st-mf-list mr-bt st-mf-hef">
                                    <li class="pt-mf-item"><label>Contrast</label> : <span>{{$description['ocontrastName']}} <img src="{{URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['ocontrast'],'contrsfab_img'))}}" width="24"    alt="{{$description['ocontrastName']}}" title="{{$description['ocontrastName']}}"></span></li>
                                    <li class="pt-mf-item"><label>Vest Upper</label> : <span>{{$ocontlapel}}</span></li>
                                    <li class="pt-mf-item"><label>Pocket Style</label> : <span>{{$ocontpockets}}</span></li>
                                </ul>
                            </div>
                            <div class="st-box-bottom">
                               <h5><span>Type Measure :</span> {{$description['osizePattern']}} , {{$description['osizeStyle']}} @if($description['osizePattern']=='Standard'), Size SML : {{$description['osizeFit']}} @endif { {{$description['osizeType']}} }</h5>
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
</div>

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