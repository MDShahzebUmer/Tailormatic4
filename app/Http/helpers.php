<?php
namespace App\Http;
use App\Contrast;
use App\Country;
use App\ShippingRate;
use App\Cart;
use DB;
use Session;
use App\CamaignPromoCode;
use App\Order;
use Auth;
use User;
use App\ShippingsAddr;
use App\CanvasDataurl;
use App\OrderSmss;
use App\ProductImg;
use App\OrderReview;
use App\StandardSize;
use App\EcollectionPattern;
use App\EcollectionFabrictype;
use App\EcollectionProimg;
use App\Etfabric;
use App\OthersPage;
use App\OrderItem;
use App\Page;
use App\EcollectionProduct;
use App\FabricGroup;
use App\BodyMeasurment;
use App\MeasurmentSize;



class Helpers {

     public static function alltebinfo($table,$id,$fieldname){

     $alltebinfo = DB::table($table)->where('id','=',$id)->value($fieldname);
      return $alltebinfo;
    }
	
	public static function optionval($fieldname){
		if($fieldname=='true'){
			$fieldresponse='Yes';
		}else{
			$fieldresponse='No';
		}
     
      return $fieldresponse;
    }
	
	public static function shippingamt($countryid,$cat_id){
		
		$shipamt=ShippingRate::select('*')->where('country_id', '=',  $countryid)->first();
		if($cat_id==1){
			$shipingamt=$shipamt->shirt_amt;
		}elseif($cat_id==2){
			$shipingamt=$shipamt->jacket_amt;
		}elseif($cat_id==3){
			$shipingamt=$shipamt->vests_amt;
		}elseif($cat_id==4){
			$shipingamt=$shipamt->pant_amt;
		}else{
			$shipingamt=$shipamt->other_cat_amt;
		}
	     
      return $shipingamt;
    }
	
	public static function cartcount(){
		
		if(Auth::check())
		{
			 $id = Auth::user()->id;
			$cartsess=Session::get('carts');
			if (Session::has('carts')) {
				$count = Cart::select('*')->where('user_id', '=',  $id)->orWhere('cart_sessionid', '=', $cartsess)->count();
			}else{
				$count = Cart::select('*')->where('user_id', '=',  $id)->count();
			}
		    

		}elseif (Session::has('carts')) {
					
		$cartsess=Session::get('carts');
		$count = Cart::select('*')->where('cart_sessionid', '=',  $cartsess)->count();
		}else{
			$count=0;
		}
	     
      return $count;
    }
	
	
	public static function producttotal($cartsess){
		
		$pricecount = Cart::select('price')->where('cart_sessionid', '=',  $cartsess)->sum('price');		
	     
      return $pricecount;
    }
	public static function shiptotal($cartsess){
		
		$shiptotal = Cart::select('shipping')->where('cart_sessionid', '=',  $cartsess)->sum('shipping');		
	     
      return $shiptotal;
    }
	
	
	
	public static function catcarttotal($catId='',$cartsess){
		
		if($catId!=''){
			$catcarttotal = Cart::select('id')->where('cat_id', '=',  $catId)->where('cart_sessionid', '=',  $cartsess)->count();
		}else{
			$catcarttotal=0;
		}
	     
      return $catcarttotal;
    }
	
	public static function maxamt($promocode){
		
		$maxamount = CamaignPromoCode::select('max_amount')->where('promo_code', '=',  $promocode)->first();
		if($maxamount->max_amount==''){
			$maxcouamt=5000000000;//Assume amount is 0
		}else{
			$maxcouamt=$maxamount->max_amount;
		}
	     
      return $maxamount;
    }
	
	
	
	public static function ordusercount($userid){		
		$ordusercount = Order::select('id')->where('user_id', '=',  $userid)->count();	     
      return $ordusercount;
    }
	
	
	public static function regionchk($address='',$shipaddid){		
		
		if($address!=''){				
									
		$regionchk = ShippingsAddr::select('id')->where('id', '=',  $shipaddid)->where('saddress', 'LIKE', '%' .$address. '%')->count();
		}else{
			$regionchk=0;
		}
		
     	return $regionchk;	  
    }
	
	public static function citychk($city,$shipaddid){		
		$userid=Auth::user()->id;
		if($city!=''){						
		$citychk = ShippingsAddr::select('id')->where('id', '=',  $shipaddid)->where('scity', 'LIKE', '%' .$city. '%')->count();
		}else{
			$citychk=0;
		}
     	return $citychk;	  
    }
	
