<?php

namespace App\Http\Livewire\Loan;

use Livewire\Component;
use App\Models\LoanPlans;

class Index extends Component
{
    public $user;
    private $plans;
    public $settings; 

    public function xBalance()
    {
        $business = $this->user->business;
        if ($business->reveal_balance == 1) {
            $business->update(['reveal_balance' => 0]);
        } else {
            $business->update(['reveal_balance' => 1]);
        }
    }

    public function render()
    {
        $this->plans = LoanPlans::whereType('loan')->whereStatus(1)->get();
        return view('livewire.loan.index', ['plans' => $this->plans]);
    }
}
