@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Edit Product</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                 
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Product</h3>
                        </div>
                         @foreach($data as $productId)@endforeach
                        <!-- form start -->
                        <form role="form" action="{{ route('voyager.customproduct.edit') }}/{{$productId->id}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                             <div class="panel-body">
                              <?php                              
                                 $pcolor    =  App\EcollectionColor::get_color_product();
                                ?>

                                 <div class="form-group">
                                    <label for="product_name">Product Name.</label>
       <input type="text" class="form-control" name="product_name" placeholder="Product Name" id="product_name" required value="{{$productId->product_name}}">
                                <input type="hidden" name="id"  value="{{$productId->id}}">
                                 </div>
                                 <div class="form-group" >
                                  <label for="product_name">Product Code.</label>
      <input type="text" class="form-control" name="sku_code" placeholder="Product Code" id="sku_code" required value="{{$productId->sku_code}}">                               </div>
                                 
                                 <div class="form-group">
                                    <label for="brand">Fabric Name.</label>
      <input type="text" class="form-control" name="fabric_name" placeholder="Fabric Name" id="fabric_name" value="{{$productId->fabric_name}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="brand">Fabric Description.</label>
                                    <textarea name="fabric_dec" class="form-control" rows="2"><?php echo $productId->fabric_dec; ?></textarea>
                                 </div>
                                 

                                 <div class="form-group">
                                   <label for="product_color">Select Color</label>
                                   <select name="product_color[]" id="size_list" class="form-control select2" multiple required >
                                    <option value=""  >Select Size</option>
                                    @foreach($pcolor as $co)
                                    <option value="<?php echo $co['id']; ?>" <?php echo App\EcollectionColor::get_checked_colorP($productId->id,$co['id']); ?>><?php echo $co['color_name'];  ?> </option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="color_desc">Color Description.</label>
                                    <textarea name="color_desc" class="form-control" rows="2">{{$productId->color_desc}}</textarea>
                                 </div>
                                
                                 <div class="form-group">
                                    <label for="qty_desc">Quality Description.</label>
                                 <textarea class="form-control" rows="3" name="quality_desc">{{$productId->quality_desc}}</textarea>
                                </div>
                                
                                 
                                <div class="form-group">
                                    <label for="product_mrp">Product MRP.</label>
                                    <input type="text" class="form-control" name="product_mrp"
                                           placeholder="Product MRP" id="product_mrp"
                                           required value="{{$productId->product_mrp}}">
                                 </div>
                                 <div class="form-group">
                                  <label for="product_offer_rate">Product Offer Price.</label>
                                  <input type="text" class="form-control" name="product_offer_rate"
                                  placeholder="Product Offer Price" id="product_offer_rate"
                                  value="{{$productId->product_offer_rate}}">
                                </div>
                              
                              
                                   <div class="form-group">
                                    <label for="initial_stock">Initial Stock.</label>
                                    <input type="text" class="form-control" name="initial_stock"
                                           placeholder="Product Initial Stock" id="initial_stock"
                                          value="{{$productId->initial_stock}}">
                                 </div>                           
                                   <?php  $pc = count($proimg);
                                     $lp = (2-$pc);
                                 ?>
                                @foreach($proimg as $pg)
                                <div class="form-group">
                                  <label for="price">Main Img.<code>WxH--800*800</code></label>
                                  <input type="file"  name="imgid{{$pg->id}}" value="" >
                                <?php if($pg->main_img != '') {?>
                              <img src="{{url('/storage').'/'.$pg->main_img}}" width="60px">
                               <?php   }?>
                               </div>
                                @endforeach
                                <?php 
                                 if($lp != 0)
                                 {
                                  for ($ii=1; $ii <=$lp ; $ii++) { 
                                     ?>
                                     <div class="form-group">
                                      <label for="price">Img.<code>WxH--800*800</code></label>
                                      <input type="file"  name="img[]"
                                      value="">
                                      </div> <?php
                                  }
                                 }

                                ?>                           
                                 
                                  <div class="form-group">
                                    <label for="button_img">Related Product.</label>  
                                <table class="table table-hover">
                                  <tr>
                                    <th>Select</th>
                                    <th>Product Id</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Category Name</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                  </tr>
                                 
                                  <?php if(count($relpro) > 0)  {
                                    foreach($relpro as $rel){
                                   ?>
                                  <tr>
                                    <td><input type="checkbox" name="relateds_id[]" value="{{$rel->id}}" <?php  echo $chek = App\EcollectionRelated::get_checked_relatedP($productId->id,$rel->id) ?>></td>
                                    <td>{{$rel->id}}</td>
                                    <td>{{$rel->sku_code}}</td>
                                    <td>
                                    
                                      @if($rel->product_type!=1)
									 <a target="_blank" href="{{ route('voyager.productslists.edit') }}/{{$rel->id}}">									
									<?php $catname = App\Category::getcatname($rel->cat_id); ?>{{$rel->product_name}}</a>
                                    @else
                                    <a target="_blank" href="{{ route('voyager.customproduct.edit') }}/{{$rel->id}}">									
									<?php $catname = App\Category::getcatname($rel->cat_id); ?>{{$rel->product_name}}</a>
                                    
                                    @endif
                                    
                                    
                                    </td>
                                    <td>
									<?php $catname = App\Category::getcatname($rel->cat_id); ?>{{$catname->name}}</td>
                                    <td>${{number_format($rel->product_mrp,2)}}</td>
                                    <td>
                                    @if($rel->product_type!=1)
                                    Singal Product
                                    @else
                                    Custom Product
                                    @endif
                                    </td>
                                  </tr>
                                  <?php } }else{

                                  } ?>
                                </table>
                               </div>

                          
                                
                           </div><!-- panel-body -->

                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                         
                     

                        <iframe id="form_target" name="form_target" style="display:none"></iframe>
                     </div>
                     <!-- form start -->
                       <iframe id="form_target" name="form_target" style="display:none"></iframe>
                     </div>
                
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
    <script src="{{ config('voyager.assets_path') }}/lib/js/tinymce/tinymce.min.js"></script>
    <script src="{{ config('voyager.assets_path') }}/js/voyager_tinymce.js"></script>
   
    
@stop
