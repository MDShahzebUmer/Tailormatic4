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
use App\AttributeStyle;
use App\Piping;
use App\JvLiningDesgin;
use TCG\Voyager\Models\Permission;
use DB;
use Redirect;
use App\PipingStyleImg;
use App\Colorcoller;
use App\JvLiningFabric;
use App\ShippingRate;
use App\BodyMeasurment;
use App\MeasurementsFabric;
use App\User;
use App\ProductImg;
use App\PromotionalPop;

class CommonDesignController extends Controller
{
  public function get_piping()
  {

    $data = Piping::select('*')->where('status', '=' , '1')->get();
    return view('voyager::design/piping_view')->with(compact('data')); 
  }
  public function get_piping_create()
  {
   $type=1;
   return view('voyager::design/edit-add-piping')->with(compact('type'));
  }
 public function post_piping_create(Request $request)
 {
  
  $data = new Piping;
  $slug_type ="Piping";
  $data->name = $request->input(['name']);
  $data->piping_code = $request->input(['piping_code']);
  $data->save();
  //$data->piping_img = $this->save_img($request->file('piping_img'),$name,130,$ids);
   if($data->save())
   {
     $data->id;
     $data = Piping::findOrFail($data->id);
     $data->piping_img = $this->save_img($request->file('piping_img'),$slug_type,25,$data->id);
     $data = $data->save()
              ? [
                'message'    => "Successfully Piping Records Save ",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this',
                'alert-type' => 'danger',
            ];
      return Redirect::to('/admin/piping/')->with($data);
   }
   else{
             return redirect()->back();
   }

}
public function edit_piping($id = null)
{
  if($id != '')
  {
    $type = 2;
    $data = Piping::select('*')->where('id' ,'=' , $id)->find($id);
    return view('voyager::design/edit-add-piping')->with(compact('data' , 'type'));
  }
  else
  {
    return redirect()->back();   
  }
}
 public function edit_update_piping(Request $request)
 {
     $data = Piping::findOrFail($request->input(['id']));
     $data->name = $request->input(['name']);
     $data->piping_code = $request->input(['piping_code']);
     if($request->file('piping_img')  != '')
     {
      $slug_type="Piping";
       $data->piping_img = $this->save_img($request->file('piping_img'),$slug_type,25,$request->input(['id']));
     }
     $data = $data->save()
              ? [
                'message'    => "Successfully Piping Update Records",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this',
                'alert-type' => 'danger',
            ];
      return Redirect::to('/admin/piping/')->with($data);

}
  public function piping_del($id)
  { 
    $this->authorize('browse_database');
       $data   = new Piping;
       $data1   = new PipingStyleImg;
       $data = Piping::find($id);
       $data1 = PipingStyleImg::find($id);
       $data1  = PipingStyleImg::destroy($id);
       $data  = Piping::destroy($id)
     
           ? [
               'message'    => "Successfully removed Piping  from {$data->name}",
               'alert-type' => 'success',
           ]
           : [
               'message'    => 'Sorry it appears there was a problem removing this bread',
               'alert-type' => 'danger',
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
          $status = 'Upload Fail Unknown error occurred!';
        }

      }
      public function add_styleimg_piping($id = null , $cat_id = null)
      {
        if($id != '' && $cat_id != '')
        {

           $type=1;
            $cat_name = Category::select('name','id')->where('id' , '=' , $cat_id)->find($cat_id);
            
            return view('voyager::design/edit-add-pipingstyle')->with(compact('cat_name','type','id'));

        }else{
          return redirect()->back();
        }
      }
      public function save_styleimg_piping(Request $request)
      {
          $data = new PipingStyleImg;
          $slug_type = $this->sluget('categories',$request->input(['cat_id']),'name');
          $slug_type = $slug_type.'/ColorContrast/Piping';
          $data->piping_id = $request->input(['piping_id']);
          $data->cat_id = $request->input(['cat_id']);
          $data->piping_img = $this->save_img($request->file('piping_img'),$slug_type,500,$data->piping_id);
          $data = $data->save()
          ? [
                'message'    => "Successfully Piping Update Records",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this',
                'alert-type' => 'danger',
            ];
      return Redirect::to('/admin/piping/')->with($data);



      }
      public function edit_styleimg_piping($id = null , $cat_id = null)
      {
        if($id != '' && $cat_id != '')
        {

            $type='';
            $cat_name = Category::select('name','id')->where('id' , '=' , $cat_id)->find($cat_id);
            $data = PipingStyleImg::select('*')->where('id', '=' , $id)->find($id);
            return view('voyager::design/edit-add-pipingstyle')->with(compact('cat_name','type','data'));

        }else{
          return redirect()->back();
        }
      }
      public function edit_update_styleimg_piping(Request $request)
      {
        $piping_id = $request->input(['piping_id']);
        $data = PipingStyleImg::findOrFail($request->input(['id']));
        if($request->file('piping_img')  != '')
        {
          $slug_type = $this->sluget('categories',$request->input(['cat_id']),'name');
          $slug_type = $slug_type.'/ColorContrast/Piping';
          $data->piping_img = $this->save_img($request->file('piping_img'),$slug_type,500,$piping_id);
        }
        $data = $data->save()
        ? [
        'message'    => "Successfully Piping Style Update Records",
        'alert-type' => 'success',
        ]
        : [
        'message'    => 'Sorry it appears there was a problem removing this',
        'alert-type' => 'danger',
        ];
        return Redirect::to('/admin/piping/')->with($data);
      }

