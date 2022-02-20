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
use App\Thread;
use Redirect;
use App\ThreadStyleImage;
use App\MainAttribute;
use App\AttributeStyle;
use App\OptionContrastImglist;

//use App\OptionTabel;
//use App\Etfabric;
//use App\OptionContrastImglist;

class ThreadDesignController extends Controller
{
    /* public function __construct(Request $request)
    {
        $this->con_id = $request->id;
         
    }*/
    public function threads()
    {
      $threads = Thread::select('*')->get();
      return view('voyager::design/thread')->with(compact('threads'));
    }
    public function getcreate()
    {
      $type = 1;
      $cat = Category::select('id','name')->get();
      return view('voyager::design/edit-add-thread')->with(compact('cat','type'));
    }
    public function postdata(Request $request)
  {
            print_r($_POST);exit();
        $catval=$request->input('cat_id');
        foreach($catval as $catID){

      $catname=$this->sluget('categories',$catID,'name');
      $slug_type=$catname.'/Threads';
      $dataSet = [
      'cat_id'      => $catID,
      'thrd_name' =>  $request->input(['thrd_name']),
      'thread_code' =>  $request->input(['thread_code']),
      'thread_color' =>  $request->input(['thread_color']),
      'created_at' => date('y-m-d H:i:s'),
      'updated_at' => date('y-m-d H:i:s'),
      ];

      $ids = DB::table('threads')->insert($dataSet);
      $ids = DB::getPdo()->lastInsertId();

      $dataimg=[
      'thrd_img'=>$this->save_img($request->file('thrd_img'),$slug_type.'/T',23,$ids),
      'thrd_hole_vertical'=>$this->save_img($request->file('thrd_hole_vertical'),$slug_type.'/V',94,$ids),
      'thrd_hole_horizontal'=>$this->save_img($request->file('thrd_hole_horizontal'),$slug_type.'/H',94,$ids),
      'thrd_hole_slanted'=>$this->save_img($request->file('thrd_hole_slanted'),$slug_type.'/S',94,$ids),
      'thrd_cross'=>$this->save_img($request->file('thrd_cross'),$slug_type.'/C',94,$ids)
      ];

      $data =  DB::table('threads')
      ->where('id', $ids)
      ->update($dataimg);
    }
      return redirect()->back();
    }
    /*Edit Thread*/
    public function getedit($id =null)
    {

     if($id != '')
     {
      $type = 'edit';
      $thred = Thread::select('*')->where('id' ,'=' , $id)->get();

      return view('voyager::design/edit-add-thread')->with(compact('thred','type'));

    }
    else
    {
      return $this->threads();
    }
  }

    public function editpostdata(Request $request)
   {
       
       
        $t = $request->file('thrd_img');
        $v = $request->file('thrd_hole_vertical');
        $h = $request->file('thrd_hole_horizontal');
        $s = $request->file('thrd_hole_slanted');
        $c = $request->file('thrd_cross');
        
        $th   = new Thread;
        $th = Thread::findOrFail($request->input('id'));
        $th->cat_id  = $request->input('cat_id');
        $th->thrd_name  = $request->input('thrd_name');
        $th->thread_code  = $request->input('thread_code');
        $th->thread_color  = $request->input('thread_color');
        $catname=$this->sluget('categories',$th->cat_id,'name');
        $slug_type=$catname.'/Threads';
        if($t != ''){
            $th->thrd_img = $this->save_img($request->file('thrd_img'),$slug_type.'/T',23,$request->input('id'));
          }
        if($v != ''){
            $th->thrd_hole_vertical = $this->save_img($request->file('thrd_hole_vertical'),$slug_type.'/V', 94, $request->input('id'));
          }
        if($h != ''){
          $th->thrd_hole_horizontal = $this->save_img($request->file('thrd_hole_horizontal'),$slug_type.'/H',94,$request->input('id'));
        }
        if($s != ''){
          $th->thrd_hole_slanted = $this->save_img($request->file('thrd_hole_slanted'),$slug_type.'/S',94,$request->input('id'));
        }
        if($c != ''){
          $th->thrd_cross = $this->save_img($request->file('thrd_cross'),$slug_type.'/C',94,$request->input('id'));
          }
            $data = $th->save()
              ? [
                'message'    => "Successfully Update Records",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this',
                'alert-type' => 'danger',
            ];
              return Redirect::to('/admin/thread/');
        
   }
   public function deletethread($id)
   {
    $this->authorize('browse_database');

        /** @var \TCG\Voyager\Models\DataType $dataType */
    DB::table('thread _style_images')->where('thrd_id', '=', $id)->delete();
    
    
        $cont   = new Thread;
        $cont = Thread::find($id);
        $data = Thread::destroy($id)
            ? [
                'message'    => "Successfully removed Contrasts  from {$cont->thrd_name}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing',
                'alert-type' => 'danger',
            ];

       

        return redirect()->back()->with($data);      
    }

