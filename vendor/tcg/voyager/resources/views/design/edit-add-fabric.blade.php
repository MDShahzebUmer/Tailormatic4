@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
  <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Fabric Design</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 'edit')
                    <div class="panel-heading">
                            <h3 class="panel-title">Edit Fabric</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                <div class="form-group">
                                    <label for="fbgrp_id">Fabric Group Name</label>
                                  @foreach($fabricedit as $con)@endforeach
                                   <select name="fbgrp_id" id="fbgrp_id" class="form-control select" required>
                                    <?php
									
									$catgid = App\FabricGroup::select('cat_id')->where('id', '=' , $con->fbgrp_id)->get();
									?>
                                     @foreach($catgid as $cati)@endforeach
									<?php 
									$fab = App\FabricGroup::select('*')->where('cat_id', '=' , $cati->cat_id)->get();
									?>
                                    @foreach($fab as $c)
                                        <option value="{{$c->id}}" @if(isset($fabricedit) && $con->fbgrp_id == $c->id) selected @endif>{{$c->fbgrp_name}}</option>
                                    @endforeach
                                    </select>
                                    
                                </div>

                                 <div class="form-group">
                                    <label for="fabric_name">Fabric Name.</label>
                                    <input type="text" class="form-control" name="fabric_name"
                                           placeholder="Fabric Name" id="fabric_name"
                                           value="{{$con->fabric_name}}" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="fabric_code">Fabric Code.</label>
                                    <input type="text" class="form-control" name="fabric_code"
                                           placeholder="Fabric Code" id="fabric_code"
                                           value="{{$con->fabric_code}}" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="fabric_brand">Fabric Brand Name.</label>
                                    <input type="text" class="form-control" name="fabric_brand"
                                           placeholder="Fabric Brand Name" id="fabric_brand"
                                           value="{{$con->fabric_brand}}" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="fabric_thickness">Fabric Thickness.</label>
                                    <input type="text" class="form-control" name="fabric_thickness"
                                           placeholder="Fabric Thickness" id="fabric_thickness"
                                           value="{{$con->fabric_thickness}}" required>
                                 </div>
                                 

                                <div class="form-group">
                                    <label for="fabric_qty">Fabric Qty.</label>
                                    <input type="text" class="form-control" name="fabric_qty"
                                           placeholder="Qty" id="fabric_qty"
                                           value="{{$con->fabric_qty}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="fabric_min_qty">Fabric Min Qty.</label>
                                    <input type="text" class="form-control" name="fabric_min_qty"
                                           placeholder="Min Qty" id="fabric_min_qty"
                                           value="{{$con->fabric_min_qty}}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="fabric_name">Fabric Desc.</label>
                                     <textarea class="form-control" id="fabric_desc" name="fabric_desc"placeholder="Short Description." required>{{$con->fabric_desc}}</textarea>
                                 </div>
                                   <span><b>Fabric Large Image Size. (WxH)(436x567),JPG Format, 15-20.KB.</b></span>
                               <div class="form-group">
                                    <label for="fabric_img_l">Fabric Large Image.</label>
                                  <input type="file" name="fabric_img_l">
                                  <img src="{{URL::asset('/storage/'.$con->fabric_img_l)}}" style="width:40px">
                                  
                                </div>
                                <div class="form-group">
                                    <label for="basic_img_f">Fabric Front Image.</label>
                                  <input type="file" name="basic_img_f">
                                  <img src="{{URL::asset('/storage/'.$con->basic_img_f)}}" style="width:60px">
                                  
                                </div>
                                <div class="form-group">
                                 <input type="hidden" name="id"  value="{{$con->id}}">
                                    <label for="basic_img_b">Fabric Back Image.</label>

                                  <input type="file" name="basic_img_b">
                                  <img src="{{URL::asset('/storage/'.$con->basic_img_b)}}" style="width:60px">
                                </div>
                                <div class="form-group">
                                    <label for="fabric_contrast_img">Fabric Contrast Image.</label>
                                  <input type="file" name="fabric_contrast_img">
                                  <img src="{{URL::asset('/storage/'.$con->fabric_contrast_img)}}" style="width:60px">
                                  
                                </div>
                                 <div class="form-group">
                                    <label for="fabric_inside_view">Fabric Inside View.</label>
                                  <input type="file" name="fabric_inside_view">
                                  <img src="{{URL::asset('/storage/'.$con->fabric_inside_view)}}" style="width:60px">
                                  
                                </div>

                                <div class="form-group">
                                    <label for="image_in">Fabric Coller In.</label>
                                  <input type="file" name="image_in">
                                    <img src="{{URL::asset('/storage/'.$con->image_in)}}" style="width:60px">
                                </div>
                                <div class="form-group">
                                    <label for="coller_band">Fabric Coller Band.</label>
                                      <img src="{{URL::asset('/storage/'.$con->coller_band)}}" style="width:60px">
                                  <input type="file" name="coller_band">
                                </div>
                                
                            </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                         <div class="panel-heading">
                            <h3 class="panel-title">Create Fabric Contrasts</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                <div class="form-group">
                                    <label for="fbgrp_id">Fabric Group Name</label>
                                   <select name="fbgrp_id[]" id="fbgrp_id" class="form-control select2" required multiple>
                                        @if(!empty($fgroup))
                                         @foreach($fgroup as $fg)
                                         <option value="{{$fg->id}}">{{$fg->fbgrp_name.' -- '.$fg->name}}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                    
                                </div>

                                 <div class="form-group">
                                    <label for="fabric_name">Fabric Name.</label>
                                    <input type="text" class="form-control" name="fabric_name"
                                           placeholder="Fabric Name" id="fabric_name"
                                           value="" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="fabric_code">Fabric Code.</label>
                                    <input type="text" class="form-control" name="fabric_code"
                                           placeholder="Fabric Code" id="fabric_code"
                                           value="" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="fabric_brand">Fabric Brand Name.</label>
                                    <input type="text" class="form-control" name="fabric_brand"
                                           placeholder="Fabric Brand Name" id="fabric_brand"
                                           value="" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="fabric_thickness">Fabric Thickness.</label>
                                    <input type="text" class="form-control" name="fabric_thickness"
                                           placeholder="Fabric Thickness" id="fabric_thickness"
                                           value="" required>
                                 </div>
                                 

                                <div class="form-group">
                                    <label for="fabric_qty">Fabric Qty.</label>
                                    <input type="text" class="form-control" name="fabric_qty"
                                           placeholder="Qty" id="fabric_qty"
                                           value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="fabric_min_qty">Fabric Min Qty.</label>
                                    <input type="text" class="form-control" name="fabric_min_qty"
                                           placeholder="Min Qty" id="fabric_min_qty"
                                           value="2" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="fabric_name">Fabric Desc.</label>
                                     <textarea class="form-control" id="fabric_desc" name="fabric_desc"placeholder="Short Description." required></textarea>
                                 </div>
                                <span><b>Fabric Large Image Size. (WxH)(436x567),JPG Format, 15-20.KB.</b></span>
                               <div class="form-group">
                                    <label for="fabric_img_l">Fabric Large Image.</label>
                                  <input type="file" name="fabric_img_l">
                                </div>
                                <div class="form-group">
                                    <label for="basic_img_f">Fabric Front Image.</label>
                                  <input type="file" name="basic_img_f">
                                </div>
                                <div class="form-group">
                                    <label for="basic_img_b">Fabric Back Image.</label>
                                  <input type="file" name="basic_img_b">
                                </div>
                                <div class="form-group">
                                    <label for="fabric_contrast_img">Fabric Contrast Image.</label>
                                  <input type="file" name="fabric_contrast_img">
                                </div>
                                <div class="form-group">
                                    <label for="fabric_inside_view">Fabric Inside View.</label>
                                  <input type="file" name="fabric_inside_view">
                                </div>
                                
                                <div class="form-group">
                                    <label for="image_in">Fabric Coller In.</label>
                                  <input type="file" name="image_in">
                                </div>
                                <div class="form-group">
                                    <label for="coller_band">Fabric Coller Band.</label>
                                  <input type="file" name="coller_band">
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
