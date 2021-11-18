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


class DemoController extends Controller
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
		
		return view::make('demo/test')->with(compact('car_record','group_record','mainattr_record','contrast_record','eTailorObj','mytab','mysubtab','loadme'));
    }
   
   public function getfabdetails()
   {
		$data='';
		$datastyle='';
		$datatab='';
		$datacont='';
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
		/* Fabric */
		$data=$data.'<div class="et-content-fab"><figure class="et-fab-img"><img src="'.$paths.'/'.$fabric_record->fabric_img_l.'" alt="'.$fabric_record->fabric_name.'"></figure><div class="et-fab-box"><h2>'.$fabric_record->fabric_name.'</h2>';
        if($eTailorObjN['ofabric']==1){
        	$data=$data.'<h1 class="un-bg">WORLD’S BEST</h1><span>100% Cotton</span><div class="et-guarantee"><span>'.number_format($fabgrup_record->fabric_rate,2).'$</span><figure class="gura-icon"><img src="'.$p[0].'/demo/img/sil.png" alt=""></figure></div><h1>SUPER-SOFT</h1><span>80/2X80/2</span>';
		} else {
        	$data=$data.'<span>100% Cotton</span><span>easy care</span><h1><h2>&nbsp;</h2><span>-Free Contrast Fabrics</span><span>-Free Monogram/Initials</span>';
		}
        $data=$data.'<h3><a href="#" data-toggle="modal" data-target="#fabric-id">Zoom</a></h3></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div><div class="modal fade et-fabric-modal" id="fabric-id" tabindex="-1" role="dialog" aria-labelledby="fabric-modal"><div class="modal-dialog" role="document"><div class="modal-content"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><div class="modal-body"><figure class="et-fabric-big"><img src="'.$paths.'/'.$fabric_record->fabric_img_l.'" alt="'.$fabric_record->fabric_name.'"></figure></div></div></div></div>';
		/* Style */
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 1)->where('parent_id', '=', 1)->get();
		foreach($mainattr_record as $mattr){
			$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
		
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get(); 
			foreach($stylelst as $styllst) {
				if($stylci==7){ $datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
			
				$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				if($styllst->id == 37) { 
					$datastyle=$datastyle.'<figure class="et-item-img"><img src="'.$paths.'/none/none.jpg" alt="'.$styllst->style_name.'"></figure>';
					if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
				} else {
					foreach($styleimglst as $ls) {
						$datastyle=$datastyle.'<figure class="et-item-img"><img src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
					
						$thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
						foreach($thrdimglst as $thrdls) { if($mattr->id!='5') { $datastyle=$datastyle.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$ls->style_name.'">';}}
						$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
						foreach($buttimglst as $buttls) { if($mattr->id!='4') { $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}}
						$datastyle=$datastyle.'</figure>';
						if($mattr->id==4) { if($styllst->id == $eTailorObjN['osleeve']) { $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==5) { if($styllst->id == $eTailorObjN['ofront']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==6) { if($styllst->id == $eTailorObjN['oback']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==7) { if($styllst->id == $eTailorObjN['obottom']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==8) { if($styllst->id == $eTailorObjN['ocollar']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==9) { if($styllst->id == $eTailorObjN['ocuff']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==10) { if($styllst->id == $eTailorObjN['opacket'] && $styllst->id != 37){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==11) { if($styllst->id == $eTailorObjN['ocontrast']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==12) { if($styllst->id == $eTailorObjN['obutton']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==13) { if($styllst->id == $eTailorObjN['omonogramColor']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					}
					}
				}
				$datastyle=$datastyle.'</li>'; 
				$stylci++;
			}
			$datastyle=$datastyle.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-left.png"></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-right.png"></span><span class="sr-only">Next</span></a></div></div>';
		}
		
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg"><div class="et-content-fab" id="miniview-etstyle-4"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['osleeveName'].'"></figure><div class="et-style-select"><h2>Sleeve</h2><span>'.$eTailorObjN['osleeveName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['oshoulder']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['oshoulder'].',\'Epaulette\',\'4\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['oshoulder'].',\'Epaulette\',\'4\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Epaulettes</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-5" style="display:none"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['ofrontName'].'"></figure><div class="et-style-select"><h2>Front Style</h2><span>'.$eTailorObjN['ofrontName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['oseams']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['oseams'].',\'Seams\',\'5\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['oseams'].',\'Seams\',\'5\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Seams</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-6" style="display:none"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['obackName'].'"></figure><div class="et-style-select"><h2>Back Style</h2><span>'.$eTailorObjN['obackName'].'</span>';
		
		if($eTailorObjN['oback']==7 || $eTailorObjN['oback']==8) {
			$datastyle=$datastyle.'<div class="et-check-box"><div class="checkbox"><label>';
			if($eTailorObjN['odart']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['odart'].',\'Darts\',\'6\',\'etstyle\');">';} else { $datastyle=$datastyle.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['odart'].',\'Darts\',\'6\',\'etstyle\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Darts</label></div></div>';
		}
		
		$datastyle=$datastyle.'</div></div><div class="et-content-fab" id="miniview-etstyle-7" style="display:none"><figure class="et-selected-img">';
		$bottomstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['obottom'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$bottomstyle_record->list_img.'" alt="'.$eTailorObjN['obottomName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Bottom Style</h2><span>'.$eTailorObjN['obottomName'].'</span></div></div><div class="et-content-fab" id="miniview-etstyle-8" style="display:none"><figure class="et-selected-img">';
		$collarstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['ocollar'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collarstyle_record->list_img.'" alt="'.$eTailorObjN['ocollarName'].'">';
		$collrthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocollar'])->where('attri_id' , '=' , 8)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collrthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
		$collrbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocollar'])->where('attri_id' , '=' , 8)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collrbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Collar Style</h2><span>'.$eTailorObjN['ocollarName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocollarStay']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarStay'].',\'CollarStay\',\'8\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarStay'].',\'CollarStay\',\'8\',\'etstyle\');">';}
		
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Stay</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-9" style="display:none"><figure class="et-selected-img">';
		$cuffstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['ocuff'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffstyle_record->list_img.'" alt="'.$eTailorObjN['ocuffName'].'">';
		$cuffthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocuff'])->where('attri_id' , '=' , 9)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
		$cuffbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocuff'])->where('attri_id' , '=' , 9)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Cuff Style</h2><span>'.$eTailorObjN['ocuffName'].'</span></div></div>';
		$datastyle=$datastyle.'<div class="et-content-fab" id="miniview-etstyle-10" style="display:none;"><figure class="et-selected-img">';
		if($eTailorObjN['opacket']!=37) { 
			$pocktstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['opacket'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
			$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktstyle_record->list_img.'" alt="'.$eTailorObjN['opacketName'].'">';
			if($eTailorObjN['opacket']==42 || $eTailorObjN['opacket']==43 || $eTailorObjN['opacket']==44){
				$pocktthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['opacket'])->where('attri_id' , '=' , 10)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
				$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
				$pocktbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['opacket'])->where('attri_id' , '=' , 10)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
				$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
			}
		} else {
			$datastyle=$datastyle.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['opacketName'].'">';
		}
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Pocket Style</h2><span>'.$eTailorObjN['opacketName'].'</span>';
		
		if($eTailorObjN['opacket']!=37) { 
			$datastyle=$datastyle.'<div class="et-check-box"><div class="et-btn-group"><span>Number Of Pocket</span><div class="et-btn-select"><select class="selectpicker btn-primary" name="pocketstxt" id="pocketstxt" onChange="javascript:getseloptions(this.value,\'NumPocket\',\'10\',\'etstyle\');">';
			if($eTailorObjN['opacketCount']=="1"){$datastyle=$datastyle.'<option value="1" selected >1 Pocket</option>';} else {$datastyle=$datastyle.'<option value="1" >1 Pocket</option>';}
			if($eTailorObjN['opacketCount']=="2"){$datastyle=$datastyle.'<option value="2" selected >2 Pockets</option>'; } else { $datastyle=$datastyle.'<option value="2" >2 Pockets</option>';}
			$datastyle=$datastyle.'</select></div></div></div>';
		}
		$datastyle=$datastyle.'</div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		/* Image Tab */
		$datatab=$datatab.'<ul><li><a href="javascript:designProcessing();"><img src="'.$p[0].'/demo/img/product/view-normal.png"></a></li>';
		if($eTailorObjN['ocollar']!=21 && $eTailorObjN['ocollar']!=22 && $eTailorObjN['ocollar']!=23 && $eTailorObjN['ocollar']!=26 && $eTailorObjN['ocollar']!=27){ $datatab=$datatab.'<li><a href="javascript:designOpenProcessing();"><img src="'.$p[0].'/demo/img/product/view-advanced.png"/></a></li>'; }
		$datatab=$datatab.'</ul>';
		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', 1)->where('parent_id', '=', 2)->get();
		foreach($contrast_record as $contlst) {
			if($contlst->id == '11'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contfablst = Contrast::select('*')->where('cat_id','=',1)->get(); 
				foreach($contfablst as $cfablst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cfablst->id.'" data-title="'.$cfablst->contrsfab_name.'" title="'.$cfablst->contrsfab_name.'" onClick="javascript:getcontrast('.$cfablst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cfablst->contrsfab_img.'" alt="'.$cfablst->contrsfab_name.'"></figure>';
					if($cfablst->id==$eTailorObjN['ocontrast']) { $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';                                            
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '12') {
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contbuttlst = Button::select('*')->where('cat_id','=',1)->get(); 
				foreach($contbuttlst as $cbuttnlst){
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cbuttnlst->id.'" data-title="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')" onClick="javascript:getbutton('.$cbuttnlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cbuttnlst->button_img.'" alt="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')"></figure>';
					if($cbuttnlst->id==$eTailorObjN['obutton']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>B. Choose Your Buttonhole Thread</span></div><div class="et-contrast-list"><ul class="et-item-list">';
				
				$contthrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdlst as $cthreadlst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-thrd-'.$cthreadlst->id.'" data-title="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')" onClick="javascript:getthread('.$cthreadlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cthreadlst->thrd_img.'" alt="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')"></figure>';
					if($cthreadlst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>C. Choose Your Button Hole Style</span></div><div class="et-contrast-list">';
				
				$contthrdstyllst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdstyllst as $cthrdstyllst){
					$datacont=$datacont.'<ul class="et-item-list" id="TC'.$cthrdstyllst->id.'"';
					if($cthrdstyllst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'style="display:block;"';} else { $datacont=$datacont.'style="display:none"';} 
					$datacont=$datacont.'><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Vertical(V)" onClick="javascript:getthreadhole(\'V\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_vertical.'" alt="Vertical(V)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='V'){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Horizontal(H)" onClick="javascript:getthreadhole(\'H\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_horizontal.'" alt="Horizontal(H)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='H'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Slanted(L)" onClick="javascript:getthreadhole(\'S\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_slanted.'" alt="Slanted(L)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='S'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li></ul>';
				}
				$datacont=$datacont.'</div></div>';
			} elseif($contlst->id == '13'){ 
				$datacont=$datacont.'<div class="et-carousel" id="menu-opt-'.$contlst->id.'"><div id="et-style-item" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list"><li class="et-item" id="optionlist-'.$contlst->id.'-1" data-title="No Monogram" onClick="javascript:getmonogram(\'1\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/none/none.jpg" alt="No Monogram" title="No Monogram"></figure>';
				if($eTailorObjN['omonogram']=='1') { $datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';  
				
				$contmonogrmlst = AttributeStyle::select('*')->where('attri_id','=','13')->get(); 
				foreach($contmonogrmlst as $cmonolst){
				$cmonoimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$cmonolst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				if($cmonolst->id==46){
					foreach($cmonoimglst as $cmonols){
						$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
						if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
						$datacont=$datacont.'</figure>';
						if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
				} elseif($cmonolst->id==47) {
					if($eTailorObjN['opacket']==37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==48){
					if($eTailorObjN['opacket']!=37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==49){ 
					if($eTailorObjN['osleeve']!=3){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				}
				}
				$datacont=$datacont.'</ul></div></div></div>';
				
				if($eTailorObjN['omonogram']==46 || $eTailorObjN['omonogram']==47 || $eTailorObjN['omonogram']==48 || $eTailorObjN['omonogram']==49){
					$datacont=$datacont.'<div class="pt-pagination no-pad-left"><span>B. Enter Desire Monogram/Initials (English Script)</span></div><div class="et-contrast-list"><input type="text" name="monotext" id="monotext" maxlength="5" value="'.$eTailorObjN['omonogramText'].'" style="color:#8c7676;" onBlur="javascript:getmonotext(this.value,\'etcontrast\');"></div><div class="pt-pagination no-pad-left"><span>C. Monogram Color</span></div><div class="et-contrast-list"><ul class="et-item-list">';
					
					$monothrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
					foreach($monothrdlst as $monothrdlst){
						$datacont=$datacont.'<li class="et-item" id="optionlist-thrdcolr-'.$monothrdlst->id.'" data-title="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')" onClick="javascript:getmonotxtcolor('.$monothrdlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')"></figure>';
						if($monothrdlst->id==$eTailorObjN['omonogramColor']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
					$datacont=$datacont.'</ul></div>';
				}     
				$datacont=$datacont.'</div>';
			}
		}
		
		$datacont=$datacont.'<div class="et-progress-des et-style-bg"><div class="et-content-fab" id="miniview-etcontrast-11"><figure class="et-selected-img et-selected-con"><img src="'.$paths.'/Shirts/Fabric/C/'.$eTailorObjN['ofabric'].'.png">';
		if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObjN['ocontrast'].'.png" >';}
		if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofront']==4){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		} elseif($eTailorObjN['ofront']==5){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		}
		
		if($eTailorObjN['osleeve']!=3){
			if($eTailorObjN['ocuff']==34 || $eTailorObjN['ocuff']==35 || $eTailorObjN['ocuff']==36){
				if($eTailorObjN['ocollarCuffIn']=="true"){$datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">'; } else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			} else { 
				if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png" class="menu-l-contrast-cuff "><img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			}
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Contrast Fabric</h2><span class="highlight">Collar & Cuff</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffIn']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div></div><span class="highlight">Front Placket</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketIn']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div>';
		
		if($eTailorObjN['ofront']==5) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box Placket</label></div>';
		}
		if($eTailorObjN['oback']==8) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['obackBoxOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Box Placket</label></div>';
		}
		
		$datacont=$datacont.'</div></div></div>';
		$datacont=$datacont.'<div class="et-content-fab" id="miniview-etcontrast-12" style="display:none;" ><figure class="et-selected-img"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" alt=""><img src="'.$paths.'/Shirts/Threads/'.$eTailorObjN['obuttonHoleStyle'].'/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:18px; padding-top:20px;"><img src="'.$paths.'/Shirts/Buttons/'.$eTailorObjN['obutton'].'.png" alt="" style="padding-left:34px; padding-top:36px;"><img src="'.$paths.'/Shirts/Threads/C/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:17px; padding-top:18px;"></figure><div class="et-style-select"><h2>Contrast & Threads</h2><span class="highlight">A. Button Color :</span><p>'.$eTailorObjN['obuttonName'].' ('.$eTailorObjN['obuttonCode'].')</p><span class="highlight">B. Thread Color :</span><p>'.$eTailorObjN['obuttonHoleName'].' ('.$eTailorObjN['obuttonHoleCode'].')</p><span class="highlight">C. Button Hole Thread :</span><p>'.$eTailorObjN['obuttonHoleStyleName'].' ('.$eTailorObjN['obuttonHoleStyle'].')</p></div></div><div class="et-content-fab" id="miniview-etcontrast-13" style="display:none;" ><figure class="et-selected-img">';
		if($eTailorObjN['omonogram']==1){
			$datacont=$datacont.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['omonogramName'].'">';
		} elseif($eTailorObjN['omonogram']==46){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnWaist/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 55px 0px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==47){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnChest/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 75px 0px 35px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==48){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnPocket/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 11px;width: 100%;left: 0;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==49){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnCuff(Right)/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 55px;width: 100%;left: 0;transform: rotate(65deg);;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Monogram</h2><span class="highlight">A. Position :</span><p>'.$eTailorObjN['omonogramName'].'</p><span class="highlight">B. Enter Monogram :</span><p>'.$eTailorObjN['omonogramText'].'</p><span class="highlight">C. Monogram Color :</span><p>'.$eTailorObjN['omonogramHoleName'].' ('.$eTailorObjN['omonogramCode'].')</p></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $fabgrp,'4' => $eTailorObjN,'5' => $datastyle,'6' => $datatab,'7' => $datacont];
		return $data;
	}
	
	public function getstyledetails()
	{
		$data='';
		$datacont='';
		$datatab='';
		$datamaintab='';
		$datameasure='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		switch($attrbid){
			case '4':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['osleeve']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['osleeveName']=$style_record->style_name;
				
				$data=$data.'<figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['osleeveName'].'"></figure><div class="et-style-select"><h2>Sleeve</h2><span>'.$eTailorObjN['osleeveName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
				if($eTailorObjN['oshoulder']=="true"){$data=$data.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['oshoulder'].',\'Epaulette\',\'4\',\'etstyle\');">';} else {$data=$data.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['oshoulder'].',\'Epaulette\',\'4\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Epaulettes</label></div></div></div>';
				break;
			case '5':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['ofront']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['ofrontName']=$style_record->style_name;
				
				$data=$data.'<figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['ofrontName'].'"></figure><div class="et-style-select"><h2>Front Style</h2><span>'.$eTailorObjN['ofrontName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
				if($eTailorObjN['oseams']=="true"){ $data=$data.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['oseams'].',\'Seams\',\'5\',\'etstyle\');">';} else { $data=$data.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['oseams'].',\'Seams\',\'5\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Seams</label></div></div></div>';
				break;
			case '6':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['oback']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obackName']=$style_record->style_name;
				
				$data=$data.'<figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['obackName'].'"></figure><div class="et-style-select"><h2>Back Style</h2><span>'.$eTailorObjN['obackName'].'</span>';
				if($eTailorObjN['oback']==7 || $eTailorObjN['oback']==8){
					$data=$data.'<div class="et-check-box"><div class="checkbox"><label>';
					if($eTailorObjN['odart']=="true"){$data=$data.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['odart'].',\'Darts\',\'6\',\'etstyle\');">';} else {$data=$data.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['odart'].',\'Darts\',\'6\',\'etstyle\');">';}
					$data=$data.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Darts</label></div></div>';
				}
                $data=$data.'</div>';
				break;
			case '7':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['obottom']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obottomName']=$style_record->style_name;
				
				$data=$data.'<figure class="et-selected-img">';
				$data=$data.'<img src="'.$paths.'/'.$style_record->list_img.'" alt="'.$eTailorObjN['obottomName'].'">';
                $data=$data.'</figure><div class="et-style-select"><h2>Bottom Style</h2><span>'.$eTailorObjN['obottomName'].'</span></div>';
				break;
			case '8':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['ocollar']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['ocollarName']=$style_record->style_name;
				
				$data=$data.'<figure class="et-selected-img"><img src="'.$paths.'/'.$style_record->list_img.'" alt="'.$eTailorObjN['ocollarName'].'">';
				
				$collrthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$ff)->where('attri_id' , '=' , 8)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
				$data=$data.'<img src="'.$paths.'/'.$collrthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
				$collrbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$ff)->where('attri_id' , '=' , 8)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
				$data=$data.'<img src="'.$paths.'/'.$collrbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'"></figure><div class="et-style-select"><h2>Collar Style</h2><span>'.$eTailorObjN['ocollarName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
				if($eTailorObjN['ocollarStay']=="true"){$data=$data.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarStay'].',\'CollarStay\',\'8\',\'etstyle\');">';} else {$data=$data.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarStay'].',\'CollarStay\',\'8\',\'etstyle\');">';}
				$data=$data.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Stay</label></div></div></div>';
				break;
			case '9':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['ocuff']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['ocuffName']=$style_record->style_name;
				
				$data=$data.'<figure class="et-selected-img"><img src="'.$paths.'/'.$style_record->list_img.'" alt="'.$eTailorObjN['ocuffName'].'">';
				$cuffthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$ff)->where('attri_id' , '=' , 9)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
				$data=$data.'<img src="'.$paths.'/'.$cuffthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
				$cuffbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$ff)->where('attri_id' , '=' , 9)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
				$data=$data.'<img src="'.$paths.'/'.$cuffbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
                $data=$data.'</figure><div class="et-style-select"><h2>Cuff Style</h2><span>'.$eTailorObjN['ocuffName'].'</span></div>';
				break;
			case '10':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['opacket']=$ff;
				if($ff==37){
					$eTailorObjN['opacketName']="No Pocket";
				} else {
					$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
					$eTailorObjN['opacketName']=$style_record->style_name;
				}
				
				$data=$data.'<figure class="et-selected-img">';
				if($eTailorObjN['opacket']!=37) { 
					$pocktstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['opacket'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
					$data=$data.'<img src="'.$paths.'/'.$pocktstyle_record->list_img.'" alt="'.$eTailorObjN['opacketName'].'">';
					if($eTailorObjN['opacket']==42 || $eTailorObjN['opacket']==43 || $eTailorObjN['opacket']==44){
						$pocktthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['opacket'])->where('attri_id' , '=' , 10)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
						$data=$data.'<img src="'.$paths.'/'.$pocktthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
						$pocktbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['opacket'])->where('attri_id' , '=' , 10)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
						$data=$data.'<img src="'.$paths.'/'.$pocktbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
					}
				} else {
					$data=$data.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['opacketName'].'">';
				}
				$data=$data.'</figure><div class="et-style-select"><h2>Pocket Style</h2><span>'.$eTailorObjN['opacketName'].'</span>';
				
				if($eTailorObjN['opacket']!=37) { 
				$data=$data.'<div class="et-check-box"><div class="et-btn-group"><span>Number Of Pocket</span><div class="et-btn-select"><select class="selectpicker btn-primary" name="pocketstxt" id="pocketstxt" onChange="javascript:getseloptions(this.value,\'NumPocket\',\'10\',\'etstyle\');">';
				if($eTailorObjN['opacketCount']=="1"){$data=$data.'<option value="1" selected >1 Pocket</option>';} else {$data=$data.'<option value="1" >1 Pocket</option>';}
				if($eTailorObjN['opacketCount']=="2"){$data=$data.'<option value="2" selected >2 Pockets</option>'; } else { $data=$data.'<option value="2" >2 Pockets</option>';}
				$data=$data.'</select></div></div></div>';
				}
				$data=$data.'</div>';
				break;
		}
		
		/* Image Tab */
		$datatab=$datatab.'<ul><li><a href="javascript:designProcessing();"><img src="'.$p[0].'/demo/img/product/view-normal.png"></a></li>';
		if($eTailorObjN['ocollar']!=21 && $eTailorObjN['ocollar']!=22 && $eTailorObjN['ocollar']!=23 && $eTailorObjN['ocollar']!=26 && $eTailorObjN['ocollar']!=27){ $datatab=$datatab.'<li><a href="javascript:designOpenProcessing();"><img src="'.$p[0].'/demo/img/product/view-advanced.png"/></a></li>';}
		$datatab=$datatab.'</ul>';
		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', 1)->where('parent_id', '=', 2)->get();
		foreach($contrast_record as $contlst) {
			if($contlst->id == '11'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contfablst = Contrast::select('*')->where('cat_id','=',1)->get(); 
				foreach($contfablst as $cfablst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cfablst->id.'" data-title="'.$cfablst->contrsfab_name.'" title="'.$cfablst->contrsfab_name.'" onClick="javascript:getcontrast('.$cfablst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cfablst->contrsfab_img.'" alt="'.$cfablst->contrsfab_name.'"></figure>';
					if($cfablst->id==$eTailorObjN['ocontrast']) { $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';                                            
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '12') {
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contbuttlst = Button::select('*')->where('cat_id','=',1)->get(); 
				foreach($contbuttlst as $cbuttnlst){
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cbuttnlst->id.'" data-title="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')" onClick="javascript:getbutton('.$cbuttnlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cbuttnlst->button_img.'" alt="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')"></figure>';
					if($cbuttnlst->id==$eTailorObjN['obutton']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>B. Choose Your Buttonhole Thread</span></div><div class="et-contrast-list"><ul class="et-item-list">';
				
				$contthrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdlst as $cthreadlst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-thrd-'.$cthreadlst->id.'" data-title="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')" onClick="javascript:getthread('.$cthreadlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cthreadlst->thrd_img.'" alt="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')"></figure>';
					if($cthreadlst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>C. Choose Your Button Hole Style</span></div><div class="et-contrast-list">';
				
				$contthrdstyllst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdstyllst as $cthrdstyllst){
					$datacont=$datacont.'<ul class="et-item-list" id="TC'.$cthrdstyllst->id.'"';
					if($cthrdstyllst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'style="display:block;"';} else { $datacont=$datacont.'style="display:none"';} 
					$datacont=$datacont.'><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Vertical(V)" onClick="javascript:getthreadhole(\'V\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_vertical.'" alt="Vertical(V)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='V'){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Horizontal(H)" onClick="javascript:getthreadhole(\'H\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_horizontal.'" alt="Horizontal(H)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='H'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Slanted(L)" onClick="javascript:getthreadhole(\'S\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_slanted.'" alt="Slanted(L)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='S'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li></ul>';
				}
				$datacont=$datacont.'</div></div>';
			} elseif($contlst->id == '13'){ 
				$datacont=$datacont.'<div class="et-carousel" id="menu-opt-'.$contlst->id.'"><div id="et-style-item" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list"><li class="et-item" id="optionlist-'.$contlst->id.'-1" data-title="No Monogram" onClick="javascript:getmonogram(\'1\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/none/none.jpg" alt="No Monogram" title="No Monogram"></figure>';
				if($eTailorObjN['omonogram']=='1') { $datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';  
				
				$contmonogrmlst = AttributeStyle::select('*')->where('attri_id','=','13')->get(); 
				foreach($contmonogrmlst as $cmonolst){
				$cmonoimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$cmonolst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				if($cmonolst->id==46){
					foreach($cmonoimglst as $cmonols){
						$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
						if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
						$datacont=$datacont.'</figure>';
						if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
				} elseif($cmonolst->id==47) {
					if($eTailorObjN['opacket']==37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==48){
					if($eTailorObjN['opacket']!=37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==49){ 
					if($eTailorObjN['osleeve']!=3){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				}
				}
				$datacont=$datacont.'</ul></div></div></div>';
				
				if($eTailorObjN['omonogram']==46 || $eTailorObjN['omonogram']==47 || $eTailorObjN['omonogram']==48 || $eTailorObjN['omonogram']==49){
					$datacont=$datacont.'<div class="pt-pagination no-pad-left"><span>B. Enter Desire Monogram/Initials (English Script)</span></div><div class="et-contrast-list"><input type="text" name="monotext" id="monotext" maxlength="5" value="'.$eTailorObjN['omonogramText'].'" style="color:#8c7676;" onBlur="javascript:getmonotext(this.value,\'etcontrast\');"></div><div class="pt-pagination no-pad-left"><span>C. Monogram Color</span></div><div class="et-contrast-list"><ul class="et-item-list">';
					
					$monothrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
					foreach($monothrdlst as $monothrdlst){
						$datacont=$datacont.'<li class="et-item" id="optionlist-thrdcolr-'.$monothrdlst->id.'" data-title="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')" onClick="javascript:getmonotxtcolor('.$monothrdlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')"></figure>';
						if($monothrdlst->id==$eTailorObjN['omonogramColor']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
					$datacont=$datacont.'</ul></div>';
				}     
				$datacont=$datacont.'</div>';
			}
		}
		
		$datacont=$datacont.'<div class="et-progress-des et-style-bg"><div class="et-content-fab" id="miniview-etcontrast-11"><figure class="et-selected-img et-selected-con"><img src="'.$paths.'/Shirts/Fabric/C/'.$eTailorObjN['ofabric'].'.png">';
		if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObjN['ocontrast'].'.png" >';}
		if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofront']==4){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		} elseif($eTailorObjN['ofront']==5){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		}
		
		if($eTailorObjN['osleeve']!=3){
			if($eTailorObjN['ocuff']==34 || $eTailorObjN['ocuff']==35 || $eTailorObjN['ocuff']==36){
				if($eTailorObjN['ocollarCuffIn']=="true"){$datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">'; } else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			} else { 
				if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png" class="menu-l-contrast-cuff "><img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			}
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Contrast Fabric</h2><span class="highlight">Collar & Cuff</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffIn']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div></div><span class="highlight">Front Placket</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketIn']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div>';
		
		if($eTailorObjN['ofront']==5) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box Placket</label></div>';
		}
		if($eTailorObjN['oback']==8) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['obackBoxOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Box Placket</label></div>';
		}
		
		$datacont=$datacont.'</div></div></div>';
		$datacont=$datacont.'<div class="et-content-fab" id="miniview-etcontrast-12" style="display:none;" ><figure class="et-selected-img"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" alt=""><img src="'.$paths.'/Shirts/Threads/'.$eTailorObjN['obuttonHoleStyle'].'/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:18px; padding-top:20px;"><img src="'.$paths.'/Shirts/Buttons/'.$eTailorObjN['obutton'].'.png" alt="" style="padding-left:34px; padding-top:36px;"><img src="'.$paths.'/Shirts/Threads/C/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:17px; padding-top:18px;"></figure><div class="et-style-select"><h2>Contrast & Threads</h2><span class="highlight">A. Button Color :</span><p>'.$eTailorObjN['obuttonName'].' ('.$eTailorObjN['obuttonCode'].')</p><span class="highlight">B. Thread Color :</span><p>'.$eTailorObjN['obuttonHoleName'].' ('.$eTailorObjN['obuttonHoleCode'].')</p><span class="highlight">C. Button Hole Thread :</span><p>'.$eTailorObjN['obuttonHoleStyleName'].' ('.$eTailorObjN['obuttonHoleStyle'].')</p></div></div><div class="et-content-fab" id="miniview-etcontrast-13" style="display:none;" ><figure class="et-selected-img">';
		if($eTailorObjN['omonogram']==1){
			$datacont=$datacont.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['omonogramName'].'">';
		} elseif($eTailorObjN['omonogram']==46){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnWaist/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 55px 0px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==47){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnChest/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 75px 0px 35px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==48){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnPocket/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 11px;width: 100%;left: 0;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==49){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnCuff(Right)/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 55px;width: 100%;left: 0;transform: rotate(65deg);;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Monogram</h2><span class="highlight">A. Position :</span><p>'.$eTailorObjN['omonogramName'].'</p><span class="highlight">B. Enter Monogram :</span><p>'.$eTailorObjN['omonogramText'].'</p><span class="highlight">C. Monogram Color :</span><p>'.$eTailorObjN['omonogramHoleName'].' ('.$eTailorObjN['omonogramCode'].')</p></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		/* Measurment */
		$datameasure=$datameasure.'<span>SLEEVE</span>'; 
        if($eTailorObjN['osleeve']==3){
			 $measureshortsleevelst = MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',8)->get();
			 foreach($measureshortsleevelst as $mshrtslevlst){
			 $datameasure=$datameasure.'<input type="text" data-title="'.$mshrtslevlst->from_range.'-'.$mshrtslevlst->to_range.'" name="bsizeSleeve" id="bsizeSleeve" onFocus="javascript:showRanges(\''.$mshrtslevlst->bodysize_type.'\','.$mshrtslevlst->from_range.','.$mshrtslevlst->to_range.',\'shortsleeve\');" onBlur="javascript:validateField(this.id,'.$mshrtslevlst->from_range.','.$mshrtslevlst->to_range.');" value="'.$eTailorObjN['osizeSleeve'].'" >';
			 }
		}else {
            $measuresleevelst = MeasurmentVideo::select('*')->where('cat_id','=',1)->where('id','=',7)->get();
            foreach($measuresleevelst as $msleevlst){
            $datameasure=$datameasure.'<input type="text" data-title="'.$msleevlst->from_range.'-'.$msleevlst->to_range.'" name="bsizeSleeve" id="bsizeSleeve" onFocus="javascript:showRanges(\''.$msleevlst->bodysize_type.'\','.$msleevlst->from_range.','.$msleevlst->to_range.',\'sleeve\');" onBlur="javascript:validateField(this.id,'.$msleevlst->from_range.','.$msleevlst->to_range.');" value="'.$eTailorObjN['osizeSleeve'].'" >';
			}
		}
		/* Main Tab */
		$smi=1;
		$mainattrrr_record = MainAttribute::select('*')->where('cat_id', '=', 1)->where('parent_id', '=', 1)->get();
		if($eTailorObjN['osleeve']==3){foreach($mainattrrr_record as $mattrr){if($mattrr->id!=9){$datamaintab=$datamaintab.'<div id="menu-'.$mattrr->id.'" class="pt-box-square" onClick="javascript:getPgOption(this.id,\'etstyle\',\''.$mattrr->id.'\',\''.$mattrr->attribute_name.'\');"><p>2.'.$smi.'  '.$mattrr->attribute_name.'</p></div>';}$smi++;}
		} else {foreach($mainattrrr_record as $mattrr){$datamaintab=$datamaintab.'<div id="menu-'.$mattrr->id.'" class="pt-box-square" onClick="javascript:getPgOption(this.id,\'etstyle\',\''.$mattrr->id.'\',\''.$mattrr->attribute_name.'\');"><p>2.'.$smi.'  '.$mattrr->attribute_name.'</p></div>';$smi++;}
		}
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datatab,'6' => $datacont,'7' => $datameasure,'8' => $datamaintab];
		return $data;
	}
	
	public function getcontrastdetails(){
		$datacont='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['ocontrast']=$ff;
		$style_record = Contrast::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['ocontrastName']=$style_record->contrsfab_name;
		
		$datacont=$datacont.'<figure class="et-selected-img et-selected-con"><img src="'.$paths.'/Shirts/Fabric/C/'.$eTailorObjN['ofabric'].'.png">';
		if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObjN['ocontrast'].'.png" >';}
		if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofront']==4){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		} elseif($eTailorObjN['ofront']==5){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		}
		
		if($eTailorObjN['osleeve']!=3){
			if($eTailorObjN['ocuff']==34 || $eTailorObjN['ocuff']==35 || $eTailorObjN['ocuff']==36){
				if($eTailorObjN['ocollarCuffIn']=="true"){$datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">'; } else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			} else { 
				if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png" class="menu-l-contrast-cuff "><img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			}
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Contrast Fabric</h2><span class="highlight">Collar & Cuff</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffIn']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div></div><span class="highlight">Front Placket</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketIn']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div>';
		
		if($eTailorObjN['ofront']==5) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box Placket</label></div>';
		}
		if($eTailorObjN['oback']==8) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['obackBoxOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Box Placket</label></div>';
		}
		
		$datacont=$datacont.'</div></div>';
		
		$data = ['1' => $datacont,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}
	
	public function getbuttondetails(){
		$data='';
		$datastyle='';
		$datacont='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['obutton']=$ff;
		$style_record = Button::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['obuttonName']=$style_record->button_name;
		$eTailorObjN['obuttonCode']=$style_record->button_code;
		
		/* Style */
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 1)->where('parent_id', '=', 1)->get();
		foreach($mainattr_record as $mattr){
			$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
		
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get(); 
			foreach($stylelst as $styllst) {
				if($stylci==7){ $datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
			
				$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				if($styllst->id == 37) { 
					$datastyle=$datastyle.'<figure class="et-item-img"><img src="'.$paths.'/none/none.jpg" alt="'.$styllst->style_name.'"></figure>';
					if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
				} else {
					foreach($styleimglst as $ls) {
						$datastyle=$datastyle.'<figure class="et-item-img"><img src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
					
						$thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
						foreach($thrdimglst as $thrdls) { if($mattr->id!='5') { $datastyle=$datastyle.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$ls->style_name.'">';}}
						$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
						foreach($buttimglst as $buttls) { if($mattr->id!='4') { $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}}
						$datastyle=$datastyle.'</figure>';
						if($mattr->id==4) { if($styllst->id == $eTailorObjN['osleeve']) { $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==5) { if($styllst->id == $eTailorObjN['ofront']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==6) { if($styllst->id == $eTailorObjN['oback']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==7) { if($styllst->id == $eTailorObjN['obottom']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==8) { if($styllst->id == $eTailorObjN['ocollar']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==9) { if($styllst->id == $eTailorObjN['ocuff']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==10) { if($styllst->id == $eTailorObjN['opacket'] && $styllst->id != 37){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==11) { if($styllst->id == $eTailorObjN['ocontrast']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==12) { if($styllst->id == $eTailorObjN['obutton']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==13) { if($styllst->id == $eTailorObjN['omonogramColor']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					}
					}
				}
				$datastyle=$datastyle.'</li>'; 
				$stylci++;
			}
			$datastyle=$datastyle.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-left.png"></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-right.png"></span><span class="sr-only">Next</span></a></div></div>';
		}
		
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg"><div class="et-content-fab" id="miniview-etstyle-4"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['osleeveName'].'"></figure><div class="et-style-select"><h2>Sleeve</h2><span>'.$eTailorObjN['osleeveName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['oshoulder']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['oshoulder'].',\'Epaulette\',\'4\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['oshoulder'].',\'Epaulette\',\'4\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Epaulettes</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-5" style="display:none"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['ofrontName'].'"></figure><div class="et-style-select"><h2>Front Style</h2><span>'.$eTailorObjN['ofrontName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['oseams']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['oseams'].',\'Seams\',\'5\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['oseams'].',\'Seams\',\'5\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Seams</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-6" style="display:none"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['obackName'].'"></figure><div class="et-style-select"><h2>Back Style</h2><span>'.$eTailorObjN['obackName'].'</span>';
		
		if($eTailorObjN['oback']==7 || $eTailorObjN['oback']==8) {
			$datastyle=$datastyle.'<div class="et-check-box"><div class="checkbox"><label>';
			if($eTailorObjN['odart']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['odart'].',\'Darts\',\'6\',\'etstyle\');">';} else { $datastyle=$datastyle.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['odart'].',\'Darts\',\'6\',\'etstyle\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Darts</label></div></div>';
		}
		
		$datastyle=$datastyle.'</div></div><div class="et-content-fab" id="miniview-etstyle-7" style="display:none"><figure class="et-selected-img">';
		$bottomstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['obottom'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$bottomstyle_record->list_img.'" alt="'.$eTailorObjN['obottomName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Bottom Style</h2><span>'.$eTailorObjN['obottomName'].'</span></div></div><div class="et-content-fab" id="miniview-etstyle-8" style="display:none"><figure class="et-selected-img">';
		$collarstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['ocollar'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collarstyle_record->list_img.'" alt="'.$eTailorObjN['ocollarName'].'">';
		$collrthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocollar'])->where('attri_id' , '=' , 8)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collrthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
		$collrbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocollar'])->where('attri_id' , '=' , 8)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collrbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Collar Style</h2><span>'.$eTailorObjN['ocollarName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocollarStay']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarStay'].',\'CollarStay\',\'8\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarStay'].',\'CollarStay\',\'8\',\'etstyle\');">';}
		
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Stay</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-9" style="display:none"><figure class="et-selected-img">';
		$cuffstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['ocuff'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffstyle_record->list_img.'" alt="'.$eTailorObjN['ocuffName'].'">';
		$cuffthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocuff'])->where('attri_id' , '=' , 9)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
		$cuffbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocuff'])->where('attri_id' , '=' , 9)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Cuff Style</h2><span>'.$eTailorObjN['ocuffName'].'</span></div></div>';
		$datastyle=$datastyle.'<div class="et-content-fab" id="miniview-etstyle-10" style="display:none;"><figure class="et-selected-img">';
		if($eTailorObjN['opacket']!=37) { 
			$pocktstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['opacket'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
			$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktstyle_record->list_img.'" alt="'.$eTailorObjN['opacketName'].'">';
			if($eTailorObjN['opacket']==42 || $eTailorObjN['opacket']==43 || $eTailorObjN['opacket']==44){
				$pocktthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['opacket'])->where('attri_id' , '=' , 10)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
				$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
				$pocktbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['opacket'])->where('attri_id' , '=' , 10)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
				$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
			}
		} else {
			$datastyle=$datastyle.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['opacketName'].'">';
		}
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Pocket Style</h2><span>'.$eTailorObjN['opacketName'].'</span>';
		
		if($eTailorObjN['opacket']!=37) { 
			$datastyle=$datastyle.'<div class="et-check-box"><div class="et-btn-group"><span>Number Of Pocket</span><div class="et-btn-select"><select class="selectpicker btn-primary" name="pocketstxt" id="pocketstxt" onChange="javascript:getseloptions(this.value,\'NumPocket\',\'10\',\'etstyle\');">';
			if($eTailorObjN['opacketCount']=="1"){$datastyle=$datastyle.'<option value="1" selected >1 Pocket</option>';} else {$datastyle=$datastyle.'<option value="1" >1 Pocket</option>';}
			if($eTailorObjN['opacketCount']=="2"){$datastyle=$datastyle.'<option value="2" selected >2 Pockets</option>'; } else { $datastyle=$datastyle.'<option value="2" >2 Pockets</option>';}
			$datastyle=$datastyle.'</select></div></div></div>';
		}
		$datastyle=$datastyle.'</div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';

		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', 1)->where('parent_id', '=', 2)->get();
		foreach($contrast_record as $contlst) {
			if($contlst->id == '11'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contfablst = Contrast::select('*')->where('cat_id','=',1)->get(); 
				foreach($contfablst as $cfablst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cfablst->id.'" data-title="'.$cfablst->contrsfab_name.'" title="'.$cfablst->contrsfab_name.'" onClick="javascript:getcontrast('.$cfablst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cfablst->contrsfab_img.'" alt="'.$cfablst->contrsfab_name.'"></figure>';
					if($cfablst->id==$eTailorObjN['ocontrast']) { $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';                                            
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '12') {
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contbuttlst = Button::select('*')->where('cat_id','=',1)->get(); 
				foreach($contbuttlst as $cbuttnlst){
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cbuttnlst->id.'" data-title="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')" onClick="javascript:getbutton('.$cbuttnlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cbuttnlst->button_img.'" alt="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')"></figure>';
					if($cbuttnlst->id==$eTailorObjN['obutton']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>B. Choose Your Buttonhole Thread</span></div><div class="et-contrast-list"><ul class="et-item-list">';
				
				$contthrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdlst as $cthreadlst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-thrd-'.$cthreadlst->id.'" data-title="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')" onClick="javascript:getthread('.$cthreadlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cthreadlst->thrd_img.'" alt="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')"></figure>';
					if($cthreadlst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>C. Choose Your Button Hole Style</span></div><div class="et-contrast-list">';
				
				$contthrdstyllst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdstyllst as $cthrdstyllst){
					$datacont=$datacont.'<ul class="et-item-list" id="TC'.$cthrdstyllst->id.'"';
					if($cthrdstyllst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'style="display:block;"';} else { $datacont=$datacont.'style="display:none"';} 
					$datacont=$datacont.'><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Vertical(V)" onClick="javascript:getthreadhole(\'V\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_vertical.'" alt="Vertical(V)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='V'){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Horizontal(H)" onClick="javascript:getthreadhole(\'H\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_horizontal.'" alt="Horizontal(H)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='H'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Slanted(L)" onClick="javascript:getthreadhole(\'S\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_slanted.'" alt="Slanted(L)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='S'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li></ul>';
				}
				$datacont=$datacont.'</div></div>';
			} elseif($contlst->id == '13'){ 
				$datacont=$datacont.'<div class="et-carousel" id="menu-opt-'.$contlst->id.'"><div id="et-style-item" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list"><li class="et-item" id="optionlist-'.$contlst->id.'-1" data-title="No Monogram" onClick="javascript:getmonogram(\'1\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/none/none.jpg" alt="No Monogram" title="No Monogram"></figure>';
				if($eTailorObjN['omonogram']=='1') { $datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';  
				
				$contmonogrmlst = AttributeStyle::select('*')->where('attri_id','=','13')->get(); 
				foreach($contmonogrmlst as $cmonolst){
				$cmonoimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$cmonolst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				if($cmonolst->id==46){
					foreach($cmonoimglst as $cmonols){
						$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
						if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
						$datacont=$datacont.'</figure>';
						if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
				} elseif($cmonolst->id==47) {
					if($eTailorObjN['opacket']==37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==48){
					if($eTailorObjN['opacket']!=37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==49){ 
					if($eTailorObjN['osleeve']!=3){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				}
				}
				$datacont=$datacont.'</ul></div></div></div>';
				if($eTailorObjN['omonogram']==46 || $eTailorObjN['omonogram']==47 || $eTailorObjN['omonogram']==48 || $eTailorObjN['omonogram']==49){
					$datacont=$datacont.'<div class="pt-pagination no-pad-left"><span>B. Enter Desire Monogram/Initials (English Script)</span></div><div class="et-contrast-list"><input type="text" name="monotext" id="monotext" maxlength="5" value="'.$eTailorObjN['omonogramText'].'" style="color:#8c7676;" onBlur="javascript:getmonotext(this.value,\'etcontrast\');"></div><div class="pt-pagination no-pad-left"><span>C. Monogram Color</span></div><div class="et-contrast-list"><ul class="et-item-list">';
					
					$monothrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
					foreach($monothrdlst as $monothrdlst){
						$datacont=$datacont.'<li class="et-item" id="optionlist-thrdcolr-'.$monothrdlst->id.'" data-title="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')" onClick="javascript:getmonotxtcolor('.$monothrdlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')"></figure>';
						if($monothrdlst->id==$eTailorObjN['omonogramColor']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
					$datacont=$datacont.'</ul></div>';
				}     
				$datacont=$datacont.'</div>';
			}
		}
		
		$datacont=$datacont.'<div class="et-progress-des et-style-bg"><div class="et-content-fab" id="miniview-etcontrast-11"><figure class="et-selected-img et-selected-con"><img src="'.$paths.'/Shirts/Fabric/C/'.$eTailorObjN['ofabric'].'.png">';
		if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObjN['ocontrast'].'.png" >';}
		if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofront']==4){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		} elseif($eTailorObjN['ofront']==5){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		}
		
		if($eTailorObjN['osleeve']!=3){
			if($eTailorObjN['ocuff']==34 || $eTailorObjN['ocuff']==35 || $eTailorObjN['ocuff']==36){
				if($eTailorObjN['ocollarCuffIn']=="true"){$datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">'; } else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			} else { 
				if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png" class="menu-l-contrast-cuff "><img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			}
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Contrast Fabric</h2><span class="highlight">Collar & Cuff</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffIn']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div></div><span class="highlight">Front Placket</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketIn']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div>';
		
		if($eTailorObjN['ofront']==5) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box Placket</label></div>';
		}
		if($eTailorObjN['oback']==8) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['obackBoxOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Box Placket</label></div>';
		}
		
		$datacont=$datacont.'</div></div></div>';
		$datacont=$datacont.'<div class="et-content-fab" id="miniview-etcontrast-12" style="display:none;" ><figure class="et-selected-img"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" alt=""><img src="'.$paths.'/Shirts/Threads/'.$eTailorObjN['obuttonHoleStyle'].'/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:18px; padding-top:20px;"><img src="'.$paths.'/Shirts/Buttons/'.$eTailorObjN['obutton'].'.png" alt="" style="padding-left:34px; padding-top:36px;"><img src="'.$paths.'/Shirts/Threads/C/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:17px; padding-top:18px;"></figure><div class="et-style-select"><h2>Contrast & Threads</h2><span class="highlight">A. Button Color :</span><p>'.$eTailorObjN['obuttonName'].' ('.$eTailorObjN['obuttonCode'].')</p><span class="highlight">B. Thread Color :</span><p>'.$eTailorObjN['obuttonHoleName'].' ('.$eTailorObjN['obuttonHoleCode'].')</p><span class="highlight">C. Button Hole Thread :</span><p>'.$eTailorObjN['obuttonHoleStyleName'].' ('.$eTailorObjN['obuttonHoleStyle'].')</p></div></div><div class="et-content-fab" id="miniview-etcontrast-13" style="display:none;" ><figure class="et-selected-img">';
		if($eTailorObjN['omonogram']==1){
			$datacont=$datacont.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['omonogramName'].'">';
		} elseif($eTailorObjN['omonogram']==46){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnWaist/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 55px 0px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==47){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnChest/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 75px 0px 35px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==48){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnPocket/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 11px;width: 100%;left: 0;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==49){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnCuff(Right)/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 55px;width: 100%;left: 0;transform: rotate(65deg);;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Monogram</h2><span class="highlight">A. Position :</span><p>'.$eTailorObjN['omonogramName'].'</p><span class="highlight">B. Enter Monogram :</span><p>'.$eTailorObjN['omonogramText'].'</p><span class="highlight">C. Monogram Color :</span><p>'.$eTailorObjN['omonogramHoleName'].' ('.$eTailorObjN['omonogramCode'].')</p></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datastyle,'6' => $datacont];
		return $data;
	}
	
	public function getthreaddetails(){
		$data='';
		$datastyle='';
		$datacont='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['obuttonHole']=$ff;
		$style_record = Thread::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['obuttonHoleName']=$style_record->thrd_name;
		$eTailorObjN['obuttonHoleCode']=$style_record->thread_code;
		$eTailorObjN['obuttonHoleColor']=strtoupper($style_record->thread_color);
		
		/* Style */
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 1)->where('parent_id', '=', 1)->get();
		foreach($mainattr_record as $mattr){
			$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
		
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get(); 
			foreach($stylelst as $styllst) {
				if($stylci==7){ $datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
			
				$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				if($styllst->id == 37) { 
					$datastyle=$datastyle.'<figure class="et-item-img"><img src="'.$paths.'/none/none.jpg" alt="'.$styllst->style_name.'"></figure>';
					if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
				} else {
					foreach($styleimglst as $ls) {
						$datastyle=$datastyle.'<figure class="et-item-img"><img src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
					
						$thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
						foreach($thrdimglst as $thrdls) { if($mattr->id!='5') { $datastyle=$datastyle.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$ls->style_name.'">';}}
						$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
						foreach($buttimglst as $buttls) { if($mattr->id!='4') { $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}}
						$datastyle=$datastyle.'</figure>';
						if($mattr->id==4) { if($styllst->id == $eTailorObjN['osleeve']) { $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==5) { if($styllst->id == $eTailorObjN['ofront']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==6) { if($styllst->id == $eTailorObjN['oback']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==7) { if($styllst->id == $eTailorObjN['obottom']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==8) { if($styllst->id == $eTailorObjN['ocollar']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==9) { if($styllst->id == $eTailorObjN['ocuff']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==10) { if($styllst->id == $eTailorObjN['opacket'] && $styllst->id != 37){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==11) { if($styllst->id == $eTailorObjN['ocontrast']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==12) { if($styllst->id == $eTailorObjN['obutton']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==13) { if($styllst->id == $eTailorObjN['omonogramColor']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					}
					}
				}
				$datastyle=$datastyle.'</li>'; 
				$stylci++;
			}
			$datastyle=$datastyle.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-left.png"></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-right.png"></span><span class="sr-only">Next</span></a></div></div>';
		}
		
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg"><div class="et-content-fab" id="miniview-etstyle-4"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['osleeveName'].'"></figure><div class="et-style-select"><h2>Sleeve</h2><span>'.$eTailorObjN['osleeveName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['oshoulder']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['oshoulder'].',\'Epaulette\',\'4\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['oshoulder'].',\'Epaulette\',\'4\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Epaulettes</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-5" style="display:none"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['ofrontName'].'"></figure><div class="et-style-select"><h2>Front Style</h2><span>'.$eTailorObjN['ofrontName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['oseams']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['oseams'].',\'Seams\',\'5\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['oseams'].',\'Seams\',\'5\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Seams</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-6" style="display:none"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['obackName'].'"></figure><div class="et-style-select"><h2>Back Style</h2><span>'.$eTailorObjN['obackName'].'</span>';
		
		if($eTailorObjN['oback']==7 || $eTailorObjN['oback']==8) {
			$datastyle=$datastyle.'<div class="et-check-box"><div class="checkbox"><label>';
			if($eTailorObjN['odart']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['odart'].',\'Darts\',\'6\',\'etstyle\');">';} else { $datastyle=$datastyle.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['odart'].',\'Darts\',\'6\',\'etstyle\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Darts</label></div></div>';
		}
		
		$datastyle=$datastyle.'</div></div><div class="et-content-fab" id="miniview-etstyle-7" style="display:none"><figure class="et-selected-img">';
		$bottomstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['obottom'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$bottomstyle_record->list_img.'" alt="'.$eTailorObjN['obottomName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Bottom Style</h2><span>'.$eTailorObjN['obottomName'].'</span></div></div><div class="et-content-fab" id="miniview-etstyle-8" style="display:none"><figure class="et-selected-img">';
		$collarstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['ocollar'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collarstyle_record->list_img.'" alt="'.$eTailorObjN['ocollarName'].'">';
		$collrthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocollar'])->where('attri_id' , '=' , 8)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collrthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
		$collrbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocollar'])->where('attri_id' , '=' , 8)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collrbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Collar Style</h2><span>'.$eTailorObjN['ocollarName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocollarStay']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarStay'].',\'CollarStay\',\'8\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarStay'].',\'CollarStay\',\'8\',\'etstyle\');">';}
		
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Stay</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-9" style="display:none"><figure class="et-selected-img">';
		$cuffstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['ocuff'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffstyle_record->list_img.'" alt="'.$eTailorObjN['ocuffName'].'">';
		$cuffthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocuff'])->where('attri_id' , '=' , 9)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
		$cuffbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocuff'])->where('attri_id' , '=' , 9)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Cuff Style</h2><span>'.$eTailorObjN['ocuffName'].'</span></div></div>';
		$datastyle=$datastyle.'<div class="et-content-fab" id="miniview-etstyle-10" style="display:none;"><figure class="et-selected-img">';
		if($eTailorObjN['opacket']!=37) { 
			$pocktstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['opacket'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
			$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktstyle_record->list_img.'" alt="'.$eTailorObjN['opacketName'].'">';
			if($eTailorObjN['opacket']==42 || $eTailorObjN['opacket']==43 || $eTailorObjN['opacket']==44){
				$pocktthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['opacket'])->where('attri_id' , '=' , 10)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
				$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
				$pocktbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['opacket'])->where('attri_id' , '=' , 10)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
				$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
			}
		} else {
			$datastyle=$datastyle.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['opacketName'].'">';
		}
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Pocket Style</h2><span>'.$eTailorObjN['opacketName'].'</span>';
		
		if($eTailorObjN['opacket']!=37) { 
			$datastyle=$datastyle.'<div class="et-check-box"><div class="et-btn-group"><span>Number Of Pocket</span><div class="et-btn-select"><select class="selectpicker btn-primary" name="pocketstxt" id="pocketstxt" onChange="javascript:getseloptions(this.value,\'NumPocket\',\'10\',\'etstyle\');">';
			if($eTailorObjN['opacketCount']=="1"){$datastyle=$datastyle.'<option value="1" selected >1 Pocket</option>';} else {$datastyle=$datastyle.'<option value="1" >1 Pocket</option>';}
			if($eTailorObjN['opacketCount']=="2"){$datastyle=$datastyle.'<option value="2" selected >2 Pockets</option>'; } else { $datastyle=$datastyle.'<option value="2" >2 Pockets</option>';}
			$datastyle=$datastyle.'</select></div></div></div>';
		}
		$datastyle=$datastyle.'</div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';

		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', 1)->where('parent_id', '=', 2)->get();
		foreach($contrast_record as $contlst) {
			if($contlst->id == '11'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contfablst = Contrast::select('*')->where('cat_id','=',1)->get(); 
				foreach($contfablst as $cfablst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cfablst->id.'" data-title="'.$cfablst->contrsfab_name.'" title="'.$cfablst->contrsfab_name.'" onClick="javascript:getcontrast('.$cfablst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cfablst->contrsfab_img.'" alt="'.$cfablst->contrsfab_name.'"></figure>';
					if($cfablst->id==$eTailorObjN['ocontrast']) { $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';                                            
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '12') {
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contbuttlst = Button::select('*')->where('cat_id','=',1)->get(); 
				foreach($contbuttlst as $cbuttnlst){
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cbuttnlst->id.'" data-title="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')" onClick="javascript:getbutton('.$cbuttnlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cbuttnlst->button_img.'" alt="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')"></figure>';
					if($cbuttnlst->id==$eTailorObjN['obutton']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>B. Choose Your Buttonhole Thread</span></div><div class="et-contrast-list"><ul class="et-item-list">';
				
				$contthrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdlst as $cthreadlst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-thrd-'.$cthreadlst->id.'" data-title="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')" onClick="javascript:getthread('.$cthreadlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cthreadlst->thrd_img.'" alt="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')"></figure>';
					if($cthreadlst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>C. Choose Your Button Hole Style</span></div><div class="et-contrast-list">';
				
				$contthrdstyllst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdstyllst as $cthrdstyllst){
					$datacont=$datacont.'<ul class="et-item-list" id="TC'.$cthrdstyllst->id.'"';
					if($cthrdstyllst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'style="display:block;"';} else { $datacont=$datacont.'style="display:none"';} 
					$datacont=$datacont.'><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Vertical(V)" onClick="javascript:getthreadhole(\'V\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_vertical.'" alt="Vertical(V)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='V'){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Horizontal(H)" onClick="javascript:getthreadhole(\'H\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_horizontal.'" alt="Horizontal(H)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='H'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Slanted(L)" onClick="javascript:getthreadhole(\'S\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_slanted.'" alt="Slanted(L)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='S'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li></ul>';
				}
				$datacont=$datacont.'</div></div>';
			} elseif($contlst->id == '13'){ 
				$datacont=$datacont.'<div class="et-carousel" id="menu-opt-'.$contlst->id.'"><div id="et-style-item" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list"><li class="et-item" id="optionlist-'.$contlst->id.'-1" data-title="No Monogram" onClick="javascript:getmonogram(\'1\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/none/none.jpg" alt="No Monogram" title="No Monogram"></figure>';
				if($eTailorObjN['omonogram']=='1') { $datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';  
				
				$contmonogrmlst = AttributeStyle::select('*')->where('attri_id','=','13')->get(); 
				foreach($contmonogrmlst as $cmonolst){
				$cmonoimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$cmonolst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				if($cmonolst->id==46){
					foreach($cmonoimglst as $cmonols){
						$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
						if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
						$datacont=$datacont.'</figure>';
						if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
				} elseif($cmonolst->id==47) {
					if($eTailorObjN['opacket']==37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==48){
					if($eTailorObjN['opacket']!=37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==49){ 
					if($eTailorObjN['osleeve']!=3){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				}
				}
				$datacont=$datacont.'</ul></div></div></div>';
				
				if($eTailorObjN['omonogram']==46 || $eTailorObjN['omonogram']==47 || $eTailorObjN['omonogram']==48 || $eTailorObjN['omonogram']==49){
					$datacont=$datacont.'<div class="pt-pagination no-pad-left"><span>B. Enter Desire Monogram/Initials (English Script)</span></div><div class="et-contrast-list"><input type="text" name="monotext" id="monotext" maxlength="5" value="'.$eTailorObjN['omonogramText'].'" style="color:#8c7676;" onBlur="javascript:getmonotext(this.value,\'etcontrast\');"></div><div class="pt-pagination no-pad-left"><span>C. Monogram Color</span></div><div class="et-contrast-list"><ul class="et-item-list">';
					
					$monothrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
					foreach($monothrdlst as $monothrdlst){
						$datacont=$datacont.'<li class="et-item" id="optionlist-thrdcolr-'.$monothrdlst->id.'" data-title="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')" onClick="javascript:getmonotxtcolor('.$monothrdlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')"></figure>';
						if($monothrdlst->id==$eTailorObjN['omonogramColor']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
					$datacont=$datacont.'</ul></div>';
				}     
				$datacont=$datacont.'</div>';
			}
		}
		
		$datacont=$datacont.'<div class="et-progress-des et-style-bg"><div class="et-content-fab" id="miniview-etcontrast-11"><figure class="et-selected-img et-selected-con"><img src="'.$paths.'/Shirts/Fabric/C/'.$eTailorObjN['ofabric'].'.png">';
		if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObjN['ocontrast'].'.png" >';}
		if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofront']==4){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		} elseif($eTailorObjN['ofront']==5){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		}
		
		if($eTailorObjN['osleeve']!=3){
			if($eTailorObjN['ocuff']==34 || $eTailorObjN['ocuff']==35 || $eTailorObjN['ocuff']==36){
				if($eTailorObjN['ocollarCuffIn']=="true"){$datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">'; } else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			} else { 
				if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png" class="menu-l-contrast-cuff "><img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			}
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Contrast Fabric</h2><span class="highlight">Collar & Cuff</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffIn']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div></div><span class="highlight">Front Placket</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketIn']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div>';
		
		if($eTailorObjN['ofront']==5) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box Placket</label></div>';
		}
		if($eTailorObjN['oback']==8) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['obackBoxOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Box Placket</label></div>';
		}
		
		$datacont=$datacont.'</div></div></div>';
		$datacont=$datacont.'<div class="et-content-fab" id="miniview-etcontrast-12" style="display:none;" ><figure class="et-selected-img"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" alt=""><img src="'.$paths.'/Shirts/Threads/'.$eTailorObjN['obuttonHoleStyle'].'/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:18px; padding-top:20px;"><img src="'.$paths.'/Shirts/Buttons/'.$eTailorObjN['obutton'].'.png" alt="" style="padding-left:34px; padding-top:36px;"><img src="'.$paths.'/Shirts/Threads/C/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:17px; padding-top:18px;"></figure><div class="et-style-select"><h2>Contrast & Threads</h2><span class="highlight">A. Button Color :</span><p>'.$eTailorObjN['obuttonName'].' ('.$eTailorObjN['obuttonCode'].')</p><span class="highlight">B. Thread Color :</span><p>'.$eTailorObjN['obuttonHoleName'].' ('.$eTailorObjN['obuttonHoleCode'].')</p><span class="highlight">C. Button Hole Thread :</span><p>'.$eTailorObjN['obuttonHoleStyleName'].' ('.$eTailorObjN['obuttonHoleStyle'].')</p></div></div><div class="et-content-fab" id="miniview-etcontrast-13" style="display:none;" ><figure class="et-selected-img">';
		if($eTailorObjN['omonogram']==1){
			$datacont=$datacont.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['omonogramName'].'">';
		} elseif($eTailorObjN['omonogram']==46){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnWaist/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 55px 0px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==47){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnChest/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 75px 0px 35px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==48){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnPocket/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 11px;width: 100%;left: 0;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==49){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnCuff(Right)/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 55px;width: 100%;left: 0;transform: rotate(65deg);;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Monogram</h2><span class="highlight">A. Position :</span><p>'.$eTailorObjN['omonogramName'].'</p><span class="highlight">B. Enter Monogram :</span><p>'.$eTailorObjN['omonogramText'].'</p><span class="highlight">C. Monogram Color :</span><p>'.$eTailorObjN['omonogramHoleName'].' ('.$eTailorObjN['omonogramCode'].')</p></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datastyle,'6' => $datacont];
		return $data;
	}
	
	public function getthreadstyledetails(){
		$data='';
		$datastyle='';
		$datacont='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['obuttonHoleStyle']=$ff;
		if($ff=="V"){
			$eTailorObjN['obuttonHoleStyleName']="Vertical";
		} elseif($ff=="H"){
			$eTailorObjN['obuttonHoleStyleName']="Horizontal";
		} elseif($ff=="S"){
			$eTailorObjN['obuttonHoleStyleName']="Slanted";
		}
		/* Style */
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 1)->where('parent_id', '=', 1)->get();
		foreach($mainattr_record as $mattr){
			$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
		
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get(); 
			foreach($stylelst as $styllst) {
				if($stylci==7){ $datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
			
				$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				if($styllst->id == 37) { 
					$datastyle=$datastyle.'<figure class="et-item-img"><img src="'.$paths.'/none/none.jpg" alt="'.$styllst->style_name.'"></figure>';
					if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
				} else {
					foreach($styleimglst as $ls) {
						$datastyle=$datastyle.'<figure class="et-item-img"><img src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
					
						$thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
						foreach($thrdimglst as $thrdls) { if($mattr->id!='5') { $datastyle=$datastyle.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$ls->style_name.'">';}}
						$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
						foreach($buttimglst as $buttls) { if($mattr->id!='4') { $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}}
						$datastyle=$datastyle.'</figure>';
						if($mattr->id==4) { if($styllst->id == $eTailorObjN['osleeve']) { $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==5) { if($styllst->id == $eTailorObjN['ofront']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==6) { if($styllst->id == $eTailorObjN['oback']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==7) { if($styllst->id == $eTailorObjN['obottom']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==8) { if($styllst->id == $eTailorObjN['ocollar']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==9) { if($styllst->id == $eTailorObjN['ocuff']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==10) { if($styllst->id == $eTailorObjN['opacket'] && $styllst->id != 37){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==11) { if($styllst->id == $eTailorObjN['ocontrast']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==12) { if($styllst->id == $eTailorObjN['obutton']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==13) { if($styllst->id == $eTailorObjN['omonogramColor']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					}
					}
				}
				$datastyle=$datastyle.'</li>'; 
				$stylci++;
			}
			$datastyle=$datastyle.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-left.png"></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-right.png"></span><span class="sr-only">Next</span></a></div></div>';
		}
		
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg"><div class="et-content-fab" id="miniview-etstyle-4"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['osleeveName'].'"></figure><div class="et-style-select"><h2>Sleeve</h2><span>'.$eTailorObjN['osleeveName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['oshoulder']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['oshoulder'].',\'Epaulette\',\'4\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['oshoulder'].',\'Epaulette\',\'4\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Epaulettes</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-5" style="display:none"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['ofrontName'].'"></figure><div class="et-style-select"><h2>Front Style</h2><span>'.$eTailorObjN['ofrontName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['oseams']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['oseams'].',\'Seams\',\'5\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['oseams'].',\'Seams\',\'5\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Seams</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-6" style="display:none"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['obackName'].'"></figure><div class="et-style-select"><h2>Back Style</h2><span>'.$eTailorObjN['obackName'].'</span>';
		if($eTailorObjN['oback']==7 || $eTailorObjN['oback']==8) {
			$datastyle=$datastyle.'<div class="et-check-box"><div class="checkbox"><label>';
			if($eTailorObjN['odart']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['odart'].',\'Darts\',\'6\',\'etstyle\');">';} else { $datastyle=$datastyle.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['odart'].',\'Darts\',\'6\',\'etstyle\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Darts</label></div></div>';
		}
		$datastyle=$datastyle.'</div></div><div class="et-content-fab" id="miniview-etstyle-7" style="display:none"><figure class="et-selected-img">';
		$bottomstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['obottom'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$bottomstyle_record->list_img.'" alt="'.$eTailorObjN['obottomName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Bottom Style</h2><span>'.$eTailorObjN['obottomName'].'</span></div></div><div class="et-content-fab" id="miniview-etstyle-8" style="display:none"><figure class="et-selected-img">';
		$collarstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['ocollar'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collarstyle_record->list_img.'" alt="'.$eTailorObjN['ocollarName'].'">';
		$collrthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocollar'])->where('attri_id' , '=' , 8)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collrthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
		$collrbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocollar'])->where('attri_id' , '=' , 8)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collrbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Collar Style</h2><span>'.$eTailorObjN['ocollarName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocollarStay']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarStay'].',\'CollarStay\',\'8\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarStay'].',\'CollarStay\',\'8\',\'etstyle\');">';}
		
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Stay</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-9" style="display:none"><figure class="et-selected-img">';
		$cuffstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['ocuff'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffstyle_record->list_img.'" alt="'.$eTailorObjN['ocuffName'].'">';
		$cuffthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocuff'])->where('attri_id' , '=' , 9)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
		$cuffbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocuff'])->where('attri_id' , '=' , 9)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Cuff Style</h2><span>'.$eTailorObjN['ocuffName'].'</span></div></div>';
		$datastyle=$datastyle.'<div class="et-content-fab" id="miniview-etstyle-10" style="display:none;"><figure class="et-selected-img">';
		if($eTailorObjN['opacket']!=37) { 
			$pocktstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['opacket'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
			$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktstyle_record->list_img.'" alt="'.$eTailorObjN['opacketName'].'">';
			if($eTailorObjN['opacket']==42 || $eTailorObjN['opacket']==43 || $eTailorObjN['opacket']==44){
				$pocktthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['opacket'])->where('attri_id' , '=' , 10)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
				$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
				$pocktbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['opacket'])->where('attri_id' , '=' , 10)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
				$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
			}
		} else {
			$datastyle=$datastyle.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['opacketName'].'">';
		}
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Pocket Style</h2><span>'.$eTailorObjN['opacketName'].'</span>';
		
		if($eTailorObjN['opacket']!=37) { 
			$datastyle=$datastyle.'<div class="et-check-box"><div class="et-btn-group"><span>Number Of Pocket</span><div class="et-btn-select"><select class="selectpicker btn-primary" name="pocketstxt" id="pocketstxt" onChange="javascript:getseloptions(this.value,\'NumPocket\',\'10\',\'etstyle\');">';
			if($eTailorObjN['opacketCount']=="1"){$datastyle=$datastyle.'<option value="1" selected >1 Pocket</option>';} else {$datastyle=$datastyle.'<option value="1" >1 Pocket</option>';}
			if($eTailorObjN['opacketCount']=="2"){$datastyle=$datastyle.'<option value="2" selected >2 Pockets</option>'; } else { $datastyle=$datastyle.'<option value="2" >2 Pockets</option>';}
			$datastyle=$datastyle.'</select></div></div></div>';
		}
		$datastyle=$datastyle.'</div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';

		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', 1)->where('parent_id', '=', 2)->get();
		foreach($contrast_record as $contlst) {
			if($contlst->id == '11'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contfablst = Contrast::select('*')->where('cat_id','=',1)->get(); 
				foreach($contfablst as $cfablst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cfablst->id.'" data-title="'.$cfablst->contrsfab_name.'" title="'.$cfablst->contrsfab_name.'" onClick="javascript:getcontrast('.$cfablst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cfablst->contrsfab_img.'" alt="'.$cfablst->contrsfab_name.'"></figure>';
					if($cfablst->id==$eTailorObjN['ocontrast']) { $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';                                            
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '12') {
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contbuttlst = Button::select('*')->where('cat_id','=',1)->get(); 
				foreach($contbuttlst as $cbuttnlst){
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cbuttnlst->id.'" data-title="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')" onClick="javascript:getbutton('.$cbuttnlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cbuttnlst->button_img.'" alt="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')"></figure>';
					if($cbuttnlst->id==$eTailorObjN['obutton']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>B. Choose Your Buttonhole Thread</span></div><div class="et-contrast-list"><ul class="et-item-list">';
				
				$contthrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdlst as $cthreadlst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-thrd-'.$cthreadlst->id.'" data-title="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')" onClick="javascript:getthread('.$cthreadlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cthreadlst->thrd_img.'" alt="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')"></figure>';
					if($cthreadlst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>C. Choose Your Button Hole Style</span></div><div class="et-contrast-list">';
				
				$contthrdstyllst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdstyllst as $cthrdstyllst){
					$datacont=$datacont.'<ul class="et-item-list" id="TC'.$cthrdstyllst->id.'"';
					if($cthrdstyllst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'style="display:block;"';} else { $datacont=$datacont.'style="display:none"';} 
					$datacont=$datacont.'><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Vertical(V)" onClick="javascript:getthreadhole(\'V\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_vertical.'" alt="Vertical(V)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='V'){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Horizontal(H)" onClick="javascript:getthreadhole(\'H\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_horizontal.'" alt="Horizontal(H)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='H'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Slanted(L)" onClick="javascript:getthreadhole(\'S\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_slanted.'" alt="Slanted(L)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='S'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li></ul>';
				}
				$datacont=$datacont.'</div></div>';
			} elseif($contlst->id == '13'){ 
				$datacont=$datacont.'<div class="et-carousel" id="menu-opt-'.$contlst->id.'"><div id="et-style-item" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list"><li class="et-item" id="optionlist-'.$contlst->id.'-1" data-title="No Monogram" onClick="javascript:getmonogram(\'1\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/none/none.jpg" alt="No Monogram" title="No Monogram"></figure>';
				if($eTailorObjN['omonogram']=='1') { $datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';  
				
				$contmonogrmlst = AttributeStyle::select('*')->where('attri_id','=','13')->get(); 
				foreach($contmonogrmlst as $cmonolst){
				$cmonoimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$cmonolst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				if($cmonolst->id==46){
					foreach($cmonoimglst as $cmonols){
						$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
						if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
						$datacont=$datacont.'</figure>';
						if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
				} elseif($cmonolst->id==47) {
					if($eTailorObjN['opacket']==37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==48){
					if($eTailorObjN['opacket']!=37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==49){ 
					if($eTailorObjN['osleeve']!=3){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				}
				}
				$datacont=$datacont.'</ul></div></div></div>';
				if($eTailorObjN['omonogram']==46 || $eTailorObjN['omonogram']==47 || $eTailorObjN['omonogram']==48 || $eTailorObjN['omonogram']==49){
					$datacont=$datacont.'<div class="pt-pagination no-pad-left"><span>B. Enter Desire Monogram/Initials (English Script)</span></div><div class="et-contrast-list"><input type="text" name="monotext" id="monotext" maxlength="5" value="'.$eTailorObjN['omonogramText'].'" style="color:#8c7676;" onBlur="javascript:getmonotext(this.value,\'etcontrast\');"></div><div class="pt-pagination no-pad-left"><span>C. Monogram Color</span></div><div class="et-contrast-list"><ul class="et-item-list">';
					
					$monothrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
					foreach($monothrdlst as $monothrdlst){
						$datacont=$datacont.'<li class="et-item" id="optionlist-thrdcolr-'.$monothrdlst->id.'" data-title="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')" onClick="javascript:getmonotxtcolor('.$monothrdlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')"></figure>';
						if($monothrdlst->id==$eTailorObjN['omonogramColor']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
					$datacont=$datacont.'</ul></div>';
				}     
				$datacont=$datacont.'</div>';
			}
		}
		$datacont=$datacont.'<div class="et-progress-des et-style-bg"><div class="et-content-fab" id="miniview-etcontrast-11"><figure class="et-selected-img et-selected-con"><img src="'.$paths.'/Shirts/Fabric/C/'.$eTailorObjN['ofabric'].'.png">';
		if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObjN['ocontrast'].'.png" >';}
		if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofront']==4){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		} elseif($eTailorObjN['ofront']==5){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		}
		
		if($eTailorObjN['osleeve']!=3){
			if($eTailorObjN['ocuff']==34 || $eTailorObjN['ocuff']==35 || $eTailorObjN['ocuff']==36){
				if($eTailorObjN['ocollarCuffIn']=="true"){$datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">'; } else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			} else { 
				if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png" class="menu-l-contrast-cuff "><img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			}
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Contrast Fabric</h2><span class="highlight">Collar & Cuff</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffIn']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div></div><span class="highlight">Front Placket</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketIn']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div>';
		
		if($eTailorObjN['ofront']==5) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box Placket</label></div>';
		}
		if($eTailorObjN['oback']==8) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['obackBoxOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Box Placket</label></div>';
		}
		
		$datacont=$datacont.'</div></div></div>';
		$datacont=$datacont.'<div class="et-content-fab" id="miniview-etcontrast-12" style="display:none;" ><figure class="et-selected-img"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" alt=""><img src="'.$paths.'/Shirts/Threads/'.$eTailorObjN['obuttonHoleStyle'].'/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:18px; padding-top:20px;"><img src="'.$paths.'/Shirts/Buttons/'.$eTailorObjN['obutton'].'.png" alt="" style="padding-left:34px; padding-top:36px;"><img src="'.$paths.'/Shirts/Threads/C/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:17px; padding-top:18px;"></figure><div class="et-style-select"><h2>Contrast & Threads</h2><span class="highlight">A. Button Color :</span><p>'.$eTailorObjN['obuttonName'].' ('.$eTailorObjN['obuttonCode'].')</p><span class="highlight">B. Thread Color :</span><p>'.$eTailorObjN['obuttonHoleName'].' ('.$eTailorObjN['obuttonHoleCode'].')</p><span class="highlight">C. Button Hole Thread :</span><p>'.$eTailorObjN['obuttonHoleStyleName'].' ('.$eTailorObjN['obuttonHoleStyle'].')</p></div></div><div class="et-content-fab" id="miniview-etcontrast-13" style="display:none;" ><figure class="et-selected-img">';
		if($eTailorObjN['omonogram']==1){
			$datacont=$datacont.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['omonogramName'].'">';
		} elseif($eTailorObjN['omonogram']==46){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnWaist/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 55px 0px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==47){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnChest/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 75px 0px 35px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==48){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnPocket/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 11px;width: 100%;left: 0;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==49){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnCuff(Right)/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 55px;width: 100%;left: 0;transform: rotate(65deg);;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Monogram</h2><span class="highlight">A. Position :</span><p>'.$eTailorObjN['omonogramName'].'</p><span class="highlight">B. Enter Monogram :</span><p>'.$eTailorObjN['omonogramText'].'</p><span class="highlight">C. Monogram Color :</span><p>'.$eTailorObjN['omonogramHoleName'].' ('.$eTailorObjN['omonogramCode'].')</p></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datastyle,'6' => $datacont];
		return $data;
	}
	
	public function getmonogramdetails(){
		$datacont='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['omonogram']=$ff;
		if($ff=="1"){
			$eTailorObjN['omonogramName']="No Monogram";
		} else{
			$style_record = AttributeStyle::select('*')->where('id', '=', $ff)->find($ff);
			$eTailorObjN['omonogramName']=$style_record->style_name;
		}
		
		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', 1)->where('parent_id', '=', 2)->get();
		foreach($contrast_record as $contlst) {
			if($contlst->id == '11'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contfablst = Contrast::select('*')->where('cat_id','=',1)->get(); 
				foreach($contfablst as $cfablst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cfablst->id.'" data-title="'.$cfablst->contrsfab_name.'" title="'.$cfablst->contrsfab_name.'" onClick="javascript:getcontrast('.$cfablst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cfablst->contrsfab_img.'" alt="'.$cfablst->contrsfab_name.'"></figure>';
					if($cfablst->id==$eTailorObjN['ocontrast']) { $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';                                            
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '12') {
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contbuttlst = Button::select('*')->where('cat_id','=',1)->get(); 
				foreach($contbuttlst as $cbuttnlst){
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cbuttnlst->id.'" data-title="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')" onClick="javascript:getbutton('.$cbuttnlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cbuttnlst->button_img.'" alt="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')"></figure>';
					if($cbuttnlst->id==$eTailorObjN['obutton']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>B. Choose Your Buttonhole Thread</span></div><div class="et-contrast-list"><ul class="et-item-list">';
				
				$contthrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdlst as $cthreadlst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-thrd-'.$cthreadlst->id.'" data-title="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')" onClick="javascript:getthread('.$cthreadlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cthreadlst->thrd_img.'" alt="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')"></figure>';
					if($cthreadlst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>C. Choose Your Button Hole Style</span></div><div class="et-contrast-list">';
				
				$contthrdstyllst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdstyllst as $cthrdstyllst){
					$datacont=$datacont.'<ul class="et-item-list" id="TC'.$cthrdstyllst->id.'"';
					if($cthrdstyllst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'style="display:block;"';} else { $datacont=$datacont.'style="display:none"';} 
					$datacont=$datacont.'><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Vertical(V)" onClick="javascript:getthreadhole(\'V\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_vertical.'" alt="Vertical(V)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='V'){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Horizontal(H)" onClick="javascript:getthreadhole(\'H\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_horizontal.'" alt="Horizontal(H)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='H'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Slanted(L)" onClick="javascript:getthreadhole(\'S\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_slanted.'" alt="Slanted(L)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='S'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li></ul>';
				}
				$datacont=$datacont.'</div></div>';
			} elseif($contlst->id == '13'){ 
				$datacont=$datacont.'<div class="et-carousel" id="menu-opt-'.$contlst->id.'"><div id="et-style-item" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list"><li class="et-item" id="optionlist-'.$contlst->id.'-1" data-title="No Monogram" onClick="javascript:getmonogram(\'1\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/none/none.jpg" alt="No Monogram" title="No Monogram"></figure>';
				if($eTailorObjN['omonogram']=='1') { $datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';  
				
				$contmonogrmlst = AttributeStyle::select('*')->where('attri_id','=','13')->get(); 
				foreach($contmonogrmlst as $cmonolst){
				$cmonoimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$cmonolst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				if($cmonolst->id==46){
					foreach($cmonoimglst as $cmonols){
						$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
						if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
						$datacont=$datacont.'</figure>';
						if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
				} elseif($cmonolst->id==47) {
					if($eTailorObjN['opacket']==37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==48){
					if($eTailorObjN['opacket']!=37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==49){ 
					if($eTailorObjN['osleeve']!=3){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				}
				}
				$datacont=$datacont.'</ul></div></div></div>';
				if($eTailorObjN['omonogram']==46 || $eTailorObjN['omonogram']==47 || $eTailorObjN['omonogram']==48 || $eTailorObjN['omonogram']==49){
					$datacont=$datacont.'<div class="pt-pagination no-pad-left"><span>B. Enter Desire Monogram/Initials (English Script)</span></div><div class="et-contrast-list"><input type="text" name="monotext" id="monotext" maxlength="5" value="'.$eTailorObjN['omonogramText'].'" style="color:#8c7676;" onBlur="javascript:getmonotext(this.value,\'etcontrast\');"></div><div class="pt-pagination no-pad-left"><span>C. Monogram Color</span></div><div class="et-contrast-list"><ul class="et-item-list">';
					
					$monothrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
					foreach($monothrdlst as $monothrdlst){
						$datacont=$datacont.'<li class="et-item" id="optionlist-thrdcolr-'.$monothrdlst->id.'" data-title="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')" onClick="javascript:getmonotxtcolor('.$monothrdlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')"></figure>';
						if($monothrdlst->id==$eTailorObjN['omonogramColor']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
					$datacont=$datacont.'</ul></div>';
				}     
				$datacont=$datacont.'</div>';
			}
		}
		$datacont=$datacont.'<div class="et-progress-des et-style-bg"><div class="et-content-fab" id="miniview-etcontrast-11"><figure class="et-selected-img et-selected-con"><img src="'.$paths.'/Shirts/Fabric/C/'.$eTailorObjN['ofabric'].'.png">';
		if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObjN['ocontrast'].'.png" >';}
		if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofront']==4){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		} elseif($eTailorObjN['ofront']==5){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		}
		
		if($eTailorObjN['osleeve']!=3){
			if($eTailorObjN['ocuff']==34 || $eTailorObjN['ocuff']==35 || $eTailorObjN['ocuff']==36){
				if($eTailorObjN['ocollarCuffIn']=="true"){$datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">'; } else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			} else { 
				if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png" class="menu-l-contrast-cuff "><img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			}
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Contrast Fabric</h2><span class="highlight">Collar & Cuff</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffIn']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div></div><span class="highlight">Front Placket</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketIn']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div>';
		
		if($eTailorObjN['ofront']==5) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box Placket</label></div>';
		}
		if($eTailorObjN['oback']==8) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['obackBoxOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Box Placket</label></div>';
		}
		
		$datacont=$datacont.'</div></div></div>';
		$datacont=$datacont.'<div class="et-content-fab" id="miniview-etcontrast-12" style="display:none;" ><figure class="et-selected-img"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" alt=""><img src="'.$paths.'/Shirts/Threads/'.$eTailorObjN['obuttonHoleStyle'].'/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:18px; padding-top:20px;"><img src="'.$paths.'/Shirts/Buttons/'.$eTailorObjN['obutton'].'.png" alt="" style="padding-left:34px; padding-top:36px;"><img src="'.$paths.'/Shirts/Threads/C/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:17px; padding-top:18px;"></figure><div class="et-style-select"><h2>Contrast & Threads</h2><span class="highlight">A. Button Color :</span><p>'.$eTailorObjN['obuttonName'].' ('.$eTailorObjN['obuttonCode'].')</p><span class="highlight">B. Thread Color :</span><p>'.$eTailorObjN['obuttonHoleName'].' ('.$eTailorObjN['obuttonHoleCode'].')</p><span class="highlight">C. Button Hole Thread :</span><p>'.$eTailorObjN['obuttonHoleStyleName'].' ('.$eTailorObjN['obuttonHoleStyle'].')</p></div></div><div class="et-content-fab" id="miniview-etcontrast-13" style="display:none;" ><figure class="et-selected-img">';
		if($eTailorObjN['omonogram']==1){
			$datacont=$datacont.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['omonogramName'].'">';
		} elseif($eTailorObjN['omonogram']==46){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnWaist/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 55px 0px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==47){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnChest/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 75px 0px 35px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==48){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnPocket/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 11px;width: 100%;left: 0;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==49){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnCuff(Right)/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 55px;width: 100%;left: 0;transform: rotate(65deg);;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Monogram</h2><span class="highlight">A. Position :</span><p>'.$eTailorObjN['omonogramName'].'</p><span class="highlight">B. Enter Monogram :</span><p>'.$eTailorObjN['omonogramText'].'</p><span class="highlight">C. Monogram Color :</span><p>'.$eTailorObjN['omonogramHoleName'].' ('.$eTailorObjN['omonogramCode'].')</p></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $datacont,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}
	
	public function getmonotextdetails(){
		$datacont='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['omonogramText']=trim($ff);
		
		$datacont=$datacont.'<figure class="et-selected-img">';
		if($eTailorObjN['omonogram']==1){
			$datacont=$datacont.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['omonogramName'].'">';
		} elseif($eTailorObjN['omonogram']==46){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnWaist/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 55px 0px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==47){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnChest/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 75px 0px 35px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==48){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnPocket/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 11px;width: 100%;left: 0;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==49){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnCuff(Right)/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 55px;width: 100%;left: 0;transform: rotate(65deg);;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Monogram</h2><span class="highlight">A. Position :</span><p>'.$eTailorObjN['omonogramName'].'</p><span class="highlight">B. Enter Monogram :</span><p>'.$eTailorObjN['omonogramText'].'</p><span class="highlight">C. Monogram Color :</span><p>'.$eTailorObjN['omonogramHoleName'].' ('.$eTailorObjN['omonogramCode'].')</p></div>';
		
		$data = ['1' => $datacont,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}
	
	public function getmonotextcolrdetails(){
		$datacont='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		$eTailorObjN['omonogramColor']=$ff;
		$style_record = Thread::select('*')->where('id', '=', $ff)->find($ff);
		$eTailorObjN['omonogramHoleName']=$style_record->thrd_name;
		$eTailorObjN['omonogramCode']=$style_record->thread_code;
		$eTailorObjN['omonogramtextColor']=strtoupper($style_record->thread_color);
		
		$datacont=$datacont.'<figure class="et-selected-img">';
		if($eTailorObjN['omonogram']==1){
			$datacont=$datacont.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['omonogramName'].'">';
		} elseif($eTailorObjN['omonogram']==46){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnWaist/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 55px 0px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==47){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnChest/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 75px 0px 35px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==48){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnPocket/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 11px;width: 100%;left: 0;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==49){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnCuff(Right)/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 55px;width: 100%;left: 0;transform: rotate(65deg);;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Monogram</h2><span class="highlight">A. Position :</span><p>'.$eTailorObjN['omonogramName'].'</p><span class="highlight">B. Enter Monogram :</span><p>'.$eTailorObjN['omonogramText'].'</p><span class="highlight">C. Monogram Color :</span><p>'.$eTailorObjN['omonogramHoleName'].' ('.$eTailorObjN['omonogramCode'].')</p></div>';
		
		$data = ['1' => $datacont,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN];
		return $data;
	}
	
	public function getshirtoptiondetails(){
		$data='';
		$datastyle='';
		$datacont='';
		$carray=$_POST['carr'];
		$ff=$_POST['fabid'];
		$attrbid=$_POST['typ'];
		$options=$_POST['opttyp'];
		
		$paths=$_POST['rurl'];
		$p=explode('/',$paths);
		$eTailorObjN=$carray;
		
		switch($options){
			case "Epaulette":
				if($ff=="true"){ $eTailorObjN['oshoulder']="false"; } else { $eTailorObjN['oshoulder']="true"; }
				break;
			case "Seams":
				if($ff=="true"){ $eTailorObjN['oseams']="false"; } else { $eTailorObjN['oseams']="true"; }
				break;
			case "Darts":
				if($ff=="true"){ $eTailorObjN['odart']="false"; } else { $eTailorObjN['odart']="true"; }
				break;
			case "CollarStay":
				if($ff=="true"){ $eTailorObjN['ocollarStay']="false"; } else { $eTailorObjN['ocollarStay']="true"; }
				break;
			case "CollarCuffIn":
				if($ff=="true"){ $eTailorObjN['ocollarCuffIn']="false"; } else { $eTailorObjN['ocollarCuffIn']="true"; }
				break;
			case "CollarCuffOut":
				if($ff=="true"){ $eTailorObjN['ocollarCuffout']="false"; } else { $eTailorObjN['ocollarCuffout']="true"; }
				break;
			case "FrontPlacketIn":
				if($ff=="true"){ $eTailorObjN['ofrontPlacketIn']="false"; } else { $eTailorObjN['ofrontPlacketIn']="true"; }
				break;
			case "FrontPlacketOut":
				if($ff=="true"){ $eTailorObjN['ofrontPlacketOut']="false"; } else { $eTailorObjN['ofrontPlacketOut']="true"; }
				break;
			case "FrontBoxOut":
				if($ff=="true"){ $eTailorObjN['ofrontBoxOut']="false"; } else { $eTailorObjN['ofrontBoxOut']="true"; }
				break;
			case "BackBoxOut":
				if($ff=="true"){ $eTailorObjN['obackBoxOut']="false"; } else { $eTailorObjN['obackBoxOut']="true"; }
				break;
			case "NumPocket":
				$eTailorObjN['opacketCount']=$ff;
				break;
		}
		
		/* Style */
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', 1)->where('parent_id', '=', 1)->get();
		foreach($mainattr_record as $mattr){
			$datastyle=$datastyle.'<div class="et-carousel" id="menu-opt-'.$mattr->id.'"><div id="et-style-item-'.$mattr->id.'" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list">';
		
			$stylci=1; $stylelst = AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get(); 
			foreach($stylelst as $styllst) {
				if($stylci==7){ $datastyle=$datastyle.'</ul></div><div class="item"><ul class="et-item-list">'; $stylci=1;}
				$datastyle=$datastyle.'<li class="et-item" id="optionlist-'.$mattr->id.'-'.$styllst->id.'" data-title="'.$styllst->style_name.'" title="'.$styllst->style_name.'" onClick="javascript:getstyles('.$styllst->id.',\''.$mattr->id.'\',\'etstyle\');">';
			
				$styleimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				if($styllst->id == 37) { 
					$datastyle=$datastyle.'<figure class="et-item-img"><img src="'.$paths.'/none/none.jpg" alt="'.$styllst->style_name.'"></figure>';
					if($styllst->id == $eTailorObjN['opacket']){$datastyle=$datastyle.'<div class="icon-check"></div>';}
				} else {
					foreach($styleimglst as $ls) {
						$datastyle=$datastyle.'<figure class="et-item-img"><img src="'.$paths.'/'.$ls->list_img.'" alt="'.$ls->style_name.'">';
					
						$thrdimglst = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->get();
						foreach($thrdimglst as $thrdls) { if($mattr->id!='5') { $datastyle=$datastyle.'<img src="'.$paths.'/'.$thrdls->thrd_list_img.'" alt="'.$ls->style_name.'">';}}
						$buttimglst = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObjN['obutton'])->get();
						foreach($buttimglst as $buttls) { if($mattr->id!='4') { $datastyle=$datastyle.'<img src="'.$paths.'/'.$buttls->button_list_img.'" alt="'.$ls->style_name.'">';}}
						$datastyle=$datastyle.'</figure>';
						if($mattr->id==4) { if($styllst->id == $eTailorObjN['osleeve']) { $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==5) { if($styllst->id == $eTailorObjN['ofront']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==6) { if($styllst->id == $eTailorObjN['oback']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==7) { if($styllst->id == $eTailorObjN['obottom']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==8) { if($styllst->id == $eTailorObjN['ocollar']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==9) { if($styllst->id == $eTailorObjN['ocuff']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==10) { if($styllst->id == $eTailorObjN['opacket'] && $styllst->id != 37){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==11) { if($styllst->id == $eTailorObjN['ocontrast']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==12) { if($styllst->id == $eTailorObjN['obutton']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					} elseif($mattr->id==13) { if($styllst->id == $eTailorObjN['omonogramColor']){ $datastyle=$datastyle.'<div class="icon-check"></div>';}
					}
					}
				}
				$datastyle=$datastyle.'</li>'; 
				$stylci++;
			}
			$datastyle=$datastyle.'</ul></div></div><a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-left.png"></span><span class="sr-only">Previous</span></a><a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-'.$mattr->id.'" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="'.$p[0].'/demo/img/ar-right.png"></span><span class="sr-only">Next</span></a></div></div>';
		}
		
		$datastyle=$datastyle.'<div class="et-progress-des et-style-bg"><div class="et-content-fab" id="miniview-etstyle-4"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['osleeveName'].'"></figure><div class="et-style-select"><h2>Sleeve</h2><span>'.$eTailorObjN['osleeveName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['oshoulder']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['oshoulder'].',\'Epaulette\',\'4\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="epaulettetxt" id="epaulettetxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['oshoulder'].',\'Epaulette\',\'4\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Epaulettes</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-5" style="display:none"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['ofrontName'].'"></figure><div class="et-style-select"><h2>Front Style</h2><span>'.$eTailorObjN['ofrontName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['oseams']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['oseams'].',\'Seams\',\'5\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="seamstxt" id="seamstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['oseams'].',\'Seams\',\'5\',\'etstyle\');">';}
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Seams</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-6" style="display:none"><figure class="et-selected-img et-selected-full"><img src="" alt="'.$eTailorObjN['obackName'].'"></figure><div class="et-style-select"><h2>Back Style</h2><span>'.$eTailorObjN['obackName'].'</span>';
		if($eTailorObjN['oback']==7 || $eTailorObjN['oback']==8) {
			$datastyle=$datastyle.'<div class="et-check-box"><div class="checkbox"><label>';
			if($eTailorObjN['odart']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['odart'].',\'Darts\',\'6\',\'etstyle\');">';} else { $datastyle=$datastyle.'<input type="checkbox" name="dartstxt" id="dartstxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['odart'].',\'Darts\',\'6\',\'etstyle\');">';}
			$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Darts</label></div></div>';
		}
		$datastyle=$datastyle.'</div></div><div class="et-content-fab" id="miniview-etstyle-7" style="display:none"><figure class="et-selected-img">';
		$bottomstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['obottom'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$bottomstyle_record->list_img.'" alt="'.$eTailorObjN['obottomName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Bottom Style</h2><span>'.$eTailorObjN['obottomName'].'</span></div></div><div class="et-content-fab" id="miniview-etstyle-8" style="display:none"><figure class="et-selected-img">';
		$collarstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['ocollar'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collarstyle_record->list_img.'" alt="'.$eTailorObjN['ocollarName'].'">';
		$collrthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocollar'])->where('attri_id' , '=' , 8)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collrthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
		$collrbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocollar'])->where('attri_id' , '=' , 8)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$collrbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Collar Style</h2><span>'.$eTailorObjN['ocollarName'].'</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocollarStay']=="true"){ $datastyle=$datastyle.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarStay'].',\'CollarStay\',\'8\',\'etstyle\');">'; } else { $datastyle=$datastyle.'<input type="checkbox" name="collarstaytxt" id="collarstaytxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarStay'].',\'CollarStay\',\'8\',\'etstyle\');">';}
		
		$datastyle=$datastyle.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Collar Stay</label></div></div></div></div><div class="et-content-fab" id="miniview-etstyle-9" style="display:none"><figure class="et-selected-img">';
		$cuffstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['ocuff'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffstyle_record->list_img.'" alt="'.$eTailorObjN['ocuffName'].'">';
		$cuffthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocuff'])->where('attri_id' , '=' , 9)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
		$cuffbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['ocuff'])->where('attri_id' , '=' , 9)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
		$datastyle=$datastyle.'<img src="'.$paths.'/'.$cuffbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
		
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Cuff Style</h2><span>'.$eTailorObjN['ocuffName'].'</span></div></div>';
		$datastyle=$datastyle.'<div class="et-content-fab" id="miniview-etstyle-10" style="display:none;"><figure class="et-selected-img">';
		if($eTailorObjN['opacket']!=37) { 
			$pocktstyle_record = Stylefabimglist::select('*')->where('style_id', '=', $eTailorObjN['opacket'])->where('fab_id', '=', $eTailorObjN['ofabric'])->first();
			$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktstyle_record->list_img.'" alt="'.$eTailorObjN['opacketName'].'">';
			if($eTailorObjN['opacket']==42 || $eTailorObjN['opacket']==43 || $eTailorObjN['opacket']==44){
				$pocktthread = ThreadStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['opacket'])->where('attri_id' , '=' , 10)->where('thrd_id' , '=' , $eTailorObjN['obuttonHole'])->first();
				$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktthread->thrd_list_img.'" alt="'.$eTailorObjN['obuttonHoleName'].'">';
				$pocktbttn = ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$eTailorObjN['opacket'])->where('attri_id' , '=' , 10)->where('but_id' , '=' , $eTailorObjN['obutton'])->first();
				$datastyle=$datastyle.'<img src="'.$paths.'/'.$pocktbttn->button_list_img.'" alt="'.$eTailorObjN['obuttonName'].'">';
			}
		} else {
			$datastyle=$datastyle.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['opacketName'].'">';
		}
		$datastyle=$datastyle.'</figure><div class="et-style-select"><h2>Pocket Style</h2><span>'.$eTailorObjN['opacketName'].'</span>';
		
		if($eTailorObjN['opacket']!=37) { 
			$datastyle=$datastyle.'<div class="et-check-box"><div class="et-btn-group"><span>Number Of Pocket</span><div class="et-btn-select"><select class="selectpicker btn-primary" name="pocketstxt" id="pocketstxt" onChange="javascript:getseloptions(this.value,\'NumPocket\',\'10\',\'etstyle\');">';
			if($eTailorObjN['opacketCount']=="1"){$datastyle=$datastyle.'<option value="1" selected >1 Pocket</option>';} else {$datastyle=$datastyle.'<option value="1" >1 Pocket</option>';}
			if($eTailorObjN['opacketCount']=="2"){$datastyle=$datastyle.'<option value="2" selected >2 Pockets</option>'; } else { $datastyle=$datastyle.'<option value="2" >2 Pockets</option>';}
			$datastyle=$datastyle.'</select></div></div></div>';
		}
		$datastyle=$datastyle.'</div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';

		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', 1)->where('parent_id', '=', 2)->get();
		foreach($contrast_record as $contlst) {
			if($contlst->id == '11'){
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contfablst = Contrast::select('*')->where('cat_id','=',1)->get(); 
				foreach($contfablst as $cfablst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cfablst->id.'" data-title="'.$cfablst->contrsfab_name.'" title="'.$cfablst->contrsfab_name.'" onClick="javascript:getcontrast('.$cfablst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cfablst->contrsfab_img.'" alt="'.$cfablst->contrsfab_name.'"></figure>';
					if($cfablst->id==$eTailorObjN['ocontrast']) { $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';                                            
				}
				$datacont=$datacont.'</ul></div></div>';
			} elseif($contlst->id == '12') {
				$datacont=$datacont.'<div class="et-sm-carousel" id="menu-opt-'.$contlst->id.'" style="display:none"><div class="et-contrast-list"><ul class="et-item-list">';
				$contbuttlst = Button::select('*')->where('cat_id','=',1)->get(); 
				foreach($contbuttlst as $cbuttnlst){
					$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cbuttnlst->id.'" data-title="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')" onClick="javascript:getbutton('.$cbuttnlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cbuttnlst->button_img.'" alt="'.$cbuttnlst->button_name.'('.$cbuttnlst->button_code.')"></figure>';
					if($cbuttnlst->id==$eTailorObjN['obutton']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>B. Choose Your Buttonhole Thread</span></div><div class="et-contrast-list"><ul class="et-item-list">';
				
				$contthrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdlst as $cthreadlst) {
					$datacont=$datacont.'<li class="et-item" id="optionlist-thrd-'.$cthreadlst->id.'" data-title="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')" onClick="javascript:getthread('.$cthreadlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cthreadlst->thrd_img.'" alt="'.$cthreadlst->thrd_name.'('.$cthreadlst->thread_code.')"></figure>';
					if($cthreadlst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li>';
				}
				$datacont=$datacont.'</ul></div><div class="pt-pagination no-pad-left"><span>C. Choose Your Button Hole Style</span></div><div class="et-contrast-list">';
				
				$contthrdstyllst = Thread::select('*')->where('cat_id','=',1)->get(); 
				foreach($contthrdstyllst as $cthrdstyllst){
					$datacont=$datacont.'<ul class="et-item-list" id="TC'.$cthrdstyllst->id.'"';
					if($cthrdstyllst->id==$eTailorObjN['obuttonHole']){ $datacont=$datacont.'style="display:block;"';} else { $datacont=$datacont.'style="display:none"';} 
					$datacont=$datacont.'><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Vertical(V)" onClick="javascript:getthreadhole(\'V\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_vertical.'" alt="Vertical(V)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='V'){ $datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Horizontal(H)" onClick="javascript:getthreadhole(\'H\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_horizontal.'" alt="Horizontal(H)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='H'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li><li class="et-item" id="optionlist-thrdstyl-'.$cthrdstyllst->id.'" data-title="Slanted(L)" onClick="javascript:getthreadhole(\'S\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.'Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" ><img src="'.$paths.'/'.$cthrdstyllst->thrd_hole_slanted.'" alt="Slanted(L)"></figure>';
					if($eTailorObjN['obuttonHoleStyle']=='S'){$datacont=$datacont.'<div class="icon-check"></div>';}
					$datacont=$datacont.'</li></ul>';
				}
				$datacont=$datacont.'</div></div>';
			} elseif($contlst->id == '13'){ 
				$datacont=$datacont.'<div class="et-carousel" id="menu-opt-'.$contlst->id.'"><div id="et-style-item" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false"><div class="carousel-inner" role="listbox"><div class="item active"><ul class="et-item-list"><li class="et-item" id="optionlist-'.$contlst->id.'-1" data-title="No Monogram" onClick="javascript:getmonogram(\'1\',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/none/none.jpg" alt="No Monogram" title="No Monogram"></figure>';
				if($eTailorObjN['omonogram']=='1') { $datacont=$datacont.'<div class="icon-check"></div>';}
				$datacont=$datacont.'</li>';  
				
				$contmonogrmlst = AttributeStyle::select('*')->where('attri_id','=','13')->get(); 
				foreach($contmonogrmlst as $cmonolst){
				$cmonoimglst = Stylefabimglist::select('*')->where('style_id' ,'=' ,$cmonolst->id)->where('fab_id' , '=' , $eTailorObjN['ofabric'])->get();
				if($cmonolst->id==46){
					foreach($cmonoimglst as $cmonols){
						$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
						if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
						$datacont=$datacont.'</figure>';
						if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
				} elseif($cmonolst->id==47) {
					if($eTailorObjN['opacket']==37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==48){
					if($eTailorObjN['opacket']!=37){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				} elseif($cmonolst->id==49){ 
					if($eTailorObjN['osleeve']!=3){
						foreach($cmonoimglst as $cmonols){
							$datacont=$datacont.'<li class="et-item" id="optionlist-'.$contlst->id.'-'.$cmonolst->id.'" data-title="'.$cmonolst->style_name.'" onClick="javascript:getmonogram('.$cmonolst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$cmonols->list_img.'" alt="'.$cmonolst->style_name.'" title="'.$cmonolst->style_name.'">';
							if($cmonolst->id==46){ $datacont=$datacont.'<img src="'.$paths.'/none/Waist.png">';} elseif($cmonolst->id==47){ $datacont=$datacont.'<img src="'.$paths.'/none/Chest.png">';} elseif($cmonolst->id==48){ $datacont=$datacont.'<img src="'.$paths.'/none/Pocket.png">';} elseif($cmonolst->id==49){ $datacont=$datacont.'<img src="'.$paths.'/none/Cuff.png">';}
							$datacont=$datacont.'</figure>';
							if($cmonolst->id==$eTailorObjN['omonogram']){ $datacont=$datacont.'<div class="icon-check"></div>';}
							$datacont=$datacont.'</li>';
						}
					}
				}
				}
				$datacont=$datacont.'</ul></div></div></div>';
				if($eTailorObjN['omonogram']==46 || $eTailorObjN['omonogram']==47 || $eTailorObjN['omonogram']==48 || $eTailorObjN['omonogram']==49){
					$datacont=$datacont.'<div class="pt-pagination no-pad-left"><span>B. Enter Desire Monogram/Initials (English Script)</span></div><div class="et-contrast-list"><input type="text" name="monotext" id="monotext" maxlength="5" value="'.$eTailorObjN['omonogramText'].'" style="color:#8c7676;" onBlur="javascript:getmonotext(this.value,\'etcontrast\');"></div><div class="pt-pagination no-pad-left"><span>C. Monogram Color</span></div><div class="et-contrast-list"><ul class="et-item-list">';
					
					$monothrdlst = Thread::select('*')->where('cat_id','=',1)->get(); 
					foreach($monothrdlst as $monothrdlst){
						$datacont=$datacont.'<li class="et-item" id="optionlist-thrdcolr-'.$monothrdlst->id.'" data-title="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')" onClick="javascript:getmonotxtcolor('.$monothrdlst->id.',\'etcontrast\');"><figure class="et-item-img"><img src="'.$paths.'/'.$monothrdlst->thrd_img.'" alt="'.$monothrdlst->thrd_name.'('.$monothrdlst->thread_code.')"></figure>';
						if($monothrdlst->id==$eTailorObjN['omonogramColor']){ $datacont=$datacont.'<div class="icon-check"></div>';}
						$datacont=$datacont.'</li>';
					}
					$datacont=$datacont.'</ul></div>';
				}     
				$datacont=$datacont.'</div>';
			}
		}
		$datacont=$datacont.'<div class="et-progress-des et-style-bg"><div class="et-content-fab" id="miniview-etcontrast-11"><figure class="et-selected-img et-selected-con"><img src="'.$paths.'/Shirts/Fabric/C/'.$eTailorObjN['ofabric'].'.png">';
		if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftCollerIn/'.$eTailorObjN['ocontrast'].'.png" >';}
		if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftOutColler/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketIn']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontIn/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontPlacketOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftFrontOut/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/LeftBoxPlacket/'.$eTailorObjN['ocontrast'].'.png">';}
		if($eTailorObjN['ofront']==4){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/SinglePlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		} elseif($eTailorObjN['ofront']==5){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png"><img src="'.$paths.'/Shirts/Style/Front/BoxPlacket/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png">';
		}
		
		if($eTailorObjN['osleeve']!=3){
			if($eTailorObjN['ocuff']==34 || $eTailorObjN['ocuff']==35 || $eTailorObjN['ocuff']==36){
				if($eTailorObjN['ocollarCuffIn']=="true"){$datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">'; } else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/CuffFrenchOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/FrenchRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			} else { 
				if($eTailorObjN['ocollarCuffIn']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffIn/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Inner/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				if($eTailorObjN['ocollarCuffout']=="true") { $datacont=$datacont.'<img src="'.$paths.'/Shirts/FabricContrasts/Mix/RoundCuffOut/'.$eTailorObjN['ocontrast'].'.png" class="menu-l-contrast-cuff ">';} else { $datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Outer/'.$eTailorObjN['ofabric'].'.png" class="menu-l-contrast-cuff ">';}
				
				$datacont=$datacont.'<img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Thread/ContrastImg/'.$eTailorObjN['obuttonHole'].'.png" class="menu-l-contrast-cuff "><img src="'.$paths.'/Shirts/Style/Cuffs/1ButtonRound/Button/ContrastImg/'.$eTailorObjN['obutton'].'.png" class="menu-l-contrast-cuff " >';
			}
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Contrast Fabric</h2><span class="highlight">Collar & Cuff</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffIn']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';} else { $datacont=$datacont.'<input type="checkbox" name="collcuffinnertxt" id="collcuffinnertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffIn'].',\'CollarCuffIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ocollarCuffout']=="true"){ $datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="collcuffoutertxt" id="collcuffoutertxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ocollarCuffout'].',\'CollarCuffOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div></div><span class="highlight">Front Placket</span><div class="et-check-box"><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketIn']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktintxt" id="frntplktintxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketIn'].',\'FrontPlacketIn\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inside Contrast</label></div><div class="checkbox"><label>';
		if($eTailorObjN['ofrontPlacketOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntplktouttxt" id="frntplktouttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontPlacketOut'].',\'FrontPlacketOut\',\'11\',\'etcontrast\');">';}
		$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Outside Contrast</label></div>';
		
		if($eTailorObjN['ofront']==5) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['ofrontBoxOut']=="true"){ $datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="frntboxplkttxt" id="frntboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['ofrontBoxOut'].',\'FrontBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Front Box Placket</label></div>';
		}
		if($eTailorObjN['oback']==8) { $datacont=$datacont.'<div class="checkbox"><label>';
			if($eTailorObjN['obackBoxOut']=="true"){$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" checked onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';} else {$datacont=$datacont.'<input type="checkbox" name="backboxplkttxt" id="backboxplkttxt" value="true" onClick="javascript:getseloptions('.$eTailorObjN['obackBoxOut'].',\'BackBoxOut\',\'11\',\'etcontrast\');">';}
			$datacont=$datacont.'<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Box Placket</label></div>';
		}
		
		$datacont=$datacont.'</div></div></div>';
		$datacont=$datacont.'<div class="et-content-fab" id="miniview-etcontrast-12" style="display:none;" ><figure class="et-selected-img"><img src="'.$paths.'/Shirts/Fabric/S/'.$eTailorObjN['ofabric'].'.jpg" alt=""><img src="'.$paths.'/Shirts/Threads/'.$eTailorObjN['obuttonHoleStyle'].'/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:18px; padding-top:20px;"><img src="'.$paths.'/Shirts/Buttons/'.$eTailorObjN['obutton'].'.png" alt="" style="padding-left:34px; padding-top:36px;"><img src="'.$paths.'/Shirts/Threads/C/'.$eTailorObjN['obuttonHole'].'.png" alt="" style="padding-left:17px; padding-top:18px;"></figure><div class="et-style-select"><h2>Contrast & Threads</h2><span class="highlight">A. Button Color :</span><p>'.$eTailorObjN['obuttonName'].' ('.$eTailorObjN['obuttonCode'].')</p><span class="highlight">B. Thread Color :</span><p>'.$eTailorObjN['obuttonHoleName'].' ('.$eTailorObjN['obuttonHoleCode'].')</p><span class="highlight">C. Button Hole Thread :</span><p>'.$eTailorObjN['obuttonHoleStyleName'].' ('.$eTailorObjN['obuttonHoleStyle'].')</p></div></div><div class="et-content-fab" id="miniview-etcontrast-13" style="display:none;" ><figure class="et-selected-img">';
		if($eTailorObjN['omonogram']==1){
			$datacont=$datacont.'<img src="'.$paths.'/none/none.jpg" alt="'.$eTailorObjN['omonogramName'].'">';
		} elseif($eTailorObjN['omonogram']==46){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnWaist/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 55px 0px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==47){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnChest/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 0;width: 100%;left: 0;padding: 75px 0px 35px;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==48){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnPocket/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 11px;width: 100%;left: 0;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		} elseif($eTailorObjN['omonogram']==49){
			$datacont=$datacont.'<img src="'.$paths.'/Shirts/ColorContract/Monogram/MonogramOnCuff(Right)/List/'.$eTailorObjN['ofabric'].'.jpg" alt="'.$eTailorObjN['omonogramName'].'"><span style="color: '.$eTailorObjN['omonogramtextColor'].';position: absolute;top: 55px;width: 100%;left: 0;transform: rotate(65deg);;font-size:12px;font-style:italic;font-family: Mtcorsva;">'.$eTailorObjN['omonogramText'].'</span>';
		}
		$datacont=$datacont.'</figure><div class="et-style-select"><h2>Monogram</h2><span class="highlight">A. Position :</span><p>'.$eTailorObjN['omonogramName'].'</p><span class="highlight">B. Enter Monogram :</span><p>'.$eTailorObjN['omonogramText'].'</p><span class="highlight">C. Monogram Color :</span><p>'.$eTailorObjN['omonogramHoleName'].' ('.$eTailorObjN['omonogramCode'].')</p></div></div><div class="et-next-back"><ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul></div></div>';
		
		$data = ['1' => $data,'2' => $_POST['t'],'3' => $attrbid,'4' => $eTailorObjN,'5' => $datastyle,'6' => $datacont];
		return $data;
	}
	
   	public function get_item(Request $request)
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
		  
	   $eTailorObj = json_decode($request['setarr'], true);  
	   
	   
		//print_r($eTailorObj); exit();
	   $finalarr = json_decode($request['setarr'], true);
	   $finalarr['osizePattern']= $request['mpattern'];
	   if($eTailorObj['osleeve']==3){
				$finalarr['ocuffName']='';
				$finalarr['ocollarCuffout'] ='false';
				$finalarr['ocollarCuffIn']  = 'false';
		}
	   if($request['mpattern']=="Body"){
			$finalarr['osizeStyle']= $request['fitstyle'];
			$finalarr['osizeType']= $request['bsizetyp'];
			$finalarr['osizeNeck']= $request['bsizeNeck'];
			$finalarr['osizeChest']= $request['bsizeChest'];
			$finalarr['osizeWaist']= $request['bsizeWaist'];
			$finalarr['osizeHip']= $request['bsizeHip'];
			$finalarr['osizeLength']= $request['bsizeLength'];
			$finalarr['osizeShoulder']= $request['bsizeShoulder'];
			$finalarr['osizeSleeve']= $request['bsizeSleeve'];
			$finalarr['oqty']= 1;			
			$finalarr['ofrontView']= '';
			$finalarr['obackView']= '';
			$finalarr['osizeFit']='';
			
			if($eTailorObj['ocartID']==''){
				$bodyqty=$request['selbodyqty'];
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
					$canvasSet = [
						'cart_id' => $cartId,
						'canvas_front_img' => $request['frntviewfinal'],
						'canvas_back_img' => $request['bkviewfinal'],					
						 'created_at' => date('y-m-d H:i:s'),
						'updated_at' => date('y-m-d H:i:s'),
					];
		  			$canvasids = DB::table('canvas_dataurls')->insert($canvasSet);
						
				 }else{	 				 
					 DB::table('carts')
						->where('id', $eTailorObj['ocartID'])
						->update($cartSet);
						
					$cartId=$eTailorObj['ocartID'];	
					
					/* Update canvas dataurl*/
					$cartimg = Cart::select('canvas_front_img','canvas_back_img')->where('id', '=',  $cartId)->first();					
					
					$deletefront=Helpers::imggdelete($cartimg->canvas_front_img);
					$deleteback=Helpers::imggdelete($cartimg->canvas_back_img);
					
					$canvasSet = [					
						'orderitem_id' => $cartId,
						'canvas_front_img' => $request['frntviewfinal'],
						'canvas_back_img' => $request['bkviewfinal'],
						'updated_at' => date('y-m-d H:i:s'),
					];
					$canvasids = DB::table('canvas_dataurls')->where('cart_id', $cartId)->update($canvasSet);
							
				 }
				 
				/*Update front image and back image*/
				$frontimg=Helpers::dataurltoimg($request['frntviewfinal'],$cartId,'front');
				$backimg=Helpers::dataurltoimg($request['bkviewfinal'],$cartId,'back');
				
				$cartimgSet = [					
					'canvas_front_img' => $frontimg,
					'canvas_back_img' => $backimg,				 
				];
				DB::table('carts')->where('id', $cartId)->update($cartimgSet);
				 
				 
			}
			
	   } elseif($request['mpattern']=="Standard"){
		   
		   	$sizefit=$request['selsize'];					
			
		   	$finalarr['osizeType']= $request['sizetyp'];
		    $finalarr['oqty']= 1;
		    $finalarr['osizeStyle']='';
			$finalarr['ofrontView']= '';
			$finalarr['obackView']= '';
			$fitlst="";
			 
			
			if($eTailorObj['ocartID']==''){
				$sizeqty=$request['selstdqty'];
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
							$canvasSet = [
							'cart_id' => $cartId,
							'canvas_front_img' => $request['frntviewfinal'],
							'canvas_back_img' => $request['bkviewfinal'],					
							 'created_at' => date('y-m-d H:i:s'),
							'updated_at' => date('y-m-d H:i:s'),
							];
							
		  					$canvasids = DB::table('canvas_dataurls')->insert($canvasSet);
							
						 }else{
						   	DB::table('carts')
							->where('id', $eTailorObj['ocartID'])
							->update($cartSet);
							$cartId = $eTailorObj['ocartID'];
							
							$cartimg = Cart::select('canvas_front_img','canvas_back_img')->where('id', '=',  $cartId)->first();	
											
							/* update canvas dataurl*/
							$deletefront=Helpers::imggdelete($cartimg->canvas_front_img);
							$deleteback=Helpers::imggdelete($cartimg->canvas_back_img);
							
							$canvasSet = [					
								'orderitem_id' => $cartId,
								'canvas_front_img' => $request['frntviewfinal'],
								'canvas_back_img' => $request['bkviewfinal'],
								'updated_at' => date('y-m-d H:i:s'),
							];
							$canvasids = DB::table('canvas_dataurls')->where('cart_id', $cartId)->update($canvasSet);
									
						 }	
						 
						/* update front and back image*/
						$frontimg=Helpers::dataurltoimg($request['frntviewfinal'],$cartId,'front');
						$backimg=Helpers::dataurltoimg($request['bkviewfinal'],$cartId,'back');			 
						
						$cartimgSet = [					
							'canvas_front_img' => $frontimg,
							'canvas_back_img' => $backimg,				 
						];
						DB::table('carts')->where('id', $cartId)->update($cartimgSet); 
						 
						 		
				}	
			}			
	   }	   
	
		return Redirect::to('/cart');
	   
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
	
	
}
