<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cancelorder extends Model
{
    protected $table = 'cancelorders'; 

      public static function cancel_user_request($order_id, $colname)
      {

           $data = Cancelorder::select('*')->where($colname , '=' , $order_id)->first();
            return $data;
      }

      public static function cancel_message_request_a($id)
      {
           $adata = Cancelorder::select("*")->where('order_id' ,'=' ,$id)->where('user_type' ,'=' ,'A')->get();
           if($adata != '')
           {
            return $adata;
           
           }
           else
           {
            return false;
            
           }
          
      }
      public static function cancelitem_message_request_a($id)
      {
           $adata = Cancelorder::select("*")->where('order_itemId' ,'=' ,$id)->where('user_type' ,'=' ,'A')->get();
           if($adata != '')
           {
            return $adata;
           
           }
           else
           {
            return false;
            
           }
          
      }
      public static function cancel_message_request_u($id)
      {
         $udata = Cancelorder::select("*")->where('order_id' ,'=' ,$id)->where('user_type' ,'=' ,'U')->first();
          if($udata != '')
            {
              
               return $udata;
              
            }
           else
            {
               return false;
            }
      }

      public static function cancelitem_message_request_u($id)
      {
         $udata = Cancelorder::select("*")->where('order_itemId','=',$id)->where('user_type' ,'=' ,'U')->first();
          if($udata != '')
            {
              
               return $udata;
              
            }
           else
            {
               return false;
            }
      }


}
