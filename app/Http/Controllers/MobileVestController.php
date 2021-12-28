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


class MobileVestController extends Controller
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
    		if($device!='MOBILE'){
    			return redirect(route('designvests'));
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
        return view('vests.mobilevest')->with(compact('car_record','group_record','mainattr_record','contrast_record','eTailorObj','mytab','mysubtab','loadme'));
    }

	public function get_item(Request $request) {
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
