@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
   <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left:60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i> Add/Edit Color Coller</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 1)
                    <div class="panel-heading">
                            <h3 class="panel-title">Add Color Coller</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                
                                 <div class="form-group">
                                    <label for="name">Color Name.</label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="Color Name" id="name"
                                           value="" required>
                                 </div>
                                 
                                  <div class="form-group">
                                    <label for="color_img">Color Image.</label>
                                  <input type="file" name="color_img">
                                </div>
                                
                               <div class="form-group">
                                    <label for="piping_img">Coller Image.</label>
                                  <input type="file" name="coller_img">
                                </div>
                               
                                
                           </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Color Coller</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                
                                 <div class="form-group">
                                    <label for="name">Color Name.</label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="Color Name" id="name"
                                           value="{{$data->name}}" required>
                                 </div>
                                <div class="form-group">
                                    <label for="color_img">Color Image.</label>
                                     <img src="{{URL::asset('/storage/'.$data->color_img)}}" style="width:25px">
                                  <input type="file" name="color_img">
                                </div>
                               
                               <div class="form-group">
                                    <label for="coller_img">Coller Image.</label>
                                    <img src="{{URL::asset('/storage/'.$data->coller_img)}}" style="width:25px">
                                    <input type="file" name="coller_img" title="Change image">
                                    <input type="hidden" name="id"  value="{{$data->id}}">
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
