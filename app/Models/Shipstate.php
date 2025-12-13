<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Services\Cachable\ModelCaching\Traits\Cachable;

class Shipstate extends Model {
    use Cachable;
    protected $table = "state";
    protected $guarded = [];
}
