@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Add/Edit Shipping Rates</h1>  
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
                                <div class="col-md-12">
                                  <div class="form-group">
                                    @php $country = App\Country::get_country(); @endphp
                                    <label for="country_id">Country.</label>
                                    <select name="country_id" id="country_id" class="form-control">
                                      <option value="">Select Country</option> 
                                      @foreach($country as $c)
                                    <option value="{{$c->id}}" >{{$c->name}}</option>
                                    @endforeach
                                    </select>
                                  </div>
                                  </div>
                                <div class="form-group">
                                    <label for="shirt_amt">Shirt Amount.</label>
                                    <input type="text" class="form-control" name="shirt_amt"
                                           placeholder="Shirt Amount" id="shirt_amt"
                                           value="" required>
                                 </div>
                                <div class="form-group">
                                    <label for="jacket_amt">Jacket Amount.</label>
                                    <input type="text" class="form-control" name="jacket_amt"
                                           placeholder="Jacket Amount" id="jacket_amt"
                                           value="" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="vests_amt">Vests.</label>
                                    <input type="text" class="form-control" name="vests_amt"
                                           placeholder="Vests Amount" id="vests_amt"
                                           value="" required>
                                 </div>
                                 <div class="form-group" id="hide_count">
                                    <label for="pant_amt">Pant Amount.</label>
                                    <input type="text" class="form-control" name="pant_amt"
                                           placeholder="Pant Amount" id="pant_amt"
                                           value="" required>
                                 </div>
                                 <div class="form-group" id="hide_count">
                                    <label for="other_cat_amt">Other Category Amount.</label>
                                    <input type="text" class="form-control" name="other_cat_amt"
                                           placeholder="Pant Amount" id="other_cat_amt"
                                           value="" >
                                 </div>
                                  
                                 

                            </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Shipping Rates</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                            <div class="panel-body">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    @php $country = App\Country::get_country(); @endphp
                                    <label for="country_id">Country.</label>
                                    <select name="country_id" id="country_id" class="form-control" required>
                                      <option value="">Select Country</option> 
                                      @foreach($country as $c)
                                    <option value="{{$c->id}}" @if(isset($data) && $data->country_id == $c->id) selected @endif >{{$c->name}}</option>
                                    @endforeach
                                    </select>
                                  </div>
                                  </div>
                                <div class="form-group">
                                    <label for="shirt_amt">Shirt Amount.</label>
                                    <input type="text" class="form-control" name="shirt_amt"
                                           placeholder="Shirt Amount" id="shirt_amt"
                                           value="{{$data->shirt_amt}}" required>
                                 </div>
                                <div class="form-group">
                                    <label for="jacket_amt">Jacket Amount.</label>
                                    <input type="text" class="form-control" name="jacket_amt"
                                           placeholder="Jacket Amount" id="jacket_amt"
                                           value="{{$data->jacket_amt}}" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="vests_amt">Vests.</label>
                                    <input type="text" class="form-control" name="vests_amt"
                                           placeholder="Vests Amount" id="vests_amt"
                                           value="{{$data->vests_amt}}" required>
                                 </div>
                                 <div class="form-group" id="hide_count">
                                    <label for="pant_amt">Pant Amount.</label>
                                    <input type="text" class="form-control" name="pant_amt"
                                           placeholder="Pant Amount" id="pant_amt"
                                           value="{{$data->pant_amt}}" required>
                                           <input type="hidden" name="id" value="{{$data->id}}">
                                 </div>
                                 <div class="form-group" id="hide_count">
                                    <label for="other_cat_amt">Other Category Amount.</label>
                                    <input type="text" class="form-control" name="other_cat_amt"
                                           placeholder="Pant Amount" id="other_cat_amt"
                                           value="{{$data->other_cat_amt}}" >
                                 </div>

                            </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                         
                        @endif

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
   
  
    <script src="{{ config('voyager.assets_path') }}/lib/js/tinymce/tinymce.min.js"></script>
    <script src="{{ config('voyager.assets_path') }}/js/voyager_tinymce.js"></script>
@stop
