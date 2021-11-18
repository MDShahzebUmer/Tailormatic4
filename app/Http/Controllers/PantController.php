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

class PantController extends Controller
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
        $common_name = Helpers::get_pants_FirstInfo(4); 
		$eTailorObj=[
			'oprodType'=>'Pants',
			'ocatID'=>'4',
			'ofabricGroup'=>$common_name['fbgrp_name'],
			'ofabricType'=>$common_name['fabric_gid'],
			'ofabricPrice'=>$common_name['fabric_rate'],
			'ofabric'=>$common_name['fabric_eid'],
			'ofabricName'=>$common_name['fabric_name'],
			'ofabricImage'=>$common_name['fabric_img_l'],
			'ofabricList'=>$common_name['fabric_img_s'],
			'ofabricDesc'=>$common_name['fabric_desc'],
			'ostyle'=>'99',
			'ostyleName'=>'Normal Straight',
			'opleat'=>'103',
			'opleatName'=>'Single Pleat',
			'opacket'=>'109', 
			'opacketName'=>'Slanted',
			'obackpockt'=>'114',
			'obackpocktName'=>'Single Opening',
			'obackpocktSide'=>'right',
			'obeltloop'=>'120',
			'obeltloopName'=>'Single',
			'owaistbandedge'=>'normal',
			'ocuff'=>'125',
			'ocuffName'=>'Regular',
			'ocontrast'=>'79',
			'ocontrastName'=>'Houndstooth',
			'ocontbeltloop'=>'false',
			'ocontbackpockets'=>'false',
			'obutton'=>'37',
			'obuttonName'=>'White',
			'obuttonCode'=>'S1',
			'obuttonHole'=>'23',
			'obuttonHoleName'=>'White',
			'obuttonHoleCode'=>'A8',
			'osizePattern'=>'Body',
			'osizeStyle'=>'Comfortable',
			'osizeType'=>'inch',
			'osizeFit'=>'',
			'osizeWaist'=>'',
			'osizeHip'=>'',
			'osizeCrotch'=>'',
			'osizeThigh'=>'',
			'osizeLength'=>'',
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
		$car_record = Category::select('*')->where('id', '=', 4)->first($id);
		$cat_id = $car_record->id;
		$group_record = FabricGroup::select('*')->where('cat_id', '=', $cat_id)->where('fabric_status','=','ACTIVE')->get();
		//echo '<pre>'.print_r($group_record,true).'</pre>';
		
		/* Attribute Style */
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 45)->get();
		
		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 46)->get();
        return view('pants.pants')->with(compact('car_record','group_record','mainattr_record','contrast_record','eTailorObj','mytab','mysubtab','loadme'));
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
		
		$data=$data.'<div class="et-content-fab"><figure class="et-fab-img"><img src="'.$paths.'/'.$fabric_record->fabric_img_l.'" alt="'.$eTailorObjN['ofabricName'].'"></figure><div class="et-fab-box"><h3>'.$eTailorObjN['ofabricDesc'].'</h3><span>'.$eTailorObjN['ofabricName'].'</span><span>Fit-Guaranteed Price<img src="'.$p[0].'/demo/img/product/info.png" alt="info"></span><h1>$'.$eTailorObjN['ofabricPrice'].'</h1><h3><a href="#" data-toggle="modal" data-target="#fabric-id">Zoom</a></h3></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div><div class="modal fade et-fabric-modal" id="fabric-id" tabindex="-1" role="dialog" aria-labelledby="fabric-modal"><div class="modal-dialog" role="document"><div class="modal-content"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><div class="modal-body"><figure class="et-fabric-big"><img src="'.$paths.'/'.$eTailorObjN['ofabricImage'].'" alt="'.$eTailorObjN['ofabricName'].'"></figure></div></div></div></div>';
		/* STYLE */
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 4)->where('parent_id', '=', 45)->get();
		foreach($mainattr_record as $mattr){
			$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
			if($mattr->id=="50"){
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get(); 
			foreach($stylelst as $styllst){
				if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">';  $stylci=1;}
				if(($styllst->id==112 || $styllst->id==113) && $eTailorObjN['opleat']==102){
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
				   
				   $styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				   foreach($styleimglst as $ls){
					   $datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'"></figure>';
					   if($mattr->id==50){ if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';} }
				   }
				   $datastyle=$datastyle.'</li>'; 
				} elseif($styllst->id==108 || $styllst->id==109 || $styllst->id==110 || $styllst->id==111){
				   $datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
				   
				   $styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				   foreach($styleimglst as $ls){
					   $datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'"></figure>';
					   if($mattr->id==50){ if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}}
				   }
				   $datastyle=$datastyle.'</li>';
				}
				$stylci++;
			}
			} else {
				$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get(); 
				foreach($stylelst as $styllst){
					if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">';  $stylci=1;}
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
					
					$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
					foreach($styleimglst as $ls){
						$datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'"></figure>';
						if($mattr->id==48){ if($styllst->id == $eTailorObjN['ostyle']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
						} elseif($mattr->id==49){ if($styllst->id == $eTailorObjN['opleat']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
						} elseif($mattr->id==51){ if($styllst->id == $eTailorObjN['obackpockt']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
						} elseif($mattr->id==52){ if($styllst->id == $eTailorObjN['obeltloop']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
						} elseif($mattr->id==53){ if($styllst->id == $eTailorObjN['ocuff']){ $datastyle=$datastyle.'<div class="icon-check"></div>';} 
						}
					}
					$datastyle=$datastyle.'</li>'; 
					$stylci++;
				}
			}
			$datastyle=$datastyle.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-left.png" alt=""></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-right.png" alt=""></span><span class="sr-only">Next</span></a></div></div>';
        }
        
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg">';
		$datastyle=$datastyle.'<div class="et-content-fab " id="miniview-etstyle-48"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['ostyleName'].'</h2><p>Classic,All Time,Business</p></div></div>';
	    $datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstyle-49" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opleatName'].'</h2><p>Classic,All Time,Business</p></div></div>';
        $datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstyle-50" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opacketName'].'</h2><p>Classic,All Time,Business</p></div></div>';
        $datastyle=$datastyle.'<div class="et-content-fab jacket-pocket-bg" id="miniview-etstyle-51" style="display:none;"><div class="et-style-select"><h2>Back Pockets</h2><p>'.$eTailorObjN['obackpocktName'].'</p><div class="radio"><label>';
		if($eTailorObjN['obackpocktSide']=="left"){ $datastyle=$datastyle.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" checked onClick="javascript:getseloptions(\'left\',\'PocketSide\',\'51\',\'etstyle\');">';}else {$datastyle=$datastyle.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" onClick="javascript:getseloptions(\'left\',\'PocketSide\',\'51\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span> Left </label></div><div class="radio"><label>';
		if($eTailorObjN['obackpocktSide']=="right"){ $datastyle=$datastyle.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" checked onClick="javascript:getseloptions(\'right\',\'PocketSide\',\'51\',\'etstyle\');">';} else {$datastyle=$datastyle.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" onClick="javascript:getseloptions(\'right\',\'PocketSide\',\'51\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span> Right </label></div><div class="radio"><label>';
		if($eTailorObjN['obackpocktSide']=="both"){ $datastyle=$datastyle.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" checked onClick="javascript:getseloptions(\'both\',\'PocketSide\',\'51\',\'etstyle\');">';} else {$datastyle=$datastyle.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" onClick="javascript:getseloptions(\'both\',\'PocketSide\',\'51\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span> Both</label></div></div></div>';
        $datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstyle-52" style="display:none;"><div class="et-style-select"><h2>Belt Loop and Waistband</h2><p>'.$eTailorObjN['obeltloopName'].'</p><span>Waistband Edge</span><div class="radio"><label>';
		if($eTailorObjN['owaistbandedge']=="normal"){ $datastyle=$datastyle.'<input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" checked onClick="javascript:getseloptions(\'normal\',\'WaistEdge\',\'52\',\'etstyle\');">';} else {$datastyle=$datastyle.'<input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" onClick="javascript:getseloptions(\'normal\',\'WaistEdge\',\'52\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>Normal</label></div><div class="radio"><label>';
		if($eTailorObjN['owaistbandedge']=="round"){ $datastyle=$datastyle.'<input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" checked onClick="javascript:getseloptions(\'round\',\'WaistEdge\',\'52\',\'etstyle\');">';} else{ $datastyle=$datastyle.'<input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" onClick="javascript:getseloptions(\'round\',\'WaistEdge\',\'52\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>Round</label></div><div class="radio"><label>';
		if($eTailorObjN['owaistbandedge']=="square"){ $datastyle=$datastyle.'<input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" checked onClick="javascript:getseloptions(\'square\',\'WaistEdge\',\'52\',\'etstyle\');">';} else {$datastyle=$datastyle.'<input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" onClick="javascript:getseloptions(\'square\',\'WaistEdge\',\'52\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>Square</label></div></div></div>';
        $datastyle=$datastyle.'<div class="et-content-fab pant-style" id="miniview-etstyle-53" style="display:none;"><figure class="et-selected-img et-selected-full">';
        if($eTailorObjN['ocuff']=="125"){
        $datastyle=$datastyle.'<img src="'.$paths.'/Pants/Style/Cuffs/Regular/Show/'.$eTailorObjN['ofabric'].'.png" alt="">';
		} elseif($eTailorObjN['ocuff']=="126"){
        $datastyle=$datastyle.'<img src="'.$paths.'/Pants/Style/Cuffs/Cuff/Show/'.$eTailorObjN['ofabric'].'.png" alt="">';
		} elseif($eTailorObjN['ocuff']=="127"){
        $datastyle=$datastyle.'<img src="'.$paths.'/Pants/Style/Cuffs/SingleTabs/Show/'.$eTailorObjN['ofabric'].'.png" alt=""><img src="'.$paths.'/Pants/Style/Cuffs/SingleTabs/Button/ShowImg/'.$eTailorObjN['obutton'].'.png" alt="">';
		} elseif($eTailorObjN['ocuff']=="128"){
        $datastyle=$datastyle.'<img src="'.$paths.'/Pants/Style/Cuffs/DoubleTabs/Show/'.$eTailorObjN['ofabric'].'.png" alt=""><img src="'.$paths.'/Pants/Style/Cuffs/DoubleTabs/Button/ShowImg/'.$eTailorObjN['obutton'].'.png" alt="">';
		} elseif($eTailorObjN['ocuff']=="129"){
        $datastyle=$datastyle.'<img src="'.$paths.'/Pants/Style/Cuffs/FoldoverTabs/Show/'.$eTailorObjN['ofabric'].'.png" alt=""><img src="'.$paths.'/Pants/Style/Cuffs/FoldoverTabs/Button/ShowImg/'.$eTailorObjN['obutton'].'.png" alt="">';
		}
        $datastyle=$datastyle.'</figure><div class="et-style-select"><h2>'.$eTailorObjN['ocuffName'].'</h2>';
        if($eTailorObjN['ocuff']!="125"){
        	$datastyle=$datastyle.'<p>If you choose Double Cuff style the Pant Length measurement that you measure has to be very accurate as double cuff styles the Length of Pants can not be adjusted,for new customers we suggest regular cuffs as it is very easy to adjust with your tailor locally.</p>';
		}
        $datastyle=$datastyle.'</div>';
		 $datastyle=$datastyle.'</div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $fabgrp,'4' => $eTailorObjN,'5' => $datastyle];
		return $data;
	}
	
	public function getstyledetails(){
		$data='';
		$datastyle='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		switch($attrbid){
			case '48':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['ostyle']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['ostyleName']=$style_record->style_name;
				
				$data=$data.'<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['ostyleName'].'</h2><p>Classic,All Time,Business</p></div>';
				break;
			case '49':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['opleat']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['opleatName']=$style_record->style_name;
				
				$data=$data.'<div class="et-style-select"><h2>'.$eTailorObjN['opleatName'].'</h2><p>Classic,All Time,Business</p></div>';
				break;
			case '50':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['opacket']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['opacketName']=$style_record->style_name;
				
				$data=$data.'<div class="et-style-select"><h2>'.$eTailorObjN['opacketName'].'</h2><p>Classic,All Time,Business</p></div>';
				break;
			case '51':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['obackpockt']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obackpocktName']=$style_record->style_name;
				
				$data=$data.'<div class="et-style-select"><h2>Back Pockets</h2><p>'.$eTailorObjN['obackpocktName'].'</p><div class="radio"><label>';
				if($eTailorObjN['obackpocktSide']=="left"){ $data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" checked onClick="javascript:getseloptions(\'left\',\'PocketSide\',\'51\',\'etstyle\');">';}else {$data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" onClick="javascript:getseloptions(\'left\',\'PocketSide\',\'51\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span> Left </label></div><div class="radio"><label>';
				if($eTailorObjN['obackpocktSide']=="right"){ $data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" checked onClick="javascript:getseloptions(\'right\',\'PocketSide\',\'51\',\'etstyle\');">';} else {$data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" onClick="javascript:getseloptions(\'right\',\'PocketSide\',\'51\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span> Right </label></div><div class="radio"><label>';
				if($eTailorObjN['obackpocktSide']=="both"){ $data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" checked onClick="javascript:getseloptions(\'both\',\'PocketSide\',\'51\',\'etstyle\');">';} else {$data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" onClick="javascript:getseloptions(\'both\',\'PocketSide\',\'51\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span> Both</label></div></div>';
				break;
			case '52':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['obeltloop']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obeltloopName']=$style_record->style_name;
				
				$data=$data.'<div class="et-style-select"><h2>Belt Loop and Waistband</h2><p>'.$eTailorObjN['obeltloopName'].'</p><span>Waistband Edge</span><div class="radio"><label>';
				if($eTailorObjN['owaistbandedge']=="normal"){ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" checked onClick="javascript:getseloptions(\'normal\',\'WaistEdge\',\'52\',\'etstyle\');">';} else {$data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" onClick="javascript:getseloptions(\'normal\',\'WaistEdge\',\'52\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span>Normal</label></div><div class="radio"><label>';
				if($eTailorObjN['owaistbandedge']=="round"){ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" checked onClick="javascript:getseloptions(\'round\',\'WaistEdge\',\'52\',\'etstyle\');">';} else{ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" onClick="javascript:getseloptions(\'round\',\'WaistEdge\',\'52\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span>Round</label></div><div class="radio"><label>';
				if($eTailorObjN['owaistbandedge']=="square"){ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" checked onClick="javascript:getseloptions(\'square\',\'WaistEdge\',\'52\',\'etstyle\');">';} else {$data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" onClick="javascript:getseloptions(\'square\',\'WaistEdge\',\'52\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span>Square</label></div></div>';
				break;
			case '53':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['ocuff']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['ocuffName']=$style_record->style_name;
				
				$data=$data.'<figure class="et-selected-img et-selected-full">';
				if($eTailorObjN['ocuff']=="125"){
				$data=$data.'<img src="'.$paths.'/Pants/Style/Cuffs/Regular/Show/'.$eTailorObjN['ofabric'].'.png" alt="">';
				} elseif($eTailorObjN['ocuff']=="126"){
				$data=$data.'<img src="'.$paths.'/Pants/Style/Cuffs/Cuff/Show/'.$eTailorObjN['ofabric'].'.png" alt="">';
				} elseif($eTailorObjN['ocuff']=="127"){
				$data=$data.'<img src="'.$paths.'/Pants/Style/Cuffs/SingleTabs/Show/'.$eTailorObjN['ofabric'].'.png" alt=""><img src="'.$paths.'/Pants/Style/Cuffs/SingleTabs/Button/ShowImg/'.$eTailorObjN['obutton'].'.png" alt="">';
				} elseif($eTailorObjN['ocuff']=="128"){
				$data=$data.'<img src="'.$paths.'/Pants/Style/Cuffs/DoubleTabs/Show/'.$eTailorObjN['ofabric'].'.png" alt=""><img src="'.$paths.'/Pants/Style/Cuffs/DoubleTabs/Button/ShowImg/'.$eTailorObjN['obutton'].'.png" alt="">';
				} elseif($eTailorObjN['ocuff']=="129"){
				$data=$data.'<img src="'.$paths.'/Pants/Style/Cuffs/FoldoverTabs/Show/'.$eTailorObjN['ofabric'].'.png" alt=""><img src="'.$paths.'/Pants/Style/Cuffs/FoldoverTabs/Button/ShowImg/'.$eTailorObjN['obutton'].'.png" alt="">';
				}
				$data=$data.'</figure><div class="et-style-select"><h2>'.$eTailorObjN['ocuffName'].'</h2>';
				if($eTailorObjN['ocuff']!="125"){
					$data=$data.'<p>If you choose Double Cuff style the Pant Length measurement that you measure has to be very accurate as double cuff styles the Length of Pants can not be adjusted,for new customers we suggest regular cuffs as it is very easy to adjust with your tailor locally.</p>';
				}
				$data=$data.'</div>';
				break;
		}
		/*Pockets*/
		$datastyle=$datastyle.'<div id="et-style-item-50" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',50)->get(); 
			foreach($stylelst as $styllst){
				if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">';  $stylci=1;}
				if(($styllst->id==112 || $styllst->id==113) && $eTailorObjN['opleat']==102){
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-50-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\'50\',\'etstyle\');">';
				   
				   $styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				   foreach($styleimglst as $ls){
					   $datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'"></figure>';
					   if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
				   }
				   $datastyle=$datastyle.'</li>'; 
				} elseif($styllst->id==108 || $styllst->id==109 || $styllst->id==110 || $styllst->id==111){
				   $datastyle=$datastyle.'<li class="et-item" id="optionlist-50-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\'50\',\'etstyle\');">';
				   
				   $styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				   foreach($styleimglst as $ls){
					   $datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'"></figure>';
					   if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
				   }
				   $datastyle=$datastyle.'</li>';
				}
				$stylci++;
			}
			$datastyle=$datastyle.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-50" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-left.png" alt=""></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-50" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-right.png" alt=""></span><span class="sr-only">Next</span></a></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datastyle];
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
	
	public function getbuttondetails(){
		$data='';
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
		
		$data=$data.'<div class="et-style-select"><h2>Jacket Button</h2><p>'.$eTailorObjN['obuttonName'].'</p></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
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
		
		$data=$data.'<div class="et-style-select"><h2>Jacket Button</h2><p>'.$eTailorObjN['obuttonName'].'</p></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}
	
	public function getsetoptiondetails(){
		$data='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$options=$_POST['opttyp'];
		
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		switch($options){
			case "PocketSide":
				$eTailorObjN['obackpocktSide']=$ff;
				
				$data=$data.'<div class="et-style-select"><h2>Back Pockets</h2><p>'.$eTailorObjN['obackpocktName'].'</p><div class="radio"><label>';
				if($eTailorObjN['obackpocktSide']=="left"){ $data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" checked onClick="javascript:getseloptions(\'left\',\'PocketSide\',\'51\',\'etstyle\');">';}else {$data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" onClick="javascript:getseloptions(\'left\',\'PocketSide\',\'51\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span> Left </label></div><div class="radio"><label>';
				if($eTailorObjN['obackpocktSide']=="right"){ $data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" checked onClick="javascript:getseloptions(\'right\',\'PocketSide\',\'51\',\'etstyle\');">';} else {$data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" onClick="javascript:getseloptions(\'right\',\'PocketSide\',\'51\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span> Right </label></div><div class="radio"><label>';
				if($eTailorObjN['obackpocktSide']=="both"){ $data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" checked onClick="javascript:getseloptions(\'both\',\'PocketSide\',\'51\',\'etstyle\');">';} else {$data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" onClick="javascript:getseloptions(\'both\',\'PocketSide\',\'51\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span> Both</label></div></div>';
				break;
			case "WaistEdge":
				$eTailorObjN['owaistbandedge']=$ff;
				
				$data=$data.'<div class="et-style-select"><h2>Belt Loop and Waistband</h2><p>'.$eTailorObjN['obeltloopName'].'</p><span>Waistband Edge</span><div class="radio"><label>';
				if($eTailorObjN['owaistbandedge']=="normal"){ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" checked onClick="javascript:getseloptions(\'normal\',\'WaistEdge\',\'52\',\'etstyle\');">';} else {$data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" onClick="javascript:getseloptions(\'normal\',\'WaistEdge\',\'52\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span>Normal</label></div><div class="radio"><label>';
				if($eTailorObjN['owaistbandedge']=="round"){ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" checked onClick="javascript:getseloptions(\'round\',\'WaistEdge\',\'52\',\'etstyle\');">';} else{ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" onClick="javascript:getseloptions(\'round\',\'WaistEdge\',\'52\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span>Round</label></div><div class="radio"><label>';
				if($eTailorObjN['owaistbandedge']=="square"){ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" checked onClick="javascript:getseloptions(\'square\',\'WaistEdge\',\'52\',\'etstyle\');">';} else {$data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" onClick="javascript:getseloptions(\'square\',\'WaistEdge\',\'52\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span>Square</label></div></div>';
				break;
			case "BeltLoop":
				if($ff=="true"){ $eTailorObjN['ocontbeltloop']="false"; } else { $eTailorObjN['ocontbeltloop']="true"; }
				
				$data=$data.'<div class="et-style-select"><h2>Contrast Fabric</h2><div class="et-check-box"><div class="checkbox"><label>';
				if($eTailorObjN['ocontbeltloop']=="true"){$data=$data.'<input type="checkbox" name="beltlooptxt" id="beltlooptxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontbeltloop'].',\'BeltLoop\',\'54\',\'etcontrast\');">';}else{$data=$data.'<input type="checkbox" name="beltlooptxt" id="beltlooptxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontbeltloop'].',\'BeltLoop\',\'54\',\'etcontrast\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Belt Loops</label></div><div class="checkbox"><label>';
				if($eTailorObjN['ocontbackpockets']=="true"){ $data=$data.'<input type="checkbox" name="backpocketstxt" id="backpocketstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontbackpockets'].',\'BackPockets\',\'54\',\'etcontrast\');">';} else{$data=$data.'<input type="checkbox" name="backpocketstxt" id="backpocketstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontbackpockets'].',\'BackPockets\',\'54\',\'etcontrast\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Pockets</label></div></div></div>';
				break;
			case "BackPockets":
				if($ff=="true"){ $eTailorObjN['ocontbackpockets']="false"; } else { $eTailorObjN['ocontbackpockets']="true"; }
				
				$data=$data.'<div class="et-style-select"><h2>Contrast Fabric</h2><div class="et-check-box"><div class="checkbox"><label>';
				if($eTailorObjN['ocontbeltloop']=="true"){$data=$data.'<input type="checkbox" name="beltlooptxt" id="beltlooptxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontbeltloop'].',\'BeltLoop\',\'54\',\'etcontrast\');">';}else{$data=$data.'<input type="checkbox" name="beltlooptxt" id="beltlooptxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontbeltloop'].',\'BeltLoop\',\'54\',\'etcontrast\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Belt Loops</label></div><div class="checkbox"><label>';
				if($eTailorObjN['ocontbackpockets']=="true"){ $data=$data.'<input type="checkbox" name="backpocketstxt" id="backpocketstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocontbackpockets'].',\'BackPockets\',\'54\',\'etcontrast\');">';} else{$data=$data.'<input type="checkbox" name="backpocketstxt" id="backpocketstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocontbackpockets'].',\'BackPockets\',\'54\',\'etcontrast\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Pockets</label></div></div></div>';
				break;
		}
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}
	
	public function measurestd(){
		$data="";
		if(isset($_POST['sizeid'])){
			$data='<select class="selectpicker btn-primary" id="sizefit" name="sizefit" onChange="javascript:changeSizeDetails();">';
			$measureeurolst = BodyMeasurment::select('*')->where('cat_id','=',4)->where('country_id','=',$_POST['sizeid'])->get();
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
			$measurelst = BodyMeasurment::select('*')->where('cat_id','=',4)->where('country_id','=',$_POST['cntryid'])->where('id','=',$_POST['sizeid'])->get();
            foreach($measurelst as $measuresrec){
				$data=$measuresrec->waist."/".$measuresrec->hip."/".$measuresrec->crotch."/".$measuresrec->thigh."/".$measuresrec->length;
            }
		}
		return $data;
	}
	

   
   public function get_item(Request $request)
   {
	   		   
	 /*  $eTailorObj = json_decode($request['setarr'], true);
	   print_r($eTailorObj);	   
	   echo $request['mpattern'];*/

	   
	     $eTailorObj = json_decode($request['setarr'], true);
		   
	
		 
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
			  
		   //$eTailorObj = json_decode($request['setarr'], true);  
		   $finalarr = json_decode($request['setarr'], true);
		   $finalarr['mpattern']= $request['mpattern'];
		   
		  
		   $finalarr['sizetyp']=$request['sizetyp'];
		   $finalarr['ofrontView']= '';
			$finalarr['obackView']= '';
			
		   
		   $finalarr = $eTailorObj;
		   $finalarr['osizePattern']= $request['mpattern'];
		   if($request['mpattern']=="Body"){
				$finalarr['osizeStyle']= $request['fitstyle'];			
				$finalarr['osizeType']= $request['bsizetyp'];				
				$finalarr['osizeWaist']= $request['bsizeWaist'];
				$finalarr['osizeHip']= $request['bsizeHip'];
				$finalarr['osizeCrotch']= $request['bsizeCrotch'];
				$finalarr['osizeThigh']= $request['bsizeThigh'];
				$finalarr['osizeLength']= $request['bsizeLength'];			
				$finalarr['oqty']= 1;			
				
				$finalarr['osizeFit']='';				
				
			  } elseif($request['mpattern']=="Standard"){
				  
				  if($request['cntrysize']==2){
					$finalarr['osizeStyle']= 'Uk/American Size';
				}else{
					$finalarr['osizeStyle']= 'European Size';
				}
				
				$finalarr['osizeFit']=$request['hsizefit'];	
				$finalarr['osizeType']= $request['sizetyp'];			
				$finalarr['osizeWaist']= $request['sizeWaist'];
				$finalarr['osizeHip']= $request['sizeHip'];
				$finalarr['osizeCrotch']= $request['sizeCrotch'];
				$finalarr['osizeThigh']= $request['sizeThigh'];
				$finalarr['osizeLength']= $request['sizeLength'];			
				$finalarr['oqty']= $request['selstdqty'];					
				  
			  }
				
								
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
						'total' => $eTailorObj['ofabricPrice'],
						 'created_at' => date('y-m-d H:i:s'),
						'updated_at' => date('y-m-d H:i:s'),
					];
					
					 //Insert if record is new ot
					 if($eTailorObj['ocartID']==''){
						
						$ids = DB::table('carts')->insert($cartSet);
						$cartId = DB::getPdo()->lastInsertId();	
						
						/* insert canvas dataurl*/
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
						
						/* Update canvas dataurl*/
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
