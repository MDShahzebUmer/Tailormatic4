@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title"><i class="voyager-data"></i>Contrasts Collar Design</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 'edit')    
                  
                    <div class="panel-heading">
                            <h3 class="panel-title">Edit "{{$optdata}}" Contrast Image</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                               @if($maindata->opt_id==14 || $maindata->opt_id==15 || $maindata->opt_id==20)
                            <?php $style = App\AttributeStyle::select('*')->where('id', '=', $maindata->sub_type_id)->first($maindata->sub_type_id);?>
                                
                                <div class="form-group">
                                    <label for="sub_type_id">Style List</label>
                                    <input type="text" name="" value="{{$style->style_name}}"  class="form-control" readonly>
                                    <input type="hidden" name="sub_type_id" value="{{$style->id}}">
                                </div>
                                @else
                                    <input type="hidden" name="sub_type_id" value="0">
                                @endif
                                    @if($maindata->opt_id==14 || $maindata->opt_id==15)
                                        @php $atid=20; $showt=1; $stnamee='Lapel'; @endphp
                                    @elseif($maindata->opt_id==16)
                                        @php $atid=37; $showt=1; $stnamee='Pocket'; @endphp
                                     @elseif($maindata->opt_id==17)
                                        @php $atid=19; $showt=1; $stnamee='Button'; @endphp
                                     @elseif($maindata->opt_id==19)
                                        @php $atid=37; $showt=1; $stnamee='Pocket'; @endphp
                                    @elseif($maindata->opt_id==20)
                                        @php $atid=36; $showt=1; $stnamee='Buttons Vest Style';  @endphp
                                    @elseif($maindata->opt_id==21)
                                        @php $atid=52; $showt=1; $stnamee='Belt Loop Style';  @endphp 
                                     @elseif($maindata->opt_id==22)
                                        @php $atid=51; $showt=1; $stnamee='Back Pockets Style';  @endphp    
                                     @else
                                      @php $atid=0; $showt=0; @endphp
                                    @endif
                                
                                    @if($showt==1)
                                    <?php $lapel = App\AttributeStyle::select('*')->where('id', '=', $maindata->main_type_id)->first($maindata->main_type_id); ?>
                                    <div class="form-group">
                                        <label for="main_type_id">{{$stnamee}} Style List</label>
                                        <input type="text" name="" value="{{$lapel->style_name}}" class="form-control" readonly>
                                  	   <input type="hidden" name="main_type_id" value="{{$lapel->id}}">
                                                                         
                                    </div>
                                    @else
                                        <input type="hidden" name="main_type_id" value="0">
                                    @endif
                                

                                 <div class="form-group">
                                        <input type="hidden" name="opt_id" value="{{$maindata->opt_id}}">
                                        <input type="hidden" name="contrast_id" value="{{$maindata->contrast_id}}">
                                        <input type="hidden" name="id" value="{{$maindata->id}}">
                                 </div>
                                
                               <div class="form-group">
                                    <label for="front_img">Front Image.</label>
                                    @if($maindata->front_img!='')
                                     <img src="{{URL::asset('/storage/'.$maindata->front_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                     @endif
                                  <input type="file" name="front_img">
                                </div>
                                <?php if($maindata->opt_id  == 22) { $names = "Right Back Img"; }else {$names = "Back Img" ;} ?>
                                <div class="form-group">
                                    <label for="back_img"><?php echo $names; ?></label>
                                      @if($maindata->back_img!='')
                                     <img src="{{URL::asset('/storage/'.$maindata->back_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                     @endif
                                  <input type="file" name="back_img">
                                </div>
                                 @if($maindata->opt_id == 22)
                                 <div class="form-group">
                                    <label for="back_left">Left Back.</label>
                                     @if($maindata->back_left !='' )
                                     <img src="{{URL::asset('/storage/'.$maindata->back_left)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                     @endif
                                  <input type="file" name="back_left">
                                </div>
                                @else
                                <div class="form-group">
                                    <label for="join_img">Joind Image.</label>
                                     @if($maindata->join_img!='')
                                     <img src="{{URL::asset('/storage/'.$maindata->join_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                     @endif
                                  <input type="file" name="join_img">
                                </div>
                                @endif
                           </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                         <div class="panel-heading">
                         
                            <h3 class="panel-title">Add "{{$optdata}}" Contrast Image</h3>
                        </div>
                        
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                          
                             <div class="panel-body">
                               @if($optid==14 || $optid==15 || $optid==20)
                            <?php 
                            if($optid==14 || $optid==15){
                                $atidd=19;
                                $sttxt='Button';
                            }else{
                                $atidd=20;
                                $sttxt='Neck';
                            }

                            $style = App\AttributeStyle::select('*')->where('attri_id', '=', $atidd)->get(); ?>
                                <div class="form-group">
                                    <label for="sub_type_id">{{$sttxt}} Style List</label>
                                   <select name="sub_type_id" id="sub_type_id" class="form-control select" required>
                                        @if(!empty($style))
                                         @foreach($style as $sty)
                                         <option value="{{$sty->id}}">{{$sty->style_name}}</option>
                                       @endforeach
                                       @endif
                                    </select>                                  
                                </div>
                                @else
                                <input type="hidden" name="sub_type_id" value="0">
                                @endif
                                    @if($optid==14 || $optid==15)
                                        @php $atid=20; $showt=1; $stnamee='Lapel'; @endphp
                                    @elseif($optid==16)
                                        @php $atid=22; $showt=1; $stnamee='Pocket';  @endphp
                                    @elseif($optid==17)
                                        @php $atid=19; $showt=1; $stnamee='Button';  @endphp
                                    @elseif($optid==19)
                                        @php $atid=37; $showt=1; $stnamee='Pocket';  @endphp    
                                    @elseif($optid==20)
                                        @php $atid=36; $showt=1; $stnamee='Buttons Vest Style';  @endphp
                                     @elseif($optid==21)
                                        @php $atid=52; $showt=1; $stnamee='Belt Loop Style';  @endphp
                                      @elseif($optid==22)
                                        @php $atid=51; $showt=1; $stnamee='Back Pockets Style';  @endphp
                                     @else
                                      @php $atid=0; $showt=0; @endphp
                                    @endif
                                
                                    @if($showt==1)
                                    <?php $lapel = App\AttributeStyle::select('*')->where('attri_id', '=', $atid)->get(); ?>
                                    <div class="form-group">
                                        <label for="main_type_id"> {{$stnamee}} List</label>
                                       <select name="main_type_id" id="main_type_id" class="form-control select" required>
                                            @if(!empty($lapel))
                                             @foreach($lapel as $lap)
                                             <option value="{{$lap->id}}">{{$lap->style_name}}</option>
                                           @endforeach
                                           
                                        </select>                                  
                                    </div>
                                    @else
                                     <input type="hidden" name="main_type_id" value="0">
                                    @endif
                                @endif

                                 <div class="form-group">
                          	<input type="hidden" name="opt_id" value="{{$optid}}">
                            <input type="hidden" name="contrast_id" value="{{$contsid}}">
                                 </div>
                                
                               <div class="form-group">
                                    <label for="front_img">Front Image.</label>
                                  <input type="file" name="front_img">
                                </div>
                                
                               <?php if($optid == 22) { $names = "Right Back Img"; }else {$names = "Back Img" ;} ?>
                               
                                <div class="form-group">
                                    <label for="back_img"><?php echo $names?></label>
                                  <input type="file" name="back_img">
                                </div>
                                
                                @if($optid == 22)
                                <div class="form-group">
                                    <label for="back_left">Left Back.</label>
                                  <input type="file" name="back_left">
                                </div>
                                 @else
                                <div class="form-group">
                                    <label for="join_img">Joind Image.</label>
                                  <input type="file" name="join_img">
                                </div>
                                @endif
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
