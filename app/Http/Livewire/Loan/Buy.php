<?php

namespace App\Http\Livewire\Loan;

use App\Models\Banks;
use App\Models\LoanApplicants;
use App\Models\UserBank;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Jobs\SendEmail;

class Buy extends Component
{
    public $user;
    public $plan;
    private $month;
    public $banks;
    public $settings; 
    private $getBank;
    public $user_bank;
    public $acct_no;
    public $acct_name;
    public $terms;
    public $amount;
    public $bank;

    public function mount(){
        $this->banks = $this->user->banks;
    }

    public function apply(){
        $this->validate(
            [
                'bank' => ['required'],
                'terms' => ['required'],
            ],
            [
                'bank.required' => __('Select a Bank account'),
            ]
        );

        if(LoanApplicants::whereUserId($this->user->id)->whereStatus('pending')->exists()){
            $this->emit('alert', 'You already have a pending loan application, wait till that application is sorted out!');
        }else{
            LoanApplicants::create([
                'user_id' => $this->user->id,
                'plan_id' => $this->plan->id,
                'acct_id' => $this->bank,
                'amount' => $this->plan->amount,
                'duration' => $this->plan->duration,
                'ref_id' => Str::uuid(),
                'status' => 'pending',
                'percent' => $this->plan->interest,
                'failed_percent' => $this->plan->failed_interest,
                'payback' => ($this->plan->amount * $this->plan->interest/100) + $this->plan->amount,
            ]);
            dispatch(new SendEmail($this->settings->email, 'Loan Application', 'New Loan Application Review request, ' . $this->user->business->name, $this->user->business->name . " Just submitted a new loan request, please review it & process applicantion", null, null, 0));
            return redirect()->route('user.followed', ['type' => 'loan'])->with('success', __('Loan Application submitted, kindly wait review'));
        }
    }
    
    public function addBank(){
        $this->validate([
            'user_bank' => ['required'],
            'acct_no' => ['required', 'digits_between:10,16'],
            'acct_name' => ['required', 'string', 'max:255'],
        ]);

        if(UserBank::whereBankId($this->user_bank)->whereUserId($this->user->id)->whereAcctNo($this->acct_no)->exists()){
            $this->emit('alert', 'Account already added');
        }else{
            UserBank::create([
                'user_id' => $this->user->id,
                'bank_id' => $this->user_bank,
                'acct_no' => $this->acct_no,
                'acct_name' => $this->acct_name,
            ]);
            $this->banks = UserBank::whereUserId($this->user->id)->get();
            $this->reset(['user_bank', 'acct_no', 'acct_name']);
            $this->emit('closeDrawer');
            $this->emit('success', 'Bank account added');
        }
    }

    public function render()
    {
        $duration = ($this->plan->installment == 1) ? '1 month' : $this->plan->duration.' month';
        $end = ($this->plan->installment == 1) ? $this->plan->duration - 1 : $this->plan->duration;
        $this->month = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now(), $duration, \Carbon\Carbon::now()->addMonths($end));
        $this->getBank = Banks::whereStatus(1)->get();
        return view('livewire.loan.buy', ['plan' => $this->plan, 'month' => $this->month, 'getBank' => $this->getBank]);
    }
}
