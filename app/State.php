<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class State extends Model
{
  protected $table = 'states';  

   public function  country_id()
    {
       return $this->belongsTo(Country::class); 
    }
    public function  countryId()
    {
       return $this->belongsTo(Country::class); 
    }

    public static function get_state_name($id= null)
    {
    	 if($id != '')
    	 {
    	 	$data  = State::select('name')->find($id);
    	 	return $data->name;
    	 }else
    	 {
    	 	return false;
    	 }
    	
    }
}
