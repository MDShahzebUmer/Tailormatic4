<?php

namespace App;
use App\FabricGroup;
use Illuminate\Database\Eloquent\Model;


class Etfabric extends Model
{
  protected $table = 'etfabrics'; 
  protected $fillable = ['slug', 'name'];

    public function  fbgrp_id()
    {
      return $this->belongsTo(FabricGroup::class);
    }
    public function  fbgrpId()
    {
      return $this->belongsTo(FabricGroup::class);
    }

   /*public function parent_id()
   {
       return $this->belongsTo(self::class);
    }*/
}
