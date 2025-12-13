<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EncryptPersonalData;
use Carbon\Carbon;

class Business extends Model
{
    use HasFactory, Uuid, SoftDeletes, EncryptPersonalData;

    protected $casts = [
        'bank_account' => 'array'
    ];
    protected $dates = [
        'kyc_expiry', 'g_expiry'
    ];

    protected $fillable = [
        'user_id',
        'name',
        'reference',
        'reveal_balance',
        'kyc_status',
        'kyc_type',
        'pin',
        'tag',
        'otp_required',
        'b_day',
        'b_month',
        'b_year',
        'line_1',
        'line_2',
        'state',
        'city',
        'postal_code',
        'proof_of_address',
        'selfie',
        'doc_front',
        'doc_back',
        'source_of_funds',
        'kin_first_name',
        'kin_last_name',
        'kin_mobile',
        'kin_mobile_code',
        'kin_email',
        'kin_address',
        'doc_type',
        'doc_number',
        'financial_statement',
        'g_first_name',
        'g_last_name',
        'g_email',
        'g_mobile',
        'g_address',
        'g_mobile_code',
        'g_doc_type',
        'g_doc_number',
        'g_doc_front',
        'g_doc_back',
        'g_proof_of_address',
        'loan_status',
        'decline_reason',
        'kyc_expiry',
        'g_expiry',
        'country',
    ];

    protected $encryptable = [
        'ssn',
    ];

    public function receiver()
    {
        return $this->belongsTo(User::class, 'user_id');
    }    
    
    public function kyctype()
    {
        return $this->belongsTo(KycDoc::class, 'doc_type')->withTrashed();
    } 
    
    public function gkyctype()
    {
        return $this->belongsTo(KycDoc::class, 'g_doc_type')->withTrashed();
    }    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function customLinks()
    {
        return $this->hasMany(CustomLinks::class, 'business_id', 'reference');
    }
    
    public function getState()
    {
        return Shipstate::wherecountry_code($this->getCountry()->iso2)->orderby('name', 'asc')->get();
    }

    public function myState()
    {
        return $this->belongsTo(Shipstate::class, 'state');
    }

    public function myBusinessState()
    {
        return Shipstate::whereid($this->business_state)->first();
    }

    public function pendingTransfers()
    {
        return $this->hasMany(PendingTransfers::class, 'business_id', 'reference')->whereType('transfer');
    }
}
