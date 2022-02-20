@extends('voyager::master')
@section('css')
    <link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/database.css">
   <!-- invoice style start here -->
    <style type="text/css">
        .table-box{max-width: 790px; margin: 0 auto; border: 2px solid #212325;}
        .table-box table{margin-bottom: 0;}
        .invoice-header td{background: #141B23; width: 185px; color: #fff;}
        .table-box th{ font-style: italic;}
        .orderId td strong{float: left; padding-right:3px;}
        .invoice-header-title{background: #593A2E; font-size: 15px; letter-spacing: 1px; color: #fff;}
        .billing-info p, .margin0-p{margin-bottom: 0;padding: 0;}
        .footer td{background: #593A2E;}
        .footer ul{display: block; width: 395px; margin: 0 auto; list-style-type: none;}
        .footer ul li{float: left; text-align: center; border-right: 1px solid #fff; margin-right: 15px;}
        .footer ul li a{color: #fff; padding-right: 15px; text-decoration: none;}
        .footer ul li:last-child{border-right: 0; margin-right: 0;}
    </style>
    <!-- invoice style end here -->
@stop
@section('page_header')
    <h1 class="page-title hidden_div">
        <i class="voyager-data"></i>Invoice View:
    </h1>
@stop
@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
               
                <div class="panel-body">
               
                <!-- invoice start here -->
                <div class="table-box">
                    <table class="table">
                        <thead>
                          <tr class="invoice-header">
                            <td colspan="6" class="text-center"><img src="{{asset('storage/settings/February2017/UREh6pnL3T8C8a2UIfpz.png')}}"></td>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <th colspan="6" class="text-center invoice-header-title">Order Details</th>
                            </tr>
                            <tr class="orderId">
                              <td colspan="6"><strong >Order ID : </strong>  #{{$order->id}}</td>
                           </tr>
                           <tr class="orderId">
                              <td colspan="6"><strong >Tracking Number : </strong>  #{{$order->tracking_code}}</td>
                           </tr>
                           <tr class="orderId">
                              <td colspan="6"><strong>Order DateTime : </strong> {{$order->created_at}}</td>
                            </tr>
                            <tr class="invoice-header-title">
                              <th colspan="3" >Billing Information</th>
                              <th colspan="3" >Shipping Information</th>
                            </tr>
                            <tr class="billing-info">
                              <td colspan="3">
                                <p><strong>Name :</strong>{{$uinfo->name}}</p>
                                <p><strong>Email :</strong>{{$uinfo->email}}</p>
                                <p><strong>Contact No. :</strong> {{$uinfo->phone}}</p>
                                <p><strong>Address : </strong>
                               {{$uinfo->address}},<br>{{$uinfo->city}} <?php echo App\State::get_state_name($uinfo->state); ?>,<?php echo App\Country::get_country_name($uinfo->country_id); ?>
                                </p>
                              </td>
                              <td colspan="3">
                                <p><strong>Name :</strong>{{$shippinginfo->sname}}</p>
                                <p><strong>Email :</strong> {{$uinfo->email}}</p>
                                <p><strong>Contact No. :</strong> {{$shippinginfo->sphone}}</p>
                                <p><strong>Address : </strong>
                                {{$shippinginfo->saddress}}, <br>{{$shippinginfo->scity}},{{$statename}},{{$countryname}},
                                </p>
                              </td>
                            </tr>
                            <tr class="invoice-header-title">
                              <th colspan="6" class="text-center">Ordered Items</th>
                            </tr>
                            <tr class="text-center">
                                <td><strong>Item</strong></td>
                                <td><strong>Fabric</strong></td>
                                <td><strong>Unit Price(USD)</strong></td>
                                <td><strong>Shipping</strong></td>
                                <td><strong>Quantity</strong></td>
                                <td align="right"><strong>Total</strong></td>
                            </tr>
                            <?php 
                            $i=0;
                            $total=0;
                            $shipamt=0;
                            ?>
                             @foreach($orderitem as $itm)
                             @php 
                             $i++
                             @endphp

                             <?php
                             $groupname = App\OrderItem::groupinfo($itm->group_id,'fbgrp_name');
                             $oprodType = App\OrderItem::orderiteminfo($itm->id,'oprodType');
                             if($itm->cat_id==1){
                              $ocollarName = App\OrderItem::orderiteminfo($itm->id,'ocollarName');
                              $olapelName='';           
                            }elseif($itm->cat_id==2){
                              $ocollarName = App\OrderItem::orderiteminfo($itm->id,'ostyleName');
                              $olapelN=App\OrderItem::orderiteminfo($itm->id,'olapelName');
                              $olapelName=$olapelN;
                            }elseif($itm->cat_id==3){
                              $ocollarName = App\OrderItem::orderiteminfo($itm->id,'ostyleName');            
                              $olapelName='';           
                            }else{
							  $ocollarName = App\OrderItem::orderiteminfo($itm->id,'ostyleName');
							  $olapelN=App\OrderItem::orderiteminfo($itm->id,'opleatName');
							  $olapelName=$olapelN;

                            }
            //$canvasimg = App\Cart::cartdescnfo($cart->id,'ofrontView');
                            $size=App\OrderItem::orderiteminfo($itm->id,'osizeFit');
                            $fabno=App\OrderItem::allinfodes('etfabrics',$itm->fabric_id,'fabric_code');
                             ?>
                            <tr>
                                <td>
                                    <p class="margin0-p">{{$oprodType}}</p>
                                    <p class="margin0-p">{{$ocollarName}}</p>
                                    <p class="margin0-p">Fabric No : {{$fabno}}</p>
                                    <p class="margin0-p">Size : {{$size}}</p>
                                </td>
                                <td class="text-center">
                                    <img src="{{URL::asset('/storage/'.$itm->fabric_image)}}" width="50"  alt=""> <br><span>{{$groupname}}</span>
                                </td>
                                <td class="text-center">{{number_format($itm->price,2)}}$</td>
                                <td class="text-center">{{number_format($itm->shipping,2)}}$</td>
                                <td class="text-center">{{$itm->qty}}</td>
                                <td align="right"><?php $toamt=$itm->price*$itm->qty;
                                    echo number_format($toamt, 2);?>$</td>
                            </tr>
                            <?php 
                $total=$toamt+$total;
                $shipamt=$shipamt+$itm->shipping;            
            ?>
            @endforeach
            
            <?php
            $grtotal=$total+$shipamt;
            $orderid=$itm->order_id;
            $couponamt = App\Order::orderinfo($orderid);
            $camt = $couponamt->coupon_amt;
            ?>
                           
                            <tr>
                              <td colspan="6" class="text-center">
                              <p><strong>Terms & Conditions</strong></p>
                              <p>You will be contacted within 24 hrs by your assigned credit specialist prior to your account being charged. We will discuss terms and conditions at that time.</p>
                              </td>
                            </tr>
                            <tr class="footer">
                              <td colspan="6">
                                <ul>
                                  <li><a href="#">About Us</a></li>
                                  <li><a href="#">Contact Us</a></li>
                                  <li><a href="#">How it Works</a></li>
                                  <li><a href="#">FAQ'S</a></li>
                                </ul>
                              </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end invoice -->
                <button type="submit" class="btn-sm btn-public pull-left hidden_div" onclick="myOrderPrint()" >Print</button>
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
    <script>
    function myOrderPrint() {
    $(".hidden_div").hide();
      window.print();
    }
    </script>
@stop

