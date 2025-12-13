<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Countrysupported extends Model
{
    protected $table = "country_supported";
    protected $guarded = [];
    protected $fillable = [
        'country_id',
    ];

    public function real()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }   
}
