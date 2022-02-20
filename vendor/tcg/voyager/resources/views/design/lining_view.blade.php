@extends('voyager::master')
@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left:60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Add Jacket/Vest Lining Fabric 
      <?php $dataType = 'linings'; ?> 
       <a href="{{ route('voyager.'.$dataType.'.create') }}" class="btn btn-success">
            <i class="voyager-plus"></i> Add New
        </a>
    </h1>
@stop

@section('content')
<div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
<th style="">ID</th>
                                    <th style="">Cat Name</th>
                                    <th style="">Fabric Name</th>
                                    <th style="">Lining Img</th>                                                                        
                                    <th class="actions" style="text-align:center">Actions</th>
                                </tr>
                            </thead>
                           <tbody>
                         
                        @forelse ($data as $d)      
                       <tr>
<td>{{$d->id  }}</td>
                        	<td>@if($d->cat_id == 2) Jacket @else Vests @endif</td>
                        	<td>{{$d->fabric_name  }}</td>
                        	 <td><img src="{{URL::asset('/storage/'.$d->lining_img)}}" alt=" " height="" width="40"></td>                        	
                        	<td class="no-sort no-click">
                        		<div class="btn-sm btn-danger pull-right delete" data-id="{{$d->id}}" id="delete-{{$d->id}}">
                                 <i class="voyager-trash"></i> Delete
                        		</div>
                                <a href="{{ route('voyager.'.$dataType.'.edit', $d->id) }}" class="btn-sm btn-primary pull-right edit">
                        			<i class="voyager-edit"></i> Edit
                        		</a>
                                @if($d->cat_id == 2)

                                <a href="{{ route('voyager.'.$dataType.'.desgin', $d->id) }}" class="btn-sm btn-primary pull-right edit">
                                   Jacket Lining Design
                                </a>
                                @else
                                <a href="{{ route('voyager.'.$dataType.'.desgin', $d->id) }}" class="btn-sm btn-primary pull-right edit">
                                   Vests Lining Design
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <p>No users</p>
                        @endforelse
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
                                                    <form action="{{ route('voyager.'.$dataType.'.desgin.del',$d->id)}}" id="delete_form" method="POST">
                                                        {{ method_field("DELETE") }}
                                                        {{ csrf_field() }}
                                                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                                                        value="Yes, Delete This ">
                                                    </form>
                                                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                           
                           
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    
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