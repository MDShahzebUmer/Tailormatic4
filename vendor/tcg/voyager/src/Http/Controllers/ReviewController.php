<?php

namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Voyager;
use TCG\Voyager\Models\Category;
use App\Button;
use TCG\Voyager\Models\Permission;
use DB;
use App\Order;
use App\OrderReviewsImg;
use App\OrderReview;

class ReviewController extends Controller
{
     public function __construct(Request $request)
    {
        $this->con_id = $request->id;
         
    }
    public function index()
    {
        return view('voyager::index');
    }
   
    public function review()
    {      
	  $reviewdata = OrderReview::select('*')->get();
       return view('voyager::review/review')->with(compact('reviewdata'));
   }
   
   public function reviewcreate()
   {
		$type = 1;
		
		return view('voyager::review/edit-add-review')->with(compact('type'));
	}
	
	 public function reviewadd(Request $request)
   	{
		$type = 1;
		
		
		$data = new OrderReview;
			$data->fabric_rate = $request->input('fabric_rate');
			$data->price_rate = $request->input('price_rate');
			$data->delivery_rate = $request->input('delivery_rate');
			$data->fitting_rate = $request->input('fitting_rate');
			$data->message = $request->input('message');
			$data->type = $request->input('rtype');
                        $data->user_name = $request->input('user_name');
			$data->country_id = $request->input('country_id');
			$data->status = $request->input('status');				
			$data->save();
            $reviewid  = $data->id;
			
			if($request->input('rtype')!=1){
			$datar = new OrderReviewsImg;
			$slug_type='Review/Order';
			if($request->input('rtype')==2){
				
				$slug_type = $slug_type.'/Image';
				 if($request->file('image_fir')!= '')
    			 {			 
				$datar->image_fir = $this->save_imgone($request->file('image_fir'),$slug_type,600,300,'F'.$reviewid);
				$datar->image_fir_thumb = $this->save_imgone($request->file('image_fir'),$slug_type,60,30,'thumb-F'.$reviewid);
				 }
				 if($request->file('image_sec')!= ''){
				$datar->image_sec = $this->save_imgone($request->file('image_sec'),$slug_type,600,300,'S'.$reviewid);
				$datar->image_sec_thumb = $this->save_imgone($request->file('image_sec'),$slug_type,60,30,'thumb-S'.$reviewid);
				}
				if($request->file('image_thr')!= ''){
				$datar->image_thr = $this->save_imgone($request->file('image_thr'),$slug_type,600,300,'T'.$reviewid);
				$datar->image_thr_thumb = $this->save_imgone($request->file('image_thr'),$slug_type,60,30,'thumb-T'.$reviewid);
				}
				if($request->file('image_fou')!= ''){
				$datar->image_fou = $this->save_imgone($request->file('image_fou'),$slug_type,600,300,'FO'.$reviewid);
				$datar->image_fou_thumb = $this->save_imgone($request->file('image_fou'),$slug_type,60,30,'thumb-FO'.$reviewid);
				}
				if($request->file('image_fiv')!= ''){
				$datar->image_fiv = $this->save_imgone($request->file('image_fiv'),$slug_type,600,300,'FI'.$reviewid);
				$datar->image_fiv_thumb = $this->save_imgone($request->file('image_fiv'),$slug_type,60,30,'thumb-FI'.$reviewid);
				}				
				
			
			}else{
				$datar->video = $this->get_youtube_id_from_url($request->input('video'));
				
			}
			
			$datar->reviewid = $reviewid;
			
			$datar->save();
           
			}
		
		
		$reviewdata = OrderReview::select('*')->get();
       return view('voyager::review/review')->with(compact('reviewdata'));
	}
	
	
	
