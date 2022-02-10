<?php  $slider = $data['slider'];
    //print_r($slider);
 ?>
<section id="et-slider" class="et-home-slider"><!-- Slider Section Start -->
    <div class="container-xl">
        <div class="row shahzeb">
            <div id="et-banner" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="false" >
                <!-- Indicators -->
                <ol class="carousel-indicators">
                <?php
					$dp=0;
					foreach($slider as $sid){
				?>
                    <li data-target="#et-banner" data-slide-to="<?php echo $dp;?>" <?php if($dp==0){?>class="active"<?php }?>></li>
                 <?php $dp++; }?>
                </ol>
                <div class="carousel-inner" role="listbox"><!-- Wrapper For Slides -->
                   @foreach($slider as $s)
                    <div @if($loop->first) class="item banner-slide-div banner-slide-{{$s->id}} active" @else class="item banner-slide-div banner-slide-{{$s->id}}" @endif ><!-- First Slide -->
                        <!-- Slide Background -->
                        <img src="{{asset('/storage/')}}/{{$s->image}}" alt="{{$alt_name}}"  class="slide-image"/>
                        <!-- Slide Text Layer -->
                        <div class="et-slide-review">
                            @include('../layouts.inc.rating')
                        </div>
                        <div class="slide-text slide_style_left">
                            {!! $s->body !!}
                       <a href="{{ $s->tab_url_one }}" class="et-btn et-btn-default">{!! $s->tab_one !!}</a>
                            <a href="{{ $s->tab_url_two }}" class="et-btn et-btn-default">{!! $s->tab_two !!}</a>
                        </div>
                    </div><!-- End of Slide -->



                   @endforeach

                </div><!-- End of Wrapper For Slides -->
            </div>
        </div>
    </div>
</section><!-- Slider Section End -->
