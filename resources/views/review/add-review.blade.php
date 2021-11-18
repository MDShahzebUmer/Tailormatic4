<?php  $seo = App\Http\Helpers::page_seo_details(29);?>
@include('../layouts.inc.page_header')
@include('../layouts.inc.page_menu')
<body>
<!-- Header End -->
<!-- Service Section End -->
<section class="et-content">
	<div class="container">
  	<div class="row">
      	<div class="et-block">
          	<div class="col-sm-12 col-md-12">
                <div class="add-review-box full-width">
                    <div class="add-title-box">
                        <ul class="nav nav-pills">
                          <li class="active"><a data-toggle="tab" href="#review-text">Text Review </a></li>
                          <li><a data-toggle="tab" href="#review-photo">Photo Review </a></li>
                          <li><a data-toggle="tab" href="#review-video">Video Review </a></li>
                        </ul>
                    </div>
                    <p class="review-heading">Review US/UK Customers</p>
                     <div class="add-review-content-box full-width">
                        <div class="tab-content">
                           <div id="review-text" class="tab-pane fade in active">
                            <form class="full-width" method="post" action="{{ url('/review/add/1') }}">
                            {{ csrf_field() }}
                              <div class="col-sm-6">
                                  <p class="rating-title">How do you rate this product</p>
                                  <ul class="rating-list">
                                    <li>
                                      <div class="rate-text">1. Fabric</div> <span id="fabric" class="starrr fabt"></span>
                                    </li>
                                    <li>
                                      <div class="rate-text">1. Price</div> <span id="price" class="starrr prit"></span>
                                    </li>
                                    <li>
                                      <div class="rate-text">1. Delivery</div> <span id="delivery" class="starrr delt"></span>
                                    </li>
                                    <li>
                                      <div class="rate-text">1. Fitting</div> <span id="fitting" class="starrr fitt"></span>
                                    </li>
                                  </ul>
                                   <input type="hidden" class="fabcount" name="fab" value="">
                                  <input type="hidden" class="pricecount" name="price" value="">
                                  <input type="hidden" class="deliverycount" name="delivery" value="">
                                  <input type="hidden" class="fittingcount" name="fitting" value="">
                                  <input type="hidden"  name="rtype" value="1">
                                  <input type="hidden"  name="orderid" value="{{$orderid}}">
                                  <p class="comments-title">Let us know your thoughts</p>
                                  <textarea class="comments-textarea" name="message" required></textarea>
                                  <button type="submit" class="review-btn">Submit Review</button>
                              </div>
                            </form>
                          </div>
                          <div id="review-photo" class="tab-pane fade">
                            <form class="full-width" method="POST" enctype="multipart/form-data" action="{{ url('/review/add/1') }}">
                            {{ csrf_field() }}
                              <div class="col-sm-6">
                                  <p class="rating-title">How do you rate this product</p>
                                  <ul class="rating-list">
                                    <li>
                                      <div class="rate-text">1. Fabric</div> <span id="fabric" class="starrr fabp"></span>
                                    </li>
                                    <li>
                                      <div class="rate-text">1. Price</div> <span id="price" class="starrr prip"></span>
                                    </li>
                                    <li>
                                      <div class="rate-text">1. Delivery</div> <span id="delivery" class="starrr delp"></span>
                                    </li>
                                    <li>
                                      <div class="rate-text">1. Fitting</div> <span id="fitting" class="starrr fitp"></span>
                                    </li>
                                  </ul>
                                  <input type="hidden" class="fabcount" name="fab" value="">
                                 <input type="hidden" class="pricecount" name="price" value="">
                                  <input type="hidden" class="deliverycount" name="delivery" value="">
                                  <input type="hidden" class="fittingcount" name="fitting" value="">
                                  <input type="hidden"  name="rtype" value="2">
                                  <input type="hidden"  name="orderid" value="{{$orderid}}">
                                  <p class="comments-title">Let us know your thoughts</p>
                                  <textarea class="comments-textarea" name="message" required></textarea>
                                  <button type="submit" class="review-btn">Submit Review</button>
                              </div>
                              <div class="col-sm-6">
                                  <p class="rating-title">Upload Images</p>
                                  <div class="input-file-group">
                                  <input type="file" name="image_fir" required>
                                    <input type="file" name="image_sec">
                                    <input type="file" name="image_thr">
                                    <input type="file" name="image_fou">
                                    <input type="file" name="image_fiv">
                                    
                                  </div>
                              </div>
                            </form>
                          </div>
                          <div id="review-video" class="tab-pane fade">
                            <form class="full-width" method="post" action="{{ url('/review/add/1') }}">
                            {{ csrf_field() }}
                              <div class="col-sm-6">
                                  <p class="rating-title">How do you rate this product</p>
                                  <ul class="rating-list">
                                    <li>
                                      <div class="rate-text">1. Fabric</div> <span id="fabric" class="starrr fabv"></span>
                                    </li>
                                    <li>
                                      <div class="rate-text">1. Price</div> <span id="price" class="starrr priv"></span>
                                    </li>
                                    <li>
                                      <div class="rate-text">1. Delivery</div> <span id="delivery" class="starrr delv"></span>
                                    </li>
                                    <li>
                                      <div class="rate-text">1. Fitting</div> <span id="fitting" class="starrr fitv"></span>
                                    </li>
                                  </ul>
                                 <input type="hidden" class="fabcount" name="fab" value="">
                                 <input type="hidden" class="pricecount" name="price" value="">
                                  <input type="hidden" class="deliverycount" name="delivery" value="">
                                  <input type="hidden" class="fittingcount" name="fitting" value="">
                                  <input type="hidden"  name="rtype" value="3">
                                  <input type="hidden"  name="orderid" value="{{$orderid}}">
                                  <p class="comments-title">Let us know your thoughts</p>
                                  <textarea class="comments-textarea" name="message" required></textarea>
                                  <button type="submit" class="review-btn">Submit Review</button>
                              </div>
                              <div class="col-sm-6">
                                  <p class="rating-title">Upload Video</p>
                                  <p class="reviewyou-yout">(Add Youtube Video url Ex:- www.youtube.com/watch?v=eSY5ge5W4Td )</p>
                                  <div class="input-file-group">
                                    <input type="text" class="reviewyou-btn" required placeholder="www.youtube.com/watch?v=eSY5ge5W4Td" name="video">
                                  </div>
                              </div>
                            </form>
                          </div>
                        </div>
                     </div> 
                </div>
            </div>
        </div>
      </div><!-- end row -->
    </div>
