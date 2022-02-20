@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
   <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Fabric Type</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 1)
                    <div class="panel-heading">
                            <h3 class="panel-title">Add Fabric Type</h3>
                        </div>
                        <?php $cat = App\Category::getall_catname(); ?>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                             <div class="panel-body">

                              <div class="form-group">
                                <label for="cat_id">Select Category</label>
                                <select name="cat_id[]" id="cat_id" class="form-control select2" multiple required>
                                  @foreach($cat as $c)
                                  <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="type_name">Product Fabric Type Name.</label>
                                <input type="text" class="form-control" name="type_name"
                                placeholder="Product Fabric Type Name" id="type_name"
                                value="" required>
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
                                    <?php $cat = App\Category::getall_catname(); ?>
                                   <select name="cat_id" id="cat_id" class="form-control select" required>
                                    
                                    @foreach($cat as $c)
                                        <option value="{{$c->id}}" @if(isset($data) && $data->cat_id == $c->id) selected @endif>{{$c->name}}</option>
                                    @endforeach
                                	</select>
                                    
                                </div>
                                <div class="form-group">
                                  <label for="type_name">Product Fabric Type Name.</label>
                                  <input type="text" class="form-control" name="type_name"
                                  placeholder="Product Fabric Type Name" id="type_name"
                                  value="{{$data->type_name}}" required>
                                  <input type="hidden" name="id" value="{{$data->id}}"> 
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
