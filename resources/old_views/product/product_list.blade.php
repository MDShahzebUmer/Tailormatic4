<?php  $seo = App\Http\Helpers::page_seo_details(19);?>
@include('../layouts.inc.page_header')
@include('../layouts.inc.page_menu')
<section class="et-content ec-product-list">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
          
      </div>
    </div>
    <div class="row">
        <!-- <div class="col-sm-12">
          <div class="et-sub-title et-fw">
            <h2>Order Detail</h2> 
          </div>
        </div> -->
        <?php $mcn = App\Category::get_ecollection_cat_name($catIds); ?>
        <div class="et-block">
            <div class="col-sm-3 col-md-3">
              <div class="et-account-left-box product-left-bar" >
                <h4><?php echo $catnames = App\Category::get_catname($catIds); ?></h4>
                <input type="hidden" value="{{$catIds}}" id="cat_ids">
                <dl class="dl-list-right-bar">
                  @if($mcn != '')
                  @foreach($mcn as $ncm)
                  <dd><a href="{{$ncm->id}}">{{$ncm->name}}</a></dd>
                  
                  @endforeach
                  @endif
                </dl>
                
                  
                </dl>
                <?php  $cgory = App\Category::select('*')->get();  $newcat = App\Http\Helpers::get_parent($cgory,$catIds); ?>

                 @if($newcat == 1)
                <?php $sds = App\MeasurmentSize::get_standardSize(); ?>
                @else
                <?php $sds = App\StandardSize::get_standersizeno(); ?>
                @endif
                 @if($newcat == 1 || $newcat == 2 || $newcat == 3 || $newcat == 4 )
                <dl class="dl-list-right-bar size-filter">
                  <dt>By Size</dt>
                   @if($sds != '')
                  @foreach($sds as $sd)
                  <dd><span rel="unchecked" id="prod_size{{$sd->id}}">@if($newcat == 1){{$sd->name}}@else{{$sd->value}}@endif
                        <strong class="check-icon"><i class="fa fa-check" aria-hidden="true"></i></strong>
                        <input type="hidden" value="{{$sd->id}}">
                      </span>
                  </dd>
                  @endforeach
                  @endif
                  <!-- <input id="scheckbox_{{$sd->id}}" type="checkbox" value="{{$sd->id}}"> -->
                </dl>
                @endif
               
                <dl class="dl-list-right-bar price-filter">
                  <dt>By Price</dt>
                  
                  <dd class="type-price">
                    <div class="input-group">
                      <span>&#36; &nbsp;</span>
                      <input type="text" class="form-control" placeholder="" id="frompr">
                      <span>&nbsp; To &#36; &nbsp;</span>
                      <input type="text" class="form-control" placeholder="" id="topr">
                      <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button">Go!</button>
                      </span>
                    </div>
                  </dd>
                </dl>
                <?php $ftp = App\EcollectionFabrictype::fabric_types_catId($catIds); ?>
                <dl class="dl-list-right-bar checkbox-list" id="fabric_type">
                  <dt>Fabric Type</dt>
                  @foreach($ftp as $ft)
                  <dd>
                      <div class="checkbox ">
                        <input id="checkboxt{{$ft->id}}" type="checkbox" value="{{$ft->id}}">
                        <label for="checkboxt{{$ft->id}}"> {{$ft->type_name}} </label>
                      </div>
                  </dd>
                  @endforeach
                </dl>
                <?php $fpn = App\EcollectionPattern::fabric_pattern(); ?>
                <dl class="dl-list-right-bar checkbox-list" id="fabric_patern">
                  <dt>Fabric Patterns</dt>
                      @if($fpn != '')
                  @foreach($fpn as $fp)
                  <dd>
                      <div class="checkbox ">
                        <input id="checkboxp{{$fp->id}}" type="checkbox" value="{{$fp->id}}">
                        <label for="checkboxp{{$fp->id}}"> {{$fp->name}} </label>
                      </div>
                  </dd>
                  @endforeach
                  @endif
               </dl>
              </div> 
            </div>
            <div class="col-sm-9 col-md-9 search-sec">
                <div class="product-search-box full-width">
                    <div class="input-group">
                     
                      <input type="hidden" name="search_param" value="all" id="search_param">         
                      <input type="text" class="form-control" name="x" placeholder="Search term...">
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                      </span>
                  </div>
                </div>
            </div>
            <div class="col-sm-9">
              
                <div class="row">
                  <div class="product-list full-width">
                    @if($productsh->isNotEmpty())
                    @foreach($productsh as $psh)
                    <div class="col-xs-12 col-sm-6 col-md-3">
                      <div class="product-list-box ">
                          @if($psh->product_new == 1)
                          <a href="{{url('/productdetails')}}/{{$psh->id}}"><img src="{{url('/storage/none/tag.png')}}" class="new-tag tag-box"></a>
                          @endif
                          <figure class="figure-box"><img src="{{url('/storage').'/'.$psh->main_img}}"></figure>
                          <p class="p-name" title="{{$psh->product_name}}">{{ Str::limit($psh->product_name,15) }}</p>
                          <p class="p-price">{{$psh->product_mrp}}</p>
                           @if($psh->product_offer_rate != 0 || $psh->product_offer_rate != '')
                          <p><span><?php echo App\Http\Helpers::get_cal_discount($psh->product_mrp,$psh->product_offer_rate) ?>%</span> off</p>
                           @else
                           <p><span>&nbsp;</span></p>
                           @endif
                          <div class="p-icon-box"></div>
                      </div>
                      <a class="shopping-btn-box" href="{{url('/productdetails')}}/{{$psh->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </div>
                   @endforeach
                   @else
                    <div class="col-xs-12 col-sm-6">
                    <h3>Coming soon Products</h3>
                     </div>

                    @endif
                    

                  </div>
                </div>
               
            </div>

        </div>
      </div>
    </div>
