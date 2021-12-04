<?php  $seo = App\Http\Helpers::page_seo_details(19);?>
@include('../layouts.inc.page_header')
@include('../layouts.inc.page_menu')
<section class="et-content ec-product-details">
	<div class="container ">
		<div class="row">
			<div class="et-block">
				<?php //echo'<pre>'.print_r($proimg,true).'</pre>'; ?>
				<div class="col-sm-12 col-md-4">
					<ul class="piclist">

                        @foreach($proimg as $timg)
                         @if($loop->first)
                         <?php $firstimg=$timg->main_img;?>
                         @endif

						<li><img src="{{url('/storage')}}/{{$timg->main_img}}" alt=""></li>
						@endforeach
					</ul>
					<div class="picZoomer">

						<img src="{{url('/storage')}}/{{$firstimg}}"  alt="">
					</div>
				</div>
				<form name="" action="" method="post">
					 {{ csrf_field() }}
				<div class="col-sm-12 col-md-8 responsive-mr-top">
					<div class="row">
						<div class="col-sm-8">
							<div class="product-detail-content">

								<h3 class="product-head">{{$mpdata->product_name}}</h3>
								<div class="sug-price">

									<input type="hidden" name="productid" value="{{$mpdata->id}}" id="idPD" data="" required>
									  @if($mpdata->product_offer_rate == 0 || $mpdata->product_offer_rate == '')
									<p class="sug-text">Suggested price: &#36; {{number_format($mpdata->product_mrp,2)}}</p>
									<input type="hidden" value="{{$mpdata->product_mrp}}" name="price">
									@else
									<p class="sug-text">Suggested price: &#36;<del class="cross-price">{{number_format($mpdata->product_mrp,2)}}</del></p>
									<p class="sale-price">Sale: &#36;{{number_format($mpdata->product_offer_rate,2)}}</p>
									<p class="save-price">You Save: &#36;<?php $sav = ($mpdata->product_mrp)-($mpdata->product_offer_rate);  echo number_format($sav,2); ?> (<?php echo App\Http\Helpers::get_cal_discount($mpdata->product_mrp,$mpdata->product_offer_rate) ?>%)</p>
                                     <input type="hidden" value="{{$mpdata->product_mrp}}" name="price" required>
									@endif
								</div>

              @if($mpdata->product_size!='')

                     @if($mpdata->product_type==1)
                     <?php
							$cussize=unserialize($mpdata->product_size);
					?>
                            <div class="product-desc" style="clear:both">
                           <p><strong>Size : </strong> <?php echo $cussize[0]; ?> </p>
                             <input type="hidden" value="<?php echo $cussize[0]; ?>" name="size" required>
                             </div>
                    @else
                    <div class="size-box">
                      <div class="input-group">

                            <?php $prsize = App\MeasurmentSize::get_ecollection_size_dropdown($mpdata->product_size ,$mpdata->main_catid);?>
                            @if($mpdata->main_catid == 1)

                                @if(count($prsize) > 1)
                                    <span class="input-group-btn">
                                        <p class="btn btn-secondary">Size : </p>
                                    </span>
                                    <select id="lunch" class="selectpicker form-control" data-live-search="true" title="" name="size" required>
                                        <option value="" disabled="" selected="">Select</option>
                                        @foreach($prsize as $szi)
                                        <option value="<?php echo App\MeasurmentSize::ecollection_size_name($szi) ?>"><?php echo App\MeasurmentSize::ecollection_size_name($szi) ?></option>
                                        @endforeach
                                    </select>

                                @else
                                    <p class="color-name">Size&nbsp;: <span><?php echo App\MeasurmentSize::ecollection_size_name($prsize[0]) ?></span></p>
                                     <input type="hidden" value="<?php echo App\MeasurmentSize::ecollection_size_name($prsize[0]) ?>" name="size" required>
                                @endif
                            @elseif($mpdata->main_catid == 2 || $mpdata->main_catid == 3 || $mpdata->main_catid == 4)

                                @if(count($prsize) > 1)
                                    <span class="input-group-btn">
                                        <p class="btn btn-secondary" type="button">Size : </p>
                                    </span>
                                    <select id="lunch" class="selectpicker form-control" data-live-search="true" name="size" required>

                                        <option value="" selected="">Select</option>
                                        @foreach($prsize as $szi)
                                        <option value="<?php echo App\MeasurmentSize::ecollection_sizename($szi) ?>" ><?php echo App\MeasurmentSize::ecollection_sizename($szi) ?></option>
                                        @endforeach
                                    </select>
                                @else
                                    <p class="color-name">Size&nbsp; <span><?php echo App\MeasurmentSize::ecollection_sizename($prsize[0]) ?></span></p>
                                     <input type="hidden" value="<?php echo App\MeasurmentSize::ecollection_sizename($prsize[0]) ?>" name="size" required>
                                @endif


                            @else
                            <!-- Extra Category Size  -->
                           <input type="hidden" value="" name="size" required>
                            @endif


                      </div>
                    </div>

                    @endif

             @else
              <input type="hidden" value="" name="size" required>
             @endif
								<div class="size-box">
									<div class="input-group">
										<span class="input-group-btn">
											<button class="btn btn-secondary" type="button">QTY : </button>
										</span>
										<select id="lunch" class="selectpicker form-control" data-live-search="true" name="qty" required>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
										</select>

									</div>
								</div>
								<?php  ?>


								<div class="product-desc">
									<p><strong>Fabric Name : </strong> {{$mpdata->fabric_name}} </p>

                                    @if($mpdata->fabric_brand!='')
									<p><strong>Fabric Brand : </strong> {{$mpdata->fabric_brand}} </p>
                                    @endif
									 <?php $dt = App\EcollectionFabrictype::get_type_fabric_name($mpdata->fabric_type); ?>
									 @if($dt != '')
									<p><strong>Product Type : </strong> {{$dt}} </p>
									@endif
									<?php $dp = App\EcollectionPattern::get_fabric_patternname($mpdata->product_pattern); ?>
									 @if($dp != '')
									<p><strong>Product Pattern : </strong> {{$dp}} </p>
									@endif

                                    @if($mpdata->product_type==1)

                                    <?php
                                    if($mpdata->cat_id==1){
										$editpath='designshirts/sedit';
										$detailpath='shirtdetail';
									}elseif($mpdata->cat_id==2){
										$editpath='designjackets/sedit';
										$detailpath='jacketdetails';
									}elseif($mpdata->cat_id==3){
										$editpath='designvests/sedit';
										$detailpath='vestsdetails';
									}elseif($mpdata->cat_id==4){
										$editpath='designpants/sedit';
										$detailpath='paintdetails';
									}
									?>


                                   <a href="{{url($detailpath,$mpdata->id)}}"><img alt="" src="{{url('asset/img/details1.png')}}"></a>&nbsp; <a href="{{url($editpath,$mpdata->id)}}"><img alt="" src="{{url('asset/img/customize1.png')}}"></a>
                                   @endif

										</div>
									</div>
								</div>
								<div class="col-sm-4">

										<div class="btn-group text-center">
											  <?php  $outsto = App\Http\Helpers::product_outofstock($mpdata->id); ?>
											  @if($outsto == 0)
										<button type="sumbit" class="et-btn cart-btn" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</button>
										@else
										<button type="sumbit" class="et-btn cart-btn" disabled><i class="fa fa-shopping-cart" aria-hidden="true" ></i>Out Of Stock</button>
										@endif
	                                </form>
	                                @if($wpm != '')
	                                      <div class="message"></div>
										<button type="button" class="et-btn cart-btn"  id="wishlist" data-toggle="tooltip" title="Product is already in wishlist!"><i class="fa fa-heart" aria-hidden="true" ></i>Add to Wish List</button>
										@else
										<div class="message"></div>
										<button type="button" class="et-btn cart-btn" id="wishlist"><i class="fa fa-heart" aria-hidden="true"></i>Add to Wish List</button>
                                        @endif
									</div>
                                                                      <?php  $cartcount = App\Http\Helpers::cartcount(); ?>
									<div class="et-checkout-box pd-checkout-box">
										<div class="et-bag-box">
											<div class="et-bag-inner">
												<span>SHOPPING BAG</span>
												<div class="et-shope">
													<figure class="et-cart-icon">
														<img alt="" src="{{url('asset/img/cart-icon.png')}}">
													</figure>
													 <a>
													 <span>items:({{$cartcount}})</span>
													</a>

												</div>
											</div>
											<a class="et-ck-btn pd-ck-btn" >Checkout</a>
											 <input type="hidden" id="crtcount" value="{{$cartcount}}">
										</div>
									</div>
									<button type="button" class="et-btn cart-btn send-btn" data-toggle="modal" data-target="#sendProductLink"><i class="fa fa-link" aria-hidden="true"></i> Send Link</button>
								</div>
							</div>
						</div>
					</div>
				</div><!-- end row -->
				<!-- start row product description tab menu -->
     <div class="row">
       <div class="col-sm-12 product-details-tab">
         <ul class="nav nav-tabs">
           <li class="active"><a data-toggle="tab" href="#home">Fabric Description</a></li>
           <li><a data-toggle="tab" href="#menu1">Color Description</a></li>
           <li><a data-toggle="tab" href="#menu2">Quality Description</a></li>

         </ul>

         <div class="tab-content">
           <div id="home" class="tab-pane fade in active">
             <h4>Fabric Description</h4>
             <p>{{$mpdata->fabric_dec}}</p>
           </div>
           <div id="menu1" class="tab-pane fade">
             <h4>Color Description</h4>
             <p>{{$mpdata->color_desc}}</p>
           </div>
           <div id="menu2" class="tab-pane fade">
             <h4>Quality Description</h4>
             <p>{{$mpdata->quality_desc}}</p>
           </div>

         </div>
       </div>
     </div> <!-- end row product description tab menu -->
				<div class="row">
					<div class="col-sm-12 et-related-slider">
						@if($reld != '')
						<h2>Related Products</h2>
						@endif
						<!--*-*-*-*-*-*-*-*-*-*- BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*-->
						<div class="row">
							<div id="adv_gp_products_6_columns_carousel" class="carousel slide six_shows_one_move gp_products_carousel_wrapper" data-ride="carousel" data-interval="2000">
			<!--========= Wrapper for slides =========-->
			<div class="carousel-inner" role="listbox">

				<!--========= 1st slide =========-->


				@if($reld != '')
					<?php  $reld = App\EcollectionRelated::get_related_product_list_checkdata($reld);

					$rcount=count($reld);
                     $reld = array_filter($reld);
					   if(!empty($reld)){


					 $p=0;
						foreach($reld as $rr){
							$ecpd = App\EcollectionProduct::select('*')->find($rr);
                           /*if($ecpd != ''){*/
							$p++;

					if($p%6==0){

					$cle='</div></div><div class="item">';
					}else{

					$cle='</div>';

					}

					 ?>

					 <?php if($p==1){?>
					<div class="item active">
						<?php }?>


					<div class="col-xs-12 col-sm-4 col-md-2 gp_products_item">
						<div class="gp_products_inner">
							<div class="gp_products_item_image">
								<?php  $ecimg = App\EcollectionProimg::select('main_img')->where('product_id','=', $ecpd->id)->first(); ?>
								<a href="{{URL('/productdetails')}}/{{$ecpd->id}}">
									<img src="{{url('/storage')}}/{{$ecimg->main_img}}" alt="gp product" />

								</a>
							</div>
							<div class="gp_products_item_caption">
								<ul class="gp_products_caption_name">
									<li style="text-align:center"><a href="{{URL('/productdetails')}}/{{$ecpd->id}}">{{ Str::limit($ecpd->product_name,15) }}</a></li>
									<li style="text-align:center"><a>${{number_format($ecpd->product_mrp,2)}}</a></li>

								</ul>
								@if($ecpd->product_offer_rate == 0)
								<ul class="gp_products_caption_rating">
									<li style="text-align:center;text-transform:lowercase;"><a  style="text-transform:lowercase">${{$ecpd->product_mrp}}</a></li>
								</ul>
								@else
								<ul class="gp_products_caption_rating" style="text-align:center">
									<li style="text-align:center;text-transform:lowercase;"><a  style="text-transform:lowercase">$<?php  echo App\Http\Helpers::get_cal_discount($ecpd->product_mrp,$ecpd->product_offer_rate) ?>% <?php echo strtolower('off'); ?></a></li>
								</ul>
								@endif
							</div>
						</div>


					<?php echo $cle;?>

					<?php }}?>
					@endif

			</div>
			<!--======= Navigation Buttons =========-->

			<!--======= Left Button =========-->
			<a class="left carousel-control gp_products_carousel_control_left" href="#adv_gp_products_6_columns_carousel" role="button" data-slide="prev">
				<span class="fa fa-angle-left gp_products_carousel_control_icons" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>

			<!--======= Right Button =========-->
			<a class="right carousel-control gp_products_carousel_control_right" href="#adv_gp_products_6_columns_carousel" role="button" data-slide="next">
				<span class="fa fa-angle-right gp_products_carousel_control_icons" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>

		</div>

