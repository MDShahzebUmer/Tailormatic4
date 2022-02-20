@extends('voyager::master')
@section('css')
    <link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/database.css">
@stop
@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Shipping Rates List Country:
        <?php $dataType = 'shippingrates'; ?>
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
                    @php  $vai = App\CamaignPromoCode::get_Validity(); @endphp
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">

                            <thead>
                                <tr>
                                    <th>Country Name</th>
                                    <th>Shitrs Amt</th>
                                    <th>Jacket</th>
                                    <th>Pant</th>
                                    <th>Vests</th>    
                                    <th>Other amt</th>    
                                    <th class="actions" style="text-align:center">Actions</th>
                                </tr>
                            </thead>
                             <tbody>
                                @foreach($data as $d)
                              <tr>
                                @php $country = App\Country::get_country_name($d->country_id); @endphp
                                <td>{{$country}}</td>
                                <td>${{$d->shirt_amt}}</td>
                                <td>${{$d->jacket_amt}}</td>
                                <td>${{$d->pant_amt}}</td>
                                <td>${{$d->vests_amt}}</td>
                                <td>${{$d->other_cat_amt}}</td>
                                <td class="no-sort no-click">
                                  <div class="btn-sm btn-danger pull-right delete" data-id="{{$d->id}}" id="delete-{{$d->id}}">

                                        <i class="voyager-trash"></i> Delete
                                    </div>
                                    <a href="{{ route('voyager.'.$dataType.'.edit') }}/{{$d->id}}" class="btn-sm btn-primary pull-right edit">
                                        <i class="voyager-edit"></i> Edit
                                    </a>
                                    @if($d->status == 1)
                                    <a href="{{ route('voyager.'.$dataType.'.status') }}/{{$d->id}}/{{$d->status}}" class="btn-sm btn-primary pull-right edit">
                                        <i class="voyager-lock"></i> Enable
                                    </a>
                                    @else
                                    <a href="{{ route('voyager.'.$dataType.'.status') }}/{{$d->id}}/{{$d->status}}" class="btn-sm btn-primary pull-right edit">
                                        <i class="voyager-lock"></i> Disable
                                    </a>
                                     @endif 
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
                                                    <form action="{{ route('voyager.'.$dataType.'.del') }}/{{$d->id}}" id="delete_form" method="POST">
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

