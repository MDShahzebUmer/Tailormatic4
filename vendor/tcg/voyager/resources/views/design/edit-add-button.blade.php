@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Add/EditButtons</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 1)
                    <div class="panel-heading">
                            <h3 class="panel-title">Add Button</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                <div class="form-group">
                                    <label for="inside_view">Select Category</label>
                                   <select name="cat_id[]" id="cat_id" class="form-control select2" required multiple>
                                   
                                        @if(!empty($cat))
                                         @foreach($cat as $c)
                                         <option value="{{$c->id}}">{{$c->name}}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                    
                                </div>
                                 <div class="form-group">
                                    <label for="button_name">Button Name.</label>
                                    <input type="text" class="form-control" name="button_name"
                                           placeholder="Button Name" id="button_name"
                                           value="" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="button_code">Button Code.</label>
                                    <input type="text" class="form-control" name="button_code"
                                           placeholder="Button Code" id="button_code"
                                           value="">
                                 </div>
                                
                               <div class="form-group">
                                    <label for="button_img">Button Image.</label>
                                  <input type="file" name="button_img">
                                </div>
                                
                           </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Buttons</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                <div class="form-group">
                                    <label for="inside_view">Category</label>
                                   <?php //print_r($conts);?>
                                   @foreach($butt as $con)@endforeach
                                   <select name="cat_id" id="cat_id" class="form-control select" required>
                                    <?php $catg = TCG\Voyager\Models\Category::all(); ?>
                                    @foreach($catg as $c)
                                        <option value="{{$c->id}}" @if(isset($conts) && $con->cat_id == $c->id) selected @endif>{{$c->name}}</option>
                                    @endforeach
                                	</select>
                                    
                                </div>
                                 <div class="form-group">
                                    <label for="button_name">Button Name.</label>
                                    <input type="text" class="form-control" name="button_name"
                                           placeholder="Button Name" id="button_name"
                                           value="@if($con->button_name) {{$con->button_name}} @else '' @endif" required>
                                 </div>
                                <div class="form-group">
                                    <label for="button_code">Button Code.</label>
                                    <input type="text" class="form-control" name="button_code"
                                           placeholder="Button Code" id="button_code"
                                           value="{{$con->button_code}}" required>
                                 </div>
                               <div class="form-group">
                                    <label for="button_img">Button Image.</label>
                                    <img src="{{URL::asset('/storage/'.$con->button_img)}}" style="width:60px">
                                    <input type="file" name="button_img" title="Change image">
                                    <input type="hidden" name="id"  value="{{$con->id}}">
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
