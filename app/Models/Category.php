<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Cachable\ModelCaching\Traits\Cachable;

class Category extends Model
{
    use HasFactory, Uuid, SoftDeletes, Cachable;

    protected $fillable = [
        'name', 
        'slug', 
        'status', 
        'type', 
        'icon', 
        'description', 
        'state_id', 
        'amount', 
        'image', 
        'duration', 
        'circle_duration', 
        'interest', 
        'cat_id', 
        'plan_id', 
        'expiry_date', 
        'min', 
        'max', 
        'fc', 
        'pc', 
        'requirements', 
        'edited_by', 
        'created_by'
    ];

    protected $dates = [
        'expiry_date'
    ];

    public function withdrawTrx()
	{
		return $this->hasMany(Transactions::class, 'withdraw_id');
	}

    public function articles()
    {
        return $this->hasMany(Blog::class, 'cat_id');
    }

    public function faq()
    {
        return $this->hasMany(HelpCenter::class, 'cat_id');
    }

    public function savings()
    {
        return $this->hasMany(Savings::class, 'circle_id')->orderBy('amount', 'desc');
    }

    public function invest()
    {
        return $this->belongsTo(Plans::class, 'cat_id');
    }

    public function state()
    {
        return $this->belongsTo(Shipstate::class, 'state_id');
    }    
    
    public function circleCategory()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by')->withTrashed();
    } 
    
    public function editedBy()
    {
        return $this->belongsTo(Admin::class, 'edited_by')->withTrashed();
    }
}
