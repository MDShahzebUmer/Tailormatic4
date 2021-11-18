@extends('voyager::master')
@section('css')
    <link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/database.css">
    <style type="text/css">
    .et-scrollbar {
    max-height: 60px;
    overflow-y: scroll;
    overflow-x: auto;
    }
    </style>
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
                       <div class="col-md-12" id="downloadexceldiv" align="center">
                          <label for="downloadexcel">Export to:</label>
                          <select id="downloadexcel">
                            <option value=""></option>
                            <option value="xsl">EXCEL</option>
                            <option value="csv">CSV</option>
                          </select>
                        </div>
                        <div id="daterange_div" align="right">
                          <label for="from">From</label>
                          <input type="text" id="from" name="from" readonly>
                          <label for="to">to</label>
                          <input type="text" id="to" name="to" readonly>
                          <button id="search_by_range">Go</button>
                        </div>
                        <table id="dataTable" class="table table-hover">

                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                     <th>Name</th>
                                     <th>Total Items</th>
                                     <th>Shipping Amt</th>
                                     <th>Coupan Amt</th>
                                     <th>Purchase Date</th>
                                     <th>Cancellation Request</th>
                                     <th>Order Status</th>
                                     <th>Print Invoice</th>
                                     <th class="actions" >Sms</th>
                                    <th class="actions" style="text-align:center">Details</th>
                                </tr>
                            </thead>
                             <tbody>
                             @foreach($data as $d) 
                            <tr>
                                <td class="order_ID">{{$d->id}}</td>
                                   <?php $user = App\User::userinfo($d->user_id); ?>
                                <td>{{$user->name}}</td>
                                 <td>${{$d->od_amount}}</td>
                                 <td>${{$d->shipping_amt}}</td>
                                <td>${{$d->coupon_amt}}</td>
                                <td>{{ substr($d->created_at, 0, 10)}}</td>
                                <td style="text-align:center" class="no-sort no-click">
                                  <?php $check = App\Http\Helpers::allItemsCancel($d->id); ?>
                                 
                                  @if($check == 1 || $check == 2)  
                                 @if($d->request_status == 1)
                                  <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#requestCancel{{$d->id}}">
                                    <i class="voyager-check-circle"></i> Pending Cancellation
                                </div>
                                 @elseif($d->request_status == 2)
                                     <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#requestCancel{{$d->id}}">
                                    <i class="voyager-check-circle"></i> Approved Cancellation
                                </div>
                                @elseif($d->request_status == 4)
                                <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#requestCancel{{$d->id}}">
                                    <i class="voyager-check-circle"></i> Refund
                                </div>
                                @elseif($d->request_status == 3)
                                  <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#requestCancel{{$d->id}}">
                                    <i class="voyager-check-circle"></i> Disapproved Cancellation
                                </div>
                                @else
                                 @if($d->orderstatus == 7)
                                     <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#requestCancel{{$d->id}}">
                                      <i class="voyager-check-circle"></i> Pending Cancellation
                                    </div>
                                     @else
                                     @endif
                                 @endif
                                  
                                   @else
                                     
                                    @endif

                                 </td>
                                 <td style="text-align:center">
                                  @if($d->orderstatus == 1)  
                                 
                                  <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#ProcessRequest{{$d->id}}">
                                    <i class="voyager-check-circle"></i> Order placed
                                </div>
                                 @elseif($d->orderstatus == 2)
                                     <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#ProcessRequest{{$d->id}}">
                                    <i class="voyager-check-circle"></i> Processing
                                </div>
                                @elseif($d->orderstatus == 3)
                                <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#ProcessRequest{{$d->id}}">
                                    <i class="voyager-check-circle"></i> Ready to ship
                                </div>
                                @elseif($d->orderstatus == 4)
                                  <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#ProcessRequest{{$d->id}}">
                                    <i class="voyager-check-circle"></i> On the way
                                </div>
                                @elseif($d->orderstatus == 5)
                                  <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#ProcessRequest{{$d->id}}">
                                    <i class="voyager-check-circle"></i> Completed
                                </div>
                                @elseif($d->orderstatus == 6)
                                  <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#ProcessRequest{{$d->id}}">
                                    <i class="voyager-check-circle"></i> Approved
                                </div>
                                 @elseif($d->orderstatus == 7)
                                  <div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#ProcessRequest{{$d->id}}">
                                    <i class="voyager-check-circle"></i> Disapproved
                                </div>
                                @else
                                   <span></span>
                                @endif
                                </td>
                                         <td class="no-sort no-click">
                                           <a href="{{ url('/storage/pdf')}}/{{$d->id}}-invoice.pdf" target="_blank" class="btn-sm btn-primary pull-right edit">
                                                <i class="voyager-receipt"></i> 
                                            </a>
                                            
                                            
                                        </td>
                                        <td><div class="btn-sm btn-danger pull-right" data-toggle="modal" data-id="{{$d->id}}" id="delete-{{$d->id}}" data-target="#SmsRequest{{$d->id}}">
                                   <i class="voyager-phone"></i>
                                </div> </td>
                                 <td><a href="{{ route('voyager.orderitems')}}/{{$d->id}}" class="btn-sm btn-info pull-right edit"><i class="voyager-eye"></i> </a></td>
                                 
                            </tr>
                           
                            <div class="modal fade requestCancel" id="requestCancel{{$d->id}}" role="dialog">
                             <div class="modal-dialog">
                               <!-- Modal content-->
                               <div class="modal-content" style="padding-bottom: 20px;">
                                 <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                                   <h4 class="modal-title">Cancel Request </h4>
                                  </div>
                                  <div class="modal-body" style="border-bottom: 1px #ccc solid;">
                                      <?php $con = App\Cancelorder::cancel_user_request($d->id,'order_id'); ?>
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
                                  <?php  $rq = App\Http\Helpers::get_user_request_status($d->id); ?>
                                   <div class="modal-body">
                                   <form class="" role="form" method="POST" action="{{ route('voyager.orderrecords.cancelrequest') }}">
                                      
                                       {{ csrf_field() }}
                                     <div class="form-group row">
                                       <label for="example-text-input" class="col-sm-3 col-form-label">Reason:</label>
                                       <div class="col-sm-9">
                                         <input type="hidden" value="{{$d->id}}" name="order_id">             
                                        <select name="request_status" class="form-control select" required>
                                           <option value="">Select Status</option>                                           
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
        
        <!-- Process Request -->
         <div class="modal fade ProcessRequest" id="ProcessRequest{{$d->id}}" role="dialog">
                             <div class="modal-dialog">
                               <!-- Modal content-->
                               <div class="modal-content" style="padding-bottom: 20px;">
                                 <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                                   <h4 class="modal-title">Order Process Request</h4>
                                  </div>
                                  <?php $os = App\Http\Helpers::get_user_order_status($d->id); ?>
                                   <div class="modal-body">
                                   <form class="" role="form" method="POST" action="{{ route('voyager.orderrecords.changestatus') }}">
                                      
                                       {{ csrf_field() }}
                                     <div class="form-group row">
                                       <label for="example-text-input" class="col-sm-3 col-form-label">Order Status:</label>
                                       <div class="col-sm-9">
                                         <input type="hidden" value="{{$d->id}}" name="order_id">             
                                        <select name="orderstatus" class="form-control select" required>
                                             <option value="">Select Status</option>
                                          
                                            <option value="6" @if(isset($os) && $os == "6")  selected  @endif>Approved</option>
                                            <option value="7" @if(isset($os) && $os == "7")  selected  @endif>Disapproved</option>
                                            <option value="2" @if(isset($os) && $os == "2")  selected  @endif>Processing</option>
                                            <option value="3" @if(isset($os) && $os == "3")  selected  @endif>Ready to ship</option>
                                            <option value="4" @if(isset($os) && $os == "4")  selected  @endif>On the way</option>
                                            <option value="5" @if(isset($os) && $os == "5")  selected  @endif>Completed</option>
                                        </select>
                                      </div>
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Customer Message:</label>
                                       <div class="col-sm-9">
                                          <textarea class="form-control" name="user_message" required></textarea>
                                      </div>
                                </div>
                                
                            <button type="submit" class="btn btn-info pull-left" name="save" value="save">Save</button> &nbsp;
                            <button type="submit" class="btn btn-success pull-left" name="notify" value="notify" style="margin-left:10px;">Notify</button>
                           
                        </form>
                        &nbsp; <button type="button" class="btn btn-cancel pull-left" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- End process Request -->
          <!-- Sms Request -->
         <div class="modal fade SmsRequest" id="SmsRequest{{$d->id}}" role="dialog">
                             <div class="modal-dialog">	
                               <!-- Modal content-->
                               <div class="modal-content" style="padding-bottom: 20px;">
                                 <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                                   <h4 class="modal-title">Send Order Sms</h4>
                                  </div>
                                 <?php $orsms = App\Http\Helpers::get_user_order_sms($d->id); ?>
                                   <?php if(count($orsms) > 0 ) { ?>
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-sm-12">
                                      <h6>Messages</h6>
                                    </div>
                                       <div class="col-sm-12 et-scrollbar">
                                        @foreach($orsms as $o)
                                        <div>
                                        <p>{{$o->sms_text}}</p>
                                        <code>Date:Time:-{{$o->created_at}}</code>
                                      </div>
                                        @endforeach
                                       </div>
                                    </div>
                                    <div>
                                   <?php } ?>
                                   <div class="modal-body">
                                   <form class="" role="form" method="POST" action="{{ route('voyager.orderrecords.ordersms') }}">
                                      
                                       {{ csrf_field() }}
                                     <div class="form-group row">
                                       
                                         <input type="hidden" value="{{$d->id}}" name="order_id">             
                                        
                                     
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Sms Message:</label>
                                       <div class="col-sm-9">
                                          <textarea class="form-control" name="sms_message" required></textarea>
                                      </div>
                                </div>
                                
                            <button type="submit" class="btn btn-info pull-left">Send Sms</button>
                           
                        </form>
                        &nbsp; <button type="button" class="btn btn-info pull-left" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- End SMS Request -->

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
    
      $('select#downloadexcel').on('change', function() {

        if($(this).val() !=''){

                  var url = "{{ route('voyager.orderrecords.getexcel') }}/"+$(this).val();
                  var $a = $("<a>");
                  $a.attr("href",url);
                  $("body").append($a);
                  $a.attr("download","");
                  $a[0].click();
                  $a.remove();

         
        }

      });

      $('#search_by_range').on('click',function(){
        var date1 = $("#from").val();
        var date2 = $("#to").val();
        var flag = 0; 

        $('#daterange_div input').each(function(){
          flag = 0;
          if($(this).val() != ''){
            $(this).css('border-color','initial');
            flag=1;
          }else{
            $(this).css('border-color','red');
            $(this).focus();
            return false;
          }
        });

        if(flag==1){
          $('#from').blur();
          $('#to').blur();
        }
        
      });
     

    $( function() {

      var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          dateFormat: "yy-mm-dd",
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        dateFormat: "yy-mm-dd",
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }
   
        return date;
      }

  });

    $.fn.dataTableExt.afnFiltering.push(
    function( oSettings, aData, iDataIndex ) {
        var iFini = document.getElementById('from').value;
        var iFfin = document.getElementById('to').value;
        var iStartDateCol = 5;
        var iEndDateCol = 5;
 
        iFini=iFini.substring(6,10) + iFini.substring(3,5)+ iFini.substring(0,2);
        iFfin=iFfin.substring(6,10) + iFfin.substring(3,5)+ iFfin.substring(0,2);
 
        var datofini=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
        var datoffin=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);
 
        if ( iFini === "" && iFfin === "" )
        {
            return true;
        }
        else if ( iFini <= datofini && iFfin === "")
        {
            return true;
        }
        else if ( iFfin >= datoffin && iFini === "")
        {
            return true;
        }
        else if (iFini <= datofini && iFfin >= datoffin)
        {
            return true;
        }
        return false;
    }
);
  
  $(document).ready(function() {
      var table = $('#dataTable').DataTable();
      // Add event listeners to the two range filtering inputs
      $('#from').on('blur', function() { table.draw(); } );
      $('#to').on('blur', function() { table.draw(); } );
  } );

    </script>
    @stop