<html>
<head>
</head>
<body style="font-family:Arial, sans-serif; font-size:10px !important;">
<!-- <canvas id="frontcanvas" width="340" height="417" style="display:none"></canvas>
<canvas id="backcanvas" width="340" height="417" style="display:none"></canvas> -->
<script type="text/javascript" src="<?=asset('asset/js/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?=asset('asset/js/bootstrap.min.js')?>"></script>
<!-- Bootstrap bootstrap-touch-slider Slider Main JS File -->
<script type="text/javascript" src="<?=asset('asset/js/float-panel.js')?>"></script>
<script type="text/javascript" src="<?=asset('asset/js/responsive_bootstrap_carousel.js')?>"></script>
<!--<script type="text/javascript" src="<?=asset('asset/js/jquery.touchSwipe.min.js')?>"></script>-->
<script type="text/javascript" src="<?=asset('asset/js/bootstrap-touch-slider.js')?>"></script>
<script type="text/javascript" src="<?=asset('demo/js/fabric.min.js')?>"></script>
<!-- <script type="text/javascript" src="<?=asset('demo/js/jcart.js')?>"></script>  -->
<script type="text/javascript">var url = "<?=asset('/storage/')?>";</script>
<?php $description=unserialize($val->item_description);    
?>
<script>
    /*
    $(document).ready(function(e) {
      var arr='<?php echo json_encode($description); ?>';
      designProcessing(JSON.parse(arr));
    });
    */
</script>
<?php
  $olapelupper = App\Http\helpers::optionval($description['olapelupper']);
  $olapellower = App\Http\helpers::optionval($description['olapellower']);
  $ocontpockets = App\Http\helpers::optionval($description['ocontpockets']);
  $ocontchestpocket = App\Http\helpers::optionval($description['ocontchestpocket']);
  $ocontelbowmix = App\Http\helpers::optionval($description['ocontelbowmix']);
?>

<table class="table" style="background-color: #000;width:100%;padding:5px;text-align:center;">
  <tbody>
    <tr>
      <td width="100%" > 
        <div style="background: #000;">
          <!-- <img src="<?=URL::asset('/storage/')?>/<?=Voyager::setting('front-logo')?>" width="130px"> -->
        </div>
      </td>
    </tr>
  </tbody>
</table> 

