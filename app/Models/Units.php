<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Units extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $fillable = ['user_id', 'profit_id', 'units', 'plan_id', 'amount', 'type', 'mutual'];

    public function plan()
    {
        return $this->belongsTo(Plans::class, 'plan_id')->withTrashed();
    }    
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
    
    public function profit()
    {
        return $this->belongsTo(Followed::class, 'profit_id')->withTrashed();
    }
}
