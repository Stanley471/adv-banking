<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Followed extends Model
{
    use Uuid, SoftDeletes;
    protected $table = "followed";
    protected $fillable = ['user_id', 'plan_id', 'units', 'amount', 'status', 'sold', 'dividend'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function plan()
    {
        return $this->belongsTo(Plans::class, 'plan_id')->withTrashed();
    }
}
