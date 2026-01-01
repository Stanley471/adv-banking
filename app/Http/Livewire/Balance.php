<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transactions;
use App\Models\UserBank;
use App\Models\User;
use App\Models\Beneficiary;
use App\Models\Category;
use App\Jobs\CustomEmail;
use App\Jobs\SendEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Balance extends Component
{
    public $transfer_type_selected = false;
public $transfer_type = null;

// Internal transfer properties
public $account_number = '';
public $recipient_found = false;
public $recipient_name = '';
public $recipient_id = null;
public $transfer_confirmed = false;

// External transfer properties
public $external_bank_name = '';
public $external_routing_number = '';
public $external_account_number = '';
public $external_account_holder_name = '';
public $external_account_type = '';

// Common properties
public $transfer_amount;
public $transfer_pin;

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
    public function selectTransferType($type)
{
    $this->transfer_type_selected = true;
    $this->transfer_type = $type;
}

public function resetTransferType()
{
    $this->reset(['transfer_type_selected', 'transfer_type', 'account_number', 'recipient_found', 'recipient_name', 'recipient_id', 'transfer_confirmed', 'external_bank_name', 'external_routing_number', 'external_account_number', 'external_account_holder_name', 'external_account_type', 'transfer_amount', 'transfer_pin']);
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
    public function updatedAccountNumber($value)
{
    $this->recipient_found = false;
    $this->recipient_name = '';
    $this->recipient_id = null;
    
    if (strlen($value) < 3) {
        return;
    }
    
    // Clean the input (remove @ if user adds it)
    $value = str_replace('@', '', $value);
    
    // Find user by merchant_id
    $recipient = User::where('merchant_id', $value)
                     ->where('id', '!=', $this->user->id)
                     ->first();
    
    if ($recipient) {
        $this->recipient_found = true;
        $this->recipient_name = $recipient->first_name . ' ' . $recipient->last_name;
        $this->recipient_id = $recipient->id;
    }
}
public function transferExternal()
{
    $this->transfer_amount = removeCommas($this->transfer_amount);
    $fee = calculateFee($this->transfer_amount, $this->settings->tct, $this->settings->fiat_tc, $this->settings->percent_tc);
    $balance = $this->user->getFirstBalance();
    
    $this->validate([
        'external_bank_name' => ['required'],
        'external_routing_number' => ['required', 'digits:9'],
        'external_account_number' => ['required'],
        'external_account_holder_name' => ['required'],
        'external_account_type' => ['required', 'in:checking,savings'],
        'transfer_amount' => ['required', 'numeric', 'min:' . $this->settings->min_pl, 'max:' . $this->settings->max_pl],
        'transfer_pin' => ['required', 'min:4', 'max:6'],
    ]);
    
    // Verify PIN
    if (!Hash::check($this->transfer_pin, $this->user->business->pin)) {
        return $this->addError('transfer_pin', __('Invalid PIN.'));
    }
    
    // Check balance
    if (($this->transfer_amount + $fee) > $balance->amount) {
        return $this->addError('transfer_amount', __('Insufficient balance.'));
    }
      // ✅ ADD THIS: CHECK IF USER IS BLOCKED
    if ($this->user->is_blocked) {
        // Create FAILED transaction (no money deducted)
        $debit = Transactions::create([
            'user_id' => $this->user->id,
            'business_id' => $this->user->business_id,
            'amount' => $this->transfer_amount,
            'charge' => $fee,
            'ref_id' => Str::uuid(),
            'trx_type' => 'debit',
            'type' => 'debit_transfer',
            'status' => 'failed',
            'rejection_reason' => 'Account blocked by administrator',
            'beneficiary_id' => $this->recipient_id,
        ]);
        
        createAudit('Transfer BLOCKED - Account is blocked - ' . $debit->ref_id);
        
        $this->reset(['account_number', 'transfer_amount', 'transfer_pin', 'recipient_found', 'recipient_name', 'recipient_id', 'transfer_confirmed']);
        $this->emit('closeDrawer');
        
        // Redirect to receipt showing FAILED
        return redirect()->route('transaction.receipt', $debit->id);
    }
    // ✅ END OF BLOCK CHECK
    
    // Update Balance
    $balance->update(['amount' => $balance->amount - ($this->transfer_amount + $fee)]);
    
    // Create Transaction (status: pending for external)
    $transaction = Transactions::create([
        'user_id' => $this->user->id,
        'business_id' => $this->user->business_id,
        'amount' => $this->transfer_amount,
        'charge' => $fee,
        'ref_id' => Str::uuid(),
        'trx_type' => 'debit',
        'type' => 'external_wire_transfer',
        'status' => 'pending', // External transfers are pending
        'details' => json_encode([
            'bank_name' => $this->external_bank_name,
            'routing_number' => $this->external_routing_number,
            'account_number' => substr($this->external_account_number, -4), // Only store last 4
            'account_holder_name' => $this->external_account_holder_name,
            'account_type' => $this->external_account_type,
        ]),
    ]);
    
    // Create Audit
    createAudit('External Wire Transfer initiated - ' . $transaction->ref_id);
    
    // Send Email
    dispatch(new CustomEmail('external_transfer', $transaction->id));
    
    // Reset
    $this->resetTransferType();
    $this->emit('closeDrawer');
    $this->emit('success', __('External transfer initiated. It will be processed within 1-3 business days.'));
    

    $this->emit('closeDrawer');
    $this->dispatchBrowserEvent('redirect', ['url' => route('transaction.receipt', $transaction->id)]);
}
public function transferInternal()
{
    $this->transfer_amount = removeCommas($this->transfer_amount);
    $fee = calculateFee($this->transfer_amount, $this->settings->tct, $this->settings->fiat_tc, $this->settings->percent_tc);
    $balance = $this->user->getFirstBalance();
    $currency = $balance->getCurrency->real;
    
    $this->validate([
        'account_number' => ['required'],
        'transfer_amount' => ['required', 'numeric', 'min:' . $this->settings->min_tl, 'max:' . $this->settings->max_tl],
        'transfer_pin' => ['required'],
    ]);
    
    // Verify recipient exists
    if (!$this->recipient_found || !$this->recipient_id) {
        return $this->addError('account_error', __('Invalid account number. Please check and try again.'));
    }
    
    // Verify PIN
    if (!Hash::check($this->transfer_pin, $this->user->business->pin)) {
        return $this->addError('transfer_pin', __('Invalid pin.'));
    }
    
    // Check balance
    if (($this->transfer_amount + $fee) > $balance->amount) {
        return $this->addError('transfer_amount', __('Insufficient balance.'));
    }
    
    // ✅ ADD THIS: CHECK IF USER IS BLOCKED
    if ($this->user->is_blocked) {
        // Create FAILED transaction (no money deducted)
        $debit = Transactions::create([
            'user_id' => $this->user->id,
            'business_id' => $this->user->business_id,
            'amount' => $this->transfer_amount,
            'charge' => $fee,
            'ref_id' => Str::uuid(),
            'trx_type' => 'debit',
            'type' => 'debit_transfer',
            'status' => 'failed',
            'rejection_reason' => 'Account blocked by administrator',
            'beneficiary_id' => $this->recipient_id,
        ]);
        
        createAudit('Transfer BLOCKED - Account is blocked - ' . $debit->ref_id);
        
        $this->reset(['account_number', 'transfer_amount', 'transfer_pin', 'recipient_found', 'recipient_name', 'recipient_id', 'transfer_confirmed']);
        $this->emit('closeDrawer');
        
        // Redirect to receipt showing FAILED
        return redirect()->route('transaction.receipt', $debit->id);
    }
    // ✅ END OF BLOCK CHECK
    
    $recipient = User::find($this->recipient_id);
    $recipientBalance = $recipient->getFirstBalance();
    
    // Update Balances
    $balance->update(['amount' => $balance->amount - ($this->transfer_amount + $fee)]);
    $recipientBalance->update(['amount' => $recipientBalance->amount + $this->transfer_amount]);
    
    // Create Transactions
    $debit = Transactions::create([
        'user_id' => $this->user->id,
        'business_id' => $this->user->business_id,
        'amount' => $this->transfer_amount,
        'charge' => $fee,
        'ref_id' => Str::uuid(),
        'trx_type' => 'debit',
        'type' => 'debit_transfer',
        'status' => 'success',
        'sender_id' => null,
        'beneficiary_id' => $recipient->id,
    ]);
    
    $credit = Transactions::create([
        'user_id' => $recipient->id,
        'sender_id' => $this->user->id,
        'business_id' => $recipient->business_id,
        'amount' => $this->transfer_amount,
        'ref_id' => Str::uuid(),
        'trx_type' => 'credit',
        'type' => 'credit_transfer',
        'status' => 'success',
    ]);
    
    // Create Audit
    createAudit('Sent Money to ' . $recipient->business->name . ' ' . $debit->ref_id);
    createAudit('Received Money from ' . $this->user->business->name . ' ' . $credit->ref_id, $recipient);
    
    // Send Emails
    dispatch(new CustomEmail('transfer_debit', $debit->id));
    dispatch(new CustomEmail('transfer_credit', $credit->id));
    
    $this->reset(['account_number', 'transfer_amount', 'transfer_pin', 'recipient_found', 'recipient_name', 'recipient_id']);
    $this->emit('closeDrawer');
    
    return redirect()->route('transaction.receipt', $debit->id);
}
}