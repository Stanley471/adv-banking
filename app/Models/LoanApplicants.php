<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class LoanApplicants extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $fillable = [
        'user_id',
        'plan_id',
        'amount',
        'percent',
        'payback',
        'duration',
        'ref_id',
        'status',
        'failed_percent',
        'defaulter',
        'acct_id',
        'staff_id',
    ];

    public function defaulters()
    {
        if(Installment::whereApplicationId($this->id)->whereStatus('unpaid')->whereDate('expiry_date', '<', \Carbon\Carbon::now())->get()->count()){
            return true;
        }else{
            return false;
        }
    }

    public function uncompleted()
    {
        if(Installment::whereApplicationId($this->id)->whereStatus('unpaid')->get()->count()){
            return true;
        }else{
            return false;
        }
    }


    public function staff()
    {
        return $this->belongsTo(Admin::class, 'staff_id')->withTrashed();
    }  
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function acct()
    {
        return $this->belongsTo(UserBank::class, 'acct_id')->withTrashed();
    }

    public function plan()
    {
        return $this->belongsTo(LoanPlans::class, 'plan_id')->withTrashed();
    }    
    
    
    public function installments()
    {
        return $this->hasMany(Installment::class, 'application_id')->orderBy('expiry_date', 'asc')->withTrashed();
    }
}
