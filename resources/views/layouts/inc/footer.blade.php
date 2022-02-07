<!-- Start News Letter -->
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
                 <h4>Need Help? Call Us On: {{ setting('site.call_us') }}</h4>
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

<section class="et-sign-up"><!-- Section Start -->
    <div class="container">
        <div class="row">
         <div class="et-sign-sec">
           <div class="et-sign-left">
             <h2>SIGN UP FOR NEWSLETTER</h2><a name="news"></a>
             <P>Get exclusive deals you wont find any where else straight to your inbox</P>
           </div>
           <div class="et-sign-right">
            @if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
 <button type="button" class="close" data-dismiss="alert">×</button>
       <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
 <button type="button" class="close" data-dismiss="alert">×</button>
       <strong>{{ $message }}</strong>
</div>
@endif
            <!-- {!! Form::open(array('route' => 'subscribe')) !!}
              <div class="input-box">
               <input class="eet-sub-email" name="email" type="email" id="email"  placeholder="Enter E-mail Address">
              </div>
              <div class="input-box et-Subscribe">
               <input type="submit" value="Subscribe"/>
              </div>
             {!! Form::close() !!} -->
             <!-- Begin Mailchimp Signup Form -->
<div id="mc_embed_signup">
<form style="display:flex;" action="https://lskit.us20.list-manage.com/subscribe/post?u=a11ea5af6ce297ee8e5962c4d&amp;id=abaced5eb4" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div class="input-box" id="mc_embed_signup_scroll">
	<!-- <h2>Subscribe</h2>
<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
<div class="mc-field-group">
	<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
</label> -->
	<input type="email" value="" name="EMAIL" class="eet-sub-email required email " id="mce-EMAIL" placeholder="Enter your email">
</div>
	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_c6c222550f8e71f3bdb82f8b7_65f089b56b" tabindex="-1" value=""></div>
    <div class="input-box et-Subscribe clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>

<!--End mc_embed_signup-->
           </div>

         </div>
       </div>
    </div>
</section>
<!-- Newsletter -->
<!-- FOOTER -->
<section class="et-footer-links"><!-- Section Start -->
    <div class="container">
        <div class="row">
         <div class="et-links">
            <div class="col-md-4 col-sm-3">
             <div class="et-in-link">
               <h2>Custom Clothing</h2>
               <ul>
                 <li><a href="{{url('/designshirts')}}">Custom Shirts</a></li>
                 <li><a href="{{url('/designjackets')}}">Custom Jackets</a></li>
                 <li><a href="{{url('/designvests')}}">Custom Vests</a></li>
                 <li><a href="{{url('/designpants')}}">Custom Pants</a></li>


               </ul>
             </div>
            </div>
            {{-- <div class="col-md-3 col-sm-3">
             <div class="et-in-link">
             <h2>Why Duniya Tailor</h2>
               <ul>
                 <li><a href="{{url('/ecollection')}}/{{1}}">Collection Shirts</a></li>
                 <li><a href="{{url('/ecollection/2')}}">Collection Jackets</a></li>
                 <li><a href="{{url('/ecollection/3')}}">Collection Vests</a></li>
                 <li><a href="{{url('/ecollection/4')}}">Collection Pants</a></li>

               </ul>
             </div>
            </div> --}}
            <div class="col-md-4 col-sm-3">
             <div class="et-in-link">
               <h2>Customer Care</h2>
               <ul>
                 <li><a href="{{url('pages/faq')}}">FAQ’S</a></li>
                 <li><a href="{{url('pages/how-we-work')}}">How We Work</a></li>
                 <li><a href="{{url('pages/contact-us')}}">Contact Us</a></li>
                 <li><a href="{{url('pages/delivery')}}">Delivery</a></li>
                 <li><a href="{{url('pages/privacy-policy')}}">Privacy Policy</a></li>
                 {{-- <li><a href="{{url('/b2b')}}">B2B / Reseller</a></li> --}}

               </ul>
             </div>
            </div>
            <div class="col-md-4 col-sm-3">
             <div class="et-in-link">
               <h2>About Us</h2>
               <ul>
                 <li><a href="{{url('pages/about-us')}}">Company</a></li>
                 <li><a href="{{url('review')}}">Review</a></li>
                 <li><a href="{{url('pages/terms-and-conditions')}}">Terms & Conditions</a></li>
                 <li><a href="{{url('pages/return-and-refund-policy')}}">Returns Policy</a></li>
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
              <div class="et-fblike">
                   <iframe src="https://www.facebook.com/plugins/like.php?href={{$fburl}}&width=100&layout=button&action=like&layout=button_count&size=small&show_faces=true&height=65&appId" width="94" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
</div><div class="et-fbshare">
                 <iframe src="https://www.facebook.com/plugins/share_button.php?href={{$fburl}}&layout=button_count&size=small&mobile_iframe=true&width=86&height=20&appId" width="86" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
              </div>
              <div class="et-likshare">
                 <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
                  <script type="IN/Share" data-url="{{$fburl}}" data-counter="right" ></script>
              </div>



             </div>
            <div class="col-md-4 col-sm-4">

             <div class="et--link">

               <ul>
<li class="st-follows-us">FOLLOW US</li>
                @foreach($soc as $s)
                 <li >
                     <a href="{{$s->url}}" target="_blank">
                        <i class="fa fa-{{$s->name}}" aria-hidden="true" ></i></a></li>
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
         @include('layouts.inc.footer-desgin')
         {{-- @include('layouts.inc.footer-strkey') --}}
        </div>
            </div>
           </div>
</section>
<div class="et-top et-bottom-img">
            <img src="{{asset('asset/img/top-to-bottom.png')}}" alt="top">
</div>
<!-- END FOOTER -->
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
<!-- secondry nav script -->

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
<script type="text/javascript">
$(document).ready(function(){
    $(".et-ck-cart-button").click(function(){
        var cc=$("#crtcount").val();
        if(cc==0) { alert("No item in the cart, please add 1");} else{  $(".et-ck-cart-button").attr("href","{{url('/cart')}}");}
    });
});
</script>
<script type="text/javascript">
function closepp()
{
  $("div#bio_ep").css("display","none");
  $("div#bio_ep_bg").css("display","none");
}
</script>

@auth
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
  var Tawk_API=Tawk_API||{};

  Tawk_API.visitor = {
  name : '{{auth()->user()->name}}',
  email : '{{auth()->user()->email}}',
  // hash : 'hash-value'
  };

  var Tawk_LoadStart=new Date();

  (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/619878a36885f60a50bca9d2/1fktpega4';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
@endauth


{{-- <!-- mibew button --><a id="mibew-agent-button" href="/support/chat?locale=en" target="_blank" onclick="Mibew.Objects.ChatPopups['590aba641ddde16e'].open();return false;"><img src="{{asset('/asset/img/support.png')}}" border="0" alt="" /></a><script type="text/javascript" src="/support/js/compiled/chat_popup.js"></script><script type="text/javascript">Mibew.ChatPopup.init({"id":"590aba641ddde16e","url":"\/support\/chat?locale=en","preferIFrame":true,"modSecurity":false,"width":640,"height":480,"resizable":true,"styleLoader":"\/support\/chat\/style\/popup"});</script><!-- / mibew button --> --}}
</body>
</html>
