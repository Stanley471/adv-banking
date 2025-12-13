<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;

class Savings extends Component
{
    public $client;

    public function render()
    {
        return view('livewire.admin.users.savings');
    }
}
