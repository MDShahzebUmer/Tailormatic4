@extends('voyager::master')
@section('css')
    <link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/database.css">
@stop
@section('page_header')
<style>
.page-content .panel-body .btn.btn-success:last-child {
    margin-top: 0;
}
.flat-blue .btn.btn-success:hover, .flat-blue .btn.btn-success:focus, .flat-blue .btn.btn-success.active {
    background-color: #0d8d74;
}
</style>
    <div class="row">
           
            	<div class="col-md-4">
                  <h1 class="page-title" style="height:70px;">
                   <i class="voyager-data"></i> Jacket Design
                   </h1>
                   </div>
                   	<div class="col-md-8">
                    <a href="<?php echo url('admin/categories');?>" class="btn btn-success" title="Category Name" alt="{{ $cat_data->name}}">{{ $cat_data->name}} <b>&raquo;</b></a>
                    <a href="<?php echo url('admin/fabric');?>" class="btn btn-success"title="Fabric Group Name" alt="{{ $fabg_data->fbgrp_name}}">{{ $fabg_data->fbgrp_name}} <b>&raquo;</b></a>
                   		<a href="" class="btn btn-success active" title="Fabric Name" alt="{{ $data->fabric_name}}">{{ $data->fabric_name}}</a>
                   	</div>
           
    </div>
    
@stop
@section('content')
 <?php  $test = array_first($MainAttribute);
 if($style_id == ''){
	$addid=$test->id;
}else{
	$addid=$style_id;
}
 ?>
   <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                    
	    @foreach($MainAttribute as $m)
	     <a href="{{ url('admin/jacketdesign') }}/{{ $data->id}}-{{$m->id}}" class="btn btn-success <?php if($addid==$m->id){?> active<?php }?>" title="{{ $m->attribute_name}}" alt="Fabric Name">{{ $m->attribute_name}}</a>                   
	    @endforeach
        
       
        
   </div>
</div>
</div>


<div class="col-md-12">


    <a href="{{ url('admin/jacketdesign/') }}/add/{{$data->id}}/<?php echo $addid;?>" class="btn btn-success">
        <i class="voyager-plus"></i> Add New
    </a>

<?php 

if($optionchk['id']!='0291'){ ?>
   @if($optionchk['id']==0)
          <?php if($addid!=20){?>
                <a href="{{ route('voyager.jvcreateoption.add')}}/{{$data->id}}/{{$addid}}" class="btn btn-success">
                     <i class="voyager-plus"></i> Add {{$optionchk['name']}} Image</a>
                     <?php }?>
   @else   
   <a href="{{ route('voyager.jveditfaboption.edit')}}/{{$optionchk['id']}}" class="btn btn-success">
                     <i class="voyager-plus"></i> Edit {{$optionchk['name']}} Image</a>
   @endif   
<?php }?>
    </div>
</div>
</div>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>List Image</th>
                                    <th>Created At</th>
                                    <th class="actions" style="text-align:center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                           
                                <?php //echo '<pre>'.print_r($data,true).'</pre>'; exit(); ?>

                                
                                @foreach($stylefabimglist as $p)
                                <tr>
                                    <td>
                                   {{$p->style_name}}
                                    </td>
                                    <td>{{ $p->style_code}}</td>
                                    <td><img src="{{URL::asset('/storage/'.$p->list_img)}}" alt="profile Pic" height="100" width="100"></td>
                                    
                                    <td>{{ $p->created_at}}</td>
                                    <td class="no-sort no-click">
                                        <div class="btn-sm btn-danger pull-right delete" data-id="{{$p->id}}" id="delete-{{$p->id}}">
                                            <i class="voyager-trash"></i> Delete
                                        </div>
                                        <a href="{{ url('admin/jacketdesign/') }}/edit/{{ $p->id}}" class="btn-sm btn-primary pull-right edit">
                                            <i class="voyager-edit"></i> Edit
                                        </a>
                                        @if($addid==19)
                                       <a href="{{ url('admin/jacketcollar') }}/{{$p->id}}" class="btn-sm btn-primary pull-right edit">
                                            <i class="voyager-plus"></i> Lapel Type
                                        </a>
                                        @endif
                                       <!-- <a href="#" class="btn-sm btn-warning pull-right">
                                            <i class="voyager-eye"></i> View
                                        </a>-->
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
                    <form action="{{ url('admin/jacketdesign/delete') }}/{{$p->id}}" id="delete_form" method="POST">
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
                           
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.modal -->
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