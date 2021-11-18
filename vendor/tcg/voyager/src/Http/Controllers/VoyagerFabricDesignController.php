<?php

namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Voyager;
use TCG\Voyager\Models\DataType;
use App\Etfabric;
use App\FabricGroup;
use App\MainAttribute;
use App\AttributeStyle;
use App\OptionTabel;
use App\Stylefabimglist;
use App\OptionFabImg;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Redirect;
use TCG\Voyager\Models\Permission;
use DB;
use Illuminate\Http\File;
class VoyagerFabricDesignController extends Controller
{
   /* public function __construct($id,)
    {
        $this->data =  "hello";
    }*/
    public function index($id)
    {
       
       return view('voyager::design.fabricdesign');
    }
  
    public function fabricGroup($id)
    {
            
          /* echo 'sdfsdfsdf';
		   exit();*/
		   
		   $ex =  explode('-', $id);
           if(count($ex)>1){
            $id =   $ex[0];
            $style_id = $ex[1];
           }else{
            $id =   $id;
            $style_id='';
           }
           
           
          $data = Etfabric::select('fbgrp_id', 'fabric_name','id')->where('id','=',$id)->findOrFail($id);
          $fbgrp_id  =   $data->fbgrp_id;
          $fabg_data =   FabricGroup::findOrFail($fbgrp_id);
		  $cat_data  =   Category::findOrFail($fabg_data->cat_id);
		  
		 
		  
		  
		 
          $main_id   =   MainAttribute::select('id','attribute_name')->where('cat_id','=' ,$fabg_data->cat_id)->where('parent_id' ,'=' , 0)->first();
		  
		  
          $MainAttribute = MainAttribute::select('attribute_name','id')->where('parent_id', '=' ,$main_id->id)->get();
		  
		  
            if($style_id == ''){
                $AttributeId = MainAttribute::select('attribute_name','id')->where('parent_id', '=' ,$main_id->id)->first();
                $stylefabimglist = Stylefabimglist::select('*')->where('attri_id', '=' ,$AttributeId->id)->where('fab_id' ,'=' , $id)->get();
				$optionchk=$this->chkOptionFabImg($AttributeId->id,$id);
				
                //print_r($stylefabimglist);
                
          }else{
			  $optionchk=$this->chkOptionFabImg($style_id,$id);
			  
            $stylefabimglist = Stylefabimglist::select('*')->where('attri_id', '=' ,$style_id)->where('fab_id' ,'=' , $id)->get();
          }
		  
		  
        return view('voyager::design.fabricdesign')->with(compact('fabg_data', 'cat_data','data','MainAttribute','style_id','stylefabimglist','optionchk'));
           
    }
    public function createdata($f,$a)
    {
        
       $type=1;
	   
       if($f != '' && $a != '')
       {
          
		  $AttributeId = MainAttribute::select('attribute_name')->where('id', '=' ,$a)->first();
		  $AttributeName=$AttributeId->attribute_name;
		  
		  $opt = OptionTabel::select('name','id' ,'attri_id')->where('attri_id', '=' , $a)->get();
          if($opt->isEmpty())
          {
            $opt = '';
          return view('voyager::design.edit-add')->with(compact('opt' ,'f','a','type','AttributeName'));
          }else{
          
            return view('voyager::design.edit-add')->with(compact('opt' ,'f','a','type','AttributeName'));
          } 
        }
     }
     public function addfabimglist(Request $request)
     {
      
        $stylelist   = new Stylefabimglist;
         $stylelist->attri_id   = $request->input('attri_id');
         $stylelist->fab_id     = $request->input(['fab_id']);
         $stylelist->style_id = $request->input(['style_id']);
		 $stylelist->style_name = $this->sluget('attribute_styles',$stylelist->style_id,'style_name');
         $stylelist->style_code = $request->input(['style_code']);
         $stylelist->inside_view = $request->input(['inside_view']);
         $stylelist->opt_id      = $request->input(['opt_id']);
         $a=$stylelist->attri_id;
         $f=$stylelist->fab_id;
         $stylelist->status   = '1';
		 
		 //Slug creation
		 $catID=$this->sluget('main_attributes',$stylelist->attri_id,'cat_id');
		 $catname=$this->sluget('categories',$catID,'name');
		 $attname= trim(str_replace(' ','', $this->sluget('main_attributes',$a,'attribute_name')));
		 $parentId= $this->sluget('main_attributes',$a,'parent_id');
		 $attMainname= str_replace(' ', '', $this->sluget('main_attributes',$parentId,'attribute_name'));
		 $stltype= str_replace(' ', '', $stylelist->style_name);
		 $slug_type=$catname.'/'.$attMainname.'/'.$attname.'/'.$stltype;
		 
				 
         for($t=1;$t<=5;$t++){
              if($request->hasFile('img'.$t)) {
             $file = $request->file('img'.$t);
			 
			
            if($t==1){  
                $stylelist->list_img = $name=$this->saveimgfab($file,$slug_type.'/List',1800,$f);
              }elseif($t==2){
               $stylelist->show_img = $name=$this->saveimgfab($file,$slug_type.'/Show',1800,$f);
             }elseif($t==3){
               $stylelist->front_img = $name=$this->saveimgfab($file,$slug_type.'/Front',1800,$f);
             }elseif($t==4){
              $stylelist->back_img = $name=$this->saveimgfab($file,$slug_type.'/Back',1800,$f);
            }elseif($t==5){
              $stylelist->buttons_img = $name=$this->saveimgfab($file,$slug_type.'/ButtonsImg',1800,$f);
            }elseif($t==6){
              $stylelist->img_inner = $name=$this->saveimgfab($file,$slug_type.'/Inner',1800,$f);
            }else{
              $stylelist->img_outer = $name=$this->saveimgfab($file,$slug_type.'/Outer',1800,$f);
            }
            //$file->move(public_path().'/storage/faddesign/', $name);
          }
        }
		
	
         $stylelist->save();
		 
        return Redirect::to('/admin/fabricdesign/'.$f.'-'.$a);
        
    }

