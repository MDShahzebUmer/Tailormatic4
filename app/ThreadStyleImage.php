<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ThreadStyleImage extends Model
{
   protected $table = 'thread _style_images'; 
   //protected $fillable = ['slug', 'name'];

    public function  thrd_id()
    {
      return $this->belongsTo(Thread::class);
    }
    public function  thrdId()
    {
      return $this->belongsTo(Thread::class);
    }
    public function  attri_sty_id()
    {
      return $this->belongsTo(AttributeStyle::class);
    }
    public function  attristyId()
    {
      return $this->belongsTo(AttributeStyle::class);
    }
}
