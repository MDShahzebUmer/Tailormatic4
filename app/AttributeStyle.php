<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AttributeStyle extends Model
{
  protected $table = 'attribute_styles';
  public static function getStylename($id,$name){
		
		if($id != '')
   	    {
               $res = AttributeStyle::select($name)->where('id', '=' , $id)->get();
                foreach ($res as $value) {
                         
                }
                return $value->$name;
   	    }else
   	    {
   	    return false;
   	    }
	}  
}
