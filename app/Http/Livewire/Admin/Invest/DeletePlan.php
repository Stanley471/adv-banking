<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class DeletePlan extends Component
{
    public $val;
    public $admin;

    public function delete()
    {
        if ($this->val->followed->count()) {
            return $this->emit('alert', __('Users already have units on this plan'));
        } else {
            Storage::delete('invest/'.$this->val->image);
            $this->val->delete();
            $this->emit('success', 'Plan deleted');
            $this->emit('saved');
            $this->emit('closeModal', $this->val->id);
        }
    }

    public function render()
    {
        return view('livewire.admin.invest.delete-plan');
    }
}