    public function editdata($idst=null)
    {
         if($idst != '')    
         {       
          $type=2;
          $fabstylelist = Stylefabimglist::select('*')->where('id', '=' , $idst)->get();
		  
		  foreach($fabstylelist as $attid){
		  }
		  
		  
		  $opt = OptionTabel::select('name','id' ,'attri_id')->where('attri_id', '=' , $attid->attri_id)->get();
          if($opt->isEmpty())
          {
            $opt = '';
		  }
		  
          
		  if($fabstylelist->isEmpty())
          {
            $fabstylelist = '';
           
           return view('voyager::design.edit-add')->with(compact('fabstylelist','type','opt'));
          }else{           
            return view('voyager::design.edit-add')->with(compact('fabstylelist','type','opt'));
          }
    }
      else{
        return redirect()->back();
      } 
        
     }
	 
	 
	 public function editfabimglist(Request $request)
     {
      
        $stylelist   = new Stylefabimglist;
         $stylelist = Stylefabimglist::findOrFail($request->input(['id']));	
         $stylelist->style_id = $request->input(['style_id']);
		 $stylelist->style_name = $this->sluget('attribute_styles',$stylelist->style_id,'style_name');
         $stylelist->style_code = $request->input(['style_code']);
         $stylelist->inside_view = $request->input(['inside_view']);
         $stylelist->opt_id      = $request->input(['opt_id']);
		 $stylelist->status      = $request->input(['status']);
		 
         $a=$request->input(['attri_id']);
         $f=$request->input(['fab_id']);  
		 	      
         
		  //Slug creation
		 $catID=$this->sluget('main_attributes',$a,'cat_id');
		 $catname=$this->sluget('categories',$catID,'name');
		 $attname= trim(str_replace(' ','', $this->sluget('main_attributes',$a,'attribute_name')));
		 $parentId= $this->sluget('main_attributes',$a,'parent_id');
		 $attMainname= $this->sluget('main_attributes',$parentId,'attribute_name');
		 $stltype= str_replace(' ', '', $stylelist->style_name);
		 $slug_type=$catname.'/'.$attMainname.'/'.$attname.'/'.$stltype;
		 
				 
         for($t=1;$t<=7;$t++){
           if($request->hasFile('img'.$t)) {             
			$file = $request->file('img'.$t);
			 
			
            if($t==1){  
                $stylelist->list_img = $name=$this->saveimgfab($file,$slug_type.'/List',1800,$f);
              }elseif($t==2){
               $stylelist->show_img = $name=$this->saveimgfab($file,$slug_type.'/Show',1800,$f);
             }elseif($t==3){
               $stylelist->front_img = $name=$this->saveimgfab($file,$slug_type.'/Front',1800,$f);
              }elseif($t==4){
              $stylelist->back_img = $name=$this->saveimgfab($file,$slug_type.'/Back',1800,$f);
            }elseif($t==5){
              $stylelist->buttons_img = $name=$this->saveimgfab($file,$slug_type.'/ButtonsImg',1800,$f);
            }elseif($t==6){
              $stylelist->img_inner = $name=$this->saveimgfab($file,$slug_type.'/Inner',1800,$f);
            }elseif($t==7){
              $stylelist->img_outer = $name=$this->saveimgfab($file,$slug_type.'/Outer',1800,$f);
            }
            
          }
		  /* for move image from one style to another*/ 
		 /* elseif($stylelist->style_id!=$old_style_id){
				
				if($t==1){				
				 	$stylelist->list_img = $this->imgRename($oldimg,'List');				 
				}elseif($t==2){							 		
				 	$stylelist->show_img = $this->imgRename($oldshow,'Show');				 
				}elseif($t==3){
					 $stylelist->front_img = $this->imgRename($oldfront,'Front');
				}elseif($t==4){
					 $stylelist->back_img = $this->imgRename($oldback,'Back');
				
				}
				 
			}*/		   
		  
        }		 
		 
		
         $stylelist->save();		 
		 	 
        return Redirect::to('/admin/fabricdesign/'.$f.'-'.$a);
        
    }
	
	
	 public function move_yfile($newpath,$oldimg)
    {
        $source = $oldimg;
        $destination = $newpath;
        //$folderLocation = $request->folder_location;
        $success = false;
        $error = '';

       /* if (is_array($folderLocation)) {
            $folderLocation = rtrim(implode('/', $folderLocation), '/');
        }*/

        $location = "public/storage";
        $source = "{$location}/{$source}";
        $destination = "{$location}/{$destination}";

        if (!file_exists($destination)) {
            if (Storage::move($source, $destination)) {
                $success = true;
            } else {
                $error = 'Sorry there seems to be a problem moving that file/folder, please make sure you have the correct permissions.';
            }
        } else {
            $error = 'Sorry there is already a file/folder with that existing name in that folder.';
        }

        return compact('success', 'error');
    }
	
	
	
	
	/*pr function*/
	public function chkOptionFabImg($attid,$fabid){
		
		$opt = OptionTabel::select('id','name')->where('attri_id', '=' , $attid)->get();
          if($opt->isEmpty())
          {
            $chekop['id'] = '0291';
		  }else{
			  
			  foreach($opt as $ID){}
			   $ID->id;
			  
			 
			$optfab = OptionFabImg::select('id')->where('fab_id', '=' , $fabid)->where('opt_id', '=' , $ID->id)->get();
			//print_r($optfab);
			//exit();
			
			 if($optfab->isEmpty())
          {
			   $chekop['id'] = 0;
			   $chekop['name'] = $ID->name;//attribute option name from option_tabels
		  }else{
			  foreach($optfab as $idch){
			  }
			    $chekop['id'] = $idch->id;
				$chekop['name'] = $ID->name;//attribute option name from option_tabels
			  // exit();
		  }
				
			  
		}
		//exit();
		return $chekop;
	}
	
