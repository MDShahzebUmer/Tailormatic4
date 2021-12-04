<?php
namespace App\Http\Controllers;
use DB;
use Auth;
use Session;
use View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use Validator;
use Illuminate\Http\Request;
use Redirect;
use App\Mail\RefFriendLink;
use Illuminate\Support\Collection;
use App\Http\Helpers;
use Mail;
use App\EcollectionProduct;
use App\EcollectionProimg;
use App\EcollectionRelated;
use App\Socialicon;
use App\EcollectionWishlist;
use App\Category;
use App\Cart;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Voyager;
//use Request;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
      $carts=md5(microtime().rand());

      if(Session::has('carts')) {
        $cartsess=Session::get('carts');

      }else{
        $cartsess=Session::put('carts', $carts);

      }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /*Welcome blade call*/
	public function product_Lits($id = null)
	{


        if($id != ''){
         $productsh = DB::table('ecollection_products')
        ->orwhere('main_catid' , '=' ,$id)
        ->where('product_status' , '=' ,'1')
         ->orwhere('cat_id' , '=' ,$id)
		 ->where('product_status' , '=' ,'1')
        ->join('ecollection_proimgs', 'ecollection_proimgs.product_id', '=', 'ecollection_products.id')
        ->select('ecollection_products.*','ecollection_proimgs.main_img')
        ->groupBy('ecollection_products.id')
        ->get();
        $catIds = $id;
         //echo '<pre>'.print_r($productsh,true).'</pre>';exit();
		 $soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
		return view('product.product_list')->with(compact('soc','productsh','catIds'));
     }else{
        return Redirect()->to('/');
     }
	}



   public function product_Search($ids,$s=null,$search=null)
    {

            $productsh = DB::table('ecollection_products')
             ->where('product_status' , '=' ,'1')
             ->join('ecollection_proimgs', 'ecollection_proimgs.product_id', '=', 'ecollection_products.id')
             ->select('ecollection_products.*','ecollection_proimgs.main_img')
             ->where('product_name' , 'LIKE' ,"%{$search}%")
             ->groupBy('ecollection_products.id')
             ->get();

            return response()->json(array('sum'=> $productsh), 200);
    }

    public function product_Filter($ids,$filterdata=null)
    {

        if($filterdata != 'All'){

          $filterdata =  json_decode($filterdata,TRUE);


          $color_str = array();
          $size_str = array();
          $fromprice='';
          $toprice ='';
          $febtype_str = '';
          $febpat_str = '';

            foreach ($filterdata as $key => $value) {

              if(!empty($value['color_data'])){
                $color_str = $value['color_data'];
              }

              if(!empty($value['size_data'])){
                $size_str = $value['size_data'];
              }

              if(!empty($value['price_data'][0])){
                $fromprice = $value['price_data'][0]['from'];
                $toprice = $value['price_data'][0]['to'];
              }

              if(!empty($value['febpatern'])){
                foreach ($value['febpatern'] as $pkey => $pvalue) {
                  $febpat_str.= $pvalue['patern'].',';
                }
                $febpat_str = rtrim($febpat_str,',');
              }

              if(!empty($value['febtype'])){
                 foreach ($value['febtype'] as $tkey => $tvalue) {
                  $febtype_str .= $tvalue['type'].',';
                }
                $febtype_str = rtrim($febtype_str,',');
              }


        }

            $data_array = $this->match_serialize($ids,$color_str,$size_str,$febpat_str,$febtype_str);

            if(!empty($fromprice) && !empty($toprice)){

             if(!empty($data_array)){
                  $productsh = DB::table('ecollection_products')
               ->where('product_status' , '=' ,'1')
               ->join('ecollection_proimgs', 'ecollection_proimgs.product_id', '=', 'ecollection_products.id')
               ->select('ecollection_products.*','ecollection_proimgs.main_img')
               ->whereIn('ecollection_products.id' , $data_array)
               ->whereBetween('product_mrp', [$fromprice, $toprice])
               ->groupBy('ecollection_products.id')
               ->get();
             }else{
                $productsh = DB::table('ecollection_products')
               ->where('product_status' , '=' ,'1')
               ->join('ecollection_proimgs', 'ecollection_proimgs.product_id', '=', 'ecollection_products.id')
               ->select('ecollection_products.*','ecollection_proimgs.main_img')
               ->whereBetween('product_mrp', [$fromprice, $toprice])
               ->groupBy('ecollection_products.id')
               ->get();
             }

            }else{

              $productsh = DB::table('ecollection_products')
             ->where('product_status' , '=' ,'1')
             ->join('ecollection_proimgs', 'ecollection_proimgs.product_id', '=', 'ecollection_products.id')
             ->select('ecollection_products.*','ecollection_proimgs.main_img')
             ->whereIn('ecollection_products.id' , $data_array)
             ->groupBy('ecollection_products.id')
             ->get();

            }


        }else{

        $productsh = DB::table('ecollection_products')
        ->orwhere('main_catid' , '=' ,$ids)
        ->where('product_status' , '=' ,'1')
         ->orwhere('cat_id' , '=' ,$ids)
		  ->where('product_status' , '=' ,'1')
        ->join('ecollection_proimgs', 'ecollection_proimgs.product_id', '=', 'ecollection_products.id')
        ->select('ecollection_products.*','ecollection_proimgs.main_img')
        ->groupBy('ecollection_products.id')
        ->get();

        }

        return response()->json(array('sum'=> $productsh), 200);

    }


  public function match_serialize($id,$color,$size,$febpat_str,$febtype_str)
    {
       $fil1 = array();
       $fil2 = array();
       $fpnew = array();
       $ftnew = array();

       $productsh = DB::table('ecollection_products')
       ->orwhere('main_catid' , '=' ,$id)
       ->where('product_status' , '=' ,'1')
       ->orwhere('cat_id' , '=' ,$id)
	   ->where('product_status' , '=' ,'1')
      // ->whereIn('product_color','=',$c)
       ->join('ecollection_proimgs', 'ecollection_proimgs.product_id', '=', 'ecollection_products.id')
       ->select('ecollection_products.*')
       ->groupBy('ecollection_products.id')
       ->get();

           foreach ($color as  $key => $value) {

              foreach ($productsh as $pr)
			  {
					if($pr->product_color!='')
					{
					   $col = unserialize($pr->product_color);
					   $r = in_array($value['color'] , $col);

					   if($r == TRUE)
					   {

						 $fil1[] = $pr->id;

					   }
					}else{
						continue;
					}

             }

           }

           foreach ($size as $key => $value) {

              foreach ($productsh as $pr) {

                 if($pr->product_size!='')
				{
				   $col = unserialize($pr->product_size);
                   $r = in_array($value['size'] , $col);
                   if($r == TRUE)
                   {

                     $fil2[] = $pr->id;

                   }else{

                   }

			  }else{
					continue;
				}


             }
           }


          $fil1 = array_unique($fil1);
          $fil2 = array_unique($fil2);

          if(count($fil1) > 0 && count($fil2) > 0){
            $result = array_intersect($fil1, $fil2);
          }else{
            $result = array_merge($fil1, $fil2);
          }

          if(trim($febpat_str) !=''){
            $febpat = explode(',', $febpat_str);
            $productfp = DB::table('ecollection_products')
            ->where('main_catid' , '=' ,$id)
             ->where('product_status' , '=' ,'1')
             ->join('ecollection_proimgs', 'ecollection_proimgs.product_id', '=', 'ecollection_products.id')
             ->select('ecollection_products.id')
             ->whereIn('ecollection_products.product_pattern' , $febpat)
             ->groupBy('ecollection_products.id')
             ->get()->toArray();

             foreach ($productfp as $pkey => $pvalue) {
              array_push($fpnew,$pvalue->id);
            }


          }

          if(trim($febtype_str) !=''){
            $febtype = explode(',', $febtype_str);
            $productft = DB::table('ecollection_products')
            ->where('main_catid' , '=' ,$id)
             ->where('product_status' , '=' ,'1')

             ->join('ecollection_proimgs', 'ecollection_proimgs.product_id', '=', 'ecollection_products.id')
             ->select('ecollection_products.id')
             ->whereIn('ecollection_products.fabric_type' , $febtype)
             ->groupBy('ecollection_products.id')
             ->get()->toArray();

             foreach ($productft as $tkey => $tvalue) {
              array_push($ftnew,$tvalue->id);
            }

          }

          if(count($fpnew) > 0 && count($ftnew) > 0){
            $result1 = array_intersect($fpnew, $ftnew);
          }else{
            $result1 = array_merge($fpnew, $ftnew);
          }


          if(count($result1) > 0 && count($result) > 0){
            $result2 = array_intersect($result1,$result);
          }else{
            $result2 = array_merge($result1,$result);
          }

          return $result2;

    }


    public function productDetails($id)
    {

        if($id != ''){
           $wpm = '';
           $mpdata = EcollectionProduct::select('*')->where('id','=',$id)->where('product_status','=',1)->find($id);
            if($mpdata != ''){
                 $mpcount  = EcollectionRelated::select('id')->where('product_id','=',$mpdata->id)->count();
				           if($mpcount>0){
					            $mprel  = EcollectionRelated::select('*')->where('product_id','=',$mpdata->id)->first();

					             if($mprel->relateds_id!=''){
						                 $reld = $mprel->relateds_id;

					                 }else{
						                  $reld = '';
					                  }


				            }else{
					            $reld = '';
				           }

                $soc = Socialicon::select('name','url')->where('status' , '=' ,'ACTIVE')->get();
                $proimg = EcollectionProimg::select('*')->where('product_id','=',$mpdata->id)->orderBy('id', 'asc')->get();
                  //$id = Auth::user()->id;
                  if(Auth::check())
                  {

                     $uid = Auth::user()->id;
                     $chk = $this->check_wishlistproduct($id,$uid);
                     if($chk != '')
                     {
                       $wpm = 1;
                     }
                     return view('product.ecollection_details')->with(compact('soc','mpdata','proimg','reld','wpm'));

                  }
                  else{

                    return view('product.ecollection_details')->with(compact('soc','mpdata','proimg','reld','wpm'));
                  }

            }else{
				return view::make('errors/404');
			}
        }
        else
        {
          return false;
        }
    }



     public function get_product_frientlink(Request $request)
     {

        $request->proID;

         $ecproimg = EcollectionProimg::select('thumb_img')->where('product_id','=',$request->proID)->limit(1)->first();
         $ecpropro = EcollectionProduct::select('product_mrp','product_offer_rate','product_size','quality_desc','product_name','main_catid')->where('id','=',$request->proID)->first();
         //print_r($ecproimg->main_img);
         //exit();
          if($ecpropro->product_offer_rate == 0)
          {
             $mrp = $ecpropro->product_mrp;
          }else{
            $mrp = $ecpropro->product_offer_rate;
          }
           //$col  = unserialize($ecpropro->product_color);
         if($ecpropro->product_size!=''){
           $siz  = unserialize($ecpropro->product_size);
		   $pp=1;
		   }else{
			   $siz='';
			    $pp=2;
		   }

            $emaildata = [
               'mrp'       =>  $mrp,
               'prod_name' =>  $ecpropro->product_name,
               'catId'     =>  $ecpropro->main_catid,
               'siz'       =>  $siz,
               'desc'      =>  $ecpropro->quality_desc,
               'main_img'  =>  $ecproimg->thumb_img,
               'proID'     =>  $request->proID,
			   'pp'     =>  $pp,
            ];
            Mail::to($request->user_email)->send(new RefFriendLink($emaildata));
            Session::flash('message','E-mail has been Sent Successfully to friend');
            return redirect()->back();
     }

     public function check_wishlistproduct($p,$u)
     {
        $d = EcollectionWishlist::select('*')->where('product_id','=',$p)->where('user_id','=',$u)->first();
        if($d != '')
        {
          return $d;
        }
        else
        {
          return '';
        }
     }

     public function save_wishlist($id)
     {
       if($id != '')
       {
          if(Auth::check())
          {
            $uid = Auth::user()->id;
             $res =$this->check_wishlistproduct($id,$uid);
             if($res != '')
             {
               $wishlist = "Product already add in wishlist";
               return response()->json(array('allready'=> $wishlist), 200);
             }else{
               $outsto =  Helpers::product_outofstock($id);
               if($outsto == 0){
                $wishlist = new EcollectionWishlist;
               $wishlist->product_id = $id;
               $wishlist->user_id = $uid;
               $wishlist->save();
               $wishlist = "Successfully added in wishlist";
                  return response()->json(array('sucess'=> $wishlist), 200);

               }else{
                $wishlist = new EcollectionWishlist;
               $wishlist->product_id = $id;
               $wishlist->user_id = $uid;
               $wishlist->out_ofstock_sta = 1;
               $wishlist->save();
               $wishlist = "Successfully added in wishlist";
                  return response()->json(array('sucess'=> $wishlist), 200);

               }

             }


          }
          else
          {

             return response()->json(array('checks'=> 'login'), 200);

          }
       }
     }

     public function productget(Request $request)
     {

      if(Session::has('carts')) {
        $cartsess=Session::get('carts');
      }else{
       $carts=md5(microtime().rand());
       $cartsess=Session::put('carts', $carts);
     }


     if (Auth::check())
     {
      $userid=Auth::user()->id;
      $cartuser = Cart::select('id')->where('user_id' ,'=' , $userid)->count();
      if($cartuser>0){
        DB::table('carts')->where('user_id', $userid)->update(['cart_sessionid' => $cartsess]);
      }
    }else{
      $userid=Null;
    }

    $proid= $request['productid'];
    $size= $request['size'];
    $color= '';
    $qty= $request['qty'];

      /*$proid= 9;
      $size= 'SL';
      $color= 'RED';
      $qty= 2;*/
      //product_type

      $prodetail = EcollectionProduct::select('*')->where('id' ,'=' , $proid)->first();
      $catid=$prodetail->cat_id;
      $mrp=$prodetail->product_mrp;
      $offerp=$prodetail->product_offer_rate;
	  $proimg=Helpers::get_proimg($proid);
	  $producttype=$prodetail->product_type;

      if($producttype==0){
		  $catname=Category::getcatname($catid);
		  $catname=$catname->name;
		  $subcatname=Category::getcatname($prodetail->main_catid);
		  $subcatname=$subcatname->name;
		  $pattern=Helpers::get_pattern($prodetail->product_pattern);
		  $fabtype=Helpers::get_fabtype($prodetail->fabric_type);
		  $ri=0;
		  $protype=1;

		  $eTailorObj=[
		  'oprodName'=>addslashes($prodetail->product_name),
		  'oprodType'=>addslashes($catname),
		  'subprotype'=>addslashes($subcatname),
		  'ocatID'=>$catid,
		  'mailcatID'=>$prodetail->main_catid,
		  'procode'=>$prodetail->sku_code,
		  'ofabricName'=>addslashes($prodetail->fabric_name),
		  'fabdesc'=>addslashes($prodetail->fabric_dec),
		  'fabbrand'=>addslashes($prodetail->fabric_brand),
		  'ofabricType'=>addslashes($fabtype),
		  'productPrice'=>$mrp,
		  'offerPrice'=>$offerp,
		  'color'=>$color,
		  'colordes'=>addslashes($prodetail->color_desc),
		  'pattern'=>addslashes($pattern),
		  'qualitydesc'=>addslashes($prodetail->quality_desc),
		  'osizeType'=>'inch',
		  'osizeFit'=>$size,
		  'oqty'=>1
		  ];

	  $prodes=serialize($eTailorObj);
	  $cussingal=0;
	  $fabid='';
	  $groupid='';
	  $fabimg='';

	  }else{
		 $protype=0;
		  $prodes=$prodetail->custom_description;
		  $description=unserialize($prodetail->custom_description);
		  $fabid=$description['ofabric'];
		  $groupid=$description['ofabricType'];
		  $cussingal=1;
		  $fabimg=$description['ofabricImage'];

	  }
      if($offerp==0 || $offerp==''){
		  $mainprice=$mrp;
	  }else{
		  $mainprice=$offerp;
	  }


      for($i=0;$i<$qty;$i++){

        $cartSet = [
          'cart_sessionid' => $cartsess,
          'cat_id' => $catid,
          'user_id' => $userid,
          'product_id' => $proid,
          'product_type' => $protype,
          'custom_single' => $cussingal,
          'group_id' => $groupid,
          'fabric_id' => $fabid,
          'fabric_image' => $fabimg,
          'fabric_name' => addslashes($prodetail->fabric_name),
          'item_description' => $prodes,
          'canvas_front_img' => $proimg[0],
          'canvas_back_img' => $proimg[1],
          'price' => $mainprice,
          'qty' => 1,
          'shipping' => 0.00,
          'shipping' => 0.00,
          'total' => $mainprice,
          'created_at' => date('y-m-d H:i:s'),
          'updated_at' => date('y-m-d H:i:s'),
        ];

        $ids = DB::table('carts')->insert($cartSet);
      //$cartId = DB::getPdo()->lastInsertId();

      }


      return Redirect::to('/cart');

    }

    public function wishtocart($id, Request $request)
    {
        // return $request;
        if(Session::has('carts')) {
            $cartsess=Session::get('carts');
          }else{
           $carts=md5(microtime().rand());
           $cartsess=Session::put('carts', $carts);
         }
        // $product = EcollectionProduct::where('id', $id)->first();
        // $addCart = new Cart();
        // $addCart->cart_sessionid = $cartsess;
        // $addCart->user_id = auth()->user()->id;
        // $addCart->cat_id = $product->cat_id;
        // $addCart->product_id = $product->id;
        // $addCart->fabric_name = $product->fabric_name;
        // $addCart->canvas_front_img = '';
        // $addCart->canvas_back_img = '';
        // $addCart->price = $product->product_offer_rate;
        // $addCart->total = $product->product_offer_rate;
        // $addCart->qty = 1;
        // $addCart->item_description = serialize($product);
        // $addCart->save();

        $proid= $id;
        $size= $request->size;
        $color= '';
        $qty= 1;
         $userid = auth()->user()->id;

          $prodetail = EcollectionProduct::select('*')->where('id' ,'=' , $proid)->first();
          $catid=$prodetail->cat_id;
          $mrp=$prodetail->product_mrp;
          $offerp=$prodetail->product_offer_rate;
          $proimg=Helpers::get_proimg($proid);
          $producttype=$prodetail->product_type;

          if($producttype==0){
              $catname=Category::getcatname($catid);
              $catname=$catname->name;
              $subcatname=Category::getcatname($prodetail->main_catid);
              $subcatname=$subcatname->name;
              $pattern=Helpers::get_pattern($prodetail->product_pattern);
              $fabtype=Helpers::get_fabtype($prodetail->fabric_type);
              $ri=0;
              $protype=1;

              $eTailorObj=[
              'oprodName'=>addslashes($prodetail->product_name),
              'oprodType'=>addslashes($catname),
              'subprotype'=>addslashes($subcatname),
              'ocatID'=>$catid,
              'mailcatID'=>$prodetail->main_catid,
              'procode'=>$prodetail->sku_code,
              'ofabricName'=>addslashes($prodetail->fabric_name),
              'fabdesc'=>addslashes($prodetail->fabric_dec),
              'fabbrand'=>addslashes($prodetail->fabric_brand),
              'ofabricType'=>addslashes($fabtype),
              'productPrice'=>$mrp,
              'offerPrice'=>$offerp,
              'color'=>$color,
              'colordes'=>addslashes($prodetail->color_desc),
              'pattern'=>addslashes($pattern),
              'qualitydesc'=>addslashes($prodetail->quality_desc),
              'osizeType'=>'inch',
              'osizeFit'=>$size,
              'oqty'=>1
              ];

          $prodes=serialize($eTailorObj);
          $cussingal=0;
          $fabid='';
          $groupid='';
          $fabimg='';

          }else{
             $protype=0;
              $prodes=$prodetail->custom_description;
              $description=unserialize($prodetail->custom_description);
              $fabid=$description['ofabric'];
              $groupid=$description['ofabricType'];
              $cussingal=1;
              $fabimg=$description['ofabricImage'];

          }
          if($offerp==0 || $offerp==''){
              $mainprice=$mrp;
          }else{
              $mainprice=$offerp;
          }


          for($i=0;$i<$qty;$i++){

            $cartSet = [
              'cart_sessionid' => $cartsess,
              'cat_id' => $catid,
              'user_id' => $userid,
              'product_id' => $proid,
              'product_type' => $protype,
              'custom_single' => $cussingal,
              'group_id' => $groupid,
              'fabric_id' => $fabid,
              'fabric_image' => $fabimg,
              'fabric_name' => addslashes($prodetail->fabric_name),
              'item_description' => $prodes,
              'canvas_front_img' => $proimg[0],
              'canvas_back_img' => $proimg[1],
              'price' => $mainprice,
              'qty' => 1,
              'shipping' => 0.00,
              'shipping' => 0.00,
              'total' => $mainprice,
              'created_at' => date('y-m-d H:i:s'),
              'updated_at' => date('y-m-d H:i:s'),
            ];

            $ids = DB::table('carts')->insert($cartSet);
          //$cartId = DB::getPdo()->lastInsertId();

          }

        return redirect('/cart');
    }


	public function cusprodetail($id='')
    {
			if($id!=''){

				$count = EcollectionProduct::select('*')->where('id' ,'=' , $id)->where('product_type' ,'=' , 1)->where('product_status' ,'=' , 1)->count();
				$productdata = EcollectionProduct::select('*')->where('id' ,'=' , $id)->first();

				if($count>0){

					if($productdata->cat_id==1){
						return view('product.shirtdetail')->with('productdata',$productdata);
					}elseif($productdata->cat_id==2){
						return view('product.jacketdetails')->with('productdata',$productdata);
					}elseif($productdata->cat_id==3){
						return view('product.vestsdetails')->with('productdata',$productdata);
					}elseif($productdata->cat_id==4){
						return view('product.paintdetails')->with('productdata',$productdata);
					}else{
						return view::make('errors/404');
					}

				}else{
				return view::make('errors/404');
				}

			}else{

				return view::make('errors/404');

			}

    }



  }
