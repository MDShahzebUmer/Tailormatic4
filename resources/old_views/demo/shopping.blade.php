<?php  $cartcount = App\Http\Helpers::cartcount(); ?>
<div class="et-bag-box">
    <div class="et-bag-inner">
        <span>SHOPPING BAG</span>
        <div class="et-shope">
            <figure class="et-cart-icon">
                <img src="{{asset('demo/img/cart-icon.png')}}" alt="Shopping Bag">
            </figure>
          <span>items:({{$cartcount}})</span>
        </div>
    </div>
    <input type="hidden" id="crtcount" value="{{$cartcount}}">
   <a class="et-ck-btn">Checkout</a>
</div>
<div class="et-ck-payment">
    <span>WORLDWIDE SHIPPING</span>
    <ul class="et-payment-list">
        <li><i class="fa fa-cc-visa" aria-hidden="true"></i></li>
        <li><i class="fa fa-cc-mastercard" aria-hidden="true"></i></li>
        <li><i class="fa fa-cc-amex" aria-hidden="true"></i></li>
        <li><i class="fa fa-cc-paypal" aria-hidden="true"></i></li>
        <li><i class="fa fa-cc-discover" aria-hidden="true"></i></li>
    </ul>
    <!--  <h4>OVER <?php //echo $cs = App\Http\Helpers::get_count_customer_served(); ?></h4>
  <p>CUSTOMERS SERVED</p> -->
{!! setting('site.shirts_served') !!}
</div>