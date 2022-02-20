@extends('voyager::master')
@section('css')
    <link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/database.css">
@stop
@section('page_header')
<div class="row">
<style>
.page-content .panel-body .btn.btn-success:last-child {
    margin-top: 0;
}
.flat-blue .btn.btn-success:hover, .flat-blue .btn.btn-success:focus, .flat-blue .btn.btn-success.active {
    background-color: #0d8d74;
}
</style>
    <div class="col-md-4">
       <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;">
    <i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Contrasts Design
   </h1>
</div>
<div class="col-md-8">
    <a href="" class="btn btn-success" title="Category Name" alt="Category Name">{{$cat_data->name}} <b>&raquo;</b></a>
    <a href="" class="btn btn-success"title="Fabric Group Name" alt="">{{$m->attribute_name}} <b>&raquo;</b></a>
    <a href="" class="btn btn-success active" title="Fabric Name" alt="Fabric Name">{{$data->contrsfab_name}} <b>&raquo;</b></a>
</div>
</div>@stop
@section('content')
   <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body" style="padding:0px;">
                       <?php $names = App\OptionTabel::select('name','id')->where('attri_id', '=', $attridata->id)->get();?>
                         @foreach($names as $ns)

                        <a href="{{ route('voyager.contrastsdesign.fabric',$data->id)}}-{{$ns->id}}" class="btn btn-success @if($optdata==$ns->id) active @endif" title="Fabric Name" alt="Fabric Name">{{$ns->name}}</a>
                         @endforeach
                    </div>
                </div>
            </div>
            <!-- Second Button -->
                <div class="col-md-12">
                    <?php $nam = App\OptionTabel::select('name','id')->where('attri_id', '=', $attridata->id)->first();?>

                    <a href="{{ route('voyager.contrastsdesign.option',$data->id)}}/{{$optdata}}" class="btn btn-success">
                    <i class="voyager-plus"></i> Add New
                   </a>
                </div>
                <!-- end second -->
            <div>
            </div>
        </div>
    </div><!-- First Close Div -->
    <!-- Second Section -->
     <?php //echo '<pre>'.print_r($maindata,true).'</pre>';exit();?>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Field Name</th>
                                    <th>Image</th>
                                    <th>Create</th>
                                    <th class="actions" style="text-align:center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(!empty($maindata))
                                @foreach($maindata as $md)
                                <tr>
                                   <?php $md->opt_id; ?>
                                    <?php 
                                        // $a = App\ContrastOptionIimgType::select('type_name')
                                        //         ->where('opt_id','=',$md->opt_id)
                                        //         ->where('id','=',$md->contrast_type_id)
                                        //         ->first($md->opt_id,$md->contrast_type_id);
                                        $a = App\ContrastOptionIimgType::select('*')
                                                ->where('id','=',$md->contrast_type_id)
                                                ->first();
                                    ?>
                                    <td><?php echo $a->type_name ?></td>

                                    <td><img src="{{URL::asset('/storage/'.$md->main_img)}}" alt="profile Pic" height="100" width="100"></td>
                                    <th>{{$md->created_at}}</th>

                                    <td class="no-sort no-click">
                                        <div class="btn-sm btn-danger pull-right delete" data-id="{{$md->id}}" id="delete-{{$md->id}}">
                                            <i class="voyager-trash"></i> Delete
                                        </div>
                                        <a href="{{route('voyager.contrastsdesign.edit.option',$md->id)}}" class="btn-sm btn-primary pull-right edit">
                                            <i class="voyager-edit"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to delete
                                                        this </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('voyager.contrastsdesign.del.option',$md->id) }}" id="delete_form" method="POST">
                                                            {{ method_field("DELETE") }}
                                                            {{ csrf_field() }}
                                                            <input type="submit" class="btn btn-danger pull-right delete-confirm"
                                                            value="Yes, Delete This ">
                                                        </form>
                                                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                @endforeach
                                @endif



                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <!-- End second Section -->
@stop

@section('javascript')
    <!-- DataTables -->
    <script>

            $(document).ready(function () {
                $('#dataTable').DataTable({ "order": [] });
            });


        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];

            form.action = parseActionUrl(form.action, $(this).data('id'));

            $('#delete_modal').modal('show');
        });

        function parseActionUrl(action, id) {
            return action.match(/\/[0-9]+$/)
                    ? action.replace(/([0-9]+$)/, id)
                    : action + '/' + id;
        }
    </script>
@stop
