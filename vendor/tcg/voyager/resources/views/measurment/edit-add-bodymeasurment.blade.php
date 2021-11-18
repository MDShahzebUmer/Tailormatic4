@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Add/Edit Body Measurments</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 1)

                    <div class="panel-heading">

                            <h3 class="panel-title">Add Body Measurments</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                              <div class="form-group">
                                  <label for="type">Fiting Type</label>
                                  <select name="type" id="type" class="form-control select" required>
                                    <option value="">Select Fiting Type</option>
                                    <option value="0">Body Size</option>
                                    <option value="1">Standard Sizes</option>
                                  </select>
                                </div>
                                 <div class="form-group">
                                  <label for="cat_id">Category</label>
                                  <select name="cat_id" id="cat_id" class="form-control select" required>
                                    <option value="">Select Category</option>
                                    <?php $cat = App\Category::getall_catname();?>
                                    
                                      @foreach($cat as $c)
                                      <option value="{{$c->id}}">{{$c->name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="mer_id">Measurments Type</label>
                                  <select name="mer_id" id="mer_id" class="form-control select">
                                    <option value="">Select Measurments</option>
                                    <?php $size = App\BodyMeasurment::get_standersize();?>
                                    @foreach($size as $s)
                                      <option value="{{$s->id}}">{{$s->name}}</option>
                                      @endforeach
                                    
                                  </select>
                                </div>
                                
                                <div class="form-group">
                                  <label for="country_id">Country</label>
                                  <select name="country_id" id="country_id" class="form-control select">
                                    <option value="">Select Measurments Country</option>
                                    <option value="1">European Size</option>
                                    <option value="2">UK/American Size</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="standardsize_id">Country Standard Size</label>
                                  <select name="standardsize_id = $request->standardsize_id;" id="country_id" class="form-control select" required>
                                    <option value="">Select Measurments</option>
                                    <?php $sizeno = App\StandardSize::get_standersizeno();?>
                                    @foreach($sizeno as $n)
                                      <option value="{{$n->id}}">{{$n->value}}</option>
                                      @endforeach
                                    
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="mert_type">Unit Measurments Type</label>
                                  <select name="mert_type" id="mert_type" class="form-control select" required>
                                    <option value="">Select Unit Measurments Type</option>
                                    <option value="0">Inch</option>
                                    <option value="1">CM</option>
                                  </select>
                                </div>

                                
                                <div class="col-md-1">
                                 <div class="form-group">
                                  <label for="benefit_amt">Neck.</label>
                                  <div class='input-group' id='neck'>
                                    <input type='text' class="form-control" name="neck" onkeypress='return event.charCode >= 46 && event.charCode <= 57' >
                                  </div>     
                                </div>
                              </div>

                              <div class="col-md-1">
                               <div class="form-group">
                                <label for="benefit_amt">Chest.</label>
                                <div class='input-group' id='chest'>
                                  <input type='text' class="form-control" name="chest" onkeypress='return event.charCode >= 46 && event.charCode <= 57' >
                                 </div>     
                              </div>
                            </div>
                            <div class="col-md-1">
                                 <div class="form-group">
                                  <label for="benefit_amt">Waist.</label>
                                  <div class='input-group' id='waist'>
                                    <input type='text' class="form-control" name="waist" onkeypress='return event.charCode >= 46 && event.charCode <= 57' >
                                  </div>     
                                </div>
                              </div>

                              <div class="col-md-1">
                               <div class="form-group">
                                <label for="benefit_amt">Hip.</label>
                                <div class='input-group' id='hip'>
                                  <input type='text' class="form-control" name="hip" onkeypress='return event.charCode >= 46 && event.charCode <= 57' >
                                 </div>     
                              </div>
                            </div>
                            <div class="col-md-1">
                                 <div class="form-group">
                                  <label for="shoulder">Shoulder.</label>
                                  <div class='input-group' id='shoulder'>
                                    <input type='text' class="form-control" name="shoulder" onkeypress='return event.charCode >= 46 && event.charCode <= 57' >
                                  </div>     
                                </div>
                              </div>

                              <div class="col-md-1">
                               <div class="form-group">
                                <label for="sleeve">Sleeve.</label>
                                <div class='input-group' id='sleeve'>
                                  <input type='text' class="form-control" name="sleeve" onkeypress='return event.charCode >= 46 && event.charCode <= 57' >
                                 </div>     
                              </div>
                            </div>
                            <div class="col-md-1">
                               <div class="form-group">
                                <label for="benefit_amt">Crotch.</label>
                                <div class='input-group' id='crotch'>
                                  <input type='text' class="form-control" name="crotch" onkeypress='return event.charCode >= 46 && event.charCode <= 57' >
                                 </div>     
                              </div>
                            </div>
                            <div class="col-md-1">
                               <div class="form-group">
                                <label for="thigh">Thigh.</label>
                                <div class='input-group' id='thigh'>
                                  <input type='text' class="form-control" name="thigh" onkeypress='return event.charCode >= 46 && event.charCode <= 57' >
                                 </div>     
                              </div>
                            </div>
                             <div class="col-md-1">
                               <div class="form-group">
                                <label for="length">Length.</label>
                                <div class='input-group' id='length'>
                                  <input type='text' class="form-control" name="length" onkeypress='return event.charCode >= 46 && event.charCode <= 57' >
                              </div>
                            </div>
                                 
                             </div><!-- panel-body -->
                           <div class="panel-footer col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                         
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit </h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                              <div class="form-group">
                                  <label for="type">Fiting Type</label>
                                  <select name="type" id="type" class="form-control select">
                                    <option value="">Select Fiting Type</option>
                                    <option value="0"  @if(isset($bdata) && $bdata->type == "0") selected @endif>Body Size</option>
                                    <option value="1"  @if(isset($bdata) && $bdata->type == "1") selected @endif>Standard Sizes</option>
                                  </select>
                                </div>
                                 <div class="form-group">
                                  <label for="cat_id">Category</label>
                                  <select name="cat_id" id="cat_id" class="form-control select">
                                    <option value="">Select Category</option>
                                    <?php $cat = App\Category::getall_catname();?>
                                    
                                      @foreach($cat as $c)
                                      <option value="{{$c->id}}" @if(isset($cat) && $bdata->cat_id == $c->id) selected @endif>{{$c->name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="mer_id">Measurments Type</label>
                                  <select name="mer_id" id="mer_id" class="form-control select">
                                    <option value="">Select Measurments</option>
                                    <?php $size = App\BodyMeasurment::get_standersize();?>
                                    @foreach($size as $s)
                                      <option value="{{$s->id}}" @if(isset($size) && $bdata->mer_id == $s->id) selected @endif>{{$s->name}}</option>
                                      @endforeach
                                    
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="mert_type">Country</label>
                                  <select name="country_id" id="country_id" class="form-control select">
                                    <option value="">Select Measurments Country</option>
                                    <option value="1" @if(isset($bdata) && $bdata->country_id == "1") selected @endif>European Size</option>
                                    <option value="2" @if(isset($bdata) && $bdata->country_id == "2") selected @endif>UK/American Size</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="country_id">Country Standard Size</label>
                                  <select name="standardsize_id" id="country_id" class="form-control select">
                                    <option value="">Select Measurments</option>
                                    <?php $sizeno = App\StandardSize::get_standersizeno();?>
                                    @foreach($sizeno as $n)
                                      <option value="{{$n->id}}" @if(isset($sizeno) && $bdata->standardsize_id == $n->id) selected @endif >{{$n->value}}</option>
                                      @endforeach
                                    
                                  </select>
                                </div>
                                
                                <div class="form-group">
                                  <label for="mert_type">Unit Measurments Type</label>
                                  <select name="mert_type" id="mert_type" class="form-control select">
                                    <option value="">Select Unit Measurments Type</option>
                                    <option value="0" @if(isset($bdata) && $bdata->mert_type == "0") selected @endif>Inch</option>
                                    <option value="1" @if(isset($bdata) && $bdata->mert_type == "1") selected @endif>CM</option>
                                  </select>
                                </div>

                                
                                <div class="col-md-1">
                                 <div class="form-group">
                                  <label for="benefit_amt">Neck.</label>
                                  <div class='input-group' id='neck'>
                                    <input type='text' class="form-control" value="{{$bdata['neck']}}" name="neck" onkeypress='return event.charCode >= 46 && event.charCode <= 57'>
                                  </div>     
                                </div>
                              </div>

                              <div class="col-md-1">
                               <div class="form-group">
                                <label for="benefit_amt">Chest.</label>
                                <div class='input-group' id='chest'>
                                  <input type='text' class="form-control" name="chest" value="{{$bdata['chest']}}" onkeypress='return event.charCode >= 46 && event.charCode <= 57'>
                                 </div>     
                              </div>
                            </div>
                            <div class="col-md-1">
                                 <div class="form-group">
                                  <label for="benefit_amt">Waist.</label>
                                  <div class='input-group' id='waist'>
                                    <input type='text' class="form-control" name="waist" value="{{$bdata['waist']}}" onkeypress='return event.charCode >= 46 && event.charCode <= 57'>
                                  </div>     
                                </div>
                              </div>

                              <div class="col-md-1">
                               <div class="form-group">
                                <label for="benefit_amt">Hip.</label>
                                <div class='input-group' id='hip'>
                                  <input type='text' class="form-control" name="hip" value="{{$bdata['hip']}}" onkeypress='return event.charCode >= 46 && event.charCode <= 57' >
                                  <input type='hidden' class="form-control" name="id" value="{{$bdata->id}}" >
                                 </div>     
                              </div>
                            </div>
                            <div class="col-md-1">
                                 <div class="form-group">
                                  <label for="shoulder">Shoulder.</label>
                                  <div class='input-group' id='shoulder'>
                                    <input type='text' class="form-control" value="{{$bdata['shoulder']}}"  name="shoulder" onkeypress='return event.charCode >= 46 && event.charCode <= 57' />
                                  </div>     
                                </div>
                              </div>

                              <div class="col-md-1">
                               <div class="form-group">
                                <label for="sleeve">Sleeve.</label>
                                <div class='input-group' id='sleeve'>
                                  <input type='text' class="form-control" name="sleeve" value="{{$bdata['sleeve']}}"  onkeypress='return event.charCode >= 46 && event.charCode <= 57' />
                                 </div>     
                              </div>
                            </div>
                            <div class="col-md-1">
                               <div class="form-group">
                                <label for="benefit_amt">Crotch.</label>
                                <div class='input-group' id='crotch'>
                                  <input type='text' class="form-control" name="crotch" value="{{$bdata['crotch']}}" onkeypress='return event.charCode >= 46 && event.charCode <= 57' />
                                 </div>     
                              </div>
                            </div>
                            <div class="col-md-1">
                               <div class="form-group">
                                <label for="thigh">Thigh.</label>
                                <div class='input-group' id='thigh'>
                                  <input type='text' class="form-control" name="thigh" value="{{$bdata['thigh']}}" onkeypress='return event.charCode >= 46 && event.charCode <= 57' />
                                 </div>     
                              </div>
                            </div>
                             <div class="col-md-1">
                               <div class="form-group">
                                <label for="length">Length.</label>
                                <div class='input-group' id='length'>
                                  <input type='text' class="form-control" name="length" value="{{$bdata['length']}}" onkeypress='return event.charCode >= 46 && event.charCode <= 57' />
                                 </div>     
                              </div>
                            </div>
                                 
                             </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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
