<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;

class EditUnits extends Component
{
    public $val;

    protected $listeners = ['saved' => '$refresh'];

    protected $rules = [
        'val.amount' => ['required', 'numeric'],
    ];

    public function update()
    {
        $this->validate();

        $this->val->update([
            'amount' =>  $this->val->amount
        ]);
        $this->emit('success', __('Saved'));
    }

    public function render()
    {
        return view('livewire.admin.invest.edit-units');
    }
}
