<?php
 namespace App;
 use Illuminate\Database\Eloquent\Builder;

 use Illuminate\Database\Eloquent\Model;

 class Your extends Model
 {
	protected $table = 'yours';
  public $yours = ['group_id' => 'array'];
  protected $guarded = []; 
    
    public function  group_id()
    {
      return $this->hasMany(FabricGroup::class);
    }  
    public function  groupId()
    {
      return $this->belongsTo(FabricGroup::class);
    } 
}