   /*-----------END-------------------*/
   /*///--------Coller Back Img----------/////*/
    
   public function get_colorcoller()
   {
       $data = Colorcoller::select('*')->get();
      return view('voyager::design/color-coller')->with(compact('data')); 
   }

    public function add_colorcoller()
    {
      $type=1;
      return view('voyager::design/edit-add-colorcoller')->with(compact('type'));

    }
    public function save_colorcoller(Request $request)
    {
        $data = new Colorcoller;
        $data->name = $request->input(['name']);
        $data->save();
        if($data->save())
        {
           $slug_type = 'Jacket/BackColor';
           $slug_type1 = 'Jacket/BackColler';
           $data = Colorcoller::findOrFail($data->id);
           $data->color_img = $this->save_img($request->file('color_img'),$slug_type,500,$data->id);
           $data->coller_img = $this->save_img($request->file('coller_img'),$slug_type1,500,$data->id);
           $data = $data->save()
           ? [
                'message'    => "Successfully Colorcoller Coller Records Save",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this',
                'alert-type' => 'danger',
            ];
      return Redirect::to('/admin/colorcoller/')->with($data);


        }
        else{ return redirect()->back();}

    }
    public function edit_colorcoller($id = null)
    {
        if($id != '')
        {
           $type='';
            $data = Colorcoller::select('*')->where('id' , '=' , $id)->find($id);
            return view('voyager::design/edit-add-colorcoller')->with(compact('data','type'));

        }
        else
        {
          return redirect()->back();
        }
    }

    public function update_edit_colorcoller(request $request)
    {
        $data = Colorcoller::findOrFail($request->input(['id']));
        $data->name = $request->input(['name']);
         if($request->file(['color_img']) != '')
         {
           $slug_type = 'Jacket/BackColor';
            $data->color_img = $this->save_img($request->file('color_img'),$slug_type,500,$request->input(['id']));

         }
         if($request->file(['coller_img']) != '')
         {
          $slug_type1 = 'Jacket/BackColler';
          $data->coller_img = $this->save_img($request->file('coller_img'),$slug_type1,500,$request->input(['id']));

         }
         $data = $data->save()
         ? [
                'message'    => "Successfully Upadte coller-coller Records Save",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this',
                'alert-type' => 'danger',
            ];
         return Redirect::to('/admin/colorcoller/')->with($data);


    }

