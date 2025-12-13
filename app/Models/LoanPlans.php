<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanPlans extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'breaks',
        'duration',
        'status',
        'installment',
        'interest',
        'failed_interest',
        'min',
        'max',
        'type',
        'suggested_amount',
        'created_by',
        'edited_by',
        'image',
        'amount',
        'description',
        'cat_id',
        'product_type',
        'digital_link',
    ];

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by')->withTrashed();
    } 
    
    public function editedBy()
    {
        return $this->belongsTo(Admin::class, 'edited_by')->withTrashed();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id')->whereType('product')->withTrashed();
    } 

    public function users()
    {
        return $this->hasMany(LoanApplicants::class, 'plan_id');
    }
}
