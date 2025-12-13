<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Installment extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $dates = [
        'expiry_date'
    ];

    protected $fillable = [
        'user_id',
        'plan_id',
        'application_id',
        'payback',
        'failed',
        'initial',
        'profit',
        'expiry_date',
        'ref_id',
        'status',
        'reminder',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function plan()
    {
        return $this->belongsTo(LoanPlans::class, 'plan_id')->withTrashed();
    } 
    
    public function previous()
    {
        return Installment::whereApplicationId($this->application_id)->whereDate('expiry_date', $this->expiry_date->subMonths(1))->withTrashed()->first();
    }    
    
    public function application()
    {
        return $this->belongsTo(LoanApplicants::class, 'application_id')->withTrashed();
    }    
}
