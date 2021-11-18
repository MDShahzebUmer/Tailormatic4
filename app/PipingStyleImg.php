<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PipingStyleImg extends Model
{
    protected $table = 'piping_style_imgs';

    public static function check_edit_add($id=null,$cat_id =null)
      {
             if($id != '' && $cat_id != '')
             {
                
                $data = PipingStyleImg::select('id')->where('piping_id', '=',$id)->where('cat_id', '=',$cat_id)->first();
                if ($data === null) {
                    return 'add';
                 }
                 else{ return $data; }
             }else{
              return 'add';
             }
      }
}
