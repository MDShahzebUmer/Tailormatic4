<?php  $seo = App\Http\Helpers::page_seo_details(27);?>
@include('../layouts.inc.page_header')
@include('../layouts.inc.page_menu')
<link rel="stylesheet" type="text/css" href="{{asset('asset/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/css/et-responsive.css')}}">
@include('../layouts.inc.section_div')
	<div class="container">
    	<div class="row">
          <div class="col-sm-12">
              <div class="et-sub-title et-fw">
                <h2>My Wish List</h2> 
              </div>
            </div>
        	<div class="et-block">
            	<div class="col-md-3 st-pro-leftbar">
                <div class="et-account-left-box">
                  {{-- <ul class="user-frofile-list"> --}}
                  <ul >
                       @include('../layouts.inc.profile-menu')
                  </ul>
                </div> 
              </div>
              <div class="col-md-9 dt-responsive st-pro-content-wrap">
                @include('../layouts.inc.profile-menu-responsive')
                  <div class="contact-box full-witdh order-list-data-table">
                      <table id="order-list-dt" class="table table-striped table-bordered " cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                  <th>Item</th>
                                  <th>Product Images</th>
                                  <th>Product Name</th>
                                  <th>Price</th>
                                  <th>Offer Price</th>
                                  <th>Process</th>
                                  <th>Acation</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>Item</th>
                                  <th>Product Images</th>
                                  <th>Product Name</th>
                                  <th>Price</th>
                                  <th>Offer Price</th>
                                  <th>Process</th>
                                  <th>Acation</th>
                              </tr>
                          </tfoot>
                          <tbody>
							              @if($wishlists->isNotEmpty())
                          <?php $i =1;?> 
								             @foreach($wishlists as $wis)
                            
                              <tr id="item_{{$wis->wishId}}">
                                  <td>{{$i++}}</td>
                                  <td class="item-desc">
                                    <img src="{{url('/storage/')}}/{{$wis->thumb_img}}" alt="">
                                    
                                  </td>
                                  <!-- <td class="order-fabric-image">
                                    <img src="img/product/pt-thumb.png" alt=""> -->
                                  </td>
                                  <td>{{$wis->product_name}}</td>
                                  <td>${{number_format($wis->product_mrp)}}</td><?php  ?>
                                  <td>${{number_format($wis->product_offer_rate)}}</td>
                                  
                                
                                  <td> 
                                    @if($wis->initial_stock > 0)
                                    <a href="{{url('/productdetails')}}/{{$wis->product_id}}" class="btn btn-primary">
                                       View Product
                                    </a>
                                    @else
                                     <a href="" class="pending pd-canceld">
                                        Out of Stock
                                    </a>
                                    @endif
                                  </td>
                                  <td  class="item-trash" align="center">
                                   <a class="deletewishItems" data-id="{{ $wis->wishId }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                  </td>
                              </tr>
                              
								            @endforeach
                            @endif
                              
                              
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
        </div>
    </div>
</section>

  @include('../profile.profile-footer')
  
  <script type="text/javascript" src="{{asset('asset/js/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('asset/js/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#order-list-dt').DataTable();
} );
</script>
 <script type="text/javascript">
$(".deletewishItems").click(function(){
        var id = $(this).data("id");
         //alert(id);

        var token = $(this).data("token");

         if (confirm("Sure you want to delete this item? ")) {
        $.ajax(
        {
            url: "/../myaccount/wishlists/del/"+id,
            type: 'POST',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: function (data)
            {
               if(data.del)
               {
                $('#item_'+id).fadeOut();
               }
            
            }
        });
       
    }
    return false;
  });
 </script>

</body>
</html>