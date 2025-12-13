<?php

namespace App\Http\Livewire\Admin\Withdraw;

use Livewire\Component;

class Edit extends Component
{
    public $val;
    
    protected $rules = [
        'val.name' => ['required', 'string', 'max:255'],
        'val.min' => ['required', 'integer', 'lt:val.max'],
        'val.max' => ['required', 'integer', 'gte:val.min'],
        'val.status' => ['required'],
        'val.requirements' => ['required'],
        'val.fc' => ['required', 'numeric'],
        'val.pc' => ['required', 'numeric'],
    ];

    public function delete()
    {
        if($this->val->withdrawTrx->count()){
            return $this->emit('alert', __('Method can\'t be deleted, users have added this method already, disable this method to prevent new users from seeing it'));
        }
        $this->val->delete();
        $this->emit('saved');
        $this->emit('closeModal', $this->val->id);
    }

    public function update()
    {
        $this->validate();

        $this->val->update([
            'name' =>  $this->val->name,
            'min' => $this->val->min,
            'max' => $this->val->max,
            'status' => $this->val->status,
            'requirements' => $this->val->requirements,
            'fc' => $this->val->fc,
            'pc' => $this->val->pc,
        ]);

        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('success', __('Method updated'));
    }

    public function render()
    {
        return view('livewire.admin.withdraw.edit');
    }
}