</section>
<!-- Bootstrap Main JS File -->
  @include('../profile.profile-footer')
<script type="text/javascript">

$('.product-search-box button').click(function(){
    var search_val = $('#search_param').next('input').val();
    var cat =   $('#cat_ids').val();
    if($.trim(search_val) != ''){
      $('#search_param').next('input').css('border-color','initial');
        var s = 'true';
        getsearchAjaxVal(search_val,cat,s);
    }else{
      $('#search_param').next('input').css('border-color','red');
      $('#search_param').next('input').focus();
      return false;
    }
});

$( 'input[id^="checkbox_"]').click(function() {

    var cat =   $('#cat_ids').val();  
    var fullstring = filterdata();  
    getAjaxVal(fullstring,cat);

});

$( '#fabric_type input[id^="checkboxt"]').click(function() {

    var cat =   $('#cat_ids').val();  
    var fullstring = filterdata();  
    getAjaxVal(fullstring,cat);

});

$( '#fabric_patern input[id^="checkboxp"]').click(function() {

    var cat =   $('#cat_ids').val();  
    var fullstring = filterdata();  
    getAjaxVal(fullstring,cat);

});


  $('.type-price button').on('click',function(){
      var cat =   $('#cat_ids').val(); 

       var flag = 0;
      $('.type-price input').each(function(){
          if($.trim(parseFloat($(this).val()))=='' || $.trim(parseFloat($(this).val()))=='NaN'){
            flag = 1;
            $(this).css('border-color','red');
          }else{
            $(this).css('border-color','#663333');
          }
      });
      if(flag==1){
        return false;
      }

      var fullstring = filterdata();
      getAjaxVal(fullstring,cat);

  });
  

  var sizeFilter =  $(".size-filter span");
  $(sizeFilter).click(function(){

    $(this).find($(".check-icon")).toggle();
    var temp = $(this).attr('rel');
    if(temp!='checked'){
      $(this).attr('rel','checked');
    }else{
      $(this).attr('rel','unchecked');
    }

    var cat =   $('#cat_ids').val();  
    var fullstring = filterdata();

    getAjaxVal(fullstring,cat);


  });


