<?php
namespace App\Http\Controllers;
use DB;
use Session;
use View;
use Illuminate\Support\Facades\Route;
use Validator;
use Request;
use Redirect;
use App\Mail\Reminder;
use Illuminate\Support\Collection;
use App\Cart;
use App\CartCoupon;
use Auth;
use App\CamaignPromoCode;
use App\Http\helpers;
use App\ShippingRate;
use App\Order;
use App\Socialicon;
use App\ShippingsAddr;
use App\Category;
use App\TaxRate;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $successfully;
    public function __construct()
    {
        //$this->middleware('auth');
		if(Session::has('carts')) {
			$cartsess=Session::get('carts');						
		}else{
			$carts=md5(microtime().rand());
			$cartsess=Session::put('carts', $carts);
		}	
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /*Welcome blade call*/
	 public function index()
    {
		
		
	}
	
	

    public function cart()
    {
	 			
				if (Auth::check())
				{
					
					
					$cartsess=Session::get('carts');		
					$userid=Auth::user()->id;
		
						DB::table('carts')->where('user_id', $userid)->update(['cart_sessionid' => $cartsess]);
				}
			
			
			
			$cartsess=Session::get('carts');			
			
			$cartcount = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->count();
		if($cartcount>0){
				$cartdata = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->get();
			
			// print_r($data);			
			//$data = new ButtonStyleImage;			 
			// $data = $data->save();
			
			//Session('cart', $carts);
			//session::forget('carts');
			//session::flush();
			//Session::flush();
			//$datas = Session::all();
			
					
        	return view::make('cart.cart')->with('cartdata',$cartdata);
		}else{
			 return view::make('errors/404');
		}
         
    }
    /*Common Page Call*/
   public function detailcart($id='')
    {        
			if($id!=''){
			
				if (Session::has('carts')) {				
					$cartsess=Session::get('carts');				
					$count = Cart::select('*')->where('id', '=',  $id)->where('cart_sessionid', '=',  $cartsess)->count();
					$catdata = Cart::select('*')->where('id', '=',  $id)->where('cart_sessionid', '=',  $cartsess)->first();
					
					if($count!=0){
						$cartdata = Cart::select('*')->where('id', '=',  $id)->where('cart_sessionid', '=',  $cartsess)->get();
					}else{
						return view::make('errors/404');
					}
					
										
				}else{
					$cartdata=0;
					return view::make('errors/404');
				}   
			}else{
				$cartdata=0;
				return view::make('errors/404');
				
			}
			
			
			     
       	if($catdata->product_type==0){
			if($catdata->cat_id==1){
			 	return view('cart.detail')->with('cartdata',$cartdata);
			}else if($catdata->cat_id==2){
			 	return view('cart.jacketdetail')->with('cartdata',$cartdata);
			}else if($catdata->cat_id==3){
			 	return view('cart.vestsdetails')->with('cartdata',$cartdata);
			}else if($catdata->cat_id==4){
			 	return view('cart.paintdetails')->with('cartdata',$cartdata);
			}else if($catdata->cat_id==18){
			 	return view('cart.threepiecedetails')->with('cartdata',$cartdata);
			}else if($catdata->cat_id==19){
			 	return view('cart.twopiecedetails')->with('cartdata',$cartdata);
			}
	   }else{
		   return view('cart.productdetails')->with('cartdata',$cartdata);
	   }
		
    }
	
	
	public function cartitems()
    {
		
		
		
		if (Auth::check())
		{
			
			
			$cartsess=Session::get('carts');		
			$userid=Auth::user()->id;
			
			$count = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->count();
			
			
			
			if($count>0){				
				
								
				//update existing user data with new session
				DB::table('carts')
				->where('user_id', $userid)
				->update(['cart_sessionid' => $cartsess]);
				
				$shipid = Cart::select('ship_id')->where('cart_sessionid', '=',  $cartsess)->first();
				
				if($shipid->ship_id==''){
					return Redirect::to('/cartchk');
				}else{
					
					$shicoutryid = ShippingsAddr::select('scountry_id')->where('id', '=',  $shipid->ship_id)->first();
					
				}
				
				$countryid=$shicoutryid->scountry_id;
				
				//cartchk
				
				//exit();
				
				$promocount = ShippingRate::select('id')->where('country_id', '=',  $countryid)->count();
				if($promocount>0){
					
										
						$cartdata = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->get();	
							
						$cartid = Category::select('*')->get();		
							
							foreach($cartdata as $cartd){
								
								$pcatid=Helpers::get_parent($cartid,$cartd->cat_id);
								
								$shipamt=Helpers::shippingamt($countryid,$pcatid);
								
								$dataamt=[
								'user_id'=>$userid,
								'shipping'=>$shipamt							
								];
						
								DB::table('carts')
								->where('id', $cartd->id)
								->update($dataamt);
								
							}
					
				}else{
					DB::table('carts')
					->where('cart_sessionid', $cartsess)
					->update(['user_id' => $userid]);
				}
				
				$taxdata = TaxRate::select('*')->where('id', '=',  1)->first();
				
				if($taxdata->tax_status==1){
					$tax=$taxdata->tax_rates;
				}else{
					$tax=0;
				}
								
					
												
				$cartdata = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->get();
				  return view('cart/cartitem')->with(compact('cartdata','tax'));
			  
			 }else{
				return Redirect::to('/home');
			 } 
			  
		}else{
			return view::make('errors/404');
		}		  
		
	}
	
	public function cartchk()
    {
		if (Session::has('carts')) {
					
		$cartsess=Session::get('carts');
		$count = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->count();
		if($count>0){
			
			if (Auth::check())
			{
				return Redirect::to('/shipping-address');
				
			}else{
				return Redirect::to('/login');				
			}
			
			
		}else{
			return Redirect::to('/home');
		}
		
		
		
		}else{
			return Redirect::to('/home');
		}
	}

	public function del_cart_item($id)
    {
		$data   = new Cart;
		$data = Cart::find($id);
		$da = Cart::select('cart_sessionid','canvas_front_img','canvas_back_img','product_type')->where('id' ,'=' , $id)->first();
		if($da->product_type==0){
			//$deletefront=Helpers::imggdelete($da->canvas_front_img);
			//$deleteback=Helpers::imggdelete($da->canvas_back_img);
		}
		$data = Cart::destroy($id);	
		$data = Cart::select('id')->where('cart_sessionid' ,'=' , $da->cart_sessionid)->sum('price');
		$data1 = Cart::select('id')->where('cart_sessionid' ,'=' , $da->cart_sessionid)->count();
		return response()->json(array('sum'=> number_format(round($data,2),2),'coun' => $data1), 200);
    }
	
	 public function del_cartitem($id)
    {
        $cartsess=Session::get('carts');
		
		 $data   = new Cart;
		 $data = Cart::find($id);
		 $da = Cart::select('cart_sessionid','canvas_front_img','canvas_back_img','product_type')->where('id' ,'=' , $id)->first();
		 if($da->product_type==0){
			 //$deletefront=Helpers::imggdelete($da->canvas_front_img);
			 //$deleteback=Helpers::imggdelete($da->canvas_back_img);
		 }
		 $data = Cart::destroy($id);
		 $cucou = CartCoupon::select('id')->where('cart_sessionid' ,'=' , $cartsess)->count();
		 if($cucou>0){
		 $cu = CartCoupon::select('id')->where('cart_sessionid' ,'=' , $da->cart_sessionid)->first();
		 $data = CartCoupon::destroy($cu->id);
		 }
		 $data = Cart::select('id')->where('cart_sessionid' ,'=' , $da->cart_sessionid)->sum('price');
		 $d2 = Cart::select('id')->where('cart_sessionid' ,'=' , $da->cart_sessionid)->sum('shipping');
		 $d1 = Cart::select('id')->where('cart_sessionid' ,'=' , $da->cart_sessionid)->count();
		 
		 $taxdata = TaxRate::select('*')->where('id', '=',  1)->first();
				
		if($taxdata->tax_status==1){
			$taxrate=$taxdata->tax_rates;
			$tax=round(($data*$taxrate)/100,2);
			
		}else{
			$tax=0;
		}
		
		
		return response()->json(array('sum'=> number_format(round($data,2),2),'coun' => $d1 ,'shipping' => number_format(round($d2,2),2),'tax' => number_format(round($tax,2),2)), 200);
    }

    public function check_coupan($couponCode)
    {
    	$short = '';
    	$term = '';

    	$userid=Auth::user()->id;
		$cartsess=Session::get('carts');
		$producttotal=Helpers::producttotal($cartsess);
		
		
		$currentdate=date('Y-m-d');
		$count = CamaignPromoCode::select('id')->where('promo_code', '=',  $couponCode)->where('start_date', '<=',  $currentdate)->where('end_date', '>=',  $currentdate)->count();
		
		$userordercoupon = Order::select('id')->where('user_id', '=',  $userid)->where('coupon_code', '=',  $couponCode)->count();
		
		if($count>0 && $userordercoupon==0){
			$procode = CamaignPromoCode::select('*')->where('promo_code', '=',  $couponCode)->first();	
					
			$ordpromocount = Order::select('id')->where('coupon_code', '=',  $couponCode)->count();
			
			$catcarttotal=Helpers::catcarttotal($procode->cat_id,$cartsess);
			
			$maxamt=Helpers::maxamt($couponCode);
			$ordusercount=Helpers::ordusercount($userid);
			
			
			$shipaddid=Helpers::chkcartinfo('carts',$cartsess,'ship_id');
					
			$regionchk=Helpers::regionchk($procode->region,$shipaddid);
			$citychk=Helpers::citychk($procode->city,$shipaddid);
			$statechk=Helpers::statechk($procode->state,$shipaddid);
			$countrychk=Helpers::countrychk($procode->country,$shipaddid);
			
			$specificday = CamaignPromoCode::select('id')->where('promo_code', '=',  $couponCode)->where('specific_day', '=',  $currentdate)->count();
			
				
			if($procode->validity_condition == 1 && $procode->code_count > $ordpromocount){				
					
					if($procode->benefit_type=='A'){
						
						$data = $procode->benefit_amt;
						$err = 200;					
					}else{					
						
						$data = round($producttotal*($procode->benefit_amt/100),2);
						$err = 200;						
					}					
				
				
			}elseif($procode->validity_condition == 2 && $procode->code_count==$catcarttotal){				
								
				if($procode->benefit_type=='A'){
						
						$data = $procode->benefit_amt;
						$err = 200;
					
				}else{					
						
						$data = round($producttotal*($procode->benefit_amt/100),2);
						$err = 200;						
				}
				
			}elseif($procode->validity_condition == 3 && $procode->max_amount <= $producttotal){
				
				if($procode->benefit_type=='A'){
						
						$data = $procode->benefit_amt;
						$err = 200;
					
				}else{					
						
						$data = round($producttotal*($procode->benefit_amt/100),2);
						$err = 200;						
				}
				
				
				
			}elseif($procode->validity_condition == 4 && $ordusercount < 1){
				
				if($procode->benefit_type=='A'){
						
						$data = $procode->benefit_amt;
						$err = 200;
					
				}else{					
						
						$data = round($producttotal*($procode->benefit_amt/100),2);
						$err = 200;						
				}
				
				
			}elseif($procode->validity_condition == 5){
				
				
				if($regionchk!=0){
					
					if($procode->benefit_type=='A'){
						
						$data = $procode->benefit_amt;
						$err = 200;
					
					}else{					
						
						$data = round($producttotal*($procode->benefit_amt/100),2);
						$err = 200;						
					}
					
					
				}elseif($citychk!=0){
					if($procode->benefit_type=='A'){
						
						$data = $procode->benefit_amt;
						$err = 200;
					
					}else{					
						
						$data = round($producttotal*($procode->benefit_amt/100),2);
						$err = 200;						
					}					
				}elseif($statechk!=0){
					if($procode->benefit_type=='A'){
						
						$data = $procode->benefit_amt;
						$err = 200;
					
					}else{					
						
						$data = round($producttotal*($procode->benefit_amt/100),2);
						$err = 200;						
					}
										
				}elseif($countrychk!=0){
					if($procode->benefit_type=='A'){
						
						$data = $procode->benefit_amt;
						$err = 200;
					
					}else{					
						
						$data = round($producttotal*($procode->benefit_amt/100),2);
						$err = 200;						
					}
										
				}else{
					$data = 0;
					$err = 500;
				}			
				
			}elseif($procode->validity_condition == 6 && $specificday>0){	
			
					if($procode->benefit_type=='A'){
						
						$data = $procode->benefit_amt;
						$err = 200;
					
					}else{					
						
						$data = round($producttotal*($procode->benefit_amt/100),2);
						$err = 200;						
					}
			
			}else{
				$data = 0;
				$err = 500;
			}
			
		}else{
			$data = 0;
			$err = 500;			
		}	
		
		if($err==200){
			
			
			$sescount = CartCoupon::select('id')->where('cart_sessionid', '=',  $cartsess)->count();
			
			if($sescount==0){
			
			  $datap = new CartCoupon;			 
			  $datap->cart_sessionid = $cartsess;
			  $datap->coupon_code = $couponCode;
			  $datap->coupon_amt = $data;
			  $datap = $datap->save();
			
			}else{
				$sesid = CartCoupon::select('id')->where('cart_sessionid', '=',  $cartsess)->first();
				$iidd=$sesid->id;
				
				$datap = CartCoupon::findOrFail($iidd);
			   $datap->coupon_code = $couponCode;
			   $datap->coupon_amt = $data;
			   $datap = $datap->save();
				
			}
               $procode->id;
                $newterm = CamaignPromoCode::select('*')->where('id','=',$procode->id)->first();
                 $short = $newterm['promo_description'];  
                 $term = $newterm['id'];  
              
		}else{
			
			$sescount = CartCoupon::select('id')->where('cart_sessionid', '=',  $cartsess)->count();
			if($sescount>0){
				$sesid = CartCoupon::select('id')->where('cart_sessionid', '=',  $cartsess)->first();
				$iidd=$sesid->id;
				$short = '';
				$term = '';
				$datap = CartCoupon::destroy($iidd);
			}			
			
		}
			
		 $taxdata = TaxRate::select('*')->where('id', '=',  1)->first();
		if($taxdata->tax_status==1){
			$taxrate=$taxdata->tax_rates;
			$tax=round(($producttotal*$taxrate)/100,2);
			
		}else{
			$tax=0;
		}
		
		
		
      return response()->json(array('sum'=> $data,'suc'=> 'Valid Coupon','short' => $short,'term' => $term,'tax' => $tax), $err); 
    }

    public function get_term_and_polices($id = null)
    {
    	if($id != '')
    	{
    		  $countcode =CamaignPromoCode::select('id')->where('id','=',$id)->count();

    		
    		if($countcode == 0)
    		{ 
               return view::make('errors/404');     
    		}else{
    			$cartsess = Session::get('carts');
    			$p =CamaignPromoCode::select('promo_code')->where('id','=',$id)->first();
    			$p->promo_code;
    	$coupansession =  CartCoupon::select('cart_sessionid')->where('coupon_code','=',$p->promo_code)->where('cart_sessionid','=',$cartsess)->first();
                          
    			if($coupansession->cart_sessionid == $cartsess)
    			{
    				$soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
    				$term =CamaignPromoCode::select('coupan_term')->where('id','=',$id)->first();
    				return view('cart.term-and-condition')->with(compact('term','soc'));
    			}else
    			{return view::make('errors/404'); }


    		}
    	}
    	else
    	{
          return view::make('errors/404'); 
    	}
    	//echo $id;
    }
	
		function dataurlimg(){
		echo $catid=$_POST['catid'];
		$dataurl=$_POST['ul'];
		$imgid=$_POST['imgid'];
		
		if($imgid==1){		
			$frontimg=Helpers::dataurltoimg($dataurl,$catid,'front');				 
			
			$cartimgSet = [					
				'canvas_front_img' => $frontimg,							 
			];
			DB::table('carts')->where('id', $catid)->update($cartimgSet); 
		}else{
			$backimg=Helpers::dataurltoimg($dataurl,$catid,'back');					 
			
			$cartimgSet = [	
				'canvas_back_img' => $backimg,				 
			];
			DB::table('carts')->where('id', $catid)->update($cartimgSet); 

		}
	}
}