<?php

namespace App\Http\Livewire\Plans;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Jobs\SendEmail;
use App\Models\Followed;
use App\Models\Transactions;
use App\Models\Units;
use App\Models\User;
use App\Jobs\CustomEmail;

class ProjectDetails extends Component
{
    public $plan;
    public $type;
    public $user;
    public $settings;
    public $amount;
    public $terms;

    protected $listeners = ['saved' => '$refresh'];

    public function purchase()
    {
        if ($this->user->business->kyc_status != 'APPROVED') {
            return $this->emit('alert', __('Complete compliance'));
        }
        $this->amount = removeCommas($this->amount);
        $balance = $this->user->getFirstBalance();
        if ($balance->waivers == 0) {
            $fee = calculateFee($this->amount * $this->plan->price, $this->plan->fee_type, $this->plan->fiat_pc, $this->plan->percent_pc);
        } else {
            $fee = calculateFee($this->amount * $this->plan->price, $this->plan->fee_type, 0, 0);
        }
        $this->validate(
            [
                'amount' => ['required', 'numeric', 'min:1', 'max:' . $this->plan->units],
                'terms' => ['required'],
            ],
            [
                'amount.required' => __('Amount is required'),
                'amount.min' => __('Amount must be between ' . 1 . ' & ' . number_format($this->plan->units) . ' units'),
                'amount.max' => __('Amount must be between ' . 1 . ' & ' . number_format($this->plan->units) . ' units'),
            ]
        );

        if (($this->user->getFirstBalance()->amount) < ($this->amount * $this->plan->price + $fee)) {
            return $this->addError('amount', __('Insufficient Balance'));
        }

        if ($this->plan->units > $this->amount) {
            $balance->update(['amount' => $balance->amount - (($this->amount * $this->plan->price) + $fee)]);

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
            $this->plan->update(['units' => $this->plan->units - $this->amount]);

            //Update Follower
            $followed->update([
                'units' => $followed->units + $this->amount,
                'amount' => $followed->amount + ($this->amount * $this->plan->price),
            ]);

            //Log unit
            $unit = Units::create([
                'user_id' => $this->user->id,
                'profit_id' => $followed->id,
                'plan_id' => $this->plan->id,
                'units' => $this->amount,
                'amount' => $this->amount * $this->plan->price,
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
                'amount' => $this->amount * $this->plan->price,
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
            $this->emit('chart');
            $this->emit('saved');
            $this->emit('success', 'Unit Purchase successful');
        } else {
            $this->emit('alert', __('Units have all been sold out'));
        }
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
        return view('livewire.plans.project-details');
    }
}
