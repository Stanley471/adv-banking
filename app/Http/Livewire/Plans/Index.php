<?php

namespace App\Http\Livewire\Plans;

use Livewire\Component;

class Index extends Component
{
    public $user;

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
        return view('livewire.plans.index');
    }
}
