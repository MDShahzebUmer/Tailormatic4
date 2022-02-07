<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\FabricGroup;

class Etfabric extends Model
{
    use HasFactory;
    public function  fbgrpId()
    {
      return $this->belongsTo(FabricGroup::class);
    }
}
