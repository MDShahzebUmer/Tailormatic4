@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Add/Edit PromoCode</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 1)
                    <div class="panel-heading">
                            <h3 class="panel-title">Add PromoCode</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                <div class="form-group">
                                    <label for="promo_code">PromCode.</label>
                                    <input type="text" class="form-control" name="promo_code"
                                           placeholder="PromCode" id="promo_code"
                                           value="" required>
                                 </div>
                                 <div class="form-group">
                                  <label for="inside_view">Benefit Type</label>
                                  <select name="benefit_type" id="benefit_type" class="form-control select" required>
                                    <option value="">Select Benefit Type</option>
                                    <option value="P">%</option>
                                    <option value="A">$</option>
                                  </select>
                                </div>
                                 <div class="form-group">
                                    <label for="benefit_amt">Benefit Amount.</label>
                                    <input type="text" class="form-control" name="benefit_amt"
                                           placeholder="Benefit Amount" id="benefit_amt"
                                           value="" required onkeypress='return event.charCode >= 46 && event.charCode <= 57'>
                                 </div>
                                 <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="benefit_amt">Start Date Time.</label>
                                    <div class='input-group date' id='datetimepicker1'>
                                      <input type='text' class="form-control" name="start_date" />
                                      <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                  </div>     
                                </div>
                                </div>
                                <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="benefit_amt">End Date Time.</label>
                                    <div class='input-group date' id='datetimepicker2'>
                                      <input type='text' class="form-control" name="end_date" />
                                      <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                  </div>     
                                </div>
                                </div>
                                  
                                 <div class="form-group">
                                  <label for="validity_condition">Validity Condition</label>
                                  <select name="validity_condition" id="validity_condition" class="form-control select" required>
                                    <option value="">Select Validity Condition</option>
                                    <option value="1">X no. of time before Y date</option>
                                    <option value="2">If X count of Y Item in an order</option>
                                    <option value="3">If Order value is greater than X amount</option>
                                    <option value="4">Only if Buying Item 1st time</option>
                                    <option value="5">Valid for specific city,state,country,region</option>
                                    <option value="6">Valid for specific day</option>
                                    <!-- <option value="6">$</option> -->
                                  </select>
                                </div>
                                
                                <div class="form-group" id="cat_div">
                                  @php $cat = App\Category::getall_catname() @endphp
                                    <label for="inside_view">Select Category</label>
                                   <select name="cat_id" id="cat_id" class="form-control select">
                                   <option value="">Select Category</option>
                                        @if(!$cat->isEmpty())
                                         @foreach($cat as $c)
                                         <option value="{{$c->id}}">{{$c->name}}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                </div>

                                 <div class="form-group" id="hide_count">
                                    <label for="code_count">Count.</label>
                                    <input type="text" class="form-control" name="code_count"
                                           placeholder="Count" id="code_count"
                                           value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                 </div>
                                  <div class="form-group" id="hide_amount">
                                    <label for="max_amount">Max Amount.</label>
                                    <input type="text" class="form-control" name="max_amount"
                                           placeholder="Max Amount Code" id="max_amount"
                                           value="">
                                  </div>
                                  <div id="hide_city">
                                  <div class="col-md-6">
                                  <div class="form-group">
                                    @php $country = App\Country::get_country(); @endphp
                                    <label for="country">Country.</label>
                                    <select name="country" id="country" class="form-control">
                                      <option value="">Select Country</option> 
                                      @foreach($country as $c)
                                    <option value="{{$c->id}}" >{{$c->name}}</option>
                                    @endforeach
                                    </select>
                                  </div>
                                  </div>
                                   <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="country">State.</label>
                                      <select name="state" id="state" class="form-control">

                                      </select>
                                    </div>
                                   </div>
                                   <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="city">City.</label>
                                    <input type="text" class="form-control" name="city"
                                           placeholder="City" id="city"
                                           value="">
                                   </div>
                                  </div>

                                   <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="region">Region.</label>
                                      <input type="text" class="form-control" name="region"
                                           placeholder="Region" id="region" value="">
                                     
                                    </div>
                                   </div>
                                    </div>
                                    <div class="form-group spe_day">
                                      <label for="benefit_amt">Specific Day.</label>
                                      <div class='input-group date' id='datetimepicker3'>
                                        <input type='text' class="form-control" name="specific_day" />
                                        <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                      </span>
                                    </div>     
                                  </div>
                                   <div class="form-group">
                                    <textarea class="form-control" name="promo_description"></textarea>
                                   
                                   </div>
                                   <label for="benefit_amt">Coupan term and condition.</label>
                                   <div class="form-group">
                                      
                                    <textarea class="form-control richTextBox" name="coupan_term"></textarea>
                                   
                                   </div>

                            </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                         @php  $vai = App\CamaignPromoCode::get_Validity(); @endphp
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Campaign {{$vai[$data->validity_condition]}}</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="promo_code">PromCode.</label>
                                    <input type="text" class="form-control" name="promo_code"
                                           placeholder="PromCode" id="promo_code"
                                           value="{{$data->promo_code}}" required>
                                 </div>
                                 <div class="form-group">
                                  <label for="inside_view">Benefit Type</label>
                                  <select name="benefit_type" id="benefit_type" class="form-control select" required>
                                    <option value="">Select Benefit Type</option>
                                    <option value="P" @if(isset($data) && $data->benefit_type == "P") selected @endif >%</option>
                                    <option value="A" @if(isset($data) && $data->benefit_type == "A") selected @endif>$</option>
                                  </select>
                                </div>
                                 <div class="form-group">
                                    <label for="benefit_amt">Benefit Amount.</label>
                                    <input type="text" class="form-control" name="benefit_amt"
                                           placeholder="Benefit Amount" id="benefit_amt"
                                           value="{{$data->benefit_amt}}" required>
                                 </div>
                                 <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="benefit_amt">Start Date Time.</label>
                                    <div class='input-group date' id='datetimepicker1'>
                                      <input type='text' class="form-control" name="start_date" value="{{$data->start_date}}" />
                                      <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                  </div>     
                                </div>
                                </div>
                                <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="benefit_amt">End Date Time.</label>
                                    <div class='input-group date' id='datetimepicker2'>
                                      <input type='text' class="form-control" name="end_date" value="{{$data->end_date}}" />
                                      <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                  </div>     
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="benefit_amt">Validity Condition</label>
                                    <div class='input-group date' id='datetimepicker1'>
                                      <input type='text' class="form-control" name="start_date" value="{{$data->start_date}}" />
                                      <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                  </div>     
                                </div>  
                                 
                                <?php if($data->validity_condition == 1) { ?>
                               
                                <div class="form-group" id="">
                                    <label for="code_count">Count.</label>
                                    <input type="text" class="form-control" name="code_count"
                                           placeholder="Count" id="count"
                                           value="{{$data->code_count}}">
                                 </div>
                                <?php } else if($data->validity_condition == 2) { ?>
                               

                                <div class="form-group" id="">
                                  @php $cat = App\Category::getall_catname() @endphp
                                    <label for="inside_view">Select Category</label>
                                   <select name="cat_id" id="cat_id" class="form-control select">
                                   <option value="">Select Category</option>
                                        @if(!$cat->isEmpty())
                                         @foreach($cat as $c)
                                         <option value="{{$c->id}}" @if(isset($cat) && $data->cat_id == $c->id) selected @endif >{{$c->name}}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                </div>
                                <div class="form-group" >
                                    <label for="code_count">Count.</label>
                                    <input type="text" class="form-control" name="code_count"
                                           placeholder="Count" id="count"
                                           value="{{$data->code_count}}" >
                                 </div>
                                 <?php } else if($data->validity_condition == 3) {  ?>
                               

                                <div class="form-group" >
                                    <label for="max_amount">Max Amount.</label>
                                    <input type="text" class="form-control" name="max_amount"
                                           placeholder="Max Amount Code" id="max_amount"
                                           value="{{$data->max_amount}}">
                                  </div>
                                  <?php } else if($data->validity_condition == 5 ) { ?>
                               
                                  <div>
                                  <div class="col-md-6">
                                  <div class="form-group">
                                    @php $country = App\Country::get_country(); @endphp
                                    <label for="country">Country.</label>
                                    <select name="country" id="country" class="form-control">
                                      <option value="">Select Country</option> 
                                      @foreach($country as $c)
                                    <option value="{{$c->id}}" @if(isset($country) && $data->country == $c->id) selected @endif >{{$c->name}}</option>
                                    @endforeach
                                    </select>
                                  </div>
                                  </div>
                                   <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="state">State.</label>
                                      <select name="state" id="state" class="form-control">
                                         <option value="{{$data->state}}"> <?php echo App\State::get_state_name($data->state)?></option>
                                      </select>
                                    </div>
                                   </div>
                                   <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="city">City.</label>
                                    <input type="text" class="form-control" name="city"
                                           placeholder="City" id="city"
                                           value="">
                                   </div>
                                  </div>

                                   <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="region">Region.</label>
                                      <input type="text" class="form-control" name="region"
                                           placeholder="Region" id="region" value="">
                                     
                                    </div>
                                   </div>
                                    </div>
                                  <?php } else if($data->validity_condition == 6) { ?>
                                    <div class="form-group">
                                      <label for="benefit_amt">Specific Day.</label>
                                      <div class='input-group date' id='datetimepicker3'>
                                        <input type='text' class="form-control" name="specific_day" value="{{$data->specific_day}}" />
                                        <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                      </span>
                                    </div>     
                                  </div>
                                 <?php } else {

                                 }?>
                                  <div class="form-group">
                                    <textarea class="form-control" name="promo_description">{{$data->promo_description}}</textarea>
                                    <input type="hidden" name="id" value="{{$data->id}}"> 
                                   </div>
                                   <label for="benefit_amt">Coupan term and condition.</label>
                                     <div class="form-group">
                                      <textarea class="form-control richTextBox" name="coupan_term">{{$data->coupan_term}}</textarea>
                                    </div>
                                 @endif
                            </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                         
                       

                        <iframe id="form_target" name="form_target" style="display:none"></iframe>
                     </div>
                     <!-- form start -->
                       <iframe id="form_target" name="form_target" style="display:none"></iframe>
                     </div>
                
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
    <script>
            $(function () {
                $('#datetimepicker2').datetimepicker({
              format: 'YYYY-MM-DD',
                });
               
            });
            $(function () {
                $('#datetimepicker1').datetimepicker({
                  format: 'YYYY-MM-DD',

                });
                
            });
            $(function () {
                $('#datetimepicker3').datetimepicker({
                  format: 'YYYY-MM-DD',

                });
                
            });
           
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
<script>
$(document).ready(function(){
  $('#cat_div').hide();
  $('#hide_city').hide();
  $('#hide_count').hide();
  $('#hide_amount').hide();
  $('.spe_day').hide();
    $('#validity_condition').change(function(){
      var validity_condition = $(this).val();
      //$('#cat_div').hide();
       if(validity_condition == 1)
       {
         $('#cat_div').hide();
         $('#hide_city').hide();
         $('#hide_amount').hide();
         $('.spe_day').hide();
         $('#hide_count').show();
       }else if(validity_condition == 2)
       {
       
        $('#hide_city').hide();
        
        $('#hide_amount').hide();
        $('.spe_day').hide();

        $('#cat_div').show();
        $('#hide_count').show();
       }else if(validity_condition == 3)
       {
        //$('#cat_div').show();
        $('#cat_div').hide();
        $('#hide_city').hide();
        $('#hide_count').hide();

        $('.spe_day').hide();
        $('#hide_amount').show();
       }
       else if(validity_condition == 4){
        $('#cat_div').hide();
        $('#hide_city').hide();
        $('#hide_count').hide();
        $('#hide_amount').hide();
        $('.spe_day').hide();
       }
       else if(validity_condition == 5)
       {
        $('#cat_div').hide();
        $('#hide_city').show();
        $('#hide_count').hide();
        $('#hide_amount').hide();
        $('.spe_day').hide();
       }else if(validity_condition == 6)
       {
        $('#cat_div').hide();
        $('#hide_city').hide();
        $('#hide_count').hide();
        $('#hide_amount').hide();
        $('.spe_day').show();
       }
       else{
        $('#cat_div').hide();
        $('#hide_city').hide();
        $('#hide_count').hide();
        $('#hide_amount').hide();
        $('.spe_day').hide();
       }

    });
    
        
    
});
</script>
    <script src="{{ config('voyager.assets_path') }}/lib/js/tinymce/tinymce.min.js"></script>
    <script src="{{ config('voyager.assets_path') }}/js/voyager_tinymce.js"></script>
@stop
