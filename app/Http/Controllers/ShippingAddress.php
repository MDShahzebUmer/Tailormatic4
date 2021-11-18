<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Requests\ConatctRequest;
use Illuminate\Support\Facades\Route;
use Validator;
use Illuminate\Http\Request;
use Sentry;
use Mail;
use DB;
use App\Mail\Reminder;
use Illuminate\Support\Collection;
use Session;
use App\ShippingsAddr;
use App\Cart;
use App\State;
use Redirect;


class ShippingAddress extends Controller
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

    public function shipping_address()
    {
         if (Auth::check())
         {
             $id = Auth::user()->id; 
             $address = DB::table('users')
                ->where('users.id' ,'=' ,$id)
                ->join('shippings-addrs', 'users.id', '=', 'shippings-addrs.user_id')
                ->join('countries', 'shippings-addrs.scountry_id', '=', 'countries.id')
                ->join('states', 'shippings-addrs.sstate', '=', 'states.id')
                ->select('shippings-addrs.*','countries.name as cname','states.name as sname')
                ->get();
            
         }
        return view('cart.shipping_address')->with(compact('address'));
    }

    public function add_shipping_address(Request $request)
    {
         if(Auth::check()){
           if($request->input('shipping_id') != '') {
               if (Session::has('carts')) {
                  $cartsess=Session::get('carts');
                  $count = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->count();
                  $userid = Auth::user()->id;
                  DB::table('carts')
                    ->where('user_id', $userid)
                    ->update(['cart_sessionid' => $cartsess]);
                  
                if($count>0){
                  $shipid = $request->input('shipping_id');
                  DB::table('carts')
                      ->where('cart_sessionid', $cartsess)
                      ->update(['ship_id' => $shipid]);
                      return Redirect::to('/cartitems');
                }else{
                  return Redirect::to('/');
                }
           }else{
             return Redirect::to('/');
           }
       
         } else {
               if (Session::has('carts')) {
               $cartsess=Session::get('carts');
               $count = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->count();
                 if($count>0){
                   $user_id = Auth::user()->id;
                   $data = new ShippingsAddr;
                   $data->sfname = $request->input('sfname');
                   $data->slname = $request->input('slname');
                   $data->saddress = $request->input('saddress');
                   $data->slandmark = $request->input('slandmark');
                   $data->scity = $request->input('scity');
                   $data->szipcode = $request->input('szipcode');
                   $data->scountry_id = $request->input('scountry_id');
                   $data->sphone = $request->input('sphone');
                   $data->sstate = $request->input('sstate');
                   $data->status = 1;
                   $data->user_id = $user_id;
                   $data->save();
                   $shipid  = $data->id;

                   
                  $userid = Auth::user()->id;
                  DB::table('carts')
                  ->where('user_id', $userid)
                  ->update(['cart_sessionid' => $cartsess]);
                  
                  DB::table('carts')
                              ->where('cart_sessionid', $cartsess)
                      ->update(['ship_id' => $shipid]);
                       return Redirect::to('/cartitems');

                     }else{return Redirect::to('/');}
               }else{return Redirect::to('/');}
       }
      }else
     {
       return  Redirect::to('/');
     }

        
     
    }

     public function edit_shipping_address($ship_id)
     {
         if (Auth::check())
         {
            $uid = Auth::user()->id;
             if($uid != '' && $ship_id != '')
             {
                $addship =  ShippingsAddr::select('*')->where('id' , '=' ,$ship_id)->first();
                return view('cart.editshipping_address')->with(compact('addship'));
             }
             else
             {
                 return redirect()->back();
             }

         }else{

         }  
     }
     public function update_shipping_address(request $request)
     {
        
      if (Auth::check())
      {
         $ship = new ShippingsAddr;
         $ship = ShippingsAddr::findOrFail($request->shipping_id);
         $ship->sfname    = $request->sfname;
         $ship->slname    = $request->slname;
         $ship->saddress  = $request->saddress;
         $ship->slandmark = $request->slandmark;
         $ship->scity     = $request->scity;
         $ship->szipcode  = $request->szipcode;
         $ship->scountry_id = $request->scountry_id;
         $ship->sstate    = $request->sstate;
         $ship->sphone    = $request->sphone;
         $ship->save();
           if($ship->save())
           {
              return redirect()->to('/shipping-address');

           }else{
              return redirect()->back(); 
          }

     }else{
          return redirect()->back();
       }
        
     }

     public function get_statesName($id)
    {
        //echo $_POST['id'];
         $states = State::where('country_id' , '=' ,$id)->get();
        return response()->json($states);

    }

    
    
}
