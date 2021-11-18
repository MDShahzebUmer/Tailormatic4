@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
   <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left:60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Add/Edit Lining Fabric</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 1)
                    <div class="panel-heading">
                            <h3 class="panel-title">Add Lining Fabric</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                            <div class="panel-body">
                             <div class="form-group">
                              <label for="inside_view">Category</label>
                              <select name="cat_id[]" id="cat_id" class="form-control select2" required multiple>
                                <?php $catg = TCG\Voyager\Models\Category::select('*')
                                ->where('id' ,'=', 2)
                                ->Orwhere('id' ,'=', '3')
                                ->get(); ?>
                                @foreach($catg as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="fabric_name">Fabric Name.</label>
                              <input type="text" class="form-control" name="fabric_name"
                              placeholder="Fabric Name" id="fabric_name"
                              value="" required>
                            </div>
                            <div class="form-group">
                              <label for="lining_img">Fabric Image.</label>
                              <input type="file" name="lining_img">
                            </div>
                            <div class="form-group">
                              <label for="main_imgj">Inside View Image Jacket.</label>
                              <input type="file" name="main_imgj" required>
                            </div>
                            <div class="form-group">
                              <label for="main_imgv">Inside View Image Vests.</label>
                              <input type="file" name="main_imgv" required>
                            </div>
                            <div class="form-group">
                              <label for="back_img">Back Img Vests.</label>
                              <input type="file" name="back_img" required>
                            </div>
                            <div class="form-group">
                              <label for="cut_img">Cut Image Vests.</label>
                              <input type="file" name="cut_img" required>
                            </div>
                          </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Lining Fabric</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                              
                                 <div class="form-group">
                                    
                                  <label for="fabric_name">Fabric Name.</label>
                                  <input type="text" class="form-control" name="fabric_name"
                                  placeholder="Fabric Name" id="fabric_name"
                                  value="{{$data->fabric_name}}" >
                                 </div>
                                 <div class="form-group">
                                  <label for="lining_img">Fabric Image.</label>
                                   <img src="{{URL::asset('/storage/'.$data->lining_img)}}" style="width:50px">
                                  <input type="file" name="lining_img">
                                  <input type="hidden" name="id"  value="{{$data->id}}">
                                  <input type="hidden" name="cat_id"  value="{{$data->cat_id}}">
                                </div>
                                @if($data->cat_id == 2)
                                <div class="form-group">
                                  <label for="inside_view">Inside View Image Jacket.</label>
                                  <img src="{{URL::asset('/storage/'.$data->inside_view)}}" style="width:50px">
                                  <input type="file" name="inside_view" >
                                </div>
                                @else
                                <div class="form-group">
                                  <label for="inside_view">Inside View Image Vests.</label>
                                   <img src="{{URL::asset('/storage/'.$data->inside_view)}}" style="width:50px">
                                  <input type="file" name="inside_view" >
                                </div>
                                <div class="form-group">
                                  <label for="back_img">Back Img Vests.</label>
                                   <img src="{{URL::asset('/storage/'.$data->back_img)}}" style="width:50px">
                                  <input type="file" name="back_img" required>
                                </div>
                                <div class="form-group">
                                  <label for="cut_img">Cut Image Vests.</label>
                                   <img src="{{URL::asset('/storage/'.$data->cut_img)}}" style="width:50px">
                                  <input type="file" name="cut_img" required>
                                </div>
                                @endif
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
