<html>
<head>
</head>
<body style="font-family:Arial, sans-serif; font-size:10px !important;">
 <?php $description=unserialize($val->item_description);    
 ?>
<?php
 $ocontbeltloop = App\Http\helpers::optionval($description['ocontbeltloop']);
 $ocontbackpockets = App\Http\helpers::optionval($description['ocontbackpockets']);
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
        <td style="vertical-align:middle;padding:5px;" >Style :</td>
        <td style="vertical-align:middle;padding:5px;" >{{$description['ostyleName']}}</td>
       
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;" >Pleats:</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['opleatName']}} </td>
      
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Front Pockets:</td>
        <td style="vertical-align:middle;padding:5px;">{{$description['opacketName']}}</td>
       
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Back Pockets :</td>
        <td style="vertical-align:middle;padding:5px;">{{$description['obackpocktName']}}</td>
       
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Back Pocket Position:</td>
       <td style="vertical-align:middle;padding:5px;">{{  ucfirst(trans($description['obackpocktSide'])) }} </td>
    
      </tr>
      
      <tr>
        <td style="vertical-align:middle;padding:5px;">Pant Closure</td>
      <td style="vertical-align:middle;padding:5px;">{{ ucfirst(trans($description['owaistbandedge']))}}</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Belt Loops</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['obeltloopName']}}</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Cuffs</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['ocuffName']}}</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Button Color</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['obuttonCode']}} ( {{$description['obuttonName']}} )</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Thread Color</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['obuttonHoleCode']}} ( {{$description['obuttonHoleName']}} )</td>
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
       
        <td style="vertical-align:middle;padding:5px;" width="25%"><b>Contrast Fabric :</b></td>
        <td colspan="3" style="vertical-align:middle;padding:5px;">{{$description['ocontrastName']}} <img src="{{URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['ocontrast'],'contrsfab_img'))}}" width="24"    alt="{{$description['ocontrastName']}}" title="{{$description['ocontrastName']}}"></td>
        
      </tr>
      
     
      <tr><td colspan="4" style="padding-top:0px;padding-left:5px;"></td></tr>
      <tr>
       <td style="vertical-align:middle;padding:5px;" width="20%">Belt Loops :</td>
       <td style="vertical-align:middle;padding:5px;" width="10%">{{$ocontbeltloop}}</td>
       <td style="vertical-align:middle;padding:5px;"  width="20%">Back Pockets:</td>
       <td style="vertical-align:middle;padding:5px;" >{{$ocontbackpockets}}</td>
      
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
    

<td>Waist</td>
<td>Hip</td>
<td>Crotch</td>
<td>Thigh</td>

<td>Length</td>
</tr>
<tr>


<td>{{$description['osizeWaist']}}</td>
<td>{{$description['osizeHip']}}</td>
<td>{{$description['osizeCrotch']}}</td>
<td>{{$description['osizeThigh']}}</td>
<td>{{$description['osizeLength']}}</td>
</tr>
 
 </table>
 </td></tr>

 
    
  </table>
  

</body>
</html>