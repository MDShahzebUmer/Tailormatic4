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
  <?php
  $cartcount = App\Http\Helpers::cartcount();
  ?>
  <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.paypal') !!}" > 
   {{ csrf_field() }}  
   <div class="row">
       <div class="pt-cart-header et-fw">
           <div class="pt-cart-title et-left">
               <h1>Checkout</h1>
           </div>
           <div class="et-step-progress">
            <ul class="et-step-list">
              <li class="et-prog-step et-clear">
                <span class="step-num">1</span>
                <span class="step-nam">Cart</span>
              </li>
              <li class="et-prog-step et-clear">
                <span class="step-num">2</span>
                <span class="step-nam">Shipping</span>
              </li>
              <li class="et-prog-step et-clear">
                <span class="step-num">3</span>
                <span class="step-nam">Checkout</span>
              </li>
              <li class="et-prog-step last active">
                <span class="step-num">4</span>
                <span class="step-nam">Payment</span>
              </li>
            </ul>
          </div>
           <div class="pt-button-block et-right">
               <ul>
                   <li><a class="pt-cart-btn" href="{{url('/designshirts')}}">Continue Shopping</a></li>
                   <li><!--<a class="pt-cart-btn" href="{!! URL::route('addmoney.paypal') !!}">Checkout</a>-->
                    <button type="submit" class="pt-cart-btn pt-paypal-button">
                        Paypal Payment
                    </button></li>
                    <input id="amount" type="hidden" class="form-control" name="amount" value="100" autofocus>
                </ul>
            </div>
        </div>
    </div>
</form>
@if ($message = Session::get('error'))
<div class="custom-alerts alert alert-danger fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
    {!! $message !!}
</div>
<?php Session::forget('error');?>
@endif
<div class="row">
   <div class="pt-cart-list et-fw">
      <div class="pt-cart-style et-fw">
                  <?php //$datap= unserialize($data['item_description']);


                  ?>
                  <table class="table table-condensed">
                   <thead>
                     <tr>
                       <th class="table-cell-1 text-center">Item</th>
                       <th class="table-cell-2 text-left">Item Description</th>
                       <th class="table-cell-3 text-center">Fabric</th>
                       <th class="table-cell-4 text-center">Price</th>
                       <th class="table-cell-5 text-center">Shipping</th>
                       <th class="table-cell-6 text-center">Quantity</th>
                       <th class="table-cell-7 text-center">Total</th>
                       <th class="table-cell-8 text-center">Edit / Delete</th>
                   </tr>
               </thead>
               <tbody>
                <?php 
                $i=0;
                $total=0;
                $shipamt=0;
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
                   <td class="item-sr" align="center">No.{{$i}}</td>
                   <td class="item-dis" align="left">
                       <div class="cart-item-image">
                           <figure>
                            <img src="{{URL::asset('/storage/'.$cart->canvas_front_img)}}">
                        </figure>
                        <a href="{{url('cart/details')}}/{{$cart->id}}">View Details</a>
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
        <td class="item-ship" align="center">${{number_format($cart->shipping,2)}}</td>
        <td class="item-qty" align="center">{{$cart->qty}}</td>
        <td class="item-total" align="center">$<?php $toamt=$cart->price*$cart->qty; echo number_format($toamt, 2);
           ?></td>
           <td class="item-trash" align="center"><a class="deleteCattItems" data-id="{{ $cart->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash-o" aria-hidden="true"></i>
           </a></td>
       </tr>
       <?php 
       $total=$toamt+$total;
       $shipamt=$shipamt+$cart->shipping;								
       ?>
       @endforeach
   </tbody>
</table>

<?php
function isMobile() { return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]); }
if(isMobile()){
$t=1;
 
 } else { 
  $t=2;
  }

