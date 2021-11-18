<?php
namespace App;
use App\EcollectionProduct;
use Illuminate\Database\Eloquent\Model;


	class EcollectionColor extends Model
	{
	    protected $table = 'ecollection_colors'; 

	    public static function get_color_product()
	    {
	    	$data = EcollectionColor::select('*')->get();
	    	return $data;
	    }
	    public static function get_checked_sizeP($id = null,$ck=null)
	    {
	    	//$id = $p;
	    	$sizedata = EcollectionProduct::select('product_size')->where('id', '=' , $id)->first($id);
	    	$sizedata   = unserialize($sizedata->product_size);

	    	if(in_array($ck,$sizedata)){
	    		return 'selected';

	    	}else{
	    		return '';

	    	}


	    }
	    public static function get_checked_colorP($id = null,$ck=null)
	    {
	    
	    	
	    	$colordatae = EcollectionProduct::select('product_color')->where('id', '=' , $id)->first($id);
	    	$colordata   = unserialize($colordatae->product_color);         
	    		
			
			
		if(count($colordata ? $colordata : [])>0 && $colordatae->product_color!=''){
			
				if(in_array($ck,$colordata)){
					return 'selected';
	
				}else{
					return '';
	
				}
			}


	    }

	    public static  function get_ecollection_color($data)
	    {
             if($data != '')
             {
             	 $d =  unserialize($data);
             	 return $d;
             }
             else{
             	return 0;
             }                        
	    }

	    public static function get_color_name($id)
	    {
	      $dc =	EcollectionColor::select('color_name')->find($id);
	      return $dc->color_name;
	    }

	}