	public function reviewedit($id =0)
	{
	   if($id != '')
	   {
		$type = 'edit';
		$reviewdata = OrderReview::select('*')->where('id' ,'=' , $id)->get();
		
		$reviewimg = OrderReviewsImg::select('*')->where('reviewid' ,'=' , $id)->count();
		
		if($reviewimg!=0){
			$reviewimgdata = OrderReviewsImg::select('*')->where('reviewid' ,'=' , $id)->get();
		}else{
			$reviewimgdata='';
		}		
	
		return view('voyager::review/edit-add-review')->with(compact('reviewdata','type','reviewimgdata'));
	   }
	   else
	   {
		  return $this->review();
	   }
	 }
   
   
   public function revieweditsubmit(Request $request)
   {
               
              
			$data   = new OrderReview;
			$data = OrderReview::findOrFail($request->input('id'));
			$data->fabric_rate = $request->input('fabric_rate');
			$data->price_rate = $request->input('price_rate');
			$data->delivery_rate = $request->input('delivery_rate');
			$data->fitting_rate = $request->input('fitting_rate');
			$data->message = $request->input('message');
			$data->type = $request->input('rtype');
                         $data->user_name = $request->input('user_name');
			$data->country_id = $request->input('country_id');
			$data->status = $request->input('status');				
			$data->save();
			
			$reviewid=$request->input('id');
			
			if($request->input('rtype')!=1){
			$datar = new OrderReviewsImg;
			$datar = OrderReviewsImg::findOrFail($request->input('reimgid'));
			$slug_type='Review/Order';
			if($request->input('rtype')==2){
				
				$slug_type = $slug_type.'/Image';
				 if($request->file('image_fir')!= '')
    			 {			 
					//$del=$this->imgpredelete($request->input('reimgid'),'image_fir');
					
					$datar->image_fir = $this->save_imgone($request->file('image_fir'),$slug_type,600,300,'F'.$reviewid);
					$datar->image_fir_thumb = $this->save_imgone($request->file('image_fir'),$slug_type,60,30,'thumb-F'.$reviewid);
				 }
				 if($request->file('image_sec')!= ''){
					$datar->image_sec = $this->save_imgone($request->file('image_sec'),$slug_type,600,300,'S'.$reviewid);
					$datar->image_sec_thumb = $this->save_imgone($request->file('image_sec'),$slug_type,60,30,'thumb-S'.$reviewid);
				}
				if($request->file('image_thr')!= ''){
					$datar->image_thr = $this->save_imgone($request->file('image_thr'),$slug_type,600,300,'T'.$reviewid);
					$datar->image_thr_thumb = $this->save_imgone($request->file('image_thr'),$slug_type,60,30,'thumb-T'.$reviewid);
				}
				if($request->file('image_fou')!= ''){
					$datar->image_fou = $this->save_imgone($request->file('image_fou'),$slug_type,600,300,'FO'.$reviewid);
					$datar->image_fou_thumb = $this->save_imgone($request->file('image_fou'),$slug_type,60,30,'thumb-FO'.$reviewid);
				}
				if($request->file('image_fiv')!= ''){
					$datar->image_fiv = $this->save_imgone($request->file('image_fiv'),$slug_type,600,300,'FI'.$reviewid);
					$datar->image_fiv_thumb = $this->save_imgone($request->file('image_fiv'),$slug_type,60,30,'thumb-FI'.$reviewid);
				}				
				
			
			}else{
				$datar->video = $this->get_youtube_id_from_url($request->input('video'));
				
			}
			
			
			
			$datar->save();
           
			}
	        
             $reviewdata = OrderReview::select('*')->get();
       		return view('voyager::review/review')->with(compact('reviewdata'));
        
   }
   public function deleteButton($id)
    {
        $this->authorize('browse_database');

        /** @var \TCG\Voyager\Models\DataType $dataType */
		
		
		$reviewdata = OrderReview::select('*')->where('id' ,'=' , $id)->first();
		
		if($reviewdata->type==2){
		
			$reviewimgdata = OrderReviewsImg::select('*')->where('reviewid' ,'=' , $id)->first();
		
			$first=$this->imgpredelete($reviewimgdata->image_fir);
			$first_thumb=$this->imgpredelete($reviewimgdata->image_fir_thumb);
			$second=$this->imgpredelete($reviewimgdata->image_sec);
			$second_thumb=$this->imgpredelete($reviewimgdata->image_sec_thumb);
			$third=$this->imgpredelete($reviewimgdata->image_thr);
			$third_thumb=$this->imgpredelete($reviewimgdata->image_thr_thumb);
			$fourth=$this->imgpredelete($reviewimgdata->image_fou);
			$fourth_thumb=$this->imgpredelete($reviewimgdata->image_fou_thumb);
			$five=$this->imgpredelete($reviewimgdata->image_fiv);
			$five_thumb=$this->imgpredelete($reviewimgdata->image_fiv_thumb);		
		
		}
		if($reviewdata->type==2 || $reviewdata->type==3){
		DB::table('order_reviews_imgs')->where('reviewid', '=', $id)->delete();
		
		}
		
		
        $cont   = new OrderReview;
        $cont = OrderReview::find($id);
        $data = OrderReview::destroy($id)
            ? [
                'message'    => "Successfully removed Review  from Review table",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ];

        return redirect()->back()->with($data);      
    }

  
  


    public function sluget($table,$id,$fieldname){

      $slugname = DB::table($table)->where('id','=',$id)->value($fieldname);  
      return $slugname;
    }
	
	 public function imgRename($oldfront,$slug,$slug_type)
	 {
			$imgg=explode('/',$oldfront);
			$tt=count($imgg)-1;				 
			$newpath=$slug_type.'/'.$slug.'/'.$imgg[$tt];				 
			rename(base_path() . '/public/storage/'.$oldfront, base_path() .'/public/storage/'.$newpath);					
			 return $newpath;
	 }
		 
		 

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
			
			public static function imgpredelete($url)
			{
							
				$path=public_path().'/storage/'.$url;
				
				if(file_exists($path)){
					@unlink($path);
				}			
				
		
			}
}