	public static function statechk($state,$shipaddid){		
		$userid=Auth::user()->id;
		if($state!=''){						
		$statechk = ShippingsAddr::select('id')->where('id', '=',  $shipaddid)->where('sstate', '=',  $state)->count();
		}else{
			$statechk=0;
		}
     	return $statechk;	  
    }
	
	public static function countrychk($country,$shipaddid){		
		$userid=Auth::user()->id;
		if($country!=''){						
		$countrychk = ShippingsAddr::select('id')->where('id', '=',  $shipaddid)->where('scountry_id', '=',  $country)->count();
		}else{
			$countrychk=0;
		}
     	return $countrychk;
    }
	
	 public static function chkcartinfo($table,$sessid,$fieldname){

      $slugname = DB::table($table)->where('cart_sessionid','=',$sessid)->value($fieldname);
      //exit();

      return $slugname;
    }
	
	public static function shippinginfo($id){

      $shippinginfo = ShippingsAddr::select('*')->where('id', '=',  $id)->find($id);
      //exit();

      return $shippinginfo;
    }
	
	public static function orderrequest($id)
    {
		
		
		switch ($id) {
			case '0':
			return "Cancel Order";
			break;
			case '1':
			return "Pending Cancellation";
			break;
			case '2':
			return "Approved Cancellation";
			break;
			case '3':
			return "Disapproved Cancellation";
			break;
			case '4':
			return "Refund";
			break;
						
			default:
			return "";
			break;
		}
    }
public static function itemorrequest($id)
    {
		
		
		switch ($id) {
			case '0':
			return "Cancel Item";
			break;
			case '1':
			return "Pending Cancellation";
			break;
			case '2':
			return "Approved Cancellation";
			break;
			case '3':
			return "Disapproved Cancellation";
			break;
			case '4':
			return "Refund";
			break;
						
			default:
			return "";
			break;
		}
    }
		
	
	
	public static function dataurltoimg($imgurl,$catid,$imgview)
	{
		$path=public_path().'/storage/';
		 $r = rand(9,999);
		$imgpath='Orderimg/'.$catid.$r.$imgview.'.png';
		list($type, $imgurl) = explode(';', $imgurl);
		list(, $imgurl)      = explode(',', $imgurl);
		$data = base64_decode($imgurl);
		
		$file = $path.$imgpath;
		$success = file_put_contents($file, $data);
		
		return $imgpath;
	}

	public static function dataurltoimg2($imgurl,$catid,$imgview)
	{
		// equal rand val (reason : synchronize problem)
		$path=public_path().'/storage/';
		$imgpath='Orderimg/'.$catid.$imgview.'.png';
		list($type, $imgurl) = explode(';', $imgurl);
		list(, $imgurl)      = explode(',', $imgurl);
		$data = base64_decode($imgurl);
		
		$file = $path.$imgpath;
		$success = file_put_contents($file, $data);
		
		return $imgpath;
	}

	public static function getLiningImage($image_id,$ostyle){
		$ret_id = 1; //default lining
		$lining_path = "";
		$storage_path = public_path().'/storage';
		if($ostyle == '50'){
			$lining_path = $storage_path.'/Jacket/ColorContrast/Lining/1Button/'.$image_id.'.png';
		} else if($ostyle == '51'){
			$lining_path = $storage_path.'/Jacket/ColorContrast/Lining/2Button/'.$image_id.'.png';
		} else if($ostyle == '52'){
			$lining_path = $storage_path.'/Jacket/ColorContrast/Lining/3Button/'.$image_id.'.png';
		} else if($ostyle == '53'){
			$lining_path = $storage_path.'/Jacket/ColorContrast/Lining/4Button/'.$image_id.'.png';
		} else if($ostyle == '54'){
			$lining_path = $storage_path.'/Jacket/ColorContrast/Lining/4ButtonD2/'.$image_id.'.png';
		} else if($ostyle == '55'){
			$lining_path = $storage_path.'/Jacket/ColorContrast/Lining/4ButtonD1/'.$image_id.'.png';
		} else if($ostyle == '56'){
			$lining_path = $storage_path.'/Jacket/ColorContrast/Lining/6ButtonD2/'.$image_id.'.png';
		} else if($ostyle == '57'){
			$lining_path = $storage_path.'/Jacket/ColorContrast/Lining/6ButtonD3/'.$image_id.'.png';
		} else if($ostyle == '58'){
			$lining_path = $storage_path.'/Jacket/ColorContrast/Lining/6ButtonD1/'.$image_id.'.png';
		} 
		if(file_exists($lining_path)){
        	$ret_id = $image_id;
    	}

		return $ret_id;
	}
	
