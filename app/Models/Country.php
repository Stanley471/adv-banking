<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {
    protected $table = "country";
    protected $guarded = [];

    public function state()
    {
        return Shipstate::wherecountry_code($this->iso2)->orderby('name', 'asc')->get();
    }
}
