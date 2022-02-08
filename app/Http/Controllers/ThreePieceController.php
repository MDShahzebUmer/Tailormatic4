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


class ThreePieceController extends Controller
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
		if($device!='SYSTEM'){
			return redirect(route('mobile3pcsuits'));
		}
        //jacket data ================================================================             
        $common_name1 = Helpers::get_jacket_FirstInfo(2);

		$fb_group = Helpers::get_fabric_group_info(18);
		$fabric_rate = $common_name1['fabric_rate'];
		$fbgrp_name = $common_name1['fbgrp_name'];
		foreach($fb_group as $row){
			if($row->parent_id == $common_name1['fabric_gid']){
				if($row->fabric_offer_price != 0 && $row->fabric_offer_price != '')
				{
					$fabric_rate = $row->fabric_offer_price;
				}else{
					$fabric_rate = $row->fabric_rate;
				}
				$fbgrp_name = $row->fbgrp_name;
				break;
			}
		}

		$eJacketTailorObj=[
			'oprodType'=>'Jacket',
			'ocatID'=>'2',
			'ofabricGroup'=> $fbgrp_name,
			'ofabricType'=> $common_name1['fabric_gid'],
			'ofabricPrice'=> $fabric_rate,
			'ofabric'=> $common_name1['fabric_eid'],
			'ofabricName'=> $common_name1['fabric_name'],
			'ofabricImage'=> $common_name1['fabric_img_l'],
			'ofabricList'=> $common_name1['fabric_img_s'],
			'ofabricDesc'=> $common_name1['fabric_desc'],
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
		
		$mytabjacket="etfabricjacket";
		$myjacketsubtab="fabric".$common_name1['fabric_gid'];
		$loadme="0";

		/* Fabric */
		$id=$eJacketTailorObj['ocatID'];
		$car_record = Category::select('*')->where('id', '=', 2)->first($id);
		$cat_id = $car_record->id;
		$group_jacket_record = FabricGroup::select('*')
			->where('cat_id', '=', $cat_id)
			->where('fabric_status','=','ACTIVE')
			->get();
		
		/* Attribute Style */
		$mainattr_jacket_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 16)->get();		
		/* Contrast */
		$contrast_jacker_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 17)->get();
        
        //pants data ================================================================
        $common_name2 = Helpers::get_pants_FirstInfo(4); 

		$fabric_rate = $common_name2['fabric_rate'];
		$fbgrp_name = $common_name2['fbgrp_name'];
		foreach($fb_group as $row){
			if($row->parent_id == $common_name2['fabric_gid']){
				if($row->fabric_offer_price != 0 && $row->fabric_offer_price != '')
				{
					$fabric_rate = $row->fabric_offer_price;
				}else{
					$fabric_rate = $row->fabric_rate;
				}
				$fbgrp_name = $row->fbgrp_name;
				break;
			}
		}

		$ePantTailorObj=[
			'oprodType'=>'Pants',
			'ocatID'=>'4',
			'ofabricGroup'=>$fbgrp_name,
			'ofabricType'=>$common_name2['fabric_gid'],
			'ofabricPrice'=>$fabric_rate,
			'ofabric'=>$common_name2['fabric_eid'],
			'ofabricName'=>$common_name2['fabric_name'],
			'ofabricImage'=>$common_name2['fabric_img_l'],
			'ofabricList'=>$common_name2['fabric_img_s'],
			'ofabricDesc'=>$common_name2['fabric_desc'],
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
		$mypanttab="etfabricpant";
		$mypantsubtab="fabric".$common_name2['fabric_gid'];

		/* Fabric */
		$id=$ePantTailorObj['ocatID'];
		$car_record2 = Category::select('*')->where('id', '=', 4)->first($id);
		$cat_id = $car_record2->id;
		$group_pant_record = FabricGroup::select('*')->where('cat_id', '=', $cat_id)->where('fabric_status','=','ACTIVE')->get();
		//echo '<pre>'.print_r($group_pant_record,true).'</pre>';
		
		/* Attribute Style */
		$mainattr_pant_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 45)->get();
		
		/* Contrast */
		$contrast_pant_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 46)->get();

		// vests data ===================================================================================
		$common_name = Helpers::get_vests_FirstInfo(3);

		$fabric_rate = $common_name['fabric_rate'];
		$fbgrp_name = $common_name['fbgrp_name'];
		foreach($fb_group as $row){
			if($row->parent_id == $common_name['fabric_gid']){
				if($row->fabric_offer_price != 0 && $row->fabric_offer_price != '')
				{
					$fabric_rate = $row->fabric_offer_price;
				}else{
					$fabric_rate = $row->fabric_rate;
				}
				$fbgrp_name = $row->fbgrp_name;
				break;
			}
		}

		$eTailorObj=[
			'oprodType'=>'Vests',
			'ocatID'=>'3',
			'ofabricGroup'=>$fbgrp_name,
			'ofabricType'=>$common_name['fabric_gid'],
			'ofabricPrice'=>$fabric_rate,
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
			'ocartID'=>''
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

        return view('threepiece.threepiece')->with(
        	compact('car_record','group_jacket_record','mainattr_jacket_record','contrast_jacker_record','fb_group'
        		,'eJacketTailorObj','mytabjacket','myjacketsubtab','loadme',
        		'group_pant_record','mainattr_pant_record','contrast_pant_record','ePantTailorObj','mypanttab','mypantsubtab',
        		'group_record','mainattr_record','contrast_record','eTailorObj','mytab','mysubtab'
        	));
    } 

    // =================================== for cart ===============================================
    public function get_item(Request $request) {	
	  	$eTailorObj = json_decode($request['setarr'], true);
				 
		if(Session::has('carts')) {
			$cartsess=Session::get('carts');						
		}else{
			$carts=md5(microtime().rand());
			$cartsess=Session::put('carts', $carts);							
		}		
		
		if (Auth::check()) {
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

		/*Update front image and back image*/
		$rnd_val = rand(9,999);
		$filename_frontimg = $rnd_val.'_3piece_1_front';
		$filename_backimg = $rnd_val.'_3piece_1_back';
		$filename_pant_frontimg = $rnd_val.'_3piece_2_front';
		$filename_pant_backimg = $rnd_val.'_3piece_2_back';
		$filename_vest_frontimg = $rnd_val.'_3piece_3_front';
		$filename_vest_backimg = $rnd_val.'_3piece_3_back';

		// $finalarr = $eTailorObj;
				
		$ppt = $eTailorObj;												
		$cartSet = [
			'cart_sessionid' => $cartsess,
			'cat_id' => $request['catId'], //$eTailorObj['ocatID'],
			'user_id' => $userid,
			'group_id' => $eTailorObj['ofabricType'],
			'fabric_id' => $eTailorObj['ofabric'],
			'fabric_name' => $eTailorObj['ofabricName'],
			'fabric_image' => $eTailorObj['ofabricImage'],
			// 'item_description' => serialize($ppt),
			'price' => $request['totalPrice'], // $eTailorObj['ofabricPrice'],					
			'qty' => 1,
			'total' => $request['totalPrice'],// $eTailorObj['ofabricPrice'],
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
			// $cartimg = Cart::select('canvas_front_img','canvas_back_img','canvas_pant_front_img','canvas_pant_back_img','canvas_vest_front_img','canvas_vest_back_img')->where('id', '=',  $cartId)->first();
			$cartimg = Cart::select('canvas_front_img','canvas_back_img')->where('id', '=',  $cartId)->first();
			
			$deletefront=Helpers::imggdelete($cartimg->canvas_front_img);
			$deleteback=Helpers::imggdelete($cartimg->canvas_back_img);
			// $deletepantfront=Helpers::imggdelete($cartimg->canvas_pant_front_img);
			// $deletepantback=Helpers::imggdelete($cartimg->canvas_pant_back_img);
			// $deletepantfront=Helpers::imggdelete($cartimg->canvas_vest_front_img);
			// $deletepantback=Helpers::imggdelete($cartimg->canvas_vest_back_img);
			
			$canvasSet = [					
				'orderitem_id' => $cartId,	
				'updated_at' => date('y-m-d H:i:s'),
			];
			$canvasids = DB::table('canvas_dataurls')->where('cart_id', $cartId)->update($canvasSet);
		}		 
		

		Helpers::dataurltoimg2($request['frntviewfinal'],$cartId,$filename_frontimg);
		Helpers::dataurltoimg2($request['bkviewfinal'],$cartId,$filename_backimg);
		Helpers::dataurltoimg2($request['pant_frntviewfinal'],$cartId,$filename_pant_frontimg);
		Helpers::dataurltoimg2($request['pant_bkviewfinal'],$cartId,$filename_pant_backimg);	
		Helpers::dataurltoimg2($request['vest_frntviewfinal'],$cartId,$filename_vest_frontimg);
		Helpers::dataurltoimg2($request['vest_bkviewfinal'],$cartId,$filename_vest_backimg);

		$path_prev = 'Orderimg/'.$cartId;
		$frontimg = $path_prev.$filename_frontimg.'.png';
		$backimg = $path_prev.$filename_backimg.'.png';	
		$pant_frontimg = $path_prev.$filename_pant_frontimg.'.png';
		$pant_backimg = $path_prev.$filename_pant_backimg.'.png';
		$vest_frontimg = $path_prev.$filename_vest_frontimg.'.png';
		$vest_backimg = $path_prev.$filename_vest_backimg.'.png';

		$ppt['pant_frntviewfinal']= $pant_frontimg;
		$ppt['pant_bkviewfinal']= $pant_backimg;
		$ppt['vest_frntviewfinal']= $vest_frontimg;
		$ppt['vest_bkviewfinal']= $vest_backimg;	 
		
		$cartimgSet = [					
			'canvas_front_img' => $frontimg,
			'canvas_back_img' => $backimg,	
			// 'canvas_pant_front_img' => $pant_frontimg,
			// 'canvas_pant_back_img' => $pant_backimg,
			// 'canvas_vest_front_img' => $vest_frontimg,
			// 'canvas_vest_back_img' => $vest_backimg,
			'item_description' => serialize($ppt),				 
		];
		DB::table('carts')->where('id', $cartId)->update($cartimgSet);
		return Redirect::to('/cart');	   
    }
    // =================================== for jacket =============================================
    public function getfabjacketdetails(){
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

		$fabric_code = $fabric_record->fabric_code;
		$threepiece_record = DB::table('etfabrics')
            ->where('etfabrics.fabric_code','=',$fabric_code)
            ->join('fabric_groups', 'etfabrics.fbgrp_id', '=', 'fabric_groups.id')
            ->select('etfabrics.id','fabric_groups.cat_id','fabric_groups.fabric_rate')
            ->get();
		
		$fabgrup_record = FabricGroup::select('*')->where('id', '=', $fabgrp)->find($fabgrp);
		// if($fabgrup_record->fabric_offer_price != 0 && $fabgrup_record->fabric_offer_price != '')
		// {
		// 	  $frate = $fabgrup_record->fabric_offer_price;
		// }else{
		// 		$frate =    $fabgrup_record->fabric_rate;
		// }

		$fb_group = Helpers::get_fabric_group_info(18);	
		$frate = 0;
		foreach($fb_group as $row){
			if($row->parent_id == $fabgrup_record->id){
				if($row->fabric_offer_price != 0 && $row->fabric_offer_price != '')
				{
					$frate = $row->fabric_offer_price;
				}else{
					$frate = $row->fabric_rate;
				}
				break;
			}
		}
			
		$eTailorObjN['ofabricGroup']=$fabgrup_record->fbgrp_name;
		$eTailorObjN['ofabricType']=$fabgrp;
		$eTailorObjN['ofabricPrice']=$frate;
		$eTailorObjN['ofabricName']=$fabric_record->fabric_name;
		$eTailorObjN['ofabricImage']=$fabric_record->fabric_img_l;
		$eTailorObjN['ofabricList']=$fabric_record->fabric_img_s;
		$eTailorObjN['ofabricDesc']=$fabric_record->fabric_desc;
		
		$data=$data.'<div class="et-content-fab"><figure class="et-fab-img"><img src="'.$paths.'/'.$eTailorObjN["ofabricImage"].'" alt="'.$eTailorObjN['ofabricName'].'"></figure><div class="et-fab-box"><h3>'.$eTailorObjN['ofabricDesc'].'</h3><span>'.$eTailorObjN['ofabricName'].'</span><span>Fit-Guaranteed Price <img src="'.$p[0].'/demo/img/product/info.png" alt="info"></span><h3><a href="#" data-toggle="modal" data-target="#fabric-id">Zoom</a></h3></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigatejacketback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatejacketnext();">Next</a></li></ul></div><div class="modal fade et-fabric-modal" id="fabric-id" tabindex="-1" role="dialog" aria-labelledby="fabric-modal"><div class="modal-dialog" role="document"><div class="modal-content"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><div class="modal-body"><figure class="et-fabric-big"><img src="'.$paths.'/'.$eTailorObjN["ofabricImage"].'" alt="'.$eTailorObjN['ofabricName'].'"></figure></div></div></div></div>';
		$datastyle=$datastyle.'<div class="carousel-container">';
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 2)->where('parent_id', '=', 16)->get();
		foreach($mainattr_record as $mattr){
			$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
			if($mattr->id==21){
				$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
				foreach($stylelst as $styllst){
					if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
					if(($eTailorObjN['ostyle']==54 || $eTailorObjN['ostyle']==55 || $eTailorObjN['ostyle']==56 || $eTailorObjN['ostyle']==57 || $eTailorObjN['ostyle']==58) && ($styllst->id==130)) {
						$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
						$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
					if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
		$datastyle=$datastyle.'</div>';
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg">';
		$datastyle=$datastyle.'<div class="et-content-fab " id="miniview-etstylejacket-19"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['ostyleName'].'</h2><p>Classic,All Time,Business</p></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstylejacket-20" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['olapelName'].'</h2><p>Classic,All Time,Business</p>';
		if($eTailorObjN['olapel']!="62"){
			$datastyle=$datastyle.'<span>Button Hole on Lapel</span><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="false"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>No Button Hole</label></div><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="true"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" checked  onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>With Lapel Buttonhole</label></div>';
		}
		$datastyle=$datastyle.'</div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-bottom-bg" id="miniview-etstylejacket-21" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['obottomName'].'</h2></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-pocket-bg" id="miniview-etstylejacket-22" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opacketName'].'</h2><div class="checkbox"><label>';
		if($eTailorObjN['obreastPacket']=="false"){$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstylejacket\');">';} else{$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstylejacket\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>No Breast Pocket</label></div></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab" id="miniview-etstylejacket-23" style="display:none;"><figure class="et-sleevebuttonds"><img class="et-main-sleeve" src="'.$paths.'/Jacket/Fabric/ImageIn/'.$eTailorObjN['ofabric'].'.png">';
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
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-vent-bg" id="miniview-etstylejacket-24" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['oventName'].'</h2><p>Classic,All Time,Business</p></div>';
		$datastyle=$datastyle.'</div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigatejacketback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatejacketnext();">Next</a></li></ul></div></div>';
		
		/* Contrast */
		$datacont=$datacont.'<div class="carousel-container">';
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', 2)->where('parent_id', '=', 17)->get();
		foreach($contrast_record as $contlst){
			if($contlst->id == '25'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				 
				$contfablst = Contrast::select('*')->where('cat_id','=',2)->get(); 
				foreach($contfablst as $cfablst){
				$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cfablst->id.'" data-title="'.$cfablst->contrsfab_name.'" title="'.$cfablst->contrsfab_name.'" onClick="javascript:getjackcontrast('.$cfablst->id.',\'etcontrastjacket\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cfablst->contrsfab_img.'" alt="'.$cfablst->contrsfab_name.'"></figure>';
				if($cfablst->id==$eTailorObjN['ocontrast']){$datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';                                            
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '26'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$liningfablst = JvLiningFabric::select('*')->where('cat_id','=',2)->get(); 
				foreach($liningfablst as $lngfablst){
				$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$lngfablst->id.'" data-title="'.$lngfablst->fabric_name.'" title="'.$lngfablst->fabric_name.'" onClick="javascript:getjacketlining('.$lngfablst->id.',\'etcontrastjacket\')"><figure class="et-item-img"><img src="'.$paths.'/'.$lngfablst->lining_img.'" alt="'.$lngfablst->fabric_name.'"></figure>';
				if($lngfablst->id==$eTailorObjN['olining']){$datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';                                           
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '27'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$bckcollrfablst = Colorcoller::select('*')->get(); 
				foreach($bckcollrfablst as $bkcfablst){
				$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$bkcfablst->id.'" data-title="'.$bkcfablst->name.'" title="'.$bkcfablst->name.'" onClick="javascript:getjacketbackcollar('.$bkcfablst->id.',\'etcontrastjacket\')"><figure class="et-item-img"><img src="'.$paths.'/'.$bkcfablst->color_img.'" alt="'.$bkcfablst->name.'"></figure>';
				if($bkcfablst->id==$eTailorObjN['obackCollar']){$datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';                                           
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '28'){ 
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$buttonlst = Button::select('*')->where('cat_id','=',2)->get();
				foreach($buttonlst as $bttnlst){
				$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$bttnlst->id.'" data-title="'.$bttnlst->button_name.'" title="'.$bttnlst->button_name.'" onClick="javascript:getjacketbuttons('.$bttnlst->id.',\'etcontrastjacket\')"><figure class="et-item-img"><img src="'.$paths.'/'.$bttnlst->button_img.'" alt="'.$bttnlst->button_name.'"></figure>';
				if($bttnlst->id==$eTailorObjN['obutton']){$datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';                                            
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>B. Choose Your Button Hole Thread</span></div><div class="et-contrast-list"><ul class="et-item-list">';
				$contthrdlst = Thread::select('*')->where('cat_id','=',2)->get(); 
				foreach($contthrdlst as $cthreadlst){
				$datacont=$datacont.'<li class="et-item" id="optionlist-thrd-'.$cthreadlst->id.'" data-title="'.$cthreadlst->thrd_name.'" title="'.$cthreadlst->thrd_name.'" onClick="javascript:getjacketthread('.$cthreadlst->id.',\'etcontrastjacket\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cthreadlst->thrd_img.'" alt="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')"></figure>';
				if($cthreadlst->id==$eTailorObjN['obuttonHole']){$datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '29'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-radio-block"><div class="radio"><label>';
				if($eTailorObjN['omonogram']=="false"){$datacont=$datacont.'<input type="radio" name="chkmonotxt" id="chkmonotxt1" value="true" checked onClick="javascript:getjacketmonogram(\'false\',\'etcontrastjacket\');">';} else {$datacont=$datacont.'<input type="radio" name="chkmonotxt" id="chkmonotxt1" value="true" onClick="javascript:getjacketmonogram(\'false\',\'etcontrastjacket\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon"></i></span>No Monogram</label></div><div class="radio"><label>';
				if($eTailorObjN['omonogram']=="true"){$datacont=$datacont.'<input type="radio" name="chkmonotxt" id="chkmonotxt2" value="true" checked onClick="javascript:getjacketmonogram(\'true\',\'etcontrastjacket\');">';} else {$datacont=$datacont.'<input type="radio" name="chkmonotxt" id="chkmonotxt2" value="true" onClick="javascript:getjacketmonogram(\'true\',\'etcontrastjacket\');">';}
				$datacont=$datacont.'<span class="cr"><i class="cr-icon"></i></span>Inside Jacket</label></div></div>';
				if($eTailorObjN['omonogram']=="true"){
					$datacont=$datacont.'<div class="pt-pagination no-pad-left"><span>B. Choose Your Monogram color</span></div><div class="et-contrast-list"><ul class="et-item-list pad-left-20">';
					$monothrdlst = Thread::select('*')->where('cat_id','=',2)->get(); 
					foreach($monothrdlst as $monothrdlst){
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$monothrdlst->id.'" data-title="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')" onClick="javascript:getjacketmonotxtcolor('.$monothrdlst->id.',\'etcontrastjacket\');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')"></figure>';
					if($monothrdlst->id==$eTailorObjN['omonogramColor']){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
					}
					$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>C. Enter Desired Monogram/Initials</span></div><div class="et-contrast-list"><div class="checkbox"><label>';
					if($eTailorObjN['omonogramSpecial']=="true"){$datacont=$datacont.'<input type="checkbox" name="specialttxt" id="specialttxt" value="true" checked onClick="javascript:getjacketseloptions(\''.$eTailorObjN['omonogramSpecial'].'\',\'Special\',\'29\',\'etcontrastjacket\');">';} else {$datacont=$datacont.'<input type="checkbox" name="specialttxt" id="specialttxt" value="true" onClick="javascript:getjacketseloptions(\''.$eTailorObjN['omonogramSpecial'].'\',\'Special\',\'29\',\'etcontrastjacket\');">';}
					$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Specially Tailored For </label><input type="text" name="monotext" id="monotext" maxlength="20" value="'.$eTailorObjN['omonogramText'].'" style="color:#8c7676;" onBlur="javascript:getjacketmonotext(this.value,\'etcontrastjacket\');"></div></div>';
				}
				$datacont=$datacont.'</div>';
			}
		}
		$datacont=$datacont.'</div>';
		
		$datacont=$datacont.'<div class="et-progress-des et-style-bg">';
		$datacont=$datacont.'<div class="et-content-fab" id="miniview-etcontrastjacket-25" ><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>Contrast Fabric</h2><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['olapelupper']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrastjacket\');">';} else{$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Upper</label></div><div class="checkbox"><label>';
		if($eTailorObjN['olapellower']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrastjacket\');">';} else {$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Lower</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocontpockets']=="true"){$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrastjacket\');">';} else {$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pockets</label></div>';
		if($eTailorObjN['obreastPacket']=="true"){
			$datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ocontchestpocket']=="true"){$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrastjacket\');">';}else {$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrastjacket\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Chest Pocket</label></div>';
		}
		$datacont=$datacont.'<div class="checkbox"><label>';
		if($eTailorObjN['ocontelbowmix']=="true"){$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrastjacket\');">';} else{$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Elbow Mix</label></div></div></div></div>';
		
		$datacont=$datacont.'<div class="et-content-fab" id="miniview-etcontrastjacket-26" ><div class="et-style-select et-jacket-piping"><h5>Piping</h5><ul class="et-item-list">';
		$pipngfablst = Piping::select('*')->get();
		foreach($pipngfablst as $pipfablst){
		$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$pipfablst->id.'" data-title="'.$pipfablst->name.'" title="'.$pipfablst->name.'" onClick="javascript:getjacketpiping('.$pipfablst->id.',\'etcontrastjacket\')"><figure class="et-item-img"><img src="'.$paths.'/'.$pipfablst->piping_img.'" alt="'.$pipfablst->name.'"></figure>';
		if($pipfablst->id==$eTailorObjN['opiping']){$datacont=$datacont.'<div class="icon-check"></div>';}
		$datacont=$datacont.'</li>';                                            
		}
		$datacont=$datacont.'</ul></div></div>';
		
		$datacont=$datacont.'<div class="et-content-fab jacket-backcollr-bg" id="miniview-etcontrastjacket-27" style="display:none;" ><figure><img src="'.$paths.'/Jacket/BackColler/'.$eTailorObjN['obackCollar'].'.png" style="position: absolute;top: 0px;left: 137px;"></figure><div class="et-style-select"><h2>Back Collar</h2></div></div>';
		
		$datacont=$datacont.'<div class="et-content-fab" id="miniview-etcontrastjacket-28" style="display:none;"><figure class="et-sleevebuttonds"><img class="et-main-sleeve" src="'.$paths.'/Jacket/Fabric/ImageIn/'.$eTailorObjN['ofabric'].'.png">';
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
		
		$datacont=$datacont.'<div class="et-content-fab jacket-monogram-bg" id="miniview-etcontrastjacket-29" style="display:none;"><div class="et-style-select"><h2>Inside View of Jacket</h2>';
		if($eTailorObjN['omonogram']=="true"){
		$datacont=$datacont.'<p>Monogram Color: '.$eTailorObjN['omonogramHoleName'].'</p>';
		}
		$datacont=$datacont.'</div>';
		if($eTailorObjN['omonogram']=="true"){
			$datacont=$datacont.'<div class="et-addtttext" style="color:'.$eTailorObjN['omonogramtextColor'].'">';
			if($eTailorObjN['omonogramSpecial']=="true"){$datacont=$datacont.'<p>Specially Tailored For</p>';} else {$datacont=$datacont.'<p> </p>';}
			$datacont=$datacont.'<p>'.$eTailorObjN['omonogramText'].'</p></div>';
		}
		$datacont=$datacont.'</div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigatejacketback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatejacketnext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $fabgrp,'4' => $eTailorObjN,'5' => $datastyle,'6' => $datacont, '7' => $threepiece_record];
		return $data;
	}
	public function getstylejacketdetails(){
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
		
		$datastyle=$datastyle.'<div class="carousel-container">';
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 2)->where('parent_id', '=', 16)->get();
		foreach($mainattr_record as $mattr){
		$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
		if($mattr->id==21){
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
			foreach($stylelst as $styllst){
				if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				if(($eTailorObjN['ostyle']==54 || $eTailorObjN['ostyle']==55 || $eTailorObjN['ostyle']==56 || $eTailorObjN['ostyle']==57 || $eTailorObjN['ostyle']==58) && ($styllst->id==130)) {
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
				if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
		$datastyle=$datastyle.'</div>';
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg">';
		$datastyle=$datastyle.'<div class="et-content-fab " id="miniview-etstylejacket-19"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['ostyleName'].'</h2><p>Classic,All Time,Business</p></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstylejacket-20" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['olapelName'].'</h2><p>Classic,All Time,Business</p>';
		if($eTailorObjN['olapel']!="62"){
			$datastyle=$datastyle.'<span>Button Hole on Lapel</span><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="false"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>No Button Hole</label></div><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="true"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" checked  onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>With Lapel Buttonhole</label></div>';
		}
		$datastyle=$datastyle.'</div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-bottom-bg" id="miniview-etstylejacket-21" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['obottomName'].'</h2></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-pocket-bg" id="miniview-etstylejacket-22" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opacketName'].'</h2><div class="checkbox"><label>';
		if($eTailorObjN['obreastPacket']=="false"){$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstylejacket\');">';} else{$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstylejacket\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>No Breast Pocket</label></div></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab" id="miniview-etstylejacket-23" style="display:none;"><figure class="et-sleevebuttonds"><img class="et-main-sleeve" src="'.$paths.'/Jacket/Fabric/ImageIn/'.$eTailorObjN['ofabric'].'.png">';
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
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-vent-bg" id="miniview-etstylejacket-24" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['oventName'].'</h2><p>Classic,All Time,Business</p></div>';
		$datastyle=$datastyle.'</div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigatejacketback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatejacketnext();">Next</a></li></ul></div></div>';
		
		/*Contrast*/
		$datacont=$datacont.'<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>Contrast Fabric</h2><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['olapelupper']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrastjacket\');">';} else{$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Upper</label></div><div class="checkbox"><label>';
		if($eTailorObjN['olapellower']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrastjacket\');">';} else {$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Lower</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocontpockets']=="true"){$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrastjacket\');">';} else {$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pockets</label></div>';
		if($eTailorObjN['obreastPacket']=="true"){
			$datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ocontchestpocket']=="true"){$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrastjacket\');">';}else {$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrastjacket\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Chest Pocket</label></div>';
		}
		$datacont=$datacont.'<div class="checkbox"><label>';
		if($eTailorObjN['ocontelbowmix']=="true"){$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrastjacket\');">';} else{$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrastjacket\');">';}
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
	public function getcontrastjacketdetails(){
		$datacont='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['ocontrast']=$ff;
		$style_record = Contrast::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['ocontrastName']=$style_record->contrsfab_name;
		
		/*Contrast*/
		$datacont=$datacont.'<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>Contrast Fabric</h2><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['olapelupper']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrastjacket\');">';} else{$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Upper</label></div><div class="checkbox"><label>';
		if($eTailorObjN['olapellower']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrastjacket\');">';} else {$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Lower</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocontpockets']=="true"){$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrastjacket\');">';} else {$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pockets</label></div>';
		if($eTailorObjN['obreastPacket']=="true"){
			$datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ocontchestpocket']=="true"){$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrastjacket\');">';}else {$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrastjacket\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Chest Pocket</label></div>';
		}
		$datacont=$datacont.'<div class="checkbox"><label>';
		if($eTailorObjN['ocontelbowmix']=="true"){$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrastjacket\');">';} else{$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Elbow Mix</label></div></div></div>';
		
		$data = ['1' => $datacont,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}
	public function getbuttonjacketdetails(){
		$databtns='';
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
		
		/*Style*/
		$datastyle=$datastyle.'<div class="carousel-container">';
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 2)->where('parent_id', '=', 16)->get();
		foreach($mainattr_record as $mattr){
		$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
		if($mattr->id==21){
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
			foreach($stylelst as $styllst){
				if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				if(($eTailorObjN['ostyle']==54 || $eTailorObjN['ostyle']==55 || $eTailorObjN['ostyle']==56 || $eTailorObjN['ostyle']==57 || $eTailorObjN['ostyle']==58) && ($styllst->id==130)) {
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
				if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
		$datastyle=$datastyle.'</div>';
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg">';
		$datastyle=$datastyle.'<div class="et-content-fab " id="miniview-etstylejacket-19"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['ostyleName'].'</h2><p>Classic,All Time,Business</p></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstylejacket-20" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['olapelName'].'</h2><p>Classic,All Time,Business</p>';
		if($eTailorObjN['olapel']!="62"){
			$datastyle=$datastyle.'<span>Button Hole on Lapel</span><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="false"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>No Button Hole</label></div><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="true"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" checked  onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>With Lapel Buttonhole</label></div>';
		}
		$datastyle=$datastyle.'</div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-bottom-bg" id="miniview-etstylejacket-21" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['obottomName'].'</h2></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-pocket-bg" id="miniview-etstylejacket-22" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opacketName'].'</h2><div class="checkbox"><label>';
		if($eTailorObjN['obreastPacket']=="false"){$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstylejacket\');">';} else{$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstylejacket\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>No Breast Pocket</label></div></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab" id="miniview-etstylejacket-23" style="display:none;"><figure class="et-sleevebuttonds"><img class="et-main-sleeve" src="'.$paths.'/Jacket/Fabric/ImageIn/'.$eTailorObjN['ofabric'].'.png">';
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
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-vent-bg" id="miniview-etstylejacket-24" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['oventName'].'</h2><p>Classic,All Time,Business</p></div>';
		$datastyle=$datastyle.'</div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigatejacketback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatejacketnext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $databtns,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datastyle];
		return $data;
	}
	public function getthreadjacketdetails(){
		$databtns='';
		$datastyle='';
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
		
		/*Style*/
		$datastyle=$datastyle.'<div class="carousel-container">';
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 2)->where('parent_id', '=', 16)->get();
		foreach($mainattr_record as $mattr){
		$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
		if($mattr->id==21){
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
			foreach($stylelst as $styllst){
				if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				if(($eTailorObjN['ostyle']==54 || $eTailorObjN['ostyle']==55 || $eTailorObjN['ostyle']==56 || $eTailorObjN['ostyle']==57 || $eTailorObjN['ostyle']==58) && ($styllst->id==130)) {
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
				if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
		$datastyle=$datastyle.'</div>';
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg">';
		$datastyle=$datastyle.'<div class="et-content-fab " id="miniview-etstylejacket-19"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['ostyleName'].'</h2><p>Classic,All Time,Business</p></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstylejacket-20" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['olapelName'].'</h2><p>Classic,All Time,Business</p>';
		if($eTailorObjN['olapel']!="62"){
			$datastyle=$datastyle.'<span>Button Hole on Lapel</span><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="false"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>No Button Hole</label></div><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="true"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" checked  onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>With Lapel Buttonhole</label></div>';
		}
		$datastyle=$datastyle.'</div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-bottom-bg" id="miniview-etstylejacket-21" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['obottomName'].'</h2></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-pocket-bg" id="miniview-etstylejacket-22" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opacketName'].'</h2><div class="checkbox"><label>';
		if($eTailorObjN['obreastPacket']=="false"){$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstylejacket\');">';} else{$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstylejacket\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>No Breast Pocket</label></div></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab" id="miniview-etstylejacket-23" style="display:none;"><figure class="et-sleevebuttonds"><img class="et-main-sleeve" src="'.$paths.'/Jacket/Fabric/ImageIn/'.$eTailorObjN['ofabric'].'.png">';
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
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-vent-bg" id="miniview-etstylejacket-24" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['oventName'].'</h2><p>Classic,All Time,Business</p></div>';
		$datastyle=$datastyle.'</div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigatejacketback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatejacketnext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $databtns,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datastyle];
		return $data;
	}
	public function getmonogramjacketdetails(){
		$data='';
		$datacont='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['omonogram']=$ff;
		if($ff=="true"){ $eTailorObjN['omonogramName']="Inside Jacket";} else{ $eTailorObjN['omonogramName']="No Monogram";}
		
		$data=$data.'<div class="et-style-select"><h2>Inside View of Jacket</h2>';
        if($eTailorObjN['omonogram']=="true"){ $data=$data.'<p>Monogram Color: '.$eTailorObjN['omonogramHoleName'].'</p>';}
        $data=$data.'</div>';
        if($eTailorObjN['omonogram']=="true"){
			$data=$data.'<div class="et-addtttext" style="color:'.$eTailorObjN['omonogramtextColor'].'">';
			if($eTailorObjN['omonogramSpecial']=="true"){$data=$data.'<p>Specially Tailored For </p>';} else {$data=$data.'<p> </p>';}
			$data=$data.'<p>'.$eTailorObjN['omonogramText'].'</p></div>';
		}
		
		$datacont=$datacont.'<div class="et-radio-block"><div class="radio"><label>';
		if($eTailorObjN['omonogram']=="false"){$datacont=$datacont.'<input type="radio" name="chkmonotxt" id="chkmonotxt1" value="true" checked onClick="javascript:getjacketmonogram(\'false\',\'etcontrastjacket\');">';} else {$datacont=$datacont.'<input type="radio" name="chkmonotxt" id="chkmonotxt1" value="true" onClick="javascript:getjacketmonogram(\'false\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon"></i></span>No Monogram</label></div><div class="radio"><label>';
		if($eTailorObjN['omonogram']=="true"){$datacont=$datacont.'<input type="radio" name="chkmonotxt" id="chkmonotxt2" value="true" checked onClick="javascript:getjacketmonogram(\'true\',\'etcontrastjacket\');">';}else {$datacont=$datacont.'<input type="radio" name="chkmonotxt" id="chkmonotxt2" value="true" onClick="javascript:getjacketmonogram(\'true\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon"></i></span>Inside Jacket</label></div></div>';
        if($eTailorObjN['omonogram']=="true"){
        	$datacont=$datacont.'<div class="pt-pagination no-pad-left"><span>B. Choose Your Monogram color</span></div><div class="et-contrast-list"><ul class="et-item-list pad-left-20">';
        	$monothrdlst = Thread::select('*')->where('cat_id','=',2)->get(); 
        	foreach($monothrdlst as $monothrdlst){
				$datacont=$datacont.'<li class="et-item" id="optionlist-29-'.$monothrdlst->id.'" data-title="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')" onClick="javascript:getjacketmonotxtcolor('.$monothrdlst->id.',\'etcontrastjacket\');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')"></figure>';
			   if($monothrdlst->id==$eTailorObjN['omonogramColor']){$datacont=$datacont.'<div class="icon-check"></div>';}
			   $datacont=$datacont.'</li>';
			}
           $datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>C. Enter Desired Monogram/Initials</span></div><div class="et-contrast-list"><div class="checkbox"><label>';
		   if($eTailorObjN['omonogramSpecial']=="true"){$datacont=$datacont.'<input type="checkbox" name="specialttxt" id="specialttxt" value="true" checked onClick="javascript:getjacketseloptions(\''.$eTailorObjN['omonogramSpecial'].'\',\'Special\',\'29\',\'etcontrastjacket\');">';}else{$datacont=$datacont.'<input type="checkbox" name="specialttxt" id="specialttxt" value="true" onClick="javascript:getjacketseloptions(\''.$eTailorObjN['omonogramSpecial'].'\',\'Special\',\'29\',\'etcontrastjacket\');">';}
		   $datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Specially Tailored For </label><input type="text" name="monotext" id="monotext" maxlength="20" value="'.$eTailorObjN['omonogramText'].'" style="color:#8c7676;" onBlur="javascript:getjacketmonotext(this.value,\'etcontrastjacket\');"></div></div>';
		}
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datacont];
		return $data;
	}
	public function getoptionjacketdetails(){
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
		
		 switch($options){
		// 	case "Special":
		// 		if($ff=="true"){ $eTailorObjN['omonogramSpecial']="false"; } else { $eTailorObjN['omonogramSpecial']="true"; }
		// 		break;
		// 	case "LapelHole":
		// 		if($ff=="true"){
		// 			$eTailorObjN['olapelHole']="false";
		// 			$eTailorObjN['olapelHoleName']="No Button Hole";
		// 		} else {
		// 			$eTailorObjN['olapelHole']="true";
		// 			$eTailorObjN['olapelHoleName']="With Lapel Buttonhole";
		// 		}
		// 		break;
			case "BreastPocket":
			if($ff=="true"){ $eTailorObjN['obreastPacket']="false"; } else { $eTailorObjN['obreastPacket']="true"; }
			break;
		// 	case "LapelUpper":
		// 		if($ff=="true"){ $eTailorObjN['olapelupper']="false"; } else { $eTailorObjN['olapelupper']="true"; }
		// 		break;
		// 	case "LapelLower":
		// 		if($ff=="true"){ $eTailorObjN['olapellower']="false"; } else { $eTailorObjN['olapellower']="true"; }
		// 		break;
		// 	case "Pockets":
		// 		if($ff=="true"){ $eTailorObjN['ocontpockets']="false"; } else { $eTailorObjN['ocontpockets']="true"; }
		// 		break;
		// 	case "ChestPocket":
		// 		if($ff=="true"){ $eTailorObjN['ocontchestpocket']="false"; } else { $eTailorObjN['ocontchestpocket']="true"; }
		// 		break;
		// 	case "ElbowMix":
		// 		if($ff=="true"){ $eTailorObjN['ocontelbowmix']="false"; } else { $eTailorObjN['ocontelbowmix']="true"; }
		// 		break;
		 }
		
		/*Style*/
		$datastyle=$datastyle.'<div class="carousel-container">';
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 2)->where('parent_id', '=', 16)->get();
		foreach($mainattr_record as $mattr){
		$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
		if($mattr->id==21){
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
			foreach($stylelst as $styllst){
				if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				if(($eTailorObjN['ostyle']==54 || $eTailorObjN['ostyle']==55 || $eTailorObjN['ostyle']==56 || $eTailorObjN['ostyle']==57 || $eTailorObjN['ostyle']==58) && ($styllst->id==130)) {
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
				if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getjackstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylejacket\');">';
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
		$datastyle=$datastyle.'</div>';
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg">';
		$datastyle=$datastyle.'<div class="et-content-fab " id="miniview-etstylejacket-19"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['ostyleName'].'</h2><p>Classic,All Time,Business</p></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstylejacket-20" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['olapelName'].'</h2><p>Classic,All Time,Business</p>';
		if($eTailorObjN['olapel']!="62"){
			$datastyle=$datastyle.'<span>Button Hole on Lapel</span><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="false"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>No Button Hole</label></div><div class="radio"><label>';
			if($eTailorObjN['olapelHole']=="true"){$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" checked  onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';} else {$datastyle=$datastyle.'<input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelHole'].',\'LapelHole\',\'20\',\'etstylejacket\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>With Lapel Buttonhole</label></div>';
		}
		$datastyle=$datastyle.'</div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-bottom-bg" id="miniview-etstylejacket-21" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['obottomName'].'</h2></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-pocket-bg" id="miniview-etstylejacket-22" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opacketName'].'</h2><div class="checkbox"><label>';
		if($eTailorObjN['obreastPacket']=="false"){$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstylejacket\');">';} else{$datastyle=$datastyle.'<input type="checkbox" name="breastpackt" id="breastpackt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['obreastPacket'].',\'BreastPocket\',\'22\',\'etstylejacket\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>No Breast Pocket</label></div></div></div>';
		
		$datastyle=$datastyle.'<div class="et-content-fab" id="miniview-etstylejacket-23" style="display:none;"><figure class="et-sleevebuttonds"><img class="et-main-sleeve" src="'.$paths.'/Jacket/Fabric/ImageIn/'.$eTailorObjN['ofabric'].'.png">';
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
		
		$datastyle=$datastyle.'<div class="et-content-fab jacket-vent-bg" id="miniview-etstylejacket-24" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['oventName'].'</h2><p>Classic,All Time,Business</p></div>';
		$datastyle=$datastyle.'</div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigatejacketback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatejacketnext();">Next</a></li></ul></div></div>';
		
		/*Contrast*/
		$datacont=$datacont.'<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>Contrast Fabric</h2><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['olapelupper']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrastjacket\');">';} else{$datacont=$datacont.'<input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapelupper'].',\'LapelUpper\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Upper</label></div><div class="checkbox"><label>';
		if($eTailorObjN['olapellower']=="true"){$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrastjacket\');">';} else {$datacont=$datacont.'<input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['olapellower'].',\'LapelLower\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Lower</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocontpockets']=="true"){$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrastjacket\');">';} else {$datacont=$datacont.'<input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontpockets'].',\'Pockets\',\'25\',\'etcontrastjacket\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pockets</label></div>';
		if($eTailorObjN['obreastPacket']=="true"){
			$datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ocontchestpocket']=="true"){$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrastjacket\');">';}else {$datacont=$datacont.'<input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontchestpocket'].',\'ChestPocket\',\'25\',\'etcontrastjacket\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Chest Pocket</label></div>';
		}
		$datacont=$datacont.'<div class="checkbox"><label>';
		if($eTailorObjN['ocontelbowmix']=="true"){$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" checked onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrastjacket\');">';} else{$datacont=$datacont.'<input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" onClick="javascript:getjacketseloptions('.$eTailorObjN['ocontelbowmix'].',\'ElbowMix\',\'25\',\'etcontrastjacket\');">';}
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
	public function measurestdjacket(){
		$data="";
		if(isset($_POST['sizeid'])){
			$data='<select class="selectpicker btn-primary" id="sizefit" name="sizefit" onChange="javascript:changeJacketSizeDetails();">';
			$measureeurolst = BodyMeasurment::select('*')->where('cat_id','=',2)->where('country_id','=',$_POST['sizeid'])->get();
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
	public function measurestddetlsjacket(){
		$data="";
		if(isset($_POST['cntryid'])){
			$measurelst = BodyMeasurment::select('*')->where('cat_id','=',2)->where('country_id','=',$_POST['cntryid'])->where('id','=',$_POST['sizeid'])->get();
            foreach($measurelst as $measuresrec){
				$data=$measuresrec->chest."/".$measuresrec->waist."/".$measuresrec->hip."/".$measuresrec->shoulder."/".$measuresrec->sleeve."/".$measuresrec->length;
            }
		}
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
		
		$data=$data.'<figure><img src="'.$paths.'/Jacket/BackColler/'.$eTailorObjN['obackCollar'].'.png" style="position: absolute;top: 0px;left: 137px;"></figure><div class="et-style-select"><h2>Back Collar</h2></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}

	// =================================== for pants ===============================================
	public function getfabpantdetails(){
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
		
		// if($fabgrup_record->fabric_offer_price != 0 && $fabgrup_record->fabric_offer_price != '')
		// {
		// 	  $frate = $fabgrup_record->fabric_offer_price;
		// }else{
		// 		$frate =    $fabgrup_record->fabric_rate;
		// }
		$fb_group = Helpers::get_fabric_group_info(18);	
		$frate = 0;
		foreach($fb_group as $row){
			if($row->parent_id == $fabgrup_record->id){
				if($row->fabric_offer_price != 0 && $row->fabric_offer_price != '')
				{
					$frate = $row->fabric_offer_price;
				}else{
					$frate = $row->fabric_rate;
				}
				break;
			}
		}
		
		$eTailorObjN['ofabricGroup']=$fabgrup_record->fbgrp_name;
		$eTailorObjN['ofabricType']=$fabgrp;
		$eTailorObjN['ofabricPrice']=$frate;
		$eTailorObjN['ofabricName']=$fabric_record->fabric_name;
		$eTailorObjN['ofabricImage']=$fabric_record->fabric_img_l;
		$eTailorObjN['ofabricList']=$fabric_record->fabric_img_s;
		$eTailorObjN['ofabricDesc']=$fabric_record->fabric_desc;
		
		$data=$data.'<div class="et-content-fab"><figure class="et-fab-img"><img src="'.$paths.'/'.$fabric_record->fabric_img_l.'" alt="'.$eTailorObjN['ofabricName'].'"></figure><div class="et-fab-box"><h3>'.$eTailorObjN['ofabricDesc'].'</h3><span>'.$eTailorObjN['ofabricName'].'</span><span>Fit-Guaranteed Price<img src="'.$p[0].'/demo/img/product/info.png" alt="info"></span><h3><a href="#" data-toggle="modal" data-target="#fabric-id">Zoom</a></h3></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigatepantback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatepantnext();">Next</a></li></ul></div><div class="modal fade et-fabric-modal" id="fabric-id" tabindex="-1" role="dialog" aria-labelledby="fabric-modal"><div class="modal-dialog" role="document"><div class="modal-content"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><div class="modal-body"><figure class="et-fabric-big"><img src="'.$paths.'/'.$eTailorObjN['ofabricImage'].'" alt="'.$eTailorObjN['ofabricName'].'"></figure></div></div></div></div>';
		/* STYLE */
		$datastyle=$datastyle.'<div class="carousel-container">';
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 4)->where('parent_id', '=', 45)->get();
		foreach($mainattr_record as $mattr){
			$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
			if($mattr->id=="50"){
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get(); 
			foreach($stylelst as $styllst){
				if($stylci==7){$datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">';  $stylci=1;}
				if(($styllst->id==112 || $styllst->id==113) && $eTailorObjN['opleat']==102){
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getpantstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylepant\');">';
				   
				   $styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				   foreach($styleimglst as $ls){
					   $datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'"></figure>';
					   if($mattr->id==50){ if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';} }
				   }
				   $datastyle=$datastyle.'</li>'; 
				} elseif($styllst->id==108 || $styllst->id==109 || $styllst->id==110 || $styllst->id==111){
				   $datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getpantstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylepant\');">';
				   
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
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getpantstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstylepant\');">';
					
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
        $datastyle=$datastyle.'</div>';
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg">';
		$datastyle=$datastyle.'<div class="et-content-fab " id="miniview-etstylepant-48"><figure class="et-selected-img et-selected-full"><img src="" alt=""></figure><div class="et-style-select"><h2>'.$eTailorObjN['ostyleName'].'</h2><p>Classic,All Time,Business</p></div></div>';
	    $datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstylepant-49" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opleatName'].'</h2><p>Classic,All Time,Business</p></div></div>';
        $datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstylepant-50" style="display:none;"><div class="et-style-select"><h2>'.$eTailorObjN['opacketName'].'</h2><p>Classic,All Time,Business</p></div></div>';
        $datastyle=$datastyle.'<div class="et-content-fab jacket-pocket-bg" id="miniview-etstylepant-51" style="display:none;"><div class="et-style-select"><h2>Back Pockets</h2><p>'.$eTailorObjN['obackpocktName'].'</p><div class="radio"><label>';
		if($eTailorObjN['obackpocktSide']=="left"){ $datastyle=$datastyle.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" checked onClick="javascript:getpantseloptions(\'left\',\'PocketSide\',\'51\',\'etstylepant\');">';}else {$datastyle=$datastyle.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" onClick="javascript:getpantseloptions(\'left\',\'PocketSide\',\'51\',\'etstylepant\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span> Left </label></div><div class="radio"><label>';
		if($eTailorObjN['obackpocktSide']=="right"){ $datastyle=$datastyle.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" checked onClick="javascript:getpantseloptions(\'right\',\'PocketSide\',\'51\',\'etstylepant\');">';} else {$datastyle=$datastyle.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" onClick="javascript:getpantseloptions(\'right\',\'PocketSide\',\'51\',\'etstylepant\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span> Right </label></div><div class="radio"><label>';
		if($eTailorObjN['obackpocktSide']=="both"){ $datastyle=$datastyle.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" checked onClick="javascript:getpantseloptions(\'both\',\'PocketSide\',\'51\',\'etstylepant\');">';} else {$datastyle=$datastyle.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" onClick="javascript:getpantseloptions(\'both\',\'PocketSide\',\'51\',\'etstylepant\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span> Both</label></div></div></div>';
        $datastyle=$datastyle.'<div class="et-content-fab jacket-lapel-bg" id="miniview-etstylepant-52" style="display:none;"><div class="et-style-select"><h2>Belt Loop and Waistband</h2><p>'.$eTailorObjN['obeltloopName'].'</p><span>Waistband Edge</span><div class="radio"><label>';
		if($eTailorObjN['owaistbandedge']=="normal"){ $datastyle=$datastyle.'<input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" checked onClick="javascript:getpantseloptions(\'normal\',\'WaistEdge\',\'52\',\'etstylepant\');">';} else {$datastyle=$datastyle.'<input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" onClick="javascript:getpantseloptions(\'normal\',\'WaistEdge\',\'52\',\'etstylepant\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>Normal</label></div><div class="radio"><label>';
		if($eTailorObjN['owaistbandedge']=="round"){ $datastyle=$datastyle.'<input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" checked onClick="javascript:getpantseloptions(\'round\',\'WaistEdge\',\'52\',\'etstylepant\');">';} else{ $datastyle=$datastyle.'<input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" onClick="javascript:getpantseloptions(\'round\',\'WaistEdge\',\'52\',\'etstylepant\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>Round</label></div><div class="radio"><label>';
		if($eTailorObjN['owaistbandedge']=="square"){ $datastyle=$datastyle.'<input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" checked onClick="javascript:getpantseloptions(\'square\',\'WaistEdge\',\'52\',\'etstylepant\');">';} else {$datastyle=$datastyle.'<input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" onClick="javascript:getpantseloptions(\'square\',\'WaistEdge\',\'52\',\'etstylepant\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon"></i></span>Square</label></div></div></div>';
        $datastyle=$datastyle.'<div class="et-content-fab pant-style" id="miniview-etstylepant-53" style="display:none;"><figure class="et-selected-img et-selected-full">';
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
		 $datastyle=$datastyle.'</div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigatepantback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatepantnext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $fabgrp,'4' => $eTailorObjN,'5' => $datastyle];
		return $data;
	}
	
	public function getstylepantdetails(){
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
				if($eTailorObjN['obackpocktSide']=="left"){ $data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" checked onClick="javascript:getpantseloptions(\'left\',\'PocketSide\',\'51\',\'etstylepant\');">';}else {$data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" onClick="javascript:getpantseloptions(\'left\',\'PocketSide\',\'51\',\'etstylepant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span> Left </label></div><div class="radio"><label>';
				if($eTailorObjN['obackpocktSide']=="right"){ $data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" checked onClick="javascript:getpantseloptions(\'right\',\'PocketSide\',\'51\',\'etstylepant\');">';} else {$data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" onClick="javascript:getpantseloptions(\'right\',\'PocketSide\',\'51\',\'etstylepant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span> Right </label></div><div class="radio"><label>';
				if($eTailorObjN['obackpocktSide']=="both"){ $data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" checked onClick="javascript:getpantseloptions(\'both\',\'PocketSide\',\'51\',\'etstylepant\');">';} else {$data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" onClick="javascript:getpantseloptions(\'both\',\'PocketSide\',\'51\',\'etstylepant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span> Both</label></div></div>';
				break;
			case '52':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['obeltloop']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obeltloopName']=$style_record->style_name;
				
				$data=$data.'<div class="et-style-select"><h2>Belt Loop and Waistband</h2><p>'.$eTailorObjN['obeltloopName'].'</p><span>Waistband Edge</span><div class="radio"><label>';
				if($eTailorObjN['owaistbandedge']=="normal"){ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" checked onClick="javascript:getpantseloptions(\'normal\',\'WaistEdge\',\'52\',\'etstylepant\');">';} else {$data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" onClick="javascript:getpantseloptions(\'normal\',\'WaistEdge\',\'52\',\'etstylepant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span>Normal</label></div><div class="radio"><label>';
				if($eTailorObjN['owaistbandedge']=="round"){ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" checked onClick="javascript:getpantseloptions(\'round\',\'WaistEdge\',\'52\',\'etstylepant\');">';} else{ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" onClick="javascript:getpantseloptions(\'round\',\'WaistEdge\',\'52\',\'etstylepant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span>Round</label></div><div class="radio"><label>';
				if($eTailorObjN['owaistbandedge']=="square"){ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" checked onClick="javascript:getpantseloptions(\'square\',\'WaistEdge\',\'52\',\'etstylepant\');">';} else {$data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" onClick="javascript:getpantseloptions(\'square\',\'WaistEdge\',\'52\',\'etstylepant\');">';}
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
					$datastyle=$datastyle.'<li class="et-item" id="optionlist-50-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getpantstyles('.$styllst->id.',\'50\',\'etstylepant\');">';
				   
				   $styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				   foreach($styleimglst as $ls){
					   $datastyle=$datastyle.'<figure class="et-item-img"><img class="et-main-list-img" src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'"></figure>';
					   if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
				   }
				   $datastyle=$datastyle.'</li>'; 
				} elseif($styllst->id==108 || $styllst->id==109 || $styllst->id==110 || $styllst->id==111){
				   $datastyle=$datastyle.'<li class="et-item" id="optionlist-50-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getpantstyles('.$styllst->id.',\'50\',\'etstylepant\');">';
				   
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

	public function getsetoptionpantdetails(){
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
				if($eTailorObjN['obackpocktSide']=="left"){ $data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" checked onClick="javascript:getpantseloptions(\'left\',\'PocketSide\',\'51\',\'etstylepant\');">';}else {$data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" onClick="javascript:getpantseloptions(\'left\',\'PocketSide\',\'51\',\'etstylepant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span> Left </label></div><div class="radio"><label>';
				if($eTailorObjN['obackpocktSide']=="right"){ $data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" checked onClick="javascript:getpantseloptions(\'right\',\'PocketSide\',\'51\',\'etstylepant\');">';} else {$data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" onClick="javascript:getpantseloptions(\'right\',\'PocketSide\',\'51\',\'etstylepant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span> Right </label></div><div class="radio"><label>';
				if($eTailorObjN['obackpocktSide']=="both"){ $data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" checked onClick="javascript:getpantseloptions(\'both\',\'PocketSide\',\'51\',\'etstylepant\');">';} else {$data=$data.'<input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" onClick="javascript:getpantseloptions(\'both\',\'PocketSide\',\'51\',\'etstylepant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span> Both</label></div></div>';
				break;
			case "WaistEdge":
				$eTailorObjN['owaistbandedge']=$ff;
				
				$data=$data.'<div class="et-style-select"><h2>Belt Loop and Waistband</h2><p>'.$eTailorObjN['obeltloopName'].'</p><span>Waistband Edge</span><div class="radio"><label>';
				if($eTailorObjN['owaistbandedge']=="normal"){ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" checked onClick="javascript:getpantseloptions(\'normal\',\'WaistEdge\',\'52\',\'etstylepant\');">';} else {$data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" onClick="javascript:getpantseloptions(\'normal\',\'WaistEdge\',\'52\',\'etstylepant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span>Normal</label></div><div class="radio"><label>';
				if($eTailorObjN['owaistbandedge']=="round"){ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" checked onClick="javascript:getpantseloptions(\'round\',\'WaistEdge\',\'52\',\'etstylepant\');">';} else{ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" onClick="javascript:getpantseloptions(\'round\',\'WaistEdge\',\'52\',\'etstylepant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span>Round</label></div><div class="radio"><label>';
				if($eTailorObjN['owaistbandedge']=="square"){ $data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" checked onClick="javascript:getpantseloptions(\'square\',\'WaistEdge\',\'52\',\'etstylepant\');">';} else {$data=$data.'<input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" onClick="javascript:getpantseloptions(\'square\',\'WaistEdge\',\'52\',\'etstylepant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon"></i></span>Square</label></div></div>';
				break;
			case "BeltLoop":
				if($ff=="true"){ $eTailorObjN['ocontbeltloop']="false"; } else { $eTailorObjN['ocontbeltloop']="true"; }
				
				$data=$data.'<div class="et-style-select"><h2>Contrast Fabric</h2><div class="et-check-box"><div class="checkbox"><label>';
				if($eTailorObjN['ocontbeltloop']=="true"){$data=$data.'<input type="checkbox" name="beltlooptxt" id="beltlooptxt" value="true" checked onClick="javascript:getpantseloptions('.$eTailorObjN['ocontbeltloop'].',\'BeltLoop\',\'54\',\'etcontrastpant\');">';}else{$data=$data.'<input type="checkbox" name="beltlooptxt" id="beltlooptxt" value="true" onClick="javascript:getpantseloptions('.$eTailorObjN['ocontbeltloop'].',\'BeltLoop\',\'54\',\'etcontrastpant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Belt Loops</label></div><div class="checkbox"><label>';
				if($eTailorObjN['ocontbackpockets']=="true"){ $data=$data.'<input type="checkbox" name="backpocketstxt" id="backpocketstxt" value="true" checked onClick="javascript:getpantseloptions('.$eTailorObjN['ocontbackpockets'].',\'BackPockets\',\'54\',\'etcontrastpant\');">';} else{$data=$data.'<input type="checkbox" name="backpocketstxt" id="backpocketstxt" value="true" onClick="javascript:getpantseloptions('.$eTailorObjN['ocontbackpockets'].',\'BackPockets\',\'54\',\'etcontrastpant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Pockets</label></div></div></div>';
				break;
			case "BackPockets":
				if($ff=="true"){ $eTailorObjN['ocontbackpockets']="false"; } else { $eTailorObjN['ocontbackpockets']="true"; }
				
				$data=$data.'<div class="et-style-select"><h2>Contrast Fabric</h2><div class="et-check-box"><div class="checkbox"><label>';
				if($eTailorObjN['ocontbeltloop']=="true"){$data=$data.'<input type="checkbox" name="beltlooptxt" id="beltlooptxt" value="true" checked onClick="javascript:getpantseloptions('.$eTailorObjN['ocontbeltloop'].',\'BeltLoop\',\'54\',\'etcontrastpant\');">';}else{$data=$data.'<input type="checkbox" name="beltlooptxt" id="beltlooptxt" value="true" onClick="javascript:getpantseloptions('.$eTailorObjN['ocontbeltloop'].',\'BeltLoop\',\'54\',\'etcontrastpant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Belt Loops</label></div><div class="checkbox"><label>';
				if($eTailorObjN['ocontbackpockets']=="true"){ $data=$data.'<input type="checkbox" name="backpocketstxt" id="backpocketstxt" value="true" checked onClick="javascript:getpantseloptions('.$eTailorObjN['ocontbackpockets'].',\'BackPockets\',\'54\',\'etcontrastpant\');">';} else{$data=$data.'<input type="checkbox" name="backpocketstxt" id="backpocketstxt" value="true" onClick="javascript:getpantseloptions('.$eTailorObjN['ocontbackpockets'].',\'BackPockets\',\'54\',\'etcontrastpant\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Pockets</label></div></div></div>';
				break;
		}
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}
	
	public function measurestdpant(){
		$data="";
		if(isset($_POST['sizeid'])){
			$data='<select class="selectpicker btn-primary" id="sizefit" name="sizefit" onChange="javascript:changePantSizeDetails();">';
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
	
	public function measurestddetlspant(){
		$data="";
		if(isset($_POST['cntryid'])){
			$measurelst = BodyMeasurment::select('*')->where('cat_id','=',4)->where('country_id','=',$_POST['cntryid'])->where('id','=',$_POST['sizeid'])->get();
            foreach($measurelst as $measuresrec){
				$data=$measuresrec->waist."/".$measuresrec->hip."/".$measuresrec->crotch."/".$measuresrec->thigh."/".$measuresrec->length;
            }
		}
		return $data;
	}

	public function getPantBodyMeasurmentIdByJacket(){
		$measure_jacket = BodyMeasurment::select('*')->where('id','=',$_POST['sizeid'])->first();
		$measure_pant = BodyMeasurment::select('*')
			->where('cat_id','=',4)
			->where('country_id','=',$_POST['cntryid'])
			->where('standardsize_id','=',$measure_jacket->standardsize_id)
			->first();
		$data=$measure_pant->id;
		return $data;
	}

	public function getVestBodyMeasurmentIdByJacket(){
		$measure_jacket = BodyMeasurment::select('*')->where('id','=',$_POST['sizeid'])->first();
		$measure_vest = BodyMeasurment::select('*')
			->where('cat_id','=',3)
			->where('country_id','=',$_POST['cntryid'])
			->where('standardsize_id','=',$measure_jacket->standardsize_id)
			->first();
		$data=$measure_vest->id;
		return $data;
	}

	// ================================= for vests ==================================================
	public function getfabvestdetails(){
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
		
		// if($fabgrup_record->fabric_offer_price != 0 && $fabgrup_record->fabric_offer_price != '')
		// {
		// 	  $frate = $fabgrup_record->fabric_offer_price;
		// }else{
		// 		$frate =    $fabgrup_record->fabric_rate;
		// }
		$fb_group = Helpers::get_fabric_group_info(18);	
		$frate = 0;
		foreach($fb_group as $row){
			if($row->parent_id == $fabgrup_record->id){
				if($row->fabric_offer_price != 0 && $row->fabric_offer_price != '')
				{
					$frate = $row->fabric_offer_price;
				}else{
					$frate = $row->fabric_rate;
				}
				break;
			}
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

}
