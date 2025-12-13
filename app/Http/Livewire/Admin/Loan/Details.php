<?php

namespace App\Http\Livewire\Admin\Loan;

use Livewire\Component;
use App\Jobs\CustomEmail;
use App\Models\Installment;
use Illuminate\Support\Str;

class Details extends Component
{
    public $val;
    public $type;
    public $admin;
    public $reason;
    private $month;

    public function approve()
    {
        if ($this->val->status != 'running') {

            $duration = ($this->val->plan->installment == 1) ? '1 month' : $this->val->plan->duration.' month';
            $iduration = ($this->val->plan->installment == 1) ? $this->val->plan->duration : 1;
            $end = ($this->val->plan->installment == 1) ? $this->val->plan->duration - 1 : $this->val->plan->duration;
            $month = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now(), $duration, \Carbon\Carbon::now()->addMonths($end));

            if($this->val->plan->installment == 1){
                foreach ($month as $date){
                    Installment::create([
                        'user_id' => $this->val->user_id,
                        'plan_id' => $this->val->plan->id,
                        'application_id' => $this->val->id,
                        'payback' => (($this->val->amount * $this->val->percent/100) + $this->val->amount) / $iduration,
                        'failed' => (($this->val->amount * $this->val->failed_percent/100) + $this->val->amount) / $iduration,
                        'initial' => $this->val->amount / $iduration,
                        'expiry_date' => $date->addMonth(1)->toDateString(),
                        'ref_id' => Str::uuid(),
                        'type' => $this->val->plan->type,
                    ]);
                }
            }else{
                Installment::create([
                    'user_id' => $this->val->user_id,
                    'plan_id' => $this->val->plan->id,
                    'application_id' => $this->val->id,
                    'payback' => (($this->val->amount * $this->val->percent/100) + $this->val->amount) / $iduration,
                    'failed' => (($this->val->amount * $this->val->failed_percent/100) + $this->val->amount) / $iduration,
                    'initial' => $this->val->amount / $iduration,
                    'expiry_date' => $month->endDate,
                    'ref_id' => Str::uuid(),
                    'type' => $this->val->plan->type,
                ]);
            }

            $this->val->update([
                'status' => 'running',
                'staff_id' => $this->admin->id
            ]);

            dispatch(new CustomEmail('loan_approved'));
            createAudit('Loan request approved ' . $this->val->id, $this->val->user);
            $this->emit('saved');
            $this->emit('success', 'Loan approved');
            $this->emit('closeDrawer');
        } else {
            $this->emit('alert', 'Already approved');
        }
    }

    public function decline()
    {
        $this->validate([
            'reason' => ['required']
        ]);

        $this->val->update([
            'status' => 'declined',
            'staff_id' => $this->admin->id
        ]);

        dispatch(new CustomEmail('loan_declined', null, $this->reason));
        createAudit('Loan request Declined ' . $this->val->id, $this->val->user);
        $this->reset(['reason']);
        $this->emit('saved');
        $this->emit('success', 'Loan declined');
        $this->emit('closeDrawer');
    }

    public function render()
    {
        $duration = ($this->val->plan->installment == 1) ? '1 month' : $this->val->plan->duration.' month';
        $end = ($this->val->plan->installment == 1) ? $this->val->plan->duration - 1 : $this->val->plan->duration;
        $this->month = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now(), $duration, \Carbon\Carbon::now()->addMonths($end));
        return view('livewire.admin.loan.details', ['month' => $this->month, 'duration' => ($this->val->plan->installment == 1) ? $this->val->plan->duration : 1]);
    }
}
