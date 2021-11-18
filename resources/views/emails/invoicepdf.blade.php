<!DOCTYPE html>
<html>
<head>
	<title>Email Invoice</title>
	<?php
	
	//print_r($invoicedata);
	
	
	foreach($orderdata as $ordata){
	}
	
	 $shippinginfo = App\Http\Helpers::shippinginfo($ordata->ship_id);	 
	 $shipcountry = App\Country::get_country_name($shippinginfo->scountry_id);
	 $shippncode = App\Country::get_country_ph($shippinginfo->scountry_id);
	 	 
	 $shipstate = App\State::get_state_name($shippinginfo->sstate);	
	$useremail=Auth::user()->email;
	
	$usercountry = App\Country::get_country_name(Auth::user()->country_id);
	$userstate = App\State::get_state_name(Auth::user()->state);
	
	$cntryphncode = App\Country::get_country_ph(Auth::user()->country_id);
	

$style = [
    /* Layout ------------------------------ */

    'body' => 'margin: 0; padding: 0; width: 100%;',
    'table-body' => 'width: 100%; max-width: 790px; margin: 0 auto;border: 2px solid #212325; color: #333;',
    'invoice-header' => 'padding: 8px; line-height: 1.42857143; vertical-align: top; background: #212325; text-align: center;',
    'logo-img' => 'max-width: 260px;',
    'invoice-header-title' => 'padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; font-style: italic;background: #593A2E; font-size: 15px; letter-spacing: 1px; color: #fff; font-family: "Proxima Nova Regular";',
    'td-contents' => 'padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;',
    'td-contents-strong' => 'width: 100px; float: left; font-weight: 700;',
    'p-margin0' => 'margin: 0;',
    'p-marginBottom' => 'margin: 0; margin-bottom: 10px;',
    'footer-td-wrap' => 'padding: 8px;  vertical-align: top; border-top: 1px solid #ddd; font-style: italic;background: #593A2E; font-size: 15px; letter-spacing: 1px; color: #fff; font-family: "Proxima Nova Regular"; height:25px;',
    'footer-ul' => 'display: block; width: 475px; margin: 0 auto;',
    'footer-li' => 'float: left; text-align: center; border-right: 1px solid #fff; margin-right: 15px; list-style-type: none;font-style: normal;',
    'footer-li-a' => 'color: #fff; padding-right: 15px;text-decoration: none;',
    'footer-li-last-child' => 'float: left; text-align: center;  margin-right: 15px; list-style-type: none;font-style: normal;',

];
?>
</head>
<body style="{{ $style['body'] }}">
	<table cellpadding="0" cellspacing="0" style="{{ $style['table-body'] }}">
	    <thead>
	      <tr>
	        <td colspan="6" style="{{ $style['invoice-header'] }}"><img style="{{ $style['logo-img'] }}" src="{{asset('asset/img/email_logo.png')}}"></td>
	      </tr>
	    </thead>
	    <tbody>
	        <tr>
	          <th colspan="6" style="{{ $style['invoice-header-title'] }}" >Order Details</th>
	        </tr>
	        <tr class="orderId">
	          <td colspan="6" style="{{ $style['td-contents'] }}"><strong style="{{ $style['td-contents-strong'] }}">Order Id :</strong> #{{$ordata->id}}</td>
	        </tr>
             <tr class="orderId">
	          <td colspan="6" style="{{ $style['td-contents'] }}"><strong style="{{ $style['td-contents-strong'] }}">Tracking No :</strong> #{{$ordata->tracking_code}}</td>
	        </tr>
	         <tr class="orderId">
	          <td colspan="6" style="{{ $style['td-contents'] }}"><strong style="{{ $style['td-contents-strong'] }}">Order Date : </strong>{{date_format($ordata->created_at,"Y/m/d")}}</td>
	        </tr>
	        <tr>
	          <th align="left" colspan="3" style="{{ $style['invoice-header-title'] }}">Billing Information</th>
	          <th align="left" colspan="3" style="{{ $style['invoice-header-title'] }}">Shipping Information</th>
	        </tr>
	        <tr class="billing-info">
	          <td colspan="3" style="{{ $style['td-contents'] }}">
	            <p style="{{ $style['p-margin0'] }}"><strong>Name :</strong> {{Auth::user()->name}} {{Auth::user()->lname}}</p>
	            <p style="{{ $style['p-margin0'] }}"><strong>Email :</strong> {{Auth::user()->email}}</p>
	            <p style="{{ $style['p-margin0'] }}"><strong>Contact No. :</strong> {{$cntryphncode}} {{Auth::user()->phone}}</p>
	            <p style="{{ $style['p-margin0'] }}"><strong>Address : </strong>
	            {{Auth::user()->address}}, <br> {{Auth::user()->city}}-{{Auth::user()->zipcode}} {{$userstate}}, {{$usercountry}}
	            </p>
	          </td>
	          <td colspan="3" style="{{ $style['td-contents'] }}">
	            <p style="{{ $style['p-margin0'] }}"><strong>Name :</strong> {{$shippinginfo->sfname}} {{$shippinginfo->slname}}</p>
	            <p style="{{ $style['p-margin0'] }}"><strong>Email :</strong> {{$useremail}}</p>
	            <p style="{{ $style['p-margin0'] }}"><strong>Contact No. :</strong> {{$shippncode}} {{$shippinginfo->sphone}}</p>
	            <p style="{{ $style['p-margin0'] }}"><strong>Address : </strong>
	            {{$shippinginfo->saddress}}, <br> {{$shippinginfo->scity}}-{{$shippinginfo->szipcode}} {{$shippinginfo->$shipstate}}, {{$shippinginfo->$shipcountry}}
	            </p>
	          </td>
	        </tr>
	        <tr class="invoice-header-title">
	          <th colspan="6" style="{{ $style['invoice-header-title'] }}">Ordered Items</th>
	        </tr>
	        <tr>
	            <th style="{{ $style['td-contents'] }}">Item</th>
	            <th style="{{ $style['td-contents'] }}">Fabric</th>
	            <th style="{{ $style['td-contents'] }}">Unit Price</th>
                <th style="{{ $style['td-contents'] }}">Shipping</th>
                <th style="{{ $style['td-contents'] }}">Quantity</th>
	            <td style="{{ $style['td-contents'] }}" align="right"><strong>Total</strong></td>
	        </tr>
				<?php 
					$i=0;
					$total=0;
					$shipamt=0;
                ?>
                @foreach($invoicedata as $cart)
                    @php 
                    $i++
                    @endphp
                    
					<?php										
						if($cart->product_type==0){							
							$groupname = App\OrderItem::groupinfo($cart->group_id,'fbgrp_name');
							$oprodType = App\OrderItem::orderiteminfo($cart->id,'oprodType');
							if($cart->cat_id==1){
							$ocollarName = App\OrderItem::orderiteminfo($cart->id,'ocollarName');
							$olapelName='';						
							}elseif($cart->cat_id==2){
							$ocollarName = App\OrderItem::orderiteminfo($cart->id,'ostyleName');
							$olapelN=App\OrderItem::orderiteminfo($cart->id,'olapelName');
							$olapelName=$olapelN;
							}elseif($cart->cat_id==3){
							$ocollarName = App\OrderItem::orderiteminfo($cart->id,'ostyleName');						
							$olapelName='';						
							}elseif($cart->cat_id==4){
								$ocollarName = App\OrderItem::orderiteminfo($cart->id,'ostyleName');
								$olapelN=App\OrderItem::orderiteminfo($cart->id,'opleatName');
								$olapelName=$olapelN;						
							}elseif($cart->cat_id==18){
								$ocollarName = App\OrderItem::orderiteminfo($cart->id,'ostyleName');
								$olapelN=App\OrderItem::orderiteminfo($cart->id,'olapelName');
								$olapelName=$olapelN;						
							}elseif($cart->cat_id==19){
								$ocollarName = App\OrderItem::orderiteminfo($cart->id,'ostyleName');
								$olapelN=App\OrderItem::orderiteminfo($cart->id,'olapelName');
								$olapelName=$olapelN;						
							}
							
							//$canvasimg = App\Cart::cartdescnfo($cart->id,'ofrontView');
							$size=App\OrderItem::orderiteminfo($cart->id,'osizeFit');
							$fabno=App\OrderItem::allinfodes('etfabrics',$cart->fabric_id,'fabric_code');
							
						}else{
							$groupname = App\OrderItem::orderiteminfo($cart->id,'ofabricName');
							$oprodType = App\OrderItem::orderiteminfo($cart->id,'oprodName');
							$procode = App\OrderItem::orderiteminfo($cart->id,'procode');
							$ocollarName='Model No : '.$procode;
							$olapelN=App\OrderItem::orderiteminfo($cart->id,'ofabricType');
							$olapelName='Fab Type : '.stripslashes($olapelN);					
							
							$size=App\OrderItem::orderiteminfo($cart->id,'osizeFit');
						}
                    ?>
	        <tr>
	            <td style="{{ $style['td-contents'] }}">
	            	<p style="{{ $style['p-margin0'] }}">{{$oprodType}}</p>
                	<p style="{{ $style['p-margin0'] }}">{{$ocollarName}}</p>
                     {{$olapelName}}
                     @if($cart->product_type==0)	
                    <p style="{{ $style['p-margin0'] }}">Fabric No : {{$fabno}}</p>
                    @endif
                    <p style="{{ $style['p-margin0'] }}">Size : {{$size}}</p>
                 </td>
	            <td align="center" style="{{ $style['td-contents'] }}">
                @if($cart->fabric_image!='')	
                <img src="{{URL::asset('/storage/'.$cart->fabric_image)}}" width="50"  alt="">@endif <br><span>{{$groupname}}</span></td>
	            <td align="center" style="{{ $style['td-contents'] }}">${{number_format($cart->price,2)}}</td>
                <td align="center" style="{{ $style['td-contents'] }}">${{number_format($cart->shipping,2)}}</td>
                <td align="center" style="{{ $style['td-contents'] }}">{{$cart->qty}}</td>
	            <td style="{{ $style['td-contents'] }}" align="right">$<?php $toamt=$cart->price*$cart->qty;
									echo number_format($toamt, 2);?>
	            </td>
	        </tr>
	        <?php 
				$total=$toamt+$total;
				$shipamt=$shipamt+$cart->shipping;            
            ?>
	        @endforeach
            
            <?php
			$grtotal=$total+$shipamt;
            $orderid=$cart->order_id;
			$orderinfo = App\Order::orderinfo($orderid);
			$camt=$orderinfo->coupon_amt;
			$ccode=$orderinfo->coupon_code;
			$taxamt=$orderinfo->tax_amt;
			$ortotal=$orderinfo->od_total;
			?>
            <tr>
	            <td style="{{ $style['td-contents'] }}" align="right" colspan="5">
	              <p style="{{ $style['p-marginBottom'] }}"><strong>Sub Total: </strong></p>
	              <p style="{{ $style['p-marginBottom'] }}"><strong>Shipping: </strong></p>
                  <?php if($camt!=0){?>
                   <p style="{{ $style['p-marginBottom'] }}"><strong>Coupon<small>({{$ccode}})</small>: </strong></p>
                   <?php } ?>
                    <?php if($taxamt!=0){?>
                   <p style="{{ $style['p-marginBottom'] }}"><strong>Tax: </strong></p>
                   <?php } ?>
	            </td>
	            <td style="{{ $style['td-contents'] }}" align="right">
	              <p style="{{ $style['p-marginBottom'] }}"><strong>${{number_format($total,2)}}</strong></p>
	              <p style="{{ $style['p-marginBottom'] }}"><strong>${{number_format($shipamt,2)}}</strong></p>
                   <?php if($camt!=0){?>
                  <p style="{{ $style['p-marginBottom'] }}"><strong>-${{number_format($camt,2)}}</strong></p>
                   <?php } ?>
                    <?php if($taxamt!=0){?>
                  <p style="{{ $style['p-marginBottom'] }}"><strong>${{number_format($taxamt,2)}}</strong></p>
                   <?php } ?>
	            </td>
	        </tr>
	        <tr>
	        	<td style="{{ $style['td-contents'] }}" align="right" colspan="5">
	        		<p style="{{ $style['p-marginBottom'] }}"><strong>Total: </strong></p>
	        	</td>
	        	<td style="{{ $style['td-contents'] }}" align="right">
	        		<p style="{{ $style['p-marginBottom'] }}"><strong>${{number_format($ortotal,2)}}</strong></p>
	        	</td>
	        </tr>
	        <tr>
	          <td align="center" style="{{ $style['td-contents'] }}" colspan="6" >
	          <p style="{{ $style['p-margin0'] }}"><strong>Terms & Conditions</strong></p>
	          <p>eTailor garments are shipped worldwide individually and immediately upon production completion, directly from our production facilities to the customer's door without separate warehousing and/or re-shipping in order to minimize delivery time and carbon footprint. Separate shipping charges for each product ordered apply.</p>
	          </td>
	        </tr>
	        <tr>
	          <td style="{{ $style['footer-td-wrap'] }}" colspan="6">
	            <ul style="{{ $style['footer-ul'] }}">
	              <li style="{{ $style['footer-li'] }}"><a style="{{ $style['footer-li-a'] }}" href="{{url('/pages/about-us')}}">About Us</a></li>
	              <li style="{{ $style['footer-li'] }}"><a style="{{ $style['footer-li-a'] }}" href="{{url('/pages/contact-us')}}">Contact Us</a></li>
	              <li style="{{ $style['footer-li'] }}"><a style="{{ $style['footer-li-a'] }}" href="{{url('/pages/how-we-work')}}">How it Works</a></li>
	              <li style="{{ $style['footer-li-last-child'] }}"><a style="{{ $style['footer-li-a'] }}" href="{{url('/pages/faq')}}">FAQ'S</a></li>
	            </ul>
	          </td>
	        </tr>
	    </tbody>
  </table>
</body>
</html>