?>
<?php if($t==2){?>
<div class="col-md-4 pull-right">

    <div class="pt-cart-amount">
       <div class="pt-table-row ">
           <label>{{$i}} Item(s) Price :</label>
           <span id="subttl">${{number_format($total,2)}}</span>
       </div>
       <div class="pt-table-row">
           <label>Shipping :</label>
           <span id="shipg">${{number_format($shipamt,2)}}</span>
       </div>
       <div class="pt-table-row" id="coupns" style="display:none">
        <label>Coupon Discount :</label>
        <span id="dics">$0.00</span>

    </div>
    @if($tax!=0)
    <div class="pt-table-row">
           <label>Tax :</label>
           <?php
           $taxcharge=round(($total*$tax)/100,2);
		   ?>
           <span id="tax">${{number_format($taxcharge,2)}}</span>
       </div>
	@else
    <?php $taxcharge=0;?>
     <div class="pt-table-row"  style="display:none">
           <label>Tax :</label>
          
           <span id="tax"></span>
       </div>
    @endif
    
    
   
    <div class="pt-final-amount">
       <label>Total :</label>
       <span>${{number_format($total+$shipamt+$taxcharge,2)}}</span>
   </div>
</div>
<div class="row">
    <div class="col-md-offset-6 col-md-6 et-coupan-code">
        <a href="#." id="coup">Coupon Code</a>
        <div class="input-group et-form-coupon coupn-wrap" id="coupn" style="display:none">
            <input type="text" class="form-control" name="coupon" id="coupon" data-token="{{ csrf_token() }}" placeholder="Enter Code">
            <span class="input-group-addon" id="basic-addon2"><button type="submit" class="btn btn-coupan coupanAdd">Apply</button></span>
		</div>
        <p class="errorMessage" id="errorMessage"></p>
        <p class="termMessage" id="termMessage" style="color:#FFF;"></p>
        <span class="text-center full-witdh"><a class="termShow" id="termShow" target="_blank"></a></span>
    </div>
</div>

</div> 
<?php }?>
<div class="col-md-8">
    <div class="et-advertisement">
    	<ul class="et-adv-list">
        
        
        	
            <?php
            $shirtc = App\Http\Helpers::cartcrossspro(1);
			?>
            @if($shirtc==0)
            <li class="adv-item">
            	<div class="adv-block" style="background-image:url({{asset('/storage/FrontProductImg/5.jpg')}});">
                	<h2>get up to 20% off</h2>
                    <h3>on Shirt today</h3>
                    <a target="_blank" href="{{url('designshirts')}}">Shop Now</a>
                </div>
            </li>
            @endif
            <?php
            $jkc = App\Http\Helpers::cartcrossspro(2);
			?>
             @if($jkc==0)
            <li class="adv-item">
            	<div class="adv-block" style="background-image:url({{asset('/storage/FrontProductImg/1.jpg')}});">
                	<h2>get up to 22% off</h2>
                    <h3>on jacket today</h3>
                    <a target="_blank" href="{{url('designjackets')}}">Shop Now</a>
                </div>
            </li>
            @endif
             <?php
            $vsc = App\Http\Helpers::cartcrossspro(3);?>
             @if($vsc==0)
            <li class="adv-item">
            	<div class="adv-block" style="background-image:url({{asset('/storage/FrontProductImg/6.jpg')}});">
                	<h2>get up to 25% off</h2>
                    <h3>on vests today</h3>
                    <a target="_blank" href="{{url('designvests')}}">Shop Now</a>
                </div>
            </li>
             @endif
             <?php
            	$psc = App\Http\Helpers::cartcrossspro(4);?>
             @if($psc==0)
            <li class="adv-item">
            	<div class="adv-block" style="background-image:url({{asset('/storage/FrontProductImg/7.jpg')}});">
                	<h2>get up to 25% off</h2>
                    <h3>on pant today</h3>
                    <a target="_blank" href="{{url('designpants')}}">Shop Now</a>
                </div>
            </li>
           @endif
          
            
        </ul>
    </div>
