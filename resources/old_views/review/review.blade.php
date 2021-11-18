<?php  $seo = App\Http\Helpers::page_seo_details(29);?>
@include('../layouts.inc.page_header')
@include('../layouts.inc.page_menu')
<body>
<!-- Header End -->
<!-- Service Section End -->
<section class="et-content">
	<div class="container">
  	<div class="row">
      	<div class="et-block">
          	<div class="col-sm-12 col-md-12">
                <div class="add-review-box full-width">
                    <div class="add-title-box">
                        <ul class="nav nav-pills">
                          <li class="active"><a data-toggle="tab" href="#review-text">Text Review</a></li>
                          <li><a data-toggle="tab" href="#review-photo">Photo Review</a></li>
                          <li><a data-toggle="tab" href="#review-video">Video Review</a></li>
                        </ul>
                    </div>
                    <p class="review-heading">Review US/UK Customers </p>
                     <div class="add-review-content-box view-review-content-box full-width add-review-scroll-up">
                        <div class="tab-content">
                           <div id="review-text" class="tab-pane fade in active">
                           
                            @if($data['textcount']>0)
                           
                                  <ul class="reviewrs-ul reviewrs-scroller">
                                  
                                  @foreach($datarev['textrev'] as $textrev)
                                  
                                    <li>
                                        <div class="review-color-box">
                                          <p class="reviewrs-title">Duniya Tailor Review: <?php echo date('d/m/Y', strtotime($textrev->created_at));?> 
                                              <?php $raavg = App\Http\Helpers::reviewperavg($textrev->id);										
											  
											  ?> 
                                              <span class="show-star-rating">
                                              @for($av=0; $av< $raavg['full']; $av++)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                @endfor
                                                <!--<i class="fa fa-star-half-o" aria-hidden="true"></i>-->
                                                 @for($avg=0; $avg< $raavg['blan']; $avg++)
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endfor
                                               </span>
                                         </p>
                                         
                                        
                                         
                                          <p class="reviewrs-comments">{{$textrev->message}} </p>
                                          
                                          @if($textrev->userid!='')
                                          <p class="reviewrs-name">
										  <?php $uname = App\User::select('name','lname','country_id')->where('id','=',$textrev->userid)->first();
										  $countryname = App\Country::get_country_name($uname->country_id);
										  $flagname = App\Country::get_country_flag($uname->country_id);
										  
										  
										  ?>
                                          {{$uname->name}} {{$uname->lname}} <span> @if($countryname!='') ({{$countryname}}) @endif</span> @if($flagname!='') <img src="{{URL::asset('/storage')}}/{{$flagname}}" alt="slider 01" />@endif
                                          </p>
                                         @else
                     <p class="reviewrs-name">
                      <?php $uname = $textrev->user_name;
                      $countryname = App\Country::get_country_name($textrev->country_id);
                      $flagname = App\Country::get_country_flag($textrev->country_id);
                      
                      
                      ?>
                        {{$uname}}  <span>({{$countryname}})</span> <img src="{{URL::asset('/storage')}}/{{$flagname}}" alt="slider 01" />
                                          </p>

                                          @endif
                                        </div>
                                    </li>
                                    
                                    @endforeach
                                    
                                    
                                    
                                  </ul>
                                  @else
                                  <div class="prcenter">Text Review not published yet!</div>
                                  @endif
                             <!-- <button type="button" class="send-review-btn">Send us a link for you review</button>-->
                          </div>
                          <div id="review-photo" class="tab-pane fade">
                           @if($data['imgcount']>0)
                            <div class="col-sm-8 col-sm-offset-2">
                                 <!--*-*-*-*-*-*-*-*-*-*- BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*-->
								
                                
                                
                                
                                
                                
                                
                                <div id="thumbnail_image_carousel" class="carousel thumbnail_image_carousel_fade thumbnail_image_carousel_wrapper review-photo-gallery-wrap" data-ride="carousel" data-interval="6000" data-pause="hover">
								
                                  <!-- Indicators -->
                                  
                                  
                                  <ol class="carousel-indicators thumbnail_image_carousel_indicators indicators-photo-review">
                                     
                                    <?php if($img!=0){?>
                                    
                                    
										  <?php $pt=0;  $tp=0; foreach($dataimgrev as $imgre){
											  
											$pt=$pt+$tp;
											if($tp==0){
												$cls='class="active"';
											}else{
												$cls='';
											}
											
											?>
                                        
                                            @if($imgre->image_fir_thumb!='')
                                                <li data-target="#thumbnail_image_carousel" data-slide-to="<?php echo $pt;?>" <?php echo $cls;?>>
                                                  <img src="{{URL::asset('/storage/'.$imgre->image_fir_thumb)}}" alt="slider 01" />
                                                </li>
                                            @endif
                                            @if($imgre->image_sec_thumb!='')
                                                <li data-target="#thumbnail_image_carousel" data-slide-to="<?php echo $pt=$pt+1;?>">
                                                  <img src="{{URL::asset('/storage/'.$imgre->image_sec_thumb)}}" alt="slider 01" />
                                                </li>
                                            @endif
                                            @if($imgre->image_thr_thumb!='')
                                                <li data-target="#thumbnail_image_carousel" data-slide-to="<?php echo $pt=$pt+1;?>">
                                                  <img src="{{URL::asset('/storage/'.$imgre->image_thr_thumb)}}" alt="slider 01" />
                                                </li>
                                            @endif
                                            @if($imgre->image_fou_thumb!='')
                                                <li data-target="#thumbnail_image_carousel" data-slide-to="<?php echo $pt=$pt+1;?>">
                                                  <img src="{{URL::asset('/storage/'.$imgre->image_fou_thumb)}}" alt="slider 01" />
                                                </li>
                                            @endif
                                            @if($imgre->image_fiv_thumb!='')
                                                <li data-target="#thumbnail_image_carousel" data-slide-to="<?php echo $pt=$pt+1;?>">
                                                  <img src="{{URL::asset('/storage/'.$imgre->image_fiv_thumb)}}" alt="slider 01" />
                                                </li>
                                            @endif
                                            
                                            
                                        <?php $tp++;  }?>
                                    <?php }else{?>
                                    <?php }?>
                                    
                                  </ol>

                                  <!-- Wrapper for slides -->
                                  <div class="carousel-inner" role="listbox">

                                    <!--========= First Slide =========-->
                                    <?php
									$pd=0;
                                    foreach($dataimgrev as $imgrere){
										$pd++;
										
										if($pd==1){
												$clss='active';
											}else{
												$clss='';
											}
										
									?>
                                    
                                     <?php $remsg = App\OrderReview::select('message')->where('id','=',$imgrere->reviewid)->first();?>
                                    
                                        @if($imgrere->image_fir!='')
                                            <div class="item <?php echo $clss;?>">
                                              <img src="{{URL::asset('/storage/'.$imgrere->image_fir)}}" alt="slider 01"  />
                                              <div class="carousel-caption thumbnail_image_carousel_caption">
                                                <p>{{$remsg->message}}</p>
                                              </div>
                                            </div>
                                    	@endif
                                        @if($imgrere->image_sec!='')
                                            <div class="item">
                                              <img src="{{URL::asset('/storage/'.$imgrere->image_sec)}}" alt="slider 01" />
                                              <div class="carousel-caption thumbnail_image_carousel_caption">
                                                <p>{{$remsg->message}}</p>
                                              </div>
                                            </div>
                                    	@endif
                                        
                                        @if($imgrere->image_thr!='')
                                            <div class="item">
                                              <img src="{{URL::asset('/storage/'.$imgrere->image_thr)}}" alt="slider 01" />
                                              <div class="carousel-caption thumbnail_image_carousel_caption">
                                                <p>{{$remsg->message}}</p>
                                              </div>
                                            </div>
                                    	@endif
                                        
                                       @if($imgrere->image_fou!='')
                                            <div class="item">
                                              <img src="{{URL::asset('/storage/'.$imgrere->image_fou)}}" alt="slider 01" />
                                              <div class="carousel-caption thumbnail_image_carousel_caption">
                                                <p>{{$remsg->message}}</p>
                                              </div>
                                            </div>
                                    	@endif
                                        
                                        @if($imgrere->image_fiv!='')
                                            <div class="item">
                                              <img src="{{URL::asset('/storage/'.$imgrere->image_fiv)}}" alt="slider 01" />
                                              <div class="carousel-caption thumbnail_image_carousel_caption">
                                                <p>{{$remsg->message}}</p>
                                              </div>
                                            </div>
                                    	@endif
                                        
									 <?php }?>
                                  </div>

                                  <!--======= Navigation Buttons =========-->

                                  <!--======= Left Button =========-->
                                  <a class="left carousel-control thumbnail_image_carousel_control_left" href="#thumbnail_image_carousel" role="button" data-slide="prev">
                                    <span class="fa fa-chevron-circle-left thumbnail_image_carousel_control_icons" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>

                                  <!--======= Right Button =========-->
                                  <a class="right carousel-control thumbnail_image_carousel_control_right" href="#thumbnail_image_carousel" role="button" data-slide="next">
                                    <span class="fa fa-chevron-circle-right thumbnail_image_carousel_control_icons" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                  </a>

                                </div> <!--*-*-*-*-*-*-*-*-*-*- END BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*-->
                                <div class="indicatorsprev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
                                <div  class="indicatorsnext"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                                <!-- fb icons and btn -->
                                <!--<div class="fb-icon-btn-group">
                                  <img src="img/fb.png">
                                  <p>Become out Fan. <br> Send us suave review <br> Receive 10% Discount</p>
                                  <button type="button" class="send-review-btn">Send us a link for you review</button>
                                </div>-->
                            </div>
                            @else
                                  <div class="prcenter">Photo Review not published yet!</div>
                                  @endif
                            
                          </div>
                          <div id="review-video" class="tab-pane fade">
                          @if($data['videocount']>0 && $video==1)
                          
                            <div class="col-sm-6 col-sm-offset-3">
                            <!-- A wrapper DIV to center the Gallery -->
                                <div style="text-align:center;">
                                
                                <!-- Define the Div for Gallery -->
                                <!-- 1. Add class html5gallery to the Div -->
                                <!-- 2. Define parameters with HTML5 data tags -->
                                    <div style="display:none;margin:0 auto;" class="html5gallery" data-skin="gallery" data-width="580" data-height="320" data-resizemode="fill">
                                    @foreach($datavideorev as $vidpre)
                                        
                                        <!-- Add Youtube video to Gallery -->
                                        <a href="https://www.youtube.com/watch?v={{$vidpre->video}}"><img src="http://img.youtube.com/vi/{{$vidpre->video}}/sddefault.jpg" alt="Youtube Video"></a>
                                        
                                      @endforeach
                                    
                                    </div>
                                
                                </div>
                            <!-- fb icons and btn -->
                            <!-- <button type="button" class="send-review-btn">Send us a link for you review</button>-->
                            </div>
                             @else
                                  <div class="prcenter">Video Review not published yet!</div>
                                  @endif
                            
                          </div>
                        </div>
                     </div> 
                </div>
            </div>
        </div>
      </div><!-- end row -->
    </div>
