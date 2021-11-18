<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $table = 'orders'; 

    public static function orderinfo($id)
    {       
    	$des = Order::select('*')->where('id', '=' , $id)->first();

    	return $des;
    }

    public static function get_order_status($id)
    {
        switch ($id) {
            case '1':
            return "Pending";
            break;
            case '2':
            return "Process";
            break;
            case '3':
            return "Delivered";
            break;
            case '4':
            return "Completed";
            break;

            default:
            return "";
            break;
        }
    }

    public static function get_user_request_status($id = null)
    {
        $req = Order::select('request_status')->where('id' ,'=' ,$id)->find($id);
         if($req != '')
         {
              return $req->request_status;
         }
         else
         {
             return 0;
         }
    }
    public static function get_user_order_status($id = null)
    {
        $req = Order::select('orderstatus')->where('id' ,'=' ,$id)->find($id);
         if($req != '')
         {
              return $req->orderstatus;
         }
         else
         {
             return 0;
         }
    }

     
}