    public function colorcoller_del($id)
    {
      $this->authorize('browse_database');
       $data   = new Colorcoller;
       $data = Colorcoller::find($id);
       $data  = Colorcoller::destroy($id)
     
           ? [
               'message'    => "Successfully removed Piping  from {$data->name}",
               'alert-type' => 'success',
           ]
           : [
               'message'    => 'Sorry it appears there was a problem removing this bread',
               'alert-type' => 'danger',
           ];

        return redirect()->back()->with($data);
    }
     /*Lining Fabric Jacket And Vests*/

      public function get_lining()
      {
         //$data = 0;
         $data = JvLiningFabric::select('*')->get();
         return view('voyager::design/lining_view')->with(compact('data')); 
      }

      public function add_lining()
      {
        $type=1;
        return view('voyager::design/edit-add-lining')->with(compact('type')); 
      }

      public function save_lining_fabric(Request $request)
      { 
               $j=2;
              $catId = $request->input(['cat_id']);
               $Ytt=0;
               foreach ($catId as  $c) {
                $Ytt++;
                if($Ytt==0){$data='dataj';}else{$data='datav';}
                $data =  new JvLiningFabric;
                $data->cat_id = $c;
                $catname=$this->sluget('categories',$data->cat_id,'name');
                $slug_type = $catname.'/ColorContrast/Lining/List';
                $slug_type2 = $catname.'/ColorContrast/Lining/InsideView';
                $slug_type3 = $catname.'/ColorContrast/Lining/Back';
                $slug_type4 = $catname.'/ColorContrast/Lining/Cut';
                $data->fabric_name = $request->input(['fabric_name']);
                 if($data->save())
                  {
                    $datau = JvLiningFabric::findOrFail($data->id);
                    $datau->lining_img = $this->save_img($request->file('lining_img'),$slug_type,50,$data->id);
                      if($j == $data->cat_id){
                        $datau->inside_view = $this->save_img($request->file('main_imgj'),$slug_type2,500,$data->id);
                      }else{
                        $datau->inside_view = $this->save_img($request->file('main_imgv'),$slug_type2,500,$data->id);
                        $datau->back_img = $this->save_img($request->file('back_img'),$slug_type3,500,$data->id);
                        $datau->cut_img = $this->save_img($request->file('cut_img'),$slug_type4,500,$data->id);
                      }
                      $datau->save();
                    }else{return false;}
                  
                 }/*End For*/
              
                return Redirect::to('/admin/linings/');
     }
     public function edit_lining_fabric($id =null)
     {
         if($id != '')
         {
          $type='';
          $data = JvLiningFabric::select('*')->where('id' , '=' ,$id)->find($id);
          return view('voyager::design/edit-add-lining')->with(compact('data','type'));

         }
     }
     public function update_lining_fabric(Request $request)
     {
         $data = JvLiningFabric::findOrFail($request->input(['id'])); 
         $data->fabric_name = $request->input(['fabric_name']);
         $data->cat_id = $request->input(['cat_id']);
         $catname=$this->sluget('categories',$data->cat_id,'name');
         $slug_type = $catname.'/ColorContrast/Lining/List';
         $slug_type2 = $catname.'/ColorContrast/Lining/Main';
         $slug_type3 = $catname.'/ColorContrast/Lining/Back';
         $slug_type4 = $catname.'/ColorContrast/Lining/Cut';
         if($request->file(['lining_img']))
         {
            $data->lining_img = $this->save_img($request->file('lining_img'),$slug_type,500,$request->input(['id']));
         }
         if($request->file(['inside_view']))
         {
            $data->inside_view = $this->save_img($request->file('inside_view'),$slug_type2,500,$request->input(['id']));
         }
         if($request->file(['back_img']))
         {
            $data->back_img = $this->save_img($request->file('back_img'),$slug_type3,500,$request->input(['id']));
         }
         if($request->file(['cut_img']))
         {
            $data->cut_img = $this->save_img($request->file('cut_img'),$slug_type4,500,$request->input(['id']));
         }
         $data = $data->save()
         ? [
               'message'    => "Successfully removed Piping  from {$data->name}",
               'alert-type' => 'success',
           ]
           : [
               'message'    => 'Sorry it appears there was a problem removing this bread',
               'alert-type' => 'danger',
           ];

        return redirect()->to('/admin/linings/')->with($data);


     }