function filterdata(){

    var all_array = [];
    var color = [];
    var size = [];
    var price = [];
    var febtype = [];
    var febpatern = [];

    $('input[id^="checkbox_"]:checked').each(function() {
       var temp = $(this).val();

       color.push({ 
           color: temp
        });
     });

      $('#fabric_patern input[id^="checkboxp"]:checked').each(function() {
       var temp = $(this).val();

       febpatern.push({ 
           patern: temp
        });
     });

      $('#fabric_type input[id^="checkboxt"]:checked').each(function() {
       var temp = $(this).val();

       febtype.push({ 
           type: temp
        });
     });

      var frompr = parseFloat($('#frompr').val());
      var topr = parseFloat($('#topr').val());

      if($.trim(parseFloat(frompr))!='' && $.trim(parseFloat(topr))!='NaN'){

        price.push({ 
           from: frompr,
           to: topr,
           price: true,
        });

      }


      $('span[id^="prod_size"]').each(function(){
        var rel = $(this).attr('rel');
        if(rel=='checked'){
           var temp = $(this).find('input').val();
           size.push({ 
               size: temp
            });
        }

    });

      all_array.push({ 
           color_data: color,
           price_data: price,
           size_data: size,
           febtype: febtype,
           febpatern: febpatern,
        });

  return all_array;

  }

  function getAjaxVal(string,cat){

      var temp_flag = 0;
      var new_string = [];
      $.each(string,function(i1,v1){
        if(v1.color_data.length==0 && v1.price_data.length==0 && v1.size_data.length==0 && v1.febpatern.length==0 && v1.febtype.length==0){
          temp_flag = 1;
        }
      });

      if(temp_flag == '1'){
        var string = 'All';
      }else{

        seen = []; 
        var replacer = function(key, value) {
          if (value != null && typeof value == "object") {
            if (seen.indexOf(value) >= 0) {
              return;
            }
            seen.push(value);
          }
          return value;
        };

        var string = JSON.stringify(string, replacer); 

      }

       $.ajax({
             type:"GET",
             dataType: "JSON",
             url:"{{ route('ecollection') }}/"+cat+'/'+string,
             success:function(res){ 

               var text = '';
               $.each(res.sum,function(i,v){
                  var title = v.product_name;
                  if(v.product_offer_rate != '')
                  {
                  var offrate = Math.round((100-((v.product_offer_rate*100)/v.product_mrp)));
                  var per = '% ';
                    var offs = 'off';
                  }else{
                    var offrate = '';
                    var per = '';
                    var offs = '&nbsp;';
                  }

                  
                  //console.log(offrate);
                  if(title.length > 13) title = title.substring(0,15)+'...';

                   text += '<div class="col-xs-12 col-sm-6 col-md-3"><div class="product-list-box "><figure class="figure-box"><img src="{{asset('storage')}}/'+v.main_img+'"></figure><p class="p-name" title="Custom Dress Shirt - Lime Green Candy Stripes">'+title+'</p><p class="p-price">'+v.product_mrp+'</p><p><span>'+offrate+per+'</span>'+offs+'</p><div class="p-icon-box"></div></div><a class="shopping-btn-box" href="{{url('productdetails')}}/'+v.id+'"><i class="fa fa-eye" aria-hidden="true"></i></a></div>';
               });

               if(res.sum.length == 0){
                text = 'No search result found.';
               }

               $('.product-list').html(text);

          }
        });
     }

     function getsearchAjaxVal(string,cat,s){

       $.ajax({
             type:"GET",
             dataType: "JSON",
             url:"{{ route('ecollection') }}/"+cat+'/'+s+'/'+string,
             success:function(res){    

               var text = '';
               $.each(res.sum,function(i,v){
                  var title = v.product_name;
                  if(title.length > 13) title = title.substring(0,15)+'...';
                   text += '<div class="col-xs-12 col-sm-6 col-md-3"><div class="product-list-box "><figure class="figure-box"><img src="{{asset('storage')}}/'+v.main_img+'"></figure><p class="p-name" title="Custom Dress Shirt - Lime Green Candy Stripes">'+title+'</p><p class="p-price">'+v.product_mrp+'</p><p><span>'+v.product_offer_rate+'</span>off</p><div class="p-icon-box"></div></div><a class="shopping-btn-box" href="{{url('productdetails')}}/'+v.id+'"><i class="fa fa-eye" aria-hidden="true"></i></a></div>';
               });

               if(res.sum.length == 0){
                text = 'No search result found.';
               }
               
               $('.product-list').html(text);

          }
        });
     }

</script>
</body>
</html>