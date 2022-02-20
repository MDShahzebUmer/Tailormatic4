@extends('voyager::master')
@section('css')
    <link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/database.css">
@stop
<style type="text/css">
   .st-dt-order-list-wrap .item-short-desc{float: left; padding-left: 12px; font-size: 12px}
   .st-dt-order-list-wrap .st-item-desc img{float: left;}
   .row > [class*="col-"] {
    margin-bottom: 11px !important;}
	/*.btnr-sm {
    border-radius: 2px;
    font-size: 12px;
    line-height: 1.5;
    margin: 5px !important;
}*/
   </style><!-- end style for order list-->

@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;float:left;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Order Management:
    </h1>

   
@stop
@section('content')
<div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">                 
<div style=" margin-bottom:5px; margin-right:20px; padding-top:10px"><a  href="{{url('storage/jobcard/')}}/OD{{$id}}.zip" class="btn-sm btn-info pull-right edit">Job Card Download</a></div>
                    <div class="panel-body">
                     
                        <table id="dataTable" class="table table-hover st-dt-order-list-wrap">
                        
                            <thead>
                           
                                <tr>
                                   <th>Sr.No</th>
                                  <th>ItemID.</th>
                                  <th>Item Description</th>
                                  <th>Price</th>
                                  <th>Shipping</th>
                                  <th>QTY</th>
                                   <th>Total</th>
                                  <th>Cancel Request</th>
                                  <th class="actions" style="text-align:center">JobCard</th>
                                    <th class="actions" style="text-align:center">Details</th>
                                   
                                </tr>
                            </thead>
                             <tbody>                            

                             <?php 

                                $i=0;
                                $total=0;
                                $shipamt=0;                               

                                //print_r($orderdata);

                            ?>

                            @foreach($data as $cart)
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
                                $detailurl='shirtdetail';  
                                }elseif($cart->cat_id==2){
                                $ocollarName = App\OrderItem::orderiteminfo($cart->id,'ostyleName');
                                $olapelN=App\OrderItem::orderiteminfo($cart->id,'olapelName');
                                $olapelName=$olapelN;
                                $detailurl='jacketdetail';
                                }elseif($cart->cat_id==3){
                                $ocollarName = App\OrderItem::orderiteminfo($cart->id,'ostyleName');
                                $olapelName='';
                                $detailurl='vestsdetail';
                                 }elseif($cart->cat_id==4){
                                $ocollarName = App\OrderItem::orderiteminfo($cart->id,'ostyleName');
							  	$olapelN=App\OrderItem::orderiteminfo($cart->id,'opleatName');
							  	$olapelName=$olapelN;
                                $detailurl='pantsdetail'; 
                                }

                                //$canvasimg = App\Cart::cartdescnfo($cart->id,'ofrontView');

                                $size=App\OrderItem::orderiteminfo($cart->id,'osizeFit');
                                $fabno=App\OrderItem::orderiteminfo('etfabrics',$cart->fabric_id,'fabric_code');
                               
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

                            ?>



                            <tr>
                                 <td >{{$i}}</td>
                                 <td >#{{$cart->id}}</td>
                                  <td class="st-item-desc"><img src="{{URL::asset('/storage/'.$canvasimg)}}" alt="" width="60px;"><div class="item-short-desc">

                                      <strong>{{$oprodType}}</strong>
                                      <p>{{$ocollarName}}, <br>
                                       @if($cart->product_type==0)
                                     	Fabric No :  {{$fabno}}<br>
                                        @endif
                                     Size : {{$size}}</p>
                                    </div></td>

                                  <td>${{number_format($cart->price,2)}}</td>
                                  <td>${{number_format($cart->shipping,2)}}</td>
                                  <td>{{$cart->qty}}</td>

                                  <td>$<?php $toamt=($cart->price*$cart->qty)+$cart->shipping;
                                    echo number_format($toamt, 2);?></td>
                                     <td>
                                  <?php $check = App\Http\Helpers::allItemsCancel($cart->order_id); ?>
                                    @if($check == 1 || $check == 3)       
                                  @if($cart->item_cancel == 1)  
                                 
                                  <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$cart->id}}" id="delete-{{$cart->id}}" data-target="#requestCancel{{$cart->id}}">
                                    <i class="voyager-check-circle"></i> Cancel
                                </div>
                                @elseif($cart->item_cancel == 2)
                                     <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$cart->id}}" id="delete-{{$cart->id}}" data-target="#requestCancel{{$cart->id}}">
                                    <i class="voyager-check-circle"></i> Approved
                                </div>
                                @elseif($cart->item_cancel == 4)
                                <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$cart->id}}" id="delete-{{$cart->id}}" data-target="#requestCancel{{$cart->id}}">
                                    <i class="voyager-check-circle"></i> Refund
                                </div>
                                @elseif($cart->item_cancel == 3)
                                  <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$cart->id}}" id="delete-{{$cart->id}}" data-target="#requestCancel{{$cart->id}}">
                                    <i class="voyager-check-circle"></i> Disapproved
                                </div>
                                 
                                @else
                                   <span></span>
                                @endif
                                @else
                                 <span></span>
                                @endif

                                     </td>
                                    <td>
                                      <?php if($pp==1){?>
                                    <a href="{{ route('voyager.shirtjobcart') }}/{{$cart->id}}" class="btn-sm btn-info pull-right edit" target="_blank"><i class="voyager-receipt"></i>&nbsp; Download</a>
                                    <?php }else{?>
                                     <a href="{{url('storage/jobcard')}}/{{$id}}/{{$cart->id}}-jobcard.pdf" class="btn-sm btn-info pull-right edit" target="_blank"><i class="voyager-receipt"></i>&nbsp; Download</a>
                                     <?php }?>
                                    </td>
                                <td><a href="{{ route('voyager.'.$detailurl.'') }}/{{$cart->id}}" class="btn-sm btn-info pull-right edit">View</a></td>

                                <?php 
                                    $total=$toamt+$total;
                                    $shipamt=$shipamt+$cart->shipping; 
                                  ?>

                            </tr>

                            <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span

                                                aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to delete

                                                    this </h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="" id="delete_form" method="POST">
                                                        {{ method_field("DELETE") }}
                                                        {{ csrf_field() }}
                                                        <input type="submit" class="btn btn-danger pull-right delete-confirm"

                                                        value="Yes, Delete This ">
                                                    </form>
                                                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                     <div class="modal fade requestCancel" id="requestCancel{{$cart->id}}" role="dialog">
                             <div class="modal-dialog">
                               <!-- Modal content-->
                               <div class="modal-content" style="padding-bottom: 20px;">
                                 <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                                   <h4 class="modal-title">Cancel Request</h4>
                                  </div>
                                  <div class="modal-body" style="border-bottom: 1px #ccc solid;">
                                     <?php $con = App\Cancelorder::cancel_user_request($cart->id,'order_itemId'); ?>
                                      <div class="row">
                                        <label  class="col-sm-3 col-form-label">Reason:</label>
                                         <div class="col-sm-9">
                                            <p><?php echo isset($con->decs_reason) ? $con->reason : '';  ?></p>
                                         </div>
                                      </div>
                                      <div class="row">
                                       <label  class="col-sm-3 col-form-label">Description:</label>
                                       <div class="col-sm-9">
                                       <p><?php echo isset($con->decs_reason) ? $con->decs_reason : '';  ?></p>
                                       </div>
                                       </div>
                                  </div>
                                 <?php  $rq = App\Http\Helpers::get_user_request_temsstatus($cart->id); ?>
                                   <div class="modal-body">
                                   <form class="" role="form" method="POST" action="{{ route('voyager.orderrecords.cancelitemrequest') }}">
                                      
                                       {{ csrf_field() }}
                                     <div class="form-group row">
                                       <label for="example-text-input" class="col-sm-3 col-form-label">Reason:</label>
                                       <div class="col-sm-9">
                                         <input type="hidden" value="{{$cart->id}}" name="id">             
                                        <select name="item_cancel" class="form-control select" required>
                                          <option value="" @if(isset($rq) && $rq == "0") selected @endif>Select Process</option>
                                            <option value="2" @if(isset($rq) && $rq == "2") selected @endif>Approved</option>
                                            <option value="3" @if(isset($rq) && $rq == "3") selected @endif>Disapproved</option>
                                            <option value="4" @if(isset($rq) && $rq == "4") selected @endif>Refund</option>
                                        </select>
                                      </div>
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Reason Descriptio:</label>
                                       <div class="col-sm-9">
                                          <textarea class="form-control" name="decs_reason" required></textarea>
                                      </div>
                                </div>
                                
                            <button type="submit" class="btn btn-info pull-left">Submit</button>
                           
                        </form>
                        &nbsp; <button type="button" class="btn btn-info pull-left" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>
                    </div>
                </div>

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
@stop

@section('javascript')

    <!-- DataTables -->

    <script>
            $(document).ready(function () {
                $('#dataTable').DataTable({ "order": [] });
            });

        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];
            form.action = parseActionUrl(form.action, $(this).data('id'));
            $('#delete_modal').modal('show');
        });



        function parseActionUrl(action, id) {
            return action.match(/\/[0-9]+$/)
                    ? action.replace(/([0-9]+$)/, id)
                    : action + '/' + id;

        }

    </script>

@stop