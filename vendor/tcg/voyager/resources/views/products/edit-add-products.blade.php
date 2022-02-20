@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
   <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Add Product</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 1)
                    <div class="panel-heading">
                            <h3 class="panel-title">Add Product</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="{{ url('/admin/productslists/save') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                             <div class="panel-body">
                              <?php 
                                 
                                 $mert      =  App\MeasurmentSize::get_standardSize();
                                 $pcolor    =  App\EcollectionColor::get_color_product();
                                 $fpattern  =  App\EcollectionPattern::fabric_pattern();
                                 $ftype     =  App\EcollectionFabrictype::fabric_types_catId($pr_catg);
                                 $jvp       =  App\StandardSize::get_standersizeno();
                                 ?>
                                 <div class="form-group">
                                  <label for="product_name">Product Name.</label>
                                  <input type="text" class="form-control" name="product_name"
                                  placeholder="Product Name" id="product_name"
                                  value="" required>
                                </div>
                                 <div class="form-group" >
                                  <label for="product_name">Product Code.</label>
                                  <input type="text" class="form-control" name="sku_code"
                                  placeholder="Product Code" id="sku_code"
                                  value="" required>
                                  <input type="hidden" class="form-control" name="cat_id"
                                 value="{{$id}}" required>
                                 <input type="hidden" class="form-control" name="main_catid"
                                 value="{{$pr_catg}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="brand">Fabric Name.</label>
                                    <input type="text" class="form-control" name="fabric_name"
                                           placeholder="Fabric Name" id="fabric_name"
                                           value="">
                                 </div>
                                  <div class="form-group">
                                    <label for="brand">Fabric Description.</label>
                                    <textarea name="fabric_dec" class="form-control" rows="2" name="fabric_dec"></textarea>
                                 </div>
                                 
                                 <div class="form-group">
                                    <label for="color_desc">Color Description.</label>
                                    <textarea name="color_desc" class="form-control" rows="2" name="color_desc"></textarea>
                                 </div>
                                 <div class="form-group">
                                  <label for="fabric_brand">Fabric Brand.</label>
                                  <input type="text" class="form-control" name="fabric_brand"
                                  placeholder="Fabric Brand" id="fabric_brand"
                                  value="">
                                </div>

                                 
                                 <?php if($mt  == 1) { ?>
                                 <div class="form-group">
                                   <label for="size_list">Select Size</label>
                                   <select name="product_size[]" id="size_list" class="form-control select2" multiple>
                                    <option value=""  >Select Size</option>
                                    @foreach($mert as $m)
                                    <option value="<?php echo $m['id']; ?>"><?php echo $m['name']; ?> </option>
                                    @endforeach
                                  </select>
                                </div>

                                <?php } elseif($mt == 2 || $mt == 3  || $mt == 4) { ?>
                                <div class="form-group">
                                   <label for="product_size">Select Size</label>
                                   <select name="product_size[]" id="size_list" class="form-control select2" multiple>
                                    <option value=""  >Select Size</option>
                                    @foreach($jvp as $j)
                                    <option value="<?php echo $j['id']; ?>"><?php echo $j['value']; ?> </option>
                                    @endforeach
                                  </select>
                                </div>

                                <?php  }else{?>
                              
                                 <input type="hidden" class="form-control" name="product_size[]" value="">

                              <?php  }?>
                                 
                               
                                
                                <div class="form-group">
                                   <label for="size_list">Select Product Pattern</label>
                                   <select name="product_pattern" id="product_pattern" class="form-control"  required>
                                    <option value=""  >Select Product Pattern</option>
                                    @foreach($fpattern as $fp)
                                    <option value="<?php echo $fp['id']; ?>"><?php echo $fp['name']; ?> </option>
                                    @endforeach
                                  </select>
                                </div>

                                <div class="form-group">
                                   <label for="size_list">Select Fabric Type</label>
                                   <select name="fabric_type" id="fabric_type" class="form-control"  required>
                                    <option value=""  >Select Fabric Type</option>
                                    @foreach($ftype as $ft)
                                    <option value="<?php echo $ft['id']; ?>"><?php echo $ft['type_name']; ?> </option>
                                    @endforeach
                                  </select>
                                </div>

                                 <div class="form-group">
                                    <label for="initial_stock">Initial Stock.</label>
                                    <input type="text" class="form-control" name="initial_stock"
                                           placeholder="Product Initial Stock" id="initial_stock"
                                           value="1" onkeypress='return event.charCode >= 46 && event.charCode <= 57'>
                                 </div>

                                <div class="form-group">
                                    <label for="product_mrp">Product MRP.</label>
                                    <input type="text" class="form-control" name="product_mrp"
                                           placeholder="Product MRP" id="product_mrp"
                                           value="" required onkeypress='return event.charCode >= 46 && event.charCode <= 57'>
                                 </div>
                                 <div class="form-group">
                                  <label for="product_offer_rate">Product Offer Price.</label>
                                  <input type="text" class="form-control" name="product_offer_rate"
                                  placeholder="Product Offer Price" id="product_offer_rate"
                                   value="0" onkeypress='return event.charCode >= 46 && event.charCode <= 57'>
                                </div>


                                 
                                 <div class="form-group">
                                    <label for="qty_desc">Quality Description.</label>
                                 <textarea name="quality_desc" class="form-control" rows="3" name="qty_desc"></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="price">Main Img.<code>WxH--800*800</code></label>
                                  <input type="file"  name="img[]"
                                  value="" required>
                                </div>
                                <div class="form-group">
                                  <label for="price">Image.one <code>WxH--800*800</code></label>
                                  <input type="file" name="img[]"
                                  value="" required>
                                </div>
                                <div class="form-group">
                                  <label for="price">Image two.<code>WxH--800*800</code></label>
                                  <input type="file"  name="img[]"
                                  value="">
                                </div>
                                <div class="form-group">
                                  <label for="price">Image Three.<code>WxH--800*800</code></label>
                                  <input type="file"  name="img[]"
                                  value="">
                                </div>
                                <div class="form-group">
                                  <label for="price">Image Four.<code>WxH--800*800</code></label>
                                  <input type="file"  name="img[]"
                                  value="">
                                </div>
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
                                    <th>View</th>
                                  </tr>
                                  <?php if(count($relpro) > 0)  {
                                    foreach($relpro as $rel){
                                   ?>
                                  <tr>
                                    <td><input type="checkbox" name="relateds_id[]" value="{{$rel->id}}"></td>
                                    <td>{{$rel->id}}</td>
                                    <td>{{$rel->sku_code}}</td>
                                    <td>{{$rel->product_name}}</td>
                                    <td><?php $catname = App\Category::getcatname($rel->cat_id); ?>{{$catname->name}}</td>
                                    <td>{{$rel->product_mrp}}</td>
                                    <td></td>
                                  </tr>
                                  <?php } } ?>
                                </table>
                               </div>
                                
                           </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                <!-- Product Edit Section start  -->        
                        @else
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Product</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="{{ route('voyager.productslists.savepost') }}/{{$productId->id}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                             <div class="panel-body">
                              <?php 
                                 
                                 $mert      =  App\MeasurmentSize::get_standardSize();
                                 $pcolor    =  App\EcollectionColor::get_color_product();
                                 $fpattern  =  App\EcollectionPattern::fabric_pattern();
                                 $ftype     =  App\EcollectionFabrictype::fabric_types_catId($pr_catg);
                                 $jvp       =  App\StandardSize::get_standersizeno();
                                 ?>
                                 <div class="form-group">
                                  <label for="product_name">Product Name.</label>
                                  <input type="text" class="form-control" name="product_name"
                                  placeholder="Product Name" id="product_name"
                                  required value="{{$productId->product_name}}">
                                </div>
                                 <div class="form-group" >
                                  <label for="product_name">Product Code.</label>
                                  <input type="text" class="form-control" name="sku_code"
                                  placeholder="Product Code" id="sku_code"
                                   required value="{{$productId->sku_code}}">

                                  <input type="hidden" class="form-control" name="cat_id"
                                 value="{{$catid}}" required>
                                 <input type="hidden" class="form-control" name="main_catid"
                                 value="{{$pr_catg}}" required >
                                </div>
                                 <div class="form-group">
                                    <label for="brand">Fabric Name.</label>
                                    <input type="text" class="form-control" name="fabric_name"
                                           placeholder="Fabric Name" id="fabric_name"
                                           value="{{$productId->fabric_name}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="brand">Fabric Description.</label>
                                    <textarea name="fabric_dec" class="form-control" rows="2" name="fabric_dec"><?php echo $productId->fabric_dec; ?></textarea>
                                 </div>
                                 
                                <div class="form-group">
                                    <label for="color_desc">Color Description.</label>
                                    <textarea name="color_desc" class="form-control" rows="2" name="color_desc">{{$productId->color_desc}}</textarea>
                                 </div>
                                 <div class="form-group">
                                    <label for="fabric_brand">Fabric Brand.</label>
                                    <input type="text" class="form-control" name="fabric_brand"
                                           placeholder="Fabric Brand" id="fabric_brand"
                                           value="{{$productId->fabric_brand}}">
                                 </div>

                                 
                                 <?php if($mt  == 1) { ?>
                                 <div class="form-group">
                                   <label for="size_list">Select Size</label>
                                   <select name="product_size[]" id="size_list" class="form-control select2" multiple required >
                                    <option value=""  >Select Size</option>
                                    @if($sets == 4)
                                    @foreach($mert as $m)
                                    <option value="<?php echo $m['id']; ?>" <?php echo App\EcollectionColor::get_checked_sizeP($productId->id,$m['id']); ?>><?php echo $m['name']; ?> </option>
                                    @endforeach
                                    @else
                                    @foreach($mert as $m)
                                    <option value="<?php echo $m['id']; ?>"><?php echo $m['name']; ?> </option>
                                    @endforeach
                                    @endif
                                  </select>
                                </div>
                                <?php } elseif($mt  == 2 || $mt  == 3 || $mt  == 4) { ?>
                                <div class="form-group">
                                   <label for="product_size">Select Size</label>
                                   <select name="product_size[]" id="size_list" class="form-control select2" multiple required >
                                    <option value=""  >Select Size</option>
                                    @if($sets == 4)
                                    @foreach($jvp as $j)
                                    <option value="<?php echo $j['id']; ?>" <?php echo App\EcollectionColor::get_checked_sizeP($productId->id,$j['id']); ?>><?php echo $j['value']; ?> </option>
                                    @endforeach
                                    @else
                                    @foreach($jvp as $j)
                                    <option value="<?php echo $j['id']; ?>"><?php echo $j['value']; ?> </option>
                                    @endforeach

                                    @endif
                                  </select>
                                </div>
                                  <?php  }else{?>
                                  
                                   <input type="hidden" class="form-control" name="product_size[]"
                                     id="product_size[]">
                                    <?php }?>
                                 
                                
                                <div class="form-group">
                                   <label for="size_list">Select Product Pattern</label>
                                   <select name="product_pattern" id="product_pattern" class="form-control"  required>
                                    <option value=""  >Select Product Pattern</option>
                                    @foreach($fpattern as $fp)
                                    <option value="<?php echo $fp['id']; ?>" @if(isset($fpattern) && $fp['id'] == $productId->product_pattern) selected @endif><?php echo $fp['name']; ?> </option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                   <label for="size_list">Select Fabric Type</label>
                                   <select name="fabric_type" id="fabric_type" class="form-control"  required>
                                    <option value=""  >Select Fabric Type</option>
                                    @foreach($ftype as $ft)
                                    <option value="<?php echo $ft['id']; ?>" @if(isset($ftype) && $ft['id'] == $productId->fabric_type) selected @endif><?php echo $ft['type_name']; ?> </option>
                                    @endforeach
                                  </select>
                                </div>
                                 
                                 <div class="form-group">
                                    <label for="initial_stock">Initial Stock.</label>
                                    <input type="text" class="form-control" name="initial_stock"
                                           placeholder="Product Initial Stock" id="initial_stock"
                                          value="{{$productId->initial_stock}}">
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
                                    <label for="qty_desc">Quality Description.</label>
                                 <textarea name="quality_desc" class="form-control" rows="3" name="qty_desc">{{$productId->quality_desc}}</textarea>
                                </div>
                              
                                <?php  $pc = count($proimg);
                                     $lp = (5-$pc);
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
                                    <th>View</th>
                                  </tr>
                                 
                                  <?php if(count($relpro) > 0)  {
                                    foreach($relpro as $rel){
                                   ?>
                                  <tr>
                                    <td><input type="checkbox" name="relateds_id[]" value="{{$rel->id}}" <?php  echo $chek = App\EcollectionRelated::get_checked_relatedP($productId->id,$rel->id) ?>></td>
                                    <td>{{$rel->id}}</td>
                                    <td>{{$rel->sku_code}}</td>
                                    <td>{{$rel->product_name}}</td>
                                    <td><?php $catname = App\Category::getcatname($rel->cat_id); ?>{{$catname->name}}</td>
                                    <td>{{$rel->product_mrp}}</td>
                                    <td></td>
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
                         
                        @endif

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
