<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Cachable\ModelCaching\Traits\Cachable;

class UserBank extends Model
{
    use HasFactory, Uuid, SoftDeletes, cachable;
    protected $fillable = ['user_id', 'bank_id', 'acct_no', 'acct_name'];

    public function bank()
    {
        return $this->belongsTo(Banks::class,'bank_id')->withTrashed();
    }
}
