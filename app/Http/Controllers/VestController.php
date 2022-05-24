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


class VestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     
    public function __construct()
    {
         $carts=md5(microtime().rand());
			
		if(Session::has('carts')) {
			$cartsess=Session::get('carts');
						
		}else{
			$cartsess=Session::put('carts', $carts);
							
		}	
    }

    public function index()
    {
		$device_info = Helpers::systemInfo(); 
		$device = $device_info['device'];   // 'MOBILE','SYSTEM'
		if($device!='SYSTEM'){
			return redirect(route('mobilevests'));
		}
        $common_name = Helpers::get_vests_FirstInfo(3);
		$eTailorObj=[
			'oprodType'=>'Vests',
			'ocatID'=>'3',
			'ofabricGroup'=>$common_name['fbgrp_name'],
			'ofabricType'=>$common_name['fabric_gid'],
			'ofabricPrice'=>$common_name['fabric_rate'],
			'ofabric'=>$common_name['fabric_eid'],
			'ofabricName'=>$common_name['fabric_name'],
			'ofabricImage'=>$common_name['fabric_img_l'],
			'ofabricList'=>$common_name['fabric_img_s'],
			'ofabricDesc'=>$common_name['fabric_desc'],
			'ostyle'=>'85',
			'ostyleName'=>'V Neck',
			'obuttonstyle'=>'89',
			'obuttonstyleName'=>'6 Buttons',
			'opacket'=>'92', 
			'opacketName'=>'Single Opening',
			'obottom'=>'95',
			'obottomName'=>'Angle Cut',
			'oback'=>'97',
			'obackName'=>'Plain',
			'ocontrast'=>'33',
			'ocontrastName'=>'Houndstooth',
			'ocontlapel'=>'false',
			'ocontpockets'=>'false',
			'olining'=>'2',
			'oliningName'=>'DARK Grey',
			'opiping'=>'1',
			'opipingName'=>'lvory',
			'obutton'=>'16',
			'obuttonName'=>'White',
			'obuttonCode'=>'S1',
			'obuttonHole'=>'22',
			'obuttonHoleName'=>'Black',
			'obuttonHoleCode'=>'A6',
			'osizePattern'=>'Body',
			'osizeStyle'=>'Comfortable',
			'osizeType'=>'inch',
			'osizeFit'=>'',
			'osizeChest'=>'',
			'osizeWaist'=>'',
			'osizeHip'=>'',
			'osizeLength'=>'',
			'osizeShoulder'=>'',
			'oqty'=>'1',
			'ofrontView'=>'',
			'obackView'=>'',
			'ocartID'=>'',
			'body_type_front'=>'normal',
			'body_type_back'=>'normal',
			'body_type_shoulder'=>'normal',
			'body_type_stomach'=>'normal'
		];
		
		$mytab="etfabric";
		$mysubtab="fabric".$common_name['fabric_gid'];
		$loadme="0";

		/* Fabric */
		$id=$eTailorObj['ocatID'];
		$car_record = Category::select('*')->where('id', '=', 3)->first($id);
		$cat_id = $car_record->id;
		$group_record = FabricGroup::select('*')->where('cat_id', '=', $cat_id)->where('fabric_status','=','ACTIVE')->get();
		//echo '<pre>'.print_r($group_record,true).'</pre>';
		
		/* Attribute Style */
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 32)->get();
		
		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 33)->get();
        return view('vests.vest')->with(compact('car_record','group_record','mainattr_record','contrast_record','eTailorObj','mytab','mysubtab','loadme'));
    }
	
	public function getfabdetails(){
		$data='';
		$datastyle='';
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
		
		$data=$data.'<div class="et-content-fab"><figure class="et-fab-img"><img src="'.$paths.'/'.$fabric_record->fabric_img_l.'" alt="'.$fabric_record->fabric_name.'"></figure><div class="et-fab-box"><h3>'.$fabric_record->fabric_desc.'</h3><span>'.$fabric_record->fabric_name.'</span><span>Fit-Guaranteed Price <img src="'.$p[0].'/demo/img/product/info.png" alt="info"></span><h1>$'.$fabgrup_record->fabric_rate.'</h1><h3><a href="#" data-toggle="modal" data-target="#fabric-id">Zoom</a></h3></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div><div class="modal fade et-fabric-modal" id="fabric-id" tabindex="-1" role="dialog" aria-labelledby="fabric-modal"><div class="modal-dialog" role="document"><div class="modal-content"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><div class="modal-body"><figure class="et-fabric-big"><img src="'.$paths.'/'.$fabric_record->fabric_img_l.'" alt="'.$fabric_record->fabric_name.'"></figure></div></div></div></div>';
		
		$datastyle=$datastyle.'<div class="carousel-container">';
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 3)->where('parent_id', '=', 32)->get();
		foreach($mainattr_record as $mattr) {
        $datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
        
		$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
        foreach($stylelst as $styllst) {
        if($stylci==7){ $datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
        $datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
        
		$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
        foreach($styleimglst as $ls){
        $datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
        
		$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
       foreach($buttimglst as $buttls){ $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'"></figure>';}}
	   if($mattr->id==35) { if($styllst->id == $eTailorObjN['ostyle']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
	   } elseif($mattr->id==36){ if($styllst->id == $eTailorObjN['obuttonstyle']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
	   } elseif($mattr->id==37){ if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
	   } elseif($mattr->id==38){ if($styllst->id == $eTailorObjN['obottom']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
	   } elseif($mattr->id==39){ if($styllst->id == $eTailorObjN['oback']){$datastyle=$datastyle.'<div class="icon-check"></div>';} }
	   $datastyle=$datastyle.'</li> ';
       $stylci++;
	   }
	    $datastyle=$datastyle.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-left.png"></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-right.png"></span><span class="sr-only">Next</span></a></div></div>';
		}
	   $datastyle=$datastyle.'</div>';
        $datastyle=$datastyle.'<div class="et-progress-des et-style-bg"><div class="et-content-fab jacket-lapel-bg" id="miniview-etstyle-35"><div class="et-style-select"><h2>'.$eTailorObjN['ostyleName'].'</h2></div></div><div class="et-content-fab" id="miniview-etstyle-36" style="display:none;"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['obuttonstyleName'].'</h2></div></div><div class="et-content-fab jacket-bottom-bg" id="miniview-etstyle-37" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opacketName'].'</h2></div></div><div class="et-content-fab jacket-bottom-bg" id="miniview-etstyle-38" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['obottomName'].'</h2></div></div><div class="et-content-fab" id="miniview-etstyle-39" style="display:none;"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['obackName'].'</h2></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $fabgrp,'4' => $eTailorObjN,'5' => $datastyle];
		return $data;
	}
	
	public function getstyledetails(){
		$data='';
		$datacont='';
		$carray=$_POST['carr'];
		$styleid=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		switch($attrbid){
			case '35':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['ostyle']=$styleid;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $styleid)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['ostyleName']=$style_record->style_name;
				
				$data='<div class="et-style-select"><h2>'.$style_record->style_name.'</h2></div>';
				$datacont='<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>Vest Contrast</h2><div class="et-check-box"><div class="checkbox"><label>';
				if($eTailorObjN['ocontpockets']=="true"){$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'40\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'40\',\'etcontrast\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pocket Contrast</label></div>';
                
				if($eTailorObjN['ostyle']!="85"){
                $datacont=$datacont.'<div class="checkbox"><label>';
				if($eTailorObjN['ocontlapel']=="true"){
				$datacont=$datacont.'<input type="checkbox" name="lapelcontttxt" id="lapelcontttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontlapel'].',\'Lapel\',\'40\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="lapelcontttxt" id="lapelcontttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontlapel'].',\'Lapel\',\'40\',\'etcontrast\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Contrast</label></div>';
				}
                $datacont=$datacont.'</div>';
				break;
			case '36':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['obuttonstyle']=$styleid;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $styleid)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obuttonstyleName']=$style_record->style_name;
				
				$data='<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$style_record->style_name.'</h2></div>';
				$datacont='<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>Vest Contrast</h2><div class="et-check-box"><div class="checkbox"><label>';
				if($eTailorObjN['ocontpockets']=="true"){$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'40\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'40\',\'etcontrast\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pocket Contrast</label></div>';
                
				if($eTailorObjN['ostyle']!="85"){
                $datacont=$datacont.'<div class="checkbox"><label>';
				if($eTailorObjN['ocontlapel']=="true"){
				$datacont=$datacont.'<input type="checkbox" name="lapelcontttxt" id="lapelcontttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontlapel'].',\'Lapel\',\'40\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="lapelcontttxt" id="lapelcontttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontlapel'].',\'Lapel\',\'40\',\'etcontrast\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Contrast</label></div>';
				}
                $datacont=$datacont.'</div>';
				break;
			case '37':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['opacket']=$styleid;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $styleid)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['opacketName']=$style_record->style_name;
				
				$data='<div class="et-style-select"><h2>'.$style_record->style_name.'</h2></div>';
				$datacont='<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>Vest Contrast</h2><div class="et-check-box"><div class="checkbox"><label>';
				if($eTailorObjN['ocontpockets']=="true"){$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'40\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'40\',\'etcontrast\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pocket Contrast</label></div>';
                
				if($eTailorObjN['ostyle']!="85"){
                $datacont=$datacont.'<div class="checkbox"><label>';
				if($eTailorObjN['ocontlapel']=="true"){
				$datacont=$datacont.'<input type="checkbox" name="lapelcontttxt" id="lapelcontttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontlapel'].',\'Lapel\',\'40\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="lapelcontttxt" id="lapelcontttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontlapel'].',\'Lapel\',\'40\',\'etcontrast\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Contrast</label></div>';
				}
                $datacont=$datacont.'</div>';
				break;
			case '38':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['obottom']=$styleid;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $styleid)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obottomName']=$style_record->style_name;
				
				$data='<div class="et-style-select"><h2>'.$style_record->style_name.'</h2></div>';
				$datacont='<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>Vest Contrast</h2><div class="et-check-box"><div class="checkbox"><label>';
				if($eTailorObjN['ocontpockets']=="true"){$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'40\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'40\',\'etcontrast\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pocket Contrast</label></div>';
                
				if($eTailorObjN['ostyle']!="85"){
                $datacont=$datacont.'<div class="checkbox"><label>';
				if($eTailorObjN['ocontlapel']=="true"){
				$datacont=$datacont.'<input type="checkbox" name="lapelcontttxt" id="lapelcontttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontlapel'].',\'Lapel\',\'40\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="lapelcontttxt" id="lapelcontttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontlapel'].',\'Lapel\',\'40\',\'etcontrast\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Contrast</label></div>';
				}
                $datacont=$datacont.'</div>';
				break;
			case '39':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['oback']=$styleid;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $styleid)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obackName']=$style_record->style_name;
				
				$data='<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$style_record->style_name.'</h2></div>';
				$datacont='<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>Vest Contrast</h2><div class="et-check-box"><div class="checkbox"><label>';
				if($eTailorObjN['ocontpockets']=="true"){$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'40\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'40\',\'etcontrast\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pocket Contrast</label></div>';
                
				if($eTailorObjN['ostyle']!="85"){
                $datacont=$datacont.'<div class="checkbox"><label>';
				if($eTailorObjN['ocontlapel']=="true"){
				$datacont=$datacont.'<input type="checkbox" name="lapelcontttxt" id="lapelcontttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontlapel'].',\'Lapel\',\'40\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="lapelcontttxt" id="lapelcontttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontlapel'].',\'Lapel\',\'40\',\'etcontrast\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Contrast</label></div>';
				}
                $datacont=$datacont.'</div>';
				break;
		}
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datacont];
		return $data;
	}
	
	public function getcontrastdetails(){
		$data='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['ocontrast']=$ff;
		$style_record = Contrast::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['ocontrastName']=$style_record->contrsfab_name;
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}
	
	public function getliningdetails(){
		$data='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['olining']=$ff;
		$style_record = JvLiningFabric::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['oliningName']=$style_record->fabric_name;
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}
	
	public function getpipingdetails(){
		$data='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['opiping']=$ff;
		$style_record = Piping::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['opipingName']=$style_record->name;
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}
	
	public function getbuttondetails(){
		$data='';
		$datastyle='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['obutton']=$ff;
		$style_record = Button::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['obuttonName']=$style_record->button_name;
		$eTailorObjN['obuttonCode']=$style_record->button_code;
		
		$data='<div class="et-style-select"><h2>Jacket Button</h2><p>'.$style_record->button_name.'</p></div>';
		
		$datastyle=$datastyle.'<div class="carousel-container">';
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 3)->where('parent_id', '=', 32)->get();
		foreach($mainattr_record as $mattr) {
        $datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
        
		$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
        foreach($stylelst as $styllst) {
        if($stylci==7){ $datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
        $datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
        
		$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
        foreach($styleimglst as $ls){
        $datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
        
		$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
       foreach($buttimglst as $buttls){ $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'"></figure>';}}
	   if($mattr->id==35) { if($styllst->id == $eTailorObjN['ostyle']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
	   } elseif($mattr->id==36){ if($styllst->id == $eTailorObjN['obuttonstyle']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
	   } elseif($mattr->id==37){ if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
	   } elseif($mattr->id==38){ if($styllst->id == $eTailorObjN['obottom']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
	   } elseif($mattr->id==39){ if($styllst->id == $eTailorObjN['oback']){$datastyle=$datastyle.'<div class="icon-check"></div>';} }
	   $datastyle=$datastyle.'</li> ';
       $stylci++;
	   }
	    $datastyle=$datastyle.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-left.png"></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-right.png"></span><span class="sr-only">Next</span></a></div></div>';
		}
	   $datastyle=$datastyle.'</div>';
        $datastyle=$datastyle.'<div class="et-progress-des et-style-bg"><div class="et-content-fab jacket-lapel-bg" id="miniview-etstyle-35"><div class="et-style-select"><h2>'.$eTailorObjN['ostyleName'].'</h2></div></div><div class="et-content-fab" id="miniview-etstyle-36" style="display:none;"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['obuttonstyleName'].'</h2></div></div><div class="et-content-fab jacket-bottom-bg" id="miniview-etstyle-37" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opacketName'].'</h2></div></div><div class="et-content-fab jacket-bottom-bg" id="miniview-etstyle-38" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['obottomName'].'</h2></div></div><div class="et-content-fab" id="miniview-etstyle-39" style="display:none;"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['obackName'].'</h2></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datastyle];
		return $data;
	}
	
	public function getthreaddetails(){
		$data='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['obuttonHole']=$ff;
		$style_record = Thread::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['obuttonHoleName']=$style_record->thrd_name;
		$eTailorObjN['obuttonHoleCode']=$style_record->thread_code;
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}
	
	public function getsetoptiondetails(){
		$data='';
		$datacont='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$options=$_POST['opttyp'];
		
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		switch($options){
			case "Pockets":
				if($ff=="true"){ $eTailorObjN['ocontpockets']="false"; } else { $eTailorObjN['ocontpockets']="true"; }
				break;
			case "Lapel":
				if($ff=="true"){ $eTailorObjN['ocontlapel']="false"; } else { $eTailorObjN['ocontlapel']="true"; }
				break;
		}
		
		$datacont='<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>Vest Contrast</h2><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocontpockets']=="true"){$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'40\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'40\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pocket Contrast</label></div>';
		
		if($eTailorObjN['ostyle']!="85"){
		$datacont=$datacont.'<div class="checkbox"><label>';
		if($eTailorObjN['ocontlapel']=="true"){
		$datacont=$datacont.'<input type="checkbox" name="lapelcontttxt" id="lapelcontttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontlapel'].',\'Lapel\',\'40\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="lapelcontttxt" id="lapelcontttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontlapel'].',\'Lapel\',\'40\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Contrast</label></div>';
		}
		$datacont=$datacont.'</div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datacont];
		return $data;
	}
    
    public function measurestd(){
		$data="";
		if(isset($_POST['sizeid'])){
			$data='<select class="selectpicker btn-primary" id="sizefit" name="sizefit" onChange="javascript:changeSizeDetails();">';
			$measureeurolst = BodyMeasurment::select('*')->where('cat_id','=',3)->where('country_id','=',$_POST['sizeid'])->get();
			foreach($measureeurolst as $eurosizelst){
				$stdeurosizelst = StandardSize::select('*')->where('id','=',$eurosizelst->standardsize_id)->get();
				foreach($stdeurosizelst as $stdeurolst){
					$data=$data.'<option value='.$eurosizelst->id.'>'.$stdeurolst->value.'</option>';
				}
			}
			$data=$data.'</select>';
		}
		return $data;
	}
	
	public function measurestddetls(){
		$data="";
		if(isset($_POST['cntryid'])){
			$measurelst = BodyMeasurment::select('*')->where('cat_id','=',3)->where('country_id','=',$_POST['cntryid'])->where('id','=',$_POST['sizeid'])->get();
            foreach($measurelst as $measuresrec){
				$data=$measuresrec->chest."/".$measuresrec->waist."/".$measuresrec->hip."/".$measuresrec->shoulder."/".$measuresrec->length;
            }
		}
		return $data;
	}
	
	public function get_item(Request $request)
   {
	  /* echo '<pre>';
	   print_r($_POST);
	   echo '<pre>';
	   exit();*/ 
	   
		if(Session::has('carts')) {
			$cartsess=Session::get('carts');						
		}else{
			 $carts=md5(microtime().rand());
			$cartsess=Session::put('carts', $carts);							
		}
		
		if (Auth::check())
			{
				$userid=Auth::user()->id;
				
				$cartuser = Cart::select('id')->where('user_id' ,'=' , $userid)->count();
				if($cartuser>0){
																
						DB::table('carts')
						->where('user_id', $userid)
						->update(['cart_sessionid' => $cartsess]);					
				}
			}else{
				$userid=Null;
			}
		
		
		$eTailorObj = json_decode($request['setarr'], true);
		
			$finalarr = json_decode($request['setarr'], true);
			
			$finalarr['osizePattern']= $request['mpattern'];
		   if($request['mpattern']=="Body" || $request['mpattern']=="Outfit"){
				$finalarr['osizeStyle']= $request['fitstyle'];			
				$finalarr['osizeType']= $request['bsizetyp'];			
				$finalarr['osizeChest']= $request['bsizeChest'];
				$finalarr['osizeWaist']= $request['bsizeWaist'];
				$finalarr['osizeHip']= $request['bsizeHip'];
				$finalarr['osizeShoulder']= $request['bsizeShoulder'];
				$finalarr['osizeLength']= $request['bsizeLength'];	
				
				$finalarr['osizeFit']='';				
				
			  } elseif($request['mpattern']=="Standard"){
				  
				  if($request['cntrysize']==2){
						$finalarr['osizeStyle']= 'Uk/American Size';
					}else{
						$finalarr['osizeStyle']= 'European Size';
					}
				
				$finalarr['osizeFit']=$request['hsizefit'];	
				$finalarr['osizeType']= $request['sizetyp'];			
				$finalarr['osizeChest']= $request['sizeChest'];
				$finalarr['osizeWaist']= $request['sizeWaist'];
				$finalarr['osizeHip']= $request['sizeHip'];
				$finalarr['osizeShoulder']= $request['sizeShoulder'];
				$finalarr['osizeLength']= $request['sizeLength'];
				  
			  }
			
			$finalarr['oqty']= 1;			
			$finalarr['ofrontView']= '';
			$finalarr['obackView']= '';
			
			
				$ppt=$finalarr;												
				 $cartSet = [
					'cart_sessionid' => $cartsess,
					'cat_id' => $eTailorObj['ocatID'],
					'user_id' => $userid,
					'group_id' => $eTailorObj['ofabricType'],
					'fabric_id' => $eTailorObj['ofabric'],
					'fabric_name' => $eTailorObj['ofabricName'],
					'fabric_image' => $eTailorObj['ofabricImage'],
					'item_description' => serialize($ppt),
					'price' => $eTailorObj['ofabricPrice'],					
					'qty' => 1,
					'total' => $eTailorObj['oqty']*$eTailorObj['ofabricPrice'],
					 'created_at' => date('y-m-d H:i:s'),
					'updated_at' => date('y-m-d H:i:s'),
				];
			
			if($eTailorObj['ocartID']==''){
					$ids = DB::table('carts')->insert($cartSet);
					$cartId = DB::getPdo()->lastInsertId();
					
					$canvasSet = [
						'cart_id' => $cartId,
						'canvas_front_img' => $request['frntviewfinal'],
						'canvas_back_img' => $request['bkviewfinal'],					
						 'created_at' => date('y-m-d H:i:s'),
						'updated_at' => date('y-m-d H:i:s'),
					];
		  			$canvasids = DB::table('canvas_dataurls')->insert($canvasSet);
			 }else{
				 	DB::table('carts')
						->where('id', $eTailorObj['ocartID'])
						->update($cartSet);
						
					$cartId=$eTailorObj['ocartID'];
					$cartimg = Cart::select('canvas_front_img','canvas_back_img')->where('id', '=',  $cartId)->first();					
					
					$deletefront=Helpers::imggdelete($cartimg->canvas_front_img);
					$deleteback=Helpers::imggdelete($cartimg->canvas_back_img);
					
					$canvasSet = [					
						'orderitem_id' => $cartId,
						'canvas_front_img' => $request['frntviewfinal'],
						'canvas_back_img' => $request['bkviewfinal'],
						'updated_at' => date('y-m-d H:i:s'),
					];
					$canvasids = DB::table('canvas_dataurls')->where('cart_id', $cartId)->update($canvasSet);					
					
			 }
			 
			 /*Update front image and back image*/
				$frontimg=Helpers::dataurltoimg($request['frntviewfinal'],$cartId,'front');
				$backimg=Helpers::dataurltoimg($request['bkviewfinal'],$cartId,'back');			 
				
				$cartimgSet = [					
					'canvas_front_img' => $frontimg,
					'canvas_back_img' => $backimg,				 
				];
				DB::table('carts')->where('id', $cartId)->update($cartimgSet);

	   
	   return Redirect::to('/cart');
   }
       
}