     public function getdesging_lining_fabric($li_id=null)
     {
         if($li_id != '')
         {
            $cat =JvLiningFabric::select('cat_id')->where('id' ,'=' ,$li_id)->find($li_id);
             if($cat->cat_id == 2)
             {
                $attri_id = 19;
              $catId = $cat->cat_id;

               $data = JvLiningDesgin::select('*')->where('attri_id' , '=' ,$attri_id)->where('lining_id' , '=' ,$li_id)->get();
              return view('voyager::design/liningdesgin_view')->with(compact('catId','attri_id','li_id','data'));

             }
             else
             {
                $attri_id = 36;$catId = $cat->cat_id;
                $data = JvLiningDesgin::select('*')->where('attri_id' , '=' ,$attri_id)->where('lining_id' , '=' ,$li_id)->get();
                return view('voyager::design/liningdesgin_view')->with(compact('catId','attri_id','li_id','data'));
             }
         }
         else
         {

         }
     }
     public function add_desging_lining_fabric($id=null,$ids=null)
     {
        if($id != '' && $ids != '')
        {
          $type="1";
          $data = AttributeStyle::select('style_name','id')->where('attri_id' ,'=' , $id)->get();
          return view('voyager::design/edit-add-liningdesgin')->with(compact('data','type','id','ids'));

        }
        else
        {
           
        }

     }

     public function save_desging_lining_fabric(Request $request)
     {
        $data = new JvLiningDesgin;
        $data->attri_id = $request->input(['attri_id']);
        $data->style_id = $request->input(['style_id']);
         $data->lining_id = $request->input(['lining_id']);
         $f = $this->sluget('attribute_styles', $data->style_id, 'folder_name');
         $c_id = $this->sluget('jv_lining_fabrics', $data->lining_id, 'cat_id');
         $c = $this->sluget('categories',$c_id, 'name');
		 
		 if($f!=''){
          		$slug_type = $c.'/ColorContrast/Lining/'.$f;
		  }else{
			  $slug_type = $c.'/ColorContrast/Lining';
		  }
		 
         
		 $data->front_img = $this->save_img($request->file('front_img'),$slug_type,500,$data->lining_id);
		$data =$data->save();
        return redirect()->to('/admin/linings/')->with($data);
     }
	 
     public function edit_fabdesging_lining($id = null)
     {
         if($id != '')
         {
          $type = '';
            $data = JvLiningDesgin::select('*')->where('id' , '=' ,$id)->find($id);
             return view('voyager::design/edit-add-liningdesgin')->with(compact('data','type'));
         }
         else{
          }

     }
     public function update_fabdesging_lining(Request $request)
     {
        echo "1";
        $data = JvLiningDesgin::findOrFail($request->input(['id']));
        if($request->file(['front_img']))
        {
          $f = $this->sluget('attribute_styles', $request->input(['style_id']), 'folder_name');
          $c_id = $this->sluget('jv_lining_fabrics', $request->input(['lining_id']), 'cat_id');
          $c = $this->sluget('categories',$c_id, 'name');
		  
		  if($f!=''){
          		$slug_type = $c.'/ColorContrast/Lining/'.$f;
		  }else{
			  $slug_type = $c.'/ColorContrast/Lining';
		  }
            
           $data->front_img = $this->save_img($request->file('front_img'),$slug_type,500,$request->input(['lining_id']));
           $data = $data->save()
           ? [
               'message'    => "Successfully removed from {$data->name}",
               'alert-type' => 'success',
           ]
           : [
               'message'    => 'Sorry it appears there was a problem removing this bread',
               'alert-type' => 'danger',
           ];

        return redirect()->to('/admin/linings/'.$request->input(['id']).'/desgin')->with($data);


        } 
     }

