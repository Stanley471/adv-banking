<?php

namespace App\Http\Livewire\Admin\Loan;

use Livewire\Component;
use Illuminate\Support\Str;

class EditPlan extends Component
{
    public $val;
    public $admin;

    protected $rules = [
        'val.name' => ['required', 'string', 'max:255'],
        'val.status' => ['required'],
        'val.installment' => ['nullable'],
        'val.duration' => ['required', 'integer', 'min:1'],
        'val.min' => ['required', 'integer', 'lt:val.max'],
        'val.max' => ['required', 'integer', 'gte:val.min'],
        'val.interest' => ['required', 'numeric', 'lt:val.failed_interest'],
        'val.failed_interest' => ['required', 'numeric', 'gt:val.interest'],
        'val.suggested_amount' => ['required'],
    ];

    public function update()
    {
        $this->validate();
        $suggested_amount = collect(json_decode($this->val->suggested_amount))->pluck('value');

        if($this->val->installment == 1 && $this->val->duration == 1){
            return $this->addError('duration', 'Duration must be greater than 1 if installment is enabled');
        }

        if($suggested_amount->max() > $this->val->max){
            return $this->addError('suggested_amount', 'Amount must be less than max amount');
        }

        if($suggested_amount->min() < $this->val->min){
            return $this->addError('suggested_amount', 'Amount must be greated than min amount');
        }

        $this->val->update([
            'name' =>  $this->val->name,
            'slug' =>  Str::slug($this->val->name, '-'),
            'min' =>  $this->val->min,
            'max' =>  $this->val->max,
            'installment' =>  $this->val->installment,
            'duration' =>  $this->val->duration,
            'interest' =>  $this->val->interest,
            'failed_interest' =>  $this->val->failed_interest,
            'suggested_amount' =>  $this->val->suggested_amount,
            'status' =>  $this->val->status,
            'edited_by' => $this->admin->id,
        ]);
        if($this->val->status == 0){
            $this->emit('closeDrawer');
        }
        $this->emit('saved');
        $this->emit('success', __('Plan updated'));
    }


    public function delete()
    {
        if ($this->val->users->count()) {
            return $this->emit('alert', __('Users already have loans on this plan'));
        } else {
            $this->val->delete();
            $this->emit('success', 'Plan deleted');
            $this->emit('saved');
            $this->emit('closeModal', $this->val->id);
        }
    }

    public function render()
    {
        return view('livewire.admin.loan.edit-plan');
    }
}
