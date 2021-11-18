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
use App\EcollectionProduct;
use Voyager;
use PDF;
use App\TaxRate;




class PayeezyGatewayController extends Controller
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

   

	 public function index()
    {	

	}	

     public function paywithpayeezy()
    {
        
		$cartsess=Session::get('carts');
		
		$useremail=Auth::user()->email;
		
		$cartdata = Cart::select('*')->where('cart_sessionid' ,'=' , $cartsess)->get();
		
		$pi=1;
		$total=0;
		$shiptotal=0;
		foreach($cartdata as $key => $cartdetail){
		
		$oprodType = Cart::cartdescnfo($cartdetail->id,'oprodType');
		$pricee=$cartdetail->price;
		$shipping=$cartdetail->shipping;
		if($shipping!='' || $shipping!=0){
			$shiptotal=$shiptotal+$shipping;
		}else{
			$shiptotal=$shiptotal;
		}
		$total=$total+$pricee;
				
		
		
		$proname[]=$oprodType;
		$proprice[]=round($pricee,2);				
					
				
		$pi++;	
				
	}
	//print_r($proname);
	//print_r($pprice);
	//exit();
	
	$subtotal=$total+$shiptotal;
	
	
	$coucount = CartCoupon::select('*')->where('cart_sessionid' ,'=' , $cartsess)->count();
		if($coucount>0){
			$coucode = CartCoupon::select('*')->where('cart_sessionid' ,'=' , $cartsess)->first();
			$couamt=round($coucode->coupon_amt,2);
			
		}else{
			$couamt=0;
		}
		
		$couptotal=$subtotal-$couamt;
		
		$taxdata = TaxRate::select('*')->where('id', '=', 1)->first();
		
		
		if($taxdata->tax_status==1){
			$taxrate=$taxdata->tax_rates;
			$tax=round(($total*$taxrate)/100,2);
		    $grtotal=$couptotal+$tax;
		}else{		
			$tax=0;
			 $grtotal=$couptotal;
		}
	
		//return view('paywithpayeezy');
		return view('paywithpayeezy')->with(compact('proname','proprice','shiptotal','couamt','tax','grtotal','useremail')); 
    }

   



}