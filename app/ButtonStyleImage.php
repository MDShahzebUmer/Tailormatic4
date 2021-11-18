<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ButtonStyleImage extends Model
{
   protected $table = 'button_style_images'; 
   //protected $fillable = ['slug', 'name'];

    public function  but_id()
    {
      return $this->belongsTo(Button::class);
    }
    public function  butId()
    {
      return $this->belongsTo(Button::class);
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