     public function delete_fabdesging_lining($id=null)
     {
        if($id != '')
        {
          $this->authorize('browse_database');
         $data   = new JvLiningDesgin;
         $data = JvLiningDesgin::find($id);
         $data  = JvLiningDesgin::destroy($id)

         ? [
         'message'    => "Successfully removed Lining fabric desgin  from {$data->id}",
         'alert-type' => 'success',
         ]
         : [
         'message'    => 'Sorry it appears there was a problem removing this bread',
         'alert-type' => 'danger',
         ];

          return redirect()->back()->with($data); 
        }
        else
        {
          return redirect()->back();
        }
     }
     public function delete_fabric_lining($id = null)
     {
         if($id != '')
         {
          $this->authorize('browse_database');
            
             DB::table('jv_lining_desgin')->where('lining_id', '=', $id)->delete();

           $data   = new JvLiningFabric;
           $data = JvLiningFabric::find($id);
           $data  = JvLiningFabric::destroy($id)
               

           ? [
           'message'    => "Successfully removed Lining fabric desgin  from {$data->id}",
           'alert-type' => 'success',
           ]
           : [
           'message'    => 'Sorry it appears there was a problem removing this bread',
           'alert-type' => 'danger',
           ];

            return redirect()->back()->with($data);  
         }
         else
         {
          return redirect()->back();
         }
     }

     /*Shipping Rates*/
     public function get_shipingrate()
     {
         $data = ShippingRate::select('*')->get();
          return view('voyager::shipping.shippingrates')->with(compact('data'));
      

     }
     public function add_shipingrate()
     {
       $type = 1;
      return view('voyager::shipping.edit-add-shippingrate')->with(compact('type'));

     }
     public function add_shipingrate_post(Request $request)
     {
       //print_r($_POST);
       //exit();
       $data = new ShippingRate;
       $data->country_id = $request->input(['country_id']);
       $data->shirt_amt  = $request->input(['shirt_amt']);
       $data->jacket_amt = $request->input(['jacket_amt']);
       $data->vests_amt  = $request->input(['vests_amt']);
       $data->pant_amt   = $request->input(['pant_amt']);
       $data->other_cat_amt   = $request->input(['other_cat_amt']);
        if($data->save())
        {
          $data 
          ? [
           'message'    => "Successfully Shipping Rates  from {$data->id}",
           'alert-type' => 'success',
           ]
           : [
           'message'    => 'Sorry it appears there was a problem removing this bread',
           'alert-type' => 'danger',
           ];

            return redirect()->to('/admin/shippingrates/')->with('data');
            
        }
     }

     public function edit_shipingrate_data($id = null)
     {
        if($id != '')
        {
           $type = '';
           $data = ShippingRate::select('*')->where('id' , '=' , $id)->find($id);
           return view('voyager::shipping.edit-add-shippingrate')->with(compact('type' ,'data'));
        }
        else
        {
          return redirect()->back();
        }
     }

