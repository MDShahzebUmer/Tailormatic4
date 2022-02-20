<?php
namespace TCG\Voyager\Http\Controllers;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Voyager;
use TCG\Voyager\Models\DataType;
use App\Etfabric;
use App\EcollectionFabrictype;
use App\EcollectionProduct;
use App\EcollectionProimg;
use App\EcollectionRelated;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Redirect;
use App\Http\Helpers;
use TCG\Voyager\Models\Permission;
use DB;
use Illuminate\Http\File;

class ProductsController extends Controller
{
   /* public function __construct($id,)
    {
        $this->data =  "hello";
      }*/
      public function index()
      {
        $data = DB::table('ecollection_products')
        
        ->join('ecollection_proimgs', 'ecollection_proimgs.product_id', '=', 'ecollection_products.id')
        ->select('ecollection_products.*','ecollection_proimgs.thumb_img')
        ->groupBy('ecollection_products.id')
        ->get();
                //echo '<pre>'.print_r($data,true).'</pre>';exit();
        return view('voyager::products.list-products')->with(compact('data'));
      }
      public function product_catg()
      {
          $type = 1;
        return view('voyager::products.select-cat-products')->with(compact('type'));
      }
      public function product_postcatg(Request $request)
      {
         $type = 1;
         $mt= 1;
         $data =  Category::select('*')->get();
         $id =  $request->input('cat_id');
         $pr_catg = $this->get_parent($data,$id);
         if($pr_catg == 1 )
         {
          $relpro =  EcollectionProduct::select('*')->where('product_status' , '=' , 1)->get();
          return view('voyager::products.edit-add-products')->with(compact('type','mt','id','pr_catg','relpro'));  

        }
        else{
         $type = 1;
         $mt= $pr_catg;
         $relpro= EcollectionProduct::select('*')->where('product_status' , '=' , 1)->get();
         return view('voyager::products.edit-add-products')->with(compact('type','mt','id','pr_catg','relpro')); 
       }

   }

   public function product_editid($id = null)
   {
     
      $type = '';
      $id  = EcollectionProduct::select('cat_id')->where('id' , '=' ,$id)->find($id);
      $id = $id->cat_id;
      return view('voyager::products.select-cat-products')->with(compact('type','id'));

   }

   public function product_editidpost(request $request,$id=null)
   {
       //print_r($_POST);
        //echo $id;
              $checkcat =     EcollectionProduct::select('cat_id')->where('id' ,'=' ,$id)->find($id);
               if($checkcat->cat_id == $request->input('cat_id'))
               {
                $sets = '4';
               }else{
                $sets = '5';
               }
          
            
         $type = '';$mt= 1;
         $data =  Category::select('*')->get();
         $catid =  $request->input('cat_id');
         $pr_catg = $this->get_parent($data,$catid);
         if($pr_catg == 1 )
         {
              $productId = EcollectionProduct::select('*')->where('id' ,'=' , $id)->find($id);
              $product_id = $id;
              $proimg =   EcollectionProimg::select('*')->where('product_id' ,'=' ,$id)->get($product_id);
              $related =  EcollectionRelated::select('*')->where('product_id' ,'=' ,$id)->first($product_id);
              

          $relpro =  EcollectionProduct::select('*')->where('product_status' , '=' , 1)->get();
          return view('voyager::products.edit-add-products')->with(compact('type','mt','catid','pr_catg','relpro','productId','proimg','related','sets'));  

        }
        else{
              $checkcat =     EcollectionProduct::select('cat_id')->where('id' ,'=' ,$id)->find($id);
               if($checkcat->cat_id == $request->input('cat_id'))
               {
                 $sets = '4';
               }else{
                $sets = '5';
               }
                
         $type = '';
         $mt= $pr_catg;
          $productId = EcollectionProduct::select('*')->where('id' ,'=' , $id)->find($id);
              $product_id = $id;
              $proimg =   EcollectionProimg::select('*')->where('product_id' ,'=' ,$id)->get($product_id);
              $related =  EcollectionRelated::select('*')->where('product_id' ,'=' ,$id)->first($product_id);
           

         $relpro= EcollectionProduct::select('*')->where('product_status' , '=' , 1)->get();
          return view('voyager::products.edit-add-products')->with(compact('type','mt','catid','pr_catg','relpro','productId','proimg','related','sets'));  

       }
   }

