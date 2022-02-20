@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title" style="height:70px;"><i class="voyager-data"></i>Fabric Design</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    @if($type==1)
                        @foreach($opt as $o)
                        @endforeach
                        <div class="panel-heading">
                            <h3 class="panel-title">Add "{{$o->name}}" Image</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="panel-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <!--  <?php //print_r($opt); echo $opt->attri_id;?> -->
                                <div class="form-group">
                                    <label for="password">Main Image</label>
                                  <input type="file" name="img1">
                                </div>
                                <div class="form-group">
                                    <label for="password">Rignt Image</label>
                                   <input type="file" name="img2">
                                </div>
                                <div class="form-group">
                                    <label for="password">Front Image</label>
                                   <input type="file" name="img3">
                                </div>
                                <div class="form-group">
                                    <label for="password">Back Image</label>
                                    <input type="file" name="img4">
                                </div>
                            </div><!-- panel-body -->

                            <div class="panel-footer">
                                <input type="hidden" name="opt_id" value="{{$o->id}}">
                                <input type="hidden" name="fab_id" value="{{$f}}">
                                <input type="hidden" name="att_id" value="{{$a}}">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    @else
                        <div class="panel-heading">
                         @foreach($fabstylelist as $editd)
                          @endforeach
                            <h3 class="panel-title">Edit {{$optname}}</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="panel-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="password">Main Image</label>
                                    @if($editd->left_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->left_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                    <input type="file" name="img1">
                                </div>
                                <div class="form-group">
                                    <label for="password">Rignt Image</label>
                                     @if($editd->reight_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->reight_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                    <input type="file" name="img2">
                                </div>
                                <div class="form-group">
                                    <label for="password">Front Image</label>
                                     @if($editd->inside_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->inside_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                    <input type="file" name="img3">
                                </div>
                                <div class="form-group">
                                    <label for="password">Back Image</label>
                                      @if($editd->back_img!='')
                                    <img src="{{URL::asset('/storage/'.$editd->back_img)}}" style="width:100px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                    <input type="file" name="img4">
                                </div>
                                
                                <div class="form-group">
                                    <label for="inside_view">Status</label>
                                    <select name="status" id="status" class="form-control">
                                         <option value="">Select Status</option>
                                         <option <?php if($editd->status==1){?> selected<?php }?> value="1">Enable</option>
                                         <option <?php if($editd->status==0){?> selected<?php }?> value="0">Disable</option>
                                    </select>
                                    <input type="hidden" name="id" value="{{$editd->id}}">
                                    <input type="hidden" class="form-control" name="fab_id" value="{{$editd->fab_id}}">
                                    <input type="hidden" name="opt_id" value="{{$editd->opt_id}}">
                                </div>
                            </div><!-- panel-body -->
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    @endif
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
