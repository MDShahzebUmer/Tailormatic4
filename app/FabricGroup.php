<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class FabricGroup extends Model
{
    protected $table = 'fabric_groups';

    public function  cat_id()
    {
       return $this->belongsTo(Category::class); 
    }
    public function  catId()
    {
       return $this->belongsTo(Category::class); 
    }
}
