<?php
namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Http\Request;
//use Request;
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



class VestsController extends Controller
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
    	if(isset($_POST['fabid'])){
			$eTailorObj= $this->varupdate($_POST['fabid'],$_POST['carr'],$_POST['typ']);
			$mytab=$_POST['t'];
			if($_POST['typ']=='fabric'){
				$mysubtab = "fabric".$eTailorObj['ofabricType'];
			} else {
				$mysubtab = $this->updatesubmenu($_POST['typ']);
			}
			$loadme="1";
		}else{
			$eTailorObj=[
				'oprodType'=>'Vests',
				'ocatID'=>'3',
				'ofabricGroup'=>'Fabric Of The Week',
				'ofabricType'=>'11',
				'ofabricPrice'=>'79',
				'ofabric'=>'70',
				'ofabricName'=>'Textured Light Grey',
				'ofabricImage'=>'Vests/Fabric/L/70.png',
				'ofabricList'=>'Vests/Fabric/S/70.png',
				'ofabricDesc'=>'High Quality Wool Blend',
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
			$mysubtab="fabric11";
			$loadme="0";
		}

		/* Fabric */
		$id=$eTailorObj['ocatID'];
		$car_record = Category::select('*')->where('id', '=', 3)->first($id);
		$cat_id = $car_record->id;
		$group_record = FabricGroup::select('*')->where('cat_id', '=', $cat_id)->get();
		//echo '<pre>'.print_r($group_record,true).'</pre>';
		
		/* Attribute Style */
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 32)->get();
		
		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 33)->get();
        return view('vests.vest')->with(compact('car_record','group_record','mainattr_record','contrast_record','eTailorObj','mytab','mysubtab','loadme'));
    }
    
    public function varupdate($ff, $carray, $ctype){
   		$eTailorObjN=$carray;
		switch($ctype){
			case 'fabric':
				$eTailorObjN['ofabric']=$ff;
				$fabric_record = Etfabric::select('*')->where('id', '=', $ff)->find($ff);
				$fabgrp=$fabric_record->fbgrp_id;
				
				$fabgrup_record = FabricGroup::select('*')->where('id', '=', $fabgrp)->find($fabgrp);
				
				$eTailorObjN['ofabricGroup']=$fabgrup_record->fbgrp_name;
				$eTailorObjN['ofabricType']=$fabgrp;
				$eTailorObjN['ofabricPrice']=$fabgrup_record->fabric_rate;
				$eTailorObjN['ofabricName']=$fabric_record->fabric_name;
				$eTailorObjN['ofabricImage']=$fabric_record->fabric_img_l;
				$eTailorObjN['ofabricList']=$fabric_record->fabric_img_s;
				$eTailorObjN['ofabricDesc']=$fabric_record->fabric_desc;
				return $eTailorObjN;
				break;
			case '35':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['ostyle']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['ostyleName']=$style_record->style_name;
				return $eTailorObjN;
				break;
			case '36':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['obuttonstyle']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obuttonstyleName']=$style_record->style_name;
				return $eTailorObjN;
				break;
			case '37':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['opacket']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['opacketName']=$style_record->style_name;
				return $eTailorObjN;
				break;
			case '38':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['obottom']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obottomName']=$style_record->style_name;
				return $eTailorObjN;
				break;
			case '39':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['oback']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obackName']=$style_record->style_name;
				return $eTailorObjN;
				break;
			case '40':
				$eTailorObjN['ocontrast']=$ff;
				$style_record = Contrast::select('*')->where('id', '=', $ff)->find($ff);
				$eTailorObjN['ocontrastName']=$style_record->contrsfab_name;
				return $eTailorObjN;
				break;
			case '41':
				$eTailorObjN['olining']=$ff;
				$style_record = JvLiningFabric::select('*')->where('id', '=', $ff)->find($ff);
				$eTailorObjN['oliningName']=$style_record->fabric_name;
				return $eTailorObjN;
				break;
			case 'Piping':
				$eTailorObjN['opiping']=$ff;
				$style_record = Piping::select('*')->where('id', '=', $ff)->find($ff);
				$eTailorObjN['opipingName']=$style_record->name;
				return $eTailorObjN;
				break;
			case '42':
				$eTailorObjN['obutton']=$ff;
				$style_record = Button::select('*')->where('id', '=', $ff)->find($ff);
				$eTailorObjN['obuttonName']=$style_record->button_name;
				$eTailorObjN['obuttonCode']=$style_record->button_code;
				return $eTailorObjN;
				break;
			case 'Threads':
				$eTailorObjN['obuttonHole']=$ff;
				$style_record = Thread::select('*')->where('id', '=', $ff)->find($ff);
				$eTailorObjN['obuttonHoleName']=$style_record->thrd_name;
				$eTailorObjN['obuttonHoleCode']=$style_record->thread_code;
				return $eTailorObjN;
				break;
			case 'Pockets':
				if($ff=="true"){
					$eTailorObjN['ocontpockets']="false";
				} else {
					$eTailorObjN['ocontpockets']="true";
				}
				return $eTailorObjN;
				break;
			case 'Lapel':
				if($ff=="true"){
					$eTailorObjN['ocontlapel']="false";
				} else {
					$eTailorObjN['ocontlapel']="true";
				}
				return $eTailorObjN;
				break;
			default:
				return $eTailorObj;
				break;
		}
   	}

   	public function updatesubmenu($type){
		switch($type){
		   case "Piping":
		   		$mysubtab="41";
				return $mysubtab;
				break;
		   case "Pockets":
		   case "Lapel": 
				$mysubtab="40";
				return $mysubtab;
				break;
			case "Threads":
				$mysubtab="42";
				return $mysubtab;
				break;
			default:
				$mysubtab=$_POST['typ'];
				return $mysubtab;
				break;
		}
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
			$measurelst = BodyMeasurment::select('*')->where('cat_id','=',3)->where('country_id','=',$_POST['cntryid'])->where('id','=',$_POST['sizeid'])->orderBy('standardsize_id', 'asc')->get();
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
		   if($request['mpattern']=="Body"){
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
