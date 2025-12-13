<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Statusimage extends Model {
    use Uuid;
    protected $table = "status_images";
    protected $fillable = ['update_id', 'image'];
}
