<?php
namespace TCG\Voyager\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Voyager;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\Permission;
use DB;
use Mail;
use App\Mail\Refund;
use App\Mail\RefundItems;
use App\Mail\StatusOrder;
use App\Mail\StatusOrderReview;
use Redirect;
use App\Etfabric;
use App\Contrast;
use App\Order;
use App\Http\Helpers;
use App\Country;
use App\State;
use App\User;
use App\OrderItem;
use App\Cancelorder;
use Excel;
use App\OrderSmss;
//use PDF;
use File;
use ZipArchive;



class CatalogManagementController extends Controller
{
 public function get_fabricmgm()
 {
   $data = Etfabric::select('*')->get();
   return view('voyager::catalog.fabricsmgm')->with(compact('data'));
 }
 public function get_contastmgm()
 {
  $data = Contrast::select('*')->get();
  return view('voyager::catalog.contrastmgm')->with(compact('data'));
}
public function get_ordersmgm()
{
  $data = Order::select('*')
  ->Where('request_status' ,'=',1)
  ->orWhere('request_status', '=', 3)
  ->orWhere('request_status', '=', 0)
  ->get();
  return view('voyager::catalog.ordermgm')->with(compact('data'));
}

public function get_orderinvoice($id=null)
{
 if($id != '')
 {
   $order = Order::select('*')->where('id','=' ,$id)->find($id);
   $orderitem = OrderItem::select('*')->where('order_id','=' ,$id)->get($id);
   $order->ship_id;
   $order->user_id;

   $shippinginfo =  Helpers::shippinginfo($order->ship_id);
   $countryname    =  Country::get_country_name($shippinginfo->scountry_id);
   $statename    =  State::get_state_name($shippinginfo->sstate);
   $uinfo        =  User::select('*')->where('id' , '=' , $order->user_id)->find($order->user_id);
              // echo '<pre>'.print_r($shippinginfo,true).'</pre>';exit();
   return view('voyager::catalog.invoice')->with(compact('shippinginfo','countryname','statename','uinfo','orderitem','order'));

 }else{
   return Redirect()->to('admin/orderrecords');
 }
} 

public function get_orderlist($id = null) { 
  $orderid = $id;
  $ckepdc  =  OrderItem::select('id')->where('check_pdf' ,'=',0)->where('order_id','=',$orderid)->count();
      
  if($ckepdc > 0)
  {

    $pdfdata  =  OrderItem::select('*')->where('check_pdf' ,'=',0)->where('order_id','=',$orderid)->get();  
    foreach ($pdfdata as  $val) {
      if($val->cat_id == 1) {
        view()->share(compact('val'));
        $pdf = \PDF::loadView('voyager::catalog.jobcardshirt');
      }else if($val->cat_id == 2){
        view()->share(compact('val'));
        $pdf = \PDF::loadView('voyager::catalog.jobcardjacket');
      }else if($val->cat_id == 3){
        view()->share(compact('val'));
        $pdf = \PDF::loadView('voyager::catalog.jobcardvests');
      }else if($val->cat_id == 4){
        view()->share(compact('val'));
        $pdf = \PDF::loadView('voyager::catalog.jobcardpants');
      }else if($val->cat_id == 18){       
        view()->share(compact('val'));
        $pdf = \PDF::loadView('voyager::catalog.jobcardthreepiece');
      }else if($val->cat_id == 19){       
        view()->share(compact('val'));
        $pdf = \PDF::loadView('voyager::catalog.jobcardtwopiece');
      }else{
        view()->share(compact('val'));
        $pdf = \PDF::loadView('voyager::catalog.jobcard-cproduct');
      }
      $path = public_path().'/storage/jobcard/'.$val->order_id;
      $pt = File::exists($path,true,false);
      if($pt != 1)
      {
        File::makeDirectory($path, 0775, true, false);
      }
      $pdf->setPaper('a4', 'landscape')->setWarnings(false)->save($path.'/'.$val->id.'-jobcard.pdf');
      $id = $val->id;
      $check_pdf_update = OrderItem::findOrFail($id);
      $check_pdf_update->check_pdf = 1;
      $check_pdf_update->save();
    }
  }else
  {

  }
         
     $test_path =   public_path().'/storage/jobcard/';
     $exitzip = $test_path.'OD'.$orderid.'.zip';
       $zet=File::exists($exitzip,true,false);
      if($zet != 1)
      {
       $zdata = OrderItem::select('id')->where('order_id','=', $orderid)->get();
     $path =   public_path().'/storage/jobcard';
     $path2 =   public_path().'/storage/jobcard/'.$orderid.'/';
     $pt = File::exists($path,true,false);
     $zipFileName = 'OD'.$orderid.'.zip';
     $zip = new ZipArchive;
      if ($zip->open($path . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) { 
           foreach ($zdata as  $zips) {   
           $zip->addFile($path2.$zips->id.'-jobcard.pdf',$zips->id.'-jobcard.pdf');
         }
           $zip->close();
       }
        

      }

  if($orderid != '')
  {
               $id = $orderid;
   //$order = Order::select('*')->where('id','=' ,$id)->find($id);
   $data = OrderItem::select('*')
                     ->orWhere('item_cancel' ,'=',1)
					 ->where('order_id','=' ,$id)
                     ->orWhere('item_cancel', '=', 3)
					 ->where('order_id','=' ,$id)
                     ->orWhere('item_cancel', '=', 0)
                     ->where('order_id','=' ,$id)
                     ->get();
   return view('voyager::catalog.orderlists')->with(compact('data','id'));
 }
 else
 {
   return Redirect()->to('admin/orderrecords');
 }
} 
public function get_orderitemview($id = null)
{
  

  if($id != '')
  {
   $catId = OrderItem::select('cat_id')->where('id', '=',  $id)->first();
   $data = OrderItem::select('*')->where('id','=' ,$id)->find($id);
   $catId->cat_id;
   switch ($catId->cat_id) {
     case '1':
       return view('voyager::catalog.ordershi')->with(compact('data'));
       break;
     case '2':
       return view('voyager::catalog.orderjac')->with(compact('data'));
       break;
     case '3':
       return view('voyager::catalog.orderves')->with(compact('data'));
       break;
     case '4':
       return view('voyager::catalog.orderpan')->with(compact('data'));
       break;
     case '18':
       return view('voyager::catalog.orderthreepiece')->with(compact('data'));
       break;
     case '19':
       return view('voyager::catalog.ordertwopiece')->with(compact('data'));
       break;

     default:
     return view('voyager::catalog.orderproduct')->with(compact('data'));
     break;
   } 
              // $data = OrderItem::select('*')->where('id','=' ,$id)->find($id);

 }
 else
 {
   return Redirect()->to('admin/order');
 }
}

public function cancel_Changestatus(Request $request)
{
 $userid = Auth::user()->id;
 $this->authorize('browse_database');
 $order_id   =  $request->order_id;
 if($order_id != '')
 {
   $ordercode = Order::select('tracking_code','id','created_at')->where('id' , '=' ,$order_id)->first($order_id);
   $id      = Cancelorder::select('user_id')->where('order_id' , '=' ,$order_id)->first($order_id);
   $id  =        $id->user_id;
   $cemail    =  User::select('email','name')->where('id' , '=' ,$id)->find($id);
   $id = $order_id;
   $reu =      Order::findOrFail($id);
   $reu->request_status = $request->request_status;
   if($reu->save())
   {

     $caol = new Cancelorder;
     $caol->user_id = $userid;
     $caol->rstatus = $request->request_status;
     if($request->request_status == 2)
     {
       $caol->reason = "Approved";
       $refu = [
       'tracking_code'  =>  $ordercode->tracking_code,
       'reason' => $caol->reason,
       'decs_reason' => $request->decs_reason,
       'name' => $cemail->name,
       'order_id'  =>  $ordercode->id,
        'sdate' => substr($ordercode->created_at, 0,10),
        'subject' => 'your orderId #'.$ordercode->id.  ' cancellation request has been Approved',
       ];

     }else if($request->request_status == 3)
     {
      $caol->reason = "Disapproved";
      $refu = [
      'tracking_code'  =>  $ordercode->tracking_code,
      'reason' => $caol->reason,
      'decs_reason' => $request->decs_reason,
      'name' => $cemail->name,
      'order_id'  =>  $ordercode->id,
        'sdate' => substr($ordercode->created_at, 0,10),
        'subject' => 'your orderId #'.$ordercode->id.' cancellation request has been Disapproved',
      ];
    }
    else
    {
      $caol->reason = "Refund";
      $refu = [
      'tracking_code'  =>  $ordercode->tracking_code,
      'order_id'  =>  $ordercode->id,
      'reason' => $caol->reason,
      'decs_reason' => $request->decs_reason,
      'name' => $cemail->name,
        'sdate' => substr($ordercode->created_at, 0,10),
        'subject' => 'Refund request confirmation for Order #'.$ordercode->id,

      ];
    }
    $caol->decs_reason = $request->decs_reason;
    $caol->order_id = $request->order_id;
    $caol->user_type = "A";
    $caol->save();
    Mail::to($cemail->email)->send(new Refund($refu))
    ? [
    'message'    => "Successfully Update Records",
    'alert-type' => 'success',
    ]
    : [
    'message'    => 'Sorry it appears there was a problem removing this',
    'alert-type' => 'danger',
    ];

    return Redirect()->to('admin/orderrecords');
  }
  else
  {
    return Redirect()->back();
  }

}else{return Redirect()->back();}


} 

public function cancel_Change_itemstatus(Request $request)
{
  $userid   = Auth::user()->id;
  $id      =  $request->id;

  /*itemcancel update*/
  $cartItm = OrderItem::findOrFail($id);
  $cartItm->item_cancel = $request->item_cancel;
  $cartItm->save();

  /*get order id*/
  $orderId = OrderItem::select('order_id','user_id','id','created_at')->where('id','=',$id)->find($id);
  /*Fetach Order Record*/
  $ort =Order::select('*')->where('id','=',$orderId->order_id)->first();
  $uemail=  User::select('email','name')->where('id','=',$orderId->user_id)->first();

  /*CancelOrder Update*/
  $canItem = new Cancelorder;
  $canItem->user_id = $orderId->user_id;
  $canItem->rstatus = $request->item_cancel;
  $canItem->user_type = 'A';
  $canItem->order_id = $orderId->order_id;
  $canItem->order_itemId = $id;
  $canItem->decs_reason = $request->decs_reason;
     //$canItem->reason = "Approved";
  if($request->item_cancel == 2)
  {
    $canItem->reason = "Approved";
    $maldata = [
    'tracking_code' => $ort->tracking_code,
    'order_id' =>  $ort->id,
    'order_itemid' => $orderId->id,
    'decs_reason' =>  $request->decs_reason,
    'reason' =>  $canItem->reason,
    'name' =>  $uemail->name,
    'sdate' => substr($orderId->created_at, 0,10),
     'subject' => 'your orderId #'.$ort->id.  ' cancellation request has been Approved',
    ]; 
  }elseif($request->item_cancel == 3){
    $canItem->reason = "Disapproved";
    $maldata = [
    'tracking_code' => $ort->tracking_code,
    'order_id' =>  $ort->id,
    'order_itemid' => $orderId->id,
    'decs_reason' =>  $request->decs_reason,
    'reason' =>  $canItem->reason,
    'name' =>  $uemail->name,
     'sdate' => substr($orderId->created_at, 0,10),
       'subject' => 'your orderId #'.$ort->id.' cancellation request has been Disapproved',
   
     
    ]; 

  }else{
    $canItem->reason = "Refund";
    $maldata = [
    'tracking_code' => $ort->tracking_code,
    'order_id' =>  $ort->id,
    'order_itemid' => $orderId->id,
    'decs_reason' =>  $request->decs_reason,
    'reason' =>  $canItem->reason,
    'name' =>  $uemail->name,
    'sdate' => substr($orderId->created_at, 0,10),
    'subject' => 'Refund request confirmation for OrderId #'.$ort->id,
  
    ]; 

  }
  $canItem->save();
  Mail::to($uemail->email)->send(new RefundItems($maldata))
  ? [
  'message'    => "Successfully Update Records",
  'alert-type' => 'success',
  ]
  : [
  'message'    => 'Sorry it appears there was a problem removing this',
  'alert-type' => 'danger',
  ];

  return Redirect()->to('admin/orderrecords');



}

public function get_changestatus(Request $request)
{
 if($request->notify == 'notify'){
   
  $id = $request->order_id;
  $sav =  Order::findOrFail($id);
  $sav->orderstatus = $request->orderstatus;
  $sav->save();

  $chstatus = Order::select('tracking_code','id')->where('id', '=', $id)->first($id);
  $udata = $this->get_user_order_email($id);
  
  if($request->orderstatus == 2){

   $mess = [
   'orderid' => $chstatus->id, 
   'tracking_code' => $chstatus->tracking_code, 
   'message' => $request->user_message,
   'name' => $udata->name,
   'status' => 2,
   'action' =>'',
   'subject' => 'Your Order #'.$chstatus->id.' has been in Processing', 
   ];
   Mail::to($udata->email)->send(new StatusOrder($mess));

 }else if($request->orderstatus == 3){
  $mess = [
  'orderid' => $request->order_id, 
  'tracking_code' => $chstatus->tracking_code, 
  'message' => $request->user_message,
  'name' => $udata->name,
   'status' => 3,
   'action' =>'',
  'subject' => 'Your Order #'.$chstatus->id.'ready to be shipped by the EtailorClothes.com',   
  ];
  Mail::to($udata->email)->send(new StatusOrder($mess));

}else if($request->orderstatus == 4){
  $mess = [
  'orderid' => $request->order_id, 
  'tracking_code' => $chstatus->tracking_code, 
  'message' => $request->user_message,
  'name' => $udata->name,
  'status' => 4,
  'action' =>'',
  'subject' =>  'Your Order #'.$chstatus->id.' is on the way',   
  ];
  Mail::to($udata->email)->send(new StatusOrder($mess));

}else if($request->orderstatus == 5){
  $mess = [
  'orderid' => $request->order_id, 
  'tracking_code' => $chstatus->tracking_code, 
  'message' => $request->user_message,
  'name' => $udata->name,
  'status' => 5,
 'action' =>'',
  'action' => Helpers::encrypt_key($request->order_id),
  'subject' => 'Your Order #'.$chstatus->id.' shipment has been delivered',  
  ];
Mail::to($udata->email)->send(new StatusOrder($mess));
}
else if($request->orderstatus == 6){
  $mess = [
  'orderid' => $request->order_id, 
  'tracking_code' => $chstatus->tracking_code, 
  'message' => $request->user_message,
  'status' => 6,
   'action' =>'',
  'name' => $udata->name,
 
  'subject' => 'Your Order #'.$chstatus->id.' item has been approved',  
  ];
Mail::to($udata->email)->send(new StatusOrder($mess));
}
else if($request->orderstatus == 7){
  $mess = [
  'orderid' => $request->order_id, 
  'tracking_code' => $chstatus->tracking_code, 
  'message' => $request->user_message,
  'status' => 7,
   'action' =>'',
  'name' => $udata->name,
 
  'subject' => 'Your Order #'.$chstatus->id.' item has been disapproved',  
  ];
  Mail::to($udata->email)->send(new StatusOrderReview($mess));

}else{
  return Redirect()->back();
 }
}else
{
    $id = $request->order_id;
    $sav =  Order::findOrFail($id);
    $sav->orderstatus = $request->orderstatus;
    $sav->save();
}
return Redirect()->back();

}

public function get_cancelprocess()
{


$idatacount=OrderItem::select('order_id')->whereIn('item_cancel',[2,4])->groupBy('order_id')->count();

if($idatacount>0){
$idata=OrderItem::select('order_id')->whereIn('item_cancel',[2,4])->groupBy('order_id')->get();

foreach($idata as $orrid){
	$ordid[]=$orrid->order_id;
}

}else{
	$ordid[]=500000000;
}


 $data = Order::select('*')
  
  ->whereIn('id',$ordid)
  ->orWhere('request_status','=',2)
  ->orWhere('request_status','=',4)
  ->get();
  
 // ->orWhere('request_status','=',2);
  
 /* echo '<pre>';
  print_r($data);
  echo '</pre>';
  
  exit();*/
  
  return view('voyager::catalog.cancelmgm')->with(compact('data')); 

/*$data=Order::whereIn('id', function($query){
    $query->select('id')
    ->from(with(new OrderItem)->getTable())
    ->whereIn('item_cancel', [2,4]);
   })
->whereIn('request_status', [2])
  ->orWhere('item_request', '=', 1)
  ->get();

  return view('voyager::catalog.cancelmgm')->with(compact('data'));*/

}

public static function get_cancelprocess_item($id)
{ 
  if($id != '')
  {   
   
   $order = Order::select('request_status')->where('id','=' ,$id)->find($id);
   
   if($order->request_status==0 ){   
   	$data = OrderItem::select('*')->where('order_id','=',$id)->whereIn('item_cancel',[2,4])->get();
   }else{
	$data = OrderItem::select('*')->where('order_id','=',$id)->get();
   }
    return view('voyager::catalog.orderlistsitem')->with(compact('data'));
  }else{
      return Redirect()->to('admin/cancelrequest');
  }
    
}

public function snd_ordersms(Request $request)
{
 $id = $request->order_id;
 $userid = Order::select('user_id')->where('id' ,'=' , $id)->find($id);
 $id =   $userid->user_id;
 $uphone   = User::select('phone','country_id')->where('id' , '=' , $id)->find($id);
 $uphone   =  Helpers::get_countphone_con($uphone);


 $sms_order = new  OrderSmss;
 $sms_order->user_id =  $id;
 $sms_order->order_id = $request->order_id;
 $sms_order->sms_text = $request->sms_message;
 $sms_order->status_sms = 0;
 $sms_order->type = 2;
 $sms_order->save();
 $id = $sms_order->id;

 /*sms code*/
 $sid = Voyager::setting('sid');
 $token = Voyager::setting('token-sms');
 $client = new \Services_Twilio($sid, $token);

 try{
   $message = $client->account->messages->sendMessage(
     Voyager::setting('sms-from'), 
     $uphone,
     $request->sms_message
     );
   $sms_status = new  OrderSmss;
   $sms_status = OrderSmss::findOrFail($id);
   $sms_status->status_sms = 1;
   $sms_status->save();


   return Redirect()->back();


 }
 catch (\Exception $e) {
  $data = $e->getMessage()
  ? [
  'message'    => "Trial accounts cannot send messages to unverified numbers",
  'alert-type' => 'success',
  ]
  : [
  'message'    => 'Sorry it appears there was a problem removing this',
  'alert-type' => 'danger',
  ];
  return Redirect()->back()->with($data);
}




}

public function get_smspromotion()
{
  return view('voyager::catalog.bulksms'); 
}
public function send_smspromotion(Request $request)
{
  if($request->city_name != '')
  {
   $data =  User::select('id','phone' ,'country_id')->where('state' ,'=' , $request->state)->Where('city', 'like', '%'.$request->city_name.'%')->get(); 
 }
 else{
  $data =  User::select('id','phone','country_id')->where('state' ,'=' , $request->state)->get();
}
         // echo $c = count($data);
          //exit();
foreach ($data as $d) {
 $ms = [
 'user_id' => $d->id,
 'type' => 1,
 'sms_text' =>  $request->sms_message,
 'status_sms' => 1,
 'created_at' => date("Y-m-d H:i:s"),
 ];
 $uphone   =  Helpers::get_countphone_con($d);
 DB::table('order_smss')->insert($ms);
 $sid = Voyager::setting('sid');
 $token = Voyager::setting('token-sms');
 $client = new \Services_Twilio($sid, $token);
 try{
   $message = $client->account->messages->sendMessage(
     Voyager::setting('sms-from'), 
     $uphone,
     $request->sms_message
     );
   continue;
 }catch (\Exception $e) {
  $data = $e->getMessage()
  ? [
  'message'    => "Trial accounts cannot send messages to unverified numbers",
  'alert-type' => 'success',
  ]
  : [
  'message'    => 'Sorry it appears there was a problem removing this',
  'alert-type' => 'danger',
  ];
  return Redirect()->back()->with($data);

}
return Redirect()->back(); 
}
}

public function del_smspromotion($id)
{
 $stylelist   = new OrderSmss;
 $stylelist   =     OrderSmss::find($id);
 $data        =     OrderSmss::destroy($id)
 ? [
 'message'    => "Successfully removed Bulk SMS  from {$stylelist->id}",
 'alert-type' => 'success',
 ]
 : [
 'message'    => 'Sorry it appears there was a problem removing this bread',
 'alert-type' => 'danger',
 ];

 if (!is_null($stylelist)) {
   Permission::removeFrom($stylelist->id);
 }

 return redirect()->back()->with($data);
}

public function get_user_order_email($id)
{
 $id = Order::select('user_id')->where('id','=' ,$id)->find($id);
 $id = $id->user_id;
 $udata =  User::select('email','name')->where('id','=',$id)->find($id);
 return $udata;
}
public function get_excel_file_data($type)
{

  if($type == 'xsl'){

    Excel::create('OrderDetails', function($excel) {
            // Set the title
      $excel->setTitle('Order Details');

            // Chain the setters
      $excel->setCreator('Me')->setCompany('');

      $excel->setDescription('');

      $xslarray = $this->create_excel_file_data();

      $excel->sheet('Sheet 1', function ($sheet) use ($xslarray) {
        $sheet->setOrientation('landscape');
        $sheet->fromArray($xslarray, NULL, 'A3');
      });

    })->download('xls');

  }elseif($type == 'csv'){

    Excel::create('OrderDetails', function($excel) {
            // Set the title
      $excel->setTitle('Order Details');

            // Chain the setters
      $excel->setCreator('Me')->setCompany('');

      $excel->setDescription('');

      $xslarray = $this->create_excel_file_data();

      $excel->sheet('Sheet 1', function ($sheet) use ($xslarray) {
        $sheet->setOrientation('landscape');
        $sheet->fromArray($xslarray, NULL, 'A3');
      });

    })->download('csv');

  }


}

public function create_excel_file_data(){

  $filedata = Order::select('*')
  ->Where('request_status' ,'=',1)
  ->orWhere('request_status', '=', 3)
  ->orWhere('request_status', '=', 0)
  ->get();
  $xslarraykey = array('Order Id','Name','Total Items','Shipping Amt.','Coupan Amt.','Purchase Date','Request Status','Order Status');                       

  foreach ($filedata as $key => $value) {

    $userinfo = User::userinfo($value->user_id);
    $name = $userinfo->name;
    $orstatus = '';
    $rstatus = '';

    switch ($value->orderstatus) {
      case 1:
      $orstatus = 'Pending';
      break;
      case 2:
      $orstatus = 'Processing';
      break;
      case 3:
      $orstatus = 'Ready to ship';
      break;
      case 4:
      $orstatus = 'On the way';
      break;
      case 5:
      $orstatus = 'Completed';
      break;
    }

    switch ($value->request_status) {
      case 1:
      $rstatus = 'Cancel';
      break;
      case 2:
      $rstatus = 'Approved';
      break;
      case 3:
      $rstatus = 'Refund';
      break;
      case 4:
      $rstatus = 'Disapproved';
      break;
    }

    $date = date('d/m/Y',strtotime($value->created_at));
    $xslarrayval = array($value->id,$name,$value->od_amount,$value->shipping_amt,$value->coupon_amt,$date,$rstatus,$orstatus);

    $xslarray[$key] = array_combine($xslarraykey, $xslarrayval);

  }

  return $xslarray;

} 

   
   public function get_jobCard_Pdf_Shirt($id)
   {

       if($id != '')
  {
   $catId = OrderItem::select('cat_id')->where('id', '=',  $id)->first();
   $data = OrderItem::select('*')->where('id','=' ,$id)->find($id);
   $catId->cat_id;
   switch ($catId->cat_id) {
     case '1':
    return view('voyager::catalog.jobcardshirt')->with(compact('data'));
     break;
     case '2':
     return view('voyager::catalog.orderjac')->with(compact('data'));
     break;
     case '3':
     return view('voyager::catalog.orderves')->with(compact('data'));
     break;
     case '4':
     return view('voyager::catalog.orderpan')->with(compact('data'));

     break;

     default:
     return view('voyager::catalog.orderproduct')->with(compact('data'));
     break;
   } 
              // $data = OrderItem::select('*')->where('id','=' ,$id)->find($id);

 }
 else
 {
   return Redirect()->to('admin/order');
 }
       //print_r($data);
      //return view('voyager::catalog.jobcardshirt')->with(compact('data'));

   }
   
   public function shirtjobcart($id = null)
	{
		 $itemdata = OrderItem::select('*')->where('id', '=',  $id)->get();
		 foreach($itemdata as $val){
		 }
		
		 return view('voyager::catalog.jobcardshirt')->with(compact('val'));
	}
  public function jacketjobcart($id = null)
	{
		 $itemdata = OrderItem::select('*')->where('id', '=',  $id)->get();
		 foreach($itemdata as $val){
		 }
		
		 return view('voyager::catalog.jobcardjacket')->with(compact('val'));
	}

}
