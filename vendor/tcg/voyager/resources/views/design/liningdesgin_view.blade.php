@extends('voyager::master')
@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left:60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i> Add @php $cat_name = App\Category::getcatname($catId); @endphp {{ $cat_name->name }} Lining Fabric 
      <?php $dataType = 'linings'; ?> 
       <a href="{{ route('voyager.'.$dataType.'.desgin.add',$attri_id) }}/{{$li_id}}" class="btn btn-success">
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
                                    <th style="">Sr.No</th>
                                    <th>Name</th>
                                    <th style="">Image</th>
                                                                                                           
                                    <th class="actions" style="text-align:center">Actions</th>
                                </tr>
                            </thead>
                           <tbody>
                          <?php $i=0; ?> 
                          <?php //print_r($data); exit();?>
                        @foreach($data  as $d)  
                         
                       <tr>
                        	
                             <td>{{++$i}}</td>
                             <td>@php echo App\JvLiningDesgin::get_jv_attriname($d->style_id,$d->attri_id); @endphp</td>

                        	 <td><img src="{{URL::asset('/storage/'.$d->front_img)}}" alt="" height="" width="60"></td>                        	
                        	<td class="no-sort no-click">
                        		<div class="btn-sm btn-danger pull-right delete" data-id="{{$d->id}}" id="delete-{{$d->id}}">
                                 <i class="voyager-trash"></i> Delete
                        		</div>
                                <a href="{{ route('voyager.'.$dataType.'.fabricdesgine.edit', $d->id) }}" class="btn-sm btn-primary pull-right edit">
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
                                                    <form action="{{ route('voyager.'.$dataType.'.fabricdesgine.del',$d->id) }}" id="delete_form" method="POST">
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
                            @endforeach
                           
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