@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Button Style</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    @if($type==1)
                     
                        <div class="panel-heading">
                            <h3 class="panel-title">Add {{$name}} Button Style</h3>
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
                        
                            <select name="style_id" id="style_id" class="form-control select" required>
                            <?php $style = App\AttributeStyle::select('id','style_name')->where('attri_id', '=' , $ids)->where('buttons_status', '=' , 1)->get(); ?>
                            @foreach($style as $attstyle)
                            <option value="{{$attstyle->id}}">{{$attstyle->style_name}}</option>
                            @endforeach
                            </select>
                                           
                                <input type="hidden" class="form-control" name="but_id" value="{{$id}}">
                                <input type="hidden" class="form-control" name="attri_id" value="{{$ids}}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="list_img">List Image</label>
                                  <input type="file" name="button_list_img">
                                </div>
                                <div class="form-group">
                                    <label for="show_img">Show Image</label>
                                   <input type="file" name="button_show_img">
                                </div>
                                @if($ids == 4)
                                <div class="contrast">
                                    <label for="epaulettes_button">Main Epaulettes Button</label>
                                   <input type="file" name="epaulettes_button">
                                </div>
                                @endif
                                @if($ids == 10)
                                <div class="contrast">
                                    <label for="pocket_one_button">Pocket One Image</label>
                                   <input type="file" name="pocket_one_button">
                                </div>
                                <div class="contrast">
                                    <label for="pocket_two_button">Pocket Two Image</label>
                                   <input type="file" name="pocket_two_button">
                                </div> @endif
                                @if($ids == 19 || $ids == 23 || $ids == 52 || $ids == 53)
                                <div class="contrast">
                                    <label for="main_img">Main Img Image(Jacket/Pants)</label>
                                   <input type="file" name="main_img">
                                </div>
                                @endif
                                <div class="contrast">
                                    <label for="contrast_img">Contrast Image</label>
                                   <input type="file" name="button_contrast_img">
                                </div>
                                 @if($ids == 51)
                                 <div class="contrast">
                                    <label for="left_img">Left Image</label>
                                   <input type="file" name="left_img">
                                </div>
                                 <div class="contrast">
                                    <label for="right_img">Right Image</label>
                                   <input type="file" name="right_img">
                                </div>
                                @endif
                               
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
                            <h3 class="panel-title">Edit Button Style</h3>
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
                        
                            <select name="style_id" id="style_id" class="form-control select" required>
                            <?php $style = App\AttributeStyle::select('id','style_name')->where('attri_id', '=' , $editd->attri_id)->where('buttons_status', '=' , 1)->get(); ?>
                            @foreach($style as $attstyle)
                            <option value="{{$attstyle->id}}" <?php if($editd->attri_sty_id==$attstyle->id){?> selected<?php }?>>{{$attstyle->style_name}}</option>
                            @endforeach
                            </select>
                
                                </div>
                                
                                 <div class="form-group">
                                    <label for="list_img">List Image</label>
                                    <?php if($editd->button_list_img!=''){?>
                                     <img src="{{URL::asset('/storage/'.$editd->button_list_img)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                     <?php }?>
                                  <input type="file" name="button_list_img">
                                </div>
                                <div class="form-group">
                                    <label for="show_img">Show Image</label>
                                    <?php if($editd->button_show_img!=''){?>
                                    <img src="{{URL::asset('/storage/'.$editd->button_show_img)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    <?php }?>
                                   <input type="file" name="button_show_img">
                               </div>
                               @if($editd->attri_id == 4)
                               <div class="form-group">
                                    <label for="epaulettes_button">Main Epaulettes Button</label>
                                  
                                    <?php if($editd->epaulettes_button != ''){?>
                                     <img src="{{URL::asset('/storage/'.$editd->epaulettes_button)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                     <?php }?>
                                    <input type="file" name="epaulettes_button">
                                </div>
                                 @endif
                                @if($editd->attri_id == 10)
                                 <div class="contrast">
                                    <label for="pocket_one_button">Pocket One Image</label>
                                    <?php if($editd->pocket_one_button != ''){?>
                                     <img src="{{URL::asset('/storage/'.$editd->pocket_one_button)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                     <?php }?>
                                   <input type="file" name="pocket_one_button">
                                </div>
                                <div class="contrast">
                                    <label for="pocket_two_button">Pocket Two Image</label>
                                    <?php if($editd->pocket_two_button != ''){?>
                                     <img src="{{URL::asset('/storage/'.$editd->pocket_two_button)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                     <?php }?>
                                   <input type="file" name="pocket_two_button">
                                </div>
                                 @endif
                                @if($editd->attri_id == 19 || $editd->attri_id == 23 || $editd->attri_id == 52 || $editd->attri_id == 53)  
                               <div class="form-group">
                                    <label for="main_img">Main Img Image(Jacket)</label>
                                    <?php if($editd->main_img!=''){?>
                                     <img src="{{URL::asset('/storage/'.$editd->main_img)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                     <?php }?>
                                   <input type="file" name="main_img">
                                </div>
                                 @endif
                                <div class="form-group">
                                    <label for="button_contrast_img">Contrast Image</label>
                                    <?php if($editd->button_contrast_img!=''){?>
                                     <img src="{{URL::asset('/storage/'.$editd->button_contrast_img)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                     <?php }?>
                                   <input type="file" name="button_contrast_img">
                                </div>
                                 @if($editd->attri_id == 51)  
                                <div class="form-group">
                                    <label for="left_img">Left Image</label>
                                    <?php if($editd->left_img!=''){?>
                                     <img src="{{URL::asset('/storage/'.$editd->left_img)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                     <?php }?>
                                   <input type="file" name="left_img">
                                </div>
                                
                                <div class="form-group">
                                    <label for="right_img">Right Image</label>
                                    <?php if($editd->right_img!=''){?>
                                     <img src="{{URL::asset('/storage/'.$editd->right_img)}}" style="width:70px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                     <?php }?>
                                   <input type="file" name="right_img">
                                </div>
                                 @endif
                                
                             </div><!-- panel-body -->

                            <div class="panel-footer">
                            <input type="hidden" value="<?php echo $editd->id;?>" name="id">
                              <input type="hidden" value="<?php echo $editd->but_id;?>" name="but_id">
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
