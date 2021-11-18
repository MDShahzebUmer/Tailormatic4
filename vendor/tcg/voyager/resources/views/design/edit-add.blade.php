@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
         
    <div class="row">
      <div class="col-md-4">
          <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Fabric Design</h1> 
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
                          
                            <?php  
                             

                            $pr = App\Stylefabimglist::get_fabric_option_list($a,$f);?>

                            <div class="form-group">
                            <label for="style_name">Style Name</label>
                            <select name="style_id" id="style_id" class="form-control select" required>
                            <?php $style = App\AttributeStyle::select('id','style_name')->where('attri_id', '=' , $a)->whereNotIn('id', $pr)->get(); ?> 
                            @foreach($style as $attstyle)
                            <option value="{{$attstyle->id}}">{{$attstyle->style_name}}</option>
                            @endforeach
                            </select>
                                           
                          <input type="hidden" name="fab_id" value="{{$f}}">
                          <input type="hidden" name="attri_id" value="{{$a}}">
                                </div>
                                <div class="form-group">
                                    <label for="style_code">Style Code</label>
                                    <input type="text" class="form-control" name="style_code"
                                           placeholder="Style Code" id="style_code"
                                           value="">
                                </div>
                               <div class="form-group">
                                    <label for="inside_view">Inside View</label>
                                    <select name="inside_view" id="inside_view" class="form-control" required>
                                         <option value="">Select Inside View</option>
                                         <option value="1">Yes</option>
                                         <option value="0">No</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                   @if(!empty($opt))
                                    @foreach($opt as $o)
                                    @endforeach
                                    @if($o->id != '')
                                    <label for="inside_view">{{$o->name}} Style</label>
                                    <select name="opt_id" id="opt_id" class="form-control" required>
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
                                <?php
                                if($a!=10){
									$butclss='clhide';
									$butname='';
								}else{
									$butclss='';
									$butname='One Poickets ';
									
								}
								?>
                                
                                <div class="form-group">
                                    <label for="password">Show <?php echo $butname;?>Image</label>
                                   <input type="file" name="img2">
                                </div>
                                 <div class="form-group <?php echo $butclss;?>">
                                    <label for="password">Show Two Pockets Image</label>
                                   <input type="file" name="img5">
                                </div>
                                <div class="form-group">
                                    <label for="password">Front Image</label>
                                   <input type="file" name="img3">
                                </div>
                                <div class="form-group">
                                    <label for="password">Back Image</label>
                                    <input type="file" name="img4">
                                </div>
                                

                                <?php                                
                                if($a==9 || $a == 4){
                                    $inner='';
                                    $nafirst ='Image Inner';
                                    $nasecond ='Image Outer';


                                    
                                }elseif($a==7){
                                    $inner ='';
                                    $nafirst ='Front Placket';
                                    $nasecond ='Back Placket';

                                }elseif($a==51){
                                    $inner ='';
                                    $nafirst ='Left Pocket';
                                    $nasecond ='Right Pocket';

                                }else{
                                    $inner ='clhide';
                                    $nafirst ='';
                                    $nasecond ='';
                                    
                                }
                                ?>
                                <div class="form-group <?php echo $inner; ?> ">
                                    <label for="img6"><?php echo $nafirst;  ?></label>
                                   <input type="file" name="img6">
                                </div>
                                <div class="form-group  <?php echo $inner; ?>">
                                    <label for="img7"><?php echo $nasecond  ?></label>
                                    <input type="file" name="img7">
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
                            
                                <div class="form-group">
                                    <label for="style_code">Style Code</label>
                                    <input type="text" class="form-control" name="style_code"
                                           placeholder="Style Code" id="style_code"
                                           value="{{$editd->style_code}}">
                                </div>
                               <div class="form-group">
                                    <label for="inside_view">Inside View</label>
                                    <select name="inside_view" id="inside_view" class="form-control" required>
                                         <option value="">Select Inside View</option>
                                         <option <?php if($editd->inside_view==1){?> selected<?php }?> value="1">Yes</option>
                                         <option <?php if($editd->inside_view==0){?> selected<?php }?> value="0">No</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                   @if(!empty($opt))
                                    @foreach($opt as $o)
                                    @endforeach
                                    @if($o->id != '')
                                    <label for="inside_view">{{$o->name}} Style</label>
                                    <select name="opt_id" id="inside_view" class="form-control" required>
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
                                
                                 <?php
                                if($editd->attri_id!=10){
									$butclss='clhide';
									$butname='';
								}else{
									$butclss='';
									$butname='One Poickets ';
									
								}
								?>
                                
                                <div class="form-group">
                                    <label for="password">Show <?php echo $butname;?>Image</label>
                                     @if($editd->show_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->show_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                   <input type="file" name="img2">
                                </div>
                                
                                <div class="form-group <?php echo $butclss;?>">
                                    <label for="password">Show Two Poickets Image</label>
                                     @if($editd->buttons_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->buttons_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                   <input type="file" name="img5">
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
                                      @if($editd->back_img != '')
                                    <img src="{{URL::asset('/storage/'.$editd->back_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                    <input type="file" name="img4">
                                </div>
                                
                                  <?php                                
                                if($editd->attri_id == 9 || $editd->attri_id == 4){
                                    $inner='';
                                    $nafirst ='Image Inner';
                                    $nasecond ='Image Outer';


                                    
                                }elseif($editd->attri_id == 7){
                                    $inner ='';
                                    $nafirst ='Front Placket';
                                    $nasecond ='Back Placket';

                                }elseif($editd->attri_id == 51){
                                    $inner ='';
                                    $nafirst ='Left Pocket';
                                    $nasecond ='Right Pocket';

                                }else{
                                    $inner ='clhide';
                                    $nafirst ='';
                                    $nasecond ='';
                                    
                                }
                                ?>
                                <div class="form-group <?php echo $inner; ?> ">
                                    <label for="img6"><?php echo $nafirst;  ?></label>
                                      @if($editd->img_inner != '')
                                     <img src="{{URL::asset('/storage/'.$editd->img_inner)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                      @endif
                                   <input type="file" name="img6">
                                </div>
                                <div class="form-group  <?php echo $inner; ?>">
                                      <label for="img7"><?php echo $nasecond  ?></label>
                                       @if($editd->img_outer != '')
                                     <img src="{{URL::asset('/storage/'.$editd->img_outer)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                  @endif
                                    <input type="file" name="img7">
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
