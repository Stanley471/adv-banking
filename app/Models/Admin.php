<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Services\Cachable\ModelCaching\Traits\Cachable;
use Carbon\Carbon;

class Admin extends Authenticatable
{
    use Notifiable, Uuid, SoftDeletes, Cachable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'password',
        'status',
        'profile',
        'promo',
        'support',
        'deposit',
        'payout',
        'news',
        'message',
        'knowledge_base',
        'email_configuration',
        'general_settings',
        'investment',
        'loan',
        'savings',
        'token',
        'token_expired',
    ];
    protected $guard = 'admin';

    protected $table = "admin";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function savings($status = null, $type = null)
    {
        if ($status == 'all') {
            return Savings::whereType($type)
                ->when($type == 'duo', function ($query) {
                    return $query->whereJoinedStatus('accepted')->orWhere('partner_id', '=', $this->id);
                })
                ->orderBy('created_at', 'desc');
        } elseif ($status == 'active') {
            return Savings::whereType($type)->whereDate('expiry_date', '>', Carbon::today())->orderBy('created_at', 'desc');
        } elseif ($status == 'expired') {
            return Savings::whereType($type)->whereDate('expiry_date', '<', Carbon::today())->orderBy('created_at', 'desc');
        }
    }

    public function totalSavingsReturn($type = null, $active = null)
    {
        return Transactions::whereType('savings_return')->whereRelation('savings', 'type', '=', $type)
        ->when($type == 'regular', function ($query) use ($active) {
            return $query->whereRelation('savings', 'joined_status', '=', $active);
        })
        ->orderBy('created_at', 'desc');
    }

    public function automatedGateway()
    {
        return Gateway::wheretype(0)->orderBy('id', 'DESC')->get();
    }

    public function manualGateway()
    {
        return Gateway::wheretype(1)->orderBy('id', 'DESC')->get();
    }

    public function allGateway()
    {
        return Gateway::all();
    }

    public function emailTemplate()
    {
        return Emailtemplate::all();
    }

    public function unreadMessages()
    {
        return Messages::whereseen(0)->count();
    }

    public function pendingPayout()
    {
        return Transactions::whereStatus('pending')->whereType('payout')->count();
    }

    public function pendingLoan()
    {
        return LoanApplicants::whereStatus('pending')->count();
    }

    public function pendingDeposit()
    {
        return Transactions::whereStatus('pending')->whereType('deposit')->orWhere('type', 'bank_transfer')->whereStatus('pending')->count();
    }

    public function currency()
    {
        return Countrysupported::whereId(1)->first();
    }

    public function socialLinks()
    {
        return Social::all();
    }

    public function openTickets()
    {
        return Ticket::wherestatus(0)->count();
    }    
    
    public function pendingKYC()
    {
        return Business::whereIn('kyc_status', ['PROCESSING'])->orWhereIn('loan_status', ['processing'])->count();
    }

    public function userFunds($type = null)
    {
        $value = Cache::remember('userFunds' . $type, 600, function () use ($type) {
            $account = Balance::all()->sum('amount');
            $followed = Followed::whereStatus('pending')->get()->sum('amount');
            $savings = Savings::where('joined_status', '!=', 'paid')->get()->sum('amount');
            if($type == null){
                return $account + $followed;
            }elseif($type == 'units'){
                return $followed;
            }elseif($type == 'account'){
                return $account;
            }elseif($type == 'savings'){
                return $savings;
            }
        });
        return $value;
    }

    public function userLoan($type = null)
    {
        $value = Cache::remember('userLoan' . $type, 600, function () use ($type) {
            if ($type == null) {
                $charge = LoanApplicants::where('status', '!=', 'pending')->sum('amount');
            } elseif ($type == 'completed') {
                $charge = LoanApplicants::whereStatus('paid')->sum('amount');
            } elseif ($type == 'active') {
                $charge = Installment::whereIn('type', ['loan', 'product'])->whereStatus('unpaid')->whereRelation('application', 'defaulter', '=', 0)->sum('initial');
            } elseif ($type == 'defaulters') {
                $charge = Installment::whereIn('type', ['loan', 'product'])->whereStatus('unpaid')->whereRelation('application', 'defaulter', '=', 1)->sum('initial');
            }
            return $charge;
        });
        return $value;
    }

    public function loanProfit($duration = null)
    {
        $value = Cache::remember('loanProfit' . $duration, 600, function () use ($duration) {
            if ($duration == 'today') {
                $charge = Installment::whereIn('type', ['loan', 'product'])->whereStatus('paid')->whereDate('updated_at', Carbon::today());
            } elseif ($duration == 'week') {
                $charge = Installment::whereIn('type', ['loan', 'product'])->whereStatus('paid')->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            } elseif ($duration == 'month') {
                $charge = Installment::whereIn('type', ['loan', 'product'])->whereStatus('paid')->whereMonth('updated_at', '=', date('m'))->whereYear('updated_at', '=', date('Y'));
            } elseif ($duration == 'year') {
                $charge = Installment::whereIn('type', ['loan', 'product'])->whereStatus('paid')->whereYear('updated_at', '=', date('Y'));
            } elseif ($duration == null) {
                $charge = Installment::whereIn('type', ['loan', 'product'])->whereStatus('paid');
            }
            return [$charge->sum('profit'), $charge->count()];
        });
        return $value;
    }
    
    public function savingsDeposit($duration = null)
    {
        $value = Cache::remember('savingsDeposit' . $duration, 600, function () use ($duration) {
            if ($duration == 'today') {
                $charge = Transactions::whereType('savings_deposit')->whereStatus('success')->whereDate('updated_at', Carbon::today());
            } elseif ($duration == 'week') {
                $charge = Transactions::whereType('savings_deposit')->whereStatus('success')->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            } elseif ($duration == 'month') {
                $charge = Transactions::whereType('savings_deposit')->whereStatus('success')->whereMonth('updated_at', '=', date('m'))->whereYear('updated_at', '=', date('Y'));
            } elseif ($duration == 'year') {
                $charge = Transactions::whereType('savings_deposit')->whereStatus('success')->whereYear('updated_at', '=', date('Y'));
            } elseif ($duration == null) {
                $charge = Transactions::whereType('savings_deposit')->whereStatus('success');
            }
            return [$charge->sum('amount'), $charge->count()];
        });
        return $value;
    }

    public function userCharges($type = null, $duration = null)
    {
        $value = Cache::remember('userCharges' . $type . $duration, 600, function () use ($type, $duration) {
            if ($duration == null) {
                $charge = ($type === null) ? Transactions::whereStatus('success') : Transactions::whereStatus('success')->whereType($type);
            } else {
                if ($duration == 'today') {
                    $charge = Transactions::whereStatus('success')->whereDate('created_at', Carbon::today());
                } elseif ($duration == 'week') {
                    $charge = Transactions::whereStatus('success')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                } elseif ($duration == 'month') {
                    $charge = Transactions::whereStatus('success')->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'));
                } elseif ($duration == 'year') {
                    $charge = Transactions::whereStatus('success')->whereYear('created_at', '=', date('Y'));
                }
            }
            return [$charge->sum('charge'), $charge->count()];
        });
        return $value;
    }

    public function contacts($type = null)
    {
        $value = Cache::remember('contacts' . $type, 600, function () use ($type) {
            if ($type === null) {
                $contacts = Contact::all();
            } else if ($type === 'subscribed') {
                $contacts = Contact::whereSubscribed(1)->get();
            } else if ($type === 'unsubscribed') {
                $contacts = Contact::whereSubscribed(0)->get();
            } else if ($type === 'inbox') {
                $contacts = Messages::whereSeen(0)->get();
            } else if ($type === 'open_tickets') {
                $contacts = Ticket::whereStatus(0)->get();
            }
            return $contacts;
        });
        return $value;
    }

    public function customers($type = null)
    {
        $value = Cache::remember('customers' . $type, 600, function () use ($type) {
            if ($type === null) {
                $customers = User::withTrashed()->get();
            } else if ($type === 'active') {
                $customers = User::whereStatus(0)->get();
            } else if ($type === 'blocked') {
                $customers = User::whereStatus(1)->get();
            } else if ($type === 'kyc') {
                $customers = User::whereRelation('business', 'kyc_status', '!=', 'APPROVED')->get();
            } else if ($type === 'deleted') {
                $customers = User::onlyTrashed()->get();
            }
            return $customers->count();
        });
        return $value;
    }

    public function blogDraft()
    {
        return Blog::whereStatus(0)->count();
    }

    public function deletedMessages()
    {
        return Messages::whereNotNull('deleted_at')->withTrashed()->count();
    }

    public function pages()
    {
        return Page::orderBy('id', 'desc')->get();
    }

    public function devices()
    {
        return Devices::whereUser_id($this->id)->orderby('created_at', 'desc')->paginate(10);
    }
}
