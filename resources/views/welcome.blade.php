<?php  $seo = App\Http\Helpers::page_seo_details(32);?>

<style>
@media only screen and (min-width: 0px) and (max-width: 992px){
    #mibew-agent-button {
        display: none !important;
    }
    .et-testimonials .gp_products_carousel_wrapper {
        overflow: hidden !important;
    }
    #et-header .et-logo {
        width: 95% !important;
    }
    #et-header .et-logo > .top-logo {
        background-color: #ffffff00 !important;
        border: none;
        width: 100px !important;
        height: 100px !important;
    }
    /* ---------------- menu -------------------------- */
    #et-header .hamburger {
        top: -25px;
        right: -20px;
        transform: scale(0.4);
    }
    .hamburger .hamb-1,
    .hamburger .hamb-4,
    .hamburger .hamb-7 {
        width: 42px !important;
        height: 7px;
    }

    .et-navbar .navbar-nav {
        background-color: #ffffff !important;
        max-width: 200px !important;
    }

    #sidebar-wrapper ul a, #sidebar-wrapper ul span {
        color: #242424 !important;
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 0.2rem;
    }

    #sidebar-wrapper .et-tab-content ul a {
        text-align: end;
    }
    #et-wrapper .et-tab-content .tab-pane.active {
        background-color: #efefef !important;
    }
    .et-nav-content:before {
        background: -webkit-linear-gradient(right, rgb(20 14 10 / 23%) 0, rgb(16 11 8 / 9%) 20%, rgb(10 7 5 / 0%) 50%, rgba(0, 0, 0, .06) 100%) !important;
    }
    .et-nav-content:after {
        background: none !important;
    }

    #et-wrapper .et-tab-content {
        width: 100%;
        float: left;
        padding-right: 200px !important;
    }

    .et-navbar .navbar-nav>li>a>img {
        top: 11px;
    }
    #et-wrapper .et-tab-content .tab-pane,
    .et-nav-content {
        min-height: 685px;
    }
    #sidebar-wrapper {
        background:none !important;
    }
    .et-navbar .navbar-nav > li > a {
        padding: 10px 15px 10px 30px !important;
        height: 55px;
        align-items: center;
        display: flex !important;
    }

    .et-serivces {
        padding:0px !important;
    }
    .et-serivces .customer-service-w{
        display:none;
    }
    /* ---------------- rating (five star) ------------ */
    .et-slide-review ul>li>span {
        color: #ffd407 !important;
    }
    /* ---------------- home banner ------------------- */


    .bs-slider{
        max-height: 850px !important;
    }
    .banner-slide-div img {
        max-width: 300% !important;
        height: auto !important;
    }
    .banner-slide-1 img {
        width: 200% !important;
        transform: translate(-15%, 0%) !important;
    }
    .banner-slide-2 img {
        width: 185% !important;
        transform: translate(-28%, 0%) !important;
    }
    .banner-slide-3 img {
        width: 270% !important;
        transform: translate(-30%, 0%) !important;
    }
    .banner-slide-4 img {
        width: 270% !important;
        transform: translate(-37%, 0%) !important;
    }
    .banner-slide-5 img {
        width: 270% !important;
        transform: translate(-33%, 0%) !important;
    }
    .banner-slide-6 img {
        width: 200% !important;
        transform: translate(-40%, 0%) !important;
    }
    .banner-slide-div .slide-text{
        display: grid;
    }
    .banner-slide-div .slide-text > h2>span,
    .banner-slide-div .slide-text > h2 {
        color: #f70303 !important;
        text-shadow: 0px 1px 3px #ffffff;
        margin: auto !important;
    }
    .banner-slide-div .slide-text > h1>span {
        color: #ffffff !important;
    }
    .banner-slide-div .slide-text > .et-btn-default {
        background-color: #4d372f87 !important;
        opacity: 0 !important;
    }

    .banner-slide-div.active .et-btn-default {
        opacity: 1 !important;
        -webkit-transition: opacity ease-in-out 2s;
        -moz-transition: opacity ease-in-out 2s;
        -ms-transition: opacity ease-in-out 2s;
        -o-transition: opacity ease-in-out 2s;
        transition: opacity ease-in-out 2s;
    }

    .et-call-back>h2, .et-call-back>span>a {
        color: #b38d7f !important;
    }
    .et-effect h2{
        font-size: 30px !important;
        text-shadow: 3px -1px 1px #000 !important;
    }

}
@media only screen and (min-width: 333px) and (max-width: 667px){

    .banner-slide-div .slide-text{
        top: 50% !important;
    }
    .banner-slide-div .slide-text > h2>span,
    .banner-slide-div .slide-text > h2 {
        font-size: 35px !important;
    }
    .banner-slide-div .slide-text > .et-btn-default {
        margin: 5px 20% !important;
        font-size: 20px !important;
    }
}
@media only screen and (min-width: 0px) and (max-width: 332px){

    .banner-slide-div .slide-text{
        top: 40% !important;
    }
    .banner-slide-div .slide-text > h2>span,
    .banner-slide-div .slide-text > h2 {
        font-size: 25px !important;

    }
    .banner-slide-div .slide-text > .et-btn-default {
        margin: 1px 25% !important;
        font-size: 12px !important;
    }
}
</style>
<section class="centering-body">
<section class="body">
@include('layouts.inc.header')
@include('layouts.inc.slider')
<section class="et-serivces" ><!-- Service Section Start -->
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
    <div class="container customer-service-w">
        <div class="row">
            <div class="et-call-back et-fw">
                <h2 class="et-left">CUSTOMER SERVICE 24/7</h2>
                {{-- <span class="et-right"><a href="mailto:">{{ setting('site.web_email') }}</a></span> --}}
                @php
                    $soc = App\Socialicon::all();
                @endphp
                <div class="et--link">
                    <ul>
                        @foreach($soc as $s)
                        <li><a href="{{$s->url}}" target="_blank"><i class="fa fa-{{$s->name}}" aria-hidden="true" ></i></a></li>
                        @endforeach
                    </ul>
                </div>
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

               <div class="col-md-8 col-sm-8">
                <div class="box-top">

                </div>

                <div class="box-bottom mt-10" style="margin-top: 50px">
                 <div class="col-md-6">
                      <?php $i4 = App\Http\Helpers::img_font_call(3); ?>

                     <div class=" et-effect et-last">
                         {{-- <img src="{{asset('/storage'.$i4->img)}}" alt="{{$alt_name}}" /> --}}
                         <img style="height: 321px" src="//www.duniyatailor.com/storage/FrontProductImg/8.jpg" alt="{{$alt_name}}" />
                         {{-- <img src="{{asset('/storage/')}}" alt="" /> --}}
                          <a href="/design3pcsuits">
                             <figcaption>
                                 <h2>3 Piece Suit</h2>
                                 <p>
                                    {{-- {!! $i4->title_two !!}
                                     <span>${{$i4->rate}}</span> --}}
                                 </p>
                             </figcaption>
                         </a>
                     </div>
                 </div>

                 <div class="col-md-6">
                     <?php $i5 = App\Http\Helpers::img_font_call(4); ?>
                     <div class="et-effect et-last">
                          {{-- <img src="{{asset('/storage'.$i5->img)}}" alt="{{$alt_name}}" /> --}}
                          <img src="//www.duniyatailor.com/storage/FrontProductImg/9.png" alt="{{$alt_name}}" />
                          <a href="/design2pcsuits">
                             <figcaption>

                                 <h2>2 Piece Suit</h2>
                                 <p>
                                    {{-- {!! $i5->title_two !!}
                                     <span>${{$i5->rate}}</span> --}}
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
            <div class="et-main-title et-fw et-On" style="color: #fff">
                {{-- {!! setting('site.section_heading_three') !!} --}}
            </div>
            <?php $about = $data['about']; //print_r($about);?>
            @foreach($about as $ab) @endforeach
            <div class="et-main-Online">
                <div class="col-md-6 col-sm-6">
                  <div class="et-abt">
                    <h2>{!! $ab->title !!}</h2>
                    <P style="color: #d9d9d9">{!! $ab->excerpt !!}</P>

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
</section>

</section>