   public function product_saveeditpost(request $request,$id=null)
   {
           if($request->input('product_size')[0] != '')
           {
             $size = serialize($request->input('product_size'));
           }else{
              $size = '';
           }

         $ecollectionP = EcollectionProduct::findOrFail($id);
         $ecollectionP->sku_code            = $request->input('sku_code');
         $ecollectionP->cat_id              = $request->input('cat_id');
         $ecollectionP->product_name        = $request->input('product_name');
         $ecollectionP->initial_stock       = $request->input('initial_stock');
         $ecollectionP->fabric_name         = $request->input('fabric_name');
         $ecollectionP->fabric_dec          = $request->input('fabric_dec');
         $ecollectionP->fabric_brand        =  $request->input('fabric_brand');
         $ecollectionP->product_size        = $size;
         $ecollectionP->product_color       = serialize($request->input('product_color'));
         $ecollectionP->color_desc          = $request->input('color_desc');
         $ecollectionP->product_pattern     = $request->input('product_pattern');
         $ecollectionP->fabric_type         = $request->input('fabric_type');
         $ecollectionP->product_mrp         = $request->input('product_mrp');
         $ecollectionP->main_catid          = $request->input('main_catid');
         $ecollectionP->product_offer_rate  = $request->input('product_offer_rate');
         $ecollectionP->quality_desc        = $request->input('quality_desc');
        $ecollectionP->save();
           
          
		  
		  
		  if($request->input('relateds_id')!= '')
          {
			  
			  $countdata = EcollectionRelated::select('relateds_id')->where('product_id', '=' , $ecollectionP->id)->count();
			  
			  if($countdata>0){
				  DB::table('ecollection_relateds')
					->where('product_id', $id)
					->update(['relateds_id' => serialize($request->input('relateds_id'))]);
			  }else{
				
					$related = [
				  'product_id' => $ecollectionP->id,
				  'relateds_id' => serialize($request->input('relateds_id')),
				  'created_at' => date('y-m-d h:i:s'),
				  'updated_at' => date('y-m-d h:i:s'),
				];
				DB::table('ecollection_relateds')->insert($related); 
			  }
				
				
          }else{
			  
			  DB::table('ecollection_relateds')
				->where('product_id', $id)
				->delete();
		 }
	




     
    $proimg =   EcollectionProimg::select('*')->where('product_id' ,'=' ,$id)->get();
    $slug_type = 'Ecollection/Main';
    $slug_type2 = 'Ecollection/Thumb';
    $p=0;
    
    foreach($proimg as $mid){
      $p++;
      $r=rand(1, 22);
      if($request->hasFile('imgid'.$mid->id)) {
            //echo $mid->main_img;
          Helpers::imggdelete($mid->main_img);
          Helpers::imggdelete($mid->thumb_img);
           
         $file = $request->file('imgid'.$mid->id);

          
          $sl = $id.'-product'.$r;
          $main_img= $this->save_img($file,$slug_type,800,$sl);
          $thumb_img= $this->save_img($file,$slug_type2,200,$sl);



         DB::table('ecollection_proimgs')
            ->where('id', $mid->id)
            ->update(['main_img' => $main_img,'thumb_img' => $thumb_img]);
      }
    }
        $countimg=0;
        $d = null;
        if($request->file('img')){
                $countimg=count($request->file('img'));
                $d=$request->file('img');
        }
        $ip =1;
        if($request->file('img')!=''){
        foreach($d as $im){
          $rp=rand(1, 10);
         $sl = $id.'-product'.$rp;
         $imgrecord = [
         'product_id' => $id,
         'main_img'   => $this->save_img($im,$slug_type,800,$sl),
         'thumb_img'  => $this->save_img($im,$slug_type2,200,$sl),
         ]; 
         DB::table('ecollection_proimgs')->insert($imgrecord);
         $ip++;
       }
   }
    return Redirect()->to('admin/productslists');
   }

