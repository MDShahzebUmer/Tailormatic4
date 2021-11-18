<html>
<head>
</head>
<body style="font-family:Arial, sans-serif; font-size:10px !important;">
 <?php $description=unserialize($val->item_description);    
 ?>
<?php
 $ocontlapel = App\Http\helpers::optionval($description['ocontlapel']);
 $ocontpockets = App\Http\helpers::optionval($description['ocontpockets']);
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
        <td width="50%"  style="background-color: #efefef;"><img src="{{URL::asset('/storage/'.$val->canvas_front_img)}}" width="200px"> </td>
        <td width="50%" style="background-color: #efefef;"><img src="{{URL::asset('/storage/'.$val->canvas_back_img)}}" width="200px"> </td>
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
        <td style="vertical-align:middle;padding:5px;" >Lapel :</td>
        <td style="vertical-align:middle;padding:5px;" >{{$description['opacketName']}}</td>
       
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;" >Pockets:</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['opacketName']}} </td>
      
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Bottom:</td>
        <td style="vertical-align:middle;padding:5px;">{{$description['obottomName']}} </td>
       
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Back :</td>
        <td style="vertical-align:middle;padding:5px;">{{$description['obackName']}} </td>
       
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Buttons:</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['obuttonstyleName']}} </td>
    
      </tr>
      
      <tr>
        <td style="vertical-align:middle;padding:5px;">Button Color</td>
      <td style="vertical-align:middle;padding:5px;">{{$description['obuttonCode']}} ( {{$description['obuttonName']}} )</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Thread Color</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['obuttonHoleCode']}} ({{$description['obuttonHoleName']}})</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Lining</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['oliningName']}}</td>
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
       
        <td style="vertical-align:middle;padding:5px;" width="15%"><b>Contrast Fabric :</b></td>
        <td colspan="3" style="vertical-align:middle;padding:5px;">{{$description['ocontrastName']}} <img src="{{URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['ocontrast'],'contrsfab_img'))}}" width="24"    alt="{{$description['ocontrastName']}}" title="{{$description['ocontrastName']}}"></td>
        
      </tr>
      
     
      <tr><td colspan="4" style="padding-top:0px;padding-left:5px;"><b>Collar Contrast</b></td></tr>
      <tr>
       <td style="vertical-align:middle;padding:5px;">Vest Upper :</td>
       <td style="vertical-align:middle;padding:5px;" width="10%">{{$ocontlapel}}</td>
       <td style="vertical-align:middle;padding:5px;"  width="15%">Pocket Style :</td>
       <td style="vertical-align:middle;padding:5px;" >{{$ocontpockets}}</td>
      
      </tr>
     
      
    
     
	
     
</table>
</td>
<td>

</td>

</tr>
 <tr>
 <td colspan="2" style="background-color:#FFF;text-align:left; padding-top:5px; padding-left:5px;"><b>Type Measurement  {{$description['osizePattern']}} , {{$description['osizeStyle']}} @if($description['osizePattern']=='Standard'), Size SML : {{$description['osizeFit']}} @endif ( {{$description['osizeType']}} )</b>
 </td>
 </tr>


 <tr> 
 <td colspan="2">
<table style="background-color: #f1f1f1; font-size:14px; width:50%; text-align:center">
<tr>
    
<td>Chest</td>
<td>Waist</td>
<td>Hip</td>
<td>Shoulder</td>
<td>Length</td>
</tr>
<tr>

<td>{{$description['osizeChest']}}</td>
<td>{{$description['osizeWaist']}}</td>
<td>{{$description['osizeHip']}}</td>
<td>{{$description['osizeShoulder']}}</td>
<td>{{$description['osizeLength']}}</td>
</tr>
 
 </table>
 </td></tr>

 
    
  </table>


</body>
</html>