     public function update_shipingrate_data(Request $request)
     {

        $data = ShippingRate::findOrFail($request->input(['id']));
        $data->country_id = $request->input(['country_id']);
        $data->shirt_amt  = $request->input(['shirt_amt']);
        $data->jacket_amt = $request->input(['jacket_amt']);
        $data->vests_amt  = $request->input(['vests_amt']);
        $data->pant_amt   = $request->input(['pant_amt']);
        $data->other_cat_amt   = $request->input(['other_cat_amt']);
        if($data->save())
        {
           $data 
           ? [
           'message'    => "Successfully Update Record {$data->id}",
           'alert-type' => 'success',
           ]
           : [
           'message'    => 'Sorry it appears there was a problem removing this bread',
           'alert-type' => 'danger',
           ];

            return redirect()->to('/admin/shippingrates/');

        }
        else
        {
            return redirect()->back();
        }

     }
      public function shipingrate_del($id = null)
      {
        if($id != '')
        {
          $this->authorize('browse_database');
         $data   = new ShippingRate;
         $data = ShippingRate::find($id);
         $data  = ShippingRate::destroy($id)

         ? [
         'message'    => "Successfully removed Shipping Rates  from {$data->id}",
         'alert-type' => 'success',
         ]
         : [
         'message'    => 'Sorry it appears there was a problem removing this bread',
         'alert-type' => 'danger',
         ];

          return redirect()->to('/admin/shippingrates/')->with($data); 
        }
        else
        {
          return redirect()->back();
        }  
      }
      public function status_shipingrate_data($id ,$s)
      {
           $data = ShippingRate::findOrFail($id);
           $data->status = !$s;
           $data->save()
            ? [
         'message'    => "Successfully removed Shipping Rates  from {$data->id}",
         'alert-type' => 'success',
         ]
         : [
         'message'    => 'Sorry it appears there was a problem removing this bread',
         'alert-type' => 'danger',
         ];
         return redirect()->to('/admin/shippingrates/')->with('data'); 

      }

      public function get_bodymeasurments()
      {
		      $catid='';     
			   $bodysize = DB::table('body_measurments')
							 ->join('categories', 'body_measurments.cat_id', '=', 'categories.id')
							 ->select('body_measurments.*','categories.id as cat_id','categories.name')
							 ->get();		  
                  
    	return view('voyager::measurment.bodymeasurments')->with(compact('bodysize','catid'));
      }
	  public function get_bodymeasurmentsshirt()
      {
		      $catid=1;     
			   $bodysize = DB::table('body_measurments')
							 ->join('categories', 'body_measurments.cat_id', '=', 'categories.id')
							 ->select('body_measurments.*','categories.id as cat_id','categories.name')
							 ->where('cat_id','=',$catid)
							 ->get();		  
                  
    	return view('voyager::measurment.bodymeasurments')->with(compact('bodysize','catid'));
      }
	  
	  public function get_bodymeasurmentsjackets()
      {
		      $catid=2;     
			   $bodysize = DB::table('body_measurments')
							 ->join('categories', 'body_measurments.cat_id', '=', 'categories.id')
							 ->select('body_measurments.*','categories.id as cat_id','categories.name')
							 ->where('cat_id','=',$catid)
							 ->get();		  
                  
    	return view('voyager::measurment.bodymeasurments')->with(compact('bodysize','catid'));
      }
		public function get_bodymeasurmentsvests()
		{
			  $catid=3;     
			   $bodysize = DB::table('body_measurments')
							 ->join('categories', 'body_measurments.cat_id', '=', 'categories.id')
							 ->select('body_measurments.*','categories.id as cat_id','categories.name')
							 ->where('cat_id','=',$catid)
							 ->get();		  
				  
		return view('voyager::measurment.bodymeasurments')->with(compact('bodysize','catid'));
		}
		
		public function get_bodymeasurmentspants()
		{
			  $catid=4;     
			   $bodysize = DB::table('body_measurments')
							 ->join('categories', 'body_measurments.cat_id', '=', 'categories.id')
							 ->select('body_measurments.*','categories.id as cat_id','categories.name')
							 ->where('cat_id','=',$catid)
							 ->get();		  
				  
		return view('voyager::measurment.bodymeasurments')->with(compact('bodysize','catid'));
		}

      

