<?php

namespace App\Http\Livewire\Bank;

use Livewire\Component;

class Edit extends Component
{
    public $val;

    public function delete()
    {
        $this->val->delete();
        $this->emit('saved');
        $this->emit('closeModal', $this->val->id);
    }

    public function render()
    {
        return view('livewire.bank.edit');
    }
}
