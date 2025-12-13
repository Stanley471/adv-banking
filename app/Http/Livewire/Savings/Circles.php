<?php

namespace App\Http\Livewire\Savings;

use Livewire\Component;
use App\Models\Category;

class Circles extends Component
{
    private $plans;
    public $search = "";
    public $perPage = 100;
    public $orderBy = "name";
    public $sortBy = "asc";
    public $user;
    public $type;
    public $settings;

    protected $listeners = ['saved' => '$refresh'];

    public function render()
    {
        $this->plans = Category::whereStatus(1)->whereType('circle')
            ->when($this->search, function ($query) {
                $this->emit('drawer');
                $this->emit('color');
                $query->where(function ($query) {
                    $query->Where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
                $this->emit('color');
            })
            ->when(!in_array($this->type, ['weekly', 'monthly', 'all']), function ($query) {
                return $query->whereCatId($this->type);
            })
            ->when($this->type == 'weekly', function ($query) {
                return $query->whereCircleDuration($this->type);
            })
            ->when($this->type == 'monthly', function ($query) {
                return $query->whereCircleDuration($this->type);
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.savings.circles', ['plans' => $this->plans]);
    }
}