      public function add_bodymeasurments()
      {
       $type = 1;
		//exit();

        return view('voyager::measurment.edit-add-bodymeasurment')->with(compact('type'));
      }
      public function save_bodymeasurments(Request $request)
      {
         
                 $bodysize = new BodyMeasurment;
                 $bodysize->type = $request->type;
                 $bodysize->cat_id = $request->cat_id;
                 $bodysize->mer_id = $request->mer_id;
                 $bodysize->country_id = $request->country_id;
                 $bodysize->mert_type = $request->mert_type;
                 $bodysize->standardsize_id = $request->standardsize_id;
                 $bodysize->neck     =  $request->neck;
                 $bodysize->chest    =  $request->chest;
                 $bodysize->waist    =  $request->waist;
                 $bodysize->hip      =  $request->hip;
                 $bodysize->shoulder =  $request->shoulder;
                 $bodysize->sleeve   =  $request->sleeve;
                 $bodysize->crotch   =  $request->crotch;
                 $bodysize->thigh    =  $request->thigh;
                 $bodysize->length   =  $request->length;
                 $bodysize->save();
                 return Redirect()->to('admin/bodymeasurments');
       }
       public function edit_bodymeasurments($id=null)
      {
         $type = '';
         $bdata = BodyMeasurment::select('*')->where('id','=',$id)->first($id);
        
        return view('voyager::measurment.edit-add-bodymeasurment')->with(compact('type','bdata'));
      }
      public function editsave_bodymeasurments(Request $request)
      {
          $id = $request->id;
          $bodysize = new BodyMeasurment;
          $bodysize  = BodyMeasurment::findOrFail($id);
          $bodysize->type = $request->type;
          $bodysize->cat_id = $request->cat_id;
          $bodysize->mer_id = $request->mer_id;
          $bodysize->country_id = $request->country_id;
          $bodysize->mert_type = $request->mert_type;
          $bodysize->standardsize_id = $request->standardsize_id;
          $bodysize->neck     =  $request->neck;
          $bodysize->chest    =  $request->chest;
          $bodysize->waist    =  $request->waist;
          $bodysize->hip      =  $request->hip;
          $bodysize->shoulder =  $request->shoulder;
          $bodysize->sleeve   =  $request->sleeve;
          $bodysize->crotch   =  $request->crotch;
          $bodysize->thigh    =  $request->thigh;
          $bodysize->length   =  $request->length;
          $bodysize->save();
                 return Redirect()->to('admin/bodymeasurments');
       }

       public function del_bodymeasurments($id)
       {
         if($id != '')
        {
          $this->authorize('browse_database');
         $data   = new BodyMeasurment;
         $data = BodyMeasurment::find($id);
         $data  = BodyMeasurment::destroy($id)

         ? [
         'message'    => "Successfully removed Shipping Rates from {$data->id}",
         'alert-type' => 'success',
         ]
         : [
         'message'    => 'Sorry it appears there was a problem removing this bread',
         'alert-type' => 'danger',
         ];

          return redirect()->to('/admin/bodymeasurments/')->with($data); 
        }
        else
        {
          return redirect()->back();
        }  
       }

       public function status_userblock($id ,$s)
      {
           $data = User::findOrFail($id);
           $data->status = !$s;
           $data->save()
            ? [
         'message'    => "Successfully removed Shipping Rates  from {$data->id}",
         'alert-type' => 'success',
         ]
         : [
         'message'    => 'Sorry it appears there was a problem removing this bread',
         'alert-type' => 'danger',
         ];
         return redirect()->to('/admin/users/')->with('data'); 

      }
	  
	  /*Fabric duduct measurment*/
	   public function get_fabricmeasurments()
      {
		    $type = 2; 
			  $fabsize = DB::table('measurements_fabric')							 
							 ->select('*')
							 ->where('id','=',1)
							 ->first();		  
                  
    	return view('voyager::measurment.edit-add-fabricmeasurment')->with(compact('fabsize'));
      }
	  
