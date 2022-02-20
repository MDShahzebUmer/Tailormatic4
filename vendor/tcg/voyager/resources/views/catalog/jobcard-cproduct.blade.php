<html>
<head>
</head>
<body style="font-family:Arial, sans-serif; font-size:10px !important;">
 <?php $description=unserialize($val->item_description);    
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
        <td style="vertical-align:middle;padding:5px;" width="30%">Product Code :</td>
        <td style="vertical-align:middle;padding:5px;" width="70%">{{$description['procode']}}</td>
        
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;" >Product Name :</td>
        <td style="vertical-align:middle;padding:5px;" >{{$description['oprodName']}}</td>
       
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;" >Fabric Name:</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['ofabricName']}} </td>
      
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Fabric Brand:</td>
        <td style="vertical-align:middle;padding:5px;">{{$description['fabbrand']}}</td>
       
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Fabric Type:</td>
        <td style="vertical-align:middle;padding:5px;">{{$description['ofabricType']}}</td>
       
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Pattern:</td>
       <td style="vertical-align:middle;padding:5px;">{{$description['pattern']}}</td>
    
      </tr>
      
      <tr>
        <td style="vertical-align:middle;padding:5px;">Color</td>
      <td style="vertical-align:middle;padding:5px;">{{ $description['color']}}</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Fabric Description</td>
       <td style="vertical-align:middle;padding:5px;">{{stripslashes($description['fabdesc'])}}</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Color Description</td>
       <td style="vertical-align:middle;padding:5px;">{{stripslashes($description['colordes'])}}</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;padding:5px;">Quality Description:</td>
       <td style="vertical-align:middle;padding:5px;">{{stripslashes($description['qualitydesc'])}}</td>
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
       
        <td style="vertical-align:middle;padding:5px;" width="15%"><b>Size :</b></td>
        <td colspan="3" style="vertical-align:middle;padding:5px;">{{$description['osizeFit']}}</td>
        
      </tr>
      
     
      
     
      
    
     
	
     
</table>
</td>
<td>

</td>

</tr>
 




 
    
  </table>
  

</body>
</html>