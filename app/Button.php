<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Button extends Model
{
 protected $table = 'buttons';

    public function  cat_id()
    {
       return $this->belongsTo(Category::class); 
    }
    public function  catId()
    {
       return $this->belongsTo(Category::class); 
    }
    public function  attri_id()
    {
       return $this->belongsTo(MainAttribute::class); 
    } 
    public function  attriId()
    {
       return $this->belongsTo(MainAttribute::class); 
    }   
}
