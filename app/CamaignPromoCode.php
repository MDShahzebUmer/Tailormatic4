<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CamaignPromoCode extends Model
{
    protected $table = 'camaign_promo_code';

    public static function get_Validity()
    {
    	$val  = [
    	          '1' => 'X no. of time before Y date',
    	          '2' => 'If X count of Y Item in an order',
    	          '3' => 'If Order value is greater than X amount',
    	          '4' => 'Only if Buying Item 1st time',
    	          '5' => 'Valid for specific city,state,country,region',
    	          '6' => 'Valid for specific day',
    	        ];
    	        return $val;
    }
}
