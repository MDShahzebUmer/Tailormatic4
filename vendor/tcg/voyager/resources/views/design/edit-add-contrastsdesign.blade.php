@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
   <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Fabric Contrasts Design</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 'edit')
                  @foreach($maindata as $md)@endforeach
                   <?php $coit = App\ContrastOptionIimgType::select('*')->where('id', '=', $md->contrast_type_id)->get(); ?>
                   @foreach($coit as $c)@endforeach
                    <div class="panel-heading">
                            <h3 class="panel-title">Edit "{{$c->type_name}}" Contrasts Image</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                              
                                <div class="form-group">
                                <input type="hidden" class="form-control" name="contrast_type_id" value="{{$md->contrast_type_id}}">
                                  <input type="hidden" class="form-control" name="opt_id" value="{{$md->opt_id}}">
                                  <input type="hidden" name="contrast_id" value="{{$md->contrast_id}}">
                                  <input type="hidden" name="id" value="{{$md->id}}" >
                                 </div>
                                 
                               <div class="form-group">
                                    <label for="contrsfab_img">Image.</label>
                                    <img src="{{URL::asset('/storage/'.$md->main_img)}}" style="width:100px">
                                    <input type="file" name="main_img" title="Change image">
                                </div>
                                
                           </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                         <div class="panel-heading">
                            <h3 class="panel-title">Create Contrasts Option</h3>
                        </div>
                        
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}

                            <?php $coit = App\ContrastOptionIimgType::select('*')->where('opt_id', '=', $ids)->get(); ?>
                             <div class="panel-body">
                                <div class="form-group">
                                    <label for="inside_view">Type</label>
                                   <select name="contrast_type_id" id="contrast_type_id" class="form-control select" required>
                                        @if(!empty($coit))
                                         @foreach($coit as $c)
                                         <option value="{{$c->id}}">{{$c->type_name}}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                  
                                </div>

                                 <div class="form-group">
                                  <input type="hidden" class="form-control" name="opt_id" value="{{$ids}}">
                                    <input type="hidden" class="form-control" name="contrast_id"
                                            value="{{$id}}" required>
                                 </div>
                                
                               <div class="form-group">
                                    <label for="contrsfab_img">Image.</label>
                                  <input type="file" name="main_img">
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
