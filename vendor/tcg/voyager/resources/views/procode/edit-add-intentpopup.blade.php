@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
   <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Edit Promotion Popup</h1>  
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
                        <label for="product_name">Image <code>WxH-394x298</code></label>
                        <input type="file"  name="img">
                        
                         @if($data->img != '')
                         <img src="{{url('storage/').'/'.$data->img}}" width="100px" height="100px">
                         @endif
                        </div>
                        <div class="form-group">
                        <label for="product_name">Url</label>
                        <input type="hidden"  name="pop_id" required value="{{$data->id}}">
                        <input type="text" class="form-control" name="url" value="{{$data->url}}" placeholder="Image Url" id="image_url" required>
                        </div>
                                    
                        <div class="form-group">
                        <label for="product_name">Status</label>
                         <select name="status" id="status" class="form-control" required>               
                        <option value="" >Select Status</option>
                         <option value="1" <?php if($data->status==1){ echo 'selected';}?> >Enable</option>
                        <option value="0" <?php if($data->status==0){ echo 'selected';}?>>Disable</option>
                        </select>
                        </div>
                            
                            
                             </div><!-- panel-body -->
                           <div class="panel-footer">
                         
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
