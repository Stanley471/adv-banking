<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundComposition extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $fillable = ['plan_id', 'name', 'percent', 'color'];

    public function plan()
    {
        return $this->belongsTo(Plans::class, 'plan_id');
    }  
}