  public function save_product_data(Request $request)
  {
         $sku_res =  $this->check_sku_no($request->input('sku_code'));
          if($sku_res == 0)
            {
              
            }else{
              return redirect()->to('admin/productslists/');
             }
    
      
          
             if($request->input('product_size')[0] != '')
             {
                $size = serialize($request->input('product_size'));
             }
             else{$size = '';}
           

           if($request->input('cat_id') != '')
           {

             $d = $request->file('img');
             $c = count($d);


             $product                  = new  EcollectionProduct;
             $product->sku_code           =  $request->input('sku_code');
             $product->cat_id             =  $request->input('cat_id');
             $product->product_name       =  $request->input('product_name');
             $product->initial_stock      =  $request->input('initial_stock');
             $product->fabric_name        =  $request->input('fabric_name');
             $product->fabric_dec         =  $request->input('fabric_dec');
             $product->fabric_brand       =  $request->input('fabric_brand');
             $product->product_size       =  $size;
             $product->product_color      =  serialize($request->input('product_color'));
             $product->color_desc         =  $request->input('color_desc');
             $product->product_pattern    =  $request->input('product_pattern');
             $product->fabric_type        =  $request->input('fabric_type');
             $product->product_mrp        =  $request->input('product_mrp');
             $product->main_catid         =  $request->input('main_catid');
             $product->product_offer_rate =  $request->input('product_offer_rate');
             $product->quality_desc       =  $request->input('quality_desc');
             $product->save();
        	 
             if($product->id != '')
             {
              
              $slug_type = 'Ecollection/Main';
              $slug_type2 = 'Ecollection/Thumb';
              $i =1;
              foreach($d as $im){
               $sl = $product->id.'-product'.$i;
               $imgrecord = [
               'product_id' => $product->id,
               'main_img'   => $this->save_img($im,$slug_type,800,$sl),
               'thumb_img'  => $this->save_img($im,$slug_type2,200,$sl),
               ]; 
               DB::table('ecollection_proimgs')->insert($imgrecord);
               $i++;
             }
        	 if($request->input('relateds_id')!=''){
        		 $related = [
        		  'product_id' => $product->id,
        		  'relateds_id' => serialize($request->input('relateds_id')),
        		  'created_at' => date('y-m-d h:i:s'),
        		  'updated_at' => date('y-m-d h:i:s'),
        		  ];
        		 DB::table('ecollection_relateds')->insert($related);  
        	 }
        	 

           }
           return redirect()->back();
          }
         else
         {
           return redirect()->back();
         }
}

	public function  customproduct_editid($id){
	
						
			$datac = EcollectionProduct::where('id' , '=' ,$id)->count();
			if($datac>0){			
			 $data = EcollectionProduct::where('id' , '=' ,$id)->get();
       $proimg =   EcollectionProimg::select('*')->where('product_id' ,'=' ,$id)->get();
			  $relpro =  EcollectionProduct::select('*')->where('product_status' , '=' , 1)->get();
			return view('voyager::products.edit-add-customproducts')->with(compact('data','relpro','proimg'));
			}else{
				return view::make('errors/404');
			}
	
	}

