<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planupdate extends Model {
    use Uuid, SoftDeletes;
    protected $table = "plan_updates";
    protected $fillable = ['plan_id', 'title', 'report', 'stage', 'weeks'];

    public function plan()
    {
        return $this->belongsTo(Plans::class, 'plan_id');
    }    
    
    public function images()
    {
        return $this->hasMany(Statusimage::class, 'update_id');
    } 
}
