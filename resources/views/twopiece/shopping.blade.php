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
        <li><img src="{{asset('asset/img/product/o_visa.png')}}" class="visa" alt="visa" /></li>
        <li><img src="{{asset('asset/img/product/o_mastercard.png')}}" class="mastercard" alt="mastercard" /></li>
        <li><img src="{{asset('asset/img/product/o_amex.png')}}" class="amex" alt="amex" /></li>
        <li><img src="{{asset('asset/img/product/o_paypal.png')}}" class="paypal" alt="paypal" /></li>
        <li><img src="{{asset('asset/img/product/o_discover.png')}}" class="discover" alt="discover" /></li>
    </ul>
</div>