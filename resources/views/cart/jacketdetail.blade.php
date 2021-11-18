<?php  $seo = App\Http\Helpers::page_seo_details(19);?>
@include('layouts.inc.header-sub')
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
<body class="designshirt">  
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
        <div class="row">
            <div class="pt-tab">
                <div class="pt-order-preview">
                    <div class="pt-customize">
                        <div class="pt-men">
                        
                        
                            <div class="pt-men-left" id="main-front-etstyle">
                            <div id="plod" style="display:block; width:80px; position: absolute;left: 30%; top: 35%;"><img src="{{URL::asset('asset/img/page-loader.gif')}}"></div>
                                <div class="pt-image-div">
             
<div id="main-front-1"><div class="pt-image-div"><img src="{{URL::asset('/storage/'.$cart->canvas_front_img)}}"  width="340" alt=""/></div></div>
                                   
                                </div>   
                               
                                <div class="pt-price-shirt" >
                                    <a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBack('etstyle');">BACK VIEW </a>
                                </div>  
                            </div>
                            
                            
                            <div class="pt-men-left" id="main-back-etstyle"  style="display:none;">
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
                                        <li class="pt-mf-item"><label>Fabric</label><span>{{$description['ofabricName']}} <figure> <img src="{{URL::asset('/storage/'.$description['ofabricImage'])}}" alt="{{$description['ofabricName']}}" title="{{$description['ofabricName']}}"></figure></span></li>
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
                                            <li class="pt-mf-item"><label>Contrast</label><span>{{$description['ocontrastName']}} <img src="{{URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['ocontrast'],'contrsfab_img'))}}" width="24"	alt="{{$description['ocontrastName']}}" title="{{$description['ocontrastName']}}"></span></li>                                          
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
	document.getElementById("main-front-"+str).style.display="none";
	document.getElementById("main-back-"+str).style.display="block";
}

function viewMainFront(str){
	document.getElementById("main-front-"+str).style.display="block";
	document.getElementById("main-back-"+str).style.display="none";
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