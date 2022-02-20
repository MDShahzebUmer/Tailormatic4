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
                 
                    <div class="panel-heading">
                            <h3 class="panel-title">Add/Edit Product Category</h3>
                        </div>
                        <!-- form start -->
                        @if($type == 1)
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                             <div class="panel-body">
                              <?php 
                                 $catg = App\Category::get_relation_catname();
                                
                                 ?>
                                  <div class="form-group">
                                    <label for="cat_id">Select Category</label>
                                   <select name="cat_id" id="cat_id" class="form-control" required>
                                      <option value="">Select Category</option>
                                       <?php if(!empty($catg)) {

                                       foreach($catg as  $v) {?>
                                      <option value="<?php echo $v['cat_id']; ?>"><?php echo $v['cat_name']; ?>
                                         <?php if(!empty($v['sub_cat1'])) { 
                                          foreach ($v['sub_cat1'] as $key => $sub_cat) { ?>
                                          <p>Sub Category</p>
                                            <option value="<?php echo $sub_cat['sub1cat_id']; ?>">--<?php echo $sub_cat['sub1cat_name']; ?>
                                             <?php   if (!empty($sub_cat['sub_cat2'])) { 
                                              foreach ($sub_cat['sub_cat2'] as $key => $sub_cat2) { ?>
                                              <optgroup label="Second Sub Category">
                                                <option value="<?php echo $sub_cat2['sub2cat_id'];  ?>">---<?php echo $sub_cat2['sub2cat_name']; ?>
                                                  <?php if(!empty($sub_cat2['sub_cat3'])) { 
                                                    foreach ($sub_cat2['sub_cat3'] as $key => $sub_cat3) { ?>
                                                  <optgroup label="Four Sub Category">
                                                    <option value="<?php echo $sub_cat3['sub2cat_id']; ?>">----<?php echo $sub_cat3['sub3cat_name']; ?></option>
                                                  </optgroup>
                                                  <?php } }?>
                                                </option>
                                              </optgroup>
                                              <?php } } ?>
                                            </option>
                                           </optgroup> 
                                         <?php } } ?>
                                        </option>
                                    
                                      <?php } } ?>
                                   </select>
                                </div>

                           </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                             <div class="panel-body">
                              <?php 
                                 $catg = App\Category::get_relation_catname();
                              
                                 ?>
                                  <div class="form-group">
                                    <label for="cat_id">Select Category</label>
                                   <select name="cat_id" id="cat_id" class="form-control" required>
                                      <option value="">Select Category</option>
                                       <?php if(!empty($catg)) {

                                       foreach($catg as  $v) {?>
                                      <option value="<?php echo $v['cat_id']; ?>" @if(isset($catg) && $id == $v['cat_id']) selected @endif ><?php echo $v['cat_name']; ?>
                                         <?php if(!empty($v['sub_cat1'])) { 
                                          foreach ($v['sub_cat1'] as $key => $sub_cat) { ?>
                                          <optgroup label="Sub Category">
                                            <option value="<?php echo $sub_cat['sub1cat_id']; ?>" @if(isset($catg) && $id == $sub_cat['sub1cat_id']) selected @endif>--<?php echo $sub_cat['sub1cat_name']; ?>
                                             <?php   if (!empty($sub_cat['sub_cat2'])) { 
                                              foreach ($sub_cat['sub_cat2'] as $key => $sub_cat2) { ?>
                                              <optgroup label="Second Sub Category">
                                                <option value="<?php echo $sub_cat2['sub2cat_id'];  ?>" @if(isset($catg) && $id == $sub_cat2['sub2cat_id']) selected @endif>---<?php echo $sub_cat2['sub2cat_name']; ?>
                                                  <?php if(!empty($sub_cat2['sub_cat3'])) { 
                                                    foreach ($sub_cat2['sub_cat3'] as $key => $sub_cat3) { ?>
                                                  <optgroup label="Four Sub Category">
                                                    <option value="<?php echo $sub_cat3['sub3cat_id']; ?>" @if(isset($catg) && $id == $sub_cat3['sub3cat_id']) selected @endif >----<?php echo $sub_cat3['sub3cat_name']; ?></option>
                                                  </optgroup>
                                                  <?php } }?>
                                                </option>
                                              </optgroup>
                                              <?php } } ?>
                                            </option>
                                           </optgroup> 
                                         <?php } } ?>
                                        </option>
                                    
                                      <?php } } ?>
                                   </select>
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