	public function  customproduct_saveid(request $request){
      
        $c=0;
        $d = null;
        if($request->file('img')){
                $d=$request->file('img');
                file('img');
        
        }
		
				$id        = $request->input('id');
				$datac = EcollectionProduct::where('id' , '=' ,$id)->first();
				$customdata=unserialize($datac->custom_description);
				
				if($request->input('product_offer_rate')!=''){
				$customdata['ofabricPrice']=number_format($request->input('product_mrp')-$request->input('product_offer_rate'),2);	
				 
				}
				$customedes=serialize($customdata);
				
				$ecollectionP = EcollectionProduct::findOrFail($id);
				 $ecollectionP->sku_code        = $request->input('sku_code');
				 $ecollectionP->product_name    = $request->input('product_name');
				 $ecollectionP->initial_stock   = $request->input('initial_stock');
				 $ecollectionP->fabric_name     = $request->input('fabric_name');
				 $ecollectionP->fabric_dec      = $request->input('fabric_dec');				
				 $ecollectionP->product_color   = serialize($request->input('product_color'));
				 $ecollectionP->color_desc      = $request->input('color_desc');				
				 $ecollectionP->product_mrp        = $request->input('product_mrp');				
				 $ecollectionP->product_offer_rate = $request->input('product_offer_rate');
				 $ecollectionP->quality_desc       = $request->input('quality_desc');
				 $ecollectionP->custom_description = $customedes;
				$ecollectionP->save();

         
				
				if($request->input('relateds_id')!= '')
				  {
					  
					  $countdata = EcollectionRelated::select('relateds_id')->where('product_id', '=' , $id)->count();
					  
					  if($countdata>0){
						  DB::table('ecollection_relateds')
							->where('product_id', $id)
							->update(['relateds_id' => serialize($request->input('relateds_id'))]);
					  }else{
						
							$related = [
						  'product_id' => $id,
						  'relateds_id' => serialize($request->input('relateds_id')),
						  'created_at' => date('y-m-d h:i:s'),
						  'updated_at' => date('y-m-d h:i:s'),
						];
						DB::table('ecollection_relateds')->insert($related); 
					  }
						
						
				  }else{
					  
					  DB::table('ecollection_relateds')
						->where('product_id', $id)
						->delete();
				 }

         /*Image */
         $proimg =   EcollectionProimg::select('*')->where('product_id' ,'=' ,$id)->get();
         $slug_type = 'Ecollection/Main';
         $slug_type2 = 'Ecollection/Thumb';
         $p=0;

         foreach($proimg as $mid){
          $p++;
          $r=rand(1, 22);
          if($request->hasFile('imgid'.$mid->id)) {
            //echo $mid->main_img;
            Helpers::imggdelete($mid->main_img);
            Helpers::imggdelete($mid->thumb_img);

            $file = $request->file('imgid'.$mid->id);


            $sl = $id.'-product'.$r;
            $main_img= $this->save_img($file,$slug_type,800,$sl);
            $thumb_img= $this->save_img($file,$slug_type2,200,$sl);



            DB::table('ecollection_proimgs')
            ->where('id', $mid->id)
            ->update(['main_img' => $main_img,'thumb_img' => $thumb_img]);
          }
        }

        $countimg=0;
        $d = null;
        if($request->file('img')){
                $countimg=count($request->file('img'));
                $d=$request->file('img');
        }
       $ip =1;
        if($request->file('img')!=''){
          foreach($d as $im){
            $rp=rand(1, 10);
            $sl = $id.'-product'.$rp;
            $imgrecord = [
            'product_id' => $id,
            'main_img'   => $this->save_img($im,$slug_type,800,$sl),
            'thumb_img'  => $this->save_img($im,$slug_type2,200,$sl),
            ]; 
            DB::table('ecollection_proimgs')->insert($imgrecord);
            $ip++;
          }
        }
         /*End Image*/


				
				
				
				return Redirect()->to('admin/productslists');
		
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



public function getSubCateg(Request $request)
{
 $catd = Category::where('parent_id' , '=' ,$request->id)->get();
 return response()->json($catd);
}

public function get_Fabrictype()
{
 $data = EcollectionFabrictype::select('*')->orderBy('cat_id', 'asc')->get();
 return view('voyager::products.fabrictype')->with(compact('data'));
}
public function add_Fabrictype()
{

  $type = 1;
  return view('voyager::products.edit-add-fabrictype')->with(compact('type'));
}
public function save_Fabrictype(Request $request)
{
 if($request->input('cat_id') != ''){

  foreach ($request->input('cat_id') as $v) {

    $data = [
    'cat_id' => $v,
    'type_name' => $request->type_name
    ];
    $data = DB::table('ecollection_fabrictypes')->insert($data);
  }  
}
return Redirect()->to('admin/fabrictypes');

}

public function edit_Fabrictype($id = null)
{
 if($id != '')
 {
   $data = EcollectionFabrictype::select('*')->where('id' , '=' , $id)->first($id);
   $type = '';
   return view('voyager::products.edit-add-fabrictype')->with(compact('type','data'));
 }else{
   return Redirect()->to('admin/fabrictypes');
 }

}

public function update_Fabrictype(Request $request)
{
  $id = $request->input('id');
  $fabric_type = new EcollectionFabrictype;
  $fabric_type = EcollectionFabrictype::findOrFail($id);
  $fabric_type->cat_id = $request->input('cat_id');
  $fabric_type->type_name = $request->input('type_name');
  $fabric_type->save();
  return Redirect()->to('admin/fabrictypes');
}

public function del_Fabrictype($id = null)
{
  $this->authorize('browse_database');
  $data   = new EcollectionFabrictype;
  $data = EcollectionFabrictype::find($id);
  $data  = EcollectionFabrictype::destroy($id)

  ? [
  'message'    => "Successfully removed Fabrictype  from {$data->type_name}",
  'alert-type' => 'success',
  ]
  : [
  'message'    => 'Sorry it appears there was a problem removing this bread',
  'alert-type' => 'danger',
  ];

  return redirect()->back()->with($data);

}

public function check_main_catg($id)
{
  $cp = Category::select('parent_id','id')->where('id' , '=' ,$id)->find($id);
  if($cp->parent_id != '')
  {

    $this->check_main_catg($cp->parent_id);
  }
  else
  {
    return $cp;
  }

}



public function get_parent($arr, $id)
{

  $key = $this->get_key($arr, $id);
  if ($arr[$key]['parent_id'] == '')
  {
   return $id;
 }
 else 
 {
   return $this->get_parent($arr, $arr[$key]['parent_id']);
 }
}

public function get_key($arr, $id)
{

  foreach ($arr as $key => $val) {
   if ($val->id == $id) {
     return $key;
   }
 }
 return null;
}

  public function single_custom_status($id,$sta)
  {
      if($id != '' && $sta != '')
      {
         $changesta = EcollectionProduct::findOrFail($id);
         $changesta->product_status = $sta;
         $data = $changesta->save()
         ? [
         'message'    => "Successfully Update Status",
         'alert-type' => 'success',
         ]
         : [
         'message'    => 'Sorry it appears there was a problem removing this bread',
         'alert-type' => 'danger',
         ];

         return redirect()->back()->with($data);

      }
      else{
             return redirect()->back()->with();
      }
  }

   public function check_sku_no($sku)
   {

        $skuche  = DB::table('ecollection_products')->select('sku_code')->where('sku_code','=',$sku)->get();
        return count($skuche);
   }

   public function get_custommview($id = null)
  {	  
	  
	  if($id != '')
	  {
	   $proId = EcollectionProduct::select('cat_id')->where('id', '=',  $id)->first();
	   $data = EcollectionProduct::select('*')->where('id','=' ,$id)->find($id);
	   $proId->cat_id;
	   switch ($proId->cat_id) {
		 case '1':
		 return view('voyager::products.shirtdetails')->with(compact('data'));
		 break;
		 case '2':
		 return view('voyager::products.jacketdetails')->with(compact('data'));
		 break;
		 case '3':
		 return view('voyager::products.vestsdetails')->with(compact('data'));
		 break;
		 case '4':
		 return view('voyager::products.pantdetails')->with(compact('data'));
	
		 break;
	
		 default:
		 return view('voyager::products.orderproduct')->with(compact('data'));
		 break;
	   } 
				  // $data = OrderItem::select('*')->where('id','=' ,$id)->find($id);
	
	 }
	 else
	 {
	   return Redirect()->to('admin/productslists');
	 }
  }

}