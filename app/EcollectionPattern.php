<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class EcollectionPattern extends Model
{
    protected $table = 'ecollection_patterns'; 

    public static function  fabric_pattern()
    {
    	 $data = EcollectionPattern::select('*')->get();
    	 return $data;
    }
    public static function get_fabric_patternname($id)
    {
       $dt = EcollectionPattern::select('name')->find($id);
       if($dt != '')
       {
        return $dt->name;
       }
       else{
        return false;
       }
    }
}
