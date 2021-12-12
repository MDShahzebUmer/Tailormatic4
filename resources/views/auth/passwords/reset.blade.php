<?php  $seo = App\Http\Helpers::page_seo_details(22);?>
@include('layouts.inc.header-sub')
<body class="login-page et-bg">
<div class="et-form-page">
    <div class="container">
        <div class="row">
            <div class="et-form-header">
                <figure class="et-form-logo">
                    <a href="#.">
                       <img src="{{asset('storage/')}}/{!! setting('site.logo') !!}" alt="{{ setting('site.site_image_name') }}">
                    </a>
                </figure>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="et-form-style">
                    <div class="et-form-inner">
                        <form class="" role="form" method="POST" action="{{ url('/password/reset') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email Address :</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $email }}" placeholder="Enter Email Address">

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
                            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="pwd">Confirm Password :</label>
                                <input type="password" class="form-control" id="pwd" name="password_confirmation" placeholder="Enter Password">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-default"> Reset Password</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
