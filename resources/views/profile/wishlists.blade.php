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
                @if (!auth()->user()->email_verified_at)
                <div class="alert alert-danger" role="alert">please verify your email address</div>
                @endif
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
                                    <a href="{{ url("/productdetails/$wis->product_id") }}"><img src="{{url('/storage/')}}/{{$wis->thumb_img}}" alt=""></a>

                                  </td>
                                  <!-- <td class="order-fabric-image">
                                    <img src="img/product/pt-thumb.png" alt=""> -->
                                  </td>

                                  <td><a style="color:#ffff" href="{{ url("/productdetails/$wis->product_id") }}">{{$wis->product_name}}</a></td>
                                  <td>${{number_format($wis->product_mrp)}}</td><?php  ?>
                                  <td>${{number_format($wis->product_offer_rate)}}</td>


                                  <td>
                                    @if($wis->initial_stock > 0)
                                    {{-- <form action="{{ url("/wishtocart/$wis->product_id") }}" method="post" class="my_form">
                                        @csrf
                                        <input type="hidden" name="size" class="main_size" value=""> --}}
                                    <a type="submit" href="{{ url("/productdetails/$wis->product_id") }}" class="btn btn-primary">
                                       View
                                    </a>
                                    <!-- Button trigger modal -->
                                    <button style="margin-top: 10px" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $wis->wishId }}">
                                        Add To Cart
                                    </button>
                                    {{-- </form> --}}

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

                                                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $wis->wishId }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: red" >Please select a size</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url("/wishtocart/$wis->product_id") }}" method="post" class="my_form">
                                @csrf




                        @php

                            $product = App\EcollectionProduct::where('id', $wis->product_id)->first();
                            $mpdata=$product;
                        @endphp
                        @if($mpdata->product_size!='')

                        @if($mpdata->product_type==1)
                        <?php
                                $cussize=unserialize($mpdata->product_size);
                        ?>
                                <div class="product-desc" style="clear:both">
                                <p><strong style="color: black">Size : </strong> <?php echo $cussize[0]; ?> </p>
                                <input type="hidden" value="<?php echo $cussize[0]; ?>" name="size" required>
                                </div>
                        @else
                        <div class="size-box">
                        <div class="input-group" style="width: 100%">

                                <?php $prsize = App\MeasurmentSize::get_ecollection_size_dropdown($mpdata->product_size ,$mpdata->main_catid);?>
                                @if($mpdata->main_catid == 1)

                                    @if(count($prsize) > 1)
                                        <span class="">
                                            <p class="color-name" style="color: black">Size : </p>
                                        </span>
                                        <select  style="color: rgb(36, 39, 221)" id="lunch" class="selectpicker form-control" data-live-search="true" title="" name="size" required>
                                            <option value="" disabled="" selected="">Select</option>
                                            @foreach($prsize as $szi)
                                            <option value="<?php echo App\MeasurmentSize::ecollection_size_name($szi) ?>"><?php echo App\MeasurmentSize::ecollection_size_name($szi) ?></option>
                                            @endforeach
                                        </select>

                                    @else
                                        {{-- <p class="color-name" style="color: black">Size&nbsp;: <span><?php echo App\MeasurmentSize::ecollection_size_name($prsize[0]) ?></span></p> --}}
                                        {{-- <input type="hidden" value="<?php echo App\MeasurmentSize::ecollection_size_name($prsize[0]) ?>" name="size" required> --}}
                                        <span class="">
                                            <p class="color-name" style="color: black">Size : </p>
                                        </span>
                                        <select style="color: blue"  id="lunch" class="selectpicker form-control" data-live-search="true" name="size" required>

                                            <option value="" disabled="" selected>Select</option>
                                            @foreach($prsize as $szi)
                                            <option value="<?php echo App\MeasurmentSize::ecollection_size_name($prsize[0]) ?>" ><?php echo App\MeasurmentSize::ecollection_size_name($prsize[0]) ?></option>
                                            @endforeach
                                        </select>

                                    @endif
                                @elseif($mpdata->main_catid == 2 || $mpdata->main_catid == 3 || $mpdata->main_catid == 4)

                                    @if(count($prsize) > 1)
                                        <span class="input-group-btn">
                                            <p class="btn btn-secondary" type="button" style="color: black">Size : </p>
                                        </span>
                                        <select style="color: blue"  class="selectpicker form-control" data-live-search="true" name="size" required>

                                            <option value="" selected="">Select</option>
                                            @foreach($prsize as $szi)
                                            <option value="<?php echo App\MeasurmentSize::ecollection_sizename($szi) ?>" ><?php echo App\MeasurmentSize::ecollection_sizename($szi) ?></option>
                                            @endforeach
                                        </select>
                                    @else
                                        {{-- <p class="color-name" style="color: black">Size&nbsp; <span><?php echo App\MeasurmentSize::ecollection_sizename($prsize[0]) ?></span></p>
                                        <input type="hidden" value="<?php echo App\MeasurmentSize::ecollection_sizename($prsize[0]) ?>" name="size" required> --}}

                                        <span class="">
                                            <p class="color-name" style="color: black">Size : </p>
                                        </span>

                                        <select  style="color: blue" id="lunch" class="selectpicker form-control" data-live-search="true" name="size" required>

                                            <option value="" disabled="" selected>Select</option>
                                            @foreach($prsize as $szi)
                                            <option value="<?php echo App\MeasurmentSize::ecollection_sizename($prsize[0]) ?>" ><?php echo App\MeasurmentSize::ecollection_sizename($prsize[0]) ?></option>
                                            @endforeach
                                        </select>


                                    @endif


                                @else
                                <!-- Extra Category Size  -->
                                <input type="hidden" value="" name="size" required>

                                @endif


                        </div>
                        </div>

                        @endif

                @else
                <input type="hidden" value="" name="size" required>
                @endif
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="" class="btn btn-primary" style="">Add</button>
                        </div>
                    </div>
                </div>
            </form>
                </div>

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

 <script>
        // function handleSize(data){
        //     $(".main_size").val(data.value);
        // }




        // if($(".main_size").val()){
        //  $(".submit_me").on('click', function(){
        //     $(".my_form").submit();
        //  })
        // }



 </script>

</body>
</html>
