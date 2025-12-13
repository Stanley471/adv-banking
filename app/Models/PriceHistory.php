<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceHistory extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $fillable = ['plan_id', 'amount', 'date'];
    protected $dates = ['date'];
}
