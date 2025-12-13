<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Cachable\ModelCaching\Traits\Cachable;

class Beneficiary extends Model
{
    use HasFactory, Uuid, SoftDeletes, cachable;
    protected $fillable = ['user_id', 'beneficiary_id', 'merchant_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }

    public function recipient()
    {
        return $this->belongsTo(User::class,'beneficiary_id')->withTrashed();
    }
}