	public static function imggdelete($imgurl)
	{
		$path=public_path().'/storage/'.$imgurl;
		
		if(file_exists($path)){
        	@unlink($path);
    	}
		
		
	}
	
	public static function canvasdataurl($id){

      $canvasdataurl = CanvasDataurl::select('*')->where('cart_id', '=',  $id)->first();
      //exit();

      return $canvasdataurl;
    }
	
	 public static function get_user_request_status($id = null)
    {
        $req = Order::select('request_status')->where('id' , '=' , $id)->first($id);
         if($req != '')
         {
              return $req->request_status;
         }
         else
         {
             return 0;
         }
    }
    public static function get_user_request_temsstatus($id = null)
    {
        $req = OrderItem::select('item_cancel')->where('id' , '=' , $id)->first($id);
         if($req != '')
         {
              return $req->item_cancel;
         }
         else
         {
             return 0;
         }
    }
    public static function get_user_order_status($id = null)
    {
        $req = Order::select('orderstatus')->where('id' ,'=' ,$id)->first($id);
         if($req != '')
         {
              return $req->orderstatus;
         }
         else
         {
             return 0;
         }
    }
	
	public static function get_user_order_sms($id = null)
	{
       if($id != '')
       {
          $smschat= OrderSmss::select('sms_text','created_at')->where('order_id' ,'=' , $id)->where('type' , '=' ,'2')->where('status_sms' , '=' ,'1')->get();
          return $smschat;
       }
       else
       {
          return false;
       }
	}

	public static function get_bulk_sms()
	{
        //$data = OrderSmss::select('user_id')->where('type' , '=' ,'1')->where('status_sms' , '=' ,'1')->get(); 
        $data = DB::table('order_smss')
                ->where('type' ,'=' ,1)
                ->where('status_sms' ,'=' ,1)
                ->join('users', 'order_smss.user_id', '=', 'users.id')
                ->select('users.phone','users.name','users.city','order_smss.created_at','order_smss.sms_text','order_smss.id as smsid')
                ->get();
               return $data;
	}

	public static function get_countphone_con($pn = null)
	{
       $phone =$pn->phone;
       $id =$pn->country_id;
       $code = Country::select('phonecode')->where('id' ,'=' ,$id)->find($id);
       $phone = '+'.$code->phonecode.$phone;
      
       return $phone;
	}

	public static function encrypt_key($sData)
	{
       $secretKey="1234567890abcdefghijklmnopqrstuvwxyz";
       $sResult = '';
    for($i=0;$i<strlen($sData);$i++){
        $sChar    = substr($sData, $i, 1);
        $sKeyChar = substr($secretKey, ($i % strlen($secretKey)) - 1, 1);
        $sChar    = chr(ord($sChar) + ord($sKeyChar));
        $sResult .= $sChar;

      }

    return base64_encode($sResult);
	}
	public static function decrypt_key($sData)
	{
		   $secretKey="1234567890abcdefghijklmnopqrstuvwxyz";
		$sResult = '';
		$sData   = base64_decode($sData);
		for($i=0;$i<strlen($sData);$i++){
			$sChar    = substr($sData, $i, 1);
			$sKeyChar = substr($secretKey, ($i % strlen($secretKey)) - 1, 1);
			$sChar    = chr(ord($sChar) - ord($sKeyChar));
			$sResult .= $sChar;
		}
		return $sResult;
	}

	public static function img_font_call($id)
	{
		 $data  = ProductImg::select('*')->where('id' ,'=' ,$id)->first($id); 
		  if($data != '')
		  {
		  	return $data;
		  }
		  else
		  {
		  	return false;
		  }
	}
	
	public static function reviewperavg($id)
	{
		 $data  = OrderReview::select('*')->where('id' ,'=' ,$id)->first(); 
		 
		 $total=$data->fabric_rate+$data->price_rate+$data->delivery_rate+$data->fitting_rate;
		 
		 $avg=($total/20)*100;
		 
		if($avg<20){
			$f=1;
		}elseif($avg<40){
			$f=2;
		}elseif($avg<60){
			$f=3;
		}elseif($avg<80){  
			$f=4;
		}elseif($avg<100){ 
			$f=5;
		}else{
		$f=5;
		}
		$r=5;
		$b=$r-$f;
		$data['full']=$f;
		$data['blan']=$b;
		 
		 
		return $data;
	}

