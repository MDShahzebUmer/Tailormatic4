<?php  $seo = App\Http\Helpers::page_seo_details(19);?>
@include('../layouts.inc.page_header')
@include('../layouts.inc.page_menu')
<section class="et-content st-item-detalis">

   <div class="pt-design pt-responsive-design">
    <div class="container">

         @foreach($itemdata as $cart)
         @endforeach

         <?php
        	$description=unserialize($cart->item_description);
         ?>
        <div class="row">
            <div class="pt-tab">
                <div class="pt-order-preview">
                    <div class="pt-customize">
                        <div class="pt-men">


                            <div class="pt-men-left" id="main-front-etstyle">
                                <div class="pt-image-div">
                                    <img src="{{URL::asset('/storage/'.$cart->canvas_front_img)}}"/>
                                </div>

                                <div class="pt-price-shirt" >
                                    <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBack('etstyle');">BACK VIEW </a>
                                </div>
                            </div>


                            <div class="pt-men-left" id="main-back-etstyle"  style="display:none;">
                                <div class="pt-image-div">
                                    <img src="{{URL::asset('/storage/'.$cart->canvas_back_img)}}"/>
                                </div>

                                <div class="pt-price-shirt" >
                                    <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFront('etstyle');">FRONT VIEW </a>
                                </div>
                            </div>


                            <div class="pt-choose-right pt-item-preview">
                                <div class="pt-button-block et-right">
                                    <ul>
                                        <li><a href="{{ url('/myaccount/orderdetails') }}/{{$cart->order_id}}" class="pt-cart-btn">X</a></li>
                                    </ul>
                                </div>
                                <div class="pt-block-left">
                                    <ul class="pt-mf-list">
                                        <li class="pt-mf-item"><label>Fabric</label><span>{{$description['ofabricName']}} <figure> <img src="{{URL::asset('/storage/'.$description['ofabricImage'])}}" alt="{{$alt_name}}" title="{{$description['ofabricName']}}"></figure></span></li>
                                        <li class="pt-mf-item"><label>Lapel</label><span>{{$description['ostyleName']}}</span></li>
                                       <li class="pt-mf-item"><label>Pockets</label><span>{{$description['opacketName']}} </span></li>
                                        <li class="pt-mf-item"><label>Bottom</label><span>{{$description['obuttonstyleName']}}</span></li>
                                        <li class="pt-mf-item"><label>Back</label><span>{{$description['obackName']}}</span></li>
                                        <li class="pt-mf-item"><label>Buttons</label><span>{{$description['obuttonstyleName']}}</span></li>
                                        <li class="pt-mf-item"><label>Buton Color</label><span>{{$description['obuttonCode']}} { {{$description['obuttonName']}} }</span></li>
                                        <li class="pt-mf-item"><label>Thread Color</label><span>{{$description['obuttonHoleCode']}} {  {{$description['obuttonHoleName']}}  }</span></li>
                                        <li class="pt-mf-item"><label>Lining</label><span>{{$description['oliningName']}}</span></li>
                                    </ul>
                                </div>
                                <div class="pt-block-right">
                                    <?php
                                        $ocontlapel = App\Http\helpers::optionval($description['ocontlapel']);
										$ocontpockets = App\Http\helpers::optionval($description['ocontpockets']);
									   ?>
                                       <div class="pt-indiv-block">
                                       <h5>Contrast Fabric</h5>
                                       </div>
                                	<ul class="pt-mf-list">
                                    <li class="pt-mf-item"><label>Contrast</label><span>{{$description['ocontrastName']}} <img src="{{URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['ocontrast'],'contrsfab_img'))}}" width="24"	alt="{{$alt_name}}" title="{{$description['ocontrastName']}}"></span></li>
                                     <li class="pt-mf-item"><label>Vest Upper</label><span>{{$description['ocontlapel']}}</span></li>
                                     <li class="pt-mf-item"><label>Select Pocket Style</label><span>{{$description['ocontpockets']}}</span></li>
                                    </ul>


                                </div>
                                <div class="pt-preview-bottom">
                                    <h5><span>Type Measure :</span> {{$description['osizePattern']}} , {{$description['osizeStyle']}} @if($description['osizePattern']=='Standard'), Size SML : {{$description['osizeFit']}} @endif { {{$description['osizeType']}} }</h5>
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
</div>


</div>
</section>
@include('../profile.profile-footer')

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
</body>
</html>
