@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data"  style="top:18px;left:30px;font-size:20px;"></i>Fabric Design</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 'edit')
                    <div class="panel-heading">
                            <h3 class="panel-title">Edit Fabric Contrasts</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                <div class="form-group">
                                    <label for="inside_view">Category</label>
                                  @if(!$conts->isEmpty())
                                   @foreach($conts as $con)@endforeach
                                   @endif
                                   <select name="cat_id" id="cat_id" class="form-control select" required>
                                    <?php $catg = TCG\Voyager\Models\Category::all(); ?>
                                    @foreach($catg as $c)
                                        <option value="{{$c->id}}" @if(isset($conts) && $con->cat_id == $c->id) selected @endif>{{$c->name}}</option>
                                    @endforeach
                                </select>
                                    
                                </div>
                                 <div class="form-group">
                                    <label for="contrsfab_name">Fabric Name.</label>
                                    <input type="text" class="form-control" name="contrsfab_name"
                                           placeholder="Fabric Name" id="contrsfab_name"
                                           value="{{$con->contrsfab_name}}" required>
                                 </div>
                                <div class="form-group">
                                    <label for="style_code">Fabric Qty.</label>
                                    <input type="text" class="form-control" name="qty"
                                           placeholder="Qty" id="qty"
                                           value="{{$con->qty}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="min_qty">Fabric Min Qty.</label>
                                    <input type="text" class="form-control" name="min_qty"
                                           placeholder="Style Code" id="min_qty"
                                           value="{{$con->min_qty}}" required>
                                </div>
                                <span><b>Fabric List Image Size. (WxH)(436x567),JPG Format, 15-20.KB.</b></span>
                               <div class="form-group">
                                    <label for="contrsfab_img">List Image.</label>
                                    <img src="{{URL::asset('/storage/'.$con->contrsfab_img)}}" style="width:100px">
                                    <input type="file" name="contrsfab_img" title="Change image">
                                    <input type="hidden" name="id"  value="{{$con->id}}">
                                </div>
                                <div class="form-group">
                                    <label for="show_imh">Show Image.</label>
                                    @if($con->show_img)
                                    <img src="{{URL::asset('/storage/'.$con->show_img)}}" style="width:100px">
                                    @endif
                                  <input type="file" name="show_img">
                                </div>
                                
                           </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                         <div class="panel-heading">
                            <h3 class="panel-title">Create Fabric Contrasts</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                <div class="form-group">
                                    <label for="inside_view">Category</label>
                                   <select name="cat_id[]" id="cat_id" class="form-control select2" required multiple>
                                        @if(!empty($cat))
                                         @foreach($cat as $c)
                                         <option value="{{$c->id}}">{{$c->name}}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                    
                                </div>
                                 <div class="form-group">
                                    <label for="contrsfab_name">Fabric Name.</label>
                                    <input type="text" class="form-control" name="contrsfab_name"
                                           placeholder="Fabric Name" id="contrsfab_name"
                                           value="" required>
                                 </div>
                                <div class="form-group">
                                    <label for="style_code">Fabric Qty.</label>
                                    <input type="text" class="form-control" name="qty"
                                           placeholder="Qty" id="qty"
                                           value="">
                                </div>
                                <div class="form-group">
                                    <label for="min_qty">Fabric Min Qty.</label>
                                    <input type="text" class="form-control" name="min_qty"
                                           placeholder="Style Code" id="min_qty"
                                           value="2">
                                </div>
                              <span><b>Fabric List Image Size. (WxH)(436x567),JPG Format, 15-20.KB.</b></span>
                               <div class="form-group">
                                    <label for="contrsfab_img">List Image.</label>
                                  <input type="file" name="contrsfab_img">
                                </div>
                                <div class="form-group">
                                    <label for="show_img">Show Image.</label>
                                  <input type="file" name="show_img">
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