	public static function total_avg_revview($id = nulll)
	{
		 $data  = OrderReview::select('*')->where('id' ,'=' ,$id)->first(); 
		 $total=$data->fabric_rate+$data->price_rate+$data->delivery_rate+$data->fitting_rate;
		 $avg=($total/20)*100;
		 return $avg;
	}

	public static function total_count_review()
	{
		$tavg = 0;
        $data  = OrderReview::select('*')->get();
         $c = count($data);
         foreach ($data as  $v) {
         	     $_this = new self;
             	$tavg += $_this->total_avg_revview($v->id);
             }
             $total_review = ($tavg/$c);
             if($total_review<20){
             	$f=1;
             }elseif($total_review<40){
             	$f=2;
             }elseif($total_review<60){
             	$f=3;
             }elseif($total_review<80){  
             	$f=4;
             }elseif($total_review<100){ 
             	$f=5;
             } 
             $r=5;
             $b=$r-$f;
            $ry['full'] = $f;
            $ry['blan'] = $b;
            return $ry;  
            
	}

	public static function total_based_review()
	{
		$data  = OrderReview::select('id')->count();
		 if($data > 0)
		 {
		 	return number_format($data);
		 }
		 else
		 {
		 	return 0;
		 }
		
	}
	public static function get_cal_discount($m,$o)
	{
        if($m != '' && $o != '')
        {
        	 $d = 100-(($o*100)/$m);
        	return  round($d);
        	 
        }
	}

	public static function get_standersizenohh($id = null)
	{
		$sizeno = StandardSize::select('*')->get();
		return $sizeno;
	}
	
	public static function get_pattern($id = null)
	{
		$patname = EcollectionPattern::select('name')->where('id' , '=' ,$id)->find($id);
		return $patname->name;
	}
	
	public static function get_fabtype($id = null)
	{
		$typename = EcollectionFabrictype::select('type_name')->where('id' , '=' ,$id)->find($id);
		return $typename->type_name;
	} 
	
	public static function get_proimg($id = null)
	{
		$proimg = EcollectionProimg::select('*')->where('product_id' , '=' ,$id)->orderBy('id', 'asc')->limit(2)->get();
		
		foreach($proimg as $imgpro){
			$imgdata[]=$imgpro->main_img;
		}
		
		
		return $imgdata;
	} 

	public static function get_count_customer_served()
	{
		$cs = Order::select('orderstatus')->where('orderstatus','=',5)->count();
		if($cs != '')
		{
			return $cs;
		}else{
			return 0;
		}
	}
	public static function get_count_countery_served()
	{
	
		$ccs = DB::table('orders')
                ->where('orders.orderstatus' ,'=' ,5)
                ->join('shippings-addrs', 'orders.ship_id', '=', 'shippings-addrs.id')
                ->groupBy('shippings-addrs.id')
                ->select('shippings-addrs.id');
              $c =  count($ccs);
              if($c != '')
              {
              	return $c;
              }else{
              	return 0;
              }
              

     }
     public static function get_count_efabric()
	{
		$cf = Etfabric::select('id')->count();
		if($cf != '')
		{
			return $cf;
		}else{
			return 0;
		}
	}

	public static function get_parent($arr, $id)
	{
           $_this = new self;
		$key = $_this->get_key($arr, $id);
		if ($arr[$key]['parent_id'] == '')
		{
			return $id;
		}
		else 
		{
			return $_this->get_parent($arr, $arr[$key]['parent_id']);
		}
	}

	public static function get_key($arr, $id)
	{

		foreach ($arr as $key => $val) {
			if ($val->id == $id) {
				return $key;
			}
		}
		return null;
	}

