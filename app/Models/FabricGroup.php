<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class FabricGroup extends Model
{
    use HasFactory;
    public function  cat_id()
    {
       return $this->belongsTo(Category::class); 
    }
    public function  catId()
    {
       return $this->belongsTo(Category::class); 
    }
}
