<?php  $seo = App\Http\Helpers::page_seo_details(25);?>
@include('../layouts.inc.page_header')
@include('../layouts.inc.page_menu')
@include('../layouts.inc.section_div')
	<div class="container">
    	<div class="row">
          <div class="col-sm-12">
              <div class="et-sub-title et-fw">
                <h2>Edit Profile</h2> 
              </div>
            </div>
        	<div class="et-block">
            	<div class="col-sm-3 st-pro-leftbar">
                <div class="et-account-left-box">
                    @include('../layouts.inc.profile-menu')
                </div> 
              </div>
              <div class="col-md-9 dt-responsive st-pro-content-wrap">
                @include('../layouts.inc.profile-menu-responsive')
                @if ($profile = Session::get('profile'))
                <div class="alert alert-success alert-block">
                 <button type="button" class="close" data-dismiss="alert">×</button> 
                 <strong>{{ $profile }}</strong>
               </div>
               @endif
                  <div class="contact-box full-witdh edit-profile-form">
                      <form class="" role="form" method="POST" action="{{ url('/myaccount/edit/') }}">
                        {{ csrf_field() }}
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                  <label for="fName">First Name : </label>
                                    <input class="input__field input__field--hoshi" type="text" id="name"  placeholder="first Name" name="name" value="{{$data->name}}">
                                  </div>
                                  @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                  <label for="fName">Last Name : </label>
                                    <input class="input__field input__field--hoshi" type="text" id="lname"  placeholder="Last Name" name="lname" value="{{$data->lname}}">
                                  </div>
                                  
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                  <label for="fName">Mobile No : </label>
                                    <input class="input__field input__field--hoshi" type="text"  id="phone" placeholder="Mobile No" name="phone" value="{{$data->phone}}">
                                  </div>
                                  @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif

                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                  <label for="address">Address : </label>
                                    <input class="input__field input__field--hoshi" type="text" id="address" placeholder="Address" name="address" value="{{$data->address}}">
                                  </div>
                                  @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                  <label for="mNumber">LandMark : </label>
                                    <input class="input__field input__field--hoshi" type="text" id="landmark" placeholder="Land Mark" name="landmark" value="{{$data->landmark}}">
                                  </div>
                                  @if ($errors->has('landmark'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('landmark') }}</strong>
                                    </span>
                                    @endif
                              </div>

                              <div class="col-sm-6">
                                  <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                  <label for="address">Zipcode : </label>
                                    <input class="input__field input__field--hoshi" type="text" id="zipcode" placeholder="Zipcode" name="zipcode" value="{{$data->zipcode}}" maxlength="6">
                                  </div>
                                  @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              
                          </div>
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                  <label for="mNumber">Select Country : </label>
                                  <?php $countrys = App\Country::get_country(); ?>
                                   <select class="selectpicker input__field input__field--hoshi" id="country" name="country_id" required>
                                        <option selected>Select Country</option>
                                        @foreach($countrys   as $c)
                                        <option value="{{$c->id}}" @if(isset($countrys) && $data->country_id == $c->id) selected @endif>{{$c->name}}</option>
                                       @endforeach
                                    </select>
                                  </div>
                                  @if ($errors->has('country_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country_id') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              
                              <div class="col-sm-6">
                                  <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                  <label for="address">Select State : </label>
                                  <select class="selectpicker input__field input__field--hoshi" id="state" name="state" >
                                   <option value="{{$data->state}}"> <?php echo App\State::get_state_name($data->state)?></option>
                                    </select>
                                    
                                  </div>
                                  @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              
                          </div>
                          <div class="row">
                              <div class="col-sm-12 text-right">
                                  <div class="form-group">
                                   
                                    <button type="submit" class="et-btn et-btn2" id="any">Update</button> 
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
  <script>
    $('#country').change(function(){
    var country = $(this).val();   
     
    if(country){
        $.ajax({
           type:"GET",
           url:"{{ route('myaccount.getstate') }}/"+country,
           success:function(res){               
            if(res){
                $("#state").empty();
                $("#state").append('<option value="">Select</option>');
                $.each(res,function(key,value){
                  
                    $("#state").append('<option value="'+res[key]['id']+'">'+res[key]['name']+'</option>');
                });
           
            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
       
    }      
   });
  </script>
</body>
</html>
