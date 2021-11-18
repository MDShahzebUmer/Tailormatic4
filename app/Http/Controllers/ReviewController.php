<?php
namespace App\Http\Controllers;
use DB;
use Session;
use View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use Validator;
use Illuminate\Http\Request;
use Redirect;
use App\Mail\Reminder;
use Illuminate\Support\Collection;
use Auth;
use App\Http\Helpers;
use App\Order;
use Mail;
use App\Mail\Invoice;
use App\OrderItem;
use App\Socialicon;
use Voyager;
use App\OrderReview;
use App\OrderReviewsImg;

class ReviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  
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
	
    public function review()
    {
	  	$data['allcount'] = OrderReview::select('id')->count();
		$data['textcount'] = OrderReview::select('id')->where('type' , '=' ,1)->where('status' , '=' ,1)->count();
		$data['imgcount'] = OrderReview::select('id')->where('type' , '=' ,2)->where('status' , '=' ,1)->count();
		$data['videocount'] = OrderReview::select('id')->where('type' , '=' ,3)->where('status' , '=' ,1)->count();
		
		
		$datarev['textrev'] = OrderReview::select('*')->where('type' , '=' ,1)->where('status' , '=' ,1)->get();
		$datarev['imgrev'] = OrderReview::select('*')->where('type' , '=' ,2)->where('status' , '=' ,1)->get();
		
		if($data['imgcount']>0){
			foreach($datarev['imgrev'] as $imgr){				
				$dataimgrev[] = OrderReviewsImg::select('*')->where('reviewid' , '=' ,$imgr->id)->first();				
			}		
			$img=1;
		}else{				
			$img=0;
			$dataimgrev=0;
		}
		
		$datarev['videorev'] = OrderReview::select('*')->where('type' , '=' ,3)->where('status' , '=' ,1)->get();
		
		if($data['videocount']>0){
			foreach($datarev['videorev'] as $videor){				
				$datavideorev[] = OrderReviewsImg::select('*')->where('reviewid' , '=' ,$videor->id)->first();				
			}		
			$video=1;
		}else{				
			$video=0;
			$datavideorev=0;
		}
		
		
		
		
		
		//$revdata = OrderReview::select('*')->get();
		
		$d = (object)array("title"=>"Customers Review");
			 //check if review already added of same order id
			 
		$soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
		return view::make('review.review')->with(compact('d','soc','datarev','data','dataimgrev','img','video','datavideorev'));	
    }
	
	
	public function addreview($orderid){
		
			
			$decryptt = Helpers::decrypt_key($orderid);
			
			
			$orderid=$decryptt;
			$orcount = OrderReview::select('orderid')->where('orderid' , '=' ,$orderid)->count();
					
			 if($orcount>0){
				 return Redirect::to('/');
			}else{
			 $d = (object)array("title"=>"Add Review");
			 //check if review already added of same order id
			 
			$soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
			return view::make('review.add-review')->with(compact('d','soc','orderid'));
			}
	}
	
	
	
	public function submitreview(Request $request){
		
			$orderid=$request->input('orderid');	
				
			$user = Order::select('user_id')->where('id' , '=' ,$orderid)->first();
			
			$data = new OrderReview;
			$data->fabric_rate = $request->input('fab');
			$data->price_rate = $request->input('price');
			$data->delivery_rate = $request->input('delivery');
			$data->fitting_rate = $request->input('fitting');
			$data->message = $request->input('message');
			$data->type = $request->input('rtype');
			$data->userid = $user->user_id;
			$data->orderid = $orderid;
			$data->save();
            $reviewid  = $data->id;
			
			if($request->input('rtype')!=1){
			$datar = new OrderReviewsImg;
			$slug_type='Review/Order';
			if($request->input('rtype')==2){
				
				$slug_type = $slug_type.'/Image';
				 if($request->file('image_fir')!= '')
    			 {			 
				$datar->image_fir = $this->save_imgone($request->file('image_fir'),$slug_type,985,656,'F'.$reviewid);
				$datar->image_fir_thumb = $this->save_imgone($request->file('image_fir'),$slug_type,100,65,'thumb-F'.$reviewid);
				 }
				 if($request->file('image_sec')!= ''){
				$datar->image_sec = $this->save_imgone($request->file('image_sec'),$slug_type,985,656,'S'.$reviewid);
				$datar->image_sec_thumb = $this->save_imgone($request->file('image_sec'),$slug_type,100,65,'thumb-S'.$reviewid);
				}
				if($request->file('image_thr')!= ''){
				$datar->image_thr = $this->save_imgone($request->file('image_thr'),$slug_type,985,656,'T'.$reviewid);
				$datar->image_thr_thumb = $this->save_imgone($request->file('image_thr'),$slug_type,100,65,'thumb-T'.$reviewid);
				}
				if($request->file('image_fou')!= ''){
				$datar->image_fou = $this->save_imgone($request->file('image_fou'),$slug_type,985,656,'FO'.$reviewid);
				$datar->image_fou_thumb = $this->save_imgone($request->file('image_fou'),$slug_type,100,65,'thumb-FO'.$reviewid);
				}
				if($request->file('image_fiv')!= ''){
				$datar->image_fiv = $this->save_imgone($request->file('image_fiv'),$slug_type,985,656,'FI'.$reviewid);
				$datar->image_fiv_thumb = $this->save_imgone($request->file('image_fiv'),$slug_type,100,65,'thumb-FI'.$reviewid);
				}				
				
			
			}else{
				$datar->video = $this->get_youtube_id_from_url($request->input('video'));
				
			}
			
			$datar->reviewid = $reviewid;
			
			$datar->save();
           
			}
			 
			
			$soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
			return view::make('thank-review')->with(compact('soc'));
	}
	//save_img($request->file('image_fir'),$slug_type,600,300,'f'.$orderid);
	public function save_imgone($file =null,$slug_type =null,$wsize='',$hsize='',$id=null)
   {
     
		if($file != '' && $slug_type != '' && $id != '')
        {
          		   
		   $fullFilename = null;
           $resizeWidth = $wsize;
           $resizeHeight = $hsize;
           $filename = $id;
         
           $fullPath = $slug_type.'/'.$filename.'.'.$file->getClientOriginalExtension();
            $ext = $file->guessClientExtension();
            if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif']))
            {
               $image = Image::make($file)
               ->resize($wsize, $hsize, function (Constraint $constraint) {
                //$constraint->aspectRatio();
                $constraint->upsize();
            }) 
               ->encode($file->getClientOriginalExtension(), 75);
                if(Storage::put(config('voyager.storage.subfolder').$fullPath, (string) $image, 'public'))
                {
                   return $fullPath;
                }
                else{
                   $status = 'Upload Fail: Unknown error occurred!'; 
                }
            }
            else{
                $status = 'Upload Fail: Unknown error occurred!';
            }

        }
        else
        {
          $status = 'Upload Fail Unknown error occurred!';
        }

     }
	 
	 
	 public function get_youtube_id_from_url($url)
	{
		if (stristr($url,'youtu.be/'))
			{preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID); return $final_ID[4]; }
		else 
			{@preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD); return $IDD[5]; }
	}
	
   

}