</section>

<!-- Bootstrap Main JS File -->
	@include('profile.profile-footer')
    
<script type="text/javascript" src="{{asset('asset/js/html5gallery.js')}}"></script>
  

<script type="text/javascript">
/*photo review indicators*/
  $('.review-photo-gallery-wrap .indicators-photo-review li:gt(4)').hide();

  $('.indicatorsprev').click(function() {
      var first = $('.review-photo-gallery-wrap .indicators-photo-review').children('li:visible:first');
      first.prevAll(':lt(5)').show();
      first.prev().nextAll().hide()
  });

  $('.indicatorsnext').click(function() {
      var last = $('.review-photo-gallery-wrap .indicators-photo-review').children('li:visible:last');
      last.nextAll(':lt(5)').show();
      last.next().prevAll().hide();
  });
  /*video review indicators*/
  $('.review-photo-gallery-wrap .video-review-indicators li:gt(4)').hide();

  $('.indicatorsprev').click(function() {
      var first = $('.review-photo-gallery-wrap .video-review-indicators').children('li:visible:first');
      first.prevAll(':lt(5)').show();
      first.prev().nextAll().hide()
  });

  $('.indicatorsnext').click(function() {
      var last = $('.review-photo-gallery-wrap .video-review-indicators').children('li:visible:last');
      last.nextAll(':lt(5)').show();
      last.next().prevAll().hide();
  });

</script>
<!-- review scroll -->
<!-- review scroll -->
<script type="text/javascript">
 var div = $('.reviewrs-scroller');
 var stopint = $('.reviewrs-scroller');
 var intervalDiv = null;
 var intervalDiv = setInterval(function(){
   var pos = div.scrollTop();
   div.scrollTop(pos + 2);
 }, 80);

 $(div).click(function(){
   clearInterval(intervalDiv);
 });

</script>

