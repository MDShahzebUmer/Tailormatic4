<?php
namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Category;
use App\FabricGroup;
use App\MainAttribute;
use App\AttributeStyle;
use App\Etfabric;
use App\Stylefabimglist;
use App\Contrast;
use App\Button;
use App\ButtonStyleImage;
use App\Thread;
use App\ThreadStyleImage;
use App\MeasurmentVideo;
use Redirect;
use View;
use Illuminate\Support\Collection;
use App\Cart;
use Auth;
use App\CamaignPromoCode;
use App\Http\helpers;
use App\ShippingRate;
use App\Order;
use App\ShippingsAddr;
use App\EcollectionProduct;
use App\CanvasDataurl;

class ThreeDController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     //protected $fabid;
    //public $successfully;
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
    public function index()
    { 
		 $common_name = Helpers::get_degine_FirstInfo(1);
		
		$eTailorObj=[
			'oprodType'=>'Shirts',
			'ocatID'=>'1',
			'ofabricGroup' =>  $common_name['fbgrp_name'],
			'ofabricType'  =>  $common_name['fabric_gid'],
			'ofabricPrice' =>  $common_name['fabric_rate'],
			'ofabric'      =>  $common_name['fabric_eid'],
			'ofabricName'  =>  $common_name['fabric_name'],
			'ofabricImage' =>  $common_name['fabric_img_l'],
			'ofabricList'  =>  $common_name['fabric_img_s'],
			'omonogramMixStatus'=>'false',
			'osleeve'=>'1',
			'osleeveName'=>'Long Sleeve',
			'ofront'=>'4',
			'ofrontName'=>'Single Placket',
			'oback'=>'7',
			'obackName'=>'Plain',
			'obottom'=>'11',
			'obottomName'=>'Tri Tab',
			'ocollar'=>'14',
			'ocollarName'=>'Italian Collar 1 Button',
			'ocollarStay'=>'false',
			'opacket'=>'37', 
			'opacketCount'=>'1',
			'opacketName'=>'No Pocket',
			'ocuff'=>'28',
			'ocuffName'=>'1 Button Round',
			'oshoulder'=>'false',
			'oseams'=>'false',
			'odart'=>'false',
			'ocontrast'=>'1',
			'ocontrastName'=>'Premium White',
			'obutton'=>'1',
			'obuttonName'=>'White Color',
			'obuttonCode'=>'A8',
			'ocollarCuffIn'=>'false',
			'ocollarCuffout'=>'false',
			'ofrontPlacketIn'=>'false',
			'ofrontPlacketOut'=>'false',
			'ofrontBoxOut'=>'false',
			'obackBoxOut'=>'false',
			'obuttonHole'=>'3',
			'obuttonHoleName'=>'White',
			'obuttonHoleCode'=>'A8',
			'obuttonHoleColor'=>'#FFFFFF',
			'obuttonHoleStyle'=>'V',
			'obuttonHoleStyleName'=>'Vertical',
			'omonogram'=>'1',
			'omonogramName'=>'No Monogram',
			'omonogramColor'=>'3',
			'omonogramHoleName'=>'White',
			'omonogramCode'=>'A8',
			'omonogramtextColor'=>'#FFFFFF',
			'omonogramText'=>'',
			'omonogramStyle'=>'italic',
			'osizePattern'=>'Body',
			'osizeStyle'=>'Comfortable',
			'osizeType'=>'inch',
			'osizeFit'=>'',
			'osizeNeck'=>'',
			'osizeChest'=>'',
			'osizeWaist'=>'',
			'osizeHip'=>'',
			'osizeLength'=>'',
			'osizeShoulder'=>'',
			'osizeSleeve'=>'',
			'oqty'=>'1',
			'ofrontView'=>'',
			'obackView'=>'',
			'ocartID'=>''
		];
		
		$mytab="etfabric";
		$mysubtab="fabric1";
		$loadme="0";
		
		
		/* Fabric */
		$id=$eTailorObj['ocatID'];
		$car_record = Category::select('*')->where('id', '=', 1)->first($id);
		$cat_id = $car_record->id;
		$group_record = FabricGroup::select('*')->where('cat_id', '=', $cat_id)->get();
		/* Attribute Style */
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 1)->get();
		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 2)->get();
		return view::make('advance.threed')->with(compact('car_record','group_record','mainattr_record','contrast_record','eTailorObj','mytab','mysubtab','loadme'));
    }
	
	public function getfabdetails() {
		$datacuff=''; $datacollar=''; $datasleeve=''; $datafront=''; $databottom=''; $databack=''; $datapocket=''; $databutton='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		$eTailorObjN['ofabric']=$ff;
		$fabric_record = Etfabric::select('*')->where('id', '=', $ff)->find($ff);
		$fabgrp=$fabric_record->fbgrp_id;
		
		$fabgrup_record = FabricGroup::select('*')->where('id', '=', $fabgrp)->find($fabgrp);
		
		$eTailorObjN['ofabricGroup']=$fabgrup_record->fbgrp_name;
		$eTailorObjN['ofabricType']=$fabgrp;
		$eTailorObjN['ofabricPrice']=$fabgrup_record->fabric_rate;
		$eTailorObjN['ofabricName']=$fabric_record->fabric_name;
		$eTailorObjN['ofabricImage']=$fabric_record->fabric_img_l;
		$eTailorObjN['ofabricList']=$fabric_record->fabric_img_s;
		/*Collar*/
		$datacollar=$datacollar.'<div class="et-modal-header"><h4>Choose your Collar Style</h4><span class="ad-option-collar et-oc" onClick="hidediv(\'et-coller-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-carousel"><div id="est-item-8" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
        
		$stylolrci=1; $stylecolrlst = AttributeStyle::select('*')->where('attri_id','=',8)->get();
        foreach($stylecolrlst as $stylcolrlst){
			if($stylolrci==8){ $datacollar=$datacollar.'</ul></div><div class="item"><ul class="et-item-list">';  $stylolrci=1;}
			$datacollar=$datacollar.' <li class="et-item" id="optionlist-8-'.$stylcolrlst->id.'" data-title="'.$stylcolrlst->style_name.'" title="'.$stylcolrlst->style_name.'" onClick="javascript:getstycollars('.$stylcolrlst->id.');">';
			
			$stylecolrimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylcolrlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
			foreach($stylecolrimglst as $colrls){
				$datacollar=$datacollar.'<figure class="et-item-img"><img src="'.$paths.'/'.$colrls->list_img.'" alt="'.$colrls->style_name.'">';
			
				$thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcolrlst->id)->where('attri_id' , '=' , $stylcolrlst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
				foreach($thrdimglst as $thrdls){
					$datacollar=$datacollar.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$colrls->style_name.'">';
				}
				
				$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcolrlst->id)->where('attri_id' , '=' , $stylcolrlst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
				foreach($buttimglst as $buttls){
					$datacollar=$datacollar.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$colrls->style_name.'">';
				}
				$datacollar=$datacollar.'</figure>';
			}
			if($stylcolrlst->id==$eTailorObjN['ocollar']){ $datacollar=$datacollar.'<div class="icon-check"></div>';}
			$datacollar=$datacollar.'</li>';
			
			$stylolrci++;
		}
        $datacollar=$datacollar.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#est-item-8" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/advance/img/ar-left.png"></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#est-item-8" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/advance/img/ar-right.png"></span><span class="sr-only">Next</span></a></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-coller-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="javascript:goNextColr();">Next</button></div>';
		/*Sleeves*/
		$datasleeve=$datasleeve.'<div class="et-modal-header"><h4>1. Please Choose Sleeve Style</h4><span class="ad-option-sleeve et-oc"  onClick="hidediv(\'et-sleeve-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-block"><div class="et-choose-style"><ul>';
        
		$styleslevlst = AttributeStyle::select('*')->where('attri_id','=',4)->get();
        foreach($styleslevlst as $stylslevlst){
        	$datasleeve=$datasleeve.' <li class="et-item" id="optionlist-4-'.$stylslevlst->id.'" data-title="'.$stylslevlst->style_name.'" title="'.$stylslevlst->style_name.'" onClick="javascript:getstysleeves('.$stylslevlst->id.');">';
            $styleslevimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylslevlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
            foreach($styleslevimglst as $slevls){
				$datasleeve=$datasleeve.'<figure class="et-item-style"><img src="'.$paths.'/'.$slevls->list_img.'" alt="'.$slevls->style_name.'" /></figure>';
				if($stylslevlst->id==$eTailorObjN['osleeve']){$datasleeve=$datasleeve.'<div class="icon-check"></div>';}
			}
            $datasleeve=$datasleeve.'</li>';
		}
        $datasleeve=$datasleeve.'</ul></div><div class="et-options-more"><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['oshoulder']=="true"){$datasleeve=$datasleeve.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" checked onClick="javascript:getepaulette('.$eTailorObjN['oshoulder'].');">';} else {$datasleeve=$datasleeve.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" onClick="javascript:getepaulette('.$eTailorObjN['oshoulder'].');">';}
        $datasleeve=$datasleeve.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Epaulettes</label></div></div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-sleeve-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-sleeve-fabric\');">Done</button></div>';
		/*Front*/
		$datafront=$datafront.'<div class="et-modal-header"><h4>1. Choose your Front Style</h4><span class="ad-option-front et-oc" onClick="hidediv(\'et-front-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-front"><div class="et-select-style"><ul>';
        
		$stylefrntlst = AttributeStyle::select('*')->where('attri_id','=',5)->get();
        foreach($stylefrntlst as $stylfrntlst){
        	$datafront=$datafront.' <li class="et-item" id="optionlist-5-'.$stylfrntlst->id.'" data-title="'.$stylfrntlst->style_name.'" title="'.$stylfrntlst->style_name.'" onClick="javascript:getstyfronts('.$stylfrntlst->id.');">';
        
			$stylefrntimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylfrntlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
        	foreach($stylefrntimglst as $frntls){
        		$datafront=$datafront.'<figure class="et-item-style"><img src="'.$paths.'/'.$frntls->list_img.'" alt="'.$frntls->style_name.'" />';
				$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylfrntlst->id)->where('attri_id' , '=' , $stylfrntlst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
                foreach($buttimglst as $buttls){
                $datafront=$datafront.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$frntls->style_name.'">';
				}
				$datafront=$datafront.'</figure>';
                if($stylfrntlst->id==$eTailorObjN['ofront']){$datafront=$datafront.'<div class="icon-check"></div>';}
			}
            $datafront=$datafront.'</li>';
		}
        $datafront=$datafront.'</ul><div class="et-options-more"><div class="et-check-box"><div class="checkbox"><label>';
        if($eTailorObjN['oseams']=="true"){ $datafront=$datafront.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" checked onClick="javascript:getfrontoptions('.$eTailorObjN['oseams'].',\'Seams\');">'; } else {$datafront=$datafront.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['oseams'].',\'Seams\');">';}
        $datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>2. Seams</label></div></div></div></div><div class="et-select-style check-box-style"><ul><li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/InSide.png"/></figure><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $datafront=$datafront.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" checked onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\');">';} else {$datafront=$datafront.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\');">';}
        $datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside</label></div></li><li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/OutSide.png"/></figure><div class="checkbox"><label>';
        if($eTailorObjN['ofrontPlacketOut']=="true"){ $datafront=$datafront.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" checked onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\');">';} else {$datafront=$datafront.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\');">';}
		$datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside</label></div></li>';
        if($eTailorObjN['ofront']==5){$datafront=$datafront.'<li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/FrontBox.png"/></figure><div class="checkbox"><label>';
        if($eTailorObjN['ofrontBoxOut']=="true"){ $datafront=$datafront.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" checked onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\');">';} else {$datafront=$datafront.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\');">';}
        $datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box</label></div></li>';
		}
        $datafront=$datafront.'</ul></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-front-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-front-fabric\');">Done</button></div>';
		/*Cuffs*/
		$datacuff=$datacuff.'<div class="et-modal-header"><h4>Choose From 9 Cuff Style</h4><span class="ad-option-cuffs et-oc" onClick="hidediv(\'et-cuffs-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-cuff"><div class="et-select-style"><ul>';
        $stylecufflst = AttributeStyle::select('*')->where('attri_id','=',9)->get();
        foreach($stylecufflst as $stylcufflst){
        	$datacuff=$datacuff.' <li  class="et-item" id="optionlist-9-'.$stylcufflst->id.'" data-title="'.$stylcufflst->style_name.'" title="'.$stylcufflst->style_name.'" onClick="javascript:getstycuffs('.$stylcufflst->id.');">';
        	$stylecuffimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylcufflst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
        	foreach($stylecuffimglst as $cuffls){
            	$datacuff=$datacuff.'<figure class="et-item-style"><img src="'.$paths.'/'.$cuffls->list_img.'" alt="'.$cuffls->style_name.'" />';
                $thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcufflst->id)->where('attri_id' , '=' , $stylcufflst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
                foreach($thrdimglst as $thrdls){
                $datacuff=$datacuff.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$cuffls->style_name.'">';
				}
                $buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcufflst->id)->where('attri_id' , '=' , $stylcufflst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
                foreach($buttimglst as $buttls){
                $datacuff=$datacuff.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$cuffls->style_name.'">';
				}
                $datacuff=$datacuff.'</figure>';
                if($stylcufflst->id==$eTailorObjN['ocuff']){$datacuff=$datacuff.'<div class="icon-check"></div>';}
			}
            $datacuff=$datacuff.'</li>';
		}
        $datacuff=$datacuff.'</ul></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-cuffs-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="javascript:goNextCuff();">Next</button></div>';
		/*Bottom*/
		$databottom=$databottom.'<div class="et-modal-header"><h4>Bottom Style</h4><span class="ad-option-bottom et-oc" onClick="hidediv(\'et-bottom-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-bottom"><div class="et-select-style"><ul>';
        $stylebotmlst = AttributeStyle::select('*')->where('attri_id','=',7)->get();
        foreach($stylebotmlst as $stylbotmlst){
        	$databottom=$databottom.' <li class="et-item" id="optionlist-7-'.$stylbotmlst->id.'" data-title="'.$stylbotmlst->style_name.'" title="'.$stylbotmlst->style_name.'" onClick="javascript:getstybottoms('.$stylbotmlst->id.');">';
            $stylebotmimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylbotmlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
        	foreach($stylebotmimglst as $botmls){
            $databottom=$databottom.'<figure class="et-item-style"><img src="'.$paths.'/'.$botmls->list_img.'" alt="'.$botmls->style_name.'" /></figure>';
            if($stylbotmlst->id==$eTailorObjN['obottom']){ $databottom=$databottom.'<div class="icon-check"></div>';}
			}
            $databottom=$databottom.'</li>';
		}
        $databottom=$databottom.'</ul></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-bottom-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-bottom-fabric\');">Done</button></div>';
		/*Pockets*/
		$datapocket=$datapocket.'<div class="et-modal-header"><h4>Select Pocket Style</h4><span class="ad-option-pockts et-oc" onClick="hidediv(\'et-pockts-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-cuff"><div class="et-select-style"><ul>';
        $stylepocktlst = AttributeStyle::select('*')->where('attri_id','=',10)->get();
        foreach($stylepocktlst as $stylpocktlst){
        	$datapocket=$datapocket.' <li class="et-item" id="optionlist-10-'.$stylpocktlst->id.'" data-title="'.$stylpocktlst->style_name.'" title="'.$stylpocktlst->style_name.'" onClick="javascript:getstypockets('.$stylpocktlst->id.');">';
        	$stylepocktimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylpocktlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
            if($stylpocktlst->id == 37){
            	$datapocket=$datapocket.'<figure class="et-item-style"><img src="'.$p[0].'/advance/img/none.jpg" alt="'.$stylpocktlst->style_name.'"></figure>';
            	if($stylpocktlst->id == $eTailorObjN['opacket']){$datapocket=$datapocket.'<div class="icon-check"></div>';}
			}else{
                foreach($stylepocktimglst as $pocktls){
					$datapocket=$datapocket.'<figure class="et-item-style"><img src="'.$paths.'/'.$pocktls->list_img.'" alt="'.$pocktls->style_name.'" />';
					$thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylpocktlst->id)->where('attri_id' , '=' , $stylpocktlst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
					foreach($thrdimglst as $thrdls){
					$datapocket=$datapocket.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$pocktls->style_name.'">';
					}
					$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylpocktlst->id)->where('attri_id' , '=' , $stylpocktlst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
					foreach($buttimglst as $buttls){
					$datapocket=$datapocket.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$pocktls->style_name.'">';
					}
					$datapocket=$datapocket.'</figure>';
					if($stylpocktlst->id==$eTailorObjN['opacket']){ $datapocket=$datapocket.'<div class="icon-check"></div>';}
				}
			}
            $datapocket=$datapocket.'</li>';
		}
        $datapocket=$datapocket.'</ul><div class="et-fw text-center">';
		if($eTailorObjN['opacket']!=37){
		$datapocket=$datapocket.'<div class="et-btn-group"><div class="et-btn-select"><select class="selectpicker btn-primary" name="pocketstxt" id="pocketstxt" onChange="javascript:getnumpockets(this.value);">';
		if($eTailorObjN['opacketCount']=="1"){$datapocket=$datapocket.'<option value="1" selected >1 Pocket</option>';} else {$datapocket=$datapocket.'<option value="1" >1 Pocket</option>';}
		if($eTailorObjN['opacketCount']=="2"){$datapocket=$datapocket.'<option value="2" selected>2 Pockets</option>';} else {$datapocket=$datapocket.'<option value="2">2 Pockets</option>';}
		$datapocket=$datapocket.'</select></div></div>';
		}
		$datapocket=$datapocket.'</div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-pockts-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-pockts-fabric\');">Done</button></div>';
		/*BACK*/
		$databack=$databack.'<div class="et-modal-header"><h4>1. Choose your Back Style</h4><span class="ad-option-back et-oc" onClick="hidediv(\'et-back-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-back"><div class="et-select-style"><ul>';
        $stylebacklst = AttributeStyle::select('*')->where('attri_id','=',6)->get();
        foreach($stylebacklst as $stylbacklst){
        	$databack=$databack.' <li class="et-item" id="optionlist-6-'.$stylbacklst->id.'" data-title="'.$stylbacklst->style_name.'" title="'.$stylbacklst->style_name.'" onClick="javascript:getstybacks('.$stylbacklst->id.');">';
            $stylebackimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylbacklst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
            foreach($stylebackimglst as $backls){
            	$databack=$databack.'<figure class="et-item-style"><img src="'.$paths.'/'.$backls->list_img.'" alt="'.$backls->style_name.'" /></figure>';
                if($stylbacklst->id==$eTailorObjN['oback']){$databack=$databack.'<div class="icon-check"></div>';}
			}
            $databack=$databack.'</li>';
		}
        $databack=$databack.'</ul>';                                                        
        if($eTailorObjN['oback']==7 || $eTailorObjN['oback']==8){
        	$databack=$databack.'<div class="et-options-more"><div class="et-check-box"><div class="checkbox"><label>';
        	if($eTailorObjN['odart']=="true"){$databack=$databack.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" checked onClick="javascript:getbackoptions('.$eTailorObjN['odart'].',\'Darts\');" >';}else {$databack=$databack.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" onClick="javascript:getbackoptions('.$eTailorObjN['odart'].',\'Darts\');" >';}
            $databack=$databack.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>2. Darts</label></div></div></div>';
		}
        $databack=$databack.'</div>';
        $databack=$databack.'<div class="et-select-style check-box-style"><ul>';
        if($eTailorObjN['oback']==8){
			$databack=$databack.'<li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/Box.png"/></figure><div class="checkbox"><label>';
			if($eTailorObjN['obackBoxOut']=="true"){ $databack=$databack.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" checked onClick="javascript:getbackoptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\');" >';} else {$databack=$databack.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" onClick="javascript:getbackoptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\');" >';}
			$databack=$databack.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Placket</label></div></li>';
		}
        $databack=$databack.'</ul></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-back-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-back-fabric\');">Done</button></div>';
		/*Buttons*/
		$databutton=$databutton.'<div class="et-modal-header"><h4>Button / Hole Thread Color</h4><span class="ad-option-button et-oc" onClick="hidediv(\'et-buttons-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-2"><div class="preview-box"><figure class="ad-selected-item"><div id="design-3D-pro-button-color"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg"><img src="'.$paths.'/Shirts/Threads/'.$eTailorObjN['obuttonHoleStyle'].'/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Buttons/'.$eTailorObjN['obutton'].'.png"><img src="'.$paths.'/Shirts/Threads/C/'.$eTailorObjN['obuttonHole'].'.png"></div></figure></div>';
        $databutton=$databutton.'<div class="et-options-more"><div class="et-sm-carousel"><h5>1. Choose your Button color</h5><div class="et-contrast-list"><ul class="et-item-list">';
        $contbuttlst = Button::select('*')->where('cat_id','=',1)->get(); 
		foreach($contbuttlst as $cbuttnlst){
			$databutton=$databutton.' <li class="et-item" onClick="javascript:getstybuttons('.$cbuttnlst->id.',\'11\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cbuttnlst->button_img.'" alt="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')" /></figure>';
        	if($cbuttnlst->id==$eTailorObjN['obutton']){ $databutton=$databutton.'<div class="icon-check"></div>';}
         	$databutton=$databutton.'</li>';
		}
        $databutton=$databutton.'</ul></div></div><div class="et-sm-carousel"><h5>2. Thread Color</h5><div class="et-contrast-list"><ul class="et-item-list">';
		$contthrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
		foreach($contthrdlst as $cthreadlst){
       		$databutton=$databutton.' <li class="et-item" onClick="javascript:getstybuttons('.$cthreadlst->id.',\'12\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cthreadlst->thrd_img.'" alt="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')" /></figure>';
            if($cthreadlst->id==$eTailorObjN['obuttonHole']){ $databutton=$databutton.'<div class="icon-check"></div>';}
            $databutton=$databutton.'</li>';
		}
        $databutton=$databutton.'</ul></div></div><div class="et-sm-carousel"><h5>3. Buttons Hole Style</h5><div class="et-contrast-list">';
        $contthrdstyllst = Thread::select('*')->where('cat_id','=',1)->where('id','=',$eTailorObjN['obuttonHole'])->get(); 
        foreach($contthrdstyllst as $cthrdstyllst){
        	$databutton=$databutton.'<ul class="et-item-list"><li class="et-item" onClick="javascript:getstybuttons(\'V\',\'13\');"><figure class="et-item-img"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg"/><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_vertical.'"/></figure>';
        	if($eTailorObjN['obuttonHoleStyle']=='V'){ $databutton=$databutton.'<div class="icon-check"></div>';}
            $databutton=$databutton.'</li> <li class="et-item" onClick="javascript:getstybuttons(\'H\',\'13\');"><figure class="et-item-img"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg"/><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_horizontal.'"/></figure>';
            if($eTailorObjN['obuttonHoleStyle']=='H'){ $databutton=$databutton.'<div class="icon-check"></div>';}
            $databutton=$databutton.'</li> <li class="et-item" onClick="javascript:getstybuttons(\'S\',\'13\');"><figure class="et-item-img"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg"/><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_slanted.'"/></figure>';
            if($eTailorObjN['obuttonHoleStyle']=='S'){ $databutton=$databutton.'<div class="icon-check"></div>';}
            $databutton=$databutton.'</li></ul>';
		}
       	$databutton=$databutton.'</div></div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-buttons-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-buttons-fabric\');">Done</button></div>';
		
		$data = ['1' => $datacuff,'2' => $eTailorObjN,'3' => $fabgrp,'4' => $datacollar,'5' => $datasleeve,'6' => $datafront,'7' => $databottom,'8' => $datapocket,'9' => $databack,'10' => $databutton];
		return $data;
	}
	
	public function getcollardetails(){
		$datacollar='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$ffbid=$eTailorObjN['ofabric'];
		$eTailorObjN['ocollar']=$ff;
		$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
		$eTailorObjN['ocollarName']=$style_record->style_name;
		
		/*Collar*/
		$datacollar=$datacollar.'<div class="et-modal-header"><h4>Choose your Collar Style</h4><span class="ad-option-collar et-oc" onClick="hidediv(\'et-coller-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-carousel"><div id="est-item-8" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
        
		$stylolrci=1; $stylecolrlst = AttributeStyle::select('*')->where('attri_id','=',8)->get();
        foreach($stylecolrlst as $stylcolrlst){
			if($stylolrci==8){ $datacollar=$datacollar.'</ul></div><div class="item"><ul class="et-item-list">';  $stylolrci=1;}
			$datacollar=$datacollar.' <li class="et-item" id="optionlist-8-'.$stylcolrlst->id.'" data-title="'.$stylcolrlst->style_name.'" title="'.$stylcolrlst->style_name.'" onClick="javascript:getstycollars('.$stylcolrlst->id.');">';
			
			$stylecolrimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylcolrlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
			foreach($stylecolrimglst as $colrls){
				$datacollar=$datacollar.'<figure class="et-item-img"><img src="'.$paths.'/'.$colrls->list_img.'" alt="'.$colrls->style_name.'">';
			
				$thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcolrlst->id)->where('attri_id' , '=' , $stylcolrlst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
				foreach($thrdimglst as $thrdls){
					$datacollar=$datacollar.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$colrls->style_name.'">';
				}
				
				$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcolrlst->id)->where('attri_id' , '=' , $stylcolrlst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
				foreach($buttimglst as $buttls){
					$datacollar=$datacollar.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$colrls->style_name.'">';
				}
				$datacollar=$datacollar.'</figure>';
			}
			if($stylcolrlst->id==$eTailorObjN['ocollar']){ $datacollar=$datacollar.'<div class="icon-check"></div>';}
			$datacollar=$datacollar.'</li>';
			
			$stylolrci++;
		}
        $datacollar=$datacollar.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#est-item-8" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/advance/img/ar-left.png"></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#est-item-8" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/advance/img/ar-right.png"></span><span class="sr-only">Next</span></a></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-coller-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="javascript:goNextColr();">Next</button></div>';
		
		$data = ['1' => $datacollar,'2' => $eTailorObjN];
		return $data;
	}
	
	public function getsleevedetails(){
		$data='';
		$datasleeve='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$ffbid=$eTailorObjN['ofabric'];
		$eTailorObjN['osleeve']=$ff;
		$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
		$eTailorObjN['osleeveName']=$style_record->style_name;
		
		$datasleeve=$datasleeve.'<div class="et-modal-header"><h4>1. Please Choose Sleeve Style</h4><span class="ad-option-sleeve et-oc"  onClick="hidediv(\'et-sleeve-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-block"><div class="et-choose-style"><ul>';
        
		$styleslevlst = AttributeStyle::select('*')->where('attri_id','=',4)->get();
        foreach($styleslevlst as $stylslevlst){
        	$datasleeve=$datasleeve.' <li class="et-item" id="optionlist-4-'.$stylslevlst->id.'" data-title="'.$stylslevlst->style_name.'" title="'.$stylslevlst->style_name.'" onClick="javascript:getstysleeves('.$stylslevlst->id.');">';
            $styleslevimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylslevlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
            foreach($styleslevimglst as $slevls){
				$datasleeve=$datasleeve.'<figure class="et-item-style"><img src="'.$paths.'/'.$slevls->list_img.'" alt="'.$slevls->style_name.'" /></figure>';
				if($stylslevlst->id==$eTailorObjN['osleeve']){$datasleeve=$datasleeve.'<div class="icon-check"></div>';}
			}
            $datasleeve=$datasleeve.'</li>';
		}
        $datasleeve=$datasleeve.'</ul></div><div class="et-options-more"><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['oshoulder']=="true"){$datasleeve=$datasleeve.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" checked onClick="javascript:getepaulette('.$eTailorObjN['oshoulder'].');">';} else {$datasleeve=$datasleeve.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" onClick="javascript:getepaulette('.$eTailorObjN['oshoulder'].');">';}
        $datasleeve=$datasleeve.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Epaulettes</label></div></div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-sleeve-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-sleeve-fabric\');">Done</button></div>';
		
		if($eTailorObjN['osleeve']!="3"){ $data=$data.'<div class="et-option-inner"><div class="et-icon-check"></div><span class="et-process-number">5. </span><span class="et-style-name" data-lang="cuffs">Cuffs</span><div class="et-line"></div></div>';}
  
		$data = ['1' => $datasleeve,'2' => $eTailorObjN,'3' => $data];
		return $data;
	}
	
	public function getfrontdetails(){
		$data='';
		$datafront='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$ffbid=$eTailorObjN['ofabric'];
		$eTailorObjN['ofront']=$ff;
		$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
		$eTailorObjN['ofrontName']=$style_record->style_name;
		
		/*Front*/
		$datafront=$datafront.'<div class="et-modal-header"><h4>1. Choose your Front Style</h4><span class="ad-option-front et-oc" onClick="hidediv(\'et-front-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-front"><div class="et-select-style"><ul>';
        
		$stylefrntlst = AttributeStyle::select('*')->where('attri_id','=',5)->get();
        foreach($stylefrntlst as $stylfrntlst){
        	$datafront=$datafront.' <li class="et-item" id="optionlist-5-'.$stylfrntlst->id.'" data-title="'.$stylfrntlst->style_name.'" title="'.$stylfrntlst->style_name.'" onClick="javascript:getstyfronts('.$stylfrntlst->id.');">';
        
			$stylefrntimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylfrntlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
        	foreach($stylefrntimglst as $frntls){
        		$datafront=$datafront.'<figure class="et-item-style"><img src="'.$paths.'/'.$frntls->list_img.'" alt="'.$frntls->style_name.'" />';
				$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylfrntlst->id)->where('attri_id' , '=' , $stylfrntlst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
                foreach($buttimglst as $buttls){
                $datafront=$datafront.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$frntls->style_name.'">';
				}
				$datafront=$datafront.'</figure>';
                if($stylfrntlst->id==$eTailorObjN['ofront']){$datafront=$datafront.'<div class="icon-check"></div>';}
			}
            $datafront=$datafront.'</li>';
		}
        $datafront=$datafront.'</ul><div class="et-options-more"><div class="et-check-box"><div class="checkbox"><label>';
        if($eTailorObjN['oseams']=="true"){ $datafront=$datafront.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" checked  onClick="javascript:getfrontoptions('.$eTailorObjN['oseams'].',\'Seams\');">'; } else {$datafront=$datafront.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['oseams'].',\'Seams\');">';}
        $datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>2. Seams</label></div></div></div></div><div class="et-select-style check-box-style"><ul><li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/InSide.png"/></figure><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $datafront=$datafront.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" checked onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\');">';} else {$datafront=$datafront.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\');">';}
        $datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside</label></div></li><li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/OutSide.png"/></figure><div class="checkbox"><label>';
        if($eTailorObjN['ofrontPlacketOut']=="true"){ $datafront=$datafront.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" checked onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\');">';} else {$datafront=$datafront.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\');">';}
		$datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside</label></div></li>';
        if($eTailorObjN['ofront']==5){$datafront=$datafront.'<li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/FrontBox.png"/></figure><div class="checkbox"><label>';
        if($eTailorObjN['ofrontBoxOut']=="true"){ $datafront=$datafront.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" checked  onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\');">';} else {$datafront=$datafront.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true"  onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\');">';}
        $datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box</label></div></li>';
		}
        $datafront=$datafront.'</ul></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-front-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-front-fabric\');">Done</button></div>';
				
		$data = ['1' => $datafront,'2' => $eTailorObjN];
		return $data;
	}
	
	public function getcuffdetails(){
		$data='';
		$datacuff='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$ffbid=$eTailorObjN['ofabric'];
		$eTailorObjN['ocuff']=$ff;
		$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
		$eTailorObjN['ocuffName']=$style_record->style_name;
		
		/*Cuffs*/
		$datacuff=$datacuff.'<div class="et-modal-header"><h4>Choose From 9 Cuff Style</h4><span class="ad-option-cuffs et-oc" onClick="hidediv(\'et-cuffs-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-cuff"><div class="et-select-style"><ul>';
        $stylecufflst = AttributeStyle::select('*')->where('attri_id','=',9)->get();
        foreach($stylecufflst as $stylcufflst){
        	$datacuff=$datacuff.' <li  class="et-item" id="optionlist-9-'.$stylcufflst->id.'" data-title="'.$stylcufflst->style_name.'" title="'.$stylcufflst->style_name.'" onClick="javascript:getstycuffs('.$stylcufflst->id.');">';
        	$stylecuffimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylcufflst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
        	foreach($stylecuffimglst as $cuffls){
            	$datacuff=$datacuff.'<figure class="et-item-style"><img src="'.$paths.'/'.$cuffls->list_img.'" alt="'.$cuffls->style_name.'" />';
                $thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcufflst->id)->where('attri_id' , '=' , $stylcufflst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
                foreach($thrdimglst as $thrdls){
                $datacuff=$datacuff.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$cuffls->style_name.'">';
				}
                $buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcufflst->id)->where('attri_id' , '=' , $stylcufflst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
                foreach($buttimglst as $buttls){
                $datacuff=$datacuff.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$cuffls->style_name.'">';
				}
                $datacuff=$datacuff.'</figure>';
                if($stylcufflst->id==$eTailorObjN['ocuff']){$datacuff=$datacuff.'<div class="icon-check"></div>';}
			}
            $datacuff=$datacuff.'</li>';
		}
        $datacuff=$datacuff.'</ul></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-cuffs-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="javascript:goNextCuff();">Next</button></div>';
		
		$data = ['1' => $datacuff,'2' => $eTailorObjN];
		return $data;
	}
	
	public function getbottomdetails(){
		$data='';
		$databottom='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$ffbid=$eTailorObjN['ofabric'];
		$eTailorObjN['obottom']=$ff;
		$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
		$eTailorObjN['obottomName']=$style_record->style_name;
		
		/*Bottom*/
		$databottom=$databottom.'<div class="et-modal-header"><h4>Bottom Style</h4><span class="ad-option-bottom et-oc" onClick="hidediv(\'et-bottom-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-bottom"><div class="et-select-style"><ul>';
        $stylebotmlst = AttributeStyle::select('*')->where('attri_id','=',7)->get();
        foreach($stylebotmlst as $stylbotmlst){
        	$databottom=$databottom.' <li class="et-item" id="optionlist-7-'.$stylbotmlst->id.'" data-title="'.$stylbotmlst->style_name.'" title="'.$stylbotmlst->style_name.'" onClick="javascript:getstybottoms('.$stylbotmlst->id.');">';
            $stylebotmimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylbotmlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
        	foreach($stylebotmimglst as $botmls){
            $databottom=$databottom.'<figure class="et-item-style"><img src="'.$paths.'/'.$botmls->list_img.'" alt="'.$botmls->style_name.'" /></figure>';
            if($stylbotmlst->id==$eTailorObjN['obottom']){ $databottom=$databottom.'<div class="icon-check"></div>';}
			}
            $databottom=$databottom.'</li>';
		}
        $databottom=$databottom.'</ul></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-bottom-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-bottom-fabric\');">Done</button></div>';
		
		$data = ['1' => $databottom,'2' => $eTailorObjN];
		return $data;
	}
	
	public function getbackdetails(){
		$data='';
		$databack='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$ffbid=$eTailorObjN['ofabric'];
		$eTailorObjN['oback']=$ff;
		$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
		$eTailorObjN['obackName']=$style_record->style_name;
		
		/*BACK*/
		$databack=$databack.'<div class="et-modal-header"><h4>1. Choose your Back Style</h4><span class="ad-option-back et-oc" onClick="hidediv(\'et-back-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-back"><div class="et-select-style"><ul>';
        $stylebacklst = AttributeStyle::select('*')->where('attri_id','=',6)->get();
        foreach($stylebacklst as $stylbacklst){
        	$databack=$databack.' <li class="et-item" id="optionlist-6-'.$stylbacklst->id.'" data-title="'.$stylbacklst->style_name.'" title="'.$stylbacklst->style_name.'" onClick="javascript:getstybacks('.$stylbacklst->id.');">';
            $stylebackimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylbacklst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
            foreach($stylebackimglst as $backls){
            	$databack=$databack.'<figure class="et-item-style"><img src="'.$paths.'/'.$backls->list_img.'" alt="'.$backls->style_name.'" /></figure>';
                if($stylbacklst->id==$eTailorObjN['oback']){$databack=$databack.'<div class="icon-check"></div>';}
			}
            $databack=$databack.'</li>';
		}
        $databack=$databack.'</ul>';                                                        
        if($eTailorObjN['oback']==7 || $eTailorObjN['oback']==8){
        	$databack=$databack.'<div class="et-options-more"><div class="et-check-box"><div class="checkbox"><label>';
        	if($eTailorObjN['odart']=="true"){$databack=$databack.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" checked onClick="javascript:getbackoptions('.$eTailorObjN['odart'].',\'Darts\');" >';}else {$databack=$databack.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" onClick="javascript:getbackoptions('.$eTailorObjN['odart'].',\'Darts\');" >';}
            $databack=$databack.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>2. Darts</label></div></div></div>';
		}
        $databack=$databack.'</div>';
        $databack=$databack.'<div class="et-select-style check-box-style"><ul>';
        if($eTailorObjN['oback']==8){
			$databack=$databack.'<li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/Box.png"/></figure><div class="checkbox"><label>';
			if($eTailorObjN['obackBoxOut']=="true"){ $databack=$databack.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" checked onClick="javascript:getbackoptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\');" >';} else {$databack=$databack.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" onClick="javascript:getbackoptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\');" >';}
			$databack=$databack.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Placket</label></div></li>';
		}
        $databack=$databack.'</ul></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-back-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-back-fabric\');">Done</button></div>';
		
		$data = ['1' => $databack,'2' => $eTailorObjN];
		return $data;
	}
	
	public function getpocketdetails(){
		$data='';
		$datapocket='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$ffbid=$eTailorObjN['ofabric'];
		$eTailorObjN['opacket']=$ff;
		if($ff==37){
			$eTailorObjN['opacketName']="No Pocket";
		} else {
			$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
			$eTailorObjN['opacketName']=$style_record->style_name;
		}
		
		/*Pockets*/
		$datapocket=$datapocket.'<div class="et-modal-header"><h4>Select Pocket Style</h4><span class="ad-option-pockts et-oc" onClick="hidediv(\'et-pockts-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-cuff"><div class="et-select-style"><ul>';
        $stylepocktlst = AttributeStyle::select('*')->where('attri_id','=',10)->get();
        foreach($stylepocktlst as $stylpocktlst){
        	$datapocket=$datapocket.' <li class="et-item" id="optionlist-10-'.$stylpocktlst->id.'" data-title="'.$stylpocktlst->style_name.'" title="'.$stylpocktlst->style_name.'" onClick="javascript:getstypockets('.$stylpocktlst->id.');">';
        	$stylepocktimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylpocktlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
            if($stylpocktlst->id == 37){
            	$datapocket=$datapocket.'<figure class="et-item-style"><img src="'.$p[0].'/advance/img/none.jpg" alt="'.$stylpocktlst->style_name.'"></figure>';
            	if($stylpocktlst->id == $eTailorObjN['opacket']){$datapocket=$datapocket.'<div class="icon-check"></div>';}
			}else{
                foreach($stylepocktimglst as $pocktls){
					$datapocket=$datapocket.'<figure class="et-item-style"><img src="'.$paths.'/'.$pocktls->list_img.'" alt="'.$pocktls->style_name.'" />';
					$thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylpocktlst->id)->where('attri_id' , '=' , $stylpocktlst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
					foreach($thrdimglst as $thrdls){
					$datapocket=$datapocket.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$pocktls->style_name.'">';
					}
					$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylpocktlst->id)->where('attri_id' , '=' , $stylpocktlst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
					foreach($buttimglst as $buttls){
					$datapocket=$datapocket.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$pocktls->style_name.'">';
					}
					$datapocket=$datapocket.'</figure>';
					if($stylpocktlst->id==$eTailorObjN['opacket']){ $datapocket=$datapocket.'<div class="icon-check"></div>';}
				}
			}
            $datapocket=$datapocket.'</li>';
		}
        $datapocket=$datapocket.'</ul><div class="et-fw text-center">';
		if($eTailorObjN['opacket']!=37){
		$datapocket=$datapocket.'<div class="et-btn-group"><div class="et-btn-select"><select class="selectpicker btn-primary" name="pocketstxt" id="pocketstxt" onChange="javascript:getnumpockets(this.value);">';
		if($eTailorObjN['opacketCount']=="1"){$datapocket=$datapocket.'<option value="1" selected >1 Pocket</option>';} else {$datapocket=$datapocket.'<option value="1" >1 Pocket</option>';}
		if($eTailorObjN['opacketCount']=="2"){$datapocket=$datapocket.'<option value="2" selected>2 Pockets</option>';} else {$datapocket=$datapocket.'<option value="2">2 Pockets</option>';}
		$datapocket=$datapocket.'</select></div></div>';
		}
		$datapocket=$datapocket.'</div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-pockts-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-pockts-fabric\');">Done</button></div>';
		
		$data = ['1' => $datapocket,'2' => $eTailorObjN];
		return $data;
	}	
	
	public function getbuttonsdetails(){
		$data='';
		$databutton='';
		$datacollar='';
		$datacuff='';
		$datafront='';
		$datapocket='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typp'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		switch($attrbid){
			case '11':
				$eTailorObjN['obutton']=$ff;
				$style_record = Button::select('*')->where('id', '=', $ff)->find($ff);
				$eTailorObjN['obuttonName']=$style_record->button_name;
				$eTailorObjN['obuttonCode']=$style_record->button_code;
				break;
			case '12':
				$eTailorObjN['obuttonHole']=$ff;
				$style_record = Thread::select('*')->where('id', '=', $ff)->find($ff);
				$eTailorObjN['obuttonHoleName']=$style_record->thrd_name;
				$eTailorObjN['obuttonHoleCode']=$style_record->thread_code;
				$eTailorObjN['obuttonHoleColor']=strtoupper($style_record->thread_color);
				break;
			case '13':
				$eTailorObjN['obuttonHoleStyle']=$ff;
				if($ff=="V"){
					$eTailorObjN['obuttonHoleStyleName']="Vertical";
				} elseif($ff=="H"){
					$eTailorObjN['obuttonHoleStyleName']="Horizontal";
				} elseif($ff=="S"){
					$eTailorObjN['obuttonHoleStyleName']="Slanted";
				}
				break;
		}
		/*Buttons*/
		$databutton=$databutton.'<div class="et-modal-header"><h4>Button / Hole Thread Color</h4><span class="ad-option-button et-oc" onClick="hidediv(\'et-buttons-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-2"><div class="preview-box"><figure class="ad-selected-item"><div id="design-3D-pro-button-color"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg"><img src="'.$paths.'/Shirts/Threads/'.$eTailorObjN['obuttonHoleStyle'].'/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Buttons/'.$eTailorObjN['obutton'].'.png"><img src="'.$paths.'/Shirts/Threads/C/'.$eTailorObjN['obuttonHole'].'.png"></div></figure></div>';
        $databutton=$databutton.'<div class="et-options-more"><div class="et-sm-carousel"><h5>1. Choose your Button color</h5><div class="et-contrast-list"><ul class="et-item-list">';
        $contbuttlst = Button::select('*')->where('cat_id','=',1)->get(); 
		foreach($contbuttlst as $cbuttnlst){
			$databutton=$databutton.' <li class="et-item" onClick="javascript:getstybuttons('.$cbuttnlst->id.',\'11\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cbuttnlst->button_img.'" alt="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')" /></figure>';
        	if($cbuttnlst->id==$eTailorObjN['obutton']){ $databutton=$databutton.'<div class="icon-check"></div>';}
         	$databutton=$databutton.'</li>';
		}
        $databutton=$databutton.'</ul></div></div><div class="et-sm-carousel"><h5>2. Thread Color</h5><div class="et-contrast-list"><ul class="et-item-list">';
		$contthrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
		foreach($contthrdlst as $cthreadlst){
       		$databutton=$databutton.' <li class="et-item" onClick="javascript:getstybuttons('.$cthreadlst->id.',\'12\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cthreadlst->thrd_img.'" alt="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')" /></figure>';
            if($cthreadlst->id==$eTailorObjN['obuttonHole']){ $databutton=$databutton.'<div class="icon-check"></div>';}
            $databutton=$databutton.'</li>';
		}
        $databutton=$databutton.'</ul></div></div><div class="et-sm-carousel"><h5>3. Buttons Hole Style</h5><div class="et-contrast-list">';
        $contthrdstyllst = Thread::select('*')->where('cat_id','=',1)->where('id','=',$eTailorObjN['obuttonHole'])->get(); 
        foreach($contthrdstyllst as $cthrdstyllst){
        	$databutton=$databutton.'<ul class="et-item-list"><li class="et-item" onClick="javascript:getstybuttons(\'V\',\'13\');"><figure class="et-item-img"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg"/><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_vertical.'"/></figure>';
        	if($eTailorObjN['obuttonHoleStyle']=='V'){ $databutton=$databutton.'<div class="icon-check"></div>';}
            $databutton=$databutton.'</li> <li class="et-item" onClick="javascript:getstybuttons(\'H\',\'13\');"><figure class="et-item-img"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg"/><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_horizontal.'"/></figure>';
            if($eTailorObjN['obuttonHoleStyle']=='H'){ $databutton=$databutton.'<div class="icon-check"></div>';}
            $databutton=$databutton.'</li> <li class="et-item" onClick="javascript:getstybuttons(\'S\',\'13\');"><figure class="et-item-img"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg"/><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_slanted.'"/></figure>';
            if($eTailorObjN['obuttonHoleStyle']=='S'){ $databutton=$databutton.'<div class="icon-check"></div>';}
            $databutton=$databutton.'</li></ul>';
		}
       	$databutton=$databutton.'</div></div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-buttons-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-buttons-fabric\');">Done</button></div>';
		
		/*Collar*/
		$datacollar=$datacollar.'<div class="et-modal-header"><h4>Choose your Collar Style</h4><span class="ad-option-collar et-oc" onClick="hidediv(\'et-coller-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-carousel"><div id="est-item-8" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
        
		$stylolrci=1; $stylecolrlst = AttributeStyle::select('*')->where('attri_id','=',8)->get();
        foreach($stylecolrlst as $stylcolrlst){
			if($stylolrci==8){ $datacollar=$datacollar.'</ul></div><div class="item"><ul class="et-item-list">';  $stylolrci=1;}
			$datacollar=$datacollar.' <li class="et-item" id="optionlist-8-'.$stylcolrlst->id.'" data-title="'.$stylcolrlst->style_name.'" title="'.$stylcolrlst->style_name.'" onClick="javascript:getstycollars('.$stylcolrlst->id.');">';
			
			$stylecolrimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylcolrlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
			foreach($stylecolrimglst as $colrls){
				$datacollar=$datacollar.'<figure class="et-item-img"><img src="'.$paths.'/'.$colrls->list_img.'" alt="'.$colrls->style_name.'">';
			
				$thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcolrlst->id)->where('attri_id' , '=' , $stylcolrlst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
				foreach($thrdimglst as $thrdls){
					$datacollar=$datacollar.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$colrls->style_name.'">';
				}
				
				$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcolrlst->id)->where('attri_id' , '=' , $stylcolrlst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
				foreach($buttimglst as $buttls){
					$datacollar=$datacollar.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$colrls->style_name.'">';
				}
				$datacollar=$datacollar.'</figure>';
			}
			if($stylcolrlst->id==$eTailorObjN['ocollar']){ $datacollar=$datacollar.'<div class="icon-check"></div>';}
			$datacollar=$datacollar.'</li>';
			
			$stylolrci++;
		}
        $datacollar=$datacollar.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#est-item-8" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/advance/img/ar-left.png"></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#est-item-8" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/advance/img/ar-right.png"></span><span class="sr-only">Next</span></a></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-coller-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="javascript:goNextColr();">Next</button></div>';
		/*Cuffs*/
		$datacuff=$datacuff.'<div class="et-modal-header"><h4>Choose From 9 Cuff Style</h4><span class="ad-option-cuffs et-oc" onClick="hidediv(\'et-cuffs-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-cuff"><div class="et-select-style"><ul>';
        $stylecufflst = AttributeStyle::select('*')->where('attri_id','=',9)->get();
        foreach($stylecufflst as $stylcufflst){
        	$datacuff=$datacuff.' <li  class="et-item" id="optionlist-9-'.$stylcufflst->id.'" data-title="'.$stylcufflst->style_name.'" title="'.$stylcufflst->style_name.'" onClick="javascript:getstycuffs('.$stylcufflst->id.');">';
        	$stylecuffimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylcufflst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
        	foreach($stylecuffimglst as $cuffls){
            	$datacuff=$datacuff.'<figure class="et-item-style"><img src="'.$paths.'/'.$cuffls->list_img.'" alt="'.$cuffls->style_name.'" />';
                $thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcufflst->id)->where('attri_id' , '=' , $stylcufflst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
                foreach($thrdimglst as $thrdls){
                $datacuff=$datacuff.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$cuffls->style_name.'">';
				}
                $buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylcufflst->id)->where('attri_id' , '=' , $stylcufflst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
                foreach($buttimglst as $buttls){
                $datacuff=$datacuff.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$cuffls->style_name.'">';
				}
                $datacuff=$datacuff.'</figure>';
                if($stylcufflst->id==$eTailorObjN['ocuff']){$datacuff=$datacuff.'<div class="icon-check"></div>';}
			}
            $datacuff=$datacuff.'</li>';
		}
        $datacuff=$datacuff.'</ul></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-cuffs-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="javascript:goNextCuff();">Next</button></div>';
		/*Front*/
		$datafront=$datafront.'<div class="et-modal-header"><h4>1. Choose your Front Style</h4><span class="ad-option-front et-oc" onClick="hidediv(\'et-front-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-front"><div class="et-select-style"><ul>';
        
		$stylefrntlst = AttributeStyle::select('*')->where('attri_id','=',5)->get();
        foreach($stylefrntlst as $stylfrntlst){
        	$datafront=$datafront.' <li class="et-item" id="optionlist-5-'.$stylfrntlst->id.'" data-title="'.$stylfrntlst->style_name.'" title="'.$stylfrntlst->style_name.'" onClick="javascript:getstyfronts('.$stylfrntlst->id.');">';
        
			$stylefrntimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylfrntlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
        	foreach($stylefrntimglst as $frntls){
        		$datafront=$datafront.'<figure class="et-item-style"><img src="'.$paths.'/'.$frntls->list_img.'" alt="'.$frntls->style_name.'" />';
				$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylfrntlst->id)->where('attri_id' , '=' , $stylfrntlst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
                foreach($buttimglst as $buttls){
                $datafront=$datafront.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$frntls->style_name.'">';
				}
				$datafront=$datafront.'</figure>';
                if($stylfrntlst->id==$eTailorObjN['ofront']){$datafront=$datafront.'<div class="icon-check"></div>';}
			}
            $datafront=$datafront.'</li>';
		}
        $datafront=$datafront.'</ul><div class="et-options-more"><div class="et-check-box"><div class="checkbox"><label>';
        if($eTailorObjN['oseams']=="true"){ $datafront=$datafront.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" checked  onClick="javascript:getfrontoptions('.$eTailorObjN['oseams'].',\'Seams\');">'; } else {$datafront=$datafront.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['oseams'].',\'Seams\');">';}
        $datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>2. Seams</label></div></div></div></div><div class="et-select-style check-box-style"><ul><li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/InSide.png"/></figure><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $datafront=$datafront.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" checked onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\');">';} else {$datafront=$datafront.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\');">';}
        $datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside</label></div></li><li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/OutSide.png"/></figure><div class="checkbox"><label>';
        if($eTailorObjN['ofrontPlacketOut']=="true"){ $datafront=$datafront.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" checked onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\');">';} else {$datafront=$datafront.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\');">';}
		$datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside</label></div></li>';
        if($eTailorObjN['ofront']==5){$datafront=$datafront.'<li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/FrontBox.png"/></figure><div class="checkbox"><label>';
        if($eTailorObjN['ofrontBoxOut']=="true"){ $datafront=$datafront.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" checked onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\');">';} else {$datafront=$datafront.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\');" >';}
        $datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box</label></div></li>';
		}
        $datafront=$datafront.'</ul></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-front-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-front-fabric\');">Done</button></div>';
		/*Pockets*/
		$datapocket=$datapocket.'<div class="et-modal-header"><h4>Select Pocket Style</h4><span class="ad-option-pockts et-oc" onClick="hidediv(\'et-pockts-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-cuff"><div class="et-select-style"><ul>';
        $stylepocktlst = AttributeStyle::select('*')->where('attri_id','=',10)->get();
        foreach($stylepocktlst as $stylpocktlst){
        	$datapocket=$datapocket.' <li class="et-item" id="optionlist-10-'.$stylpocktlst->id.'" data-title="'.$stylpocktlst->style_name.'" title="'.$stylpocktlst->style_name.'" onClick="javascript:getstypockets('.$stylpocktlst->id.');">';
        	$stylepocktimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylpocktlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
            if($stylpocktlst->id == 37){
            	$datapocket=$datapocket.'<figure class="et-item-style"><img src="'.$p[0].'/advance/img/none.jpg" alt="'.$stylpocktlst->style_name.'"></figure>';
            	if($stylpocktlst->id == $eTailorObjN['opacket']){$datapocket=$datapocket.'<div class="icon-check"></div>';}
			}else{
                foreach($stylepocktimglst as $pocktls){
					$datapocket=$datapocket.'<figure class="et-item-style"><img src="'.$paths.'/'.$pocktls->list_img.'" alt="'.$pocktls->style_name.'" />';
					$thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylpocktlst->id)->where('attri_id' , '=' , $stylpocktlst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
					foreach($thrdimglst as $thrdls){
					$datapocket=$datapocket.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$pocktls->style_name.'">';
					}
					$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylpocktlst->id)->where('attri_id' , '=' , $stylpocktlst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
					foreach($buttimglst as $buttls){
					$datapocket=$datapocket.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$pocktls->style_name.'">';
					}
					$datapocket=$datapocket.'</figure>';
					if($stylpocktlst->id==$eTailorObjN['opacket']){ $datapocket=$datapocket.'<div class="icon-check"></div>';}
				}
			}
            $datapocket=$datapocket.'</li>';
		}
        $datapocket=$datapocket.'</ul><div class="et-fw text-center">';
		if($eTailorObjN['opacket']!=37){
		$datapocket=$datapocket.'<div class="et-btn-group"><div class="et-btn-select"><select class="selectpicker btn-primary" name="pocketstxt" id="pocketstxt" onChange="javascript:getnumpockets(this.value);">';
		if($eTailorObjN['opacketCount']=="1"){$datapocket=$datapocket.'<option value="1" selected >1 Pocket</option>';} else {$datapocket=$datapocket.'<option value="1" >1 Pocket</option>';}
		if($eTailorObjN['opacketCount']=="2"){$datapocket=$datapocket.'<option value="2" selected>2 Pockets</option>';} else {$datapocket=$datapocket.'<option value="2">2 Pockets</option>';}
		$datapocket=$datapocket.'</select></div></div>';
		}
		$datapocket=$datapocket.'</div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-pockts-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-pockts-fabric\');">Done</button></div>';
		
		$data = ['1' => $databutton,'2' => $eTailorObjN,'3' => $datacollar,'4' => $datacuff,'5' => $datafront,'6' => $datapocket];
		return $data;
	}
	
	public function getcontrastdetails(){
		$data='';
		$datacont='';
		$datacolr='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['ocontrast']=$ff;
		$style_record = Contrast::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['ocontrastName']=$style_record->contrsfab_name;
		
		$data=$data.'<h5>Contrast fabrics Selection :</h5><div class="et-contrast-list"><ul class="et-item-list">';
		$contfablst = Contrast::select('*')->where('cat_id','=',1)->get();
        foreach($contfablst as $cfablst){
        	$data=$data.' <li class="et-item" id="optionlist-11-'.$cfablst->id.'" data-title="'.$cfablst->contrsfab_name.'" title="'.$cfablst->contrsfab_name.'" onClick="javascript:getcontrast('.$cfablst->id.');"><figure class="et-item-img"><img src="'.$paths.'/'.$cfablst->contrsfab_img.'" alt="'.$cfablst->contrsfab_name.'" /></figure>';
            if($cfablst->id==$eTailorObjN['ocontrast']){$data=$data.'<div class="icon-check"></div>';}
            $data=$data.'</li>';
		}
        $data=$data.'</ul></div>';
		
		/*Collar 2*/
		$datacolr=$datacolr.'<div class="et-modal-header"><h4>More Collar Detail</h4><span class="ad-option-collar et-oc" onClick="hidediv(\'et-coller-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-2"><div class="preview-box"><figure class="ad-selected-item" id="collarpreview"><img src="'.$p[0].'/advance/img/product/pt-shirt-front-open.png"></figure></div><div class="et-options-more"><div class="et-check-box"><div class="checkbox"><label>';
        if($eTailorObjN['ocollarCuffout']=="true"){ $datacolr=$datacolr.'<input type="checkbox" name="colloutertxt" id="colloutertxt" value="true" checked onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\');" >';} else {$datacolr=$datacolr.'<input type="checkbox" name="colloutertxt" id="colloutertxt" value="true" onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\');" >';}
		$datacolr=$datacolr.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Outside Contrast</label></div><div class="checkbox"><label>';
        if($eTailorObjN['ocollarCuffIn']=="true"){ $datacolr=$datacolr.'<input type="checkbox" name="collinnertxt" id="collinnertxt" value="true" checked onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\');">';} else {$datacolr=$datacolr.'<input type="checkbox" name="collinnertxt" id="collinnertxt" value="true" onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\');">';}
        $datacolr=$datacolr.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocollarStay']=="true"){ $datacolr=$datacolr.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" checked onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarStay'].',\'CollarStay\');" >';} else {$datacolr=$datacolr.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarStay'].',\'CollarStay\');">';}
        $datacolr=$datacolr.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Stay</label></div></div><div class="et-sm-carousel"><h5>Contrast fabrics Selection :</h5><div class="et-contrast-list"><ul class="et-item-list">';
        $contfablst = Contrast::select('*')->where('cat_id','=',1)->get(); 
		foreach($contfablst as $cfablst){
			$datacolr=$datacolr.'<li class="et-item" id="optionlist-11-'.$cfablst->id.'" data-title="'.$cfablst->contrsfab_name.'" title="'.$cfablst->contrsfab_name.'"><figure class="et-item-img" onClick="javascript:getcontrast('.$cfablst->id.');"><img src="'.$paths.'/'.$cfablst->contrsfab_img.'" alt="'.$cfablst->contrsfab_name.'" /></figure>';
           	if($cfablst->id==$eTailorObjN['ocontrast']){ $datacolr=$datacolr.'<div class="icon-check"></div>';}
            $datacolr=$datacolr.'</li>';
		}
        $datacolr=$datacolr.'</ul></div></div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="javascript:goBackColr();">Back</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-coller-fabric\');">Done</button></div>';
		
		$datacont=$datacont.'<img src="'.$paths.'/Shirts/Fabric/C/'.$eTailorObjN['ofabric'].'.png" alt=""/>';
		if($eTailorObjN['ocollarCuffIn']=="true"){ $datacont=$datacont.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObjN['ocontrast'].'.png" >';}
		if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<img  class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $datacont=$datacont.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketOut']=="true"){ $datacont=$datacont.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofront']==4){ $datacont=$datacont.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		} elseif($eTailorObjN['ofront']==5){ $datacont=$datacont.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		}
		
		$data = ['1' => $data,'2' => $eTailorObjN,'3' => $datacolr,'4' => $datacont];
		return $data;
	}
	
	public function getcolrcuffdetails(){
		$data='';
		$datacuff='';
		$datacolr='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$attrbid=$_POST['typp'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		switch($attrbid){
			case 'CollarCuffOut':
				if($ff=="true"){ $eTailorObjN['ocollarCuffout']="false"; } else { $eTailorObjN['ocollarCuffout']="true"; }
				break;
			case 'CollarCuffIn':
				if($ff=="true"){ $eTailorObjN['ocollarCuffIn']="false"; } else { $eTailorObjN['ocollarCuffIn']="true"; }
				break;
			case 'CollarStay':
				if($ff=="true"){ $eTailorObjN['ocollarStay']="false"; } else { $eTailorObjN['ocollarStay']="true"; }
				break;
		}
		
		/*Collar 2*/
		$datacolr=$datacolr.'<div class="et-modal-header"><h4>More Collar Detail</h4><span class="ad-option-collar et-oc" onClick="hidediv(\'et-coller-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-2"><div class="preview-box"><figure class="ad-selected-item" id="collarpreview"><img src="'.$p[0].'/advance/img/product/pt-shirt-front-open.png"></figure></div><div class="et-options-more"><div class="et-check-box"><div class="checkbox"><label>';
        if($eTailorObjN['ocollarCuffout']=="true"){ $datacolr=$datacolr.'<input type="checkbox" name="colloutertxt" id="colloutertxt" value="true" checked onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\');" >';} else {$datacolr=$datacolr.'<input type="checkbox" name="colloutertxt" id="colloutertxt" value="true" onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\');" >';}
		$datacolr=$datacolr.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Outside Contrast</label></div><div class="checkbox"><label>';
        if($eTailorObjN['ocollarCuffIn']=="true"){ $datacolr=$datacolr.'<input type="checkbox" name="collinnertxt" id="collinnertxt" value="true" checked onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\');">';} else {$datacolr=$datacolr.'<input type="checkbox" name="collinnertxt" id="collinnertxt" value="true" onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\');">';}
        $datacolr=$datacolr.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocollarStay']=="true"){ $datacolr=$datacolr.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" checked onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarStay'].',\'CollarStay\');" >';} else {$datacolr=$datacolr.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarStay'].',\'CollarStay\');">';}
        $datacolr=$datacolr.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Stay</label></div></div><div class="et-sm-carousel"><h5>Contrast fabrics Selection :</h5><div class="et-contrast-list"><ul class="et-item-list">';
        $contfablst = Contrast::select('*')->where('cat_id','=',1)->get(); 
		foreach($contfablst as $cfablst){
			$datacolr=$datacolr.' <li class="et-item" id="optionlist-11-'.$cfablst->id.'" data-title="'.$cfablst->contrsfab_name.'" title="'.$cfablst->contrsfab_name.'"><figure class="et-item-img" onClick="javascript:getcontrast('.$cfablst->id.');"><img src="'.$paths.'/'.$cfablst->contrsfab_img.'" alt="'.$cfablst->contrsfab_name.'" /></figure>';
           	if($cfablst->id==$eTailorObjN['ocontrast']){ $datacolr=$datacolr.'<div class="icon-check"></div>';}
            $datacolr=$datacolr.'</li>';
		}
        $datacolr=$datacolr.'</ul></div></div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="javascript:goBackColr();">Back</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-coller-fabric\');">Done</button></div>';
		/* Cuff 2*/
		$datacuff=$datacuff.'<div class="et-modal-header"><h4>More Cuff Detail</h4><span class="ad-option-cuffs et-oc" onClick="hidediv(\'et-cuffs-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-2"><div class="preview-box"><figure class="ad-selected-item" id="cuffpreview"><img src="'.$p[0].'/advance/img/product/pt-shirt-front-open.png"></figure></div><div class="et-options-more"><div class="et-check-box"><div class="checkbox"><label>';
        
		if($eTailorObjN['ocollarCuffout']=="true"){ $datacuff=$datacuff.'<input type="checkbox" name="cuffoutertxt" id="cuffoutertxt" value="true" checked onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\');" >';} else { $datacuff=$datacuff.'<input type="checkbox" name="cuffoutertxt" id="cuffoutertxt" value="true" onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\');" >';}
		$datacuff=$datacuff.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Cuff Outside Contrast</label></div><div class="checkbox"><label>';
        if($eTailorObjN['ocollarCuffIn']=="true"){ $datacuff=$datacuff.'<input type="checkbox" name="cuffinnertxt" id="cuffinnertxt" value="true" checked onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\');" >';} else { $datacuff=$datacuff.'<input type="checkbox" name="cuffinnertxt" id="cuffinnertxt" value="true" onClick="javascript:getcollrcuffcontrast('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\');" >';}
		$datacuff=$datacuff.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Cuff Inside Contrast</label></div></div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="javascript:goBackCuff();">Back</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-cuffs-fabric\');">Done</button></div>';
		
		$data=$data.'<img src="'.$paths.'/Shirts/Fabric/C/'.$eTailorObjN['ofabric'].'.png" alt=""/>';
		if($eTailorObjN['ocollarCuffIn']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObjN['ocontrast'].'.png" >';}
		if($eTailorObjN['ocollarCuffout']=="true"){ $data=$data.'<img  class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketOut']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontBoxOut']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofront']==4){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		} elseif($eTailorObjN['ofront']==5){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		}
		
		$data = ['1' => $datacolr,'2' => $eTailorObjN,'3' => $datacuff,'4' => $data];
		return $data;
	}
	
	public function getepaulettedetails(){
		$data='';
		$datasleeve='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		if($ff=="true"){ $eTailorObjN['oshoulder']="false"; } else { $eTailorObjN['oshoulder']="true"; }
		
		/*Sleeves*/
		$datasleeve=$datasleeve.'<div class="et-modal-header"><h4>1. Please Choose Sleeve Style</h4><span class="ad-option-sleeve et-oc"  onClick="hidediv(\'et-sleeve-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-block"><div class="et-choose-style"><ul>';
        
		$styleslevlst = AttributeStyle::select('*')->where('attri_id','=',4)->get();
        foreach($styleslevlst as $stylslevlst){
        	$datasleeve=$datasleeve.' <li class="et-item" id="optionlist-4-'.$stylslevlst->id.'" data-title="'.$stylslevlst->style_name.'" title="'.$stylslevlst->style_name.'" onClick="javascript:getstysleeves('.$stylslevlst->id.');">';
            $styleslevimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylslevlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
            foreach($styleslevimglst as $slevls){
				$datasleeve=$datasleeve.'<figure class="et-item-style"><img src="'.$paths.'/'.$slevls->list_img.'" alt="'.$slevls->style_name.'" /></figure>';
				if($stylslevlst->id==$eTailorObjN['osleeve']){$datasleeve=$datasleeve.'<div class="icon-check"></div>';}
			}
            $datasleeve=$datasleeve.'</li>';
		}
        $datasleeve=$datasleeve.'</ul></div><div class="et-options-more"><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['oshoulder']=="true"){$datasleeve=$datasleeve.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" checked onClick="javascript:getepaulette('.$eTailorObjN['oshoulder'].');">';} else {$datasleeve=$datasleeve.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" onClick="javascript:getepaulette('.$eTailorObjN['oshoulder'].');">';}
        $datasleeve=$datasleeve.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Epaulettes</label></div></div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-sleeve-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-sleeve-fabric\');">Done</button></div>';
		
		$data = ['1' => $datasleeve,'2' => $eTailorObjN];
		return $data;
	}
	
	public function getfrontcontrastdtls(){
		$data='';
		$datafront='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$attrbid=$_POST['typp'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		switch($attrbid){
			case 'Seams':
				if($ff=="true"){ $eTailorObjN['oseams']="false"; } else { $eTailorObjN['oseams']="true"; }
				break;
			case 'FrontPlacketIn':
				if($ff=="true"){ $eTailorObjN['ofrontPlacketIn']="false"; } else { $eTailorObjN['ofrontPlacketIn']="true"; }
				break;
			case 'FrontPlacketOut':
				if($ff=="true"){ $eTailorObjN['ofrontPlacketOut']="false"; } else { $eTailorObjN['ofrontPlacketOut']="true"; }
				break;
			case 'FrontBoxOut':
				if($ff=="true"){ $eTailorObjN['ofrontBoxOut']="false"; } else { $eTailorObjN['ofrontBoxOut']="true"; }
				break;
		}
		
		/*Front*/
		$datafront=$datafront.'<div class="et-modal-header"><h4>1. Choose your Front Style</h4><span class="ad-option-front et-oc" onClick="hidediv(\'et-front-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-front"><div class="et-select-style"><ul>';
		$stylefrntlst = AttributeStyle::select('*')->where('attri_id','=',5)->get();
        foreach($stylefrntlst as $stylfrntlst){
        	$datafront=$datafront.' <li class="et-item" id="optionlist-5-'.$stylfrntlst->id.'" data-title="'.$stylfrntlst->style_name.'" title="'.$stylfrntlst->style_name.'" onClick="javascript:getstyfronts('.$stylfrntlst->id.');">';
        
			$stylefrntimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylfrntlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
        	foreach($stylefrntimglst as $frntls){
        		$datafront=$datafront.'<figure class="et-item-style"><img src="'.$paths.'/'.$frntls->list_img.'" alt="'.$frntls->style_name.'" />';
				$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylfrntlst->id)->where('attri_id' , '=' , $stylfrntlst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
                foreach($buttimglst as $buttls){
                $datafront=$datafront.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$frntls->style_name.'">';
				}
				$datafront=$datafront.'</figure>';
                if($stylfrntlst->id==$eTailorObjN['ofront']){$datafront=$datafront.'<div class="icon-check"></div>';}
			}
            $datafront=$datafront.'</li>';
		}
        $datafront=$datafront.'</ul><div class="et-options-more"><div class="et-check-box"><div class="checkbox"><label>';
        if($eTailorObjN['oseams']=="true"){ $datafront=$datafront.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" checked  onClick="javascript:getfrontoptions('.$eTailorObjN['oseams'].',\'Seams\');">'; } else {$datafront=$datafront.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['oseams'].',\'Seams\');">';}
        $datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>2. Seams</label></div></div></div></div><div class="et-select-style check-box-style"><ul><li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/InSide.png"/></figure><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $datafront=$datafront.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" checked onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\');">';} else {$datafront=$datafront.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\');">';}
        $datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside</label></div></li><li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/OutSide.png"/></figure><div class="checkbox"><label>';
        if($eTailorObjN['ofrontPlacketOut']=="true"){ $datafront=$datafront.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" checked onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\');">';} else {$datafront=$datafront.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\');">';}
		$datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside</label></div></li>';
        if($eTailorObjN['ofront']==5){$datafront=$datafront.'<li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/FrontBox.png"/></figure><div class="checkbox"><label>';
        if($eTailorObjN['ofrontBoxOut']=="true"){ $datafront=$datafront.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" checked onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\');">';} else {$datafront=$datafront.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" onClick="javascript:getfrontoptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\');" >';}
        $datafront=$datafront.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box</label></div></li>';
		}
        $datafront=$datafront.'</ul></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-front-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-front-fabric\');">Done</button></div>';
		
		$data=$data.'<img src="'.$paths.'/Shirts/Fabric/C/'.$eTailorObjN['ofabric'].'.png" alt=""/>';
		if($eTailorObjN['ocollarCuffIn']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObjN['ocontrast'].'.png" >';}
		if($eTailorObjN['ocollarCuffout']=="true"){ $data=$data.'<img  class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketOut']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontBoxOut']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofront']==4){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		} elseif($eTailorObjN['ofront']==5){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		}
		
		$data = ['1' => $datafront,'2' => $eTailorObjN,'3' => $data];
		return $data;
	}
	
	public function getbackcontrastdtls(){
		$databack='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$attrbid=$_POST['typp'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		switch($attrbid){
			case 'Darts':
				if($ff=="true"){ $eTailorObjN['odart']="false"; } else { $eTailorObjN['odart']="true"; }
				break;
			case 'BackBoxOut':
				if($ff=="true"){ $eTailorObjN['obackBoxOut']="false"; } else { $eTailorObjN['obackBoxOut']="true"; }
				break;
		}
		/*BACK*/
		$databack=$databack.'<div class="et-modal-header"><h4>1. Choose your Back Style</h4><span class="ad-option-back et-oc" onClick="hidediv(\'et-back-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-back"><div class="et-select-style"><ul>';
        $stylebacklst = AttributeStyle::select('*')->where('attri_id','=',6)->get();
        foreach($stylebacklst as $stylbacklst){
        	$databack=$databack.' <li class="et-item" id="optionlist-6-'.$stylbacklst->id.'" data-title="'.$stylbacklst->style_name.'" title="'.$stylbacklst->style_name.'" onClick="javascript:getstybacks('.$stylbacklst->id.');">';
            $stylebackimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylbacklst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
            foreach($stylebackimglst as $backls){
            	$databack=$databack.'<figure class="et-item-style"><img src="'.$paths.'/'.$backls->list_img.'" alt="'.$backls->style_name.'" /></figure>';
                if($stylbacklst->id==$eTailorObjN['oback']){$databack=$databack.'<div class="icon-check"></div>';}
			}
            $databack=$databack.'</li>';
		}
        $databack=$databack.'</ul>';                                                        
        if($eTailorObjN['oback']==7 || $eTailorObjN['oback']==8){
        	$databack=$databack.'<div class="et-options-more"><div class="et-check-box"><div class="checkbox"><label>';
        	if($eTailorObjN['odart']=="true"){$databack=$databack.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" checked onClick="javascript:getbackoptions('.$eTailorObjN['odart'].',\'Darts\');" >';}else {$databack=$databack.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" onClick="javascript:getbackoptions('.$eTailorObjN['odart'].',\'Darts\');" >';}
            $databack=$databack.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>2. Darts</label></div></div></div>';
		}
        $databack=$databack.'</div>';
        $databack=$databack.'<div class="et-select-style check-box-style"><ul>';
        if($eTailorObjN['oback']==8){
			$databack=$databack.'<li><figure class="et-item-style-check"><img src="'.$p[0].'/advance/img/styFront/Box.png"/></figure><div class="checkbox"><label>';
			if($eTailorObjN['obackBoxOut']=="true"){ $databack=$databack.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" checked onClick="javascript:getbackoptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\');" >';} else {$databack=$databack.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" onClick="javascript:getbackoptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\');" >';}
			$databack=$databack.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Placket</label></div></li>';
		}
        $databack=$databack.'</ul></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-back-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-back-fabric\');">Done</button></div>';
		
		$data = ['1' => $databack,'2' => $eTailorObjN];
		return $data;
	}
	
	public function getnumpocketdtls(){
		$datapocket='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['opacketCount']=$ff;
		/*Pockets*/
		$datapocket=$datapocket.'<div class="et-modal-header"><h4>Select Pocket Style</h4><span class="ad-option-pockts et-oc" onClick="hidediv(\'et-pockts-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-cuff"><div class="et-select-style"><ul>';
        $stylepocktlst = AttributeStyle::select('*')->where('attri_id','=',10)->get();
        foreach($stylepocktlst as $stylpocktlst){
        	$datapocket=$datapocket.' <li class="et-item" id="optionlist-10-'.$stylpocktlst->id.'" data-title="'.$stylpocktlst->style_name.'" title="'.$stylpocktlst->style_name.'" onClick="javascript:getstypockets('.$stylpocktlst->id.');">';
        	$stylepocktimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$stylpocktlst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
            if($stylpocktlst->id == 37){
            	$datapocket=$datapocket.'<figure class="et-item-style"><img src="'.$p[0].'/advance/img/none.jpg" alt="'.$stylpocktlst->style_name.'"></figure>';
            	if($stylpocktlst->id == $eTailorObjN['opacket']){$datapocket=$datapocket.'<div class="icon-check"></div>';}
			}else{
                foreach($stylepocktimglst as $pocktls){
					$datapocket=$datapocket.'<figure class="et-item-style"><img src="'.$paths.'/'.$pocktls->list_img.'" alt="'.$pocktls->style_name.'" />';
					$thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylpocktlst->id)->where('attri_id' , '=' , $stylpocktlst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
					foreach($thrdimglst as $thrdls){
					$datapocket=$datapocket.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$pocktls->style_name.'">';
					}
					$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$stylpocktlst->id)->where('attri_id' , '=' , $stylpocktlst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
					foreach($buttimglst as $buttls){
					$datapocket=$datapocket.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$pocktls->style_name.'">';
					}
					$datapocket=$datapocket.'</figure>';
					if($stylpocktlst->id==$eTailorObjN['opacket']){ $datapocket=$datapocket.'<div class="icon-check"></div>';}
				}
			}
            $datapocket=$datapocket.'</li>';
		}
        $datapocket=$datapocket.'</ul><div class="et-fw text-center">';
		if($eTailorObjN['opacket']!=37){
		$datapocket=$datapocket.'<div class="et-btn-group"><div class="et-btn-select"><select class="selectpicker btn-primary" name="pocketstxt" id="pocketstxt" onChange="javascript:getnumpockets(this.value);">';
		if($eTailorObjN['opacketCount']=="1"){$datapocket=$datapocket.'<option value="1" selected >1 Pocket</option>';} else {$datapocket=$datapocket.'<option value="1" >1 Pocket</option>';}
		if($eTailorObjN['opacketCount']=="2"){$datapocket=$datapocket.'<option value="2" selected>2 Pockets</option>';} else {$datapocket=$datapocket.'<option value="2">2 Pockets</option>';}
		$datapocket=$datapocket.'</select></div></div>';
		}
		$datapocket=$datapocket.'</div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-pockts-fabric\');">Skip</button><button type="button" class="btn pull-right et-done" onClick="hidediv(\'et-pockts-fabric\');">Done</button></div>';
		
		$data = ['1' => $datapocket,'2' => $eTailorObjN];
		return $data;
	}
	
	public function getmonoplacedtls(){
		$datamono='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['omonogram']=$ff;
		$style_record = AttributeStyle::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['omonogramName']=$style_record->style_name;
		
		$datamono=$datamono.'<div class="et-modal-header"><h4>MONOGRAM PERSONALISATION</h4><span class="ad-option-monogram et-oc" onClick="hidediv(\'et-monogram-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-2"><div class="preview-box monogram" style="position:relative"><label class="monogram-subhead" ><span class="cr"><i class="cr-icon"></i></span>  1. Click on the Monogram Location(red dot)</label><figure class="ad-selected-item" id="monogrmpreview"><img src=""></figure>';
        
		if($eTailorObjN['opacket']!=37){
        	if($eTailorObjN['omonogram']=='48'){ $datamono=$datamono.'<button type="button" class="et-point mon-pocket active" onClick="javascript:getmonogrmplace(\'48\');"></button>';} else {$datamono=$datamono.'<button type="button" class="et-point mon-pocket" onClick="javascript:getmonogrmplace(\'48\');"></button>';}
		} else {
        	if($eTailorObjN['omonogram']=='47'){ $datamono=$datamono.'<button type="button" class="et-point mon-chest active" onClick="javascript:getmonogrmplace(\'47\');"></button>';} else { $datamono=$datamono.'<button type="button" class="et-point mon-chest" onClick="javascript:getmonogrmplace(\'47\');"></button>';}
		}
        
		if($eTailorObjN['osleeve']!=3){
        	if($eTailorObjN['omonogram']=='49'){ $datamono=$datamono.'<button type="button" class="et-point mon-cuff active" onClick="javascript:getmonogrmplace(\'49\');"></button>';} else { $datamono=$datamono.'<button type="button" class="et-point mon-cuff" onClick="javascript:getmonogrmplace(\'49\');"></button>';}
		}
                                                            
       if($eTailorObjN['omonogram']=='46'){ $datamono=$datamono.'<button type="button" class="et-point mon-waist active" onClick="javascript:getmonogrmplace(\'46\');"></button>';} else { $datamono=$datamono.'<button type="button" class="et-point mon-waist" onClick="javascript:getmonogrmplace(\'46\');"></button>';}
      $datamono=$datamono.'</div><div class="et-options-more"><div class="et-check-box"><label class="subhead-two" ><span class="cr"><i class="cr-icon"></i></span>  2. Enter Desired Monogram/Initials <p class="sub-title">{<span>English Script Only</span>}</p></label><div class="radio"><label>';
	  if($eTailorObjN['omonogramStyle']=='normal'){ $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true" checked onClick="javascript:getmonostyle(\'normal\');">';} else { $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true" onClick="javascript:getmonostyle(\'normal\');">';}
      
	  $datamono=$datamono.'<span class="cr"><i class="cr-icon"></i></span>monogram </label></div><div class="radio"><label>';
      
	  if($eTailorObjN['omonogramStyle']=='italic'){ $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true" checked  onClick="javascript:getmonostyle(\'italic\');">';} else { $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true"  onClick="javascript:getmonostyle(\'italic\');">';}
      
	  $datamono=$datamono.'<span class="cr"><i class="cr-icon"></i></span><i>monogram</i></label></div><div class="text-box"><label><input type="text" name="monogrmtxt" id="monogrmtxt" value="'.$eTailorObjN['omonogramText'].'" maxlength="10"  onBlur="javascript:getmonotext(this.value);"></label></div></div><div class="et-sm-carousel"><h5><i class="cr-icon"></i></span>  3. Monogram Colors</h5><div class="et-contrast-list"><ul class="et-item-list">';
      
	  $monothrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
      foreach($monothrdlst as $monothrdlst){
	  	$datamono=$datamono.' <li class="et-item threads" onClick="javascript:getmonotxtcolor('.$monothrdlst->id.');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.'" />/figure>';
      	if($monothrdlst->id==$eTailorObjN['omonogramColor']){ $datamono=$datamono.'<div class="icon-check"></div>';}
      $datamono=$datamono.'</li>';
	  }
      $datamono=$datamono.'</ul></div></div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-monogram-fabric\');">BACK</button><button type="button" class="btn pull-right et-done" onClick="javascript:showSection(\'sect-measurement\');">Go TO MEASUREMENT</button></div>';
	  
		$data = ['1' => $datamono,'2' => $eTailorObjN];
		return $data;
	}
	
	public function getmonostyledtls(){
		$datamono='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['omonogramStyle']=$ff;
		
		$datamono=$datamono.'<div class="et-modal-header"><h4>MONOGRAM PERSONALISATION</h4><span class="ad-option-monogram et-oc" onClick="hidediv(\'et-monogram-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-2"><div class="preview-box monogram" style="position:relative"><label class="monogram-subhead" ><span class="cr"><i class="cr-icon"></i></span>  1. Click on the Monogram Location(red dot)</label><figure class="ad-selected-item" id="monogrmpreview"><img src=""></figure>';
        
		if($eTailorObjN['opacket']!=37){
        	if($eTailorObjN['omonogram']=='48'){ $datamono=$datamono.'<button type="button" class="et-point mon-pocket active" onClick="javascript:getmonogrmplace(\'48\');"></button>';} else {$datamono=$datamono.'<button type="button" class="et-point mon-pocket" onClick="javascript:getmonogrmplace(\'48\');"></button>';}
		} else {
        	if($eTailorObjN['omonogram']=='47'){ $datamono=$datamono.'<button type="button" class="et-point mon-chest active" onClick="javascript:getmonogrmplace(\'47\');"></button>';} else { $datamono=$datamono.'<button type="button" class="et-point mon-chest" onClick="javascript:getmonogrmplace(\'47\');"></button>';}
		}
        
		if($eTailorObjN['osleeve']!=3){
        	if($eTailorObjN['omonogram']=='49'){ $datamono=$datamono.'<button type="button" class="et-point mon-cuff active" onClick="javascript:getmonogrmplace(\'49\');"></button>';} else { $datamono=$datamono.'<button type="button" class="et-point mon-cuff" onClick="javascript:getmonogrmplace(\'49\');"></button>';}
		}
                                                            
       if($eTailorObjN['omonogram']=='46'){ $datamono=$datamono.'<button type="button" class="et-point mon-waist active" onClick="javascript:getmonogrmplace(\'46\');"></button>';} else { $datamono=$datamono.'<button type="button" class="et-point mon-waist" onClick="javascript:getmonogrmplace(\'46\');"></button>';}
      $datamono=$datamono.'</div><div class="et-options-more"><div class="et-check-box"><label class="subhead-two" ><span class="cr"><i class="cr-icon"></i></span>  2. Enter Desired Monogram/Initials <p class="sub-title">{<span>English Script Only</span>}</p></label><div class="radio"><label>';
	  if($eTailorObjN['omonogramStyle']=='normal'){ $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true" checked onClick="javascript:getmonostyle(\'normal\');">';} else { $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true" onClick="javascript:getmonostyle(\'normal\');">';}
      
	  $datamono=$datamono.'<span class="cr"><i class="cr-icon"></i></span>monogram </label></div><div class="radio"><label>';
      
	  if($eTailorObjN['omonogramStyle']=='italic'){ $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true" checked  onClick="javascript:getmonostyle(\'italic\');">';} else { $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true"  onClick="javascript:getmonostyle(\'italic\');">';}
      
	  $datamono=$datamono.'<span class="cr"><i class="cr-icon"></i></span><i>monogram</i></label></div><div class="text-box"><label><input type="text" name="monogrmtxt" id="monogrmtxt" value="'.$eTailorObjN['omonogramText'].'" maxlength="10" onBlur="javascript:getmonotext(this.value);"></label></div></div><div class="et-sm-carousel"><h5><i class="cr-icon"></i></span>  3. Monogram Colors</h5><div class="et-contrast-list"><ul class="et-item-list">';
      
	  $monothrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
      foreach($monothrdlst as $monothrdlst){
	  	$datamono=$datamono.' <li class="et-item threads" onClick="javascript:getmonotxtcolor('.$monothrdlst->id.');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.'" />/figure>';
      	if($monothrdlst->id==$eTailorObjN['omonogramColor']){ $datamono=$datamono.'<div class="icon-check"></div>';}
      $datamono=$datamono.'</li>';
	  }
      $datamono=$datamono.'</ul></div></div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-monogram-fabric\');">BACK</button><button type="button" class="btn pull-right et-done" onClick="javascript:showSection(\'sect-measurement\');">Go TO MEASUREMENT</button></div>';
	  
		$data = ['1' => $datamono,'2' => $eTailorObjN];
		return $data;
	}
	
	public function getmonotextdtls(){
		$datamono='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['omonogramText']=$ff;
		
		$datamono=$datamono.'<div class="et-modal-header"><h4>MONOGRAM PERSONALISATION</h4><span class="ad-option-monogram et-oc" onClick="hidediv(\'et-monogram-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-2"><div class="preview-box monogram" style="position:relative"><label class="monogram-subhead" ><span class="cr"><i class="cr-icon"></i></span>  1. Click on the Monogram Location(red dot)</label><figure class="ad-selected-item" id="monogrmpreview"><img src=""></figure>';
        
		if($eTailorObjN['opacket']!=37){
        	if($eTailorObjN['omonogram']=='48'){ $datamono=$datamono.'<button type="button" class="et-point mon-pocket active" onClick="javascript:getmonogrmplace(\'48\');"></button>';} else {$datamono=$datamono.'<button type="button" class="et-point mon-pocket" onClick="javascript:getmonogrmplace(\'48\');"></button>';}
		} else {
        	if($eTailorObjN['omonogram']=='47'){ $datamono=$datamono.'<button type="button" class="et-point mon-chest active" onClick="javascript:getmonogrmplace(\'47\');"></button>';} else { $datamono=$datamono.'<button type="button" class="et-point mon-chest" onClick="javascript:getmonogrmplace(\'47\');"></button>';}
		}
        
		if($eTailorObjN['osleeve']!=3){
        	if($eTailorObjN['omonogram']=='49'){ $datamono=$datamono.'<button type="button" class="et-point mon-cuff active" onClick="javascript:getmonogrmplace(\'49\');"></button>';} else { $datamono=$datamono.'<button type="button" class="et-point mon-cuff" onClick="javascript:getmonogrmplace(\'49\');"></button>';}
		}
                                                            
       if($eTailorObjN['omonogram']=='46'){ $datamono=$datamono.'<button type="button" class="et-point mon-waist active" onClick="javascript:getmonogrmplace(\'46\');"></button>';} else { $datamono=$datamono.'<button type="button" class="et-point mon-waist" onClick="javascript:getmonogrmplace(\'46\');"></button>';}
      $datamono=$datamono.'</div><div class="et-options-more"><div class="et-check-box"><label class="subhead-two" ><span class="cr"><i class="cr-icon"></i></span>  2. Enter Desired Monogram/Initials <p class="sub-title">{<span>English Script Only</span>}</p></label><div class="radio"><label>';
	  if($eTailorObjN['omonogramStyle']=='normal'){ $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true" checked onClick="javascript:getmonostyle(\'normal\');">';} else { $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true" onClick="javascript:getmonostyle(\'normal\');">';}
      
	  $datamono=$datamono.'<span class="cr"><i class="cr-icon"></i></span>monogram </label></div><div class="radio"><label>';
      
	  if($eTailorObjN['omonogramStyle']=='italic'){ $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true" checked  onClick="javascript:getmonostyle(\'italic\');">';} else { $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true"  onClick="javascript:getmonostyle(\'italic\');">';}
      
	  $datamono=$datamono.'<span class="cr"><i class="cr-icon"></i></span><i>monogram</i></label></div><div class="text-box"><label><input type="text" name="monogrmtxt" id="monogrmtxt" value="'.$eTailorObjN['omonogramText'].'" maxlength="10" onBlur="javascript:getmonotext(this.value);"></label></div></div><div class="et-sm-carousel"><h5><i class="cr-icon"></i></span>  3. Monogram Colors</h5><div class="et-contrast-list"><ul class="et-item-list">';
      
	  $monothrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
      foreach($monothrdlst as $monothrdlst){
	  	$datamono=$datamono.' <li class="et-item threads" onClick="javascript:getmonotxtcolor('.$monothrdlst->id.');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.'" />/figure>';
      	if($monothrdlst->id==$eTailorObjN['omonogramColor']){ $datamono=$datamono.'<div class="icon-check"></div>';}
      $datamono=$datamono.'</li>';
	  }
      $datamono=$datamono.'</ul></div></div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-monogram-fabric\');">BACK</button><button type="button" class="btn pull-right et-done" onClick="javascript:showSection(\'sect-measurement\');">Go TO MEASUREMENT</button></div>';
	  
		$data = ['1' => $datamono,'2' => $eTailorObjN];
		return $data;
	}
	
	public function getmonotextcolordtls(){
		$datamono='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['omonogramColor']=$ff;
		$style_record = Thread::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['omonogramHoleName']=$style_record->thrd_name;
		$eTailorObjN['omonogramCode']=$style_record->thread_code;
		$eTailorObjN['omonogramtextColor']=strtoupper($style_record->thread_color);
		
		$datamono=$datamono.'<div class="et-modal-header"><h4>MONOGRAM PERSONALISATION</h4><span class="ad-option-monogram et-oc" onClick="hidediv(\'et-monogram-fabric\');"><img src="'.$p[0].'/advance/img/CloesButton.png"/></span></div><div class="et-modal-colum-2"><div class="preview-box monogram" style="position:relative"><label class="monogram-subhead" ><span class="cr"><i class="cr-icon"></i></span>  1. Click on the Monogram Location(red dot)</label><figure class="ad-selected-item" id="monogrmpreview"><img src=""></figure>';
        
		if($eTailorObjN['opacket']!=37){
        	if($eTailorObjN['omonogram']=='48'){ $datamono=$datamono.'<button type="button" class="et-point mon-pocket active" onClick="javascript:getmonogrmplace(\'48\');"></button>';} else {$datamono=$datamono.'<button type="button" class="et-point mon-pocket" onClick="javascript:getmonogrmplace(\'48\');"></button>';}
		} else {
        	if($eTailorObjN['omonogram']=='47'){ $datamono=$datamono.'<button type="button" class="et-point mon-chest active" onClick="javascript:getmonogrmplace(\'47\');"></button>';} else { $datamono=$datamono.'<button type="button" class="et-point mon-chest" onClick="javascript:getmonogrmplace(\'47\');"></button>';}
		}
        
		if($eTailorObjN['osleeve']!=3){
        	if($eTailorObjN['omonogram']=='49'){ $datamono=$datamono.'<button type="button" class="et-point mon-cuff active" onClick="javascript:getmonogrmplace(\'49\');"></button>';} else { $datamono=$datamono.'<button type="button" class="et-point mon-cuff" onClick="javascript:getmonogrmplace(\'49\');"></button>';}
		}
                                                            
       if($eTailorObjN['omonogram']=='46'){ $datamono=$datamono.'<button type="button" class="et-point mon-waist active" onClick="javascript:getmonogrmplace(\'46\');"></button>';} else { $datamono=$datamono.'<button type="button" class="et-point mon-waist" onClick="javascript:getmonogrmplace(\'46\');"></button>';}
      $datamono=$datamono.'</div><div class="et-options-more"><div class="et-check-box"><label class="subhead-two" ><span class="cr"><i class="cr-icon"></i></span>  2. Enter Desired Monogram/Initials <p class="sub-title">{<span>English Script Only</span>}</p></label><div class="radio"><label>';
	  if($eTailorObjN['omonogramStyle']=='normal'){ $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true" checked onClick="javascript:getmonostyle(\'normal\');">';} else { $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true" onClick="javascript:getmonostyle(\'normal\');">';}
      
	  $datamono=$datamono.'<span class="cr"><i class="cr-icon"></i></span>monogram </label></div><div class="radio"><label>';
      
	  if($eTailorObjN['omonogramStyle']=='italic'){ $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true" checked  onClick="javascript:getmonostyle(\'italic\');">';} else { $datamono=$datamono.'<input type="radio" name="monogrmrad" id="monogrmrad" value="true"  onClick="javascript:getmonostyle(\'italic\');">';}
      
	  $datamono=$datamono.'<span class="cr"><i class="cr-icon"></i></span><i>monogram</i></label></div><div class="text-box"><label><input type="text" name="monogrmtxt" id="monogrmtxt" value="'.$eTailorObjN['omonogramText'].'" maxlength="10" onBlur="javascript:getmonotext(this.value);"></label></div></div><div class="et-sm-carousel"><h5><i class="cr-icon"></i></span>  3. Monogram Colors</h5><div class="et-contrast-list"><ul class="et-item-list">';
      
	  $monothrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
      foreach($monothrdlst as $monothrdlst){
	  	$datamono=$datamono.' <li class="et-item threads" onClick="javascript:getmonotxtcolor('.$monothrdlst->id.');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.'" />/figure>';
      	if($monothrdlst->id==$eTailorObjN['omonogramColor']){ $datamono=$datamono.'<div class="icon-check"></div>';}
      $datamono=$datamono.'</li>';
	  }
      $datamono=$datamono.'</ul></div></div></div></div><div class="et-bottom-wrp et-pro-wrp"><button type="button" class="btn pull-left et-skip" onClick="hidediv(\'et-monogram-fabric\');">BACK</button><button type="button" class="btn pull-right et-done" onClick="javascript:showSection(\'sect-measurement\');">Go TO MEASUREMENT</button></div>';
	  
		$data = ['1' => $datamono,'2' => $eTailorObjN];
		return $data;
	}
	
	public function getallfabricsdetails(){
		$data='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		$cntv=0; 
		
		if($ff!=0){ 
			$data=$data.'<div class="et-full-modal"><div class="et-modal-header"><h3>All Shirt Fabrics</h3><div class="et-modal-listem"><ul><li class="et-yellow">Search :</li><li><div class="et-btn-group"><div class="et-btn-select"><select class="selectpicker btn-primary" name="allfabtxt" id="allfabtxt" onChange="javascript:getallfabricslist(this.value);"><option value="0">Fabric All</option>';
			
			$group_record = FabricGroup::select('*')->where('cat_id', '=', 1)->get();
			foreach($group_record as $grall){
			$fabricalllst = Etfabric::select('*')->where('fbgrp_id','=',$ff)->get(); 
			if($grall->id==$ff){ $data=$data.'<option value="'.$grall->id.'" selected>'.$grall->fbgrp_name.'</option>';} else {$data=$data.'<option value="'.$grall->id.'">'.$grall->fbgrp_name.'</option>';}
			} $cntv=$cntv-(-count($fabricalllst));
	
			$data=$data.'</select></div></div></li><li class="et-blue" id="totfab">Total : '.$cntv.' Fabric</li></ul></div></div><div class="et-fabric-view"><div class="et-selected-fabric et-fw"><figure class="choosen-fabric st-fabric-img-group" id="cpreview"><img src="'.$paths.'/Shirts/Fabric/C/'.$eTailorObjN['ofabric'].'.png" alt=""/>';
			if($eTailorObjN['ocollarCuffIn']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObjN['ocontrast'].'.png" >';}
			if($eTailorObjN['ocollarCuffout']=="true"){ $data=$data.'<img  class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObjN['ocontrast'].'.png">';}
			if($eTailorObjN['ofrontPlacketIn']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObjN['ocontrast'].'.png">';}
			if($eTailorObjN['ofrontPlacketOut']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObjN['ocontrast'].'.png">';}
			if($eTailorObjN['ofrontBoxOut']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObjN['ocontrast'].'.png">';}
			if($eTailorObjN['ofront']==4){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
			} elseif($eTailorObjN['ofront']==5){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
			}
			$data=$data.'</figure></div><div class="btn-wrp et-fw"><input type="hidden" id="allfabh" value="'.$eTailorObjN['ofabric'].'"><input type="hidden" id="allfabch" value="'.$eTailorObjN['ofabric'].'"><button type="button" class="btn adv-button" onClick="javascript:getCfabric();">Choose</button> <button type="button" class="btn adv-button" onClick="javascript:getExit();">EXIT</button></div></div><div class="et-custom-scrollbar"><ul class="et-item-list">';
			$fabricalllst = Etfabric::select('*')->where('fbgrp_id','=',$ff)->get();
			foreach($fabricalllst as $faballlst){
			$data=$data.'<li class="et-item" id="optionlist-fabric-all'.$faballlst->id.'" onClick="javascript:showCPreview(\''.$faballlst->id.'\')"><figure class="et-item-img"><img src="'.$paths.'/'.$faballlst->fabric_img_s.'" alt="'.$faballlst->fabric_name.'"></figure>';
			if($faballlst->id==$eTailorObjN['ofabric']){ $data=$data.'<div class="icon-check"></div>';}
			$data=$data.'</li>';
			}
			$data=$data.'</ul></div></div>';
		} else {
			$data=$data.'<div class="et-full-modal"><div class="et-modal-header"><h3>All Shirt Fabrics</h3><div class="et-modal-listem"><ul><li class="et-yellow">Search :</li><li><div class="et-btn-group"><div class="et-btn-select"><select class="selectpicker btn-primary" name="allfabtxt" id="allfabtxt" onChange="javascript:getallfabricslist(this.value);"><option value="0">Fabric All</option>';
		
			$group_record = FabricGroup::select('*')->where('cat_id', '=', 1)->get();
			foreach($group_record as $grall){
			$fabricalllst = Etfabric::select('*')->where('fbgrp_id','=',$grall->id)->get(); $cntv=$cntv-(-count($fabricalllst));
			$data=$data.'<option value="'.$grall->id.'">'.$grall->fbgrp_name.'</option>';
			} 
	
			$data=$data.'</select></div></div></li><li class="et-blue" id="totfab">Total : '.$cntv.' Fabric</li></ul></div></div><div class="et-fabric-view"><div class="et-selected-fabric et-fw"><figure class="choosen-fabric st-fabric-img-group" id="cpreview"><img src="'.$paths.'/Shirts/Fabric/C/'.$eTailorObjN['ofabric'].'.png" alt=""/>';
			if($eTailorObjN['ocollarCuffIn']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObjN['ocontrast'].'.png" >';}
			if($eTailorObjN['ocollarCuffout']=="true"){ $data=$data.'<img  class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObjN['ocontrast'].'.png">';}
			if($eTailorObjN['ofrontPlacketIn']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObjN['ocontrast'].'.png">';}
			if($eTailorObjN['ofrontPlacketOut']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObjN['ocontrast'].'.png">';}
			if($eTailorObjN['ofrontBoxOut']=="true"){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObjN['ocontrast'].'.png">';}
			if($eTailorObjN['ofront']==4){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
			} elseif($eTailorObjN['ofront']==5){ $data=$data.'<img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img class="st-fabric-img-abs" src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
			}
			$data=$data.'</figure></div><div class="btn-wrp et-fw"><input type="hidden" id="allfabh" value="'.$eTailorObjN['ofabric'].'"><input type="hidden" id="allfabch" value="'.$eTailorObjN['ofabric'].'"><button type="button" class="btn adv-button" onClick="javascript:getCfabric();">Choose</button> <button type="button" class="btn adv-button" onClick="javascript:getExit();">EXIT</button></div></div><div class="et-custom-scrollbar"><ul class="et-item-list">';
			foreach($group_record as $grall){
				$fabricalllst = Etfabric::select('*')->where('fbgrp_id','=',$grall->id)->get();
				foreach($fabricalllst as $faballlst){
					$data=$data.'<li class="et-item" id="optionlist-fabric-all'.$faballlst->id.'" onClick="javascript:showCPreview(\''.$faballlst->id.'\')"><figure class="et-item-img"><img src="'.$paths.'/'.$faballlst->fabric_img_s.'" alt="'.$faballlst->fabric_name.'"></figure>';
					if($faballlst->id==$eTailorObjN['ofabric']){ $data=$data.'<div class="icon-check"></div>';}
					$data=$data.'</li>';
				}
			}
			$data=$data.'</ul></div></div>';
		}
	  
		$data = ['1' => $data,'2' => $eTailorObjN];
		return $data;
	}
	
	
	
	public function get_item()
   	{ 	
   		/*print_r($_POST);
	      exit();*/
	
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
																
						DB::table('carts')
						->where('user_id', $userid)
						->update(['cart_sessionid' => $cartsess]);					
				}
			}else{
				$userid=Null;
			}
		  
	   $eTailorObj = json_decode($_POST['setarr'], true);  
	   
	   
		//print_r($eTailorObj); exit();
	   $finalarr = json_decode($_POST['setarr'], true);
	   $finalarr['osizePattern']= $_POST['mpattern'];
	   if($eTailorObj['osleeve']==3){
				$finalarr['ocuffName']='';
				$finalarr['ocollarCuffout'] ='false';
				$finalarr['ocollarCuffIn']  = 'false';
		}
	   if($_POST['mpattern']=="Body"){
			$finalarr['osizeStyle']= $_POST['fitstyle'];
			$finalarr['osizeType']= $_POST['bsizetyp'];
			$finalarr['osizeNeck']= $_POST['bsizeNeck'];
			$finalarr['osizeChest']= $_POST['bsizeChest'];
			$finalarr['osizeWaist']= $_POST['bsizeWaist'];
			$finalarr['osizeHip']= $_POST['bsizeHip'];
			$finalarr['osizeLength']= $_POST['bsizeLength'];
			$finalarr['osizeShoulder']= $_POST['bsizeShoulder'];
			$finalarr['osizeSleeve']= $_POST['bsizeSleeve'];
			$finalarr['oqty']= 1;			
			$finalarr['ofrontView']= '';
			$finalarr['obackView']= '';
			$finalarr['osizeFit']='';
			
			if($eTailorObj['ocartID']==''){
				$bodyqty=$_POST['selbodyqty'];
			}else{
				$bodyqty=1;
			}
			
			//print_r($eTailorObj);
			//exit();
			for($i=0;$i<$bodyqty;$i++){
				
				$ppt=$finalarr;												
				 $cartSet = [
					'cart_sessionid' => $cartsess,
					'cat_id' => $eTailorObj['ocatID'],
					'user_id' => $userid,
					'group_id' => $eTailorObj['ofabricType'],
					'fabric_id' => $eTailorObj['ofabric'],
					'fabric_name' => $eTailorObj['ofabricName'],
					'fabric_image' => $eTailorObj['ofabricImage'],
					'item_description' => serialize($ppt),
					'price' => $eTailorObj['ofabricPrice'],					
					'qty' => 1,
					'total' => $eTailorObj['oqty']*$eTailorObj['ofabricPrice'],
					 'created_at' => date('y-m-d H:i:s'),
					'updated_at' => date('y-m-d H:i:s'),
				];
				
				 //Insert if record is new ot
				 if($eTailorObj['ocartID']==''){
			 		
				 	$ids = DB::table('carts')->insert($cartSet);
					$cartId = DB::getPdo()->lastInsertId();	
					
					/* insert canvas dataurl*/
					/*$canvasSet = [
						'cart_id' => $cartId,
						'canvas_front_img' => $_POST['frntviewfinal'],
						'canvas_back_img' => $_POST['bkviewfinal'],					
						 'created_at' => date('y-m-d H:i:s'),
						'updated_at' => date('y-m-d H:i:s'),
					];*/
		  			//$canvasids = DB::table('canvas_dataurls')->insert($canvasSet);
						
				 }else{	 				 
					 DB::table('carts')
						->where('id', $eTailorObj['ocartID'])
						->update($cartSet);
						
					$cartId=$eTailorObj['ocartID'];	
					
					/* Update canvas dataurl*/
					$cartimg = Cart::select('canvas_front_img','canvas_back_img')->where('id', '=',  $cartId)->first();					
					
					$deletefront=Helpers::imggdelete($cartimg->canvas_front_img);
					$deleteback=Helpers::imggdelete($cartimg->canvas_back_img);
					
					/*$canvasSet = [					
						'orderitem_id' => $cartId,
						'canvas_front_img' => $_POST['frntviewfinal'],
						'canvas_back_img' => $_POST['bkviewfinal'],
						'updated_at' => date('y-m-d H:i:s'),
					];*/
					//$canvasids = DB::table('canvas_dataurls')->where('cart_id', $cartId)->update($canvasSet);
					
					
					
							
				 }
				 
				$canvasfront = CanvasDataurl::select('canvas_front_img')->where('orderitem_id', '=', $_POST['rndvalue'])->where('canvas_front_img', '!=', '')->first();
				
				$canvasback = CanvasDataurl::select('canvas_back_img')->where('orderitem_id', '=', $_POST['rndvalue'])->where('canvas_back_img', '!=', '')->first();
								
				$frontimg=Helpers::dataurltoimg($canvasfront->canvas_front_img,$cartId,'front');
				$backimg=Helpers::dataurltoimg($canvasback->canvas_back_img,$cartId,'back');			 
				
				$cartimgSet = [					
				'canvas_front_img' => $frontimg,
				'canvas_back_img' => $backimg,				 
				];
				DB::table('carts')->where('id', $cartId)->update($cartimgSet);
				 
				/*Update front image and back image*/
				/*$frontimg=Helpers::dataurltoimg($_POST['frntviewfinal'],$cartId,'front');
				$backimg=Helpers::dataurltoimg($_POST['bkviewfinal'],$cartId,'back');
				
				$cartimgSet = [					
					'canvas_front_img' => $frontimg,
					'canvas_back_img' => $backimg,				 
				];
				DB::table('carts')->where('id', $cartId)->update($cartimgSet);*/
				 
				 
			}
			
	   } elseif($_POST['mpattern']=="Standard"){
		   
		   	$sizefit=$_POST['selsize'];					
			
		   	$finalarr['osizeType']= $_POST['sizetyp'];
		    $finalarr['oqty']= 1;
		    $finalarr['osizeStyle']='';
			$finalarr['ofrontView']= '';
			$finalarr['obackView']= '';
			$fitlst="";
			 
			
			if($eTailorObj['ocartID']==''){
				$sizeqty=$_POST['selstdqty'];
			}else{				
				$finalarr['osizeStyle']='';				
				$finalarr['osizeNeck']= '';
				$finalarr['osizeChest']='';
				$finalarr['osizeWaist']='';
				$finalarr['osizeHip']= '';
				$finalarr['osizeLength']='';
				$finalarr['osizeShoulder']='';
				$finalarr['osizeSleeve']='';				
				$sizeqty[]=1;
			}
			
			for($i=0;$i<count($sizeqty);$i++){
							
				for($p=0;$p<$sizeqty[$i];$p++){
				
					$finalarr['osizeFit']=$sizefit[$i];	
						$pp=$finalarr;				
						
						 $cartSet = [
						'cart_sessionid' => $cartsess,
						'cat_id' => $eTailorObj['ocatID'],
						'user_id' => $userid,
						'group_id' => $eTailorObj['ofabricType'],
						'fabric_id' => $eTailorObj['ofabric'],
						'fabric_name' => $eTailorObj['ofabricName'],
						'fabric_image' => $eTailorObj['ofabricImage'],						
						'item_description' => serialize($pp),
						'price' => $eTailorObj['ofabricPrice'],					
						'qty' => 1,
						'total' => $eTailorObj['oqty']*$eTailorObj['ofabricPrice'],
						 'created_at' => date('y-m-d H:i:s'),
        				'updated_at' => date('y-m-d H:i:s'),
						];
						
						 if($eTailorObj['ocartID']==''){
						 	$ids = DB::table('carts')->insert($cartSet);
							$cartId = DB::getPdo()->lastInsertId();	
							/* insert canvas dataurl*/
							/*$canvasSet = [
							'cart_id' => $cartId,
							'canvas_front_img' => $_POST['frntviewfinal'],
							'canvas_back_img' => $_POST['bkviewfinal'],					
							 'created_at' => date('y-m-d H:i:s'),
							'updated_at' => date('y-m-d H:i:s'),
							];*/
							
		  					//$canvasids = DB::table('canvas_dataurls')->insert($canvasSet);
							
						 }else{
						   	DB::table('carts')
							->where('id', $eTailorObj['ocartID'])
							->update($cartSet);
							$cartId = $eTailorObj['ocartID'];
							
							$cartimg = Cart::select('canvas_front_img','canvas_back_img')->where('id', '=',  $cartId)->first();	
											
							/* update canvas dataurl*/
							$deletefront=Helpers::imggdelete($cartimg->canvas_front_img);
							$deleteback=Helpers::imggdelete($cartimg->canvas_back_img);
							
							/*$canvasSet = [					
								'orderitem_id' => $cartId,
								'canvas_front_img' => $_POST['frntviewfinal'],
								'canvas_back_img' => $_POST['bkviewfinal'],
								'updated_at' => date('y-m-d H:i:s'),
							];*/
							//$canvasids = DB::table('canvas_dataurls')->where('cart_id', $cartId)->update($canvasSet);
									
						 }	
						 
						/* update front and back image*/
						
			//echo $_POST['rndvalue'];			
	$canvasfront = CanvasDataurl::select('canvas_front_img')->where('orderitem_id', '=', $_POST['rndvalue'])->where('canvas_front_img', '!=', '')->first();
	$canvasback = CanvasDataurl::select('canvas_back_img')->where('orderitem_id', '=', $_POST['rndvalue'])->where('canvas_back_img', '!=', '')->first();
											
						$frontimg=Helpers::dataurltoimg($canvasfront->canvas_front_img,$cartId,'front');
						$backimg=Helpers::dataurltoimg($canvasback->canvas_back_img,$cartId,'back');			 
						
						$cartimgSet = [					
							'canvas_front_img' => $frontimg,
							'canvas_back_img' => $backimg,				 
						];
						DB::table('carts')->where('id', $cartId)->update($cartimgSet);
						 		
				}	
			}			
	   }	
	   
	      
		$deleteDataurl = CanvasDataurl::select('*')->where('orderitem_id', '=',  $_POST['rndvalue'])->delete();
		//return Redirect::to('/cart');
		return response()->json(array('mes'=>'sucess'));
	   
   }
   
   public function editcartshirt($id = null){
	
	  	if(Session::has('carts')) {
			$cartsess=Session::get('carts');						
		}else{
			 return Redirect::to('/');							
		}	
		
		
		$data =  Cart::select('*')->where('id' , '=' ,$id)->where('cart_sessionid' , '=' ,$cartsess)->find($id);
			if($data!=''){
			$eTailorObj = unserialize($data->item_description);
			$eTailorObj['ocartID']=$id;
			$mytab="etfabric";
			$mysubtab="fabric1";
			$loadme="0";
			/* Fabric */
			 $id=$eTailorObj['ocatID'];
			 //$car_record = Category::select('*')->where('id', '=', $data->cat_id)->first($id);
			 $cat_id = $data->cat_id;
			 $group_record = FabricGroup::select('*')->where('cat_id', '=', $cat_id)->get();
			 
			 switch ($cat_id) {
					case '1':
					$mainr=1;
					$conr=2; 
					$pname='demo/test';
					break;
					case '2':
					$mainr=16;
					$conr=17;
					$pname='jacket.jacket';
					break;
					case '3':
					$mainr=32;
					$conr=33;
					$pname='vests.vest';
					break;
					case '4':
					$mainr=45;
					$conr=46;
					$pname='pants.pants';
					break;			
					
					default:
					return "";
					break;
			}		 
			 
			 
			/* Attribute Style */
			$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', $mainr)->get();
			
			/* Contrast */
			$contrast_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', $conr)->get();
			
			return view::make($pname)->with(compact('car_record','group_record','mainattr_record','contrast_record','eTailorObj','mytab','mysubtab','loadme'));
		}else{
			 return view::make('errors/404');	
		}
	}
	
	public function editcustomshirt($id = null){	
	  	
		
		$data =  EcollectionProduct::select('*')->where('id' , '=' ,$id)->find($id);
			if($data!=''){
			$eTailorObj = unserialize($data->custom_description);
			//$eTailorObj['ocartID']=$id;
			$mytab="etfabric";
			$mysubtab="fabric1";
			$loadme="0";
			/* Fabric */
			 $id=$eTailorObj['ocatID'];
			 $car_record = Category::select('*')->where('id', '=', $data->cat_id)->first($id);
			 $cat_id = $data->cat_id;
			 $group_record = FabricGroup::select('*')->where('cat_id', '=', $cat_id)->get();
			 
			 switch ($cat_id) {
					case '1':
					$mainr=1;
					$conr=2; 
					$pname='demo/test';
					break;
					case '2':
					$mainr=16;
					$conr=17;
					$pname='jacket.jacket';
					break;
					case '3':
					$mainr=32;
					$conr=33;
					$pname='vests.vest';
					break;
					case '4':
					$mainr=45;
					$conr=46;
					$pname='pants.pants';
					break;			
					
					default:
					return "";
					break;
			}		 
			 
			 
			/* Attribute Style */
			$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', $mainr)->get();
			
			/* Contrast */
			$contrast_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', $conr)->get();
			
			return view::make($pname)->with(compact('car_record','group_record','mainattr_record','contrast_record','eTailorObj','mytab','mysubtab','loadme'));
		}else{
			 return view::make('errors/404');	
		}
	}
	
	
	function postfdataurl(){
		
			$canvasSet = [					
			'canvas_front_img' => $_POST['frntviewfinal'],
			'orderitem_id' => $_POST['rndvalue'],
			'created_at' => date('y-m-d H:i:s'),
			'updated_at' => date('y-m-d H:i:s'),
			];
			
			$canvasids = DB::table('canvas_dataurls')->insert($canvasSet);				
			 return response()->json(array('mes'=>'sucess')); 
	}
	
	
	function postbdataurl(){
							
		$canvasSet = [					
			'canvas_back_img' => $_POST['bkviewfinal'],
			'orderitem_id' => $_POST['rndvalue'],
			'created_at' => date('y-m-d H:i:s'),
			'updated_at' => date('y-m-d H:i:s'),
			];
			
			$canvasids = DB::table('canvas_dataurls')->insert($canvasSet);			
						
		 return response()->json(array('mes'=>'sucess')); 	
	}
	
	
}
