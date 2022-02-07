@extends('voyager::master')
@section('css')
    <link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/database.css">
@stop
@section('page_header')
     <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;">
        <i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i> Add Fabric
      <?php $dataType = 'fabric'; ?> 
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
                                     <th>ID</th>
                                    <th>Fabric Name</th>
                                    <th>Group Name</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                    <th>CSV/Image</th>
                                    <th>Status</th>
                                    <th class="actions" style="text-align:center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                           @foreach($etf as $f)
                             <tr>
                                <td>{{$f->id}}</td>
                                 <td>@if($f->fabric_name) {{$f->fabric_name}} @else '' @endif</td>
                                <td>
                                <?php $fg = App\FabricGroup::select('fbgrp_name','cat_id')->where('id' , '=' , $f->fbgrp_id)->get();?>
                                 @foreach($fg as $fgroup)@endforeach
                                {{$fgroup->fbgrp_name}} </td>
                                <td> 
                                <?php $fgcat = App\Category::select('name')->where('id' , '=' , $fgroup->cat_id)->get();?>
                                @foreach($fgcat as $catname)@endforeach
                                {{$catname->name}}
                                
                                </td>
                                 <td><img src="{{URL::asset('/storage/'.$f->fabric_img_l)}}"style="width:50px"></td>
                                <td>@if($f->fabric_qty) {{$f->fabric_qty}} @else '' @endif</td>
                                
                                <td><?php if($f->created_at){ echo substr($f->created_at,0,11);}else{echo " ";} ?></td>
                                 
                                 @if($f->active_fabric == 0)
                                 <td><a href="#" class="btn-sm btn-primary pull-right edit" disabled>
                                        <i class="voyager-add"></i> Complete
                                </a></td>                                
                                
                                 @elseif($f->active_fabric == 1)                                 
                                <td><a href="#" class="btn-sm btn-primary pull-right edit" disabled>
                                        <i class="voyager-add"></i> Awaited
                                </a></td>  
                                @elseif($f->active_fabric == 2)
                                 <td><a href="{{ route('voyager.etailor_fabriccsv',$f->id) }}" class="btn-sm btn-success pull-right edit">
                                        <i class="voyager-add"></i> Upload
                                </a></td>
                                
                                @elseif($f->active_fabric == 3)
                                 <td><a href="{{ route('voyager.etailor_fabriccsv',$f->id) }}" class="btn-sm btn-success pull-right edit">
                                        <i class="voyager-add"></i> Complete
                                </a></td>

                                 @endif
                                

                                @if($f->fabric_status == 1)
                                <td><a href="{{ route('voyager.status',$f->id) }}" class="btn-sm btn-primary pull-right edit">
                                        <i class="voyager-add"></i> Active
                                </a></td>
                                @else
                                <td><a href="{{ route('voyager.status',$f->id) }}" class="btn-sm btn-warning pull-right edit">
                                        <i class="voyager-add"></i> Inactive
                                </a></td>
                                @endif
                                <td class="no-sort no-click">
                                    <div class="btn-sm btn-danger pull-right delete" data-id="{{$f->id}}" id="delete-{{ $f->id }}">
                                           
                                        <i class="voyager-trash"></i> Delete
                                    </div>
                                    <a href="{{ route('voyager.fabric.edit',$f->id) }}" class="btn-sm btn-primary pull-right edit">
                                        <i class="voyager-edit"></i> Edit
                                    </a>
                                    <?php
                                    // if($fgroup->cat_id==2){ $designpath='admin/jacketdesign';}else if($fgroup->cat_id==4){$designpath='admin/fabricdesign';}else{$designpath='admin/fabricdesign';}
                                    if($fgroup->cat_id==2){ $designpath='admin/fabricdesign';}else if($fgroup->cat_id==4){$designpath='admin/fabricdesign';}else{$designpath='admin/fabricdesign';}
									?>
                                    <a href="<?php echo url($designpath);?>/{{ $f->id}}" class="btn-sm btn-primary pull-right edit">
                                        <i class="voyager-settings"></i> Fabric Design
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