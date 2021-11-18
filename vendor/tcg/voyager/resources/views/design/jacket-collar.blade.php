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

@foreach($stylefabimglist as $attstyle)
@endforeach
    <div class="row">
           
            	<div class="col-md-5">
                  <h1 class="page-title" style="height:70px;">
                   <i class="voyager-data"></i> Jacket "{{$attstyle->style_name}}" Collar Design
                   </h1>
                   </div>
                   	
           
    </div>
    
@stop
@section('content')

   <div class="page-content container-fluid">
        <div class="row">
            


<div class="col-md-12">


    <a href="{{ url('admin/jacketcollar') }}/add/{{$attstyle->id}}" class="btn btn-success">
        <i class="voyager-plus"></i> Add New
    </a>


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
                                    <th>Collar Image</th>
                                    <th>Created At</th>
                                    <th class="actions" style="text-align:center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                                          
                                @foreach($jacketcollar as $p)
                                <tr>
                                    <td>
                                     <?php
                                    $pp=App\AttributeStyle::getStylename($p->attri_sty_id,'style_name');
									echo $pp;
									?>
                                    
                                    </td>
                                    
                                    <td><img src="{{URL::asset('/storage/'.$p->main_collar)}}" alt="profile Pic" height="100" width="100"></td>
                                    
                                    <td>{{ $p->created_at}}</td>
                                    <td class="no-sort no-click">
                                        <div class="btn-sm btn-danger pull-right delete" data-id="{{$p->id}}" id="delete-{{$p->id}}">
                                            <i class="voyager-trash"></i> Delete
                                        </div>
                                        <a href="{{ url('admin/jacketcollar') }}/edit/{{$p->id}}" class="btn-sm btn-primary pull-right edit">
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
                    <form action="{{ url('admin/jacketcollar/delete') }}/{{$p->id}}" id="delete_form" method="POST">
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