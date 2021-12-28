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

class MobilePantController extends Controller
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
			return redirect(route('designpants'));
		}

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
        return view('pants.mobilepants')->with(compact('car_record','group_record','mainattr_record','contrast_record','eTailorObj','mytab','mysubtab','loadme'));
    }

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
				'created_at' => date('y-m-d H:i:s'),
				'updated_at' => date('y-m-d H:i:s'),
			];
			$canvasids = DB::table('canvas_dataurls')->insert($canvasSet);
			$canvasSet2 = [				
				'canvas_back_img' => $request['bkviewfinal'],
				'updated_at' => date('y-m-d H:i:s'),
			];
			$canvasids = DB::table('canvas_dataurls')->where('cart_id', $cartId)->update($canvasSet2);	
			
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
				'updated_at' => date('y-m-d H:i:s'),
			];
			$canvasids = DB::table('canvas_dataurls')->where('cart_id', $cartId)->update($canvasSet);
			$canvasSet2 = [				
				'canvas_back_img' => $request['bkviewfinal'],
				'updated_at' => date('y-m-d H:i:s'),
			];
			$canvasids = DB::table('canvas_dataurls')->where('cart_id', $cartId)->update($canvasSet2);
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
