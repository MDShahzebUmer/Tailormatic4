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
                      @foreach($stylefabimglist as $designlist)
                	@endforeach
                        <div class="panel-heading">
                            <h3 class="panel-title">Add "{{$designlist->style_name}}" jacket collar</h3>
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
                                    <label for="style_name">Lapel Type</label>
                                    <!--<input type="text" class="form-control" name="style_name"
                                           placeholder="Style name" id="style_name"
                                           value="">-->
                                            
                            <select name="attri_sty_id" id="attri_sty_id" class="form-control select" required>
                            
							
							<?php
							
							$style = App\AttributeStyle::select('id','style_name')->where('attri_id', '=' , $lapel)->get(); ?>
                            @foreach($style as $attstyle)
                            <option value="{{$attstyle->id}}">{{$attstyle->style_name}}</option>
                            @endforeach
                            </select>
                                           
                          <input type="hidden" name="stylefabimglists_id" value="{{$id}}">
                          <input type="hidden" name="style_type_id" value="{{$designlist->style_id}}">
                          <input type="hidden" name="attri_id" value="{{$designlist->attri_id}}">
                          <input type="hidden" name="fab_id" value="{{$designlist->fab_id}}">
                           </div>
                                
                               
                                 
                                <div class="form-group">
                                    <label for="password">Main Collar</label>
                                  <input type="file" name="main_collar">
                                </div>
                               
                                
                                <div class="form-group">
                                    <label for="password">Inner Collar</label>
                                   <input type="file" name="inner_collar">
                                </div>
                                 
                                <div class="form-group">
                                    <label for="password">Back Collar</label>
                                   <input type="file" name="back_collar">
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
                         @foreach($stylefabimglist as $styfabid)
                          @endforeach
                        
                        
                        <?php
                        $stylename=App\AttributeStyle::getStylename($editd->attri_sty_id,'style_name');
									
						?>
                            <h3 class="panel-title">Edit "{{$stylename}}" Collar</h3>
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
                                    <label for="password">Main Collar</label>
                                    @if($editd->main_collar!='')
                                    <img src="{{URL::asset('/storage/'.$editd->main_collar)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                  <input type="file" name="main_collar">
                                </div>
                                 
                                
                                <div class="form-group">
                                    <label for="password">Inner Collar</label>
                                     @if($editd->inner_collar!='')
                                    <img src="{{URL::asset('/storage/'.$editd->inner_collar)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                   <input type="file" name="inner_collar">
                                </div>
                                
                                
                                
                                <div class="form-group">
                                    <label for="password">Back Collar</label>
                                     @if($editd->back_collar!='')
                                    <img src="{{URL::asset('/storage/'.$editd->back_collar)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                   <input type="file" name="back_collar">
                                </div>
                                
                                
                                 <div class="form-group">
                                    <label for="inside_view">Status</label>
                                    <select name="status" id="status" class="form-control">
                                         <option value="">Select Status</option>
                                         <option <?php if($editd->status==1){?> selected<?php }?> value="1">Enable</option>
                                         <option <?php if($editd->status==0){?> selected<?php }?> value="0">Disable</option>
                                        
                                    </select>
                                   <input type="hidden" name="stylefabimglists_id" value="{{$editd->stylefabimglists_id}}">
                                  <input type="hidden" name="style_type_id" value="{{$editd->style_type_id}}">
                                  <input type="hidden" name="attri_sty_id" value="{{$editd->attri_sty_id}}">
                                  <input type="hidden" name="id" value="{{$editd->id}}">
                                 <input type="hidden" name="fab_id" value="{{$styfabid->fab_id}}">
                                  <input type="hidden" name="attri_id" value="{{$styfabid->attri_id}}">
                                  
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
