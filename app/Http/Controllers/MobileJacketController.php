<?php
namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Category;
use App\FabricGroup;
use App\MainAttribute;
use App\AttributeStyle;
use App\Etfabric;
use App\Stylefabimglist;
use App\Contrast;
use App\JvLiningFabric;
use App\Piping;
use App\Colorcoller;
use App\Button;
use App\ButtonStyleImage;
use App\Thread;
use App\BodyMeasurment;
use App\StandardSize;
use Redirect;
use View;
use Illuminate\Support\Collection;
use App\Cart;
use Auth;
use App\CamaignPromoCode;
use App\Http\helpers;
use App\ShippingRate;
use App\Order;
use App\ShippingsAddr;
use App\CanvasDataurl;


class MobileJacketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     
    public function __construct()
    {
              
		
		if(Session::has('carts')) {
			$cartsess=Session::get('carts');						
		}else{
			$carts=md5(microtime().rand());
			$cartsess=Session::put('carts', $carts);							
		}

    }

    public function index()
    {
        $device_info = Helpers::systemInfo(); 
		$device = $device_info['device'];   // 'MOBILE','SYSTEM'
		if($device!='MOBILE'){
			return redirect(route('designjackets'));
		}       
        $common_name = Helpers::get_jacket_FirstInfo(2);
		$eTailorObj=[
			'oprodType'=>'Jacket',
			'ocatID'=>'2',
			'ofabricGroup'=> $common_name['fbgrp_name'],
			'ofabricType'=> $common_name['fabric_gid'],
			'ofabricPrice'=> $common_name['fabric_rate'],
			'ofabric'=> $common_name['fabric_eid'],
			'ofabricName'=> $common_name['fabric_name'],
			'ofabricImage'=> $common_name['fabric_img_l'],
			'ofabricList'=> $common_name['fabric_img_s'],
			'ofabricDesc'=> $common_name['fabric_desc'],
			'ostyle'=>'51',
			'ostyleName'=>'2 Button, Single Breasted',
			'olapel'=>'60',
			'olapelName'=>'Notch Lapel',
			'olapelHole'=>'false',
			'olapelHoleName'=>'No Button Hole',
			'obottom'=>'64',
			'obottomName'=>'Curved',
			'opacket'=>'66', 
			'opacketName'=>'2 Straight Pockets',
			'obreastPacket'=>'true',
			'osleeveButn'=>'77',
			'osleeveButnStyle'=>'4 Working Buttons',
			'ovent'=>'82',
			'oventName'=>'No Vent',
			'ocontrast'=>'32',
			'ocontrastName'=>'Houndstooth',
			'olapelupper'=>'false',
			'olapellower'=>'false',
			'ocontpockets'=>'false',
			'ocontchestpocket'=>'false',
			'ocontelbowmix'=>'false',
			'olining'=>'1',
			'oliningName'=>'DARK Grey',
			'opiping'=>'1',
			'opipingName'=>'lvory',
			'obackCollar'=>'13',
			'obackCollarName'=>'Black',
			'obutton'=>'15',
			'obuttonName'=>'White',
			'obuttonCode'=>'S1',
			'obuttonHole'=>'21',
			'obuttonHoleName'=>'Black',
			'obuttonHoleCode'=>'A6',
			'omonogram'=>'false',
			'omonogramName'=>'No Monogram',
			'omonogramSpecial'=>'true',
			'omonogramColor'=>'17',
			'omonogramHoleName'=>'White',
			'omonogramCode'=>'A8',
			'omonogramtextColor'=>'#FFFFFF',
			'omonogramText'=>'',
			'omonogramStyle'=>'italic',
			'osizePattern'=>'Body',
			'osizeStyle'=>'Comfortable',
			'osizeType'=>'inch',
			'osizeFit'=>'',
			'osizeNeck'=>'',
			'osizeChest'=>'',
			'osizeWaist'=>'',
			'osizeHip'=>'',
			'osizeLength'=>'',
			'osizeShoulder'=>'',
			'osizeSleeve'=>'',
			'oqty'=>'1',
			'ofrontView'=>'',
			'obackView'=>'',
			'ocartID'=>''
		];
		
		$mytab="etfabric";
		$mysubtab="fabric".$common_name['fabric_gid'];
		$loadme="0";

		/* Fabric */
		$id=$eTailorObj['ocatID'];
		$car_record = Category::select('*')->where('id', '=', 2)->first($id);
		$cat_id = $car_record->id;
		$group_record = FabricGroup::select('*')->where('cat_id', '=', $cat_id)->where('fabric_status','=','ACTIVE')->get();			
		/* Attribute Style */
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 16)->get();		
		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 17)->get();
        return view('jacket.mobilejacket')->with(compact('car_record','group_record','mainattr_record','contrast_record','eTailorObj','mytab','mysubtab','loadme'));
    }
    
    public function getfabdetails(){
		$data='';
		$datastyle='';
		$datacont='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['ofabric']=$ff;
		$fabric_record = Etfabric::select('*')->where('id', '=', $ff)->find($ff);
		$fabgrp=$fabric_record->fbgrp_id;
		
		$fabgrup_record = FabricGroup::select('*')->where('id', '=', $fabgrp)->find($fabgrp);
		
		if($fabgrup_record->fabric_offer_price != 0 && $fabgrup_record->fabric_offer_price != '')
		{
			  $frate = $fabgrup_record->fabric_offer_price;
		}else{
				$frate =    $fabgrup_record->fabric_rate;
		}
			
		
		$eTailorObjN['ofabricGroup']=$fabgrup_record->fbgrp_name;
		$eTailorObjN['ofabricType']=$fabgrp;
		$eTailorObjN['ofabricPrice']=$frate;
		$eTailorObjN['ofabricName']=$fabric_record->fabric_name;
		$eTailorObjN['ofabricImage']=$fabric_record->fabric_img_l;
		$eTailorObjN['ofabricList']=$fabric_record->fabric_img_s;
		$eTailorObjN['ofabricDesc']=$fabric_record->fabric_desc;
		
		$data=$data.'<div class="et-content-fab"><figure class="et-fab-img"><img src="'.$paths.'/'.$eTailorObjN["ofabricImage"].'" alt="'.$eTailorObjN['ofabricName'].'"></figure><div class="et-fab-box"><h3>'.$eTailorObjN['ofabricDesc'].'</h3><span>'.$eTailorObjN['ofabricName'].'</span><span>Fit-Guaranteed Price <img src="'.$p[0].'/demo/img/product/info.png" alt="info"></span><h1>$'.$eTailorObjN['ofabricPrice'].'</h1><h3><a href="#" data-toggle="modal" data-target="#fabric-id">Zoom</a></h3></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div><div class="modal fade et-fabric-modal" id="fabric-id" tabindex="-1" role="dialog" aria-labelledby="fabric-modal"><div class="modal-dialog" role="document"><div class="modal-content"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><div class="modal-body"><figure class="et-fabric-big"><img src="'.$paths.'/'.$eTailorObjN["ofabricImage"].'" alt="'.$eTailorObjN['ofabricName'].'"></figure></div></div></div></div>';
		
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 2)->where('parent_id', '=', 16)->get();
		foreach($mainattr_record as $mattr){
		$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
		if($mattr->id==21){
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
			foreach($stylelst as $styllst){
				if($stylci==6){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				if(($eTailorObjN['ostyle']==54 || $eTailorObjN['ostyle']==55 || $eTailorObjN['ostyle']==56 || $eTailorObjN['ostyle']==57 || $eTailorObjN['ostyle']==58) && ($styllst->id==130)) {
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
					$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
					foreach($styleimglst as $ls){
						$datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
						$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
						foreach($buttimglst as $buttls){ $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}
						$datastyle=$datastyle.'</figure>';
						if($mattr->id==21){ if($styllst->id == $eTailorObjN['obottom']){$datastyle=$datastyle.'<div class="icon-check"></div>';}}
					}
					$datastyle=$datastyle.'</li>'; 
				} elseif(($eTailorObjN['ostyle']==50 || $eTailorObjN['ostyle']==51 || $eTailorObjN['ostyle']==52 || $eTailorObjN['ostyle']==53) && ($styllst->id==63 || $styllst->id==64 || $styllst->id==65)){
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
					$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
					foreach($styleimglst as $ls){
					$datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
					$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
					foreach($buttimglst as $buttls){ $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}
					$datastyle=$datastyle.'</figure>';
					if($mattr->id==21){ if($styllst->id == $eTailorObjN['obottom']){$datastyle=$datastyle.'<div class="icon-check"></div>';}}
					}
					$datastyle=$datastyle.'</li>';
				}
				$stylci++;
			}
		} else{
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
			foreach($stylelst as $styllst){
				if($stylci==6){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
				$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				foreach($styleimglst as $ls){
					$datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
					$buttimglstt = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
					foreach($buttimglstt as $buttls){ $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}
					$datastyle=$datastyle.'</figure>';
					if($mattr->id==19){ if($styllst->id == $eTailorObjN['ostyle']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==20){ if($styllst->id == $eTailorObjN['olapel']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==22){ if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==23){ if($styllst->id == $eTailorObjN['osleeveButn']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==24){ if($styllst->id == $eTailorObjN['ovent']){$datastyle=$datastyle.'<div class="icon-check"></div>';}}
				}
				$datastyle=$datastyle.'</li>';
			$stylci++;
			}
		}
		$datastyle=$datastyle.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-left.png"></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-right.png"></span><span class="sr-only">Next</span></a></div></div>';
		}
		
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg">';
		$datastyle=$datastyle.'<div class="et-content-fab " id="miniview-etstyle-19"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['ostyleName'].'</h2><p>Classic,All Time,Business</p></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstyle-20" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['olapelName'].'</h2><p>Classic,All Time,Business</p>';
		if($eTailorObjN['olapel']!="62"){
			$datastyle=$datastyle.'<span>Button Hole on Lapel</span><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="false"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" checked onClick="javascript:getseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstyle\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" onClick="javascript:getseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstyle\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>No Button Hole</label></div><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="true"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" checked  onClick="javascript:getseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstyle\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" onClick="javascript:getseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstyle\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>With Lapel Buttonhole</label></div>';
		}
		$datastyle=$datastyle.'</div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-bottom-bg" id="miniview-etstyle-21" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['obottomName'].'</h2></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-pocket-bg" id="miniview-etstyle-22" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opacketName'].'</h2><div class="checkbox"><label>';
		if($eTailorObjN['obreastPacket']=="false"){$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstyle\');">';} else{$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>No Breast Pocket</label></div></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab" id="miniview-etstyle-23" style="display:none;"><figure class="et-sleevebuttonds"><img class="et-main-sleeve" src="'.$paths.'/Jacket/Fabric/ImageIn/'.$eTailorObjN['ofabric'].'.png">';
		if($eTailorObjN['osleeveButn']=="73"){
		$datastyle=$datastyle.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="74"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="75"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="76"){
		$datastyle=$datastyle.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="77"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="78"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="79"){
		$datastyle=$datastyle.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="80"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="81"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		}
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>'.$eTailorObjN['osleeveButnStyle'].'</h2><p>Classic,All Time,Business</p></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-vent-bg" id="miniview-etstyle-24" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['oventName'].'</h2><p>Classic,All Time,Business</p></div>';
		$datastyle=$datastyle.'</div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		
		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', 2)->where('parent_id', '=', 17)->get();
		foreach($contrast_record as $contlst){
			if($contlst->id == '25'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				 
				$contfablst = Contrast::select('*')->where('cat_id','=',2)->get(); 
				foreach($contfablst as $cfablst){
				$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cfablst->id.'" data-title="'.$cfablst->contrsfab_name.'" title="'.$cfablst->contrsfab_name.'" onClick="javascript:getcontrast('.$cfablst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cfablst->contrsfab_img.'" alt="'.$cfablst->contrsfab_name.'"></figure>';
				if($cfablst->id==$eTailorObjN['ocontrast']){$datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';                                            
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '26'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$liningfablst = JvLiningFabric::select('*')->where('cat_id','=',2)->get(); 
				foreach($liningfablst as $lngfablst){
				$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$lngfablst->id.'" data-title="'.$lngfablst->fabric_name.'" title="'.$lngfablst->fabric_name.'" onClick="javascript:getlining('.$lngfablst->id.',\'etcontrast\')"><figure class="et-item-img"><img src="'.$paths.'/'.$lngfablst->lining_img.'" alt="'.$lngfablst->fabric_name.'"></figure>';
				if($lngfablst->id==$eTailorObjN['olining']){$datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';                                           
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '27'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$bckcollrfablst = Colorcoller::select('*')->get(); 
				foreach($bckcollrfablst as $bkcfablst){
				$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$bkcfablst->id.'" data-title="'.$bkcfablst->name.'" title="'.$bkcfablst->name.'" onClick="javascript:getbackcollar('.$bkcfablst->id.',\'etcontrast\')"><figure class="et-item-img"><img src="'.$paths.'/'.$bkcfablst->color_img.'" alt="'.$bkcfablst->name.'"></figure>';
				if($bkcfablst->id==$eTailorObjN['obackCollar']){$datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';                                           
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '28'){ 
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$buttonlst = Button::select('*')->where('cat_id','=',2)->get();
				foreach($buttonlst as $bttnlst){
				$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$bttnlst->id.'" data-title="'.$bttnlst->button_name.'" title="'.$bttnlst->button_name.'" onClick="javascript:getbuttons('.$bttnlst->id.',\'etcontrast\')"><figure class="et-item-img"><img src="'.$paths.'/'.$bttnlst->button_img.'" alt="'.$bttnlst->button_name.'"></figure>';
				if($bttnlst->id==$eTailorObjN['obutton']){$datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';                                            
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>B. Choose Your Button Hole Thread</span></div><div class="et-contrast-list"><ul class="et-item-list">';
				$contthrdlst = Thread::select('*')->where('cat_id','=',2)->get(); 
				foreach($contthrdlst as $cthreadlst){
				$datacont=$datacont.'<li class="et-item" id="optionlist-thrd-'.$cthreadlst->id.'" data-title="'.$cthreadlst->thrd_name.'" title="'.$cthreadlst->thrd_name.'" onClick="javascript:getthread('.$cthreadlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cthreadlst->thrd_img.'" alt="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')"></figure>';
				if($cthreadlst->id==$eTailorObjN['obuttonHole']){$datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '29'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-radio-block"><div class="radio"><label>';
				if($eTailorObjN['omonogram']=="false"){$datacont=$datacont.'<input type="radio" name="chkmonotxt" id="chkmonotxt1" value="true" checked onClick="javascript:getmonogram(\'false\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="radio" name="chkmonotxt" id="chkmonotxt1" value="true" onClick="javascript:getmonogram(\'false\',\'etcontrast\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon"></i></span>No Monogram</label></div><div class="radio"><label>';
				if($eTailorObjN['omonogram']=="true"){$datacont=$datacont.'<input type="radio" name="chkmonotxt" id="chkmonotxt2" value="true" checked onClick="javascript:getmonogram(\'true\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="radio" name="chkmonotxt" id="chkmonotxt2" value="true" onClick="javascript:getmonogram(\'true\',\'etcontrast\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon"></i></span>Inside Jacket</label></div></div>';
				if($eTailorObjN['omonogram']=="true"){
					$datacont=$datacont.'<div class="pt-pagination no-pad-left"><span>B. Choose Your Monogram color</span></div><div class="et-contrast-list"><ul class="et-item-list pad-left-20">';
					$monothrdlst = Thread::select('*')->where('cat_id','=',2)->get(); 
					foreach($monothrdlst as $monothrdlst){
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$monothrdlst->id.'" data-title="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')" onClick="javascript:getmonotxtcolor('.$monothrdlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')"></figure>';
					if($monothrdlst->id==$eTailorObjN['omonogramColor']){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
					}
					$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>C. Enter Desired Monogram/Initials</span></div><div class="et-contrast-list"><div class="checkbox"><label>';
					if($eTailorObjN['omonogramSpecial']=="true"){$datacont=$datacont.'<input type="checkbox" name="specialttxt" id="specialttxt" value="true" checked onClick="javascript:getseloptions(\''.$eTailorObjN['omonogramSpecial'].'\',\'Special\',\'29\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="specialttxt" id="specialttxt" value="true" onClick="javascript:getseloptions(\''.$eTailorObjN['omonogramSpecial'].'\',\'Special\',\'29\',\'etcontrast\');">';}
					$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Specially Tailored For </label><input type="text" name="monotext" id="monotext" maxlength="20" value="'.$eTailorObjN['omonogramText'].'" style="color:#8c7676;" onBlur="javascript:getmonotext(this.value,\'etcontrast\');"></div></div>';
				}
				$datacont=$datacont.'</div>';
			}
		}
		
		$datacont=$datacont.'<div class="et-progress-des et-style-bg">';
		$datacont=$datacont.'<div class="et-content-fab" id="miniview-etcontrast-25" ><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>Contrast Fabric</h2><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['olapelupper']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrast\');">';} else{$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Upper</label></div><div class="checkbox"><label>';
		if($eTailorObjN['olapellower']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Lower</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocontpockets']=="true"){$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pockets</label></div>';
		if($eTailorObjN['obreastPacket']=="true"){
			$datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ocontchestpocket']=="true"){$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrast\');">';}else {$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Chest Pocket</label></div>';
		}
		$datacont=$datacont.'<div class="checkbox"><label>';
		if($eTailorObjN['ocontelbowmix']=="true"){$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrast\');">';} else{$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Elbow Mix</label></div></div></div></div>';
		
		$datacont=$datacont.'<div class="et-content-fab" id="miniview-etcontrast-26" ><div class="et-style-select et-jacket-piping"><h5>Piping</h5><ul class="et-item-list">';
		$pipngfablst = Piping::select('*')->get();
		foreach($pipngfablst as $pipfablst){
		$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$pipfablst->id.'" data-title="'.$pipfablst->name.'" title="'.$pipfablst->name.'" onClick="javascript:getpiping('.$pipfablst->id.',\'etcontrast\')"><figure class="et-item-img"><img src="'.$paths.'/'.$pipfablst->piping_img.'" alt="'.$pipfablst->name.'"></figure>';
		if($pipfablst->id==$eTailorObjN['opiping']){$datacont=$datacont.'<div class="icon-check"></div>';}
		$datacont=$datacont.'</li>';                                            
		}
		$datacont=$datacont.'</ul></div></div>';
		
		$datacont=$datacont.'<div class="et-content-fab jacket-backcollr-bg" id="miniview-etcontrast-27" style="display:none;" ><figure><img src="'.$paths.'/Jacket/BackColler/'.$eTailorObjN['obackCollar'].'.png" style="position: absolute;top: -2px;left: 138px;width: 80%;"></figure><div class="et-style-select"><h2>Back Collar</h2></div></div>';
		
		$datacont=$datacont.'<div class="et-content-fab" id="miniview-etcontrast-28" style="display:none;"><figure class="et-sleevebuttonds"><img class="et-main-sleeve" src="'.$paths.'/Jacket/Fabric/ImageIn/'.$eTailorObjN['ofabric'].'.png">';
		if($eTailorObjN['osleeveButn']=="73"){
		$datacont=$datacont.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="74"){
		$datacont=$datacont.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="75"){
		$datacont=$datacont.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="76"){
		$datacont=$datacont.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="77"){
		$datacont=$datacont.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="78"){
		$datacont=$datacont.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="79"){
		$datacont=$datacont.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="80"){
		$datacont=$datacont.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="81"){
		$datacont=$datacont.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Jacket Button</h2><p>'.$eTailorObjN['obuttonName'].'</p></div></div>';
		
		$datacont=$datacont.'<div class="et-content-fab jacket-monogram-bg" id="miniview-etcontrast-29" style="display:none;"><div class="et-style-select"><h2>Inside View of Jacket</h2>';
		if($eTailorObjN['omonogram']=="true"){
		$datacont=$datacont.'<p>Monogram Color: '.$eTailorObjN['omonogramHoleName'].'</p>';
		}
		$datacont=$datacont.'</div>';
		if($eTailorObjN['omonogram']=="true"){
			$datacont=$datacont.'<div class="et-addtttext" style="color:'.$eTailorObjN['omonogramtextColor'].'">';
			if($eTailorObjN['omonogramSpecial']=="true"){$datacont=$datacont.'<p>Specially Tailored For</p>';} else {$datacont=$datacont.'<p> </p>';}
			$datacont=$datacont.'<p>'.$eTailorObjN['omonogramText'].'</p></div>';
		}
		$datacont=$datacont.'</div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $fabgrp,'4' => $eTailorObjN,'5' => $datastyle,'6' => $datacont];
		return $data;
	}

	public function getstyledetails(){
		$datastyle='';
		$datacont='';
		$databtns='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		switch($attrbid){
			case '19':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['ostyle']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['ostyleName']=$style_record->style_name;
				if($ff==54 || $ff==55 || $ff==56 || $ff==57 || $ff==58){
				$eTailorObjN['obottom']=130;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', 130)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obottomName']=$style_record->style_name;
				} else {
				$eTailorObjN['obottom']=64;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', 64)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obottomName']=$style_record->style_name;
				}
				break;
			case '20':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['olapel']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['olapelName']=$style_record->style_name;
				break;
			case '21':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['obottom']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obottomName']=$style_record->style_name;
				break;
			case '22':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['opacket']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['opacketName']=$style_record->style_name;
				break;
			case '23':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['osleeveButn']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['osleeveButnStyle']=$style_record->style_name;
				break;
			case '24':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['ovent']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['oventName']=$style_record->style_name;
				break;
		}
		
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 2)->where('parent_id', '=', 16)->get();
		foreach($mainattr_record as $mattr){
		$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
		if($mattr->id==21){
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
			foreach($stylelst as $styllst){
				if($stylci==6){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				if(($eTailorObjN['ostyle']==54 || $eTailorObjN['ostyle']==55 || $eTailorObjN['ostyle']==56 || $eTailorObjN['ostyle']==57 || $eTailorObjN['ostyle']==58) && ($styllst->id==130)) {
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
					$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
					foreach($styleimglst as $ls){
						$datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
						$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
						foreach($buttimglst as $buttls){ $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}
						$datastyle=$datastyle.'</figure>';
						if($mattr->id==21){ if($styllst->id == $eTailorObjN['obottom']){$datastyle=$datastyle.'<div class="icon-check"></div>';}}
					}
					$datastyle=$datastyle.'</li>'; 
				} elseif(($eTailorObjN['ostyle']==50 || $eTailorObjN['ostyle']==51 || $eTailorObjN['ostyle']==52 || $eTailorObjN['ostyle']==53) && ($styllst->id==63 || $styllst->id==64 || $styllst->id==65)){
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
					$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
					foreach($styleimglst as $ls){
					$datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
					$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
					foreach($buttimglst as $buttls){ $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}
					$datastyle=$datastyle.'</figure>';
					if($mattr->id==21){ if($styllst->id == $eTailorObjN['obottom']){$datastyle=$datastyle.'<div class="icon-check"></div>';}}
					}
					$datastyle=$datastyle.'</li>';
				}
				$stylci++;
			}
		} else{
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
			foreach($stylelst as $styllst){
				if($stylci==6){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
				$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				foreach($styleimglst as $ls){
					$datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
					$buttimglstt = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
					foreach($buttimglstt as $buttls){ $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}
					$datastyle=$datastyle.'</figure>';
					if($mattr->id==19){ if($styllst->id == $eTailorObjN['ostyle']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==20){ if($styllst->id == $eTailorObjN['olapel']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==22){ if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==23){ if($styllst->id == $eTailorObjN['osleeveButn']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==24){ if($styllst->id == $eTailorObjN['ovent']){$datastyle=$datastyle.'<div class="icon-check"></div>';}}
				}
				$datastyle=$datastyle.'</li>';
			$stylci++;
			}
		}
		$datastyle=$datastyle.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-left.png"></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-right.png"></span><span class="sr-only">Next</span></a></div></div>';
		}
		
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg">';
		$datastyle=$datastyle.'<div class="et-content-fab " id="miniview-etstyle-19"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['ostyleName'].'</h2><p>Classic,All Time,Business</p></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstyle-20" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['olapelName'].'</h2><p>Classic,All Time,Business</p>';
		if($eTailorObjN['olapel']!="62"){
			$datastyle=$datastyle.'<span>Button Hole on Lapel</span><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="false"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" checked onClick="javascript:getseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstyle\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" onClick="javascript:getseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstyle\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>No Button Hole</label></div><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="true"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" checked  onClick="javascript:getseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstyle\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" onClick="javascript:getseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstyle\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>With Lapel Buttonhole</label></div>';
		}
		$datastyle=$datastyle.'</div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-bottom-bg" id="miniview-etstyle-21" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['obottomName'].'</h2></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-pocket-bg" id="miniview-etstyle-22" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opacketName'].'</h2><div class="checkbox"><label>';
		if($eTailorObjN['obreastPacket']=="false"){$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstyle\');">';} else{$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>No Breast Pocket</label></div></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab" id="miniview-etstyle-23" style="display:none;"><figure class="et-sleevebuttonds"><img class="et-main-sleeve" src="'.$paths.'/Jacket/Fabric/ImageIn/'.$eTailorObjN['ofabric'].'.png">';
		if($eTailorObjN['osleeveButn']=="73"){
		$datastyle=$datastyle.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="74"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="75"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="76"){
		$datastyle=$datastyle.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="77"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="78"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="79"){
		$datastyle=$datastyle.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="80"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="81"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		}
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>'.$eTailorObjN['osleeveButnStyle'].'</h2><p>Classic,All Time,Business</p></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-vent-bg" id="miniview-etstyle-24" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['oventName'].'</h2><p>Classic,All Time,Business</p></div>';
		$datastyle=$datastyle.'</div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		
		/*Contrast*/
		$datacont=$datacont.'<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>Contrast Fabric</h2><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['olapelupper']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrast\');">';} else{$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Upper</label></div><div class="checkbox"><label>';
		if($eTailorObjN['olapellower']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Lower</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocontpockets']=="true"){$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pockets</label></div>';
		if($eTailorObjN['obreastPacket']=="true"){
			$datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ocontchestpocket']=="true"){$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrast\');">';}else {$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Chest Pocket</label></div>';
		}
		$datacont=$datacont.'<div class="checkbox"><label>';
		if($eTailorObjN['ocontelbowmix']=="true"){$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrast\');">';} else{$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Elbow Mix</label></div></div></div>';
		/*Buttons*/
		$databtns=$databtns.'<figure class="et-sleevebuttonds"><img class="et-main-sleeve" src="'.$paths.'/Jacket/Fabric/ImageIn/'.$eTailorObjN['ofabric'].'.png">';
		if($eTailorObjN['osleeveButn']=="73"){
		$databtns=$databtns.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="74"){
		$databtns=$databtns.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="75"){
		$databtns=$databtns.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="76"){
		$databtns=$databtns.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="77"){
		$databtns=$databtns.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="78"){
		$databtns=$databtns.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="79"){
		$databtns=$databtns.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="80"){
		$databtns=$databtns.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="81"){
		$databtns=$databtns.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		}
		$databtns=$databtns.'</figure><div class="et-style-select"><h2>Jacket Button</h2><p>'.$eTailorObjN['obuttonName'].'</p></div>';
		
		$data = ['1' => $datastyle,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datacont,'6' => $databtns];
		return $data;
	}

	public function getjktoptiondetails(){
		$datastyle='';
		$datacont='';
		$datamono='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$options=trim($_POST['opttyp']);
		
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;		
		
		/*Style*/
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 2)->where('parent_id', '=', 16)->get();
		foreach($mainattr_record as $mattr){
		$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
		if($mattr->id==21){
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
			foreach($stylelst as $styllst){
				if($stylci==6){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				if(($eTailorObjN['ostyle']==54 || $eTailorObjN['ostyle']==55 || $eTailorObjN['ostyle']==56 || $eTailorObjN['ostyle']==57 || $eTailorObjN['ostyle']==58) && ($styllst->id==130)) {
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
					$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
					foreach($styleimglst as $ls){
						$datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
						$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
						foreach($buttimglst as $buttls){ $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}
						$datastyle=$datastyle.'</figure>';
						if($mattr->id==21){ if($styllst->id == $eTailorObjN['obottom']){$datastyle=$datastyle.'<div class="icon-check"></div>';}}
					}
					$datastyle=$datastyle.'</li>'; 
				} elseif(($eTailorObjN['ostyle']==50 || $eTailorObjN['ostyle']==51 || $eTailorObjN['ostyle']==52 || $eTailorObjN['ostyle']==53) && ($styllst->id==63 || $styllst->id==64 || $styllst->id==65)){
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
					$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
					foreach($styleimglst as $ls){
					$datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
					$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
					foreach($buttimglst as $buttls){ $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}
					$datastyle=$datastyle.'</figure>';
					if($mattr->id==21){ if($styllst->id == $eTailorObjN['obottom']){$datastyle=$datastyle.'<div class="icon-check"></div>';}}
					}
					$datastyle=$datastyle.'</li>';
				}
				$stylci++;
			}
		} else{
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
			foreach($stylelst as $styllst){
				if($stylci==6){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
				$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				foreach($styleimglst as $ls){
					$datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
					$buttimglstt = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
					foreach($buttimglstt as $buttls){ $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}
					$datastyle=$datastyle.'</figure>';
					if($mattr->id==19){ if($styllst->id == $eTailorObjN['ostyle']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==20){ if($styllst->id == $eTailorObjN['olapel']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==22){ if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==23){ if($styllst->id == $eTailorObjN['osleeveButn']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==24){ if($styllst->id == $eTailorObjN['ovent']){$datastyle=$datastyle.'<div class="icon-check"></div>';}}
				}
				$datastyle=$datastyle.'</li>';
			$stylci++;
			}
		}
		$datastyle=$datastyle.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-left.png"></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-right.png"></span><span class="sr-only">Next</span></a></div></div>';
		}
		
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg">';
		$datastyle=$datastyle.'<div class="et-content-fab " id="miniview-etstyle-19"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['ostyleName'].'</h2><p>Classic,All Time,Business</p></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstyle-20" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['olapelName'].'</h2><p>Classic,All Time,Business</p>';
		if($eTailorObjN['olapel']!="62"){
			$datastyle=$datastyle.'<span>Button Hole on Lapel</span><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="false"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" checked onClick="javascript:getseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstyle\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" onClick="javascript:getseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstyle\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>No Button Hole</label></div><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="true"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" checked  onClick="javascript:getseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstyle\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" onClick="javascript:getseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstyle\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>With Lapel Buttonhole</label></div>';
		}
		$datastyle=$datastyle.'</div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-bottom-bg" id="miniview-etstyle-21" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['obottomName'].'</h2></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-pocket-bg" id="miniview-etstyle-22" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opacketName'].'</h2><div class="checkbox"><label>';
		if($eTailorObjN['obreastPacket']=="false"){$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstyle\');">';} else{$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>No Breast Pocket</label></div></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab" id="miniview-etstyle-23" style="display:none;"><figure class="et-sleevebuttonds"><img class="et-main-sleeve" src="'.$paths.'/Jacket/Fabric/ImageIn/'.$eTailorObjN['ofabric'].'.png">';
		if($eTailorObjN['osleeveButn']=="73"){
		$datastyle=$datastyle.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="74"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="75"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/3KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="76"){
		$datastyle=$datastyle.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="77"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="78"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/4KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="79"){
		$datastyle=$datastyle.'<img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5StandardButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5StandardButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="80"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5WorkingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		} elseif($eTailorObjN['osleeveButn']=="81"){
		$datastyle=$datastyle.'<img class="et-sleeve-b1" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Thread/ShowImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="et-sleeve-b2" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Button/ShowImg/'.$eTailorObjN['obutton'].'.png"><img class="et-sleeve-b3" src="'.$paths.'/Jacket/Style/SleeveButton/5KissingButtons/Thread/JCross/'.$eTailorObjN['obuttonHole'].'.png">';
		}
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>'.$eTailorObjN['osleeveButnStyle'].'</h2><p>Classic,All Time,Business</p></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-vent-bg" id="miniview-etstyle-24" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['oventName'].'</h2><p>Classic,All Time,Business</p></div>';
		$datastyle=$datastyle.'</div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		
		/*Contrast*/
		$datacont=$datacont.'<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>Contrast Fabric</h2><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['olapelupper']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrast\');">';} else{$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Upper</label></div><div class="checkbox"><label>';
		if($eTailorObjN['olapellower']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Lower</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocontpockets']=="true"){$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pockets</label></div>';
		if($eTailorObjN['obreastPacket']=="true"){
			$datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ocontchestpocket']=="true"){$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrast\');">';}else {$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Chest Pocket</label></div>';
		}
		$datacont=$datacont.'<div class="checkbox"><label>';
		if($eTailorObjN['ocontelbowmix']=="true"){$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrast\');">';} else{$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Elbow Mix</label></div></div></div>';
		
		$datamono=$datamono.'<div class="et-style-select"><h2>Inside View of Jacket</h2>';
        if($eTailorObjN['omonogram']=="true"){ $datamono=$datamono.'<p>Monogram Color: '.$eTailorObjN['omonogramHoleName'].'</p>';}
        $datamono=$datamono.'</div>';
        if($eTailorObjN['omonogram']=="true"){
			$datamono=$datamono.'<div class="et-addtttext" style="color:'.$eTailorObjN['omonogramtextColor'].'">';
			if($eTailorObjN['omonogramSpecial']=="true"){$datamono=$datamono.'<p>Specially Tailored For </p>';} else {$datamono=$datamono.'<p> </p>';}
			$datamono=$datamono.'<p>'.$eTailorObjN['omonogramText'].'</p></div>';
		}
		
		$data = ['1' => $datastyle,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datacont,'6' => $datamono];
		return $data;
	}
	
	public function getbackcollardetails(){
		$data='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['obackCollar']=$ff;
		$style_record = Colorcoller::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['obackCollarName']=$style_record->name;
		
		$data=$data.'<figure><img src="'.$paths.'/Jacket/BackColler/'.$eTailorObjN['obackCollar'].'.png" style="position: absolute;top: -2px;left: 138px;width: 80%;"></figure><div class="et-style-select"><h2>Back Collar</h2></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}
}
