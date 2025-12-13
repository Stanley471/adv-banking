<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;
use Services\Cachable\ModelCaching\Traits\Cachable;

class Balance extends Model
{
    use SoftDeletes, Uuid, HasFactory, Cachable;
    protected $fillable = ['user_id', 'country_id', 'ref_id', 'business_id', 'amount', 'profit', 'waivers', 'used_waivers', 'main', 'short_code'];

    protected $table = "balance";

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    } 

    public function getCurrency()
    {
        return $this->belongsTo(Countrysupported::class,'country_id');
    } 

    public function receiver()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function business(){
        return $this->belongsTo(Business::class, 'business_id', 'reference');
    }    
}