	   public function save_fabricmeasurments(Request $request)
      {
		      $id = $request->id;
          $fabsize = new MeasurementsFabric;
          $fabsize  = MeasurementsFabric::findOrFail($id);
          $fabsize->shirt_body = $request->shirt_body;
          $fabsize->shirt_s = $request->shirt_s;
          $fabsize->shirt_m = $request->shirt_m;
          $fabsize->shirt_l = $request->shirt_l;
          $fabsize->shirt_xl = $request->shirt_xl;
          $fabsize->shirt_xll = $request->shirt_xll;
          $fabsize->shirt_xxxl     =  $request->shirt_xxxl;
          $fabsize->shirt_xxxxl    =  $request->shirt_xxxxl;
          $fabsize->jacket_body    =  $request->jacket_body;
          $fabsize->jacket_stand      =  $request->jacket_stand;
          $fabsize->vest_body =  $request->vest_body;
          $fabsize->vest_stand   =  $request->vest_stand;
          $fabsize->pant_body   =  $request->pant_body;
          $fabsize->pant_stand    =  $request->pant_stand;         
          $fabsize->save()
		   ? [
         'message'    => "Successfully removed Shipping Rates  from {$fabsize->id}",
         'alert-type' => 'success',
         ]
         : [
         'message'    => 'Sorry it appears there was a problem removing this bread',
         'alert-type' => 'danger',
         ];	  
                  
    	return view('voyager::measurment.edit-add-fabricmeasurment')->with(compact('fabsize'));
      }   

      /*End*/


      /*continueshopping*/

        public function get_continueshopping()
        {
          $imgone   =   ProductImg::select('*')->where('id' ,'=' , 1)->first(1);
          $imgtwo   =   ProductImg::select('*')->where('id' ,'=' , 2)->first(2);
          $imgthree =   ProductImg::select('*')->where('id' ,'=' , 3)->first(3);
          $imgfour  =  ProductImg::select('*')->where('id' ,'=' , 4)->first(4);
          $imgfive  =  ProductImg::select('*')->where('id' ,'=' , 5)->first(5);
          return view('voyager::products.frontcustomproduct')->with(compact('imgone','imgtwo','imgthree','imgfour','imgfive'));
        }
        public function save_continueshopping(Request $request)
        {

          
           $slug_type = '/FrontProductImg';
            $id = $request->id;
           $data = new ProductImg;

           $data = ProductImg::findOrFail($id);
           if($request->file('img') != '')
           {
             $data->img = $this->save_img($request->file('img'),$slug_type,500,$request->id);
           }
           if($request->title_one != '')
           {
             $data->title_one = $request->title_one; 
           }
           if($request->title_two != '')
           {
             $data->title_two = $request->title_two; 
           }
           if($request->rate != '')
           {
             $data->rate = $request->rate; 
           }
           if($request->url != '')
           {
             $data->url = $request->url; 
           }
           $data->save()
           ? [
         'message'    => "Successfully removed Shipping Rates  from",
         'alert-type' => 'success',
         ]
         : [
         'message'    => 'Sorry it appears there was a problem removing this bread',
         'alert-type' => 'danger',
         ];  
         return Redirect()->back();

        }

      /*END*/
    
       public function get_promotionImg()
      {
         $data = PromotionalPop::select('*')->first();
         return view('voyager::procode.edit-add-intentpopup')->with(compact('data'));
      }
      public function save_promotionImg(request $request)
      {      
        
             
               $id= $request->pop_id;
              
             $pop =  PromotionalPop::findOrFail($id);
             
              $slug_type = 'none';
             if($request->file('img') != '')
               {
                 $pop->img = $this->save_img($request->file('img'),$slug_type,500,$request->pop_id);
               }
             $pop->url = $request->url;
             $pop->status = $request->status;
             $pop->save()
             ? [
             'message'    => "Successfully Save",
             'alert-type' => 'success',
             ]
             : [
             'message'    => 'Sorry it appears there was a problem removing this bread',
             'alert-type' => 'danger',
             ];  
             return Redirect()->back();

          
         
      }
	  


  
     /*Common Fuction*/ 
      public function sluget($table,$id,$fieldname){

        $slugname = DB::table($table)->where('id','=',$id)->value($fieldname);
        return $slugname;
      }



    }
