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
use TCG\Voyager\Models\Permission;
use DB;
use App\MainAttribute;
use App\OptionTabel;
use App\AttributeStyle;
use App\JvContrastStyle;
use App\ContrastCollar;
use Redirect;

class JVContrastController extends Controller
{
   /* public function __construct($id,)
    {
        $this->data =  "hello";
    }*/
    public function index($id =null)
    {
       
       return view('voyager::design.jv-contrastsdesign');
    }
  
   public function jvContrast($id=null,$opt=null)
    {
       
	   if ($id != '') {
       
        if($opt!='' && $opt!=''){
            $id =   $id;
            $second = $opt;
           
           }else{
            $id =   $id;
            $second='';
           
           }
        
        $data = Contrast::select('cat_id', 'contrsfab_name','id')->where('id','=',$id)->findOrFail($id);
        $cont_id  =   $data->cat_id;
        $cat_data  =   Category::findOrFail($cont_id);
        $main_id   =   MainAttribute::select('id','attribute_name')->where('cat_id','=' ,$cat_data->id)->where('parent_id' ,'=' , 0)->take(1)->skip(1)->get();
        foreach ($main_id as $m){}
        $attridata = MainAttribute::select('id','attribute_name')->where('parent_id', '=', $m->id)->first();
        if($second == ''){
       $attid = $attridata->id;
        $optdata = OptionTabel::select('id')->where('attri_id', '=', $attid)->first();
         $optdata=$optdata->id;
        
      }else{
        $optdata = $second;
      }
        
        
         $maindata  = JvContrastStyle::select('*')->where('opt_id', '=',$optdata )->where('contrast_id', '=',$id )->get();
        
        return view('voyager::design/jv-contrastsdesign')->with(compact('cat_data','attridata','m','data','optdata','maindata'));
       }
       else{
         return redirect()->back();
       }
    }
	
	public function addcontrast($contsid =Null,$optid=Null)
    {
        
		
		if($contsid != '' && $optid)
        {
          $type = '';
		    $optdata = OptionTabel::select('name')->where('id', '=', $optid)->first();
			$optdata=$optdata->name;
		  
		  
           return view('voyager::design/edit-add-jvcontrast')->with(compact('type','contsid','optid','optdata'));

        }
        else
        {
          return redirect()->back();
        }
    }
	
	public function addcontrastdata(Request $request)
    {
        
            $data = new JvContrastStyle;
            $data->opt_id = $request->input('opt_id');
            $data->contrast_id = $request->input('contrast_id');
			$data->sub_type_id = $request->input('sub_type_id');
			$data->main_type_id = $request->input('main_type_id');
			$contrsid=$request->input('contrast_id');
			$optid=$request->input('opt_id');
			
			$cat_id = $this->sluget('contrasts',$contrsid,'cat_id');
            $catname = $this->sluget('categories',$cat_id,'name');
			$opt_name= trim(str_replace(' ','', $this->sluget('option_tabels',$optid,'name')));
			
			if($data->sub_type_id!=0){
				$attristy_id = AttributeStyle::select('style_name','folder_name','id')->where('id', '=',  $data->sub_type_id)->find($data->sub_type_id);
				if($attristy_id->folder_name!=''){
					$styname='/'.$attristy_id->folder_name;
				}else{
					$styname='/'.str_replace(' ','',$attristy_id->style_name);
				}
			}else{
				$styname='';
			}
		   
			
			if($data->main_type_id!=0){
				$attri_id = $this->sluget('attribute_styles',$data->main_type_id,'attri_id');
				$mainatt_name = str_replace(' ','',$this->sluget('main_attributes',$attri_id,'attribute_name'));
							
				$attritype_id = AttributeStyle::select('style_name','folder_name','id')->where('id', '=',  $data->main_type_id)->find($data->main_type_id);
					if($attritype_id->folder_name!=''){
						$sty_typename=$attritype_id->folder_name;
					}else{
						$sty_typename=str_replace(' ','',$attritype_id->style_name);
					}	
					
				 $slug_type=$catname.'/ColorContrast/'.'Mix/'.$opt_name.'/'.$mainatt_name.'/'.$sty_typename.$styname; 					
										
			}else{
				$slug_type=$catname.'/ColorContrast/'.'Mix/'.$opt_name;
			}
			 
			
           //$slug_type=$catname.'/ColorContrast/'.'Mix/'.$opt_name.'/'.$mainatt_name.'/'.$sty_typename.$styname;
			
			if($request->file('front_img')!=''){
				$data->front_img = $this->save_img($request->file('front_img'),$slug_type.'/Front',500,$contrsid);
			}
			if($request->file('back_img')!=''){
				$data->back_img = $this->save_img($request->file('back_img'),$slug_type.'/Back',500,$contrsid);
			}
			if($request->file('join_img')!=''){
				$data->join_img = $this->save_img($request->file('join_img'),$slug_type.'/Join',500,$contrsid);
			}
      if($request->file('back_left')!=''){
        $data->back_left = $this->save_img($request->file('back_left'),$slug_type.'/BackLeft',500,$contrsid);
      }
			
			
             $data = $data->save()
             ? [
                'message'    => "Successfully  Contrasts Option Save ",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ];

       
               return Redirect::to('/admin/contrast/'.$contrsid.'/'.$optid);
              // return redirect()->back();  

             
    }
	
