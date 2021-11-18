<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\MeasurmentSize;



class BodyMeasurment extends Model
{
    protected $table = 'body_measurments'; 
    
    public function  mert_type()
    {
      return $this->belongsTo(BodyMeasurment::class);
    }
    public function  cat_id()
    {
      return $this->belongsTo(Category::class);
    }
    public function  catId()
    {
      return $this->belongsTo(Category::class);
    }
	public function  mer_id()
    {
      return $this->belongsTo(MeasurmentSize::class);
    }
    public function  merId()
    {
      return $this->belongsTo(MeasurmentSize::class);
    }
	public function  standardsize_id()
    {
      return $this->belongsTo(StandardSize::class);
    }
    public function  standardsizeId()
    {
      return $this->belongsTo(StandardSize::class);
    }
	
	public function  country_id()
    {
      return $this->belongsTo(CountrySize::class);
    }
    public function  countryId()
    {
      return $this->belongsTo(CountrySize::class);
    }

    public static function get_stander_size($id = null)
     {
         if($id != '')
         {
                

               $size = MeasurmentSize::select('name')->where('id' ,'=' ,$id)->get();
                 foreach($size as $s)
                         {
                       return   $s->name;                    
                        }

         }
         else
         {
          return '';
         }
     }
     
     public static function get_standersize($id = null)
     {
         $size = MeasurmentSize::select('*')->get();
         return $size;
     }
}
