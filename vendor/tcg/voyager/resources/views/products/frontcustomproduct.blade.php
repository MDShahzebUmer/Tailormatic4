@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        
        .img_settings_container {
            width: 110px;
            height: auto;
            position: relative;
        }

        .img_settings_container > a {
            position: absolute;
            right: 0px;
            top: -10px;
            display: block;
            padding: 5px;
            background: #F94F3B;
            color: #fff;
            border-radius: 13px;
            width: 25px;
            height: 25px;
            font-size: 15px;
            line-height: 19px;
        }

       

       
    </style>
@stop
@section('page_header')
    <h1 class="page-title" style="height:70px;"><i class="voyager-data"></i>Continue Shopping</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading"> <h3 class="panel-title">Edit Front Images</h3></div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h5 class="panel-title">Image One <code>WxH=360x225</code></h5>
                             <div class="panel-body">
                             	<div class="img_settings_container">
                             		<img src="{{URL::asset('/storage/'.$imgone->img )}}" style="width:100px; height:auto; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                             	</div>
                             	<div class="form-group">
                             		<label for="brand">Image One.</label>
                             		<input type="file" name="img">
                             		<input type="hidden" name="id" value="{{$imgone->id}}">
                             	</div>
                             
                             	<div class="form-group col-md-6">
                             		<label for="brand">Tile One.</label>
                             		<input type="text" name="title_one" class="form-control" value="{{$imgone->title_one}}">
                             	</div>

                             	<div class="form-group col-md-6">
                             		<label for="brand">Tile Two.</label>
                             		<input type="text" name="title_two" class="form-control" value="{{$imgone->title_two}}">
                             	</div>
                             	<div class="form-group col-md-6">
                             		<label for="brand">Price.</label>
                             		<input type="text" name="rate" class="form-control" value="{{$imgone->rate}}">
                             	</div>
                             	<div class="form-group col-md-6">
                             		<label for="brand">Url.</label>
                             		<input type="text" name="url" class="form-control" value="{{$imgone->url}}">
                             	</div>
                          </div><!-- panel-body -->
                          <div class="panel-footer">
                          	<button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                     <!-- form start -->
                     <!-- img2 -->
                      <form role="form" action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h5 class="panel-title">Image Two <code>WxH=360x435</code></h5>
                             <div class="panel-body">
                             	<div class="img_settings_container">
                             		<img src="{{URL::asset('/storage/'.$imgtwo->img )}}" style="width:100px; height:auto; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                             	</div>
                             	<div class="form-group">
                             		<label for="brand">Image Two.</label>
                             		<input type="file" name="img">
                             		<input type="hidden" name="id" value="{{$imgtwo->id}}">
                             	</div>
                             
                             	<div class="form-group col-md-6">
                             		<label for="brand">Tile One.</label>
                             		<input type="text" name="title_one" class="form-control" value="{{$imgtwo->title_one}}">
                             	</div>

                             	<div class="form-group col-md-6">
                             		<label for="brand">Tile Two.</label>
                             		<input type="text" name="title_two" class="form-control" value="{{$imgtwo->title_two}}">
                             	</div>
                             	<div class="form-group col-md-6">
                             		<label for="brand">Price.</label>
                             		<input type="text" name="rate" class="form-control" value="{{$imgtwo->rate}}">
                             	</div>
                             	<div class="form-group col-md-6">
                             		<label for="brand">Url.</label>
                             		<input type="text" name="url" class="form-control" value="{{$imgtwo->url}}">
                             	</div>
                          </div><!-- panel-body -->
                          <div class="panel-footer">
                          	<button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                     <!-- End -->
                     <!-- img3 -->
                      <form role="form" action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h5 class="panel-title">Image Three <code>WxH=750x385</code></h5>
                             <div class="panel-body">
                             	<div class="img_settings_container">
                             		<img src="{{URL::asset('/storage/'.$imgthree->img )}}" style="width:100px; height:auto; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                             	</div>
                             	<div class="form-group">
                             		<label for="brand">Image Three.</label>
                             		<input type="file" name="img">
                             		<input type="hidden" name="id" value="{{$imgthree->id}}">
                             	</div>
                             
                             	<div class="form-group col-md-6">
                             		<label for="brand">Tile One.</label>
                             		<input type="text" name="title_one" class="form-control" value="{{$imgthree->title_one}}">
                             	</div>

                             	<div class="form-group col-md-6">
                             		<label for="brand">Tile Two.</label>
                             		<input type="text" name="title_two" class="form-control" value="{{$imgthree->title_two}}">
                             	</div>
                             	<div class="form-group col-md-6">
                             		<label for="brand">Price.</label>
                             		<input type="text" name="rate" class="form-control" value="{{$imgthree->rate}}">
                             	</div>
                             	<div class="form-group col-md-6">
                             		<label for="brand">Url.</label>
                             		<input type="text" name="url" class="form-control" value="{{$imgthree->url}}">
                             	</div>
                          </div><!-- panel-body -->
                          <div class="panel-footer">
                          	<button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                     <!-- End -->
                     <!-- img4 -->
                      <form role="form" action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h5 class="panel-title">Image Four <code>WxH=360x276</code></h5>
                             <div class="panel-body">
                             	<div class="img_settings_container">
                             		<img src="{{URL::asset('/storage/'.$imgfour->img )}}" style="width:100px; height:auto; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                             	</div>
                             	<div class="form-group">
                             		<label for="brand">Image Four.</label>
                             		<input type="file" name="img">
                             		<input type="hidden" name="id" value="{{$imgfour->id}}">
                             	</div>
                             
                             	<div class="form-group col-md-6">
                             		<label for="brand">Tile One.</label>
                             		<input type="text" name="title_one" class="form-control" value="{{$imgfour->title_one}}">
                             	</div>

                             	<div class="form-group col-md-6">
                             		<label for="brand">Tile Two.</label>
                             		<input type="text" name="title_two" class="form-control" value="{{$imgfour->title_two}}">
                             	</div>
                             	<div class="form-group col-md-6">
                             		<label for="brand">Price.</label>
                             		<input type="text" name="rate" class="form-control" value="{{$imgfour->rate}}"> 
                             	</div>
                             	<div class="form-group col-md-6">
                             		<label for="brand">Url.</label>
                             		<input type="text" name="url" class="form-control" value="{{$imgfour->url}}">
                             	</div>
                          </div><!-- panel-body -->
                          <div class="panel-footer">
                          	<button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                     <!-- End -->
                     <!-- img5 -->
                      <form role="form" action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h5 class="panel-title">Image Five <code>WxH=360x276</code></h5>
                             <div class="panel-body">
                             	<div class="img_settings_container">
                             		<img src="{{URL::asset('/storage/'.$imgfive->img )}}" style="width:100px; height:auto; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                             	</div>
                             	<div class="form-group">
                             		<label for="brand">Image Five.</label>
                             		<input type="file" name="img">
                             		<input type="hidden" name="id" value="{{$imgfive->id}}">
                             	</div>
                             
                             	<div class="form-group col-md-6">
                             		<label for="brand">Tile One.</label>
                             		<input type="text" name="title_one" class="form-control" value="{{$imgfive->title_one}}">
                             	</div>

                             	<div class="form-group col-md-6">
                             		<label for="brand">Tile Two.</label>
                             		<input type="text" name="title_two" class="form-control" value="{{$imgfive->title_two}}">
                             	</div>
                             	<div class="form-group col-md-6">
                             		<label for="brand">Price.</label>
                             		<input type="text" name="rate" class="form-control" value="{{$imgfive->rate}}">
                             	</div>
                             	<div class="form-group col-md-6">
                             		<label for="brand">Url.</label>
                             		<input type="text" name="url" class="form-control" value="{{$imgfive->url}}">
                             	</div>
                          </div><!-- panel-body -->
                          <div class="panel-footer">
                          	<button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                     <!-- End -->
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
