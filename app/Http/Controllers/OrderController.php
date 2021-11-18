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
// use PDF;
use App\TaxRate;




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

          if(Session::has('carts')) {               
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
			
			$taxdata = TaxRate::select('*')->where('id', '=',  1)->first();
			if($taxdata->tax_status==1){
				$taxrate=$taxdata->tax_rates;
				$tax=round(($prototal*$taxrate)/100,2);
				
			}else{
				$tax=0;
			}

		
			$alltotal=$prototal+$shiptotal-$couamt+$tax;		

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
		  'tax_amt' =>  $tax,
		  'od_total' =>  $alltotal,
		  'created_at' => date('y-m-d H:i:s'),
		  'updated_at' => date('y-m-d H:i:s'),

		  ];

	

		  $idss = DB::table('orders')->insert($orderSet);
		  $idss = DB::getPdo()->lastInsertId();

			

			$allcartdata = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->get();			

			foreach($allcartdata as $cartdetail){	
			
				if($cartdetail->custom_single==1){
					$csingal=1;	
				}else{
					$csingal=0;
				}

			$cartSet = [
				'order_id' => $idss,
				'user_id' => $userid,
				'cat_id' => $cartdetail->cat_id,
				'product_id' => $cartdetail->product_id,
				'product_type' => $cartdetail->product_type,
				'custom_single' => $csingal,
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
				 $itemId = DB::getPdo()->lastInsertId();
				 

				/*DB::table('canvas_dataurls')
					->where('cart_id', $cartdetail->id)
					->update(['orderitem_id' => $itemId]);*/

					if($cartdetail->product_type==0){
	
						$ofabric = Cart::cartdescnfo($cartdetail->id,'ofabric');	
						$totalqty = Cart::fabdeduct($cartdetail->id,$cartdetail->cat_id);			
		
						$fabdataSet = [
						'fabric_qty' => $totalqty['fabqty'],
						'fabric_total_qty' => $totalqty['totalqty'],	
						];
							
						DB::table('etfabrics')
							->where('id', $ofabric)
							->update($fabdataSet);
							
						if($cartdetail->custom_single==1){							
							
							if($cartdetail->product_id!=''){
								$prodata = EcollectionProduct::select('initial_stock')->where('id', '=',  $cartdetail->product_id)->first();
								$qty=$prodata->initial_stock-1;	
														
								DB::table('ecollection_products')
								->where('id', $cartdetail->product_id)
								->update(['initial_stock' => $qty]);
							}
							
							
						}
							
							
							
					}else{
						
						$prodata = EcollectionProduct::select('initial_stock')->where('id', '=',  $cartdetail->product_id)->first();
						$qty=$prodata->initial_stock-1;	
												
						DB::table('ecollection_products')
						->where('id', $cartdetail->product_id)
						->update(['initial_stock' => $qty]);							
					}	
					
					
					
					/*Add detail in singal product page*/
					$osizFi=[];
					
					if($cartdetail->product_type==0)
					{	
						
						$osizFitt = Cart::cartdescnfo($cartdetail->id,'osizeFit');
						if($osizFitt!=''){
							array_push($osizFi,$osizFitt); //$osizFi[]=$osizFitt;
							$osizFit=serialize($osizFi);
						}else{
							$osizFit='';
						}
						
						
						$productSet = [
								'cat_id' => $cartdetail->cat_id,
								'product_name' => $cartdetail->fabric_name,
								'initial_stock' => 1,
								'product_type' => 1,
								'fabric_name' => $cartdetail->fabric_name,
								'product_mrp' => $cartdetail->price,
								'main_catid' => $cartdetail->cat_id,
								'custom_description' => $cartdetail->item_description,
								'product_size' => $osizFit,
								'product_status' => 0,
								'created_at' => date('y-m-d H:i:s'),
								'updated_at' => date('y-m-d H:i:s'),
	
							];
	
				
							 $ids = DB::table('ecollection_products')->insert($productSet);
							 $productsId = DB::getPdo()->lastInsertId();
						
						for($po=1;$po<3;$po++)
						{
							
							if($po==1)
							{
								$imgrecord = [
								'product_id' => $productsId,
								'main_img'   => $cartdetail->canvas_front_img,
								'thumb_img'  => $cartdetail->canvas_front_img,
								]; 
								DB::table('ecollection_proimgs')->insert($imgrecord);
							}elseif($po==2){
								
								if($cartdetail->canvas_back_img!=''){
								
									$imgrecordu = [
									'product_id' => $productsId,
									'main_img'   => $cartdetail->canvas_back_img,
									'thumb_img'  => $cartdetail->canvas_back_img,
									]; 
									DB::table('ecollection_proimgs')->insert($imgrecordu);
								}
							}
							
						}
					}
					
					/*End singal product page*/
					
							
					
					
				}
				

			$deletecartdata = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->delete();			

			$deleteCoupon = CartCoupon::select('*')->where('cart_sessionid', '=',  $cartsess)->delete();

			session::forget('carts');

			$orderdata = Order::select('*')->where('id', '=',  $idss)->get();
			$invoicedata = OrderItem::select('*')->where('order_id', '=',  $idss)->get();			

			view()->share(compact('orderdata','invoicedata'));
			$pdf = \PDF::loadView('emails.invoicepdf')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
			$pdf->setPaper('a4', 'landscape')->setWarnings(false)->save('storage/pdf/'.$idss.'-invoice.pdf');
		    $pdurl = 'storage/pdf/'.$idss.'-invoice.pdf';

  

			$useremail=Auth::user()->email;

				Mail::to($useremail)
				->cc(array(setting('site.web_email','name')))
				->send(new Invoice($orderdata,$invoicedata,$pdurl));

			

			//Session::flash('message','E-mail has been sent Successfully');

							

        	//return Redirect::to('/thankyou')->with($transactionId);

			$id = Auth::user()->id;
            $soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
			return view::make('thank-you')->with(compact('soc','transactionId'));
 }else{
     return Redirect::to('/myaccount'); 
}

    }
	

	public function thankyou($orderid){		
                           if($orderid != ''){
			$id = Auth::user()->id;
            $soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();		

			 return view('thankyou')->with(compact('id','soc','orderid'));
                    }else{
                     return Redirect::to('/myaccount'); 
                  } 
	}

   



}