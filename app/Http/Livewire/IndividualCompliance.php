<?php

namespace App\Http\Livewire;

use Livewire\Component;

class IndividualCompliance extends Component
{
    public $user;
    public $type;

    public function render()
    {
        return view('livewire.individual-compliance');
    }
}
