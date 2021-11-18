<?php  $seo = App\Http\Helpers::page_seo_details(28);?>
@include('../layouts.inc.page_header')
@include('../layouts.inc.page_menu')
@include('../layouts.inc.section_div')
<section class="et-content">
	<div class="container">
    	<div class="row">
          <div class="col-sm-12">
              <div class="et-sub-title et-fw">
                <h2>Change Password</h2> 
              </div>
            </div>
        	<div class="et-block">
            	<div class="col-md-3 st-pro-leftbar">
                <div class="et-account-left-box">
                  <ul class="user-frofile-list">
                        @include('../layouts.inc.profile-menu')
                  </ul>
                </div> 
              </div>
              <div class="col-md-9 dt-responsive st-pro-content-wrap">
                    @if ($profile = Session::get('password'))
                <div class="alert alert-success alert-block">
                 <button type="button" class="close" data-dismiss="alert">×</button> 
                 <strong>{{ $profile }}</strong>
               </div>
               @endif
                  <div class="contact-box change-password-box full-witdh edit-profile-form">
                      <form class="" role="form" method="POST" action="{{ url('/myaccount/passwordchange') }}">
                          {{ csrf_field() }} 
                          <div class="row">
                            <div class="col-sm-6">
                                  <div class="form-group  {{ $errors->has('password') ? ' has-error' : '' }}">
                                  <label for="nPassword">New Password : </label>
                                    <input class="input__field input__field--hoshi" type="password" id="nPassword" placeholder="New Password" name="password">
                                  </div>
                                  @if ($errors->has('password'))
                                  <span class="help-block">
                                  	<strong>{{ $errors->first('password') }}</strong>
                                  </span>
                                  @endif
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                  <label for="confirm">Confirm : </label>
                                    <input class="input__field input__field--hoshi" type="password" id="confirm" placeholder="Confirm" name="password_confirmation">
                                  </div>
                                  
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-6 text-left">
                                  <div class="form-group">
                                    <button class="et-btn et-btn2" type="submit" id="any" >Update</button> 

                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
        </div>
    </div>
</section>
@include('../profile.profile-footer')
</body>
</html>