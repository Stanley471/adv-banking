<?php

namespace App\Http\Livewire\Beneficiary;

use Livewire\Component;
use App\Models\Transactions;
use App\Models\Beneficiary;
use App\Jobs\CustomEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Edit extends Component
{
    public $val;
    public $ben_amount;
    public $pin;
    public $settings;
    public $user;

    public function delete()
    {
        $this->val->delete();
        $this->emit('saved');
        $this->emit('closeModal', $this->val->id);
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
                'pin' => ['required'],
            ],
            [
                'ben_amount.required' => __('Amount is required'),
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

        $benbalance = $this->val->recipient->getFirstBalance();

        //Update Balance
        $balance->update(['amount' => $balance->amount - ($this->ben_amount + $fee)]);
        $benbalance->update(['amount' => $benbalance->amount + $this->ben_amount]);

        $debit = Transactions::create([
            'user_id' => $this->user->id,
            'beneficiary_id' => $this->val->id,
            'business_id' => $this->user->business_id,
            'amount' => $this->ben_amount,
            'charge' => $fee,
            'ref_id' => Str::uuid(),
            'trx_type' => 'debit',
            'type' => 'debit_transfer',
            'status' => 'success',
        ]);

        $credit = Transactions::create([
            'user_id' => $this->val->recipient->id,
            'sender_id' => $this->user->id,
            'business_id' => $this->val->recipient->business_id,
            'amount' => $this->ben_amount,
            'ref_id' => Str::uuid(),
            'trx_type' => 'credit',
            'type' => 'credit_transfer',
            'status' => 'success',
        ]);

        createAudit('Sent Money to ' .$debit->beneficiary->recipient->business->name.' '.$debit->ref_id);
        createAudit('Received Money from ' .$credit->sender->business->name.' '.$credit->ref_id, $this->val);

        //Send Email
        dispatch(new CustomEmail('transfer_debit', $debit->id));
        dispatch(new CustomEmail('transfer_credit', $credit->id));

        $this->reset(['pin', 'ben_amount']);
        $this->emit('closeDrawer');
        $this->emit('success', __('Transfer successful'));
    }

    public function render()
    {
        return view('livewire.beneficiary.edit');
    }
}
