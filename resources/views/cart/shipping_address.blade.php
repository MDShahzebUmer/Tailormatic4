<?php  $seo = App\Http\Helpers::page_seo_details(18);?>
@include('layouts.inc.header-sub')
<body class="register-page  designshirt">
  <section class="et-form-page">
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
    <div class="container">
      <div class="row">
        <div class="pt-cart-header et-fw et-reg-title">
          <div class="pt-cart-title et-left ">
            <h1>Shipping</h1>
          </div>
          <div class="et-step-progress">
            <ul class="et-step-list">
              <li class="et-prog-step et-clear">
                <span class="step-num">1</span>
                <span class="step-nam">Cart</span>
              </li>
              <li class="et-prog-step  et-clear">
                <span class="step-num">2</span>
                <span class="step-nam">Shipping</span>
              </li>
              <li class="et-prog-step active">
                <span class="step-num">3</span>
                <span class="step-nam">Checkout</span>
              </li>
              <li class="et-prog-step last">
                <span class="step-num">4</span>
                <span class="step-nam">Payment</span>
              </li>
            </ul>
          </div>
          <div class="pt-button-block et-right">
            <ul>
              <li><a class="pt-cart-btn" href="{{url('/cart')}}"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> &nbsp; Cart <span class="cart-span">{{$cartcount}}</span></a> </li>
              <li><a class="pt-cart-btn" href="{{url('/')}}">Continue Shopping</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
       <div class="col-md-8 col-md-offset-2">
         <div class="et-form-style">
           <div class="et-form-inner">                    	
            <form class="" role="form" method="POST" action="{{ url('/shipping-address') }}">
             {{ csrf_field() }}
             <div class="et-form-hlf et-custom-scrollbar et-hide" id="Cars2">
              <div style="min-height:300px">
                <h4>Select Shipping Address</h4>

                @foreach($address as $sa)
                <div class="form-group et-address-block selected">
                  <div class="radio @if($loop->first) enable-pointer @endif" >
                    <label style="margin-bottom:10px;">
                      <input type="radio" name="shipping_id" value="{{$sa->id}}"  @if($loop->first) checked @endif>
                      <span class="cr"><i class="cr-icon"></i></span>
                      <b>{{$sa->sfname}}&nbsp;{{$sa->slname}}</b>
                      {{$sa->saddress}},
                      &nbsp;{{$sa->scity}},
                      &nbsp;{{$sa->szipcode}},
                      &nbsp;{{$sa->sname}},
                      &nbsp;{{$sa->cname}},
                      &nbsp;{{$sa->sphone}}
                    </label>
                    <a href="" title="Edit Address" ></a> 
                    <a href="{{route('shipping-address.edit')}}/{{$sa->id}}" disabled="disabled" class="btn-sm btn-info disbled-pointer" >
                      <i class="fa fa-edit" aria-hidden="true"></i>Edit</a> 
                    </div>
                  </div>
                  @endforeach

                </div>
                <div style="clear:both">
                  <div class="et-right">
                    @if(Auth::check() && App\ShippingsAddr::where('user_id', Auth::id())->first())
                      <button type="submit" class="btn btn-default">Continue</button> 
                    @endif
                  </div> 
                </div>
              </div>
            </form>
            <form class="" role="form" method="POST" action="{{ url('/shipping-address') }}">
             {{ csrf_field() }}
             <div class="et-form-hlf et-hide" id="Cars3" style="display: none;">
              <h4>Shipping Address</h4>
              <div class="form-group et-form-name">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" id="sfname" name="sfname" required placeholder="Enter First Name">
                <input type="hidden" class="form-control" id="shipping_id" value="">
              </div>
              <div class="form-group et-form-name">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="slname" name="slname" required placeholder="Enter Last Name">
              </div>
              <div class="form-group et-form-address">
                <label for="address">Address</label>
                <textarea type="text" class="form-control" id="saddress" name="saddress" required placeholder="Enter Address"></textarea>
              </div>
              <div class="form-group et-form-address">
                <label for="address">LandMark</label>
                <textarea type="text" class="form-control" id="slandmark" name="slandmark" required placeholder="Enter Address"></textarea>
              </div>
              <div class="form-group et-form-city">
                <label for="city">City</label>
                <input type="text" class="form-control" id="scity" name="scity" required placeholder="Enter City"  >
              </div>                            
              <div class="form-group et-form-city">
                <label for="zip">Zip Code</label>
                <input type="text" class="form-control" id="szip" name="szipcode" onkeypress='return event.charCode >= 46 && event.charCode <= 57'  required placeholder="Enter Zip Code" maxlength="6" minlength="4">
              </div>
              <?php $cont = App\Country::get_country();?>
              <div class="form-group et-form-country">
                <label for="country">Select Country</label >
                  <select class="selectpicker form-control" id="scountry_id"  name="scountry_id" required>
                    <option selected>Select Country</option>
                    @foreach($cont as $c)
                    <option  value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                  </select>
                </div> 
                <div class="form-group et-form-country ">
                  <label for="country">Select State</label>
                  <select class="selectpicker form-control" id="sstate" name="sstate" required>
                    <option selected>State</option>
                  </select>

                </div>  
                <div class="form-group et-form-phone">
                  <label for="phone">Telephone</label>
                  <input type="text"   class="form-control" id="phone" name="sphone" onkeypress='return event.charCode >= 46 && event.charCode <= 57' required placeholder="Enter Telephone Number" maxlength="11" minlength="10">
                </div>
                <div style="clear:both">
                  <div class="et-right">
                    <button type="submit" class="btn btn-default">Continue</button> 
                  </div>
                </div>
              </div>
            </form>
            <div class="choiceoption">   
             <div class="et-left">
              <ul>
                <li id="ad-active1" class="add-active">
                  <div class="radio">
                    <label id="adtoggle1">
                      <input type="radio" name="etform" checked="checked" value="2">
                      <span class="cr"><i class="cr-icon"></i></span>
                      Existing Address
                    </label>
                  </div>
                </li>
                <li id="ad-active2">
                  <div class="radio">
                    <label id="adtoggle2">
                      <input type="radio" name="etform" value="3">
                      <span class="cr"><i class="cr-icon"></i></span>
                      Add New Address 
                    </label>

                  </div>

                </li>
                <li><strong>(Shipping charges based on country of delivery.)</strong></li>
              </ul>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</div><!-- Model Radio -->
      <div class="modal fade send-link-modal" id="sendProductLink" tabindex="-1" role="dialog" 
      aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">
              Send Product Link Your Friend 
            </h4>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">

            <form class="" role="form" method="POST" action="{{ url('/sendlink/') }}">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control"
                id="exampleInputEmail1" placeholder="Enter Email" name="user_email" required>
                <input type="hidden" name="proID" value="" required>
              </div>
              <button type="submit" class="et-btn cart-btn send-btn">Submit</button>
            </form>    
          </div>
        </div>
      </div>
      </div>
