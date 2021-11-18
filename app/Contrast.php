<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Contrast extends Model
{
    protected $table = 'contrasts';

    public function  cat_id()
    {
       return $this->belongsTo(Category::class); 
    }
    public function  catId()
    {
       return $this->belongsTo(Category::class); 
    }
}
