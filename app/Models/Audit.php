<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Services\Cachable\ModelCaching\Traits\Cachable;

class Audit extends Model {
    use Uuid, Cachable;
    protected $table = "audit_logs";
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'business_id',
        'trx',
        'log',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id', 'reference');
    }    
}
