<?php  $seo = App\Http\Helpers::page_seo_details(20);?>
@include('layouts.inc.header-sub')
<body class="register-page designshirt">
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
                        <div class="pt-cart-title et-left ">
                            <h1>Registration</h1>
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
                   <div class="col-md-8 col-md-offset-2">
                        <div class="et-form-style et-cart-form-style">
                            <div class="et-form-inner">
                                <form class="" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}
                            <div class="et-form-hlf et-hide" id="Cars2">
                                <h4>For New User</h4>
                                <div class="form-group et-form-name {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="name"  placeholder="Enter First Name" >
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group et-form-name {{ $errors->has('lname') ? ' has-error' : '' }}">
                                    <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname"  placeholder="Enter Last Name" >
                                    @if ($errors->has('lname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group et-form-email {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">Email Address</label>&nbsp; <area id="ems"></area>
                                    <input type="email" class="form-control" id="emailcheck" name="email" data-token="{{ csrf_token() }}"  placeholder="Enter E-mail Address">
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong id="ems">{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group et-form-address {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address">Address</label>
                                    <textarea type="text" class="form-control" name="address" id="address"  placeholder="Enter Address"></textarea>
                                    @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group et-form-city {{ $errors->has('landmark') ? ' has-error' : '' }}">
                                    <label for="city">LandMark</label>
                                    <input type="text" class="form-control" id="landmark" name="landmark"  placeholder="Enter Landmark">
                                    @if ($errors->has('landmark'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('landmark') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group et-form-city {{ $errors->has('city') ? ' has-error' : '' }}">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city"  placeholder="Enter City">
                                    @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <?php $countrys = App\Country::get_country();?>
                                <div class="form-group et-form-country {{ $errors->has('country_id') ? ' has-error' : '' }}">
                                    <label for="country">Select Country</label>
                                    <select class="selectpicker form-control" id="country" name="country_id" >
                                        <option selected>Select Country</option>
                                        @foreach($countrys as $c)
                                        <option id="{{ $c->phonecode }}" value="{{$c->id}}">{{$c->name}}</option>
                                       @endforeach
                                    </select>
                                    @if ($errors->has('country_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country_id') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group et-form-state {{ $errors->has('state') ? ' has-error' : '' }}">
                                    <label for="state">Select State</label>
                                    <select class="selectpicker form-control" id="state" name="state" >
                                    </select>
                                    @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group et-form-city {{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                    <label for="zip">Zip Code</label>
                                    <input type="text" class="form-control" id="zipcode" name="zipcode"  placeholder="Enter Zip Code" >
                                     @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                    @endif
                                    <div class="msg"></div>
                                </div>
                                <div class="form-group et-form-phone {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="phone">Telephone</label>
                                    <div class="row" style="display: flex;
                                    margin-left: 3px;">
                                        <select name="country_code" id="country-code" class="form-control" style="width: 80px" >
                                            <option value="">code</option>
                                        </select>
                                        <input type="text" class="form-control" id="phone" name="phone"  placeholder="Enter Telephone Number" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                    </div>
                                    @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <div class="form-group has-feedback  {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="pwd">Password(character limit between 6 to 16)</label>
                                    <input type="password" class="form-control" id="pwd" name="password"  placeholder="Enter Password" maxlength="12" minlength="6">

                                    <i id="pwdshow" style="right: 15px !important;" onclick="changePassword(this)" class="glyphicon  glyphicon-eye-open form-control-feedback"></i>
                                    <i id="pwdclows" style="display:none; right: 15px !important; " onclick="changePassword(this)" class="glyphicon  glyphicon-eye-close form-control-feedback"></i>


                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="cpwd">Confirm Password</label>
                                    <input type="password" class="form-control" id="cpwd" name="password_confirmation"  placeholder="Enter Confirm Password" maxlength="12" minlength="6">

                                    <i id="pwdshoww" style="right: 15px !important; pointer-events: initial;" onclick="changeConfirmPassword(this)" class="glyphicon  glyphicon-eye-open form-control-feedback"></i>
                                    <i id="pwdclowss" style="display:none; right: 15px !important; pointer-events: initial;" onclick="changeConfirmPassword(this)" class="glyphicon  glyphicon-eye-close form-control-feedback"></i>

                                    @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <script type="text/javascript">
                                    function changePassword(t){
                                        if(document.querySelector('input[name="password"]').getAttribute('type') == 'password'){
                                            document.querySelector('input[name="password"]').setAttribute('type','text');
                                            document.querySelector('i[id="pwdshow"]').style.display = 'none';
                                            document.querySelector('i[id="pwdclows"]').style.display = 'block';
                                            return 0;
                                        }
                                        document.querySelector('input[name="password"]').setAttribute('type','password');
                                            document.querySelector('i[id="pwdclows"]').style.display = 'none';
                                            document.querySelector('i[id="pwdshow"]').style.display = 'block';
                                        return 0;
                                    }
                                    function changeConfirmPassword(t){
                                        if(document.querySelector('input[name="password_confirmation"]').getAttribute('type') == 'password'){
                                            document.querySelector('input[name="password_confirmation"]').setAttribute('type','text');
                                            document.querySelector('i[id="pwdshoww"]').style.display = 'none';
                                            document.querySelector('i[id="pwdclowss"]').style.display = 'block';
                                            return 0;
                                        }
                                        document.querySelector('input[name="password_confirmation"]').setAttribute('type','password');
                                            document.querySelector('i[id="pwdclowss"]').style.display = 'none';
                                            document.querySelector('i[id="pwdshoww"]').style.display = 'block';
                                        return 0;
                                    }
                                </script>

                            </div>
                            <div class="et-form-hlf et-hide" id="Cars3" style="display: none;">
                                <h4>Shpping Address</h4>
                                <div class="form-group et-form-name">
                                    <label for="sfname">First Name</label>
                                    <input type="text" class="form-control" id="sfname" name="sfname"  placeholder="Enter First Name">
                                    @if ($errors->has('sfname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sfname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group et-form-name">
                                    <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="slname" name="slname"  placeholder="Enter Last Name">

                                </div>
                                <div class="form-group et-form-address ">
                                    <label for="address">Address</label>
                                    <textarea type="text" class="form-control" id="saddress"  name="saddress"  placeholder="Enter Address"></textarea>

                                </div>
                                <div class="form-group et-form-city ">
                                    <label for="slandmark">Landmark</label>
                                    <input type="text" class="form-control" id="slandmark" name="slandmark"  placeholder="Enter Landmark">

                                </div>
                                <div class="form-group et-form-city ">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="scity" name="scity"  placeholder="Enter City">

                                </div>

                                <div class="form-group et-form-country ">
                                    <label for="country">Select Country</label>
                                    <select class="selectpicker form-control" id="scountry_id" name="scountry_id">
                                        <option selected>Select Country</option>
                                        @foreach($countrys as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                       @endforeach
                                    </select>

                                </div>
                                <div class="form-group et-form-country ">
                                    <label for="country">Select State</label>
                                    <select class="selectpicker form-control" id="sstate" name="sstate">
                                        <option selected>Select Country</option>
                                      </select>

                                </div>
                                <div class="form-group et-form-city ">
                                    <label for="zip">Zip Code</label>
                                    <input type="text" class="form-control" id="szipcode" name="szipcode" onkeypress='return event.charCode >= 46 && event.charCode <= 57'  placeholder="Enter Zip Code">
                                    <div class="msg"></div>
                                </div>
                                <div class="form-group et-form-phone ">
                                    <label for="phone">Telephone</label>
                                    <input type="text" class="form-control" id="sphone" name="sphone" onkeypress='return event.charCode >= 46 && event.charCode <= 57' placeholder="Enter Telephone Number">

                                </div>
                            </div>
                            <div class="choiceoption">
                                <div class="et-left">
                                    <label>Make a Shipping Address</label>
                                    <ul>
                                        <li><input type="radio" name="etform" checked="checked" value="2"  /> Yes</li>
                                        <li><input type="radio" name="etform" value="3" /> No</li>
                                    </ul>
                                </div>
                                <div class="et-right">
                                    <button type="submit" class="btn btn-default">Continue</button>
                                </div>
                            </div>
                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Section -->
       <div class="pt-footer">
        <div class="container">
            <div class="row">
                <div class="pt-foot-ul">
                   @include('../layouts.inc.footer-strkey')
               </div>
           </div>
       </div>
   </div>
    </section>

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
        <script>
    $('#country').change(function(){
    var country = $(this).val();
    var country_code = $(this).find(':selected').attr('id')
    $("#country-code").append('<option selected value="'+country_code+'">'+country_code+'</option>');
    // console.log(country_code);

    if(country){
        $.ajax({
           type:"GET",
           url:"{{ route('address.getstate') }}/"+country,
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
  <script>
    $('#scountry_id').change(function(){
    var country = $(this).val();
    // var tel_id = $(this).attr("data-id");
    // $("#country-code").append('<option selected value="'+tel_id+'">'+tel_id+'</option>');

    if(country){
        $.ajax({
           type:"GET",
           url:"{{ route('address.getstate') }}/"+country,
           success:function(res){
            if(res){
                $("#sstate").empty();
                $("#sstate").append('<option value="">Select</option>');
                $.each(res,function(key,value){
                  //alert(res[key]['id'])
                    $("#sstate").append('<option value="'+res[key]['id']+'">'+res[key]['name']+'</option>');
                });

            }else{
               $("#sstate").empty();
            }
           }
        });
    }else{
        $("#sstate").empty();

    }
   });
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
    <script language="javascript">
        $(document).ready(function() {
            $("input[name$='etform']").click(function() {
                var test = $(this).val();

                $("div.et-hide").hide();
                $("#Cars" + test).show();
            });
        });
    </script>
    <script type="text/javascript">
    $('#emailcheck').on('blur',function(){
     var ids = $(this).val();
      var token = $('#emailcheck').data("token");
       $.ajax(
        {
            url: "register/check_emails/"+ids,
            type: 'POST',
            dataType: "JSON",
            data: {
                "id": ids,
                "_method": 'POST',
                "_token": token,
            },
            success: function (data)
            {

               var ert  = "<sapn>Already a Member? <a href={{url('/logincart')}}>Login Here</a></span>";
              $("#ems").html(ert);

            },
            error: function(data)
            {
                $("#errorMessage").html("INVALID COUPAN");
            }
        });
  });
    </script>


    <script type="text/javascript">

    $('form').submit(function(){
        //$('.help-block').remove();
        var rad = $('input:radio:checked').val();
        var flag = 0;
        if(rad=='2'){

            $('#Cars2 input,#Cars2 select,#Cars2 textarea').each(function(){
                if($.trim($(this).val()) == '' || $.trim($(this).val()) =='Select Country' || $.trim($(this).val()) =='Select'){

                    $(this).css('border-color','#a94442');
                    flag = 1;
                    //$(this).parent().append('<span class="help-block">This field is .</span>');
                }else{

                    if($(this).attr('id') == 'country'){
                        var country = $('#Cars2 #country option:selected').text();
                        if($.trim(country) != 'Select Country'){
                            $(this).css('border-color','#cccccc');
                            checkValidateZip(country,'Cars2','zipcode');
                        }else{
                            $(this).css('border-color','#a94442');
                            flag = 1;
                        }

                    }else{

                        $(this).css('border-color','#cccccc');
                        //$(this).parent().find('.help-block').remove();
                    }
                  if($(this).attr('id') == 'emailcheck' && !validateEmail($(this).val())){
                            $(this).css('border-color','#a94442');
                            flag = 1;
                        }


                }
            })
        }else{
            $('#Cars3 input,#Cars3 select,#Cars3 textarea').each(function(){
                if($.trim($(this).val()) == ''  || $.trim($(this).val()) == 'Select Country' || $.trim($(this).val()) == 'Select'){
                    flag = 1;
                    $(this).css('border-color','#a94442');
                    //$(this).parent().append('<span class="help-block">This field is .</span>');
                }else{

                    if($(this).attr('id') == 'scountry_id'){
                        var country = $('#Cars3 #scountry_id option:selected').text();
                        if($.trim(country) != 'Select Country'){
                            $(this).css('border-color','#cccccc');
                            checkValidateZip(country,'Cars3','szipcode');
                        }else{
                            $(this).css('border-color','#a94442');
                            flag = 1;
                        }
                    }else{
                        $(this).css('border-color','#cccccc');
                        //$(this).parent().find('.help-block').remove();
                    }


                }
            })
        }

        if(flag == '1'){
            return false;
        }

    });

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test($email);
}

    function checkValidateZip(country,div_id,zip_id){
        $('#'+div_id+' #'+zip_id).next('.msg').text('');
        var zipcode = $('#'+div_id+' #'+zip_id).val();
        var url = "https://maps.googleapis.com/maps/api/geocode/json?address="+country;

        $.getJSON(url, function(response) {

              $.each(response.results,function(i,v){
                    var c_code = v.address_components[0].short_name;
                    $.ajax({
                        type:"POST",
                        url:"{{url('/')}}/get_regular_expression.php",
                        data:{zipcode:zipcode,c_code:c_code},
                        success: function(msg){
                            if(msg=='false'){
                               $('#'+div_id+' #'+zip_id).next('.msg').text("ZIP / Postal Field Value Is Invalid.");
                                $('#'+div_id+' #'+zip_id).val($.trim($("#zipcode").val()));
                                //$('#'+div_id+' #zipcode').focus();
                                $('#'+div_id+' #'+zip_id).css('border-color','#a94442');
                                return false;
                            }else{
                                $('#'+div_id+' #'+zip_id).css('border-color','#cccccc');
                            }
                            return msg;
                        }
                    });

                });
       });
    }


    </script>
</body>
</html>
