<?php

namespace App;
use App\StandardSize;
use Illuminate\Database\Eloquent\Model;


class MeasurmentSize extends Model
{
    public static function get_standardSize()
    {
    	$data = MeasurmentSize::select('*')->get();
    	if($data != '')
    	{
    		return $data;
    	}
    	else
    	{
    		return false;
    	}
    } 

      public static function get_ecollection_size_dropdown($data,$cat)
      {
         if($data != '' && $cat != '' )
         {
             $dat = unserialize($data);
             return $dat;
             
              
         }
         else
         {
            return 0;
         }
      }
      public static function ecollection_size_name($id)
      {
         $sz = MeasurmentSize::select('name')->where('id','=',$id)->find($id);
         return $sz->name;
      } 

      public static function ecollection_sizename($id)
      {
         $sz = StandardSize::select('value')->where('id','=',$id)->find($id);
         return $sz->value;
      }
}
