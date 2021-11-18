<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
   protected $table = 'countries'; 

   public static function get_country()
   {
   	   $data = Country::select('*')->get();
   	   return $data;
   }
   public static function get_country_name($id)
   {
      if($id != '')
      {
        $data = Country::select('name')->where('id' , '=' ,$id)->find($id);
        return $data->name;  
      }
      else{
      	return false;
      }
    } 
	
	public static function get_country_flag($id)
   {
      if($id != '')
      {
        $data = Country::select('sortname')->where('id' , '=' ,$id)->find($id);
        $fword=strtolower($data->sortname);
		
		return 'flags/'.$fword.'.png';  
      }
      else{
      	return false;
      }
    }
	
	
	 public static function get_country_ph($id)
   {
      if($id != '')
      {
        $data = Country::select('phonecode')->where('id' , '=' ,$id)->find($id);
        return '+'.$data->phonecode;  
      }
      else{
      	return false;
      }
    }
	
	  
}
