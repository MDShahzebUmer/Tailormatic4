<?php  $seo = App\Http\Helpers::page_seo_details(19);?>
@include('../layouts.inc.page_header')
@include('../layouts.inc.page_menu')
<link rel="stylesheet" type="text/css" href="{{asset('asset/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/css/et-responsive.css')}}">
@include('../layouts.inc.section_div')
	<div class="container">
    	<div class="row">
          <div class="col-sm-12">
              <div class="et-sub-title et-fw">
                <h2>Order Item List</h2> 
              </div>
            </div>
        	<div class="et-block">
            	<div class="col-md-3 st-pro-leftbar">
                <div class="et-account-left-box">
                  <ul class="user-frofile-list">
                       @include('../layouts.inc.profile-menu')
                  </ul>
                </div> 
              </div>
              <div class="col-md-9 dt-responsive st-pro-content-wrap">
                  <div class="contact-box full-witdh order-list-data-table">
                      <table id="order-list-dt" class="table table-striped table-bordered " cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                  <th>Item</th>
                                  <th>Item Description</th>
                                  <!-- <th>Fabric</th> -->
                                  <th>Price</th>
                                  <th>Shipping</th>
                                  <th>QTY</th>
                                  <th>Total</th>
                                  <th>Item Cancel</th>
                                  <th>View Details</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>Item</th>
                                  <th>Item Description</th>
                                  <!-- <th>Fabric</th> -->
                                  <th>Price</th>
                                  <th>Shipping</th>
                                  <th>QTY</th>
                                  <th>Total</th>
                                  <th>Cancel</th>
                                  <th>View Details</th>
                              </tr>
                          </tfoot>
                          <tbody>
							<?php 
                                $i=0;
                                $total=0;
                                $shipamt=0;
								
								//print_r($orderdata);
                            ?>
                            @foreach($orderdata as $cart)
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
									$detailurl='itemdetail';					
									}elseif($cart->cat_id==2){
									$ocollarName = App\OrderItem::orderiteminfo($cart->id,'ostyleName');
									$olapelN=App\OrderItem::orderiteminfo($cart->id,'olapelName');
									$olapelName=$olapelN;
									$detailurl='jitemdetail';
									}elseif($cart->cat_id==3){
									$ocollarName = App\OrderItem::orderiteminfo($cart->id,'ostyleName');								
									$olapelName='';
									$detailurl='vitemdetail';	
                  }elseif($cart->cat_id==18){
                  $ocollarName = App\OrderItem::orderiteminfo($cart->id,'ostyleName');
                  $olapelN=App\OrderItem::orderiteminfo($cart->id,'olapelName');
                  $olapelName=$olapelN;
                  $detailurl='threepcitemdetail';
                  }elseif($cart->cat_id==19){
                  $ocollarName = App\OrderItem::orderiteminfo($cart->id,'ostyleName');
                  $olapelN=App\OrderItem::orderiteminfo($cart->id,'olapelName');
                  $olapelName=$olapelN;
                  $detailurl='twopcitemdetail';					
									}else{
									$ocollarName = App\OrderItem::orderiteminfo($cart->id,'ostyleName');
									$olapelN=App\OrderItem::orderiteminfo($cart->id,'opleatName');
									$olapelName=$olapelN;
									$detailurl='pitemdetail';
									
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
									$detailurl='productdetail';	
									
									
							   }
							   $canvasimg = App\OrderItem::allinfodes('order_items',$cart->id,'canvas_front_img');
							  $requeststatus = App\Http\Helpers::itemorrequest($cart->item_cancel);
							$c = App\Http\Helpers::cal_totalCanItems($cart->order_id);
                 
								
                            ?>
                              <tr>
                                  <td>{{$i}}</td>
                                  <td class="item-desc">
                                  @if($canvasimg!='')
                                    <img src="{{URL::asset('/storage/'.$canvasimg)}}" alt="">
                                   @endif
                                    <div class="item-short-desc">
                                      <strong>{{$oprodType}}</strong>
                                      <p>{{$ocollarName}}, <br>
                                      @if($cart->product_type==0)
                                     Fabric No : {{$fabno}}<br>
                                     @endif
                                     Size : {{$size}}</p>
                                    </div>
                                  </td>
                                  <!-- <td class="order-fabric-image">
                                    <img src="img/product/pt-thumb.png" alt=""> -->
                                  </td>
                                  <td>${{number_format($cart->price,2)}}</td>
                                  <td>${{number_format($cart->shipping,2)}}</td>
                                  <td>{{$cart->qty}}</td>
                                  <td>$<?php $toamt=($cart->price*$cart->qty)+$cart->shipping;
									echo number_format($toamt, 2);?></td>

                                  <td>
                                   
                                    <?php  $ordersta = App\Http\Helpers::allItemsCancel($cart->order_id);
                                            $orderpro =    App\Order::select('orderstatus')->where('id','=',$cart->order_id)->first();
                                                        $orderpro->orderstatus;
                                     ?>

                                   @if($orderpro->orderstatus > 5)
                                    <span class="pending pd-canceld" title="Order Item Not Cancel" >{{$requeststatus}}</span>
                                    @elseif($ordersta == 1 || $ordersta == 3)
                                    <span class="pending pd-canceld" data-toggle="modal" data-id="{{$cart->id}}" id="delete-{{$cart->id}}" data-target="#requestCancel{{$cart->id}}">{{$requeststatus}}</span>
                                     @else
                                       
                                     @endif
                                  </td>
                                  <td><a href="{{ url('/myaccount') }}/<?php echo $detailurl;?>/{{$cart->id}}" class="invoice-icon" title="Details"><i style="font-size:20px;color:#fff" class="fa fa-eye" aria-hidden="true"></i></a></td>
                              </tr>
									             <?php 
                                    $total=$toamt+$total;
                                    $shipamt=$shipamt+$cart->shipping;            
                                    ?>

                                    
                                    <div class="modal fade requestCancel" id="requestCancel{{$cart->id}}" role="dialog">
                                     <div class="modal-dialog">
                                      <?php 
										$adata = App\Cancelorder::cancelitem_message_request_a($cart->id);
										$udata = App\Cancelorder::cancelitem_message_request_u($cart->id);
                                      //print_r($udata);
                                    ?>
                                        <?php if($udata != '') {?>
                                        <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Request Reply </h4>
       </div>
       <div class="modal-body">

            <div class="form-group row">
              <div class="col-sm-12">
               <h4 class="">User</h4>
               </div>
             <label for="example-text-input" class="col-sm-12 col-form-label" >Reason: {{$udata['reason']}}</label>
             <div class="col-sm-12">
              <p>Message: {{$udata['decs_reason']}} </p>
             </div>
             </div>

           
              <h4 class="">Admin</h4>
             @foreach($adata as $adc)
             <div class="form-group row">

             <label for="example-text-input" class="col-sm-4 col-form-label" >Status :</label>
             <div class="col-sm-8">
              <p><?php echo isset($adc->reason) ? $adc->reason : ''; ?></p>
             </div>
             
               <label for="example-text-input" class="col-sm-4 col-form-label" > Message :</label>
             
             
             <div class="col-sm-8">
              <p><?php echo isset($adc->decs_reason) ? $adc->decs_reason : ''; ?></p>
             </div>
             </div>
            
            @endforeach
           
        
       </div>
     </div>

                                      
                                  <?php }else{ ?>
                                  <div class="modal-content">
                                       <div class="modal-header">
                                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                                         <h4 class="modal-title">Item Cancel Request </h4>
                                       </div>
                                       <div class="modal-body">
                                         <form class="" role="form" method="POST" action="{{ url('/myaccount/orderitemcancel/') }}">
                                           {{ csrf_field() }}
                                           <div class="form-group row">
                                             <label for="example-text-input" class="col-sm-3 col-form-label {{ $errors->has('reason') ? ' has-error' : '' }}">Reason:</label>
                                             <div class="col-sm-9">
                                               <input class="form-control" type="text" value="" name="reason" id="example-text-input" placeholder="Reason" required>
                                               <input class="form-control" type="hidden" value="{{$cart->id}}" name="id" id="" placeholder="Reason" required>
                                               @if ($errors->has('reason'))
                                               <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                              </span>
                                              @endif

                                            </div>
                                          </div>
                                          <div class="form-group row">
                                           <label for="example-search-input" class="col-sm-3 col-form-label {{ $errors->has('decs_reason') ? ' has-error' : '' }}">Comments :</label>
                                           <div class="col-sm-9">
                                             <textarea class="form-control" name="decs_reason" rows="5" required></textarea>
                                             @if ($errors->has('reason'))
                                             <span class="help-block">
                                              <strong>{{ $errors->first('decs_reason') }}</strong>
                                            </span>
                                            @endif
                                          </div>
                                        </div><p class="text-center"><a href="{{url('pages/return-and-refund-policy')}}" target="_blank">Read The Terms Carefully</a></p>
                                        <button type="submit" class="btn btn-default submit-request-btn">Send Request</button>
                                      </form>
                                    </div>
                                  </div>


                                 <?php }?>
                                     </div>
                                   </div>

                                @endforeach
                              
                              
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
        </div>
    </div>
</section>

  @include('../profile.profile-footer')
  
  <script type="text/javascript" src="{{asset('asset/js/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('asset/js/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#order-list-dt').DataTable();
} );

</script>

</body>
</html>