<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;
use Services\Cachable\ModelCaching\Traits\Cachable;

class Transactions extends Model
{
    use HasFactory, SoftDeletes, Uuid, Cachable;

    protected $fillable = [
        'user_id', 
        'staff_id', 
        'save_id', 
        'business_id', 
        'beneficiary_id', 
        'installment_id', 
        'sender_id', 
        'profit_id', 
        'withdraw_id', 
        'ref_id', 
        'amount', 
        'charge', 
        'status', 
        'trx_type', 
        'type',
        'acct_id',
        'gateway_id',
        'bank_reference',
        'description',
        'decline_reason',
        'secret',
        'txn_id',
        'btc_amo',
        'btc_wallet',
        'details',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }     
    
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id')->withTrashed();
    } 
    
    public function acct()
    {
        return $this->belongsTo(UserBank::class, 'acct_id')->withTrashed();
    }
    
    public function gateway()
    {
        return $this->belongsTo(Gateway::class, 'gateway_id')->withTrashed();
    }    

    public function business(){
        return $this->belongsTo(Business::class, 'business_id', 'reference')->withTrashed();
    }     
    
    public function beneficiary(){
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id')->withTrashed();
    } 

    public function staff()
    {
        return $this->belongsTo(Admin::class, 'staff_id')->withTrashed();
    }     
    
    public function units()
    {
        return $this->belongsTo(Units::class, 'profit_id')->withTrashed();
    }    
    
    public function followed()
    {
        return $this->belongsTo(Followed::class, 'profit_id')->withTrashed();
    } 

    public function installment()
    {
        return $this->belongsTo(Installment::class, 'installment_id')->withTrashed();
    }

    public function savings()
    {
        return $this->belongsTo(Savings::class, 'save_id')->withTrashed();
    }

    public function withdrawMethod()
    {
        return $this->belongsTo(Category::class, 'withdraw_id')->withTrashed();
    }
}
