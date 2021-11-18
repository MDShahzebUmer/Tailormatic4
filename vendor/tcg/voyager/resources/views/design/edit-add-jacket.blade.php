@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title"><i class="voyager-data"></i>Jacket Design</h1>  
@stop
@section('content')
<style>
.clhide{ display:none;}
</style>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    @if($type==1)
                        <div class="panel-heading">
                            <h3 class="panel-title">Create <?php echo $AttributeName;?></h3>
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
                                    <label for="style_name">Style Name</label>
                                    <!--<input type="text" class="form-control" name="style_name"
                                           placeholder="Style name" id="style_name"
                                           value="">-->
                                            
                            <select name="style_id" id="style_id" class="form-control select" required>
                            
							
							<?php
							
							$style = App\AttributeStyle::select('id','style_name')->where('attri_id', '=' , $a)->get(); ?>
                            @foreach($style as $attstyle)
                            <option value="{{$attstyle->id}}">{{$attstyle->style_name}}</option>
                            @endforeach
                            </select>
                                           
                          <input type="hidden" name="fab_id" value="{{$f}}">
                          <input type="hidden" name="attri_id" value="{{$a}}">
                                </div>
                                <div class="form-group">
                                    <label for="style_code">Style Code</label>
                       <input type="text" class="form-control" name="style_code" placeholder="Style Code" id="style_code" value="">
                                </div>
                               
                                <div class="form-group">
                                   @if(!empty($opt))
                                    @foreach($opt as $o)
                                    @endforeach
                                    @if($o->id != '')
                                    <label for="inside_view">{{$o->name}} Style</label>
                                    <select name="opt_id" id="opt_id" class="form-control">
                                         <option value="">Select Style</option>
                                         <option value="1">Yes</option>
                                         <option value="0">No</option>
                                     </select>
                                    @else
                                     
                                     <input type="hidden" name="opt_id" id="opt_id" value="0">
                                    @endif 
                                    @else
                                     
                                     <input type="hidden" name="opt_id" id="opt_id" value="0">
                                    @endif
                                 </div> 
                                <div class="form-group">
                                    <label for="password">List Image</label>
                                  <input type="file" name="img1">
                                </div>
                               
                                
                                <div class="form-group">
                                    <label for="password">Show Image</label>
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
                           </div><!-- panel-body -->

                            <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <iframe id="form_target" name="form_target" style="display:none"></iframe>
                     </div>
                 @else
                        <div class="panel-heading">
                         @foreach($fabstylelist as $editd)
                          @endforeach
                            <h3 class="panel-title">Edit {{$editd->style_name}}</h3>
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
                               <!--< <div class="form-group">
                                    <label for="style_name">Style Name</label>
                                    input type="text" class="form-control" name="style_name"
                                           placeholder="Style name" id="style_name"
                                           value="{{$editd->style_name}}">-->
                          <!--<select name="style_id" id="style_id" class="form-control select" required>
                            <?php $style = App\AttributeStyle::select('id','style_name')->where('attri_id', '=' , $editd->attri_id)->get(); ?>
                            @foreach($style as $attstyle)
                            <option value="{{$attstyle->id}}" <?php if($editd->style_id==$attstyle->id){?> selected<?php }?>>{{$attstyle->style_name}}</option>
                            @endforeach
                            </select>
                                           
                                           
                                           
                                           
                                </div> -->
                                <div class="form-group">
                                    <label for="style_code">Style Code</label>
                                    <input type="text" class="form-control" name="style_code"
                                           placeholder="Style Code" id="style_code"
                                           value="{{$editd->style_code}}">
                                </div>
                              
                                <div class="form-group">
                                   @if(!empty($opt))
                                    @foreach($opt as $o)
                                    @endforeach
                                    @if($o->id != '')
                                    <label for="inside_view">{{$o->name}} Style</label>
                                    <select name="opt_id" id="inside_view" class="form-control">
                                         <option value="">Select Style</option>
                                         <option <?php if($editd->opt_Id==1){?> selected<?php }?> value="1">Yes</option>
                                         <option <?php if($editd->opt_Id==0){?> selected<?php }?>  value="0">No</option>
                                     </select>
                                    @else
                                     
                                     <input type="hidden" name="opt_id" value="0">
                                    @endif 
                                     @else
                                     
                                     <input type="hidden" name="opt_id" value="0">
                                    @endif
                                 </div> 
                                <div class="form-group">
                                    <label for="password">List Image</label>
                                    @if($editd->list_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->list_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                  <input type="file" name="img1">
                                </div>
                                
                                 
                                
                                <div class="form-group">
                                    <label for="password">Show Image</label>
                                     @if($editd->show_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->show_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                   <input type="file" name="img2">
                                </div>
                                
                                
                                
                                <div class="form-group">
                                    <label for="password">Front Image</label>
                                     @if($editd->front_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->front_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
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
                                    <label for="inside_view">Status</label>
                                    <select name="status" id="status" class="form-control">
                                         <option value="">Select Status</option>
                                         <option <?php if($editd->status==1){?> selected<?php }?> value="1">Enable</option>
                                         <option <?php if($editd->status==0){?> selected<?php }?> value="0">Disable</option>
                                        
                                    </select>
                                    <input type="hidden" name="style_id" value="{{$editd->style_id}}">
                                    <input type="hidden" name="fab_id" value="{{$editd->fab_id}}">
                                    <input type="hidden" name="attri_id"  value="{{$editd->attri_id}}">
                                    <input type="hidden" name="id" value="{{$editd->id}}">
                                    <input type="hidden" name="old_style_id" value="{{$editd->style_id}}">
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
