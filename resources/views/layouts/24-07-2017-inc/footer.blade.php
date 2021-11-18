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
                 <h4>Need Help? Call Us On: {{Voyager::setting('callus')}}</h4>
                </div>
               </div> 
               </div> 
               
               <div class="col-md-6 col-sm-6">
               <div class="right-pay-area">
               
                <ul>
                  <li><img src="{{asset('/asset/img/icon-01.png')}}"/></li>
                  <li><img src="{{asset('/asset/img/icon-02.png')}}"/></li>
                  <li><img src="{{asset('/asset/img/icon-03.png')}}"/></li>
                  <li><img src="{{asset('/asset/img/icon-05.png')}}"/></li>
                  <li><img src="{{asset('/asset/img/icon-06.png')}}"/></li>
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
            {!! Form::open(array('route' => 'subscribe')) !!}
              <div class="input-box">
               <input class="eet-sub-email" name="email" type="email" id="email"  placeholder="Enter E-mail Address">
              </div>
              <div class="input-box et-Subscribe">
               <input type="submit" value="Subscribe"/>
              </div>
             {!! Form::close() !!}
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
            <div class="col-md-3 col-sm-3">
             <div class="et-in-link">
               <h2>World of eTailor</h2>
               <ul>
                 <li><a href="{{url('/designshirts')}}">Custom Shirts</a></li>
                 <li><a href="{{url('/designjackets')}}">Custom Jackets</a></li>
                 <li><a href="{{url('/designvests')}}">Custom Vests</a></li>
                 <li><a href="{{url('/designpants')}}">Custom Pants</a></li>
                 
                 
               </ul>
             </div>
            </div>
            <div class="col-md-3 col-sm-3">
             <div class="et-in-link">
             <h2>Why eTailor</h2>
               <ul>
                 <li><a href="{{url('/ecollection')}}/{{1}}">Collection Shirts</a></li>
                 <li><a href="{{url('/ecollection')}}/{{2}}">Collection Jackets</a></li>
                 <li><a href="{{url('/ecollection')}}/{{3}}">Collection Vests</a></li>
                 <li><a href="{{url('/ecollection')}}/{{4}}">Collection Pants</a></li>
                
               </ul>
             </div>
            </div>
            <div class="col-md-3 col-sm-3">
             <div class="et-in-link">
               <h2>Customer Care</h2>
               <ul>
                 <li><a href="{{url('pages/faq')}}">FAQ’S</a></li>
                 <li><a href="{{url('pages/contact-us')}}">Contact Us</a></li>
                 <li><a href="{{url('pages/delivery')}}">Delivery</a></li>
                 <li><a href="{{url('pages/terms-and-conditions')}}">Terms & Conditions</a></li>
                 <li><a href="{{url('pages/privacy-policy')}}">Privacy Policy</a></li>
                
               </ul>
             </div>
            </div>
            <div class="col-md-3 col-sm-3">
             <div class="et-in-link">
               <h2>About Us</h2>
               <ul>
                 <li><a href="{{url('pages/about-us')}}">Company</a></li>
                 <li><a href="{{url('review')}}">Review</a></li>
                 <li><a href="{{url('pages/how-we-work')}}">How We Work</a></li>
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
              <div class="et-Copyright"><P>{{Voyager::setting('copyright')}}</P></div>
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
         @include('layouts.inc.footer-strkey')
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
<!-- mibew button --><a id="mibew-agent-button" href="/support/chat?locale=en" target="_blank" onclick="Mibew.Objects.ChatPopups['590aba641ddde16e'].open();return false;"><img src="{{asset('/asset/img/support.png')}}" border="0" alt="" /></a><script type="text/javascript" src="/support/js/compiled/chat_popup.js"></script><script type="text/javascript">Mibew.ChatPopup.init({"id":"590aba641ddde16e","url":"\/support\/chat?locale=en","preferIFrame":true,"modSecurity":false,"width":640,"height":480,"resizable":true,"styleLoader":"\/support\/chat\/style\/popup"});</script><!-- / mibew button --></script>
</body>
</html>