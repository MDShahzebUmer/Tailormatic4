<html>
<head>
</head>
<body style="font-family:Arial, sans-serif; font-size:10px !important;">
<canvas id="frontcanvas" width="340" height="417" style="display:none"></canvas>
<canvas id="backcanvas" width="340" height="417" style="display:none"></canvas>
<script type="text/javascript" src="{{asset('asset/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/bootstrap.min.js')}}"></script>
<!-- Bootstrap bootstrap-touch-slider Slider Main JS File -->
<script type="text/javascript" src="{{asset('asset/js/float-panel.js')}}"></script>
<script type="text/javascript" src="{{asset('asset/js/responsive_bootstrap_carousel.js')}}"></script>
<!--<script type="text/javascript" src="{{asset('asset/js/jquery.touchSwipe.min.js')}}"></script>-->
<script type="text/javascript" src="{{asset('asset/js/bootstrap-touch-slider.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/fabric.min.js')}}"></script>
<script type="text/javascript" src="{{asset('demo/js/cart.js')}}"></script> 
<script type="text/javascript">var url = "{{asset('/storage/')}}";</script>

 <?php /*?>@foreach($itemdata as $val)
         @endforeach<?php */?>
 <?php $description=unserialize($val->item_description);    
 ?>
<script>
	$(document).ready(function(e) {
		var arr='<?php echo json_encode($description); ?>';
		designProcessing(JSON.parse(arr),1);
});
</script> 
   

<?php
	$cuffIn     = App\Http\helpers::optionval($description['ocollarCuffIn']);
	$cuffout    = App\Http\helpers::optionval($description['ocollarCuffout']);
	$placketin  = App\Http\helpers::optionval($description['ofrontPlacketIn']);
	$placketout = App\Http\helpers::optionval($description['ofrontPlacketOut']);
	$boxout     = App\Http\helpers::optionval($description['ofrontBoxOut']);
	$boxin      = App\Http\helpers::optionval($description['obackBoxOut']);
	
 ?>
 
 <table class="table" style="background-color: #000;width:100%;padding:5px;text-align:center;">
 <tbody>
   
      <tr>
        <td width="100%" > <div style="background: #000;">
          <img src="{{URL::asset('/storage/')}}/{!! Voyager::setting('front-logo') !!}" width="130px"></div></td>
       
      </tr>
      
    </tbody>

  </table> 
<table class="table" width="100%">
 <tr>
  <td colspan="2" style="padding-bottom:5px; padding-top:5px;"><b>Order ID:- #<?php echo $val->id;?></b></td>
  </tr>
<tr>
<td  style="background-color: #efefef;">
 <table>
 <tr>
        <td width="50%" style="text-align:center"><span >Front Side</span></td>
        <td width="50%" style="text-align:center"><span >Back Side</span></td>
      </tr>
      <tr>
        <td width="50%"  style="background-color: #efefef;">
            <div class="pt-men">
            <div class="pt-image-div">
            <div id="main-front-1"><div class="pt-image-div"><img src=""  alt="" width="200px"/></div></div>
            </div>   
            </div>
                                </td>
        <td width="50%" style="background-color: #efefef;">
    <div class="pt-men">
    <div class="pt-image-div">
    <div id="main-back-1"><div class="pt-image-div"><img src=""  alt="" width="200px"/></div></div>
    </div>
    </div>
                                 </td>
      </tr>
    </table>
</td>

<td style="width:100%">
<table style="background-color: #f1f1f1; font-size:14px; width:100%">
<tr>
        <td style="vertical-align:middle;padding:5px;" width="30%">Fabric :</td>
        <td style="vertical-align:middle;padding:5px;" width="70%">{{$description['ofabricName']}} <img src="{{URL::asset('/storage/'.$description['ofabricImage'])}}" width=" 30px"></td>
        
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;" >Sleeve :</td>
        <td style="vertical-align:middle;padding:5px;" >{{$description['osleeveName']}} @if($description['oshoulder']=='true')with Epaulettes @endif</td>
       
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;" >Front Style :</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['ofrontName']}} @if($description['oseams']=='true')with Seam @endif</td>
      
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Back Style :</td>
        <td style="vertical-align:middle;padding:5px;">{{$description['obackName']}} @if($description['odart']=='true')with Dart @endif</td>
       
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Collar Style :</td>
        <td style="vertical-align:middle;padding:5px;">{{$description['ocollarName']}} @if($description['ocollarStay']=='true')with Collar Stay @endif</td>
       
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Cuff Style :</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['ocuffName']}}</td>
    
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Pocket Style :</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['opacketName']}} @if($description['opacketName']!='No Pocket')<br>{{$description['opacketCount']}} Pocket @endif</td>
 
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Bottom Style</td>
      <td style="vertical-align:middle;padding:5px;">{{$description['obottomName']}}</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Monogram</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['omonogramName']}} @if($description['omonogramName']!='No Monogram'), Color : {{$description['omonogramCode']}}@endif</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Monogram Text</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['omonogramText']}} </td>
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Buttons and Thread</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['obuttonName']}} Button { {{$description['obuttonCode']}} } , {{{$description['obuttonHoleStyleName']}}} { {{$description['obuttonHoleCode']}} }</td>
    </tr>

</table>


</td>
</tr>
  </table> 
<table class="table" style="width:100%;background-color: #f1f1f1; margin-top:5px">
<tr>

