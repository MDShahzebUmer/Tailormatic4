<?php  $seo = App\Http\Helpers::page_seo_details(19);?>
@include('layouts.inc.header-sub')
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
<body class="designshirt">
<section class="pt-bg">
<style>
/* new added 3piece style */
.box-view-design{
    left: -55px;
    position: absolute;
    top: 145px;
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
    /*transform: scale(1.1);*/
    box-shadow: 0px 0px 27px #ebebeb;
    transition-duration: 20ms;
}

</style>
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
    <div class="container">
        <div class="row">
            <div class="et-rating-exp">
                @include('../layouts.inc.rating')
            </div>
        </div>
        <div class="row">
            <div class="pt-cart-header et-fw">
                <div class="pt-cart-title et-left">
                    <h1>Your Style</h1>
                </div>
                <div class="pt-button-block et-right">
                    <ul>
                        <li><a href="{{ url()->previous() }}" class="pt-cart-btn">X</a></li>

                    </ul>
                </div>
            </div>
        </div>
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

        @foreach($cartdata as $cart)
        @endforeach

        <?php
        	$description=unserialize($cart->item_description);
        ?>
        <script>
    		$(document).ready(function(e) {
    		var arr='<?php echo json_encode($description); ?>';
    		designProcessing(JSON.parse(arr));
        });
        </script>
        <!-- ============================ jacket content ========================== -->
        <div id="container_jacket" class="tab-container">
            <div class="row">
                <div class="pt-tab">
                    <div class="pt-order-preview">
                        <div class="pt-customize">
                            <div class="pt-men">
                                <div class="pt-men-left main-front-etstyle" id="main-front-etstyle">
                                    <div id="plod" style="display:block; width:80px; position: absolute;left: 30%; top: 35%;">
                                        <img src="{{URL::asset('asset/img/page-loader.gif')}}">
                                    </div>
                                    <div class="pt-image-div">
                                        <div id="main-front-1">
                                            <div class="pt-image-div">
                                                <img src="{{URL::asset('/storage/'.$cart->canvas_front_img)}}"  width="340" alt=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-price-shirt" >
                                        <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBack('etstyle');">BACK VIEW </a>
                                    </div>
                                </div>
                                <div class="pt-men-left main-back-etstyle" id="main-back-etstyle"  style="display:none;">
                                    <div class="pt-image-div">
                                    <img src="{{URL::asset('/storage/'.$cart->canvas_back_img)}}">
                                    </div>

                                    <div class="pt-price-shirt" >
                                        <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFront('etstyle');">FRONT VIEW </a>
                                    </div>
                                </div>
                                <?php
                                $attstycode = App\Http\helpers::alltebinfo('attribute_styles',$description['ostyle'],'style_code');
                                  ?>
                                <div class="pt-choose-right pt-item-preview">
                                    <div class="pt-block-left">
                                        <ul class="pt-mf-list">
                                            <li class="pt-mf-item"><label>Fabric</label><span>{{$description['ofabricName']}} <figure> <img src="{{URL::asset('/storage/'.$description['ofabricImage'])}}" alt="{{$alt_name}}" title="{{$description['ofabricName']}}"></figure></span></li>
                                            <li class="pt-mf-item"><label>Style</label><span>{{$description['ostyleName']}}</span></li>
                                            <li class="pt-mf-item"><label>Lapel</label><span>{{$description['olapelName']}}</span></li>
                                            <li class="pt-mf-item"><label>Lapel Hole</label><span>{{$description['olapelHoleName']}}</span></li>
                                           <!-- <li class="pt-mf-item"><label>Jacket bottom</label><span>{{$description['obottomName']}}</span></li>-->
                                             <li class="pt-mf-item"><label>Jacket Button</label><span>{{$description['obottomName']}}</span></li>
                                            <li class="pt-mf-item"><label>Jacket Pocket</label><span>{{$description['opacketName']}} @if($description['obreastPacket']=='true')with Breast Pocket @endif</span></li>
                                            <li class="pt-mf-item"><label>Jacket Sleeve Bu..</label><span>{{$description['osleeveButnStyle']}}</span></li>
                                            <li class="pt-mf-item"><label>Jacket Vent</label><span>{{$description['oventName']}}</span></li>
                                            <li class="pt-mf-item"><label>Buttons & Thread</label><span>{{$description['obuttonName']}} Button { {{$description['obuttonCode']}} } , <br>{{{$description['obuttonHoleName']}}} { {{$description['obuttonHoleCode']}} }</span></li>
                                            <li class="pt-mf-item"><label>Monogram</label><span>{{$description['omonogramName']}} @if($description['omonogramName']!='No Monogram'), Color : {{$description['omonogramCode']}}@endif</span></li>
                                             <li class="pt-mf-item"><label>Monogram Text</label><span>{{$description['omonogramText']}}</span></li>
                                        </ul>
                                    </div>
                                    <div class="pt-block-right">

                                        <ul class="pt-mf-list">
                                        <li class="pt-mf-item"><label>Lining</label><span>{{$description['oliningName']}}</span></li>                                    <li class="pt-mf-item"><label>Pining Color</label><span>{{$description['opipingName']}}</span></li>
                                         <li class="pt-mf-item"><label>Back Collar</label><span>{{$description['obackCollarName']}}</span></li>
                                        </ul>
                                            <ul class="pt-mf-list">
                                                <li class="pt-mf-item"><label>Contrast</label><span>{{$description['ocontrastName']}} <img src="{{URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['ocontrast'],'contrsfab_img'))}}" width="24"  alt="{{$alt_name}}" title="{{$description['ocontrastName']}}"></span></li>
                                            </ul>


                                        <?php
                                            $olapelupper = App\Http\helpers::optionval($description['olapelupper']);
                                            $olapellower = App\Http\helpers::optionval($description['olapellower']);
                                            $ocontpockets = App\Http\helpers::optionval($description['ocontpockets']);
                                            $ocontchestpocket = App\Http\helpers::optionval($description['ocontchestpocket']);
                                            $ocontelbowmix = App\Http\helpers::optionval($description['ocontelbowmix']);

                                        ?>
                                        <div class="pt-indiv-block">
                                           <h5>Contrast Fabric</h5>
                                            <ul class="pt-mf-list">
                                                <li class="pt-mf-item"><label>Lapel Upper</label><span>{{$olapelupper}}</span></li>
                                                <li class="pt-mf-item"><label>Lapel Lower</label><span>{{$olapellower}}</span></li>
                                            </ul>
                                            <ul class="pt-mf-list">
                                                <li class="pt-mf-item"><label>Pockets</label><span>{{$ocontpockets}}</span></li>
                                                <li class="pt-mf-item"><label>Chest Pocket</label><span>{{$ocontchestpocket}}</span></li>
                                            </ul>
                                             <ul class="pt-mf-list">
                                                <li class="pt-mf-item"><label>Elbow Mix</label><span>{{$ocontelbowmix}}</span></li>

                                            </ul>
                                        </div>

                                    </div>
                                    <div class="pt-preview-bottom">
                                        <h5><span>Type Measure :</span> {{$description['osizePattern']}} , {{$description['osizeStyle']}}  @if($description['osizePattern']=='Standard'), Size SML : {{$description['osizeFit']}} , Fit : Regular @endif { {{$description['osizeType']}} }</h5>
                                        <ul class="pt-mg-list">


                                            <li class="pt-mg-item">
                                                <div class="pt-small-box">
                                                    <span class="mg-title">Chest</span>
                                                    <span class="mg-size">{{$description['osizeChest']}}</span>
                                                </div>
                                            </li>
                                            <li class="pt-mg-item">
                                                <div class="pt-small-box">
                                                    <span class="mg-title">Waist</span>
                                                    <span class="mg-size">{{$description['osizeWaist']}}</span>
                                                </div>
                                            </li>
                                            <li class="pt-mg-item">
                                                <div class="pt-small-box">
                                                    <span class="mg-title">Hip</span>
                                                    <span class="mg-size">{{$description['osizeHip']}}</span>
                                                </div>
                                            </li>

                                            <li class="pt-mg-item">
                                                <div class="pt-small-box">
                                                    <span class="mg-title">Shoulder</span>
                                                    <span class="mg-size">{{$description['osizeShoulder']}}</span>
                                                </div>
                                            </li>
                                            <li class="pt-mg-item">
                                                <div class="pt-small-box">
                                                    <span class="mg-title">Sleeve</span>
                                                    <span class="mg-size">{{$description['osizeSleeve']}}</span>
                                                </div>
                                            </li>
                                            <li class="pt-mg-item">
                                                <div class="pt-small-box">
                                                    <span class="mg-title">Length</span>
                                                    <span class="mg-size">{{$description['osizeLength']}}</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================ pant content ============================ -->
        <div id="container_pant" class="tab-container" style="display:none;">
            <div class="row">
                <div class="pt-tab">
                    <div class="pt-order-preview">
                        <div class="pt-customize">
                            <div class="pt-men">
                                <div class="pt-men-left main-front-etstyle" id="main-front-etstyle">
                                    <div class="pt-image-div">
                                        <div id="main-front-1">
                                            <div class="pt-image-div">
                                                <img src="{{URL::asset('/storage/'.$description['pant_frntviewfinal'])}}"  width="340" alt=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-price-shirt" >
                                        <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBack('etstyle');">BACK VIEW </a>
                                    </div>
                                </div>
                                <div class="pt-men-left main-back-etstyle" id="main-back-etstyle"  style="display:none;">
                                    <div class="pt-image-div">
                                        <img src="{{URL::asset('/storage/'.$description['pant_bkviewfinal'])}}">
                                    </div>

                                    <div class="pt-price-shirt" >
                                        <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFront('etstyle');">FRONT VIEW </a>
                                    </div>
                                </div>
                                <?php
                                $attstycode = App\Http\helpers::alltebinfo('attribute_styles',$description['ostyle'],'style_code');
                                  ?>
                                <div class="pt-choose-right pt-item-preview">
                                    <div class="pt-block-left">
                                        <ul class="pt-mf-list">
                                            <li class="pt-mf-item"><label>Fabric</label><span>{{$description['pant_ofabricName']}} <figure> <img src="{{URL::asset('/storage/'.$description['pant_ofabricImage'])}}" alt="{{$alt_name}}" title="{{$description['pant_ofabricName']}}"></figure></span></li>
                                            <li class="pt-mf-item"><label>Style</label><span>{{$description['pant_ostyleName']}}</span></li>
                                            <li class="pt-mf-item"><label>Pleats</label><span>{{$description['pant_opleatName']}}</span></li>
                                            <li class="pt-mf-item"><label>Front Pockets</label><span>{{$description['pant_opacketName']}}</span></li>
                                            <li class="pt-mf-item"><label>Back Pockets</label><span>{{$description['pant_obackpocktName']}}</span></li>
                                            <li class="pt-mf-item"><label>Back Pocket Position</label><span>{{ ucfirst($description['pant_obackpocktSide'])}}</span></li>
                                            <li class="pt-mf-item"><label>Pant Closure</label><span>{{$description['pant_owaistbandedge']}}</span></li>
                                            <li class="pt-mf-item"><label>Belt Loops</label><span>{{$description['pant_obeltloopName']}}</span></li>
                                            <li class="pt-mf-item"><label>Cuffs</label><span>{{$description['pant_ocuffName']}}</span></li>
                                            <li class="pt-mf-item"><label>Buton Color</label><span>{{$description['pant_obuttonCode']}} { {{$description['pant_obuttonName']}} }</span></li>
                                            <li class="pt-mf-item"><label>Button Hole Thread</label><span>{{$description['pant_obuttonHoleCode']}} {  {{$description['pant_obuttonHoleName']}}  }</span></li>
                                        </ul>
                                    </div>
                                    <div class="pt-block-right">
                                        <div class="pt-indiv-block">
                                            <h5>Contrast Fabric</h5>
                                        </div>
                                        <?php
                                            $ocontbeltloop = App\Http\helpers::optionval($description['pant_ocontbeltloop']);
                                            $ocontbackpockets = App\Http\helpers::optionval($description['pant_ocontbackpockets']);
                                        ?>
                                        <ul class="pt-mf-list">
                                            <li class="pt-mf-item"><label>Contrast</label><span>{{$description['pant_ocontrastName']}} <img src="{{URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['pant_ocontrast'],'contrsfab_img'))}}" width="24"  alt="{{$alt_name}}" title="{{$description['pant_ocontrastName']}}"></span></li>
                                            <li class="pt-mf-item"><label>Belt Loops</label><span>{{$ocontbeltloop}}</span></li>
                                            <li class="pt-mf-item"><label>Back Pockets</label><span>{{$ocontbackpockets}}</span></li>
                                        </ul>
                                    </div>
                                    <div class="pt-preview-bottom">
                                        <h5><span>Type Measure :</span> {{$description['osizePattern']}} , {{$description['osizeStyle']}} @if($description['osizePattern']=='Standard'), Size SML : {{$description['osizeFit']}} @endif { {{$description['osizeType']}} }</h5>
                                        <ul class="pt-mg-list">
                                            <li class="pt-mg-item">
                                                <div class="pt-small-box">
                                                    <span class="mg-title">Waist</span>
                                                    <span class="mg-size">{{$description['pant_osizeWaist']}}</span>
                                                </div>
                                            </li>
                                            <li class="pt-mg-item">
                                                <div class="pt-small-box">
                                                    <span class="mg-title">Hip</span>
                                                    <span class="mg-size">{{$description['pant_osizeHip']}}</span>
                                                </div>
                                            </li>

                                            <li class="pt-mg-item">
                                                <div class="pt-small-box">
                                                    <span class="mg-title">Crotch</span>
                                                    <span class="mg-size">{{$description['pant_osizeCrotch']}}</span>
                                                </div>
                                            </li>
                                            <li class="pt-mg-item">
                                                <div class="pt-small-box">
                                                    <span class="mg-title">Thigh</span>
                                                    <span class="mg-size">{{$description['pant_osizeThigh']}}</span>
                                                </div>
                                            </li>
                                            <li class="pt-mg-item">
                                                <div class="pt-small-box">
                                                    <span class="mg-title">Length</span>
                                                    <span class="mg-size">{{$description['pant_osizeLength']}}</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================ end content ============================= -->
    </div>
</div>
<!-- DESIGN AREA ENDS -->

<!-- FOOTER SECTION -->
<div class="pt-footer">
    <div class="container">
        <div class="row">
            <div class="pt-foot-ul">
               @include('../layouts.inc.footer-strkey')
           </div>
       </div>
   </div>
</div>
<!-- FOOTER SECTION END -->

</section>
<script type="text/javascript">
function viewMainBack(str){
    $(".main-front-"+str).css('display','none');
    $(".main-back-"+str).css('display','block');
}

function viewMainFront(str){
    $(".main-front-"+str).css('display','block');
    $(".main-back-"+str).css('display','none');
}
function showContent(cat){
    $('.tab-container').css('display','none');
    $('#container_'+cat).css('display','block');
}
</script>
<!-- --------------------------------------Product Modal Section----------------------------- -->
<script>
$(document).ready(function(e) {
$("#plod").delay(2000).hide(0);

});
</script>
</body>
<!-- --------------------------------------Product Section End Here----------------------------- -->

</html>
