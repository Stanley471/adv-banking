<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use App\Models\FundComposition;

class Composition extends Component
{
    private $category;
    public $val;
    public $type;
    public $name;
    public $color = 'bg-warning';
    public $percent;
    public $perPage = 100;
    public $orderBy = "created_at";
    public $count = 0;
    public $sortBy = "desc";
    public $search = "";

    protected $listeners = ['saved' => '$refresh'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + $this->perPage;
        $this->emit('drawer');
    }

    public function addStatus()
    {
        $needed = 100 - $this->val->fundComposition->sum('percent');

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'percent' => ['required', 'numeric'],
        ]);
        if ($needed >= $this->percent) {
            FundComposition::create([
                'plan_id' =>  $this->val->id,
                'name' =>  $this->name,
                'color' =>  $this->color,
                'percent' =>  $this->percent
            ]);
            $this->emit('saved');
            $this->reset(['name', 'color', 'percent']);
            $this->emit('closeDrawer');
        } else {
            return $this->emit('alert', 'Percent must be less or equal to ' . $needed . '%');
        }
    }

    public function render()
    {
        $this->category = FundComposition::wherePlanId($this->val->id)
            ->when($this->search, function ($query) {
                $this->emit('drawer');
                $query->where(function ($query) {
                    $query->Where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('percent', 'like', '%' . $this->search . '%')
                        ->orWhere('color', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.admin.invest.composition', ['category' => $this->category]);
    }
}
