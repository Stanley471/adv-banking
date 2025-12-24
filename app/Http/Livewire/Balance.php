<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transactions;
use App\Models\UserBank;
use App\Models\Beneficiary;
use App\Models\Category;
use App\Jobs\CustomEmail;
use App\Jobs\SendEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Balance extends Component
{
    public $val;
    public $user;
    public $withdraw_type;
    public $other;
    public $requirements;
    public $type;
    public $settings;
    public $currency;
    public $amount;
    public $bank_amount;
    public $ben_amount;
    public $bank;
    public $pin;
    public $beneficiary;
    private $recent;
    public $trx;

    public function portfolio()
    {
        $pending_portfolio = [];
        $success_portfolio = [];
        $sold_portfolio = [];
        foreach ($this->user->followed() as $units) {
            if ($units->status == 'pending') {
                $pending_portfolio[] = $units->amount + ($units->plan->interest * $units->amount / 100);
            }
            if ($units->status == 'success') {
                $success_portfolio[] = $units->amount + ($units->plan->interest * $units->amount / 100);
            }
            if ($units->sold != null) {
                $sold_portfolio[] = $units->sold;
            }
        }
        return [array_sum($pending_portfolio), array_sum($success_portfolio), array_sum($sold_portfolio)];
    }

    public function xBalance()
    {
        $business = $this->user->business;
        if ($business->reveal_balance == 1) {
            $business->update(['reveal_balance' => 0]);
        } else {
            $business->update(['reveal_balance' => 1]);
        }
        
    }

    public function next()
    {
        if (($this->user->business->pin == null) || ($this->user->business->kin_first_name == null) || ($this->user->banks->count() == 0) || ($this->user->avatar == null) || ($this->user->business->kyc_status == null || $this->user->business->kyc_status == "RESUBMIT" || $this->user->business->kyc_status == "PENDING") || ($this->user->phone_verify == 0 && $this->settings->phone_verify == 1) || ($this->user->fa_status == 0)) {
            $next = 1;
        } else {
            $next = 0;
        }
        return $next;
    }

    public function completed()
    {
        $task = [
            ($this->user->business->kin_first_name == null) ? 1 : 0,
            ($this->user->business->pin == null) ? 1 : 0,
            ($this->user->banks->count() == 0) ? 1 : 0,
            ($this->user->avatar == null) ? 1 : 0,
            ($this->user->business->kyc_status == null || $this->user->business->kyc_status == "RESUBMIT" || $this->user->business->kyc_status == "PENDING") ? 1 : 0,
            ($this->user->phone_verify == 0 && $this->settings->phone_verify == 1) ? 1 : 0,
            ($this->user->fa_status == 0) ? 1 : 0,
        ];
        return [(count($task) - array_sum($task)) * 100, count($task)];
    }

    public function transfer()
    {
        $this->ben_amount = removeCommas($this->ben_amount);
        $fee = calculateFee($this->ben_amount, $this->settings->tct,  $this->settings->fiat_tc,  $this->settings->percent_tc);
        $balance = $this->user->getFirstBalance();
        $currency = $balance->getCurrency->real;
        $this->validate(
            [
                'ben_amount' => ['required', 'numeric', 'min:' . $this->settings->min_tl, 'max:' . $this->settings->max_tl],
                'beneficiary' => ['required'],
                'pin' => ['required'],
            ],
            [
                'ben_amount.required' => __('Amount is required'),
                'beneficiary.required' => __('Select a Beneficiary'),
                'ben_amount.min' => __('Amount must be between ' . $currency->currency_symbol . currencyFormat(number_format($this->settings->min_tl, 2)) . ' ' . $currency->currency . ' & ' . $currency->currency_symbol . currencyFormat(number_format($this->settings->max_tl, 2)) . ' ' . $currency->currency),
                'ben_amount.max' => __('Amount must be between ' . $currency->currency_symbol . currencyFormat(number_format($this->settings->min_tl, 2)) . ' ' . $currency->currency . ' & ' . $currency->currency_symbol . currencyFormat(number_format($this->settings->max_tl, 2)) . ' ' . $currency->currency),
            ]
        );

        if (!Hash::check($this->pin, $this->user->business->pin)) {
            return $this->addError('pin', __('Invalid pin.'));
        }
        if (($balance->amount  + $fee) < $this->ben_amount) {
            return $this->addError('amount', __('Insufficient balance.'));
        }

        if (!Beneficiary::whereId($this->beneficiary)->whereUserId($this->user->id)->exists()) {
            return $this->addError('beneficiary', __('Invalid beneficiary.'));
        }

        $ben = Beneficiary::whereId($this->beneficiary)->whereUserId($this->user->id)->first();
        $benbalance = $ben->recipient->getFirstBalance();

        //Update Balance
        $balance->update(['amount' => $balance->amount - ($this->ben_amount + $fee)]);
        $benbalance->update(['amount' => $benbalance->amount + $this->ben_amount]);

        $debit = Transactions::create([
            'user_id' => $this->user->id,
            'beneficiary_id' => $this->beneficiary,
            'business_id' => $this->user->business_id,
            'amount' => $this->ben_amount,
            'charge' => $fee,
            'ref_id' => Str::uuid(),
            'trx_type' => 'debit',
            'type' => 'debit_transfer',
            'status' => 'success',
        ]);

        $credit = Transactions::create([
            'user_id' => $ben->recipient->id,
            'sender_id' => $this->user->id,
            'business_id' => $ben->recipient->business_id,
            'amount' => $this->ben_amount,
            'ref_id' => Str::uuid(),
            'trx_type' => 'credit',
            'type' => 'credit_transfer',
            'status' => 'success',
        ]);

        createAudit('Sent Money to ' . $debit->beneficiary->recipient->business->name . ' ' . $debit->ref_id);
        createAudit('Received Money from ' . $credit->sender->business->name . ' ' . $credit->ref_id, $ben);

        //Send Email
        dispatch(new CustomEmail('transfer_debit', $debit->id));
        dispatch(new CustomEmail('transfer_credit', $credit->id));

       $this->reset(['beneficiary', 'ben_amount', 'pin']);
$this->emit('closeDrawer');
return redirect()->route('transaction.receipt', $debit->id);
    }

    public function payout()
    {
        $this->amount = removeCommas($this->amount);
        $fee = calculateFee($this->amount, $this->settings->pct,  $this->settings->fiat_pc,  $this->settings->percent_pc);
        $balance = $this->user->getFirstBalance();
        $currency = $balance->getCurrency->real;
        if ($this->withdraw_type == 'other') {
            $method = Category::whereId($this->other)->first();
            $fee = calculateFee($this->amount, 'both',  $method->fc,  $method->pc);
        }
        $this->validate(
            [
                'amount' => ['required', 'numeric', 'min:' . $this->settings->min_pl, 'max:' . $this->settings->max_pl],
                'withdraw_type' => ['required'],
                'bank' => [($this->withdraw_type == 'bank') ? 'required' : 'nullable'],
                'other' => [($this->withdraw_type == 'other') ? 'required' : 'nullable'],
                'requirements' => [($this->withdraw_type == 'other') ? 'required' : 'nullable', 'string'],
            ],
            [
                'amount.required' => __('Amount is required'),
                'bank.required' => __('Select a Bank account'),
                'other.required' => __('Select a Payout method'),
                'amount.min' => __('Amount must be between ' . $currency->currency_symbol . currencyFormat(number_format(($this->withdraw_type == 'bank') ? $this->settings->min_pl : $method->min, 2))) . ' ' . $currency->currency . ' & ' . $currency->currency_symbol . currencyFormat(number_format(($this->withdraw_type == 'bank') ? $this->settings->max_pl : $method->max, 2) . ' ' . $currency->currency),
                'amount.max' => __('Amount must be between ' . $currency->currency_symbol . currencyFormat(number_format(($this->withdraw_type == 'bank') ? $this->settings->min_pl : $method->min, 2))) . ' ' . $currency->currency . ' & ' . $currency->currency_symbol . currencyFormat(number_format(($this->withdraw_type == 'bank') ? $this->settings->max_pl : $method->max, 2) . ' ' . $currency->currency),
            ]
        );

        if (($this->user->getFirstBalance()->amount + $fee) < $this->amount) {
            return $this->addError('amount', __('Insufficient Balance'));
        }

        if ($this->withdraw_type == 'bank') {
            if (!UserBank::whereId($this->bank)->whereUserId($this->user->id)->exists()) {
                return $this->addError('amount', __('Invalid Bank Account'));
            }
        }

        $balance->update(['amount' => $balance->amount - ($this->amount + $fee)]);

        $object = [
            'user_id' => $this->user->id,
            'business_id' => $this->user->business_id,
            'amount' => $this->amount,
            'charge' => $fee,
            'ref_id' => Str::uuid(),
            'trx_type' => 'debit',
            'type' => 'payout',
            'status' => 'pending',
        ];

        if ($this->withdraw_type == 'bank') {
            $object = array_merge($object, [
                'acct_id' => $this->bank,
            ]);
        }else{
            $object = array_merge($object, [
                'withdraw_id' => $this->other,
                'details' => $this->requirements,
            ]);
        }
        $trx = Transactions::create($object);

        createAudit('Submitted withdraw request' . $trx->ref_id);

        dispatch(new CustomEmail('new_withdraw_request_admin', $trx->id));

        $this->reset(['bank', 'amount', 'withdraw_type', 'other', 'requirements']);
        $this->emit('closeDrawer');
        $this->emit('success', __('Payout request submitted'));
    }

    public function bankDeposit()
    {
        $this->bank_amount = removeCommas($this->bank_amount);
        $currency = $this->user->getFirstBalance()->getCurrency->real;
        $this->validate([
            'bank_amount' => ['required', 'numeric', 'min:1'],
            'trx' => 'required',
        ]);

        $trx = Transactions::create([
            'user_id' => $this->user->id,
            'business_id' => $this->user->business_id,
            'amount' => $this->bank_amount,
            'charge' => 0,
            'ref_id' => Str::uuid(),
            'bank_reference' => $this->trx,
            'trx_type' => 'credit',
            'type' => 'bank_transfer',
            'status' => 'pending',
        ]);

        createAudit('Created Bank Transfer Request of' . $this->bank_amount . $currency->currency);

        dispatch(new SendEmail($this->user->email, $this->user->first_name . ' ' . $this->user->last_name, 'Deposit request under review', 'We are currently reviewing your deposit of ' . currencyFormat(number_format($this->bank_amount, 2)) . ' ' . $currency->currency . ', once confirmed your balance will be credited automatically.<br>Thanks for working with us.', null, null, 0));
        dispatch(new SendEmail($this->settings->email, $this->settings->site_name, 'New bank deposit request', 'Hello admin, you have a new bank deposit request for ' . $trx->ref_id, null, null, 0));

        $this->reset(['bank_amount']);
        $this->emit('closeDrawer');
        $this->emit('closeModal');
        $this->emit('success', 'Bank deposit request is under review');
    }

    public function render()
    {
        $trx = Transactions::with(['user', 'business'])->whereUserId($this->user->id)->whereBusinessId($this->user->business_id)->limit(20)->latest()->get();
        $this->recent = $trx->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
        return view('livewire.balance', ['user' => $this->user, 'next' => $this->next(), 'completed' => $this->completed(), 'transactions' => $trx, 'group' => $this->recent, 'returns' => $this->portfolio()]);
    }
}
