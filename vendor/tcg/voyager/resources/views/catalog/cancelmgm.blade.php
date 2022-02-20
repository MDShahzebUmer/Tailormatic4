@extends('voyager::master')

@section('css')

    <link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/database.css">

@stop

@section('page_header')

    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Order Management:

    </h1>

@stop

@section('content')





<div class="page-content container-fluid">

        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-bordered">

                  @if(Session::has('message')) <div class="alert alert-info"> {{Session::get('message')}} </div> @endif

                    

                    <div class="panel-body">

                        <table id="dataTable" class="table table-hover">



                            <thead>

                                <tr>

                                    <th>Order Id</th>

                                     <th>Total Items</th>

                                     <th>Shipping Amt.</th>

                                     <th>Coupan Amt.</th>

                                     <th>Purchase Date</th>

                                     <th>Request Status</th>



                                     

                                     <th>Invoice</th>

                                    <th class="actions" style="text-align:center">Details</th>

                                </tr>

                            </thead>

                             <tbody>

                             @foreach($data as $d) 

                            <tr>

                                <td class="order_ID">{{$d->id}}</td>

                                 <td>${{$d->od_amount}}</td>

                                 <td>${{$d->shipping_amt}}</td>

                                <td>${{$d->coupon_amt}}</td>

                                <td>{{ substr($d->created_at, 0, 10)}}</td>

                                <td style="text-align:center" class="no-sort no-click">

                                  @if($d->request_status == 1)  

                                 

                                  <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#requestCancel{{$d->id}}">

                                    <i class="voyager-check-circle"></i> Cancel

                                </div>

                                 @elseif($d->request_status == 2)

                                     <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#requestCancel{{$d->id}}">

                                    <i class="voyager-check-circle"></i> Approved

                                </div>

                                @elseif($d->request_status == 4)

                                <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#requestCancel{{$d->id}}">

                                    <i class="voyager-check-circle"></i> Refund

                                </div>

                                @elseif($d->request_status == 3)

                                  <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#requestCancel{{$d->id}}">

                                    <i class="voyager-check-circle"></i> Disapproved

                                </div>

                                @else

                                   <span></span>

                                @endif



                                </td>

                                 

                                         <td class="no-sort no-click">

                                            <a href="{{ route('voyager.orderinvoice')}}/{{$d->id}}" class="btn-sm btn-primary pull-right edit">

                                                <i class="voyager-file-text"></i> 

                                            </a>

                                        </td>

                                 <td><a href="{{ route('voyager.cancelrequest')}}/{{$d->id}}" class="btn-sm btn-info pull-right edit">View</a></td>

                                 

                            </tr>

                           

                            <div class="modal fade requestCancel" id="requestCancel{{$d->id}}" role="dialog">

                             <div class="modal-dialog">



                               <!-- Modal content-->

                               <div class="modal-content" style="padding-bottom: 20px;">

                                 <div class="modal-header">

                                   <button type="button" class="close" data-dismiss="modal">&times;</button>

                                   <h4 class="modal-title">Cancel Request</h4>

                               </div>

                                    

                               <div class="modal-body" style="border-bottom: 1px #ccc solid;">

                                      <?php $con = App\Cancelorder::cancel_user_request($d->id,'order_id'); //print_r($con);  ?>

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

                                        <?php  $rq = App\Order::get_user_request_status($d->id); ?>

                                   <div class="modal-body">

                                   <form class="" role="form" method="POST" action="{{ route('voyager.orderrecords.cancelrequest') }}">

                                      

                                       {{ csrf_field() }}

                                     <div class="form-group row">

                                       <label for="example-text-input" class="col-sm-3 col-form-label">Reason:</label>

                                       <div class="col-sm-9">

                                         <input type="hidden" value="{{$d->id}}" name="order_id">             

                                        <select name="request_status" class="form-control select" required>

                                           <option value="" @if(isset($rq) && $rq == "0") selected @endif>Select Process</option>

                                            <option value="2" @if(isset($rq) && $rq == "2") selected @endif>Approved</option>

                                            <!--<option value="3" @if(isset($rq) && $rq == "3") selected @endif>Disapproved</option>-->

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

        

       

    </script>

    <script >

    $('.change_status').change(function(){

      var did=$(this).attr("id");

      did=$.trim(did.replace('drop-',''));

      var cs = $(this).val();

            

       

    if(did){

        $.ajax({

           type:"GET",

           url:"{{ route('voyager.orderrecords.changestatus') }}/"+cs+'/'+did,

           success:function(res){               

            if(res){

               // $("#state").empty();

             alert("Order status successfully updated.");

           

            }else{

               alert("Order status not successfully updated.");

            }

           }

        });

    }else{

        //$("#state").empty();

        //$("#city").empty();

    }      

   });

  </script>

@stop