<!-- End Radio -->
<div class="pt-footer">
  <div class="container">
    <div class="row">
      <div class="pt-foot-ul">
       @include('../layouts.inc.footer-strkey')
     </div>   
   </div>
 </div>   
</div>
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
$('#adtoggle1').click( function() {
    $("#ad-active1").addClass( "add-active" );
	$("#ad-active2").removeClass( "add-active" );
} );

$('#adtoggle2').click( function() {
    $("#ad-active2").addClass( "add-active" );
	$("#ad-active1").removeClass( "add-active" );
} );
</script>
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
                //alert(test);
                $("div.et-hide").hide();
                $("#Cars" + test).show();

              });

});
</script>
<script>
$('#scountry_id').change(function(){
  var scountry = $(this).val();   
        //alert(scountry); 
        if(scountry){
          $.ajax({
           type:"GET",
           url:"{{ route('shipping-address.getstate') }}/"+scountry,
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
<script type="text/javascript">
//$("input[type=radio]:checked").click(function(){
  //$(this).attr('checked');
//});

$('input[name="shipping_id"]').on('change', function() {
   $("input[type=radio]").parent().parent().removeClass("enable-pointer");
   $("input[type=radio]:checked").parent().parent().addClass("enable-pointer");
});
//$("input[type=radio]:checked").parent().parent().addClass("enable-pointer");    </script>
<script language="javascript">
$(document).ready(function () {  
	$('textarea').toggleClass(function() {
	  if ($(this).parent().is('.expandingArea')) {
		return $(this).parent().addClass('open');
	  } else {
		return $(this).parent().removeClass('open');
	  }
	});
});
</script>
</body>
</html>