   public function thread_style_view($id=null)
   {
     //threadstyle
    if ($id != '') {
      $ex =  explode('-', $id);
      if(count($ex)>1){
        $id =   $ex[0];
        $second = $ex[1];

      }else{
        $id =   $id;
        $second='';
      }

      $data = Thread::select('cat_id', 'thrd_name','id')->where('id','=',$id)->findOrFail($id);
      $cat_id  =   $data->cat_id;
      $cat_data  =   Category::findOrFail($cat_id);

      if($second == '')
      {
        $attriall = MainAttribute::select('id','attribute_name')->where('cat_id', '=', $cat_id)->where('thread_status', '=', 1)->first();
       
      $attridata = $attriall->id;
       }else{
        $attridata = $second;
      
      } 
       $thread_style = ThreadStyleImage::select('*')->where('thrd_id', '=', $id)->where('attri_id', '=', $attridata)->get(); 
        return view('voyager::design/threadstyle')->with(compact('data','cat_data','attridata','thread_style'));
    }
    else{
     return redirect()->back();
   }

   }

    public function thread_style_create($id = Null,$ids = Null)
    {

      if($id !='' && $ids != '')
      {
          $type = 1;
          $attriall = MainAttribute::select('cat_id','id','attribute_name')->where('id', '=', $ids)->where('thread_status', '=', 1)->first();
          if($attriall->cat_id == 1  && $ids == 4){
            $name='Epaulettes';
          }else{
            $name=$attriall->attribute_name;
          }
          return view('voyager::design/edit-add-threadstyle')->with(compact('type','ids','id','name'));

      }
      else
      {
         return redirect()->back();
      }
    }

