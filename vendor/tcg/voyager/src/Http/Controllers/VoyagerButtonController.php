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
use App\MainAttribute;
use App\AttributeStyle;
use App\OptionContrastImglist;
use App\ButtonStyleImage;

class VoyagerButtonController extends Controller
{
     public function __construct(Request $request)
    {
        $this->con_id = $request->id;
         
    }
    public function index()
    {
        return view('voyager::index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('voyager.logout');
    }

    public function upload(Request $request)
    {
        $fullFilename = null;
        $resizeWidth = 1800;
        $resizeHeight = null;
        $slug = $request->input('type_slug');
        $file = $request->file('image');
        $filename = Str::random(20);
        $fullPath = $slug.'/'.date('F').date('Y').'/'.$filename.'.'.$file->getClientOriginalExtension();

        $ext = $file->guessClientExtension();

        if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {
            $image = Image::make($file)
            ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode($file->getClientOriginalExtension(), 75);

            // move uploaded file from temp to uploads directory
            if (Storage::put(config('voyager.storage.subfolder').$fullPath, (string) $image, 'public')) {
                $status = 'Image successfully uploaded!';
                $fullFilename = $fullPath;
            } else {
                $status = 'Upload Fail: Unknown error occurred!';
            }
        } else {
            $status = 'Upload Fail: Unsupported file format or It is too large to upload!';
        }

        // echo out script that TinyMCE can handle and update the image in the editor
        return "<script> parent.setImageValue('".Voyager::image($fullFilename)."'); </script>";
    }

    public function profile()
    {
        return view('voyager::profile');
    }
    public function buttons()
    {
      
	  // exit();
	   $buttons = Button::select('*')->get();
       return view('voyager::design/button')->with(compact('buttons'));
   }
   public function getcreate()
   {
    $type = 1;
    $cat = Category::select('id','name')->get();
    return view('voyager::design/edit-add-button')->with(compact('cat','type'));
}
public function getedit($id =0)
{
   if($id != '')
   {
    $type = 'edit';
    $butt = Button::select('*')->where('id' ,'=' , $id)->get();

    return view('voyager::design/edit-add-button')->with(compact('butt','type'));
   }
   else
   {
      return $this->buttons();
   }
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
    public function postdata(Request $request)
    {
    	
		$catval=$request->input('cat_id');
            foreach($catval as $catID){

              $catname=$this->sluget('categories',$catID,'name');
              $slug_type=$catname.'/Buttons';
              $dataSet = [
              'cat_id'      => $catID,
              'button_name' =>  $request->input(['button_name']),
			  'button_code' =>  $request->input(['button_code']),
          	  'button_status' => '1',
              'created_at' => date('y-m-d H:i:s'),
              'updated_at' => date('y-m-d H:i:s'),
              ];

              $ids = DB::table('buttons')->insert($dataSet);
              $ids = DB::getPdo()->lastInsertId();
                              
              $dataimg=[
              'button_img'=>$this->save_img($request->file('button_img'),$slug_type,60,$ids)
              ];
			  
             $data =  DB::table('buttons')
              ->where('id', $ids)
              ->update($dataimg);
			  
        }
         
     
        return Redirect::to('/admin/button/');

             
    }
   public function editpostdata(Request $request)
   {
        $file = $request->file('button_img');
        
              
              $cont   = new Button;
              $cont = Button::findOrFail($request->input('id'));
              $cont->cat_id  = $request->input('cat_id');
			  $cont->button_name  = $request->input('button_name');
			  $cont->button_code  = $request->input('button_code');
              $catname=$this->sluget('categories',$cont->cat_id,'name');
			  
			  $oldimg=$cont->button_img;
			  $oldcatid=$request->input('catId');
			  $newcatid=$request->input('cat_id');
			  
			  
			  
              $slug_type=$catname;
              if($file != ''){
               $cont->button_img = $this->save_img($request->file('button_img'),$slug_type,60,$request->input('id'));
			   
               }elseif($newcatid!=$oldcatid){
				   
			  	$cont->button_img = $this->imgRename($oldimg,'Buttons',$slug_type);	
			   
			   }
              $data = $cont->save()
              ? [
                'message'    => "Successfully Update Records",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this',
                'alert-type' => 'danger',
            ];
              return Redirect::to('/admin/button/');
        
   }
   public function deleteButton($id)
    {
      $this->authorize('browse_database');

        /** @var \TCG\Voyager\Models\DataType $dataType */
		DB::table('button_style_images')->where('but_id', '=', $id)->delete();
		
		
        $cont   = new Button;
        $cont = Button::find($id);
        $data = Button::destroy($id)
            ? [
                'message'    => "Successfully removed Contrasts  from {$cont->button_name}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ];

       

        return redirect()->back()->with($data);      
    }

    public function buttstyle_view($id=null)
    {
       
       if ($id != '') {
        $ex =  explode('-', $id);
        if(count($ex)>1){
            $id =   $ex[0];
            $second = $ex[1];
           
           }else{
            $id =   $id;
            $second='';
           
           }
        
       $data = Button::select('cat_id', 'button_name','id')->where('id','=',$id)->findOrFail($id);
       $cat_id  =   $data->cat_id;
	  
        $cat_data  =   Category::findOrFail($cat_id);
       if($second == ''){
        $attriall = MainAttribute::select('id','attribute_name')->where('cat_id', '=', $cat_id)->where('buttons_status', '=', 1)->first();
		$attridata=$attriall->id;
		       
      }else{
        $attridata = $second;
      }        
        $buttnstyle = ButtonStyleImage::select('*')->where('but_id', '=', $id)->where('attri_id', '=', $attridata)->get(); 
		
        return view('voyager::design/buttonstyle')->with(compact('data','cat_data','attridata','buttnstyle'));
       }
       else{
         return redirect()->back();
       }
    }
    public function buttstyle_create($id =Null,$ids=Null)
    {
        
		if($id != '' && $ids)
        {
          $type = 1;
		  $attriall = MainAttribute::select('cat_id','id','attribute_name')->where('id', '=', $ids)->where('buttons_status', '=', 1)->first();
		  
		  if($attriall->cat_id==1 && $ids==4){
			  $name='Epaulettes';
		  }else{
			  $name=$attriall->attribute_name;
		  }
		  
           return view('voyager::design/edit-add-buttonstyle')->with(compact('type','ids','id','name'));

        }
        else
        {
          return redirect()->back();
        }
    }
    public function buttstyle_create_add(Request $request,$id,$ids)
    {
         
		 if($id != '' && $ids != '')
         {
              
            $data = new ButtonStyleImage;
            $data->attri_sty_id = $request->input('style_id');          
            $data->but_id = $request->input('but_id');            
            $data->attri_id = $request->input('attri_id');
			//$stylename=$this->sluget('attribute_styles',$data->attri_sty_id,'style_name');
			//$stltype= trim(str_replace(' ', '', $stylename));
			$cat_id=$this->sluget('main_attributes',$data->attri_id,'cat_id');
			$attname=trim(str_replace(' ', '', $this->sluget('main_attributes',$data->attri_id,'attribute_name')));
			
			$catname=$this->sluget('categories',$cat_id,'name');
			
			$attristy_id = AttributeStyle::select('style_name','folder_name','id')->where('id', '=',  $data->attri_sty_id)->find($data->attri_sty_id);
			if($attristy_id->folder_name!=''){
				$stltype= $attristy_id->folder_name;
			}else{
				$stltype= str_replace(' ','',$attristy_id->style_name);
			}
	        $slug_type=$catname.'/Style/'.$attname.'/'.$stltype.'/Button';
			
			 if($request->file('button_list_img')) {
				 $data->button_list_img = $this->save_img($request->file('button_list_img'),$slug_type.'/ListImg',1000,$data->but_id);
			 }
			 if($request->file('button_show_img')) {
				 $data->button_show_img = $this->save_img($request->file('button_show_img'),$slug_type.'/ShowImg',1000,$data->but_id);
			 }
			 if($request->file('button_contrast_img')) {
				 $data->button_contrast_img = $this->save_img($request->file('button_contrast_img'),$slug_type.'/ContrastImg',1000,$data->but_id);
			 }
       if($request->file('main_img')) {
         $data->main_img = $this->save_img($request->file('main_img'),$slug_type.'/MainImg',1000,$data->but_id);
       }
       if($request->file('epaulettes_button')) {
         $data->epaulettes_button = $this->save_img($request->file('epaulettes_button'),$slug_type.'/EpaulettesButton',1000,$data->but_id);
       }
       if($request->file('pocket_one_button')) {
         $data->pocket_one_button = $this->save_img($request->file('pocket_one_button'),$slug_type.'/PocketOneButton',1000,$data->but_id);
       }
       if($request->file('pocket_two_button')) {
         $data->pocket_two_button = $this->save_img($request->file('pocket_two_button'),$slug_type.'/PocketTwoButton',1000,$data->but_id);
       }
	    if($request->file('left_img')) {
         $data->left_img = $this->save_img($request->file('left_img'),$slug_type.'/LeftImg',1000,$data->but_id);
       }
	   if($request->file('right_img')) {
         $data->right_img = $this->save_img($request->file('right_img'),$slug_type.'/RightImg',1000,$data->but_id);
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
            // return redirect()->back()->with($data);
			 return Redirect::to('/admin/button/style/'.$request->input('but_id').'-'.$request->input('attri_id'));
            

         }
         else
         {
          return redirect()->back();
         }
    }

    public function buttstyle_edit($id = null)
    {

        if($id != '')
        {
            $type='';
             $maindata  = ButtonStyleImage::select('*')->where('id', '=',$id )->get();
             return view('voyager::design/edit-add-buttonstyle')->with(compact('maindata','type'));
        }
        else
        {
          return redirect()->back();
        }
    }
    public function buttstyle_create_edit(Request $request)
    {
           $data = new ButtonStyleImage;
           $data= ButtonStyleImage::findOrFail($request->input('id'));
           $data->attri_sty_id = $request->input('style_id');          
            
			//$stylename=$this->sluget('attribute_styles',$data->attri_sty_id,'style_name');
			
			//$stltype= trim(str_replace(' ', '', $stylename));
			$cat_id=$this->sluget('main_attributes',$request->input('attri_id'),'cat_id');
			$attn=trim($this->sluget('main_attributes',$request->input('attri_id'),'attribute_name'));
			$attname=str_replace(' ','',$attn);
			
			$catname=$this->sluget('categories',$cat_id,'name');
			
			$attristy_id = AttributeStyle::select('style_name','folder_name','id')->where('id', '=',  $data->attri_sty_id)->find($data->attri_sty_id);
			if($attristy_id->folder_name!=''){
				$stltype= $attristy_id->folder_name;
			}else{
				$stltype= str_replace(' ','',$attristy_id->style_name);
			}
			
            $slug_type=$catname.'/Style/'.$attname.'/'.$stltype.'/Button';
			
			 if($request->file('button_list_img')) {
				 $data->button_list_img = $this->save_img($request->file('button_list_img'),$slug_type.'/ListImg',1000,$data->but_id);
			 }
			 if($request->file('button_show_img')) {
				 $data->button_show_img = $this->save_img($request->file('button_show_img'),$slug_type.'/ShowImg',1000,$data->but_id);
			 }
			 if($request->file('button_contrast_img')) {
				 $data->button_contrast_img = $this->save_img($request->file('button_contrast_img'),$slug_type.'/ContrastImg',1000,$data->but_id);
			 }
       if($request->file('main_img')) {
         $data->main_img = $this->save_img($request->file('main_img'),$slug_type.'/MainImg',1000,$data->but_id);
       }
       if($request->file('epaulettes_button')) {
         $data->epaulettes_button = $this->save_img($request->file('epaulettes_button'),$slug_type.'/EpaulettesButton',1000,$data->but_id);
       }
       if($request->file('pocket_one_button')) {
         $data->pocket_one_button = $this->save_img($request->file('pocket_one_button'),$slug_type.'/PocketOneButton',1000,$data->but_id);
       }
       if($request->file('pocket_two_button')) {
         $data->pocket_two_button = $this->save_img($request->file('pocket_two_button'),$slug_type.'/PocketTwoButton',1000,$data->but_id);
       }
	   if($request->file('left_img')) {
         $data->left_img = $this->save_img($request->file('left_img'),$slug_type.'/LeftImg',1000,$data->but_id);
       }
	   
	    if($request->file('right_img')) {
         $data->right_img = $this->save_img($request->file('right_img'),$slug_type.'/RightImg',1000,$data->but_id);
       }
             //exit();
             $data = $data->save()

             ? [
                'message'    => "Successfully  Contrasts Option Save ",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ];
             return Redirect::to('/admin/button/style/'.$request->input('but_id').'-'.$request->input('attri_id'));
            
    }
    public function buttstyle_deleteButton($id)
    {
      	 $cont   = new ButtonStyleImage;
        $cont = ButtonStyleImage::find($id);
        $data = ButtonStyleImage::destroy($id)
            ? [
                'message'    => "Successfully removed Contrasts  from list",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ];

        if (!is_null($cont)) {
            Permission::removeFrom($cont->contrsfab_name);
        }

        return redirect()->back()->with($data);
    }

    public function sluget($table,$id,$fieldname){

     $slugname = DB::table($table)->where('id','=',$id)->value($fieldname);  
      return $slugname;
    }
	
	 public function imgRename($oldfront,$slug,$slug_type){
			$imgg=explode('/',$oldfront);
			$tt=count($imgg)-1;				 
			$newpath=$slug_type.'/'.$slug.'/'.$imgg[$tt];				 
			rename(base_path() . '/public/storage/'.$oldfront, base_path() .'/public/storage/'.$newpath);	
				
			 return $newpath;
		 }


}
