<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class EcollectionFabrictype extends Model
{
    protected $table = 'ecollection_fabrictypes'; 

    public static function  fabric_types()
    {
    	 $data = EcollectionFabrictype::select('*')->get();
    	 return $data;
    }
    public static function  fabric_types_catId($id)
    {

    	 $data = EcollectionFabrictype::select('*')->where('cat_id','=',$id)->get();
    	 return $data;
    }

    public static function get_type_fabric_name($id)
    {
       $dt = EcollectionFabrictype::select('type_name')->find($id);
       if($dt != '')
       {
        return $dt->type_name;
       }
       else{
        return false;
       }
    }
}
