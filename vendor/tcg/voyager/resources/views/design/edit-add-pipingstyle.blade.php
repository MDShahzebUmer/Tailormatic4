@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
   <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left:60px;">
    <i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Add/Edit Piping</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 1)
                    <div class="panel-heading">
                            <h3 class="panel-title">Add Piping Style Image {{$cat_name->name}}</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                <div class="form-group">
                                    <label for="piping_img">Style Piping Image.</label>
                                  <input type="file" name="piping_img">
                                  <input type="hidden" name="piping_id" value="{{$id}}">
                                  <input type="hidden" name="cat_id" value="{{$cat_name->id}}">
                                </div>
                           </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Piping Style Image {{$cat_name->name}}</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                
                               <div class="form-group">
                                <label for="piping_img">Style Piping Image.</label>
                               <img src="{{URL::asset('/storage/'.$data->piping_img)}}" style="width:60px">
                               <input type="file" name="piping_img"> 
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <input type="hidden" name="cat_id" value="{{$data->cat_id}}">
                                <input type="hidden" name="piping_id" value="{{$data->piping_id}}">
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