    public function editContrast($editid=Null)
    {
        
		
		if($editid != '')
        {
          $type = 'edit';
		   
			$maindata  = JvContrastStyle::select('*')->where('id', '=',$editid )->find($editid);
			
			$optdata = OptionTabel::select('name')->where('id', '=', $maindata->opt_id)->first();
			$optdata=$optdata->name;
			
		 
           return view('voyager::design/edit-add-jvcontrast')->with(compact('type','maindata','optdata'));

        }
        else
        {
          return redirect()->back();
        }
    }
	
	public function editcontrastdata(Request $request)
    {
        
            $data = new JvContrastStyle;
			$data= JvContrastStyle::findOrFail($request->input('id'));
            $data->opt_id = $request->input('opt_id');
            $data->contrast_id = $request->input('contrast_id');
			$data->sub_type_id = $request->input('sub_type_id');
			$data->main_type_id = $request->input('main_type_id');
			$contrsid=$request->input('contrast_id');
			$optid=$request->input('opt_id');
			
			$cat_id = $this->sluget('contrasts',$contrsid,'cat_id');
            $catname = $this->sluget('categories',$cat_id,'name');
			$opt_name= trim(str_replace(' ','', $this->sluget('option_tabels',$optid,'name')));
			
			if($data->sub_type_id!=0){
				$attristy_id = AttributeStyle::select('style_name','folder_name','id')->where('id', '=',  $data->sub_type_id)->find($data->sub_type_id);
				if($attristy_id->folder_name!=''){
					$styname='/'.$attristy_id->folder_name;
				}else{
					$styname='/'.str_replace(' ','',$attristy_id->style_name);
				}
			}else{
				$styname='';
			}
		   
			
			if($data->main_type_id!=0){
				$attri_id = $this->sluget('attribute_styles',$data->main_type_id,'attri_id');
				$mainatt_name = str_replace(' ','',$this->sluget('main_attributes',$attri_id,'attribute_name'));
							
				$attritype_id = AttributeStyle::select('style_name','folder_name','id')->where('id', '=',  $data->main_type_id)->find($data->main_type_id);
					if($attritype_id->folder_name!=''){
						$sty_typename=$attritype_id->folder_name;
					}else{
						$sty_typename=str_replace(' ','',$attritype_id->style_name);
					}	
					
				 $slug_type=$catname.'/ColorContrast/'.'Mix/'.$opt_name.'/'.$mainatt_name.'/'.$sty_typename.$styname; 					
										
			}else{
				$slug_type=$catname.'/ColorContrast/'.'Mix/'.$opt_name;
			}
			
			if($request->file('front_img')!=''){
				$data->front_img = $this->save_img($request->file('front_img'),$slug_type.'/Front',500,$contrsid);
			}
			if($request->file('back_img')!=''){
				$data->back_img = $this->save_img($request->file('back_img'),$slug_type.'/Back',500,$contrsid);
			}
			if($request->file('join_img')!=''){
				$data->join_img = $this->save_img($request->file('join_img'),$slug_type.'/Join',500,$contrsid);
			}
		     
			
             $data = $data->save()
             ? [
                'message'    => "Successfully  Contrasts Option Save ",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ];

       
               return Redirect::to('/admin/contrast/'.$contrsid.'/'.$optid);
              // return redirect()->back();  

             
    }
	 
	public function save_img($file =null,$slug_type =null,$size='',$id=null)
   {
        if($file != '' && $slug_type != '')
        {
           $fullFilename = null;
           $resizeWidth = $size;
           $resizeHeight = null;
           $filename = $id;
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
   
   
   
       public function contrastsdel($id)
    {
      $cont   = new JvContrastStyle;
        $cont = JvContrastStyle::find($id);
        $data = JvContrastStyle::destroy($id)
            ? [
                'message'    => "Successfully removed Option Contrast Imglist",
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
	
	
}