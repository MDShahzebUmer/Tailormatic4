@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Add/Edit Review</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 1)
                    <div class="panel-heading">
                            <h3 class="panel-title">Add Review</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                
                                <div class="form-group">
                                  <label for="validity_condition">Review Type</label>
                                  <select name="rtype" id="Review_condition" class="form-control select" required>
                                    <option value="">Select Review Type</option>
                                    <option value="1">Text Review</option>
                                    <option value="2">Photo Review</option>
                                    <option value="3">Video Review</option>                                    
                                  </select>
                                </div> 
                                 
                                 <div class="form-group">
                                    <label for="button_name">Fabric Rate</label>
                                    <select name="fabric_rate" id="fabric_rate" class="form-control select" required> 
                                    <option value="0"  selected >Select Rate</option>                                  
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>                                  
                                	</select>
                                 </div>
                                <div class="form-group">
                                    <label for="button_name">Price Rate</label>
                                    <select name="price_rate" id="price_rate" class="form-control select" required>   
                                    <option value="0"  selected >Select Rate</option>                                   
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>                                  
                                	</select>
                                 </div>
                                 <div class="form-group">
                                    <label for="button_name">Delivery Rate</label>
                                    <select name="delivery_rate" id="delivery_rate" class="form-control select" required>   
                                    <option value="0"  selected >Select Rate</option>                                   
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>                                  
                                	</select>
                                 </div>
                                 <div class="form-group">
                                    <label for="button_name">Fitting Rate</label>
                                    <select name="fitting_rate" id="fitting_rate" class="form-control select" required>  
                                    <option value="0"  selected >Select Rate</option>                                    
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>                                  
                                	</select>
                                 </div>
                                 <div class="form-group">
                                    <label for="user_name">User Name</label>
                                   <input type="text" class="form-control" id="user_name" name="user_name" required>
                                 </div>
                                 <?php $coun_nmae = App\Country::get_country(); ?>
                                 <div class="form-group">
                                    <label for="button_name">Country Name</label>
                                    <select name="country_id" id="country_id" class="form-control select" required>  
                                    
                                    <option value="0"  selected >Select Country</option>  
                                    @foreach($coun_nmae as $cn)
                                    <option value="{{$cn->id}}">{{$cn->name}}</option>                                 
                                    @endforeach                                   
                                  </select>
                                 </div>
                                 
                                 <div class="form-group">
                                    <label for="button_name">Comments Rate</label>
                                   <textarea class="form-control" id="message" name="message"></textarea>
                                 </div>
                              
                                 <div id="imgid">
                                       <div class="form-group">
                                            <label for="button_img">Image.</label>
                                          
                                            <input type="file" name="image_fir" title="Change image">                                       
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="button_img">Image.</label>
                                           
                                            <input type="file" name="image_sec" title="Change image">                                       
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="button_img">Image.</label>
                                           
                                            <input type="file" name="image_thr" title="Change image">                                       
                                        </div>
                                        <div class="form-group">
                                            <label for="button_img">Image.</label>
                                           
                                            <input type="file" name="image_fou" title="Change image">                                       
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="button_img">Image.</label>
                                           
                                            <input type="file" name="image_fiv" title="Change image">                                       
                                        </div>
                                    
                                	</div>
                                    <div id="videoid"> 
                                        <div class="form-group">
                                           
                                             <label for="button_img"> Edit Video ID.</label>
                                            <input type="text" name="video" class="form-control" value="" placeholder="https://www.youtube.com/watch?v=5_07O3G4AoM">                                       
                                        </div>
                                    </div>
                              
                               
                               <div class="form-group">
                                    <label for="button_name">Status</label>
                                    <select name="status" id="status" class="form-control select" required>                                   
                                        <option value="0">Disable</option>
                                        <option value="1">Enable</option>
                                	</select>
                                 </div>
                           </div><!-- panel-body -->
                           <div class="panel-footer">
                                                      
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                        <div class="panel-heading">
                        @foreach($reviewdata as $review)@endforeach
                        
                         	<?php
                            if($review->type==1){
                                 $rtype='Text Review';
							}elseif($review->type==2){
                                $rtype='Photo Review'; 
							}else{
                                 $rtype='Video Review';
							}
							?>	
                        
                        
                          <h3 class="panel-title">Edit {{$rtype}}</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                
                                 <div class="form-group">
                                    <label for="button_name">Fabric Rate</label>
                                    <select name="fabric_rate" id="fabric_rate" class="form-control select" required> 
                                    <option value="0"  selected >Select Rate</option>                                  
                                        <option value="1" @if($review->fabric_rate == 1) selected @endif >1</option>
                                        <option value="2" @if($review->fabric_rate == 2) selected @endif >2</option>
                                        <option value="3" @if($review->fabric_rate == 3) selected @endif >3</option>
                                        <option value="4" @if($review->fabric_rate == 4) selected @endif >4</option>
                                        <option value="5" @if($review->fabric_rate == 5) selected @endif >5</option>
                                  
                                	</select>
                                 </div>
                                <div class="form-group">
                                    <label for="button_name">Price Rate</label>
                                    <select name="price_rate" id="price_rate" class="form-control select" required>   
                                    <option value="0"  selected >Select Rate</option>                                   
                                        <option value="1" @if($review->price_rate == 1) selected @endif >1</option>
                                        <option value="2" @if($review->price_rate == 2) selected @endif >2</option>
                                        <option value="3" @if($review->price_rate == 3) selected @endif >3</option>
                                        <option value="4" @if($review->price_rate == 4) selected @endif >4</option>
                                        <option value="5" @if($review->price_rate == 5) selected @endif >5</option>
                                  
                                	</select>
                                 </div>
                                 <div class="form-group">
                                    <label for="button_name">Delivery Rate</label>
                                    <select name="delivery_rate" id="delivery_rate" class="form-control select" required>   
                                    <option value="0"  selected >Select Rate</option>                                   
                                        <option value="1" @if($review->delivery_rate == 1) selected @endif >1</option>
                                        <option value="2" @if($review->delivery_rate == 2) selected @endif >2</option>
                                        <option value="3" @if($review->delivery_rate == 3) selected @endif >3</option>
                                        <option value="4" @if($review->delivery_rate == 4) selected @endif >4</option>
                                        <option value="5" @if($review->delivery_rate == 5) selected @endif >5</option>
                                  
                                	</select>
                                 </div>
                                 <div class="form-group">
                                    <label for="button_name">Fitting Rate</label>
                                    <select name="fitting_rate" id="fitting_rate" class="form-control select" required>  
                                    <option value="0"  selected >Select Rate</option>                                    
                                        <option value="1" @if($review->fitting_rate == 1) selected @endif >1</option>
                                        <option value="2" @if($review->fitting_rate == 2) selected @endif >2</option>
                                        <option value="3" @if($review->fitting_rate == 3) selected @endif >3</option>
                                        <option value="4" @if($review->fitting_rate == 4) selected @endif >4</option>
                                        <option value="5" @if($review->fitting_rate == 5) selected @endif >5</option>
                                  
                                	</select>
                                 </div>
                                   <div class="form-group">
                                    <label for="user_name">User Name</label>
                                   <input type="text" class="form-control" id="user_name" value="{{$review->user_name}}" name="user_name" required>
                                 </div>
                                 <?php $coun_nmae = App\Country::get_country(); ?>
                                 <div class="form-group">
                                    <label for="button_name">Country Name</label>
                                    <select name="country_id" id="country_id" class="form-control select" required>  
                                    
                                    <option>Select Country</option>  
                                    @foreach($coun_nmae as $cn)
                                    <option value="{{$cn->id}}" @if(isset($coun_nmae) && $review->country_id == $cn->id) selected @endif>{{$cn->name}}
                                       </option>                                   
                                    @endforeach                                   
                                  </select>
                                 </div>
                                 
                                 <div class="form-group">
                                    <label for="button_name">Comments Rate</label>
                                   <textarea class="form-control" id="message" name="message">{{$review->message}}</textarea>
                                 </div>
                               @if($review->type!=1)
                                 
                                     @foreach($reviewimgdata as $reviewimg)@endforeach
                                  
                                  @if($review->type==2)
                                 
                                       <div class="form-group">
                                            <label for="button_img">Image.</label>
                                            @if($reviewimg->image_fir!='')
                                            <img src="{{URL::asset('/storage/'.$reviewimg->image_fir_thumb)}}" style="width:60px">
                                            @endif
                                            <input type="file" name="image_fir" title="Change image">                                       
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="button_img">Image.</label>
                                            @if($reviewimg->image_sec!='')
                                            <img src="{{URL::asset('/storage/'.$reviewimg->image_sec_thumb)}}" style="width:60px">
                                            @endif
                                            <input type="file" name="image_sec" title="Change image">                                       
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="button_img">Image.</label>
                                            @if($reviewimg->image_thr!='')
                                            <img src="{{URL::asset('/storage/'.$reviewimg->image_thr_thumb)}}" style="width:60px">
                                            @endif
                                            <input type="file" name="image_thr" title="Change image">                                       
                                        </div>
                                        <div class="form-group">
                                            <label for="button_img">Image.</label>
                                            @if($reviewimg->image_fou!='')
                                            <img src="{{URL::asset('/storage/'.$reviewimg->image_fou_thumb)}}" style="width:60px">
                                            @endif
                                            <input type="file" name="image_fou" title="Change image">                                       
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="button_img">Image.</label>
                                            @if($reviewimg->image_fiv!='')
                                            <img src="{{URL::asset('/storage/'.$reviewimg->image_fiv_thumb)}}" style="width:60px">
                                            @endif
                                            <input type="file" name="image_fiv" title="Change image">                                       
                                        </div>
                                    
                                	@else
                                    
                                        <div class="form-group">
                                            <label for="button_img">Video.</label>
                                            @if($reviewimg->video!='')
                                            
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $reviewimg->video;?>" frameborder="0" allowfullscreen></iframe>
                                            
                                              <!--<a href="https://www.youtube.com/watch?v=<?php echo $reviewimg->video;?>"><img src="http://img.youtube.com/vi/<?php echo $reviewimg->video;?>/sddefault.jpg" alt="Youtube Video"></a>-->
                                            @endif
                                            <br>
                                             <label for="button_img"> Edit Video ID.</label>
                                            <input type="text" name="video" class="form-control" value="https://www.youtube.com/watch?v={{$reviewimg->video}}">                                       
                                        </div>
                                    
                                    @endif
                                    
                                    <input type="hidden" name="reimgid"  value="{{$reviewimg->id}}">
                                
                               @endif 
                               
                               <div class="form-group">
                                    <label for="button_name">Status</label>
                                    <select name="status" id="status" class="form-control select" required>                                   
                                        <option value="0" @if($review->status == 0) selected @endif >Disable</option>
                                        <option value="1" @if($review->status == 1) selected @endif >Enable</option>
                                	</select>
                                 </div>
                           </div><!-- panel-body -->
                           <div class="panel-footer">
                           <input type="hidden" name="id"  value="{{$review->id}}">
                           <input type="hidden" name="rtype"  value="{{$review->type}}">
                           
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
$(document).ready(function(){
  $('#imgid').hide();
  $('#videoid').hide();
  
    $('#Review_condition').change(function(){
      var Review_condition = $(this).val();
      //$('#cat_div').hide();
      if(Review_condition == 2)
       {
       
         $('#imgid').show();
  		$('#videoid').hide();
       }else if(Review_condition == 3)
       {
        $('#imgid').hide();
  		$('#videoid').show();
       }
      
       else{
        $('#imgid').hide();
        $('#videoid').hide();       
       }

    });
    
        
    
});
</script>


<script>
	$('document').ready(function () {
		$('.toggleswitch').bootstrapToggle();
	});
</script>
<script src="{{ config('voyager.assets_path') }}/lib/js/tinymce/tinymce.min.js"></script>
<script src="{{ config('voyager.assets_path') }}/js/voyager_tinymce.js"></script>
@stop
