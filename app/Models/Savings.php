<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Savings extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $dates = [
        'expiry_date',
        'reminder_month',
    ];

    protected $fillable = [
        'user_id',
        'plan_id',
        'partner_id',
        'circle_id',
        'ref_id',
        'name',
        'type',
        'goal',
        'amount',
        'automated',
        'interest',
        'expiry_date',
        'reminder_month',
        'joined_status',
        'resend_time',
        'day',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }  
    
    public function circle()
    {
        return $this->belongsTo(Category::class, 'circle_id')->withTrashed();
    } 
    
    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id')->withTrashed();
    }

    public function plan()
    {
        return $this->belongsTo(Category::class, 'plan_id')->withTrashed();
    }

    public function installments()
    {
        return $this->hasMany(Installment::class, 'application_id')->latest()->withTrashed();
    }    
    
    public function transactionDeposit()
    {
        return $this->hasMany(Transactions::class, 'save_id')->whereType('savings_deposit')->latest()->withTrashed();
    }
}
