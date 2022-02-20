@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title" style="height:50px;margin-top: 0px;padding-top:14px;padding-left: 60px;"><i class="voyager-data" style="top:18px;left:30px;font-size:20px;"></i>Edit Fabric Measurments</h1>  
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                 

                    
                        <!-- form start -->
                        
                        
                         
                        <div class="panel-heading">
                            <h3 class="panel-title">Fabric Deduct QTY (Meter)</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                
                            {{ csrf_field() }}
                             <div class="panel-body">
                                 
                               <div class="row"> 
                                <div class="form-group ">                                
                                  <label for="mert_type">Shirt Measurments QTY</label>                              
                                  
                                </div>
                                <div class="col-md-1">
                               <div class="form-group">
                                <label for="thigh">Body</label>
                                <div class='input-group' id='thigh'>
                                  <input type='text' class="form-control" name="shirt_body" value="{{$fabsize->shirt_body}}"  />
                                 </div>     
                              </div>
                            </div>
                                
                                
                                <div class="col-md-1">
                                 <div class="form-group">
                                  <label for="benefit_amt">Stand S</label>
                                  <div class='input-group' id='neck'>
                                    <input type='text' class="form-control" name="shirt_s" value="{{$fabsize->shirt_s}}"  />
                                  </div>     
                                </div>
                              </div>

                              <div class="col-md-1">
                               <div class="form-group">
                                <label for="benefit_amt">Stand M</label>
                                <div class='input-group' id='chest'>
                                <input type='text' class="form-control" name="shirt_m" value="{{$fabsize->shirt_m}}"  />
                                 </div>     
                              </div>
                            </div>
                            <div class="col-md-1">
                                 <div class="form-group">
                                  <label for="benefit_amt">Stand L</label>
                                  <div class='input-group' id='waist'>
                                  <input type='text' class="form-control" name="shirt_l" value="{{$fabsize->shirt_l}}"  />
                                  </div>     
                                </div>
                              </div>

                              <div class="col-md-1">
                               <div class="form-group">
                                <label for="benefit_amt">Stand XL</label>
                                <div class='input-group' id='hip'>
                                 <input type='text' class="form-control" name="shirt_xl" value="{{$fabsize->shirt_xl}}"  />
                                
                                 </div>     
                              </div>
                            </div>
                            <div class="col-md-1">
                                 <div class="form-group">
                                  <label for="shoulder">Stand XXL</label>
                                  <div class='input-group' id='shoulder'>
                                    <input type='text' class="form-control" name="shirt_xll" value="{{$fabsize->shirt_xll}}"  />
                                  </div>     
                                </div>
                              </div>

                              <div class="col-md-1">
                               <div class="form-group">
                                <label for="sleeve">Stand 3XL</label>
                                <div class='input-group' id='sleeve'>
                                <input type='text' class="form-control" name="shirt_xxxl" value="{{$fabsize->shirt_xxxl}}"  />
                                 </div>     
                              </div>
                            </div>
                            <div class="col-md-1">
                               <div class="form-group">
                                <label for="benefit_amt">Stand 4XL</label>
                                <div class='input-group' id='crotch'>
                                 <input type='text' class="form-control" name="shirt_xxxxl" value="{{$fabsize->shirt_xxxxl}}"  />
                                 </div>     
                              </div>
                            </div>
                            </div>
                          
                          <div class="row">
                            <div class="form-group">
                              <label for="mert_type">Jacket Measurments QTY</label>                               
                            </div>
                            
                            <div class="col-md-1">
                             <div class="form-group">
                              <label for="benefit_amt">Body</label>
                              <div class='input-group' id='neck'>
                                <input type='text' class="form-control" name="jacket_body" value="{{$fabsize->jacket_body}}"  />
                              </div>     
                            </div>
                          </div>
                          <div class="col-md-1">
                             <div class="form-group">
                              <label for="benefit_amt">Standard</label>
                              <div class='input-group' id='neck'>
                                <input type='text' class="form-control" name="jacket_stand" value="{{$fabsize->jacket_stand}}"  />
                              </div>     
                            </div>
                          </div>
                          
                            </div> 
                            
                            <div class="row">
                            <div class="form-group">
                              <label for="mert_type">Vests Measurments QTY</label>                               
                            </div>
                            
                            <div class="col-md-1">
                             <div class="form-group">
                              <label for="benefit_amt">Body</label>
                              <div class='input-group' id='neck'>
                                 <input type='text' class="form-control" name="vest_body" value="{{$fabsize->vest_body}}"  />
                              </div>     
                            </div>
                          </div>
                          <div class="col-md-1">
                             <div class="form-group">
                              <label for="benefit_amt">Standard</label>
                              <div class='input-group' id='neck'>
                                 <input type='text' class="form-control" name="vest_stand" value="{{$fabsize->vest_stand}}"  />
                              </div>     
                            </div>
                          </div>
                            </div>
                            
                            <div class="row">
                            <div class="form-group">
                              <label for="mert_type">Pants Measurments QTY</label>                               
                            </div>
                            
                            <div class="col-md-1">
                             <div class="form-group">
                              <label for="benefit_amt">Body</label>
                              <div class='input-group' id='neck'>
                                <input type='text' class="form-control" name="pant_body" value="{{$fabsize->pant_body}}"  />
                              </div>     
                            </div>
                          </div>
                          <div class="col-md-1">
                             <div class="form-group">
                              <label for="benefit_amt">Standard</label>
                              <div class='input-group' id='neck'>
                                <input type='text' class="form-control" name="pant_stand" value="{{$fabsize->pant_stand}}"  />
                              </div>     
                            </div>
                          </div>
                            </div>
                             </div><!-- panel-body -->
                           <div class="panel-footer">
                           <input type="hidden" class="form-control" name="id" value="{{$fabsize->id}}"  />
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                         
                    

                        <iframe id="form_target" name="form_target" style="display:none"></iframe>
                     </div>
                     <!-- form start -->
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