	public function deletedata($id)
   {
    $this->authorize('browse_database');

       /** @var \TCG\Voyager\Models\DataType $dataType */
        $stylelist   = new Stylefabimglist;
       $stylelist = Stylefabimglist::find($id);
       $data = Stylefabimglist::destroy($id)
           ? [
               'message'    => "Successfully removed Contrasts  from {$stylelist->style_name}",
               'alert-type' => 'success',
           ]
           : [
               'message'    => 'Sorry it appears there was a problem removing this bread',
               'alert-type' => 'danger',
           ];

       if (!is_null($stylelist)) {
           Permission::removeFrom($stylelist->style_name);
       }

       return redirect()->back()->with($data);
      // return redirect()->route('voyager.contrastsdesign')->with($data);
   }
	
	
	
	
	
	/* fabric option add edit*/
	public function createoption($f=null,$a=null)
    {
       
	   $type=1;
       if($f != '' && $a != '')
       {
          $opt = OptionTabel::select('name','id' ,'attri_id')->where('attri_id', '=' , $a)->get();
          if($opt->isEmpty())
          {
            $opt = '';
          return view('voyager::design.editop-addop')->with(compact('opt' ,'f','a','type'));
          }else{
          
            return view('voyager::design.editop-addop')->with(compact('opt' ,'f','a','type'));
          } 
        }
        else
        {
          return Redirect()->to('/admin/fabricdesign/');
           //return Redirect::to('/admin/fabricdesign/'.$f.'-'.$a);
        }

     }
	 
