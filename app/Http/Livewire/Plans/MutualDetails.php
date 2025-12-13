<?php

namespace App\Http\Livewire\Plans;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Jobs\SendEmail;
use App\Models\Followed;
use App\Models\PriceHistory;
use App\Models\Transactions;
use App\Models\Units;
use App\Models\User;
use App\Jobs\CustomEmail;

class MutualDetails extends Component
{
    public $plan;
    public $type;
    public $user;
    public $settings;
    public $amount;
    public $sell_amount;
    public $terms;
    public $sell_terms;

    protected $listeners = ['saved' => '$refresh'];

    public function sell()
    {
        if ($this->user->business->kyc_status != 'APPROVED') {
            return $this->emit('alert', __('Complete compliance'));
        }
        $this->sell_amount = removeCommas($this->sell_amount);
        $balance = $this->user->getFirstBalance();
        $fee = calculateFee($this->sell_amount * $this->plan->first()?->amount, 'percent', 0, $this->plan->sale_percent);
        $min = ($this->plan->min_sell == null) ? 1 : $this->plan->min_sell;
        $this->validate(
            [
                'sell_amount' => ['required', 'integer', ($this->plan->min_sell == null) ? 'min:1' : 'min:' . $this->plan->min_sell, 'max:' . $this->user->followed($this->plan->id)->sum('units')],
                'sell_terms' => ['required'],
            ],
            [
                'sell_amount.required' => __('Amount is required'),
                'sell_amount.min' => __('Minimum amount is ') . $min . __(' units'),
                'sell_amount.max' => __('Maximum amount is ') . $this->user->followed($this->plan->id)->sum('units') . __(' units'),
            ]
        );

        if ($this->sell_amount > $this->user->followed($this->plan->id)->sum('units')) {
            return $this->addError('amount', __('Insufficient Units'));
        }

        //Get Follower;
        $followed = Followed::whereUserId($this->user->id)->wherePlanId($this->plan->id)->first();

        if ($this->plan->claim_duration != null) {
            $start = $followed->created_at;
            $end = $followed->created_at->add($this->plan->claim_duration.' month');
            if($start->diffInMonths() < $this->plan->claim_duration){
                return $this->addError('added', __('You can\'t sell units until '.$end->toDateString()));
            }
        }

        $balance->update(['amount' => $balance->amount + (($this->sell_amount * $this->plan->first()?->amount) - $fee)]);

        //Update Plan
        if ($this->plan->units != null) {
            $this->plan->update(['units' => $this->plan->units + $this->sell_amount]);
        }

        //Update Follower
        $followed->update([
            'units' => $followed->units - $this->sell_amount,
            'sold' => $followed->sold + ($this->sell_amount * $this->plan->first()->amount),
        ]);

        //Log unit
        $unit = Units::create([
            'user_id' => $this->user->id,
            'profit_id' => $followed->id,
            'plan_id' => $this->plan->id,
            'units' => $this->sell_amount,
            'type' => 'sale',
            'amount' => $this->sell_amount * $this->plan->first()->amount,
        ]);

        //Save Sale Fee
        $saleFee = Transactions::create([
            'user_id' => $this->user->id,
            'profit_id' => $followed->id,
            'business_id' => $this->user->business_id,
            'amount' => $fee,
            'charge' => null,
            'ref_id' => Str::uuid(),
            'trx_type' => 'debit',
            'type' => 'unit_sale_fee',
            'status' => 'success',
        ]);
        createAudit('Paid Investment Sale Fee' . $saleFee->ref_id);

        $trx = Transactions::create([
            'user_id' => $this->user->id,
            'profit_id' => $unit->id,
            'business_id' => $this->user->business_id,
            'amount' => $this->sell_amount * $this->plan->first()->amount,
            'charge' => $fee,
            'ref_id' => Str::uuid(),
            'trx_type' => 'credit',
            'type' => 'unit_sale',
            'status' => 'success',
        ]);

        dispatch(new CustomEmail('unit_sale', $trx->id));

        $this->reset(['sell_amount', 'sell_terms']);
        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('chart');
        $this->emit('success', 'Unit Sale successful');
    }

