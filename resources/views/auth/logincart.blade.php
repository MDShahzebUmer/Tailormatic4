<?php  $seo = App\Http\Helpers::page_seo_details(21);?>
@include('layouts.inc.header-sub')
<body class="designshirt">  
<!-- Product Section Start Here -->
<section class="pt-bg">
    <div class="container">
        <div class="row">
            <div class="pt-top-menu">
                <div class="pt-left-p">
                    @include('../layouts.inc.login')
                </div>
            </div>
        </div>
    </div>
    <?php
        $cartcount = App\Http\Helpers::cartcount();
        ?>
    <div class="pt-design">       
        <div class="container">
            <div class="row">
                <div class="pt-cart-header et-fw et-reg-title">
                    <div class="pt-cart-title et-left">
                        <h1>Login</h1>
                    </div>
                    <div class="pt-button-block et-right">
                         <ul>
                                <li><a class="pt-cart-btn" href="{{url('/cart')}}"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> &nbsp; Cart <span class="cart-span">{{$cartcount}}</span></a> </li>
                                <li><a class="pt-cart-btn" href="{{url('/')}}">Continue Shopping</a></li>
                            </ul>
                    </div>
                </div>
            </div>
            <!-- cart Login -->
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="et-form-style et-cart-form-style">
                        <div class="et-form-inner">
                            <form class="" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">Email Address :</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email Address">
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
                                <a href="{{ url('/password/reset') }}" class="et-empty-btn">Forgot Password</a>
                            </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Login</button> 
                                </div>                       
                                <div class="">
                                    <label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> keep me signed in.</label>
                                </div>
                                <div class="login-boder"style="text-align:center;margin-bottom:10px;">
                                <span >New to E-tailor ?</span>
                                </div>
                            </form>
                            <div class="et-extra-block">
                              <a href="{{ url('/register') }}" class="btn btn-default ragister-btn">Create your E-tailor Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    
    <div class="pt-footer cart-page-footer">
        <div class="container">
            <div class="row">
                <div class="pt-foot-ul">
                   @include('../layouts.inc.footer-strkey') 
                </div>   
            </div>
        </div>   
</div>
</section>

<div class="modal fade et-fabric-modal" id="fabric-id" tabindex="-1" role="dialog" aria-labelledby="fabric-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-body">
                <figure class="et-fabric-big">
                    <img src="img/Fabric/41m.jpg" alt="">
                </figure>
            </div>
        </div>
    </div>
</div>

<!--Product Section End Here-->

    <script type="text/javascript" src="js/float-panel.js"></script>
    <script type="text/javascript" src="js/responsive_bootstrap_carousel.js"></script>
    <script type="text/javascript" src="js/jquery.touchSwipe.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-touch-slider.js"></script>
    <script type="text/javascript">
        $( '#et-banner' ).bsTouchSlider();
    </script>
    
    
</body>
</html>
