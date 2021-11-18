<?php
namespace App\Http\Controllers;
use DB;
use Session;
use View;
use Illuminate\Support\Facades\Route;
use Validator;
use Request;
use Redirect;
use App\Mail\RefFriendLink;
use App\Mail\Notify;
use Illuminate\Support\Collection;
use Auth;
use App\Http\helpers;
use Mail;
use App\EcollectionProduct;
use Voyager;
use App\EcollectionWishlist;
use App\User;
use App\EcollectionProimg;


class NotifyController extends Controller
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

    public function wishlistnotify()
    {
		$wishdata = EcollectionWishlist::select('*')->where('out_ofstock_sta' , '=',1)->get();
		if (count($wishdata)) {
			
			foreach($wishdata as $prodata){
				
				$userdata = User::select('*')->where('id' , '=',$prodata->user_id)->first();
				
				
				
				$ecpropro = EcollectionProduct::select('product_mrp','product_offer_rate','product_size','quality_desc','product_name','main_catid')->where('id' , '=',$prodata->product_id)->where('initial_stock' ,'>',0)->where('product_status', '=',1)->first();
				
				 $ecproimg = EcollectionProimg::select('thumb_img')->where('product_id','=',$prodata->product_id)->limit(1)->first();
				
				
				if($ecpropro){
					
					if($ecpropro->product_offer_rate == 0)
					{
						$mrp = $ecpropro->product_mrp;
					}else{
						$mrp = $ecpropro->product_offer_rate;
					}
					
					if($ecpropro->product_size!=''){
					   $siz  = unserialize($ecpropro->product_size);
					   $pp=1;
					   }else{
						   $siz='';
							$pp=2;
					   }
					   
					   //lname name
          
					$data = [
					   'mrp'       =>  $mrp,
					   'prod_name' =>  $ecpropro->product_name,
					   'catId'     =>  $ecpropro->main_catid,
					   'siz'       =>  $siz,
					   'desc'      =>  $ecpropro->quality_desc,
					   'main_img'  =>  $ecproimg->thumb_img,
					   'proID'     =>  $prodata->product_id,
					   'pp'     =>  $pp,
					   'name'     =>  $userdata->name.' '.$userdata->lname,					   
					]; 
					
					
					Mail::to($userdata->email)->send(new Notify($data));
				
				}
				
			}
			
			
		}
		
		exit();
		
		
	}
	



   



}