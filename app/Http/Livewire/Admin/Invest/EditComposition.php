<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use App\Models\FundComposition;

class EditComposition extends Component
{
    public $val;

    protected $listeners = ['saved' => '$refresh'];

    protected $rules = [
        'val.name' => ['required', 'string', 'max:255'],
        'val.color' => ['required', 'string', 'max:255'],
        'val.percent' => ['required', 'numeric'],
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

        $others = FundComposition::where('id', '!=', $this->val->id)->sum('percent');
        $needed = 100 - $others;
        if ($needed >= $this->val->percent) {
            $this->val->update([
                'name' =>  $this->val->name,
                'color' =>  $this->val->color,
                'percent' =>  $this->val->percent
            ]);
            $this->emit('saved');
            $this->emit('success', __('Saved'));
        } else {
            return $this->emit('alert', 'Percent must be less or equal to ' . $needed . '%');
        }
    }

    public function render()
    {
        return view('livewire.admin.invest.edit-composition');
    }
}
