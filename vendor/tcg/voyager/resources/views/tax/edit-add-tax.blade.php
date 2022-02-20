@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
  <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Edit Tax Rate</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                        <!-- form start -->
                        
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                 
                               
                          
                        <div class="form-group">
                        <label for="product_name">Tax Rate.(%)</label>
                        <input type="text" class="form-control" name="tax_rates" placeholder="Tax Rate" id="tax" value="{{$taxdata->tax_rates}}">
                        </div>
                                    
                          <div class="form-group">
                        <label for="product_name">Status</label>
                         <select name="tax_status" id="tax_status" class="form-control select2">               
                        <option value="1" <?php if($taxdata->tax_status==1){ echo 'selected';}?> >Enable</option>
                        <option value="0" <?php if($taxdata->tax_status==0){ echo 'selected';}?>>Disable</option>
                        </select>
                        </div>
                            
                            
                             </div><!-- panel-body -->
                           <div class="panel-footer">
                           <input type="hidden" class="form-control" name="id" value="{{$taxdata->id}}"  />
                                <button type="submit" class="btn btn-primary">Update</button>
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
