<?php

namespace App\Http\Livewire\Loan;

use Livewire\Component;
use App\Models\LoanPlans;
use App\Models\Category;

class Market extends Component
{
    public $user;
    private $plans;
    public $settings;
    private $categoryAll;
    public $category;
    public $search = "";
    public $perPage = 100;
    public $orderBy = "asc";
    public $sortBy = "name";

    public function xBalance()
    {
        $business = $this->user->business;
        if ($business->reveal_balance == 1) {
            $business->update(['reveal_balance' => 0]);
        } else {
            $business->update(['reveal_balance' => 1]);
        }
    }

    public function render()
    {
        $this->plans = LoanPlans::whereType('product')->whereStatus(1)
            ->when($this->search, function ($query) {
                $this->emit('drawer');
                $query->where(function ($query) {
                    $query->Where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->when($this->category != null, function ($query) {
                $query->whereCatId($this->category);
            })
            ->orderby($this->sortBy, $this->orderBy)
            ->paginate($this->perPage);
        $this->categoryAll = Category::whereType('product')->get();
        return view('livewire.loan.market', ['plans' => $this->plans, 'categoryAll' => $this->categoryAll]);
    }
}
