@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
     <div class="row">
      <div class="col-md-4">
         <h1 class="page-title" style="height:70px;"><i class="voyager-data"></i>Fabric Design</h1> 
     </div>
    
     @if($type == 1)
     @php $slug = Request::segments(1);
           $one = $slug[2];
           $two = $slug[3]; 

        $slug = App\Stylefabimglist::get_add_slug($one , $two); 
         @endphp
     <div class="col-md-8">
         <a href="<?php echo url('admin/categories');?>" class="btn btn-success" title="Category Name" alt="">{{$slug['name']}}  <b>&raquo;</b></a>
         <a href="<?php echo url('admin/fabric');?>" class="btn btn-success"title="Fabric Group Name" alt="">{{$slug['fbgrp_name']}} <b>&raquo;</b></a>
         <a href="<?php echo url('admin/fabricdesign/').'/'.$slug['fab_id'].'-'.$slug['attri_id']?>" class="btn btn-success active" title="Fabric Name" alt="">{{$slug['fabric_name']}}</a>
     </div>
     @else
    @php  $slug = Request::segments(1); 
          $slug = $slug[2];
          $slug = App\Stylefabimglist::get_slug($slug); 
     @endphp
     <div class="col-md-8">
         <a href="<?php echo url('admin/categories');?>" class="btn btn-success" title="Category Name" alt="">{{$slug['name']}} <b>&raquo;</b></a>
         <a href="<?php echo url('admin/fabric');?>" class="btn btn-success"title="Fabric Group Name" alt=""> {{$slug['fbgrp_name']}}<b>&raquo;</b></a>
         <a href="<?php echo url('admin/fabricdesign/').'/'.$slug['fab_id'].'-'.$slug['attri_id']?>" class="btn btn-success active" title="Fabric Name" alt="">{{$slug['fabric_name']}}</a>
     </div>
     @endif
</div>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    @if($type==1)
                     @foreach($opt as $o)
                          @endforeach
                        <div class="panel-heading">
                            <h3 class="panel-title">Add {{$o->name}}</h3>
                        </div>
                         
                       
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}

                            <div class="panel-body">

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <!--  <?php //print_r($opt); echo $opt->attri_id;?> -->
                                
                                <div class="form-group">
                                    <label for="password">Main Image</label>
                                  <input type="file" name="img1">
                                </div>
                                <div class="form-group">
                                    <label for="password">Rignt Image</label>
                                   <input type="file" name="img2">
                                </div>
                                <div class="form-group">
                                    <label for="password">Front Image</label>
                                   <input type="file" name="img3">
                                </div>
                                <div class="form-group">
                                    <label for="password">Back Image</label>
                                    <input type="file" name="img4">
                                </div>
                                <div class="form-group">
                                    <label for="password">Tri Tab Seams</label>
                                    <input type="file" name="img5">
                                </div>
                                <div class="form-group">
                                    <label for="password">Straight img Seams</label>
                                    <input type="file" name="img6">
                                </div>
                           </div><!-- panel-body -->

                            <div class="panel-footer">
                             <input type="hidden" name="opt_id" value="{{$o->id}}">
                            <input type="hidden" name="fab_id" value="{{$f}}">
                            <input type="hidden" name="att_id" value="{{$a}}">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <iframe id="form_target" name="form_target" style="display:none"></iframe>
                     </div>
                 @else
                        <div class="panel-heading">
                         @foreach($fabstylelist as $editd)
                          @endforeach
                            <h3 class="panel-title">Edit {{$optname}}</h3>
                        </div>
                       
                        <!-- form start -->
                       <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}

                            <div class="panel-body">

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                           
                                 
                                <div class="form-group">
                                    <label for="password">Main Image</label>
                                    @if($editd->left_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->left_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                  <input type="file" name="img1">
                                </div>
                                <div class="form-group">
                                    <label for="password">Rignt Image</label>
                                     @if($editd->reight_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->reight_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                   <input type="file" name="img2">
                                </div>
                                <div class="form-group">
                                    <label for="password">Front Image</label>
                                     @if($editd->inside_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->inside_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                   <input type="file" name="img3">
                                </div>
                                <div class="form-group">
                                    <label for="password">Back Image</label>
                                      @if($editd->back_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->back_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                    <input type="file" name="img4">
                                </div>
                                <div class="form-group">
                                    <label for="password">Tri Tab Seams</label>
                                    @if($editd->tritab_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->tritab_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                    <input type="file" name="img5">
                                </div>
                                <div class="form-group">
                                    @if($editd->straight_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->straight_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                    <label for="password">Straight img Seams</label>
                                    <input type="file" name="img6">
                                </div>
                                
                                 <div class="form-group">
                                    <label for="inside_view">Status</label>
                                    <select name="status" id="status" class="form-control">
                                         <option value="">Select Status</option>
                                         <option <?php if($editd->status==1){?> selected<?php }?> value="1">Enable</option>
                                         <option <?php if($editd->status==0){?> selected<?php }?> value="0">Disable</option>
                                        
                                    </select>
                        <input type="hidden" name="id" value="{{$editd->id}}">
                        <input type="hidden" name="opt_id" value="{{$editd->opt_id}}">
                        <input type="hidden" name="fab_id" value="{{$editd->fab_id}}">
                                </div>
                                
                           </div><!-- panel-body -->

                            <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                       

                        <iframe id="form_target" name="form_target" style="display:none"></iframe>
                     </div>
                 @endif
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
