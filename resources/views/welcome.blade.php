<?php  $seo = App\Http\Helpers::page_seo_details(32);?>
@include('layouts.inc.header')
@include('layouts.inc.slider')
<section class="et-serivces"><!-- Service Section Start -->
    <div class="et-stuck-navbar">
        <div class="et-fix-nav float-panel">
            <div class="container">
               <div class="row" id="row-menu">

                   <button class="et-menu-btn"><i class="fa fa-bars" aria-hidden="true"></i></button>
                        {!! TCG\Voyager\Models\Menu::display('page_menu') !!}
                 </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="et-call-back et-fw">
                <h2 class="et-left">CUSTOMER SERVICE 24/7</h2>
                <span class="et-right"><a href="mailto:">{{ setting('site.web_email') }}</a></span>
            </div>
        </div>
    </div>
</section><!-- Service Section End -->
<section class="et-testimonials" style="background-image:url({{asset('/asset/img/testimonials-bg.jpg')}});"><!-- Section Start -->
    <div class="container">
        <div class="row">
            <div class="et-main-title et-fw">
                {!! setting('site.section_heading_one') !!}
            </div>
            <?php $client = $data['client']; //print_r($client); ?>

            <div class="et-post-slider et-fw">
                <div id="et-testimonial" class="carousel slide gp_products_carousel_wrapper" data-ride="carousel" data-interval="2000">
                    <!--========= Wrapper for slides =========-->
                    <div class="carousel-inner" role="listbox">
                        <!--========= 1st slide =========-->

                        <?php
						$u=count($client);
						$ip=0;
						?>
                        @foreach($client as $t)
                        <?php //for($i=1; $i<=$u; $i++){
							$ip++;
							if($ip==1){
								$ll='<div class="item active">';
							}else{
								$ll='';
							}

							if($ip%2==0 && $ip!=$u){
								$bb='</div><div class="item">';
							}else{
								$bb='';
							}


						?>

                        <?php echo $ll;?>
                           <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="et-client-block">
                                    <div class="et-client-image">
                                        <img src="{{asset('/storage/')}}/{{$t->image}}" alt="{{$alt_name}}"  />
                                    </div>
                                    <div class="et-client-caption">
                                        <h5>{{$t->name}}</h5>
                                        <p>{{$t->content}}</p>
                                        <ul>
                                            <li><img src="{{asset('/storage/')}}/{{$t->country_flag}}" alt="{{$alt_name}}" ></li>
                                            <li>{{$t->country_name}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php echo $bb;?>
                         @endforeach
                         </div>

                    </div>
                    <!--======= Navigation Buttons =========-->

                    <!--======= Left Button =========-->
                    <a class="left carousel-control gp_products_carousel_control_left" href="#et-testimonial" role="button" data-slide="prev">
                        <span class="fa fa-angle-left gp_products_carousel_control_icons" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>

                    <!--======= Right Button =========-->
                    <a class="right carousel-control gp_products_carousel_control_right" href="#et-testimonial" role="button" data-slide="next">
                        <span class="fa fa-angle-right gp_products_carousel_control_icons" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>
            </div>
        </div>
    </div>
</section><!-- Section End -->
<section class="et-collection">
    <div class="container">
        <div class="row">
            <?php $i1 = App\Http\Helpers::img_font_call(1); ?>
            <div class="et-grid-style Collectionsec">
               <div class="col-md-4 col-sm-4">
                <div class="col-md-12">
                    <div class="et-effect et-square">
                        <img src="{{asset('/storage'.$i1->img)}}" alt="{{$alt_name}}" />
                          <a href="{{Url('/'.$i1->url)}}">
                        <figcaption>

                                <h2>{!! $i1->title_one !!}</h2>
                                <p>
                                   {!! $i1->title_two !!}
                                    <span>${{$i1->rate}}</span>
                                </p>

                        </figcaption></a>
                    </div>
                </div>
                <div class="col-md-12">
                     <?php $i2 = App\Http\Helpers::img_font_call(2); ?>
                    <div class="et-effect et-port">
                        <img src="{{asset('/storage'.$i2->img)}}" alt="{{$alt_name}}" />
                         <a href="{{Url('/'.$i2->url)}}">
                            <figcaption>
                                <h2>{!! $i2->title_one !!}</h2>
                                <p>
                                   {!! $i2->title_two !!}
                                    <span>${{$i2->rate}}</span>
                                </p>
                            </figcaption>
                        </a>
                    </div>
                </div>
               </div>

               <div class="col-md-8 col-sm-8">
               <div class="box-top">

               </div>
               <div class="box-bottom">
                <div class="col-md-6">
                     <?php $i4 = App\Http\Helpers::img_font_call(4); ?>
                    <div class="et-effect et-last">
                        <img src="{{asset('/storage'.$i4->img)}}" alt="{{$alt_name}}" />
                         <a href="{{Url('/'.$i4->url)}}">
                            <figcaption>
                                <h2>{!! $i4->title_one !!}</h2>
                                <p>
                                   {!! $i4->title_two !!}
                                    <span>${{$i4->rate}}</span>
                                </p>
                            </figcaption>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php $i5 = App\Http\Helpers::img_font_call(5); ?>
                    <div class="et-effect et-last">
                         <img src="{{asset('/storage'.$i5->img)}}" alt="{{$alt_name}}" />
                         <a href="{{Url('/'.$i5->url)}}">
                            <figcaption>

                                <h2>{!! $i5->title_one !!}</h2>
                                <p>
                                   {!! $i5->title_two !!}
                                    <span>${{$i5->rate}}</span>
                                </p>
                            </figcaption>
                        </a>
                    </div>
                </div>
               </div>
               </div>
            </div>
        </div>
    </div>
</section><!-- Collection Section End -->
<section class="et-world" style="background-image: url({{asset('/asset/img/girl-bg.jpg')}});background-repeat:no-repeat;"><!-- Section Start -->
    <div class="container">
        <div class="row">
            <div class="et-main-title et-fw">
                {!! setting('site.section_heading_two') !!}
            </div>

            <div class="et-main-count">
                <div class="col-md-3 col-sm-3 et-f1">
                    <div class="et-upper-box">
                        <div class="et-inner-box">
                              <h3>{!! setting('site.customers_served') !!}</h3>
                        </div>
                        <div class="et-dim-title">
                         <h4>CUSTOMERS SERVED</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 et-f2">
                    <div class="et-upper-box">
                        <div class="et-inner-box">
                           <h3>{!! setting('site.countries_shipped') !!}</h3>
                        </div>
                        <div class="et-dim-title">
                         <h4>COUNTRIES SHIPPED</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 et-f3">
                    <div class="et-upper-box">
                        <div class="et-inner-box">
                           <h3>{!! setting('site.fabric_choices') !!}</h3>
                        </div>
                        <div class="et-dim-title">
                         <h4>FABRIC CHOICES</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 et-f4">
                    <div class="et-upper-box">
                        <div class="et-inner-box">
                             <h3>{!! setting('site.facebook_fan') !!}</h3>
                        </div>
                        <div class="et-dim-title">
                         <h4>FACEBOOK FANS</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="et-Online"><!-- Section Start -->
    <div class="container">
        <div class="row">
            <div class="et-main-title et-fw et-On">
                {!! setting('site.section_heading_three') !!}
            </div>
            <?php $about = $data['about']; //print_r($about);?>
            @foreach($about as $ab) @endforeach
            <div class="et-main-Online">
                <div class="col-md-6 col-sm-6">
                  <div class="et-abt">
                    <h2>{!! $ab->title !!}</h2>
                    <P>{!! $ab->excerpt !!}</P>

                   <div class="et-default-read"> <a href="{{url('pages/about-us')}}" class="et-btn et-btn-default">Read More</a> </div>
                  </div>
                </div>

                <div class="col-md-6 col-sm-6">
                  <div class="et-abt-slide">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
                            </ol>
                            <div class="carousel-inner">

                                <div class="item active">
                                    <div class="dot-border"><div class="fill" style="background: url({{asset('/asset/img/slide-abt.jpg')}});"></div></div>
                                </div>
                                <div class="item">
                                    <div class="dot-border"><div class="fill" style="background: url({{asset('/asset/img/slide-abt.jpg')}});"></div></div>
                                </div>
                                <div class="item">
                                    <div class="dot-border"><div class="fill" style="background: url({{asset('/asset/img/slide-abt.jpg')}});"></div></div>
                                </div>
                             </div>
                        </div>
                    </div>
                 </div>
             </div>
         </div>
    </div>
</section>
<?php $soc =  $data['soc'];?>
@include('layouts.inc.footer')
