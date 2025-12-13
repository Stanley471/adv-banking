<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use App\Models\Category;

class Dividend extends Component
{
    public $perPage = 100;
    public $val;
    public $search = "";
    public $orderBy = "created_at";
    public $count = 0;
    public $sortBy = "desc";
    private $dividend;
    public $admin;
    public $type;

    protected $listeners = ['saved' => '$refresh'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + $this->perPage;
        $this->emit('drawer');
    }

    public function render()
    {
        $this->dividend = Category::wherePlanId($this->val->id)->whereType('dividend')
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.admin.invest.dividend', ['dividend' => $this->dividend]);
    }
}
