<?php

namespace App\Http\Livewire\Admin\Loan;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\LoanPlans as Plan;

class Loanplans extends Component
{

    private $plans;
    public $search = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $admin;
    public $status = 1;
    public $installment = 0;
    public $name;
    public $min;
    public $max;
    public $interest;
    public $failed_interest;
    public $duration;
    public $suggested_amount;

    protected $listeners = ['saved' => '$refresh'];

    public function addPlan()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required'],
            'installment' => ['nullable'],
            'duration' => ['required', 'integer', 'min:1'],
            'min' => ['required', 'integer', 'lt:max'],
            'max' => ['required', 'integer', 'gte:min'],
            'interest' => ['required', 'numeric', 'lt:failed_interest'],
            'failed_interest' => ['required', 'numeric', 'gt:interest'],
            'suggested_amount' => ['required'],
        ]);

        $suggested_amount = collect(json_decode($this->suggested_amount))->pluck('value');

        if($this->installment == 1 && $this->duration == 1){
            return $this->addError('duration', 'Duration must be greater than 1 if installment is enabled');
        }

        if($suggested_amount->max() > $this->max){
            return $this->addError('suggested_amount', 'Amount must be less than max amount');
        }

        if($suggested_amount->min() < $this->min){
            return $this->addError('suggested_amount', 'Amount must be greated than min amount');
        }

        Plan::create([
            'name' =>  $this->name,
            'slug' =>  Str::slug($this->name, '-'),
            'min' =>  $this->min,
            'max' =>  $this->max,
            'installment' =>  $this->installment,
            'duration' =>  $this->duration,
            'interest' =>  $this->interest,
            'failed_interest' =>  $this->failed_interest,
            'suggested_amount' =>  $this->suggested_amount,
            'status' =>  $this->status,
            'created_by' => $this->admin->id,
            'edited_by' => $this->admin->id,
        ]);


        $this->reset(['name', 'status', 'installment', 'duration', 'min', 'max', 'interest', 'failed_interest', 'suggested_amount']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Plan Created');
    }

    public function render()
    {
        $this->plans = Plan::whereType('loan')->when($this->search, function ($query) {
            $this->emit('drawer');
            $query->where(function ($query) {
                $query->Where('name', 'like', '%' . $this->search . '%');
            });
        })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);

        return view('livewire.admin.loan.loanplans', ['plans' => $this->plans, 'admin' => $this->admin]);
    }
}
