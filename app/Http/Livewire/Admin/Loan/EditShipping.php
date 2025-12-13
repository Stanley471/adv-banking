<?php

namespace App\Http\Livewire\Admin\Loan;

use Livewire\Component;
use Illuminate\Support\Str;

class EditShipping extends Component
{
    public $val;

    protected $rules = [
        'val.state_id' => ['required', 'string'],
        'val.amount' => ['required', 'numeric', 'min:1'],
    ];

    public function delete()
    {
        $this->val->delete();
        $this->emit('saved');
        $this->emit('closeModal', $this->val->id);
    }

    public function update(){
        $this->validate();
        $this->val->update([
            'state_id' =>  $this->val->state_id,
            'amount' =>  $this->val->amount,
        ]);
        $this->emit('saved');
        $this->emit('success', __('Address updated'));

    }

    public function render()
    {
        return view('livewire.admin.loan.edit-shipping');
    }
}