<!-- ================================================ jacket info ====================================== -->
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
                    <img src="<?=URL::asset('/storage/'.$val->canvas_front_img)?>" width="200px"/>
              </div>
          </td>
          <td width="50%" style="background-color: #efefef;">
            <div class="pt-men">
              <div class="pt-image-div">
                  <img src="<?=URL::asset('/storage/'.$val->canvas_back_img)?>" width="200px"/>
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
          <td style="vertical-align:middle;padding:5px;" width="70%"><?=$description['ofabricName']?> 
            <img src="<?=URL::asset('/storage/'.$description['ofabricImage'])?>" width=" 30px">
          </td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;" >Style :</td>
          <td style="vertical-align:middle;padding:5px;" ><?=$description['ostyleName']?></td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;" >Lapel:</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['olapelName']?> </td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Lapel Hole:</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['olapelHoleName']?> </td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Jacket bottom :</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['obottomName']?> </td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Jacket Pocket:</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['opacketName']?> 
            <?php if($description['obreastPacket']=='true'): ?>with Breast Pocket <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Jacket Sleeve Button</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['osleeveButnStyle']?></td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Jacket Vent</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['oventName']?></td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Buttons and Thread</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['obuttonName']?> Button { <?=$description['obuttonCode']?> } , <br> <?=$description['obuttonHoleName']?> ( <?=$description['obuttonHoleCode']?> )</td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Monogram</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['omonogramName']?> 
            <?php if($description['omonogramName']!='No Monogram'): ?>
              , Color : <?=$description['omonogramCode']?> 
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Monogram Text</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['omonogramText']?></td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Lining</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['oliningName']?></td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Piping Color</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['opipingName']?></td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Back Collar</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['obackCollarName']?></td>
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
          <td colspan="3" style="vertical-align:middle;padding:5px;"><?=$description['ocontrastName']?> 
            <img src="<?=URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['ocontrast'],'contrsfab_img'))?>" width="24"  alt="<?=$description['ocontrastName']?>" title="<?=$description['ocontrastName']?>">
          </td>
        </tr>     
        <tr><td colspan="4" style="padding-top:0px;padding-left:5px;"><b>Collar Contrast</b></td></tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;" width="20%">Lapel Upper :</td>
          <td style="vertical-align:middle;padding:5px;" width="10%"><?=$olapelupper?></td>
          <td style="vertical-align:middle;padding:5px;"  width="20%">Lapel Lower :</td>
          <td style="vertical-align:middle;padding:5px;" ><?=$olapellower?></td>
        </tr>
        <tr>      
          <td style="vertical-align:middle;padding:5px;">Pockets :</td>
          <td style="vertical-align:middle;padding:5px;"><?=$ocontpockets?></td>
          <td style="vertical-align:middle;padding:5px;" >Chest Pocket :</td>
          <td style="vertical-align:middle;padding:5px;" ><?=$ocontchestpocket?></td>
        </tr>
        <tr>      
          <td style="vertical-align:middle;padding:5px;">Elbow Mix :</td>
          <td style="vertical-align:middle;padding:5px;"><?=$ocontelbowmix?></td>
          <td colspan="2" style="vertical-align:middle;padding:5px;" ></td>
        </tr>    
      </table>
    </td>
    <td>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="background-color:#FFF;text-align:left; padding-top:5px; padding-left:5px;"><b>Type Measurement <?=$description['osizePattern']?> , <?=$description['osizeStyle']?> 
      <?php if($description['osizePattern']=='Standard'): ?>
        , Size SML : <?=$description['osizeFit']?> , Fit : Regular 
      <?php endif; ?> 
      ( <?=$description['osizeType']?> )</b>
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
          <td>Sleeve</td>
          <td>Length</td>
        </tr>
        <tr>
          <td><?=$description['osizeChest']?></td>
          <td><?=$description['osizeWaist']?></td>
          <td><?=$description['osizeHip']?></td>
          <td><?=$description['osizeShoulder']?></td>
          <td><?=$description['osizeSleeve']?></td>
          <td><?=$description['osizeLength']?></td>
        </tr>
      </table>
    </td>
  </tr>
  <!-- ===================================== new added for body type ===================================== -->
  <?php 
  if(!empty($description['body_type_front']) && !empty($description['body_type_back'])
  && !empty($description['body_type_shoulder']) && !empty($description['body_type_stomach'])):
  ?>
    <tr>
      <td colspan="2" style="background-color:#FFF;text-align:left; padding-left:8px;"><b>Body Type</b></td>
    </tr>
    <tr> 
      <td colspan="2">
        <table style="background-color: #f1f1f1; font-size:14px; width:50%; text-align:center">
          <tr>
            <td>Front : <?=$description['body_type_front']?></td>
            <td>Back : <?=$description['body_type_back']?></td>
            <td>Shoulder : <?=$description['body_type_shoulder']?></td>
            <td>Stomach : <?=$description['body_type_stomach']?></td>
          </tr>
          <tr>
            <td>
              <?php $b_type = $description['body_type_front']; ?>
              <figure style="margin-bottom:10px;background-color:#3a2311;">
                  <img src="<?=asset('/asset/img/body_type/front_'.$b_type.'.png')?>" alt="" style="width:100px;">
              </figure>
            </td>
            <td>
              <?php $b_type = $description['body_type_back']; ?>
              <figure style="margin-bottom:10px;background-color:#3a2311;">
                  <img src="<?=asset('/asset/img/body_type/back_'.$b_type.'.png')?>" alt="" style="width:100px;">
              </figure>
            </td>
            <td>
              <?php $b_type = $description['body_type_shoulder']; ?>
              <figure style="margin-bottom:10px;background-color:#3a2311;">
                  <img src="<?=asset('/asset/img/body_type/shoulder_'.$b_type.'.png')?>" alt="" style="width:100px;">
              </figure>
            </td>
            <td>
              <?php $b_type = $description['body_type_stomach']; ?>
              <figure style="margin-bottom:10px;background-color:#3a2311;">
                  <img src="<?=asset('/asset/img/body_type/stomach_'.$b_type.'.png')?>" alt="" style="width:100px;">
              </figure>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  <?php endif; ?>
  <!-- ===================================== end for body type =========================================== -->
</table>
<!-- ================================================ pant info ======================================== -->
<?php
 $pant_ocontbeltloop = App\Http\helpers::optionval($description['pant_ocontbeltloop']);
 $pant_ocontbackpockets = App\Http\helpers::optionval($description['pant_ocontbackpockets']);
