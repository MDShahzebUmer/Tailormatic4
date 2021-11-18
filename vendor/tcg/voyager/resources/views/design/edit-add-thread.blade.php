@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
   <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Add/Edit Thread</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 1)
                    <div class="panel-heading">
                            <h3 class="panel-title">Add Thread</h3>
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
                                    <label for="thrd_name">Thread Name.</label>
                                    <input type="text" class="form-control" name="thrd_name"
                                           placeholder="Thread Name" id="thrd_name"
                                           value="" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="thread_code">Thread Code.</label>
                                    <input type="text" class="form-control" name="thread_code"
                                           placeholder="Thread Code" id="thread_code"
                                           value="" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="thread_color">Thread Color Code.</label>
                                    <input type="color" class="form-control" name="thread_color"
                                           placeholder="Thread Color Code" id="thread_color"
                                           value="" required >
                                 </div>
                                
                               <div class="form-group">
                                    <label for="thrd_img">Thread Image.</label>
                                  <input type="file" name="thrd_img">
                                </div>
                                <div class="form-group">
                                    <label for="thrd_hole_vertical">Thread Vrtical.</label>
                                  <input type="file" name="thrd_hole_vertical">
                                </div>
                                <div class="form-group">
                                    <label for="thrd_hole_horizontal">Thread Horizontal.</label>
                                  <input type="file" name="thrd_hole_horizontal">
                                </div>
                                <div class="form-group">
                                    <label for="thrd_hole_slanted">Thread Slanted.</label>
                                  <input type="file" name="thrd_hole_slanted">
                                </div>
                                <div class="form-group">
                                    <label for="thrd_cross">Thread Cross Image.</label>
                                  <input type="file" name="thrd_cross">
                                </div>
                                
                           </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Thread</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                <div class="form-group">
                                    <label for="inside_view">Category</label>
                                   <?php //print_r($conts);?>
                                   @foreach($thred as $th)@endforeach
                                   <select name="cat_id" id="cat_id" class="form-control select" required>
                                    <?php $catg = TCG\Voyager\Models\Category::all(); ?>
                                    @foreach($catg as $c)
                                        <option value="{{$c->id}}" @if(isset($conts) && $th->cat_id == $c->id) selected @endif>{{$c->name}}</option>
                                    @endforeach
                                	</select>
                                    
                                </div>
                                 <div class="form-group">
                                    <label for="thrd_name">Thread Name.</label>
                                    <input type="text" class="form-control" name="thrd_name"
                                           placeholder="Thread Name" id="thrd_name"
                                           value="{{$th->thrd_name}}" required>
                                 </div>
                                <div class="form-group">
                                    <label for="thread_code">Thread Name.</label>
                                    <input type="text" class="form-control" name="thread_code"
                                           placeholder="Thread Code" id="thread_code"
                                           value="{{$th->thread_code}}" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="thread_color">Thread Color Code.</label>
                                    <input type="color" class="form-control" name="thread_color"
                                           placeholder="Thread Color Code" id="thread_color"
                                           value="{{$th->thread_code}}" required >
                                 </div>
                              <div class="form-group">
                                    <label for="thrd_img">Thread Image.</label>
                                    <img src="{{URL::asset('/storage/'.$th->thrd_img)}}" style="width:60px">
                                    <input type="file" name="thrd_img" title="Change image">
                                </div>
                                <div class="form-group">
                                    <label for="thrd_hole_vertical">Thread Vertical Image.</label>
                                    <img src="{{URL::asset('/storage/'.$th->thrd_hole_vertical)}}" style="width:60px">
                                    <input type="file" name="thrd_hole_vertical" title="Change image">
                                </div>
                                <div class="form-group">
                                    <label for="thrd_hole_horizontal">Thread Horizontal Image.</label>
                                    <img src="{{URL::asset('/storage/'.$th->thrd_hole_horizontal)}}" style="width:60px">
                                    <input type="file" name="thrd_hole_horizontal" title="Change image">
                                </div>
                                <div class="form-group">
                                    <label for="thrd_hole_slanted">Thread Slanted Image.</label>
                                    <img src="{{URL::asset('/storage/'.$th->thrd_hole_slanted)}}" style="width:60px">
                                    <input type="file" name="thrd_hole_slanted" title="Change image">
                                </div>
                               
                               <div class="form-group">
                                    <label for="thrd_cross">Thread Cross  Image.</label>
                                    <img src="{{URL::asset('/storage/'.$th->thrd_cross)}}" style="width:60px">
                                    <input type="file" name="thrd_cross" title="Change image">
                                    <input type="hidden" name="id"  value="{{$th->id}}">
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
