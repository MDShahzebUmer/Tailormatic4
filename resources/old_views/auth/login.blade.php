<?php  $seo = App\Http\Helpers::page_seo_details(21);?>
@include('layouts.inc.header-sub')
<body class="login-page et-bg">
<div class="et-form-page">
    <div class="container">
        <div class="row">           
            <div class="et-form-header">
                <figure class="et-form-logo">
                    <a href="#.">
                        <img src="{{asset('storage/')}}/{!! setting('site.logo') !!}" alt="eTailor Logo">
                    </a>
                </figure>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="et-form-style">
                    <div class="et-form-inner">
                        <form class="" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email Address :</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email Address">
                                <input type="hidden" class="form-control" id="ids" name="ids" value="1">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="pwd">Password :</label>
                                <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter Password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                                <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>

                                    </span>

                                @endif
                                <a href="{{ url('/password/reset') }}" class="et-empty-btn">Forgot Password?</a>

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Login</button> 
                            </div>  
                            <br> 
                            <div class="form-group">
                            <a href="{{ url('/register') }}"><button type="button" class="btn btn-default">Don't have an account? Register now</button>
                            </a>  
                            </div> 

                            <!-- <div class="checkbox">
                                <label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> kepp me signed in.</label>
                            </div> -->
                        </form>
                        <!-- <div class="et-extra-block">
                            <a href="{{ url('/register') }}" class="btn btn-default ragister-btn">"Create your e-Tailor account"</a>
                          
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        {!! NoCaptcha::renderJs() !!}
<!-- Bootstrap Main JS File -->
    <script type="text/javascript" src="{{asset('asset/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset/js/bootstrap.min.js')}}"></script>
    <!-- Bootstrap bootstrap-touch-slider Slider Main JS File -->
    <script type="text/javascript" src="{{asset('asset/js/float-panel.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset/js/responsive_bootstrap_carousel.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset/js/jquery.touchSwipe.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset/js/bootstrap-touch-slider.js')}}"></script>
    <script type="text/javascript">
        $( '#et-banner' ).bsTouchSlider();
    </script>
     <!-- Bootstrap Side Menu JS File -->
    <script type="text/javascript">
        $(document).ready(function () {
          var trigger = $('.hamburger'),
              overlay = $('.overlay'),
             isClosed = false;
        
            trigger.click(function () {
              hamburger_cross();      
            });
        
            function hamburger_cross() {
        
              if (isClosed == true) {          
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
              } else {   
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
              }
          }
          
          $('[data-toggle="offcanvas"]').click(function () {
                $('#et-wrapper').toggleClass('toggled');
          });  
        });
        $('.navbar-nav > li').mouseover( function(){
            $(this).find('a').tab('show');
        });
        $('.navbar-nav > li').mouseout( function(){
            $(this).find('a').tab('hide');
        });
    </script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function(e) {
            $("[id^='lst_']").hover(function(e) {
                var colr=$(this).attr('id');
                var orgcolr=colr.replace('lst_','').trim();
                var bgc={'red':'fullimage1.jpg','black':'fullimage2.jpg','blue':'fullimage3.jpg','green':'fullimage4.jpg','cyan':'fullimage5.jpg'};
                //alert(bgc[orgcolr]);
                $("body").css('background-image','url('+bgc[orgcolr]+')');
                $("body").css('background-repeat','no-repeat');
            });
        });
    </script>
    <script type="text/javascript">
   $('.et-top').click(function(){
      $("html, body").animate({ scrollTop: 0 }, 600);
      return false;
   });
   
</script>
<script language="javascript">
        $(document).ready(function() {
            $("input[name$='etform']").click(function() {
                var test = $(this).val();
        
                $("div.et-hide").hide();
                $("#Cars" + test).show();
            });
        });
    </script>
</body>
</html>