@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <div class="row">
        <div class="col-md-4">
            <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Fabric Design</h1> 
        </div>
        @php 
            $slug = Request::segments(1);
            $one = $slug[2];
            $two = $slug[3]; 
            $slug = App\Stylefabimglist::get_add_slug($one , $two); 
        @endphp
        <div class="col-md-8">
            <a href="<?php echo url('admin/categories');?>" class="btn btn-success" title="Category Name" alt="">{{$slug['name']}}  <b>&raquo;</b></a>
            <a href="<?php echo url('admin/fabric');?>" class="btn btn-success"title="Fabric Group Name" alt="">{{$slug['fbgrp_name']}} <b>&raquo;</b></a>
            <a href="<?php echo url('admin/fabricdesign/').'/'.$slug['fab_id'].'-'.$slug['attri_id']?>" class="btn btn-success active" title="Fabric Name" alt="">{{$slug['fabric_name']}}</a>
        </div>
    </div>
@stop
@section('content')
<style>
.clhide{ display:none;}
</style>
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title">Automatic Design</h3>
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
                            <label for="fab_images">Select Zip File</label>
                            <input type="file" name="fab_images">
                        </div>
                        <input type="hidden" name="fab_id" value="{{$fab_id}}">
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div><!-- panel-body -->
                </form>
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