	public static function get_ItemMailDetails($cart)
	{
		if($cart->product_type==0){	
		$groupname = OrderItem::groupinfo($cart->group_id,'fbgrp_name');
		$oprodType = OrderItem::orderiteminfo($cart->id,'oprodType');
			if($cart->cat_id==1){
				$ocollarName = $oprodType.' - '.OrderItem::orderiteminfo($cart->id,'ocollarName');
				$olapelName='';	
				$detailurl='itemdetail';					
				}elseif($cart->cat_id==2){
					$ocollarName = $oprodType.' - '.OrderItem::orderiteminfo($cart->id,'ostyleName');
					$olapelN=OrderItem::orderiteminfo($cart->id,'olapelName');
					$olapelName=$olapelN;
					$detailurl='jitemdetail';
				}elseif($cart->cat_id==3){
					$ocollarName = $oprodType.' - '.OrderItem::orderiteminfo($cart->id,'ostyleName');								
					$olapelName='';
					$detailurl='vitemdetail';
				}elseif($cart->cat_id==18){
					$ocollarName = $oprodType.' - '.OrderItem::orderiteminfo($cart->id,'ostyleName');
					$olapelN=OrderItem::orderiteminfo($cart->id,'olapelName');
					$olapelName=$olapelN;
					$detailurl='threepcitemdetail';
				}elseif($cart->cat_id==19){
					$ocollarName = $oprodType.' - '.OrderItem::orderiteminfo($cart->id,'ostyleName');
					$olapelN=OrderItem::orderiteminfo($cart->id,'olapelName');
					$olapelName=$olapelN;
					$detailurl='twopcitemdetail';						
				}else{
					$ocollarName = $oprodType.' - '.OrderItem::orderiteminfo($cart->id,'ostyleName');
					$olapelN=OrderItem::orderiteminfo($cart->id,'opleatName');
					$olapelName=$olapelN;
					$detailurl='pitemdetail';
									
				     }
									
					$size= OrderItem::orderiteminfo($cart->id,'osizeFit');
					$fabno= OrderItem::allinfodes('etfabrics',$cart->fabric_id,'fabric_code');

									
				}else{
					$groupname = OrderItem::orderiteminfo($cart->id,'ofabricName');										
					$ocollarName=OrderItem::orderiteminfo($cart->id,'oprodName');
					$olapelN=OrderItem::orderiteminfo($cart->id,'ofabricType');
					$olapelName='Fab Type : '.stripslashes($olapelN);									
					$size=OrderItem::orderiteminfo($cart->id,'osizeFit');
					$detailurl='productdetail';	
					$fabno = OrderItem::orderiteminfo($cart->id,'procode');
			   }
			   $canvasimg = OrderItem::allinfodes('order_items',$cart->id,'canvas_front_img');
			     $mail_data = [
	                   'name' => $ocollarName,
	                   'img' => $canvasimg,
	                   'gpname' => $groupname,
	                   'fnum' => $fabno,
	                   'size' => $size,
	                   'ptype' => $cart->product_type,

	                   
			     ];
			     return $mail_data;
	}

	public static function allItemsCancel($id)
	{
        $sta = Order::select('request_status','item_request')->where('id','=',$id)->first();

          if(($sta->request_status == 0 && $sta->item_request == 0))
           {
           	 return 1;
           }
           elseif(($sta->request_status > 0 && $sta->item_request == 0))
           {
           	 return 2;
           }
           else{
           	return 3;
           }
	} 

	public static function cal_totalItems($id)
	{
       $total_item = OrderItem::select('order_id')->where('order_id','=',$id)->count(); 
       return $total_item;  
	}
	public static function cal_totalCanItems($id)
	{
       $total_canitem = OrderItem::select('id')->where('order_id','=',$id)->where('item_cancel','>',0)->count(); 
        return $total_canitem;   
	}

	public static function get_Oreder_ItemDetails($odId)
	{
       $oitem_record = OrderItem::select('*')->where('order_id','=',$odId)->orderBy('id','asc')->first();
         $_this = new self;
          $order_list = $_this->get_ItemMailDetails($oitem_record);

          return $order_list;

	}
	public static function order_status_Check($id)
	{
        switch ($id) {
        	case '1':
        	return 'Your order has been placed successfully';
        		break;
        	case '2':
        		return 'Your order has been sent for processing';
        		break;
        	case '3':
        		return 'ready to be shipped by the E-tailor';
        		break;
        	case '4':
        		return 'Your order is on the way';
        		break;
        	case '5':
        		return 'Your item has been delivered';
        		break;
        	case '6':
        		return 'Your item has been approved';
        		break;
        	case '7':
        		return 'Your item has been disapproved';
        		break;
        	default:
        		return '';
        		break;
        }
	}