	 public function addfaboption(Request $request)
     {
        $stylelist   = new OptionFabImg;
         $stylelist->opt_id   = $request->input('opt_id');
         $stylelist->fab_id     = $request->input(['fab_id']);
         $stylelist->status   = '1';
		 $a=$request->input(['att_id']);
		 $f=$request->input(['fab_id']);
		 
		 
		 //Slug creation
		 $catID=$this->sluget('main_attributes',$a,'cat_id');
		 $catname=$this->sluget('categories',$catID,'name');
		 $attname= trim(str_replace(' ','', $this->sluget('main_attributes',$a,'attribute_name')));
		 $parentId= $this->sluget('main_attributes',$a,'parent_id');
		 $attMainname= $this->sluget('main_attributes',$parentId,'attribute_name');
		 $optname= $this->sluget('option_tabels',$stylelist->opt_id,'name');
		 //$stltype= str_replace(' ', '', $stylelist->style_name);
		 $slug_type=$catname.'/'.$attMainname.'/'.$attname.'/'.$optname;
		 
				 
         for($t=1;$t<=6;$t++){
              if($request->hasFile('img'.$t)) {
          	$file = $request->file('img'.$t);
			 
			
            if($t==1){  
                $stylelist->left_img = $name=$this->saveimgfab($file,$slug_type.'/left',1800,$f);
              }elseif($t==2){
               $stylelist->reight_img = $name=$this->saveimgfab($file,$slug_type.'/right',1800,$f);
             }elseif($t==3){
               $stylelist->inside_img = $name=$this->saveimgfab($file,$slug_type.'/Front',1800,$f);
            }elseif($t==4){
                $stylelist->back_img = $name=$this->saveimgfab($file,$slug_type.'/Back',1800,$f);
            }elseif($t==5){
               $stylelist->tritab_img = $name=$this->saveimgfab($file,$slug_type.'/Tritab',1800,$f);
            }else{
              $stylelist->straight_img = $name=$this->saveimgfab($file,$slug_type.'/Straight',1800,$f);
            }
            //$file->move(public_path().'/storage/faddesign/', $name);
          }
        }
		 
		 
		 
		/*
         for($t=1;$t<=4;$t++){
              if($request->hasFile('img'.$t)) {
             $file = Input::file('img'.$t);
            // $timestamp = md5($file. time());
             //$name = 'faboption/'.$timestamp. '-' .$file->getClientOriginalName();
            if($t==1){  
                $stylelist->left_img = $name;
              }elseif($t==2){
               $stylelist->reight_img = $name;
             }elseif($t==3){
               $stylelist->inside_img = $name;
            }else{
              $stylelist->back_img = $name;
            }
            $file->move(public_path().'/storage/faboption/', $name);
          }
        }*/
         $stylelist->save();
		 
		 
        return Redirect::to('/admin/fabricdesign/'.$f.'-'.$a);
        
    }
	
	public function editoption($idst)
    {
          
         $type=2;
		  $fabstylelist = OptionFabImg::select('*')->where('id', '=' , $idst)->get();
		  
		  foreach($fabstylelist as $optid){
		  }
		  
		  
		  $opt = OptionTabel::select('name')->where('id', '=' , $optid->opt_id)->get();
          foreach($opt as $optinfo){
		  }
		  $optname=$optinfo->name;
		
          
		  if($fabstylelist->isEmpty())
          {
            $fabstylelist = '';
           
           return view('voyager::design.editop-addop')->with(compact('fabstylelist','type','optname'));
          }else{           
            return view('voyager::design.editop-addop')->with(compact('fabstylelist','type','optname'));
          } 
        
     }
	 
	  public function editoptionlist(Request $request)
     {
        $stylelist   = new OptionFabImg;
         $stylelist = OptionFabImg::findOrFail($request->input(['id']));	
         $stylelist->status   = $request->input(['status']);
		 
		  $opt = OptionTabel::select('attri_id')->where('id', '=' , $request->input(['opt_id']))->get();
          foreach($opt as $optinfo){
		  }
		 
		 $a=$optinfo->attri_id; 
		 $f=$request->input(['fab_id']);
		 
		 
		  //Slug creation
		 $catID=$this->sluget('main_attributes',$a,'cat_id');
		 $catname=$this->sluget('categories',$catID,'name');
		 $attname= trim(str_replace(' ','', $this->sluget('main_attributes',$a,'attribute_name')));
		 $parentId= $this->sluget('main_attributes',$a,'parent_id');
		 $attMainname= $this->sluget('main_attributes',$parentId,'attribute_name');
		 $optname= $this->sluget('option_tabels',$request->input(['opt_id']),'name');
		 //$stltype= str_replace(' ', '', $stylelist->style_name);
		 $slug_type=$catname.'/'.$attMainname.'/'.$attname.'/'.$optname;
		 
				 
         for($t=1;$t<=6;$t++){
              if($request->hasFile('img'.$t)) {
          	$file = $request->file('img'.$t);
			 
			
            if($t==1){  
                $stylelist->left_img = $name=$this->saveimgfab($file,$slug_type.'/left',1800,$f);
              }elseif($t==2){
               $stylelist->reight_img = $name=$this->saveimgfab($file,$slug_type.'/right',1800,$f);
             }elseif($t==3){
               $stylelist->inside_img = $name=$this->saveimgfab($file,$slug_type.'/Front',1800,$f);
            }elseif($t==4){
               $stylelist->back_img = $name=$this->saveimgfab($file,$slug_type.'/Back',1800,$f);
            }elseif($t==5){
               $stylelist->tritab_img = $name=$this->saveimgfab($file,$slug_type.'/Tritab',1800,$f);
            }else{
              $stylelist->straight_img = $name=$this->saveimgfab($file,$slug_type.'/Straight',1800,$f);
            }
            //$file->move(public_path().'/storage/faddesign/', $name);
          }
        }
		 
		
         $stylelist->save();
		 
		
		 
		 
        return Redirect::to('/admin/fabricdesign/'.$f.'-'.$a);
        
    }
	
