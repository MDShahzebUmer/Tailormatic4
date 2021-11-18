<?php  $seo = App\Http\Helpers::page_seo_details(26);?>
@include('../layouts.inc.page_header')
@include('../layouts.inc.page_menu')
<link rel="stylesheet" type="text/css" href="{{asset('asset/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/css/et-responsive.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/css/jquery-ui.css')}}">
@include('../layouts.inc.section_div')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="et-sub-title et-fw">
          <h2>Order List</h2> 
        </div>
      </div>
      <div class="et-block">
        <div class="col-sm-3 st-pro-leftbar">
          <div class="et-account-left-box">
            <ul>
            {{-- <ul class="user-frofile-list"> --}}
             @include('../layouts.inc.profile-menu')
           </ul>
         </div> 
       </div>
       <div class="col-md-9 dt-responsive st-pro-content-wrap">
        @include('../layouts.inc.profile-menu-responsive')
        <div class="contact-box full-witdh order-list-data-table">
          <div class="st-fromDate-toDate-wrap">
            <div class="st-fromDate-box-center" id="daterange_div">
             <div class="col-sm-6">
              <div class="input-group">
                <span class="input-group-btn group-btn-calendar">
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                </span>
                <input type="text" class="form-control st-from-date-input" id="from" name="from" placeholder="From Date">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="input-group">
                <span class="input-group-btn group-btn-calendar">
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                </span>
                <input type="text" class="form-control" id="to" name="to" placeholder="To Date">
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button" id="search_by_range"><i class="fa fa-search-plus" aria-hidden="true"></i></button>
                </span>
              </div>
            </div>
          </div>

        </div>
        <table id="order-list-dt" class="table table-striped table-bordered " cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>My Orders</th>
              <th style="display:none">Date</th>
              <th id="odid" style="display:none">Order Id</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orderdata as $ordata)

            <?php             
            $shippinginfo = App\Http\Helpers::shippinginfo($ordata->ship_id);
            $requeststatus = App\Http\Helpers::orderrequest($ordata->request_status);

            ?>  
            <?php  $dts = App\Http\Helpers::get_Oreder_ItemDetails($ordata->id);
                   $odcun = App\Http\Helpers::cal_totalItems($ordata->id); 
            ?>      
            <tr>
              <td class="item-desc-list item-desc-list-pt">
               <ul class="st-dec-wrap-box-pro">
                <li class="st-product-img"><img src="{{url('storage')}}/{{$dts['img']}}"></li>
                <li class="st-product-detail-list">
                  <div class="st-product-desc-text">
                    <p class="st-product-name">{{$dts['name']}}</p>
                    @if($dts['fnum'] != '')
                    <?php if($dts['ptype']==0){ $fcode='Fabric No';}else{$fcode='Model No';} ?>
                    <p><span class="st-highlights-color ">{{$fcode}}: </span>  {{$dts['fnum']}}</p>
                    @endif
                    @if($dts['size']!='')
                    <p><span class="st-highlights-color">Size: </span> {{$dts['size']}}</p>
                    @endif
                    <p><span class="st-highlights-color">Item Count:</span> {{$odcun}}</p>
                  </div>
                </li>

                <li class="st-date-ant-list">

                  <?php echo date_format($ordata->created_at,"d-M-Y"); ?>
             <div class="st-right-bottom"><p class="st-pl-total">Total: ${{number_format($ordata->od_amount,2)}}</p></div>

                </li>
                <li class="st-btn-group-list">
                 <?php  $ordersta = App\Http\Helpers::allItemsCancel($ordata->id); ?>
                 @if($ordata->orderstatus > 1 && $ordata->orderstatus < 6)
                <div href="" class="btn btn-block st-product-list-btn" title="Order Not Cancel" style="cursor:none">{{$requeststatus}}</div>
                 @elseif($ordersta == 1 || $ordersta == 2)
                 <a href="" class="btn btn-block st-product-list-btn" data-toggle="modal" data-id="{{$ordata->id}}"  data-target="#requestCancel{{$ordata->id}}">{{$requeststatus}}</a>
                 @else
                 <a href="{{ url('/myaccount/orderdetails') }}/{{$ordata->id}}" class="btn btn-block st-product-list-btn">Items Cancel</a>
                 @endif
                
                

                 <a target="_blank" href="{{ url('/myaccount/invoice') }}/{{$ordata->id}}" class="btn btn-block st-product-list-btn">Invoice</a>
                 <a target="_blank" href="{{ url('/storage/pdf') }}/{{$ordata->id}}-invoice.pdf" class="btn btn-block st-product-list-btn">Print</a>
                  <?php ?>
                  <a href="{{url('/myaccount/orderdetails')}}/{{$ordata->id}}" class="btn btn-block st-product-list-btn"> Items List({{$odcun}})</a>
                </li>  
              </ul>
              <div class="st-date-total">
                <p class="st-date-del"><strong>Order Id:</strong>#{{$ordata->id}}.<!--<strong>Tracking code:#{{ strtoupper(trans($ordata->tracking_code)) }}</strong>--></p>
                <?php  $psta = App\Http\Helpers::order_status_Check($ordata->orderstatus);?>

                <p class="delev-status"><b>Status</b>: {{$psta}}</p>



              </div> 
            </td>
            <td style="display:none"><?php echo date_format($ordata->created_at,"d-M-Y"); ?></td>
             <td style="display:none">{{$ordata->id}}</td>
          </tr>
          <div class="modal fade requestCancel" id="requestCancel{{$ordata->id}}" role="dialog">
           <div class="modal-dialog">

             <!-- Modal content-->
             <?php $adata = App\Cancelorder::cancel_message_request_a($ordata->id);
             $udata = App\Cancelorder::cancel_message_request_u($ordata->id); 

             ?>
             <?php if($udata != '') 
             {?>
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
                <label for="example-text-input" class="col-sm-12 col-form-label" >Reason:{{$udata['reason']}} :</label>
                 <div class="col-sm-12">
                  <p>Message: {{$udata['decs_reason']}} </p>
                </div>
              </div>

              <h4 class="">Admin</h4>
              @foreach($adata as $adc)
              <div class="form-group row">

               <label for="example-text-input" class="col-sm-4 col-form-label" >Status :</label>
               <div class="col-sm-8">
                <p><?php echo isset($adc->reason) ? $adc->reason : ''; ?> </p>
              </div>

              <label for="example-text-input" class="col-sm-4 col-form-label" > Message :</label>


              <div class="col-sm-8">
                <p><?php echo isset($adc->decs_reason) ? $adc->decs_reason : ''; ?></p>
              </div>
            </div>
            
            @endforeach
          </div>
        </div>


        <?php } else  { ?>


        <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Cancel Order </h4>
         </div>
         <div class="modal-body">
           <form class="" role="form" method="POST" action="{{ url('/myaccount/ordercancel/') }}">
             {{ csrf_field() }}
             <div class="form-group row">
               <label for="example-text-input" class="col-sm-3 col-form-label {{ $errors->has('reason') ? ' has-error' : '' }}">Reason:</label>
               <div class="col-sm-9">
                 <input class="form-control" type="text" value="" name="reason" id="example-text-input" placeholder="Reason" required>
                 <input class="form-control" type="hidden" value="{{$ordata->id}}" name="id" id="" placeholder="Reason" required>
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
    <?php
  }  ?>
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
<script type="text/javascript" src="{{asset('asset/js/jquery-ui.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#order-list-dt').DataTable();
  $('#odid').click();
  $('#odid').click();
} );

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

  from = $( "#from" )
  .datepicker({
    dateFormat: "dd-M-yy",
          //defaultDate: "+1w",
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1
        })
  .on( "change", function() {
    to.datepicker( "option", "minDate", getDate( this ) );
  }),
  to = $( "#to" ).datepicker({ 
    dateFormat: "dd-M-yy",
      //  defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
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
    var iStartDateCol = 1;
    var iEndDateCol = 1;

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
	$('#order-list-dt td:nth-child(2)').hide();
   $('#order-list-dt th:nth-child(2)').hide();
	
	
    return false;
  }
  );

$(document).ready(function() {
  $('#order-list-dt td:nth-child(2)').hide();
  $('#order-list-dt th:nth-child(2)').hide();
  var table = $('#order-list-dt').DataTable();
      // Add event listeners to the two range filtering inputs
      $('#from').on('blur', function() { table.draw(); } );
      $('#to').on('blur', function() { table.draw(); } );
    } );

</script>
</body>
</html>