	public static function page_seo_details($id = null)
	{
		if($id != '')
		{    
             $seo_data = Page::select('*')->where('id','=',$id)->first();
            // print_r($seo_data->title);
             //exit();
             if($seo_data != '')
               { 
               	$seo = [
               	'meta_title' => $seo_data->title,
               	'meta_keyword' => $seo_data->meta_keywords,
               	'meta_desc' => $seo_data->meta_description
               	]; 
               	return  $seo; 

               }else{
               	$seo = [
               	'meta_title' => '',
               	'meta_keyword' => '',
               	'meta_desc' => ''
               	];
               	return $seo;
              }

		}
		else{
            $seo = [
             'meta_title' => '',
             'meta_keyword' => '',
             'meta_desc' => ''
            ];
            return $seo;
		}
        

	}
	
	
	public static function product_outofstock($id)
	{
		if($id != ''){
		$data = EcollectionProduct::select('*')->where('id','=',$id)->where('initial_stock', '=',0)->first();
		 if($data != '')
		 {
			return 1;
		 }else{ 
		 return 0;}
		
		}else{
			return 0;
		}
	}
	
	public static function cartcrossspro($id)
	{
	
		$cartsess=Session::get('carts');
		$cartitems = Cart::select('cat_id')->where('cart_sessionid', '=',  $cartsess)->where('cat_id', '=',  $id)->count();		
		
		if($cartitems>0){
			$itc=1;
		}else{
			$itc=0;
		}
		return $itc;
			
		
	}

        public static function get_degine_FirstInfo($id = 1)
	{
	     $frate = '';
           if($id != '')
            {
        	$fdata = FabricGroup::select('*')->where('cat_id','=',$id)->where('fabric_status','=','ACTIVE')->orderBy('id','asc')->limit(1)->first();
        	if($fdata->id){
                  //$edata = Etfabric::select('*')->where('fbgrp_id','=',$fdata->id)->whereRaw('fabric_qty > fabric_min_qty')->first();
				  $edata = Etfabric::select('*')->where('fbgrp_id','=',$fdata->id)->where('fabric_status','=','1')->whereRaw('fabric_qty > fabric_min_qty')->first();
                  if($fdata->fabric_offer_price != 0 && $fdata->fabric_offer_price != '')
                  {
                          $frate = $fdata->fabric_offer_price;
                  }else{
                  	        $frate =    $fdata->fabric_rate;
                  }
                  $collect_info = [
                  'fbgrp_name'         => $fdata->fbgrp_name,
                  'fabric_rate'        => $frate,
                  'fabric_img_l'       => $edata->fabric_img_l,
                  'fabric_img_s'       => $edata->fabric_img_s,
                  'fabric_code'        => $edata->fabric_code,
                  'fabric_name'        => $edata->fabric_name,
                  'fabric_gid'         => $fdata->id,
                  'fabric_eid'         => $edata->id,
                  ];
                  return $collect_info;
        	}else{
        		$collect_info = [
                  'fbgrp_name'         => 'Fabric Of The Week',
                  'fabric_rate'        => '69.59' ,
                   'fabric_img_l'      => 'Shirts/Fabric/L/1.jpg',
                  'fabric_img_s'       => 'Shirts/Fabric/S/1.jpg',
                  'fabric_code'        => '41',
                  'fabric_name'        => 'Premium White No.41',
                  'fabric_gid'         => '1',
                  'fabric_eid'         => '1',
                  ];
                  return $collect_info;
                    
        	}

        }else{
        	$collect_info = [
                  'fbgrp_name'         => 'Fabric Of The Week',
                  'fabric_rate'        => '69.59' ,
                   'fabric_img_l'      => 'Shirts/Fabric/L/1.jpg',
                  'fabric_img_s'       => 'Shirts/Fabric/S/1.jpg',
                  'fabric_code'        => '41',
                  'fabric_name'        => 'Premium White No.41',
                  'fabric_gid'         => '1',
                  'fabric_eid'         => '1',
                  ];
                   return $collect_info;

        }
    }
   	public static function get_fabric_group_info($cat_id){
		$fdata = FabricGroup::select('*')
			->where('cat_id','=',$cat_id)
			->where('fabric_status','=','ACTIVE')
			->orderBy('id','asc')->get();
		return $fdata;
    }
   
