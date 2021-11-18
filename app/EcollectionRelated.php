<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class EcollectionRelated extends Model
{
     protected $table = 'ecollection_relateds';

     public static function get_checked_relatedP($p = null,$ck=null)
     {
       // echo $ck;exit();
        if($ck != '' && $p != ''){
        $product_id = $p;
    $reldatacount = EcollectionRelated::select('relateds_id')->where('product_id', '=' , $product_id)->count();
        $reldata = EcollectionRelated::select('relateds_id')->where('product_id', '=' , $product_id)->first();
    
        if($reldatacount>0){
      if($reldata->relateds_id != ''){
        $reldata   = unserialize($reldata->relateds_id);
  
          if(in_array($ck,$reldata)){
            return 'checked';
  
          }else{return '';}
        }else{return ""; }
      
     }else{return ""; } 
      
      
      
        }else{return "";}
    

    }

       public static function get_related_product_list($data)
       {
            return $data = unserialize($data);
             
       }

       public static function get_related_product_list_checkdata($data)
       {
             $data = unserialize($data);
           
             if($dcount=count($data)>0){
            $pdata[]='';
              foreach($data as $iid){

                $ecpd = EcollectionProduct::select('*')->where('id','=',$iid)->where('product_status','=',1)->count();
                if($ecpd>0){
                  $pdata[]=$iid;
                }


              }
             }else{
              $pdata='';
             } 
            

            return $pdata; 


       }


}
