<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;
use MBarlow\Megaphone\HasMegaphone;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes, Uuid, HasMegaphone;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $sortable = [
        'first_name',
        'last_name',
        'email',
        'status',
        'created_at',
    ];
    protected $fillable = [
        'first_name',
        'last_name',
        'country_id',
        'business_id',
        'email',
        'email_verify',
        'verification_code',
        'email_time',
        'ip_address',
        'password',
        'last_login',
        'fa_expiring',
        'account_type',
        'phone',
        'phone_verify',
        'phone_code',
        'phone_time',
        'otp_required',
        'token_expired',
        'social',
        'login_alert',
        'transaction_notification',
        'promotional_emails',
        'fa_status',
        'googlefa_secret',
        'contact_id',
        'social_account',
        'social_account_id',
        'status',
        'iso2',
        'mobile_code',
        'referral',
        'merchant_id',
        'ref_waivers',
        'avatar',
        'language',
        'referred_date',
        'email_auth',
    ];
    protected $guard = 'user';

    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function userFunds($type = null)
    {
        $account = Balance::whereUserId($this->id)->get()->sum('amount');
        $followed = Followed::whereStatus('pending')->whereUserId($this->id)->get()->sum('amount');
        return ($type == null) ? $account + $followed : (($type == 'units') ? $followed : $account);
    }

    public function followedPlan($plan = null)
    {
        return Followed::whereUserId($this->id)->orderby('id', 'DESC')
            ->when(($plan != null), function ($query) use ($plan) {
                return $query->wherePlanId($plan);
            })
            ->exists();
    }

    public function followed($plan = null, $type = null)
    {
        return Followed::whereUserId($this->id)->orderby('id', 'DESC')
            ->when(($plan != null), function ($query) use ($plan) {
                return $query->wherePlanId($plan);
            })
            ->when(($type != null), function ($query) use ($type) {
                return $query->whereRelation('plan', 'type', '=', $type);
            })
            ->get();
    }

    public function loanApplications($plan = null, $type = null)
    {
        return LoanApplicants::whereUserId($this->id)->whereIn('status', ['pending', 'running', 'paid'])->orderby('created_at', 'DESC')
            ->when(($plan != null), function ($query) use ($plan) {
                return $query->wherePlanId($plan);
            })
            ->when(($type != null), function ($query) use ($type) {
                return $query->whereRelation('plan', 'type', '=', $type);
            })
            ->get();
    }

    public function pendingLoan($type = null)
    {
        return $this->hasMany(Installment::class, 'user_id')->whereType($type)->whereStatus('unpaid');
    }

    public function savedMoney()
    {
        return $this->hasMany(Savings::class, 'user_id');
    }

    public function planUnits($plan = null)
    {
        return Units::whereUserId($this->id)->whereType('buy')->orderby('created_at', 'ASC')
            ->when(($plan != null), function ($query) use ($plan) {
                return $query->wherePlanId($plan);
            })
            ->get();
    }

    public function planDividend($plan = null)
    {
        return Units::whereUserId($this->id)->whereType('dividend')->orderby('created_at', 'ASC')
            ->when(($plan != null), function ($query) use ($plan) {
                return $query->wherePlanId($plan);
            })
            ->get();
    }

    public function planUnitsSold($plan = null)
    {
        return Units::whereUserId($this->id)->whereType('sale')->orderby('created_at', 'ASC')
            ->when(($plan != null), function ($query) use ($plan) {
                return $query->wherePlanId($plan);
            })
            ->get();
    }

    public function pendingSentDuo()
    {
        return $this->hasMany(Savings::class, 'user_id')->whereType('duo')->whereJoinedStatus('pending')->orderBy('created_at', 'desc');
    }

    public function pendingReceivedDuo()
    {
        return $this->hasMany(Savings::class, 'partner_id')->whereType('duo')->whereJoinedStatus('pending')->orderBy('created_at', 'desc');
    }

    public function savings($status = null, $type = null)
    {
        if ($status == 'all') {
            return $this->hasMany(Savings::class, 'user_id')->whereType($type)
                ->when($type == 'duo', function ($query) {
                    return $query->whereJoinedStatus('accepted')->orWhere('partner_id', '=', $this->id);
                })
                ->orderBy('created_at', 'desc');
        } elseif ($status == 'active') {
            return $this->hasMany(Savings::class, 'user_id')->whereType($type)->whereDate('expiry_date', '>', Carbon::today())->orderBy('created_at', 'desc');
        } elseif ($status == 'expired') {
            return $this->hasMany(Savings::class, 'user_id')->whereType($type)->whereDate('expiry_date', '<', Carbon::today())->orderBy('created_at', 'desc');
        }
    }

    public function totalSavings($type = null)
    {
        return $this->hasMany(Transactions::class, 'user_id')->whereType('savings_deposit')->whereRelation('savings', 'type', '=', $type)->orderBy('created_at', 'desc');
    }

    public function totalSavingsReturn($type = null)
    {
        return $this->hasMany(Transactions::class, 'user_id')->whereType('savings_return')->whereRelation('savings', 'type', '=', $type)->orderBy('created_at', 'desc');
    }

    public function userCharges($type = null, $duration = null)
    {
        if ($duration == null) {
            $charge = ($type === null) ? Transactions::whereUserId($this->id)->whereStatus('success')->get() : Transactions::whereUserId($this->id)->whereStatus('success')->whereType($type)->get();
        } else {
            if ($duration == 'today') {
                $charge = Transactions::whereUserId($this->id)->whereStatus('success')->where('created_at', '=', Carbon::today())->get();
            } elseif ($duration == 'week') {
                $charge = Transactions::whereUserId($this->id)->whereStatus('success')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            } elseif ($duration == 'month') {
                $charge = Transactions::whereUserId($this->id)->whereStatus('success')->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get();
            } elseif ($duration == 'year') {
                $charge = Transactions::whereUserId($this->id)->whereStatus('success')->whereYear('created_at', '=', date('Y'))->get();
            }
        }
        return [$charge->sum('charge'), $charge->count()];
    }

    public function userLoan($type = null)
    {
        if ($type == null) {
            $charge = LoanApplicants::whereUserId($this->id)->where('status', '!=', 'pending')->sum('amount');
        } elseif ($type == 'completed') {
            $charge = LoanApplicants::whereUserId($this->id)->whereStatus('paid')->sum('amount');
        } elseif ($type == 'active') {
            $charge = Installment::whereIn('type', ['loan', 'product'])->whereUserId($this->id)->whereStatus('unpaid')->whereRelation('application', 'defaulter', '=', 0)->sum('initial');
        } elseif ($type == 'defaulters') {
            $charge = Installment::whereIn('type', ['loan', 'product'])->whereUserId($this->id)->whereStatus('unpaid')->whereRelation('application', 'defaulter', '=', 1)->sum('initial');
        }
        return $charge;
    }

    public function loanProfit($duration = null)
    {
        if ($duration == 'today') {
            $charge = Installment::whereIn('type', ['loan', 'product'])->whereUserId($this->id)->whereStatus('paid')->whereDate('updated_at', Carbon::today());
        } elseif ($duration == 'week') {
            $charge = Installment::whereIn('type', ['loan', 'product'])->whereUserId($this->id)->whereStatus('paid')->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($duration == 'month') {
            $charge = Installment::whereIn('type', ['loan', 'product'])->whereUserId($this->id)->whereStatus('paid')->whereMonth('updated_at', '=', date('m'))->whereYear('updated_at', '=', date('Y'));
        } elseif ($duration == 'year') {
            $charge = Installment::whereIn('type', ['loan', 'product'])->whereUserId($this->id)->whereStatus('paid')->whereYear('updated_at', '=', date('Y'));
        } elseif ($duration == null) {
            $charge = Installment::whereIn('type', ['loan', 'product'])->whereUserId($this->id)->whereStatus('paid');
        }
        return [$charge->sum('profit'), $charge->count()];
    }

    public function lastMac()
    {
        return Devices::whereUser_id($this->business->user->id)->wherebusiness_id($this->business_id)->whereNotNull('mac_address')->orderby('created_at', 'desc')->first();
    }    
    
    public function devices()
    {
        return Devices::whereUser_id($this->business->user->id)->wherebusiness_id($this->business_id)->orderby('created_at', 'desc')->get();
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class, 'user_id')->whereBusinessId($this->business_id)->orderBy('created_at', 'desc');
    }

    public function banks()
    {
        return $this->hasMany(UserBank::class, 'user_id')->orderBy('created_at', 'desc');
    }

    public function beneficiary()
    {
        return $this->hasMany(Beneficiary::class, 'user_id')->orderBy('created_at', 'desc');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referral')->orderBy('created_at', 'desc');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id', 'reference');
    }

    public function audit()
    {
        return $this->hasMany(Audit::class, 'user_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id')->withTrashed();
    }

    public function businesses()
    {
        return $this->hasMany(Business::class, 'user_id');
    }

    public function getCountrySupported()
    {
        return $this->belongsTo(Countrysupported::class, 'country_id');
    }

    public function getCountry()
    {
        return Country::find($this->getCountrySupported->country_id);
    }

    public function getState()
    {
        $currency = Countrysupported::find(1);
        return Shipstate::wherecountry_code($currency->real->iso2)->orderby('name', 'asc')->get();
    }

    public function myState()
    {
        return Shipstate::whereid($this->state)->first();
    }

    public function getFirstBalance()
    {
        return Balance::where('user_id', $this->id)->wherebusiness_id($this->business_id)->where('country_id', $this->country_id)->first();
    }

    public function getBalance($id)
    {
        return Balance::where('user_id', $this->id)->wherebusiness_id($this->business_id)->where('country_id', $id)->first();
    }

    public function planUnitsProject($plan = null)
    {
        return Units::whereUserId($this->id)->whereMutual(0)->whereType('buy')->orderby('created_at', 'DESC')
        ->when(($plan != null), function ($query) use ($plan) {
            return $query->wherePlanId($plan);
        })
        ->get();
    }
}
