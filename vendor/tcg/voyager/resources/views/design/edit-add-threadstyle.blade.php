@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Button Style</h1>  
@stop
@section('content')
<style type="text/css">
.hclas{display: none;}
</style>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    @if($type==1)
                     
                        <div class="panel-heading">
                            <h3 class="panel-title">Add {{$name}} Thread Style</h3>
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
                                    <label for="style_name">Style Name</label>
                        
                            <select name="attri_sty_id" id="style_id" class="form-control select" required>
                            <?php $style = App\AttributeStyle::select('id','style_name')->where('attri_id', '=' , $ids)->where('thread_status', '=' , 1)->get(); ?>
                            @foreach($style as $attstyle)
                            <option value="{{$attstyle->id}}">{{$attstyle->style_name}}</option>
                            @endforeach
                            </select>
                                           
                                <input type="hidden" class="form-control" name="thrd_id" value="{{$id}}">
                                <input type="hidden" class="form-control" name="attri_id" value="{{$ids}}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="password">List Image</label>
                                  <input type="file" name="thrd_list_img">
                                </div>
                                <div class="form-group">
                                    <label for="password">Show Image</label>
                                   <input type="file" name="thrd_show_img">
                                </div>
                                
                                 <?php
                                    if($ids!=23){
                                        $cclas='cclas';    
                                    }else{
                                        $cclas='';    
                                    }
                                    ?>
                                 <div class="form-group <?php echo $cclas;?> ">
                                    <label for="password">Cross Image</label>
                                   <input type="file" name="thrd_sleeve_cross">
                                </div>   
                                <div class="form-group">
                                    <label for="password">Contrast Image</label>
                                   <input type="file" name="thrd_contrast_img">
                                </div>
                                <!-- hide and show -->
                                    <?php
                                    if($ids!=5){
                                        $hclas='hclas';    
                                    }else{
                                        $hclas='';    
                                    }
                                    ?>
                                <div class="form-group <?php echo $hclas;?>">
                                    <label for="password">Thread Front vertical</label>
                                   <input type="file" name="thread_v_img">
                                </div>
                                <div class="form-group <?php echo $hclas;?>">
                                    <label for="password">Thread Front Horizontal</label>
                                   <input type="file" name="thread_h_img">
                                </div>
                                <div class="form-group <?php echo $hclas;?>">
                                    <label for="password">Thread Front Slanted</label>
                                   <input type="file" name="thread_a_img">
                                </div>
                               <!-- End hide and show -->
                           </div><!-- panel-body -->

                            <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <iframe id="form_target" name="form_target" style="display:none"></iframe>
                     </div>
                 @else
                 <div class="panel-heading">
                   @foreach($maindata as $editd)
                   @endforeach
                   <h3 class="panel-title">Edit Thread Style</h3>
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
                        <label for="style_name">Style Name</label>
                        
                        <select name="attri_sty_id" id="attri_sty_id" class="form-control select" required>
                            <?php $style = App\AttributeStyle::select('id','style_name')->where('attri_id', '=' , $editd->attri_id)->where('thread_status', '=' , 1)->get(); ?>
                            @foreach($style as $attstyle)
                            <option value="{{$attstyle->id}}" <?php if($editd->attri_sty_id==$attstyle->id){?> selected<?php }?>>{{$attstyle->style_name}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="list_img">List Image</label>
                        <?php if($editd->thrd_list_img != ''){?>
                        <img src="{{URL::asset('/storage/'.$editd->thrd_list_img)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                        <?php }?>
                        <input type="file" name="thrd_list_img">
                    </div>
                    <div class="form-group">
                        <label for="show_img">Show Image</label>
                        <?php if($editd->thrd_show_img!=''){?>
                        <img src="{{URL::asset('/storage/'.$editd->thrd_show_img)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                        <?php }?>
                        <input type="file" name="thrd_show_img">

                    </div>
                    <?php
                    if($editd->attri_id != 23){
                        $cclas='cclas';    
                    }else{
                        $cclas='';    
                    }
                    ?>
                    <div class="form-group <?php echo $cclas;?> ">
                        <label for="password">Cross Image</label>
                        <?php if($editd->jsleeve_cross!=''){?>
                        <img src="{{URL::asset('/storage/'.$editd->jsleeve_cross)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                        <?php }?>
                        <input type="file" name="thrd_sleeve_cross">
                    </div>
                     <!-- hide and show -->
                                    <?php
                                    if($editd->attri_id != 5){
                                        $hclas='hclas';    
                                    }else{
                                        $hclas='';    
                                    }
                                    ?>
                                <div class="form-group <?php echo $hclas;?>">
                                    <label for="thread_v_img">Thread Front vertical</label>
                                    <?php if($editd->thread_v_img!=''){?>
                        <img src="{{URL::asset('/storage/'.$editd->thread_v_img)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                        <?php }?>
                                   <input type="file" name="thread_v_img">

                                </div>
                                <div class="form-group <?php echo $hclas;?>">
                                    <label for="thread_h_img">Thread Front Horizontal</label>
                                    <?php if($editd->thread_h_img!=''){?>
                        <img src="{{URL::asset('/storage/'.$editd->thread_h_img)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                        <?php }?>
                                   <input type="file" name="thread_h_img">
                                </div>
                                <div class="form-group <?php echo $hclas;?>">
                                    <label for="thread_a_img">Thread Front Slanted</label>
                                    <?php if($editd->thread_a_img!=''){?>
                        <img src="{{URL::asset('/storage/'.$editd->thread_a_img)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                        <?php }?>
                                   <input type="file" name="thread_a_img">
                                </div>
                                <!-- END --> 
                    <div class="contrast">
                        <label for="thrd_contrast_img">Contrast Image</label>
                        <?php if($editd->thrd_contrast_img!=''){?>
                        <img src="{{URL::asset('/storage/'.$editd->thrd_contrast_img)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                        <?php }?>
                        <input type="file" name="thrd_contrast_img">
                    </div>
                </div><!-- panel-body -->

                <div class="panel-footer">
                    <input type="hidden" value="<?php echo $editd->id;?>" name="id">
                    <input type="hidden" value="<?php echo $editd->thrd_id;?>" name="thrd_id">
                    <input type="hidden" value="<?php echo $editd->attri_id;?>" name="attri_id">
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
