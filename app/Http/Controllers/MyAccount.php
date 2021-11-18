<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Validator;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ReferfRequest;
use App\Http\Requests\OrderCancelsRequest;
use Sentry;
use DB;
use Illuminate\Http\Request;
use Mail;
use App\Mail\Ucancleorder;
use App\Mail\UcancleorderItem;
use App\Mail\Acancleorder;
use App\Mail\AcancleorderItem;
use App\Mail\RefReminder;
use Illuminate\Support\Collection;
use Session;
use App\User;
use App\Socialicon;
use Redirect;
use App\Http\Helpers;
use App\Order;
use App\OrderItem;
use App\Cancelorder;
use App\Refertofriend;
use App\EcollectionWishlist;
use Voyager;
use App\Cart;
use PDF;


class MyAccount extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   // public $successfully;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myProfile()
    {
         if (Auth::check())
         {
             $id = Auth::user()->id;
             $data = User::select('*')->find($id);
             $soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
             if (Session::has('carts')) {
          $cartsess=Session::get('carts');
          $count = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->count();
          if($count>0){
            
                DB::table('carts')
                ->where('cart_sessionid', $cartsess)
                ->update(['user_id' => $id]);
            
          }
        }
             return view('profile.myprofile')->with(compact('id','soc','data')); 
         }
        //return view('cart.shipping_address')->with(compact('address'));
    }
    public function myeditProfile()
    {
       $id = Auth::user()->id;
       if($id != '')
       {
          if (Auth::check())
         {
             $data = User::select('*')->where('id' , '=' , $id)->find($id);
             $soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
             return view('profile.edit-profile')->with(compact('soc','data')); 
         }  
       }
       else
       {
         return Redirect()->back();
       }
    }
    public function myupdateProfile(ProfileUpdateRequest $request)
    {
      //print_r($_POST);exit();
      $id = Auth::user()->id;
       if($id != '')
       {
          if (Auth::check())
         {
           
           $u = user::findOrFail($id);
            $u->name =     $request->name;
           $u->lname =    $request->lname;
           $u->phone =   $request->phone;
           $u->address =  $request->address;
           $u->landmark = $request->landmark;
           $u->zipcode =  $request->zipcode;
           $u->country_id =  $request->country_id;
           $u->state =  $request->state;
            if($u->save())
            {
              $u = Session::flash('profile','Profile Update Successfully');
             return redirect()->back()->with($u);
            }
            else{
              return $this->myeditProfile();
            }

          
         }  
       }
       else
       {
         return Redirect()->back();
       }
    }
    
    public function myOrderlistsProfile()
    {
      $id = Auth::user()->id;
       if($id != '')
       {
            if (Auth::check())
           {
			
             $orderdata = Order::select('*')->where('user_id', '=',  $id)->get();
			 
			 $soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
             return view('profile.orderlists')->with(compact('soc','orderdata'));
           }else{

           }
        }
        else
        {

        }
    }
    public function myOrderdetails($orid)
    {
      $id = Auth::user()->id;
       if($id != '')
       {
            if (Auth::check())
           {
			$orderdata = OrderItem::select('*')->where('order_id', '=',  $orid)->get();
			
             $soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
             return view('profile.orderdetails')->with(compact('soc','orderdata')); 
           }else{

           }
        }
        else
        {

        }
    }
    public function passwordChange()
    {
      $id = Auth::user()->id;
       if($id != '')
       {
            if (Auth::check())
           {

             $soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
             return view('profile.passwordchange')->with(compact('soc')); 
           }else{

           }
        }
        else
        {

        }
    }
	public function changepassword(PasswordUpdateRequest $request)
    {
      $id = Auth::user()->id;
       if($id != '')
       {
            if(Auth::check())
           {

               $u = User::findOrFail($id);
               $u->password     =  bcrypt($request->password);
               $u->remember_token = Str::random(60);
               $u->save();
                $u = Session::flash('password','Password Update Successfully');
               return redirect()->back()->with($u);

            }else{
                return redirect()->back();
           }
        }
        else
        {

        }

    }
	
	public function OrderInvoice($orid)
    {
				
      $id = Auth::user()->id;
       if($id != '')
       {
            if (Auth::check())
           {
			  
			
             $ordata = Order::select('*')->where('id', '=',  $orid)->first();
			 $invoicedata = OrderItem::select('*')->where('order_id', '=',  $orid)->get();
			
             return view('profile.order-invoice')->with(compact('ordata','invoicedata'));
           }else{

           }
        }
        else
        {

        }
    }

    
   
    public function itemdetail($itemid='')
    {        
			if($itemid!=''){
				
				$userid = Auth::user()->id;
				
				 if (Auth::check())
           		{
						$catId = OrderItem::select('cat_id','product_type')->where('id', '=',  $itemid)->where('user_id', '=',  $userid)->first();
						
						$itemdata = OrderItem::select('*')->where('id', '=',  $itemid)->where('user_id', '=',  $userid)->get();						
						$soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();	
								     
						if($catId->product_type==0){	
							if($catId->cat_id==1){						
								return view('profile.itemdetail')->with(compact('itemdata','soc'));	
							}elseif($catId->cat_id==2){
								return view('profile.jitemdetail')->with(compact('itemdata','soc'));
							}elseif($catId->cat_id==3){
								return view('profile.vitemdetail')->with(compact('itemdata','soc'));		
							}elseif($catId->cat_id==4){
								return view('profile.pitemdetail')->with(compact('itemdata','soc'));
							}elseif($catId->cat_id==18){
                                return view('profile.threepcitemdetail')->with(compact('itemdata','soc'));
                            }elseif($catId->cat_id==19){
                                return view('profile.twopcitemdetail')->with(compact('itemdata','soc'));
                            }
						}else{
							return view('profile.productdetail')->with(compact('itemdata','soc'));
						}
											
				}else{
					
					return view::make('errors/404');
				}
				  
			}else{
				
				return view::make('errors/404');
				
			}
    }
	
	public function orderCancels(OrderCancelsRequest $request)
    {
          $userid = Auth::user()->id;
          $email = Auth::user()->email;
          $name = Auth::user()->name;
        
          if (Auth::check())
          { 
         if($request->id != null)
         {
          $id = $request->id;
         $ordercode = Order::select('tracking_code','id','no_item','created_at')->where('id' , '=' ,$id)->find($id);
               

         DB::table('order_items')
            ->where('order_id', $ordercode->id)
            ->update(['item_cancel' => true]);

          $canl = Order::findOrFail($id);
          $canl->request_status = '1';
          

          

          if($canl->save())
          {
            $co = new  Cancelorder;
            $co->order_id    =  $request->id;
            $co->reason      =  $request->reason;
            $co->user_id     =  $userid;
            $co->user_type   =  'U';
            $co->rstatus     =  '1';
            $co->decs_reason =  $request->decs_reason;
            $u = [
                   'tracking_code' => $ordercode->tracking_code,
                    'order_id' => $ordercode->id,
                    'name' => $name,
                    'itemcoun' => $ordercode->no_item,
                    'odate' => substr($ordercode->created_at, 0,10),
                     'email' => $email,
                     'reason' => $request->reason,
                     'decs_reason' => $request->decs_reason,
                    ];
            

            $co->save();
            Mail::to($email)->send(new Ucancleorder($u));
            Mail::to(Voyager::setting('web-email'))->send(new Acancleorder($u));

            return redirect()->back();
          }
         }
         else
         {
          return redirect()->back();
         }
          
      }
      else
      {
         return redirect()->back();
      }

    }

    public function orderCancelsItem(Request $request)
    {
       if(Auth::check())
       {
         $t_can = 0;
          if($request->id != ''){
              $id = $request->id;
              $can_req = OrderItem::findOrFail($id);
              $can_req->item_cancel = 1;
              if($can_req->save()){

                   $oreder_item =  OrderItem::select('id','order_id','user_id')->where('id','=',$id)->first($id);
                   $cart =  OrderItem::select('*')->where('id','=',$id)->first($id);
                  //echo $oreder_item->order_id;
                    $co = new  Cancelorder;
                    $co->user_id =     $oreder_item->user_id;
                    $co->user_type   =  'U';
                    $co->rstatus     =  '1';
                    $co->order_id =     $oreder_item->order_id;
                    $co->order_itemId = $oreder_item->id;
                    $co->reason = $request->reason;
                    $co->decs_reason = $request->decs_reason;
                    if($co->save()){
                       $id = $oreder_item->order_id;
                           $t_itms  = Helpers::cal_totalItems($id);
                           $t_can  = Helpers::cal_totalCanItems($id);
                              $tcan = $t_can;
                              if($tcan == $t_itms)
                              {
                                $item_st = Order::findOrFail($id);
                                $item_st->item_request = 1;
                                $item_st->request_status = 1;
                                $item_st->save();

                              }else{
                                $item_st = Order::findOrFail($id);
                                $item_st->item_request = 1;
                                $item_st->save();
                                }
                      

                      $ordercode = Order::select('tracking_code','id','created_at')->where('id' , '=' ,$id)->find($id);
                            $cm = Helpers::get_ItemMailDetails($cart);
                           $email = Auth::user()->email;
                           $name = Auth::user()->name;
                            $u = [
                              'tracking_code' => $ordercode->tracking_code,  
                              'order_id' => $ordercode->id,  
                              'item_id' => $oreder_item->id,  
                              'name' => $cm['name'],  
                              'cimg' => $cm['img'],   
                              'email' => $email,   
                              'uname' => $name,   
                              'otm' => $ordercode->created_at,     
                              'reason' => $request->reason,     
                              'decs_reason' => $request->decs_reason,     
                               
                            ];
                         //   print_r($u);
                        
                      Mail::to($email)->send(new UcancleorderItem($u));
                      Mail::to(Voyager::setting('web-email'))->send(new AcancleorderItem($u));
                       return Redirect()->back();
                         
                   }else{
                      return Redirect()->back();
                    }

              }else{
                return Redirect()->back();
              }




          }else{
             return Redirect()->back();
          }
         //print_r($_POST);    

       }else{
        return redirect()->back();
       }
    }

    public function refer_friend()
    {
       $id = Auth::user()->id;
       if($id != '')
       {
          if (Auth::check())
         {
             
            $soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
             return view('profile.refer-to-friend')->with(compact('soc')); 
         }  
       }
       else
       {
         return Redirect()->back();
       }
    }

    public function referfriend(ReferfRequest $request)
    {
      
        
       $name = Auth::user()->name;
       $femail = Auth::user()->email;
       $id = Auth::user()->id;
       $data = new Refertofriend;
       $data->name = $request->name;
       $data->email = $request->email;
       $data->phone = $request->phone;
       $data->message = $request->message;
       $data->femail = $femail;
       $data->fname = $name;
       $data->user_id = $id;
       $data->save();

       $reff = [
           'name' => $request->name,
           'fname' => $name,
           'message' => $request->message,
       ];
       Mail::to($request->email)->send(new RefReminder($reff));
      $u = Session::flash('reffriend','E-mail has been sent Successfully');
      return redirect()->back()->with($u);

       
    }

    public function wish_userList()
    {
       $id = Auth::user()->id;
       if($id != '')
       {
          if (Auth::check())
         {
            $wishlists = DB::table('ecollection_wishlists')
                ->where('user_id','=',$id)
                ->where('ecollection_products.product_status','=',1)
                ->join('ecollection_products', 'ecollection_wishlists.product_id', '=', 'ecollection_products.id')
                ->join('ecollection_proimgs', 'ecollection_wishlists.product_id', '=', 'ecollection_proimgs.product_id')
                ->groupBy('ecollection_wishlists.id')
                ->select('ecollection_products.*','ecollection_wishlists.id as wishId','ecollection_wishlists.product_id','ecollection_proimgs.thumb_img')
                ->get();
                //echo '<pre>'.print_r($wishlists,true).'</pre>';
               // exit();
            $soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
            return view('profile.wishlists')->with(compact('wishlists','soc')); 
         }  
       }
       else
       {
         return Redirect()->back();
       }
       
    } 

        public function wish_userListdel($id)
        { 
          $uid = Auth::user()->id;
          if($uid != '')
          {
            if (Auth::check())
            {
               DB::table('ecollection_wishlists')->where('id', '=', $id)->where('user_id', '=', $uid)->delete();
               return response()->json(array('del'=> "Successfully Remove"), 200);
            }  
          }
          else
          {
           return Redirect()->back();
         } 

       }
      
    
}