   public static function get_jacket_FirstInfo($id = 2)
	{
	     $frate = '';
           if($id != '')
            {
        	$fdata = FabricGroup::select('*')->where('cat_id','=',$id)->where('fabric_status','=','ACTIVE')->orderBy('id','asc')->limit(1)->first();
        	if($fdata->id){
                  //$edata = Etfabric::select('*')->where('fbgrp_id','=',$fdata->id)->whereRaw('fabric_qty > fabric_min_qty')->first();
				  $edata = Etfabric::select('*')->where('fbgrp_id','=',$fdata->id)->where('fabric_status','=','1')->whereRaw('fabric_qty > fabric_min_qty')->first();
                  if($fdata->fabric_offer_price != 0 && $fdata->fabric_offer_price != '')
                  {
                          $frate = $fdata->fabric_offer_price;
                  }else{
                  	        $frate =    $fdata->fabric_rate;
                  }
                  $collect_info = [
                  'fbgrp_name'         => $fdata->fbgrp_name,
                  'fabric_rate'        => $frate,
                  'fabric_img_l'       => $edata->fabric_img_l,
                  'fabric_img_s'       => $edata->fabric_img_s,
                  'fabric_code'        => $edata->fabric_code,
                  'fabric_name'        => $edata->fabric_name,
				  'fabric_desc'        => $edata->fabric_desc,
                  'fabric_gid'         => $fdata->id,
                  'fabric_eid'         => $edata->id,
                  ];
                  return $collect_info;
        	}else{
        		$collect_info = [
                  'fbgrp_name'         => 'Fabric Of The Week',
                  'fabric_rate'        => '119' ,
                   'fabric_img_l'      => 'Jacket/Fabric/L/51.jpg',
                  'fabric_img_s'       => 'Jacket/Fabric/S/51.jpg',
                  'fabric_code'        => '41',
                  'fabric_name'        => 'Textured Light Grey',
				  'fabric_desc' 	   => 'Textured Light Grey',
                  'fabric_gid'         => '6',
                  'fabric_eid'         => '51',
                  ];
                  return $collect_info;
                    
        	}

        }else{
        	$collect_info = [
                  'fbgrp_name'         => 'Fabric Of The Week',
                  'fabric_rate'        => '119' ,
                   'fabric_img_l'      => 'Jacket/Fabric/L/51.jpg',
                  'fabric_img_s'       => 'Jacket/Fabric/S/51.jpg',
                  'fabric_code'        => '41',
                  'fabric_name'        => 'Textured Light Grey',
				  'fabric_desc' 	   => 'Textured Light Grey',
                  'fabric_gid'         => '6',
                  'fabric_eid'         => '51',
                  ];
                   return $collect_info;

        }
   }
   
 public static function get_vests_FirstInfo($id = 3)
	{
	     $frate = '';
           if($id != '')
            {
        	$fdata = FabricGroup::select('*')->where('cat_id','=',$id)->where('fabric_status','=','ACTIVE')->orderBy('id','asc')->limit(1)->first();
        	if($fdata->id){
                  //$edata = Etfabric::select('*')->where('fbgrp_id','=',$fdata->id)->whereRaw('fabric_qty > fabric_min_qty')->first();
				  $edata = Etfabric::select('*')->where('fbgrp_id','=',$fdata->id)->where('fabric_status','=','1')->whereRaw('fabric_qty > fabric_min_qty')->first();
                  if($fdata->fabric_offer_price != 0 && $fdata->fabric_offer_price != '')
                  {
                          $frate = $fdata->fabric_offer_price;
                  }else{
                  	        $frate =    $fdata->fabric_rate;
                  }
                  $collect_info = [
                  'fbgrp_name'         => $fdata->fbgrp_name,
                  'fabric_rate'        => $frate,
                  'fabric_img_l'       => $edata->fabric_img_l,
                  'fabric_img_s'       => $edata->fabric_img_s,
                  'fabric_code'        => $edata->fabric_code,
                  'fabric_name'        => $edata->fabric_name,
				  'fabric_desc'        => $edata->fabric_desc,
                  'fabric_gid'         => $fdata->id,
                  'fabric_eid'         => $edata->id,
                  ];
                  return $collect_info;
        	}else{
        		$collect_info = [
                  'fbgrp_name'         => 'Fabric Of The Week',
                  'fabric_rate'        => '79' ,
                   'fabric_img_l'      => 'Vests/Fabric/L/70.png',
                  'fabric_img_s'       => 'Vests/Fabric/S/70.png',
                  'fabric_code'        => '41',
                  'fabric_name'        => 'Textured Light Grey',
				  'fabric_desc' 	   => 'Textured Light Grey',
                  'fabric_gid'         => '11',
                  'fabric_eid'         => '78',
                  ];
                  return $collect_info;
                    
        	}

        }else{
        	$collect_info = [
                  'fbgrp_name'         => 'Fabric Of The Week',
                  'fabric_rate'        => '79' ,
                   'fabric_img_l'      => 'Vests/Fabric/L/70.png',
                  'fabric_img_s'       => 'Vests/Fabric/S/70.png',
                  'fabric_code'        => '41',
                  'fabric_name'        => 'Textured Light Grey',
				  'fabric_desc' 	   => 'Textured Light Grey',
                  'fabric_gid'         => '11',
                  'fabric_eid'         => '78',
                  ];
                   return $collect_info;

        }
   }
   
