<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use App\Models\PriceHistory;

class EditHistory extends Component
{
    private $units;
    public $val;
    public $plan;

    protected $listeners = ['saved' => '$refresh'];

    public function render()
    {
        $this->units = PriceHistory::wherePlanId($this->plan->id)->whereBetween('date', [$this->val->start_date, $this->val->end_date])->orderBy('date', 'desc')->get();
        return view('livewire.admin.invest.edit-history', ['units' => $this->units]);
    }
}
