<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

class Logout extends Component
{
    public $user; 

    protected $listeners = ['eventAvatar' => '$refresh'];

    public function render()
    {
        return view('livewire.settings.logout');
    }
}