	public function saveimgfab($file =null,$slug_type =null,$size=null,$id)
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
	  
	  
	  public function imgRename($oldfront,$slug){
		$imgg=explode('/',$oldfront);
		$tt=count($imgg)-1;				 
			$newpath=$slug_type.'/'.$slug.'/'.$imgg[$tt];				 
			rename(base_path() . '/public/storage/'.$oldfront, base_path() .'/public/storage/'.$newpath);
				
			 return $newpath;
		 }
public function efabric_status($id){
     
       $eIds =Etfabric::select("fabric_status")->where('id','=',$id)->find($id);
       $eIds->fabric_status;
        if($eIds->fabric_status == 1){
          $es = Etfabric::findOrFail($id);
          $es->fabric_status = '0';
          $es->save();
          return Redirect()->back();

        }else if($eIds->fabric_status == 0){
          $es = Etfabric::findOrFail($id);
          $es->fabric_status = '1';
          $es->save();
          return Redirect()->back();

        }else{
          return Redirect()->back();

        }

    }
 /* FABRIC GROUP CODE*/
    
    public function get_fabricGP(){
       $data = FabricGroup::select("*")->get();
      return view('voyager::fabricgroup.fabricgp')->with(compact('data'));
      
    }

    public function add_fabricGP(){
     
      $type="1";
      $cat = Category::select('*')->get();
      return view('voyager::fabricgroup.edit-add-fabricgp')->with(compact('type','cat'));
    }
    public function save_fabricGP(Request $request){
     
     $data = new FabricGroup;
     $data->cat_id = $request->input('cat_id');
     $data->fbgrp_name = $request->input('fbgrp_name');
    
     $data->fabric_rate = $request->input('fabric_rate');
     $data->fabric_offer_price = $request->input('fabric_offer_price');
     $data->fabric_status = $request->input('fabric_status');
     $data->save();
     return Redirect()->to('admin/fabricgroups');

    }
     public function edit_fabricGP($id){
     
      $type="2";
      $cat = Category::select('*')->get();
      $fg = FabricGroup::select('*')->where('id','=',$id)->first();
      return view('voyager::fabricgroup.edit-add-fabricgp')->with(compact('type','cat','fg'));
    }
    public function update_fabricGP(Request $request){
    
          $id = $request->input('id');

       $data = FabricGroup::findOrFail($id);
       $data->cat_id = $request->input('cat_id');
       $data->fbgrp_name = $request->input('fbgrp_name');
       
       $data->fabric_rate = $request->input('fabric_rate');
       $data->fabric_offer_price = $request->input('fabric_offer_price');
       $data->fabric_status = $request->input('fabric_status');
       $data->save();
        return Redirect()->to('admin/fabricgroups');
      
    }

    public function del_fabricGP($id)
   {
    $this->authorize('browse_database');

       /** @var \TCG\Voyager\Models\DataType $dataType */
        $stylelist   = new FabricGroup;
       $stylelist = FabricGroup::find($id);
       $data = FabricGroup::destroy($id)
           ? [
               'message'    => "Successfully removed fabric group  from {$stylelist->fbgrp_name}",
               'alert-type' => 'success',
           ]
           : [
               'message'    => 'Sorry it appears there was a problem removing this bread',
               'alert-type' => 'danger',
           ];

       if (!is_null($stylelist)) {
           Permission::removeFrom($stylelist->fbgrp_name);
       }

       return redirect()->back()->with($data);
      // return redirect()->route('voyager.contrastsdesign')->with($data);
   }

    /*======END========= */
	  
	  
	 
	
	
	
}