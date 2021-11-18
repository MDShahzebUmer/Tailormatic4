<?php  $seo = App\Http\Helpers::page_seo_details(19);?>
@include('../layouts.inc.page_header')
@include('../layouts.inc.page_menu')

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
<section class="et-content st-item-detalis">
   <div class="pt-design pt-responsive-design">       
    <div class="container">
         @foreach($itemdata as $cart)
         @endforeach
         <?php $description=unserialize($cart->item_description); ?>

	<script>
			$(document).ready(function(e) {
				var arr='<?php echo json_encode($description); ?>';
				designProcessing(JSON.parse(arr),1);
			
			});
        </script>
        <div class="row">
            <div class="pt-tab">
                <div class="pt-order-preview">
                    <div class="pt-customize">
                        <div class="pt-men">
                        
                        
                            <div class="pt-men-left" id="main-front-etstyle">
                            <div id="plod" style="display:block; width:80px; position: absolute;left: 30%; top: 35%;"><img src="{{URL::asset('asset/img/page-loader.gif')}}"></div>
                                <div class="pt-image-div">
<div id="main-front-1"><div class="pt-image-div"><img src="{{URL::asset('/storage/'.$cart->canvas_front_img)}}" width="340" alt=""/></div></div>
                                    <!--<img src="{{URL::asset('/storage/'.$cart->canvas_front_img)}}"/>-->
                                </div>   
                               
                                <div class="pt-price-shirt" >
                                    <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBack('etstyle');">BACK VIEW </a>
                                </div>  
                            </div>
                            
                            
                            <div class="pt-men-left" id="main-back-etstyle"  style="display:none;">
                                <div class="pt-image-div">
<div id="main-back-1"><div class="pt-image-div"><img src="{{asset('demo/img/product/pt-shirts.png')}}" width="340" alt=""/></div></div>
                                    <!--<img src="{{URL::asset('/storage/'.$cart->canvas_back_img)}}"/>-->
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
                                        <li class="pt-mf-item"><label>Fabric</label><span>{{$description['ofabricName']}} <figure> <img src="{{URL::asset('/storage/'.$description['ofabricImage'])}}" alt="{{$description['ofabricName']}}" title="{{$description['ofabricName']}}"></figure></span></li>
                                        <li class="pt-mf-item"><label>Sleeve</label><span>{{$description['osleeveName']}} @if($description['oshoulder']=='true')with Epaulettes @endif</span></li>
                                        <li class="pt-mf-item"><label>Front Style</label><span>{{$description['ofrontName']}} @if($description['oseams']=='true')with Seam @endif </span></li>
                                        <li class="pt-mf-item"><label>Back Style</label><span>{{$description['obackName']}} @if($description['odart']=='true')with Dart @endif</span></li>
                                        <li class="pt-mf-item"><label>Collar Style</label><span>{{$description['ocollarName']}} @if($description['ocollarStay']=='true')with Collar Stay @endif</span></li>
                                        <li class="pt-mf-item"><label>Cuff Style</label><span>{{$description['ocuffName']}}</span></li>
                                        <li class="pt-mf-item"><label>Pocket Style</label><span>{{$description['opacketName']}} @if($description['opacketName']!='No Pocket')<br>{{$description['opacketCount']}} Pocket @endif</span></li>
                                        <li class="pt-mf-item"><label>Bottom Style</label><span>{{$description['obottomName']}}</span></li>
                                        <li class="pt-mf-item"><label>Monogram</label><span>{{$description['omonogramName']}} @if($description['omonogramName']!='No Monogram'), Color : {{$description['omonogramCode']}}@endif</span></li>
                                        <li class="pt-mf-item"><label>Monogram Text</label><span>{{$description['omonogramText']}} </span></li> 
                                        <li class="pt-mf-item"><label>Buttons & Thread</label><span>{{$description['obuttonName']}} Button { {{$description['obuttonCode']}} } , <br>{{{$description['obuttonHoleStyleName']}}} { {{$description['obuttonHoleCode']}} }</span></li>                                         
                                    </ul>
                                </div>
                                <div class="pt-block-right"> 
                                    <ul class="pt-mf-list">
                                        <li class="pt-mf-item"><label>Contrast</label><span>{{$description['ocontrastName']}} <img src="{{URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['ocontrast'],'contrsfab_img'))}}" width="24"	alt="{{$description['ocontrastName']}}" title="{{$description['ocontrastName']}}"></span></li>
                                        <!--<li class="pt-mf-item"><label>Pining Color</label><span>A1</span></li>
                                        <li class="pt-mf-item"><label>Back Collar</label><span>001</span></li>-->
                                    </ul>
                                    
                                    <?php
                                        $cuffIn = App\Http\helpers::optionval($description['ocollarCuffIn']);
										$cuffout = App\Http\helpers::optionval($description['ocollarCuffout']);
										$placketin = App\Http\helpers::optionval($description['ofrontPlacketIn']);
										$placketout = App\Http\helpers::optionval($description['ofrontPlacketOut']);
										$boxout = App\Http\helpers::optionval($description['ofrontBoxOut']);
										$boxin = App\Http\helpers::optionval($description['obackBoxOut']);
										?>
                                    <div class="pt-indiv-block">
                                        <h5>Collar Contrast</h5>
                                        <ul class="pt-mf-list">
                                        
                                            <li class="pt-mf-item"><label>Inside</label><span>{{$cuffIn}}</span></li>
                                            <li class="pt-mf-item"><label>Outside</label><span>{{$cuffout}}</span></li>
                                        </ul>
                                    </div>
                                    <div class="pt-indiv-block">
                                        <h5>Cuff Contrast</h5>
                                        <ul class="pt-mf-list">
                                            <li class="pt-mf-item"><label>Inside</label><span>{{$cuffIn}}</span></li>
                                            <li class="pt-mf-item"><label>Outside</label><span>{{$cuffout}}</span></li>
                                        </ul>
                                    </div>
                                    <div class="pt-indiv-block">
                                        <h5>Front/Back Placket Contrast</h5>
                                        <ul class="pt-mf-list">
                                            <li class="pt-mf-item"><label>Inside</label><span>{{$placketin}}</span></li>
                                            <li class="pt-mf-item"><label>Outside</label><span>{{$placketout}}</span></li>
                                            <li class="pt-mf-item"><label>Front Box Pl..</label><span>{{$boxout}}</span></li>
                                            <li class="pt-mf-item"><label>Back Box Pl..</label><span>{{$boxin}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="pt-preview-bottom">
                                    <h5><span>Type Measure :</span> {{$description['osizePattern']}} , {{$description['osizeStyle']}} { {{$description['osizeType']}} }</h5>
                                    <ul class="pt-mg-list">
                                    
                                    <?php if($description['osizePattern']=='Body'){?>
                                        <li class="pt-mg-item">
                                            <div class="pt-small-box">
                                                <span class="mg-title">Neck</span>
                                                <span class="mg-size">{{$description['osizeNeck']}}</span>
                                            </div>
                                        </li>
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
                                                <span class="mg-title">Length</span>
                                                <span class="mg-size">{{$description['osizeLength']}}</span>
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
                                        <?php }else{?>
                                        <li class="pt-mg-item">
                                            <div class="pt-small-box">
                                                <span class="mg-title">Size</span>
                                                <span class="mg-size">{{$description['osizeFit']}}</span>
                                            </div>
                                        </li>
                                        <?php }?>
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
<script>
$(document).ready(function(e) {		
$("#plod").delay(2000).hide(0);

});
</script>
</body>
</html>