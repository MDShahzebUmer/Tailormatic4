<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

 
 class Category extends Model
 {
    protected $table = 'categories';

    public static function getcatname($id=null)
    {
       if($id != '')
       {
          $cat_name = Category::select('name')->where('id' , '=' ,$id)->find($id);
          return $cat_name;
          //exit();
       }
      else{
          return false;
       }
    }
    public static function getall_catname($id=null)
    {
       if($id == '')
       {
          $cat_name = Category::select('name','id')->where('parent_id' ,'=' ,null)->get();
           return $cat_name;
       }
    else{
        return false;
      }
    }

     public static function get_relation_catname($id = null)
     {
         if($id== '')
         {
           $cat_name = Category::select('name','id')->where('parent_id' ,'=' ,null)->get();
            if(!$cat_name->isEmpty())
            {
            $i=1;
             $_this = new self;
            foreach ($cat_name as  $v) {
             $arrayName[$i++] = [
              'cat_name' => $v->name, 
              'cat_id' => $v->id, 
              'sub_cat1' => $_this->get_sub1($v->id), 
              ];
            }

           return $arrayName;
         }
         else{return false;}
            
         }
     }

     public function get_sub1($id = null)
     {
     // echo $id;
        if($id != '')
        {
           $sub_name = Category::select('name','id')->where('parent_id' ,'=' ,$id)->get();
          // print_r($sub_name);
          // exit();
           $j=1;
           $sub1 = [];
               $_this = new self;
               foreach ($sub_name as  $vs) {
             $sub1[$j++] = [
              'sub1cat_name' => $vs->name, 
              'sub1cat_id' => $vs->id, 
              'sub_cat2' => $_this->get_sub2($vs->id), 
              ];
            }  
           return $sub1;
        }
        else
        {
          return false;
        }
     }
     public function get_sub2($id= null)
     {
        if($id != '')
        {
           $sub_name2 = Category::select('name','id')->where('parent_id' ,'=' ,$id)->get();
           $k=1;
           $sub2 = [];
               $_this = new self;
               foreach ($sub_name2 as  $vs2) {
             $sub2[$k++] = [
              'sub2cat_name' => $vs2->name, 
              'sub2cat_id' => $vs2->id, 
              'sub_cat3' => $_this->get_sub3($vs2->id), 
              ];
            }  
           return $sub2;  
        }
        else
        {
            return false;
        }
     }

     public function get_sub3($id = null)
     {
        if($id != '')
        {
           $sub_name3 = Category::select('name','id')->where('parent_id' ,'=' ,$id)->get();
           $l=1;
           $sub3 = [];
               $_this = new self;
               foreach ($sub_name3 as  $vs3) {
             $sub3[$l++] = [
              'sub3cat_name' => $vs3->name, 
              'sub3cat_id' => $vs3->id, 
              
              ];
            }  
           return $sub3;  
        }
        else
        {
          return false;
        }
     }
     public static function  get_category_mgm($id = null)
     {
        $cat = FabricGroup::select('cat_id')->first($id);
        $data = Category::select('name')->where('id' , '=' ,$cat->cat_id)->find($cat->cat_id);
        return $data->name;
     }
     public static function get_catname($id=null)
     {
       if($id != '')
       {
          $cat_name = Category::select('name')->where('id' , '=' ,$id)->find($id);
         return $cat_name->name;
          
         
       }
      else{
          return false;
       }
    }

    public static function get_ecollection_cat_name($id=null)
    {
        if($id != '')
        {
           $data = Category::select('name','id')->where('parent_id' , '=' ,$id)->get($id);
           return $data;
        }
        else
        {
          return false;
        }
    }

    
 }
