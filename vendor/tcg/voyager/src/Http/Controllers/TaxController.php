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
use TCG\Voyager\Models\Permission;
use DB;
use App\TaxRate;

class TaxController extends Controller
{
    
    public function index()
    {
        return view('voyager::index');
    }
   
    
    public function get_tax()
      {
		    $type = 2; 
			  $taxdata = DB::table('tax-rates')							 
							 ->select('*')
							 ->where('id','=',1)
							 ->first();		  
                  
    	return view('voyager::tax.edit-add-tax')->with(compact('taxdata'));
      }
	  
	   public function save_tax(Request $request)
      {
		  $id = $request->id;
          $taxdata = new TaxRate;
          $taxdata  = TaxRate::findOrFail($id);
          $taxdata->tax_rates = $request->tax_rates;
          $taxdata->tax_status = $request->tax_status;                      
          $taxdata->save()
		   ? [
         'message'    => "Successfully removed Shipping Rates  from {$taxdata->id}",
         'alert-type' => 'success',
         ]
         : [
         'message'    => 'Sorry it appears there was a problem removing this bread',
         'alert-type' => 'danger',
         ];	  
                  
    	return view('voyager::tax.edit-add-tax')->with(compact('taxdata'));
      } 
   
   
}