</div>  
</div>
</div>
<?php if($t==1){?>
<div class="col-md-4 pull-right formobile">

    <div class="pt-cart-amount">
       <div class="pt-table-row ">
           <label>{{$i}} Item(s) Price :</label>
           <span id="subttl">${{number_format($total,2)}}</span>
       </div>
       <div class="pt-table-row">
           <label>Shipping :</label>
           <span id="shipg">${{number_format($shipamt,2)}}</span>
       </div>
       <div class="pt-table-row" id="coupns" style="display:none">
        <label>Coupon Discount :</label>
        <span id="dics">$0.00</span>

    </div>
    @if($tax!=0)
    <div class="pt-table-row">
           <label>Tax :</label>
           <?php
           $taxcharge=round(($total*$tax)/100,2);
       ?>
           <span id="tax">${{number_format($taxcharge,2)}}</span>
       </div>
  @else
    <?php $taxcharge=0;?>
     <div class="pt-table-row"  style="display:none">
           <label>Tax :</label>
          
           <span id="tax"></span>
       </div>
    @endif
    
    
   
    <div class="pt-final-amount">
       <label>Total :</label>
       <span>${{number_format($total+$shipamt+$taxcharge,2)}}</span>
   </div>
</div>
<div class="row">
    <div class="col-md-offset-6 col-md-6 et-coupan-code">
        <a href="#." id="coup">Coupon Code</a>
        <div class="input-group et-form-coupon coupn-wrap" id="coupn" style="display:none">
            <input type="text" class="form-control" name="coupon" id="coupon" data-token="{{ csrf_token() }}" placeholder="Enter Code">
            <span class="input-group-addon" id="basic-addon2"><button type="submit" class="btn btn-coupan coupanAdd">Apply</button></span>
    </div>
        <p class="errorMessage" id="errorMessage"></p>
        <p class="termMessage" id="termMessage" style="color:#FFF;"></p>
        <span class="text-center full-witdh"><a class="termShow" id="termShow" target="_blank"></a></span>
    </div>
</div>

</div> 
<?php }?>
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
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />

<script type="text/javascript">
$( '#et-banner' ).bsTouchSlider();
</script>
<script language="javascript">
$(document).ready(function() {
    $("#coup").click(function() {
        $("#coupn,#coupns").show();
                //$('#coupn').fadeOut(3000);

            });
});
</script>
<script type="text/javascript">
$(".coupanAdd").click(function(){
    var ids = $('#coupon').val();
    var token = $('#coupon').data("token");
    var subttl = $('#subttl').html();
    var shipg = $('#shipg').html();
	var tax = $('#tax').html();

    subttl = $.trim(subttl.replace('$',''));
    shipg  = $.trim(shipg.replace('$',''));
	tax  = $.trim(tax.replace('$',''));

    $.ajax(
    {
        url: "cart/coupan/"+ids,
        type: 'POST',
        dataType: "JSON",
        data: {
            "id": ids,
            "_method": 'POST',
            "_token": token,
        },
        success: function (data)
        {
            var cc =parseFloat(data['sum']);
			var tax =parseFloat(data['tax']);
            var ftotal=parseFloat(subttl)-(-parseFloat(shipg))-parseFloat(cc)-(-parseFloat(tax));
            $("#dics").html("$"+(cc).toFixed(2));
			if(tax!=0){
					$(".pt-table-row span#tax").html("$"+(tax).toFixed(2));
				}
            $(".pt-final-amount span").html("$"+(ftotal).toFixed(2));
            $("#errorMessage").html(data['suc']);
            $("#termMessage").html(data['short']);
            var te = data['term'];
            var links = "{{route('cartitems.coupanterm')}}/"+te;
            $("#termShow").attr('href',links);
            $("#termShow").text('Read More Coupan Code Policies');

        },
        error: function(data)
        {
            $("#errorMessage").html("Invalid Coupon");
            $('#coupon').val('');
            $("#coupns span#dics").html("$0.00");

        }
    });
});
</script>
<script type="text/javascript">
$(".deleteCattItems").click(function(){
    var id = $(this).data("id");
         

       var token = $(this).data("token");

       if (confirm("Sure you want to delete this item? ")) {
        $.ajax(
        {
            url: "/../cartitems/delete/"+id,
            type: 'POST',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: function (data)
            {
            
                var t=data['sum'];
                var shp =data['shipping'];
				var tax =data['tax'];
                var sums = parseFloat(shp)+parseFloat(t)+parseFloat(tax);
				//var tax = parseFloat(tax);                      
                $(".pt-cart-amount span#subttl").html("$"+(data['sum']));
                $(".pt-cart-amount span#nitem").html(data['coun']);
                $(".pt-table-row span#shipg").html("$"+(shp));
				if(tax!=0){
					$(".pt-table-row span#tax").html("$"+(tax));
				}
                $(".pt-final-amount span").html("$"+(sums));
                $("#coupns span#dics").html("$0.00");
                $("#coupns").css("display","none")
                $("#coupon").val('');
                $("#coupn").css("display","none");				
                $("#errorMessage").html(" ");
                $('#item_'+id).fadeOut();
                $('#item_'+id).remove();
                var i = 1;
                $('.table-condensed tbody tr .item-sr').each(function(){
                    $(this).text('No.'+i);
                    i++;
                   
                });
            }
        });

}
return false;
});
</script>

</body>
</html>