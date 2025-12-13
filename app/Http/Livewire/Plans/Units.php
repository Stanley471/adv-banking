<?php

namespace App\Http\Livewire\Plans;

use Livewire\Component;

class Units extends Component
{
    public $buy;
    public $user;

    public function render()
    {
        return view('livewire.plans.units');
    }
}
