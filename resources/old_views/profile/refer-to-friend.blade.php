<?php  $seo = App\Http\Helpers::page_seo_details(9);?>
@include('../layouts.inc.page_header')
@include('../layouts.inc.page_menu')
@include('../layouts.inc.section_div')
<section class="et-content">
	<div class="container">
    	<div class="row">
          <div class="col-sm-12">
              <div class="et-sub-title et-fw">
                <h2>Refer To Friend</h2> 
              </div>
            </div>
        	<div class="et-block">
            	<div class="col-sm-3 st-pro-leftbar">
                <div class="et-account-left-box">
                    @include('../layouts.inc.profile-menu')
                </div> 
              </div>
              <div class="col-md-9 dt-responsive st-pro-content-wrap">

                @if ($reffriend = Session::get('reffriend'))
                <div class="alert alert-success alert-block">
                 <button type="button" class="close" data-dismiss="alert">×</button> 
                 <strong>{{ $reffriend }}</strong>
               </div>
               @endif
                  <div class="contact-box full-witdh edit-profile-form">
                      <form class="" role="form" method="POST" action="{{ url('/myaccount/refertofriend/') }}">
                        {{ csrf_field() }}
                          <div class="row">
                              
                              <div class="col-sm-6">
                                  <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                  <label for="fName">Full Name:</label>
                                    <input class="input__field input__field--hoshi" type="text"  id="name" placeholder="Full Name" name="name" >
                                  </div>
                                  @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif

                              </div>
                              
                              <div class="col-sm-6">
                                  <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                  <label for="phone">Mobile No :</label>
                                    <input class="input__field input__field--hoshi" type="text"  id="phone" placeholder="Mobile No" name="phone" >
                                  </div>
                                  @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif

                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                  <label for="email">Friend Email :</label>
                                    <input class="input__field input__field--hoshi" type="text" id="email" placeholder="Friend Email" name="email" >
                                  </div>
                                  @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                                  <label for="mNumber">Message : </label>
                                    <textarea class="input__field input__field--hoshi" type="text" id="message" placeholder="Message" name="message" ></textarea>
                                  </div>
                                  @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              
                              
                          </div>
                          <div class="row">
                              <div class="col-sm-12 text-right">
                                  <div class="form-group">
                                   
                                    <button type="submit" class="et-btn et-btn2" id="any">Send</button> 
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
