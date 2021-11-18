<?php  $seo = App\Http\Helpers::page_seo_details(17);?>
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
                    	<h1>Cart</h1>
                    </div>
                    <div class="et-step-progress">
                    	<ul class="et-step-list">
                        	<li class="et-prog-step et-clear">
                            	<span class="step-num">1</span>
                                <span class="step-nam">Cart</span>
                            </li>
                            <li class="et-prog-step active">
                            	<span class="step-num">2</span>
                                <span class="step-nam">Shipping</span>
                            </li>
                            <li class="et-prog-step">
                            	<span class="step-num">3</span>
                                <span class="step-nam">Checkout</span>
                            </li>
                            <li class="et-prog-step last">
                            	<span class="step-num">4</span>
                                <span class="step-nam">Payment</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-button-block et-right">
                    	<ul>
                        	<li><a class="pt-cart-btn" href="{{url('/designshirts')}}">Continue Shopping</a></li>
                            <li><a class="pt-cart-btn" href="{{url('cartchk')}}">Proceed to Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
			<div class="row">
		 		<div class="pt-cart-list et-fw">
            		<div class="pt-cart-style et-fw">
                  
                        <table class="table table-condensed">
                        	<thead>
                              	<tr>
                                	<th class="table-cell-1 text-center">Item</th>
                                	<th class="table-cell-2 text-left">Item Description</th>
                                	<th class="table-cell-3 text-center">Fabric</th>
                                    <th class="table-cell-4 text-center">Price</th>
                                	<th class="table-cell-6 text-center">Quantity</th>
                                   
                                    <th class="table-cell-7 text-center">Total</th>
                                	<th class="table-cell-8 text-center">Edit / Delete</th>
                              	</tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i=0;
                            $total=0;
                           ?>
                            @foreach($cartdata as $cart)
                            @php 
                            $i++
                            @endphp
                           
                            <?php
							
							
							if($cart->product_type==0){
								if($cart->cat_id==1){
    								$ocollarName = App\Cart::cartdescnfo($cart->id,'ocollarName');
    								$olapelName='';
    								$detailurl='details';
								}elseif($cart->cat_id==2){
    								$ocollarName = App\Cart::cartdescnfo($cart->id,'ostyleName');
    								$olapelN=App\Cart::cartdescnfo($cart->id,'olapelName');
    								$olapelName=$olapelN;
    								$detailurl='jacketdetails';
								}elseif($cart->cat_id==3){
    								$ocollarName = App\Cart::cartdescnfo($cart->id,'ostyleName');
    								//$olapelN=App\Cart::cartdescnfo($cart->id,'olapelName');
    								$olapelName='';
    								$detailurl='vestsdetails';
								}elseif($cart->cat_id==4){
    								$ocollarName = App\Cart::cartdescnfo($cart->id,'ostyleName');
    								$olapelN=App\Cart::cartdescnfo($cart->id,'opleatName');
    								$olapelName=$olapelN;
    								$detailurl='paintdetails';
								}elseif($cart->cat_id==18){ //3Piece suit
                                    $ocollarName = App\Cart::cartdescnfo($cart->id,'ostyleName');
                                    $olapelN=App\Cart::cartdescnfo($cart->id,'olapelName');
                                    $olapelName=$olapelN;
                                    $detailurl='threepiecedetails';
                                }elseif($cart->cat_id==19){ //2Piece suit
                                    $ocollarName = App\Cart::cartdescnfo($cart->id,'ostyleName');
                                    $olapelN=App\Cart::cartdescnfo($cart->id,'olapelName');
                                    $olapelName=$olapelN;
                                    $detailurl='twopiecedetails';
                                }
								$groupname = App\Cart::groupinfo($cart->group_id,'fbgrp_name');
								$oprodType = App\Cart::cartdescnfo($cart->id,'oprodType');
								
								$size=App\Cart::cartdescnfo($cart->id,'osizeFit');
								$fabno=App\Cart::allinfodes('etfabrics',$cart->fabric_id,'fabric_code');
								
								
							}else{
								
								$procode = App\Cart::cartdescnfo($cart->id,'procode');
								$ocollarName='Model No : '.$procode;
								$olapelN=App\Cart::cartdescnfo($cart->id,'ofabricType');
								$olapelName='Fab Type : '.stripslashes($olapelN);
								$detailurl='productdetails';								
																
								$groupname = stripslashes(App\Cart::cartdescnfo($cart->id,'ofabricName'));
								
								$oprodType = stripslashes(App\Cart::cartdescnfo($cart->id,'oprodType'));
								$mainfab = stripslashes(App\Cart::cartdescnfo($cart->id,'subprotype'));
								$oprodType=$mainfab.' - '.$oprodType;
								
								$size=App\Cart::cartdescnfo($cart->id,'osizeFit');
								$fabno='';
								$productname = stripslashes(App\Cart::cartdescnfo($cart->id,'oprodName'));								
								
								if(strlen($productname)>20){
									$productname=substr($productname,0,25).'...';
								}else{
									$productname=$productname;
								}
								
									
								
							}
							
							
							
                            ?>
                            
                              	<tr id="item_{{$cart->id}}">
                                	<td class="item-sr" align="center" >No.{{$i}}</td>
                                	<td class="item-dis" align="left">
                                    	<div class="cart-item-image">
                                        	<figure>
                                            <img src="{{URL::asset('/storage/'.$cart->canvas_front_img)}}" width="100px" height="100px;">
                                            </figure>
                                            
                                            <a href="{{url('cart/')}}/<?php echo $detailurl;?>/{{$cart->id}}">View Details</a>
                                        </div>
                                        <div class="cart-short-detail">
                                        @if($cart->product_type!=0)
                                        <p>{{$productname}}</p>
                                        @endif
                                        	<span>{{$oprodType}}</span>
                                        	<p>{{$ocollarName}}</p>
                                            {{$olapelName}}
                                            @if($cart->product_type==0)
                                            <p>Fabric No : {{$fabno}}</p>
                                            @endif
                                            <p>Size : {{$size}}</p>
                                        </div>
                                    </td>
                                	<td class="item-fab" align="center">
                                    	<div class="cart-fabric-image">
                                        	<figure>
                                            @if($cart->fabric_image!='')
                                        <img src="{{URL::asset('/storage/'.$cart->fabric_image)}}"  alt="" width="100px" height="100px">
                                      		@endif
                                            </figure>
                                        </div>
                                        <span>{{$groupname}}</span>
                                          
                                    </td>
                                    <td class="item-price" align="center">${{number_format($cart->price,2)}}</td>
                                	<!--<td class="item-ship" align="center">$19.99</td>-->
                                    <td class="item-qty" align="center">{{$cart->qty}}</td>
                                	

                                    <td class="item-total" align="center">$<?php $toamt=$cart->price*$cart->qty;
									echo number_format($toamt, 2);?></td>
                                    <?php
                                    if($cart->cat_id==1){
										$editpath='designshirts/edit';
									}elseif($cart->cat_id==2){
										$editpath='designjackets/edit';
									}elseif($cart->cat_id==3){
										$editpath='designvests/edit';
									}elseif($cart->cat_id==18){
                                        $editpath='designthreepiece/edit';
                                    }elseif($cart->cat_id==19){
                                        $editpath='designtwopiece/edit';
                                    }else{
										$editpath='designpants/edit';
									}
									?>
                                	<td class="item-trash" align="center">
                                    @if($cart->product_type==0 && $cart->cat_id != 18 && $cart->cat_id != 19)
                                        <a href="{{url($editpath,$cart->id)}}" ><i class="fa fa-edit" aria-hidden="true"></i></a> 
                                    @endif
                                    <a class="deleteCattItem" data-id="{{ $cart->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a></td>
                              	</tr>
                                <?php $total=$toamt+$total;?>
                                @endforeach
                            </tbody>
						</table>
                        <div class="pt-cart-amount">
                        	<div class="pt-table-row">
                            	<label><span id="nitem">{{$i}}</span> Item(s) Price :</label>
                                <span id="subttl">${{number_format($total,2)}}</span>
                            </div>
                            
                            <div class="pt-final-amount">
                            	<label>Total :</label>
                                <span>${{number_format($total,2)}}</span>
                            </div>
                        </div>

					</div>
                    <div class="pt-cart-amount formobile">
                            <div class="pt-table-row">
                                <label><span id="nitem">{{$i}}</span> Item(s) Price :</label>
                                <span id="subttl">${{number_format($total,2)}}</span>
                            </div>
                            
                            <div class="pt-final-amount">
                                <label>Total :</label>
                                <span>${{number_format($total,2)}}</span>
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
<script type="text/javascript" src="{{asset('asset/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset/js/bootstrap.min.js')}}"></script>
    <!-- Bootstrap bootstrap-touch-slider Slider Main JS File -->
    <script type="text/javascript" src="{{asset('asset/js/float-panel.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset/js/responsive_bootstrap_carousel.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset/js/jquery.touchSwipe.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset/js/bootstrap-touch-slider.js')}}"></script>
    <script type="text/javascript">
        $( '#et-banner' ).bsTouchSlider();
    </script>
<!-- --------------------------------------Product Modal Section----------------------------- -->


<!-- --------------------------------------Product Section End Here----------------------------- -->
<script type="text/javascript">
$(".deleteCattItem").click(function(){
        var id = $(this).data("id");
        
        var token = $(this).data("token");
         if (confirm("Sure you want to delete this item? ")) {
        $.ajax(
        {
            url: "/../cart/delete/"+id,
            type: 'POST',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: function (data)
            {
                console.log(data);
                var t=data['sum'];
                $(".pt-cart-amount span#subttl").html("$"+(data['sum']));
                $(".pt-cart-amount span#nitem").html(data['coun']);
                $(".pt-final-amount span").html("$"+(data['sum']));
                $('#item_'+id).fadeOut();
                $('#item_'+id).remove();
                var i = 1;
                $('.table-condensed tbody tr .item-sr').each(function(){
                    $(this).text('No.'+i);
                    i++;
                   // alert(i++);
                });
            }
        });
       
    }
    return false;
  });
    </script>
</body>
</html>