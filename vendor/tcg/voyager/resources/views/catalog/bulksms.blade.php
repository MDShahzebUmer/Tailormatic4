@extends('voyager::master')

@section('css')

<link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/database.css">

@stop

@section('page_header')
<h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Bulk Promotion Sms:

</h1>



<div class="btn btn-success" data-toggle="modal" data-id="" id="delete-" data-target="#requestCancel" style="margin-left: 38px;">

 Send Sms Bulk Message

</div>



@stop

@section('content')





<div class="page-content container-fluid">

  <div class="row">

    <div class="col-md-12">

      <div class="panel panel-bordered">

        <div class="panel-body">

          <table id="dataTable" class="table table-hover">



            <thead>

              <tr>

                <th>Sr.no</th>

                <th>User Name</th>

                <th>Phone</th>

                <th>City Name</th>

                <th>Message.</th>

                <th>Date:Time.</th>

                <th>Remove.</th>

                



              </tr>

            </thead>

            <tbody>

          <?php  $sms = App\Http\Helpers::get_bulk_sms(); $i=1; ?> 

          

          @foreach($sms as $s)

              <tr>



                <td>{{$i++}}</td>

                <td>{{$s->name}}</td>

                <td>{{$s->phone}}</td>

                <td>{{$s->city}}</td>

                <td>{{$s->sms_text}}</td>

                <td>{{$s->created_at}}</td>

                <td><div class="btn-sm btn-danger pull-right delete" data-id="{{$s->smsid}}" id="delete-{{$s->smsid}}">

                                            <i class="voyager-trash"></i> Delete

                                        </div></td>

                



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

                         <form action="{{ route('voyager.smspromotion.delete',$s->smsid) }}" id="delete_form" method="POST">

                          {{ method_field("DELETE") }}

                          {{ csrf_field() }}

                          <input type="submit" class="btn btn-danger pull-right delete-confirm"

                          value="Yes, Delete This ">

                        </form>

                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>

                      </div>

                    </div><!-- /.modal-content -->

                  </div><!-- /.modal-dialog -->

                </div>

               @endforeach

              <div class="modal fade requestCancel" id="requestCancel" role="dialog">

               <div class="modal-dialog">

                 <!-- Modal content-->

                 <div class="modal-content" style="padding-bottom: 20px;">

                   <div class="modal-header">

                     <button type="button" class="close" data-dismiss="modal">&times;</button>

                     <h4 class="modal-title">Bulk Sms Send</h4>

                   </div>



                   <div class="modal-body">

                     <form class="" role="form" method="POST" action="{{ route('voyager.smspromotion') }}">



                       {{ csrf_field() }}

                       <div class="form-group row">

                         <label for="example-text-input" class="col-sm-3 col-form-label">Country:</label>

                         <div class="col-sm-9">

                             @php $country = App\Country::get_country(); @endphp   

                             <select name="country" id="country" class="form-control" required>

                              <option value="">Select Country</option> 

                              @foreach($country as $c)

                              <option value="{{$c->id}}" >{{$c->name}}</option>

                              @endforeach

                            </select>

                        </div>

                        <label for="example-text-input" class="col-sm-3 col-form-label">State Name:</label>

                         <div class="col-sm-9">

                               

                           <select name="state" id="state" class="form-control" required>

                           </select>

                        </div>

                        <label for="example-text-input" class="col-sm-3 col-form-label">City Name:</label>

                         <div class="col-sm-9">

                            <input type="text" class="form-control" name="city_name" >  

                        </div>

                        <label for="example-text-input" class="col-sm-3 col-form-label">Promotion Message:</label>

                        <div class="col-sm-9">

                          <textarea class="form-control" name="sms_message" required></textarea>

                        </div>

                      </div>



                      <button type="submit" class="btn btn-info pull-left">Submit</button>



                    </form>

                    &nbsp; <button type="button" class="btn btn-info pull-left" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>

                  </div>

                </div>



              </div>

            </div>

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



 <script >

    $('#country').change(function(){

    var country = $(this).val();    

    if(country){

        $.ajax({

           type:"GET",

           url:"{{ route('voyager.campaign.getstate') }}/"+country,

           success:function(res){               

            if(res){

                $("#state").empty();

                $("#state").append('<option value="">Select</option>');

                $.each(res,function(key,value){

                  //alert(res[key]['id'])

                    $("#state").append('<option value="'+res[key]['id']+'">'+res[key]['name']+'</option>');

                });

           

            }else{

               $("#state").empty();

            }

           }

        });

    }else{

        $("#state").empty();

        $("#city").empty();

    }      

   });

  </script>



@stop



