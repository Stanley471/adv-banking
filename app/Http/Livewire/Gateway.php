<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Transactions;
use Livewire\WithFileUploads;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Cache;

class Gateway extends Component
{
    use WithFileUploads;
    public $gateway;
    public $image;
    public $user;
    public $details;
    public $amount;
    public $settings;

    public function gateway()
    {
        $this->amount = removeCommas($this->amount);
        $currency = $this->user->getFirstBalance()->getCurrency->real;
        $this->validate([
            'amount' => ['required', 'numeric', 'min:' . $this->gateway->minamo, 'max:' . $this->gateway->maxamo],
            'details' => [($this->gateway->type == 1) ? 'required' : 'nullable', 'string'],
            'image' => ($this->gateway->type == 1) ? 'required' : 'nullable',
        ],
        [
            'amount.required' => __('Amount is required'),
            'amount.min' => __('Amount must be between ' . $currency->currency_symbol . 1 . ' ' . $currency->currency . ' & ' . $currency->currency_symbol . currencyFormat(number_format($this->user->getFirstBalance()->amount, 2)) . ' ' . $currency->currency),
            'amount.max' => __('Amount must be between ' . $currency->currency_symbol . 1 . ' ' . $currency->currency . ' & ' . $currency->currency_symbol . currencyFormat(number_format($this->user->getFirstBalance()->amount, 2)) . ' ' . $currency->currency),
        ]);

        $charge = ($this->amount * $this->gateway->percent_charge / 100) + $this->gateway->fiat_charge;
        $trx = Transactions::create([
            'user_id' => $this->user->id,
            'business_id' => $this->user->business_id,
            'gateway_id' => $this->gateway->id,
            'amount' => $this->amount,
            'charge' => $charge,
            'ref_id' => Str::uuid(),
            'secret' => Str::random(16),
            'trx_type' => 'credit',
            'type' => 'deposit',
            'status' => 'pending',
        ]);
        if ($this->gateway->type == 1) {
            $trx->update(['details' => $this->details]);
            if ($this->image) {
                $trx->update(['image' => $this->image->store('deposit')]);
            }
            dispatch(new SendEmail($this->user->email, $this->user->first_name . ' ' . $this->user->last_name, 'Deposit request under review', 'We are currently reviewing your deposit of ' . currencyFormat(number_format($this->amount, 2)) .' '. $currency->currency . ', once confirmed your balance will be credited automatically.<br>Thanks for working with us.', null, null, 0));
            dispatch(new SendEmail($this->settings->email, $this->settings->site_name, 'New Deposit request', 'Hello admin, you have a new bank deposit request for ' . $trx->ref_id, null, null, 0));
        }
        createAudit('Created Funding Request of ' . $this->amount . $currency->currency . ' via ' . $this->gateway->name);
        Cache::put('Track'.$this->user->id, $trx->ref_id);
        if ($this->gateway->type == 0) {
            return redirect()->route('deposit.confirm', ['deposit' => $trx->secret]);
        } else {
            return redirect()->route('user.dashboard')->with('success', __('Deposit request is under review'));
        }
       
    }

    public function render()
    {
        return view('livewire.gateway');
    }
}
