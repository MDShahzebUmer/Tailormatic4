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
use App\Contrast;
use App\FabricGroup;
use App\Etfabric;
use TCG\Voyager\Models\Permission;
use DB;

class FabricDesignController extends Controller
{
    public function index()
    {
        $etf = Etfabric::select('*')->get();
        return view('voyager::design/fabric')->with(compact('etf'));
    }
    public function fabric_create()
    {
       $type = "";
       $fgroup =DB::table('categories')
                ->join('fabric_groups', 'categories.id', '=', 'fabric_groups.cat_id')
                ->select('fabric_groups.fbgrp_name','fabric_groups.id','categories.name','categories.id as cat_id')
                ->get();
            return view('voyager::design/edit-add-fabric' ,compact('fgroup','type'));
    }
    public function fabric_post_data(Request $request)
    {

      $fabric =new  Etfabric;
      $fabric->fbgrp_id  = $request->input('fbgrp_id');
      
      foreach ($fabric->fbgrp_id as  $f) {
        $fabricSet = [
        'fbgrp_id'      => $f,
        'fabric_name' =>  $request->input(['fabric_name']),
        'fabric_code' =>  $request->input(['fabric_code']),
        'fabric_brand' =>  $request->input(['fabric_brand']),
        'fabric_thickness' =>  $request->input(['fabric_thickness']),
        'fabric_qty' =>  $request->input(['fabric_qty']),
        'fabric_min_qty' =>  $request->input(['fabric_min_qty']),
        'fabric_desc' =>  $request->input(['fabric_desc']),
        'fabric_status' => '1',
		'active_fabric' => '1',		
        'created_at' => date('y-m-d H:i:s'),
        'updated_at' => date('y-m-d H:i:s'),
        ];
                  
        $ids = DB::table('etfabrics')->insert($fabricSet);
        $ids = DB::getPdo()->lastInsertId();

        $cat_id = $this->sluget('fabric_groups',$f,'cat_id');
        $name   =   $this->sluget('categories',$cat_id,'name');
        $name   =    $name.'/'.'Fabric';
       
        $update_img = [
        'fabric_img_s' => $this->save_img($request->file('fabric_img_l'),$name.'/'.'S',130,$ids),
        'fabric_img_l' => $this->large_img($request->file('fabric_img_l'),$name.'/'.'L',436,$ids),
        'fabric_contrast_img' => $this->save_img($request->file('fabric_contrast_img'),$name.'/'.'C',200,$ids),
        'basic_img_f' =>  $this->save_img($request->file('basic_img_f'),$name.'/'.'Front',500,$ids),
        'basic_img_b' =>  $this->save_img($request->file('basic_img_b'),$name.'/'.'Back',500,$ids),
        'fabric_inside_view' =>  $this->save_img($request->file('fabric_inside_view'),$name.'/'.'InsideView',500,$ids),
        'image_in' =>  $this->save_img($request->file('image_in'),$name.'/'.'ImageIn',500,$ids),
        'coller_band' =>  $this->save_img($request->file('coller_band'),$name.'/'.'CollerBandIn',500,$ids),
        ];

        $data =  DB::table('etfabrics')
        ->where('id', $ids)
        ->update($update_img)
        ? [
        'message'    => "Successfully Insert Fabric Image",
        'alert-type' => 'success',
        ]
        : [
        'message'    => 'Sorry it appears there was a problem removing this bread',
        'alert-type' => 'danger',
        ];


      }

      return redirect()->back()->with($data);

    }
    public function fabric_edit($id=0)
    {
      if($id != '')
      {
        $type = 'edit';
        $fabricedit = Etfabric::select('*')->where('id' ,'=' , $id)->get();

        return view('voyager::design/edit-add-fabric')->with(compact('fabricedit','type'));
      }
      else{
         return $this->index();
      }
      
    }

    public function fabric_post(Request $request)
    {
        /*$l = $request->file('fabric_img_l');
        $f = $request->file('basic_img_f');
        $b = $request->file('basic_img_b');
        $c = $request->file('fabric_contrast_img');
        $vi = $request->file('fabric_inside_view');
		    $in = $request->file('image_in');*/
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
          $data->fabric_img_l = $this->large_img($request->file('fabric_img_l'),$name.'/'.'L',500,$id);
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
   /*Large Image Function*/
      public function large_img($file =null,$slug_type =null,$size='',$id=null)
   {
        if($file != '' && $slug_type != '' && $id != '')
        {
           $fullFilename = null;
           $resizeWidth = $size;
           $resizeHeight = 567;
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