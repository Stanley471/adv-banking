<?php

namespace App\Http\Livewire\Admin\Savings;

use Livewire\Component;
use Illuminate\Support\Str;

class EditRegular extends Component
{
    public $val;

    protected $rules = [
        'val.duration' => ['required', 'integer'],
        'val.interest' => ['required', 'numeric'],
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
            'duration' => $this->val->duration,
            'interest' => $this->val->interest
        ]);
        $this->emit('saved');
        $this->emit('success', __('Plan updated'));

    }

    public function render()
    {
        return view('livewire.admin.savings.edit-regular');
    }
}
