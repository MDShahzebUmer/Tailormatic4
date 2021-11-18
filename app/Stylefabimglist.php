<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MainAttribute;
use DB;


class Stylefabimglist extends Model
{
   protected $table = 'stylefabimglists'; 

    public static function get_fabric_option_list($a,$f)
    {       
    	     if($a != '' && $f != '')
    	     {
                $res = Stylefabimglist::select('style_id')->where('attri_id', '=' , $a)->where('fab_id', $f)->get();
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
    public static function get_slug($id = null)
     {
        if($id != '')
        {
            $d1 =  Stylefabimglist::select('attri_id','fab_id')->where('id' , '=' , $id)->find($id);
            $d2 = MainAttribute::select('cat_id')->where('id' , '=' , $d1->attri_id)->find($d1->attri_id);
            $_this = new self;
            $d3 = $_this->sluget('etfabrics',$d1->fab_id,'fbgrp_id');
            $d4 = $_this->sluget('fabric_groups',$d3,'fbgrp_name');
            $d5 = $_this->sluget('categories',$d2->cat_id,'name');
            $d6 = $_this->sluget('etfabrics',$d1->fab_id,'fabric_name');
            $data = [
                       'cat_id' => $d2->cat_id,
                       'fab_id' => $d1->fab_id,
                       'attri_id' => $d1->attri_id,
                       'group_id' => $d3,
                       'fbgrp_name' => $d4,
                       'name' => $d5,
                       'fabric_name' => $d6,
                 ];
                 return $data;
           
        }
        else
        {

        }
     }
     public  static function get_add_slug($f = null , $a = null)
     {
         if($f != '' && $a != '')
         {
           $d2 = MainAttribute::select('cat_id')->where('id' , '=' , $a)->find($a);
           $_this = new self;
            $d3 = $_this->sluget('etfabrics',$f,'fbgrp_id');
            $d4 = $_this->sluget('fabric_groups',$d3,'fbgrp_name');
            $d5 = $_this->sluget('categories',$d2->cat_id,'name');
            $d6 = $_this->sluget('etfabrics',$f,'fabric_name');
            $data = [
                       'cat_id' => $d2->cat_id,
                       'fab_id' => $f,
                       'attri_id' => $a,
                       'group_id' => $d3,
                       'fbgrp_name' => $d4,
                       'name' => $d5,
                       'fabric_name' => $d6,
                 ];
                
                 return $data;

         }
         else
         {

         }
     }

     public  function sluget($table,$id,$fieldname){

      $slugname = DB::table($table)->where('id','=',$id)->value($fieldname);
      return $slugname;
      
    }
}

