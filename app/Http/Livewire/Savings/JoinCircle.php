<?php

namespace App\Http\Livewire\Savings;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Savings;
use App\Models\Transactions;
use Carbon\Carbon;
use App\Jobs\CustomEmail;

class JoinCircle extends Component
{
    public $val;
    public $settings;
    public $user;
    public $automation;
    public $duration;

    protected $listeners = ['saved' => '$refresh'];

    public function mount()
    {
        $this->automation = 1;
        $this->duration = 'monday';
    }

    public function getDuration()
    {
        if ($this->duration == 'monday') {
            return Carbon::MONDAY;
        } else if ($this->duration == 'tuesday') {
            return Carbon::TUESDAY;
        } else if ($this->duration == 'wednesday') {
            return Carbon::WEDNESDAY;
        } else if ($this->duration == 'thursday') {
            return Carbon::THURSDAY;
        } else if ($this->duration == 'friday') {
            return Carbon::FRIDAY;
        } else if ($this->duration == 'saturday') {
            return Carbon::SATURDAY;
        } else if ($this->duration == 'sunday') {
            return Carbon::SUNDAY;
        }
    }
    
    public function join()
    {
        if ($this->user->business->kyc_status != 'APPROVED') {
            return $this->emit('alert', __('Complete compliance'));
        }
        $balance = $this->user->getFirstBalance();

        $this->validate([
            'duration' => ['required'],
        ]);

        if ($this->automation == 1) {
            if ($this->user->getFirstBalance()->amount < $this->val->amount) {
                return $this->addError('added', __('Insufficient Balance'));
            } else {
                $balance->update(['amount' => $balance->amount - $this->val->amount]);
            }
        }

        if (Savings::whereUserId($this->user->id)->whereCircleId($this->val->id)->whereType('circle')->exists()) {
            return $this->addError('added', 'You are already a member of this circle');
        }

        $save = Savings::create([
            'user_id' => $this->user->id,
            'circle_id' => $this->val->id,
            'ref_id' => Str::uuid(),
            'type' => 'circle',
            'amount' => ($this->automation == 1) ? $this->val->amount : 0,
            'interest' => $this->val->interest,
            'reminder_month' => ($this->val->duration == 'weekly') ? Carbon::now()->copy()->next($this->getDuration()) : Carbon::create($this->duration . '-' . Carbon::now()->addMonth(1)->format('m') . '-' . date('Y')),
            'day' => $this->duration,
        ]);

        createAudit('Created saving plan' . $save->ref_id);

        if ($this->automation == 1) {
            $trx = Transactions::create([
                'user_id' => $this->user->id,
                'save_id' => $save->id,
                'business_id' => $this->user->business_id,
                'amount' => $this->val->amount,
                'ref_id' => Str::uuid(),
                'trx_type' => 'debit',
                'type' => 'savings_deposit',
                'status' => 'success',
            ]);
            dispatch(new CustomEmail('savings_deposit', $trx->id));
        }
        $this->emit('success', __('Circled joined'));
        $this->emit('saved');
        $this->emit('closeDrawer');
    }

    public function render()
    {
        return view('livewire.savings.join-circle');
    }
}
