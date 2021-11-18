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
                               
                                <div class="pt-price-shirt">
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
                                        <li class="pt-mf-item"><label>Style</label><span>{{$description['ostyleName']}}</span></li>
                                       <li class="pt-mf-item"><label>Pleats</label><span>{{$description['opleatName']}} </span></li>
                                        <li class="pt-mf-item"><label>Front Pockets</label><span>{{$description['opacketName']}}</span></li>
                                        <li class="pt-mf-item"><label>Back Pockets</label><span>{{$description['obackpocktName']}}</span></li>
                                        <li class="pt-mf-item"><label>Back Pocket Position</label><span>{{$description['obackpocktSide']}}</span></li>
                                        <li class="pt-mf-item"><label>Pant Closure</label><span>{{$description['owaistbandedge']}}</span></li>
                                        <li class="pt-mf-item"><label>Belt Loops</label><span>{{$description['obeltloopName']}}</span></li>
                                        <li class="pt-mf-item"><label>Cuffs</label><span>{{$description['ocuffName']}}</span></li>
                                        <li class="pt-mf-item"><label>Buton Color</label><span>{{$description['obuttonCode']}} { {{$description['obuttonName']}} }</span></li>
                                        <li class="pt-mf-item"><label>Button Hole Thread</label><span>{{$description['obuttonHoleCode']}} {  {{$description['obuttonHoleName']}}  }</span></li>
                                                                                                                
                                    </ul>
                                </div>
                                <div class="pt-block-right">
                                    <?php
                                        $ocontbeltloop = App\Http\helpers::optionval($description['ocontbeltloop']);
										$ocontbackpockets = App\Http\helpers::optionval($description['ocontbackpockets']);
									   ?>
                                       <div class="pt-indiv-block">
                                       <h5>Contrast Fabric</h5>
                                       </div> 
                                	<ul class="pt-mf-list">                                    
                                    <li class="pt-mf-item"><label>Contrast</label><span>{{$description['ocontrastName']}} <img src="{{URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['ocontrast'],'contrsfab_img'))}}" width="24"	alt="{{$description['ocontrastName']}}" title="{{$description['ocontrastName']}}"></span></li>                                    
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
                                                <span class="mg-title">Crotch</span>
                                                <span class="mg-size">{{$description['osizeCrotch']}}</span>
                                            </div>
                                        </li>
                                        <li class="pt-mg-item">
                                            <div class="pt-small-box">
                                                <span class="mg-title">Thigh</span>
                                                <span class="mg-size">{{$description['osizeThigh']}}</span>
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