    public function purchase()
    {
        if ($this->user->business->kyc_status != 'APPROVED') {
            return $this->emit('alert', __('Complete compliance'));
        }
        $this->amount = removeCommas($this->amount);
        $balance = $this->user->getFirstBalance();
        if ($balance->waivers == 0) {
            $fee = calculateFee($this->amount * $this->plan->first()?->amount, $this->plan->fee_type, $this->plan->fiat_pc, $this->plan->percent_pc);
        } else {
            $fee = calculateFee($this->amount * $this->plan->first()?->amount, $this->plan->fee_type, 0, 0);
        }
        $min = ($this->plan->min_buy == null) ? 1 : $this->plan->min_buy;
        $this->validate(
            [
                'amount' => ['required', 'integer', ($this->plan->min_buy == null) ? 'min:1' : 'min:' . $this->plan->min_buy, ($this->plan->units != null) ? 'max:' . $this->plan->units : ''],
                'terms' => ['required'],
            ],
            [
                'amount.required' => __('Amount is required'),
                'amount.min' => __('Minimum amount is ') . $min . __(' units'),
                'amount.max' => __('Maximum amount is ') . number_format($this->plan->units) . __(' units'),
            ]
        );

        if (($this->user->getFirstBalance()->amount) < ($this->amount * $this->plan->first()?->amount + $fee)) {
            return $this->addError('amount', __('Insufficient Balance'));
        }

        if ($this->plan->units != null && $this->plan->units < $this->amount) {
            $this->emit('alert', __('Units have all been sold out'));
        }

        $balance->update(['amount' => $balance->amount - (($this->amount * $this->plan->first()?->amount) + $fee)]);

        if ($this->user->followedPlan($this->plan->id) == false) {
            $followed = Followed::create([
                'user_id' => $this->user->id,
                'plan_id' => $this->plan->id,
            ]);
            dispatch(new SendEmail($this->settings->email, $this->settings->site_name, 'New Follower', 'Hello admin, ' . $this->user->business->name . ' follwed plan ' . $this->plan->name, null, null, 0));
        }

        //Get Follower;
        $followed = Followed::whereUserId($this->user->id)->wherePlanId($this->plan->id)->first();

        //Update Plan
        if ($this->plan->units != null) {
            $this->plan->update(['units' => $this->plan->units - $this->amount]);
        }

        //Update Follower
        $followed->update([
            'units' => $followed->units + $this->amount,
            'amount' => $followed->amount + ($this->amount * $this->plan->first()?->amount),
        ]);

        //Log unit
        $unit = Units::create([
            'user_id' => $this->user->id,
            'profit_id' => $followed->id,
            'plan_id' => $this->plan->id,
            'units' => $this->amount,
            'type' => 'buy',
            'mutual' => 1,
            'amount' => $this->amount * $this->plan->first()?->amount,
        ]);

        //Delete Investment Fee
        if ($balance->waivers == 0) {
            $waiver = Transactions::create([
                'user_id' => $this->user->id,
                'profit_id' => $followed->id,
                'business_id' => $this->user->business_id,
                'amount' => $fee,
                'charge' => null,
                'ref_id' => Str::uuid(),
                'trx_type' => 'debit',
                'type' => 'investment_fee',
                'status' => 'success',
            ]);
            createAudit('Paid Investment Fee' . $waiver->ref_id);
        } else {
            $balance->update([
                'waivers' => $balance->waivers - 1,
                'used_waivers' => $balance->waivers + 1
            ]);
        }

        $trx = Transactions::create([
            'user_id' => $this->user->id,
            'profit_id' => $unit->id,
            'business_id' => $this->user->business_id,
            'amount' => $this->amount * $this->plan->first()?->amount,
            'charge' => $fee,
            'ref_id' => Str::uuid(),
            'trx_type' => 'debit',
            'type' => 'unit_purchase',
            'status' => 'success',
        ]);

        if ($this->settings->referral == 1 && $this->user->referral != null) {
            $user_update = User::whereId($this->user->referral)->first();
            $user_update->getFirstBalance()->update(['waivers' => $user_update->getFirstBalance()->waivers + 1]);
            $this->user->update(['ref_waivers' => $this->user->ref_waivers + 1]);
            createAudit('Received waiver from ' . $this->user->merchant_id, $this->user);
        }

        dispatch(new CustomEmail('unit_purchase', $trx->id));

        $this->reset(['amount', 'terms']);
        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('chart');
        $this->emit('success', 'Unit Purchase successful');
    }

    public function follow()
    {
        if ($this->user->followedPlan($this->plan->id) == false) {
            Followed::create([
                'user_id' => $this->user->id,
                'plan_id' => $this->plan->id,
            ]);
            dispatch(new SendEmail($this->settings->email, $this->settings->site_name, 'New Follower', 'Hello admin, ' . $this->user->business->name . ' follwed plan ' . $this->plan->name, null, null, 0));
        } else {
            $this->emit('alert', $this->plan->name . __(' already added to your porfolio'));
        }
        $this->emit('success', $this->plan->name . __(' has been added to your porfolio'));
    }

    public function render()
    {
        $log = PriceHistory::wherePlanId($this->plan->id)->whereBetween('date', [$this->plan->last()->date, $this->plan->first()->date])->orderBy('date', 'asc')->get();
        return view('livewire.plans.mutual-details', ['log' => $log]);
    }
}
