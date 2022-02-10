<section class="et-visa-section"><!-- Section Start -->
	<div class="container">
    	<div class="row">
            <div class="et-visa-sec">
               <div class="col-md-6 col-sm-6">
               <div class="left-sil-area">
                <div class="image-sil">
                  <img src="{{asset('/asset/img/sil.png')}}"/>
                </div>
                <div class="need-help">
                 <h4>Need Help? Call Us On: {{setting('site.call_us')}}</h4>
                </div>
               </div>
               </div>

               <div class="col-md-6 col-sm-6">
               <div class="right-pay-area">

                <ul>
                  <li><img width="72px" height="52px" src="{{asset('/asset/img/visa.png')}}"/></li>
                  <li><img width="72px" height="52px" src="{{asset('/asset/img/master-card.png')}}"/></li>
                  <li><img width="72px" height="52px" src="{{asset('/asset/img/amex.png')}}"/></li>
                  <li><img width="72px" height="52px" src="{{asset('/asset/img/paypal.png')}}"/></li>
                  <li><img width="72px" height="52px" src="{{asset('/asset/img/discover.png')}}"/></li>
                </ul>

               </div>
               </div>
            </div>
         </div>
    </div>
</section>

<section class="et-powered"><!-- Section Start -->
	<div class="container">
    	<div class="row">
         <div class="et-linkspow">
            <div class="col-md-5 col-sm-5">
              <div class="et-Copyright"><P>{{ setting('site.Copyright') }}</P></div>
            </div>
             <div class="col-md-3 col-sm-3 etfbklike">
               <?php $fburl =Request::url(); ?>
              {{-- <div class="et-fblike">
                   <iframe src="https://www.facebook.com/plugins/like.php?href={{$fburl}}&width=100&layout=button&action=like&layout=button_count&size=small&show_faces=true&height=65&appId" width="94" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
</div><div class="et-fbshare">
                 <iframe src="https://www.facebook.com/plugins/share_button.php?href={{$fburl}}&layout=button_count&size=small&mobile_iframe=true&width=86&height=20&appId" width="86" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
              </div>
              <div class="et-likshare">
                 <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
                  <script type="IN/Share" data-url="{{$fburl}}" data-counter="right" ></script>
              </div>
              --}}


             </div>
            <div class="col-md-4 col-sm-4">
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
    </div>
</section>

<section class="et-footer">
	<div class="container">
   <div class="row">
     <div class="et-foot">
       @include('../layouts.inc.footer-strkey')
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
	<script type="text/javascript" src="{{asset('asset/js/jquery.picZoomer.js')}}"></script>
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
$(document).ready(function(){
    $(".et-ck-cart-button").click(function(){
        var cc=$("#crtcount").val();
        if(cc==0) { alert("No item in the cart, please add 1");} else{  $(".et-ck-cart-button").attr("href","{{url('/cart')}}");}
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
$("#row-menu ul").addClass("et-responsive-menu");
  $(".et-menu-btn").click(function(){
    $(".et-responsive-menu").toggleClass("show-move");
  });

  $(".et-stuck-navbar").click(function(event){
     event.stopPropagation();
  });

  $("html, body").click(function(event){
      $(".et-responsive-menu").removeClass("show-move");
  });

});
</script>