    public static function get_pants_FirstInfo($id = 4)
	{
	     $frate = '';
           if($id != '')
            {
        	$fdata = FabricGroup::select('*')->where('cat_id','=',$id)->where('fabric_status','=','ACTIVE')->orderBy('id','asc')->limit(1)->first();
        	if($fdata->id){
                  //$edata = Etfabric::select('*')->where('fbgrp_id','=',$fdata->id)->whereRaw('fabric_qty > fabric_min_qty')->first();
				  $edata = Etfabric::select('*')->where('fbgrp_id','=',$fdata->id)->where('fabric_status','=','1')->whereRaw('fabric_qty > fabric_min_qty')->first();
                  if($fdata->fabric_offer_price != 0 && $fdata->fabric_offer_price != '')
                  {
                          $frate = $fdata->fabric_offer_price;
                  }else{
                  	        $frate =    $fdata->fabric_rate;
                  }
                  $collect_info = [
                  'fbgrp_name'         => $fdata->fbgrp_name,
                  'fabric_rate'        => $frate,
                  'fabric_img_l'       => $edata->fabric_img_l,
                  'fabric_img_s'       => $edata->fabric_img_s,
                  'fabric_code'        => $edata->fabric_code,
                  'fabric_name'        => $edata->fabric_name,
				  'fabric_desc'        => $edata->fabric_desc,
                  'fabric_gid'         => $fdata->id,
                  'fabric_eid'         => $edata->id,
                  ];
                  return $collect_info;
        	}else{
        		$collect_info = [
                  'fbgrp_name'         => 'Fabric Of The Week',
                  'fabric_rate'        => '69' ,
                   'fabric_img_l'      => 'Pants/Fabric/L/97.png',
                  'fabric_img_s'       => 'Pants/Fabric/S/97.png',
                  'fabric_code'        => '41',
                  'fabric_name'        => 'Textured Light Grey',
				  'fabric_desc' 	   => 'Textured Light Grey',
                  'fabric_gid'         => '15',
                  'fabric_eid'         => '97',
                  ];
                  return $collect_info;
                    
        	}

        }else{
        	$collect_info = [
                 'fbgrp_name'         => 'Fabric Of The Week',
                  'fabric_rate'        => '69' ,
                   'fabric_img_l'      => 'Pants/Fabric/L/97.png',
                  'fabric_img_s'       => 'Pants/Fabric/S/97.png',
                  'fabric_code'        => '41',
                  'fabric_name'        => 'Textured Light Grey',
				  'fabric_desc' 	   => 'Textured Light Grey',
                  'fabric_gid'         => '15',
                  'fabric_eid'         => '97',
                  ];
                   return $collect_info;

        }
   }
   

   public static function get_standersize_value_SML($sname = null)
   {
   	  $sizedata = '';
      if($sname != ''){
    
        $ids = MeasurmentSize::select('id')->where('name','=',$sname)->first();
        $sizedata=  BodyMeasurment::select('*')->where('mer_id','=',$ids->id)->where('cat_id','=',1)->first();
        return $sizedata;

      }else{
         
        return $sizedata;
      }
   }
   
   public static function convertinch($size){
	   
	 if($size!='' || $size!=0){ 
		  $sizearr=explode("-",$size);
		  $sizcount=count($sizearr);
		  if($sizcount==1){
			  $sizeres=$size*2.54;
		  }else{
			  $a=$sizearr[0]*2.54;
			  $b=$sizearr[1]*2.54;
			  $sizeres=$a.'-'.$b;		  
		  }
		  
		  return $sizeres;
		  
	 }else{
		 
		 $sizeres='';
		 return $sizeres;
	 }
	  
	   
	   
	 }

        public static  function b2b_page_content($id=null){

         if($id != '')
         {
             $data = OthersPage::select('*')->where('id','=',$id)->where('page_id','=',4)->first();
             return $data;
         }else{
            return false;
         }
        
	 } 
	
	
}
?>