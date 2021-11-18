<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Thread extends Model
{
   protected $table = 'threads'; 
   //protected $fillable = ['slug', 'name'];

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
      return $this->belongsTo(Attribute::class);
    } 
    public function  attriId()
    {
      return $this->belongsTo(Attribute::class);
    } 
}
