<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Cachable\ModelCaching\Traits\Cachable;

class Banks extends Model
{
    use HasFactory, Uuid, SoftDeletes, cachable;
    protected $fillable = ['title', 'image', 'status'];

    public function users()
	{
		return $this->hasMany(UserBank::class, 'bank_id');
	}
}
