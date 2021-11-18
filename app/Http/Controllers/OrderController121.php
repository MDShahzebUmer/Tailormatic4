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
use App\ShippingsAddr;
use Mail;
use App\Mail\Invoice;
use App\OrderItem;
use App\Socialicon;

class OrderController extends Controller
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
	
    public function order()
    {
	  	
			 if (Auth::check())
			{
				$userid=Auth::user()->id;				
			}else{
				$userid=Null;
			}
			
			$cartsess=Session::get('carts');
						
			$cartdata = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->first();
			
			
			$prototal = Cart::select('id')->where('cart_sessionid' ,'=' , $cartsess)->sum('price');
			$qtytotal = Cart::select('id')->where('cart_sessionid' ,'=' , $cartsess)->sum('qty');
			$shiptotal = Cart::select('id')->where('cart_sessionid' ,'=' , $cartsess)->sum('shipping');	
			
			$cartcoupon = CartCoupon::select('*')->where('cart_sessionid' ,'=' , $cartsess)->count();
			if($cartcoupon>0){
				$coucodee = CartCoupon::select('*')->where('cart_sessionid' ,'=' , $cartsess)->first();
				$coucode=$coucodee->coupon_code;
				$couamt=$coucodee->coupon_amt;
			}else{
				$coucode='';
				$couamt=0;
			}
								
			
			
			$alltotal=$prototal+$shiptotal-$couamt;
			
			$transactionId=uniqid();
			
			$orderSet = [
		  'tracking_code' => $transactionId,
		  'user_id' =>  $userid,
		  'ship_id' =>  $cartdata->ship_id,
		  'od_amount' =>  $prototal,
		  'no_item' =>  $qtytotal,
		  'shipping_amt' =>  $shiptotal,
		  'coupon_code' =>  $coucode,
		  'coupon_amt' =>  $couamt,
		  'od_total' =>  $alltotal,
		  'created_at' => date('y-m-d H:i:s'),
		  'updated_at' => date('y-m-d H:i:s'),
		  ];
	
		  $idss = DB::table('orders')->insert($orderSet);
		  $idss = DB::getPdo()->lastInsertId();
		  
			
			$allcartdata = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->get();
			
			foreach($allcartdata as $cartdetail){
				
			$cartSet = [
				'order_id' => $idss,
				'user_id' => $userid,
				'cat_id' => $cartdetail->cat_id,
				'product_id' => $cartdetail->product_id,
				'group_id' => $cartdetail->group_id,
				'fabric_id' => $cartdetail->fabric_id,
				'fabric_name' => $cartdetail->fabric_name,
				'fabric_image' => $cartdetail->fabric_image,
				'canvas_front_img' => $cartdetail->canvas_front_img,
				'canvas_back_img' => $cartdetail->canvas_back_img,
				'item_description' => $cartdetail->item_description,
				'price' => $cartdetail->price,
				'shipping' => $cartdetail->shipping,			
				'qty' => $cartdetail->qty,	
				'total' => $cartdetail->total,
				 'created_at' => date('y-m-d H:i:s'),
				'updated_at' => date('y-m-d H:i:s'),
				];
				
				 $ids = DB::table('order_items')->insert($cartSet);		
				
			}
			$deletecartdata = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->delete();
			
			$deleteCoupon = CartCoupon::select('*')->where('cart_sessionid', '=',  $cartsess)->delete();
			
					
			session::forget('carts');
			
			$orderdata = Order::select('*')->where('id', '=',  $idss)->get();			
			$invoicedata = OrderItem::select('*')->where('order_id', '=',  $idss)->get();
			
			
			$useremail=Auth::user()->email;
			
			$to_email = $useremail;
                        Mail::to($to_email)
			->cc(array('fudugotest@gmail.com'))
			->send(new Invoice($orderdata,$invoicedata));
			//Mail::to($to_email)->send(new Invoice($orderdata,$invoicedata));
			//Session::flash('message','E-mail has been sent Successfully');
							
        	//return Redirect::to('/thankyou')->with($transactionId);
			$id = Auth::user()->id;
            $soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
			return view::make('thank-you')->with(compact('soc','transactionId'));
    }
	
	
	public function thankyou($orderid){
		
			$id = Auth::user()->id;
            $soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
		
			 return view('thankyou')->with(compact('id','soc','orderid')); 
	}
   

}