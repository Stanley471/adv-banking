<?php

namespace App\Http\Livewire\Admin\Kyc;

use Livewire\Component;

class Edit extends Component
{
    public $val;

    protected $rules = [
        'val.title' => ['required', 'string', 'max:255'],
        'val.type' => ['required', 'string', 'max:255'],
        'val.min' => ['required', 'integer'],
        'val.max' => ['required', 'integer'],
    ];

    public function delete()
    {
        $this->val->delete();
        $this->emit('saved');
        $this->emit('closeModal', $this->val->id);
    }

    public function update()
    {
        $this->validate();

        $this->val->update([
            'title' =>  $this->val->title,
            'type' =>  $this->val->type,
            'min' =>  $this->val->min,
            'max' =>  $this->val->max,
        ]);

        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('success', __('Kyc Doc updated'));
    }

    public function render()
    {
        return view('livewire.admin.kyc.edit');
    }
}