    public function thread_style_create_add(Request $request,$id,$ids)
    {
       if($id != '' && $ids != '')
         {
              
          $data = new ThreadStyleImage;
          $data->attri_sty_id = $request->input('attri_sty_id');      
          $data->thrd_id = $request->input('thrd_id');            
          $data->attri_id = $request->input('attri_id');
          $cat_id=$this->sluget('main_attributes',$data->attri_id,'cat_id');
		  $attn=$this->sluget('main_attributes',$data->attri_id,'attribute_name');
          $attname=trim(str_replace(' ','',$attn));
			//$stylename=$this->sluget('attribute_styles',$data->attri_sty_id,'style_name');
			//$stltype= trim(str_replace(' ', '', $stylename));
			$attristy_id = AttributeStyle::select('style_name','folder_name','id')->where('id', '=',  $data->attri_sty_id)->find($data->attri_sty_id);
				if($attristy_id->folder_name!=''){
					$stltype= $attristy_id->folder_name;
				}else{
					$stltype= str_replace(' ','',$attristy_id->style_name);
				}

          $catname=$this->sluget('categories',$cat_id,'name');
        $slug_type=$catname.'/Style/'.$attname.'/'.$stltype.'/Thread';
           
          if($request->file('thrd_list_img')) {
           $data->thrd_list_img = $this->save_img($request->file('thrd_list_img'),$slug_type.'/ListImg',1000,$data->thrd_id);
         }
         if($request->file('thrd_show_img')) {
           $data->thrd_show_img = $this->save_img($request->file('thrd_show_img'),$slug_type.'/ShowImg',1000,$data->thrd_id);
         }
         if($request->file('thrd_contrast_img')) {
           $data->thrd_contrast_img = $this->save_img($request->file('thrd_contrast_img'),$slug_type.'/ContrastImg',1000,$data->thrd_id);
         }
         if($request->file('thread_v_img')) {
           $data->thread_v_img = $this->save_img($request->file('thread_v_img'),$slug_type.'/VFront',1000,$data->thrd_id);
         }
         if($request->file('thread_h_img')) {
           $data->thread_h_img = $this->save_img($request->file('thread_h_img'),$slug_type.'/HFront',1000,$data->thrd_id);
         }
         if($request->file('thread_a_img')) {
           $data->thread_a_img = $this->save_img($request->file('thread_a_img'),$slug_type.'/SFront',1000,$data->thrd_id);
         }
         if($request->file('thrd_sleeve_cross')) {
           $data->jsleeve_cross = $this->save_img($request->file('thrd_sleeve_cross'),$slug_type.'/JCross',1000,$data->thrd_id);
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
         return Redirect::to('/admin/thread/style/'.$request->input('thrd_id').'-'.$request->input('attri_id'));


       }
       else
       {
        return redirect()->back();
      }    
    }

    public function thread_style_edit($id=null)
    {
       if($id != '')
        {
            $type='';
             $maindata  = ThreadStyleImage::select('*')->where('id', '=',$id )->get();
             return view('voyager::design/edit-add-threadstyle')->with(compact('maindata','type'));
        }
        else
        {
          return redirect()->back();
        }
    }
    public function thread_style_create_edit(Request $request)
    {
       
      $data = new ThreadStyleImage;
      $data= ThreadStyleImage::findOrFail($request->input('id'));
      $data->attri_sty_id = $request->input('attri_sty_id');  
      //$stylename=$this->sluget('attribute_styles',$data->attri_sty_id,'style_name');
      //$stltype= trim(str_replace(' ', '', $stylename));
      $cat_id=$this->sluget('main_attributes',$request->input('attri_id'),'cat_id');
       $catname=$this->sluget('categories',$cat_id,'name');
      
	  
		$attn=$this->sluget('main_attributes',$request->input('attri_id'),'attribute_name');
		$attname=trim(str_replace(' ','',$attn));
		//$attname=trim($this->sluget('main_attributes',$request->input('attri_id'),'attribute_name'));
		
		$attristy_id = AttributeStyle::select('style_name','folder_name','id')->where('id', '=',  $data->attri_sty_id)->find($data->attri_sty_id);
			if($attristy_id->folder_name!=''){
				$stltype=$attristy_id->folder_name;
			}else{
				$stltype= str_replace(' ','',$attristy_id->style_name);
			}
	  
	  $slug_type=$catname.'/Style/'.$attname.'/'.$stltype.'/Thread';
	  
      
      if($request->file('thrd_list_img')) {
       $data->thrd_list_img = $this->save_img($request->file('thrd_list_img'),$slug_type.'/ListImg',1000,$request->input('thrd_id'));
     }
     if($request->file('thrd_show_img')) {
       $data->thrd_show_img = $this->save_img($request->file('thrd_show_img'),$slug_type.'/ShowImg',1000,$request->input('thrd_id'));
     }
     if($request->file('thrd_contrast_img')) {
       $data->thrd_contrast_img = $this->save_img($request->file('thrd_contrast_img'),$slug_type.'/ContrastImg',1000,$request->input('thrd_id'));
     }
     if($request->file('thread_v_img')) {
       $data->thread_v_img = $this->save_img($request->file('thread_v_img'),$slug_type.'/VFront',1000,$request->input('thrd_id'));
     }
     if($request->file('thread_h_img')) {
       $data->thread_h_img = $this->save_img($request->file('thread_h_img'),$slug_type.'/HFront',1000,$request->input('thrd_id'));
     }
     if($request->file('thread_a_img')) {
       $data->thread_a_img = $this->save_img($request->file('thread_a_img'),$slug_type.'/SFront',1000,$request->input('thrd_id'));
     }
     if($request->file('thrd_sleeve_cross')) {
           $data->jsleeve_cross = $this->save_img($request->file('thrd_sleeve_cross'),$slug_type.'/JCross',1000,$request->input('thrd_id'));
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
     return Redirect::to('/admin/thread/style/'.$request->input('thrd_id').'-'.$request->input('attri_id'));

    }
    public function thread_style_deleteButton($id)
    {
     $cont   = new ThreadStyleImage;
     $cont = ThreadStyleImage::find($id);
     $data = ThreadStyleImage::destroy($id)
     ? [
     'message'    => "Successfully removed Contrasts Thread from list",
     'alert-type' => 'success',
     ]
     : [
     'message'    => 'Sorry it appears there was a problem removing this ',
     'alert-type' => 'danger',
     ];
       return redirect()->back()->with($data);
    }

   /*Image Function Save File*/
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
    
   

    public function sluget($table,$id,$fieldname){

     $slugname = DB::table($table)->where('id','=',$id)->value($fieldname);  
      return $slugname;
    }

}