</section>

<!-- Bootstrap Main JS File -->
	@include('profile.profile-footer')
    
    <script type="text/javascript" src="{{asset('asset/js/html5gallery.js')}}"></script>



    
    
  
  <!-- script for star rating-->
  <script type="text/javascript">
    // Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function($, window) {
  var Starrr;

  Starrr = (function() {
    Starrr.prototype.defaults = {
      rating: void 0,
      numStars: 5,
      change: function(e, value) {}
    };

    function Starrr($el, options) {
      var i, _, _ref,
        _this = this;

      this.options = $.extend({}, this.defaults, options);
      this.$el = $el;
      _ref = this.defaults;
      for (i in _ref) {
        _ = _ref[i];
        if (this.$el.data(i) != null) {
          this.options[i] = this.$el.data(i);
        }
      }
      this.createStars();
      this.syncRating();
      this.$el.on('mouseover.starrr', 'span', function(e) {
        return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('mouseout.starrr', function() {
        return _this.syncRating();
      });
      this.$el.on('click.starrr', 'span', function(e) {
        return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('starrr:change', this.options.change);
    }

    Starrr.prototype.createStars = function() {
      var _i, _ref, _results;

      _results = [];
      for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
        _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
      }
      return _results;
    };

    Starrr.prototype.setRating = function(rating) {
      if (this.options.rating === rating) {
        rating = void 0;
      }
      this.options.rating = rating;
      this.syncRating();
      return this.$el.trigger('starrr:change', rating);
    };

    Starrr.prototype.syncRating = function(rating) {
      var i, _i, _j, _ref;

      rating || (rating = this.options.rating);
      if (rating) {
        for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
        }
      }
      if (rating && rating < 5) {
        for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
        }
      }
      if (!rating) {
        return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
      }
    };

    return Starrr;

  })();
  return $.fn.extend({
    starrr: function() {
      var args, option;

      option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      return this.each(function() {
        var data;

        data = $(this).data('star-rating');
        if (!data) {
          $(this).data('star-rating', (data = new Starrr($(this), option)));
        }
        if (typeof option === 'string') {
          return data[option].apply(data, args);
        }
      });
    }
  });
})(window.jQuery, window);

$(function() {
  return $(".starrr").starrr();
});

$( document ).ready(function() {
  //Video    
  $('.fabv').on('starrr:change', function(e, value){
	$('.fabcount').attr("value", value);
  });  
   $('.priv').on('starrr:change', function(e, value){
    $('.pricecount').attr("value", value);
  });
    $('.delv').on('starrr:change', function(e, value){
    $('.deliverycount').attr("value", value);
  });
  $('.fitv').on('starrr:change', function(e, value){
    $('.fittingcount').attr("value", value);
  });
  //Text
    $('.fabt').on('starrr:change', function(e, value){
	$('.fabcount').attr("value", value);
  });  
   $('.prit').on('starrr:change', function(e, value){
    $('.pricecount').attr("value", value);
  });
    $('.delt').on('starrr:change', function(e, value){
    $('.deliverycount').attr("value", value);
  });
  $('.fitt').on('starrr:change', function(e, value){
    $('.fittingcount').attr("value", value);
  });
  
  //photo
    $('.fabp').on('starrr:change', function(e, value){
	$('.fabcount').attr("value", value);
  });  
   $('.prip').on('starrr:change', function(e, value){
    $('.pricecount').attr("value", value);
  });
    $('.delp').on('starrr:change', function(e, value){
    $('.deliverycount').attr("value", value);
  });
  $('.fitp').on('starrr:change', function(e, value){
    $('.fittingcount').attr("value", value);
  });
  
});
  </script>
</body>
</html>
