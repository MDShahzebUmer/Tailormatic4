@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
  <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Measurment Video</h1>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 'edit')    
                  
                  @foreach($measuredit as $measur) @endforeach
                  
                    <div class="panel-heading">
                            <h3 class="panel-title">Edit "{{$measur->bodysize_type}}" Measurment Video</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                          
                             <div class="panel-body">
                             
                                <div class="form-group">
                                    <label for="sub_type_id">Category</label>
                                  <select name="d" id="d" class="form-control select" disabled required>
                                    <?php $catg = TCG\Voyager\Models\Category::all(); ?>
                                    @foreach($catg as $c)
                                        <option value="{{$c->id}}" @if($c->id==$measur->cat_id) selected @endif>{{$c->name}}</option>
                                    @endforeach
                                </select>  
                                 <input type="hidden" name="cat_id" value="{{$measur->cat_id}}">                             
                                </div>
                                
                                 <div class="form-group">
                                        <label for="size_type">Size Type</label>
                                        <input type="text" class="form-control" name="bodysize_type" value="{{$measur->bodysize_type}}" disabled> 
                                        <input type="hidden" name="bodysize_type" value="{{$measur->bodysize_type}}"> 
                                                                         
                                    </div>
                                    
                                  <div class="form-group">
                                    <label for="contrsfab_name">Range From (Inch).</label>
                                    
                                    <input type="text" class="form-control" name="range_from" id="range_from" value="{{$measur->from_range}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="contrsfab_name">Range To (Inch).</label>
                                    <input type="text" class="form-control" name="range_to" id="range_to" value="{{$measur->to_range}}">
                                 </div>  
                                    
                                    
                               <div class="form-group">
                                    <label for="front_img">Type Image.</label>
                                  <input type="file" name="measurment_img">
                                </div>
                               
                               <div class="form-group">
                                    <label for="front_img">MP Video.</label>
                                    <video width="20%" loop preload="metadata"  controls class="__web-inspector-hide-shortcut__">
                                    <source src="{{URL::asset('/storage/'.$measur->measurment_mp_video)}}" type="video/mp4">
                                    </video>
                                  <input type="file" name="measurment_mp_video">
                                </div>
                               
                               <div class="form-group">
                                    <label for="front_img">OGV Video.</label>
                                    <video width="20%" loop preload="metadata"  controls class="__web-inspector-hide-shortcut__">
                                    <source src="{{URL::asset('/storage/'.$measur->measurment_ogvvideo)}}" type="video/ogg">
                                   </video>
                                  <input type="file" name="measurment_ogvvideo">
                                </div>
                                
                               <div class="form-group">
                                    <label for="front_img">SWF Video.</label>
                                    <video width="20%" loop preload="metadata"  controls class="__web-inspector-hide-shortcut__">
                                   <object data="{{URL::asset('/storage/'.$measur->measurment_swfvideo)}}" type="application/x-shockwave-flash" width="300" height="220"></object>
                                    </video>
                                  <input type="file" name="measurment_swfvideo">
                                </div>
                                
                               <div class="form-group">
                                    <label for="front_img">WEBM Video.</label>
                                    <video width="20%" loop preload="metadata"  controls class="__web-inspector-hide-shortcut__">
                                     <source src="{{URL::asset('/storage/'.$measur->measurment_webmvideo)}}" type="video/webm"></video>
                                  <input type="file" name="measurment_webmvideo">
                                </div>
                                
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                         <div class="panel-heading">
                         
                            <h3 class="panel-title">Add Measurment Video</h3>
                        </div>
                        
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                          
                             <div class="panel-body">
                             
                                <div class="form-group">
                                    <label for="sub_type_id">Category</label>
                                  <select name="cat_id" id="cat_id" class="form-control select" required>
                                    <?php $catg = TCG\Voyager\Models\Category::all(); ?>
                                    @foreach($catg as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>                               
                                </div>
                                
                                 <div class="form-group">
                                        <label for="size_type">Size Type</label>
                                         <select name="size_type" id="size_type" class="form-control select" required>
                                  	   <option value="Neck">Neck</option>
                                       <option value="Chest">Chest</option>
                                       <option value="Waist">Waist</option>
                                       <option value="Hip">Hip</option>
                                       <option value="Length">Length</option>
                                       <option value="Shoulder">Shoulder</option>
                                       <option value="Sleeve">Sleeve</option>
                                       <option value="Crotch">Crotch</option>
                                       <option value="Thigh">Thigh</option>
                                       </select>  
                                                                         
                                    </div>
                                    
                                  <div class="form-group">
                                    <label for="contrsfab_name">Range From (Inch).</label>
                                    <input type="text" class="form-control" name="range_from" id="range_from" value="">
                                 </div>
                                 <div class="form-group">
                                    <label for="contrsfab_name">Range To (Inch).</label>
                                    <input type="text" class="form-control" name="range_to" id="range_to" value="">
                                 </div>  
                                    
                                    
                               <div class="form-group">
                                    <label for="front_img">Type Image.</label>
                                  <input type="file" name="measurment_img">
                                </div>
                                
                               <div class="form-group">
                                    <label for="front_img">MP Video.</label>
                                  <input type="file" name="measurment_mp_video">
                                </div>
                               
                               <div class="form-group">
                                    <label for="front_img">OGV Video.</label>
                                  <input type="file" name="measurment_ogvvideo">
                                </div>
                                
                               <div class="form-group">
                                    <label for="front_img">SWF Video.</label>
                                  <input type="file" name="measurment_swfvideo">
                                </div>
                                
                               <div class="form-group">
                                    <label for="front_img">WEBM Video.</label>
                                  <input type="file" name="measurment_webmvideo">
                                </div>
                                
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
