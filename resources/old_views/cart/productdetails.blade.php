<?php  $seo = App\Http\Helpers::page_seo_details(19);?>
@include('layouts.inc.header-sub')
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
        <div class="row">
            <div class="pt-tab">
                <div class="pt-order-preview">
                    <div class="pt-customize">
                        <div class="pt-men">
                            <div class="pt-men-left" id="main-front-etstyle">
                                <div class="pt-image-div">
                                    <img src="{{URL::asset('/storage/'.$cart->canvas_front_img)}}">
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
                                                     
                            <div class="pt-choose-right pt-item-preview">
                            <div class="pt-preview-bottom">
                               <h5><span><strong>{{stripslashes($description['oprodType'])}}</strong></span> : {{stripslashes($description['oprodName'])}}
                                </h5>
                                </div>
                                <div class="pt-block-left">                                    
                                    <ul class="pt-mf-list">   
                                                                      
                                     <li class="pt-mf-item"><label>Product Code</label><span>{{$description['procode']}}</span></li>
                                     <li class="pt-mf-item"><label>Product Name</label><span>{{stripslashes($description['oprodName'])}}</span></li>
                                        <li class="pt-mf-item"><label>Fabric Name</label><span>{{stripslashes($description['ofabricName'])}} </span></li>
                                        <li class="pt-mf-item"><label>Fabric Brand</label><span>{{$description['fabbrand']}}</span></li>
                                       <li class="pt-mf-item"><label>Fabric Type</label><span>{{stripslashes($description['ofabricType'])}} </span></li>
                                       
                                        <li class="pt-mf-item"><label>Pattern</label><span>{{stripslashes($description['pattern'])}}</span></li>
                                        
                                                                                                               
                                    </ul>
                                    
                                </div>
                                
                                
                              <div class="pt-block-right">
                              
                                     <div class="pt-preview-bottom">
                                     <h5><span><strong>Fabric Description:</strong></span></h5>
                               <h5> {{stripslashes($description['fabdesc'])}}</h5>
                                <h5><span><strong>Color Description:</strong></span></h5>
                               <h5> {{stripslashes($description['colordes'])}}</h5>
                                       
                                       </div> 
                                       
                               </div>
                                
                                <div class="pt-preview-bottom">
                              <h5><span><strong>Quality Description:-</strong></span></h5><h5>{{stripslashes($description['qualitydesc'])}}</h5>
                               
                                </div>
                                <div class="pt-preview-bottom">
                                    <h5><span>Type Measure :</span> Standard , { inch }</h5>
                                    <ul class="pt-mg-list">                                   
                                   
                                        
                                        <li class="pt-mg-item">
                                            <div class="pt-small-box">
                                                <span class="mg-title">Size</span>
                                                <span class="mg-size">{{$description['osizeFit']}}</span>
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
    @include('../layouts.inc.footer-desgin')
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

</body>
<!-- --------------------------------------Product Section End Here----------------------------- -->

</html>