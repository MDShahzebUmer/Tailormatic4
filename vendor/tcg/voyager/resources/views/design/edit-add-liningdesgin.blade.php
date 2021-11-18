@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title"><i class="voyager-data"></i>Add/Edit Lining Fabric</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                  @if($type == 1)
                    <div class="panel-heading">
                            <h3 class="panel-title">Add Lining Fabric Style</h3>
                        </div>
                        <!-- form start -->
                         <?php $gg = App\JvLiningDesgin::get_lining_option_list($id,$ids);
                        $style = App\AttributeStyle::select('id','style_name')->where('attri_id', '=' , $id)->whereNotIn('id', $gg)->get(); ?>
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                            <div class="panel-body">
                             <div class="form-group">
                              <label for="inside_view">Select Jacket Style Desgin</label>
                              <select name="style_id" id="cat_id" class="form-control select" required>
                                @foreach($style as $d)
                                <option value="{{$d->id}}">{{$d->style_name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="main_img">Lining Desgin Image.</label>
                              <input type="file" name="front_img" required>
                              <input type="hidden" name="attri_id" value="{{$id}}" required>
                              <input type="hidden" name="lining_id" value="{{$ids}}" required>
                              
                            </div>
                          </div><!-- panel-body -->
                           <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit " @php echo App\JvLiningDesgin::get_jv_attriname($data->style_id,$data->attri_id); @endphp " Lining Fabric Style</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                              <div class="form-group">
                                  <label for="lining_img">Fabric Image.</label>
                                   <img src="{{URL::asset('/storage/'.$data->front_img)}}" style="width:60px">
                                  <input type="file"   name="front_img">
                                  <input type="hidden" name="id"  value="{{$data->id}}">
                                  <input type="hidden" name="lining_id"  value="{{$data->lining_id}}">
                                  <input type="hidden" name="style_id"  value="{{$data->style_id}}">
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
