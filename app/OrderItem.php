<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Etfabric;
use App\FabricGroup;
use App\Order;

class OrderItem extends Model
{
     protected $table = 'order_items'; 	 

	  public static function groupinfo($id,$field)
		{      			 

				 $fabricdata = FabricGroup::select($field)->where('id', '=' , $id)->value($field);
				 return $fabricdata;
		}
		

		public static function allinfodes($table,$id,$fieldname)
		{
		  $slugname = DB::table($table)->where('id','=',$id)->value($fieldname); 
		  return $slugname;
		}


		public static function orderiteminfo($id,$field)
		{       
			$des = OrderItem::select('item_description')->where('id', '=' , $id)->value('item_description');
			$description=unserialize($des);			 
			if($des){
				if(!empty($description[$field])){
					return $description[$field];
				}else{
					return 0;
				}
			}
			return 0;
		}



public static function orderinfos($id)
    {        

        $des = Order::select('*')->where('id', '=' , $id)->find($id);
        return $des;   	

    }

}

