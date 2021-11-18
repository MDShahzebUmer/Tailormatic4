<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Validator;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\OrderCancelsRequest;
use Sentry;
use DB;
use Request;
use App\Mail\Reminder;
use Illuminate\Support\Collection;
use Session;
use App\User;
use App\Socialicon;
use Redirect;
use App\Order;
use App\OrderItem;
use App\Cancelorder;

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
           $u->name = Request::input('name');
           $u->lname = Request::input('lname');
           $u->phone = Request::input('phone');
           $u->address = Request::input('address');
           $u->landmark = Request::input('landmark');
           $u->zipcode = Request::input('zipcode');
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
               return redirect('/myaccount');

            }else{

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
   
    public function itemdetail($orid='')
    {        
			if($orid!=''){
				
				$userid = Auth::user()->id;
				
				 if (Auth::check())
           		{
					
						$itemdata = OrderItem::select('*')->where('id', '=',  $orid)->where('user_id', '=',  $userid)->get();						
						$soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();			     
         				return view('profile.itemdetail')->with(compact('itemdata','soc'));	
					
				}else{
					
					return view::make('errors/404');
				}
					
										
				  
			}else{
				
				return view::make('errors/404');
				
			}
			
		}
    
    public function orderCancels(OrderCancelsRequest $request)
    {
          
         if($request->id != null)
         {
          $id = $request->id;
         
          $canl = Order::findOrFail($id);
          $canl->request_status = '1';
          if($canl->save())
          {
            $co = new  Cancelorder;
            $co->order_id = $request->id;
            $co->reason = $request->reason;
            $co->decs_reason = $request->decs_reason;
            $co->save();
            return redirect()->back();
          }
         }
         else
         {
          echo "";
         }
          

    }



    


    /**/
    
}
