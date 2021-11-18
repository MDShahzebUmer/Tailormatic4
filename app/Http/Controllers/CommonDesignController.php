<?php
namespace App\Http\Controllers;
use App\PipingStyleImg;
use App\Http\Requests\ConatctRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;

class CommonDesignController extends Controller
{
     public function check_edit_add($id=null,$cat_id =null)
      {
             if($id != '' && $cat_id != '')
             {
                
                $data = PipingStyleImg::where('piping_id', '=',$id)->where('cat_id', '=',$cat_id)->first();
                if ($data === null) {
                    return 'add';
                 }
                 else{ return 'edit'; }
             }else{
              return 'add';
             }
      }
      
}
