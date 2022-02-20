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
use App\MeasurmentVideo;
use TCG\Voyager\Models\Permission;
use DB;


class MeasurmentController extends Controller
{
    public function index()
    {
       
    }
	public function measurment()
	{
	 $measurment = MeasurmentVideo::select('*')->get();	
			
        return view('voyager::design/measurmentvideo')->with(compact('measurment'));
	}
	
    public function addmeasurmentvideo()	
    {
       
	   $type = "";
      
            return view('voyager::design/edit-add-measurmentvideo' ,compact('type'));
    }
    public function addvideodata(Request $request)
    {

      $stylelist =new  MeasurmentVideo;
      $stylelist->fbgrp_id  = $request->input('fbgrp_id');
      
      if($request->file('front_img')!=''){
				$data->front_img = $this->save_img($request->file('front_img'),$slug_type.'/Front',500,$contrsid);
			}
			
	    $stylelist->save();

      return redirect()->back()->with($data);

    }
    public function editvideodata($id=0)
    {
      if($id != '')
      {
        $type = 'edit';
        $measuredit = MeasurmentVideo::select('*')->where('id' ,'=' , $id)->get();

        return view('voyager::design/edit-add-measurmentvideo')->with(compact('measuredit','type'));
      }
      else{
         return $this->index();
      }
      
    }

    public function fabric_post(Request $request)
    {
        
        $id = $request->input('id');
        $fbgrp_id = $request->input('fbgrp_id');
        $cat_id = $this->sluget('fabric_groups',$fbgrp_id,'cat_id');
        $name   =   $this->sluget('categories',$cat_id,'name');
        $name   =    $name.'/'.'Fabric';
        $data = new Etfabric;
        $data =     Etfabric::findOrFail($request->input('id'));
        $data->fabric_name  = $request->input('fabric_name');
        $data->fabric_code  = $request->input('fabric_code');
        $data->fabric_brand  = $request->input('fabric_brand');
        $data->fabric_thickness  = $request->input('fabric_thickness');
        $data->fabric_qty  = $request->input('fabric_qty');
        $data->fabric_min_qty  = $request->input('fabric_min_qty');
        $data->fabric_desc  = $request->input('fabric_desc');
        if($request->file('fabric_img_l') != '')
        {
          $data->fabric_img_s = $this->save_img($request->file('fabric_img_l'),$name.'/'.'S',130,$id);
          $data->fabric_img_l = $this->save_img($request->file('fabric_img_l'),$name.'/'.'L',500,$id);
        }
        if($request->file('basic_img_f') != '')
        {
          $data->basic_img_f =  $this->save_img($request->file('basic_img_f'),$name.'/'.'Front',500,$id);
        
        }
        if($request->file('basic_img_b') != '')
        {
          $data->basic_img_b =  $this->save_img($request->file('basic_img_b'),$name.'/'.'Back',500,$id);
        }
        if($request->file('fabric_contrast_img') != '')
        {
          $data->fabric_contrast_img =  $this->save_img($request->file('fabric_contrast_img'),$name.'/'.'C',500,$id);
        }
		    if($request->file('fabric_inside_view') != '')
        {
          $data->fabric_inside_view =  $this->save_img($request->file('fabric_inside_view'),$name.'/'.'InsideView',500,$id);
        }
        if($request->file('image_in') != '')
        {
          $data->image_in =  $this->save_img($request->file('image_in'),$name.'/'.'ImageIn',500,$id);
        }
        if($request->file('coller_band') != '')
        {
          $data->coller_band =  $this->save_img($request->file('coller_band'),$name.'/'.'CollerBandIn',500,$id);
        }
         $data= $data->save()
         ? [
        'message'    => "Update Successfully Fabric data",
        'alert-type' => 'Success',
        ]
        : [
        'message'    => 'Sorry it appears there was a problem removing this ',
        'alert-type' => 'Danger',
        ];
        return redirect()->back()->with($data);


       
    }

 
   public function save_img($file =null,$slug_type =null,$size='',$id=null)
   {
        if($file != '' && $slug_type != '' && $id != '')
        {
           $fullFilename = null;
           $resizeWidth = $size;
           $resizeHeight = null;
           $filename = trim($id);
         
           $fullPath = $slug_type.'/'.$filename.'.'.$file->getClientOriginalExtension();
            $ext = $file->guessClientExtension();
            if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif']))
            {
               $image = Image::make($file)
               ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                $constraint->aspectRatio();
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
          $status = 'Upload Fail: Unknown error occurred!';
        }

   }
    
    

    public function sluget($table,$id,$fieldname){

      echo $slugname = DB::table($table)->where('id','=',$id)->value($fieldname);
      //exit();

      return $slugname;
    }

}
