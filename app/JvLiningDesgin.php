<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\AttributeStyle;


class JvLiningDesgin extends Model
{
   protected $table = "jv_lining_desgin"; 

   public static function get_lining_option_list($a,$l)
    {       
    	     if($a != '' && $l != '')
    	     {
                $res = JvLiningDesgin::select('style_id')->where('attri_id', '=' , $a)->where('lining_id', $l)->get();
                 if(count($res)!=0){

                 foreach ($res as $value) {
                 	          $r[]  =  $value->style_id;
                 }
             }else{
                $r[]=0;
             }
                 return $r;
    	     }else
    	     {
    	     	return false;
    	     }
          
    }
    public static function get_jv_attriname($a,$b)
    {
        if($a != '' && $b != '')
        {
            $name = AttributeStyle::select('style_name')->where('id', '=' ,$a)->where('attri_id', '=' ,$b)->first();
            return $name->style_name;
        }
        else
        {
           return false;
        }
    }
}