<td width="40%">
<table style="font-size:14px; width:100%">
<tr>
       
        <td style="vertical-align:middle;padding:5px;" width="15%"><b>Contrast :</b></td>
        <td colspan="3" style="vertical-align:middle;padding:5px;"><b>{{$description['ocontrastName']}}</b></td>
        
      </tr>
      
     
      <tr><td colspan="4" style="padding-top:0px;padding-left:5px;"><b>Collar Contrast</b></td></tr>
      <tr>
       <td style="vertical-align:middle;padding:5px;">Inside :</td>
       <td style="vertical-align:middle;padding:5px;" width="10%">{{$cuffIn}}</td>
       <td style="vertical-align:middle;padding:5px;"  width="15%">Outside :</td>
       <td style="vertical-align:middle;padding:5px;" >{{$cuffout}}</td>
      
      </tr>
       <tr><td colspan="4" style="padding-top:0px;padding-left:5px;"><b>Cuff Contrast</b></td></tr>
      <tr>
       <td style="vertical-align:middle;padding:5px;">Inside :</td>
       <td style="vertical-align:middle;padding:5px;">{{$cuffIn}}</td>
       <td style="vertical-align:middle;padding:5px;" >Outside :</td>
       <td style="vertical-align:middle;padding:5px;" >{{$cuffout}}</td>
      
      </tr>
     
</table>
</td>
<td>
<table style="font-size:14px; width:100%">

<tr><td colspan="4">&nbsp;</td></tr>
     <tr><td colspan="4" style="padding-top:5px;padding-left:5px;"><b>Front/Back Placket Contras</b></td></tr>
      <tr>
       <td style="vertical-align:middle;padding:5px;" width="20%" >Inside :</td>
       <td style="vertical-align:middle;padding:5px;"  width="10%" >{{$placketin}}</td>
       <td style="vertical-align:middle;padding:5px;" width="20%" >Outside :</td>
       <td style="vertical-align:middle;padding:5px;">{{$placketout}}</td>
      </tr>
    <tr><td colspan="4" style="padding-top:0px;padding-left:5px;"><b>Front/Back Placket Contras</b></td></tr>
      <tr>
       <td style="vertical-align:middle;padding:5px;" >Inside :</td>
       <td style="vertical-align:middle;padding:5px;" >{{$placketin}}</td>
       <td style="vertical-align:middle;padding:5px;">Outside :</td>
       <td style="vertical-align:middle;padding:5px;">{{$placketout}}</td>
      </tr>   
     
	 <tr>
       <td style="vertical-align:middle;padding:5px;">Front Box Placket :</td>
       <td style="vertical-align:middle;padding:5px;">{{$boxout}}</td>
        <td style="vertical-align:middle;padding:5px;">Back Box Placket :</td>
       <td style="vertical-align:middle;padding:5px;">{{$boxin}}</td>
      </tr>
     
</table>
</td>

</tr>
 <tr>
 <td colspan="2" style="background-color:#FFF;text-align:left; padding-top:5px; padding-left:5px;"><b>Type Measurement :-  {{$description['osizePattern']}} , {{$description['osizeStyle']}} ( {{$description['osizeType']}} )</b>
 </td>
 </tr>

  <?php if($description['osizePattern']=='Body'){?>
 <tr> 
 <td colspan="2">
<table style="background-color: #f1f1f1; font-size:14px; width:50%; text-align:center">
<tr>
<td>Neck</td>      
<td>Chest</td>
<td>Waist</td>
<td>Hip</td>
<td>Shoulder</td>
<td>Sleeve</td>
</tr>
<tr>
<td>{{$description['osizeNeck']}}</td>
<td>{{$description['osizeChest']}}</td>
<td>{{$description['osizeWaist']}}</td>
<td>{{$description['osizeHip']}}</td>
<td>{{$description['osizeShoulder']}}</td>
<td>{{$description['osizeSleeve']}}</td>
</tr>
 
 </table>
 </td></tr>
 <?php }else{?>
<tr>
<td colspan="2" style="background-color:#FFF;text-align:left; padding-left:8px;"><b>Size :- {{$description['osizeFit']}}</b></td>
<?php $sizedata = App\Http\Helpers::get_standersize_value_SML($description['osizeFit']); ?>
</tr>
 <tr> 
 <td colspan="2">
<table style="background-color: #f1f1f1; font-size:14px; width:50%; text-align:center">
<tr>
<td>Neck</td>
<td>Chest</td>
<td>Waist</td>
<td>Hip</td>
<td>Shoulder</td>
<td>Sleeve</td>
</tr>
<tr>
<?php
if($description['osizeType']=='inch'){
?>
 <td style="text-align:center">{{$sizedata->neck}}</td>
 <td>{{$sizedata->chest}}</td>
<td>{{$sizedata->waist}}</td>
<td>{{$sizedata->hip}}</td>
<td>{{$sizedata->shoulder}}</td>
<td>{{$sizedata->sleeve}}</td>
<?php }else{?>
 <td style="text-align:center"><?php echo $ins= App\Http\helpers::convertinch($sizedata->neck);?></td>
 <td><?php echo $ins= App\Http\helpers::convertinch($sizedata->chest);?></td>
<td><?php echo $ins= App\Http\helpers::convertinch($sizedata->waist);?></td>
<td><?php echo $ins= App\Http\helpers::convertinch($sizedata->hip);?></td>
<td><?php echo $ins= App\Http\helpers::convertinch($sizedata->shoulder);?></td>
<td><?php echo $ins= App\Http\helpers::convertinch($sizedata->sleeve);?></td>
<?php }?>
</tr>
</table>
 </td></tr>
 
 <?php }?>
 
    
  </table>

<script type="text/javascript">
setTimeout(function()
    {
       window.print();
    }, 
    5000);
</script>

</body>
</html>