?>
<table class="table" width="100%">
  <tr>
    <td  style="background-color: #efefef;">
      <table>
        <tr>
          <td width="50%" style="text-align:center"><span >Front Side</span></td>
          <td width="50%" style="text-align:center"><span >Back Side</span></td>
        </tr>
        <tr>
          <td width="50%"  style="background-color: #efefef;">
            <img src="<?=URL::asset('/storage/'.$description['pant_frntviewfinal'])?>" width="200px"> 
          </td>
          <td width="50%" style="background-color: #efefef;">
            <img src="<?=URL::asset('/storage/'.$description['pant_bkviewfinal'])?>" width="200px"> 
          </td>
        </tr>
      </table>
    </td>
    <td style="width:100%">
      <table style="background-color: #f1f1f1; font-size:14px; width:100%">
        <tr>
          <td style="vertical-align:middle;padding:5px;" width="30%">Fabric :</td>
          <td style="vertical-align:middle;padding:5px;" width="70%"><?=$description['pant_ofabricName']?> <img src="<?=URL::asset('/storage/'.$description['pant_ofabricImage'])?>" width=" 30px"></td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;" >Style :</td>
          <td style="vertical-align:middle;padding:5px;" ><?=$description['pant_ostyleName']?></td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;" >Pleats:</td>
        <td style="vertical-align:middle;padding:5px;"><?=$description['pant_opleatName']?> </td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Front Pockets:</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['pant_opacketName']?></td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Back Pockets :</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['pant_obackpocktName']?></td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Back Pocket Position:</td>
          <td style="vertical-align:middle;padding:5px;"><?=  ucfirst(trans($description['pant_obackpocktSide'])) ?> </td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Pant Closure</td>
          <td style="vertical-align:middle;padding:5px;"><?= ucfirst(trans($description['pant_owaistbandedge']))?></td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Belt Loops</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['pant_obeltloopName']?></td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Cuffs</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['pant_ocuffName']?></td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Button Color</td>
         <td style="vertical-align:middle;padding:5px;"><?=$description['pant_obuttonCode']?> ( <?=$description['pant_obuttonName']?> )</td>
        </tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;">Thread Color</td>
          <td style="vertical-align:middle;padding:5px;"><?=$description['pant_obuttonHoleCode']?> ( <?=$description['pant_obuttonHoleName']?> )</td>
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
          <td colspan="3" style="vertical-align:middle;padding:5px;"><?=$description['pant_ocontrastName']?> <img src="<?=URL::asset('/storage/'.$sss = App\Http\helpers::alltebinfo('contrasts',$description['pant_ocontrast'],'contrsfab_img'))?>" width="24"    alt="<?=$description['pant_ocontrastName']?>" title="<?=$description['pant_ocontrastName']?>"></td>
        </tr>
        <tr><td colspan="4" style="padding-top:0px;padding-left:5px;"></td></tr>
        <tr>
          <td style="vertical-align:middle;padding:5px;" width="20%">Belt Loops :</td>
          <td style="vertical-align:middle;padding:5px;" width="10%"><?=$pant_ocontbeltloop?></td>
          <td style="vertical-align:middle;padding:5px;"  width="20%">Back Pockets:</td>
          <td style="vertical-align:middle;padding:5px;" ><?=$pant_ocontbackpockets?></td>
        </tr>
      </table>
    </td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2" style="background-color:#FFF;text-align:left; padding-top:5px; padding-left:5px;"><b>Type Measurement  <?=$description['osizePattern']?> , <?=$description['osizeStyle']?> 
      <?php if($description['osizePattern']=='Standard'): ?>
        , Size SML : <?=$description['osizeFit']?> 
      <?php endif; ?> 
      ( <?=$description['osizeType']?> )</b>
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
          <td><?=$description['pant_osizeWaist']?></td>
          <td><?=$description['pant_osizeHip']?></td>
          <td><?=$description['pant_osizeCrotch']?></td>
          <td><?=$description['pant_osizeThigh']?></td>
          <td><?=$description['pant_osizeLength']?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<!-- ================================================ end ============================================== -->
<script type="text/javascript">
setTimeout(function() {
    // window.print();
  }, 
  5000
);
</script>
</body>
</html>