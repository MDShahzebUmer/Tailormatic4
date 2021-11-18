<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class StandardSize extends Model
{
	protected $table = 'standard_sizes';
	
    public static function get_standersizeno($id = null)
     {
         $sizeno = StandardSize::select('*')->get();
         return $sizeno;
     }
	 
	 public static function get_standersizevalue($id = null)
     {
     	
         if($id!='' || $id!=0){
		 $sizeno = StandardSize::select('value')->where('id','=',$id)->first($id);
                    
                          $sizeno=$sizeno->value;
                     
		
		 }else{
			 $sizeno='';
		 }
         return $sizeno;
     }
}
