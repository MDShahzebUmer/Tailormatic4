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
         
            @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
            <div class="col-md-4 col-md-offset-4">
              
                <div class="et-form-style">
                    <div class="et-form-inner">
                       <form  role="form" method="POST" action="{{ url('/password/email') }}">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Reset Passwords :</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email Address">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            

                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Send Password Reset Link</button> 
                            </div>                       
                            
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Main JS File -->

</body>
</html>