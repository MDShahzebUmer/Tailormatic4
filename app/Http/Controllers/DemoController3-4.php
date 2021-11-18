<?php

namespace App\Http\Controllers;
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
use App\Thread;
use Requests;
use View;
use Illuminate\Support\Collection;


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
        //$this->fabid;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /*Welcome blade call*/
    public function index()
    {
		if(isset($_POST['fabid'])){
			$eTailorObj= $this->varupdate($_POST['fabid'],$_POST['carr'],$_POST['typ']);
			$mytab=$_POST['t'];
			if($_POST['typ']=='fabric'){
				$mysubtab = "fabric".$eTailorObj['ofabricType'];
			} else {
				$mysubtab = $this->updatesubmenu($_POST['typ']);
			}
			$loadme="1";
		}else{
			$eTailorObj=[
				'oprodType'=>'Shirts',
				'ocatID'=>'1',
				'ofabricGroup'=>'Fabric Of The Week',
				'ofabricType'=>'1',
				'ofabricPrice'=>'20',
				'ofabric'=>'1',
				'ofabricName'=>'Premium White No.41',
				'ofabricImage'=>'Shirts/Fabric/L/1.jpg',
				'ofabricList'=>'Shirts/Fabric/S/1.jpg',
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
				'obackView'=>''
			];
			
			$mytab="etfabric";
			$mysubtab="fabric1";
			$loadme="0";
		}
		
		/* Fabric */
		$id=$eTailorObj['ocatID'];
		$car_record = Category::select('*')->where('id', '=', 1)->first($id);
		$cat_id = $car_record->id;
		$group_record = FabricGroup::select('*')->where('cat_id', '=', $cat_id)->get();
		//echo '<pre>'.print_r($group_record,true).'</pre>';
		
		/* Attribute Style */
		$mainattr_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 1)->get();
		
		/* Contrast */
		$contrast_record = MainAttribute::select('*')->where('cat_id', '=', $cat_id)->where('parent_id', '=', 2)->get();
		
		return view::make('demo/test')->with(compact('car_record','group_record','mainattr_record','contrast_record','eTailorObj','mytab','mysubtab','loadme'));
    }
   
   public function varupdate($ff, $carray, $ctype){
   		$eTailorObjN=$carray;
		switch($ctype){
			case 'fabric':
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
				return $eTailorObjN;
				break;
			case 'Sleeve':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['osleeve']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['osleeveName']=$style_record->style_name;
				return $eTailorObjN;
				break;
			case 'Front':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['ofront']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['ofrontName']=$style_record->style_name;
				return $eTailorObjN;
				break;
			case 'Back':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['oback']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obackName']=$style_record->style_name;
				return $eTailorObjN;
				break;
			case 'Bottom':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['obottom']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['obottomName']=$style_record->style_name;
				return $eTailorObjN;
				break;
			case 'Collar':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['ocollar']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['ocollarName']=$style_record->style_name;
				return $eTailorObjN;
				break;
			case 'Cuffs':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['ocuff']=$ff;
				$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
				$eTailorObjN['ocuffName']=$style_record->style_name;
			case 'Pockets':
				$ffbid=$eTailorObjN['ofabric'];
				$eTailorObjN['opacket']=$ff;
				if($ff==37){
					$eTailorObjN['opacketName']="No Pocket";
				} else {
					$style_record = Stylefabimglist::select('*')->where('style_id', '=', $ff)->where('fab_id', '=', $ffbid)->first();
					$eTailorObjN['opacketName']=$style_record->style_name;
				}
				return $eTailorObjN;
				break;
			case 'Contrast':
				$eTailorObjN['ocontrast']=$ff;
				$style_record = Contrast::select('*')->where('id', '=', $ff)->find($ff);
				$eTailorObjN['ocontrastName']=$style_record->contrsfab_name;
				return $eTailorObjN;
				break;
			case 'Buttons':
				$eTailorObjN['obutton']=$ff;
				$style_record = Button::select('*')->where('id', '=', $ff)->find($ff);
				$eTailorObjN['obuttonName']=$style_record->button_name;
				$eTailorObjN['obuttonCode']=$style_record->button_code;
				return $eTailorObjN;
				break;
			case 'Threads':
				$eTailorObjN['obuttonHole']=$ff;
				$style_record = Thread::select('*')->where('id', '=', $ff)->find($ff);
				$eTailorObjN['obuttonHoleName']=$style_record->thrd_name;
				$eTailorObjN['obuttonHoleCode']=$style_record->thread_code;
				$eTailorObjN['obuttonHoleColor']=strtoupper($style_record->thread_color);
				return $eTailorObjN;
				break;
			case 'ThreadStyle':
				$eTailorObjN['obuttonHoleStyle']=$ff;
				if($ff=="V"){
					$eTailorObjN['obuttonHoleStyleName']="Vertical";
				} elseif($ff=="H"){
					$eTailorObjN['obuttonHoleStyleName']="Horizontal";
				} elseif($ff=="S"){
					$eTailorObjN['obuttonHoleStyleName']="Slanted";
				}
				return $eTailorObjN;
				break;
			case 'Monogram':
				$eTailorObjN['omonogram']=$ff;
				if($ff=="1"){
					$eTailorObjN['omonogramName']="No Monogram";
				} else{
					$style_record = AttributeStyle::select('*')->where('id', '=', $ff)->find($ff);
					$eTailorObjN['omonogramName']=$style_record->style_name;
				}
				return $eTailorObjN;
				break;
			case 'MonoText':
				$eTailorObjN['omonogramText']=trim($ff);
				return $eTailorObjN;
				break;
			case 'MonoColor':
				$eTailorObjN['omonogramColor']=$ff;
				$style_record = Thread::select('*')->where('id', '=', $ff)->find($ff);
				$eTailorObjN['omonogramHoleName']=$style_record->thrd_name;
				$eTailorObjN['omonogramCode']=$style_record->thread_code;
				$eTailorObjN['omonogramtextColor']=strtoupper($style_record->thread_color);
				return $eTailorObjN;
				break;
			case 'Epaulette':
				if($ff=="true"){
					$eTailorObjN['oshoulder']="false";
				} else {
					$eTailorObjN['oshoulder']="true";
				}
				return $eTailorObjN;
				break;
			case 'Seams':
				if($ff=="true"){
					$eTailorObjN['oseams']="false";
				} else {
					$eTailorObjN['oseams']="true";
				}
				return $eTailorObjN;
				break;
			case 'Darts':
				if($ff=="true"){
					$eTailorObjN['odart']="false";
				} else {
					$eTailorObjN['odart']="true";
				}
				return $eTailorObjN;
				break;
			case 'CollarStay':
				if($ff=="true"){
					$eTailorObjN['ocollarStay']="false";
				} else {
					$eTailorObjN['ocollarStay']="true";
				}
				return $eTailorObjN;
				break;
			case 'CollarCuffIn':
				if($ff=="true"){
					$eTailorObjN['ocollarCuffIn']="false";
				} else {
					$eTailorObjN['ocollarCuffIn']="true";
				}
				return $eTailorObjN;
				break;
			case 'CollarCuffOut':
				if($ff=="true"){
					$eTailorObjN['ocollarCuffout']="false";
				} else {
					$eTailorObjN['ocollarCuffout']="true";
				}
				return $eTailorObjN;
				break;
			case 'FrontPlacketIn':
				if($ff=="true"){
					$eTailorObjN['ofrontPlacketIn']="false";
				} else {
					$eTailorObjN['ofrontPlacketIn']="true";
				}
				return $eTailorObjN;
				break;
			case 'FrontPlacketOut':
				if($ff=="true"){
					$eTailorObjN['ofrontPlacketOut']="false";
				} else {
					$eTailorObjN['ofrontPlacketOut']="true";
				}
				return $eTailorObjN;
				break;
			case 'FrontBoxOut':
				if($ff=="true"){
					$eTailorObjN['ofrontBoxOut']="false";
				} else {
					$eTailorObjN['ofrontBoxOut']="true";
				}
				return $eTailorObjN;
				break;
			case 'BackBoxOut':
				if($ff=="true"){
					$eTailorObjN['obackBoxOut']="false";
				} else {
					$eTailorObjN['obackBoxOut']="true";
				}
				return $eTailorObjN;
				break;
			case 'NumPocket':
				$eTailorObjN['opacketCount']=$ff;
				return $eTailorObjN;
				break;		
			default:
				return $eTailorObj;
				break;
		}
   }
  
   public function updatesubmenu($type){
	   switch($type){
		   case "CollarCuffIn":
		   case "CollarCuffOut":
		   case "FrontPlacketIn":
		   case "FrontPlacketOut":
		   case "FrontBoxOut": 
		   case "BackBoxOut":
				$mysubtab="Contrast";
				return $mysubtab;
				break;
			case "Threads":
			case "ThreadStyle":
				$mysubtab="Buttons";
				return $mysubtab;
				break;
			case "MonoText":
			case "MonoColor":
				$mysubtab="Monogram";
				return $mysubtab;
				break;
			case "Epaulette":
				$mysubtab="Sleeve";
				return $mysubtab;
				break;
			case "Seams":
				$mysubtab="Front";
				return $mysubtab;
				break;
			case "Darts":
				$mysubtab="Back";
				return $mysubtab;
				break;
			case "CollarStay":
				$mysubtab="Collar";
				return $mysubtab;
				break;
			case "NumPocket":
				$mysubtab="Pockets";
				return $mysubtab;
				break;
			default:
				$mysubtab=$_POST['typ'];
				return $mysubtab;
				break;
		}
   }

   public function get_item(Request $request)
   {
       echo "work under progress";
    // print_r($_POST);
	   
   }
}