</div>
</div>
</div><!-- end row -->
</div>
</section>
<!-- Releted Product -->
<section class="releted-wrap full-width">
	<div class="container">

	</div>
</section>



<div class="modal fade send-link-modal" id="sendProductLink" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<!-- Modal Header -->
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
				<span class="sr-only">Close</span>
			</button>
			<h4 class="modal-title" id="myModalLabel">
				Send Product Link Your Friend
			</h4>
		</div>
		<!-- Modal Body -->
		<div class="modal-body">

			<form class="" role="form" method="POST" action="{{ url('/sendlink/') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input type="email" class="form-control"
					id="exampleInputEmail1" placeholder="Enter Email" name="user_email" required>
					<input type="hidden" name="proID" value="{{$mpdata->id}}" required>
				</div>
				<button type="submit" class="et-btn cart-btn send-btn">Submit</button>
			</form>
		</div>
	</div>
</div>
</div>
<!-- send link model end here -->
<!-- product zooming -->


<!-- Bootstrap Side Menu JS File -->
@include('../profile.profile-footer')
<script type="text/javascript">
    // search cat filter
    $(document).ready(function(e){
    	$('.search-panel .dropdown-menu').find('a').click(function(e) {
    		e.preventDefault();
    		var param = $(this).attr("href").replace("#","");
    		var concept = $(this).text();
    		$('.search-panel span#search_concept').text(concept);
    		$('.input-group #search_param').val(param);
    	});
    });
    </script>
    <!-- product zomming -->
    <script type="text/javascript">
    $(function() {
    	$('.picZoomer').picZoomer();
    	$('.piclist li').on('click',function(event){
    		var $pic = $(this).find('img');
    		$('.picZoomer-pic').attr('src',$pic.attr('src'));
    	});
    });
    </script>
    <script type="text/javascript">
$("#wishlist").click(function(){
		$('.message').text('');
        var id = $('#idPD').val();
        $.ajax(
        {
            url: "/../wishlistproduct/"+id,
            type: 'POST',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'GET',
            },
            success: function (res)
            {
            	if(res.checks)
            	{
            	  var url = "{{ url('/') }}/"+res.checks;
            	 var $a = $("<a>");
                  $a.attr("href",url);
                  $("body").append($a);
                  $a[0].click();
                  $a.remove();
            	}
            	else if(res.allready)
            	{

                   $('.message').text(res.allready);
            	}
            	else{
            		var sucess = res.sucess;
            		$('.message').text(sucess);
            	}

            }
        });
    return false;
  });
 </script>
 <script type="text/javascript">
$(document).ready(function(){
    $(".et-ck-btn").click(function(){
        var cc=$("#crtcount").val();

        if(cc==0) { alert("No item in the cart, please add 1");} else{  $(".et-ck-btn").attr("href","{{url('/cart')}}");}
    });
});
</script>


</body>
</html>
