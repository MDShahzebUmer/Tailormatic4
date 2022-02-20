<?php
namespace TCG\Voyager\Http\Controllers;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Voyager;
use TCG\Voyager\Models\DataType;
use App\CamaignPromoCode;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Redirect;
use App\State;
use TCG\Voyager\Models\Permission;
use DB;
use Illuminate\Http\File;

class CampaignController extends Controller
{
   /* public function __construct($id,)
    {
        $this->data =  "hello";
    }*/
    
    public function get_camaign_list()
    {
    	 $data = CamaignPromoCode::select('*')->get();
    	 return view('voyager::procode.promocode')->with(compact('data'));
    }
    public function add_camaign_list()
    {
    	$type=1;

    	return view('voyager::procode.edit-add-promocode')->with(compact('type'));
    }
     public function add_camaign_post(Request $request)
     {
     	    $code = CamaignPromoCode::select('promo_code')->where('promo_code' ,'=' ,$request->input('promo_code'))->count();
          if($code == 0){

           $data = new  CamaignPromoCode;
           $data->promo_code = $request->input('promo_code');
           $data->benefit_type = $request->input('benefit_type');
           $data->benefit_amt = $request->input('benefit_amt');
           $data->validity_condition =$request->input('validity_condition');
           $data->start_date = $request->input('start_date');
           $data->end_date =  $request->input('end_date');
           $data->coupan_term =  $request->input('coupan_term');
           
           
           if($request->input('promo_description') != '')
           {
           	$data->promo_description =$request->input('promo_description');
           }
           if($request->input('code_count') != '')
           {
           	$data->code_count =$request->input('code_count');
           }
           if($request->input('max_amount') != '')
           {
           	$data->max_amount =$request->input('max_amount');
           }
           if($request->input('cat_id') != '')
           {
           	$data->cat_id =$request->input('cat_id');
           }
           if($request->input('country') != '')
           {
           	$data->country =$request->input('country');
           }
           if($request->input('state') != '')
           {
           	$data->state =$request->input('state');
           }
           if($request->input('city') != '')
           {
           	$data->city =$request->input('city');
           }
           if($request->input('region') != '')
           {
           	$data->region =$request->input('region');
           }
           if($request->input('specific_day') != '')
           {
           	$data->specific_day =$request->input('specific_day');
           }
           $data = $data->save()
             ? [
                'message'    => "Successfully  Campaign Option Save ",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ];
            return redirect()->to('admin/campaign/')->with($data);
        }
        else
        {
          $code ="All Ready Used";
           $code 
           ? [
                'message'    => "Coupan  {{$code}}",
                'alert-type' => 'danger',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ]; 
            return redirect()->to('admin/campaign/')->with($code);
        }
     } 
     public function edit_camaign_data($id = null)
     {

        if($id != '')
        {
        	$type ='';
        	$data = CamaignPromoCode::select('*')->where('id' ,'=' , $id)->find($id);
        
    	    return view('voyager::procode.edit-add-promocode')->with(compact('type','data'));
        }
        else
        {
        	return redirect()->back();
        }
     }

     public function update_camaign_data(Request $request)
     {
     	$data = new  CamaignPromoCode;
     	$data= CamaignPromoCode::findOrFail($request->input('id'));
           $data->promo_code = $request->input('promo_code');
           $data->benefit_type = $request->input('benefit_type');
           $data->benefit_amt = $request->input('benefit_amt');
         
           $data->start_date = $request->input('start_date');
           $data->end_date =  $request->input('end_date');
           $data->coupan_term =  $request->input('coupan_term');
           
           
           if($request->input('promo_description') != '')
           {
           	$data->promo_description =$request->input('promo_description');
           }
           if($request->input('code_count') != '')
           {
           	$data->code_count =$request->input('code_count');
           }
           if($request->input('max_amount') != '')
           {
           	$data->max_amount =$request->input('max_amount');
           }
           if($request->input('cat_id') != '')
           {
           	$data->cat_id =$request->input('cat_id');
           }
           if($request->input('country') != '')
           {
           	$data->country =$request->input('country');
           }
           if($request->input('state') != '')
           {
           	$data->state =$request->input('state');
           }
           if($request->input('city') != '')
           {
           	$data->city =$request->input('city');
           }
           if($request->input('region') != '')
           {
           	$data->region =$request->input('region');
           }
           if($request->input('specific_day') != '')
           {
           	$data->specific_day =$request->input('specific_day');
           }
           $data = $data->save()
             ? [
                'message'    => "Successfully  Campaign Option Save ",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ];
            return redirect()->back()->with($data);
     }

     public function campaign_del($id = null)
     {
        $cont   = new CamaignPromoCode;
        $cont = CamaignPromoCode::find($id);
        $data = CamaignPromoCode::destroy($id)
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

    public function getStateList(Request $request)
    {
    	$states = State::where('country_id' , '=' ,$request->country_id)->get();
        return response()->json($states);
    }
	  
}